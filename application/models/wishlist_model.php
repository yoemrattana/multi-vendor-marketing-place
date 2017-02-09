<?php 
/**
* 
*/
class Wishlist_model extends My_Model
{
	protected $table_name = "wishlist";
	protected $primary_key = "wishlistID";

	function __construct()
	{
		parent::__construct();
	}

	function get_wishlist_by_user_id($user_id){
		$this->db->select('w.wishlistID, u.userID, p.productTitle, p.slug, i.imageName')
				->from('wishlist as w, user as u, product as p, image as i')
				->where('w.userID = u.userID')
				->where('w.productID = p.productID')
				->where('i.productID = p.productID')
				->where('p.status = 1')
				->where('u.userID', $user_id)
				->group_by('p.productID');
		$q = $this->db->get();
		return $q->result();
	}

}
 ?>