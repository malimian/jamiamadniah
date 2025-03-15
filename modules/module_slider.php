<!-- Carousel Start -->
<!-- <div class="container-fluid p-0 pb-5 wow fadeIn" data-wow-delay="0.1s">
<div class="owl-carousel header-carousel position-relative">
<div class="owl-carousel-item position-relative" data-dot="&lt;img  data-cke-saved-src='img/carousel-1.jpg' src='img/carousel-1.jpg'&gt;"><img alt="" class="img-fluid" src="img/carousel-1.jpg" />
<div class="owl-carousel-inner">
<div class="container">
<div class="row justify-content-start">
<div class="col-10 col-lg-8">
<h1 class="display-2 text-white animated slideInDown">Pioneers Of Solar And Renewable Energy</h1>

<p class="fs-5 fw-medium text-white mb-4 pb-3">Vero elitr justo clita lorem. Ipsum dolor at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea elitr.</p>
<a class="btn btn-primary rounded-pill py-3 px-5 animated slideInLeft" href="">Read More</a></div>
</div>
</div>
</div>
</div>

<div class="owl-carousel-item position-relative" data-dot="&lt;img  data-cke-saved-src='img/carousel-2.jpg' src='img/carousel-2.jpg'&gt;"><img alt="" class="img-fluid" src="img/carousel-2.jpg" />
<div class="owl-carousel-inner">
<div class="container">
<div class="row justify-content-start">
<div class="col-10 col-lg-8">
<h1 class="display-2 text-white animated slideInDown">Pioneers Of Solar And Renewable Energy</h1>

<p class="fs-5 fw-medium text-white mb-4 pb-3">Vero elitr justo clita lorem. Ipsum dolor at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea elitr.</p>
<a class="btn btn-primary rounded-pill py-3 px-5 animated slideInLeft" href="">Read More</a></div>
</div>
</div>
</div>
</div>

<div class="owl-carousel-item position-relative" data-dot="&lt;img  data-cke-saved-src='img/carousel-3.jpg' src='img/carousel-3.jpg'&gt;"><img alt="" class="img-fluid" src="img/carousel-3.jpg" />
<div class="owl-carousel-inner">
<div class="container">
<div class="row justify-content-start">
<div class="col-10 col-lg-8">
<h1 class="display-2 text-white animated slideInDown">Pioneers Of Solar And Renewable Energy</h1>

<p class="fs-5 fw-medium text-white mb-4 pb-3">Vero elitr justo clita lorem. Ipsum dolor at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea elitr.</p>
<a class="btn btn-primary rounded-pill py-3 px-5 animated slideInLeft" href="">Read More</a></div>
</div>
</div>
</div>
</div>
</div>
</div>
 --><!-- Carousel End -->

<div class="carousel slide" data-ride="carousel" id="carouselExampleControls">
<div class="carousel-inner">
<div class="carousel-item active">
<div class="jumbotron jumbotron-fluid home-banner" style="background-image: url(../images/pexels-wendy-wei-1190298.jpg);">
<div class="home-banner-container">
<div class="container">
<div class="row">
<div class="col-12 text-center">
<h1 class="naniv"><span style="font-size:36px;"><strong>2023 Joint Convention of Efiks in the USA</strong></span></h1>
</div>

<div class="col-12 text-center">
<h3 class="display-5 mont"><strong>Together Again</strong></h3>

<p><span style="font-size:16px;"><strong>Annual National Convention and Gala on July 27th Sunday, 2023&nbsp;to be held in Houston, TX, USA</strong></span></p>
</div>
</div>
</div>
</div>
</div>
</div>

<?php


if(isset($_GET['url']) && !empty($_GET['url']) ){
	if(strpos($_GET['url'], '.html') !== false) $url = $_GET['url'];
	else $url = $_GET['url'].".html";
}

$pid = return_single_ans("Select pid from pages Where page_url = '$url' and soft_delete = 0 and isactive = 1 "); 

$images = return_multiple_rows("SELECT * FROM `images` Where pid = $pid and soft_delete = 0 and isactive = 1 ");

foreach($images as $image){
?>
<div class="carousel-item">
<div class="jumbotron jumbotron-fluid home-banner" style="background-image: url(../photo_gallery/<?php echo $image['i_name'];?>); height:500px">
<div class="home-banner-container">
<div class="container">
</div>
</div>
</div>
</div>
<?php }?>

</div>
<a class="carousel-control-prev" data-slide="prev" href="#carouselExampleControls" role="button"><span class="sr-only">Previous</span> </a> <a class="carousel-control-next" data-slide="next" href="#carouselExampleControls" role="button"> <span class="sr-only">Next</span> </a></div>