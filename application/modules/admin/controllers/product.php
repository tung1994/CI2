<?php
class product extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("product_model");
		$this->load->library("form_validation");
		$this->load->helper(array("form","url"));
		$this->load->model("category_model");
	}

	public function index()
	{
		$data['product'] = $this->product_model->getAll(); 
		$data['title']   = "Danh sách sản phẩm";
		$data['template'] = "product/index"; 
		$this->load->view("layout", $data);
	}

	public function insert()
	{
		$this->category_model->listCategory();
		if($this->input->post("btnok")) {
			$formData = $this->validation();
			if($formData) {
				$fileName = $this->upload();
				if($fileName) {
					$formData['image'] = $fileName;
				}
				$this->product_model->insert($formData);
				redirect("/admin/product");
			}
		}
		$data['category']  = $this->category_model->listCategory();
		$data['title']     = "Thêm sản phẩm";
		$data['template']  = "product/form"; 
		$this->load->view("layout", $data);	
	}

	public function edit($id)
	{


		$data['product'] = $this->product_model->getOnce($id);
		$data['category']  = $this->category_model->listCategory();
		
		if($this->input->post("btnok")) {
			$formData = $this->validation();
			if($formData) {
				$fileName = $this->upload();
				if($fileName) {
					$formData['image'] = $fileName;
					@unlink("./uploads/".$data['product']['image']);
				}
				$this->product_model->update($formData,$id);
				redirect("/admin/product");
			}
		}

		$data['title']     = "Sửa sản phẩm";
		$data['template']  = "product/form"; 
		$this->load->view("layout", $data);	
	}

	public function delete($id)
	{	
		$data = $this->product_model->getOnce($id);
		$this->product_model->delete($id);
		@unlink("./uploads/".$data['image']);
		redirect("/admin/product");
	}

	public function validation()
	{
		$this->form_validation->set_rules('name','Tên sản phẩm','required');
		$this->form_validation->set_rules('category','Danh mục sản phẩm','required');
		$this->form_validation->set_rules('price','Giá sản phẩm','required|numeric');
		$this->form_validation->set_rules('info','Thông tin sản phẩm','required');

		$this->form_validation->set_message('required','%s không được để trống');
		$this->form_validation->set_message('numeric', "%s phải là số");
		if($this->form_validation->run()) {
			return array(
						"cate_id"  => $this->input->post("category"), 
						"name"     => $this->input->post("name"),
						"price"    => $this->input->post("price"),
						"info"     => $this->input->post("info"),
						"status"   => $this->input->post("status"),
				   );
		} else {
			return false;
		}
	}

	protected function upload()
	{
		if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != null) {

			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']	= '100000';
			$config['max_width']  = '10000';
			$config['max_height']  = '1024';
			$this->load->library('upload', $config);
			$this->upload->do_upload("image");
			$fileInfo = $this->upload->data();
			return $fileInfo['file_name'];
		}else {
			return false;
		}
	}
}