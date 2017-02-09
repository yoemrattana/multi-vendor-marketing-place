<?php 
	/**
	* 
	*/
	class Home extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->library("pagination");
		}

		function index(){
			$data['sliders'] = $this->get_slider_image();
			//$data['products'] = $this->get_all_products();
			$data['categories_with_products'] = $this->get_category_with_product();
			//$data['category'] = $this->category();
			$this->load->view('home', $data);
		}

		function detail($slug){
			$this->load->model('product_model');

			$this->product_count_view($slug);

			$data['product'] = $this->product_model->get_product_by_slug($slug);
			$product_id = $this->product_model->get_product_by_slug($slug)->productID;
			$shop_id = $this->product_model->get_product_by_slug($slug)->shopID;
			$data['images'] = $this->get_images($product_id);
			$data['variants'] =$this->get_product_varint($product_id);
			$data['shop'] = $this->get_shop_by_shop_id($shop_id);

			$this->load->view('product_detail', $data);
		}

		function shopping_cart(){
			$data['cart_data'] = $this->view_cart();

			$this->load->view('shopping_cart', $data);
			//$this->load->view('shopping_cart');
		}

		function register(){
			$this->load->view('register');
		}

		function login(){
			$this->load->view('login');
		}

		function get_slider_image(){
			$this->load->model('slider_model');
			return $this->slider_model->get_all();
		}

		function get_all_products(){
			$this->load->model('product_model');
			return $this->product_model->get_all_product();	
		}

		function list_stores(){
			$this->load->model('shop_model');
			$data['stores'] = $this->shop_model->get_all_stores();
			$this->load->view('list_stores', $data);
		}

		/*
		* Resgister for store
		*/
		function store_register(){
			$this->load->view('store_register');
		}

		function store($store_slug,  $offset =0){
	/*		$url_controller = base_url()."home/store/".$store_slug;
			$this->load->model('product_model');
			$num_product = $this->product_model->count_product_by_store_slug($store_slug)->num_product;
			$data['page_link'] = $this->paginations($url_controller, $num_product);*/

			$data['products'] = $this->get_product_by_store_slug($store_slug, $offset);
			$store = $data['store'] = $this->get_store_by_store_slug($store_slug);
			$data['map'] = $this->get_map($store->lat, $store->lng);
			$this->load->model('user_model');
			$data['user'] = $this->user_model->get_by_id($store->userID);
			$this->load->view('store', $data);
		}

		function get_store_by_store_slug($shop_slug){
			$this->load->model('shop_model');
			return $this->shop_model->get_shop_by_shop_slug($shop_slug);
		}

		function get_category_with_product(){
			$this->load->model('category_model');
			$cats = $this->category_model->get_categories();
			$output = "";
			
			foreach($cats as $cat){
				


				$output .= "<section class='product-carousel'>";
				//$output .= "<a href='".base_url()."home/get_product_by_category_slug/".$cat->slug."'>";
				$output .= "<h2 class='product-head'><a href='".base_url()."category/".$cat->slug."'>".$cat->categoryName."</a></h2>";
				//$output .= "</a>";
				$output .= "<div class='row'>";
				$output .= "<div class='col-xs-12'>";
				$output .= "<div class='owl-product' class='owl-carousel'>";
				$output .= $this->get_product_by_category_id($cat->categoryID);
				
			}
			return $output;
			
		}

		function get_product_by_category_id($category_id){
			$this->load->model('product_model');
			$products = $this->product_model->get_product_by_category_id($category_id);

			$output = "";
			foreach($products as $product){
				
				$output .= "<div class='item'>";
				$output .= "<div class='product-col'>";
				$output .= "<div class='image'>";
				$output .= "<div class='item-pro'><img src='".base_url()."assets/images/product/".$this->product_image($product->productID)."' alt='product' class='img-pro img-responsive' /></div>";
				$output .= "</div>";
				$output .= "<div class='caption'>";
				$output .= "<h4><a href='".base_url()."product/".$product->slug.".html'>".$product->productTitle."</a></h4>";
				//$output .= "<div class='description'>";
				//$output .= "We are so lucky living in such a wonderful time. Our almost unlimited ...";
				//$output .= "</div>";
				$output .= "<div class='price'>";
				$output .= "<span class='price-new'>".$this->get_product_price($product->productID)."</span> ";
				//$output .= "<span class='price-old'>".$product->productView."</span>";
				$output .= "<span class='fa fa-eye pull-right'> ".$product->productView."</span>";
				$output .= "</div>";
				//$output .= "<div class='cart-button'>";
				//$output .= "<button type='button' class='btn btn-cart'>";
				//$output .= "Add to cart";
				//$output .= "<i class='fa fa-shopping-cart'></i> ";
				//$output .= "</button>";
				//$output .= "</div>";
				// $output .= "<div class='pull-right'>";
				// $output .= $product->productView;
				// $output .= "</div>";
				$output .= "</div>";
				$output .= "</div>";
				$output .= "</div>";
			
			}
				$output .= "</div>";
				$output .= "</div>";
				$output .= "</div>";
				$output .= "</section>";

				return $output;

		}		

		/*
		* get 1 image for each product 
		*/
		
		function product_image($product_id){
			$this->load->model('image_model');
			$result =  $this->image_model->get_single_image_by_product_id($product_id);
			return $result->imageName;
		}
		
		/*
		* Get price for each product
		*/
		
		function get_product_price($product_id){
			$this->load->model('variant_model');
			$result =  $this->variant_model->get_price_by_product_id($product_id);
			//return $result;
			return ($result->minPrice == $result->maxPrice)? "$".$result->minPrice:"From $" . $result->minPrice;
			//echo $price;
		}
		

		/*
		*	Get a collection of each image
		*/
		function get_images($product_id){
			$this->load->model('image_model');
			return $this->image_model->get_by_product_id($product_id);	
		}

		/*
		* get variant product
		*/
		function get_product_varint($product_id){
			$this->load->model('option_value_variant_model');
			return $this->option_value_variant_model->get_by_product_id($product_id);
		}
		/*
		function get_product_by_category_slug($category_slug, $offset =0){
			$url_controller = base_url()."home/get_product_by_category_slug/".$category_slug;
			
			$this->load->model('product_model');
			$data['products'] = $products = $this->product_model->get_product_by_category_slug($category_slug, 6, $offset);
			$num_product = $this->product_model->count_product_by_category_slug($category_slug)->num_product;
			//pagination
			$data['page_link'] = $this->paginations($url_controller, $num_product);

			$output = '';
			$count = 1;
			$output .= '<section class="products-list">';
			foreach($products as $product){
				if($count == 1){
					$output .= '<h2 class="product-head">'. $product->categoryName.'</h2>';
					$output .= '<div class="row">';
					$output .= '<div class="col-md-4 col-sm-6">';
					$output .= '<div class="product-col">';
					$output .= '<div class="image">';
					$output .= '<div class="item-pro"><img src="'.base_url().'assets/images/product/'.$this->product_image($product->productID).'" alt="product" class="img-pro img-responsive"/></div> ';
					$output .= '</div>';
					$output .= '<div class="caption">';
					$output .= '<h4>';
					$output .= '<a href="'.base_url().'product/'.$product->slug.'">'. $product->productTitle. '</a>';
					$output .= '</h4>';
					$output .= '<div class="price">';
					$output .= '<span class="price-new">'.$this->get_product_price($product->productID).'</span> ';
					//$output .= '<span class="price-old">$249.50</span>';
					$output .= '</div>';
					//$output .= '<div class="cart-button">';
					//$output .= '<button type="button" class="btn btn-cart">';
					//$output .= 'Add to cart';
					//$output .= '<i class="fa fa-shopping-cart"></i>';
					//$output .= '</button>';
					//$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';
				}else{
					$output .= '<div class="col-md-4 col-sm-6">';
					$output .= '<div class="product-col">';
					$output .= '<div class="image">';
					$output .= '<div class="item-pro"><img src="'.base_url().'assets/images/product/'.$this->product_image($product->productID).'" alt="product" class="img-pro img-responsive"/> </div>';
					$output .= '</div>';
					$output .= '<div class="caption">';
					$output .= '<h4>';
					$output .= '<a href="'.base_url().'product/'.$product->slug.'">'. $product->productTitle. '</a>';
					$output .= '</h4>';
					$output .= '<div class="price">';
					$output .= '<span class="price-new">'.$this->get_product_price($product->productID).'</span> ';
					//$output .= '<span class="price-old">$249.50</span>';
					$output .= '</div>';
					//$output .= '<div class="cart-button">';
					//$output .= '<button type="button" class="btn btn-cart">';
					//$output .= 'Add to cart';
					//$output .= '<i class="fa fa-shopping-cart"></i>';
					//$output .= '</button>';
					//$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';
				
				}
				$count++;
			}
			$output .= '</div>';
			$output .= '</section>';
			
			$data['product'] = $output;	
			$this->load->view('category', $data);
		}
		*/

		/*
		* get product by sub category
		*/
		/*
		function get_product_by_sub_category_slug($sub_category_slug, $offset=0){
			$url_controller = base_url()."home/get_product_by_sub_category_slug/".$sub_category_slug;

			$this->load->model('product_model');
			$products = $this->product_model->get_product_by_sub_category_slug($sub_category_slug, 6, $offset);

			$num_product = $this->product_model->count_product_by_sub_category_slug($sub_category_slug)->num_product;
			//pagination
			$data['page_link'] = $this->paginations($url_controller, $num_product);

			$output = '';
			$count = 1;
			$output .= '<section class="products-list">';
			foreach($products as $product){
				if($count == 1){
					$output .= '<h2 class="product-head">'. $product->subCategoryName.'</h2>';
					$output .= '<div class="row">';
					$output .= '<div class="col-md-4 col-sm-6">';
					$output .= '<div class="product-col">';
					$output .= '<div class="image">';
					$output .= '<div class="item-pro"><img src="'.base_url().'assets/images/product/'.$this->product_image($product->productID).'" alt="product" class="img-pro img-responsive"/></div> ';
					$output .= '</div>';
					$output .= '<div class="caption">';
					$output .= '<h4>';
					$output .= '<a href="'.base_url().'product/'.$product->slug.'.html">'. $product->productTitle. '</a>';
					$output .= '</h4>';
					$output .= '<div class="price">';
					$output .= '<span class="price-new">'.$this->get_product_price($product->productID).'</span> ';
					//$output .= '<span class="price-old">$249.50</span>';
					$output .= '</div>';
					//$output .= '<div class="cart-button">';
					//$output .= '<button type="button" class="btn btn-cart">';
					//$output .= 'Add to cart';
					//$output .= '<i class="fa fa-shopping-cart"></i>';
					//$output .= '</button>';
					//$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';
				}else{
					$output .= '<div class="col-md-4 col-sm-6">';
					$output .= '<div class="product-col">';
					$output .= '<div class="image">';
					$output .= '<div class="item-pro"><img src="'.base_url().'assets/images/product/'.$this->product_image($product->productID).'" alt="product" class="img-pro img-responsive"/></div> ';
					$output .= '</div>';
					$output .= '<div class="caption">';
					$output .= '<h4>';
					$output .= '<a href="'.base_url().'product/'.$product->slug.'.html">'. $product->productTitle. '</a>';
					$output .= '</h4>';
					$output .= '<div class="price">';
					$output .= '<span class="price-new">'.$this->get_product_price($product->productID).'</span> ';
					//$output .= '<span class="price-old">$249.50</span>';
					$output .= '</div>';
					//$output .= '<div class="cart-button">';
					//$output .= '<button type="button" class="btn btn-cart">';
					//$output .= 'Add to cart';
					//$output .= '<i class="fa fa-shopping-cart"></i>';
					//$output .= '</button>';
					//$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';
				
				}
				$count++;
			}
			$output .= '</div>';
			$output .= '</section>';

			$data['product'] = $output;	

			$this->load->view('sub_category', $data);	
			
		}
		*/


		/*
		* pagination
		*/
		function paginations($url_controller, $row_counts){
			$config = array();
	        $config["base_url"] = $url_controller;
	        $config["total_rows"] = $row_counts;
	        $config["per_page"] = 6;

	        $config['full_tag_open'] = "<ul class='pagination'>";
	        $config['full_tag_close'] = "</ul>";
	        $config['num_tag_open'] = '<li>';
	        $config['num_tag_close'] = '</li>';
	        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
	        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
	        $config['next_tag_open'] = "<li>";
	        $config['next_tagl_close'] = "</li>";
	        $config['prev_tag_open'] = "<li>";
	        $config['prev_tagl_close'] = "</li>";
	        $config['first_tag_open'] = "<li>";
	        $config['first_tagl_close'] = "</li>";
	        $config['last_tag_open'] = "<li>";
	        $config['last_tagl_close'] = "</li>";

	        //$config["uri_segment"] = 3;

	        $this->pagination->initialize($config);

	        return $this->pagination->create_links();
		}

		function get_shop_by_shop_id($shop_id){
			$this->load->model('shop_model');
			return $this->shop_model->get_shop_by_shop_id($shop_id);
		}

		function get_product_by_store_slug($shop_slug, $offset){
			$url_controller = base_url()."home/store/".$shop_slug;
			$this->load->model('product_model');
			$products = $this->product_model->get_product_by_store_slug($shop_slug, 6, $offset);

			$num_product = $this->product_model->count_product_by_store_slug($shop_slug)->num_product;
			//$data['page_link'] = $this->paginations($url_controller, $num_product);

			$output = '';
			$output .= '<section class="products-list">';
			$output .= '<h2 class="product-head">Products</h2>';
			$output .= '<div class="row">';
			foreach($products as $product){
				
					$output .= '<div class="col-md-4 col-sm-6">';
					$output .= '<div class="product-col">';
					$output .= '<div class="image">';
					$output .= '<div class="item-pro"><img src="'.base_url().'assets/images/product/'.$this->product_image($product->productID).'" alt="product" class="img-pro img-responsive"/></div> ';
					$output .= '</div>';
					$output .= '<div class="caption">';
					$output .= '<h4>';
					$output .= '<a href="'.base_url().'product/'.$product->slug.'">'. $product->productTitle. '</a>';
					$output .= '</h4>';
					$output .= '<div class="price">';
					$output .= '<span class="price-new">'.$this->get_product_price($product->productID).'</span> ';
					//$output .= '<span class="price-old">$249.50</span>';
					$output .= '</div>';
					//$output .= '<div class="cart-button">';
					//$output .= '<button type="button" class="btn btn-cart">';
					//$output .= 'Add to cart';
					//$output .= '<i class="fa fa-shopping-cart"></i>';
					//$output .= '</button>';
					//$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';
				
				}
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</section>';
			$output .= $this->paginations($url_controller, $num_product);
			return $output;	

		}

		function get_map($lat, $lng){
    		$this->load->library('googlemaps');

	        $config['center'] = '' . $lat . ', ' . $lng . '';
	        $config['zoom'] = '16';
	        $config['onboundschanged'] = 'if (!centreGot) {
	          var mapCentre = map.getCenter();
	          marker_0.setOptions({
	          position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
	          });
	          }
	          centreGot = true;';
	        $this->googlemaps->initialize($config);

	        $marker = array();
	        $marker['position'] = '' . $lat . ', ' . $lng . '';
	        $this->googlemaps->add_marker($marker);

	        return $this->googlemaps->create_map();
    	}

    	function view_cart(){

	    	$item_array = array();
	    	foreach ($this->cart->contents() as $items) {
	    		$nested_data = array();
	    		$nested_data['rowid'] = $items['rowid'];
	    		$nested_data['item_id'] = $items['id'];
	    		$nested_data['item_name'] = $items['name'];
	    		$nested_data['qty'] = $items['qty'];
	    		$nested_data['price'] = $items['price'];
	    		$nested_data['shop_name'] = $this->cart->product_options($items['rowid'])['shop_name'];
	    		$nested_data['product_slug'] = $this->cart->product_options($items['rowid'])['product_slug'];
	    		$nested_data['shop_id'] = $this->cart->product_options($items['rowid'])['shop_id'];
	    		$nested_data['option_value'] = $this->cart->product_options($items['rowid'])['option_value'];
	    		//$nested_data['count_item'] = count($items['rowid']); 
	    		$item_array[] = $nested_data;
	    	}

	    	$this->aasort($item_array, "shop_name");

	    	$parent = "";
	    	$output = "";
	    	$i = 1;

	    	$test_array = array();
	    	$output .= '<form method="post" id="form-shopping-cart">';
	    	foreach($item_array as $item){

	    		if($item['shop_name'] != $parent){
	    			if($i!=1){
	    				$output .= '</tbody>';
			    		$output .= '</table>';
			    		//$output .= '</form>';
			    		$output .= '</div>';
			    		$output .= '<hr>';
	    			}

	    			$output .= '<p>'.$item['shop_name'].'</p>';
	    			
	    			$output .= '<div class="table-responsive shopping-cart-table">';
	    			//$output .= '<form method="post" id="form-shopping-cart">';
	    			$output .= '<table class="table table-bordered">';
	    			$output .= '<thead>';
	    			$output .= '<tr>';
	    			$output .= '<td class="text-center">';
	    			$output .= 'Product Details';
	    			$output .= '</td>';
	    			$output .= '<td class="text-center">';
	    			$output .= 'Quantity';
	    			$output .= '</td>';
	    			$output .= '<td class="text-center">';
	    			$output .= 'Price';
	    			$output .= '</td>';
	    			$output .= '<td class="text-center">';
	    			$output .= 'Total';
	    			$output .= '</td>';
	    			$output .= '<td class="text-center">';
	    			$output .= 'Action';
	    			$output .= '</td>';
	    			$output .= '</tr>';
	    			$output .= '</thead>';
	    			$output .= '<tbody>';

	    			
	    		}

	    			$output .= '<input type="hidden" name="'.$i . '[rowid]' .'" value="'.$item["rowid"].'"/>';

	    			$output .= '<tr>';

	    			$output .= '<td class="text-center">';
	    			$output .= '<a href="'.base_url().'product/'.$item['product_slug'].'">'.$item['item_name'].'</a>';
	    			$output .= '<p>'.$item['option_value'].'</p>';
	    			$output .= '</td>';

	    			$output .= '<td class="text-center">';
	    			$output .= '<input type="text" item="'.$item['item_id'].'" id="qty_'.$i.'" name="'.$i.'[qty]'.'" value="'.$item['qty'].'" size="1" class="form-control" />';
	    			$output .= '</td>';

	    			$output .= '<td class="text-center">';
	    			$output .= '$'.$item['price'];
	    			$output .= '<input id="price_'.$i.'" type="hidden" value="'.$item['price'].'">';
	    			$output .= '</td>';

	    			$output .= '<td class="text-center">';
	    			//$output .= '$'.$item['qty']*$item['price'].'';
	    			$output .= '<div id="sub_total_'.$i.'"></div>';
	    			$output .= '<input type="hidden" name="sub_total_'.$i.'">';
	    			$output .= '</td>';

	    			$output .= '<td class="text-center">';
	    			$output .= '<button type="submit" title="Update" class="btn btn-default tool-tip btn-update">';
	    			$output .= '<i class="fa fa-refresh"></i>';
	    			$output .= '</button>';
	    			$output .= '<button type="button" id="item_'.$item["rowid"].'" title="Remove" class="btn btn-default tool-tip item_remove">';
	    			$output .= '<i class="fa fa-times-circle"></i>';
	    			$output .= '</button>';
	    			$output .= '</td>';


	    			$output .= '</tr>';

	    		$i++;
	    		$parent = $item['shop_name'];
	    	}
	    		$output .= '</tbody>';
	    		$output .= '</table>';
	    		$output .= '</form>';
	    		$output .= '</div>';
	    		
	    		$output .= '<input type="hidden" id="count_item" value="'.count($this->cart->contents()).'">';

	    		// $output .= '<a '.($this->session->userdata('logged_in')==true? 'href="home"' : base_url().'href="login"').' class="btn btn-primary">';
	    		// $output .= 'Check out';
	    		// $output .= '</a>';
	    		return $output;
    	}

/*    	function kk(){
    			$output = array();
	    		$this->output->set_content_type('application/json');
	    		$result = $this->view_cart();
	    		$this->output->set_output(json_encode($result));
    	}*/

    	function aasort (&$array, $key) {
		    $sorter=array();
		    $ret=array();
		    reset($array);
		    foreach ($array as $ii => $va) {
		        $sorter[$ii]=$va[$key];
		    }
		    asort($sorter);
		    foreach ($sorter as $ii => $va) {
		        $ret[$ii]=$array[$ii];
		    }
		    $array=$ret;
		}

		function product_count_view($slug){
			$this->load->model('product_model');
			$this->load->helper('cookie');
			$check_visitor = $this->input->cookie(urldecode($slug), FALSE); 
			$ip = $this->input->ip_address();
			if ($check_visitor == false) {
				$cookie = array(
					"name" => urldecode($slug),
					"value" => "$ip",
					"expire" => time() + 7200,
					//'domain' => 'http://127.0.0.1/multivendor/',
					"secure" => false
				);
				$this->input->set_cookie($cookie);
				$this->product_model->update_counter(urldecode($slug));
			}

		}

		//search store and product
		function search(){
			$this->load->model('product_model');
			$this->load->model('shop_model');
			if($this->input->post('keywords')!=null){
				if(isset($_POST['type']) && $_POST['type']=='product'){
					//$data['item'] = $this->product_model->search($this->input->post('keywords'), 'productID', 'DESC', 8);
				
					
					$data['item'] = $this->search_product();
					
				}else{
					$data['stores'] = $this->shop_model->search($this->input->post('keywords'), 'shopID', 'DESC', 8);
				}

			}else{
				$data['kq'] = "No item found";
			}

			$this->load->view('search', $data);
			
		}

		function search_product(){
			
			
			$products = $this->product_model->search($this->input->post('keywords'));
			

			if($products){
				$output = '';
				$output .= '<section class="products-list">';
				$output .= '<h2 class="product-head">Products</h2>';
				$output .= '<div class="row">';
				foreach($products as $product){
					
						$output .= '<div class="col-md-4 col-sm-6">';
						$output .= '<div class="product-col">';
						$output .= '<div class="image">';
						$output .= '<div class="item-pro"><img src="'.base_url().'assets/images/product/'.$this->product_image($product->productID).'" alt="product" class="img-pro img-responsive"/></div> ';
						$output .= '</div>';
						$output .= '<div class="caption">';
						$output .= '<h4>';
						$output .= '<a href="'.base_url().'product/'.$product->slug.'">'. $product->productTitle. '</a>';
						$output .= '</h4>';
						$output .= '<div class="price">';
						$output .= '<span class="price-new">'.$this->get_product_price($product->productID).'</span> ';
						$output .= "<span class='fa fa-eye pull-right'> ".$product->productView."</span>";
						$output .= '</div>';

						$output .= '</div>';
						$output .= '</div>';
						$output .= '</div>';
					
					}
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</section>';
				
				return $output;	
			}else{
				return "Item not found";
			}

		}

		//display category on footer
/*		function category(){
			$this->load->model('category_model');
			$items = $this->category_model->get_all_categories();

			$count = 1;
			$parent = "";
			$output = "";
			foreach($items as $item){
				//$parent = $item->parent;
				//$child = $item->child;

				if($parent!=$item->parent){
					//echo $item->parent . "</br>";
					if($count!=1){
						$output .= '</ul>';
						$output .= '</div>';
					}
					$output .= '<div class="col-md-2 col-sm-6">';
					$output .= '<h5>'.$item->parent.'</h5>';
					$output .= '<ul>';
					$count = 1;
				}
				if($count <=4){
					//echo $item->child . "</br>";
					$output .= '<li><a href="'.base_url().'categorys/'.$item->slug.'">'.$item->child.'</a></li>';
				}else{
					//echo $item->child ." No " . "</br>";
				}
				

				$parent=$item->parent;
				$count++;
			}
			return $output;
		}*/

		function test(){
			/*$this->load->model('product_model');
			$results = $this->product_model->popular_product();
			print_r($results);*/
			$this->load->view('search');
			//$this->cart->destroy();
		}
	}
 ?>