
<div class="col-lg-12">
	<h1 class="page-header">Options</h1>

	<ol class="breadcrumb">
		<li><a href="<?php echo base_url() ?>vendor/dashboard/index"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url() ?>vendor/option/index"><i class="fa fa-table"></i> Options</a></li>
		<li class="active"><i class="fa fa-plus-square"></i> Edit Option</li>
	</ol>
	

	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Edit Option</h3>
		</div>
		<div class="panel-body bg">
		<div class="block">
			<form id="form-general" method="post" action="<?php echo base_url()?>vendor/option/add" id="general-form" enctype="multipart/form-data">
				<input type="hidden" name="not_ajax">
				<div class="form-group">
					<label> Option Title <i class="asterisk">*</i></label>
					<input type="text" name="option_type_name" class="form-control validate[required]">
				</div>

				<div class="input_fields_wrap">
				    <a href="#" class="add_field_button">Add More Fields</a>
				    	<div>
				    		
							<input class="option_field validate[required]" type="text" name="option_value[]"​>
						</div>
				
				</div>

				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary">Save Changes</button> 
				</div>
			</form>
		</div><!-- end block -->	
		</div> <!-- end panel body -->
	</div> <!-- end panel -->

</div>

