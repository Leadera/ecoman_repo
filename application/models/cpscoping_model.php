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
  	$this->db->select('t_cp_allocation.id as allocation_id, t_cp_allocation.prcss_id as prcss_id,t_prcss.name as prcss_name, t_flow.name as flow_name, t_flow_type.name as flow_type_name,amount,unit_amount,allocation_amount,importance_amount,cost,unit_cost,allocation_cost,importance_cost,env_impact,unit_env_impact,allocation_env_impact,importance_env_impact,t_cp_allocation.flow_id as flow_id,t_cp_allocation.prcss_id as prcss_id,t_cp_allocation.flow_type_id as flow_type_id, kpi, unit_kpi, kpi_error');
  	$this->db->from('t_cp_allocation');
  	$this->db->join('t_flow','t_flow.id = t_cp_allocation.flow_id');
  	$this->db->join('t_flow_type', 't_flow_type.id = t_cp_allocation.flow_type_id');
  	$this->db->join('t_cmpny_prcss','t_cmpny_prcss.id = t_cp_allocation.prcss_id');
  	$this->db->join('t_prcss','t_prcss.id = t_cmpny_prcss.prcss_id');
  	$this->db->where('t_cp_allocation.id',$allocation_id);
  	return $this->db->get()->row_array();
  }

  public function get_allocation_from_allocation_id_output($allocation_id){
    $this->db->select('t_cp_allocation.id as allocation_id, t_cp_allocation.prcss_id as prcss_id,t_prcss.name as prcss_name, t_flow.name as flow_name, t_flow_type.name as flow_type_name,amount,unit_amount,allocation_amount,importance_amount,cost,unit_cost,allocation_cost,importance_cost,env_impact,unit_env_impact,allocation_env_impact,importance_env_impact,t_cp_allocation.flow_id,t_cp_allocation.prcss_id');
    $this->db->from('t_cp_allocation');
    $this->db->join('t_flow','t_flow.id = t_cp_allocation.flow_id');
    $this->db->join('t_flow_type', 't_flow_type.id = t_cp_allocation.flow_type_id');
    $this->db->join('t_cmpny_prcss','t_cmpny_prcss.id = t_cp_allocation.prcss_id');
    $this->db->join('t_prcss','t_prcss.id = t_cmpny_prcss.prcss_id');
    $this->db->where('t_cp_allocation.id',$allocation_id);
    $this->db->where('t_cp_allocation.flow_type_id','2');
    $query = $this->db->get()->row_array();
    if(!empty($query)){
      return $query;
    }
  }

  public function get_allocation_id_from_ids($company_id,$project_id){
  	$this->db->select('allocation_id');
  	$this->db->from('t_cp_company_project');
  	$this->db->where('cmpny_id',$company_id);
  	$this->db->where('prjct_id',$project_id);
  	return $this->db->get()->result_array();
  }

  /*public function get_allocation_from_fname_pname($flow_id,$process_id,$input_output){
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
  }*/

  public function get_allocation_values($cmpny_id,$prjct_id){
    $this->db->select('t_prcss.name as prcss_name, t_flow.name as flow_name, t_flow_type.name as flow_type_name');
    $this->db->from('t_cp_company_project');
    $this->db->join('t_cp_allocation','t_cp_allocation.id = t_cp_company_project.allocation_id');
    $this->db->join('t_flow','t_flow.id = t_cp_allocation.flow_id');
    $this->db->join('t_flow_type','t_flow_type.id = t_cp_allocation.flow_type_id');
    $this->db->join('t_cmpny_prcss','t_cmpny_prcss.id = t_cp_allocation.prcss_id');
    $this->db->join('t_prcss','t_prcss.id = t_cmpny_prcss.prcss_id');
    $this->db->where('t_cp_company_project.prjct_id',$prjct_id);
    $this->db->where('t_cp_company_project.cmpny_id',$cmpny_id);
    return $this->db->get()->result_array();
  }

  public function get_allocation_from_fname_pname_copy($flow_id,$allocation_id,$input_output){
    $this->db->select('t_prcss.name as prcss_name, t_flow.name as flow_name, t_flow_type.name as flow_type_name,amount,unit_amount,allocation_amount,importance_amount,cost,unit_cost,allocation_cost,importance_cost,env_impact,unit_env_impact,allocation_env_impact,importance_env_impact');
    $this->db->from('t_cp_allocation');
    $this->db->join('t_flow','t_flow.id = t_cp_allocation.flow_id');
    $this->db->join('t_flow_type', 't_flow_type.id = t_cp_allocation.flow_type_id');
    $this->db->join('t_cmpny_prcss','t_cmpny_prcss.id = t_cp_allocation.prcss_id');
    $this->db->join('t_prcss','t_prcss.id = t_cmpny_prcss.prcss_id');
    $this->db->where('t_cp_allocation.id',$allocation_id);
    $this->db->where('t_cp_allocation.flow_id',$flow_id);
    $this->db->where('t_cp_allocation.flow_type_id',$input_output);
    return $this->db->get()->row_array();
  }

  public function get_allocation_prcss_flow_id($allocation_id,$input_output){
    $this->db->select('*');
    $this->db->from('t_cp_allocation');
    $this->db->where('id',$allocation_id);
    $this->db->where('flow_type_id',$input_output);
    return $this->db->get()->row_array();
  }

  public function cp_is_candidate_control($allocation_id){
    $this->db->select('*');
    $this->db->from('t_cp_is_candidate');
    $this->db->where('allocation_id',$allocation_id);
    $query = $this->db->get()->row_array();

    if(!empty($query)){
      if($query['active'] == 1){
        return 1;
      }else{
        return 2;
      }
    }else{
      return 0;
    }
  }

  public function cp_is_candidate_insert($is_candidate_array){
    $this->db->insert('t_cp_is_candidate',$is_candidate_array);
  }

  public function cp_is_candidate_update($is_candidate_array,$allocation_id){
    $this->db->where('allocation_id',$allocation_id);
    $this->db->update('t_cp_is_candidate',$is_candidate_array);
  }

  public function get_is_candidate_active_position($allocation_id){
    $this->db->select('active');
    $this->db->from('t_cp_is_candidate');
    $this->db->where('allocation_id',$allocation_id);
    $query = $this->db->get()->row_array();
    if(empty($query)){
      return 0;
    }else{
      return $query['active'];
    }
  }

  public function insert_cp_scoping_file($cp_scoping_files){
    $this->db->insert('t_cp_scoping_files',$cp_scoping_files);
  }

  public function get_cp_scoping_files($project_id,$cmpny_id){
    $this->db->select('*');
    $this->db->from('t_cp_scoping_files');
    $this->db->where('prjct_id',$project_id);
    $this->db->where('cmpny_id',$cmpny_id);
    return $this->db->get()->result_array();
  }

  public function search_result($prjct_id,$cmpny_id,$search){
    $this->db->from('t_cp_scoping_files');
    $this->db->like('file_name', $search, 'both');
    $this->db->where('prjct_id',$prjct_id);
    $this->db->where('cmpny_id',$cmpny_id);
    return $this->db->get()->result_array();
  }

  public function kpi_insert($kpi,$allocation_id){
    $this->db->where('id',$allocation_id);
    $this->db->update('t_cp_allocation',$kpi);
  }
}
?>
