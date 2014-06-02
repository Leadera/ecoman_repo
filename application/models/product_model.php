<?php 
class Product_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function register_pro($product){
		$this->db->insert('T_PRDCT', $product);
	}

	public function product_list(){
		$this->db->select("*");
		$this->db->from("T_PRDCT");
		$query = $this->db->get();
		return $query->result_array();
	}


}