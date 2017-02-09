<?php 
/**
* 
*/
class Orders extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('order_model');
		$this->load->model('shop_model');
		$this->load->model('user_model');
		$this->load->model('order_detail_model');

		parent::is_login_admin();
	}

	function index(){
		$data['main_content'] = 'admin/order/index';
		$this->load->view('admin/layouts/main', $data);
	}

	function get_all_order(){
		$output = array();
        $this->output->set_content_type('application/json');

		$this->load->model('order_model');
		$results = $this->order_model->get_all_order();
		//print_r($results);
		$data = array();
        	foreach($results as $result){
        		$nested_data = array();
        		$nested_data[] = $result->orderID;
        		$nested_data[] = $result->firstName ." ". $result->lastName;
        		$nested_data[] = $result->shopName;
        		$nested_data[] = date("d/m/Y", strtotime($result->orderDate));


        		if ($result->status == 0) {
                	$nested_data[] = '<span class = "label label-warning" aria-hidden = "true">Pending</span>';
            	} elseif($result->status == 1) {
                	$nested_data[] = '<span class = "label label-info" aria-hidden = "true">On delivery</span>';
            	}else{
            		$nested_data[] = '<span class = "label label-success" aria-hidden = "true">Deliveried</span>';
            	}
            	$nested_data[] = ' <a href = "' . base_url() . 'admin/orders/view/' . $result->orderID . '" class = "insert btn btn-sm btn-primary" id = "' . $result->orderID . '" title = "View"><span class = "glyphicon glyphicon-list-alt" aria-hidden = "true"></span> View</a> '
            		//. '<button class="btn btn-sm btn-info" data-whatever="'.$result->orderID.'" data-toggle="modal" data-target="#status-modal" title = "Edit"><span class = "glyphicon glyphicon-edit" aria-hidden = "true">Status</button> '
                    . '<a class = "del btn btn-sm btn-danger" id = "' . $result->orderID . '" title = "Delte"><span class = "glyphicon glyphicon-trash" aria-hidden = "true"></span> Delete</a>';

        		$data[] = $nested_data;
        	}

        	$this->output->set_output(json_encode($data));
	}

	function view($order_id){
		$data['order'] = $this->shop_model->get_shop_by_order_id($order_id);
		$customer_id = $this->shop_model->get_shop_by_order_id($order_id)->userID;
		$data['customer'] = $this->user_model->get_by_id($customer_id);
		$data['order_detail'] = $this->order_detail_model->get_order_detail_by_order_id($order_id);
		$data['main_content'] = "admin/order/view";
		$this->load->view('admin/layouts/main', $data);
	}

}

 ?>