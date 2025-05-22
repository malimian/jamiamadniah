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
        <?php foreach ($attribute[15]['sections']['carousel section']['sets'] as $index => $slide): ?>
            <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>"></button>
        <?php endforeach; ?>
    </div>
    <div class="carousel-inner">
        <?php
        
        // print_r($attribute[15]['sections']['carousel section']);

         foreach ($attribute[15]['sections']['carousel section']['sets'] as $index => $slide): ?>
            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                <img src="<?= ABSOLUTE_IMAGEPATH.$slide[321]['value'] ?>" class="d-block w-100" alt="<?= $slide[320]['value'] ?> <?= $index + 1 ?>">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="display-3 fw-bold"><?= $slide[320]['value'] ?></h1>
                    <p class="lead"><?= $slide[320]['value'] ?></p>
                </div>
            </div>
        <?php endforeach; ?>
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
                                    <h3 class="h4 mb-2"><?= $attribute[17]['sections']['Community Section']['sets'][0][313]['value'] ?></h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="mb-3"><?= strip_tags($attribute[17]['sections']['Community Section']['sets'][0][314]['value']) ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="list-unstyled">
                                                <?php 
                                                $listItems = explode('</li>', $attribute[17]['sections']['Community Section']['sets'][0][314]['value']);
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
                                <?php foreach ($attribute[18]['sections']['education section']['sets'] as $index => $education): ?>
                                    <div class="timeline-step">
                                        <div class="timeline-content">
                                            <div class="inner-circle bg-primary text-white">
                                                <i class="bi bi-book"></i>
                                            </div>
                                            <h4 class="h5 mb-1"><?= $education[280]['value'] ?></h4>
                                            <p class="mb-1 text-primary fw-bold"><?= $education[319]['value'] ?></p>
                                            <p class="small text-muted mb-2"><?= $education[281]['value'] ?></p>
                                            <div class="d-flex gap-2">
                                                <span class="badge bg-success bg-opacity-10 text-success"><?= $education[282]['value'] ?></span>
                                            </div>
                                        </div>
                                    </div>
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
                                <?php foreach ($attribute[18]['sections']['Certifications section']['sets'] as $index => $cert): ?>
                                    <div class="col-md-6">
                                        <div class="certification-card bg-white rounded-3 p-4 h-100 shadow-sm border-start border-4 border-primary">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="<?= ABSOLUTE_IMAGEPATH.$cert[299]['value'] ?>" 
                                                     alt="<?= $cert[297]['value'] ?>" 
                                                     class="img-fluid rounded-3 me-3" 
                                                     width="60">
                                                <div>
                                                    <h4 class="h6 mb-0"><?= $cert[297]['value'] ?></h4>
                                                    <small class="text-muted"><?= $cert[298]['value'] ?></small>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="badge bg-primary bg-opacity-10 text-primary"><?= $cert[300]['value'] ?></span>
                                                <a href="<?= $cert[301]['value'] ?>" class="btn btn-sm btn-outline-primary rounded-pill" target="_blank">Verify</a>
                                            </div>
                                        </div>
                                    </div>
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
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-8 text-center">
                    <h2 class="display-5 fw-bold text-primary mb-3"><?= $attribute[19]['tab_name'] ?></h2>
                    <p class="lead text-muted"><?= strip_tags($attribute[19]['sections']['Main']['attributes'][304]['current_value']) ?></p>
                </div>
            </div>
            <div class="row g-4">
                <?php foreach ($attribute[19]['sections']['leadership section']['sets'] as $index => $leadership): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card shadow-sm h-100 border-0">
                            <div class="card-body p-4 text-center">
                                <div class="mb-3">
                                    <i class="<?= $leadership[256]['value'] ?>"></i>
                                </div>
                                <h3 class="h5 fw-semibold text-secondary mb-2"><?= $leadership[255]['value'] ?></h3>
                                <p class="text-muted"><?= strip_tags($leadership[257]['value']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    <!-- Section 6: Cultural Stewardship -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-8 text-center">
                    <h2 class="display-5 fw-bold text-primary mb-3"><?= $attribute[20]['tab_name'] ?></h2>
                    <p class="lead text-muted"><?= strip_tags($attribute[20]['sections']['Main']['attributes'][306]['current_value']) ?></p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card shadow-sm h-100 border-0">
                        <div class="card-body p-4">
                            <div class="mb-3 text-center">
                                <i class="<?= $attribute[20]['sections']['community section']['sets'][0][258]['value'] ?>"></i>
                            </div>
                            <h3 class="h5 fw-semibold text-secondary mb-2"><?= $attribute[20]['sections']['community section']['sets'][0][259]['value'] ?></h3>
                            <ul class="list-unstyled text-muted">
                                <?php 
                                $listItems = explode('</li>', $attribute[20]['sections']['community section']['sets'][0][260]['value']);
                                foreach ($listItems as $item):
                                    if (trim(strip_tags($item))): ?>
                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i><?= strip_tags($item) ?></li>
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
                                <iframe src="https://www.youtube.com/embed/<?= $attribute[20]['sections']['community section']['sets'][0][307]['value'] ?>" title="Jacob Oroks Cultural Stewardship" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    <!-- Section 7: Professional Journey & Achievements -->
    <section class="mb-5">
        <h2 class="mb-4">Professional Journey & Achievements</h2>
        <div class="timeline-steps">
            <?php foreach ($attribute[21]['sections']['experience section']['sets'] as $index => $experience): ?>
                <div class="timeline-step">
                    <div class="timeline-content">
                        <div class="inner-circle bg-primary text-white">
                            <i class="bi bi-briefcase"></i>
                        </div>
                        <h3><?= $experience[262]['value'] ?></h3>
                        <h4><?= $experience[261]['value'] ?></h4>
                        <p><?= strip_tags($experience[263]['value']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <div class="section-divider"></div>

    <!-- Section 8: Expertise & Unique Value Proposition -->
    <section id="expertise" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title"><?= $attribute[22]['tab_name'] ?></h2>
            
            <div class="row g-4 mb-5">
                <?php foreach ($attribute[22]['sections']['expertise section']['sets'] as $index => $expertise): ?>
                    <div class="col-md-4">
                        <div class="card value-card shadow-sm h-100">
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <i class="<?= $expertise[265]['value'] ?> fa-3x text-primary"></i>
                                </div>
                                <h3 class="h4 text-center"><?= $expertise[264]['value'] ?></h3>
                                <p class="text-muted"><?= strip_tags($expertise[266]['value']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <h3 class="h4 mb-3">Distinct Methodologies</h3>
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h4 class="h5">The Oroks Transformation Framework</h4>
                            <p>A proprietary 5-phase approach to organizational transformation that balances technological innovation with cultural preservation.</p>
                            <ol>
                                <li>Diagnostic Assessment</li>
                                <li>Vision Alignment</li>
                                <li>Capability Building</li>
                                <li>Pilot Implementation</li>
                                <li>Scale & Institutionalize</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h3 class="h4 mb-3">Thought Leadership</h3>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h4 class="h5">Speaking Topics</h4>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-microphone text-primary me-2"></i> "Faith-Based Leadership in the Digital Age"</li>
                                <li class="mb-2"><i class="fas fa-microphone text-primary me-2"></i> "Bridging Cultural Heritage with Technological Innovation"</li>
                                <li class="mb-2"><i class="fas fa-microphone text-primary me-2"></i> "The Triple Bottom Line: Profit, People & Purpose"</li>
                                <li class="mb-2"><i class="fas fa-microphone text-primary me-2"></i> "Diaspora Engagement Strategies for Community Development"</li>
                            </ul>
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
                <?php foreach ($attribute[23]['sections']['impact section']['sets'] as $index => $caseStudy): ?>
                    <div class="col-lg-6">
                        <?= str_replace(
                            ['[CASE_TITLE]', '[CHALLENGE_TEXT]', '[APPROACH_TEXT]', '[RESULTS_LIST]', '[TESTIMONIAL_TEXT]', '[TESTIMONIAL_AUTHOR]'],
                            [
                                'Case Study ' . ($index + 1),
                                'Challenge description for case study ' . ($index + 1),
                                'Approach taken for case study ' . ($index + 1),
                                '<li>Result 1</li><li>Result 2</li><li>Result 3</li>',
                                'Testimonial text for case study ' . ($index + 1),
                                'Testimonial Author ' . ($index + 1)
                            ],
                            $caseStudy[285]['value']
                        ) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Section 10: Thought Leadership & Publications -->
    <section id="thought-leadership" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title"><?= $attribute[24]['tab_name'] ?></h2>
            
            <div class="row">
                <?php foreach ($attribute[24]['sections']['publications section']['sets'] as $index => $publication): ?>
                    <div class="col-md-4 mb-4">
                        <?= str_replace(
                            ['[PUB_ICON]', '[PUB_TYPE]', '[PUB_TITLE]', '[PUB_SOURCE]', '[PUB_YEAR]', '[PUB_LINK]'],
                            [
                                'fas fa-newspaper',
                                'Article',
                                $publication[270]['value'],
                                'Publication Source',
                                date('Y'),
                                '#'
                            ],
                            $publication[287]['value']
                        ) ?>
                    </div>
                <?php endforeach; ?>
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
                        <?php foreach ($attribute[17]['sections']['background section']['attributes'][249]['values'] as $index => $image): ?>
                            <div class="col-6">
                                <?= str_replace(
                                    ['[MEDIA_IMAGE]', '[MEDIA_TITLE]'],
                                    [ABSOLUTE_IMAGEPATH.$image['value'], 'Image ' . ($index + 1)],
                                    $attribute[25]['sections']['media section']['sets'][0][289]['value']
                                ) ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <h3 class="h4 mb-3">Video Clips</h3>
                    <div class="ratio ratio-16x9 mb-3">
                        <iframe src="https://www.youtube.com/embed/<?= $attribute[20]['sections']['community section']['sets'][0][307]['value'] ?>" title="Sample video" allowfullscreen></iframe>
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
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            Leadership Webinar: The Pastor-CEO
                            <span class="badge bg-primary rounded-pill">45:21</span>
                        </a>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <h3 class="h4 mb-3">Downloads</h3>
                    <?php foreach ($attribute[25]['sections']['media section']['sets'] as $index => $download): ?>
                        <?= str_replace(
                            ['[FILE_ICON]', '[FILE_COLOR]', '[FILE_TITLE]', '[FILE_FORMAT]', '[FILE_SIZE]', '[FILE_URL]'],
                            [
                                'fas fa-file-pdf',
                                'danger',
                                'Document ' . ($index + 1),
                                'PDF',
                                '2.4MB',
                                '#'
                            ],
                            $download[291]['value']
                        ) ?>
                    <?php endforeach; ?>
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
                                <a href="<?= $attribute[26]['sections']['contact section']['sets'][0][276]['value'] ?>" class="text-decoration-none" target="_blank">jacoboroks.com</a>
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
                                    <a href="<?= $attribute[26]['sections']['SocialMedia']['attributes'][311]['current_value'] ?>" class="btn btn-sm btn-outline-primary rounded-pill">
                                        <i class="fab fa-linkedin-in me-1"></i> LinkedIn
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-info rounded-pill">
                                        <i class="fab fa-twitter me-1"></i> Twitter
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-danger rounded-pill">
                                        <i class="fab fa-instagram me-1"></i> Instagram
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Professional Associations -->
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0 bg-primary bg-opacity-10 p-2 rounded">
                                <i class="fas fa-award text-primary fs-5"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="h6 mb-2">Professional Associations</h4>
                                <ul class="list-unstyled">
                                    <li class="mb-1">
                                        <i class="fas fa-circle-check text-success me-2"></i>
                                        Forbes Technology Council
                                    </li>
                                    <li class="mb-1">
                                        <i class="fas fa-circle-check text-success me-2"></i>
                                        FaithTech Collective
                                    </li>
                                    <li class="mb-1">
                                        <i class="fas fa-circle-check text-success me-2"></i>
                                        Efik Diaspora Council
                                    </li>
                                    <li>
                                        <i class="fas fa-circle-check text-success me-2"></i>
                                        Royal Society of Arts
                                    </li>
                                </ul>
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
                            
                            <!-- Real Estate Pros -->
                            <div class="col-md-6">
                                <div class="card bg-warning bg-opacity-10 border-warning border-opacity-25 h-100">
                                    <div class="card-body text-center p-3">
                                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle d-inline-block mb-3">
                                            <i class="fas fa-building text-warning fs-4"></i>
                                        </div>
                                        <h4 class="h6 mb-2">Real Estate Professionals</h4>
                                        <p class="small mb-3">View available investment listings</p>
                                        <a href="#" class="btn btn-warning btn-sm stretched-link">
                                            Browse Listings <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Product/Project Managers -->
                            <div class="col-md-6">
                                <div class="card bg-info bg-opacity-10 border-info border-opacity-25 h-100">
                                    <div class="card-body text-center p-3">
                                        <div class="bg-info bg-opacity-10 p-3 rounded-circle d-inline-block mb-3">
                                            <i class="fas fa-road text-info fs-4"></i>
                                        </div>
                                        <h4 class="h6 mb-2">Product/Project Managers</h4>
                                        <p class="small mb-3">Download our roadmap template</p>
                                        <a href="#" class="btn btn-info btn-sm stretched-link">
                                            Download <i class="fas fa-arrow-down ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Administrators -->
                            <div class="col-md-12">
                                <div class="card bg-secondary bg-opacity-10 border-secondary border-opacity-25 h-100">
                                    <div class="card-body text-center p-3">
                                        <div class="bg-secondary bg-opacity-10 p-3 rounded-circle d-inline-block mb-3">
                                            <i class="fas fa-cogs text-secondary fs-4"></i>
                                        </div>
                                        <h4 class="h6 mb-2">Administrators</h4>
                                        <p class="small mb-3">Learn about our operational services</p>
                                        <a href="#" class="btn btn-secondary btn-sm stretched-link">
                                            Explore Services <i class="fas fa-arrow-right ms-1"></i>
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
