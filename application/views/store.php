<?php $this->load->view('layouts/top-header'); ?>

<?php $this->load->view('layouts/main-header'); ?>

<?php $this->load->view('layouts/top-nav'); ?>

<?php $this->load->view('layouts/store-info'); ?>

<?php //$this->load->view('layouts/slide'); ?>

<?php //$this->load->view('layouts/banner'); ?>

<!-- 	<div class="container-fluid">				
	<div class="row">
		
			
		<img class="store-banner img-responsive" src="<?php echo base_url() ?>assets/images/banner.jpg" >
		

	
	</div>
	</div> -->

	<div class="row">
		<div class="fb-profile">
			<?php if($store->banner!=null): ?>
				<img align="left" class="fb-image-lg" src="<?php echo base_url() ?>assets/images/banner/<?php echo $store->banner ?>" alt="Profile image example"/>
			<?php else :?>
				<img align="left" class="fb-image-lg" src="<?php echo base_url() ?>assets/images/banner/banner.jpg" alt="Profile image example"/>
			<?php endif ?>

			<?php if($store->logo!=null): ?>
				<img align="left" class="fb-image-profile thumbnail" src="<?php echo base_url() ?>assets/images/logo/<?php echo $store->logo ?>" alt="Profile image example"/>
			<?php else :?>
				<img align="left" class="fb-image-profile thumbnail" src="<?php echo base_url() ?>assets/images/logo/logo.jpg" alt="Profile image example"/>
			<?php endif ?>
			
			
			<div class="fb-profile-text">
				<h1><?php echo $store->shopName; ?></h1>
			</div>
		</div>

	</div>
<!-- <div class="container">
    <div class="fb-profile">
        <img align="left" class="fb-image-lg" src="<?php echo base_url() ?>assets/images/banner.jpg" alt="Profile image example"/>
        <img align="left" class="fb-image-profile thumbnail" src="http://lorempixel.com/180/180/people/9/" alt="Profile image example"/>
       
    </div>
</div>  -->

	

<div class="product-store">
<!-- Specials Products Starts -->
			<?php echo $products; ?>	
			<?php //echo $page_link; ?>
</div>
		
	

<?php $this->load->view('layouts/footer') ?>