<?php
$GLOBALS['content'] = $content;

if(!function_exists("header_t")) {
    function header_t(){
        return '
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
            <link href="css/templates/template_general.css" rel="stylesheet">
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

<style>

.icon-hover{
        border-radius: 0px !important;
}
    .icon-hover:hover {
    border-color: #3b71ca !important;
    background-color: white !important;
    color: #3b71ca !important;
}

.icon-hover:hover i {
  color: #3b71ca !important;
}
</style>
<header>

  <!-- Heading -->
  <div class="bg-warning">
    <div class="container py-4">
      <!-- Breadcrumb -->
      <nav class="d-flex">
        <h6 class="mb-0">
          <a href="" class="text-white-50">Home</a>
          <span class="text-white-50 mx-2"> > </span>
          <a href="" class="text-white-50">Library</a>
          <span class="text-white-50 mx-2"> > </span>
          <a href="" class="text-white"><u>Data</u></a>
        </h6>
      </nav>
      <!-- Breadcrumb -->
    </div>
  </div>
  <!-- Heading -->
</header>

<!-- content -->
<section class="py-5">
  <div class="container">
    <div class="row gx-5">
      <aside class="col-lg-6">
        <div class="border rounded-4 mb-3 d-flex justify-content-center">
          <a data-fslightbox="mygalley" class="rounded-4" target="_blank" data-type="image" href="<?php echo ABSOLUTE_IMAGEPATH.$content['featured_image'];?>">
            <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit" src="<?php echo ABSOLUTE_IMAGEPATH.$content['featured_image'];?>" />
          </a>
        </div>
        <div class="d-flex justify-content-center mb-3">
          <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="<?php echo ABSOLUTE_IMAGEPATH.$content['featured_image'];?>" class="item-thumb">
            <img width="60" height="60" class="rounded-2" src="<?php echo ABSOLUTE_IMAGEPATH.$content['featured_image'];?>" />
          </a>
          <?php
                $photogallery = return_multiple_rows("Select * from images Where pid = ".$content['pid']." and isactive = 1 and soft_delete = 0");
                if(!empty($photogallery)){
                foreach($photogallery as $photogallery_){
            ?>
              <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="photo_gallery/<?php echo $photogallery_['i_name'];?>" class="item-thumb">
                <img width="60" height="60" class="rounded-2" alt="<?php echo $photogallery_['i_name'];?>" src="photo_gallery/<?php echo $photogallery_['i_name'];?>" />
              </a>
          <?php }}?>
        </div>
        <!-- thumbs-wrap.// -->
        <!-- gallery-wrap .end// -->
      </aside>
      <main class="col-lg-6">
        <div class="ps-lg-3">
          <h4 class="title text-dark">
            <?php echo replace_sysvari($content['page_title']);?><br />
            Casual Hoodie
          </h4>
          <div class="d-flex flex-row my-3">
            <div class="text-warning mb-1 me-2">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
              <span class="ms-1">
                4.5
              </span>
            </div>
            <span class="text-muted"><i class="fas fa-shopping-basket fa-sm mx-1"></i><?php echo $content['sku'];?></span>
            <?php if( $content['stock_status'] == 1){?>
            <span class="text-success ms-2">In stock</span>
            <?php }else{?>
            <span class="text-danger ms-2">Out of stock</span>
            <?php }?> 
          </div>

          <div class="mb-3">
            <span class="h5"><?php echo CURRENCY?> <?php echo $content['plistprice'];?></span>
          </div>

          <p>
           <?php
           $short_desc = replace_sysvari($content['page_desc'] , getcwd()."/");
           if (strlen($short_desc) > 212) {
                $short_desc = substr($short_desc, 0, 212);
            }
            echo $short_desc." ...";
           
           ?>
          </p>

          <div class="row">
            <?php
            $product_variations = return_multiple_rows("Select * from product_variations Where page_id = ".$content['pid']." and isactive = 1 and soft_delete = 0");
            if(!empty($product_variations)){
                foreach($product_variations as $product_variation_){
            ?>
            <dt class="col-3"><?php echo $product_variation_['variation_type'];?>:</dt>
            <dd class="col-9"><?php echo $product_variation_['variation_value'];?></dd>
            <?php }}?>
          </div>

          <hr />

          <div class="row mb-4">
            <div class="col-md-4 col-6">
              <label class="mb-2">Size</label>
              <select class="form-select border border-secondary" style="height: 35px;">
                <option>Small</option>
                <option>Medium</option>
                <option>Large</option>
              </select>
            </div>
            <!-- col.// -->
            <div class="col-md-4 col-6 mb-3">
              <label class="mb-2 d-block">Quantity</label>
              <div class="input-group mb-3" style="width: 170px;">
                <button class="btn btn-white border border-secondary px-3" type="button" id="button-addon1" data-bs-ripple-color="dark">
                  <i class="fas fa-minus"></i>
                </button>
                <input type="text" class="form-control text-center border border-secondary" placeholder="14" aria-label="Example text with button addon" aria-describedby="button-addon1" />
                <button class="btn btn-white border border-secondary px-3" type="button" id="button-addon2" data-bs-ripple-color="dark">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
            </div>
          </div>
          <a href="#" class="btn btn-warning border border-secondary py-2 icon-hover px-3"> Buy now </a>
          <a href="#" class="btn btn-warning border border-secondary py-2 icon-hover px-3"> <i class="me-1 fa fa-shopping-basket"></i> Add to cart </a>
          <a href="#" class="btn btn-light border border-secondary py-2 icon-hover px-3"> <i class="me-1 fa fa-heart fa-lg"></i> Save </a>
        </div>
      </main>
    </div>
  </div>
</section>
<!-- content -->

<section class="bg-light border-top py-4">
  <div class="container">
    <div class="row gx-4">
      <div class="col-lg-8 mb-4">
        <div class="border rounded-2 px-3 py-2 bg-white">
          <!-- Pills navs -->
          <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
            <li class="nav-item d-flex" role="presentation">
              <a class="nav-link d-flex align-items-center justify-content-center w-100 active" id="ex1-tab-1" data-bs-toggle="pill" href="#ex1-pills-1" role="tab" aria-controls="ex1-pills-1" aria-selected="true">Specification</a>
            </li>
            <li class="nav-item d-flex" role="presentation">
              <a class="nav-link d-flex align-items-center justify-content-center w-100" id="ex1-tab-2" data-bs-toggle="pill" href="#ex1-pills-2" role="tab" aria-controls="ex1-pills-2" aria-selected="false">Warranty info</a>
            </li>
            <li class="nav-item d-flex" role="presentation">
              <a class="nav-link d-flex align-items-center justify-content-center w-100" id="ex1-tab-3" data-bs-toggle="pill" href="#ex1-pills-3" role="tab" aria-controls="ex1-pills-3" aria-selected="false">Shipping info</a>
            </li>
            <li class="nav-item d-flex" role="presentation">
              <a class="nav-link d-flex align-items-center justify-content-center w-100" id="ex1-tab-4" data-bs-toggle="pill" href="#ex1-pills-4" role="tab" aria-controls="ex1-pills-4" aria-selected="false">Seller profile</a>
            </li>
          </ul>
          <!-- Pills navs -->

          <!-- Pills content -->
          <div class="tab-content" id="ex1-content">
            <div class="tab-pane fade show active" id="ex1-pills-1" role="tabpanel" aria-labelledby="ex1-tab-1">
              <?php   echo replace_sysvari($content['page_desc'] , getcwd()."/"); ?>
            </div>
            <div class="tab-pane fade mb-2" id="ex1-pills-2" role="tabpanel" aria-labelledby="ex1-tab-2">
     <p>SHIPPING We charge Rs.195 on all orders under the value of Rs.5000/-.</p>

<p>We deliver in 24-48 hours in Karachi city and 3 to 5 working days in rest of the cities &amp; towns</p>

<p>Delivery time is between 5 to 7 working days (No delivery on Sundays). However delivery can take up to 7 working days during busy shopping season or our mega sales events. On orders above the value of Rs.15,000 we will need an advance payment. Orders weighing more than 10 KGs will be charged Rs.50 per extra KG.</p>

<p>RETURNS &amp; EXCHANGES POLICY</p>

<p>We will gladly accept Returns or Exchange, given that the merchandise returned are NOT damaged or used and are in their ORIGINAL packing with tags (if any), within 7 Days of purchase for a refund or an exchange.</p>

<p>Please return goods with a copy of the invoice and mention the reason for returning the items. Customer needs to return the merchandise via traceable delivery i.e. courier or registered post on his own expense to our address.</p>

<p>Delivery Charges will not be refunded. Refund requests will be processed within 7 working days after receiving the return products. For further queries about exchanges and returns, please contact us at info@alhamdstationers.com</p>

<p>Follow these simple steps to return or exchange your item(s):</p>

<p>1. Complete Return Form If you wish to return or exchange any portion of your online order, please complete the Return Form and include it with your return shipment. Don&#39;t have a Return Form? Please click here to download one. if you wish to return or exchange any product of your order, please complete this form and include it with your return shipment.</p>

<p>2. Repack Merchandise Please make sure that the item(s) you wish to return, along with the Return Form are included with your return shipment.</p>

<p>3. Ship to Customer needs to return the merchandise via traceable delivery i.e. courier or registered post on his own expense to the following address:&nbsp;</p>

<p>Al Hamd Stationers and Fragrances Shop # 19, Sonehri Apartment, Block 12, Gulistan e Johar, karachi.</p>

<p>Telephone Support : 0334-0282201, 0332-8212906 &nbsp;( 10:00 AM to 7:00 PM Monday - Saturday )</p>

            </div>
            <div class="tab-pane fade mb-2" id="ex1-pills-3" role="tabpanel" aria-labelledby="ex1-tab-3">
              Another tab content or sample information now <br />
              Dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
              commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
              mollit anim id est laborum.
            </div>
            <div class="tab-pane fade mb-2" id="ex1-pills-4" role="tabpanel" aria-labelledby="ex1-tab-4">
              Some other tab content or sample information now <br />
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
              aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
              officia deserunt mollit anim id est laborum.
            </div>
          </div>
          <!-- Pills content -->
        </div>
      </div>
      <div class="col-lg-4">
        <div class="px-0 border rounded-2 shadow-0">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Similar items</h5>
              
                <?php 
                $latest_posts = return_multiple_rows("Select * from pages Where soft_delete = 0 and isactive = 1 and catid = ".$content['catid']." Order by createdon DESC LIMIT 0 , 5 ");
                foreach ($latest_posts as $latest_post) {
                ?>
              <div class="d-flex mb-3">
                <a href="<?php echo $latest_post['page_url'];?>" class="me-3">
                  <img src="<?php echo ABSOLUTE_IMAGEPATH.$latest_post['featured_image'];?>" alt="<?php echo $latest_post['page_title'];?>" style="min-width: 96px; height: 96px;" class="img-md img-thumbnail" />
                </a>
                <div class="info">
                  <a href="<?php echo $latest_post['page_url'];?>" class="nav-link mb-1"><?php echo $latest_post['page_title'];?><br />
                   <?php 
                    $dt = new DateTime($latest_post['createdon']);
                    $date = $dt->format('d F Y');
                    echo $date;
                    ?>
                  </a>
                  <strong class="text-dark"><?php echo CURRENCY?> <?php echo $latest_post['plistprice'];?></strong>
                </div>
              </div>
              <?php }?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>