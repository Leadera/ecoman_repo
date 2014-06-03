<?php
class Equipment_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }

  public function get_equipment_name(){
    $this->db->select('*');
    $this->db->from('T_EQPMNT');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function cmpny_prcss($id){
    $this->db->select('T_PRCSS.name_tr as prcessname,T_PRCSS.id as processid');
    $this->db->from('T_CMPNY_PRCSS');
    $this->db->join('T_PRCSS','T_CMPNY_PRCSS.prcss_id = T_PRCSS.id');
    $this->db->where('T_CMPNY_PRCSS.cmpny_id',$id);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function cmpny_eqpmnt($data){
    $this->db->insert('T_CMPNY_EQPMNT',$data);
  }

  public function get_eqpmnt_type_id($id){
    $this->db->select('T_EQPMNT.eqpmnt_type_id');
    $this->db->from('T_EQPMNT');
    $this->db->where('T_EQPMNT.id',$id);
    $query = $this->db->get();
    return $query->row_array();
  }

  public function cmpny_eqpmnt_type($data){
    $this->db->insert('T_CMPNY_EQPMNT_TYPE',$data);
    return $this->db->insert_id();
  }

  public function t_cmpny_prcss_eqpmnt_type($data){
    $this->db->insert('T_CMPNY_PRCSS_EQPMNT_TYPE',$data);
  }

  public function get_cmpny_process($id){
    $this->db->select('T_CMPNY_PRCSS.id');
    $this->db->from('T_CMPNY_PRCSS');
    $this->db->where('T_CMPNY_PRCSS.prcss_id',$id);
    $query = $this->db->get();
    return $query->row_array();
  }
}
?>
