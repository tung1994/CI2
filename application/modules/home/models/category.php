<?php
/**
* Model Category
*/
class category extends CI_Model
{
	protected $table = "tbl_category";

	public function listCategory()
	{
	   return $this->db->get($this->table)->result_array();
	}
}