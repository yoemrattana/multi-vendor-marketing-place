<?php 
/**
* 
*/
class Auth extends CI_controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');
	}

	function admin_login(){
		if(isset($this->session->userdata['admin_logged_in']) && $this->session->userdata['admin_logged_in']==1){
			$this->navigate_page(1);
		}
		$data['main_content'] = 'admin/auth/login';
		$this->load->view('admin/layouts/login', $data);
	}

	function login(){
		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));
		$user_group = $this->input->post('user_group');

		$this->load->model('auth_model');

		$result = $this->auth_model->login($email, $password, $user_group);

		if($result){
			if($user_group == 1){
				$user_data = array(
					'a_user_id' => $result->userID,
					'a_email'		=> $result->email,
					'a_first_name' => $result->firstName,
					'admin_logged_in' => TRUE
				);
			}else{
				$user_data = array(
					'user_id' => $result->userID,
					'email'		=> $result->email,
					'first_name' => $result->firstName,
					'logged_in' => TRUE
				);
			}

			

			$this->session->set_userdata($user_data);
			$this->session->set_flashdata('inform', 'You have been loginned!');

			$this->navigate_page($user_group);

		}else{
			$this->session->set_flashdata('error', 'Incrrect password/email');
			redirect($this->agent->referrer());
		}

	}

	function logout($user_group=null){
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('user_id');
		$this->session->sess_destroy();

		//set message
		$this->session->set_flashdata('inform', 'You have been logged out');
		if($user_group=="1"){
			redirect(base_url().'auth/admin_login.html', 'refresh');
		}
		if($user_group=="2"){
			redirect('vendor/auth/login_view', 'refresh');
		}
		if($user_group=="3"){
			redirect(base_url().'home/index.html', 'refresh');
		}
    	
	}
	function register($user_group = null){

		if(isset($_POST['submit'])){
			$data = array(
				'firstName' => $this->input->post('first_name'),
				'lastName' => $this->input->post('last_name'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'address'=> $this->input->post('address'),
				'password'=> md5($this->input->post('password')),
				'userGroupID' => $user_group,
			);

			$this->load->model('user_model');
			$user_id = $this->user_model->insert($data);


			if($user_id){
				$this->session->set_flashdata('inform', 'Registeration has been successful! Please login');
				if($user_group==3){
					redirect(base_url().'home/login.html');
				}
			}else{
				$this->session->set_flashdata('error', 'Registeration is not successful!');
				redirect(base_url().'home/register.html');
			}
		}

	}


	function navigate_page($user_group){
		switch ($user_group) {
			case '1':
				redirect(base_url().'admin/dashboard/index');
				break;
			case '2':
				redirect(base_url().'vendor/dashboard/index');	
				break;
			case '3': 	
				if($this->cart->contents()==null){
					redirect(base_url().'home/index.html');
				}else{
					redirect(base_url().'home/shopping_cart.html');
				}
				break;
			default:
				# code...
				break;
		}
	}

	function is_exist_password(){
		//$user_id ='';
		$validateValue = $_REQUEST['fieldValue'];
    	$validateId = $_REQUEST['fieldId'];

    	 /* RETURN VALUE */
        $arrayToJs = array();
        $arrayToJs[0] = $validateId;

        $this->load->model('user_model');

        if(isset($this->session->userdata['user_id'])){
        	$user_id = $this->session->userdata('user_id');
        }elseif (isset($this->session->userdata['v_user_id'])) {
        	$user_id =$this->session->userdata('v_user_id');
        }elseif (isset($this->session->userdata['a_user_id'])) {
        	$user_id =$this->session->userdata('a_user_id');
        }
        
    	$result = $this->user_model->is_exist_password($validateValue, $user_id);

        if ($result) {
            $arrayToJs[1] = true;    // RETURN TRUE
            echo json_encode($arrayToJs);    // RETURN ARRAY WITH success
           
        } else {
            $arrayToJs[1] = false;
            echo json_encode($arrayToJs);    // RETURN ARRAY WITH ERROR
           
        }
	}

}
 ?>