
<div class="col-lg-12 ">
	<h1 class="page-header">Customer</h1>

	<ol class="breadcrumb">
		<li><a href="<?php echo base_url() ?>admin/dashboard/index"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url() ?>admin/customer/index"><i class="fa fa-table"></i> Customers</a></li>
		<li class="active"><i class="fa fa-plus-square"></i> Edit New Store</li>
	</ol>

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">View customer</h3>
		</div>
		<div class="panel-body bg">
		<div class="block">
			<form  method="post" action="<?php //echo base_url()?>admin/store/edit/<?php //echo $store->userID ?>" id="form-general" enctype="multipart/form-data">

		
				<div class="form-group">
					<label> First Name <i class="asterisk">*</i></label>
					<input type="text" name="firstname" class="form-control validate[required]" value="<?php echo $customer->firstname ?>" disabled>
				</div>

				<div class="form-group">
					<label> Last Name <i class="asterisk">*</i></label>
					<input type="text" name="lastname" class="form-control validate[required]" value="<?php echo $customer->lastname ?>" disabled>
				</div>


				<div class="form-group">
					<label> Email <i class="asterisk">*</i></label>
					<input type="text" name="phone" class="form-control validate[required]" value="<?php echo $customer->email ?>" disabled>
				</div>

				<div class="form-group">
					<label> Phone <i class="asterisk">*</i></label>
					<input type="text" name="phone"  id="disabledInput" disabled class="form-control validate[required]" value="<?php echo $customer->phone ?>">
				</div>

				<div class="form-group">
					<label>Address <i class="asterisk">*</i></label>
					<textarea class="form-control validate[required]" name="address" id="disabledInput" cols="20" rows="3" disabled><?php echo $customer->address ?></textarea> 
				</div>

			<!-- 	<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary">Save Changes</button> 
				</div> -->

			</form>
		</div><!-- end block -->
		</div> <!-- end panel body -->

	</div> <!-- end panel -->

</div>

