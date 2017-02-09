<?php
class Option_model extends My_model{

	protected $table_name = "optionType";
	protected $primary_key = "optionTypeID";
	
	function  __construct(){
		parent::__construct();
	}


	function get_by_shop_id($shop_id){
		$this->db->select('*')
				->from('optionType')
				->where('shopID', $shop_id);
		$q= $this->db->get();
		return $q->result();
	}

	function get_by_option_id($option_type_id){
		$this->db->select('*')
				->from('optionType as ot, optionValue as ov')		
				->where('ov.optionTypeID = ot.optionTypeID')
				->where('ot.optionTypeID', $option_type_id);
		$q = $this->db->get();
		return $q->result();
	}

	function get_by_value_variant($opt_value_id){//this function used in helper
		$this->db->select('ot.optionTypeName')
				->from('optionType as ot, optionValue as ov, optionValueVariant as ovv')
				->where('ovv.optionValueID = ov.optionValueID')
				->where('ov.optionTypeID = ot.optionTypeID')
				->where('ov.optionValueName', $opt_value_id);
		$q = $this->db->get();
		return $q->row();
	}


/*	function get_by_value_variant($opt_value_id, $shop_id){
		$this->db->select('ot.optionTypeName')
				->from('optionType as ot, optionValue as ov, optionValueVariant as ovv, shop as s')
				->where('ovv.optionValueID = ov.optionValueID')
				->where('ov.optionTypeID = ot.optionTypeID')
				->where('s.shopID = ot.shopID')
				->where('s.shopID', $shop_id)
				->where('ov.optionValueName', $opt_value_id);
		$q = $this->db->get();
		return $q->row();
	}*/

	

}

?>