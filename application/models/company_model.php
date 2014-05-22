<?php
class Company_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }

  public function create_company($data){
    $this->db->insert('T_CMPNY', $data); 
  }
}
?>
