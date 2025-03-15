<div class="container">
	<div class="row">
<?php
$packages = return_multiple_rows("Select * from all_packages Where soft_delete = 0 and isactive = 1 and packages_category = $packages_category ");

foreach ($packages as $package) {
?>

	<?php if (count($packages) > 3) { ?>
		<div class="col-lg-4 col-md-6 wow fadeInUp">
		<?php } else if (count($packages) <= 3) { ?>
			<div class="col-lg-4 col-md-6 wow fadeInUp">
			<?php } ?>

			<div class="pricBoxArea box package-item">

				<div class="priceBoxHead volt-box overflow-hidden">

				<?php if (!empty($package['p_image'])) { ?>
					<img src="<?php echo ABSOLUTE_IMAGEPATH . $package['p_image'] ?>" class="img-fluid" alt="<?php echo $package['ptitle'] ?>">
				<?php } ?>

				</div>


							<?php
				if ($package['IsFeatured'] == 1) {
				?>

                   	<div class="d-flex border-bottom">
                      <h4 class="tc"><?php echo $package['FeaturedText'] ?></h4>
                 	</div>

				<?php } ?>

        			   <div class="text-center p-4">
						    <h2 id="pacakages_title_<?php echo $package['pid'] ?>"><?php echo $package['ptitle'] ?></h2>
                            <h3 class="mb-0">
                            	<span class="amount_packages_span"><?php echo $package['p_cost'] ?></span> <span class="signDollar"><?php echo CURRENCY; ?></span>
                            </h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                            </div>
                            <div id="pacakages_content_<?php echo $package['pid'] ?>">
						    	<?php echo $package['p_content'] ?>
						    </div>
                            <div class="d-flex justify-content-center mb-2 btnPackage">
                                <a href="#" class="btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">Read More</a>
                                <a 
                                data-toggle="modal" data-cost="<?php echo $package['p_cost'] ?>" 
								data-title="<?php echo $package['ptitle'] ?>" data-id="<?php echo $package['pid'] ?>" 
								data-modalid="<?php echo $packages_category; ?>"
							 	class="btn btn-sm btn-primary px-3 open_order_model btnBrandArea" style="border-radius: 0 30px 30px 0;">Book Now</a>
                            </div>
                        </div>
			</div>
			</div>
		<?php } ?>
			</div>

			</div>
		<!-- Modal -->
		<div class="modal fade" id="modalOrder_<?php echo $packages_category; ?>" role="dialog">
			<div class="modal-dialog modal-lg">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">ORDER NOW</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<div class="sucsses_msg"></div>
								</div>

								<div class="form-group">
									<label for="UserName">User Name: *</label>
									<input type="text" class="form-control" id="username_dh_<?php echo $packages_category; ?>" placeholder="Enter User Name" name="UserName">
								</div>
								<div class="form-group">
									<label for="UserEmail">Email: *</label>
									<input type="Email" class="form-control" id="useremail_dh_<?php echo $packages_category; ?>" placeholder="Enter Email" name="UserEmail">
								</div>
								<div class="form-group">
									<label for="UserPhoneNumber">Phone Number: *</label>
									<input type="tel" class="form-control" id="userphoneno_dh_<?php echo $packages_category; ?>" placeholder="Phone Number" name="UserPhoneNumber">
								</div>
								<div class="form-group">
									<p>By placing Order you agree to <a href="terms-and-conditions.html" target="_blank">Terms and Conditions</a> </p>
								</div>
							</div>
							<div class="col-sm-6">

								<div class="form-group">
									<select class="form-control" id="packages_select_<?php echo $packages_category; ?>">
										<?php
										foreach ($packages as $package) {
										?>

											<option value="<?php echo $package['pid'] ?>"><?php echo $package['ptitle'] ?> - PKR <?php echo $package['p_cost'] ?>/= </option>

										<?php } ?>
									</select>
								</div>
								<div class="packagedatModal">
								</div>
								<p id="subscription_Total"><strong>Total </strong><span id="TotalPrice_<?php echo $packages_category; ?>"></span></p>
							</div>

						</div>
						<div class="modal-footer">
							<button type="submit" data-modalid="<?php echo $packages_category; ?>" class="btn btn-success btn-order">ORDER NOW&nbsp;<i class="fa fa-shopping-cart" aria-hidden="true"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal -->


		<script src="js/modules/packages/module_order.js" async></script>
		<script src="js/modules/packages/create_order.js" async></script>
