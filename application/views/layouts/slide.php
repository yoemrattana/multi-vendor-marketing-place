<!-- Slider Section Starts -->
<div class="slider">
	<div id="main-carousel" class="carousel slide" data-ride="carousel">
	<!-- Wrapper For Slides Starts -->
		<!-- <div class="carousel-inner">
			<div class="item active">
				<img src="<?php echo base_url() ?>assets/images/slider-imgs/slide1-img.jpg" alt="Slider" class="img-responsive" />
			</div>
			<div class="item">
				<img src="<?php echo base_url() ?>assets/images/slider-imgs/slide2-img.jpg" alt="Slider" class="img-responsive" />
			</div>
			<div class="item">
				<img src="<?php echo base_url() ?>assets/images/slider-imgs/chicken(200x200)_.jpg" alt="Slider" class="img-responsive" />
			</div>
		</div> -->

		<div class="carousel-inner">
			<?php $count = 1; ?>
			<?php foreach($sliders as $item): ?>
				<?php if($count == 1): ?>
					<div class="item active">
				<?php else:  ?>
					<div class="item">
				<?php endif; ?>
					<img src="<?php echo base_url() ?>assets/images/slider-imgs/<?php echo $item->imageName ?>" alt="Slider" class="img-responsive" />
				</div>
				<?php $count++; ?>
			<?php endforeach;  ?>

		</div>
	<!-- Wrapper For Slides Ends -->
	<!-- Controls Starts -->
		<a class="left carousel-control" href="#main-carousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
		</a>
		<a class="right carousel-control" href="#main-carousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
		</a>
	<!-- Controls Ends -->
	</div>	
</div>
<!-- Slider Section Ends -->