<?php
// Fatwa data from database
$fatwa = $content;
$categories = return_multiple_rows("SELECT * FROM page_category 
    INNER JOIN category ON page_category.cat_id = category.catid 
    WHERE page_category.page_id = ".$content['pid']." 
    AND category.isactive = 1 
    AND category.soft_delete = 0");

// Build category hierarchy
$categoryHierarchy = [];
foreach($categories as $cat) {
    if($cat['ParentCategory'] == 0) {
        $categoryHierarchy['main'] = $cat;
    } else {
        $categoryHierarchy['sub'][] = $cat;
    }
}

// Get all active categories for sidebar
$allActiveCategories = return_multiple_rows("SELECT * FROM category 
    WHERE isactive = 1 AND soft_delete = 0 and ParentCategory != 0
    ORDER BY cat_sequence");

// Format dates
$createdDate = date('d F Y', strtotime($fatwa['createdon']));
?>

<style>
    .fatwa-header {
        border-bottom: 2px solid #0d6efd;
        padding-bottom: 15px;
        margin-bottom: 25px;
        padding-top: 7rem;
    }
    .fatwa-content {
        line-height: 2;
        font-size: 1.1rem;
    }
    .fatwa-question {
        background-color: #f8f9fa;
        border-right: 4px solid #0d6efd;
        padding: 15px;
        margin-bottom: 25px;
    }
    .fatwa-answer {
        background-color: #fff;
        border: 1px solid #eee;
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .related-fatwa {
        border-left: 3px solid #0d6efd;
        padding-left: 15px;
        margin-bottom: 15px;
    }
    .fatwa-sidebar {
        padding-top: 7rem;
    }
    .fatwa-content img {
        width: 100%;
        border-radius: 8px;
        margin-bottom: 20px;
    }
</style>

<!-- Fatwa Description Container -->
<div class="container py-5 pt-5" style="padding-top: 15rem;">
    <div class="row">
        <!-- Main Fatwa Content -->
        <div class="col-lg-8">
            <!-- Fatwa Header -->
            <div class="fatwa-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> ہوم</a></li>
                        <?php if(isset($categoryHierarchy['main'])): ?>
                            <li class="breadcrumb-item"><a href="<?= $categoryHierarchy['main']['cat_url'] ?>">
                                <?= $categoryHierarchy['main']['catname'] ?>
                            </a></li>
                            
                            <?php if(isset($categoryHierarchy['sub'])): ?>
                                <?php foreach($categoryHierarchy['sub'] as $subCat): ?>
                                    <li class="breadcrumb-item"><a href="<?= $subCat['cat_url'] ?>">
                                        <?= $subCat['catname'] ?>
                                    </a></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                        <li class="breadcrumb-item active" aria-current="page">موجودہ فتوٰی</li>
                    </ol>
                </nav>

                <h1 class="h2 fw-bold"><?= htmlspecialchars($fatwa['page_title']) ?></h1>

                <!-- Fatwa Number -->
                <div class="mt-3">
                    <span class="badge bg-primary fs-6">
                        <i class="fas fa-hashtag me-1"></i> فتویٰ نمبر: 
                        <?= isset($fatwa['attributes'][27]['sections']['Main']['attributes'][366]['current_value']) 
                            ? $fatwa['attributes'][27]['sections']['Main']['attributes'][366]['current_value'] 
                            : 'N/A' ?>
                    </span>
                </div>
                
                <div class="d-flex align-items-center text-muted mt-3">
                    <span class="me-4"><i class="far fa-calendar-alt me-2"></i> <?= $createdDate ?></span>
                    <span><i class="far fa-eye me-2"></i> <?= $fatwa['views'] ?> مشاہدات</span>
                </div>

                <!-- Download & View Buttons -->
                <?php 
                $files = return_single_row("SELECT * FROM page_files 
                    WHERE isactive = 1 
                    AND soft_delete = 0 
                    AND pid = ".$content['pid']);

                if (!empty($files) && !empty($files['f_name'])) {
                    $file_link = ABSOLUTE_FILEPATH . $files['f_name'];
                ?>
                    <div class="mt-4">
                        <a href="<?= htmlspecialchars($file_link) ?>" class="btn btn-outline-success me-2" download>
                            <i class="fas fa-download me-2"></i>ڈاؤن لوڈ کریں
                        </a>
                        <a href="<?= htmlspecialchars($file_link) ?>" target="_blank" class="btn btn-outline-primary">
                            <i class="fas fa-eye me-2"></i>آن لائن دیکھیں
                        </a>
                    </div>
                <?php } else { ?>
                    <div class='alert alert-warning mt-4'>اس فتوی کی کوئی فائل موجود نہیں ہے۔</div>
                <?php } ?>
            </div>

            <!-- Fatwa Content -->
            <div class="fatwa-content">
                <!-- Question Section -->
                <div class="fatwa-question">
                    <h3 class="text-primary mb-3"><i class="fas fa-question-circle me-2"></i>سوال</h3>
                    <?= isset($fatwa['attributes'][27]['sections']['Main']['attributes'][367]['current_value']) 
                        ? $fatwa['attributes'][27]['sections']['Main']['attributes'][367]['current_value'] 
                        : $fatwa['page_title'] ?>
                </div>

                <!-- Answer Section -->
                <div class="fatwa-answer">
                    <h3 class="text-primary mb-4"><i class="fas fa-gavel me-2"></i>جواب</h3>
                    <?= $fatwa['page_desc'] ?>
                </div>

                <!-- Share Buttons -->
                <div class="mt-5">
                    <h5 class="mb-3"><i class="fas fa-share-alt me-2"></i>فتویٰ شیئر کریں:</h5>
                    <a href="#" class="btn btn-outline-primary me-2"><i class="fab fa-facebook-f me-2"></i>فیس بک</a>
                    <a href="#" class="btn btn-outline-info me-2"><i class="fab fa-twitter me-2"></i>ٹویٹر</a>
                    <a href="#" class="btn btn-outline-success me-2"><i class="fab fa-whatsapp me-2"></i>واٹس ایپ</a>
                    <a href="#" class="btn btn-outline-danger"><i class="fas fa-envelope me-2"></i>ای میل</a>
                </div>

                <!-- Related Fatawa -->
                <?php 
                $relatedFatawa = return_multiple_rows("SELECT p.* FROM pages p
                    INNER JOIN page_category pc ON p.pid = pc.page_id
                    WHERE pc.cat_id IN (
                        SELECT cat_id FROM page_category 
                        WHERE page_id = ".$fatwa['pid']."
                    )
                    AND p.pid != ".$fatwa['pid']."
                    AND p.isactive = 1
                    GROUP BY p.pid
                    ORDER BY p.views DESC
                    LIMIT 3");
                ?>
                
                <?php if(!empty($relatedFatawa)): ?>
                    <div class="mt-5">
                        <h4 class="mb-4"><i class="fas fa-link me-2"></i>متعلقہ فتاویٰ</h4>
                        
                        <?php foreach($relatedFatawa as $related): ?>
                            <div class="related-fatwa">
                                <h5><a href="<?= $related['page_url'] ?>"><?= htmlspecialchars($related['page_title']) ?></a></h5>
                                <p class="text-muted"><?= substr(strip_tags($related['page_desc']), 0, 100) ?>...</p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4 fatwa-sidebar">
            <!-- Ask Question -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="card-title mb-4"><i class="fas fa-question-circle me-2"></i>نیا سوال پوچھیں</h4>
                    <p class="card-text">اپنے شرعی مسائل کے لیے جامعہ مدنیہ کے مفتیان کرام سے رجوع کریں۔</p>
                    <a href="#" class="btn btn-primary w-100">سوال جمع کروائیں</a>
                </div>
            </div>

            <!-- Popular Fatawa -->
            <?php 
            $popularFatawa = return_multiple_rows("SELECT p.* FROM pages p
                INNER JOIN page_category pc ON p.pid = pc.page_id
                WHERE pc.cat_id IN (
                    SELECT catid FROM category 
                    WHERE ParentCategory = 0 
                    AND isactive = 1
                )
                AND p.isactive = 1
                GROUP BY p.pid
                ORDER BY p.views DESC
                LIMIT 5");
            ?>
            
            <?php if(!empty($popularFatawa)): ?>
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h4 class="card-title mb-4"><i class="fas fa-fire me-2"></i>مقبول فتاویٰ</h4>
                        <div class="list-group list-group-flush">
                            <?php foreach($popularFatawa as $popular): ?>
                                <a href="<?= $popular['page_url'] ?>" class="list-group-item list-group-item-action">
                                    <?= htmlspecialchars($popular['page_title']) ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Categories -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-4"><i class="fas fa-tags me-2"></i>زمرہ جات</h4>
                    <div class="d-flex flex-wrap">
                        <?php foreach($allActiveCategories as $cat): ?>
                            <?php if($cat['ParentCategory'] == 154): ?>
                                <a href="<?= $cat['cat_url'] ?>" class="btn btn-sm btn-outline-primary me-2 mb-2">
                                    <?= htmlspecialchars($cat['catname']) ?>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>