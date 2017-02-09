
<div class="col-lg-12 ">
	<h1 class="page-header">My Products</h1>

	<ol class="breadcrumb">
		<li><a href="<?php echo base_url() ?>vendor/dashboard/index"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url() ?>vendor/product/index"><i class="fa fa-table"></i> Products</a></li>
		<li class="active"><i class="fa fa-plus-square"></i> Add New Product</li>
	</ol>

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Add New Product</h3>
		</div>
		<div class="panel-body bg">
			<form  method="post" action="<?php echo base_url()?>vendor/product/add" id="form-general" enctype="multipart/form-data">
				 <div class="form-group">
					<label> Product Title <i class="asterisk">*</i></label>
					<input type="text" name="product_title" class="form-control validate[required]">
				</div>

				<div class="form-group">
					<label>Category <i class="asterisk">*</i></label>
					<select name="category" id="category" class="form-control validate[required]">
						<option value="">--- Please select ---</option>
						<?php foreach ($categories as $category):?>
							<option value="<?php echo $category->categoryID; ?>​"><?php echo $category->categoryName; ?></option>
						<?php endforeach; ?>
					</select>
				</div>

				<div class="form-group sub_c hidden">
					<label>Sub-category <i class="asterisk">*</i></label>
					<select name="sub_category" id="sub_category" class="form-control validate[required]">
						
					</select>
				</div>

				<!-- <div class="form-group">
					<label>Unit <i class="asterisk">*</i></label>
					<input type="text" name="unit" class="form-control validate[required]">
				</div> -->

				<div class="form-group">
					<label>QTY on hand <i class="asterisk">*</i></label>
					<input type="text" name="qty" class="form-control validate[required]">
				</div>

				<div class="form-group">
					<label>Image <i class="asterisk">*</i></label>
					<input class="validate[required]" type="file" name="images[]"​​​​ multiple>
				
				</div>

				<div class="form-group">
					<label>Price <i class="asterisk">*</i></label>
					<input type="text" name="price" class="form-control validate[required]">
				</div>

				<!-- <div class="form-group">
					<label>Discount price </label>
					<input type="text" name="discount_price" class="form-control validate[required]">
				</div> -->

				

				<div class="form-group">
					<label>Description <i class="asterisk">*</i></label>
					<textarea class="form-control validate[required]" name="description" id="" cols="20" rows="3"></textarea> 
				</div>

				<div class="form-group">
					<label>Customer choices (optional)</label>
					<input type="checkbox" class="switch">
				</div> 

				<!-- <div class="form-group">
					<input type="text" class="form-control" name="color">
				</div> -->

				<div class="form-group" id="color-picker"></div>

				<!-- <div class="form-group">
					<div class="variant-combination"><input type="checkbox"> M / <span>L</span> <input type="text"> <input type="text"></div>
					<div class="variant-combination"><input type="checkbox"> M / <span>L</span> <input type="text"> <input type="text"></div>
				</div> -->
				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary">Save Changes</button> 
				</div>
			</form>
		</div> <!-- end panel body -->
	</div> <!-- end panel -->

</div>


        
<!-- Bootstrap modal for status -->
<div class="modal fade" id="option-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header modal-header-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Password Form</h4>
      </div>
      <div class="modal-body">
        	<form id="form-option-type" method="post" action="">
        		<input type="hidden" name="shop_id" value="">
				<div class="form-group">
					<label>Option Name <i class="asterisk">*</i></label>
					<input type="text" name="option_type_name" class="form-control validate[required]">
				</div>
		
				
				<div class="input_fields_wrap">
				    <a href="#" class="add_field_button">Add More Fields</a>
				    <div><input class="option_field validate[required]" type="text" name="option_value[]"></div>
				</div>


					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        			<button type="submit" class="btn btn-primary">Save changes</button>
			</form>
      </div>
     
    </div>
  </div>
</div>
<!-- End Bootstrap modal for status -->