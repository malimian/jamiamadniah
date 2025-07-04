<?php
include 'front_connect.php';

$url = basename($_SERVER['PHP_SELF']);

// Fetch page data using proper URL sanitization
$safe_url = addslashes($url); // Basic sanitization for SQL
$content = return_single_row(
    "SELECT page_meta_title, site_template_id, page_meta_keywords, page_meta_desc, page_desc, 
    page_title, featured_image, pages.createdon, pid, catname, cat_url, page_url 
    FROM pages 
    LEFT JOIN category ON pages.catid = category.catid 
    WHERE pages.soft_delete = 0 
    AND category.soft_delete = 0 
    AND page_url = '$safe_url' 
    AND pages.isactive = 1"
);

// Initialize template ID with default if not found
$template_id = !empty($content['site_template_id']) ? (int)$content['site_template_id'] : 0;

// Prepare additional CSS/JS libraries
$additional_libs = [
    '<link href="css/checkout.css" rel="stylesheet">',
    // Add any other CSS/JS files needed
];

// Output the header with all meta information
echo front_header(
    htmlspecialchars($content['page_meta_title'] ?? 'Home Page'),
    htmlspecialchars($content['page_meta_keywords'] ?? ''),
    htmlspecialchars($content['page_meta_desc'] ?? ''),
    $additional_libs,
    $template_id,
    $content
);

// Output the navbar with path replacement
$navbar_content = front_menu( null ,$template_id);
if (!empty($navbar_content)) {
    echo replace_sysvari($navbar_content, getcwd() . "/");
}

?>

<!-- Hero Start -->
    <div class="container-fluid hero-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="hero-header-inner animated zoomIn">
                        <p class="fs-4 text-dark">جامعہ مدنیہ میں خوش آمدید</p>
                        <h1 class="display-1 mb-5 text-dark">علم دین حاصل کریں، اپنی آخرت سنواریں</h1>
                        <a href="" class="btn btn-primary py-3 px-5">مزید جانیں</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


   <!-- Jamia ki Khasoosiat Start -->
<div class="container-fluid about py-5">
    <div class="container py-5">
        <div class="row g-5 mb-5">
            <div class="col-xl-6">
                <div class="row g-4">
                    <div class="col-6">
                        <img src="img/about-1.jpg" class="img-fluid h-100 wow zoomIn" data-wow-delay="0.1s" alt="">
                    </div>
                    <div class="col-6">
                        <img src="img/about-2.jpg" class="img-fluid pb-3 wow zoomIn" data-wow-delay="0.1s" alt="">
                        <img src="img/about-3.jpg" class="img-fluid pt-3 wow zoomIn" data-wow-delay="0.1s" alt="">
                    </div>
                </div>
            </div>
            <div class="col-xl-6 wow fadeIn" data-wow-delay="0.5s">
                <p class="fs-5 text-uppercase text-primary">جامعہ کی خصوصیات</p>
                <h1 class="display-5 pb-4 m-0">عصری سہولیات کے ساتھ معیاری دینی تعلیم</h1>
                <p class="pb-4">جامعہ مدنیہ ایک مثالی دینی ادارہ ہے جو طلبہ کو جدید سہولیات کے ساتھ دینی و دنیاوی علوم سکھانے میں پیش پیش ہے۔ یہاں قیام، طعام، سیکیورٹی اور دیگر سہولیات فراہم کی جاتی ہیں۔</p>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="ps-3 d-flex align-items-start mb-3">
                            <span class="bg-primary btn-md-square rounded-circle mt-1 me-2"><i class="fa fa-home text-dark fa-4x mb-5 pb-2"></i></span>
                            <div class="ms-3">
                                <h5>قیام و طعام</h5>
                                <p>جامعہ میں رہائش کے لیے آرام دہ کمروں اور معیاری کھانے کا انتظام ہے تاکہ طلبہ پوری توجہ سے تعلیم حاصل کریں۔</p>
                            </div>
                        </div>
                        <div class="ps-3 d-flex align-items-start mb-3">
                            <span class="bg-primary btn-md-square rounded-circle mt-1 me-2"><i class="fa fa-video text-dark fa-4x mb-5 pb-2"></i></span>
                            <div class="ms-3">
                                <h5>سی سی ٹی وی سیکیورٹی</h5>
                                <p>جامعہ کے احاطے میں CCTV کیمروں کے ذریعے 24 گھنٹے نگرانی کی جاتی ہے تاکہ طلبہ و والدین کو مکمل اطمینان رہے۔</p>
                            </div>
                        </div>
                        <div class="ps-3 d-flex align-items-start mb-3">
                            <span class="bg-primary btn-md-square rounded-circle mt-1 me-2"><i class="fa fa-solar-panel text-dark fa-4x mb-5 pb-2"></i></span>
                            <div class="ms-3">
                                <h5>شمسی توانائی</h5>
                                <p>بجلی کی مستقل فراہمی کے لیے جامعہ میں شمسی توانائی کا نظام نصب ہے تاکہ کسی بھی تعلیمی عمل میں خلل نہ آئے۔</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="ps-3 d-flex align-items-start mb-3">
                            <span class="bg-primary btn-md-square rounded-circle mt-1 me-2"><i class="fa fa-mosque text-dark fa-4x mb-5 pb-2"></i></span>
                            <div class="ms-3">
                                <h5>خوبصورت مسجد</h5>
                                <p>جامعہ میں ایک وسیع اور خوبصورت مسجد ہے جہاں طلبہ باجماعت نماز ادا کرتے ہیں اور دینی ماحول حاصل کرتے ہیں۔</p>
                            </div>
                        </div>
                        <div class="ps-3 d-flex align-items-start mb-3">
                            <span class="bg-primary btn-md-square rounded-circle mt-1 me-2"><i class="fa fa-futbol text-dark fa-4x mb-5 pb-2"></i></span>
                            <div class="ms-3">
                                <h5>کھیل کا میدان</h5>
                                <p>طلبہ کی جسمانی صحت کے لیے کھیل کا میدان موجود ہے جہاں وہ مختلف کھیل کھیل کر صحت مند رہ سکتے ہیں۔</p>
                            </div>
                        </div>
                        <div class="ps-3 d-flex align-items-start mb-3">
                            <span class="bg-primary btn-md-square rounded-circle mt-1 me-2"><i class="fa fa-hand-holding-heart text-dark fa-4x mb-5 pb-2"></i></span>
                            <div class="ms-3">
                                <h5>خیرات و عطیات</h5>
                                <p>جامعہ میں مستحق طلبہ کی مدد کے لیے باقاعدہ خیرات و عطیات کا انتظام موجود ہے۔</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container text-center bg-primary py-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="row g-4 align-items-center">
                <div class="col-lg-2">
                    <i class="fa fa-mosque fa-5x text-white"></i>
                </div>
                <div class="col-lg-7 text-center text-lg-start">
                    <h1 class="mb-0 text-white">جامعہ مدنیہ میں مسجد، رہائش، طعام، کھیل کا میدان اور جدید سیکیورٹی سسٹم</h1>
                </div>
                <div class="col-lg-3">
                    <a href="#" class="btn btn-light py-2 px-4">مزید جانیں</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Jamia ki Khasoosiat End -->


<style type="text/css">
.counter-item {
    transition: all 0.3s;
}
.counter-item:hover {
    transform: translateY(-5px);
}
</style>
<!-- Statistics Section Start -->
<div class="container-fluid py-5 bg-light">
    <div class="container py-5">
        <div class="row g-4 text-center">
            <!-- فارغ التحصیل -->
            <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                <div class="counter-item bg-white p-4 rounded shadow">
                    <div class="counter-icon">
                        <i class="fas fa-user-graduate fa-3x text-primary mb-3"></i>
                    </div>
                    <h2 class="mb-1 display-5" data-toggle="counter-up">130</h2>
                    <p class="mb-0 text-dark fw-bold">فارغ التحصیل</p>
                </div>
            </div>
            
            <!-- شعبہ درس نظامی میں زیر تعلیم طلبہ -->
            <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.3s">
                <div class="counter-item bg-white p-4 rounded shadow">
                    <div class="counter-icon">
                        <i class="fas fa-book-open fa-3x text-primary mb-3"></i>
                    </div>
                    <h2 class="mb-1 display-5" data-toggle="counter-up">196</h2>
                    <p class="mb-0 text-dark fw-bold">شعبہ درس نظامی میں زیر تعلیم طلبہ</p>
                </div>
            </div>
            
            <!-- شعبہ تحفیظ القرآن میں زیر تعلیم طلبہ -->
            <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.5s">
                <div class="counter-item bg-white p-4 rounded shadow">
                    <div class="counter-icon">
                        <i class="fas fa-quran fa-3x text-primary mb-3"></i>
                    </div>
                    <h2 class="mb-1 display-5" data-toggle="counter-up">260</h2>
                    <p class="mb-0 text-dark fw-bold">شعبہ تحفیظ القرآن میں زیر تعلیم طلبہ</p>
                </div>
            </div>
            
            <!-- شعبہ حفاظ عربی طلبہ -->
            <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.7s">
                <div class="counter-item bg-white p-4 rounded shadow">
                    <div class="counter-icon">
                        <i class="fas fa-language fa-3x text-primary mb-3"></i>
                    </div>
                    <h2 class="mb-1 display-5" data-toggle="counter-up">88</h2>
                    <p class="mb-0 text-dark fw-bold">شعبہ حفاظ عربی طلبہ</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Statistics Section End -->

    <!-- Activities Start -->
    <div class="container-fluid activities py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5 wow fadeIn" data-wow-delay="0.1s" style="max-width: 700px;">
                <p class="fs-5 text-uppercase text-primary">سرگرمیاں</p>
                <h1 class="display-3">ہماری سرگرمیاں</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-6 col-xl-4">
                    <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.1s">
                        <i class="fa fa-mosque fa-4x text-dark"></i>
                        <div class="ms-4">
                            <h4>درس نظامی</h4>
                            <p class="mb-4">جامعہ مدنیہ میں معیاری درس نظامی کا انتظام ہے جس میں طلبہ کو دینی علوم کی تعلیم دی جاتی ہے۔</p>
                            <a href="dars-e-nizami-boys.html" class="btn btn-primary px-3">مزید جانیں</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.3s">
                        <i class="fa fa-donate fa-4x text-dark"></i>
                        <div class="ms-4">
                            <h4>تحفیظ القرآن</h4>
                            <p class="mb-4">جامعہ میں قرآن کریم حفظ کرانے کا خصوصی انتظام ہے جہاں بچوں کو حفظ قرآن کی تعلیم دی جاتی ہے۔</p>
                            <a href="tahafaz-quran.html" class="btn btn-primary px-3">مزید جانیں</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.5s">
                        <i class="fa fa-quran fa-4x text-dark"></i>
                        <div class="ms-4">
                            <h4>حفاظ عربی</h4>
                            <p class="mb-4">جامعہ میں حفاظ کرام کو عربی زبان کی تعلیم دی جاتی ہے تاکہ وہ قرآن و حدیث کو بہتر سمجھ سکیں۔</p>
                            <a href="hifz.html" class="btn btn-primary px-3">مزید جانیں</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.1s">
                        <i class="fa fa-book fa-4x text-dark"></i>
                        <div class="ms-4">
                            <h4>دارالافتاء</h4>
                            <p class="mb-4">جامعہ میں دارالافتاء قائم ہے جہاں سے عوام الناس کے شرعی مسائل کے حل پیش کیے جاتے ہیں۔</p>
                            <a href="dar-al-ifta.html" class="btn btn-primary px-3">مزید جانیں</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.3s">
                        <i class="fa fa-book-open fa-4x text-dark"></i>
                        <div class="ms-4">
                            <h4>خدمت خلق</h4>
                            <p class="mb-4">جامعہ مدنیہ معاشرے کے ضرورت مند افراد کی مدد کے لیے مختلف رفاہی پروگرام چلاتا ہے۔</p>
                            <a href="" class="btn btn-primary px-3">مزید جانیں</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.5s">
                        <i class="fa fa-hands fa-4x text-dark"></i>
                        <div class="ms-4">
                            <h4>مختصر کورسز</h4>
                            <p class="mb-4">جامعہ میں مختلف مختصر دینی کورسز کا انتظام ہے جو عام لوگوں کے لیے مفید ہیں۔</p>
                            <a href="" class="btn btn-primary px-3">مزید جانیں</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Activities Start -->

    <!-- Jamia Introduction Video Section -->
<section class="py-5 bg-light" id="intro-video">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0 wow fadeInUp" data-wow-delay="0.1s">
                <div class="position-relative rounded overflow-hidden">
                    <!-- Video Thumbnail with Play Button -->
                    <img src="img/jamia-video-thumbnail.jpg" class="img-fluid w-100 rounded shadow" alt="جامعہ مدنیہ کا تعارفی ویڈیو">
                    <div class="video-play-button">
                        <a href="#" class="video-popup-btn" data-bs-toggle="modal" data-bs-target="#videoModal">
                            <i class="fas fa-play"></i>
                        </a>
                    </div>
                    <!-- Video Stats -->
                    <div class="video-stats bg-primary text-white p-3 rounded-bottom">
                        <div class="row text-center">
                            <div class="col-4 border-end border-white">
                                <h4 class="mb-0">1.2K</h4>
                                <small>Views</small>
                            </div>
                            <div class="col-4 border-end border-white">
                                <h4 class="mb-0">95</h4>
                                <small>Likes</small>
                            </div>
                            <div class="col-4">
                                <h4 class="mb-0">24</h4>
                                <small>Shares</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="ps-lg-5">
                    <h5 class="text-uppercase text-primary mb-3">ہمارا تعارف</h5>
                    <h1 class="display-5 mb-4">جامعہ مدنیہ کا تعارفی ویڈیو</h1>
                    <p class="mb-4">جامعہ مدنیہ ایک عظیم دینی درسگاہ ہے جہاں قرآن و حدیث کی تعلیم دی جاتی ہے۔ اس ویڈیو میں آپ جامعہ کی عمارت، اساتذہ کرام، طلبہ اور تعلیمی ماحول کو قریب سے دیکھ سکتے ہیں۔</p>
                    
                    <div class="d-flex align-items-center mb-4">
                        <div class="flex-shrink-0 bg-primary rounded-circle p-3 me-3">
                            <i class="fas fa-mosque text-white fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">دینی تعلیم کا بہترین مرکز</h5>
                            <p class="mb-0 text-muted">جامعہ مدنیہ میں حفظ قرآن اور درس نظامی کی معیاری تعلیم</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center mb-4">
                        <div class="flex-shrink-0 bg-primary rounded-circle p-3 me-3">
                            <i class="fas fa-user-graduate text-white fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">تجربہ کار اساتذہ</h5>
                            <p class="mb-0 text-muted">قرآن و حدیث کے ماہر اساتذہ کی نگرانی میں تعلیم</p>
                        </div>
                    </div>
                    
                    <a href="mad_intro.mp4" class="btn btn-primary py-3 px-4 me-2" download>
                        <i class="fas fa-download me-2"></i> ویڈیو ڈاؤن لوڈ کریں
                    </a>
                    <a href="#" class="btn btn-outline-primary py-3 px-4">
                        <i class="fas fa-share-alt me-2"></i> شیئر کریں
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="videoModalLabel">جامعہ مدنیہ کا تعارفی ویڈیو</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="ratio ratio-16x9">
                    <video id="introVideo" controls class="w-100">
                        <source src="mad_intro.mp4" type="video/mp4">
                        آپ کا براؤزر ویڈیو کو سپورٹ نہیں کرتا۔
                    </video>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بند کریں</button>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom CSS for Video Section */
.video-play-button {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 10;
}

.video-play-button a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 80px;
    height: 80px;
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(5px);
    border-radius: 50%;
    color: white;
    font-size: 30px;
    transition: all 0.3s ease;
}

.video-play-button a:hover {
    background: var(--bs-primary);
    transform: scale(1.1);
}

.video-stats {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0,0,0,0.7);
    transition: all 0.3s ease;
}

.video-popup-btn:hover + .video-stats {
    opacity: 0;
}

@media (max-width: 767.98px) {
    .video-play-button a {
        width: 60px;
        height: 60px;
        font-size: 24px;
    }
}

/* Video player styling */
#introVideo {
    background-color: #000;
    border-radius: 8px;
    overflow: hidden;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var videoModal = document.getElementById('videoModal');
    var video = document.getElementById('introVideo');
    
    videoModal.addEventListener('show.bs.modal', function () {
        // Play video when modal opens
        video.play();
    });
    
    videoModal.addEventListener('hide.bs.modal', function () {
        // Pause video when modal closes
        video.pause();
        // Reset video to beginning
        video.currentTime = 0;
    });
    
    // Handle download button
    document.querySelector('[download]').addEventListener('click', function(e) {
        // You can add download tracking here if needed
        console.log('Video download initiated');
    });
});
</script>
<!-- Intro video ends -->

  <!-- Yearly Risala Section Start -->
<section class="py-5 bg-light" id="risala">
    <div class="container">
        <div class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="text-uppercase text-primary">جامعہ مدنیہ کا سالانہ</h5>
            <h1 class="display-5 mb-0">رسالہ</h1>
            <p class="fs-5 text-muted">ہمارے سالانہ رسالے میں دینی تعلیمات، مضامین اور جامعہ کی سرگرمیاں</p>
        </div>

        <?php 
        $file_gallery = return_multiple_rows("SELECT * FROM page_files WHERE isactive = 1 AND soft_delete = 0 AND pid = 16423 ORDER BY f_sequence DESC");
        
        if (!empty($file_gallery)): 
            // Get current year's risala (first item)
            $current_risala = $file_gallery[0];
            $current_file_path = BASE_URL . ABSOLUTE_FILEPATH . $current_risala['f_name'];
            $current_thumbnail = !empty($current_risala['f_thumbnail']) ? BASE_URL . ABSOLUTE_IMAGEPATH . $current_risala['f_thumbnail'] : 'img/default-book.jpg';
            
            // Get previous risalas (all except first item)
            $previous_risalas = array_slice($file_gallery, 1);
        ?>
        
        <div class="row g-4">
            <!-- Current Year Risala -->
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="card border-0 shadow-lg h-100">
                    <div class="position-relative">
                        <img src="<?= $current_thumbnail ?>" class="card-img-top" alt="<?= htmlspecialchars($current_risala['f_title']) ?>">
                        <div class="badge bg-primary text-white position-absolute top-0 end-0 m-3 fs-6">نیا</div>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title"><?= htmlspecialchars($current_risala['f_title']) ?></h3>
                        <p class="card-text"><?= html_entity_decode($current_risala['f_description']) ?></p>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <a href="<?= $current_file_path ?>" class="btn btn-primary py-2 px-4 me-2" download>
                            <i class="fa fa-download me-2"></i> ڈاؤن لوڈ کریں
                        </a>
                        <a href="<?= $current_file_path ?>" target="_blank" class="btn btn-outline-primary py-2 px-4">
                            <i class="fa fa-book me-2"></i> آن لائن پڑھیں
                        </a>
                    </div>
                </div>
            </div>

            <!-- Previous Years Risala Archive -->
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="card border-0 shadow-lg h-100">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">گذشتہ سالوں کے رسالے</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>سال</th>
                                        <th>عنوان</th>
                                        <th>عمل</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($previous_risalas as $risala): 
                                        $file_path = BASE_URL . ABSOLUTE_FILEPATH . $risala['f_name'];
                                        $year = date('Y', strtotime($risala['createdon']));
                                    ?>
                                    <tr>
                                        <td><?= $year ?></td>
                                        <td><?= htmlspecialchars($risala['f_title']) ?></td>
                                        <td>
                                            <a href="<?= $file_path ?>" class="btn btn-sm btn-outline-primary" download>
                                                <i class="fa fa-download"></i>
                                            </a>
                                            <a href="<?= $file_path ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fa fa-book"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php if (count($previous_risalas) > 5): ?>
                    <div class="card-footer bg-white border-0 text-center">
                        <a href="yearly-magazine.html" class="btn btn-link">تمام گذشتہ رسالے دیکھیں <i class="fa fa-arrow-right ms-2"></i></a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center mt-5 wow fadeInUp" data-wow-delay="0.7s">
            <div class="bg-primary p-4 rounded">
                <h3 class="text-white mb-3">رسالے میں اپنا مضمون شائع کروائیں</h3>
                <p class="text-white mb-4">اگر آپ دینی موضوعات پر لکھتے ہیں تو اپنا مضمون ہمارے سالانہ رسالے کے لیے ارسال کریں۔</p>
                <a href="#" class="btn btn-light py-2 px-4"><i class="fa fa-pen me-2"></i> مضمون ارسال کریں</a>
            </div>
        </div>
        
        <?php else: ?>
        <div class="text-center py-5">
            <i class="fas fa-book fa-3x text-muted mb-3"></i>
            <h4>کوئی رسالہ دستیاب نہیں ہے</h4>
            <p class="text-muted">براہ کرم بعد میں دوبارہ کوشش کریں</p>
        </div>
        <?php endif; ?>
    </div>
</section>
<!-- Yearly Risala Section End -->

<!-- Audio Bayanat Section Start -->

<?php
// Get first 6 audio files (assuming they're MP4 files in your case)
$audio_files = return_multiple_rows("SELECT * FROM videos WHERE pid = 16425 AND isactive = 1 AND soft_delete = 0 ORDER BY v_sequence LIMIT 6");
?>

<!-- Audio Bayanat Section -->
<section class="py-5">
    <div class="container py-5">
        <div class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="text-uppercase text-primary">آڈیو بیانات</h5>
            <h1 class="display-5 mb-0">ہمارے آڈیو بیانات</h1>
            <p class="fs-5 text-muted">علماء کرام کے بیانات سے مستفید ہوں</p>
        </div>

        <!-- Audio Bayanat Cards -->
        <div class="row g-4">
            <?php foreach ($audio_files as $index => $audio): 
                $audio_path = BASE_URL . ABSOLUTE_VIDEOPATH . $audio['v_name'];
                $speaker_name = $audio['section_name'] ?: 'مولانا صاحب';
                $title = $audio['v_title'] ?: 'بیان';
                $date = date('d M Y', strtotime($audio['createdon']));
            ?>
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.<?= ($index%3)+3 ?>s">
                <div class="card border-0 shadow-lg h-100">
                    <div class="card-img-top bg-dark position-relative" style="height: 200px;">
                        <?php if (!empty($audio['v_thumbnail'])): ?>
                            <img src="<?= BASE_URL . ABSOLUTE_IMAGEPATH . $audio['v_thumbnail'] ?>" class="img-fluid h-100 w-100 object-fit-cover" alt="<?= htmlspecialchars($title) ?>">
                        <?php else: ?>
                            <div class="h-100 w-100 d-flex align-items-center justify-content-center bg-secondary">
                                <i class="fas fa-headphones fa-4x text-white"></i>
                            </div>
                        <?php endif; ?>
                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                            <button class="btn btn-primary btn-lg rounded-circle" style="width: 60px; height: 60px;"
                                onclick="document.getElementById('audioPlayer<?= $audio['v_id'] ?>').play()">
                                <i class="fa fa-play"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title"><?= htmlspecialchars($title) ?></h4>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fa fa-user text-primary me-2"></i>
                            <span><?= htmlspecialchars($speaker_name) ?></span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fa fa-calendar text-primary me-2"></i>
                            <span><?= $date ?></span>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <audio id="audioPlayer<?= $audio['v_id'] ?>" controls class="w-100">
                            <source src="<?= $audio_path ?>" type="audio/mpeg">
                            آپ کا براؤزر آڈیو ایلیمنٹ کو سپورٹ نہیں کرتا۔
                        </audio>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- View More Button -->
        <div class="text-center mt-5 wow fadeInUp" data-wow-delay="0.9s">
            <a href="audio-bayant.html" class="btn btn-primary py-3 px-5">
                <i class="fa fa-headphones me-2"></i> مزید بیانات سنیں
            </a>
        </div>
    </div>
</section>

<style>
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}
.audio-controls {
    width: 100%;
    background: #f8f9fa;
    border-radius: 0 0 8px 8px;
}
</style>

<script>
// Auto-pause other players when one plays
document.addEventListener('play', function(e){
    var audios = document.getElementsByTagName('audio');
    for(var i = 0, len = audios.length; i < len; i++){
        if(audios[i] != e.target){
            audios[i].pause();
        }
    }
}, true);
</script>

<!-- Gallery Section Start -->
<section class="py-5 bg-light" id="gallery">
    <div class="container py-5">
        <div class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="text-uppercase text-primary">تصاویر</h5>
            <h1 class="display-5 mb-0">ہماری گیلری</h1>
            <p class="fs-5 text-muted">جامعہ مدنیہ کی سرگرمیوں اور تقریبات کی جھلکیاں</p>
        </div>

        <div class="row g-4">
            <?php
            // Fetch limited number of gallery images (6 in this case)
            $gallery_images = return_multiple_rows(
                "SELECT * FROM images 
                    WHERE isactive = 1 AND soft_delete = 0 AND pid = 16424 
                    ORDER BY RAND()
                LIMIT 6; "
            );
            
            if (!empty($gallery_images)):
                foreach ($gallery_images as $image): 
                    $image_path = BASE_URL . ABSOLUTE_IMAGEPATH . $image['i_name'];
            ?>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.<?= ($index+1) ?>s">
                <div class="gallery-item position-relative rounded overflow-hidden">
                    <img src="<?= $image_path ?>" class="img-fluid w-100" alt="<?= htmlspecialchars($image['i_alttext'] ?: 'Gallery Image') ?>">
                    <div class="gallery-overlay">
                        <a href="<?= $image_path ?>" data-lightbox="gallery" class="btn btn-primary btn-square rounded-circle">
                            <i class="fa fa-search-plus"></i>
                        </a>
                        <div class="gallery-caption bg-white p-3">
                            <h6 class="mb-1"><?= htmlspecialchars($image['i_title'] ?: 'Gallery') ?></h6>
                            <small class="text-muted"><?= htmlspecialchars($image['section_name']) ?></small>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <div class="col-12 text-center py-5">
                <i class="fas fa-image fa-3x text-muted mb-3"></i>
                <h4>تصاویر دستیاب نہیں ہیں</h4>
            </div>
            <?php endif; ?>
        </div>

        <!-- Complete Gallery Button -->
        <div class="text-center mt-5 wow fadeInUp" data-wow-delay="0.7s">
            <a href="gallery.php" class="btn btn-primary py-3 px-5">
                <i class="fa fa-images me-2"></i> مکمل گیلری دیکھیں
            </a>
        </div>
    </div>
</section>
<!-- Gallery Section End -->

<!-- Add Lightbox CSS and JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<style>
.gallery-item {
    position: relative;
    overflow: hidden;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    height: 250px;
}

.gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.gallery-item:hover img {
    transform: scale(1.1);
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(0,0,0,0.3);
    opacity: 0;
    transition: all 0.3s ease;
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.gallery-caption {
    position: absolute;
    bottom: -100%;
    left: 0;
    width: 100%;
    transition: all 0.3s ease;
}

.gallery-item:hover .gallery-caption {
    bottom: 0;
}
</style>

<script>
// Initialize lightbox
lightbox.option({
    'resizeDuration': 200,
    'wrapAround': true,
    'showImageNumberLabel': true,
    'alwaysShowNavOnTouchDevices': true
});
</script>

    <!-- Events Start -->
    <div class="container-fluid event py-5">
        <div class="container py-5">
            <h1 class="display-3 mb-5 wow fadeIn" data-wow-delay="0.1s">آنے والی <span class="text-primary">تقریبات</span></h1>
            <div class="row g-4 event-item wow fadeIn" data-wow-delay="0.1s">
                <div class="col-3 col-lg-2 pe-0">
                    <div class="text-center border-bottom border-dark py-3 px-2">
                        <h6>01 جنوری 2024</h6>
                        <p class="mb-0">جمعہ 06:55</p>
                    </div>
                </div>
                <div class="col-9 col-lg-6 border-start border-dark pb-5">
                    <div class="ms-3">
                        <h4 class="mb-3">میلاد النبی ﷺ</h4>
                        <p class="mb-4">جامعہ مدنیہ میں میلاد النبی ﷺ کی خصوصی تقریب منعقد ہوگی جس میں علماء کرام سے خطابات ہوں گے۔</p>
                        <a href="#" class="btn btn-primary px-3">شامل ہوں</a>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="overflow-hidden mb-5">
                        <img src="img/events-1.jpg" class="img-fluid w-100" alt="">
                    </div>
                </div>
            </div>
            <div class="row g-4 event-item wow fadeIn" data-wow-delay="0.3s">
                <div class="col-3 col-lg-2 pe-0">
                    <div class="text-center border-bottom border-dark py-3 px-2">
                        <h6>10 اپریل 2024</h6>
                        <p class="mb-0">بدھ 11:30</p>
                    </div>
                </div>
                <div class="col-9 col-lg-6 border-start border-dark pb-5">
                    <div class="ms-3">
                        <h4 class="mb-3">عید الفطر</h4>
                        <p class="mb-4">جامعہ مدنیہ میں عید الفطر کی خصوصی نماز اور تقریب کا اہتمام کیا جائے گا۔</p>
                        <a href="#" class="btn btn-primary px-3">شامل ہوں</a>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="overflow-hidden mb-5">
                        <img src="img/events-2.jpg" class="img-fluid w-100" alt="">
                    </div>
                </div>
            </div>
            <div class="row g-4 event-item wow fadeIn" data-wow-delay="0.5s">
                <div class="col-3 col-lg-2 pe-0">
                    <div class="text-center border-bottom border-dark py-3 px-2">
                        <h6>16 جون 2024</h6>
                        <p class="mb-0">جمعرات 11:30</p>
                    </div>
                </div>
                <div class="col-9 col-lg-6 border-start border-dark pb-5">
                    <div class="ms-3">
                        <h4 class="mb-3">عید الاضحی</h4>
                        <p class="mb-4">جامعہ مدنیہ میں عید الاضحی کی خصوصی نماز اور قربانی کی تقریب منعقد ہوگی۔</p>
                        <a href="#" class="btn btn-primary px-3">شامل ہوں</a>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="overflow-hidden mb-5">
                        <img src="img/events-3.jpg" class="img-fluid w-100" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Events End -->


    <!-- Sermon Start -->
    <div class="container-fluid sermon py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeIn" data-wow-delay="0.1s" style="max-width: 700px;">
                <p class="fs-5 text-uppercase text-primary">بیانات</p>
                <h1 class="display-3">اسلامی معاشرے سے جڑیں</h1>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-6 col-xl-4">
                    <div class="sermon-item wow fadeIn" data-wow-delay="0.1s">
                        <div class="overflow-hidden p-4 pb-0">
                            <img src="img/sermon-1.jpg" class="img-fluid w-100" alt="">
                        </div>
                        <div class="p-4">
                            <div class="sermon-meta d-flex justify-content-between pb-2">
                                <div class="">
                                    <small><i class="fa fa-calendar me-2 text-muted"></i><a href="" class="text-muted me-2">13 نومبر 2023</small></a>
                                    <small><i class="fas fa-user me-2 text-muted"></i><a href="" class="text-muted">ایڈمن</small></a>
                                </div>
                                <div class="">
                                    <a href="" class="me-1"><i class="fas fa-video text-muted"></i></a>
                                    <a href="" class="me-1"><i class="fas fa-headphones text-muted"></i></a>
                                    <a href="" class="me-1"><i class="fas fa-file-alt text-muted"></i></a>
                                    <a href="" class=""><i class="fas fa-image text-muted"></i></a>
                                </div>
                            </div>
                            <a href="" class="d-inline-block h4 lh-sm mb-3">اللہ تعالیٰ سے قریب ہونے کے طریقے</a>
                            <p class="mb-0">حضرت مولانا ارشاد احمد صاحب کا خصوصی بیان جس میں اللہ تعالیٰ سے قریب ہونے کے طریقے بیان کیے گئے ہیں۔</p>
                        </div>
                    </div>
                </div>
               <div class="col-lg-6 col-xl-4">
                    <div class="sermon-item wow fadeIn" data-wow-delay="0.3s">
                        <div class="overflow-hidden p-4 pb-0">
                            <img src="img/sermon-2.jpg" class="img-fluid w-100" alt="">
                        </div>
                        <div class="p-4">
                            <div class="sermon-meta d-flex justify-content-between pb-2">
                                <div class="">
                                    <small><i class="fa fa-calendar me-2 text-muted"></i><a href="" class="text-muted me-2">13 نومبر 2023</small></a>
                                    <small><i class="fas fa-user me-2 text-muted"></i><a href="" class="text-muted">ایڈمن</small></a>
                                </div>
                                <div class="">
                                    <a href="" class="me-1"><i class="fas fa-video text-muted"></i></a>
                                    <a href="" class="me-1"><i class="fas fa-headphones text-muted"></i></a>
                                    <a href="" class="me-1"><i class="fas fa-file-alt text-muted"></i></a>
                                    <a href="" class=""><i class="fas fa-image text-muted"></i></a>
                                </div>
                            </div>
                            <a href="" class="d-inline-block h4 lh-sm mb-3">اسلام میں حج کی اہمیت</a>
                            <p class="mb-0">حضرت مولانا نعیم صاحب کا خصوصی بیان جس میں حج کی فضیلت اور اہمیت کو بیان کیا گیا ہے۔</p>
                        </div>
                    </div>
                </div>
               <div class="col-lg-6 col-xl-4">
                    <div class="sermon-item wow fadeIn" data-wow-delay="0.5s">
                        <div class="overflow-hidden p-4 pb-0">
                            <img src="img/sermon-3.jpg" class="img-fluid w-100" alt="">
                        </div>
                        <div class="p-4">
                            <div class="sermon-meta d-flex justify-content-between pb-2">
                                <div class="">
                                    <small><i class="fa fa-calendar me-2 text-muted"></i><a href="" class="text-muted me-2">13 نومبر 2023</small></a>
                                    <small><i class="fas fa-user me-2 text-muted"></i><a href="" class="text-muted">ایڈمن</small></a>
                                </div>
                                <div class="">
                                    <a href="" class="me-1"><i class="fas fa-video text-muted"></i></a>
                                    <a href="" class="me-1"><i class="fas fa-headphones text-muted"></i></a>
                                    <a href="" class="me-1"><i class="fas fa-file-alt text-muted"></i></a>
                                    <a href="" class=""><i class="fas fa-image text-muted"></i></a>
                                </div>
                            </div>
                            <a href="" class="d-inline-block h4 lh-sm mb-3">اسلام کے "ارکان" کی اہمیت</a>
                            <p class="mb-0">حضرت مولانا عبدالستار صاحب کا خصوصی بیان جس میں اسلام کے ارکان کی اہمیت کو واضح کیا گیا ہے۔</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sermon End -->


    <!-- Blog Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="display-3 mb-5 wow fadeIn" data-wow-delay="0.1s">ہمارے <span class="text-primary">بلاگز</span> سے تازہ ترین</h1>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-6 col-xl-4">
                    <div class="blog-item wow fadeIn" data-wow-delay="0.1s">
                        <div class="blog-img position-relative overflow-hidden">
                            <img src="img/blog-1.jpg" class="img-fluid w-100" alt="">
                            <div class="bg-primary d-inline px-3 py-2 text-center text-white position-absolute top-0 end-0">01 جنوری 2024</div>
                        </div>
                        <div class="p-4">
                            <div class="blog-meta d-flex justify-content-between pb-2">
                                <div class="">
                                    <small><i class="fas fa-user me-2 text-muted"></i><a href="" class="text-muted me-2">ایڈمن کی جانب سے</small></a>
                                    <small><i class="fa fa-comment-alt me-2 text-muted"></i><a href="" class="text-muted me-2">12 تبصرے</small></a>
                                </div>
                                <div class="">
                                    <a href=""><i class="fas fa-bookmark text-muted"></i></a>
                                </div>
                            </div>
                            <a href="" class="d-inline-block h4 lh-sm mb-3">اسلام کے "ارکان" کی اہمیت</a>
                            <p class="mb-4">اس بلاگ میں اسلام کے بنیادی ارکان کی اہمیت اور ان کے معاشرے پر اثرات پر تفصیلی بحث کی گئی ہے۔</p>
                            <a href="#" class="btn btn-primary px-3">مزید تفصیلات</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="blog-item wow fadeIn" data-wow-delay="0.3s">
                        <div class="blog-img position-relative overflow-hidden">
                            <img src="img/blog-2.jpg" class="img-fluid w-100" alt="">
                            <div class="bg-primary d-inline px-3 py-2 text-center text-white position-absolute top-0 end-0">01 جنوری 2024</div>
                        </div>
                        <div class="p-4">
                            <div class="blog-meta d-flex justify-content-between pb-2">
                                <div class="">
                                    <small><i class="fas fa-user me-2 text-muted"></i><a href="" class="text-muted me-2">ایڈمن کی جانب سے</small></a>
                                    <small><i class="fa fa-comment-alt me-2 text-muted"></i><a href="" class="text-muted me-2">12 تبصرے</small></a>
                                </div>
                                <div class="">
                                    <a href=""><i class="fas fa-bookmark text-muted"></i></a>
                                </div>
                            </div>
                            <a href="" class="d-inline-block h4 lh-sm mb-3">اللہ تعالیٰ سے قریب ہونے کے طریقے</a>
                            <p class="mb-4">اس بلاگ میں اللہ تعالیٰ سے قریب ہونے کے عملی طریقے بیان کیے گئے ہیں جو ہر مسلمان کے لیے مفید ہیں۔</p>
                            <a href="#" class="btn btn-primary px-3">مزید تفصیلات</a>
                        </div>
                    </div>
                </div>
               <div class="col-lg-6 col-xl-4">
                    <div class="blog-item wow fadeIn" data-wow-delay="0.5s">
                        <div class="blog-img position-relative overflow-hidden">
                            <img src="img/blog-3.jpg" class="img-fluid w-100" alt="">
                            <div class="bg-primary d-inline px-3 py-2 text-center text-white position-absolute top-0 end-0">01 جنوری 2024</div>
                        </div>
                        <div class="p-4">
                            <div class="blog-meta d-flex justify-content-between pb-2">
                                <div class="">
                                    <small><i class="fas fa-user me-2 text-muted"></i><a href="" class="text-muted me-2">ایڈمن کی جانب سے</small></a>
                                    <small><i class="fa fa-comment-alt me-2 text-muted"></i><a href="" class="text-muted me-2">12 تبصرے</small></a>
                                </div>
                                <div class="">
                                    <a href=""><i class="fas fa-bookmark text-muted"></i></a>
                                </div>
                            </div>
                            <a href="" class="d-inline-block h4 lh-sm mb-3">اسلام میں حج کی اہمیت</a>
                            <p class="mb-4">اس بلاگ میں حج کی فضیلت، اہمیت اور اس کے معاشرتی و روحانی فوائد پر روشنی ڈالی گئی ہے۔</p>
                            <a href="#" class="btn btn-primary px-3">مزید تفصیلات</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog End -->


<!-- Bayanat Section Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mx-auto mb-5 wow fadeIn" data-wow-delay="0.1s" style="max-width: 700px;">
            <p class="fs-5 text-uppercase text-primary">بیانات</p>
            <h1 class="display-3">علماء کرام کے بیانات</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="card h-100">
                    <div class="card-body p-4">
                        <h4 class="card-title mb-3">شفق و رحمت سے پڑھنا</h4>
                        <p class="card-text"><strong>بیان:</strong> حضرت مولانا ارشاد احمد</p>
                        <p class="card-text"><strong>سامعین:</strong> اساتذہ کرام شعبہ حفظ</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <a href="#" class="btn btn-primary btn-sm">مزید تفصیلات</a>
                            <small class="text-muted">12 جنوری 2024</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeIn" data-wow-delay="0.3s">
                <div class="card h-100">
                    <div class="card-body p-4">
                        <h4 class="card-title mb-3">شفق و رحمت سے پڑھنا</h4>
                        <p class="card-text"><strong>بیان:</strong> حضرت مولانا ارشاد احمد</p>
                        <p class="card-text"><strong>سامعین:</strong> اساتذہ کرام شعبہ حفظ</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <a href="#" class="btn btn-primary btn-sm">مزید تفصیلات</a>
                            <small class="text-muted">5 جنوری 2024</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="card h-100">
                    <div class="card-body p-4">
                        <h4 class="card-title mb-3">شفق و رحمت سے پڑھنا</h4>
                        <p class="card-text"><strong>بیان:</strong> حضرت مولانا ارشاد احمد</p>
                        <p class="card-text"><strong>سامعین:</strong> اساتذہ کرام شعبہ حفظ</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <a href="#" class="btn btn-primary btn-sm">مزید تفصیلات</a>
                            <small class="text-muted">29 دسمبر 2023</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="#" class="btn btn-primary px-4">مزید بیانات</a>
        </div>
    </div>
</div>
<!-- Bayanat Section End -->

    <!-- Books Section Start -->
<section class="library-section py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <!-- Image Column -->
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="library-img-container position-relative">
                    <img src="img/library.jpg" class="img-fluid rounded-4 library-main-img shadow-lg" alt="جامعہ مدنیہ لائبریری">
                    
                    <!-- Decorative Elements -->
                    <div class="library-decoration-1"></div>
                    <div class="library-decoration-2"></div>
                    
                    <!-- Floating Book Icons -->
                    <div class="floating-book book-1">
                        <i class="fas fa-book-open text-primary"></i>
                    </div>
                    <div class="floating-book book-2">
                        <i class="fas fa-quran text-warning"></i>
                    </div>
                    <div class="floating-book book-3">
                        <i class="fas fa-book text-success"></i>
                    </div>
                </div>
            </div>
            
            <!-- Content Column -->
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.3s">
                <div class="ps-lg-4">
                    <span class="section-tag bg-primary bg-opacity-10 text-primary py-1 px-3 rounded-pill">علم کا خزانہ</span>
                    <h1 class="display-5 fw-bold mb-4 mt-3">جامعہ مدنیہ کا عظیم کتب خانہ</h1>
                    
                    <div class="library-description mb-4">
                        <p class="lead text-dark mb-4">
                            تعلیم اور کتب خانے ایک دوسرے کیلئے لازم وملزوم کی حیثیت رکھتے ہیں۔ کوئی تعلیمی درسگاہ ایک منظم کتب خانے کی ضرورت سے بے نیاز نہیں ہوسکتی۔
                        </p>
                        
                        <div class="d-flex align-items-start mb-3">
                            <div class="flex-shrink-0">
                                <div class="library-icon-box bg-primary bg-opacity-10 text-primary rounded-3 p-2">
                                    <i class="fas fa-check fs-5 text-light"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-0 text-dark">
                                    تعلیمی اداروں میں نصابی ضرورت محض نصابی کتابوں سے پوری نہیں ہو سکتیں
                                </p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-start mb-3">
                            <div class="flex-shrink-0">
                                <div class="library-icon-box bg-primary bg-opacity-10 text-primary rounded-3 p-2">
                                    <i class="fas fa-check fs-5 text-light"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-0 text-dark">
                                    تحقیقی ضروریات کیلئے اضافی کتابوں کا ہونا ضروری ہے
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Features Grid -->
                    <div class="row g-4 mb-4">
                        <div class="col-sm-6">
                            <div class="library-feature-card p-4 rounded-4 h-100">
                                <div class="icon-wrapper bg-primary bg-opacity-10 text-primary rounded-3 p-3 mb-3">
                                    <i class="fas fa-book fs-3 text-light"></i>
                                </div>
                                <h5 class="mb-2">سیکڑوں کتابیں</h5>
                                <p class="small text-muted mb-0">دینی و دنیاوی علوم پر مشتمل</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="library-feature-card p-4 rounded-4 h-100">
                                <div class="icon-wrapper bg-primary bg-opacity-10 text-primary rounded-3 p-3 mb-3">
                                    <i class="fas fa-users fs-3 text-light"></i>
                                </div>
                                <h5 class="mb-2">اساتذہ و طلباء</h5>
                                <p class="small text-muted mb-0">سب کی تحقیقی ضروریات پوری کرنا</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#" class="btn btn-primary px-4 py-3">
                            <i class="fas fa-book-open me-2"></i> لائبریری دیکھیں
                        </a>
                        <a href="#" class="btn btn-outline-primary px-4 py-3">
                            <i class="fas fa-list me-2 text-light"></i> کتابوں کی فہرست
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Books Section End -->

<style>
/* Library Section Custom Styles */
.library-section {
    background-color: #f8f9fa;
    position: relative;
    overflow: hidden;
}

.library-img-container {
    position: relative;
    z-index: 1;
}

.library-main-img {
    border: 8px solid white;
    transform: perspective(1000px) rotateY(-5deg);
    transition: all 0.5s ease;
}

.library-img-container:hover .library-main-img {
    transform: perspective(1000px) rotateY(0deg);
}

/* Decorative Elements */
.library-decoration-1 {
    position: absolute;
    width: 150px;
    height: 150px;
    background-color: rgba(13, 110, 253, 0.1);
    border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
    top: -20px;
    left: -20px;
    z-index: -1;
    animation: float 6s ease-in-out infinite;
}

.library-decoration-2 {
    position: absolute;
    width: 100px;
    height: 100px;
    background-color: rgba(255, 193, 7, 0.1);
    border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
    bottom: -30px;
    right: -30px;
    z-index: -1;
    animation: float 8s ease-in-out infinite;
}

/* Floating Books Animation */
.floating-book {
    position: absolute;
    font-size: 1.5rem;
    opacity: 0.8;
    animation: float 5s ease-in-out infinite;
}

.floating-book.book-1 {
    top: 10%;
    left: -5%;
    animation-delay: 0s;
}

.floating-book.book-2 {
    top: 70%;
    right: -5%;
    animation-delay: 1s;
}

.floating-book.book-3 {
    bottom: 10%;
    left: 20%;
    animation-delay: 2s;
}

/* Feature Cards */
.library-feature-card {
    background-color: white;
    border: 1px solid rgba(0,0,0,0.05);
    box-shadow: 0 5px 15px rgba(0,0,0,0.03);
    transition: all 0.3s ease;
}

.library-feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

/* Icon Wrapper */
.icon-wrapper {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

/* Section Tag */
.section-tag {
    font-size: 0.8rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

/* Floating Animation */
@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
    100% { transform: translateY(0px); }
}

@media (max-width: 767.98px) {
    .library-main-img {
        transform: none;
    }
    
    .floating-book {
        display: none;
    }
}
</style>

<script>
// Additional interactive effects
document.addEventListener('DOMContentLoaded', function() {
    const libraryImg = document.querySelector('.library-main-img');
    
    if (libraryImg) {
        libraryImg.addEventListener('mousemove', (e) => {
            const xAxis = (window.innerWidth / 2 - e.pageX) / 25;
            const yAxis = (window.innerHeight / 2 - e.pageY) / 25;
            libraryImg.style.transform = `perspective(1000px) rotateY(${xAxis}deg) rotateX(${yAxis}deg)`;
        });
        
        libraryImg.addEventListener('mouseleave', () => {
            libraryImg.style.transform = 'perspective(1000px) rotateY(-5deg)';
        });
    }
});
</script>

    <!-- Team Start -->
    <div class="container-fluid team py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeIn" data-wow-delay="0.1s" style="max-width: 700px;">
                <p class="fs-5 text-uppercase text-primary">ہمارا اسٹاف</p>
                <h1 class="display-3">ہمارے منتظمین سے ملاقات کریں</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-4 col-xl-5">
                    <div class="team-img wow zoomIn" data-wow-delay="0.1s">
                        <img src="img/team-1.jpg" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-lg-8 col-xl-7">
                    <div class="team-item wow fadeIn" data-wow-delay="0.1s">
                        <h1>مولانا نعیم صاحب</h1>
                        <h5 class="fw-normal fst-italic text-primary mb-4">صدر جامعہ مدنیہ</h5>
                        <p class="mb-4">مولانا نعیم صاحب جامعہ مدنیہ کے بانی اور صدر ہیں جنہوں نے دینی تعلیم کے فروغ کے لیے قابل قدر خدمات انجام دی ہیں۔</p>
                        <div class="team-icon d-flex pb-4 mb-4 border-bottom border-primary">
                            <a class="btn btn-primary btn-lg-square me-2" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-lg-square me-2" href=""><i class="fab fa-twitter"></i></a>
                            <a href="#" class="btn btn-primary btn-lg-square me-2"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="btn btn-primary btn-lg-square"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="team-item wow zoomIn" data-wow-delay="0.2s">
                                <img src="img/team-2.jpg" class="img-fluid w-100" alt="">
                                <div class="team-content text-dark text-center py-3">
                                    <div class="team-content-inner">
                                        <h5 class="mb-0">مولانا ارشاد احمد</h5>
                                        <p class="text-dark">امام و خطیب</p>
                                        <div class="team-icon d-flex align-items-center justify-content-center">
                                            <a class="btn btn-primary btn-sm-square me-2" href=""><i class="fab fa-facebook-f"></i></a>
                                            <a class="btn btn-primary btn-sm-square me-2" href=""><i class="fab fa-twitter"></i></a>
                                            <a href="#" class="btn btn-primary btn-sm-square me-2"><i class="fab fa-instagram"></i></a>
                                            <a href="#" class="btn btn-primary btn-sm-square"><i class="fab fa-linkedin-in"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="team-item wow zoomIn" data-wow-delay="0.4s">
                                <img src="img/team-3.jpg" class="img-fluid w-100" alt="">
                                <div class="team-content text-dark text-center py-3">
                                    <div class="team-content-inner">
                                        <h5 class="mb-0">مولانا عبدالستار</h5>
                                        <p class="text-dark">استاذ حدیث</p>
                                        <div class="team-icon d-flex align-items-center justify-content-center">
                                            <a class="btn btn-primary btn-sm-square me-2" href=""><i class="fab fa-facebook-f"></i></a>
                                            <a class="btn btn-primary btn-sm-square me-2" href=""><i class="fab fa-twitter"></i></a>
                                            <a href="#" class="btn btn-primary btn-sm-square me-2"><i class="fab fa-instagram"></i></a>
                                            <a href="#" class="btn btn-primary btn-sm-square"><i class="fab fa-linkedin-in"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="team-item wow zoomIn" data-wow-delay="0.6s">
                                <img src="img/team-4.jpg" class="img-fluid w-100" alt="">
                                <div class="team-content text-dark text-center py-3">
                                    <div class="team-content-inner">
                                        <h5 class="mb-0">مولانا محمد علی</h5>
                                        <p class="text-dark">استاذ قرآن</p>
                                        <div class="team-icon d-flex align-items-center justify-content-center">
                                            <a class="btn btn-primary btn-sm-square me-2" href=""><i class="fab fa-facebook-f"></i></a>
                                            <a class="btn btn-primary btn-sm-square me-2" href=""><i class="fab fa-twitter"></i></a>
                                            <a href="#" class="btn btn-primary btn-sm-square me-2"><i class="fab fa-instagram"></i></a>
                                            <a href="#" class="btn btn-primary btn-sm-square"><i class="fab fa-linkedin-in"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Testiminial Start -->
    <div class="container-fluid testimonial py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeIn" data-wow-delay="0.1s" style="max-width: 700px;">
                <p class="fs-5 text-uppercase text-primary">توصیفی کلمات</p>
                <h1 class="display-3">لوگ اسلام کے بارے میں کیا کہتے ہیں</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeIn" data-wow-delay="0.1s">
                <div class="testimonial-item">
                    <div class="d-flex mb-3">
                        <div class="position-relative">
                            <img src="img/testimonial-1.jpg" class="img-fluid" alt="">
                            <div class="btn-md-square bg-primary rounded-circle position-absolute" style="top: 25px; left: -25px;">
                                <i class="fa fa-quote-left text-dark"></i>
                            </div>
                        </div>
                        <div class="ps-3 my-auto ">
                            <h5 class="mb-0">احمد رضا</h5>
                            <p class="m-0">کاروباری شخصیت</p>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <div class="d-flex">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                        <p class="fs-5 m-0 pt-3">جامعہ مدنیہ ایک عظیم دینی درسگاہ ہے جہاں معیاری تعلیم دی جاتی ہے۔</p>
                    </div>
                </div>
                <div class="testimonial-item">
                    <div class="d-flex mb-3">
                        <div class="position-relative">
                            <img src="img/testimonial-2.jpg" class="img-fluid" alt="">
                            <div class="btn-md-square bg-primary rounded-circle position-absolute" style="top: 25px; left: -25px;">
                                <i class="fa fa-quote-left text-dark"></i>
                            </div>
                        </div>
                        <div class="ps-3 my-auto ">
                            <h5 class="mb-0">محمد عمر</h5>
                            <p class="m-0">استاذ</p>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <div class="d-flex">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                        <p class="fs-5 m-0 pt-3">جامعہ مدنیہ میں میرے بچوں کو قرآن و حدیث کی بہترین تعلیم دی گئی۔</p>
                    </div>
                </div>
                <div class="testimonial-item">
                    <div class="d-flex mb-3">
                        <div class="position-relative">
                            <img src="img/testimonial-3.jpg" class="img-fluid" alt="">
                            <div class="btn-md-square bg-primary rounded-circle position-absolute" style="top: 25px; left: -25px;">
                                <i class="fa fa-quote-left text-dark"></i>
                            </div>
                        </div>
                        <div class="ps-3 my-auto ">
                            <h5 class="mb-0">عبداللہ خان</h5>
                            <p class="m-0">طالب علم</p>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <div class="d-flex">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                        <p class="fs-5 m-0 pt-3">جامعہ مدنیہ میں تعلیم حاصل کرنا میرے لیے ایک اعزاز کی بات ہے۔</p>
                    </div>
                </div>
                <div class="testimonial-item">
                    <div class="d-flex mb-3">
                        <div class="position-relative">
                            <img src="img/testimonial-4.jpg" class="img-fluid" alt="">
                            <div class="btn-md-square bg-primary rounded-circle position-absolute" style="top: 25px; left: -25px;">
                                <i class="fa fa-quote-left text-dark"></i>
                            </div>
                        </div>
                        <div class="ps-3 my-auto ">
                            <h5 class="mb-0">سیدہ فاطمہ</h5>
                            <p class="m-0">گھریلو خاتون</p>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <div class="d-flex">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                        <p class="fs-5 m-0 pt-3">جامعہ مدنیہ کی خدمات قابل تحسین ہیں، اللہ تعالیٰ قبول فرمائے۔</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testiminial End -->
<?php 
echo replace_sysvari(front_script(null, $template_id), getcwd() . "/");
?>

<?php
echo replace_sysvari(front_footer(null, $template_id), getcwd() . "/");
?>

