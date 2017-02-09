<?php 

/**
* 
*/
class Cart extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function add(){

		$output =array();
		$this->output->set_content_type('application/json');
	    $this->cart->product_name_rules = "\.\:\-_\"\' a-z0-9";
		$data = array(
	        'id'      => $this->input->post('item_id'),
	        'qty'     => $this->input->post('qty'),
	        'price'   => $this->input->post('price'),
	        'name'    => $this->input->post('product_title'),
	        'options' => 	array(
	        					'shop_id' => $this->input->post('shop_id'), 
	        					'option_value' => $this->input->post('option_value'),
	        					'shop_name' => $this->input->post('shop_name'),
                                'product_slug' => $this->input->post('product_slug')
	        				),
		);
		$result = $this->cart->insert($data);
        //$count_item = count($this->cart->contents());

        $item = array(
            'result' => 1,
            'count_item' =>  count($this->cart->contents()),
        );
		if($result){
			$this->output->set_output(json_encode($item));
            
           // $this->output->set_output(json_encode(['result'=>1]));
		}

		//$this->cart->destroy();
		//print_r($this->cart->contents());
	}

	function update($in_cart=null){
		$output =array();
		$this->output->set_content_type('application/json');

		$data = $_POST;
        $result = $this->cart->update($data);

        $item = array(
            'result' => 1,
            'count_item' =>  count($this->cart->contents()),
        );

        if($result){
			$this->output->set_output(json_encode($item));
		}
	}

 	function remove($rowid){
 		$output =array();
		$this->output->set_content_type('application/json');

        if($rowid == "all"){
            $this->cart->destroy();
        }else{
            $data = array(
                'rowid' => $rowid,
                'qty' => 0
            );
            $result = $this->cart->update($data);

             $item = array(
                    'result' => 1,
                    'count_item' =>  count($this->cart->contents()),
                );
            if($result){
				$this->output->set_output(json_encode($item));
			}
        }
    }

    //check item qty in shopping cart page
    function check_qty($qty, $variant_id){
        $this->load->model('variant_model');
        $item_qty = $this->variant_model->get_by_id($variant_id)->qty;
        
        if($qty<=$item_qty){
            echo $result = true;
        }else{
            echo $result = false;
        }
    }





/*
    function test(){
//    	$items = $this->cart->contents();
//     	//$this->aasort($items, "name");

//     	//$this->array_sort($items, "name");

//     	//print_r($items['7da006a4af87f26a628ef0e85fccfe60']['name']);
//     	print_r($items);

//     	$parent = "";
//     	$shop = "Dona feshion shop";

//     	foreach($items as $item){
    		
// 			$shop_name = $this->cart->product_options($item['rowid'])['shop_name'];
    		

// }

    	$item_array = array();
    	foreach ($this->cart->contents() as $items) {
    		$nested_data = array();
    		$nested_data['rowid'] = $items['rowid'];
    		$nested_data['item_name'] = $items['name'];
    		$nested_data['qty'] = $items['qty'];
    		$nested_data['price'] = $items['price'];
    		$nested_data['shop_name'] = $this->cart->product_options($items['rowid'])['shop_name'];
    		$nested_data['shop_id'] = $this->cart->product_options($items['rowid'])['shop_id'];
    		$nested_data['option_value'] = $this->cart->product_options($items['rowid'])['option_value'];

    		$item_array[] = $nested_data;
    	}

    	$this->aasort($item_array, "shop_name");

    	$parent = "";
    	$output = "";
    	$i = 1;

    	$test_array = array();

    	foreach($item_array as $item){

    		if($item['shop_name'] != $parent){
    			if($i!=1){
    				$output .= '</tbody>';
		    		$output .= '</table>';
		    		$output .= '</form>';
		    		$output .= '</div>';
    			}

    			$output .= '<p>'.$item['shop_name'].'</p>';
    			
    			$output .= '<div class="table-responsive shopping-cart-table">';
    			$output .= '<form method="post" id="form-shopping-cart">';
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
    			$output .= '<a href="product-full.html">'.$item['item_name'].'</a>';
    			$output .= '<p>'.$item['option_value'].'</p>';
    			$output .= '</td>';

    			$output .= '<td class="text-center">';
    			$output .= '<input type="text" name="'.$i.'[qty]'.'" value="'.$item['qty'].'" size="1" class="form-control" />';
    			$output .= '</td>';

    			$output .= '<td class="text-center">';
    			$output .= '$'.$item['price'].'';
    			$output .= '</td>';

    			$output .= '<td class="text-center">';
    			$output .= '$'.$item['qty']*$item['price'].'';
    			$output .= '</td>';

    			$output .= '<td class="text-center">';
    			$output .= '<button type="submit" title="Update" class="btn btn-default tool-tip">';
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
    	
    	echo $output;
 
    }

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


	/*function array_sort($array, $on, $order=SORT_ASC)
	{
	    $new_array = array();
	    $sortable_array = array();

	    if (count($array) > 0) {
	        foreach ($array as $k => $v) {
	            if (is_array($v)) {
	                foreach ($v as $k2 => $v2) {
	                    if ($k2 == $on) {
	                        $sortable_array[$k] = $v2;
	                    }
	                }
	            } else {
	                $sortable_array[$k] = $v;
	            }
	        }

	        switch ($order) {
	            case SORT_ASC:
	                asort($sortable_array);
	            break;
	            case SORT_DESC:
	                arsort($sortable_array);
	            break;
	        }

	        foreach ($sortable_array as $k => $v) {
	            $new_array[$k] = $array[$k];
	        }
	    }

	    return $new_array;
	}*/



}

 ?>