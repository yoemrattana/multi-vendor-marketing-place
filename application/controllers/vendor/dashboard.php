<?php 
	/**
	* 
	*/
	class Dashboard extends My_Controller
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

		public function index(){
			$data['product'] = $this->count_product();
			$data['order'] = $this->count_order();
			$data['main_content'] = 'vendor/dashboard/index';
			$this->load->view('vendor/layouts/main', $data);

		}

		function count_product(){
			$this->load->model('product_model');
			return $this->product_model->count_product($this->shop_id);
		}

		function count_order(){
			$this->load->model('order_model');
			$orders = $this->order_model->get_order_by_shop_id($this->shop_id);
			return count($orders);
		}

		function get_shop_id(){
			$this->load->model('shop_model');
			$shop = $this->shop_model->get_by_user_id($this->user_id);
			return $shop_id = $shop->shopID;
		}



	}
 ?>