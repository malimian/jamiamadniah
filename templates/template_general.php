<style>
.article-content {
    text-align: center;
    font-size: 22px;
    font-weight: 900;
    line-height: 1.6;
    margin-bottom: 1rem;
    padding: 20px;
}
@media (max-width: 768px) {
    .article-content p {
        font-size: 18px;
        padding: 10px;
    }
}

.background-img {
    background: url(images/bahir%20wali.jpeg) no-repeat center center;
    background-size: cover;
    position: relative;
}

.main-box {
    background: url(images/andar-wali.jpeg) no-repeat center center;
    background-size: cover;
    position: relative;
    margin: 9rem 0 4.5rem 0;
    border: 5px solid var(--bs-primary);
    border-radius: 0.625rem;
    padding: 59px 2rem !important;
}


.img-large {
    background: url(images/andar-wali.jpeg) no-repeat center center;
    background-size: cover;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-top: 0.8rem;
}

.img-large img.img-fluid {
    width: 22%;
}

p.par-1 {
    font-size: 28px;
    font-weight: bolder;
    text-align: center;
    margin: 0 0 14px 0;
}
@media (max-width: 768px) {
    p.par-1 {
        font-size: 17px;
    }
}

.hero-header{
    background: url(<?= !empty($content['featured_image']) ? BASE_URL . ABSOLUTE_IMAGEPATH . $content['featured_image'] : 'img/hero.jpg'; ?>), center center no-repeat !important;
        background-size: cover !important;
}
</style>

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

<div class="Main">
    <div class="background-img position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="main-box">
                        <div class="article-content">
                            <?= replace_sysvari(remove_non_utf($content['page_desc']), getcwd()."/") ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

