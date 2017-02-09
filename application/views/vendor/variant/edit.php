
</br>

<div class="col-lg-4">
	<div class="block">
		<?php echo product_h($variant->productID)->productTitle; ?>
		
		</br>
		<a href="<?php echo base_url(); ?>vendor/product/update/<?php echo $variant->productID; ?>">Back to product</a>
	</div>

	<div class="block">
	<ul>
		<?php foreach($variant_values as $vv): ?>
			<li><a href="<?php echo base_url(); ?>vendor/variants/edit/<?php echo $vv->variantID; ?>"><?php echo $vv->opt1;  ?> / <?php echo $vv->opt2;  ?></a></li>
		<?php endforeach; ?>
	</ul>
	</div>
</div><!-- end col-lg-9 -->

<div class="col-lg-8">
 	<div class="block">
 		Options	
 		<div>
 			<?php //echo option_h($variant->opt1); ?>
 		</div>
 		

 		<?php //echo opt_val_var_id_h($variant->opt1, $variant->variantID); ?>
 		<?php //echo opt_val_var_id_h($variant->opt2, $variant->variantID); ?>

 		<?php //print_r($variant); ?>



 		
 		<form method="post" action="<?php echo base_url(); ?>vendor/variants/edit/<?php echo $variant->variantID; ?>">
	 		<?php if(isset($variant->opt1)): ?>
	 			<input type="hidden" name="opt1_val_var_id" value="<?php echo opt_val_var_id_h($variant->opt1, $variant->variantID); ?>">
	 		<div class="form-group">
	 			<label><?php echo $variant->opt1_type_name; ?></label>
	 			<select name="opt1" class="form-control">
	 				<option value="">--- Please select ---</option>
	 				<?php foreach($option1 as $ov): ?>
	 					<?php if($variant->opt1 == $ov->optionValueName): ?>
	 						<?php $selected = 'selected'; ?>
	 					<?php else: ?>
	 						<?php $selected = '' ;?>
	 					<?php endif; ?>
	 				<option value="<?php echo $ov->optionValueID; ?>" <?php echo $selected; ?>><?php echo $ov->optionValueName; ?></option>
	 				<?php endforeach; ?>
	 			</select>
	 		</div>
	 		<?php endif; ?>

	 		<?php if(isset($variant->opt2)): ?>
	 			<input type="hidden" name="opt2_val_var_id" value="<?php echo opt_val_var_id_h($variant->opt2, $variant->variantID); ?>">
	 		<div class="form-group">
	 			<label><?php echo $variant->opt2_type_name; ?></label>
	 			<select name="opt2" class="form-control">
	 				<option value="">--- Please select ---</option>
	 				<?php foreach($option2 as $ov): ?>
	 					<?php if($variant->opt2 == $ov->optionValueName): ?>
	 						<?php $selected = 'selected'; ?>
	 					<?php else: ?>
	 						<?php $selected = '' ;?>
	 					<?php endif; ?>
	 				<option value="<?php echo $ov->optionValueID; ?>" <?php echo $selected; ?>><?php echo $ov->optionValueName; ?></option>
	 				<?php endforeach; ?>
	 			</select>
	 		</div>
	 		<?php endif; ?>

	 		<div class="form-group">
				<label>QTY on hand <i class="asterisk">*</i></label>
				<input type="text" name="qty" class="form-control validate[required]" value="<?php echo $variant->qty ?>">
			</div>
			<div class="form-group">
				<label>Price <i class="asterisk">*</i></label>
				<input type="text" name="price" class="form-control validate[required]" value="<?php echo $variant->price ?>">
			</div>
			<div class="form-group">
				<input class="btn btn-default" name="submit" type="submit" value="Save change">
			</div>
		</form>
 	</div><!-- end block -->
</div><!-- end col-8 -->
