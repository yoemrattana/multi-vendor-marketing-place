    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>

    
    
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>assets/js/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>assets/js/sb-admin-2.js"></script>

    <!-- Notification -->
    <script src="<?php echo base_url(); ?>assets/js/lobibox.min.js"></script>

    <!-- Central loader -->
    <script src="<?php echo base_url(); ?>assets/js/center-loader.js"></script>

    <!-- Custom js -->
    <script src="<?php echo base_url(); ?>assets/js/ajax.js"></script>
    
    <!-- Form validation -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.validationEngine.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validationEngine-en.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/formvalidation.js"></script>

    <!--data table-->
    <script type="text/javascript" src="<?=base_url()?>assets/js/datatable/jquery.dataTables.js" ></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/datatable/dataTables.bootstrap.js" ></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/datatable/datatable.js" ></script>
    
    <!-- Bootstrap-switch -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-switch.js"></script>

     <script src="//cdnjs.cloudflare.com/ajax/libs/tinycolor/0.11.1/tinycolor.min.js"></script>
    <!-- Bootstrap-color picker -->
   <!-- <script src="<?php echo base_url(); ?>assets/js/bootstrap.colorpickersliders.js"></script> -->
    
    <!-- Chosen -->
    <script src="<?php echo base_url(); ?>assets/chosen/chosen.jquery.js"></script>

    <!-- Conbination -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.combinations.1.0.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
    
</body>

</html>


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