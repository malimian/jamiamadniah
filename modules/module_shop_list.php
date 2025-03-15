<style>

  .searchBox {
    display: flex;
    gap: 10px;
  }

  .borderRound {
    border-radius: 5px;
  }

  @media only screen and (max-width: 600px) {

    .fefvgrg {
      padding-top: 5px;
    }
  }
</style>


  <div class="container mt-3">
    <div class="border p-4 mb-4 ">
      <form>
        <div class="row">
          <div class="col mt-3 mb-3">
           <select class="form-select" name="select_model">
            <?php 
                if(isset($_GET['select_model'])){
                    if(!empty($_GET['select_model']))
                        echo "<option value='".$_GET['select_model']."'>".$_GET['select_model']."</option>";
                }
            ?>
              <option value="">Select All Models</option>
              <?php 
              $cats = return_multiple_rows("SELECT SUBSTRING_INDEX(`page_title`, ' ', 1) as cat_ FROM `pages` Where template_id IN (4,5,6,8,10) and isactive = 1 AND soft_delete = 0 GROUP by SUBSTRING_INDEX(`page_title`, ' ', 1) order by cat_;");
              foreach($cats as $cat){
              ?>
              <option value="<?php echo $cat['cat_']?>"><?php echo $cat['cat_']?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-sm-8 mt-3 mb-3">
            <div class="searchBox">
                <input type="text" name="q" class="form-control" placeholder="Search" value="<?php if(isset($_GET['q'])){ if(!empty($_GET['q'])) echo $_GET['q']; } ?>">
              <div class="">
                <button class="btn btn-success borderRound" type="submit">Search</button>
              </div>
              <div class="">
              </div>
              <button class="btn btn-danger borderRound" type="reset">Reset</button>
            </div>
          </div>
        </div>
      </form>
<?php
$q = "";
$searching_for = "";

if(isset($_GET['select_kw'])){
    if(!empty($_GET['select_kw'])){
        $select_kw = $_GET['select_kw'];
        $qs = clean(strip_tags($select_kw));
        $q .= " AND `page_title` LIKE '%$qs%' ";
        $searching_for .=$select_kw." , ";
    }
}


if(isset($_GET['select_model'])){
    if(!empty($_GET['select_model'])){
        $select_model = $_GET['select_model'];
        $qs = clean(strip_tags($select_model));
        $q .= " AND `page_title` LIKE '%$qs%' ";
        $searching_for .= $select_model." , ";

    }
}

if(isset($_GET['q'])){
    if(!empty($_GET['q'])){
        $qf = $_GET['q'];
        $qs = clean(strip_tags($qf));
        $q .= " AND REPLACE(`page_title`,'-','') LIKE '%$qs%' ";
        $searching_for .= $qs;
    }
}

echo "<strong>Search reasult for ".$searching_for."</strong>";

?>
    </div>

</div>

<div class="row g-4">
	<?php
		$latest_news = return_multiple_rows("Select * from pages Where template_id IN (4,5,6,8,10)  $q and soft_delete = 0 and isactive = 1  Order by RAND() ");

		foreach ($latest_news as $latest_new) {
	?>  			    
	  			    <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
	                    <div class="service-item rounded overflow-hidden">
	                        <img class="img-fluid" src="<?php echo ABSOLUTE_IMAGEPATH.$latest_new['featured_image'];?>" alt="<?php echo $latest_new['page_title']?>">
	                        <div class="position-relative p-4 pt-0">
	                            <h4 class="mb-3"><?php echo $latest_new['page_title']?></h4>
	                            <p><?php echo small_txt($latest_new['page_desc']);?></p>
	                            <a  href="<?php echo $latest_new['page_url'];?>" class="small fw-medium" href="">Read More<i class="fa fa-arrow-right ms-2"></i></a>
	                        </div>
	                    </div>
	                </div>
	<?php }?>
</div>