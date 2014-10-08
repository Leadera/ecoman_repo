<?php 
class Component_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_cmpny_flow_and_flow_type($cmpny_id){
		$this->db->select('t_cmpny_flow.id as value_id, t_flow.name as flow_name, t_flow_type.name as flow_type_name');
		$this->db->from('t_cmpny_flow');
		$this->db->join('t_flow','t_flow.id = t_cmpny_flow.flow_id');
		$this->db->join('t_flow_type','t_flow_type.id = t_cmpny_flow.flow_type_id');
		$this->db->where('t_cmpny_flow.cmpny_id',$cmpny_id);
		$query = $this->db->get()->result_array();
    	return $query;
	}

	public function set_cmpnnt($data){
		$this->db->insert('t_cmpnnt',$data);
		return $this->db->insert_id();
	}

	public function set_cmpny_flow_cmpnnt($data){
		$this->db->insert('t_cmpny_flow_cmpnnt',$data);
	}

	public function get_cmpnnt($cmpny_id){
		$this->db->select('t_cmpnnt.id as id,t_cmpnnt.name as component_name, t_flow.name as flow_name, t_flow_type.name as flow_type_name');
		$this->db->from('t_cmpny_flow');
		$this->db->join('t_cmpny_flow_cmpnnt','t_cmpny_flow.id = t_cmpny_flow_cmpnnt.cmpny_flow_id');
		$this->db->join('t_cmpnnt','t_cmpny_flow_cmpnnt.cmpnnt_id = t_cmpnnt.id');
		$this->db->join('t_flow','t_flow.id = t_cmpny_flow.flow_id ');
		$this->db->join('t_flow_type','t_flow_type.id = t_cmpny_flow.flow_type_id ');
		$this->db->where('t_cmpny_flow.cmpny_id',$cmpny_id);
		$query = $this->db->get()->result_array();
    	return $query;
	}

	public function delete_flow_cmpnnt_by_flowID($id){
		$this->db->where('cmpny_flow_id', $id);
		$this->db->delete('t_cmpny_flow_cmpnnt'); 
	}

	public function delete_flow_cmpnnt_by_cmpnntID($id){
		$this->db->where('cmpnnt_id', $id);
		$this->db->delete('t_cmpny_flow_cmpnnt'); 
	}

	public function delete_cmpnnt($id){
		$this->db->where('id', $id);
		$this->db->delete('t_cmpnnt'); 
	}
}