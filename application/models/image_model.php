<?php 
/**
* 
*/
class Image_model extends My_Model
{
	protected $table_name = 'image';
	protected $primary_key = 'imageID';

	function __construct()
	{
		parent::__construct();
	}

	/*function get_by_product_id($product_id){
		$this->db->select('*')
				->from($this->table_name)
				->where('productID', $product_id);
		$q = $this->db->get();
		return $q->row();
	}*/
	function get_single_image_by_product_id($product_id){
		$this->db->select('*')
				->from($this->table_name)
				->where('productID', $product_id);
				//->limit(1);
		$q = $this->db->get();
		return $q->row();
	}

	function get_by_product_id($product_id){
		$this->db->select('*')
				->from($this->table_name)
				->where('productID', $product_id);
				//->limit(1);
		$q = $this->db->get();
		return $q->result();
	}
	/*
	* Get image by imageID
	*/

	function get_by_image_id($image_id){
		$this->db->select('*')
				->from($this->table_name)
				->where($this->primary_key, $image_id);
		$q = $this->db->get();
		return $q->row();
	}

	/*
	* inser batch
	*/

	function insert_image($data){
		$this->db->insert_batch($this->table_name, $data);
		return true;
	}

}
 ?>