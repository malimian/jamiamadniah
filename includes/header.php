<?php
function front_header($title = null ,  $keywords = null  ,$description = null ,$libs = null){
?><!DOCTYPE html>
<html>
<head>
    <title><?php echo $title;?></title>
    <meta name="title" content="<?php echo $title;?>">
    <meta name="description" content="<?php echo $description;?>">
    <meta name="keywords" content="<?php echo $keywords;?>">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="author" content="<?php Company;?>">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
    <script src="js_settings.js"></script>
    <?php
    $lang = "en";
    if(isset($_GET['lang'])){
        $lang = $_GET['lang'];
        setcookie('googtrans', "/en/".$lang);
    }
    
    ?>
    
            <script type="text/javascript">
            function googleTranslateElementInit() {
              new google.translate.TranslateElement({pageLanguage: 'en' , includedLanguages : 'ar,ur,en' , layout: google.translate.TranslateElement.InlineLayout.SIMPLE }, 'google_translate_element');
            }
            </script>
            
            <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <?php

        if(!empty($libs)){
        foreach ($libs as $lib){
            echo $lib;
         }
        }
     ?>

</head>


<body>

<?php }?>


<?php
function Baseheader($title = null ,  $keywords = null  ,$description = null ,$libs = null , $template_id = null){
    
    global $and_gc;
   
   $header = "";

   if(!empty($template_id)){

    $site_header = return_single_ans("Select st_header from site_template Where st_id = $template_id $and_gc and isactive = 1 ");

        $header = $site_header;
   }

?><!DOCTYPE html>
<html>
<head>
    <title><?php echo $title;?></title>
    <meta name="title" content="<?php echo $title;?>">
    <meta name="description" content="<?php echo $description;?>">
    <meta name="keywords" content="<?php echo $keywords;?>">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="author" content="<?php Company;?>">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
    
    <?php
    $lang = "en";
    if(isset($_GET['lang'])){
        $lang = $_GET['lang'];
        setcookie('googtrans', "/en/".$lang);
    }
    
    ?>
    
            <script type="text/javascript">
            function googleTranslateElementInit() {
              new google.translate.TranslateElement({pageLanguage: 'en' , includedLanguages : 'ar,ur,en' , layout: google.translate.TranslateElement.InlineLayout.SIMPLE }, 'google_translate_element');
            }
            </script>
            
            <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
            
    <?php
      echo $header;
      echo $libs;
    ?>

</head>


<body>
    
<?php }?>