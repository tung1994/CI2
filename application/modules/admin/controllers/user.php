<?php
/**
* 
*/
class user extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("user_model");
		$this->load->helper(array('form','url'));
		$this->load->library("form_validation");
	}

	public function index()
	{
		$data['user'] = $this->user_model->getAll();
		$data['template'] = "user/index";
		$this->load->view('layout', $data);
	}

	public function insert()
	{

		if($this->input->post("btnok")) {
			$this->form_validation->set_rules('name','Username','required');
			$this->form_validation->set_rules('pass','Password','required|min_length[6]|max_length[24]');
			$this->form_validation->set_rules('email','Email','required|valid_email|callback_checkemail');
			$this->form_validation->set_rules('repass','Xác nhận mật khẩu','matches[pass]');
			$this->form_validation->set_rules('address','Address','required');

			$this->form_validation->set_message('required','%s không được để trống');
			$this->form_validation->set_message('valid_email','%s không đúng định dạng');
			$this->form_validation->set_message('min_length','%s không được nhỏ hơn %d');
			$this->form_validation->set_message('max_length','%s không được lớn hơn %d');
			$this->form_validation->set_message('matches','%s không đúng');
			$this->form_validation->set_message('checkemail','Email đã tồn tại');

			if($this->form_validation->run()) {
				$formData = array(
								'name'     => $this->input->post('name'),
								'email'    => $this->input->post('email'),
								'address'  => $this->input->post('address'),
								'password' => $this->input->post('pass')
							);

				$this->user_model->insert($formData);
				redirect('/admin/user');
			}
		}

		$data['template'] = "user/insert";
		$this->load->view('layout', $data);	
	}

	public function delete()
	{
		$id = $this->uri->segment(4);
		$this->user_model->delete($id);
		redirect('/admin/user');
	}

	public function edit()
	{
		$id = $this->uri->segment(4);
		if($this->input->post("btnok")) {
			$this->form_validation->set_rules('name','Username','required');
			$this->form_validation->set_rules('pass','Password','min_length[6]|max_length[24]');
			$this->form_validation->set_rules('email','Email','required|valid_email|callback_checkemail');
			$this->form_validation->set_rules('repass','Xác nhận mật khẩu','matches[pass]');
			$this->form_validation->set_rules('address','Address','required');

			$this->form_validation->set_message('required','%s không được để trống');
			$this->form_validation->set_message('valid_email','%s không đúng định dạng');
			$this->form_validation->set_message('min_length','%s không được nhỏ hơn %d');
			$this->form_validation->set_message('max_length','%s không được lớn hơn %d');
			$this->form_validation->set_message('matches','%s không đúng');
			$this->form_validation->set_message('checkemail','Email không được trùng nhau');

			if($this->form_validation->run()) {
				$formData = array(
								'name'     => $this->input->post('name'),
								'email'    => $this->input->post('email'),
								'address'  => $this->input->post('address'),
							);
				if($this->input->post('pass') 
						&& $this->input->post('pass') == $this->input->post('repass') ) {
					$formData['password'] = $this->input->post('pass');
				}
				$this->user_model->update($id,$formData);
				redirect('/admin/user');
			}
		}

		$data['infoUser'] = $this->user_model->getOnce($id);
		$data['template'] = "user/edit";
		$this->load->view('layout', $data);	
	}

	public function checkemail()
	{
		$id    = $this->uri->segment(4);
		$email = $this->input->post("email"); 
		if($id) {
			$check = $this->user_model->checkemail($email,$id);	
		} else {
			$check = $this->user_model->checkemail($email);
		}
		if($check > 0) {
			return false;
		} else {
			return true;
		}
	}
}