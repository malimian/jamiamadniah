<?php 
require_once '../connect.php';

// Assign category based on category name or content analysis
function getCategoryId($categoryName, $content = '') {
    $categoryName = strtolower(trim($categoryName));
    $knownCategories = ['news', 'sports', 'technology', 'business', 'health'];

    // Match RSS category directly
    if (in_array($categoryName, $knownCategories)) {
        $cat = return_single_row("SELECT catid FROM category WHERE LOWER(catname) = '$categoryName' AND isactive = 1 AND soft_delete = 0 AND ParentCategory = 118");
        if ($cat) return $cat['catid'];
    }

    // Analyze content for keywords
    $content = strtolower(strip_tags($content));
    $categories = return_multiple_rows("SELECT catid, catname, cat_api_name FROM category WHERE isactive = 1 AND soft_delete = 0 AND ParentCategory = 118");

    foreach ($categories as $cat) {
        $keywords = explode(',', strtolower($cat['cat_api_name']));
        foreach ($keywords as $keyword) {
            if (strpos($content, trim($keyword)) !== false) {
                return $cat['catid'];
            }
        }
    }

    // Fallback: News
    $cat = return_single_row("SELECT catid FROM category WHERE LOWER(catname) = 'news' AND isactive = 1 AND soft_delete = 0 AND ParentCategory = 118");
    return $cat ? $cat['catid'] : 118;
}

function estimateReadingTime($content, $wordsPerMinute = 200) {
    $content = strip_tags($content);
    $wordCount = str_word_count($content);
    $minutes = ceil($wordCount / $wordsPerMinute);
    return ($minutes < 2) ? "1 minute" : "$minutes minutes";
}

function extractAuthor($item, $content) {
    // 1. Try <author> tag with format: email (Author)
    if (!empty($item->author)) {
        if (preg_match('/\(([^)]+)\)/', (string)$item->author, $matches)) {
            return trim($matches[1]); // e.g., AFP from (AFP)
        }
    }

    // 2. Try to extract "By XYZ" in content
    $pattern = '/<p><strong>By\s+(.*?)<\/strong><\/p>/i';
    if (preg_match($pattern, $content, $matches)) return trim($matches[1]);

    $altPatterns = [
        '/<strong>By\s+(.*?)<\/strong>/i',
        '/By\s+([^<]+)</i',
        '/<p>By\s+(.*?)<\/p>/i'
    ];
    foreach ($altPatterns as $pattern) {
        if (preg_match($pattern, $content, $matches)) return trim($matches[1]);
    }

    return '';
}

// Fetch the RSS feed
$feed_url = "https://www.dawn.com/feeds/home";
$content = get_webpage($feed_url);

if (!empty($content)) {
    $rss = simplexml_load_string($content);
    if ($rss === false) die("Error: Failed to parse RSS feed");

    foreach ($rss->channel->item as $item) {
        $contentEncoded = $item->children('content', true)->encoded;
        $article_content = !empty($contentEncoded) ? (string)$contentEncoded : (string)$item->description;

        // Remove <a href> tags
        $article_content = preg_replace('#<a[^>]*>(.*?)</a>#is', '$1', $article_content);

        // Extract categories
        $rssCategories = [];
        foreach ($item->category as $cat) {
            $rssCategories[] = trim((string)$cat);
        }
        $primaryCategory = !empty($rssCategories) ? strtolower($rssCategories[0]) : '';

        // Determine final category ID
        $cat_id = getCategoryId($primaryCategory, $article_content);

        // Collect metadata
        $article_title = escape((string)$item->title);
        $article_description = escape((string)$item->description);
        $article_url = escape((string)$item->link);
        $article_author = escape(extractAuthor($item , $article_content));
        $article_source = "Dawn News";

        // Extract image (media:content → enclosure → img)
        $namespaces = $item->getNamespaces(true);
        $article_urlToImage = '';

        if (isset($namespaces['media'])) {
            $media = $item->children($namespaces['media']);
            if (isset($media->content)) {
                $article_urlToImage = escape((string)$media->content->attributes()->url);
            }
        }
        if (empty($article_urlToImage) && isset($item->enclosure)) {
            $article_urlToImage = escape((string)$item->enclosure['url']);
        }
        if (empty($article_urlToImage)) {
            preg_match('/<img[^>]+src="([^">]+)"/', $article_content, $matches);
            if (isset($matches[1])) $article_urlToImage = escape($matches[1]);
        }

        // Insert to DB if valid
        if (!empty($article_title) && !empty($article_content) && !empty($article_url)) {
            $isAlreadyPosted = return_single_ans("SELECT COUNT(*) FROM pages WHERE page_title = '$article_title'");
            if ($isAlreadyPosted == 0) {
                $slug = generateSeoURL($article_title) . ".html";
                if (!empty($slug) && strpos($article_url, 'youtube') === false) {
                    $site_template_id = 1;
                    $template_id = 7;
                    $page_meta_keywords = escape(remove_utf(clean($article_author))) . "," . $primaryCategory . ",ibspotlight";
                    $page_meta_desc = mb_strimwidth(escape(strip_tags($article_content)), 0, 200, "...");
                    $article_read_time = estimateReadingTime($article_content);
                    $article_content = escape($article_content);

                    echo Insert("INSERT INTO `pages` (
                        `catid`, `site_template_id`, `template_id`, `page_url`, `page_title`,
                        `page_desc`, `page_meta_title`, `page_meta_keywords`, `page_meta_desc`,
                        `pages_sequence`, `isactive`, `featured_image`, `article_url`,
                        `article_author`, `article_read`, `country`
                    ) VALUES (
                        '$cat_id', '$site_template_id', '$template_id', '$slug', '$article_title',
                        '$article_content', '$article_title', '$page_meta_keywords', '$page_meta_desc',
                        '1', '1', '$article_urlToImage', '$article_url',
                        '$article_author', '$article_read_time', 'pk'
                    )");
                }
            }
        } else {
            echo "Skipping article: missing required data.<br>";
        }
    }
}
?>
