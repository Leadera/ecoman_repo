<?php 
class Search_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function search_product($term){
		$this->db->select('*');
		$this->db->from('products');
		$this->db->like('name', $term); 
		$query = $this->db->get();
		return $query->result_array();
	}
}
?>