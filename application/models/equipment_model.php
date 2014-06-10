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

  public function get_cmpny_process($id){
    $this->db->select('T_CMPNY_PRCSS.id');
    $this->db->from('T_CMPNY_PRCSS');
    $this->db->where('T_CMPNY_PRCSS.prcss_id',$id);
    $query = $this->db->get();
    return $query->row_array();
  }

  public function get_equipment_type_list($equipment_id){
    $this->db->select('id,name');
    $this->db->from('T_EQPMNT_TYPE');
    $this->db->where('mother_id',$equipment_id);
    $query = $this->db->get()->result_array();
    return $query;
  }

  public function get_equipment_attribute_list($equipment_type_id){
    $this->db->select('id,attribute_name');
    $this->db->from('T_EQPMNT_TYPE_ATTRBT');
    $this->db->where('eqpmnt_type_id',$equipment_type_id);
    $query = $this->db->get()->result_array();
    return $query;
  }

  public function set_cmpny_eqpmnt($cmpny_eqpmnt_data){
    $this->db->insert('T_CMPNY_EQPMNT',$cmpny_eqpmnt_data);
  }

  public function set_cmpny_eqpmnt_type($cmpny_eqpmnt_type_data){
    $this->db->insert('T_CMPNY_EQPMNT_TYPE',$cmpny_eqpmnt_type_data);
    return $this->db->insert_id();
  }

  public function get_cmpny_prcss_id($cmpny_id,$prcss_id){
    $this->db->select('id');
    $this->db->from('T_CMPNY_PRCSS');
    $this->db->where('cmpny_id',$cmpny_id);
    $this->db->where('prcss_id',$prcss_id);
    $query = $this->db->get()->row_array();
    return $query;
  }

  public function set_cmpny_prcss_eqpmnt($cmpny_prcss_eqpmnt_type_data){
    $this->db->insert('T_CMPNY_PRCSS_EQPMNT_TYPE',$cmpny_prcss_eqpmnt_type_data);
  }

  public function all_information_of_equipment($companyID){
    $this->db->select('T_CMPNY_PRCSS_EQPMNT_TYPE.cmpny_eqpmnt_type_id as cmpny_prcss_eqpmnt_type_id, T_EQPMNT.name as equipment_name, T_EQPMNT_TYPE.name equipment_type_name, T_PRCSS.name as prcss_name');
    $this->db->from('T_CMPNY_PRCSS_EQPMNT_TYPE');
    $this->db->join('T_CMPNY_PRCSS','T_CMPNY_PRCSS.id = T_CMPNY_PRCSS_EQPMNT_TYPE.cmpny_prcss_id');
    $this->db->join('T_PRCSS','T_PRCSS.id = T_CMPNY_PRCSS.prcss_id');
    $this->db->join('T_CMPNY_EQPMNT_TYPE','T_CMPNY_EQPMNT_TYPE.id = T_CMPNY_PRCSS_EQPMNT_TYPE.cmpny_eqpmnt_type_id');
    $this->db->join('T_EQPMNT_TYPE','T_EQPMNT_TYPE.id = T_CMPNY_EQPMNT_TYPE.eqpmnt_type_id');
    $this->db->join('T_EQPMNT','T_EQPMNT.id = T_EQPMNT_TYPE.mother_id');
    $this->db->where('T_CMPNY_PRCSS.cmpny_id',$companyID);
    $this->db->order_by("cmpny_prcss_eqpmnt_type_id", "inc");
    $query = $this->db->get()->result_array();
    return $query;
  }
}
?>
