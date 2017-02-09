<?php 
/**
* 
*/
class Wishlist extends CI_Controller
{
	protected $user_id;

	function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('wishlist_model');
	}

	function index(){
		$data['products'] = $this->wishlist_model->get_wishlist_by_user_id($this->user_id);

		$this->load->view('wishlist', $data);
	}

	function add($product_id){
		$output = array();
		$this->output->set_content_type('application/json');

		if($this->session->userdata('logged_in')){
			$data = array(
				'productID' => $product_id,
				'userID' => $this->user_id
			);
			$this->wishlist_model->insert($data);
		
			$this->output->set_output(json_encode(['result'=> 1]));
		}else{
			$this->output->set_output(json_encode(['result'=> 0]));
		}
	}

	function delete($id){
	
		$this->wishlist_model->delete($id);

		$this->session->set_flashdata('inform', 'Item has been deleted!');
		redirect(base_url()."wishlist/index.html");
	}


}
 ?>