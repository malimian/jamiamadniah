 <!-- Popular News Start -->
                                <h4 class="my-4">Popular News</h4>
                                <div class="row g-4">
                                    <?php
                                // Fetch popular news items
                                $popular_news = return_multiple_rows("
                                    SELECT p.*, c.catname AS catname 
                                    FROM (
                                        SELECT p.*, 
                                               ROW_NUMBER() OVER (PARTITION BY p.catid ORDER BY RAND()) AS rn 
                                        FROM pages p
                                        WHERE p.template_id = 7 
                                          AND p.isactive = 1 
                                          AND p.soft_delete = 0
                                    ) AS p
                                    LEFT JOIN category c ON p.catid = c.catid
                                    WHERE p.rn = 1 
                                    ORDER BY p.views DESC 
                                    LIMIT 5
                                ");

                                    foreach ($popular_news as $news) {
                                        $not_show_more_then_once[] = $news['pid'];
                                    ?>
                                        <div class="col-12">
                                            <div class="row g-4 align-items-center features-item">
                                                <div class="col-4">
                                                    <div class="rounded-circle position-relative">
                                                        <div class="overflow-hidden rounded-circle">
                                                            <img src="<?php echo getFullImageUrl($news['featured_image']); ?>" class="img-zoomin img-fluid rounded-circle w-100 circle-clss" alt="<?php echo $news['page_title']; ?>">
                                                        </div>
                                                        <span class="rounded-circle border border-2 border-white bg-primary btn-sm-square text-white position-absolute" style="top: 10%; right: -10px;"><?php echo $news['views']; ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <div class="features-content d-flex flex-column">
                                                        <p class="text-uppercase mb-2"><?php echo $news['catname']; ?></p>
                                                        <a href="<?php echo $news['page_url']; ?>" class="h6"><?php echo mb_strimwidth($news['page_title'], 0, 45, "..."); ?></a>
                                                        <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i><?php echo timeAgo($news['createdon']); ?></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                        <div class="col-lg-12">
                                            <a href="#" class="link-hover btn border border-primary rounded-pill text-dark w-100 py-3 mb-4">View More</a>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="border-bottom my-3 pb-3">
                                                <h4 class="mb-0">Trending Tags</h4>
                                            </div>
                                            <ul class="nav nav-pills d-inline-flex text-center mb-4">
                                                <?php
                                                // Fetch trending tags from page_meta_keywords
                                                $tags = [];
                                                $all_keywords = return_multiple_rows("
                                                    SELECT page_meta_keywords 
                                                    FROM pages 
                                                    WHERE page_meta_keywords IS NOT NULL 
                                                      AND page_meta_keywords != ''
                                                ");

                                                // Process keywords and count their frequency
                                                foreach ($all_keywords as $keyword_row) {
                                                    $keywords = explode(",", $keyword_row['page_meta_keywords']);
                                                    foreach ($keywords as $keyword) {
                                                        $keyword = trim($keyword); // Remove extra spaces
                                                        if (!empty($keyword)) {
                                                            if (isset($tags[$keyword])) {
                                                                $tags[$keyword]++;
                                                            } else {
                                                                $tags[$keyword] = 1;
                                                            }
                                                        }
                                                    }
                                                }

                                                // Sort tags by frequency in descending order
                                                arsort($tags);

                                                // Get top 10 tags
                                                $trending_tags = array_slice(array_keys($tags), 0, 24);

                                                // Loop through the trending tags and display them
                                                if (!empty($trending_tags)) {
                                                    foreach ($trending_tags as $tag) {
                                                        echo '
                                                        <li class="nav-item mb-3">
                                                            <a class="d-flex py-2 bg-light rounded-pill me-2" href="' . BASE_URL . 'search.php?q=' . urlencode($tag) . '">
                                                                <span class="text-dark link-hover" style="width: 90px;">' . htmlspecialchars($tag) . '</span>
                                                            </a>
                                                        </li>';
                                                    }
                                                } else {
                                                    echo '<p>No tags found.</p>';
                                                }
                                                ?>
                                            </ul>
                                        </div>
                        </div>