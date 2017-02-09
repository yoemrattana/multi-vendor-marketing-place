<div class="col-md-8 col-md-offset-2">

	<?php if ($this->session->flashdata('mail_sent')): ?>
   		 <?= '<p id="info" class="alert alert-success">' . $this->session->flashdata('mail_sent') . '</p>' ?>
	<?php endif; ?>
</div>

<div class="col-md-4 col-md-offset-4">
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Resset Password</h3>
        </div>
        <div class="panel-body">
            <form id="form-pass-resset" role="form" method="post" action="<?php echo base_url() ?>vendor/auth/resset_password">
                <fieldset>
                    <div class="form-group">
                        <input class="form-control validate[required]" placeholder="E-mail" name="email">
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
