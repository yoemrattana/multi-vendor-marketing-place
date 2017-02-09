<?php 
	/**
	* 
	*/
	class My_Model extends CI_Model
	{
		protected $table_name = '';
    	protected $primary_key = '';
    	protected $foriegn_key = '';

		function __construct()
		{
			parent::__construct();	
		}

		function insert($data){
			$success = $this->db->insert($this->table_name, $data);
	        if ($success) {
	            return $this->db->insert_id();
	        } else {
	            return FALSE;
	        }
		}
		function insert_batch($data){
			$this->db->insert_batch($this->table_name, $data);
			return true;
		}

		function update($data, $param){
			$this->db->where($this->primary_key, $param);
	        $this->db->update($this->table_name, $data);
	        return TRUE;
		}

		function update_batch($data, $param){
			//$this->db->where($this->primary_key, $param);
	        //$this->db->update($this->table_name, $data);
	        $this->db->update_batch($this->table_name, $data, $param);
	        return TRUE;
		}

		function update_by_foriegn_key($data, $param){
			$this->db->where($this->foriegn_key, $param);
	        $this->db->update($this->table_name, $data);
	        return TRUE;
		}

		function delete($param){
			$this->db->where($this->primary_key, $param);
        	$this->db->delete($this->table_name);
        	return TRUE;
		}

		function active($param){
			$data = array(
	            'status' => 1
	        );

	        $this->db->where($this->primary_key, $param);
	        $this->db->update($this->table_name, $data);
		}

		function inactive($param){
			$data = array(
	            'status' => 0
	        );

	        $this->db->where($this->primary_key, $param);
	        $this->db->update($this->table_name, $data);
		}
	}
 ?>