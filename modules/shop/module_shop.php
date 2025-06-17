<!-- Shop Section Start -->
<div class="shop-section py-5 bg-light">
    <div class="container">
        <div class="shop-section-header d-flex justify-content-between align-items-center mb-5">
            <h2 class="display-5 fw-bold text-dark mb-0">Shop</h2>
            <a href="<?php echo BASE_URL; ?>products.html" class="btn btn-primary rounded-pill px-4">
                View All <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
        
        <div class="row g-4">
            <?php
            $featured_products = return_multiple_rows("SELECT * FROM pages WHERE isactive = 1 AND soft_delete = 0 
                AND catid = 131 and template_id = 4 ORDER BY createdon DESC LIMIT 5");
            
            if (!empty($featured_products)) {
                $main_featured = array_shift($featured_products);
                $price = $main_featured['attributes'][2]['sections']['Price']['attributes'][8]['current_value'] ?? 0;
                $discountPrice = $main_featured['attributes'][2]['sections']['Discount Price']['attributes'][9]['current_value'] ?? 0;
                $inStock = $main_featured['attributes'][4]['sections']['Stock Status']['attributes'][323]['current_value'] ?? 0;
            ?>
            <!-- Featured Product -->
            <div class="col-lg-12 mb-4">
                <div class="featured-product-card card border-0 shadow-lg overflow-hidden h-100">
                    <div class="row g-0 h-100">
                        <div class="col-md-6">
                            <div class="position-relative h-100">
                                <img src="<?php echo getFullImageUrl($main_featured['featured_image']); ?>" 
                                     class="img-fluid h-100 w-100 object-cover" 
                                     alt="<?php echo htmlspecialchars($main_featured['page_title']); ?>">
                                <div class="position-absolute top-0 start-0 bg-primary text-white px-3 py-2">
                                    Featured Product
                                </div>
                                <?php if($discountPrice > 0 && $discountPrice < $price): ?>
                                <div class="position-absolute top-0 end-0 bg-danger text-white px-3 py-2">
                                    <?php echo round(100 - ($discountPrice / $price * 100)); ?>% OFF
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body d-flex flex-column h-100 p-4 p-lg-5">
                                <div class="mb-3">
                                    <span class="badge bg-opacity-10 text-primary me-2">Bestseller</span>
                                    <small class="text-muted">
                                        <i class="fas fa-barcode me-1"></i>
                                        <?php echo $main_featured['attributes'][1]['sections']['SKU']['attributes'][3]['current_value'] ?? 'N/A'; ?>
                                    </small>
                                </div>
                                <h2 class="card-title mb-3">
                                    <a href="<?php echo $main_featured['page_url']; ?>" 
                                       class="text-dark text-decoration-none stretched-link">
                                        <?php echo $main_featured['page_title']; ?>
                                    </a>
                                </h2>
                                <div class="product-price mb-3">
                                    <?php if($discountPrice > 0 && $discountPrice < $price): ?>
                                        <span class="current-price h4"><?php echo CURRENCY.number_format($discountPrice, 2); ?></span>
                                        <span class="original-price"><?php echo CURRENCY.number_format($price, 2); ?></span>
                                    <?php else: ?>
                                        <span class="current-price h4"><?php echo CURRENCY.number_format($price, 2); ?></span>
                                    <?php endif; ?>
                                </div>
                                <p class="card-text flex-grow-1 text-muted">
                                    <?php echo mb_strimwidth(strip_tags($main_featured['page_desc']), 0, 200, "..."); ?>
                                </p>
                                
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <span class="<?php echo $inStock ? 'text-success' : 'text-danger'; ?>">
                                            <i class="fas fa-<?php echo $inStock ? 'check' : 'times'; ?>-circle me-1"></i>
                                            <?php echo $inStock ? 'In Stock' : 'Out of Stock'; ?>
                                        </span>
                                    </div>
                                    <div>
                                        <?php if($inStock): ?>
                                            <button class="btn btn-sm btn-primary">
                                                <i class="fas fa-shopping-cart me-1"></i> Add to Cart
                                            </button>
                                        <?php else: ?>
                                            <button class="btn btn-sm btn-outline-secondary" disabled>
                                                <i class="fas fa-bell me-1"></i> Notify Me
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            
            <!-- Regular Products Grid -->
            <?php foreach (array_chunk($featured_products, 2) as $product_group): ?>
            <div class="col-lg-6">
                <div class="row g-4">
                    <?php foreach ($product_group as $product): 
                        $price = $product['attributes'][2]['sections']['Price']['attributes'][8]['current_value'] ?? 0;
                        $discountPrice = $product['attributes'][2]['sections']['Discount Price']['attributes'][9]['current_value'] ?? 0;
                        $inStock = $product['attributes'][4]['sections']['Stock Status']['attributes'][323]['current_value'] ?? 0;
                        $isNew = $product['attributes'][4]['sections']['New Arrival']['attributes'][20]['current_value'] ?? 0;
                    ?>
                    <div class="col-md-6">
                        <div class="product-card card border-0 shadow-sm h-100">
                            <div class="position-relative">
                                <img src="<?php echo getFullImageUrl($product['featured_image']); ?>" 
                                     class="card-img-top img-fluid" 
                                     alt="<?php echo htmlspecialchars($product['page_title']); ?>">
                                <div class="card-img-overlay d-flex align-items-start justify-content-between">
                                    <?php if($isNew): ?>
                                    <span class="badge bg-danger">
                                        <small>New</small>
                                    </span>
                                    <?php endif; ?>
                                    <?php if($discountPrice > 0 && $discountPrice < $price): ?>
                                    <span class="badge bg-success">
                                        <small>Sale</small>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="card-body">
                                <h3 class="h5 card-title mb-2">
                                    <a href="<?php echo $product['page_url']; ?>" 
                                       class="text-dark text-decoration-none stretched-link">
                                        <?php echo mb_strimwidth($product['page_title'], 0, 50, "..."); ?>
                                    </a>
                                </h3>
                                <div class="product-price mb-3">
                                    <?php if($discountPrice > 0 && $discountPrice < $price): ?>
                                        <span class="current-price"><?php echo CURRENCY.number_format($discountPrice, 2); ?></span>
                                        <span class="original-price"><?php echo CURRENCY.number_format($price, 2); ?></span>
                                    <?php else: ?>
                                        <span class="current-price"><?php echo CURRENCY.number_format($price, 2); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <span class="<?php echo $inStock ? 'text-success' : 'text-danger'; ?> small">
                                            <i class="fas fa-<?php echo $inStock ? 'check' : 'times'; ?>-circle me-1"></i>
                                            <?php echo $inStock ? 'In Stock' : 'Out of Stock'; ?>
                                        </span>
                                    </div>
                                    <div class="wishlist-btn" title="Add to Wishlist">
                                        <i class="far fa-heart"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-top-0 pt-0">
                                <?php if($inStock): ?>
                                    <button class="btn btn-sm btn-outline-primary w-100">
                                        <i class="fas fa-shopping-cart me-1"></i> Add to Cart
                                    </button>
                                <?php else: ?>
                                    <button class="btn btn-sm btn-outline-secondary w-100" disabled>
                                        <i class="fas fa-bell me-1"></i> Notify Me
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<style>
    .shop-section {
        background-color: #f8f9fa;
    }
    
    .featured-product-card {
        transition: transform 0.3s ease;
        border-radius: 12px;
        overflow: hidden;
    }
    
    .featured-product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
    }
    
    .featured-product-card .card-body {
        background: white;
    }
    
    .product-card {
        transition: all 0.3s ease;
        border-radius: 8px;
        overflow: hidden;
    }
    
    .product-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.08) !important;
    }
    
    .product-card .card-img-top {
        height: 180px;
        object-fit: contain;
        padding: 20px;
        background: #f8f9fa;
    }
    
    .current-price {
        color: var(--bs-primary);
        font-weight: 600;
    }
    
    .original-price {
        color: #999;
        text-decoration: line-through;
        font-size: 0.9rem;
        margin-left: 0.5rem;
    }
    
    .wishlist-btn {
        color: #ccc;
        cursor: pointer;
        transition: color 0.2s;
    }
    
    .wishlist-btn:hover {
        color: var(--bs-danger);
    }
    
    .object-cover {
        object-fit: cover;
    }
    
    @media (max-width: 992px) {
        .featured-product-card .row {
            flex-direction: column;
            height: auto !important;
        }
        
        .featured-product-card .col-md-6 {
            width: 100%;
        }
        
        .featured-product-card .card-body {
            padding: 2rem;
        }
    }
    
    @media (max-width: 768px) {
        .product-card .card-img-top {
            height: 150px;
        }
        
        .shop-section-header h2 {
            font-size: 1.8rem;
        }
    }
</style>
<!-- Shop Section End -->