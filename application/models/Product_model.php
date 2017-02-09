<?php 
	/**
	* 
	*/
	class Product_model extends My_Model
	{
		protected $table_name = 'product';
		protected $primary_key = 'productID';

		function __construct()
		{
			parent::__construct();
		}

		function get_by_user_id($user_id){
			$this->db->select('product.productID, product.productTitle, product.status, image.imageName')
						->from('product, shop, user, image')
						->where('product.shopID = shop.shopID')
						->where('shop.userID = user.userID')
						->where('image.productID = product.productID')
						//->where('product.status = 1')
						->where('user.userID', $user_id)
						->group_by('product.productID');
			$q = $this->db->get();
			return $q->result();
		}

		function get_by_id($product_id){
			$this->db->select('product.*, category.*, subCategory.*')
						->from('product, category, subCategory')
						->where('product.subCategoryID = subCategory.subCategoryID')
						->where('subCategory.categoryID = category.categoryID')
						->where($this->primary_key, $product_id);
						//->group_by('subCategory.subCategoryID');
			$q = $this->db->get();
			return $q->row();
		}

		function count_product($shop_id){
			$this->db->select('count(productID) as total_product')
						->from('product')
						->where('shopID', $shop_id);
			$q = $this->db->get();
			return $q->row();
		}

		/*
		* get all product ***used in admin
		*/
		function get_all_products(){
			$this->db->select('p.productID, p.productTitle, p.status, p.slug, s.shopName, i.imageName')
					->from('product as p, shop as s, user as u, image as i')
					->where('s.userID = u.userID')
					->where('p.shopID = s.shopID')
					->where('p.productID = i.productID')
					->group_by('p.productID');
			$q = $this->db->get();
			return $q->result();

		}
		
		/*
		* Front-end section
		*
		*/

		function get_product_by_category($category_id, $limit = null, $offset = 0){
			$this->db->select()
					->from($this->table_name);
		}

		function get_all_product(){
			$this->db->select('c.categoryName as parent, c.categoryID as parentID, p.productID, p.productTitle as child, p.productID as childID')
					->from('category as c')
					->join('subCategory as sc', 'sc.categoryID = c.categoryID')
					->join('product as p', 'p.subCategoryID = sc.subCategoryID')
					->where('p.status', 1)
					->order_by('p.productID', 'desc');
			$q = $this->db->get();
			return $q->result();
		}

		function get_product_by_sub_category_slug($sub_category_slug, $from=0, $to=0, $limit=null, $offset=0){
			$this->db->select('p.productTitle, p.productID, p.slug, p.productView, sc.subCategoryName')
					->from('product as p, subCategory as sc, variant as v')
					//->join('subCategory as sc', 'sc.subCategoryID = p.subCategoryID', 'inner')
					//->join('category as c', 'c.categoryID = sc.categoryID', 'inner')
					->where('sc.subCategoryID = p.subCategoryID')
					//->where('c.categoryID = sc.categoryID')
					->where('sc.slug', $sub_category_slug)
					->where('v.productID = p.productID')
					->where('p.status', 1);

					if($from !=0 || $to !=0){
						 $this->db->where('v.price >=', $from);
						 $this->db->where('v.price <=', $to);
						 
					}
					$this->db->group_by('p.productID');
			if($limit != null){
				$this->db->limit($limit, $offset);
			}
			$q = $this->db->get();
			return $q->result();
		}

		function get_product_by_category_id($category_id){
			$this->db->select('p.productTitle, p.productID, p.slug, p.productView')
					->from('product as p, subCategory as sc, category as c')
					//->join('subCategory as sc', 'sc.subCategoryID = p.subCategoryID')
					
					->where('c.categoryID = sc.categoryID')
					
					->where('c.categoryID', $category_id)
					->where('sc.subCategoryID = p.subCategoryID')
					->where('p.status', 1)
					->order_by('p.productID', 'DESC');
			$q = $this->db->get();
			return $q->result();
		}

		function get_product_by_category_slug($category_slug, $from=0, $to=0, $limit=null, $offset=0){
			$this->db->select('p.productTitle, p.productID, p.slug, p.productView, c.categoryName')
					->from('product as p, subCategory as sc, category as c, variant as v')
					//->join('subCategory as sc', 'sc.subCategoryID = p.subCategoryID', 'inner')
					//->join('category as c', 'c.categoryID = sc.categoryID', 'inner')
					->where('sc.subCategoryID = p.subCategoryID')
					->where('c.categoryID = sc.categoryID')
					->where('c.slug', $category_slug)
					->where('v.productID = p.productID')
					->where('p.status', 1)
					->order_by('p.productID', 'DESC');

					if($from !=0 || $to !=0){
						 $this->db->where('v.price >=', $from);
						 $this->db->where('v.price <=', $to);
						 
					}
					$this->db->group_by('p.productID');

			if($limit != null){
				$this->db->limit($limit, $offset);
			}
			$q = $this->db->get();
			return $q->result();
		}

		function count_product_by_category_slug($category_slug){
			$this->db->select('COUNT(p.productID) as num_product')
					->from('product as p')
					->join('subCategory as sc', 'sc.subCategoryID = p.subCategoryID')
					->join('category as c', 'c.categoryID = sc.categoryID')
					->where('c.slug', $category_slug)
					->where('p.status', 1);
			$q = $this->db->get();
			return $q->row();
		}

		function count_product_by_sub_category_slug($sub_category_slug){
			$this->db->select('COUNT(p.productID) as num_product')
					->from('product as p')
					->join('subCategory as sc', 'sc.subCategoryID = p.subCategoryID')
					//->join('category as c', 'c.categoryID = sc.categoryID')
					->where('sc.slug', $sub_category_slug)
					->where('p.status', 1);
			$q = $this->db->get();
			return $q->row();
		}

		function get_product_by_slug($slug){
			$this->db->select('*')
					->from('product')
					->where('slug', $slug);
			$q = $this->db->get();
			return $q->row();
		}

		function get_product_by_store_slug($slug, $limit=null, $offset=0){
			$this->db->select('p.*')
					->from('product as p, shop as s')
					->where('p.shopID = s.shopID')
					->where('s.slug', $slug)
					->where('p.status', 1);
			if($limit != null){
				$this->db->limit($limit, $offset);
			}
			$q = $this->db->get();
			return $q->result();
		}

		function count_product_by_store_slug($slug){
			$this->db->select('COUNT(p.productID) as num_product')
					->from('product as p, shop as s')
					->where('p.shopID = s.shopID')
					->where('s.slug', $slug)
					->where('p.status', 1);
			$q = $this->db->get();
			return $q->row();
		}

		function update_counter($slug){
			$this->db->where('slug', urldecode($slug));
			$this->db->select('productView');
			$count = $this->db->get('product')->row();

			$this->db->where('slug', urldecode($slug));
			$this->db->set('productView', ($count->productView + 1));
			$this->db->update('product');
		}

		function popular_product(){
			$this->db->select('p.productID, p.productTitle, p.productView, p.slug, i.imageName')
					->from('product as p, image as i')
					->where('p.productID = i.productID')
					->order_by('p.productView', 'DESC')
					->group_by('p.productID')
					->limit('8');
			$q = $this->db->get();
			return $q->result();
		}

		function search($keywords, $limit = null, $offset = 0){
			$this->db->select('*')
					->from('product')
					->like('productTitle', $keywords);
			 $this->db->order_by('productID', 'DESC');

			if ($limit != null) {
	            $this->db->limit($limit, $offset);
	        }
	       
	        $query = $this->db->get();
	        return $query->result();
		}

		function range_price($sub_category_slug){
			$this->db->select('MAX(v.price) as max, MIN(v.price) as min')
					->from('product as p')
					->join('subCategory as sc', 'sc.subCategoryID = p.subCategoryID')
					->join('variant as v', 'v.productID = p.productID')
					->where('sc.slug', $sub_category_slug)
					->where('p.status', 1);
			$q = $this->db->get();
			return $q->row();
		}

		function range_price_category($category_slug){
			$this->db->select('MAX(v.price) as max, MIN(v.price) as min')
					->from('product as p')
					->join('subCategory as sc', 'sc.subCategoryID = p.subCategoryID')
					->join('category as c', 'c.categoryID = sc.categoryID')
					->join('variant as v', 'v.productID = p.productID')
					->where('c.slug', $category_slug)
					->where('p.status', 1);
			$q = $this->db->get();
			return $q->row();
		}

	}
 ?>