<div class="col-md-8 col-md-offset-2">

	<?php if ($this->session->flashdata('error')): ?>
   		 <?= '<p id="info" class="alert alert-success">' . $this->session->flashdata('error') . '</p>' ?>
	<?php endif; ?>
</div>

<div class="col-md-4 col-md-offset-4">
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Change Password</h3>
        </div>
        <div class="panel-body">
            <form id="form-pass-change" role="form" method="post" action="<?php echo base_url() ?>vendor/auth/password_change">
                <fieldset>
                  	<div class="form-group">
                                
                        <?php if(isset($email_hash, $email_code)) { ?>
                        <input type="hidden" value="<?php echo $email_hash ?>" name="email_hash"/>
                        <input type="hidden" value="<?php echo $email_code ?>" name="email_code"/>
                        <?php } ?>
                        
                          
                        <input type="hidden" class="form-control" id="email" value="<?php echo (isset($email))?$email:''; ?>" name="email" >
                        
                    </div>

                    <div class="form-group">
                        <input type="password" id="new_password" class="form-control validate[required, minSize[6]]" placeholder="New password" name="password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control validate[required, equals[new_password]]" placeholder="New password again">
                    </div>
            
                     <div class="form-group">
                        <input id="login" name="submit" type="submit" class="btn btn-primary" value="Send">
                    </div>
                    
               
                    <!-- Change this to a button or input when using this as a form -->
                    
                </fieldset>
            </form>

            <script> 
                var flag = "";
                var message = "";
            </script>

            <?php if($this->session->flashdata('error')): ?>
                <script> 
                    var flag = "0";
                    var message = "Error!!! " + "<?php echo $this->session->flashdata('error'); ?>";
                </script>
            
            <?php endif; ?>

            <?php if($this->session->flashdata('inform')): ?>
                <script> 
                    var flag = "1";
                    var message = "Inform!!! " + "<?php echo $this->session->flashdata('inform'); ?>";
                </script>
            
            <?php endif; ?>

        </div>
    </div>
</div>
