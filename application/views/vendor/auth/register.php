
<div class="col-md-4 col-md-offset-4">
	<div class="login-panel panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Vendor's Register Form</h3>
		</div>
		<div class="panel-body">
			<form role="form">
				<fieldset>
					<div class="form-group">
						<label for="exampleInputEmail1">Email*</label>
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1"><i class="fa fa-at"></i></span>
							<input type="email" name="email" class="form-control validate[required,custom[email] ajax[ajaxEmailValidate]]"  placeholder="Enter email">
						</div>
					</div>
					
					<div class="form-group">
						<label for="exampleInputPassword1">Password*</label>
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-star"></span></span>
							<input type="password" name="pass" class="form-control validate[required, minSize[6]]" id="pass" placeholder="Enter Password">
						</div>       
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Confirm Password*</label>
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-star"></span></span>
							<input type="password" name="cpass" class="form-control validate[required, equals[pass]]" placeholder="Reenter Password">
						</div>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">First name*</label>
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
							<input type="text" name="userName" id="userName" class="form-control validate[required, minSize[4],maxSize[20],ajax[ajaxUserValidate]]" placeholder="Enter Firstname">
						</div>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Last name*</label>
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1"><i class="fa fa-list-alt"></i></span>
							<input type="text" class="form-control validate[required]" name="nameSurname" placeholder="Enter Lastname">
						</div>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Shop Name*</label>
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1"><i class="fa fa-briefcase"></i></span>
							<input type="text" class="form-control validate[required]" name="businessName" placeholder="Enter business name">
						</div>

					</div>

					<div class="form-group">
						<label for="exampleInputEmail1">Phone Number*</label>
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1"><i class="fa fa-phone-square"></i></span>
							<input type="text" class="form-control validate[required]" name="phoneNumber" placeholder="Enter phone number">
						</div>

					</div>
	
					<div class="form-group">
						<label for="exampleInputEmail1">Address*</label>
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
							<input type="text" class="form-control validate[required]" name="address" placeholder="Enter address">
						</div>

					</div>

					<!-- Change this to a button or input when using this as a form -->
					<a href="index.html" class="btn btn-lg btn-success btn-block">Login</a>
				</fieldset>
			</form>
		</div>
	</div>
</div>