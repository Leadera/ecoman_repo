<?php 
class Product_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function register_product_to_company($product){
		$this->db->insert('T_PRDCT', $product);
	}

	public function get_product_list(){
		$this->db->select("*");
		$this->db->from("T_PRDCT");
		$query = $this->db->get();
		return $query->result_array();
	}


}