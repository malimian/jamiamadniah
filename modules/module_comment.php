<?php
global $content;
?>

<div class="bg-light rounded p-4 my-4" id="comment-form-container">
    <h4 class="mb-4">تبصرہ کریں</h4>
    <div id="comment-message" class="mb-3" style="display: none;"></div>
    
    <form id="comment-form">
        <input type="hidden" name="action" value="submit_comment">
        <input type="hidden" name="page_id" value="<?php echo $content['pid']; ?>">
        
        <?php if (isset($_SESSION['user']['id'])): ?>
            <!-- لاگ ان صارف - پروفائل تصویر دکھائیں -->
            <div class="d-flex align-items-center mb-3">
                <img src="<?php echo get_user_profile_pic($_SESSION['user']['id']); ?>" 
                     class="rounded-circle me-2" width="60" height="60" 
                     alt="<?php echo htmlspecialchars($_SESSION['user']['username']); ?>">
                <div>
                    <h6 class="mb-0"><?php echo htmlspecialchars($_SESSION['user']['fullname'] ?? $_SESSION['user']['username']); ?></h6>
                    <small>رجسٹرڈ صارف کے طور پر تبصرہ کر رہے ہیں</small>
                </div>
            </div>
        <?php else: ?>
            <!-- مہمان صارف - نام/ای میل فیلڈز دکھائیں -->
            <div class="row g-4">
                <div class="col-lg-6">
                    <input type="text" name="name" class="form-control py-3" placeholder="مکمل نام" required>
                </div>
                <div class="col-lg-6">
                    <input type="email" name="email" class="form-control py-3" placeholder="ای میل ایڈریس" required>
                </div>
            </div>
        <?php endif; ?>
        
        <div class="mt-3">
            <textarea name="comment" class="form-control" cols="30" rows="7" 
                      placeholder="اپنا تبصرہ یہاں لکھیں" required></textarea>
            <small class="text-muted">تبصرے کی نگرانی کی جاتی ہے اور ظاہر ہونے میں وقت لگ سکتا ہے۔</small>
        </div>
        
        <div class="mt-3">
            <button type="submit" class="btn btn-primary py-3 px-4">
                تبصرہ جمع کروائیں
            </button>
        </div>
    </form>
</div>

<!-- تبصروں کا ڈسپلے سیکشن -->
<div class="bg-light rounded p-4">
    <h4 class="mb-4">تبصرے</h4>
    <div class="p-4 bg-white rounded mb-4" id="comments-container">
        <?php 
        $is_admin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'];
        echo display_comments($content['pid'], $is_admin); 
        ?>
    </div>
</div>


  <!-- Download & View Buttons -->
        <?php 
        $files = return_single_row("SELECT * FROM page_files 
            WHERE isactive = 1 
            AND soft_delete = 0 
            AND pid = ".$content['pid']);

        if (!empty($files) && !empty($files['f_name'])) {
            $file_link = ABSOLUTE_FILEPATH . $files['f_name'];
        ?>
            <div class="mt-4">
                <a href="<?= htmlspecialchars($file_link) ?>" class="btn btn-outline-success me-2" download>
                    <i class="fas fa-download me-2"></i>ڈاؤن لوڈ کریں
                </a>
                <a href="<?= htmlspecialchars($file_link) ?>" target="_blank" class="btn btn-outline-primary">
                    <i class="fas fa-eye me-2"></i>آن لائن دیکھیں
                </a>
            </div>
        <?php } else { ?>
            <div class='alert alert-warning mt-4'>اس فتوی کی کوئی فائل موجود نہیں ہے۔</div>
        <?php } ?>
    </div>

<script type="text/javascript" src="js/modules/comments/comments.js" async></script>