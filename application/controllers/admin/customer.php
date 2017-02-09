<?php 
/**
* 
*/
class Customer extends My_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		parent::is_login_admin();
	}

	function index(){
		$data['main_content'] = 'admin/customer/index';
		$this->load->view('admin/layouts/main', $data);
	}

	function get_all_customer(){
		$output = array();
		$this->output->set_content_type('application/json');

		$results = $this->user_model->get_all_customer();

		$data = array();
		foreach($results as $result){
			$nested_data = array();
			$nested_data[] = $result->userID;
			
			$nested_data[] = $result->firstname ." ". $result->lastname;
			$nested_data[] = $result->email;
			$nested_data[] = $result->phone;
			//$nested_data[] = $result->address;

			if ($result->status == 1) {
	        	$nested_data[] = '<span class = "label label-success" aria-hidden = "true">Active</span>';
	    	} else {
	        	$nested_data[] = '<span class = "label label-warning" aria-hidden = "true">Disactive</span>';
	    	}
	    	$nested_data[] = ' <a href = "' . base_url() . 'admin/customer/view/' . $result->userID . '" target="_blank" class = "insert btn btn-sm btn-info" id = "' . $result->userID . '" title = "Edit"><span class = "glyphicon glyphicon-eye-open" aria-hidden = "true"></span> View</a> '
	            . '<a class = "btn btn-sm btn-warning" data-whatever = "' . $result->userID . '" data-toggle="modal" data-target="#status-user-modal" title = "Edit"><span class = "glyphicon glyphicon-cog" aria-hidden = "true"></span> Status</a> '
	            . '<a class = "del-customer btn btn-sm btn-danger" id = "' . $result->userID . '" title = "Delte"><span class = "glyphicon glyphicon-trash" aria-hidden = "true"></span> Delete</a>';

			$data[] = $nested_data;
		}

		$this->output->set_output(json_encode($data));
	}

	function edit_status(){
		$data = array(
			'status' => $this->input->post('status')
		);

		$result = $this->user_model->update($data, $this->input->post('user_id'));
		if($result){
			$this->session->set_flashdata('inform', 'Customer status has been updated!');

			redirect(base_url()."admin/customer/index");
		}
		
	}

	function delete($user_id){
		$result = $this->user_model->delete($user_id);
		if($result){
			$this->session->set_flashdata('inform', 'Customer has been deleted!');
			redirect(base_url()."admin/customer/index");
		}
	}

	function view($customer_id){
		$data['customer'] = $this->user_model->get_by_id($customer_id);
		$data['main_content'] = 'admin/customer/view';
		$this->load->view('admin/layouts/main', $data);
	}
}
 ?>