<!-- Footer Start -->
<div class="container-fluid footer pt-5 wow fadeIn" data-wow-delay="0.1s">
   <div class="container py-5">
     <div class="row py-5">
       <div class="col-lg-7">
         <h1 class="text-light mb-0">تلاش کریں</h1>
         <p class="text-secondary">ہمارے مواد میں تلاش کریں</p>
       </div>
       <div class="col-lg-5">
         <div class="position-relative mx-auto">
           <form action="search.php" method="get">
             <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" name="q" placeholder="تلاش کریں...">
             <button type="submit" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">تلاش</button>
           </form>
         </div>
       </div>
       <div class="col-12">
         <div class="border-top border-secondary"></div>
       </div>
     </div>
     <div class="row g-4 footer-inner">
       <div class="col-md-6 col-lg-6 col-xl-3">
         <div class="footer-item mt-5">
            <!-- Logo Section -->
            <div class="mb-4">
                <a href="index.php">
                    <img src="{ABSOLUTE_IMAGEPATH}{SITE_LOGO}" alt="جامعہ مدنیہ لوگو" class="img-fluid" style="max-height: 160px;">
                </a>
            </div>
            
            <p class="mb-4 text-secondary">جامعہ مدنیہ ایک معروف اسلامی تعلیمی ادارہ ہے جو قرآن و حدیث کی تعلیمات کو عام کرنے کے لیے کوشاں ہے۔</p>
            
            <!-- Social Media Icons -->
            <div class="d-flex mb-4">
                <a href="#" class="btn btn-outline-light btn-square rounded-circle me-2">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="btn btn-outline-light btn-square rounded-circle me-2">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="btn btn-outline-light btn-square rounded-circle me-2">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="#" class="btn btn-outline-light btn-square rounded-circle">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
            
            <a href="donation.html" class="btn btn-primary py-2 px-4">عطیہ دیں</a>
        </div>
       </div>
       <div class="col-md-6 col-lg-6 col-xl-3">
         <div class="footer-item mt-5">
           <h4 class="text-light mb-4">ہماری جامعہ</h4>
           <div class="d-flex flex-column">
             <h6 class="text-secondary mb-0">ہمارا پتہ</h6>
             <div class="d-flex align-items-center border-bottom py-4">
               <span class="flex-shrink-0 btn-square bg-primary me-3 p-4"><i class="fa fa-map-marker-alt text-dark"></i></span>
               <a href="" class="text-light">بلاک آئی، نارتھ ناظم آباد، کراچی</a>
             </div>
             <h6 class="text-secondary mt-4 mb-0">ہمارا موبائل</h6>
             <div class="d-flex align-items-center py-4">
               <span class="flex-shrink-0 btn-square bg-primary me-3 p-4"><i class="fa fa-phone-alt text-dark"></i></span>
               <a href="" dir="ltr" class="text-light">+92 321 2725000</a>
             </div>
           </div>
         </div>
       </div>
       <div class="col-md-6 col-lg-6 col-xl-3">
         <div class="footer-item mt-5">
           <h4 class="text-light mb-4">صفحات</h4>
           <div class="d-flex flex-column align-items-start">
             <?php
             $menues = return_multiple_rows("Select * from category Where soft_delete = 0 and isactive = 1 and showInNavBar = 1 and ParentCategory = 0 Order By cat_sequence ASC");
             
             foreach ($menues as $menu) {
                 if(return_single_ans("SELECT COUNT(catid) from pages Where catid = ".$menu['catid']." and isactive = 1 and soft_delete = 0 ") > 0 && $menu['CreateHierarchy']== 1) {
                     echo '<a class="text-light mb-2" href="'.$menu['cat_url'].'"><i class="fa fa-check text-primary me-2"></i>'.$menu['catname'].'</a>';
                 } else {
                     echo '<a class="text-light mb-2" href="'.$menu['cat_url'].'"><i class="fa fa-check text-primary me-2"></i>'.$menu['catname'].'</a>';
                 }
             }
             ?>
           </div>
         </div>
       </div>
       <div class="col-md-6 col-lg-6 col-xl-3">
          <div class="footer-item mt-5">
              <h4 class="text-light mb-4">تازہ ترین پوسٹس</h4>
              <?php
              // Get latest 2 blog posts from database
              $blogs = return_multiple_rows("SELECT p.*, u.username 
                                           FROM pages p 
                                           JOIN loginuser u ON p.createdby = u.id 
                                           WHERE p.template_id = 3 
                                           AND p.isactive = 1 
                                           AND p.soft_delete = 0 
                                           ORDER BY p.createdon DESC 
                                           LIMIT 2");
              
              foreach($blogs as $index => $blog): 
                  // Format date
                  $date = date_create($blog['createdon']);
                  $formatted_date = date_format($date, 'd F Y');
                  
                  // Get featured image or default
                  $featured_image = !empty($blog['featured_image']) ? ABSOLUTE_IMAGEPATH.$blog['featured_image'] : 'img/blog-mini-'.($index+1).'.jpg';
              ?>
              <div class="d-flex <?php echo $index < count($blogs)-1 ? 'border-bottom border-secondary' : ''; ?> py-4">
                  <img src="<?php echo $featured_image; ?>" class="img-fluid flex-shrink-0" style="width:80px; height:60px; object-fit:cover;" alt="<?php echo $blog['page_title']; ?>">
                  <div class="ps-3">
                      <p class="mb-0 text-muted"><?php echo $formatted_date; ?></p>
                      <a href="<?php echo $blog['page_url']; ?>" class="text-light"><?php echo $blog['page_title']; ?></a>
                  </div>
              </div>
              <?php endforeach; ?>
              
              <!-- View All Link -->
              <div class="mt-3">
                  <a href="blogs.html" class="text-primary">تمام بلاگز دیکھیں <i class="fas fa-arrow-left ms-1"></i></a>
              </div>
          </div>
      </div>
     </div>
   </div>
   <div class="container py-4">
     <div class="border-top border-secondary pb-4"></div>
     <div class="row">
       <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
         &copy; <a class="border-bottom" href="#">جامعہ مدنیہ</a>, تمام حقوق محفوظ ہیں۔
       </div>
       <div class="col-md-6 text-light text-center text-md-end">
         Developed by <a class="border-bottom" href="https://hatinco.com">HAT INC</a>
       </div>
     </div>
   </div>
</div>
<!-- Footer End -->

<!-- Back to Top -->
<a href="#" class="btn btn-primary border-3 border-light back-to-top"><i class="fa fa-arrow-up"></i></a>