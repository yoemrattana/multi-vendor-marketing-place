

<div class="col-lg-12">
	<h1 class="page-header">Shop Setting</h1>

	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Shop Info</h3>
		</div>
		<div class="panel-body">

			<div class="col-md-6 col-md-offset-3">
				<table class="table table-condensed">
  					<tr>
  						<td style="width:45%">Shop Name:</td>
  						<td><?php echo $shop->shopName; ?></td>
  					</tr>
  					
				</table>
				<div class="btn btn-info" data-toggle="modal" data-target="#shop-modal">Edit Shop Name</div>
				
			</div>

		</div> <!-- end panel body -->
	</div> <!-- end panel -->

	<!-- 
		********* Vendor Image********************
	 -->
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Vendor Image</h3>
		</div>
		<div class="panel-body panel-body-section">
			<!-- <div class="col-md-6 col-md-offset-3">
				<table class="table table-condensed">
  					<tr>
  						<td style="width:45%">First Name:</td>
  						<td></td>
  					</tr>
  					<tr>
  						<td style="width:45%">Last Name</td>
  						<td></td>
  					</tr>
  					
				</table>
				<div class="btn btn-info" data-toggle="modal" data-target="#profile-modal">Edit My Profile</div>
				<div class="btn btn-primary" data-toggle="modal" data-target="#password-modal">Change Password</div>
			</div> -->

			<div class="row">
				<div class="col-md-6">
					<?php if($shop->logo!=null): ?>
						<img class="thumbnail" src="<?php echo base_url(); ?>assets/images/logo/<?php echo $shop->logo ?>" width="180px" height="180px">
					<?php else :?>
						<img class="thumbnail" src="<?php echo base_url(); ?>assets/images/logo/logo.jpg" width="180px" height="180px">
					<?php endif ?>
					
					<p>(suggested width:height - 180px:180px*)</p>
				</div>
				<div class="col-md-4">
					<form method="post" action="<?php echo base_url();?>vendor/shop/update" enctype="multipart/form-data">
						<div class="form-group">
							<lable>Vendor Logo</lable>
							<input type="file" name="file">
						</div>
						<div class="form-group">
							<button type="submit" name="upload_logo" class="btn btn-primary">Upload logo</button>
						</div>
					</form>
				</div>
			</div>

			<div class="row banner-row">
				<div class="col-md-6">
					<?php if($shop->banner!=null): ?>
						<img class="thumbnail" src="<?php echo base_url(); ?>assets/images/banner/<?php echo $shop->banner ?>" width="300px" height="150px">
					<?php else :?>
						<img class="thumbnail" src="<?php echo base_url(); ?>assets/images/banner/banner.jpg" width="300px" height="150px">
					<?php endif ?>
					<p>(suggested width:height - 950px:250px*)</p>
				</div>
				<div class="col-md-4">
					<form method="post" action="<?php echo base_url();?>vendor/shop/update" enctype="multipart/form-data">
						<div class="form-group">
							<lable>Vendor Banner</lable>
							<input type="file" name="file">
						</div>
						<div class="form-group">
							<button type="submit" name="upload_banner" class="btn btn-primary">Upload bannaer</button>
						</div>
					</form>
				</div>
			</div>

		</div> <!-- end panel body -->
	</div> <!-- end panel -->


	<!-- 
		********* Vendor Image********************
	 -->


	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Shop Map</h3>
		</div>
		<div class="panel-body">

			<?php echo $map['js']; ?>
			<!-- <form id="map" method="post">
				<input type="text"  id="mapposition" name="mapposition">
				<input type="submit" class="btn btn-primary" value="Search">
			</form> -->
			<?php echo $map['html']; ?>

		</div> <!-- end panel body -->
	</div> <!-- end panel -->


</div><!-- end col-lg-12 -->


<!-- Bootstrap modal for change password -->
<div class="modal fade" id="shop-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header modal-header-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Password Form</h4>
      </div>
      <div class="modal-body">
        	<form id="form-general" method="post" action="<?php echo base_url() ?>vendor/shop/update">
        		<input type="hidden" name="shop_id" value="<?php echo $shop->shopID; ?>">
				<div class="form-group">
					<label for="shopName">Shop Name <i class="asterisk">*</i></label>
					<input type="type" name="shop_name" class="form-control validate[required]">
				</div>

					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        			<button type="submit" class="btn btn-primary">Save changes</button>
			</form>
      </div>
     
    </div>
  </div>
</div>
<!-- End Bootstrap modal for change password -->


			