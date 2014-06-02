<?php 
class Component_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function register_component($component){
		$this->db->insert('T_CMPNNT', $component);
	}

	public function component_list(){
		$this->db->select("*");
		$this->db->from("T_CMPNNT");
		$query = $this->db->get();
		return $query->result_array();
	}


}