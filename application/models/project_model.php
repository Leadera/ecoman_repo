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

}
?>
