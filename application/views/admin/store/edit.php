
<div class="col-lg-12 ">
	<h1 class="page-header">Store</h1>

	<ol class="breadcrumb">
		<li><a href="<?php echo base_url() ?>admin/dashboard/index"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url() ?>admin/store/index"><i class="fa fa-table"></i> Stores</a></li>
		<li class="active"><i class="fa fa-plus-square"></i> Edit New Store</li>
	</ol>

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Edit New Store</h3>
		</div>
		<div class="panel-body bg">
		<div class="block">
			<form  method="post" action="<?php echo base_url()?>admin/store/edit/<?php echo $store->userID ?>" id="form-general" enctype="multipart/form-data">

				<div class="form-group">
					<label> Store Name <i class="asterisk">*</i></label>
					<input type="text" name="storename" class="form-control validate[required]" value="<?php echo $store->shopName ?>">
				</div>
				<div class="form-group">
					<label> First Name <i class="asterisk">*</i></label>
					<input type="text" name="firstname" class="form-control validate[required]" value="<?php echo $store->firstname ?>">
				</div>

				<div class="form-group">
					<label> Last Name <i class="asterisk">*</i></label>
					<input type="text" name="lastname" class="form-control validate[required]" value="<?php echo $store->lastname ?>">
				</div>


				<div class="form-group">
					<label> Email <i class="asterisk">*</i></label>
					 <p class="form-control-static"><?php echo $store->email ?></p>
				</div>

				<div class="form-group">
					<label> Phone <i class="asterisk">*</i></label>
					<input type="text" name="phone" class="form-control validate[required]" value="<?php echo $store->phone ?>">
				</div>

				<div class="form-group">
					<label>Address <i class="asterisk">*</i></label>
					<textarea class="form-control validate[required]" name="address" id="" cols="20" rows="3"><?php echo $store->address ?></textarea> 
				</div>

				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary">Save Changes</button> 
				</div>

			</form>
		</div><!-- end block -->

		<div class="block">
			<form method="post" action="<?php echo base_url()?>admin/store/change_password/<?php echo $store->userID ?>" id="form-pass" enctype="multipart/form-data">
				<div class="form-group">
					<label> Password <i class="asterisk">*</i></label>
					<input type="password" id="new_password" name="password" class="form-control validate[required, minSize[6]]">
				</div>

				<div class="form-group">
					<label> Re-Password <i class="asterisk">*</i></label>
					<input type="password" name="re_password" class="form-control validate[required, equals[new_password]]">
				</div>

				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary">Save Changes</button> 
				</div>
			</form>

		</div>
		</div> <!-- end panel body -->

	</div> <!-- end panel -->

</div>

