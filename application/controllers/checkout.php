<?php 
/**
* 
*/
class Checkout extends CI_Controller
{
	
	function __construct()
	{
		  parent::__construct();
      $this->is_login();
      $this->load->model('variant_model');
	}

	function add(){
		$this->load->model('order_model');
		$this->load->model('order_detail_model');

		$item_array = array();
    	foreach ($this->cart->contents() as $items) {
    		$nested_data = array();
    		$nested_data['rowid'] = $items['rowid'];
    		$nested_data['item_name'] = $items['name'];
    		$nested_data['item_id'] = $items['id'];
    		$nested_data['qty'] = $items['qty'];
    		$nested_data['price'] = $items['price'];
    		$nested_data['shop_name'] = $this->cart->product_options($items['rowid'])['shop_name'];
    		$nested_data['shop_id'] = $this->cart->product_options($items['rowid'])['shop_id'];
    		$nested_data['option_value'] = $this->cart->product_options($items['rowid'])['option_value'];

    		$item_array[] = $nested_data;
    	}
    	//sort array item
    	$this->aasort($item_array, "shop_name");

    	$parent = "";

   		foreach($item_array as $item){

   			if($item['shop_id']!=$parent){
   				//echo $item['shop_id']. "<br>";
   				$data_order = array(
   					'shopID' => $item['shop_id'],
   					'userID' => $this->session->userdata('user_id'),
            'orderDate' => date('Y/m/d'),
   				);
   				$order_id = $this->order_model->insert($data_order);
   			}

   			//echo $item['item_id']. "<br>";
   			$data_line_item = array(
   				'orderID' => $order_id,
   				'variantID' => $item['item_id'],
   				'qty' => $item['qty']
   			);

   			$this->order_detail_model->insert($data_line_item);

     /*   $data_qty = array(
            'qty'=>$item['qty']
        );*/

        $this->variant_model->update_qty($item['qty'], $item['item_id']);

   			$parent = $item['shop_id'];
   		}

      $this->cart->destroy();

      redirect(base_url().'checkout/infor.html');
	}

  function infor(){
    $this->load->view('infor');
  }




	/*
	* array short
	*/

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

  function is_login(){
      if (!$this->session->userdata('logged_in')) {
              redirect(base_url().'home/login.html', 'refresh');
          }
    }
}
 ?>