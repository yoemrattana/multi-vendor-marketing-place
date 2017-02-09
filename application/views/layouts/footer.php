</div>
		<!-- Primary Content Ends -->
		</div>
	</div>
<!-- Main Container Ends -->			
<!-- Footer Section Starts -->
	<footer id="footer-area">
	<!-- Footer Links Starts -->
		<div class="footer-links">
		<!-- Container Starts -->
			<div class="container">
				<div class="col-md-2 col-sm-6">
					<h5>Home</h5>
						<ul>
							<li><a href="<?php echo base_url() ?>home.html">Home page</a></li>
							<li><a href="<?php echo base_url() ?>list_stores.html">Our Vendor</a></li>
							
						</ul>
				</div>

				<?php echo categoryf_h(); ?>
				<!-- Contact Us Starts -->
					<!-- <div class="col-md-4 col-sm-12 last">
						<h5>Contact Us</h5>
						<ul>
							<li>My Company</li>
							<li>
								1247 LB Nagar Road, Hyderabad, Telangana - 35S
							</li>
							<li>
								Email: <a href="#">info@demolink.com</a>
							</li>								
						</ul>
						<h4 class="lead">
							Tel: <span>1(234) 567-9842</span>
						</h4>
					</div> -->
				<!-- Contact Us Ends -->
				</div>
			</div>
		<!-- Container Ends -->
		</div>
	<!-- Footer Links Ends -->
	<!-- Copyright Area Starts -->
		<div class="copyright">
		<!-- Container Starts -->
			<div class="container">
			<!-- Starts -->
				<p class="pull-left">
					&copy; EzyBuy
				</p>
			<!-- Ends -->
			<!-- Payment Gateway Links Starts -->
				<!-- <ul class="pull-right list-inline">
					<li>
						<img src="images/payment-icon/cirrus.png" alt="PaymentGateway" />
					</li>
					
				</ul> -->
			<!-- Payment Gateway Links Ends -->
			</div>
		<!-- Container Ends -->
		</div>
	<!-- Copyright Area Ends -->
	</footer>
<!-- Footer Section Ends -->
<!-- JavaScript Files -->
<script> var baseurl = '<?= base_url(); ?>'  ; </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery-migrate-1.2.1.min.js"></script>	
<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap-hover-dropdown.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/owl.carousel.min.js"></script>
 <!-- Form validation -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.validationEngine.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validationEngine-en.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/formvalidation.js"></script>
<script src="<?php echo base_url() ?>assets/js/custom-front.js"></script>

<script src="<?php echo base_url() ?>assets/js/notification.js"></script>

<script src="<?php echo base_url() ?>assets/js/lobibox.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/pagination-jquery.js"></script>

<script src="<?php echo base_url() ?>assets/rangeSlider/js/ion-rangeSlider/ion.rangeSlider.js"></script>



<script src="<?php echo base_url() ?>assets/js/ajax.js"></script>
</body>
</html>




			<script> 
                var flag = "";
                var message = "";
            </script>

            <?php if($this->session->flashdata('error')): ?>
                <script> 
                    var flag = "0";
                    var message = "Error!!! " + "<?php echo $this->session->flashdata('error'); ?>";
                </script>
            
            <?php endif; ?>

            <?php if($this->session->flashdata('inform')): ?>
                <script> 
                    var flag = "1";
                    var message = "Inform!!! " + "<?php echo $this->session->flashdata('inform'); ?>";
                </script>
            
            <?php endif; ?>