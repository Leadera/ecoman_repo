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

  public function set_cba($capexold,$ltold,$capexnew,$ltnew,$disrate,$newcons,$marcos,$ecoben,$id,$cp_or_is){
    $flag = $this->is_cb_exist($id);
    if($cp_or_is=="is"){
      $data = array(
                'capexold' => $capexold,
                'ltold' => $ltold,
                'capexnew' => $capexnew,
                'ltnew' => $ltnew,
                'disrate' => $disrate,
                'ecoben' => $ecoben,
                'marcos' => $marcos,
                'newcons' => $newcons,
                'is_id' => $id
              );

        if($flag){
          $this->db->where('is_id', $id);
          $this->db->update('t_costbenefit_temp', $data); 
        }
        else{
          $this->db->insert('t_costbenefit_temp', $data); 
        }
    }else{
      $data = array(
                'capexold' => $capexold,
                'ltold' => $ltold,
                'capexnew' => $capexnew,
                'ltnew' => $ltnew,
                'disrate' => $disrate,
                'ecoben' => $ecoben,
                'marcos' => $marcos,
                'newcons' => $newcons,
                'cp_id' => $id
      );
      if($flag){
        $this->db->where('cp_id', $id);
        $this->db->update('t_costbenefit_temp', $data); 
      }
      else{
        $this->db->insert('t_costbenefit_temp', $data); 
      }
    }
  }

  public function is_cb_exist($id){
    $where = "(t_costbenefit_temp.is_id='".$id."' or t_costbenefit_temp.cp_id='".$id."') ";
    $this->db->select('*');
    $this->db->from('t_costbenefit_temp');
    $this->db->where($where);
    $query = $this->db->get()->row_array();
    if(!empty($query)){
      return true;
    }else{
      return false;
    }

  }

}
?>
