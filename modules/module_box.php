<?php

if($packages_category == 15)
    $og_templateid = 3;

if($packages_category == 19)
    $og_templateid = 4;

if($packages_category == 20)
    $og_templateid = 5;

if($packages_category == 23)
    $og_templateid = 6;


    $blogs = return_multiple_rows("Select * from pages Where soft_delete = 0 and isactive = 1 and template_id = ".$og_templateid." Order by createdon DESC");
?>
<section>
<div class="container">
    <div class="row">
        <?php
        foreach ($blogs as $blog) {
        ?>
        <div class="col-lg-4 col-md-6 mb-2-6">
            <article class="card card-style2">
                <?php
                if(!empty($blog['featured_image'])){
                ?>
                <div class="card-img">
                    <a href="<?php echo $blog['page_url'];?>"><img class="rounded-top img-fluid" src="<?php echo ABSOLUTE_IMAGEPATH.$blog['featured_image'];?>" alt="<?php echo $blog['page_title'];?>"></a>
                    <!--<div class="date">-->
                    <?php 
                                    $dt = new DateTime($blog['createdon']);
                                    $date = $dt->format('<\s\p\a\n>d<\/\s\p\a\n>M');
                                   // echo $date;
                    ?>
                    <!--</div>-->
                </div>
            <?php }?>
                <div class="card-body">
                    <h3 class="h5"><a href="<?php echo $blog['page_url'];?>"><?php echo $blog['page_title'];?></a></h3>
                    <p class="display-30"><?php echo small_txt($blog['page_desc']);?></p>
                    <a href="<?php echo $blog['page_url'];?>" class="btn btn-primary read-more">Read more</a>
                </div>
            </article>
        </div>
        <?php }?>
</div>
</section>