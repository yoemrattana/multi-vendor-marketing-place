<?php 

	class Auth extends CI_Controller
	{
		public $username;
		public $password;
		public $user_group;

		function __construct()
		{
			parent::__construct();
		}


		function login_view()
		{	
			if(isset($this->session->userdata['vendor_logged_in']) && $this->session->userdata['vendor_logged_in']==1){
				redirect('vendor/dashboard/index');
			}else{
				$data['main_content'] = 'vendor/auth/login';
				$this->load->view('vendor/layouts/login', $data);
			}
			
		}

		function register_view(){
			$data['main_content'] = 'vendor/auth/register';
			$this->load->view('vendor/layouts/login', $data);
		}

		function resset_password(){
			$data['main_content'] = 'vendor/auth/resset_password';
			$this->load->view('vendor/layouts/login', $data);

			if(isset($_POST['submit'])){
				$email = trim($this->input->post('email'));
		        //get user's firstname
		        $this->load->model('user_model');
		        $first_name = $this->user_model->get_firstname_by_email($email);
		        //send mail
		        $this->send_email($email, $first_name);

		        $this->session->set_flashdata('mail_sent', 'Your email has been sent, please go to your mail in order to reset password');
		        redirect('vendor/auth/resset_password');
			}
		}


		function login()
		{
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));
			$user_group = '2';

			$this->load->model('auth_model');

			$result = $this->auth_model->login($email, $password, $user_group);

			if($result){

				$user_data = array(
					'v_user_id' => $result->userID,
					'v_email'		=> $result->email,
					'vendor_logged_in' => TRUE
				);

				$this->session->set_userdata($user_data);
				redirect('vendor/dashboard/index');
			}else{
				$this->session->set_flashdata('error', 'Incrrect password/email');
				redirect('vendor/auth/login_view');
			}

		}

		function logout(){
			$this->session->unset_userdata('vendor_logged_in');
			$this->session->unset_userdata('v_email');
			$this->session->unset_userdata('v_user_id');
			$this->session->sess_destroy();

			//set message
			$this->session->set_flashdata('inform', 'You have been logged out');
        	redirect('vendor/auth/login_view', 'refresh');
		}

		function is_exist_email(){
			$validateValue = $_REQUEST['fieldValue'];
        	$validateId = $_REQUEST['fieldId'];

        	 /* RETURN VALUE */
	        $arrayToJs = array();
	        $arrayToJs[0] = $validateId;

	        $this->load->model('user_model');
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

	/*	public function reset_password() {
	       
	        $email = trim($this->input->post('email'));
	        //get user's firstname
	        $this->load->model('user');
	        $first_name = $this->user_model->get_firstname_by_email($email);
	        //send mail
	        $this->send_email($email, $first_name);


	    }*/

	    public function send_email($email, $firstname) {

	        $email_code = md5($firstname);
	        //$email_code = $firstname;

	        $config['protocol'] = 'smtp';
	        $config['smtp_host'] = 'ssl://smtp.gmail.com'; //smtp host name
	        $config['smtp_port'] = '465'; //smtp port number
	        $config['smtp_user'] = 'yoemrattana168@gmail.com';
	        $config['smtp_pass'] = 'H4ck3r168#$*'; //$from_email password
	        $config['mailtype'] = 'html';
	        $config['charset'] = 'iso-8859-1';
	        $config['wordwrap'] = TRUE;
	        $config['newline'] = "\r\n"; //use double quotes
	        $this->email->initialize($config);

	        $this->email->set_mailtype('html');
	        $this->email->from('yoemrattana168@gmail.com', 'ezyBuy');
	        $this->email->to($email);
	        $this->email->subject('Password reset.');

	        $message = '<p>Dear ' . $firstname . ',</p>';
	        $message .= '<p>Please reset your password <strong> <a href="' . base_url() . 'vendor/auth/password_change/' . $email . '/' . $email_code . '">click here</a></strong> to reset password.</p>';
	        $message .= '<p>Thank you </p>';
	        $message .= '<p>ezyBuy</p>';

	        $this->email->message($message);
	        $this->email->send();
   		}

   		/*
		* view password change when user want to reset password
   		*/
   		public function password_change($email, $email_code) {
	        if (isset($email, $email_code)) {
	            $email = trim($email);
	            $email_hash = sha1($email, $email_code);
	            $this->load->model('user_model');
	            $verified = $this->user_model->verify_reset_password_code($email, $email_code);

	            if ($verified) {
	                // $data['scripts'] = array('send-mail.js');
	                // $data['title'] = 'Change password';
	                $data['email_hash'] = $email_hash;
	                $data['email'] = $email;
	                $data['email_code'] = $email_code;
	                $data['main_content'] = 'vendor/auth/password_change';
					$this->load->view('vendor/layouts/login', $data);
	                //$this->load->view('admin/login/change_pass_view', array('email_hash' => $email_hash, 'email_code' => $email_code, 'email' => $email));
	                
	            } else {
	                $this->session->set_flashdata('error', 'ERROR!!!');
	        		$data['main_content'] = 'vendor/auth/password_change';
					$this->load->view('vendor/layouts/login');
	            }
	        }

	        if(isset($_POST['submit'])){
	        	$data['password'] = md5($this->input->post('password'));
	        	$this->load->model('user_model');
	        	$result = $this->user_model->change_password_by_email($data, $this->input->post('email'));
	        	if($result){
	        		$this->session->set_flashdata('password_updated', 'Your password has been updated');
	        		redirect('vendor/auth/login_view');
	        	}
	        }
	    }
	    /*
		* change password after user click reset in email
	    */
	  /*  function password_change(){
	    	$data['main_content'] = 'vendor/auth/password_change';
			$this->load->view('vendor/layouts/login', $data);

	    }*/

	}
 ?>