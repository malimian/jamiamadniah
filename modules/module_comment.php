<?php
global $content;
?>

<div class="bg-light rounded p-4 my-4" id="comment-form-container">
    <h4 class="mb-4">Leave A Comment</h4>
    <div id="comment-message" class="mb-3" style="display: none;"></div>
    
    <form id="comment-form">
        <input type="hidden" name="action" value="submit_comment">
        <input type="hidden" name="page_id" value="<?php echo $content['pid']; ?>">
        
        <?php if (isset($_SESSION['user']['id'])): ?>
            <!-- Logged in user - show profile pic -->
            <div class="d-flex align-items-center mb-3">
                <img src="<?php echo get_user_profile_pic($_SESSION['user']['id']); ?>" 
                     class="rounded-circle me-2" width="60" height="60" 
                     alt="<?php echo htmlspecialchars($_SESSION['user']['username']); ?>">
                <div>
                    <h6 class="mb-0"><?php echo htmlspecialchars($_SESSION['user']['fullname'] ?? $_SESSION['user']['username']); ?></h6>
                    <small>Posting as registered user</small>
                </div>
            </div>
        <?php else: ?>
            <!-- Guest user - show name/email fields -->
            <div class="row g-4">
                <div class="col-lg-6">
                    <input type="text" name="name" class="form-control py-3" placeholder="Full Name" required>
                </div>
                <div class="col-lg-6">
                    <input type="email" name="email" class="form-control py-3" placeholder="Email Address" required>
                </div>
            </div>
        <?php endif; ?>
        
        <div class="mt-3">
            <textarea name="comment" class="form-control" cols="30" rows="7" 
                      placeholder="Write Your Comment Here" required></textarea>
            <small class="text-muted">Comments are moderated and may take time to appear.</small>
        </div>
        
        <div class="mt-3">
            <button type="submit" class="btn btn-primary py-3 px-4">
                Submit Comment
            </button>
        </div>
    </form>
</div>

<!-- Comments display section -->
<div class="bg-light rounded p-4">
    <h4 class="mb-4">Comments</h4>
    <div class="p-4 bg-white rounded mb-4" id="comments-container">
        <?php 
        $is_admin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'];
        echo display_comments($content['pid'], $is_admin); 
        ?>
    </div>
</div>

<script type="text/javascript" src="js/modules/comments/comments.js" async></script>