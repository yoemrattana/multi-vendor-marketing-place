
<div class="col-lg-12">
	<h1 class="page-header">Store</h1>
    <!-- <a id="btn-add" class="btn btn-primary" href="<?php echo base_url()?>admin/store/add"><i class="fa fa-plus-square"></i> Add New</a> -->

	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Stores List</h3>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-store">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Store</th>
                            <th>Email</th>
                            <th>State</th>
                            <th>Action</th>
                        </tr>
                    </thead>


                </table>
                <!--<div id="pageContent"></div>-->

            </div>
		</div> <!-- end panel body -->
	</div> <!-- end panel -->

</div>


        
<!-- Bootstrap modal for status -->
<div class="modal fade" id="status-store-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header modal-header-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Status Form</h4>
      </div>
      <div class="modal-body">
            <form id="form-general" method="post" action="<?php echo base_url() ?>admin/store/update_status">
                
                <div class="form-group">
                    
                    <input type="hidden" name="user_id" class="form-control validate[required]">
                </div>
                <div class="form-group">
                    <label for="shopName">Status <i class="asterisk">*</i></label>
                    <select name="status" class="form-control">
                        <option value="0">Disactive</option>
                        <option value="1">Active</option>
                    </select>
                </div>

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
      </div>
     
    </div>
  </div>
</div>
<!-- End Bootstrap modal for status -->