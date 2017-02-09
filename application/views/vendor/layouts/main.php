<?php  $this->load->view("vendor/layouts/includes/header"); ?>


<?php  $this->load->view("vendor/layouts/includes/top-nav"); ?>

<?php  $this->load->view("vendor/layouts/includes/left-nav"); ?>   


        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    
                    <?php $this->load->view($main_content); ?>

                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->



<?php  $this->load->view("vendor/layouts/includes/footer"); ?>