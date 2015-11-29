<?php
class category extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library("form_validation");
		$this->load->helper(array("form","url"));
		$this->load->model("category_model");
		$this->load->library("pagination");
	}

	public function index()
	{
		$start = $this->uri->segment(4);
		$config['base_url']    = '/admin/category/index';
		$config['total_rows']  = $this->category_model->getTotal();
		$config['per_page']    = 10;
		$config['uri_segment'] = 4; 
		$this->pagination->initialize($config); 

		$data['category'] = $this->category_model->listCategory($config['per_page'],$start);
		$data['template'] = "category/index";
		$this->load->view('layout', $data);
	}

	public function insert()
	{
		if($this->input->post('btnok')) {
			$this->form_validation->set_rules('cate_name','Category name','required|callback_check_name');
			$this->form_validation->set_message('required','%s không được để trống');
			$this->form_validation->set_message('check_name', "Category name da ton tai");
			if($this->form_validation->run()) {
				$formData = array(
								"cate_name"=>$this->input->post("cate_name"),
								"parent"   =>0,
								"status"   =>$this->input->post("status")
							);
		
				if(isset($_FILES['images']['name']) 
					&& $_FILES['images']['name'] != null ) {

					$config['upload_path'] = './uploads/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size']	= '100000';
					$config['max_width']  = '10000';
					$config['max_height']  = '1024';
					$this->load->library('upload', $config);

					if($this->upload->do_upload("images")) {
						$fileInfo = $this->upload->data();

						$formData['image'] = $fileInfo['file_name'];
					}
				} 
				$this->category_model->insertCategory($formData);
				redirect("/admin/category");
			}
		}
		$data['title']    = "Insert Category";
		$data['template'] = "category/form";
		$this->load->view("layout", $data);
	}

	public function edit()
	{

		$id = $this->uri->segment(4);
		$data['info'] = $this->category_model->getInfo($id);

		if($this->input->post('btnok')) {
			$this->form_validation->set_rules('cate_name','Category name','required|callback_check_name');
			$this->form_validation->set_message('required','%s không được để trống');
			$this->form_validation->set_message('check_name', "Category name da ton tai");
			if($this->form_validation->run()) {
				$formData = array(
								"cate_name"=>$this->input->post("cate_name"),
								"parent"   =>0,
								"status"   =>$this->input->post("status")
							);
		
				if(isset($_FILES['images']['name']) 
					&& $_FILES['images']['name'] != null ) {

					$config['upload_path'] = './uploads/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size']	= '100000';
					$config['max_width']  = '10000';
					$config['max_height']  = '1024';
					$this->load->library('upload', $config);

					if($this->upload->do_upload("images")) {
						$fileInfo = $this->upload->data();

						$formData['image'] = $fileInfo['file_name'];
					}
				} 

				$this->category_model->update($formData, $id);
				redirect("/admin/category");
			}
		}

		$data['title']    = "Edit Category";
		$data['template'] = "category/form";
		$this->load->view("layout", $data);
	}


	public function check_name()
	{
		$name = $this->input->post("cate_name");
		$id = $this->uri->segment(4);
		if($id) {
			$check = $this->category_model->checkName($name, $id);
		} else {
			$check = $this->category_model->checkName($name);
		}

		if($check > 0 ) {
			return false;
		} else {
			return true;
		}
	}
	
	public function delete()
	{
		$id = $this->uri->segment(4);
		$this->category_model->delete($id);
		redirect("/admin/category");
	}
}