
<div class="col-lg-12">
	<h1 class="page-header">Category</h1>

	<ol class="breadcrumb">
		<li><a href="<?php echo base_url() ?>admin/dashboard/index"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url() ?>admin/category/index"><i class="fa fa-table"></i> Category</a></li>
		<li class="active"><i class="fa fa-plus-square"></i> Edit Category</li>
	</ol>
	

	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Edit Category</h3>
		</div>
		<div class="panel-body bg">
		<div class="block">
			<form id="form-general" method="post" action="<?php echo base_url()?>admin/category/edit/<?php echo $category->categoryID; ?>" id="general-form" enctype="multipart/form-data">
				<div class="form-group">
					<label> Category Name <i class="asterisk">*</i></label>
					<input type="text" name="category_name" class="form-control validate[required]" value="<?php echo $category->categoryName?>">
				</div>

				<div class="input_fields_wrap_sub_category">
				    <a href="#" class="add_field_button">Add More Fields</a>
				    
				    <?php foreach($sub_category as $item): ?>
				    	<div>
				    		<input type="hidden" name='sub_category_id[]' value="<?php echo $item->subCategoryID; ?>">
							<input class="option_field validate[required]" type="text" name="sub_category[]"​ value="<?php echo $item->subCategoryName ?>"><a href="#" id="<?php echo $item->subCategoryID;?>" class="remove_old_field del_sub_cat"><i class="fa fa-minus-circle" style="color:red;"></i></a>
						</div>
					<?php endforeach; ?>
				</div>

				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary">Save Changes</button> 
				</div>
			</form>
		</div><!-- end block -->	
		</div> <!-- end panel body -->
	</div> <!-- end panel -->

</div>

