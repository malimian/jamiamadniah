<?php
require_once '../connect.php';

if(isset($_GET['category'])){

$category = $_GET['category'];

    $cat = return_single_row("Select * from category Where catname = '$category' and isactive = 1 and soft_delete = 0 ");
    $cat_id = $cat['catid'];
    $cat_api = $cat['cat_api_name'];


	$api_key = return_single_ans("SELECT api_key FROM `api_keys` Where isProcessed = 0 ");

    $content = get_webpage("https://newsapi.org/v2/top-headlines?category=$cat_api&apiKey=".$api_key);


if(!empty($content)){
    
    $content = json_decode($content , TRUE);

    if($content['status'] == "error"){
    	die(Update("Update api_key SET  isProcessed = 1 Where api_key = '$api_key' "));
    }


    $articles = $content['articles'];

   foreach($articles as $article){
     
    $article_source = escape($article['source']['name']);
    $article_author = escape($article['author']);
    $article_title = escape($article['title']);
    $article_description = escape($article['description']);
    $article_url = escape($article['url']);
    $article_urlToImage = escape($article['urlToImage']);
    $article_content = escape($article['content']);
     
    echo $article_source."</br>";
    echo $article_author."</br>";
    echo $article_description."</br>";
    echo $article_url."</br>";
    echo $article_urlToImage."</br>";
    
    $isAlreadyPosted = return_single_ans("Select count(*) from pages Where page_title = '$article_title' ");
    
        if($isAlreadyPosted == 0){
            
            if(!empty($article_urlToImage)){
                
                 $host = parse_url($article_urlToImage);
        
	            if(!isset($host['host']) || !isset($host['scheme'])) continue;
               
            }
             
            
           	$slug = generateSeoURL($article_title).".html";

            if(!empty($slug) && !((strpos($article_url, 'youtube') !== false)) && (strlen($slug) < 151 ) ){


                $site_template_id = 1;
                $template_id = 6;

                $page_meta_keywords = remove_utf($article_author).",".$category.",ibspotlight";
                $featured_image = $article_urlToImage;

				echo Insert("INSERT INTO `pages` ( `catid`, `site_template_id`, `template_id`, `page_url`, `page_title`, `sku`, `UniqueCode`, `inventory_number`, `barcode`, `plistprice`, `pprice`, `whole_sale_unit_price`, `stock_status`, `stock_qty`, `new_arrivals`, `featured_product`, `on_sale`, `best_seller`, `trending_item`, `hot_item`, `header`, `page_desc`, `page_meta_title`, `page_meta_keywords`, `page_meta_desc`, `pages_sequence`, `isactive`, `featured_image`, `isFeatured`, `views`, `showInNavBar`, `createdby`, `createdon`, `updatedon`, `soft_delete`, `article_url`, `article_author`) 

					VALUES ( '$cat_id', '$site_template_id', '$template_id', '$slug', '$article_title', NULL, NULL, NULL, NULL, '0', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', NULL, '$article_content', '$article_title', '$page_meta_keywords', '$article_description', '1', '1', '$featured_image', '0', '0', '0', '0', current_timestamp(), current_timestamp(), '0', '$article_url', '$article_author' )

					");


				die;

            }
                
                                
    
        }
    
                                
      
   } 
    
    
    
    
}


}