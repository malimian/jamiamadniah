<?php 
// print_r($content['attributes']);
$array = $content['attributes'];
?>

<?php
if(!function_exists("header_t")) {
    function header_t(){
        return '
            <link href="css/templates/template_person_spotlight2.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

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
        ';
    }
}
?>
    <!-- Section 1: Hero Banner with Carousel -->
    <section id="hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php foreach ($array[0]['sections'][0]['sets'] as $index => $slide): ?>
                <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>"></button>
            <?php endforeach; ?>
        </div>
        <div class="carousel-inner">
            <?php foreach ($array[0]['sections'][0]['sets'] as $index => $slide): ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                    <img src="<?= $slide[239]['value'] ?>" class="d-block w-100" alt="Jacob Oroks Banner <?= $index + 1 ?>">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="display-3 fw-bold"><?= $slide[238]['value'] ?></h1>
                        <p class="lead"><?= $slide[240]['value'] ?></p>
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
                    <img src="<?= $array[1]['sections'][0]['attributes'][0]['current_value'] ?>" 
                         alt="Professional Headshot of Jacob Oroks" 
                         class="img-fluid rounded-circle shadow"
                         style="width: 300px; height: 300px; object-fit: cover;">
                </div>
                
                <!-- Right Column - Profile Details -->
                <div class="col-md-8">
                    <div class="profile-card p-4 shadow-sm rounded-4">
                        <h2 class="mb-4 text-gradient"><?= $array[1]['tab_name'] ?></h2>
                        
                        <div class="row g-4">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <div class="d-flex align-items-start mb-4">
                                    <div class="me-3 text-primary">
                                        <i class="bi bi-person-badge fs-3"></i>
                                    </div>
                                    <div>
                                        <h3 class="h5 mb-1">Name & Titles</h3>
                                        <p class="mb-0 fw-bold fs-5"><?= $array[1]['sections'][0]['attributes'][1]['current_value'] ?></p>
                                        <?php 
                                        $titles = explode(',', $array[1]['sections'][0]['attributes'][2]['current_value']);
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
                                            <span class="d-block"><?= $array[1]['sections'][0]['attributes'][3]['current_value'] ?></span>
                                            <small class="text-muted">Based in Maryland</small>
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
                                            <a href="mailto:<?= $array[1]['sections'][0]['attributes'][4]['current_value'] ?>" class="text-decoration-none">
                                                <?= $array[1]['sections'][0]['attributes'][4]['current_value'] ?>
                                            </a>
                                        </p>
                                        <p class="mb-0">
                                            <a href="tel:<?= str_replace([' ', '(', ')', '-', '+'], '', $array[1]['sections'][0]['attributes'][5]['current_value']) ?>" class="text-decoration-none">
                                                <?= $array[1]['sections'][0]['attributes'][5]['current_value'] ?>
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
                                <a href="<?= $array[11]['sections'][1]['attributes'][0]['current_value'] ?>" class="btn btn-outline-primary p-2" target="_blank">
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

        <!-- Section 3: Personal Background -->
        <section class="mb-5 py-4">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="display-5 fw-bold text-gradient mb-3"><?= $array[2]['tab_name'] ?></h2>
                    <div class="section-divider mx-auto"></div>
                    <p class="lead text-muted"><?= $array[2]['sections'][2]['attributes'][1]['current_value'] ?></p>
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
                                                <img src="<?= $array[1]['sections'][0]['attributes'][0]['current_value'] ?>" 
                                                     class="rounded-circle shadow-sm" 
                                                     width="60" 
                                                     alt="Jacob Oroks">
                                            </div>
                                            <div>
                                                <h4 class="h5 mb-0"><?= $array[1]['sections'][0]['attributes'][1]['current_value'] ?></h4>
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
                                        <h3 class="h4 mb-2"><?= $array[2]['sections'][0]['attributes'][0]['current_value'] ?></h3>
                                        <p class="mb-0"><?= $array[2]['sections'][0]['attributes'][1]['current_value'] ?></p>
                                        <div class="mt-3">
                                            <?php 
                                            $badges = explode(',', $array[2]['sections'][0]['attributes'][2]['current_value']);
                                            foreach ($badges as $badge): ?>
                                                <span class="badge bg-success bg-opacity-10 text-success me-2"><?= trim($badge) ?></span>
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
                                        <h3 class="h4 mb-2"><?= $array[2]['sections'][1]['sets'][0][313]['value'] ?></h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="mb-3"><?= strip_tags($array[2]['sections'][1]['sets'][0][314]['value']) ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="list-unstyled">
                                                    <?php 
                                                    $listItems = explode('</li>', $array[2]['sections'][1]['sets'][0][314]['value']);
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
                    <h2 class="display-4 fw-bold mb-3 text-gradient"><?= $array[3]['tab_name'] ?></h2>
                    <p class="lead text-muted mx-auto" style="max-width: 600px;">
                        <?= $array[3]['sections'][2]['attributes'][1]['current_value'] ?>
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
                                    <?php foreach ($array[3]['sections'][1]['sets'] as $index => $education): ?>
                                        <div class="timeline-step">
                                            <div class="timeline-content">
                                                <div class="inner-circle bg-primary text-white">
                                                    <i class="bi bi-book"></i>
                                                </div>
                                                <h4 class="h5 mb-1"><?= $education[280]['value'] ?></h4>
                                                <p class="mb-1 text-primary fw-bold">Computer Science</p>
                                                <p class="small text-muted mb-2"><?= $education[281]['value'] ?></p>
                                                <div class="d-flex gap-2">
                                                    <span class="badge bg-primary bg-opacity-10 text-primary"><?= $array[3]['sections'][1]['attributes'][2]['current_value'] ?></span>
                                                    <span class="badge bg-success bg-opacity-10 text-success"><?= $education[284]['value'] ?></span>
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
                                    <?php foreach ($array[3]['sections'][0]['sets'] as $index => $cert): ?>
                                        <div class="col-md-6">
                                            <div class="certification-card bg-white rounded-3 p-4 h-100 shadow-sm border-start border-4 border-primary">
                                                <div class="d-flex align-items-center mb-3">
                                                    <img src="<?= $cert[299]['value'] ?>" 
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
                        <h2 class="display-5 fw-bold text-primary mb-3"><?= $array[4]['tab_name'] ?></h2>
                        <p class="lead text-muted"><?= $array[4]['sections'][1]['attributes'][1]['current_value'] ?></p>
                    </div>
                </div>
                <div class="row g-4">
                    <?php foreach ($array[4]['sections'][0]['sets'] as $index => $leadership): ?>
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
                        <h2 class="display-5 fw-bold text-primary mb-3"><?= $array[5]['tab_name'] ?></h2>
                        <p class="lead text-muted"><?= $array[5]['sections'][1]['attributes'][1]['current_value'] ?></p>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="card shadow-sm h-100 border-0">
                            <div class="card-body p-4">
                                <div class="mb-3 text-center">
                                    <i class="<?= $array[5]['sections'][0]['sets'][0][258]['value'] ?>"></i>
                                </div>
                                <h3 class="h5 fw-semibold text-secondary mb-2"><?= $array[5]['sections'][0]['sets'][0][259]['value'] ?></h3>
                                <ul class="list-unstyled text-muted">
                                    <?php 
                                    $listItems = explode('</li>', $array[5]['sections'][0]['sets'][0][260]['value']);
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
                                    <iframe src="https://www.youtube.com/embed/<?= $array[5]['sections'][0]['sets'][0][307]['value'] ?>" title="Jacob Oroks Cultural Stewardship" allowfullscreen></iframe>
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
                <?php foreach ($array[6]['sections'][0]['sets'] as $index => $experience): ?>
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
                <h2 class="section-title"><?= $array[7]['tab_name'] ?></h2>
                
                <div class="row g-4 mb-5">
                    <?php 
                    $expertiseItems = [
                        [
                            'icon' => 'fas fa-chart-line',
                            'title' => 'Data Driven Decision Making',
                            'desc' => 'Leveraging advanced analytics and business intelligence to drive strategic organizational decisions with measurable outcomes.'
                        ],
                        [
                            'icon' => 'fas fa-handshake',
                            'title' => 'M&A Integration',
                            'desc' => 'Expertise in merging organizations with minimal disruption while maximizing synergies and cultural alignment.'
                        ],
                        [
                            'icon' => 'fas fa-tasks',
                            'title' => 'Agile Product Delivery',
                            'desc' => 'Implementing lean methodologies to accelerate product development cycles while maintaining quality standards.'
                        ]
                    ];
                    foreach ($expertiseItems as $item): ?>
                        <div class="col-md-4">
                            <div class="card value-card shadow-sm h-100">
                                <div class="card-body">
                                    <div class="text-center mb-3">
                                        <i class="<?= $item['icon'] ?> fa-3x text-primary"></i>
                                    </div>
                                    <h3 class="h4 text-center"><?= $item['title'] ?></h3>
                                    <p class="text-muted"><?= $item['desc'] ?></p>
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
                <h2 class="section-title"><?= $array[8]['tab_name'] ?></h2>
                
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h3 class="h4">Case Study - Efik Cultural Preservation Initiative</h3>
                                <h4 class="h5 text-muted mt-3">Challenge</h4>
                                <p>Declining engagement among younger generations with Efik cultural traditions and language in the diaspora community.</p>
                                
                                <h4 class="h5 text-muted mt-3">Approach</h4>
                                <p>Developed a hybrid digital-physical engagement platform combining mobile apps for language learning with community events that modernized traditional practices.</p>
                                
                                <h4 class="h5 text-muted mt-3">Results</h4>
                                <ul>
                                    <li>+300% increase in youth participation in cultural events</li>
                                    <li>15,000+ downloads of language learning app in first year</li>
                                    <li>Formation of 12 new community chapters across the US</li>
                                </ul>
                                
                                <div class="testimonial-card bg-light p-3 mt-3">
                                    <p class="fst-italic mb-2">"Jacob's innovative approach saved our cultural heritage from being lost to assimilation. He made our traditions accessible and relevant to our digital-native youth."</p>
                                    <p class="fw-bold mb-0">— Chief Edet Okon, President, Efik Diaspora Council</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h3 class="h4">Case Study - Faith-Based Tech Startup Accelerator</h3>
                                <h4 class="h5 text-muted mt-3">Challenge</h4>
                                <p>Lack of funding and mentorship for Christian entrepreneurs building technology solutions for ministry applications.</p>
                                
                                <h4 class="h5 text-muted mt-3">Approach</h4>
                                <p>Created a 12-week accelerator program pairing Silicon Valley methodologies with biblical business principles, including:</p>
                                <ul>
                                    <li>Faith-integrated lean startup curriculum</li>
                                    <li>Network of impact investors</li>
                                    <li>Ministry-market fit validation framework</li>
                                </ul>
                                
                                <h4 class="h5 text-muted mt-3">Results</h4>
                                <ul>
                                    <li>42 startups graduated in 3 cohorts</li>
                                    <li>$5.2M in total funding raised by participants</li>
                                    <li>85% of ventures still operational after 3 years (vs. industry avg. of 40%)</li>
                                </ul>
                                
                                <div class="testimonial-card bg-light p-3 mt-3">
                                    <p class="fst-italic mb-2">"The accelerator gave us both the spiritual foundation and practical tools to build a sustainable business. Jacob's mentorship was transformative."</p>
                                    <p class="fw-bold mb-0">— Sarah Johnson, Founder, FaithfulMetrics</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 10: Thought Leadership & Publications -->
        <section id="thought-leadership" class="py-5 bg-light">
            <div class="container">
                <h2 class="section-title"><?= $array[9]['tab_name'] ?></h2>
                
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h3 class="h4 mb-3"><i class="fas fa-newspaper text-primary me-2"></i> Articles & Whitepapers</h3>
                                <ul class="list-unstyled">
                                    <li class="mb-2">"Digital Discipleship: Leveraging Technology for Spiritual Growth", <em>FaithTech Journal</em>, 2022</li>
                                    <li class="mb-2">"The Diaspora Dividend: Measuring the Economic Impact of Cultural Communities", <em>Harvard Business Review</em>, 2021</li>
                                    <li class="mb-2">"When Silicon Valley Meets Solomon: Ancient Wisdom for Modern Entrepreneurs", <em>Forbes</em>, 2020</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h3 class="h4 mb-3"><i class="fas fa-book text-primary me-2"></i> Books & E-Books</h3>
                            <ul class="list-unstyled">
                                <li class="mb-2"><strong>The Bilingual Leader</strong>: Navigating Between Sacred and Secular Leadership, Iboto Press, 2023</li>
                                <li class="mb-2"><strong>Code & Covenant</strong>: Building Technology With Kingdom Values, FaithTech Publishing, 2021</li>
                                <li class="mb-2"><strong>Diaspora 2.0</strong>: A Blueprint for Cultural Preservation in the Digital Age (e-book), 2020</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h3 class="h4 mb-3"><i class="fas fa-video text-primary me-2"></i> Conference Talks & Webinars</h3>
                            <ul class="list-unstyled">
                                <li class="mb-2">"Faith in the Algorithm" - TEDxSanFrancisco, 2022 <a href="#" class="text-decoration-none">[Watch]</a></li>
                                <li class="mb-2">"Building Bridges: Technology for Cultural Preservation" - UNESCO Digital Heritage Summit, 2021 <a href="#" class="text-decoration-none">[Watch]</a></li>
                                <li class="mb-2">"The Pastor-CEO: Leading at the Intersection of Faith and Business" - Global Leadership Network, 2020 <a href="#" class="text-decoration-none">[Watch]</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 11: Media Assets & Downloads -->
    <section id="media" class="py-5">
        <div class="container">
            <h2 class="section-title">Media Assets & Downloads</h2>
            
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <h3 class="h4 mb-3">Photo Gallery</h3>
                    <div class="row g-2">
                        <div class="col-6">
                            <div class="media-thumbnail">
                                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Team workshop" class="img-fluid">
                                <div class="overlay">Team Workshop</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="media-thumbnail">
                                <img src="https://images.unsplash.com/photo-1497366811353-6870744d04b2?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Speaking engagement" class="img-fluid">
                                <div class="overlay">Keynote Speech</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="media-thumbnail">
                                <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Community event" class="img-fluid">
                                <div class="overlay">Community Event</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="media-thumbnail">
                                <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Strategy session" class="img-fluid">
                                <div class="overlay">Strategy Session</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <h3 class="h4 mb-3">Video Clips</h3>
                    <div class="ratio ratio-16x9 mb-3">
                        <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="Sample video" allowfullscreen></iframe>
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
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-file-pdf fa-2x text-danger me-3"></i>
                                <div>
                                    <h4 class="h6 mb-0">Cultural Preservation Framework</h4>
                                    <small class="text-muted">PDF • 2.4 MB</small>
                                </div>
                            </div>
                            <a href="#" class="btn btn-sm btn-outline-primary w-100">Download</a>
                        </div>
                    </div>
                    
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-file-powerpoint fa-2x text-warning me-3"></i>
                                <div>
                                    <h4 class="h6 mb-0">Faith-Tech Integration Deck</h4>
                                    <small class="text-muted">PPTX • 5.1 MB</small>
                                </div>
                            </div>
                            <a href="#" class="btn btn-sm btn-outline-primary w-100">Download</a>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-file-alt fa-2x text-info me-3"></i>
                                <div>
                                    <h4 class="h6 mb-0">Diaspora Engagement Playbook</h4>
                                    <small class="text-muted">DOCX • 1.8 MB</small>
                                </div>
                            </div>
                            <a href="#" class="btn btn-sm btn-outline-primary w-100">Download</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 12: Digital Presence & Call to Action -->
    <section id="contact" class="py-5 bg-dark text-white">
        <div class="container">
            <h2 class="section-title text-white">Digital Presence & Call to Action</h2>
            
            <div class="row">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h3 class="h4 mb-4">Connect With Jacob</h3>
                    
                    <div class="mb-4">
                        <h4 class="h5">Website & Blog</h4>
                        <a href="https://www.jacoboroks.com" class="text-white text-decoration-none">www.jacoboroks.com</a>
                    </div>
                    
                    <div class="mb-4">
                        <h4 class="h5">Social Media</h4>
                        <div class="d-flex gap-3">
                            <a href="<?=($linkedin) ?>" class="text-white fs-3"><i class="fab fa-linkedin"></i></a>
                            <a href="<?=($twitter) ?>" class="text-white fs-3"><i class="fab fa-twitter"></i></a>
                            <a href="<?=($instagram) ?>" class="text-white fs-3"><i class="fab fa-instagram"></i></a>
                            <a href="<?=($facebook) ?>" class="text-white fs-3"><i class="fab fa-facebook"></i></a>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="h5">Professional Associations</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Member, Forbes Technology Council</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Advisor, FaithTech Collective</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Board Member, Efik Diaspora Council</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Fellow, Royal Society of Arts</li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <h3 class="h4 mb-4">Let's Collaborate</h3>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card bg-primary text-white h-100">
                                <div class="card-body">
                                    <h4 class="h5"><i class="fas fa-lightbulb me-2"></i> Entrepreneurs/Consultants</h4>
                                    <p>Schedule a Strategy Session to explore synergies and growth opportunities.</p>
                                    <a href="#" class="btn btn-light btn-sm">Book Now</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card bg-secondary text-white h-100">
                                <div class="card-body">
                                    <h4 class="h5"><i class="fas fa-chart-pie me-2"></i> Finance Leaders</h4>
                                    <p>Request a Financial Review to optimize your organization's stewardship.</p>
                                    <a href="#" class="btn btn-light btn-sm">Request Review</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card bg-success text-white h-100">
                                <div class="card-body">
                                    <h4 class="h5"><i class="fas fa-road me-2"></i> Product/Project Managers</h4>
                                    <p>Download our proven Product Roadmap Template to accelerate your planning.</p>
                                    <a href="#" class="btn btn-light btn-sm">Download</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card bg-info text-white h-100">
                                <div class="card-body">
                                    <h4 class="h5"><i class="fas fa-hands-helping me-2"></i> Administrators</h4>
                                    <p>Learn About Our Services that can streamline your operations.</p>
                                    <a href="#" class="btn btn-light btn-sm">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Section 12: Digital Presence & Call to Action -->
<section id="connect" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Connect & Collaborate</h2>
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
                                <a href="https://jacoboroks.com" class="text-decoration-none" target="_blank">jacoboroks.com</a>
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
                                    <a href="<?=($linkedin) ?>" class="btn btn-sm btn-outline-primary rounded-pill">
                                        <i class="fab fa-linkedin-in me-1"></i> LinkedIn
                                    </a>
                                    <a href="<?=($twitter) ?>" class="btn btn-sm btn-outline-info rounded-pill">
                                        <i class="fab fa-twitter me-1"></i> Twitter
                                    </a>
                                    <a href="<?=($instagram) ?>" class="btn btn-sm btn-outline-danger rounded-pill">
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