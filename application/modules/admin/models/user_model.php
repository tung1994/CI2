<?php
class user_model extends CI_Model
{
	protected $table = "tbl_user";

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function getAll()
	{
		return $this->db->get($this->table)->result_array();
	}

	public function insert($data)
	{
		$this->db->insert($this->table, $data);
	}

	public function delete($id)
	{
		$this->db->where("id", $id);
		$this->db->delete($this->table);
	}

	public function getOnce($id)
	{
		$this->db->where("id", $id);
		return $this->db->get($this->table)->row_array();
	}

	public function update($id,$data)
	{
		$this->db->where("id", $id);
		$this->db->update($this->table, $data);
	}

	public function checkEmail($email,$id="") {
		$this->db->where("email",$email);
		if($id != null ) {
			$this->db->where("id != ", $id);
		}
		return $this->db->get($this->table)->num_rows();
	}
}