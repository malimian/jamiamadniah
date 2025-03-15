<?php 
$url = basename($_SERVER['PHP_SELF']);


$page_c = return_single_row("Select * from pages Where page_url = '$url' and soft_delete = 0 and isactive = 1 "); 

?>
  <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" style="height: 410px;">
                            <img class="img-fluid" src="<?php echo ABSOLUTE_IMAGEPATH.$page_c['featured_image'];?>" alt="<?php echo $page_c['page_title'];?>">
                        </div>
                        <?php 
                        $images = return_multiple_rows("SELECT * FROM `images` Where pid = ".$page_c['pid']." and soft_delete = 0 and isactive = 1 ");

                        foreach($images as $image){
                        ?>
                        <div class="carousel-item" style="height: 410px;">
                            <img class="img-fluid" src="<?php echo ABSOLUTE_IMAGEPATH.$image['i_name'];?>" alt="<?php echo $image['i_name'];?>">
                        </div>
                        <?php } ?>
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>