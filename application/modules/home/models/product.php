<?php
class product extends CI_Model
{
	protected $table = "tbl_product";

	public function newProduct()
	{
		$this->db->order_by("id","DESC");
		$this->db->limit(9);
		return $this->db->get($this->table)->result_array();
	}

	public function listCategoryProduct($id)
	{
		$this->db->where("cate_id",$id);
		return $this->db->get($this->table)->result_array();
	}
}
?>