<?php
    header('Content-type: application/xml');

    $output =  '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $output .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    echo $output;
    include 'connect.php';
?>
<url>
  <loc><?php echo BASE_URL;?></loc>
  <lastmod>2020-03-26T14:58:47+00:00</lastmod>
  <priority>1.00</priority>
  <changefreq>weekly</changefreq>
</url>


<?php
  $pages = return_multiple_rows("SELECT * FROM pages $where_gc AND isactive = 1 AND include_in_sitemap = 1");
  foreach ($pages as $page) {
?>

<url>
  <loc><?php echo BASE_URL;?><?php echo $page['page_url'];?></loc>
    <lastmod><?php echo date('c',  strtotime($page['updatedon'])); ?></lastmod>
    <priority><?php echo $page['sitemap_priority'] ?? '0.8'; ?></priority>
    <changefreq><?php echo $page['sitemap_changefreq'] ?? 'weekly'; ?></changefreq>
</url>

<?php
}
?>


</urlset>