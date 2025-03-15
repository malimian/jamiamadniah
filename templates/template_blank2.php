<?php
if(!function_exists("header_t")) {
    function header_t(){
        return '
            
            <link href="css/main.css" rel="stylesheet">
            
            ';
    }
}
?>

<?php
if(!function_exists("footer_t")) {
    function footer_t(){
        return '
        ';
    }
}
?>

<?php
if(!function_exists("script_t")) {
    function script_t(){
        return '
        ';
    }
}
?>

<section>

<div class="Main">
      <div class="background-img">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="main-box">
                <div class="top-center-box">
                  <div class="img-large">
                    <div class="img-book">
                      <img class="img-responsive" src="<?php echo ABSOLUTE_IMAGEPATH.$content['featured_image'];?>" />
                    </div>
                    <p class="par-1"><?php echo $content['page_title'];?></p>
                  </div>
                </div>
              	<?php echo replace_sysvari(($content['page_desc']) , getcwd()."/"); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


</section>