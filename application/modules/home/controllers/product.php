<?php
class product extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("category");
		$this->load->model("product");
	}

	public function listcategory()
	{	
		$id = $this->uri->segment(4);
		
		$data['category'] = $this->category->listCategory();
		$data['product']  = $this->product->listCategoryProduct($id);

		
	}
}