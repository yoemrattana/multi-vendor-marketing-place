<?php 
/**
* 
*/
class Variants extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');

		$this->load->model('option_value_model');
		$this->load->model('option_value_variant_model');
	}

	function edit($variant_id){
		$data['main_content'] = 'vendor/variant/edit';
		$data['variant'] = $this->get_by_variant_id($variant_id);
		$product_id = $this->get_by_variant_id($variant_id)->productID;

		$data['variant_values'] = $this->option_value_variant_model->get_by_product_id($product_id);

		$opt1_id =$this->get_option_value_variant($product_id)[0]->opt1_type_id;
		$opt2_id =$this->get_option_value_variant($product_id)[0]->opt2_type_id;
		$data['option1'] = $this->option_value_model->get_by_option_id($opt1_id);
		$data['option2'] = $this->option_value_model->get_by_option_id($opt2_id);

		$this->load->view('vendor/layouts/main', $data);

		if(isset($_POST['submit'])){
			$variant_data = array(
				'qty' => $this->input->post('qty'),
				'price' => $this->input->post('price')
			);
			$this->load->model('variant_model');
			$this->variant_model->update($variant_data, $variant_id);

			/*
			* Update option value variant
			*/
			if(isset($_POST['opt1_val_var_id'])){
				$option1_value_variant_id = $this->input->post('opt1_val_var_id');
				$data1 = array(
					'optionValueID' => $this->input->post('opt1')
				);
				$this->load->model('option_value_variant_model');
				$this->option_value_variant_model->update($data1, $option1_value_variant_id);
			}

			if(isset($_POST['opt2_val_var_id'])){
				$option2_value_variant_id = $this->input->post('opt2_val_var_id');
				$data2 = array(
					'optionValueID' => $this->input->post('opt2')
				);

				$this->load->model('option_value_variant_model');
				$this->option_value_variant_model->update($data2, $option2_value_variant_id);
			}
			
			$this->session->set_flashdata('inform', 'Update successful');
			redirect('vendor/variants/edit/'.$variant_id);
		}
	}

	function add(){
		if(isset($_POST['submit'])){
			$data = array(
				'productID' => $this->input->post('product_id'),
				'qty'	=> $this->input->post('qty'),
				'price' => $this->input->post('price')
			);
			$this->load->model('variant_model');
			$variant_id = $this->variant_model->insert($data);

			if(isset($_POST['option_value'])){
    				$this->insert_option_value_variant($_POST['option_value'], $variant_id);
    		}

    		redirect(base_url()."vendor/product/update/".$this->input->post('product_id'));

		}
	}
		/*
		* Insert option value variant
		*/
		function insert_option_value_variant($op_value, $variant_id){
			$option_value_data = array();
			for($i=0; $i<count($_POST['option_value']); $i++){
				$option_value_data[]= array(
					'variantID' => $variant_id,
					'optionValueID'=> $op_value[$i]
				);
			}

			$this->load->model('option_value_variant_model');
			$this->option_value_variant_model->insert_batch($option_value_data);

		}

		/*
		*delete product variant
		*/
		/*
			**NOTE** The condition for delete product variant ****
			Number of product variant of one product >1 , it will delete both optionValueVariant
			, otherwise , if Number of product variant of one product =0 , it will only delete optionValueVariant and keep that one variant
				
		*/
		function delete($variant_id){
			$this->load->model('variant_model');
			$this->variant_model->delete($variant_id);

			//delete option value variant by variantID
			$this->delete_option_value_variant($variant_id);
			redirect($this->agent->referrer());
		}
		/*
		* Delete option value variant
		*/
		function delete_option_value_variant($variant_id){
			$this->load->model('option_value_variant_model');
			$this->option_value_variant_model->delete_by_variant_id($variant_id);
			redirect($this->agent->referrer());
		}

		function get_option_value_variant($product_id){
			$this->load->model('option_value_variant_model');
			return $this->option_value_variant_model->get_by_product_id($product_id);
		}


		/*
		* Get option type name by option value id ******NOTE the following code not yet to use
		*/
		function get_option_type($value_id){
			$this->load->model('option_model');
			$test = $this->option_model->get_by_value_variant($value_id);		
			echo $test->optionTypeName;
		}

		function get_by_variant_id($variant_id){
			$this->load->model('variant_model');
			return $this->variant_model->get_by_variant_id($variant_id);		
			
		}

		/*
		* the following code is used in front view
		*/

		/*
		* used by ajax in front view
		*/
		function get_variant_by_variant_id($variant_id){
			$output = array();
			$this->output->set_content_type('application/json');

			$this->load->model('variant_model');
			$result = $this->variant_model->get_by_variant_id($variant_id);	

			$this->output->set_output(json_encode($result));
		}
}
 ?>