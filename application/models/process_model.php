<?php 
class Process_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_process(){
		$this->db->select('*');
	    $this->db->from('T_PRCSS');
	    $query = $this->db->get();
	    return $query->result_array();
	}

	public function cmpny_flow_prcss($data){
		$this->db->insert('T_CMPNY_FLOW_PRCSS',$data);
	}

	public function cmpny_prcss($data){
		$this->db->insert('T_CMPNY_PRCSS',$data);
		return $this->db->insert_id();
	}

	public function get_cmpny_flow_prcss($id){
		$this->db->select('T_FLOW.name_tr as flowname, T_PRCSS.name_tr as prcessname');
		$this->db->from('T_CMPNY_FLOW_PRCSS');
		$this->db->join('T_CMPNY_FLOW','T_CMPNY_FLOW.id = T_CMPNY_FLOW_PRCSS.cmpny_flow_id');
		$this->db->join('T_FLOW','T_FLOW.id = T_CMPNY_FLOW.flow_id');
		$this->db->join('T_CMPNY_PRCSS','T_CMPNY_PRCSS.id = T_CMPNY_FLOW_PRCSS.cmpny_prcss_id');
		$this->db->join('T_PRCSS','T_PRCSS.id = T_CMPNY_PRCSS.prcss_id');
		$this->db->where('T_CMPNY_FLOW.cmpny_id',$id);
		$query = $this->db->get();
	    return $query->result_array();
	}

}

?>