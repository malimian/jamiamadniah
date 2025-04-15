<?php
$GLOBALS['content'] = $content;

if (!function_exists("header_t")) {
    function header_t()
    {
        return '
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
            <link href="css/templates/template_general.css" rel="stylesheet">
            <meta property="og:site_name" content="' . SITE_TITLE . '">
            <meta property="og:title" content="' . replace_sysvari($GLOBALS['content']['page_title']) . '" />
            <meta property="og:description" content="' . replace_sysvari($GLOBALS['content']['page_title']) . '" />
            <meta property="og:image" itemprop="image" content="' . BASE_URL . ABSOLUTE_IMAGEPATH . $GLOBALS['content']['featured_image'] . '">           
        ';
    }
}

if (!function_exists("footer_t")) {
    function footer_t()
    {
        return '
        ';
    }
}




$GLOBALS['content'] = $content;

// 4. Fetch product variations
$product_variations = return_multiple_rows("SELECT * from product_variations Where page_id = " . $content['pid'] . " and isactive = 1 and soft_delete = 0");

// 5. Fetch images
$photogallery = return_multiple_rows("Select * from images Where pid = " . $content['pid'] . " and isactive = 1 and soft_delete = 0");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo replace_sysvari($content['page_title']); ?></title>
    <?php echo header_t(); ?>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #111;
            color: #fff;
        }
        .hero-section {
            min-height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-size: cover;
            background-position: center;
            position: relative;
            z-index: 1;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: -1;
        }
        .hero-content {
            text-align: center;
            padding: 2rem;
        }
        .hero-name {
            font-size: 4rem;
            font-weight: bold;
            margin-bottom: 1rem;
            letter-spacing: 0.1em;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
        }
        .hero-title {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            color: #eee;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
        }
        .social-links a {
            color: #fff;
            font-size: 2rem;
            margin: 0 0.5rem;
            transition: color 0.3s ease;
        }
        .social-links a:hover {
            color: #007bff;
        }
        .video-highlight {
            padding: 3rem;
            background-color: #1a1a1a;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
            margin-bottom: 5rem;
        }
        .video-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.7);
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .highlight-text {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #fff;
        }
        .details-section {
            padding: 5rem 0;
        }
        .detail-card {
            background-color: #222;
            border: 1px solid #333;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .detail-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.7);
        }
        .detail-card-body {
            padding: 1.5rem;
        }
        .detail-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #fff;
        }
        .detail-text {
            font-size: 1rem;
            color: #eee;
            margin-bottom: 1.5rem;
        }
        .modal-content {
            background-color: #2a2a2a;
            color: #fff;
            border: 1px solid #444;
            border-radius: 10px;
        }
        .modal-header {
            border-bottom: 1px solid #444;
            padding-bottom: 1rem;
        }
        .modal-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #fff;
        }
        .modal-body {
            padding: 1.5rem;
        }
        .modal-footer {
            border-top: 1px solid #444;
            padding-top: 1rem;
        }
        .btn-outline-light:hover {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 0.75rem 1.5rem;
            font-size: 1.1rem;
            font-weight: 500;
            border-radius: 8px;
            transition: background-color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.5);
        }

        .section-title{
            font-size: 3rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 3rem;
            letter-spacing: 0.1em;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.7);
        }
        #basic{
            padding: 5rem 0;
            background-color: #1a1a1a;
        }
        #basic h3{
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            color: #fff;
        }
        #basic p{
            font-size: 1.1rem;
            color: #eee;
            line-height: 1.8;
            margin-bottom: 2rem;
        }
        #achievements-section {
            padding: 5rem 0;
        }

        .achievement-card {
            background-color: #222;
            border: 1px solid #333;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }
        .achievement-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.7);
        }
        .achievement-card img {
            height: 250px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .achievement-card-body {
            padding: 1.5rem;
        }
        .achievement-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #fff;
        }
        .achievement-text {
            font-size: 1rem;
            color: #eee;
            margin-bottom: 1.5rem;
        }

        #contact{
            padding: 5rem 0;
            text-align: center;
        }
        #contact h2{
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 2rem;
            color: #fff;
        }
        #contact p{
            font-size: 1.2rem;
            color: #eee;
            margin-bottom: 2rem;

        }

        footer{
            padding: 2rem 0;
            background-color: #111;
            text-align: center;
            color: #aaa;
            border-top: 1px solid #333;
        }

    </style>
</head>
<body>
    <header class="hero-section" style="background-image: url('<?php echo ABSOLUTE_IMAGEPATH . $content['featured_image']; ?>');">
        <div class="hero-content">
            <h1 class="hero-name"><?php echo replace_sysvari($content['page_title']); ?></h1>
            <p class="hero-title"><?php echo htmlspecialchars($groupedAttributes['basic'][1]['attribute_value'] ?? ''); // Person Title ?></p>
            <div class="social-links" id="socialLinks">
                <?php
                foreach (json_decode($groupedAttributes['contact'][0]['attribute_value'] ?? '[]', true) as $link) { // Social Links
                    echo '<a href="' . htmlspecialchars($link['url']) . '"><i class="' . htmlspecialchars($link['icon']) . '"></i></a>';
                }
                ?>
            </div>
        </div>
    </header>

    <section id="basic">
        <div class="container">
            <h2 class="section-title">Basic Information</h2>
            <div class="row">
                <div class="col-lg-6">
                    <h3 id="shortBioTitle">Short Biography</h3>
                    <p><?php echo replace_sysvari($groupedAttributes['details'][0]['attribute_value'] ?? ''); // Short Bio ?></p>
                </div>
                <div class="col-lg-6">
                    <h3 id="longBioTitle">Long Biography</h3>
                    <p><?php echo replace_sysvari($groupedAttributes['details'][1]['attribute_value'] ?? ''); // Long Bio ?></p>
                </div>
            </div>
        </div>
    </section>

    <section class="video-highlight">
        <div class="container">
            <div class="video-container">
                <iframe id="videoUrl" src="<?php echo htmlspecialchars($groupedAttributes['media'][0]['attribute_value'] ?? ''); ?>" title="Video Interview" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
            <div class="text-center mt-4">
                <h2 class="highlight-text">Video Interview</h2>
            </div>
        </div>
    </section>

    <section id="achievements-section">
        <div class="container">
            <h2 class="section-title">Achievements</h2>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="achievements">
                <?php
                foreach (json_decode($groupedAttributes['achievements'][0]['attribute_value'] ?? '[]', true) as $achievement) { // Achievements
                    echo '
                        <div class="col">
                            <div class="achievement-card">
                                <div class="achievement-card-body">
                                    <h3 class="achievement-title">' . htmlspecialchars($achievement['title']) . '</h3>
                                    <p class="achievement-text">' . htmlspecialchars($achievement['description']) . '</p>
                                </div>
                            </div>
                        </div>
                    ';
                }
                ?>
            </div>
        </div>
    </section>

    <section class="quote-section">
        <div class="container">
            <div class="quote-container">
                <blockquote class="blockquote text-center">
                    <p class="mb-0"><?php echo replace_sysvari($groupedAttributes['quote'][0]['attribute_value'] ?? ''); ?></p>
                    <footer class="blockquote-footer"><?php echo replace_sysvari($groupedAttributes['quote'][1]['attribute_value'] ?? ''); ?></footer>
                </blockquote>
            </div>
        </div>
    </section>

    <section id="contact">
        <div class="container">
            <h2>Contact</h2>
            <div id="socialLinksContact" class="social-links">
            <?php
                foreach (json_decode($groupedAttributes['contact'][0]['attribute_value'] ?? '[]', true) as $link) { // Social Links
                    echo  '<a href="' . htmlspecialchars($link['url']) . '" class="btn btn-outline-light me-2"><i class="' . htmlspecialchars($link['icon']) . '"></i>  ' . htmlspecialchars($link['name']) . '</a>';
                }
                ?>
            </div>
        </div>
    </section>