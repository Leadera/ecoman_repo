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

}
?>
