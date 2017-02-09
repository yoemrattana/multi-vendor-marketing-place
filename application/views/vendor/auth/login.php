<div class="col-md-8 col-md-offset-2">

    <?php if ($this->session->flashdata('password_updated')): ?>
         <?= '<p id="info" class="alert alert-success">' . $this->session->flashdata('password_updated') . '</p>' ?>
    <?php endif; ?>
</div>

<div class="col-md-4 col-md-offset-4">
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Please Sign In</h3>
        </div>
        <div class="panel-body">
            <form id="form-general" role="form" method="post" action="<?php echo base_url(); ?>vendor/auth/login">
                <fieldset>
                    <div class="form-group">
                        <input class="form-control validate[required]" placeholder="E-mail" name="email" type="email" autofocus>
                    </div>
                    <div class="form-group">
                        <input class="form-control validate[required]" placeholder="Password" name="password" type="password" value="">
                    </div>

                     <div class="form-group">
                        <input id="login" name="login" type="submit" class="btn btn-primary" value="Login">
                    </div>
                    
                    <div class="pull-right">
                        <a href="<?php echo base_url() ?>vendor/auth/resset_password.html">Forget password?</a>
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
