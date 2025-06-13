<!-- Category News Carousels Start -->
<div class="container-fluid latest-news py-5 bg-light">
    <div class="container py-5">
        
        <!-- Business News Carousel -->
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Business News</h2>
            </div>
            <div class="latest-news-carousel owl-carousel business-carousel">
                <?php
                $business_news = return_multiple_rows("SELECT * FROM pages WHERE catid = 119 AND isactive = 1 AND soft_delete = 0 AND template_id = 7 
                    AND pid NOT IN (" . (!empty($not_show_more_then_once) ? implode(",", $not_show_more_then_once) : "0") . ")
                    ORDER BY createdon DESC LIMIT 8");
                foreach ($business_news as $news) {
                ?>
                <div class="latest-news-item">
                    <div class="bg-white rounded">
                        <div class="rounded-top overflow-hidden">
                            <img src="<?php echo getFullImageUrl($news['featured_image']); ?>" class="img-zoomin img-fluid rounded-top w-100" alt="<?php echo $news['page_title']; ?>">
                        </div>
                        <div class="d-flex flex-column p-4">
                            <a href="<?php echo $news['page_url']; ?>" class="h4"><?php echo mb_strimwidth($news['page_title'], 0, 45, "..."); ?></a>
                            <div class="d-flex justify-content-between mt-2">
                                <a href="#" class="small text-body link-hover">by <?php echo mb_strimwidth($news['article_author'], 0, 15, "..."); ?></a>
                                <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i><?php echo timeAgo($news['createdon']); ?></small>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>

        <!-- Health News Carousel -->
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Health News</h2>
            </div>
            <div class="latest-news-carousel owl-carousel health-carousel">
                <?php
                $health_news = return_multiple_rows("SELECT * FROM pages WHERE catid = 120 AND isactive = 1 AND soft_delete = 0 
                    AND pid NOT IN (" . (!empty($not_show_more_then_once) ? implode(",", $not_show_more_then_once) : "0") . ")
                    AND template_id = 7 ORDER BY createdon DESC LIMIT 8");
                foreach ($health_news as $news) {
                ?>
                <div class="latest-news-item">
                    <div class="bg-white rounded">
                        <div class="rounded-top overflow-hidden">
                            <img src="<?php echo getFullImageUrl($news['featured_image']); ?>" class="img-zoomin img-fluid rounded-top w-100" alt="<?php echo $news['page_title']; ?>">
                        </div>
                        <div class="d-flex flex-column p-4">
                            <a href="<?php echo $news['page_url']; ?>" class="h4"><?php echo mb_strimwidth($news['page_title'], 0, 45, "..."); ?></a>
                            <div class="d-flex justify-content-between mt-2">
                                <a href="#" class="small text-body link-hover">by <?php echo mb_strimwidth($news['article_author'], 0, 15, "..."); ?></a>
                                <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i><?php echo timeAgo($news['createdon']); ?></small>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>

        <!-- Sports News Carousel -->
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Sports News</h2>
            </div>
            <div class="latest-news-carousel owl-carousel sports-carousel">
                <?php
                $sports_news = return_multiple_rows("SELECT * FROM pages WHERE catid = 121 AND isactive = 1 AND soft_delete = 0
                AND pid NOT IN (" . (!empty($not_show_more_then_once) ? implode(",", $not_show_more_then_once) : "0") . ")
                 AND template_id = 7 ORDER BY createdon DESC LIMIT 8");
                foreach ($sports_news as $news) {
                ?>
                <div class="latest-news-item">
                    <div class="bg-white rounded">
                        <div class="rounded-top overflow-hidden">
                            <img src="<?php echo getFullImageUrl($news['featured_image']); ?>" class="img-zoomin img-fluid rounded-top w-100" alt="<?php echo $news['page_title']; ?>">
                        </div>
                        <div class="d-flex flex-column p-4">
                            <a href="<?php echo $news['page_url']; ?>" class="h4"><?php echo mb_strimwidth($news['page_title'], 0, 45, "..."); ?></a>
                            <div class="d-flex justify-content-between mt-2">
                                <a href="#" class="small text-body link-hover">by <?php echo mb_strimwidth($news['article_author'], 0, 15, "..."); ?></a>
                                <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i><?php echo timeAgo($news['createdon']); ?></small>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>

        <!-- Technology News Carousel -->
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Technology News</h2>
            </div>
            <div class="latest-news-carousel owl-carousel tech-carousel">
                <?php
                $tech_news = return_multiple_rows("SELECT * FROM pages WHERE catid = 122 AND isactive = 1 AND soft_delete = 0   AND pid NOT IN (" . (!empty($not_show_more_then_once) ? implode(",", $not_show_more_then_once) : "0") . ")
                    AND template_id = 7 ORDER BY createdon DESC LIMIT 8");
                foreach ($tech_news as $news) {
                ?>
                <div class="latest-news-item">
                    <div class="bg-white rounded">
                        <div class="rounded-top overflow-hidden">
                            <img src="<?php echo getFullImageUrl($news['featured_image']); ?>" class="img-zoomin img-fluid rounded-top w-100" alt="<?php echo $news['page_title']; ?>">
                        </div>
                        <div class="d-flex flex-column p-4">
                            <a href="<?php echo $news['page_url']; ?>" class="h4"><?php echo mb_strimwidth($news['page_title'], 0, 45, "..."); ?></a>
                            <div class="d-flex justify-content-between mt-2">
                                <a href="#" class="small text-body link-hover">by <?php echo mb_strimwidth($news['article_author'], 0, 15, "..."); ?></a>
                                <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i><?php echo timeAgo($news['createdon']); ?></small>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>