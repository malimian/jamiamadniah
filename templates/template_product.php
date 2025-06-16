<?php
$GLOBALS['content'] = $content;

// print_r($content);

if(!function_exists("header_t")) {
    function header_t(){
        return '
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
            <link href="css/templates/template_general.css" rel="stylesheet">
            <meta property="og:site_name" content="'.SITE_TITLE.'">
            <meta property="og:title" content="'.replace_sysvari($GLOBALS['content']['page_title']).'" />
            <meta property="og:description" content="'.replace_sysvari($GLOBALS['content']['page_title']).'" />
            <meta property="og:image" itemprop="image" content="'.BASE_URL.ABSOLUTE_IMAGEPATH.$GLOBALS['content']['featured_image'].'">   
            ';
    }
}
?>

<?php
if(!function_exists("footer_t")) {
    function footer_t(){
        return '
        <script src="https://cdn.jsdelivr.net/npm/fslightbox@3.3.1/index.min.js"></script>
        ';
    }
}
?>

<style>
    .product-header {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }
    
    .icon-hover {
        border-radius: 0.25rem !important;
        transition: all 0.3s ease;
    }
    
    .icon-hover:hover {
        border-color: #3b71ca !important;
        background-color: white !important;
        color: #3b71ca !important;
    }
    
    .icon-hover:hover i {
        color: #3b71ca !important;
    }
    
    .nav-pills .nav-link.active {
        background-color: #3b71ca;
    }
    
    .product-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 1;
    }
    
    .thumbnail-container {
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .thumbnail-container:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .product-title {
        font-weight: 700;
        color: #2c3e50;
    }
    
    .price-text {
        font-size: 1.5rem;
        font-weight: 700;
        color: #3b71ca;
    }
    
    .original-price {
        text-decoration: line-through;
        color: #6c757d;
    }
    
    .tab-content {
        padding: 20px;
        background: #fff;
        border-left: 1px solid #dee2e6;
        border-right: 1px solid #dee2e6;
        border-bottom: 1px solid #dee2e6;
    }
    
    .attribute-label {
        font-weight: 600;
        color: #495057;
    }
    
    .attribute-value {
        color: #212529;
    }
    
    .similar-item-card {
        transition: transform 0.3s ease;
    }
    
    .similar-item-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    /* Color swatches */
    .color-swatch {
        display: inline-block;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        margin-right: 5px;
        border: 1px solid #ddd;
    }
</style>

<header class="product-header">
    <div class="container py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo BASE_URL.'/'.$content['cat_url']; ?>" class="text-decoration-none"><?php echo $content['catname']; ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo replace_sysvari($content['page_title']); ?></li>
            </ol>
        </nav>
    </div>
</header>

<section class="py-5">
    <div class="container">
        <div class="row gx-5">
            <aside class="col-lg-6">
                <div class="border rounded-4 mb-3 d-flex justify-content-center position-relative">
                    <?php 
                    // Display product badges based on flags
                    $flags = $content['attributes'][4]['sections'] ?? [];
                    foreach($flags as $flagSection) {
                        foreach($flagSection['attributes'] as $attribute) {
                            if($attribute['current_value'] == 1) {
                                $badgeClass = 'bg-primary';
                                if($attribute['attribute_label'] == 'New Arrival') $badgeClass = 'bg-danger';
                                if($attribute['attribute_label'] == 'On Sale') $badgeClass = 'bg-success';
                                echo '<span class="product-badge badge '.$badgeClass.'">'.$attribute['attribute_label'].'</span>';
                            }
                        }
                    }
                    ?>
                    
                    <a data-fslightbox="mygalley" class="rounded-4" target="_blank" data-type="image" href="<?php echo ABSOLUTE_IMAGEPATH.$content['featured_image']; ?>">
                        <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit img-fluid" src="<?php echo ABSOLUTE_IMAGEPATH.$content['featured_image']; ?>" alt="<?php echo replace_sysvari($content['page_title']); ?>" />
                    </a>
                </div>
                
                <div class="d-flex justify-content-center mb-3 flex-wrap">
                    <a data-fslightbox="mygalley" class="border mx-1 rounded-2 thumbnail-container" target="_blank" data-type="image" href="<?php echo ABSOLUTE_IMAGEPATH.$content['featured_image']; ?>">
                        <img width="60" height="60" class="rounded-2" src="<?php echo ABSOLUTE_IMAGEPATH.$content['featured_image']; ?>" alt="Thumbnail" />
                    </a>
                    <?php
                    $photogallery = return_multiple_rows("Select * from images Where pid = ".$content['pid']." and isactive = 1 and soft_delete = 0");
                    if(!empty($photogallery)){
                        foreach($photogallery as $photogallery_){
                    ?>
                        <a data-fslightbox="mygalley" class="border mx-1 rounded-2 thumbnail-container" target="_blank" data-type="image" href="photo_gallery/<?php echo $photogallery_['i_name']; ?>">
                            <img width="60" height="60" class="rounded-2" alt="<?php echo $photogallery_['i_name']; ?>" src="photo_gallery/<?php echo $photogallery_['i_name']; ?>" />
                        </a>
                    <?php }} ?>
                </div>
            </aside>
            
            <main class="col-lg-6">
                <div class="ps-lg-3">
                    <h1 class="product-title mb-3"><?php echo replace_sysvari($content['page_title']); ?></h1>
                    
                    <div class="d-flex flex-row align-items-center mb-3">
                        <div class="text-warning mb-1 me-3">
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
                    
                    <div class="mb-4">
                        <?php 
                        $price = $content['attributes'][2]['sections']['Price']['attributes'][8]['current_value'] ?? 0;
                        $discountPrice = $content['attributes'][2]['sections']['Discount Price']['attributes'][9]['current_value'] ?? 0;
                        
                        if($discountPrice > 0 && $discountPrice < $price): ?>
                            <span class="price-text"><?php echo CURRENCY; ?> <?php echo number_format($discountPrice, 2); ?></span>
                            <span class="original-price ms-2"><?php echo CURRENCY; ?> <?php echo number_format($price, 2); ?></span>
                            <span class="badge bg-danger ms-2">Save <?php echo round(100 - ($discountPrice / $price * 100)); ?>%</span>
                        <?php else: ?>
                            <span class="price-text"><?php echo CURRENCY; ?> <?php echo number_format($price, 2); ?></span>
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
                                            echo '<div class="col-md-6 mb-2">';
                                            echo '<span class="attribute-label">Color:</span> ';
                                            echo '<span class="attribute-value">';
                                            
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
                                            echo '<div class="col-md-6 mb-2">';
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
                                        echo '<div class="col-md-6 mb-2">';
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
                                              <div class="col-md-4 col-6 mb-3">
                                                  <label class="form-label"><?= htmlspecialchars($attribute['attribute_label']) ?></label>
                                                  <select class="form-select border border-secondary" name="<?= htmlspecialchars($attribute['attribute_label']) ?>">
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
                      
                      <div class="col-md-4 col-6 mb-3">
                          <label class="form-label d-block">Quantity</label>
                          <div class="input-group" style="width: 140px;">
                              <button class="btn btn-outline-secondary" type="button" id="button-addon1">
                                  <i class="fas fa-minus"></i>
                              </button>
                              <input type="text" class="form-control text-center border-secondary" value="1" aria-label="Quantity">
                              <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                                  <i class="fas fa-plus"></i>
                              </button>
                          </div>
                      </div>
                  </div>
                    
                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <a href="#" class="btn btn-primary py-2 px-4 icon-hover">
                            <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                        </a>
                        <a href="#" class="btn btn-outline-primary py-2 px-4 icon-hover">
                            Buy Now
                        </a>
                        <a href="#" class="btn btn-outline-secondary py-2 px-3 icon-hover" title="Add to Wishlist">
                            <i class="far fa-heart"></i>
                        </a>
                    </div>
                    
                    <div class="d-flex align-items-center mb-4">
                        <div class="me-3">
                            <i class="fas fa-shield-alt text-muted me-2"></i>
                            <span class="small">1 Year Warranty</span>
                        </div>
                        <div class="me-3">
                            <i class="fas fa-truck text-muted me-2"></i>
                            <span class="small">Free Shipping</span>
                        </div>
                        <div>
                            <i class="fas fa-undo text-muted me-2"></i>
                            <span class="small">Easy Returns</span>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</section>

<section class="bg-light border-top py-5">
    <div class="container">
        <div class="row gx-4">
            <div class="col-lg-8 mb-4">
                <div class="border rounded-2 overflow-hidden bg-white">
                    <ul class="nav nav-pills nav-justified mb-0" id="productTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="description-tab" data-bs-toggle="pill" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="specifications-tab" data-bs-toggle="pill" data-bs-target="#specifications" type="button" role="tab" aria-controls="specifications" aria-selected="false">Specifications</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="shipping-tab" data-bs-toggle="pill" data-bs-target="#shipping" type="button" role="tab" aria-controls="shipping" aria-selected="false">Shipping & Returns</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reviews-tab" data-bs-toggle="pill" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Reviews</button>
                        </li>
                    </ul>
                    
                    <div class="tab-content p-4" id="productTabsContent">
                        <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                            <h5 class="mb-3">About This Product</h5>
                            <?php echo replace_sysvari($content['page_desc'], getcwd()."/"); ?>
                            
                            <?php 
                            $features = $content['attributes'][2]['sections']['Features']['attributes'][16]['current_value'] ?? '';
                            if(!empty($features)): ?>
                                <h5 class="mt-4 mb-3">Key Features</h5>
                                <?php echo nl2br($features); ?>
                            <?php endif; ?>
                        </div>
                        
                        <div class="tab-pane fade" id="specifications" role="tabpanel" aria-labelledby="specifications-tab">
                            <h5 class="mb-4">Technical Specifications</h5>
                            <div class="row">
                                <?php 
                                // Display all attributes with values in specifications tab
                                foreach($content['attributes'] as $tab) {
                                    foreach($tab['sections'] as $section) {
                                        foreach($section['attributes'] as $attribute) {
                                            // Skip if no current value or if it's a system field
                                            if(empty($attribute['current_value']) || 
                                               in_array($attribute['attribute_label'], ['Price', 'Discount Price', 'Product image'])) {
                                                continue;
                                            }
                                            
                                            echo '<div class="col-md-6 mb-3">';
                                            echo '<div class="d-flex">';
                                            echo '<span class="attribute-label me-2">'.$attribute['attribute_label'].':</span>';
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
                                            echo '</div>';
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                            <h5 class="mb-3">Shipping Information</h5>
                            <?php 
                            $shippingInfo = $content['attributes'][3]['sections']['Shipping Information']['attributes'][18]['current_value'] ?? '';
                            if(!empty($shippingInfo)): ?>
                                <?php echo nl2br($shippingInfo); ?>
                            <?php else: ?>
                                <p>We offer free standard shipping on all orders. Delivery typically takes 3-5 business days.</p>
                                <p>Express shipping options are available at checkout for an additional fee.</p>
                            <?php endif; ?>
                            
                            <h5 class="mt-4 mb-3">Return Policy</h5>
                            <?php 
                            $returnPolicy = $content['attributes'][3]['sections']['Return/Refund Policy']['attributes'][19]['current_value'] ?? '';
                            if(!empty($returnPolicy)): ?>
                                <?php echo nl2br($returnPolicy); ?>
                            <?php else: ?>
                                <p>We accept returns within 30 days of purchase. Items must be in original condition with all tags attached.</p>
                                <p>To initiate a return, please contact our customer service team.</p>
                            <?php endif; ?>
                        </div>
                        
                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <h5 class="mb-4">Customer Reviews</h5>
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="text-warning me-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <span class="fw-bold">4.5 out of 5</span>
                                </div>
                                <p class="text-muted">Based on 24 reviews</p>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <span class="me-2">5 stars</span>
                                        <div class="progress flex-grow-1" style="height: 8px;">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="ms-2">18</span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <span class="me-2">4 stars</span>
                                        <div class="progress flex-grow-1" style="height: 8px;">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 15%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="ms-2">4</span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <span class="me-2">3 stars</span>
                                        <div class="progress flex-grow-1" style="height: 8px;">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 5%;" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="ms-2">1</span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <span class="me-2">2 stars</span>
                                        <div class="progress flex-grow-1" style="height: 8px;">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 3%;" aria-valuenow="3" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="ms-2">1</span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <span class="me-2">1 star</span>
                                        <div class="progress flex-grow-1" style="height: 8px;">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 2%;" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="ms-2">0</span>
                                    </div>
                                </div>
                            </div>
                            
                            <button class="btn btn-outline-primary mt-3">Write a Review</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Similar Products</h5>
                        
                        <?php 
                        $latest_posts = return_multiple_rows("Select * from pages Where soft_delete = 0 and isactive = 1 and catid = ".$content['catid']." Order by createdon DESC LIMIT 0 , 5 ");
                        foreach ($latest_posts as $latest_post) {
                            if($latest_post['pid'] == $content['pid']) continue; // Skip current product
                        ?>
                        <div class="d-flex mb-3 similar-item-card">
                            <a href="<?php echo $latest_post['page_url']; ?>" class="me-3 flex-shrink-0">
                                <img src="<?php echo ABSOLUTE_IMAGEPATH.$latest_post['featured_image']; ?>" alt="<?php echo $latest_post['page_title']; ?>" style="width: 80px; height: 80px;" class="img-thumbnail" />
                            </a>
                            <div class="flex-grow-1">
                                <a href="<?php echo $latest_post['page_url']; ?>" class="text-decoration-none">
                                    <h6 class="mb-1"><?php echo $latest_post['page_title']; ?></h6>
                                </a>
                                <div class="text-warning small mb-1">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong class="text-dark"><?php echo CURRENCY; ?> <?php //echo $latest_post['plistprice']; ?></strong>
                                    <a href="#" class="btn btn-sm btn-outline-primary">Add</a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        
                        <a href="<?php echo BASE_URL.'/'.$content['cat_url']; ?>" class="btn btn-outline-secondary w-100 mt-3">View All</a>
                    </div>
                </div>
                
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Why Choose Us</h5>
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0 text-primary me-3">
                                <i class="fas fa-truck fa-lg"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Free Shipping</h6>
                                <p class="small text-muted mb-0">On all orders over $50</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0 text-primary me-3">
                                <i class="fas fa-undo fa-lg"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Easy Returns</h6>
                                <p class="small text-muted mb-0">30-day return policy</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0 text-primary me-3">
                                <i class="fas fa-shield-alt fa-lg"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Secure Payment</h6>
                                <p class="small text-muted mb-0">100% secure payment</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="flex-shrink-0 text-primary me-3">
                                <i class="fas fa-headset fa-lg"></i>
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