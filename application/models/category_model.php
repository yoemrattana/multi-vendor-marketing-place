<?php 
/**
* 
*/
class Category_model extends My_Model
{
	protected $table_name = "category";
	protected $primary_key = "categoryID";
	function __construct()
	{
		parent::__construct();
	}

	function get_category(){
			$this->db->select('*')
					->from('category')
					->where('status', 1);
			$q = $this->db->get();
			return $q->result();
	}

	function get_sub_category($parent_id){
		$this->db->select('a.*')
				->from('subCategory as a, category as b')
				->where('b.status', 1)
				->where('a.categoryID', $parent_id)
				->group_by('a.subCategoryID');
		$q = $this->db->get();
		return $q->result();
	}
	/*
	* used in admin
	*/
	function get_all_category(){
		$this->db->select('*')
                ->from('category');
        $q = $this->db->get();
        return $q->result();  
	}

	function get_category_by_id($category_id){
		$this->db->select('*')
                ->from('category')
                ->where('categoryID', $category_id);
        $q = $this->db->get();
        return $q->row();  
	}



	/*
	* The following code is used for front view
	*/

	function get_all_categories(){// use for footer section
		$this->db->select('c.categoryID as parentID, c.categoryName as parent, sc.subCategoryName as child, sc.categoryID as categoryID, sc.slug, c.slug as slug_cat')
				->from('category as c')
				->join('subCategory as sc', 'c.categoryID=sc.categoryID');
				
		$q = $this->db->get();
        return $q->result();
	}

	function get_categories(){
		$this->db->select('*')
                ->from('category')
                ->where('status', 1);
        $q = $this->db->get();
        return $q->result();  
	}

	function get_sub_categories($category_id){
		$this->db->select('*')
                ->from('subCategory')
                ->where('categoryID', $category_id);
        $q = $this->db->get();
        return $q->result();
	}

	/*
	* combine between category and sub category
	*/

	function get_categ_sub(){//not yet to used
		$this->db->select('sub.subCategoryID, c.categoryName, c.categoryID')
				->from('category as c')
				->join('subCategory as sub', 'sub.categoryID = c.categoryID');
		$q = $this->db->get();
        return $q->result();
	}

}
 ?>