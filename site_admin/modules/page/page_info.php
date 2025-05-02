<!-- Page Heading -->
<div class="row align-items-center mb-4">
    <div class="col-md-8">
        <h1 class="h3 mb-0 text-gray-800">Update <?php echo htmlspecialchars($page[0]['page_title']); ?></h1>
    </div>
    <div class="col-md-4 text-md-right">
        <!-- Page Info Dropdown -->
        <div class="dropdown d-inline-block">
            <button class="btn btn-sm btn-outline-info dropdown-toggle" type="button" id="pageInfoDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-info-circle"></i> Page Info
            </button>
            <div class="dropdown-menu dropdown-menu-right p-3" style="min-width: 300px;" aria-labelledby="pageInfoDropdown">
                <!-- Featured Image -->
                <div class="text-center mb-3">
                    <?php
                        $featured_image = !empty($page[0]['featured_image']) ? 
                            (filter_var($page[0]['featured_image'], FILTER_VALIDATE_URL) ? 
                                $page[0]['featured_image'] : 
                                BASE_URL.ABSOLUTE_IMAGEPATH.$page[0]['featured_image']) : 
                            BASE_URL.'assets/img/no-image-available.jpg';
                    ?>
                    <img src="<?php echo htmlspecialchars($featured_image); ?>" alt="Featured Image" class="img-fluid rounded" style="max-height: 100px;">
                </div>
                
                <!-- Status and Visibility -->
                <div class="d-flex justify-content-between mb-2">
                    <span class="badge badge-<?php echo $page[0]['isactive'] ? 'success' : 'warning'; ?>">
                        <?php echo $page[0]['isactive'] ? 'Published' : 'Draft'; ?>
                    </span>
                    <span class="badge badge-<?php echo $page[0]['visibility'] ? 'success' : 'secondary'; ?>">
                        <?php echo $page[0]['visibility'] ? 'Public' : 'Private'; ?>
                    </span>
                    <?php if($page[0]['isFeatured']): ?>
                        <span class="badge badge-primary">Featured</span>
                    <?php endif; ?>
                </div>

                <!-- Last Modified -->
                <div class="mb-2">
                    <small class="text-muted">Last Modified</small>
                    <div><?php echo date('M j, Y', strtotime($page[0]['updatedon'])); ?></div>
                </div>

                <!-- Author Section -->
                <div class="mb-2">
                    <small class="text-muted">Author</small>
                    <div class="d-flex align-items-center">
                        <?php
                            $author = isset($user_lookup[$page[0]['createdby']]) ? $user_lookup[$page[0]['createdby']] : null;
                            $author_name = $author ? htmlspecialchars($author['username']) : 'System';
                            $author_image = $author && !empty($author['profile_pic']) ? 
                                BASE_URL.ABSOLUTE_IMAGEPATH.$author['profile_pic'] : 
                                'https://ui-avatars.com/api/?name='.urlencode($author_name).'&size=30';
                        ?>
                        <img src="<?php echo htmlspecialchars($author_image); ?>" class="rounded-circle mr-2" width="30" height="30" alt="<?php echo htmlspecialchars($author_name); ?>">
                        <span><?php echo $author_name; ?></span>
                    </div>
                </div>

                <!-- Publisher Section (if different from author) -->
                <?php 
                    $same_user = ($page[0]['createdby'] == $page[0]['activatedby']) && $page[0]['isactive'];
                    if(!$same_user && $page[0]['isactive']): 
                ?>
                    <div class="mb-2">
                        <small class="text-muted">Publisher</small>
                        <div class="d-flex align-items-center">
                            <?php
                                $publisher = isset($user_lookup[$page[0]['activatedby']]) ? $user_lookup[$page[0]['activatedby']] : null;
                                $publisher_name = $publisher ? htmlspecialchars($publisher['username']) : 'System';
                                $publisher_image = $publisher && !empty($publisher['profile_pic']) ? 
                                    BASE_URL.ABSOLUTE_IMAGEPATH.$publisher['profile_pic'] : 
                                    'https://ui-avatars.com/api/?name='.urlencode($publisher_name).'&size=30';
                            ?>
                            <img src="<?php echo htmlspecialchars($publisher_image); ?>" class="rounded-circle mr-2" width="30" height="30" alt="<?php echo htmlspecialchars($publisher_name); ?>">
                            <span><?php echo $publisher_name; ?></span>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>