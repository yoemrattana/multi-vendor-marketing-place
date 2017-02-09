<?php 
/**
* 
*/
class Shop extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('shop_model');
		$this->load->model('user_model');
		parent::init_slug('shop', 'shopID', 'shopName');
	}

	function add_store(){

		//if($_POST['submit']){
			//personal info
			$data_user = array(
				'firstName' => $this->input->post('firstName'),
				'lastName' => $this->input->post('lastName'),
				'email' => $this->input->post('email'),
				'password' => md5($this->input->post('password')),
				'phone' => $this->input->post('phone'),
				'address' => $this->input->post('address'),
				'userGroupID' => '2'

			);
			$user_id = $this->user_model->insert($data_user);

			$data_store = array(
				'shopName' => $this->input->post('shopName'),
				'userID' => $user_id,
				'slug' => parent::create_slug('shopName' ,$this->input->post('shopName'))
			);

			$store_id = $this->shop_model->insert($data_store);


			if($store_id){
				//$this->send_mail($this->input->post('email'));
				$this->session->set_flashdata('store_registered', 'Your store has been registered successful!');
				redirect('/home/store_register');
			}
		//}
	}

	function send_mail($to_email) {
        $from_email = 'yoemrattana168@gmail.com'; //change this to yours
        $subject = 'Verify Your Email Address';
        $message = 'Dear User,<br /><br />Please click on the below activation link to verify your email address.<br /><br /> ' . base_url() . 'admin/register/verify/' . md5($to_email) . '<br /><br /><br />Thanks<br /> EzyDiscount';

        //configure email settings

        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com'; //smtp host name
        $config['smtp_port'] = '465'; //smtp port number
        $config['smtp_user'] = $from_email;
        $config['smtp_pass'] = 'H4ck3r168#$*'; //$from_email password
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n"; //use double quotes
        $this->email->initialize($config);

        //send mail
        $this->email->from($from_email, 'EzyBuy');
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);

        return $this->email->send();
    }
	
	public function verify($hash = NULL) {
        if ($this->register_model->verifyEmail($hash)) {
            $this->session->set_flashdata('verify_msg', '<div class="alert alert-success text-center">Your Email Address is successfully verified! Please login to access your account!</div>');
            //redirect('authentication/authentication/email_con_success');
            $this->load->view('admin/login/email_con_success_view');
            //echo "good";
        } else {
            $this->session->set_flashdata('verify_msg', '<div class="alert alert-danger text-center">Sorry! There is error verifying your Email Address!</div>');
            //redirect('authentication/authentication/email_con_success');
            $this->load->view('admin/login/email_con_success_view');
            //echo "bad";
        }
    }
}
?>