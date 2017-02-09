<?php 
	/**
	* 
	*/
	class My_Controller extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
		}
		//just only for vendor
		function is_login_vendor(){
			if (!$this->session->userdata('vendor_logged_in')) {
            	redirect('vendor/auth/login_view');
        	}
		}

		function is_login_admin(){
			if (!$this->session->userdata('admin_logged_in')) {
            	redirect('auth/admin_login');
        	}
		}



		function init_slug($table_name, $primary_key, $field){
			$config = array(
	            'table' => $table_name,
	            'id' => $primary_key,
	            'field' => 'slug',
	            'title' => $field,
	            'replacement' => 'dash' // Either dash or underscore
        	);

        	$this->load->library('slug', $config);
		}

		function create_slug($field ,$slug_title, $id=null){
			$slug = array(
                $field => $slug_title,
            );
			if($id=null){
				return $this->slug->create_uri($slug);
			}else{
				return $this->slug->create_uri($slug, $id);
			}
            
		}

		function do_upload($min_width, $min_height, $max_width, $max_height, $file_name){
			$config['upload_path'] = './assets/images';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
	        //$config['max_size']             = 100;
	        $config['max_width']            = $max_width;
	        $config['max_height']           = $max_height;
	        //$config['encrypt_name'] = TRUE;
	        $config['min_width']             = $min_width;
	        $config['min_height']            = $min_height;
	        $config['remove_spaces']         = TRUE;
	        $this->load->library('upload', $config);

	        if (!$this->upload->do_upload($file_name)) {
	            return array('error' => $this->upload->display_errors());  
	        } else {
	            $data = $this->upload->data();
	            return $data['file_name'];
	        }
		}

		function do_uploads($path){
			$config['upload_path'] = $path;
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
	       
	        $config['remove_spaces']         = TRUE;
	        $this->load->library('upload', $config);

	        if (!$this->upload->do_upload('file')) {
	            return array('error' => $this->upload->display_errors());  
	        } else {
	            $data = $this->upload->data();
	            return $data['file_name'];
	        }
		}

		function do_multi_upload($path){
			//$config['upload_path'] = './assets/images';
			$config['upload_path'] = $path;
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
	        //$config['max_size']             = 100;
	        //$config['max_width']            = $max_width;
	        //$config['max_height']           = $max_height;
	        //$config['encrypt_name'] = TRUE;
	        //$config['min_width']             = $min_width;
	        //$config['min_height']            = $min_height;
	        $config['remove_spaces']         = TRUE;
	        $this->load->library('upload', $config);

			$files = $_FILES;

			$files_upload = array();
			$images = array();
			$cpt = count($_FILES['images']['name']);
			for($i = 0; $i < $cpt; $i ++) {

				$_FILES['images']['name'] = $files['images']['name'][$i];
				$_FILES['images']['type'] = $files['images']['type'][$i];
				$_FILES['images']['tmp_name'] = $files['images']['tmp_name'][$i];
				$_FILES['images']['error'] = $files['images']['error'][$i];
				$_FILES['images']['size'] = $files['images']['size'][$i];

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('images')) {
	            	return array('error' => $this->upload->display_errors());  
	        	} else {
	            	$files_upload[$i] = $this->upload->data();
	            	
	           		$images[$i] = $files_upload[$i]['file_name'];
	        	}
			}
			return $images;
		}


	}//end class
 ?>