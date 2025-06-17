<?php
$GLOBALS['content'] = $content;

if(!function_exists("header_t")) {
    function header_t(){
        return '
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
            <link href="css/templates/shop/template_shop_collection_page.css" rel="stylesheet">
            ';
    }
}
?>

<?php
if(!function_exists("footer_t")) {
    function footer_t(){
        return '
        <script src="https://cdn.jsdelivr.net/npm/fslightbox@3.3.1/index.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/isotope-layout@3.0.6/dist/isotope.pkgd.min.js"></script>
        <script>
            // Quick view modal functionality
            function openQuickView(pid) {
                fetch(`'.BASE_URL.'quick-view.php?pid=${pid}`)
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById("quickViewContent").innerHTML = html;
                        new bootstrap.Modal(document.getElementById("quickViewModal")).show();
                        refreshFsLightbox();
                    });
            }
            
            // Initialize Isotope for filtering
            document.addEventListener("DOMContentLoaded", function() {
                const grid = document.querySelector(".product-grid");
                if(grid) {
                    const iso = new Isotope(grid, {
                        itemSelector: ".product-card",
                        layoutMode: "fitRows"
                    });
                    
                    // Filter on button click
                    document.querySelectorAll(".filter-button").forEach(button => {
                        button.addEventListener("click", function() {
                            const filterValue = this.getAttribute("data-filter");
                            iso.arrange({ filter: filterValue });
                            
                            // Update active class
                            document.querySelectorAll(".filter-button").forEach(btn => 
                                btn.classList.remove("active"));
                            this.classList.add("active");
                        });
                    });
                }
            });
            
            // Sort functionality
            function sortProducts(sortBy) {
                const container = document.querySelector(".product-grid");
                const products = Array.from(document.querySelectorAll(".product-card"));
                
                products.sort((a, b) => {
                    if(sortBy === "price-asc") {
                        return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
                    } else if(sortBy === "price-desc") {
                        return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
                    } else if(sortBy === "date") {
                        return new Date(b.dataset.date) - new Date(a.dataset.date);
                    } else if(sortBy === "popularity") {
                        return parseInt(b.dataset.views) - parseInt(a.dataset.views);
                    }
                    return 0;
                });
                
                products.forEach(product => container.appendChild(product));
            }
        </script>
        ';
    }
}
?>

<section class="product-collection py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="page-title mb-0"><?php echo $content['catname']; ?></h1>
                    <div class="sort-options">
                        <select class="form-select" onchange="sortProducts(this.value)">
                            <option value="">Sort By</option>
                            <option value="price-asc">Price: Low to High</option>
                            <option value="price-desc">Price: High to Low</option>
                            <option value="date">Newest First</option>
                            <option value="popularity">Most Popular</option>
                        </select>
                    </div>
                </div>
                <hr class="mt-3">
            </div>
        </div>
        
        <div class="row">
            <!-- Filters Sidebar -->
            <div class="col-lg-3">
                <div class="card filter-sidebar mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Filters</h5>
                    </div>
                    <div class="card-body">
                        <!-- Price Range Filter -->
                        <div class="filter-section mb-4">
                            <h6 class="filter-title">Price Range</h6>
                            <div class="price-range-slider">
                                <input type="range" class="form-range" min="0" max="1000" step="10" id="priceRange">
                                <div class="d-flex justify-content-between mt-2">
                                    <span id="minPrice">$0</span>
                                    <span id="maxPrice">$1000</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Color Filter -->
                        <div class="filter-section mb-4">
                            <h6 class="filter-title">Color</h6>
                            <div class="color-filters">
                                <?php 
                                $colors = [
                                    'red' => 'Red', 'blue' => 'Blue', 'green' => 'Green', 
                                    'black' => 'Black', 'white' => 'White', 'yellow' => 'Yellow',
                                    'purple' => 'Purple', 'pink' => 'Pink', 'orange' => 'Orange',
                                    'gray' => 'Gray', 'brown' => 'Brown', 'multi' => 'Multi-color'
                                ];
                                foreach($colors as $value => $label): ?>
                                    <div class="form-check">
                                        <input class="form-check-input filter-button" type="checkbox" 
                                               id="color-<?php echo $value; ?>" data-filter=".color-<?php echo $value; ?>">
                                        <label class="form-check-label d-flex align-items-center" for="color-<?php echo $value; ?>">
                                            <span class="color-swatch me-2" style="background-color: <?php echo $value; ?>"></span>
                                            <?php echo $label; ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <!-- Size Filter -->
                        <div class="filter-section mb-4">
                            <h6 class="filter-title">Size</h6>
                            <div class="size-filters">
                                <?php 
                                $sizes = [
                                    'xs' => 'XS', 's' => 'S', 'm' => 'M', 'l' => 'L', 
                                    'xl' => 'XL', 'xxl' => 'XXL', 'xxxl' => 'XXXL',
                                    'os' => 'One Size', '28' => '28', '30' => '30',
                                    '32' => '32', '34' => '34', '36' => '36',
                                    '38' => '38', '40' => '40', '42' => '42',
                                    '44' => '44', '46' => '46'
                                ];
                                foreach($sizes as $value => $label): ?>
                                    <div class="form-check">
                                        <input class="form-check-input filter-button" type="checkbox" 
                                               id="size-<?php echo $value; ?>" data-filter=".size-<?php echo $value; ?>">
                                        <label class="form-check-label" for="size-<?php echo $value; ?>">
                                            <?php echo $label; ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <!-- Brand Filter -->
                        <div class="filter-section mb-4">
                            <h6 class="filter-title">Brand</h6>
                            <div class="brand-filters">
                                <?php 
                                $brands = [
                                    '1' => 'Apple', '2' => 'Samsung', '3' => 'Sony'
                                ];
                                foreach($brands as $value => $label): ?>
                                    <div class="form-check">
                                        <input class="form-check-input filter-button" type="checkbox" 
                                               id="brand-<?php echo $value; ?>" data-filter=".brand-<?php echo $value; ?>">
                                        <label class="form-check-label" for="brand-<?php echo $value; ?>">
                                            <?php echo $label; ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <!-- Availability Filter -->
                        <div class="filter-section">
                            <h6 class="filter-title">Availability</h6>
                            <div class="availability-filters">
                                <div class="form-check">
                                    <input class="form-check-input filter-button" type="checkbox" 
                                           id="in-stock" data-filter=".in-stock">
                                    <label class="form-check-label" for="in-stock">
                                        In Stock
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input filter-button" type="checkbox" 
                                           id="out-of-stock" data-filter=".out-of-stock">
                                    <label class="form-check-label" for="out-of-stock">
                                        Out of Stock
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <button class="btn btn-outline-primary w-100 mt-4" onclick="resetFilters()">
                            <i class="fas fa-sync-alt me-2"></i>Reset Filters
                        </button>
                    </div>
                </div>
                
                <!-- Featured Products -->
                <div class="card featured-products-card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Featured Products</h5>
                    </div>
                    <div class="card-body">
                        <?php 
                        $featured_products = return_multiple_rows("SELECT * FROM pages WHERE soft_delete = 0 AND isactive = 1 AND catid = ".$content['catid']." and template_id = 4 ORDER BY RAND() LIMIT 3");
                        foreach ($featured_products as $product): ?>
                        <div class="featured-product-item mb-3">
                            <div class="row g-2">
                                <div class="col-4">
                                    <img src="<?php echo ABSOLUTE_IMAGEPATH.$product['featured_image']; ?>" 
                                         class="img-fluid rounded" alt="<?php echo $product['page_title']; ?>">
                                </div>
                                <div class="col-8">
                                    <h6 class="product-title mb-1">
                                        <a href="<?php echo BASE_URL.$product['page_url']; ?>" class="text-decoration-none">
                                            <?php echo $product['page_title']; ?>
                                        </a>
                                    </h6>
                                    <div class="price">
                                        <?php 
                                        $price = $product['attributes'][2]['sections']['Price']['attributes'][8]['current_value'] ?? 0;
                                        $discountPrice = $product['attributes'][2]['sections']['Discount Price']['attributes'][9]['current_value'] ?? 0;
                                        
                                        if($discountPrice > 0 && $discountPrice < $price): ?>
                                            <span class="current-price"><?php echo CURRENCY.number_format($discountPrice, 2); ?></span>
                                            <span class="original-price"><?php echo CURRENCY.number_format($price, 2); ?></span>
                                        <?php else: ?>
                                            <span class="current-price"><?php echo CURRENCY.number_format($price, 2); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            
            <!-- Product Grid -->
            <div class="col-lg-9">
                <div class="product-grid">
                    <?php 
                    $products = return_multiple_rows("SELECT * FROM pages WHERE soft_delete = 0 AND isactive = 1 AND catid = ".$content['catid']." and template_id = 4 ORDER BY createdon DESC");
                    foreach ($products as $product): 
                        // Get product attributes
                        $price = $product['attributes'][2]['sections']['Price']['attributes'][8]['current_value'] ?? 0;
                        $discountPrice = $product['attributes'][2]['sections']['Discount Price']['attributes'][9]['current_value'] ?? 0;
                        $colors = explode(',', $product['attributes'][2]['sections']['Color']['attributes'][1]['current_value'] ?? '');
                        $sizes = explode(',', $product['attributes'][1]['sections']['Size']['attributes'][2]['current_value'] ?? '');
                        $brands = explode(',', $product['attributes'][2]['sections']['Brand/Manufacturer']['attributes'][7]['current_value'] ?? '');
                        $inStock = $product['attributes'][4]['sections']['Stock Status']['attributes'][323]['current_value'] ?? 0;
                        $isNew = $product['attributes'][4]['sections']['New Arrival']['attributes'][20]['current_value'] ?? 0;
                        $isOnSale = $product['attributes'][4]['sections']['On Sale']['attributes'][22]['current_value'] ?? 0;
                        
                        // Build filter classes
                        $filterClasses = [];
                        foreach($colors as $color) {
                            $filterClasses[] = 'color-'.trim($color);
                        }
                        foreach($sizes as $size) {
                            $filterClasses[] = 'size-'.trim($size);
                        }
                        foreach($brands as $brand) {
                            $filterClasses[] = 'brand-'.trim($brand);
                        }
                        $filterClasses[] = $inStock ? 'in-stock' : 'out-of-stock';
                        $filterClassString = implode(' ', $filterClasses);
                    ?>
                    <div class="product-card mb-4 <?php echo $filterClassString; ?>" 
                         data-price="<?php echo $discountPrice > 0 ? $discountPrice : $price; ?>"
                         data-date="<?php echo $product['createdon']; ?>"
                         data-views="<?php echo $product['views']; ?>">
                        <div class="card h-100">
                            <!-- Product Badges -->
                            <div class="product-badges">
                                <?php if($isNew): ?>
                                    <span class="badge bg-danger">New</span>
                                <?php endif; ?>
                                <?php if($isOnSale && $discountPrice > 0): ?>
                                    <span class="badge bg-success">Sale</span>
                                <?php endif; ?>
                                <?php if(!$inStock): ?>
                                    <span class="badge bg-secondary">Out of Stock</span>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Product Image -->
                            <div class="product-image-container">
                                <a href="<?php echo BASE_URL.$product['page_url']; ?>">
                                    <img src="<?php echo ABSOLUTE_IMAGEPATH.$product['featured_image']; ?>" 
                                         class="card-img-top" alt="<?php echo $product['page_title']; ?>">
                                </a>
                                <div class="quick-view-btn" onclick="openQuickView(<?php echo $product['pid']; ?>)">
                                    <i class="fas fa-eye"></i> Quick View
                                </div>
                            </div>
                            
                            <!-- Product Body -->
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="product-title mb-0">
                                        <a href="<?php echo BASE_URL.$product['page_url']; ?>" class="text-decoration-none">
                                            <?php echo $product['page_title']; ?>
                                        </a>
                                    </h5>
                                    <div class="wishlist-btn" title="Add to Wishlist">
                                        <i class="far fa-heart"></i>
                                    </div>
                                </div>
                                
                                <div class="product-rating mb-2">
                                    <div class="text-warning">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <span class="ms-1 text-muted small">(24)</span>
                                    </div>
                                </div>
                                
                                <div class="product-price mb-3">
                                    <?php if($discountPrice > 0 && $discountPrice < $price): ?>
                                        <span class="current-price"><?php echo CURRENCY.number_format($discountPrice, 2); ?></span>
                                        <span class="original-price"><?php echo CURRENCY.number_format($price, 2); ?></span>
                                        <span class="discount-percent">
                                            Save <?php echo round(100 - ($discountPrice / $price * 100)); ?>%
                                        </span>
                                    <?php else: ?>
                                        <span class="current-price"><?php echo CURRENCY.number_format($price, 2); ?></span>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="product-actions">
                                    <?php if($inStock): ?>
                                        <button class="btn btn-primary btn-sm w-100 mb-2">
                                            <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                                        </button>
                                    <?php else: ?>
                                        <button class="btn btn-outline-secondary btn-sm w-100 mb-2" disabled>
                                            <i class="fas fa-bell me-2"></i>Notify Me
                                        </button>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="product-meta">
                                    <div class="d-flex justify-content-between small text-muted">
                                        <span><i class="fas fa-barcode me-1"></i> <?php echo $product['attributes'][1]['sections']['SKU']['attributes'][3]['current_value'] ?? 'N/A'; ?></span>
                                        <span class="<?php echo $inStock ? 'text-success' : 'text-danger'; ?>">
                                            <i class="fas fa-<?php echo $inStock ? 'check' : 'times'; ?>-circle me-1"></i>
                                            <?php echo $inStock ? 'In Stock' : 'Out of Stock'; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- Pagination -->
                <nav aria-label="Product pagination" class="mt-5">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Quick View Modal -->
<div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Quick View</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="quickViewContent">
                <!-- Content will be loaded via AJAX -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Add to Cart</button>
            </div>
        </div>
    </div>
</div>