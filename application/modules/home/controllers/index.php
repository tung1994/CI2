<?php
class index extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("category");
		$this->load->model("product");
	}
	
	public function index()
	{
		$data['category'] = $this->category->listCategory();
		$data['product']  = $this->product->newProduct();
		$data['template'] = "default/index";
		$this->load->view("layout", $data);
	}
}