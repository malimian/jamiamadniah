<?php 
$attribute = $content['attributes'];
// print_r($attribute);die;
?>

<?php
if(!function_exists("header_t")) {
    function header_t(){
        return '
            <link href="css/templates/template_person_spotlight2.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

<?php
if(!function_exists("script_t")) {
    function script_t(){
        return '
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        ';
    }
}
?>

<!-- Section 1: Hero Banner with Carousel -->
<section id="hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <?php for ($i = 0; $i < $attribute[15]['sections']['carousel section']['sets_count']; $i++): ?>
            <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="<?= $i ?>" class="<?= $i === 0 ? 'active' : '' ?>"></button>
        <?php endfor; ?>
    </div>
    <div class="carousel-inner">
        <?php 
        $leadTexts = $attribute[15]['sections']['carousel section']['attributes'][320]['values'];
        $images = $attribute[15]['sections']['carousel section']['attributes'][321]['values'];
        $captions = $attribute[15]['sections']['carousel section']['attributes'][322]['values'];
        
        for ($i = 0; $i < $attribute[15]['sections']['carousel section']['sets_count']; $i++): 
            $leadText = $leadTexts[$i] ?? '';
            $image = $images[$i] ?? '';
            $caption = $captions[$i] ?? '';
        ?>
            <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
                <img src="<?= ABSOLUTE_IMAGEPATH . $image ?>" class="d-block w-100" alt="<?= htmlspecialchars($leadText) ?>">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="display-3 fw-bold"><?= htmlspecialchars($leadText) ?></h1>
                    <p class="lead"><?= htmlspecialchars($caption) ?></p>
                </div>
            </div>
        <?php endfor; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#hero-carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#hero-carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</section>

<div class="container mb-5">
    <!-- Section 2: Profile Snapshot -->
    <section class="container my-5">
        <div class="row align-items-center">
            <!-- Left Column - Profile Image -->
            <div class="col-md-4 text-center mb-4 mb-md-0">
                <img src="<?= ABSOLUTE_IMAGEPATH.$attribute[16]['sections']['profile section']['attributes'][241]['current_value'] ?>" 
                     alt="Professional Headshot of Jacob Oroks" 
                     class="img-fluid rounded-circle shadow"
                     style="width: 300px; height: 300px; object-fit: cover;">
            </div>
            
            <!-- Right Column - Profile Details -->
            <div class="col-md-8">
                <div class="profile-card p-4 shadow-sm rounded-4">
                    <h2 class="mb-4 text-gradient"><?= $attribute[16]['tab_name'] ?></h2>
                    
                    <div class="row g-4">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <div class="d-flex align-items-start mb-4">
                                <div class="me-3 text-primary">
                                    <i class="bi bi-person-badge fs-3"></i>
                                </div>
                                <div>
                                    <h3 class="h5 mb-1">Name & Titles</h3>
                                    <p class="mb-0 fw-bold fs-5"><?= $attribute[16]['sections']['profile section']['attributes'][242]['current_value'] ?></p>
                                    <?php 
                                    $titles = explode(',', $attribute[16]['sections']['profile section']['attributes'][243]['current_value']);
                                    $badgeColors = ['primary', 'success', 'info'];
                                    foreach ($titles as $i => $title): ?>
                                        <span class="badge bg-<?= $badgeColors[$i] ?> bg-opacity-10 text-<?= $badgeColors[$i] ?> mt-1"><?= trim($title) ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-start">
                                <div class="me-3 text-primary">
                                    <i class="bi bi-geo-alt fs-3"></i>
                                </div>
                                <div>
                                    <h3 class="h5 mb-1">Location</h3>
                                    <p class="mb-0">
                                        <span class="d-block"><?= $attribute[16]['sections']['profile section']['attributes'][244]['current_value'] ?></span>
                                        <small class="text-muted"><?= $attribute[16]['sections']['profile section']['attributes'][318]['current_value'] ?></small>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class="d-flex align-items-start mb-4">
                                <div class="me-3 text-primary">
                                    <i class="bi bi-envelope-at fs-3"></i>
                                </div>
                                <div>
                                    <h3 class="h5 mb-1">Contact</h3>
                                    <p class="mb-1">
                                        <a href="mailto:<?= $attribute[16]['sections']['profile section']['attributes'][245]['current_value'] ?>" class="text-decoration-none">
                                            <?= $attribute[16]['sections']['profile section']['attributes'][245]['current_value'] ?>
                                        </a>
                                    </p>
                                    <p class="mb-0">
                                        <a href="tel:<?= str_replace([' ', '(', ')', '-', '+'], '', $attribute[16]['sections']['profile section']['attributes'][246]['current_value']) ?>" class="text-decoration-none">
                                            <?= $attribute[16]['sections']['profile section']['attributes'][246]['current_value'] ?>
                                        </a>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="d-grid">
                                <a href="#contact" class="btn btn-primary btn-lg rounded-pill px-4 shadow-sm">
                                    <i class="bi bi-calendar-check me-2"></i> Book a Spotlight Session
                                </a>
                                <div class="d-flex justify-content-center mt-2">
                                    <small class="text-muted">
                                        <i class="bi bi-clock-history me-1"></i> Typically replies within 24 hours
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Links -->
                    <div class="mt-4 pt-3 border-top">
                        <h4 class="h6 text-uppercase text-muted mb-3">Connect With Me</h4>
                        <div class="d-flex gap-3">
                            <a href="<?= $attribute[26]['sections']['SocialMedia']['attributes'][311]['current_value'] ?>" class="btn btn-outline-primary p-2" target="_blank">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="#" class="btn btn-outline-primary p-2">
                                <i class="bi bi-twitter"></i>
                            </a>
                            <a href="#" class="btn btn-outline-primary p-2">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="#" class="btn btn-outline-primary p-2">
                                <i class="bi bi-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    <!-- Section 3: Personal Journey -->
    <section class="mb-5 py-4">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold text-gradient mb-3"><?= strip_tags($attribute[17]['sections']['Main']['attributes'][293]['current_value']) ?></h2>
                <div class="section-divider mx-auto"></div>
                <p class="lead text-muted"><?= strip_tags($attribute[17]['sections']['Main']['attributes'][294]['current_value']) ?></p>
            </div>

            <div class="row g-4">
                <!-- Left Column -->
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0 rounded-4 h-100 hover-effect">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-start mb-3">
                                <div class="icon-box bg-primary bg-opacity-10 text-primary me-3">
                                    <i class="bi bi-person-vcard fs-3"></i>
                                </div>
                                <div>
                                    <h3 class="h4 mb-2">Professional Identity</h3>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            <img src="<?= ABSOLUTE_IMAGEPATH.$attribute[16]['sections']['profile section']['attributes'][241]['current_value'] ?>" 
                                                 class="rounded-circle shadow-sm" 
                                                 width="60" 
                                                 alt="Jacob Oroks">
                                        </div>
                                        <div>
                                            <h4 class="h5 mb-0"><?= $attribute[16]['sections']['profile section']['attributes'][242]['current_value'] ?></h4>
                                            <small class="text-muted">Full Professional Name</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Middle Column -->
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0 rounded-4 h-100 hover-effect">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-start mb-3">
                                <div class="icon-box bg-success bg-opacity-10 text-success me-3">
                                    <i class="bi bi-journal-bookmark fs-3"></i>
                                </div>
                                <div>
                                    <h3 class="h4 mb-2"><?= $attribute[17]['sections']['background section']['attributes'][247]['current_value'] ?></h3>
                                    <p class="mb-0"><?= strip_tags($attribute[17]['sections']['background section']['attributes'][248]['current_value']) ?></p>
                                    <div class="mt-3">
                                        <?php 
                                        $badges = ['Faith', 'Ministry', 'Community'];
                                        foreach ($badges as $badge): ?>
                                            <span class="badge bg-success bg-opacity-10 text-success me-2"><?= $badge ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Full Width Bottom Card -->
                <div class="col-12">
                    <div class="card shadow-sm border-0 rounded-4 hover-effect bg-light">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-start">
                                <div class="icon-box bg-info bg-opacity-10 text-info me-3">
                                    <i class="bi bi-people fs-3"></i>
                                </div>
                                <div>
                                    <h3 class="h4 mb-2"><?= $attribute[17]['sections']['Community Section']['attributes'][313]['values'][0] ?></h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="mb-3"><?= strip_tags($attribute[17]['sections']['Community Section']['attributes'][314]['values'][0]) ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="list-unstyled">
                                                <?php 
                                                $listItems = explode('</li>', $attribute[17]['sections']['Community Section']['attributes'][314]['values'][0]);
                                                foreach ($listItems as $item):
                                                    if (trim(strip_tags($item))): ?>
                                                        <li class="mb-2"><i class="bi bi-check-circle-fill text-info me-2"></i><?= strip_tags($item) ?></li>
                                                    <?php endif;
                                                endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <a href="#community-work" class="btn btn-outline-info rounded-pill">
                                            <i class="bi bi-arrow-right-circle me-2"></i> View Community Projects
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    <!-- Section 4: Education & Certifications -->
    <section class="py-6 mb-6 bg-light position-relative overflow-hidden">
        <div class="position-absolute top-0 start-0 w-100 h-100">
            <div class="position-absolute top-0 end-0 bg-primary bg-opacity-5 rounded-circle" style="width: 300px; height: 300px; transform: translate(50%, -50%);"></div>
            <div class="position-absolute bottom-0 start-0 bg-success bg-opacity-5 rounded-circle" style="width: 400px; height: 400px; transform: translate(-50%, 50%);"></div>
        </div>

        <div class="container position-relative">
            <!-- Section Header -->
            <div class="text-center mb-6">
                <span class="badge bg-primary bg-opacity-10 text-primary mb-3 rounded-pill px-3 py-2">
                    <i class="bi bi-mortarboard me-2"></i> Academic Journey
                </span>
                <h2 class="display-4 fw-bold mb-3 text-gradient"><?= strip_tags($attribute[18]['sections']['Main']['attributes'][295]['current_value']) ?></h2>
                <p class="lead text-muted mx-auto" style="max-width: 600px;">
                    <?= strip_tags($attribute[18]['sections']['Main']['attributes'][296]['current_value']) ?>
                </p>
            </div>

            <div class="row g-4">
                <!-- Education Timeline -->
                <div class="col-lg-5">
                    <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden">
                        <div class="card-header bg-white py-4 border-0">
                            <h3 class="h4 mb-0 d-flex align-items-center">
                                <span class="bg-primary bg-opacity-10 text-primary p-3 rounded-3 me-3">
                                    <i class="bi bi-mortarboard fs-2"></i>
                                </span>
                                <span>Academic Background</span>
                            </h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="timeline-steps">
                                <?php foreach ($attribute[18]['sections']['education section']['attributes'] as $attrId => $attr): ?>
                                    <?php if ($attrId == 280): // Title ?>
                                        <?php foreach ($attr['values'] as $index => $value): ?>
                                            <div class="timeline-step">
                                                <div class="timeline-content">
                                                    <div class="inner-circle bg-primary text-white">
                                                        <i class="bi bi-book"></i>
                                                    </div>
                                                    <h4 class="h5 mb-1"><?= $value ?></h4>
                                                    <p class="mb-1 text-primary fw-bold"><?= $attribute[18]['sections']['education section']['attributes'][319]['values'][$index] ?? '' ?></p>
                                                    <p class="small text-muted mb-2"><?= $attribute[18]['sections']['education section']['attributes'][281]['values'][$index] ?? '' ?></p>
                                                    <div class="d-flex gap-2">
                                                        <span class="badge bg-success bg-opacity-10 text-success"><?= $attribute[18]['sections']['education section']['attributes'][282]['values'][$index] ?? '' ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Certifications Showcase -->
                <div class="col-lg-7">
                    <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden">
                        <div class="card-header bg-white py-4 border-0">
                            <h3 class="h4 mb-0 d-flex align-items-center">
                                <span class="bg-warning bg-opacity-10 text-warning p-3 rounded-3 me-3">
                                    <i class="bi bi-award fs-2"></i>
                                </span>
                                <span>Professional Certifications</span>
                            </h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-4">
                                <?php foreach ($attribute[18]['sections']['Certifications section']['attributes'] as $attrId => $attr): ?>
                                    <?php if ($attrId == 297): // Title ?>
                                        <?php foreach ($attr['values'] as $index => $value): ?>
                                            <div class="col-md-6">
                                                <div class="certification-card bg-white rounded-3 p-4 h-100 shadow-sm border-start border-4 border-primary">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <img src="<?= ABSOLUTE_IMAGEPATH . ($attribute[18]['sections']['Certifications section']['attributes'][299]['values'][$index] ?? '') ?>" 
                                                             alt="<?= $value ?>" 
                                                             class="img-fluid rounded-3 me-3" 
                                                             width="60">
                                                        <div>
                                                            <h4 class="h6 mb-0"><?= $value ?></h4>
                                                            <small class="text-muted"><?= $attribute[18]['sections']['Certifications section']['attributes'][298]['values'][$index] ?? '' ?></small>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="badge bg-primary bg-opacity-10 text-primary"><?= $attribute[18]['sections']['Certifications section']['attributes'][300]['values'][$index] ?? '' ?></span>
                                                        <a href="<?= $attribute[18]['sections']['Certifications section']['attributes'][301]['values'][$index] ?? '#' ?>" class="btn btn-sm btn-outline-primary rounded-pill" target="_blank">Verify</a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="section-divider"></div>

    <!-- Section 5: Faith Led Leadership -->
    <?php if (!empty($attribute[19])): ?>
        <section class="container my-5">
            <h2 class="text-center mb-4"><?= $attribute[19]['sections']['Main']['attributes'][303]['current_value'] ?></h2>
            <p class="lead text-center mb-5"><?= $attribute[19]['sections']['Main']['attributes'][304]['current_value'] ?></p>

            <div class="row g-4">
                <?php 
                $leadershipSection = $attribute[19]['sections']['leadership section'];
                $titles = $leadershipSection['attributes'][255]['values'];
                $icons = $leadershipSection['attributes'][256]['values'];
                $descriptions = $leadershipSection['attributes'][257]['values'];
                for ($i = 0; $i < $leadershipSection['sets_count']; $i++): 
                ?>
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body text-center">
                                <i class="<?= $icons[$i] ?? 'fas fa-star' ?>"></i>
                                <h5 class="card-title mt-3"><?= htmlspecialchars($titles[$i] ?? '') ?></h5>
                                <div class="card-text"><?= $descriptions[$i] ?? '' ?></div>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </section>
        <?php endif; ?>


    <div class="section-divider"></div>

    <!-- Section 6: Cultural Stewardship -->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class="col-md-8 text-center">
                        <h2 class="display-5 fw-bold text-primary mb-3"><?= $attribute[20]['tab_name'] ?></h2>
                        <p class="lead text-muted">
                            <?= strip_tags($attribute[20]['sections']['Main']['attributes'][306]['current_value']) ?>
                        </p>
                    </div>
                </div>
               <div class="row g-4">
                <?php
                $community = $attribute[20]['sections']['community section']['attributes'];

                $icons = $community[258]['values'];
                $titles = $community[259]['values'];
                $descriptions = $community[260]['values'];
                $videos = $community[307]['values'];

                for ($i = 0; $i < count($titles); $i++): ?>
                    <div class="col-lg-6">
                        <div class="card shadow-sm h-100 border-0">
                            <div class="card-body p-4">
                                <div class="mb-3 text-center">
                                    <i class="<?= $icons[$i] ?? '' ?>"></i>
                                </div>
                                <h3 class="h5 fw-semibold text-secondary mb-2"><?= $titles[$i] ?? '' ?></h3>
                                <ul class="list-unstyled text-muted">
                                    <?php 
                                    $listItems = explode('</li>', $descriptions[$i] ?? '');
                                    foreach ($listItems as $item):
                                        if (trim(strip_tags($item))): ?>
                                            <li class="mb-2">
                                                <i class="fas fa-check-circle text-success me-2"></i><?= strip_tags($item) ?>
                                            </li>
                                        <?php endif;
                                    endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card shadow-sm h-100 border-0">
                            <div class="card-body p-4">
                                <div class="ratio ratio-16x9">
                                    <iframe src="https://www.youtube.com/embed/<?= $videos[$i] ?? '' ?>" 
                                            title="<?= $titles[$i] ?? 'Video' ?>" 
                                            allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
                </div>

            </div>
        </section>


    <div class="section-divider"></div>

<!-- Section 7: Professional Journey & Achievements -->
<section class="mb-5">
    <h2 class="mb-4">Professional Journey & Achievements</h2>
    <div class="timeline-steps">
        <?php
        $expAttrs = $attribute[21]['sections']['experience section']['attributes'];
        $titles = $expAttrs[261]['values'];
        $years = $expAttrs[262]['values'];
        $descriptions = $expAttrs[263]['values'];

        for ($i = 0; $i < count($titles); $i++): ?>
            <div class="timeline-step">
                <div class="timeline-content">
                    <div class="inner-circle bg-primary text-white">
                        <i class="bi bi-briefcase"></i>
                    </div>
                    <h3><?= $years[$i] ?? '' ?></h3>
                    <h4><?= $titles[$i] ?? '' ?></h4>
                    <p><?= strip_tags($descriptions[$i] ?? '') ?></p>
                </div>
            </div>
        <?php endfor; ?>
    </div>
</section>

    <div class="section-divider"></div>

 <!-- Section 8: Expertise & Unique Value Proposition -->
<section id="expertise" class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title"><?= $attribute[22]['sections']['Main']['attributes'][323]['current_value'] ?></h2>
        
        <!-- Main description content -->
        <?= $attribute[22]['sections']['Main']['attributes'][324]['current_value'] ?>
        
        <!-- Leadership Philosophy section -->
        <div class="row mt-5">
            <div class="col-lg-8 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="h4 mb-3"><?= $attribute[22]['sections']['expertise section']['attributes'][264]['current_value'] ?></h3>
                        <?= $attribute[22]['sections']['expertise section']['attributes'][266]['current_value'] ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

   <!-- Section 9: Impact Stories & Case Studies -->
        <section id="impact" class="py-5">
            <div class="container">
                <h2 class="section-title"><?= $attribute[23]['tab_name'] ?></h2>
                
                <div class="row g-4">
                    <?php
                    // Since there are no actual case studies in the array, we'll use the template
                    $template = $attribute[23]['sections']['impact section']['attributes'][285]['current_value'];
                    echo str_replace(
                        ['[CASE_TITLE]', '[CHALLENGE_TEXT]', '[APPROACH_TEXT]', '[RESULTS_LIST]', '[TESTIMONIAL_TEXT]', '[TESTIMONIAL_AUTHOR]'],
                        [
                            'Sample Case Study',
                            'This is where the challenge description would go',
                            'This is where the approach description would go',
                            '<li>Result 1</li><li>Result 2</li><li>Result 3</li>',
                            'This is a sample testimonial about the impact',
                            'Client Name'
                        ],
                        $template
                    );
                    ?>
                </div>
            </div>
        </section>

<!-- Section 10: Thought Leadership & Publications -->
<section id="thought-leadership" class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title"><?= $attribute[24]['tab_name'] ?></h2>
        
        <div class="row">
            <?php
            $pubTemplate = $attribute[24]['sections']['publications section']['attributes'][287]['current_value'];
            echo str_replace(
                ['[PUB_ICON]', '[PUB_TYPE]', '[PUB_TITLE]', '[PUB_SOURCE]', '[PUB_YEAR]', '[PUB_LINK]'],
                [
                    'fas fa-newspaper',
                    'Article',
                    $attribute[24]['sections']['publications section']['attributes'][270]['current_value'],
                    'Publication Source',
                    date('Y'),
                    '#'
                ],
                $pubTemplate
            );
            ?>
        </div>
    </div>
</section>

    <!-- Section 11: Media Assets & Downloads -->
    <section id="media" class="py-5">
        <div class="container">
            <h2 class="section-title"><?= $attribute[25]['tab_name'] ?></h2>
            
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <h3 class="h4 mb-3">Photo Gallery</h3>
                    <div class="row g-2">
                        <?php
                        // Assuming you have images in attribute 17
                        if (isset($attribute[17]['sections']['background section']['attributes'][249]['values'])) {
                            foreach ($attribute[17]['sections']['background section']['attributes'][249]['values'] as $index => $image) {
                                $mediaTemplate = $attribute[25]['sections']['media section']['attributes'][289]['current_value'];
                                echo str_replace(
                                    ['[MEDIA_IMAGE]', '[MEDIA_TITLE]'],
                                    [ABSOLUTE_IMAGEPATH.$image['value'], 'Image ' . ($index + 1)],
                                    $mediaTemplate
                                );
                            }
                        }
                        ?>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <h3 class="h4 mb-3">Video Clips</h3>
                    <div class="ratio ratio-16x9 mb-3">
                        <iframe src="https://www.youtube.com/embed/SAMPLE_VIDEO_ID" title="Sample video" allowfullscreen></iframe>
                    </div>
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            TEDx Talk: Faith in the Algorithm
                            <span class="badge bg-primary rounded-pill">12:34</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            CNBC Interview: Faith-Based Entrepreneurship
                            <span class="badge bg-primary rounded-pill">8:45</span>
                        </a>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <h3 class="h4 mb-3">Downloads</h3>
                    <?php
                    $downloadTemplate = $attribute[25]['sections']['media section']['attributes'][291]['current_value'];
                    echo str_replace(
                        ['[FILE_ICON]', '[FILE_COLOR]', '[FILE_TITLE]', '[FILE_FORMAT]', '[FILE_SIZE]', '[FILE_URL]'],
                        [
                            'fas fa-file-pdf',
                            'danger',
                            'Sample Document',
                            'PDF',
                            '2.4MB',
                            '#'
                        ],
                        $downloadTemplate
                    );
                    ?>
                </div>
            </div>
        </div>
    </section>

</div>

<!-- Section 12: Digital Presence & Call to Action -->
<section id="connect" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold"><?= $attribute[26]['tab_name'] ?></h2>
            <p class="lead text-muted">Let's work together to create meaningful impact</p>
        </div>

        <div class="row g-4">
            <!-- Digital Presence Column -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h3 class="h4 mb-4 pb-2 border-bottom"><i class="fas fa-globe text-primary me-2"></i> Digital Presence</h3>
                        
                        <!-- Website -->
                        <div class="d-flex align-items-start mb-4">
                            <div class="flex-shrink-0 bg-primary bg-opacity-10 p-2 rounded">
                                <i class="fas fa-link text-primary fs-5"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="h6 mb-1">Website & Blog</h4>
                                <a href="<?= $attribute[26]['sections']['contact section']['attributes'][276]['current_value'] ?>" class="text-decoration-none" target="_blank">jacoboroks.com</a>
                            </div>
                        </div>
                        
                        <!-- Social Media -->
                        <div class="d-flex align-items-start mb-4">
                            <div class="flex-shrink-0 bg-primary bg-opacity-10 p-2 rounded">
                                <i class="fas fa-hashtag text-primary fs-5"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="h6 mb-2">Social Media</h4>
                                <div class="d-flex gap-3">
                                    <?php if ($attribute[26]['sections']['SocialMedia']['attributes'][311]['current_value']): ?>
                                    <a href="<?= $attribute[26]['sections']['SocialMedia']['attributes'][311]['current_value'] ?>" class="btn btn-sm btn-outline-primary rounded-pill">
                                        <i class="fab fa-linkedin-in me-1"></i> LinkedIn
                                    </a>
                                    <?php endif; ?>
                                    <?php if ($attribute[26]['sections']['SocialMedia']['attributes'][310]['current_value']): ?>
                                    <a href="<?= $attribute[26]['sections']['SocialMedia']['attributes'][310]['current_value'] ?>" class="btn btn-sm btn-outline-info rounded-pill">
                                        <i class="fab fa-twitter me-1"></i> Twitter
                                    </a>
                                    <?php endif; ?>
                                    <?php if ($attribute[26]['sections']['SocialMedia']['attributes'][312]['current_value']): ?>
                                    <a href="<?= $attribute[26]['sections']['SocialMedia']['attributes'][312]['current_value'] ?>" class="btn btn-sm btn-outline-danger rounded-pill">
                                        <i class="fab fa-instagram me-1"></i> Instagram
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Call to Action Column -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h3 class="h4 mb-4 pb-2 border-bottom"><i class="fas fa-handshake-angle text-primary me-2"></i> Let's Work Together</h3>
                        
                        <div class="row g-3">
                            <!-- Entrepreneurs/Consultants -->
                            <div class="col-md-6">
                                <div class="card bg-primary bg-opacity-10 border-primary border-opacity-25 h-100">
                                    <div class="card-body text-center p-3">
                                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle d-inline-block mb-3">
                                            <i class="fas fa-lightbulb text-primary fs-4"></i>
                                        </div>
                                        <h4 class="h6 mb-2">Entrepreneurs/Consultants</h4>
                                        <p class="small mb-3">Schedule a strategy session to explore synergies</p>
                                        <a href="#" class="btn btn-primary btn-sm stretched-link">
                                            Book Session <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Finance Leaders -->
                            <div class="col-md-6">
                                <div class="card bg-success bg-opacity-10 border-success border-opacity-25 h-100">
                                    <div class="card-body text-center p-3">
                                        <div class="bg-success bg-opacity-10 p-3 rounded-circle d-inline-block mb-3">
                                            <i class="fas fa-chart-line text-success fs-4"></i>
                                        </div>
                                        <h4 class="h6 mb-2">Finance Leaders</h4>
                                        <p class="small mb-3">Request a comprehensive financial review</p>
                                        <a href="#" class="btn btn-success btn-sm stretched-link">
                                            Request Review <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>