<?php
include 'front_connect.php';

$url = "fatawa.php";

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
    '<link href="css/checkout.css" rel="stylesheet">'
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
$navbar_content = front_menu(null, $template_id);
if (!empty($navbar_content)) {
    echo replace_sysvari($navbar_content, getcwd() . "/");
}
?>

<!-- Hero Start -->
<div class="container-fluid hero-header bg-light position-relative">
    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-25"></div>
    <div class="container position-relative z-index-1">
        <div class="row">
            <div class="col-lg-7">
                <div class="hero-header-inner animated zoomIn">
                    <h1 class="display-1 text-dark"><?= htmlspecialchars($content['page_title']) ?></h1>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= replace_sysvari($content['cat_url']) ?>"><?= htmlspecialchars(replace_sysvari($content['catname'])) ?></a></li>
                        <li class="breadcrumb-item text-dark" aria-current="page"><?= htmlspecialchars($content['page_title']) ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->
    <style>
        .fatwa-card {
            transition: all 0.3s ease;
            border-left: 4px solid #0d6efd;
        }
        .fatwa-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .search-box {
            position: relative;
        }
        .search-box .form-control {
            padding-right: 45px;
        }
        .search-box .btn {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
        }
        .category-badge {
            font-size: 0.8rem;
            background-color: #f8f9fa;
            color: #0d6efd;
            border: 1px solid #dee2e6;
        }
        .mufti-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
        }
    </style>
    <!-- Fatwa Header Section -->
    <header class="bg-primary text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-4 fw-bold mb-3"><i class="fas fa-question-circle me-3"></i>جامعہ مدنیہ آن لائن فتاویٰ</h1>
                    <p class="lead mb-0">شرعی مسائل کے مستند اور معتبر جوابات</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <img src="img/jamia-logo.png" alt="جامعہ مدنیہ لوگو" style="height: 80px;">
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Section -->
    <div class="container py-5">
        <div class="row">
            <!-- Main Fatwa Content -->
            <div class="col-lg-8">
                <!-- Search Section -->
                <div class="card shadow-sm mb-5">
                    <div class="card-body">
                        <h4 class="card-title mb-4"><i class="fas fa-search me-2"></i>فتاویٰ تلاش کریں</h4>
                        <div class="search-box">
                            <input type="text" class="form-control form-control-lg" placeholder="فتاویٰ تلاش کریں...">
                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                        <div class="mt-3">
                            <a href="#" class="btn btn-sm btn-outline-primary me-2 mb-2">نماز</a>
                            <a href="#" class="btn btn-sm btn-outline-primary me-2 mb-2">روزہ</a>
                            <a href="#" class="btn btn-sm btn-outline-primary me-2 mb-2">زکوٰۃ</a>
                            <a href="#" class="btn btn-sm btn-outline-primary me-2 mb-2">حج</a>
                            <a href="#" class="btn btn-sm btn-outline-primary me-2 mb-2">معاملات</a>
                            <a href="#" class="btn btn-sm btn-outline-primary me-2 mb-2">نکاح</a>
                            <a href="#" class="btn btn-sm btn-outline-primary me-2 mb-2">طلاق</a>
                            <a href="#" class="btn btn-sm btn-outline-primary mb-2">جدید مسائل</a>
                        </div>
                    </div>
                </div>

                <!-- Ask Question Section -->
                <div class="card shadow-sm mb-5">
                    <div class="card-body">
                        <h4 class="card-title mb-4"><i class="fas fa-question me-2"></i>نیا سوال پوچھیں</h4>
                        <form>
                            <div class="mb-3">
                                <label for="questionCategory" class="form-label">زمرہ</label>
                                <select class="form-select" id="questionCategory">
                                    <option selected>زمرہ منتخب کریں</option>
                                    <option>نماز</option>
                                    <option>روزہ</option>
                                    <option>زکوٰۃ</option>
                                    <option>حج</option>
                                    <option>نکاح و طلاق</option>
                                    <option>معاملات</option>
                                    <option>جدید مسائل</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="questionTitle" class="form-label">سوال کا عنوان</label>
                                <input type="text" class="form-control" id="questionTitle" placeholder="سوال کا عنوان تحریر کریں">
                            </div>
                            <div class="mb-3">
                                <label for="questionDetail" class="form-label">سوال کی تفصیل</label>
                                <textarea class="form-control" id="questionDetail" rows="5" placeholder="سوال مکمل تفصیل سے تحریر کریں"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="questionerName" class="form-label">نام (اختیاری)</label>
                                <input type="text" class="form-control" id="questionerName" placeholder="اپنا نام تحریر کریں">
                            </div>
                            <button type="submit" class="btn btn-primary">سوال جمع کروائیں</button>
                        </form>
                    </div>
                </div>

                <!-- Recent Fatawa -->
                <div class="card shadow-sm mb-5">
                    <div class="card-body">
                        <h4 class="card-title mb-4"><i class="fas fa-file-alt me-2"></i>تازہ ترین فتاویٰ</h4>
                        
                        <!-- Fatwa 1 -->
                        <div class="card fatwa-card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="category-badge rounded-pill px-3 py-1">نماز</span>
                                    <small class="text-muted">2 دن پہلے</small>
                                </div>
                                <h5 class="mb-3">اگر نماز میں سورہ فاتحہ بھول جائے تو کیا حکم ہے؟</h5>
                                <p class="text-muted mb-3">نماز میں سورہ فاتحہ پڑھنا فرض ہے، اگر بھول جائے تو سجدہ سہو واجب ہوگا...</p>
                                <div class="d-flex align-items-center">
                                    <img src="img/mufti-1.jpg" alt="مفتی صاحب" class="mufti-img rounded-circle me-3">
                                    <div>
                                        <h6 class="mb-0">مفتی محمد عمر</h6>
                                        <small class="text-muted">جامعہ مدنیہ</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-white">
                                <a href="#" class="btn btn-sm btn-outline-primary">مکمل جواب پڑھیں</a>
                            </div>
                        </div>
                        
                        <!-- Fatwa 2 -->
                        <div class="card fatwa-card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="category-badge rounded-pill px-3 py-1">روزہ</span>
                                    <small class="text-muted">1 ہفتہ پہلے</small>
                                </div>
                                <h5 class="mb-3">کیا خون ٹیسٹ کروانے سے روزہ ٹوٹ جاتا ہے؟</h5>
                                <p class="text-muted mb-3">خون ٹیسٹ کروانے سے روزہ نہیں ٹوٹتا بشرطیکہ خون کی مقدار معمولی ہو...</p>
                                <div class="d-flex align-items-center">
                                    <img src="img/mufti-2.jpg" alt="مفتی صاحب" class="mufti-img rounded-circle me-3">
                                    <div>
                                        <h6 class="mb-0">مفتی ارشاد احمد</h6>
                                        <small class="text-muted">جامعہ مدنیہ</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-white">
                                <a href="#" class="btn btn-sm btn-outline-primary">مکمل جواب پڑھیں</a>
                            </div>
                        </div>
                        
                        <!-- Fatwa 3 -->
                        <div class="card fatwa-card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="category-badge rounded-pill px-3 py-1">زکوٰۃ</span>
                                    <small class="text-muted">2 ہفتے پہلے</small>
                                </div>
                                <h5 class="mb-3">کیا گھر کے سامان پر زکوٰۃ واجب ہوتی ہے؟</h5>
                                <p class="text-muted mb-3">صرف سونے چاندی، نقدی اور تجارتی سامان پر زکوٰۃ واجب ہوتی ہے، گھر کے استعمال کے سامان پر زکوٰۃ نہیں...</p>
                                <div class="d-flex align-items-center">
                                    <img src="img/mufti-3.jpg" alt="مفتی صاحب" class="mufti-img rounded-circle me-3">
                                    <div>
                                        <h6 class="mb-0">مفتی عبدالرحمن</h6>
                                        <small class="text-muted">جامعہ مدنیہ</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-white">
                                <a href="#" class="btn btn-sm btn-outline-primary">مکمل جواب پڑھیں</a>
                            </div>
                        </div>
                        
                        <!-- View More Button -->
                        <div class="text-center mt-4">
                            <a href="#" class="btn btn-primary">مزید فتاویٰ دیکھیں</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Muftis Section -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h4 class="card-title mb-4"><i class="fas fa-user-tie me-2"></i>ہمارے مفتیان کرام</h4>
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                                <img src="img/mufti-1.jpg" alt="مفتی صاحب" class="mufti-img rounded-circle me-3">
                                <div>
                                    <h6 class="mb-0">مفتی محمد عمر</h6>
                                    <small class="text-muted">صدر مفتی جامعہ مدنیہ</small>
                                </div>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                                <img src="img/mufti-2.jpg" alt="مفتی صاحب" class="mufti-img rounded-circle me-3">
                                <div>
                                    <h6 class="mb-0">مفتی ارشاد احمد</h6>
                                    <small class="text-muted">نائب صدر مفتی</small>
                                </div>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                                <img src="img/mufti-3.jpg" alt="مفتی صاحب" class="mufti-img rounded-circle me-3">
                                <div>
                                    <h6 class="mb-0">مفتی عبدالرحمن</h6>
                                    <small class="text-muted">شیخ الحدیث</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Categories Section -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h4 class="card-title mb-4"><i class="fas fa-tags me-2"></i>زمرہ جات</h4>
                        <div class="d-flex flex-wrap">
                            <a href="#" class="btn btn-sm btn-outline-primary me-2 mb-2">نماز (142)</a>
                            <a href="#" class="btn btn-sm btn-outline-primary me-2 mb-2">روزہ (98)</a>
                            <a href="#" class="btn btn-sm btn-outline-primary me-2 mb-2">زکوٰۃ (76)</a>
                            <a href="#" class="btn btn-sm btn-outline-primary me-2 mb-2">حج (54)</a>
                            <a href="#" class="btn btn-sm btn-outline-primary me-2 mb-2">نکاح (112)</a>
                            <a href="#" class="btn btn-sm btn-outline-primary me-2 mb-2">طلاق (67)</a>
                            <a href="#" class="btn btn-sm btn-outline-primary me-2 mb-2">معاملات (89)</a>
                            <a href="#" class="btn btn-sm btn-outline-primary me-2 mb-2">جدید مسائل (145)</a>
                        </div>
                    </div>
                </div>

                <!-- Popular Fatawa -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title mb-4"><i class="fas fa-fire me-2"></i>مقبول فتاویٰ</h4>
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action">موبائل پر قرآن سننے کا حکم</a>
                            <a href="#" class="list-group-item list-group-item-action">بینک ملازمت کے شرعی احکام</a>
                            <a href="#" class="list-group-item list-group-item-action">ڈیجیٹل کرنسی کا شرعی حکم</a>
                            <a href="#" class="list-group-item list-group-item-action">تین طلاقوں کا مسئلہ</a>
                            <a href="#" class="list-group-item list-group-item-action">شرعی پردے کی تفصیل</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
echo replace_sysvari(front_script(null, $template_id), getcwd() . "/");
?>

<?php
echo replace_sysvari(front_footer(null, $template_id), getcwd() . "/");
?>