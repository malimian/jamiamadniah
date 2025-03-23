<?php
require_once '../connect.php';

if (isset($_GET['category'])) {
    $category = $_GET['category'];

    $cat = return_single_row("SELECT * FROM category WHERE catname = '$category' AND isactive = 1 AND soft_delete = 0");
    $cat_id = $cat['catid'];
    $cat_api = $cat['cat_api_name'];

    $api_key = return_single_ans("SELECT api_key FROM `api_keys` WHERE isProcessed = 0 ORDER BY RAND() LIMIT 1;");

    $content = get_webpage("https://newsapi.org/v2/top-headlines?category=$cat_api&apiKey=" . $api_key);

    if (!empty($content)) {
        $content = json_decode($content, TRUE);

        if ($content['status'] == "error") {
            die(Update("UPDATE api_key SET isProcessed = 1 WHERE api_key = '$api_key'"));
        }

        $articles = $content['articles'];

        foreach ($articles as $article) {
            $article_source = escape($article['source']['name']);
            $article_author = escape($article['author']);
            $article_title = escape($article['title']);
            $article_description = escape($article['description']);
            $article_url = escape($article['url']);
            $article_urlToImage = escape($article['urlToImage']);
            $article_content = escape($article['content']);

            // Validate that required fields are not empty and $article_urlToImage is a valid image URL
            if (!empty($article_source) && !empty($article_author) && !empty($article_description) && !empty($article_url) && !empty($article_urlToImage) && filter_var($article_urlToImage, FILTER_VALIDATE_URL)) {
                echo $article_source . "</br>";
                echo $article_author . "</br>";
                echo $article_description . "</br>";
                echo $article_url . "</br>";
                echo $article_urlToImage . "</br>";

                $isAlreadyPosted = return_single_ans("SELECT COUNT(*) FROM pages WHERE page_title = '$article_title'");

                if ($isAlreadyPosted == 0) {
                    $slug = generateSeoURL($article_title) . ".html";

                    if (!empty($slug) && !((strpos($article_url, 'youtube') !== false))) {
                        $site_template_id = 1;
                        $template_id = 7;

                        $page_meta_keywords = remove_utf($article_author) . "," . $category . ",ibspotlight";
                        $featured_image = $article_urlToImage;
                        $article_read_time = estimateReadingTime($article_content);

                        echo Insert("INSERT INTO `pages` (`catid`, `site_template_id`, `template_id`, `page_url`, `page_title`, `sku`, `UniqueCode`, `inventory_number`, `barcode`, `plistprice`, `pprice`, `whole_sale_unit_price`, `stock_status`, `stock_qty`, `new_arrivals`, `featured_product`, `on_sale`, `best_seller`, `trending_item`, `hot_item`, `header`, `page_desc`, `page_meta_title`, `page_meta_keywords`, `page_meta_desc`, `pages_sequence`, `isactive`, `featured_image`, `isFeatured`, `views`, `showInNavBar`, `createdby`, `createdon`, `updatedon`, `soft_delete`, `article_url`, `article_author` , `article_read`) 
                            VALUES ('$cat_id', '$site_template_id', '$template_id', '$slug', '$article_title', NULL, NULL, NULL, NULL, '0', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', NULL, '$article_content', '$article_title', '$page_meta_keywords', '$article_description', '1', '1', '$featured_image', '0', '0', '0', '0', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP(), '0', '$article_url', '$article_author', '$article_read_time')");
                    }
                }
            } else {
                echo "Skipping article due to missing or invalid data.</br>";
            }
        }
    }
}




function estimateReadingTime($content, $wordsPerMinute = 200) {
    // Extract the number of truncated characters (e.g., [+1946 chars])
    preg_match('/\[\+(\d+)\s*chars\]/', $content, $matches);
    $truncatedChars = isset($matches[1]) ? (int)$matches[1] : 0;

    // Remove the truncated text from the content
    $content = preg_replace('/\[\+\d+\s*chars\]/', '', $content);

    // Count the number of characters in the visible content
    $visibleChars = strlen($content);

    // Total characters (visible + truncated)
    $totalChars = $visibleChars + $truncatedChars;

    // Estimate the number of words (assuming an average of 5 characters per word)
    $wordCount = $totalChars / 5;

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

?>