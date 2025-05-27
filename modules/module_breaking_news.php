<div class="d-flex align-items-center">
  <!-- Trending Label -->
  <div class="pe-2 me-3 border-end border-white d-flex align-items-center">
    <p class="mb-0 text-white fs-6 fw-normal">Trending</p>
  </div>

  <!-- Breaking News Ticker -->
  <div class="overflow-hidden" style="width: 914px;">
    <div id="breakingNewsTicker" class="d-flex align-items-center ps-2">
      <?php
      $breaking_news = return_multiple_rows("
          SELECT p.*, c.catname 
          FROM pages p
          JOIN category c ON p.catid = c.catid
          WHERE p.isactive = 1 
          AND p.soft_delete = 0 
          AND p.template_id = 7 
          ORDER BY p.createdon DESC 
          LIMIT 5
      ");

      foreach ($breaking_news as $news) {
      ?>
      <div class="ticker-item d-flex align-items-center me-4">
        <img src="<?php echo $news['featured_image']; ?>" class="img-fluid rounded-circle border border-3 border-primary me-2" style="width: 30px; height: 30px;" alt="">
        <a href="<?php echo $news['page_url']; ?>" class="text-white text-decoration-none">
          <p class="mb-0 text-white link-hover">
            <?php echo mb_strimwidth($news['page_title'], 0, 100, "..."); ?>
            <span class="badge bg-white text-primary ms-2"><?php echo $news['catname']; ?></span>
          </p>
        </a>
      </div>
      <?php } ?>
    </div>
  </div>

  <!-- LIVE Badge -->
  <span class="live-badge ms-3 text-white fw-bold px-2 py-1 bg-danger rounded">LIVE</span>
</div>
<style type="text/css">
    #breakingNewsTicker {
  overflow-x: auto;
  scroll-snap-type: x mandatory;
  scroll-behavior: smooth;
  -webkit-overflow-scrolling: touch;
  white-space: nowrap;
  height: 30px;
}

.ticker-item {
  scroll-snap-align: start;
  flex: 0 0 auto;
  display: inline-flex;
  align-items: center;
}

#breakingNewsTicker::-webkit-scrollbar {
  display: none;
}

.link-hover:hover {
  text-decoration: underline;
  opacity: 0.9;
}

.live-badge {
  font-size: 0.75rem;
  letter-spacing: 1px;
}

</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const ticker = document.getElementById('breakingNewsTicker');
  const items = document.querySelectorAll('.ticker-item');
  let currentIndex = 0;

  if (items.length > 0) {
    // Auto-scroll every 5 seconds
    setInterval(() => {
      currentIndex = (currentIndex + 1) % items.length;
      ticker.scrollTo({
        left: items[currentIndex].offsetLeft,
        behavior: 'smooth'
      });
    }, 5000);
  }
});
</script>
