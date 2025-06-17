<?php
$GLOBALS['content'] = $content;

if(!function_exists("header_t")) {
    function header_t(){
        return '
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
            <link href="css/templates/template_product.css" rel="stylesheet">
            ';
    }
}
?>

<?php
if(!function_exists("footer_t")) {
    function footer_t(){
        return '
        <script src="https://cdn.jsdelivr.net/npm/fslightbox@3.3.1/index.min.js"></script>
        <script>
            // Quantity selector functionality
            document.querySelectorAll(".quantity-btn").forEach(btn => {
                btn.addEventListener("click", function() {
                    const input = this.parentNode.querySelector(".quantity-input");
                    let value = parseInt(input.value);
                    if(this.classList.contains("decrement")) {
                        value = value > 1 ? value - 1 : 1;
                    } else {
                        value = value + 1;
                    }
                    input.value = value;
                });
            });
        </script>
        ';
    }
}
?>

<header class="product-header py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo BASE_URL.'/'.$content['cat_url']; ?>"><?php echo $content['catname']; ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo replace_sysvari($content['page_title']); ?></li>
            </ol>
        </nav>
    </div>
</header>

<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Product Gallery -->
            <div class="col-lg-6">
                <div class="main-image-container mb-3 position-relative">
                    <div class="product-badge-wrapper">
                        <?php 
                        // Display product badges based on flags
                        $flags = $content['attributes'][4]['sections'] ?? [];
                        foreach($flags as $flagSection) {
                            foreach($flagSection['attributes'] as $attribute) {
                                if($attribute['current_value'] == 1) {
                                    $badgeClass = 'bg-primary';
                                    if($attribute['attribute_label'] == 'New Arrival') $badgeClass = 'bg-danger';
                                    if($attribute['attribute_label'] == 'On Sale') $badgeClass = 'bg-success';
                                    echo '<span class="product-badge '.$badgeClass.'">'.$attribute['attribute_label'].'</span>';
                                }
                            }
                        }
                        ?>
                    </div>
                    
                    <a data-fslightbox="product-gallery" class="d-block" href="<?php echo ABSOLUTE_IMAGEPATH.$content['featured_image']; ?>">
                        <img class="img-fluid w-100" src="<?php echo ABSOLUTE_IMAGEPATH.$content['featured_image']; ?>" alt="<?php echo replace_sysvari($content['page_title']); ?>">
                    </a>
                </div>
                
                <div class="thumbnail-gallery d-flex flex-wrap gap-2">
                    <a data-fslightbox="product-gallery" class="thumbnail-container" href="<?php echo ABSOLUTE_IMAGEPATH.$content['featured_image']; ?>">
                        <img width="80" height="80" src="<?php echo ABSOLUTE_IMAGEPATH.$content['featured_image']; ?>" alt="Thumbnail">
                    </a>
                    <?php
                    $photogallery = return_multiple_rows("Select * from images Where pid = ".$content['pid']." and isactive = 1 and soft_delete = 0");
                    if(!empty($photogallery)){
                        foreach($photogallery as $photogallery_){
                    ?>
                        <a data-fslightbox="product-gallery" class="thumbnail-container" href="<?php echo ABSOLUTE_IMAGEPATH.$photogallery_['i_name']; ?>">
                            <img width="80" height="80" src="<?php echo ABSOLUTE_IMAGEPATH.$photogallery_['i_name']; ?>" alt="<?php echo $photogallery_['i_name']; ?>">
                        </a>
                    <?php }} ?>
                </div>
            </div>
            
            <!-- Product Details -->
            <div class="col-lg-6">
                <div class="ps-lg-4">
                    <h1 class="product-title"><?php echo replace_sysvari($content['page_title']); ?></h1>
                    
                    <div class="d-flex align-items-center mb-3">
                        <div class="text-warning me-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span class="ms-1 text-dark">4.5</span>
                        </div>
                        <span class="text-muted me-3"><i class="fas fa-barcode fa-sm mx-1"></i><?php echo $content['attributes'][1]['sections']['SKU']['attributes'][3]['current_value']; ?></span>
                        <?php if($content['attributes'][4]['sections']['Stock Status']['attributes'][323]['current_value'] == 1): ?>
                            <span class="text-success"><i class="fas fa-check-circle me-1"></i>In stock</span>
                        <?php else: ?>
                            <span class="text-danger"><i class="fas fa-times-circle me-1"></i>Out of stock</span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="price-container">
                        <?php 
                        $price = $content['attributes'][2]['sections']['Price']['attributes'][8]['current_value'] ?? 0;
                        $discountPrice = $content['attributes'][2]['sections']['Discount Price']['attributes'][9]['current_value'] ?? 0;
                        
                        if($discountPrice > 0 && $discountPrice < $price): ?>
                            <span class="current-price"><?php echo CURRENCY; ?><?php echo number_format($discountPrice, 2); ?></span>
                            <span class="original-price"><?php echo CURRENCY; ?><?php echo number_format($price, 2); ?></span>
                            <span class="badge bg-danger discount-badge">Save <?php echo round(100 - ($discountPrice / $price * 100)); ?>%</span>
                        <?php else: ?>
                            <span class="current-price"><?php echo CURRENCY; ?><?php echo number_format($price, 2); ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mb-4">
                        <h5 class="mb-3">Product Details</h5>
                        <div class="row">
                            <?php 
                            // Display product attributes that have values
                            foreach($content['attributes'] as $tab) {
                                foreach($tab['sections'] as $section) {
                                    foreach($section['attributes'] as $attribute) {
                                        // Skip if no current value or if it's a system field
                                        if(empty($attribute['current_value']) || 
                                           in_array($attribute['attribute_label'], ['Price', 'Discount Price', 'Product image'])) {
                                            continue;
                                        }
                                        
                                        // Special handling for color attribute
                                        if($attribute['attribute_label'] == 'Color') {
                                            echo '<div class="col-md-6 mb-3">';
                                            echo '<span class="attribute-label">Color:</span> ';
                                            echo '<span class="attribute-value align-items-center">';
                                            
                                            // Handle multiple colors if comma separated
                                            $colors = explode(',', $attribute['current_value']);
                                            foreach($colors as $color) {
                                                $color = trim($color);
                                                $colorName = ucfirst($color);
                                                // Find the color in options to get the proper label
                                                foreach($attribute['options'] as $option) {
                                                    if($option['option_value'] == $color) {
                                                        $colorName = $option['option_label'];
                                                        break;
                                                    }
                                                }
                                                echo '<span class="color-swatch" style="background-color: '.$color.'" title="'.$colorName.'"></span>';
                                            }
                                            
                                            echo '</span>';
                                            echo '</div>';
                                            continue;
                                        }
                                        
                                        // Special handling for size attribute
                                        if($attribute['attribute_label'] == 'Size') {
                                            echo '<div class="col-md-6 mb-3">';
                                            echo '<span class="attribute-label">Available Sizes:</span> ';
                                            echo '<span class="attribute-value">';
                                            
                                            // Handle multiple sizes if comma separated
                                            $sizes = explode(',', $attribute['current_value']);
                                            $sizeLabels = [];
                                            foreach($sizes as $size) {
                                                $size = trim($size);
                                                // Find the size in options to get the proper label
                                                foreach($attribute['options'] as $option) {
                                                    if($option['option_value'] == $size) {
                                                        $sizeLabels[] = $option['option_label'];
                                                        break;
                                                    }
                                                }
                                            }
                                            echo implode(', ', $sizeLabels);
                                            echo '</span>';
                                            echo '</div>';
                                            continue;
                                        }
                                        
                                        // Default attribute display
                                        echo '<div class="col-md-6 mb-3">';
                                        echo '<span class="attribute-label">'.$attribute['attribute_label'].':</span> ';
                                        echo '<span class="attribute-value">';
                                        
                                        // Handle select/multiselect options
                                        if(in_array($attribute['attribute_type'], ['select', 'multiselect'])) {
                                            $values = explode(',', $attribute['current_value']);
                                            $valueLabels = [];
                                            foreach($values as $value) {
                                                $value = trim($value);
                                                // Find the value in options to get the proper label
                                                foreach($attribute['options'] as $option) {
                                                    if($option['option_value'] == $value) {
                                                        $valueLabels[] = $option['option_label'];
                                                        break;
                                                    }
                                                }
                                            }
                                            echo implode(', ', $valueLabels);
                                        } else {
                                            // For other types, just display the value
                                            echo $attribute['current_value'];
                                        }
                                        
                                        echo '</span>';
                                        echo '</div>';
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <!-- Variants and Quantity -->
                    <div class="row mb-4">
                        <?php 
                        // Loop through all sections
                        foreach($content['attributes'] as $tab) {
                            if(isset($tab['sections'])) {
                                foreach($tab['sections'] as $section) {
                                    if(isset($section['attributes'])) {
                                        foreach($section['attributes'] as $attribute) {
                                            // Check if attribute has options and current_value is not empty
                                            if(!empty($attribute['options']) && !empty($attribute['current_value'])) {
                                                $availableValues = explode(',', $attribute['current_value']);
                                                ?>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold mb-2"><?= htmlspecialchars($attribute['attribute_label']) ?></label>
                                                    <select class="form-select border-2 py-2">
                                                        <?php 
                                                        foreach($availableValues as $valueCode) {
                                                            $valueCode = trim($valueCode);
                                                            $valueLabel = $valueCode;
                                                            // Find the matching option to get the proper label
                                                            foreach($attribute['options'] as $option) {
                                                                if($option['option_value'] == $valueCode) {
                                                                    $valueLabel = $option['option_label'];
                                                                    break;
                                                                }
                                                            }
                                                            echo '<option value="'.htmlspecialchars($valueCode).'">'.htmlspecialchars($valueLabel).'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <?php
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        ?>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold mb-2">Quantity</label>
                            <div class="input-group quantity-selector">
                                <button class="btn quantity-btn decrement" type="button">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="text" class="form-control text-center quantity-input" value="1">
                                <button class="btn quantity-btn increment" type="button">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <button class="btn btn-primary action-btn flex-grow-1">
                            <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                        </button>
                        <button class="btn btn-outline-primary action-btn flex-grow-1">
                            <i class="fas fa-bolt me-2"></i> Buy Now
                        </button>
                        <button class="wishlist-btn" title="Add to Wishlist">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                    
                    <!-- Product Benefits -->
                    <div class="d-flex flex-wrap gap-4 mb-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-light rounded-circle p-2 me-2">
                                <i class="fas fa-shield-alt text-primary"></i>
                            </div>
                            <span class="small">1 Year Warranty</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="bg-light rounded-circle p-2 me-2">
                                <i class="fas fa-truck text-primary"></i>
                            </div>
                            <span class="small">Free Shipping</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="bg-light rounded-circle p-2 me-2">
                                <i class="fas fa-undo text-primary"></i>
                            </div>
                            <span class="small">Easy Returns</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Product Tabs Section -->
<section class="pb-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="bg-white rounded-3 overflow-hidden">
                    <ul class="nav product-tabs" id="productTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="description-tab" data-bs-toggle="pill" data-bs-target="#description" type="button" role="tab">
                                <i class="fas fa-file-alt me-2"></i>Description
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="specifications-tab" data-bs-toggle="pill" data-bs-target="#specifications" type="button" role="tab">
                                <i class="fas fa-list-ul me-2"></i>Specifications
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="shipping-tab" data-bs-toggle="pill" data-bs-target="#shipping" type="button" role="tab">
                                <i class="fas fa-truck me-2"></i>Shipping & Returns
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reviews-tab" data-bs-toggle="pill" data-bs-target="#reviews" type="button" role="tab">
                                <i class="fas fa-star me-2"></i>Reviews
                            </button>
                        </li>
                    </ul>
                    
                    <div class="tab-content p-4" id="productTabsContent">
                        <!-- Description Tab -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <h5 class="mb-4"><i class="fas fa-file-alt text-primary me-2"></i>About This Product</h5>
                            <div class="description-content">
                                <?php echo replace_sysvari($content['page_desc'], getcwd()."/"); ?>
                            </div>
                            
                            <?php 
                            $features = $content['attributes'][2]['sections']['Features']['attributes'][16]['current_value'] ?? '';
                            if(!empty($features)): ?>
                                <h5 class="mt-5 mb-4"><i class="fas fa-star text-primary me-2"></i>Key Features</h5>
                                <ul class="feature-list list-unstyled">
                                    <?php 
                                    $featureItems = explode("\n", $features);
                                    foreach($featureItems as $item):
                                        if(trim($item) != ''): ?>
                                            <li>
                                                <i class="fas fa-check-circle"></i>
                                                <span><?php echo trim($item); ?></span>
                                            </li>
                                        <?php endif;
                                    endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Specifications Tab -->
                        <div class="tab-pane fade" id="specifications" role="tabpanel">
                            <h5 class="mb-4"><i class="fas fa-list-ul text-primary me-2"></i>Technical Specifications</h5>
                            <div class="row">
                                <?php 
                                foreach($content['attributes'] as $tab) {
                                    foreach($tab['sections'] as $section) {
                                        $hasSectionContent = false;
                                        $sectionContent = '';
                                        
                                        foreach($section['attributes'] as $attribute) {
                                            if(empty($attribute['current_value']) || 
                                               in_array($attribute['attribute_label'], ['Price', 'Discount Price', 'Product image'])) {
                                                continue;
                                            }
                                            
                                            $hasSectionContent = true;
                                            $sectionContent .= '<div class="col-md-6 mb-3">';
                                            $sectionContent .= '<div class="d-flex align-items-start">';
                                            $sectionContent .= '<span class="attribute-label">'.$attribute['attribute_label'].':</span>';
                                            $sectionContent .= '<span class="attribute-value">';
                                            
                                            if(in_array($attribute['attribute_type'], ['select', 'multiselect'])) {
                                                $values = explode(',', $attribute['current_value']);
                                                $valueLabels = [];
                                                foreach($values as $value) {
                                                    $value = trim($value);
                                                    foreach($attribute['options'] as $option) {
                                                        if($option['option_value'] == $value) {
                                                            $valueLabels[] = $option['option_label'];
                                                            break;
                                                        }
                                                    }
                                                }
                                                $sectionContent .= implode(', ', $valueLabels);
                                            } else {
                                                $sectionContent .= $attribute['current_value'];
                                            }
                                            
                                            $sectionContent .= '</span>';
                                            $sectionContent .= '</div>';
                                            $sectionContent .= '</div>';
                                        }
                                        
                                        if($hasSectionContent) {
                                            echo '<div class="spec-section mb-4">';
                                            echo '<h6 class="section-title mb-3">'.$section['section_name'].'</h6>';
                                            echo '<div class="row">';
                                            echo $sectionContent;
                                            echo '</div>';
                                            echo '</div>';
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        
                        <!-- Shipping Tab -->
                        <div class="tab-pane fade" id="shipping" role="tabpanel">
                            <h5 class="mb-4"><i class="fas fa-truck text-primary me-2"></i>Shipping Information</h5>
                            <div class="bg-light p-4 rounded mb-4">
                                <?php 
                                $shippingInfo = $content['attributes'][3]['sections']['Shipping Information']['attributes'][18]['current_value'] ?? '';
                                if(!empty($shippingInfo)): ?>
                                    <?php echo nl2br($shippingInfo); ?>
                                <?php else: ?>
                                    <p class="mb-2"><i class="fas fa-shipping-fast text-success me-2"></i> We offer free standard shipping on all orders.</p>
                                    <p class="mb-2"><i class="far fa-clock text-info me-2"></i> Delivery typically takes 3-5 business days.</p>
                                    <p><i class="fas fa-bolt text-warning me-2"></i> Express shipping options are available at checkout for an additional fee.</p>
                                <?php endif; ?>
                            </div>
                            
                            <h5 class="mt-5 mb-4"><i class="fas fa-exchange-alt text-primary me-2"></i>Return Policy</h5>
                            <div class="bg-light p-4 rounded">
                                <?php 
                                $returnPolicy = $content['attributes'][3]['sections']['Return/Refund Policy']['attributes'][19]['current_value'] ?? '';
                                if(!empty($returnPolicy)): ?>
                                    <?php echo nl2br($returnPolicy); ?>
                                <?php else: ?>
                                    <p class="mb-2"><i class="far fa-calendar-check text-success me-2"></i> We accept returns within 30 days of purchase.</p>
                                    <p class="mb-2"><i class="fas fa-tag text-primary me-2"></i> Items must be in original condition with all tags attached.</p>
                                    <p><i class="fas fa-headset text-info me-2"></i> To initiate a return, please contact our customer service team.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <!-- Reviews Tab -->
                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <h5 class="mb-4"><i class="fas fa-star text-primary me-2"></i>Customer Reviews</h5>
                            <div class="reviews-content">
                                {comments}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Similar Products -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Similar Products</h5>
                        
                        <?php 
                        $latest_posts = return_multiple_rows("Select * from pages Where soft_delete = 0 and isactive = 1 and catid = ".$content['catid']." Order by createdon DESC LIMIT 0 , 5 ");
                        foreach ($latest_posts as $latest_post) {
                            if($latest_post['pid'] == $content['pid']) continue; // Skip current product
                        ?>
                        <div class="card similar-product-card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="<?php echo ABSOLUTE_IMAGEPATH.$latest_post['featured_image']; ?>" class="img-fluid rounded-start similar-product-img" alt="<?php echo $latest_post['page_title']; ?>">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h6 class="card-title mb-1">
                                            <a href="<?php echo $latest_post['page_url']; ?>" class="text-decoration-none text-dark"><?php echo $latest_post['page_title']; ?></a>
                                        </h6>
                                        <div class="text-warning mb-2 small">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <strong class="text-primary"><?php echo CURRENCY; ?> <?php //echo $latest_post['plistprice']; ?></strong>
                                            <button class="btn btn-sm btn-outline-primary">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        
                        <a href="<?php echo BASE_URL.'/'.$content['cat_url']; ?>" class="btn btn-outline-primary w-100 mt-3">View All Products</a>
                    </div>
                </div>
                
                <!-- Why Choose Us -->
                <div class="card benefit-card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Why Choose Us</h5>
                        
                        <div class="benefit-item d-flex">
                            <div class="benefit-icon">
                                <i class="fas fa-truck"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Free Shipping</h6>
                                <p class="small text-muted mb-0">On all orders over $50</p>
                            </div>
                        </div>
                        
                        <div class="benefit-item d-flex">
                            <div class="benefit-icon">
                                <i class="fas fa-undo"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Easy Returns</h6>
                                <p class="small text-muted mb-0">30-day return policy</p>
                            </div>
                        </div>
                        
                        <div class="benefit-item d-flex">
                            <div class="benefit-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Secure Payment</h6>
                                <p class="small text-muted mb-0">100% secure payment</p>
                            </div>
                        </div>
                        
                        <div class="benefit-item d-flex">
                            <div class="benefit-icon">
                                <i class="fas fa-headset"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">24/7 Support</h6>
                                <p class="small text-muted mb-0">Dedicated support</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>