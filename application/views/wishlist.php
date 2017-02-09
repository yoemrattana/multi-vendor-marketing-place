<?php $this->load->view('layouts/top-header'); ?>

<?php $this->load->view('layouts/main-header'); ?>

<?php $this->load->view('layouts/top-nav'); ?>


<!-- Main Container Starts -->
	<div id="main-container" class="container">
	<!-- Breadcrumb Starts -->
		<!-- <ol class="breadcrumb">
			<li><a href="index.html">Home</a></li>
			<li class="active">Register</li>
		</ol> -->
	<!-- Breadcrumb Ends -->
	<!-- Main Heading Starts -->
		<h2 class="main-heading text-center">
			My Wishlist <br />
			<span>Manage Your Wishlist</span>
		</h2>
	<!-- Main Heading Ends -->
	<!-- Registration Section Starts -->
		<section class="registration-area">
			<div class="row">
				<div class="col-sm-12">
				<!-- Registration Block Starts -->
					<div class="panel panel-smart">
						<div class="panel-heading">
							<h3 class="panel-title">My Wishlist</h3>
						</div>
						<div class="table-responsive">
						<?php if(count($products)!=""): ?>
							<table class="table table-bordered">
		  						<thead>
								      <tr>
								        <th>Image</th>
								        <th>Product title</th>	 
								        <th>Action</th>
								      </tr>
							    </thead>
						     	<tbody>
						     		<?php foreach($products as $item) :?>
								      <tr>
								        <td><img src="<?php echo base_url(); ?>assets/images/product/<?php echo $item->imageName; ?>" width="30px" height="30px"></td>
								        <td><a href="<?php echo base_url() ?>product/<?php echo $item->slug ?>"><?php echo $item->productTitle ?></a></td>
								        <td>
								        	<a href="<?php echo base_url() ?>product/<?php echo $item->slug ?>" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-eye-open"></span> View</a> 
								        	<button id="<?php echo $item->wishlistID ?>" class="btn btn-sm btn-danger del-wishlist"><span class="glyphicon glyphicon-trash"></span> Delete</button>
								        </td>
								      </tr>
								    <?php endforeach; ?>
							    </tbody>
							</table>
						<?php else: ?>
							<p>There is no item in wishlist.</p>
						<?php endif ?>
						</div>
							
					</div>
				<!-- Registration Block Ends -->
				</div>
			
			</div>
		</section>
	<!-- Registration Section Ends -->
	</div>
<!-- Main Container Ends -->


<?php $this->load->view('layouts/footer') ?>