<?php $this->load->view('layouts/top-header'); ?>

<?php $this->load->view('layouts/main-header'); ?>

<?php $this->load->view('layouts/top-nav'); ?>


<!-- Main Container Starts -->
	<div id="main-container" class="container">

	<!-- Main Heading Starts -->
		<h2 class="main-heading text-center">
			Shopping Cart
	
		</h2>

	<!-- Main Heading Ends -->
	<!-- Shopping Cart Table Starts -->
	<?php if($this->cart->contents()): ?>
			<?php echo $cart_data; ?>
			<!-- <div id="cart_content"></div> -->

	<?php else: ?>
		
		<div class="alert alert-info" role="alert">There is no item in your shopping cart</div>
	<?php endif; ?>

	<!-- Shopping Cart Table Ends -->
	<!-- Shipping Section Starts -->
	<?php if($this->cart->contents()): ?>
		<section class="registration-area">
			<div class="row">
			<div class="col-sm-6">

			</div>
			<!-- Discount & Conditions Blocks Starts -->
				<div class="col-sm-6">
				
				<!-- Total Panel Starts -->
					<div class="panel panel-smart">
						<div class="panel-heading">
							<h3 class="panel-title">
								Total
							</h3>
						</div>
						<div class="panel-body">
				
						
							<dl class="dl-horizontal total">
								<dt>Total :</dt>
								<dd id="total"></dd>
							</dl>
							<hr />
							<div class="text-uppercase clearfix">
								<a href="<?php echo base_url(); ?>home/index.html" class="btn btn-default pull-left">
									<span class="hidden-xs">Continue Shopping</span>
									<span class="visible-xs">Continue</span>
								</a>
								<a href="<?php echo base_url() ?>checkout/add" class="btn btn-default pull-right btn-order">		
									Order Now
								</a>
							</div>
						</div>
					</div>
				<!-- Total Panel Ends -->
				</div>
			<!-- Discount & Conditions Blocks Ends -->
			</div>
		</section>
	<?php endif; ?>
	<!-- Shipping Section Ends -->
	</div>
<!-- Main Container Ends -->


<?php $this->load->view('layouts/footer') ?>