<?php 
	/**
	* 
	*/
	class Shop extends My_Controller
	{	
		/*
		* route['vendor/setting/(:any)'] = 'vendor/shop/$1'
		*/

		protected $user_id;
		protected $shop_id;

		function __construct()
		{
			parent::__construct();
			parent::is_login_vendor();
			$this->load->model('shop_model');
			parent::init_slug('shop', 'shopID', 'shopName');
			$this->user_id = $this->session->userdata('v_user_id');
			$this->shop_id = $this->get_shop_id();
		}

		function index(){
			$data['map'] = $this->map();
			//$data['map'] = $this->map($this->get_by_user_id()->lat, $this->get_by_user_id()->lng);
 			$data['shop'] = $this->get_by_user_id();
			$data['main_content'] = 'vendor/setting/index';
			$this->load->view('vendor/layouts/main', $data);
		}

		function get_by_user_id(){
			return $this->shop_model->get_by_user_id($this->user_id);
			
		}

		function update(){
			if($this->input->post('shop_name') != ""){
				$data = array('shopName' => $this->input->post('shop_name'));
				$data['slug'] = parent::create_slug('shopName' ,$this->input->post('shop_name'), $this->input->post('shop_id'));

				$result = $this->shop_model->update_by_foriegn_key($data, $this->user_id);
			}

			
			if(isset($_POST['upload_logo'])){

				$path = 'assets/images/logo/';
				$upload = parent::do_uploads($path);

				if(empty($_FILES['file']['name'])){
					$this->session->set_flashdata('error', $upload['error']);
					redirect('vendor/setting/index');
				}else{
					if(isset($upload['error'])){
						$this->session->set_flashdata('error', $upload['error']);
						redirect('vendor/setting/index');
					}else{
						$this->delete_logo();
						$data_input['logo'] = $upload;
					}
				}
				$result = $this->shop_model->update_by_foriegn_key($data_input, $this->user_id);
			}

			if(isset($_POST['upload_banner'])){
				$path = 'assets/images/banner/';
				$upload = parent::do_uploads($path);

				if(empty($_FILES['file']['name'])){
					$this->session->set_flashdata('error', $upload['error']);
					redirect('vendor/setting/index');
				}else{
					if(isset($upload['error'])){
						$this->session->set_flashdata('error', $upload['error']);
						redirect('vendor/setting/index');
					}else{
						$this->delete_banner();
						$data_input['banner'] = $upload;
					}
				}
				$result = $this->shop_model->update_by_foriegn_key($data_input, $this->user_id);
			}

			if(isset($_POST['lat']) && isset($_POST['lng'])){
				$data_map = array(
					'lat' => $this->input->post('lat'),
					'lng' => $this->input->post('lng'),
				);
				$this->shop_model->update($data_map, $this->shop_id);
			}

			

			if($result){
				$this->session->set_flashdata('inform', 'Data has been updated successful!');
				redirect('vendor/setting/index');
			}	
		}

		public function map() {
	        $this->load->library('googlemaps');
	       	$config = array();
	        $config['center'] = 'auto'; 
	        $config['zoom'] = '16';
	        $config['onboundschanged'] = 'if (!centreGot) {
								          var mapCentre = map.getCenter();
								          marker_0.setOptions({
								          position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
								          });
								          }
								          centreGot = true;';
	        
	        $this->googlemaps->initialize($config);

	        $marker = array();
	       	$marker['position'] = 'auto';
	        $marker['draggable'] = true;
	        $marker['ondragend'] = 'getLatLng(event.latLng.lat(), event.latLng.lng());';
	        
	        $this->googlemaps->add_marker($marker);

	        return $this->googlemaps->create_map();
    	}

    /*	function get_map($lat, $lng){
    		$this->load->library('googlemaps');

	        $config['center'] = '' . $lat . ', ' . $lng . '';
	        $config['zoom'] = '16';
	        $this->googlemaps->initialize($config);

	        $marker = array();
	        $marker['position'] = '' . $lat . ', ' . $lng . '';
	        $this->googlemaps->add_marker($marker);

	        return $this->googlemaps->create_map();
    	}*/

    	function delete_logo(){
    		$image = $this->get_by_user_id();
			$image_path = "./assets/images/logo/".$image->logo;
			unlink($image_path);
    	}
    	function delete_banner(){
    		$image = $this->get_by_user_id();
			$image_path = "./assets/images/banner/".$image->banner;
			unlink($image_path);
    	}

		/*function upload_validation($upload, $file_name){
			if(empty($_FILES[$file_name]['name'])){
				$this->session->set_flashdata('error', $upload['error']);
				redirect('vendor/setting/index');
			}else{
				if(isset($upload['error'])){
					$this->session->set_flashdata('error', $upload['error']);
					redirect('vendor/setting/index');
				}else{
					return $upload;
				}
			}
		}*/

		

		function get_shop_id(){
			$this->load->model('shop_model');
			$shop = $this->shop_model->get_by_user_id($this->user_id);
			return $shop_id = $shop->shopID;
		}

		function test(){
			echo $this->get_by_user_id()->lat;
		}

	}
 ?>