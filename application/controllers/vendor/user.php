<?php 
	/**
	* 
	*/
	class User extends My_Controller
	{
		/*
		* route 'vendor/profile/(:any) = 'vendor/user/$1'
		*/
		function __construct()
		{
			parent::__construct();
			parent::is_login_vendor();
			$this->load->model('user_model');
		}

		function index(){
			$data['user'] = $this->get_by_id();
			$data['main_content'] = "vendor/profile/index";
			$this->load->view('vendor/layouts/main', $data);
		}

		function get_by_id(){
			$user_id = $this->session->userdata('v_user_id');
			return $this->user_model->get_by_id($user_id);
		}

		/*update user profile*/
		function update(){
			$data = array(
				'firstname' => $this->input->post('first_name'),
				'lastname'	=> $this->input->post('last_name'),
				//'email'		=> $this->input->post('email'),
				'phone'		=> $this->input->post('phone_number'),
				'address'	=> $this->input->post('address') 

			);
			$user_id = $this->session->userdata('user_id');
			$result = $this->user_model->update($data, $user_id);

			$this->encode_json($result, ['result'=>1]);
		}

		function change_password(){
			$data = array(
				'password' => md5($this->input->post('new_password'))
			);

			$user_id = $this->session->userdata('user_id');
			$result = $this->user_model->update($data, $user_id);
			$this->encode_json($result, ['result'=>1]);
		}

		function is_exist_email(){
			$validateValue = $_REQUEST['fieldValue'];
        	$validateId = $_REQUEST['fieldId'];

        	 /* RETURN VALUE */
	        $arrayToJs = array();
	        $arrayToJs[0] = $validateId;

        	$result = $this->user_model->is_exist_email($validateValue);

	        if ($result) {
	            $arrayToJs[1] = false;    // RETURN TRUE
	            echo json_encode($arrayToJs);    // RETURN ARRAY WITH success
	            return false;
	        } else {
	            $arrayToJs[1] = true;
	            echo json_encode($arrayToJs);    // RETURN ARRAY WITH ERROR
	            return false;
	        }
		}
		/*
		* used in reset password form
		*/
		function exist_email(){
			$validateValue = $_REQUEST['fieldValue'];
        	$validateId = $_REQUEST['fieldId'];

        	 /* RETURN VALUE */
	        $arrayToJs = array();
	        $arrayToJs[0] = $validateId;

        	$result = $this->user_model->is_exist_email($validateValue);

	        if ($result) {
	            $arrayToJs[1] = true;    // RETURN TRUE
	            echo json_encode($arrayToJs);    // RETURN ARRAY WITH success
	            return false;
	        } else {
	            $arrayToJs[1] = false;
	            echo json_encode($arrayToJs);    // RETURN ARRAY WITH ERROR
	            return false;
	        }
		}

		function is_exist_password(){
			$validateValue = $_REQUEST['fieldValue'];
        	$validateId = $_REQUEST['fieldId'];

        	 /* RETURN VALUE */
	        $arrayToJs = array();
	        $arrayToJs[0] = $validateId;

	        $user_id = $this->session->userdata('v_user_id');
        	$result = $this->user_model->is_exist_password($validateValue, $user_id);

	        if ($result) {
	            $arrayToJs[1] = true;    // RETURN TRUE
	            echo json_encode($arrayToJs);    // RETURN ARRAY WITH success
	        } else {
	            $arrayToJs[1] = false;
	            echo json_encode($arrayToJs);    // RETURN ARRAY WITH ERROR
	        }
		}

		
		function encode_json($result, $array_data){
			$output = array();
        	$this->output->set_content_type('application/json');
        	if($result){
        		$this->output->set_output(json_encode($array_data));
        		return false;
        	}
		}

		function test(){
			print_r($this->session->userdata('user_id'));
		}

		
	}

 ?>