<?php 
/**
* 
*/
class Order_detail_model extends My_Model
{
	protected $table_name = "orderDetail";
	protected $primary_key = "orderID";

	function __construct()
	{
		parent::__construct();
	}

	function get_order_detail_by_order_id($order_id){
		$sql = "SELECT a.variantID, a.price, ";
		$sql .= "(select v1.optionValueName from optionValueVariant as b1, optionValue as v1 where b1.variantID= a.variantID and b1.optionValueID =v1.optionValueID  LIMIT 0,1) as opt1 , ";
		$sql .= "(select v2.optionValueName from optionValueVariant as b2, optionValue as v2 where b2.variantID= a.variantID and b2.optionValueID =v2.optionValueID  LIMIT 1,1) as opt2 , ";
		//$sql .= "(select v3.optionValueName from optionValueVariant as b3, optionValue as v3 where b3.variantID= a.variantID and b3.optionValueID =v3.optionValueID  LIMIT 2,1) as opt3  ";
		$sql .= "(select p.productTitle from product as p where p.productID = a.productID) as productTitle , ";
		$sql .= "(select o.qty from orderDetail as o where o.variantID = a.variantID and o.orderID = ".$order_id. " ) as qty  ";
		$sql .= " FROM variant as a , orderDetail as o";
		$sql .= " WHERE o.variantID = a.variantID ";
		$sql .= " AND o.orderID = ".$order_id."";
		$q = $this->db->query($sql);
		return $q->result();
	}
}
 ?>