<?php 
class Component_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_cmpny_flow_and_flow_type($cmpny_id){
		$this->db->select('T_CMPNY_FLOW.id as value_id, T_FLOW.name as flow_name, T_FLOW_TYPE.name as flow_type_name');
		$this->db->from('T_CMPNY_FLOW');
		$this->db->join('T_FLOW','T_FLOW.id = T_CMPNY_FLOW.flow_id');
		$this->db->join('T_FLOW_TYPE','T_FLOW_TYPE.id = T_CMPNY_FLOW.flow_type_id');
		$this->db->where('T_CMPNY_FLOW.cmpny_id',$cmpny_id);
		$query = $this->db->get()->result_array();
    	return $query;
	}

	public function set_cmpnnt($data){
		$this->db->insert('T_CMPNNT',$data);
		return $this->db->insert_id();
	}

	public function set_cmpny_flow_cmpnnt($data){
		$this->db->insert('T_CMPNY_FLOW_CMPNNT',$data);
	}

	public function get_cmpnnt($cmpny_id){
		$this->db->select('T_CMPNNT.id as id,T_CMPNNT.name as component_name, T_FLOW.name as flow_name, T_FLOW_TYPE.name as flow_type_name');
		$this->db->from('T_CMPNY_FLOW');
		$this->db->join('T_CMPNY_FLOW_CMPNNT','T_CMPNY_FLOW.id = T_CMPNY_FLOW_CMPNNT.cmpny_flow_id');
		$this->db->join('T_CMPNNT','T_CMPNY_FLOW_CMPNNT.cmpnnt_id = T_CMPNNT.id');
		$this->db->join('T_FLOW','T_FLOW.id = T_CMPNY_FLOW.flow_id ');
		$this->db->join('T_FLOW_TYPE','T_FLOW_TYPE.id = T_CMPNY_FLOW.flow_type_id ');
		$this->db->where('T_CMPNY_FLOW.cmpny_id',$cmpny_id);
		$query = $this->db->get()->result_array();
    	return $query;
	}

	public function delete_flow_cmpnnt_by_flowID($id){
		$this->db->where('cmpny_flow_id', $id);
		$this->db->delete('T_CMPNY_FLOW_CMPNNT'); 
	}

	public function delete_flow_cmpnnt_by_cmpnntID($id){
		$this->db->where('cmpnnt_id', $id);
		$this->db->delete('T_CMPNY_FLOW_CMPNNT'); 
	}

	public function delete_cmpnnt($id){
		$this->db->where('id', $id);
		$this->db->delete('T_CMPNNT'); 
	}
}