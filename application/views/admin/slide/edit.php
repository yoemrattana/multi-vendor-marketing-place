
<div class="col-lg-12 ">
	<h1 class="page-header">Slider Image</h1>

	<ol class="breadcrumb">
		<li><a href="<?php echo base_url() ?>admin/dashboard/index"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url() ?>admin/slide/index"><i class="fa fa-table"></i> Sliders</a></li>
		<li class="active"><i class="fa fa-plus-square"></i> Edit</li>
	</ol>

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Edit</h3>
		</div>
		<div class="panel-body bg">
		<div class="row">
		<!-- <div class="block"> -->
		<div class="col-lg-4">
			<img src="<?php echo base_url() ?>assets/images/slider-imgs/<?php echo $image->imageName ?>" width="200px" height="140px">
		</div>
		<div class="col-lg-8">
			<form  method="post" action="<?php echo base_url()?>admin/slide/edit/<?php echo $image->sliderID ?>" id="form-general" enctype="multipart/form-data">				

				<div class="form-group">
					<label>Slider image</label>
					<input type="file" name="file">
				</div>
			
				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary">Save Changes</button> 
				</div>

			</form>
		</div>
		<!-- </div> --><!-- end block -->
		</div>
		</div> <!-- end panel body -->

	</div> <!-- end panel -->

</div>

