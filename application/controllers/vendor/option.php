<?php 
/**
* 
*/
class Option extends MY_Controller
{
	protected $user_id;
	protected $shop_id;

	function __construct()
	{
		parent::__construct();
		$this->load->model('option_model');
		$this->load->model('option_value_model');

		$this->user_id = $this->session->userdata('v_user_id');
		$this->shop_id = $this->get_shop_id();
	}

	function index(){
		$data['main_content'] = 'vendor/option/index';
		$this->load->view('vendor/layouts/main', $data);
	}
	function get_all_option(){
		$output = array();
		$this->output->set_content_type('application/json');
		$results = $this->option_model->get_by_shop_id($this->shop_id);

		$data = array();
        	foreach($results as $result){
        		$nested_data = array();
        		$nested_data[] = $result->optionTypeID;
        		$nested_data[] = $result->optionTypeName;
            	$nested_data[] = ' <a href = "' . base_url() . 'vendor/option/edit/' . $result->optionTypeID . '" class = "insert btn btn-sm btn-info" id = "' . $result->optionTypeID . '" title = "Edit"><span class = "glyphicon glyphicon-edit" aria-hidden = "true"></span> Edit</a> '
                     . '<a class = "del-option btn btn-sm btn-danger" id = "' . $result->optionTypeID . '" title = "Delte"><span class = "glyphicon glyphicon-trash" aria-hidden = "true"></span> Delete</a>';

        		$data[] = $nested_data;
        	}


		$this->output->set_output(json_encode($data));
	}

	function get_option_by_shop_id(){
		$output = array();
		$this->output->set_content_type('application/json');
		$result = $this->option_model->get_by_shop_id($this->shop_id);
		$this->output->set_output(json_encode($result));
	}

	function add(){

		$data['main_content'] = "vendor/option/add";
		$this->load->view('vendor/layouts/main', $data);

		if(isset($_POST['submit'])){
			$output = array();
			$this->output->set_content_type('application/json');

			//insert option name
			$data_option = array(
				'optionTypeName' => $this->input->post('option_type_name'),
				'shopID' => $this->shop_id
			);

			$option_type_id = $this->option_model->insert($data_option);
			//insert option value
			$data_option_value = array();
			for($i=0; $i<count($_POST['option_value']); $i++){
				$data_option_value[] = array(
					'optionValueName' => $_POST['option_value'][$i],
					'optionTypeID' => $option_type_id
				);
			}

			$option_value_id = $this->option_value_model->insert_batch($data_option_value);

			if(isset($_POST['not_ajax'])){
				$this->session->set_flashdata('inform', 'Your data has been inserted!');
				redirect(base_url().'vendor/option/index');
			}

			if($option_value_id){
				$this->output->set_output(json_encode(['result'=>1]));
			}
		}

	}

	function edit($option_id){
		$data['options'] = $this->option_model->get_by_option_id($option_id);
		$data['main_content'] = "vendor/option/edit";
		$this->load->view('vendor/layouts/main', $data);

		if(isset($_POST['submit'])){
			$data_option_value = array();
			for($i=0; $i<count($_POST['option_value_old']); $i++){
				$data_option_value[] = array(
					'optionValueName' => $_POST['option_value_old'][$i],
					'optionValueID' => $_POST['value_id'][$i]
				);
			}
		
		$this->option_value_model->update_batch($data_option_value, 'optionValueID');
		//update optionType
		$data_option = array(
			'optionTypeName' => $this->input->post('option_name')
		);
		$this->option_model->update($data_option, $option_id);
		//insert new option_value
		if(isset($_POST['option_value'])){
			$data_option_value_new = array();
			for($i=0; $i<count($_POST['option_value']); $i++){
				$data_option_value_new[] = array(
					'optionValueName' => $_POST['option_value'][$i],
					'optionTypeID' => $option_id
				);
			}
			$this->option_value_model->insert_batch($data_option_value_new);
		}

		$this->session->set_flashdata('inform', 'Your data has been updated!');
		redirect(base_url()."vendor/option/edit/".$option_id);
		}
	}

	function delete($option_id){
		$this->option_model->delete($option_id);
		$this->session->set_flashdata('inform', 'Your data has been deleted!');
		redirect(base_url()."vendor/option/index");
	}

	function get_shop_id(){
		$this->load->model('shop_model');
		$shop = $this->shop_model->get_by_user_id($this->user_id);
		return $shop_id = $shop->shopID;
	}

	function test(){

		print_r($this->option_model->get_by_option_id(15));
	}

}
 ?>