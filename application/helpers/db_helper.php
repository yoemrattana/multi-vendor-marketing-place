<?php 
/*
*to get option name, eg: color, size,...
*/
/*function option_h($value_id){
	$CI = get_instance();
	$CI->load->model('option_model');
	$option =  $CI->option_model->get_by_value_variant($value_id);
	return $option->optionTypeName;
}*/
/*
*to get option value by option name, eg: red , blue, L, M,...
*/
/*function option_value_h($option_name){
	$CI = get_instance();
	$CI->load->model('option_value_model');
	return $CI->option_value_model->get_by_option_name($option_name);
 
}*/
/*
*to get all variant combination with its option value. eg: M/Red, L/Blue
*/
/*function variant_value_h($product_id){
	$CI = get_instance();
	$CI->load->model('option_value_variant_model');
	return $CI->option_value_variant_model->get_by_product_id($product_id);
}*/
/*
*to get product name
*/
function product_h($product_id){
	$CI = get_instance();
	$CI->load->model('product_model');
	return $CI->product_model->get_by_id($product_id);
}
/*
*to get optionValueVariantID by optionValueName (eg: blue, L,..) and variantID
*/
function opt_val_var_id_h($opt_val_name, $var_id){
	$CI = get_instance();
	$CI->load->model('option_value_variant_model');
	return $CI->option_value_variant_model->get_opt_val_var_id($opt_val_name, $var_id)->optionValueVariantID;
}

/*
* Count variant by productID
*/

function count_variant($product_id){
	$CI = get_instance();
	$CI->load->model('variant_model');
	return $CI->variant_model->count_variant($product_id)->num_variant;
}



/*
* The following code is used in front view
***NOTE** the category_h() function not used
*/
function category_h(){
 	$CI = get_instance();
	$CI->load->model('category_model');
	$results = $CI->category_model->get_all_categories();

	$prev_parent = "";
	$output = "";
	$x=1;
	foreach($results as $result){
		$parent = $result->parent;
    	$child = $result->child;

    	if($parent != $prev_parent){
    		$output .= "<a class='list-group-item' class='list-group-item' data-toggle='collapse' href='#collapseExample".$x."' aria-expanded='false' aria-controls='collapseExample".$x."'>";
    		$output .= "<i class='fa fa-chevron-right'></i>";
    		$output .= $parent;
    		$output .= "</a>";
    		$output .= "<div class='collapse sub-cat' id='collapseExample".$x."'>";
   
    	}
    	
    	$output .= "<a href='category-grid.html' class='list-group-item'>";
    	$output .= "<i class='fa fa-chevron-right'></i>";
    	$output .= $child;
    	$output .= "</a>";

    	$prev_parent = $parent;

    	
    	
    	$x++;
	}
	return $output;
}

function categories_h(){
	$CI = get_instance();
	$CI->load->model('category_model');
	$cats = $CI->category_model->get_categories();

	$output ="";
	$x = 1;
	foreach($cats as $cat){
		$output .= "<a class='list-group-item' class='list-group-item' data-toggle='collapse' href='#collapseExample".$x."' aria-expanded='false' aria-controls='collapseExample".$x."'>";
		$output .= "<i class='fa fa-chevron-right'></i>";
		$output .= $cat->categoryName;
		$output .= "</a>";
		$output .= "<div class='collapse sub-cat' id='collapseExample".$x."'>";
		$output .= sub($cat->categoryID);
		$x++;
	}
	return $output;
}

function sub($category_id){
	$CI = get_instance();
	$CI->load->model('category_model');
	$items = $CI->category_model->get_sub_categories($category_id);	
	$output = "";
	foreach($items as $item){
		$output .= "<a href='".base_url()."categorys/".$item->slug."' class='list-group-item'>";
    	$output .= "<i class='fa fa-chevron-right'></i>";
    	$output .= $item->subCategoryName;
    	$output .= "</a>";
	}

	$output .= "</div>";

	return $output;
}

function special_h(){
	$CI = get_instance();
	$CI->load->model('product_model');
	$items = $CI->product_model->popular_product();	
	$output = "";
	foreach($items as $item){
		$output .= '<li class="clearfix">';
		$output .='<img src="'.base_url().'assets/images/product/'.$item->imageName.'" alt="'.$item->imageName.'" class="img-responsive" width="64px" height="64px"/>';
		$output .='<h5><a href="'.base_url().'product/'.$item->slug.'">'.$item->productTitle.'</a></h5>';
		$output .='<div class="price-tage">';
		$output .='<span class="price-new9">'.get_price_h($item->productID).'</span>';
		/*$output .='<span class="price-old">$249.50</span>';*/
		$output .='</div>';
		$output .='</li>';
	}
	return $output;
}

function get_price_h($product_id){
	$CI = get_instance();
	$CI->load->model('variant_model');
	$result =  $CI->variant_model->get_price_by_product_id($product_id);
	//return $result;
	return ($result->minPrice == $result->maxPrice)? "$".$result->minPrice:"From $" . $result->minPrice;
	//echo $price;
}

//category for footer section

function categoryf_h(){
	$CI = get_instance();
	$CI->load->model('category_model');
	$items = $CI->category_model->get_all_categories();

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
			$output .= '<a href="'.base_url().'category/'.$item->slug_cat.'"><h5>'.$item->parent.'</h5></a>';
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
}

		

?>
