<?php 
	/**
	* 
	*/
	class Shop_model extends My_Model
	{
		protected $table_name = 'shop';
		protected $primary_key = 'shopID';
		protected $foriegn_key = 'userID';

		function __construct()
		{
			parent::__construct();
		}

		/*
		* param: user_id
		*/
		function get_by_user_id($param){
			$this->db->select('*')
						->from($this->table_name)
						->where($this->foriegn_key, $param)
						->limit('1');
			$q = $this->db->get();
			return $q->row();
		}

		function get_shop_by_order_id($order_id){
			$this->db->select('*')
						->from('shop as s, orders as o')
						->where('s.shopID = o.shopID')
						->where('o.orderID', $order_id)
						->limit('1');
			$q = $this->db->get();
			return $q->row();
		}
		/*
		* The following code is used in admin section	
		*/

		function get_all_store(){
			$this->db->select('*')
					->from('shop as s, user as u')
					->where('s.userID = u.userID');
				
			$q = $this->db->get();
			return $q->result();
		}

		function get_store_by_id($user_id){
			$this->db->select('*')
					->from('shop as s, user as u')
					->where('s.userID = u.userID')
					->where('s.userID', $user_id);
			$q = $this->db->get();
			return $q->row();
		}

		/*
		* The following code is used in front view
		*/

		function get_shop_by_shop_id($shop_id){
			$this->db->select('*')
						->from($this->table_name)
						->where($this->primary_key, $shop_id)
						->limit('1');
			$q = $this->db->get();
			return $q->row();
		}

		function get_all_stores(){
			$this->db->select('*')
						->from($this->table_name);
			$q = $this->db->get();
			return $q->result();
		}

		function get_shop_by_shop_slug($shop_slug){
			$this->db->select('*')
						->from($this->table_name)
						->where('slug', $shop_slug)
						->limit('1');
			$q = $this->db->get();
			return $q->row();
		}

		/*
		*  verify when new vendor
		*/

		/*
		*  search
		*/

		function search($keywords, $id=null, $sort = 'DESC', $limit = null, $offset = 0){
			$this->db->select('*')
					->from('shop')
					->like('shopName', $keywords);
			if ($limit != null) {
	            $this->db->limit($limit, $offset);
	        }
	        if ($id != null) {
	            $this->db->order_by($id, $sort);
	        }
	        $query = $this->db->get();
	        return $query->result();
		}
		
	}
 ?>
