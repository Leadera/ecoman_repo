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

	public function get_company_flow_list($companyID){
		$this->db->select('T_FLOW.name as flowname,T_FLOW_TYPE.name  as flowtype,T_CMPNY_FLOW.qntty as qntty,T_CMPNY_FLOW.cost as cost,T_CMPNY_FLOW.ep as ep');
		$this->db->from("T_CMPNY_FLOW");
		$this->db->join('T_FLOW','T_FLOW.id = T_CMPNY_FLOW.flow_id');
		$this->db->join('T_FLOW_TYPE','T_FLOW_TYPE.id = T_CMPNY_FLOW.flow_type_id');
		$this->db->where('cmpny_id',$companyID);
		$query = $this->db->get();
		return $query->result_array();

	}

}