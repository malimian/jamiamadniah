<?php 
        header('Content-type: application/xml'); 

        $output =   '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $output .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        echo $output;
        include 'connect.php';
?>
<url>
  <loc><?php echo BASE_URL;?></loc>
  <lastmod>2020-03-26T14:58:47+00:00</lastmod>
  <priority>1.00</priority>
</url>


<?php
  $pages = return_multiple_rows("Select * from pages $where_gc and isactive = 1 ");
  foreach ($pages as $page) {
?>

<url>
  <loc><?php echo BASE_URL;?><?php echo $page['page_url'];?></loc>
    <lastmod><?php echo date('c',  strtotime($page['updatedon'])); ?></lastmod>
    <priority>0.9</priority>

</url>

<?php 
}
?>


</urlset>