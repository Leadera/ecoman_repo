<?php 
class Product_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function register_product_to_company($product){
		$this->db->insert('T_PRDCT', $product);
	}

	public function get_product_list($id){
		$this->db->select("*");
		$this->db->from("T_PRDCT");
		$this->db->where("T_PRDCT.cmpny_id",$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function set_product($data){
		$this->db->insert('T_PRDCT',$data);
	}

	public function delete_product($id){
		$this->db->where('id', $id);
		$this->db->delete('T_PRDCT'); 
	}
}