<?php 
/**
* 
*/
class Slide extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('slider_model');
		parent::is_login_admin();
	}

	function index(){
		$data['main_content'] = 'admin/slide/index';
		$this->load->view('admin/layouts/main', $data);
	}

	function get_all_slide(){
		$output = array();
    	$this->output->set_content_type('application/json');

    	$results = $this->slider_model->get_all_slide();

    	$data = array();
    	foreach($results as $result){
    		$nested_data = array();
    		$nested_data[] = $result->sliderID;
    		$nested_data[] = '<img class="product-image" src="'.base_url().'assets/images/slider-imgs/'.$result->imageName.'" alt="'.$result->imageName.'">';
    		$nested_data[] = $result->imageName;

    		if ($result->status == 1) {
            	$nested_data[] = '<span class = "label label-success" aria-hidden = "true">Active</span>';
        	} else {
            	$nested_data[] = '<span class = "label label-warning" aria-hidden = "true">Disactive</span>';
        	}
        	$nested_data[] = ' <a href = "' . base_url() . 'admin/slide/edit/' . $result->sliderID . '" class = "insert btn btn-sm btn-info" id = "' . $result->sliderID . '" title = "Edit"><span class = "glyphicon glyphicon-edit" aria-hidden = "true"></span> Edit</a> '
                . '<a class = "btn btn-sm btn-warning" data-whatever = "' . $result->sliderID . '" data-toggle="modal" data-target="#status-slide-modal" title = "Edit"><span class = "glyphicon glyphicon-cog" aria-hidden = "true"></span> Status</a> '
                . '<a class = "del-slide btn btn-sm btn-danger" id = "' . $result->sliderID . '" title = "Delte"><span class = "glyphicon glyphicon-trash" aria-hidden = "true"></span> Delete</a>';

    		$data[] = $nested_data;
    	}

    	$this->output->set_output(json_encode($data));
	}

	function add(){
		$data['main_content'] = 'admin/slide/add';
		$this->load->view('admin/layouts/main', $data);

		if(isset($_POST['submit'])){
			$path = 'assets/images/slider-imgs/';
			$upload = parent::do_uploads($path);

			if(empty($_FILES['file']['name'])){
				$this->session->set_flashdata('error', $upload['error']);
				redirect('admin/slide/add');
			}else{
				if(isset($upload['error'])){
					$this->session->set_flashdata('error', $upload['error']);
					redirect('admin/slide/add');
				}else{
					 $data_input['imageName'] = $upload;

					 $this->slider_model->insert($data_input);

					 $this->session->set_flashdata('inform', 'Image has been uploaded successful!');

					 redirect(base_url()."admin/slide/index");
				}
			}
			

		}
	}

	function edit($slide_id){
		$data['image'] = $this->slider_model->get_slide_by_slide_id($slide_id);
		$data['main_content'] = 'admin/slide/edit';
		$this->load->view('admin/layouts/main', $data);

		if(isset($_POST['submit'])){
			$path = 'assets/images/slider-imgs/';
			$upload = parent::do_uploads($path);

			if(empty($_FILES['file']['name'])){
				$this->session->set_flashdata('error', $upload['error']);
				redirect('admin/slide/add');
			}else{
				if(isset($upload['error'])){
					$this->session->set_flashdata('error', $upload['error']);
					redirect('admin/slide/add');
				}else{
					//delete old file
					$this->delete_image($slide_id);

					$data_input['imageName'] = $upload;

					$this->slider_model->update($data_input, $slide_id);

					$this->session->set_flashdata('inform', 'Image has been uploaded successful!');

					redirect(base_url()."admin/slide/edit/".$slide_id);
				}
			}
			
		}
	}

	function edit_status(){
		$data = array(
			'status' => $this->input->post('status')
		);
		
		$result = $this->slider_model->update($data, $this->input->post('slide_id'));
		if($result){
			$this->session->set_flashdata('inform', 'Status has been updated!');
			redirect(base_url()."admin/slide/index");
		}
		
	}

	function delete($slide_id){
		$this->delete_image($slide_id);
		$result = $this->slider_model->delete($slide_id);
		
		if($result){
			
			$this->session->set_flashdata('inform', 'Your product has been deleted successful!');
			redirect(base_url()."admin/slide/index");
		}	
	}
	//delte file iamge
	function delete_image($slide_id){
		$image = $this->slider_model->get_slide_by_slide_id($slide_id)->imageName;
		$image_path = "assets/images/slider-imgs/".$image;
		unlink($image_path);
	}



}
 ?>