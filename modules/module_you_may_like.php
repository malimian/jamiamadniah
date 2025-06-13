<?php
// modules/module_you_may_also_like.php
function getArticleImage($article) {
    if (!empty($article['featured_image'])) {
        if (filter_var($article['featured_image'], FILTER_VALIDATE_URL)) {
            return $article['featured_image'];
        } elseif (file_exists(ABSOLUTE_IMAGEPATH . $article['featured_image'])) {
            return ABSOLUTE_IMAGEPATH . $article['featured_image'];
        }
    }
    return ABSOLUTE_IMAGEPATH . 'default-article-image.jpg';
}

// Get current page data from POST
$current_title = $_POST['page_title'] ?? '';
$current_catid = $_POST['catid'] ?? 0;
$current_pid = $_POST['pid'] ?? 0;

// Get similar articles
$keywords = array_unique(array_filter(explode(' ', preg_replace('/[^a-zA-Z0-9\s]/', '', $current_title))));
$title_conditions = [];
foreach ($keywords as $keyword) {
    if (strlen($keyword) > 3) {
        $title_conditions[] = "p.page_title LIKE '%" . addslashes($keyword) . "%'";
    }
}
$title_similarity = !empty($title_conditions) ? implode(' OR ', $title_conditions) : '1=1';

$similar_articles = return_multiple_rows("
    SELECT p.*, c.catname, c.cat_url,
           (
               (CASE WHEN p.catid = " . (int)$current_catid . " THEN 2 ELSE 0 END) +
               (CASE WHEN $title_similarity THEN 1 ELSE 0 END) +
               (p.views * 0.001)
           ) AS relevance_score
    FROM pages p
    LEFT JOIN category c ON p.catid = c.catid
    WHERE p.template_id = 7 
      AND p.isactive = 1 
      AND p.soft_delete = 0 
      AND p.pid != " . (int)$current_pid . "
    HAVING relevance_score > 0
    ORDER BY relevance_score DESC, p.createdon DESC
    LIMIT 8
");

if (empty($similar_articles)) {
    $similar_articles = return_multiple_rows("
        SELECT p.*, c.catname, c.cat_url 
        FROM pages p
        LEFT JOIN category c ON p.catid = c.catid
        WHERE p.template_id = 7 
          AND p.isactive = 1 
          AND p.soft_delete = 0
          AND p.pid != " . (int)$current_pid . "
        ORDER BY p.views DESC
        LIMIT 8
    ");
}
?>

<div class="bg-light rounded my-4 p-4">
    <h4 class="mb-4">You May Also Like</h4>
    <div class="row g-4">
        <?php foreach ($similar_articles as $article): ?>
            <div class="col-lg-6">
                <div class="d-flex align-items-center p-3 bg-white rounded h-100">
                    <div class="flex-shrink-0 me-3" style="width: 120px;">
                        <img src="<?= getArticleImage($article) ?>" 
                             class="img-fluid rounded" 
                             alt="<?= htmlspecialchars($article['page_title']) ?>"
                             style="width: 120px; height: 90px; object-fit: cover;">
                    </div>
                    <div class="flex-grow-1">
                        <a href="<?= BASE_URL . $article['page_url'] ?>" 
                           class="h5 mb-2 d-block text-dark link-hover">
                           <?= mb_strimwidth(htmlspecialchars($article['page_title']), 0, 60, '...') ?>
                        </a>
                        <div class="d-flex flex-wrap small text-muted">
                            <span class="me-3"><i class="fas fa-tag me-1"></i> <?= htmlspecialchars($article['catname']) ?></span>
                            <span class="me-3"><i class="far fa-eye me-1"></i> <?= $article['views'] ?> views</span>
                            <span><i class="far fa-clock me-1"></i> <?= timeAgo($article['createdon']) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>