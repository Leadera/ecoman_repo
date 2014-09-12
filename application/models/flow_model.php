<?php 
class Flow_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function register_flow_to_company($flow){

		$this->db->insert('T_CMPNY_FLOW', $flow);
	}

	public function get_flow_from_flow_id($flow_id){
		$this->db->select("*");
		$this->db->from("T_FLOW");
		$this->db->where("id",$flow_id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_flow_from_flow_name($flow_name){
		$this->db->select("*");
		$this->db->from("T_FLOW");
		$this->db->where("name",$flow_name);
		$query = $this->db->get();
		return $query->row_array();
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
		$this->db->select('T_CMPNY_FLOW.id as id,T_FLOW.name as flowname,T_FLOW_TYPE.name  as flowtype,T_CMPNY_FLOW.id as cmpny_flow_id,T_CMPNY_FLOW.qntty as qntty,unit1.name as qntty_unit_name,T_CMPNY_FLOW.cost as cost,unit2.name as cost_unit_name,T_CMPNY_FLOW.ep as ep,unit3.name as ep_unit_name');
		$this->db->from("T_CMPNY_FLOW");
		$this->db->join('T_FLOW','T_FLOW.id = T_CMPNY_FLOW.flow_id');
		$this->db->join('T_FLOW_TYPE','T_FLOW_TYPE.id = T_CMPNY_FLOW.flow_type_id');
		$this->db->join('T_UNIT as unit1','unit1.id = T_CMPNY_FLOW.qntty_unit_id');
		$this->db->join('T_UNIT as unit2','unit2.id = T_CMPNY_FLOW.cost_unit_id');
		$this->db->join('T_UNIT as unit3','unit3.id = T_CMPNY_FLOW.ep_unit_id');		
		$this->db->where('cmpny_id',$companyID);
		$this->db->group_by('T_CMPNY_FLOW.id');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_unit_list(){
		$this->db->select("*");
		$this->db->from("T_UNIT");
		$this->db->where('active',1);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function has_same_flow($flow_id,$flow_type_id){
		$this->db->select("*");
		$this->db->from("T_CMPNY_FLOW");
		$this->db->where('flow_id',$flow_id);
		$this->db->where('flow_type_id',$flow_type_id);
		$query = $this->db->get()->result_array();
		if(!empty($query)){
			return false;
		}
		else{
			return true;
		}
	}

	public function delete_flow($id){
		$this->db->where('id', $id);
		$this->db->delete('T_CMPNY_FLOW'); 
	}

}