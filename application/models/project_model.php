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

  public function update_project($project,$id){
    $this->db->where('id', $id);
    $this->db->update('T_PRJ', $project); 
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
  public function remove_company_from_project($projID){
    $this->db->delete('T_PRJ_CMPNY', array('prj_id' => $projID)); 
  }

  public function remove_consultant_from_project($projID){
    $this->db->delete('T_PRJ_CNSLTNT', array('prj_id' => $projID));  
  }

  public function remove_contactuser_from_project($projID){
    $this->db->delete('T_PRJ_CNTCT_PRSNL', array('prj_id' => $projID));  
  }

  public function can_update_project_information($user_id,$project_id){
    $this->db->select('cnsltnt_id');
    $this->db->from('T_PRJ_CNSLTNT');
    $this->db->where('T_PRJ_CNSLTNT.prj_id',$project_id);
    $query = $this->db->get()->result_array();
    foreach ($query as $cnsltnt) {
      if($cnsltnt['cnsltnt_id'] == $user_id){
        return true;
      }
    }
    return false;
  }

  public function have_project_name($project_id,$project_name){
    $this->db->select('id');
    $this->db->from('T_PRJ');
    $this->db->where('name',$project_name); 
    $query = $this->db->get()->result_array();
    if(empty($query))
      return true;
    else{
      foreach ($query as $variable) {
        if($variable['id'] != $project_id){
          return false;
        }
      }
      return true;
    }
  }
 }
?>
