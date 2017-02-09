<?php 
	/**
	* 
	*/
	class Product extends My_Controller
	{
		protected $user_id;
		protected $shop_id;

		function __construct()
		{
			parent::__construct();
			parent::is_login_vendor();
			
			$this->load->model('product_model');
			$this->load->model('category_model');
			$this->load->model('image_model');
			$this->load->model('option_value_model');
			parent::init_slug('product', 'productID', 'productTitle');
			$this->user_id = $this->session->userdata('v_user_id');
			$this->shop_id = $this->get_shop_id();
		}
		

		function index(){
			
			$data['main_content'] = 'vendor/product/index';
			$this->load->view('vendor/layouts/main', $data);
		}

		function get_by_user_id(){
			$output = array();
        	$this->output->set_content_type('application/json');

        	$results = $this->product_model->get_by_user_id($this->user_id);

        	$data = array();
        	foreach($results as $result){
        		$nested_data = array();
        		$nested_data[] = $result->productID;
        		$nested_data[] = '<img class="product-image" src="'.base_url().'assets/images/product/'.$result->imageName.'" alt="'.$result->imageName.'">';
        		$nested_data[] = $result->productTitle;

        		if ($result->status == 1) {
                	$nested_data[] = '<span class = "label label-success" aria-hidden = "true">Active</span>';
            	} else {
                	$nested_data[] = '<span class = "label label-warning" aria-hidden = "true">Disactive</span>';
            	}
            	$nested_data[] = ' <a href = "' . base_url() . 'vendor/product/update/' . $result->productID . '" class = "insert btn btn-sm btn-info" id = "' . $result->productID . '" title = "Edit"><span class = "glyphicon glyphicon-edit" aria-hidden = "true"></span> Edit</a> '
                    . '<a class = "btn btn-sm btn-warning" data-whatever = "' . $result->productID . '" data-toggle="modal" data-target="#status-product-modal" title = "Edit"><span class = "glyphicon glyphicon-cog" aria-hidden = "true"></span> Status</a> '
                    . '<a class = "del-product btn btn-sm btn-danger" id = "' . $result->productID . '" title = "Delte"><span class = "glyphicon glyphicon-trash" aria-hidden = "true"></span> Delete</a>';
        		$data[] = $nested_data;
        	}

        	$this->output->set_output(json_encode($data));
		}
		/*
		* add new product
		*/
		function add(){
			$data['categories'] = $this->get_category();
			$data['main_content'] = 'vendor/product/add';
			$this->load->view('vendor/layouts/main', $data);

			if(isset($_POST['submit'])){
				$data_input = array(
					'productTitle' 	=> $this->input->post('product_title'),
					'description'	=> $this->input->post('description'),
					'subCategoryID'	=> $this->input->post('sub_category'),
					'shopID'		=> $this->shop_id
        		);
				//Create slug
        		$data_input['slug'] = parent::create_slug('productTitle' ,$this->input->post('product_title'));
        		//insert product info
        		$product_id = $this->product_model->insert($data_input);
        		//insert color
        		/*if(isset($_POST['colors'])){
        			$this->insert_color($_POST['colors'], $product_id);
        		}*/

        		//insert default variant
    			$variant_id = $this->insert_variant($product_id);

    			// insert OptionVariantValue
    			if(isset($_POST['option_value'])){
    				$this->insert_option_value_variant($_POST['option_value'], $variant_id);
    			}

        		//upload image file	
    			if(empty($_FILES['images']['name'])){
        			$this->session->set_flashdata('error', $upload['error']);
        			redirect('vendor/product/add');
        		}else{
        			$path = './assets/images/product';
        			$files = parent::do_multi_upload($path);

        			if(isset($files['error'])){
        				$this->session->set_flashdata('error', $upload['error']);
        				redirect('vendor/product/add');
        			}else{
        				$file_data = array();
        				foreach($files as $file){
        					$file_data[] = array(
        						'imageName' => $file,
        						'productID' => $product_id
        					);
        				}
        				
        				//insert image file
        				$this->load->model('image_model');
        				$image_insert = $this->image_model->insert_image($file_data);

        				if($image_insert){
							$this->session->set_flashdata('inform', 'Data has been inserted successful!');
							redirect(base_url().'vendor/product/update/'.$product_id);
						}
        			}
        		}	
			}
		}

		/*
		* Upate product
		*/
		function update($product_id){
			$data['product'] = $this->get_by_id($product_id);
			$category_id = $this->get_by_id($product_id)->categoryID;
			$data['categories'] = $this->get_category();
			$data['sub_categories'] = $this->category_model->get_sub_category($category_id);
			//$data['colors'] = $this->color_model->get_by_product_id($product_id);
			$data['variants'] =$this->get_option_value_variant($product_id);

			$opt1_id =$this->get_option_value_variant($product_id)[0]->opt1_type_id;
			$opt2_id =$this->get_option_value_variant($product_id)[0]->opt2_type_id;
			$data['option1'] = $this->option_value_model->get_by_option_id($opt1_id);
			$data['option2'] = $this->option_value_model->get_by_option_id($opt2_id);

			$data['images'] = $this->get_image_by_product_id($product_id);

			$data['main_content'] = 'vendor/product/edit';
			$this->load->view('vendor/layouts/main', $data);

			if(isset($_POST['submit'])){
				$data_input = array(
					'productTitle' 	=> $this->input->post('product_title'),
					'description'	=> $this->input->post('description'),
					'subCategoryID'	=> $this->input->post('sub_category'),
					'shopID'		=> $this->shop_id
        		);

        		$data_input['slug'] = parent::create_slug('productTitle' ,$this->input->post('product_title'), $product_id);

        		$result = $this->product_model->update($data_input, $product_id);
				$this->session->set_flashdata('inform', 'Data has been updated successful!');
        		
        		/*
				* update price and qty when product has only one variant and no option
        		*/
        		if(isset($_POST['qty']) && isset($_POST['price'])){
        			$data_inventory = array(
        				'qty'=> $this->input->post('qty'),
        				'price' =>$this->input->post('price')
        			);
        			$this->load->model('variant_model');
        			$this->variant_model->update($data_inventory, $this->input->post('variant_id'));
        		}

        		// insert OptionVariantValue
    			if(isset($_POST['option_value'])){
    				$this->insert_option_value_variant($_POST['option_value'], $this->input->post('variant_id'));
    			}

    			//upload image file	
    			if(!empty($_FILES['images']['name'])){
    				$path = './assets/images/product';
        			$files = parent::do_multi_upload($path);

        			if(isset($files['error'])){
        				$this->session->set_flashdata('error', $upload['error']);
        				redirect('vendor/product/update/'.$product_id);
        			}else{
        				$file_data = array();
        				foreach($files as $file){
        					$file_data[] = array(
        						'imageName' => $file,
        						'productID' => $product_id
        					);
        				}
        				
        				//insert image file
        				$this->load->model('image_model');
        				$image_insert = $this->image_model->insert_image($file_data);

        				
        			}
    			}

        		//if($result){
        			$this->session->set_flashdata('inform', 'Data has been updated successful!');
					redirect(base_url().'vendor/product/update/'.$product_id);
        		//}
			}
			
		}

		function delete($product_id){
			$this->delete_image($product_id);
			$this->product_model->delete($product_id);
			$this->session->set_flashdata('inform', 'Your product has been deleted successful!');
			redirect(base_url()."vendor/product/index");
		}

		function delete_image($product_id){

			$images = $this->image_model->get_by_product_id($product_id);
			
			foreach($images as $image){
				$image_path = "assets/images/product/".$image->imageName;
				unlink($image_path);
			}
	    	/*$image = $this->get_image_by_image_id($image_id);
			$image_path = "assets/images/product/".$image->imageName;
			//echo $image_path;
			unlink($image_path);*/
	    }

		function edit_status(){
			$data = array(
				'status' => $this->input->post('status')
			);

			$this->product_model->update($data, $this->input->post('product_id'));

			$this->session->set_flashdata('inform', 'Your status has been updated!');

			redirect(base_url()."vendor/product/index");
		}

		function get_shop_id(){
			$this->load->model('shop_model');
			$shop = $this->shop_model->get_by_user_id($this->user_id);
			return $shop_id = $shop->shopID;
		}

		function get_by_id($product_id){
			return $this->product_model->get_by_id($product_id);
		}

		/*
		* Insert product color
		*/

		/*function insert_color($color, $product_id){	
    		$color_data = array();
    		for($i=0; $i<count($_POST['colors']); $i++){
    			$color_data[] = array(
    				'colorName' => $color[$i],
    				'productID' => $product_id
    			);
    		}

    		//insert color
			$this->load->model('color_model');
			$this->color_model->insert_batch($color_data);			
		}*/
		/*
		* Delete order
		*/
		/*function delete($order_id){
			$this->order_model->delete($order_id);
			$this->session->set_flashdata('inform', 'Your product has been deleted successful!');
			redirect(base_url()."vendor/product/index");
		}*/
		/*
		* Insert option value variant
		*/
		function insert_option_value_variant($op_value, $variant_id){
			$option_value_data = array();
			for($i=0; $i<count($_POST['option_value']); $i++){
				$option_value_data[]= array(
					'variantID' => $variant_id,
					'optionValueID'=> $op_value[$i]
				);
			}

			$this->load->model('option_value_variant_model');
			$this->option_value_variant_model->insert_batch($option_value_data);

		}

		
		/*
		* Insert variant
		*/
		function insert_variant($product_id){
			$product_variant = array(
    				'productID' => $product_id,
    				'qty' => $this->input->post('qty'),
    				'price'			=> $this->input->post('price')
    			);

			$this->load->model('variant_model');
			return $this->variant_model->insert($product_variant);
		}

		/*
		* Category section
		*/

		function get_category(){
			return $this->category_model->get_category();
		}

		function get_sub_category($parent_id){	
			$output = array();
			$this->output->set_content_type('application/json');

			$result = $this->category_model->get_sub_category($parent_id);

			$this->output->set_output(json_encode($result));
		}

		/*
		*	
		*/
		function get_option_value_variant($product_id){
			$this->load->model('option_value_variant_model');
			return $this->option_value_variant_model->get_by_product_id($product_id);
		}


		/*
		* Get image by productID
		*/
		function get_image_by_product_id($product_id){
			$this->load->model('image_model');
			return $this->image_model->get_by_product_id($product_id);
		}

		function test2(){
			$this->load->model('product_model');
			$test = $this->product_model->get_all_product();
			print_r($test);
		}

	}
 ?>