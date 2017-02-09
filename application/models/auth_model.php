<?php 
	/**
	* 
	*/
	class Auth_model extends CI_Model
	{
		protected $table_name = 'user';
		protected $primary_key = 'userID';
		
		function __construct()
		{
			parent::__construct();
		}

		function login($email, $password, $user_group)
		{
			$this->db->where('email', $email);
			$this->db->where('password', $password);
			$this->db->where('userGroupID', $user_group);
			$this->db->where('status', 1);
			$this->db->limit('1');

			$q = $this->db->get($this->table_name);

			if($q->num_rows()===1){
				return $q->row();
			}else{
				return FALSE;
			}
		}
		
	
	}
 ?>