<?php 
/**
* 
*/
class Image extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');
	}

	function delete($image_id){
		//delete image file
		$this->delete_image($image_id);
		
		$this->load->model('image_model');
		$result = $this->image_model->delete($image_id);
		
		//back to previuos page
		redirect($this->agent->referrer());	
	}

	function delete_image($image_id){
    	$image = $this->get_image_by_image_id($image_id);
		$image_path = "assets/images/product/".$image->imageName;
		//echo $image_path;
		unlink($image_path);
    }

    function get_image_by_image_id($image_id){
    	$this->load->model('image_model');
    	return $this->image_model->get_by_image_id($image_id);
    }
}
 ?>