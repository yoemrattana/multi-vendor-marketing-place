<?php 
/**
* 
*/
class Profile extends My_Controller
{
	protected $user_id;	
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		parent::is_login_admin();
		$this->user_id = $this->session->userdata['a_user_id'];
	}

	function index(){
		$data['user'] = $this->user_model->get_by_id(1);
		$data['main_content'] = 'admin/profile/index';
		$this->load->view('admin/layouts/main', $data);
		//$user_id = 1;
		if(isset($_POST['submit'])){
			$data = array(
				'firstName' => $this->input->post('firstname'),
				'lastName' => $this->input->post('lastname'),
				//'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'address' => $this->input->post('address'),
			);

			$this->user_model->update($data, $this->user_id);
			$this->session->set_flashdata('inform', 'Your data has been updated!');
			redirect(base_url()."admin/profile/index/");
		}
	}

	function change_password(){
		if(isset($_POST['submit'])){
			//$user_id = '1';
			$data = array(
				'password' => md5($this->input->post('password'))
			);

			$result = $this->user_model->update($data, $this->user_id);
			if($result){
				$this->session->set_flashdata('inform', 'Password has been updated!');
				redirect(base_url()."admin/profile/index");
			}
			
		}
	}
}
 ?>