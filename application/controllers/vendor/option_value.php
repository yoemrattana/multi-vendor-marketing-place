<?php 
/**
* 
*/
class Option_value extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('option_value_model');
		$this->load->library('user_agent');
	}

	function get_by_option_id($option_id){
		$output = array();
		$this->output->set_content_type('application/json');
		$result = $this->option_value_model->get_by_option_id($option_id);
		$this->output->set_output(json_encode($result));
	}

	function delete($optin_value_id){
		$this->option_value_model->delete($optin_value_id);
		$this->session->set_flashdata('inform', 'Your data has been deleted!');
		//back to previuos page
		redirect($this->agent->referrer());	
	}

	
}
 ?>