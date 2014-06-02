<?php 
class Flow_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function register_flow_to_company($flow){

		$this->db->insert('T_CMPNY_FLOW', $flow);
	}

	public function get_flowname_list(){
		$this->db->select("*");
		$this->db->from("T_FLOW");
		$this->db->where('active',1);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_flowtype_list(){
		$this->db->select("*");
		$this->db->from("T_FLOW_TYPE");
		$this->db->where('active',1);
		$query = $this->db->get();
		return $query->result_array();
	}

}