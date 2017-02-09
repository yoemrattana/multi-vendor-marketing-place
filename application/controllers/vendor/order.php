<?php 
/**
* 
*/
class Order extends My_Controller
{
	protected $user_id;
	protected $shop_id;
	
	function __construct()
	{
		parent::__construct();
		parent::is_login_vendor();
		$this->user_id = $this->session->userdata('v_user_id');
		$this->shop_id = $this->get_shop_id();
	}

	function index(){
		$data['main_content'] = "vendor/order/index";
		$this->load->view('vendor/layouts/main', $data);
	}

	function get_all(){
		$output = array();
        $this->output->set_content_type('application/json');

		$this->load->model('order_model');
		$results = $this->order_model->get_order_by_shop_id($this->shop_id);
		//print_r($results);
		$data = array();
        	foreach($results as $result){
        		$nested_data = array();
        		$nested_data[] = $result->orderID;
        		$nested_data[] = $result->firstName ." ". $result->lastName;

        		$nested_data[] = date("d/m/Y", strtotime($result->orderDate));


        		if ($result->status == 0) {
                	$nested_data[] = '<span class = "label label-warning" aria-hidden = "true">Pending</span>';
            	} elseif($result->status == 1) {
                	$nested_data[] = '<span class = "label label-info" aria-hidden = "true">On delivery</span>';
            	}else{
            		$nested_data[] = '<span class = "label label-success" aria-hidden = "true">Deliveried</span>';
            	}
            	$nested_data[] = ' <a href = "' . base_url() . 'vendor/order/view/' . $result->orderID . '" class = "insert btn btn-sm btn-primary" id = "' . $result->orderID . '" title = "View"><span class = "glyphicon glyphicon-list-alt" aria-hidden = "true"></span> View</a> '
            		. '<button class="btn btn-sm btn-info" data-whatever="'.$result->orderID.'" data-toggle="modal" data-target="#status-modal" title = "Edit"><span class = "glyphicon glyphicon-edit" aria-hidden = "true">Status</button> '
                    . '<a class = "del btn btn-sm btn-danger" id = "' . $result->orderID . '" title = "Delte"><span class = "glyphicon glyphicon-trash" aria-hidden = "true"></span> Delete</a>';

        		$data[] = $nested_data;
        	}

        	$this->output->set_output(json_encode($data));
	}

	function view($order_id){
		$data['order'] = $this->get_shop_by_order_id($order_id);
		$customer_id = $this->get_shop_by_order_id($order_id)->userID;
		$data['customer'] = $this->get_customer_by_id($customer_id);
		$data['order_detail'] = $this->get_order_detail_by_order_id($order_id);
		$data['main_content'] = "vendor/order/view";
		$this->load->view('vendor/layouts/main', $data);
	}

	function get_shop_by_order_id($order_id){
		$this->load->model('shop_model');
		return $this->shop_model->get_shop_by_order_id($order_id);
	}

	function get_customer_by_id($customer_id){
		$this->load->model('user_model');
		return $this->user_model->get_by_id($customer_id);
	}

	function get_order_detail_by_order_id($order_id){
		$this->load->model('order_detail_model');
		return $this->order_detail_model->get_order_detail_by_order_id($order_id);
	}

	function get_shop_id(){
		$this->load->model('shop_model');
		$shop = $this->shop_model->get_by_user_id($this->user_id);
		return $shop_id = $shop->shopID;
	}
	// update only its stutsu
	function update(){
		$this->load->model('order_model');

		$data = array(
			'status' => $this->input->post('status')
		);

		$this->order_model->update($data, $this->input->post('order_id'));

		$this->session->set_flashdata('inform', 'Update successful!');
		redirect(base_url()."vendor/order/index");
	}

	function delete($order_id){
		$this->load->model('order_model');
		$this->order_model->delete($order_id);
		$this->session->set_flashdata('inform', 'Your order has been deleted successful!');
		redirect(base_url()."vendor/order/index");
	}
}

 ?>