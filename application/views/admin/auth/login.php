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
            <form id="form-general" role="form" method="post" action="<?php echo base_url(); ?>auth/login">
                <fieldset>
                	<input type="hidden" name="user_group" value="1">
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

         
        </div>
    </div>
</div>
