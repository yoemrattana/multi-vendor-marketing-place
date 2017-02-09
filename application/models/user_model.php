<?php 
	/**
	* 
	*/
	class User_model extends My_Model
	{
		protected $table_name = 'user';
		protected $primary_key = 'userID';

		function __construct()
		{
			parent::__construct();
		}

		/*
		* param: user_id
		*/
		function get_by_id($param){
			$this->db->select('*')
						->from($this->table_name)
						->where($this->primary_key, $param)
						->limit('1');
			$q = $this->db->get();
			return $q->row();
		}


		function is_exist_email($email){
			$this->db->select('email')
						->from($this->table_name)
						->where('email', $email)
						->limit('1');
			$q = $this->db->get();
			return $q->row();
		}

		function is_exist_password($password, $user_id){
			$en_password = md5($password);
			$this->db->select('password')
						->from($this->table_name)
						->where('password', $en_password)
						->where('userID', $user_id)
						->limit('1');
			$q = $this->db->get();
			return $q->row();
		}

		//used in reset password
	    function get_firstname_by_email($email) {
	        $this->db->select('firstName, email')->from('user')->where('email', $email)->limit(1);
	        //$sql = "SELECT username, email FROM users WHERE email = '{$email}' LIMIT 1";
	        $result = $this->db->get();
	        $row = $result->row();

	        return ($result->num_rows() === 1 && $row->email) ? $row->firstName : false;
	    }
	    /*
		* when user reset their password via email, it will give encrypt firstname ($code)
	    */
	    public function verify_reset_password_code($email, $code) {
	        $this->db->select('firstName, email')->from('user')->where('email', $email)->limit(1);
	        //$sql = "SELECT username, email FROM users WHERE email = '{$email}' LIMIT 1";
	        $result = $this->db->get();
	        $row = $result->row();
	        if ($result->num_rows() === 1) {
	            return ($code == md5($row->firstName)) ? true : false;
	        } else {
	            return false;
	        }
	    }

	    function change_password_by_email($data, $email){
	    	$this->db->where('email', $email);
	    	$this->db->update('user', $data);
	    	return ture;
	    }

	    /*
		* the following code is used in admin section
	    */

	    function get_all_customer(){
	    	$this->db->select('*')
	    			->from('user')
	    			->where('userGroupID', 3);
	    	$q = $this->db->get();
	    	return $q->result();
	    }

	}
 ?>
