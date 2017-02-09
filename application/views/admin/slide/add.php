
<div class="col-lg-12 ">
	<h1 class="page-header">Slider Image</h1>

	<ol class="breadcrumb">
		<li><a href="<?php echo base_url() ?>admin/dashboard/index"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url() ?>admin/slide/index"><i class="fa fa-table"></i> Sliders</a></li>
		<li class="active"><i class="fa fa-plus-square"></i> Add New Store</li>
	</ol>

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Add New Store</h3>
		</div>
		<div class="panel-body bg">
		<div class="block">
			<form id="form-general" method="post" action="<?php echo base_url()?>admin/slide/add" id="form-general" enctype="multipart/form-data">
				

				<div class="form-group">
							<label>Slider image</label>
							<input type="file" class="validate[required]" name="file">
				</div>

				
			
				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary">Save Changes</button> 
				</div>

			</form>
		</div><!-- end block -->
		</div> <!-- end panel body -->

	</div> <!-- end panel -->

</div>

