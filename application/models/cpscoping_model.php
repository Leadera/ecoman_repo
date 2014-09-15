<?php
class Cpscoping_model extends CI_Model {

  public function __construct(){
    $this->load->database();
  }

  public function set_cp_allocation($data){
    $this->db->insert('t_cp_allocation',$data);    
  }

  public function set_cp_allocation_main($data){
    $this->db->insert('t_cp_company_project',$data);    
  }

  public function get_allocation_from_allocation_id($allocation_id){
  	$this->db->select('t_prcss.name as prcss_name, t_flow.name as flow_name, t_flow_type.name as flow_type_name,amount,unit_amount,allocation_amount,importance_amount,cost,unit_cost,allocation_cost,importance_cost,env_impact,unit_env_impact,allocation_env_impact,importance_env_impact,t_cp_allocation.flow_id,t_cp_allocation.prcss_id');
  	$this->db->from('t_cp_allocation');
  	$this->db->join('t_flow','t_flow.id = t_cp_allocation.flow_id');
  	$this->db->join('t_flow_type', 't_flow_type.id = t_cp_allocation.flow_type_id');
  	$this->db->join('t_cmpny_prcss','t_cmpny_prcss.id = t_cp_allocation.prcss_id');
  	$this->db->join('t_prcss','t_prcss.id = t_cmpny_prcss.prcss_id');
  	$this->db->where('t_cp_allocation.id',$allocation_id);
  	return $this->db->get()->row_array();
  }

  public function get_allocation_id_from_ids($company_id,$project_id){
  	$this->db->select('allocation_id');
  	$this->db->from('t_cp_company_project');
  	$this->db->where('cmpny_id',$company_id);
  	$this->db->where('prjct_id',$project_id);
  	return $this->db->get()->result_array();
  }

  public function get_allocation_from_fname_pname($flow_id,$process_id,$input_output){
  	$this->db->select('t_prcss.name as prcss_name, t_flow.name as flow_name, t_flow_type.name as flow_type_name,amount,unit_amount,allocation_amount,importance_amount,cost,unit_cost,allocation_cost,importance_cost,env_impact,unit_env_impact,allocation_env_impact,importance_env_impact');
  	$this->db->from('t_cp_allocation');
  	$this->db->join('t_flow','t_flow.id = t_cp_allocation.flow_id');
  	$this->db->join('t_flow_type', 't_flow_type.id = t_cp_allocation.flow_type_id');
  	$this->db->join('t_cmpny_prcss','t_cmpny_prcss.id = t_cp_allocation.prcss_id');
  	$this->db->join('t_prcss','t_prcss.id = t_cmpny_prcss.prcss_id');
  	$this->db->where('t_cp_allocation.flow_id',$flow_id);
  	$this->db->where('t_cp_allocation.prcss_id',$process_id);
  	$this->db->where('t_cp_allocation.flow_type_id',$input_output);
  	return $this->db->get()->row_array();
  }

}
?>
