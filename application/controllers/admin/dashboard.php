<?php 
/**
* 
*/
class Dashboard extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->load->model('user_model');
		$this->load->model('shop_model');
		$this->load->model('product_model');
		$this->load->model('order_model');
		parent::is_login_admin();
	}

	function index(){
		$data['customer'] = count($this->user_model->get_all_customer());
		$data['order'] = count($this->order_model->get_all_order());
		$data['product'] = count($this->product_model->get_all_products());
		$data['store'] = count($this->shop_model->get_all_store());
		$data['main_content'] = 'admin/dashboard/index';
		$this->load->view('admin/layouts/main', $data);
	}
}
 ?>