<?php
class category_model extends CI_Model
{
	protected $tabel = "tbl_category";

	public function __construct()
	{
		$this->load->database();
	} 

	public function listCategory($limit, $start= 0)
	{
		$this->db->limit($limit,$start);
		return $this->db->get($this->tabel)->result_array();
	}

	public function insertCategory($data) 
	{
		$this->db->insert($this->tabel,$data);
	}

	public function checkName($name, $id = "")
	{
		if($id) {
			$this->db->where("id != ", $id);
		}

		$this->db->where("cate_name", $name);
		return $this->db->get($this->tabel)->num_rows();
	}

	public function getInfo($id) 
	{
		$this->db->where("id", $id);
		return $this->db->get($this->tabel)->row_array();
	}

	public function update($data,$id) {
		$this->db->where("id", $id);
		$this->db->update($this->tabel, $data);
	}

	public function getTotal()
	{
		return $this->db->get($this->tabel)->num_rows();
	}

	public function delete($id)
	{
		$this->db->where("id", $id);
		$this->db->delete($this->tabel);
	}
}