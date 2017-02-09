<?php 
/**
* 
*/
class Store extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('shop_model');
		$this->load->model('user_model');

		parent::init_slug('shop', 'shopID', 'shopName');

		parent::is_login_admin();
	}

	function index(){
		$data['main_content'] = 'admin/store/index';
		$this->load->view('admin/layouts/main', $data);
	}

	function get_all_store(){

		$output = array();
    	$this->output->set_content_type('application/json');

    	$results = $this->shop_model->get_all_store();

    	$data = array();
    	foreach($results as $result){
    		$nested_data = array();
    		$nested_data[] = $result->userID;
    		$nested_data[] = $result->shopName;
    		$nested_data[] = $result->email;

    		if ($result->status == 1) {
            	$nested_data[] = '<span class = "label label-success" aria-hidden = "true">Active</span>';
        	} else {
            	$nested_data[] = '<span class = "label label-warning" aria-hidden = "true">Disactive</span>';
        	}
        	$nested_data[] = ' <a href = "' . base_url() . 'store/' . $result->slug . '" target="_blank" class = "insert btn btn-sm btn-info" id = "' . $result->slug . '" title = "Edit"><span class = "glyphicon glyphicon-eye-open" aria-hidden = "true"></span> View</a> '
        	/*' <a href = "' . base_url() . 'admin/store/edit/' . $result->userID . '" class = "insert btn btn-sm btn-info" id = "' . $result->userID . '" title = "Edit"><span class = "glyphicon glyphicon-edit" aria-hidden = "true"></span> Edit</a> '*/
                . '<a class = "btn btn-sm btn-warning" data-whatever = "' . $result->userID . '" data-toggle="modal" data-target="#status-store-modal" title = "Edit"><span class = "glyphicon glyphicon-cog" aria-hidden = "true"></span> Status</a> '
                . '<a class = "del-store btn btn-sm btn-danger" id = "' . $result->userID . '" title = "Delte"><span class = "glyphicon glyphicon-trash" aria-hidden = "true"></span> Delete</a>';

    		$data[] = $nested_data;
    	}

    	$this->output->set_output(json_encode($data));
	}

	function add(){
		$data['main_content'] = 'admin/store/add';
		$this->load->view('admin/layouts/main', $data);

		if(isset($_POST['submit'])){
			$data = array(
				'firstName' => $this->input->post('firstname'),
				'lastName' => $this->input->post('lastname'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'address' => $this->input->post('address'),
				'password' => md5($this->input->post('password')),
				'userGroupID' => 2
			);
			
			$user_id = $this->user_model->insert($data);

			$data_store = array(
				'shopName' => $this->input->post('storename'),
				'userID' => $user_id
			);
			$data_store['slug'] = parent::create_slug('shopName' ,$this->input->post('storename'));
			$this->shop_model->insert($data_store);

			$this->session->set_flashdata('inform', 'New Store has been created!');
			redirect(base_url()."admin/store/index");
		}
	}

	function edit($user_id){
		$data['store'] = $this->shop_model->get_store_by_id($user_id);
		$data['main_content'] = 'admin/store/edit';
		$this->load->view('admin/layouts/main', $data);

		if(isset($_POST['submit'])){
			$data = array(
				'firstName' => $this->input->post('firstname'),
				'lastName' => $this->input->post('lastname'),
				//'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'address' => $this->input->post('address'),
				'userGroupID' => 2
			);

			$this->user_model->update($data, $user_id);
			$this->session->set_flashdata('inform', 'Your data has been updated!');
			redirect(base_url()."admin/store/edit/".$user_id);
		}
	}

	function change_password($user_id){
		if(isset($_POST['submit'])){
			$data = array(
				'password' => md5($this->input->post('password'))
			);

			$result = $this->user_model->update($data, $user_id);
			if($result){
				$this->session->set_flashdata('inform', 'Password has been updated!');
				redirect(base_url()."admin/store/edit/".$user_id);
			}
			
		}
	}

	function delete($user_id){
		$result = $this->user_model->delete($user_id);
		if($result){
			$this->session->set_flashdata('inform', 'Store has been deleted!');
			redirect(base_url()."admin/store/index");
		}
		
	}

	function update_status(){
		$data = array(
			'status' => $this->input->post('status')
		);
		
		$result = $this->user_model->update($data, $this->input->post('user_id'));
		if($result){
			$this->session->set_flashdata('inform', 'Status has been updated!');
			redirect(base_url()."admin/store/index");
		}
		
	}
}
 ?>