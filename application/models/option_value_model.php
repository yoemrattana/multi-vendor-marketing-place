<?php 
/**
* 
*/
class Option_value_model extends My_Model
{
	protected $table_name = 'optionValue';
	protected $primary_key = 'optionValueID';

	function __construct()
	{
		parent::__construct();
	}

/*	function get_by_option_id($option_id){
		$this->db->select('*')
				->from($this->table_name)
				->where('optionTypeID', $option_id);
		$q = $this->db->get();
		return $q->result();
	}*/

	function get_by_option_name($option_name){
		$this->db->select('ov.*')
				->from('optionValue as ov, optionType as ot')
				->where('ot.optionTypeID = ov.optionTypeID')
				->where('ot.optionTypeName', $option_name);
		$q = $this->db->get();
		return $q->result();
	}

	function get_by_option_id($option_id){
		$this->db->select('ov.*')
				->from('optionValue as ov, optionType as ot')
				->where('ot.optionTypeID = ov.optionTypeID')
				->where('ot.optionTypeID', $option_id);
		$q = $this->db->get();
		return $q->result();
	}


}
 ?>