<?php 
/**
* 
*/
class Products extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('product_model');
		parent::is_login_admin();
	}

	function index(){
		$data['main_content'] =  'admin/product/index';
		$this->load->view('admin/layouts/main', $data);
	}

	function get_all_products(){
		$result = $this->product_model->get_all_products();
		print_r($result);
	}

	function get_all_product(){
		$output = array();
		$this->output->set_content_type('application/json');

		$results = $this->product_model->get_all_products();

		$data = array();
		foreach($results as $result){
			$nested_data = array();
			$nested_data[] = $result->productID;
			$nested_data[] = '<img class="product-image" src="'.base_url().'assets/images/product/'.$result->imageName.'" alt="'.$result->imageName.'">';
			$nested_data[] = $result->shopName;
			$nested_data[] = $result->productTitle;

			if ($result->status == 1) {
	        	$nested_data[] = '<span class = "label label-success" aria-hidden = "true">Active</span>';
	    	} else {
	        	$nested_data[] = '<span class = "label label-warning" aria-hidden = "true">Disactive</span>';
	    	}
	    	$nested_data[] = ' <a href = "' . base_url() . 'product/' . $result->slug . '" target="_blank" class = "insert btn btn-sm btn-info" id = "' . $result->productID . '" title = "Edit"><span class = "glyphicon glyphicon-eye-open" aria-hidden = "true"></span> View</a> '
	            . '<a class = "btn btn-sm btn-warning" data-whatever = "' . $result->productID . '" data-toggle="modal" data-target="#status-product-modal" title = "Edit"><span class = "glyphicon glyphicon-cog" aria-hidden = "true"></span> Status</a> '
	            . '<a class = "del-pro btn btn-sm btn-danger" id = "' . $result->productID . '" title = "Delte"><span class = "glyphicon glyphicon-trash" aria-hidden = "true"></span> Delete</a>';

			$data[] = $nested_data;
		}

		$this->output->set_output(json_encode($data));
	}

	function edit_status(){
		$data = array(
			'status' => $this->input->post('status')
		);

		$result = $this->product_model->update($data, $this->input->post('product_id'));
		if($result){
			$this->session->set_flashdata('inform', 'Your status has been updated!');

			redirect(base_url()."admin/products/index");
		}
		
	}

	function delete($product_id){
		$this->product_model->delete($product_id);
		$this->session->set_flashdata('inform', 'Your product has been deleted successful!');
		redirect(base_url()."admin/products/index");
	}
}
 ?>