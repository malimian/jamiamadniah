<div class="container">
    <div class="row g-4">
        <?php
        $packages = return_multiple_rows("Select * from all_packages Where soft_delete = 0 and isactive = 1 and packages_category = $packages_category ");

        foreach ($packages as $package) {
            $featuredClass = ($package['IsFeatured'] == 1) ? 'border-primary' : '';
            $buttonClass = ($package['IsFeatured'] == 1) ? 'btn-primary' : 'btn-outline-primary';
        ?>
            <div class="col-lg-4 col-md-6 wow fadeInUp">
                <div class="card h-100 pricBoxArea box package-item <?php echo $featuredClass; ?>">
                    <?php if (!empty($package['p_image'])) { ?>
                        <div class="card-header priceBoxHead volt-box overflow-hidden p-0">
                            <img src="<?php echo ABSOLUTE_IMAGEPATH . $package['p_image'] ?>" class="img-fluid w-100" alt="<?php echo $package['ptitle'] ?>">
                        </div>
                    <?php } ?>

                    <?php if ($package['IsFeatured'] == 1) { ?>
                        <div class="card-header bg-primary text-white py-3">
                            <h4 class="my-0 fw-normal text-center tc"><?php echo $package['FeaturedText'] ?></h4>
                        </div>
                    <?php } ?>

                    <div class="card-body text-center p-4">
                        <h2 class="card-title pricing-card-title mb-3" id="pacakages_title_<?php echo $package['pid'] ?>">
                            <?php echo $package['ptitle'] ?>
                        </h2>
                        <h3 class="mb-3">
                            <span class="amount_packages_span"><?php echo $package['p_cost'] ?></span> 
                            <span class="signDollar"><?php echo CURRENCY; ?></span>
                        </h3>
                        <div class="mb-3 text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="mb-4" id="pacakages_content_<?php echo $package['pid'] ?>">
                            <?php echo $package['p_content'] ?>
                        </div>
                        <button type="button" 
                            class="w-100 btn <?php echo $buttonClass; ?> open_order_model btnBrandArea "
                            data-bs-toggle="modal" 
                            data-bs-target="#modalOrder_<?php echo $packages_category; ?>"
                            data-cost="<?php echo $package['p_cost'] ?>" 
                            data-title="<?php echo $package['ptitle'] ?>" 
                            data-id="<?php echo $package['pid'] ?>" 
                            data-modalid="<?php echo $packages_category; ?>">
                            Book Now
                        </button>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<div class="modal fade" id="modalOrder_<?php echo $packages_category; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ORDER NOW</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="sucsses_msg"></div>
                        </div>

                        <div class="mb-3">
                            <label for="username_dh_<?php echo $packages_category; ?>" class="form-label">User Name: *</label>
                            <input type="text" class="form-control" id="username_dh_<?php echo $packages_category; ?>" placeholder="Enter User Name">
                        </div>
                        <div class="mb-3">
                            <label for="useremail_dh_<?php echo $packages_category; ?>" class="form-label">Email: *</label>
                            <input type="email" class="form-control" id="useremail_dh_<?php echo $packages_category; ?>" placeholder="Enter Email">
                        </div>
                        <div class="mb-3">
                            <label for="userphoneno_dh_<?php echo $packages_category; ?>" class="form-label">Phone Number: *</label>
                            <input type="tel" class="form-control" id="userphoneno_dh_<?php echo $packages_category; ?>" placeholder="Phone Number">
                        </div>
                        <div class="mb-3">
                            <p>By placing Order you agree to <a href="terms-and-conditions.html" target="_blank">Terms and Conditions</a></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <select class="form-select" id="packages_select_<?php echo $packages_category; ?>">
                                <?php foreach ($packages as $package) { ?>
                                    <option value="<?php echo $package['pid'] ?>">
                                        <?php echo $package['ptitle'] ?> - <?php echo CURRENCY; ?> <?php echo $package['p_cost'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="packagedatModal mb-3"></div>
                        <p id="subscription_Total">
                            <strong>Total </strong>
                            <span id="TotalPrice_<?php echo $packages_category; ?>" class="fw-bold"></span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" data-modalid="<?php echo $packages_category; ?>" class="btn btn-success btn-order">
                    ORDER NOW <i class="fas fa-shopping-cart ms-1"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script src="js/modules/packages/module_order.js" async></script>
<script src="js/modules/packages/create_order.js" async></script>