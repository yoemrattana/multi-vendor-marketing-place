<?php $this->load->view('layouts/top-header'); ?>

<?php $this->load->view('layouts/main-header'); ?>

<?php $this->load->view('layouts/top-nav'); ?>

<?php $this->load->view('layouts/left-nav'); ?>



<!-- Product Info Starts -->
				<div class="row product-info">
				<!-- Left Starts -->
					<div class="col-sm-5 images-block">
						<?php $count = 1; ?>
						<?php foreach($images as $image): ?>
							<?php if($count == 1): ?>
								<p>
									<img src="<?php echo base_url() ?>assets/images/product/<?php echo $image->imageName; ?>" alt="Image" class="img-responsive thumbnail" />
								</p>
								<ul class="list-unstyled list-inline">
							<?php else: ?>
								
									<li>
										<img src="<?php echo base_url() ?>assets/images/product/<?php echo $image->imageName; ?>" class="img-responsive thumbnail"​​ height="65px" width="65px" />
									</li>
								
							<?php endif; ?>

							<?php $count++; ?>
						<?php endforeach; ?>
						</ul>
					</div>
					<!-- <div class="col-sm-5 images-block">	
						<p>
							<img src="images/product-images/pimg3.jpg" alt="Image" class="img-responsive thumbnail" />
						</p>
						<ul class="list-unstyled list-inline">
							<li>
								<img src="images/product-images/thumb1.jpg" alt="Image" class="img-responsive thumbnail" />
							</li>
							<li>
								<img src="images/product-images/thumb2.jpg" alt="Image" class="img-responsive thumbnail" />
							</li>
							<li>
								<img src="images/product-images/thumb3.jpg" alt="Image" class="img-responsive thumbnail" />
							</li>
							<li>
								<img src="images/product-images/thumb4.jpg" alt="Image" class="img-responsive thumbnail" />
							</li>
						</ul>
					</div> -->
				<!-- Left Ends -->
				<!-- Right Starts -->
					<div class="col-sm-7 product-details">
					<!-- Product Name Starts -->
						<h2><?php echo $product->productTitle; ?></h2>
					<!-- Product Name Ends -->
						<!-- <hr /> -->
					<!-- Manufacturer Starts -->
						<ul class="list-unstyled manufacturer">
							<!-- <li>
								<span>Brand:</span> Indian spices
							</li>
							<li><span>Reward Points:</span> 300</li> -->
							<li>
								<span>Availability:</span> <strong class="label stock"></strong>
							</li>
						</ul>
					<!-- Manufacturer Ends -->
						<hr />
					<!-- Price Starts -->
						
						<div class="price">
							<span class="price-head">Price :</span>
							<span class="price-new"></span> 
						</div>

						<!-- 
							to check the variant has option or not , if no opt it will hidden section option in front view
						 -->
						
						<div id="variant-exist">
							<hr />
							<div class="form-group">
							Option:
								<select name="proudct_option" id="product-options" class="form-control" style="width:150px">
									<?php foreach($variants as $variant): ?>
										<option value="<?php echo $variant->variantID ?>"><?php echo $variant->opt1 ; ?> <?php echo ($variant->opt2 == NULL)? "": "/ ".$variant->opt2 ; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

					<!-- Price Ends -->
						<hr />
					<!-- Available Options Starts -->
					<form method="post" id="form-cart" class="form-general">
						<div class="options">
							<div class="form-group">
								<label class="control-label text-uppercase" for="input-quantity">Qty:</label>
								<input type="text" name="qty" value="1" size="2" id="input-quantity" class="form-control" style="width:150px"/>
							</div>
							<div class="cart-button button-group">
								<button type="button" id="<?php echo $product->productID ?>" title="Wishlist" class="btn btn-wishlist">
									<i class="fa fa-heart"></i>
								</button>

								<!-- cart section -->

								
									<input type="hidden" name="product_title" value="<?php echo $product->productTitle; ?>">
									<input type="hidden" name="product_slug" value="<?php echo $product->slug; ?>">
									<input type="hidden" name="item_id" ><!-- variant id -->
									<input type="hidden" name="product_id" value="<?php echo $product->productID; ?>">
									<input type="hidden" name="shop_id" value="<?php echo $product->shopID; ?>">
									<input type="hidden" name="shop_name" value="<?php echo $shop->shopName; ?>">
									
									<input id="item_qty" type="hidden" name="item_qty">

									<input type="hidden" name="option_value">
									<input type="hidden" name="price">

								<!-- cart end -->
								
								<button  type="submit" name="submit" class="btn btn-cart">
									Add to cart
									<i class="fa fa-shopping-cart"></i> 
								</button>
							</form>
												
							</div>
						</div>
					
					<!-- Available Options Ends -->

						<hr />
						<div>
							<?php if($shop->logo!=null): ?>
								<img src="<?php echo base_url() ?>assets/images/logo/<?php echo $shop->logo; ?>" alt="<?php echo $shop->logo; ?>" class="img-responsive" width="50px" height="50px" />
								<a href="<?php echo base_url() ?>store/<?php echo $shop->slug ?>.html"> <?php echo $shop->shopName; ?></a>
							<?php else :?>
								<img src="<?php echo base_url() ?>assets/images/logo/logo.jpg" alt="logo"  width="50px" height="50px" />
								<a href="<?php echo base_url() ?>store/<?php echo $shop->slug ?>.html"> <?php echo $shop->shopName; ?></a>
							<?php endif ?>
						
							
						</div>
						
					</div>
				<!-- Right Ends -->
				</div>
			<!-- product Info Ends -->






			<!-- Product Description Starts -->
				<div class="product-info-box">
					<h4 class="heading">Description</h4>
					<div class="content panel-smart">
						<?php echo $product->description; ?>
					</div>
				</div>
			<!-- Product Description Ends -->
			
			


<?php $this->load->view('layouts/footer') ?>