<?php 
/**
* 
*/
class My_account extends CI_Controller
{
	protected $user_id;

	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->user_id = $this->session->userdata('user_id');
	}

	function index(){
		$data['user'] = $this->user_model->get_by_id($this->user_id);
		$this->load->view('my_account', $data);
	}

	function edit(){

		if(isset($_POST['submit'])){
			$data = array(
				'firstname' => $this->input->post('first_name'),
				'lastname' => $this->input->post('last_name'),
				//'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'address' => $this->input->post('address')	
			);

			$this->user_model->update($data, $this->user_id);

			$this->session->set_flashdata('inform', 'Your personal information has been updated');
			redirect(base_url()."my_account/index.html");
		}
	}

	function change_password(){
		if(isset($_POST['submit'])){
			$data = array(
				'password' =>md5($this->input->post('password')),
			);
			$this->user_model->update($data, $this->user_id);
			$this->session->set_flashdata('inform', 'Your password has been change!');
			redirect(base_url()."my_account/index.html");
		}

		
	}


}
 ?>