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

$fataws = return_multiple_rows("Select * from pages Where template_id = 17 and isactive = 1 and soft_delete = 0");
$side_bar_categories = return_multiple_rows("Select * from category Where ParentCategory = 154 and isactive = 1 and soft_delete = 0");
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
    .accordion-button:not(.collapsed) {
        background-color: #f8f9fa;
        color: #0d6efd;
    }
    .fatwa-number {
        background-color: #f8f9fa;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 0.9rem;
    }
</style>

<!-- Fatwa Header Section -->
<header class="bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12">
                <h1 class="display-4 fw-bold mb-3"><i class="fas fa-question-circle me-3"></i>جامعہ مدنیہ آن لائن فتاویٰ</h1>
                <p class="lead mb-0">شرعی مسائل کے مستند اور معتبر جوابات</p>
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
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="search-box mb-3 mb-md-0">
                                    <input type="text" name="search" class="form-control form-control-lg" placeholder="فتاویٰ تلاش کریں..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="fatwa_number" class="form-control form-control-lg" placeholder="فتویٰ نمبر درج کریں" value="<?= isset($_GET['fatwa_number']) ? htmlspecialchars($_GET['fatwa_number']) : '' ?>">
                            </div>
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
                    </form>
                </div>
            </div>

            <!-- Selected Fatawa -->
            <div class="card shadow-sm mb-5">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title mb-0"><i class="fas fa-star me-2"></i>منتخب فتاویٰ</h4>
                </div>
                <div class="card-body">
                    <?php 
                    $selected_fatawa = array_slice($fataws, 0, 3); // Get first 3 as selected
                    foreach($selected_fatawa as $fatwa): ?>
                        <div class="card fatwa-card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="fatwa-number">فتویٰ نمبر: <?= $fatwa['pid'] ?></span>
                                    <small class="text-muted"><?= date('d M Y', strtotime($fatwa['createdon'])) ?></small>
                                </div>
                                <h5 class="mb-3"><?= htmlspecialchars($fatwa['page_title']) ?></h5>
                                <p class="text-muted mb-3"><?= substr(strip_tags($fatwa['page_desc']), 0, 150) ?>...</p>
                                <div class="d-flex align-items-center">
                                    <img src="img/mufti-1.jpg" alt="مفتی صاحب" class="mufti-img rounded-circle me-3">
                                    <div>
                                        <h6 class="mb-0">جامعہ مدنیہ</h6>
                                        <small class="text-muted">فتویٰ جات</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-white">
                                <a href="<?= BASE_URL . $fatwa['page_url'] ?>" class="btn btn-sm btn-outline-primary">مکمل جواب پڑھیں</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
                    <div class="text-center mt-4">
                        <a href="#" class="btn btn-primary">مزید منتخب فتاویٰ دیکھیں</a>
                    </div>
                </div>
            </div>

            <!-- New Fatawa -->
            <div class="card shadow-sm mb-5">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title mb-0"><i class="fas fa-file-alt me-2"></i>نئے فتاویٰ</h4>
                </div>
                <div class="card-body">
                    <?php 
                    $new_fatawa = array_slice($fataws, 3, 3); // Get next 3 as new
                    foreach($new_fatawa as $fatwa): ?>
                        <div class="card fatwa-card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="fatwa-number">فتویٰ نمبر: <?= $fatwa['pid'] ?></span>
                                    <small class="text-muted"><?= date('d M Y', strtotime($fatwa['createdon'])) ?></small>
                                </div>
                                <h5 class="mb-3"><?= htmlspecialchars($fatwa['page_title']) ?></h5>
                                <p class="text-muted mb-3"><?= substr(strip_tags($fatwa['page_desc']), 0, 150) ?>...</p>
                                <div class="d-flex align-items-center">
                                    <img src="img/mufti-1.jpg" alt="مفتی صاحب" class="mufti-img rounded-circle me-3">
                                    <div>
                                        <h6 class="mb-0">جامعہ مدنیہ</h6>
                                        <small class="text-muted">فتویٰ جات</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-white">
                                <a href="<?= BASE_URL . $fatwa['page_url'] ?>" class="btn btn-sm btn-outline-primary">مکمل جواب پڑھیں</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
                    <div class="text-center mt-4">
                        <a href="#" class="btn btn-primary">مزید نئے فتاویٰ دیکھیں</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Categories Section -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="card-title mb-4"><i class="fas fa-tags me-2"></i>زمرہ جات</h4>
                    <div class="accordion" id="fatwaCategories">
                        <?php foreach($side_bar_categories as $index => $category): ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading<?= $index ?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index ?>" aria-expanded="false" aria-controls="collapse<?= $index ?>">
                                    <?= htmlspecialchars($category['catname']) ?>
                                </button>
                            </h2>
                            <div id="collapse<?= $index ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $index ?>" data-bs-parent="#fatwaCategories">
                                <div class="accordion-body">
                                    <?php 
                                    $category_fatawa = array_filter($fataws, function($fatwa) use ($category) {
                                        return strpos($fatwa['page_title'], $category['catname']) !== false;
                                    });
                                    $category_fatawa = array_slice($category_fatawa, 0, 5);
                                    ?>
                                    <div class="list-group list-group-flush">
                                        <?php foreach($category_fatawa as $fatwa): ?>
                                            <a href="<?= BASE_URL . $fatwa['page_url'] ?>" class="list-group-item list-group-item-action"><?= htmlspecialchars($fatwa['page_title']) ?></a>
                                        <?php endforeach; ?>
                                        <a href="<?= BASE_URL . $category['cat_url'] ?>" class="list-group-item list-group-item-action text-primary">مزید دیکھیں...</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Popular Fatawa -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-4"><i class="fas fa-fire me-2"></i>مقبول فتاویٰ</h4>
                    <div class="list-group list-group-flush">
                        <?php 
                        $popular_fatawa = array_slice($fataws, 6, 15); // Get 10 popular fatawa
                        foreach($popular_fatawa as $fatwa): ?>
                            <a href="<?= BASE_URL . $fatwa['page_url'] ?>" class="list-group-item list-group-item-action"><?= htmlspecialchars($fatwa['page_title']) ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Side Bar -->
        
    </div>
</div>

<?php 
echo replace_sysvari(front_script(null, $template_id), getcwd() . "/");
echo replace_sysvari(front_footer(null, $template_id), getcwd() . "/");
?>