<?php
class Cluster_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }

  public function get_clusters(){
    $this->db->select('*');
    $this->db->from('T_CLSTR');
    $query = $this->db->get()->result_array();
    return $query;
  }

  public function get_cluster_name($cluster_id){
    $this->db->select('name');
    $this->db->from('T_CLSTR');
    $this->db->where('id',$cluster_id);
    $query = $this->db->get()->row_array();
    return $query;
  }

  public function set_cmpny_clstr($data){
    $this->db->insert('T_CMPNY_CLSTR',$data);
  }

  public function can_write_info($cluster_id,$company_id){
    $this->db->select('clstr_id');
    $this->db->from('T_CMPNY_CLSTR');
    $this->db->where('cmpny_id',$company_id);
    $query = $this->db->get()->result_array();
    if(empty($query)){
      return true;
    }else{
      foreach ($query as $var) {
        if($var['clstr_id'] == $cluster_id){
          return false;
        }
      }
      return true;
    }
  }
}
?>
