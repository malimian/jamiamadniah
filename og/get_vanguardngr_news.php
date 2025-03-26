<?php
require_once '../connect.php';

// Function to get category ID based on category name or content analysis
function getCategoryId($categoryName, $content = '') {
    
        echo "categoryName : ".$categoryName."</br>";

    // If category is explicitly specified in RSS
    if (!empty($categoryName)) {
        $categoryName = trim($categoryName);
        $cat = return_single_row("SELECT catid FROM category WHERE catname = '$categoryName' AND isactive = 1 AND soft_delete = 0 AND ParentCategory = 118 ");
        
        if ($cat) {
            return $cat['catid'];
        }
    }
    
    echo "Cat name : ".$categoryName."</br>";

    // Special handling for "News" category - analyze content
    if ($categoryName === 'News' && !empty($content)) {

        $content = strtolower($content);        
        echo "I am in</br>";
        echo "Content".$content."</br>";

        // Check for keywords in content to determine sub-category
        $categories = return_multiple_rows("SELECT catid, catname, cat_api_name FROM category WHERE isactive = 1 AND soft_delete = 0 AND ParentCategory = 118");

        print_r($categories);
        
        foreach ($categories as $cat) {
            $keywords = explode(',', strtolower($cat['cat_api_name']));
            foreach ($keywords as $keyword) {
                if (strpos($content, trim($keyword)) !== false) {
                    return $cat['catid'];
                }
            }
        }
    }
    
    // Default category (ID 118) if no match found
    return 118;
}

$feed_url = "https://www.vanguardngr.com/feed/";
$content = get_webpage($feed_url);

if (!empty($content)) {
    // Register the content namespace
    $rss = simplexml_load_string($content);
    $namespaces = $rss->getNamespaces(true);
    
    if ($rss === false) {
        die("Error: Failed to parse RSS feed");
    }

    foreach ($rss->channel->item as $item) {
        // Get content from content:encoded
        $contentEncoded = $item->children('content', true)->encoded;
        $article_content = !empty($contentEncoded) ? (string)$contentEncoded : (string)$item->description;

        // Get category from RSS (there might be multiple categories)
        $rssCategories = [];
        foreach ($item->category as $cat) {
            $rssCategories[] = (string)$cat;
        }
        $primaryCategory = !empty($rssCategories) ? $rssCategories[0] : 'News';
        
        $article_source = "Vanguard News";
        $article_author = escape(extractAuthorFromContent($article_content));
        $article_title = escape((string)$item->title);
        $article_description = escape((string)$item->description);
        $article_url = escape((string)$item->link);
        
        // Get category ID based on RSS category or content analysis
        $cat_id = getCategoryId($primaryCategory, $article_description);
        
        // Extract image from content:encoded or enclosure
        $article_urlToImage = '';
        if (isset($item->enclosure)) {
            $article_urlToImage = escape((string)$item->enclosure['url']);
        } else {
            // First try to get image from content:encoded
            preg_match('/<img[^>]+src="([^">]+)"/', $article_content, $matches);
            if (isset($matches[1])) {
                $article_urlToImage = escape($matches[1]);
            }
            // Fallback to description if no image found in content:encoded
            else {
                preg_match('/<img[^>]+src="([^">]+)"/', (string)$item->description, $matches);
                if (isset($matches[1])) {
                    $article_urlToImage = escape($matches[1]);
                }
            }
        }

        // Validate required fields
        if (!empty($article_source) && !empty($article_title) && !empty($article_content) && 
            !empty($article_url) && filter_var($article_url, FILTER_VALIDATE_URL)) {
            
            echo "Category ID: $cat_id</br>";
            echo $article_source . "</br>";
            echo "article_author : ".$article_author . "</br>";
            echo $article_description . "</br>";
            echo $article_url . "</br>";
            echo $article_urlToImage . "</br>";

            $isAlreadyPosted = return_single_ans("SELECT COUNT(*) FROM pages WHERE page_title = '$article_title'");

            if ($isAlreadyPosted == 0) {
                $slug = generateSeoURL($article_title) . ".html";

                if (!empty($slug) && !((strpos($article_url, 'youtube') !== false))) {
                    $site_template_id = 1;
                    $template_id = 7;

                    $page_meta_keywords = remove_utf($article_author) . "," . $primaryCategory . ",ibspotlight";
                    $featured_image = $article_urlToImage;
                    $article_read_time = estimateReadingTime($article_content);
                    $page_meta_desc =  mb_strimwidth(cleanContent($article_content), 0, 200, "...");
                    
                    echo Insert("INSERT INTO `pages` (`catid`, `site_template_id`, `template_id`, `page_url`, `page_title`, `sku`, `UniqueCode`, `inventory_number`, `barcode`, `plistprice`, `pprice`, `whole_sale_unit_price`, `stock_status`, `stock_qty`, `new_arrivals`, `featured_product`, `on_sale`, `best_seller`, `trending_item`, `hot_item`, `header`, `page_desc`, `page_meta_title`, `page_meta_keywords`, `page_meta_desc`, `pages_sequence`, `isactive`, `featured_image`, `isFeatured`, `views`, `showInNavBar`, `createdby`, `createdon`, `updatedon`, `soft_delete`, `article_url`, `article_author` , `article_read`) 
                        VALUES ('$cat_id', '$site_template_id', '$template_id', '$slug', '$article_title', NULL, NULL, NULL, NULL, '0', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', NULL, '$article_content', '$article_title', '$page_meta_keywords', '$page_meta_desc', '1', '1', '$featured_image', '0', '0', '0', '0', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP(), '0', '$article_url', '$article_author', '$article_read_time')");
                }
            }
        } else {
            echo "Skipping article due to missing or invalid data.</br>";
        }
    }
}

function estimateReadingTime($content, $wordsPerMinute = 200) {
    // Remove HTML tags
    $content = strip_tags($content);
    
    // Count the number of words
    $wordCount = str_word_count($content);
    
    // Calculate the estimated reading time in minutes
    $readingTimeMinutes = $wordCount / $wordsPerMinute;

    // If the reading time is less than 1 minute, round up to 1 minute
    if ($readingTimeMinutes < 1) {
        return "1 minute";
    }

    // Round up to the nearest minute
    $readingTimeMinutes = ceil($readingTimeMinutes);

    return $readingTimeMinutes . " minute" . ($readingTimeMinutes > 1 ? "s" : "");
}


function extractAuthorFromContent($content) {
    // Pattern to match "By Author Name" in strong tags
    $pattern = '/<p><strong>By\s+(.*?)<\/strong><\/p>/i';
    
    if (preg_match($pattern, $content, $matches)) {
        // Return the captured author name
        return trim($matches[1]);
    }
    
    // If pattern not found, try alternative patterns
    $alternativePatterns = [
        '/<strong>By\s+(.*?)<\/strong>/i',
        '/By\s+([^<]+)</i',
        '/<p>By\s+(.*?)<\/p>/i'
    ];
    
    foreach ($alternativePatterns as $pattern) {
        if (preg_match($pattern, $content, $matches)) {
            return trim($matches[1]);
        }
    }
    
    // If no author found, return empty string or default value
    return '';
}

?>