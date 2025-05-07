<?php
$basePath = ABSOLUTE_IMAGEPATH;

$images = array_diff(scandir($basePath), array('.', '..'));

// Filter only image files (optional but recommended)
$images = array_filter($images, function($file) use ($basePath) {
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    return in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
});

// Shuffle and get 9 random images
shuffle($images);
$images = array_slice($images, 0, 6);
?>

<?php foreach ($images as $img): ?>
  <div class="col-4 mb-3">
    <div class="rounded overflow-hidden">
      <img src="<?= $basePath . $img ?>" class="img-zoomin img-fluid rounded w-100" alt="">
    </div>
  </div>
<?php endforeach; ?>
