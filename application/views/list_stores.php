<?php $this->load->view('layouts/top-header'); ?>

<?php $this->load->view('layouts/main-header'); ?>

<?php $this->load->view('layouts/top-nav'); ?>

<?php //$this->load->view('layouts/left-nav'); ?>

<?php //$this->load->view('layouts/slide'); ?>

<?php //$this->load->view('layouts/banner'); ?>

					
		<!-- content area -->
			<?php //echo $product; ?>

			<?php //echo $page_link; ?>
		<!-- Specials Products Starts -->
				<section class="products-list">			
				<!-- Heading Starts -->
					<h2 class="product-head">Stores List</h2>
				<!-- Heading Ends -->
				<!-- Products Row Starts -->
					<div class="row">
					<!-- Product #1 Starts -->
					<?php foreach($stores as $store): ?>
						<div class="col-md-3 col-sm-4">
							<div class="product-col">
								<?php if($store->logo!=null): ?>
									<img src="<?php echo base_url() ?>assets/images/logo/<?php echo $store->logo; ?>" alt="<?php echo $store->logo; ?>" class="img-responsive" />
								<?php else :?>
									<img src="<?php echo base_url() ?>assets/images/logo/logo.jpg" alt="logo" class="img-responsive" />
								<?php endif ?>
								<!-- <div class="image">
									<img src="<?php echo base_url() ?>assets/images/<?php echo $store->logo; ?>" alt="product" class="img-responsive" />
								</div> -->
								<div class="caption">
									<h4>
										<a href="<?php echo base_url() ?>store/<?php echo $store->slug; ?>"><?php echo $store->shopName; ?></a>
									</h4>
							
									
									<div class="cart-button">
										<a href="<?php echo base_url() ?>store/<?php echo $store->slug; ?>" class="btn btn-cart">
											Visit Store
											<i class="fa fa-home"></i> 
										</a>									
									</div>
								</div>
							</div>
						</div>
					<!-- Product #1 Ends -->
					<?php endforeach; ?>
					</div>
				<!-- Products Row Ends -->
				</section>
			<!-- Specials Products Ends -->

<?php $this->load->view('layouts/footer') ?>