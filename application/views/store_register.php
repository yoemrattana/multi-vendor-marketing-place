<?php $this->load->view('layouts/top-header'); ?>

<?php $this->load->view('layouts/main-header'); ?>

<?php $this->load->view('layouts/top-nav'); ?>


<!-- Main Container Starts -->
	<div id="main-container" class="container">

	<!-- Main Heading Starts -->
		<h2 class="main-heading text-center">
			Register <br />
			<span>Create New Store</span>
		</h2>
	<!-- Main Heading Ends -->
	<!-- Registration Section Starts -->
	<?php if ($this->session->flashdata('store_registered')): ?>
   		 <?= '<p id="info" class="alert alert-success">' . $this->session->flashdata('store_registered') . '</p>' ?>
	<?php endif; ?>
		<section class="registration-area">
			<div class="row">
				<div class="col-sm-6 col-md-offset-3">
				<!-- Registration Block Starts -->
					<div class="panel panel-smart">
						<div class="panel-heading">
							<h3 class="panel-title">Personal Information</h3>
						</div>
						<div class="panel-body">
						<!-- Registration Form Starts -->
							<form id="form-register-store" class="form-horizontal" role="form" method="post" action="<?php echo base_url() ?>shop/add_store">
							<!-- Personal Information Starts -->
								<div class="form-group">
									<label for="inputFname" class="col-sm-3 control-label">First Name :</label>
									<div class="col-sm-9">
										<input type="text" name="firstName" class="form-control validate[required]" id="inputFname" placeholder="First Name">
									</div>
								</div>
								<div class="form-group">
									<label for="inputLname" class="col-sm-3 control-label">Last Name :</label>
									<div class="col-sm-9">
										<input type="text" name="lastName" class="form-control validate[required]" id="inputLname" placeholder="Last Name">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail" class="col-sm-3 control-label">Email :</label>
									<div class="col-sm-9">
										<input type="email" name="email" class="form-control validate[required, ajax[ajaxEmailValidate], custom[email]]" id="inputEmail" placeholder="Email">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPhone" class="col-sm-3 control-label">Phone :</label>
									<div class="col-sm-9">
										<input type="text" name="phone" class="form-control validate[required]" id="inputPhone" placeholder="Phone">
									</div>
								</div>
								<div class="form-group">
									<label for="inputFax" class="col-sm-3 control-label">Password :</label>
									<div class="col-sm-9">
										<input type="password" name="password" class="form-control validate[required, minSize[6]]" id="new_password" placeholder="Password">
									</div>
								</div>
								<div class="form-group">
									<label for="inputFax" class="col-sm-3 control-label">Re-Password :</label>
									<div class="col-sm-9">
										<input type="password" name="re_pass" class="form-control validate[required, equals[new_password]]" id="inputFax" placeholder="Re-Password">
									</div>
								</div>
								<div class="form-group">
									<label for="inputFax" class="col-sm-3 control-label">Address :</label>
									<div class="col-sm-9">
										<input type="text" name="address" class="form-control validate[required]" id="inputFax" placeholder="Address">
									</div>
								</div>
								<!-- Personal info end -->
								<!-- Store infor start -->
								<h3 class="panel-heading inner">
									Store Information
								</h3>
								<div class="form-group">
									<label for="inputFax" class="col-sm-3 control-label">Store Name :</label>
									<div class="col-sm-9">
										<input type="text" name="shopName" class="form-control validate[required]" id="inputFax" placeholder="Store Name">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-3 col-sm-9">
										<button type="submit" name="submit" class="btn btn-black">
											Register
										</button>
									</div>
								</div>
								<!-- store info end -->
							</form>
						<!-- Registration Form Starts -->
						</div>							
					</div>
				<!-- Registration Block Ends -->
				</div>
				<div class="col-sm-6">

				
				</div>
			</div>
		</section>
	<!-- Registration Section Ends -->
	</div>
<!-- Main Container Ends -->


<?php $this->load->view('layouts/footer') ?>