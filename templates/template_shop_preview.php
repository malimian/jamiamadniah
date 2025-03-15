<?php
$GLOBALS['content'] = $content;

if(!function_exists("header_t")) {
    function header_t(){
        return '
            <meta property="og:site_name" content="'.SITE_TITLE.'">
            <meta property="og:title" content="'.replace_sysvari($GLOBALS['content']['page_title']).'" />
            <meta property="og:description" content="'.replace_sysvari($GLOBALS['content']['page_title']).'" />
            <meta property="og:image" itemprop="image" content="'.BASE_URL.ABSOLUTE_IMAGEPATH.$GLOBALS['content']['featured_image'].'">

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
<style type="text/css">

.article{
    color : #26262e;
}


   #sendbtn { 
    background-color: #47c97b; /* Green */ 
    border: none; color: white; 
    text-align: center; 
    text-decoration: none; 
    font-size: 16px; 
    border-radius: 20px; 
    padding: 10px 20px; 
    margin-top: 10px !important; 
    width: fit-content; 
    margin: auto; 
    cursor: pointer 
}
</style>

<!--Whatsapp-->

<?php echo include_module('modules/module_whatsapp.php' , array('number' => SITE_TELNO , 'text' => 'Hi , I want to speak with '.SITE_TITLE));?>

<!--Whatsapp-->

<?php 
$user = return_single_row("Select username , fullname , profile_pic from loginuser Where soft_delete = 0 and isactive = 1  and id = ".$content['createdby']);
?>
<div class="blog-single gray-bg">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-lg-8 m-15px-tb">
                    <article class="article">
                        <div class="article-img"> 
                        <?php
                        if(!empty($content['featured_image'])){
                        ?>
                            <img class="img-fluid img-responsive blogimg" src="<?php echo ABSOLUTE_IMAGEPATH.$content['featured_image'];?>" title="<?php echo $content['page_title'];?>" alt="<?php echo $content['page_title'];?>"></div>

                        <?php }?>
                        <div class="article-title">
                            <h2><?php echo replace_sysvari($content['page_title']);?></h2>
                            <div class="media">
                                <div class="avatar">
                                    <img src="<?php echo ABSOLUTE_IMAGEPATH.$user['profile_pic'];?>" title="" alt="">
                                </div>
                                <div class="media-body">
                                    <label><?php echo $user['username'];?></label>
                                    <span><?php 
                                    $dt = new DateTime($content['createdon']);
                                    $date = $dt->format('d F Y');
                                    echo $date;
                                    ?></span>
                                </div>

                            </div>
                            
                        </div>
                                <div class="row">
                                    <a id="sendbtn" href="https://api.whatsapp.com/send?phone=923009485284&text=<?php echo rawurlencode("Hello I want to Buy ".$content['page_title']."\nThank you \n".BASE_URL.$content['page_url'])?>" title="Complete order on WhatsApp to buy <?php echo $content['page_title']?>" target="_blank"><i class="bi bi-whatsapp"></i> Buy via WhatsApp</a>
                                </div>

                        <?php if($PAGE_LOADER == 1){?>

                            <div class="article-content" id="div_content"></div>

                            <?php } else {
                                echo replace_sysvari($content['page_desc'] , getcwd()."/");
                            }?>
                            
                            
                            <!-- Gallery -->
                <?php
                    $photogallery = return_multiple_rows("Select * from images Where pid = ".$content['pid']." and isactive = 1 and soft_delete = 0");
                    if(!empty($photogallery)){
                ?>
                <div class="container">
                	<div class="row">
                		<div class="row">
                            <?php 
                                foreach($photogallery as $photogallery_){
                            ?>
                            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                                   data-image="photo_gallery/<?php echo $photogallery_['i_name'];?>"
                                   data-target="#image-gallery">
                                    <img class="img-thumbnail"
                                         src="photo_gallery/<?php echo $photogallery_['i_name'];?>"
                                         alt="<?php echo $photogallery_['i_name'];?>">
                                </a>
                            </div>
                            <?php }?>
                        </div>


                                    <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="image-gallery-title"></h4>
                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <img id="image-gallery-image" class="img-responsive col-md-12" src="">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
                                                    </button>
                            
                                                    <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                        	</div>
                        </div>
                        <?php }?>
                            <!-- Gallery -->

                        <div class="nav tag-cloud">
                        <?php $keywords = return_single_ans("Select page_meta_keywords from pages Where pid = ".$content['pid']);
                            $keywords = explode(',', $keywords);
                            foreach ($keywords as $keyword) {
                                if(!empty($keyword))
                                echo '<a href="#">'.$keyword.'</a>';
                            }
                         ?>
                        </div>
                    </article>
                    <div class="contact-form article-comment">
                        <h4>Leave a Reply</h4>
                            {comments} 
                    </div>
                </div>
                <div class="col-lg-4 m-15px-tb blog-aside">
                    <!-- Trending Post -->
                  <!--   <div class="widget widget-post">
                        <div class="widget-title">
                            <h3>Trending Now</h3>
                        </div>
                        <div class="widget-body">

                        </div>
                    </div> -->
                    <!-- End Trending Post -->
                    <!-- Latest Post -->
                    <div class="widget widget-latest-post">
                        <div class="widget-title">
                            <h3>Latest Post</h3>
                        </div>
                        <div class="widget-body">
                            <?php 
                        $latest_posts = return_multiple_rows("Select * from pages Where soft_delete = 0 and isactive = 1 and template_id = ".$content['template_id']." Order by createdon DESC LIMIT 0 , 10 ");
                        
                        // print_r($latest_post);
                        
                        foreach ($latest_posts as $latest_post) {
                            
                            ?>
                            <div class="latest-post-aside media">
                                <div class="lpa-left media-body">
                                    <div class="lpa-title">
                                        <h5><a href="<?php echo $latest_post['page_url'];?>"><?php echo $latest_post['page_title'];?></a></h5>
                                    </div>
                                    <div class="lpa-meta">
                                        <a class="date" href="#">
                                           <?php 
                                            $dt = new DateTime($latest_post['createdon']);
                                            $date = $dt->format('d F Y');
                                            echo $date;
                                            ?>
                                        </a>
                                    </div>
                                </div>
                                  <?php
                                        if(!empty($content['featured_image'])){
                                  ?>
                                <div class="lpa-right">
                                    <a href="<?php echo $latest_post['page_url'];?>">
                                        <img src="<?php echo ABSOLUTE_IMAGEPATH.$latest_post['featured_image'];?>" title="" alt="">
                                    </a>
                                </div>
                            <?php } ?>
                            </div>
                    <?php }?>
                        </div>
                    </div>
                    <!-- End Latest Post -->
                    <!-- widget Tags -->
                    <div class="widget widget-tags">
                        <div class="widget-title">
                            <h3>Latest Tags</h3>
                        </div>
                        <div class="widget-body">
                            <div class="nav tag-cloud">
                                <?php                                    
                                    $keyword_rows = return_multiple_rows("Select page_meta_keywords from pages Where catid = ".$content['catid']);

                                            foreach ($keyword_rows as $keyword_row) {
                                                $keywords = explode(',', $keyword_row['page_meta_keywords']);

                                            foreach ($keywords as $keyword) {
                                                if(!empty($keyword) && $keyword!=" ")
                                                    echo '<a href="#">'.$keyword.'</a>';
                                            }
                                    }
                                 ?>
                            </div>
                        </div>
                    </div>
                    <!-- End widget Tags -->
                </div>
            </div>
        </div>
    </div>
    <script>
        let modalId = $('#image-gallery');

            $(document)
              .ready(function () {
            
                loadGallery(true, 'a.thumbnail');
            
                //This function disables buttons when needed
                function disableButtons(counter_max, counter_current) {
                  $('#show-previous-image, #show-next-image')
                    .show();
                  if (counter_max === counter_current) {
                    $('#show-next-image')
                      .hide();
                  } else if (counter_current === 1) {
                    $('#show-previous-image')
                      .hide();
                  }
                }
            
                /**
                 *
                 * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
                 * @param setClickAttr  Sets the attribute for the click handler.
                 */
            
                function loadGallery(setIDs, setClickAttr) {
                  let current_image,
                    selector,
                    counter = 0;
            
                  $('#show-next-image, #show-previous-image')
                    .click(function () {
                      if ($(this)
                        .attr('id') === 'show-previous-image') {
                        current_image--;
                      } else {
                        current_image++;
                      }
            
                      selector = $('[data-image-id="' + current_image + '"]');
                      updateGallery(selector);
                    });
            
                  function updateGallery(selector) {
                    let $sel = selector;
                    current_image = $sel.data('image-id');
                    $('#image-gallery-title')
                      .text($sel.data('title'));
                    $('#image-gallery-image')
                      .attr('src', $sel.data('image'));
                    disableButtons(counter, $sel.data('image-id'));
                  }
            
                  if (setIDs == true) {
                    $('[data-image-id]')
                      .each(function () {
                        counter++;
                        $(this)
                          .attr('data-image-id', counter);
                      });
                  }
                  $(setClickAttr)
                    .on('click', function () {
                      updateGallery($(this));
                    });
                }
              });
            
            // build key actions
            $(document)
              .keydown(function (e) {
                switch (e.which) {
                  case 37: // left
                    if ((modalId.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
                      $('#show-previous-image')
                        .click();
                    }
                    break;
            
                  case 39: // right
                    if ((modalId.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
                      $('#show-next-image')
                        .click();
                    }
                    break;
            
                  default:
                    return; // exit this handler for other keys
                }
                e.preventDefault(); // prevent the default action (scroll / move caret)
              });

    </script>