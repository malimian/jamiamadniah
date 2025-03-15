<?php
	$latest_news = return_multiple_rows("Select * from pages Where soft_delete = 0 and isactive = 1 and template_id = 3 Order by createdon DESC LIMIT 0 , 4 ");

	foreach ($latest_news as $latest_new) {
?>

<div class="col-12 col-sm-12 col-md-2 col-lg-2 news-img-div"> <img class="img-fluid news-img" src="<?php echo ABSOLUTE_IMAGEPATH.$latest_new['featured_image'];?>" alt="<?php echo $latest_new['page_title']?>"></div>
<div class="col-12 col-sm-12 col-md-4 col-lg-4 news-content">
	<h5><b><?php echo $latest_new['page_title']?></b></h5>
	<div class="col-12">
		<p class="large">
			<?php echo small_txt($latest_new['page_desc']);?>
		</p>
	</div>
	<div class="col-12">
		<a href="<?php echo $latest_new['page_url'];?>" class="btn btn-sm" id="latest-blog-read-more1">READ MORE</a>
	</div>
</div>

<?php }?>