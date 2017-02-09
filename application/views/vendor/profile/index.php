

<div class="col-lg-12">
	<h1 class="page-header">My Profile</h1>

	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">User Profile</h3>
		</div>
		<div class="panel-body">
			<div class="col-md-6 col-md-offset-3">
				<table class="table table-condensed">
  					<tr>
  						<td style="width:45%">First Name:</td>
  						<td><?php echo $user->firstname; ?></td>
  					</tr>
  					<tr>
  						<td style="width:45%">Last Name:</td>
  						<td><?php echo $user->lastname; ?></td>
  					</tr>
  					<tr>
  						<td style="width:45%">Email:</td>
  						<td><?php echo $user->email; ?></td>
  					</tr>
  					<tr>
  						<td style="width:45%">Phone:</td>
  						<td><?php echo $user->phone; ?></td>
  					</tr>
  					<tr>
  						<td style="width:45%">Address:</td>
  						<td><?php echo $user->address; ?></td>
  					</tr>
				</table>
				<div class="btn btn-info" data-toggle="modal" data-target="#profile-modal">Edit My Profile</div>
				<div class="btn btn-primary" data-toggle="modal" data-target="#password-modal">Change Password</div>
			</div>
		</div> <!-- end panel body -->
	</div> <!-- end panel -->

</div>



<!-- Bootstrap modal for change password -->
<div class="modal fade" id="password-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header modal-header-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Password Form</h4>
      </div>
      <div class="modal-body">
        	<form id="form-password" method="post" action="<?php echo base_url() ?>vendor/user/change_password">

				<div class="form-group">
					<label for="Firstname">Current Password <i class="asterisk">*</i></label>
					<input type="password" name="current_password" class="form-control validate[required, ajax[ajaxPasswordValidate]]">
				</div>

				<div class="form-group">
					<label for="Lastname">New Password <i class="asterisk">*</i></label>
					<input type="password" id="new_password" name="new_password" class="form-control validate[required, minSize[6]]">
				</div>

				<div class="form-group">
					<label for="password">New Password Again <i class="asterisk">*</i></label>
					<input type="password" name="new_password_again" class="form-control validate[required, equals[new_password]]">
				</div>
				
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        			<button type="submit" class="btn btn-primary">Save changes</button>
			</form>
      </div>
     
    </div>
  </div>
</div>
<!-- End Bootstrap modal for change password -->

<!-- Bootstrap modal for change password -->
<div class="modal fade" id="profile-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header modal-header-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Profile Form</h4>
      </div>
      <div class="modal-body">
        	<form id="form-profile" method="post" action="<?php echo base_url() ?>vendor/user/update" >

				<div class="form-group">
					<label for="Firstname">First Name <i class="asterisk">*</i></label>
					<input type="text" name="first_name" class="form-control validate[required]" value="<?php echo $user->firstname; ?>">
				</div>

				<div class="form-group">
					<label for="Lastname">Last Name <i class="asterisk">*</i></label>
					<input type="text" name="last_name" class="form-control validate[required]" value="<?php echo $user->lastname; ?>">
				</div>

				<!-- <div class="form-group">
					<label for="password">Email <i class="asterisk">*</i></label>
					<input type="text" name="email" class="form-control validate[required, ajax[ajaxEmailValidate]]" value="<?php echo $user->email; ?>">
				</div> -->

				<div class="form-group">
					<label for="password">Phone Number <i class="asterisk">*</i></label>
					<input type="text" name="phone_number" class="form-control validate[required]" value="<?php echo $user->phone; ?>">
				</div>

				<div class="form-group">
					<label for="password">Address <i class="asterisk">*</i></label>
					<textarea class="form-control validate[required]" name="address" id="" cols="20" rows="3"><?php echo $user->address; ?></textarea> 
				</div>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        			<button type="submit" class="btn btn-primary">Save changes</button>
			</form>
      </div>
   
    </div>
  </div>
</div>
<!-- End Bootstrap modal for change password -->