<?php 
/**
* 
*/
class Product extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('product_model');
	}

	function get_product_by_sub_category($sub_category_slug){
		$output = array();
		$this->output->set_content_type('application/json');

		$result = $this->product_model->get_product_by_sub_category_slug($sub_category_slug, 6, 0);

		$this->output->set_output(json_encode($result));
	}


	function view_sub_category(){
		$this->load->view('sub_category');
	}

	/*
		* get product by sub category
		*/
		function get_product_by_sub_category_slug($sub_category_slug, $from, $to, $offset){

			$this->load->model('product_model');
			$products = $this->product_model->get_product_by_sub_category_slug($sub_category_slug, $from, $to, 6, $offset);

			$num_product = $this->product_model->count_product_by_sub_category_slug($sub_category_slug)->num_product;

			$output = '';
			$count = 1;
		
			$output .= '<section class="products-list">';
			foreach($products as $product){
				if($count == 1){
					$output .= '<h2 class="product-head">'. $product->subCategoryName.'</h2>';
					$output .= '<div class="row">';
					$output .= '<div id="pro'.$count.'" class="col-md-4 col-sm-6">';
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
					$output .= "<span class='fa fa-eye pull-right'> ".$product->productView."</span>";
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';
				}else{
					$output .= '<div id="pro'.$count.'" class="col-md-4 col-sm-6">';
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
					$output .= "<span class='fa fa-eye pull-right'> ".$product->productView."</span>";
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';
				
				}
				$count++;
			
			}
			$output .= '</div>';
			$output .= '</section>';
			$result = array(
				'product' => $output,
				'count_product'=>$num_product,
				);
			echo json_encode($result);
			
		}

		function get_product_by_category_slug($category_slug, $from, $to, $offset =0){
			
			$this->load->model('product_model');
			$data['products'] = $products = $this->product_model->get_product_by_category_slug($category_slug, $from, $to, 6, $offset);
			$num_product = $this->product_model->count_product_by_category_slug($category_slug)->num_product;
			//pagination
			

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
					$output .= '<a href="'.base_url().'product/'.$product->slug.'.html">'. $product->productTitle. '</a>';
					$output .= '</h4>';
					$output .= '<div class="price">';
					$output .= '<span class="price-new">'.$this->get_product_price($product->productID).'</span> ';
					$output .= "<span class='fa fa-eye pull-right'> ".$product->productView."</span>";
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
					$output .= '<a href="'.base_url().'product/'.$product->slug.'.html">'. $product->productTitle. '</a>';
					$output .= '</h4>';
					$output .= '<div class="price">';
					$output .= '<span class="price-new">'.$this->get_product_price($product->productID).'</span> ';
					$output .= "<span class='fa fa-eye pull-right'> ".$product->productView."</span>";
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
			
			$result = array(
				'product' => $output,
				'count_product'=>$num_product,
				);
			echo json_encode($result);
		}

		function view_category(){
			$this->load->view('category');
		}


		function price_range($sub_category){
			$result = $this->product_model->range_price($sub_category);

			echo json_encode($result);

		}
		function price_range_category($category){
			$result = $this->product_model->range_price_category($category);

			echo json_encode($result);

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



	
}
 ?>