<?php $this->load->view('layouts/top-header'); ?>

<?php $this->load->view('layouts/main-header'); ?>

<?php $this->load->view('layouts/top-nav'); ?>

<!-- Main Container Starts -->
	<div id="main-container" class="container">
	
	<!-- Main Heading Starts -->
		<h2 class="main-heading text-center">
			Login or create new account
		</h2>
	<!-- Main Heading Ends -->
	<!-- Login Form Section Starts -->
		<section class="login-area">
			<div class="row">
				<div class="col-sm-6">
				<!-- Login Panel Starts -->
					<div class="panel panel-smart">
						<div class="panel-heading">
							<h3 class="panel-title">Login for customer</h3>
						</div>
						<div class="panel-body">
							<p>
								Please login using your existing account
							</p>
						<!-- Login Form Starts -->
							<form id="form-general" class="form-inline" role="form" method="post" action="<?php echo base_url() ?>auth/login">
								<input type="hidden" name="user_group" value="3">
								<div class="form-group">
									<label class="sr-only" for="exampleInputEmail2">Username</label>
									<input type="text" name="email" class="form-control validate[required]" id="exampleInputEmail2" placeholder="Email">
								</div>
								<div class="form-group">
									<label class="sr-only" for="exampleInputPassword2">Password</label>
									<input type="password" name="password" class="form-control validate[required]" id="exampleInputPassword2" placeholder="Password">
								</div>

								<button type="submit" name="submit" class="btn btn-black">
									Login
								</button>
								</br>
								<div class="pull-left">
                       				<a href="<?php echo base_url() ?>vendor/auth/resset_password.html">Forget password?</a>
                    			</div>
							</form>
						<!-- Login Form Ends -->
						</div>
					</div>
				<!-- Login Panel Ends -->
					<!-- Guest Checkout Panel Starts -->
					<div class="panel panel-smart">
						<div class="panel-heading">
							<h3 class="panel-title">
								Login for seller
							</h3>
						</div>
						<div class="panel-body">
							<p>
								If you've an account as a seller you can log in to manage your store
							</p>
							<a href="<?php echo base_url() ?>vendor/auth/login_view.html" class="btn btn-black">
								Go to login page
							</a>
						</div>
					</div>
				<!-- Guest Checkout Panel Ends -->

				<!-- Login Panel Ends -->
					<!-- Guest Checkout Panel Starts -->
					<div class="panel panel-smart">
						<div class="panel-heading">
							<h3 class="panel-title">
								Login for Admin
							</h3>
						</div>
						<div class="panel-body">
							<p>
								This section only for Admin
							</p>
							<a href="<?php echo base_url() ?>auth/admin_login.html" class="btn btn-black">
								Go to login page
							</a>
						</div>
					</div>
				<!-- Guest Checkout Panel Ends -->
				</div>
				<div class="col-sm-6">
				<!-- Account Panel Starts -->
					<div class="panel panel-smart">
						<div class="panel-heading">
							<h3 class="panel-title">
								Create new account
							</h3>
						</div>
						<div class="panel-body">
							<p>
								Registration allows you to checkout on this website
							</p>
							<a href="<?php echo base_url() ?>home/register.html" class="btn btn-black">
								Register
							</a>
						</div>
					</div>
				<!-- Account Panel Ends -->
				<!-- Guest Checkout Panel Starts -->
					<div class="panel panel-smart">
						<div class="panel-heading">
							<h3 class="panel-title">
								Register as a seller
							</h3>
						</div>
						<div class="panel-body">
							<p>
								Registration allows you to create a store on this website
							</p>
							<a href="<?php echo base_url() ?>home/store_register.html" class="btn btn-black">
								Register
							</a>
						</div>
					</div>
				<!-- Guest Checkout Panel Ends -->
				</div>
			</div>
		</section>
	<!-- Login Form Section Ends -->
	</div>
<!-- Main Container Ends -->

<?php $this->load->view('layouts/footer') ?>




