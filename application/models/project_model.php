<?php
class Project_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }
  public function create_project($project){
    $this->db->insert('T_PRJ', $project);
    return $this->db->insert_id();
  }

  public function get_active_project_status(){

    $this->db->select('*');
    $this->db->from('T_PRJ_STATUS');
    $this->db->where('active', 1);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function insert_project_company($prj_cmpny){
    $this->db->insert('T_PRJ_CMPNY', $prj_cmpny);
  }
  public function insert_project_consultant($prj_cnsltnt){
    $this->db->insert('T_PRJ_CNSLTNT', $prj_cnsltnt);
  }
  public function insert_project_contact_person($prj_cntct_prsnl){
     $this->db->insert('T_PRJ_CNTCT_PRSNL', $prj_cntct_prsnl);
  }

  public function get_projects(){
    $this->db->select("*");
    $this->db->from('T_PRJ');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_project($prj_id){
    $this->db->select("*");
    $this->db->from('T_PRJ');
    $this->db->where('id',$prj_id);
    $query = $this->db->get();
    return $query->row_array();
  }

  public function get_status($prj_id){
    $this->db->select('T_PRJ_STATUS.name');
    $this->db->from('T_PRJ_STATUS');
    $this->db->join('T_PRJ', 'T_PRJ.status_id = T_PRJ_STATUS.id');
    $this->db->where('T_PRJ.id', $prj_id); 
    $query = $this->db->get();
    return $query->row_array();
  }

  public function get_prj_consaltnt($prj_id){
    $this->db->select('T_USER.name,T_USER.surname,T_USER.id,T_USER.user_name');
    $this->db->from('T_USER');
    $this->db->join('T_PRJ_CNSLTNT', 'T_PRJ_CNSLTNT.cnsltnt_id = T_USER.id');
    $this->db->where('T_PRJ_CNSLTNT.prj_id', $prj_id); 
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_prj_companies($prj_id){
    $this->db->select('T_CMPNY.name,T_CMPNY.id');
    $this->db->from('T_CMPNY');
    $this->db->join('T_PRJ_CMPNY', 'T_PRJ_CMPNY.cmpny_id = T_CMPNY.id');
    $this->db->where('T_PRJ_CMPNY.prj_id', $prj_id); 
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_prj_cntct_prsnl($prj_id){
    $this->db->select('T_USER.name,T_USER.surname,T_USER.id,T_USER.user_name');
    $this->db->from('T_USER');
    $this->db->join('T_PRJ_CNTCT_PRSNL', 'T_PRJ_CNTCT_PRSNL.usr_id = T_USER.id');
    $this->db->where('T_PRJ_CNTCT_PRSNL.prj_id', $prj_id); 
    $query = $this->db->get();
    return $query->result_array();
  }

}
?>
