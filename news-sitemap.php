<?php
    header('Content-type: application/xml');

    $output =  '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $output .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">' . "\n";
    echo $output;
    include 'connect.php';
?>

<?php
// Fetch active pages included in sitemap and not soft deleted
$sql = "SELECT * FROM pages WHERE isactive = 1 AND include_in_sitemap = 1 AND soft_delete = 0 And template_id = 7 ORDER BY updatedon DESC";
$pages = return_multiple_rows($sql);

if ($pages && is_array($pages)) {
    foreach ($pages as $page) {
        // Skip pages without URL or title
        if (empty($page['page_url']) || empty($page['page_title'])) {
            continue;
        }

        // Format dates in ISO 8601
        $lastmod = date('c', strtotime($page['updatedon'] ?? date('Y-m-d H:i:s')));
        $pubDate = $lastmod;

        // Build absolute URL for the page
        $loc = rtrim(BASE_URL, '/') . '/' . ltrim($page['page_url'], '/');

        // Escape XML special characters safely
        $title = htmlspecialchars($page['page_title'], ENT_XML1 | ENT_QUOTES, 'UTF-8');
        $publicationName = htmlspecialchars(SITE_TITLE, ENT_XML1 | ENT_QUOTES, 'UTF-8');
        $language = SITE_LANGUAGE;

        // Use sitemap priority and changefreq or default values
        $priority = isset($page['sitemap_priority']) && $page['sitemap_priority'] !== '' ? $page['sitemap_priority'] : '0.8';
        $changefreq = !empty($page['sitemap_changefreq']) ? $page['sitemap_changefreq'] : 'weekly';

        ?>
<url>
  <loc><?php echo $loc; ?></loc>
  <news:news>
    <news:publication>
      <news:name><?php echo $publicationName; ?></news:name>
      <news:language><?php echo $language; ?></news:language>
    </news:publication>
    <news:publication_date><?php echo $pubDate; ?></news:publication_date>
    <news:title><?php echo $title; ?></news:title>
  </news:news>
  <lastmod><?php echo $lastmod; ?></lastmod>
  <priority><?php echo $priority; ?></priority>
  <changefreq><?php echo $changefreq; ?></changefreq>
</url>
        <?php
    }
}
?>

</urlset>
