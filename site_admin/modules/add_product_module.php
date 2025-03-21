<div class="container mt-5">
   <!-- Tabs -->
   <!-- Tabs Navigation -->
   <ul class="nav nav-tabs" id="productTabs" role="tablist">
      <!-- Basic Info Tab -->
      <li class="nav-item">
         <a class="nav-link active" id="basic-tab" data-toggle="tab" href="#basic" role="tab" aria-controls="basic" aria-selected="true">
            <i class="fa fa-info-circle"></i> Basic Info
         </a>
      </li>

      <!-- Details Tab -->
      <li class="nav-item">
         <a class="nav-link" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="false">
            <i class="fa fa-list-alt"></i> Details
         </a>
      </li>

      <!-- Shipping & Policies Tab -->
      <li class="nav-item">
         <a class="nav-link" id="shipping-tab" data-toggle="tab" href="#shipping" role="tab" aria-controls="shipping" aria-selected="false">
            <i class="fa fa-truck"></i> Shipping & Policies
         </a>
      </li>

      <!-- Flags Tab -->
      <li class="nav-item">
         <a class="nav-link" id="flags-tab" data-toggle="tab" href="#flags" role="tab" aria-controls="flags" aria-selected="false">
            <i class="fa fa-flag"></i> Flags
         </a>
      </li>
   </ul>

   <!-- Tab Content -->
   <div class="tab-content" id="productTabsContent">
      <!-- Basic Info Tab -->
      <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">

         <div class="form-group row">
            <label for="productDescription" class="col-sm-2 col-form-label">Product Small Description</label>
            <div class="col-sm-10">
               <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fa fa-align-left"></i></span>
                  </div>
                  <textarea class="form-control" id="productDescription" placeholder="Enter Product Description" rows="4" required><?php if($action == "edit") echo $page[0]['product_description']; ?></textarea>
               </div>
               <div class="valid-feedback">Valid.</div>
               <div class="invalid-feedback">Please fill out this field.</div>
            </div>
         </div>

         <div class="form-group row">
            <label for="sku" class="col-sm-2 col-form-label">SKU</label>
            <div class="col-sm-10">
               <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fa fa-barcode"></i></span>
                  </div>
                  <input type="text" class="form-control" id="sku" placeholder="Enter SKU" value="<?php if($action == "edit") echo $page[0]['sku']; ?>" required>
               </div>
               <div class="valid-feedback">Valid.</div>
               <div class="invalid-feedback">Please fill out this field.</div>
            </div>
         </div>

         <!-- Sale Start Date -->
         <div class="form-group row">
            <label for="saleStartDate" class="col-sm-2 col-form-label">Sale Start Date</label>
            <div class="col-sm-10">
               <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                  </div>
                  <input type="date" class="form-control" id="saleStartDate" name="sale_start" value="<?php if($action == "edit") echo $page[0]['sale_start']; ?>">
               </div>
               <div class="valid-feedback">Valid.</div>
               <div class="invalid-feedback">Please fill out this field.</div>
            </div>
         </div>

         <!-- Sale End Date -->
         <div class="form-group row">
            <label for="saleEndDate" class="col-sm-2 col-form-label">Sale End Date</label>
            <div class="col-sm-10">
               <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                  </div>
                  <input type="date" class="form-control" id="saleEndDate" name="sale_end" value="<?php if($action == "edit") echo $page[0]['sale_end']; ?>">
               </div>
               <div class="valid-feedback">Valid.</div>
               <div class="invalid-feedback">Please fill out this field.</div>
            </div>
         </div>

      </div>

      <!-- Details Tab -->
      <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
         <div class="form-group row">
            <label for="brand" class="col-sm-2 col-form-label">Brand/Manufacturer</label>
            <div class="col-sm-10">
               <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fa fa-industry"></i></span>
                  </div>
                  <input type="text" class="form-control" id="brand" placeholder="Enter Brand/Manufacturer" value="<?php if($action == "edit") echo $page[0]['brand']; ?>" required>
               </div>
               <div class="valid-feedback">Valid.</div>
               <div class="invalid-feedback">Please fill out this field.</div>
            </div>
         </div>

         <div class="form-group row">
            <label for="price" class="col-sm-2 col-form-label">Price</label>
            <div class="col-sm-10">
               <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                  </div>
                  <input type="number" class="form-control" id="price" placeholder="Enter Price" value="<?php if($action == "edit") echo $page[0]['price']; ?>" required>
               </div>
               <div class="valid-feedback">Valid.</div>
               <div class="invalid-feedback">Please fill out this field.</div>
            </div>
         </div>

         <div class="form-group row">
            <label for="discountPrice" class="col-sm-2 col-form-label">Discount Price</label>
            <div class="col-sm-10">
               <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fa fa-tag"></i></span>
                  </div>
                  <input type="number" class="form-control" id="discountPrice" placeholder="Enter Discount Price" value="<?php if($action == "edit") echo $page[0]['discount_price']; ?>">
               </div>
               <div class="valid-feedback">Valid.</div>
               <div class="invalid-feedback">Optional field.</div>
            </div>
         </div>

         <div class="form-group row">
            <label for="dimensions" class="col-sm-2 col-form-label">Dimensions/Size</label>
            <div class="col-sm-10">
               <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fa fa-arrows-alt"></i></span>
                  </div>
                  <input type="text" class="form-control" id="dimensions" placeholder="Enter Dimensions/Size" value="<?php if($action == "edit") echo $page[0]['dimensions']; ?>">
               </div>
               <div class="valid-feedback">Valid.</div>
               <div class="invalid-feedback">Optional field.</div>
            </div>
         </div>

         <div class="form-group row">
            <label for="weight" class="col-sm-2 col-form-label">Weight</label>
            <div class="col-sm-10">
               <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fa fa-balance-scale"></i></span>
                  </div>
                  <input type="text" class="form-control" id="weight" placeholder="Enter Weight" value="<?php if($action == "edit") echo $page[0]['weight']; ?>">
               </div>
               <div class="valid-feedback">Valid.</div>
               <div class="invalid-feedback">Optional field.</div>
            </div>
         </div>

         <!-- Type -->
         <div class="form-group row">
            <label for="type" class="col-sm-2 col-form-label">Type</label>
            <div class="col-sm-10">
               <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fa fa-tags"></i></span>
                  </div>
                  <input type="text" class="form-control" id="type" placeholder="Enter Product Type" value="<?php if($action == "edit") echo $page[0]['type']; ?>" required>
               </div>
               <div class="valid-feedback">Valid.</div>
               <div class="invalid-feedback">Please fill out this field.</div>
            </div>
         </div>

         <!-- Condition -->
         <div class="form-group row">
            <label for="condition" class="col-sm-2 col-form-label">Condition</label>
            <div class="col-sm-10">
               <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fa fa-certificate"></i></span>
                  </div>
                  <select class="form-control" id="condition" required>
                     <option value="">Select Condition</option>
                     <option value="new" <?php if($action == "edit" && $page[0]['condition'] == 'new') echo 'selected'; ?>>New</option>
                     <option value="used" <?php if($action == "edit" && $page[0]['condition'] == 'used') echo 'selected'; ?>>Used</option>
                     <option value="refurbished" <?php if($action == "edit" && $page[0]['condition'] == 'refurbished') echo 'selected'; ?>>Refurbished</option>
                  </select>
               </div>
               <div class="valid-feedback">Valid.</div>
               <div class="invalid-feedback">Please select a condition.</div>
            </div>
         </div>

         <!-- Warranty -->
         <div class="form-group row">
            <label for="warranty" class="col-sm-2 col-form-label">Warranty</label>
            <div class="col-sm-10">
               <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fa fa-shield"></i></span>
                  </div>
                  <input type="text" class="form-control" id="warranty" placeholder="Enter Warranty Information" value="<?php if($action == "edit") echo $page[0]['warranty']; ?>">
               </div>
               <div class="valid-feedback">Valid.</div>
               <div class="invalid-feedback">Optional field.</div>
            </div>
         </div>

         <!-- Model -->
         <div class="form-group row">
            <label for="model" class="col-sm-2 col-form-label">Model</label>
            <div class="col-sm-10">
               <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fa fa-cube"></i></span>
                  </div>
                  <input type="text" class="form-control" id="model" placeholder="Enter Model" value="<?php if($action == "edit") echo $page[0]['model']; ?>">
               </div>
               <div class="valid-feedback">Valid.</div>
               <div class="invalid-feedback">Optional field.</div>
            </div>
         </div>

         <!-- Features -->
         <div class="form-group row">
            <label for="features" class="col-sm-2 col-form-label">Features</label>
            <div class="col-sm-10">
               <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fa fa-list"></i></span>
                  </div>
                  <textarea class="form-control" id="features" placeholder="Enter Features" rows="4"><?php if($action == "edit") echo $page[0]['features']; ?></textarea>
               </div>
               <div class="valid-feedback">Valid.</div>
               <div class="invalid-feedback">Optional field.</div>
            </div>
         </div>

         <!-- Color -->
         <div class="form-group row">
            <label for="color" class="col-sm-2 col-form-label">Color</label>
            <div class="col-sm-10">
               <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fa fa-paint-brush"></i></span>
                  </div>
                  <input type="text" class="form-control" id="color" placeholder="Enter Color Options" value="<?php if($action == "edit") echo $page[0]['color']; ?>">
               </div>
               <div class="valid-feedback">Valid.</div>
               <div class="invalid-feedback">Optional field.</div>
            </div>
         </div>

         <!-- Seller Notes -->
         <div class="form-group row">
            <label for="sellerNotes" class="col-sm-2 col-form-label">Seller Notes</label>
            <div class="col-sm-10">
               <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fa fa-sticky-note"></i></span>
                  </div>
                  <textarea class="form-control" id="sellerNotes" placeholder="Enter Seller Notes" rows="4"><?php if($action == "edit") echo $page[0]['seller_notes']; ?></textarea>
               </div>
               <div class="valid-feedback">Valid.</div>
               <div class="invalid-feedback">Optional field.</div>
            </div>
         </div>

      </div>

      <!-- Shipping & Policies Tab -->
      <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
         <!-- Shipping & Policies Section -->
         <div class="form-group row">
            <label for="shippingInfo" class="col-sm-2 col-form-label">Shipping Information</label>
            <div class="col-sm-10">
               <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fa fa-truck"></i></span>
                  </div>
                  <input type="text" class="form-control" id="shippingInfo" placeholder="Enter Shipping Information" value="<?php if($action == "edit") echo $page[0]['shipping_info']; ?>">
               </div>
               <div class="valid-feedback">Valid.</div>
               <div class="invalid-feedback">Optional field.</div>
            </div>
         </div>

         <!-- Weight and Dimensions -->
         <div class="form-group row">
            <label class="col-sm-2 col-form-label">Weight & Dimensions</label>
            <div class="col-sm-10">
               <div class="row">
                  <!-- Weight -->
                  <div class="col-md-6">
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <span class="input-group-text"><i class="fa fa-balance-scale"></i></span>
                        </div>
                        <input type="number" step="0.01" class="form-control" id="weight" placeholder="Weight (kg)" value="<?php if($action == "edit") echo $page[0]['weight']; ?>">
                     </div>
                     <div class="valid-feedback">Valid.</div>
                     <div class="invalid-feedback">Optional field.</div>
                  </div>

                  <!-- Dimensions -->
                  <div class="col-md-6">
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <span class="input-group-text"><i class="fa fa-arrows-alt"></i></span>
                        </div>
                        <input type="number" step="0.1" class="form-control" placeholder="Length (cm)" value="<?php if($action == "edit") echo $page[0]['length']; ?>">
                        <input type="number" step="0.1" class="form-control" placeholder="Width (cm)" value="<?php if($action == "edit") echo $page[0]['width']; ?>">
                        <input type="number" step="0.1" class="form-control" placeholder="Height (cm)" value="<?php if($action == "edit") echo $page[0]['height']; ?>">
                     </div>
                     <div class="valid-feedback">Valid.</div>
                     <div class="invalid-feedback">Optional field.</div>
                  </div>
               </div>
            </div>
         </div>

         <!-- Return/Refund Policy -->
         <div class="form-group row">
            <label for="returnPolicy" class="col-sm-2 col-form-label">Return/Refund Policy</label>
            <div class="col-sm-10">
               <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fa fa-undo"></i></span>
                  </div>
                  <textarea class="form-control" id="returnPolicy" placeholder="Enter Return/Refund Policy" rows="3"><?php if($action == "edit") echo $page[0]['return_policy']; ?></textarea>
               </div>
               <div class="valid-feedback">Valid.</div>
               <div class="invalid-feedback">Optional field.</div>
            </div>
         </div>
      </div>

      <!-- Flags Tab -->
      <div class="tab-pane fade" id="flags" role="tabpanel" aria-labelledby="flags-tab">
         <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
               <!-- In Stock -->
               <div class="input-group mb-3">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fa fa-check-circle"></i></span>
                  </div>
                  <div class="form-check" style="padding-left: 2.25rem;">
                     <input class="form-check-input" type="checkbox" id="additionalCheck1" <?php if($action == "edit" && $page[0]['stock_status'] == 1) echo 'checked'; ?>>
                     <label class="form-check-label" for="additionalCheck1">In Stock</label>
                  </div>
               </div>

               <!-- New Arrival -->
               <div class="input-group mb-3">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fa fa-star"></i></span>
                  </div>
                  <div class="form-check" style="padding-left: 2.25rem;">
                     <input class="form-check-input" type="checkbox" id="additionalCheck2" <?php if($action == "edit" && $page[0]['new_arrivals'] == 1) echo 'checked'; ?>>
                     <label class="form-check-label" for="additionalCheck2">New Arrival</label>
                  </div>
               </div>

               <!-- Featured Product -->
               <div class="input-group mb-3">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fa fa-certificate"></i></span>
                  </div>
                  <div class="form-check" style="padding-left: 2.25rem;">
                     <input class="form-check-input" type="checkbox" id="additionalCheck3" <?php if($action == "edit" && $page[0]['featured_product'] == 1) echo 'checked'; ?>>
                     <label class="form-check-label" for="additionalCheck3">Featured Product</label>
                  </div>
               </div>

               <!-- On Sale -->
               <div class="input-group mb-3">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fa fa-tag"></i></span>
                  </div>
                  <div class="form-check" style="padding-left: 2.25rem;">
                     <input class="form-check-input" type="checkbox" id="additionalCheck4" <?php if($action == "edit" && $page[0]['on_sale'] == 1) echo 'checked'; ?>>
                     <label class="form-check-label" for="additionalCheck4">On Sale</label>
                  </div>
               </div>

               <!-- Best Seller -->
               <div class="input-group mb-3">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fa fa-trophy"></i></span>
                  </div>
                  <div class="form-check" style="padding-left: 2.25rem;">
                     <input class="form-check-input" type="checkbox" id="additionalCheck5" <?php if($action == "edit" && $page[0]['best_seller'] == 1) echo 'checked'; ?>>
                     <label class="form-check-label" for="additionalCheck5">Best Seller</label>
                  </div>
               </div>

               <!-- Trending Item -->
               <div class="input-group mb-3">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fa fa-line-chart"></i></span>
                  </div>
                  <div class="form-check" style="padding-left: 2.25rem;">
                     <input class="form-check-input" type="checkbox" id="additionalCheck6" <?php if($action == "edit" && $page[0]['trending_item'] == 1) echo 'checked'; ?>>
                     <label class="form-check-label" for="additionalCheck6">Trending Item</label>
                  </div>
               </div>

               <!-- Hot Item -->
               <div class="input-group mb-3">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fa fa-fire"></i></span>
                  </div>
                  <div class="form-check" style="padding-left: 2.25rem;">
                     <input class="form-check-input" type="checkbox" id="additionalCheck7" <?php if($action == "edit" && $page[0]['hot_item'] == 1) echo 'checked'; ?>>
                     <label class="form-check-label" for="additionalCheck7">Hot Item</label>
                  </div>
               </div>
            </div>
         </div>
      </div>

   </div>
</div>