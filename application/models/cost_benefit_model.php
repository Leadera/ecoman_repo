<?php
class Cost_benefit_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }

  public function get_is_candidates(){
    $this->db->select('allocation_id');
    $this->db->from('t_cp_is_candidate');
    $this->db->where('active','1');
    return $this->db->get()->result_array();
  }

  public function get_allocation_ids($allocation_id,$prjct_id,$cmpny_id){
    $this->db->select('id');
    $this->db->from('t_cp_company_project');
    $this->db->where('allocation_id',$allocation_id);
    $this->db->where('prjct_id',$prjct_id);
    $this->db->where('cmpny_id',$cmpny_id);
    $query = $this->db->get()->row_array();
    if(!empty($query)){
      return true;
    }else{
      return false;
    }
  }

  public function set_cba($alloc_id,$prjct_id,$capexold,$ltold,$capexnew,$ltnew,$disrate,$newcons){
    $data = array(
              'capexold' => $capexold,
              'ltold' => $ltold,
              'capexnew' => $capexnew,
              'ltnew' => $ltnew,
              'disrate' => $disrate,
              'newcons' => $newcons
            );
    $this->db->where('id', $alloc_id);
    $this->db->update('t_cp_allocation', $data); 
  }

}
?>
