<?php 
	/**
	* 
	*/
	class Slider_model extends My_Model
	{
		protected $table_name = 'sliderImage';
		protected $primary_key = 'sliderID';
		function __construct()
		{
			parent::__construct();
		}

		function get_all(){
			$this->db->select('*')
					->from($this->table_name)
					->where('status', 1);
			$q = $this->db->get();
			return $q->result();
		}

		function get_all_slide(){
			$this->db->select('*')
					->from($this->table_name);
				
			$q = $this->db->get();
			return $q->result();
		}

		function get_slide_by_slide_id($slide_id){
			$this->db->select('*')
					->from($this->table_name)
					->where($this->primary_key, $slide_id);
			$q = $this->db->get();
			return $q->row();
		}
	}
 ?>