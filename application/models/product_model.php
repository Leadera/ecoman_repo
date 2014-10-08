<?php 
class Product_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function register_product_to_company($product){
		$this->db->insert('t_prdct', $product);
	}

	public function get_product_list($id){
		$this->db->select("*");
		$this->db->from("t_prdct");
		$this->db->where("t_prdct.cmpny_id",$id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function set_product($data){
		$this->db->insert('t_prdct',$data);
	}

	public function delete_product($id){
		$this->db->where('id', $id);
		$this->db->delete('t_prdct'); 
	}
}