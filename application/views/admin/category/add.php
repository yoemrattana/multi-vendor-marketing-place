
<div class="col-lg-12">
	<h1 class="page-header">Category</h1>

	<ol class="breadcrumb">
		<li><a href="<?php echo base_url() ?>admin/dashboard/index"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url() ?>admin/category/index"><i class="fa fa-table"></i> Category</a></li>
		<li class="active"><i class="fa fa-plus-square"></i> Add New Category</li>
	</ol>
	

	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Add New Category</h3>
		</div>
		<div class="panel-body bg">
		<div class="block">
			<form id="form-general" method="post" action="<?php echo base_url()?>admin/category/add" id="general-form" enctype="multipart/form-data">
				<input type="hidden" name="not_ajax">
				<div class="form-group">
					<label> Category Name <i class="asterisk">*</i></label>
					<input type="text" name="category_name" class="form-control validate[required]">
				</div>

				<div class="input_fields_wrap_sub_category">
				    <a href="#" class="add_field_button">Add More Fields</a>
				    	<div>	
							<input class="option_field validate[required]" type="text" name="new_sub_category[]"​>
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

