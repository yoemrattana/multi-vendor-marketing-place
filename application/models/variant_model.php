<?php 
/**
* 
*/
class Variant_model extends My_Model
{
	protected $table_name = 'variant';
	protected $primary_key = 'variantID';

	function __construct()
	{
		parent::__construct();
	}

	/*
	* Get variant by variant id
	*/

	function get_by_variant_id($variant_id){
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
		$sql .= " WHERE a.variantID = ".$variant_id."";
		$q = $this->db->query($sql);
		return $q->row();
	}

	/*
	* Count variant by productID
	*/

	function count_variant($product_id){
		$this->db->select('COUNT(variantID) as num_variant')
				->from($this->table_name)
				->where('productID', $product_id);
		$q = $this->db->get();
		return $q->row();
	}

	/*
	* The following code is used in front view
	*/
	function get_price_by_product_id($product_id){
		$this->db->select('MAX(price) as maxPrice, MIN(price) as minPrice')
				->from($this->table_name)
				->where('productID', $product_id);
		$q = $this->db->get();
		return $q->row();
	}

	function update_qty($qty, $id){
		$this->db->where($this->primary_key, $id);
		$this->db->set('qty', 'qty-'.$qty, false);
		$this->db->update($this->table_name);
	}

	//check qty 

	function get_by_id($variant_id){
		$this->db->select('*')
				->from($this->table_name)
				->where($this->primary_key, $variant_id);
		$q = $this->db->get();
		return $q->row();
	}


}
 ?>