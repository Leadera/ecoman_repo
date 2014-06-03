<?php
class Equipment_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }

  public function get_equipment_name($id){
    $this->db->select('T_PRCSS.name_tr as prcessname');
    $this->db->from('T_CMPNY_PRCSS');
    $this->db->join('T_CMPNY_PRCSS','T_CMPNY_PRCSS.id = T_CMPNY_FLOW_PRCSS.cmpny_prcss_id');
    $this->db->join('T_PRCSS','T_PRCSS.id = T_CMPNY_PRCSS.prcss_id');
    $this->db->where('T_CMPNY_FLOW.cmpny_id',$id);
    $query = $this->db->get();
    return $query->result_array();
  }
}
?>
