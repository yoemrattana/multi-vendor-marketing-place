<?php 
/**
* 
*/
class Order_model extends My_Model
{
	protected $table_name = 'orders';
	protected $primary_key = 'orderID';

	function __construct()
	{
		parent::__construct();
	}

	function get_order_by_shop_id($shop_id){
		$this->db->select('orders.*, user.firstName, user.lastName')
				->from('orders, shop, user')
				->where('orders.shopID = shop.shopID')
				->where('user.userID = orders.userID')
				->where('shop.shopID', $shop_id)
				->order_by('orders.orderID', 'DESC');
		$q = $this->db->get();
		return $q->result();
	}
/*
* The following code is used in admin
*/
	function get_all_order(){
		$this->db->select('orders.*, user.firstName, user.lastName, shop.shopName')
				->from('orders, shop, user')
				->where('orders.shopID = shop.shopID')
				->where('user.userID = orders.userID')
				->order_by('orders.orderID', 'DESC');
		$q = $this->db->get();
		return $q->result();
	}


}
 ?>