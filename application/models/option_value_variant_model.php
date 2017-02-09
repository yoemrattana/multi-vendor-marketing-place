<?php 
/**
* 
*/
class Option_value_variant_model extends My_Model
{
	protected $table_name = 'optionValueVariant';
	protected $primary_key = 'optionValueVariantID';
	
	function __construct()
	{
		parent::__construct();
	}

/*	function get_by_product_id($product_id){
		$sql = "SELECT a.variantID, a.productID, a.qty, a.price, ";
		$sql .= "(select v1.optionValueName from optionValueVariant as b1, optionValue as v1 where b1.variantID= a.variantID and b1.optionValueID =v1.optionValueID  LIMIT 0,1) as opt1 , ";
		$sql .= "(select v2.optionValueName from optionValueVariant as b2, optionValue as v2 where b2.variantID= a.variantID and b2.optionValueID =v2.optionValueID  LIMIT 1,1) as opt2  ";
		//$sql .= "(select v3.optionValueName from optionValueVariant as b3, optionValue as v3 where b3.variantID= a.variantID and b3.optionValueID =v3.optionValueID  LIMIT 2,1) as opt3  ";
		$sql .= " FROM variant as a";
		$sql .= " WHERE a.productID = ".$product_id."";
		$q = $this->db->query($sql);
				// ->from($this->table_name)
				// ->where('variantID', $variant_id);
		//$q = $this->db->get();
		return $q->result();
	}*/
	function get_by_product_id($product_id){
		$sql = "SELECT a.variantID, a.productID, a.qty, a.price, ";
		$sql .= "(select v1.optionValueName from optionValueVariant as b1, optionValue as v1 where b1.variantID= a.variantID and b1.optionValueID =v1.optionValueID  LIMIT 0,1) as opt1 , ";
		$sql .= "(select v1.optionValueID from optionValueVariant as b1, optionValue as v1 where b1.variantID= a.variantID and b1.optionValueID =v1.optionValueID  LIMIT 0,1) as opt1_id , ";
		$sql .= "(select ot.optionTypeName from optionType as ot, optionValue as ov, optionValueVariant as ovv where ot.optionTypeID = ov.optionTypeID and ov.optionValueID = ovv.optionValueID and ovv.variantID = a.variantID LIMIT 0,1) as opt1_type_name, ";
		$sql .= "(select ot.optionTypeID from optionType as ot, optionValue as ov, optionValueVariant as ovv where ot.optionTypeID = ov.optionTypeID and ov.optionValueID = ovv.optionValueID and ovv.variantID = a.variantID LIMIT 0,1) as opt1_type_id, ";

		$sql .= "(select v2.optionValueName from optionValueVariant as b2, optionValue as v2 where b2.variantID= a.variantID and b2.optionValueID =v2.optionValueID  LIMIT 1,1) as opt2 , ";
		$sql .= "(select v2.optionValueID from optionValueVariant as b2, optionValue as v2 where b2.variantID= a.variantID and b2.optionValueID =v2.optionValueID  LIMIT 1,1) as opt2_id , ";
		$sql .= "(select ot.optionTypeName from optionType as ot, optionValue as ov, optionValueVariant as ovv where ot.optionTypeID = ov.optionTypeID and ov.optionValueID = ovv.optionValueID and ovv.variantID = a.variantID LIMIT 1,1) as opt2_type_name, ";
		$sql .= "(select ot.optionTypeID from optionType as ot, optionValue as ov, optionValueVariant as ovv where ot.optionTypeID = ov.optionTypeID and ov.optionValueID = ovv.optionValueID and ovv.variantID = a.variantID LIMIT 1,1) as opt2_type_id ";
		$sql .= " FROM variant as a";
		$sql .= " WHERE a.productID = ".$product_id."";
		$q = $this->db->query($sql);
				// ->from($this->table_name)
				// ->where('variantID', $variant_id);
		//$q = $this->db->get();
		return $q->result();
	}

	/*
	* Get optionValueVariantID by optionValueName and variantID
	*/
	function get_opt_val_var_id($opt_val_name, $var_id){
		$this->db->select('ovv.optionValueVariantID')
					->from('optionValueVariant as ovv, optionValue as ov')
					->where('ov.optionValueID = ovv.optionValueID')
					->where('ov.optionValueName', $opt_val_name)
					->where('ovv.variantID', $var_id);
		$q = $this->db->get();
		return $q->row();
	}

	/*
	* Delete by variantID **foriegn key
	*/

	function delete_by_variant_id($variant_id){
		$this->db->where('variantID', $variant_id);
        $this->db->delete($this->table_name);
        return TRUE;
	}
	
}
 ?>