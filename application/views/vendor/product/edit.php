
<div class="col-lg-12">
	<h1 class="page-header">My Products</h1>

	<ol class="breadcrumb">
		<li><a href="<?php echo base_url() ?>vendor/dashboard/index"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url() ?>vendor/product/index"><i class="fa fa-table"></i> Products</a></li>
		<li class="active"><i class="fa fa-plus-square"></i> Edit Product</li>
	</ol>

	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Edit Product</h3>
		</div>
		<div class="panel-body bg">
		<div class="block">
			<form  method="post" action="<?php echo base_url()?>vendor/product/update/<?php echo $product->productID; ?>" id="general-form" enctype="multipart/form-data">
				<div class="form-group">
					<label> Product Title <i class="asterisk">*</i></label>
					<input type="text" name="product_title" class="form-control validate[required]" value="<?php echo $product->productTitle ?>">
				</div>

				<div class="form-group">
					<label>Category <i class="asterisk">*</i></label>
					<select name="category" id="category" class="form-control validate[required]">
						<option value="">--- Please select ---</option>
						<?php foreach ($categories as $category):?>
							<?php if($category->categoryID == $product->categoryID): ?>
								<?php $selected = 'selected'; ?>
							<?php else: ?>
								<?php $selected = '' ;?>
							<?php endif; ?>
							<option value="<?php echo $category->categoryID; ?>​" <?php echo $selected; ?>><?php echo $category->categoryName; ?></option>
						<?php endforeach; ?>
					</select>
				</div>

				<div class="form-group sub_c">
					<label>Sub-category <i class="asterisk">*</i></label>
					<select name="sub_category" id="sub_category" class="form-control validate[required]">
						<?php foreach ($sub_categories as $sub_category):?>
							<?php if($sub_category->subCategoryID == $product->subCategoryID): ?>
								<?php $selected = 'selected'; ?>
							<?php else: ?>
								<?php $selected = '' ;?>
							<?php endif; ?>
							<option value="<?php echo $sub_category->subCategoryID; ?>​" <?php echo $selected; ?>><?php echo $sub_category->subCategoryName; ?></option>
						<?php endforeach; ?>
					</select>
				</div>

				<div class="form-group">
					<label>Description <i class="asterisk">*</i></label>
					<textarea class="form-control validate[required]" name="description" id="" cols="20" rows="3"><?php echo $product->description ?></textarea> 
				</div>

				<?php $option_array = array(); ?>
				<?php foreach($variants as $variant): ?>
					<?php $option_array[] = array(
						'opt1'=> $variant->opt1,
						'opt1_type_name' => $variant->opt1_type_name,
						'opt1_type_id' => $variant->opt1_type_id,
						'opt2'=> $variant->opt2,
						'opt2_type_name' => $variant->opt2_type_name,
						'opt2_type_id' => $variant->opt2_type_id,
						//'opt3'=> $variant->opt3
					); ?>
				<?php endforeach; ?>

				<!-- check this product variant has option or not -->
				<?php if($option_array[0]['opt1']==null): ?>
					<?php foreach($variants as $variant): ?>
						<input type="hidden" name="variant_id" value="<?php echo $variant->variantID; ?>">
						<div class="form-group">
							<label>QTY on hand <i class="asterisk">*</i></label>
							<input type="text" name="qty" class="form-control validate[required]" value="<?php echo $variant->qty ?>">
						</div>
						<div class="form-group">
							<label>Price <i class="asterisk">*</i></label>
							<input type="text" name="price" class="form-control validate[required]" value="<?php echo $variant->price ?>">
						</div>
					<?php endforeach; ?>

					<div class="form-group">
						<label>Customer choices (optional)</label>
						<input type="checkbox" class="switch">
					</div> 
					<div class="form-group" id="color-picker"></div>
				<?php endif; ?>
			</div><!-- end block -->	

			<div class="block">
				Product Image 
				
					<div class="form-group">
						<input type="file" name="images[]"​​​​ multiple>
					</div>
				
				<div class="row">
					<?php foreach($images as $image): ?>
						<div class="col-sm-6 col-md-3">
							<div class = "thumbnail">
	         					<img src="<?php echo base_url(); ?>assets/images/product/<?php echo $image->imageName; ?>" width="200px" height="200px" alt="<?php echo $image->imageName; ?>">
	      					</div>
	      					<div class="caption">
	      						<a id="<?php echo $image->imageID; ?>" class="btn btn-default remove-product-image" href="#"><i class="fa fa-trash-o"> Delete</i></a>
	      					</div>
						</div>
					<?php endforeach; ?>
					
				</div><!-- end row -->
				
				
				
			</div> <!-- endblock -->
			<!-- **NOTE** The condition for delete product variant ****
				Number of product variant of one product >1 , it will delete both optionValueVariant
				, otherwise , if Number of product variant of one product =0 , it will only delete optionValueVariant and keep that one variant
				
			 -->
			 <?php $num_variant = count_variant($product->productID); ?>
			 <?php if($num_variant==1): ?>
			 	<?php $path = base_url().'vendor/variants/delete_option_value_variant/'; ?>
			 <?php endif; ?>

			 <?php if($num_variant>1): ?>
			 	<?php $path = base_url().'vendor/variants/delete/'; ?>
			 <?php endif; ?>

			 

			<!-- check this product variant has option or not -->
			<?php if($option_array[0]['opt1']!=null): ?>
			<div class="block">
				Variants <a class="pull-right" data-toggle="modal" data-target="#variant-modal" href="">Add new variant</a>
				<table class="table">
					<thead>
					
					
					<?php //for($i=0; $i<1; $i++): ?>
						<tr>
							<?php  if($option_array[0]['opt1']!=null):?>
  							<th><?php echo $option_array[0]['opt1_type_name'] ?></th>
  							<?php endif; ?>
  							<?php  if($option_array[0]['opt2']!=null):?>
  							<th><?php echo $option_array[0]['opt2_type_name']?></th>
  							<?php endif; ?>
  							<?php  //if($option_array[0]['opt3']!=null):?>
  							<!-- <th>Opt3</th> -->
  							<?php //endif; ?>
							<th>QTY</th>
  							<th>Price</th>
  							<th>Action</th>
						</tr>
					<?php //endfor; ?>
					</thead>
  					
  					<tbody>
  						<?php foreach($variants as $variant): ?>
  						<tr>
  							<?php  if($option_array[0]['opt1']!=null):?>
  							<td><?php echo $variant->opt1 ?></td>
  							<?php endif; ?>
  							<?php  if($option_array[0]['opt2']!=null):?>
  							<td><?php echo $variant->opt2 ?></td>
  							<?php endif; ?>
  							<?php  //if($option_array[0]['opt3']!=null):?>
  							<!-- <td><?php //echo $variant->opt3 ?></td> -->
  							<?php //endif; ?>
  							<td><?php echo $variant->qty ?></td>
							<td><?php echo $variant->price ?></td>
							<td><a class="btn btn-default" href="<?php echo base_url(); ?>vendor/variants/edit/<?php echo $variant->variantID; ?>"><i class="fa fa-edit"></i> </a> 
								<a class="btn btn-default" href="<?php echo $path.$variant->variantID; ?>"> <i class="fa fa-trash-o"></i> </a></td>
  						<?php endforeach; ?>	
  						</tr>
  					</tbody>
				</table>
			</div><!-- end block -->

			<?php endif; ?>

				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary">Save Changes</button> 
				</div>
			</form>

		</div> <!-- end panel body -->
	</div> <!-- end panel -->

</div>


<!-- Bootstrap modal for add new variant -->
<div class="modal fade" id="variant-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header modal-header-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New product variant</h4>
      </div>
      <div class="modal-body">
        	<form id="form-general" method="post" action="<?php echo base_url() ?>vendor/variants/add">
        		<input type="hidden" name="product_id" value="<?php echo $product->productID; ?>">
        		<?php if($option_array[0]['opt1']!=null): ?>
				<div class="form-group">
					<label for="shopName"><?php echo $option_array[0]['opt1_type_name'] ?> <i class="asterisk">*</i></label>
					<select name="option_value[]" class="form-control">
	 				<option value="">--- Please select ---</option>
	 				<?php foreach($option1 as $ov): ?>
	 					
	 				<option value="<?php echo $ov->optionValueID; ?>"><?php echo $ov->optionValueName; ?></option>
	 				<?php endforeach; ?>
	 			</select>
				</div>
				<?php endif; ?>
				<?php if($option_array[0]['opt2']!=null): ?>
				<div class="form-group">
					<label for="shopName"><?php echo $option_array[0]['opt2_type_name'] ?> <i class="asterisk">*</i></label>
					<select name="option_value[]" class="form-control">
	 				<option value="">--- Please select ---</option>
	 				<?php foreach($option2 as $ov): ?>
	 					
	 				<option value="<?php echo $ov->optionValueID; ?>"><?php echo $ov->optionValueName; ?></option>
	 				<?php endforeach; ?>
	 			</select>
				</div>
				<?php endif; ?>
				<div class="form-group">
					<label>QTY on hand <i class="asterisk">*</i></label>
					<input type="text" name="qty" class="form-control validate[required]" >
				</div>
				<div class="form-group">
					<label>Price <i class="asterisk">*</i></label>
					<input type="text" name="price" class="form-control validate[required]">
				</div>
				
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        			<button type="submit" name="submit" class="btn btn-primary">Save changes</button>
			</form>
      </div>
     
    </div>
  </div>
</div>
<!-- End Bootstrap modal -->

