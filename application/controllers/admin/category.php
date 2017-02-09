<?php 
/**
* 
*/
class Category extends My_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('category_model');
		$this->load->model('sub_category_model');
		$this->load->library('user_agent');

		parent::init_slug('category', 'categoryID', 'categoryName');
		//parent::init_slug('subCategory', 'subCategoryID', 'subCategoryName');
		parent::is_login_admin();
	}

	function index(){
		$data['main_content'] = 'admin/category/index';
		$this->load->view('admin/layouts/main', $data);
	}

	function get_all_category(){
		$output = array();
    	$this->output->set_content_type('application/json');

    	$results = $this->category_model->get_all_category();

    	$data = array();
    	foreach($results as $result){
    		$nested_data = array();
    		$nested_data[] = $result->categoryID;
    		$nested_data[] = $result->categoryName;

    		if ($result->status == 1) {
            	$nested_data[] = '<span class = "label label-success" aria-hidden = "true">Active</span>';
        	} else {
            	$nested_data[] = '<span class = "label label-warning" aria-hidden = "true">Disactive</span>';
        	}
        	$nested_data[] = ' <a href = "' . base_url() . 'admin/category/edit/' . $result->categoryID . '" class = "insert btn btn-sm btn-info" id = "' . $result->categoryID . '" title = "Edit"><span class = "glyphicon glyphicon-edit" aria-hidden = "true"></span> Edit</a> '
                . '<a class = "btn btn-sm btn-warning" data-whatever = "' . $result->categoryID . '" data-toggle="modal" data-target="#status-category-modal" title = "Edit"><span class = "glyphicon glyphicon-cog" aria-hidden = "true"></span> Status</a> '
                . '<a class = "del-category btn btn-sm btn-danger" id = "' . $result->categoryID . '" title = "Delte"><span class = "glyphicon glyphicon-trash" aria-hidden = "true"></span> Delete</a>';

    		$data[] = $nested_data;
    	}

    	$this->output->set_output(json_encode($data));
	}

	function add(){
		$data['main_content'] = "admin/category/add";
		$this->load->view('admin/layouts/main', $data);

		if(isset($_POST['submit'])){
			$data_category = array(
				'categoryName' => $this->input->post('category_name')
			);
			$data_category['slug'] = parent::create_slug('categoryName' ,$this->input->post('category_name'));
			$category_id = $this->category_model->insert($data_category);

			//add new sub category

			$data_sub_category_new = array();
				for($i=0; $i<count($_POST['new_sub_category']); $i++){
					$slug = url_title($_POST['new_sub_category'][$i], 'dash', TRUE);

					$data_sub_category_new[] = array(
						'subCategoryName' => $_POST['new_sub_category'][$i],
						'categoryID' => $category_id,
						'slug'=> $slug
					);
				}
			$this->sub_category_model->insert_batch($data_sub_category_new);

			$this->session->set_flashdata('inform', 'New data has been inserted!');
			redirect(base_url().'admin/category/edit/'.$category_id);

		}
	}

	function edit($category_id){
		$data['category'] = $this->category_model->get_category_by_id($category_id);
		$data['sub_category'] = $this->category_model->get_sub_categories($category_id);
		$data['main_content'] = 'admin/category/edit';
		$this->load->view('admin/layouts/main', $data);

		if(isset($_POST['submit'])){

			//update category
			$data_category = array(
				'categoryName' =>$this->input->post('category_name')
			);
			$data_category['slug'] = parent::create_slug('categoryName' ,$this->input->post('category_name'), $category_id);
			$this->category_model->update($data_category, $category_id);

			//update sub category
			$data_sub_category = array();
			for($i=0; $i<count($_POST['sub_category']); $i++){
				$slug = url_title($_POST['sub_category'][$i], 'dash', TRUE);
				$data_sub_category[] = array(
					'subCategoryName' => $_POST['sub_category'][$i],
					'subCategoryID' => $_POST['sub_category_id'][$i],
					'slug' => $slug
				);
			}
		
			$this->sub_category_model->update_batch($data_sub_category, 'subCategoryID');

			//add new sub category
			if(isset($_POST['new_sub_category'])){
				$data_sub_category_new = array();
				for($i=0; $i<count($_POST['new_sub_category']); $i++){
					$slug = url_title($_POST['new_sub_category'][$i], 'dash', TRUE);
					$data_sub_category_new[] = array(
						'subCategoryName' => $_POST['new_sub_category'][$i],
						'categoryID' => $category_id,
						'slug' => $slug
					);
				}
				$this->sub_category_model->insert_batch($data_sub_category_new);
			}

			$this->session->set_flashdata('inform', 'Category has been update!');
			redirect(base_url().'admin/category/edit/'.$category_id);
		}
	}
	function delete_category($category_id){
		$this->category_model->delete($category_id);
		$this->session->set_flashdata('inform', 'Data has been deleted!');

		//back to previuos page
		redirect(base_url().'admin/category/index');
	}

	function delete_sub_category($sub_category_id){
		$this->sub_category_model->delete($sub_category_id);
		$this->session->set_flashdata('inform', 'Data has been deleted!');

		//back to previuos page
		redirect($this->agent->referrer());	
	}

	function update_status(){
		$data = array(
			'status' => $this->input->post('status')
		);
		
		$result = $this->category_model->update($data, $this->input->post('category_id'));
		if($result){
			$this->session->set_flashdata('inform', 'Status has been updated!');
			redirect(base_url()."admin/category/index");
		}
		
	}

}
 ?>