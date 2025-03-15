<?php 
include 'front_connect.php';


if(isset($_GET['url']) && !empty($_GET['url']) ){
	if(strpos($_GET['url'], '.html') !== false) $url = $_GET['url'];
	else $url = $_GET['url'].".html";
}
else exit( '<script type="text/javascript"> window.location = "'.ERROR_404.'" </script>');

$header;
$template_ = "";
$main_header = "";
$script;
$footer;
$page;


$isPageLoad = "";



$content = return_single_row("Select 
    pages.*,
	".$isPageLoad."
	catname , 
	cat_url , 
	template_id , 
	site_template_id
	from pages 
	LEFT Join 
	category 
	On pages.catid  =  category.catid 
	Where pages.soft_delete = 0 
	AND  category.soft_delete = 0 
	And page_url='$url' 
	AND pages.isactive = 1 ");

if(empty($content)) exit( '<script type="text/javascript"> window.location = "'.ERROR_404.'" </script>');

if(!empty($content['header'])) {
	$header[] = $content['header'];
}

$page = return_single_row("SELECT * FROM site_template Where st_id = ".$content['site_template_id']. " $and_gc and isactive = 1 ");


if(!empty($page['st_header'])) {
 	$header[] = replace_sysvari($page['st_header'] , null);
}

if(!empty($page['st_script'])) {
 	$script[] = replace_sysvari($page['st_script'], null);
}

if(!empty($page['st_footer'])) {
 	$footer[] = replace_sysvari($page['st_footer'] , getcwd()."/");
}


 $template_page = return_single_ans("Select template_page from og_template Where template_id = ".$content['template_id']. " $and_gc and isactive = 1 ");

if(!empty($template_page)){
	
	 $template_ = include_module('templates/'.$template_page , array('content' => $content , 'PAGE_LOADER' => PAGE_LOADER , 'PAGE_ID' => $content['pid']) , false);
	 
	 if(function_exists("header_t"))
	 	$header[] = header_t();
	  if(function_exists("script_t"))
	 	$script[] = script_t();
	 if(function_exists("footer_t"))
	 	$footer[] = footer_t();

}
	//Remove duplicates
	// $header = array_unique($header);
	// $script = array_unique($script);
	// $footer = array_unique($footer);

	$main_header = front_header($content['page_meta_title'],  $content['page_meta_keywords']  , $content['page_meta_desc'], $header);

	// Building TEMPLATE -------------------------------------------------

 	echo replace_sysvari($main_header);
	echo replace_sysvari($page['st_menue'] , getcwd()."/");
	echo replace_sysvari($template_, getcwd()."/");

	if(PAGE_LOADER == 1)
		require_once 'modals/loading.php';
?>

<?php if(PAGE_LOADER == 1){?>
<script type="text/javascript">
	var pageid = "<?php echo $content['pid'];?>";
</script>
<script type="text/javascript" src="js/info.js"></script>
<?php }?>

<?php 
	if(!empty($script))
		echo replace_sysvari(front_script($script));
	if(!empty($footer))
	  echo replace_sysvari(front_footer($footer));
?>

