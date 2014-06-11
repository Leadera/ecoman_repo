<?php 
class Search_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function search_company($term){
		$this->db->select('*');
		$this->db->from('T_CMPNY');
		$this->db->like('name', $term); 
		$this->db->or_like('description', $term);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function search_project($term){
		$this->db->select('*');
		$this->db->from('T_PRJ');
		$this->db->like('name', $term); 
		$this->db->or_like('description', $term);
		$query = $this->db->get();
		return $query->result_array();
	}

}
?>