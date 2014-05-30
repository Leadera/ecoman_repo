<?php
class Company_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }

  public function insert_company($data){
    $this->db->insert('T_CMPNY',$data); 
    return $this->db->insert_id();
  }

  public function insert_cmpny_data($data){
    $this->db->insert('T_CMPNY_DATA',$data);
  }

  public function search_nace_code($code){
    $nace_id = $this->db->select('id')->where('code', $code)->limit(1)-> get('T_NACE_CODE')->result_array()[0]['id'];
    return $nace_id;
  }

  public function insert_cmpny_nace_code($data){
    $this->db->insert('T_CMPNY_NACE_CODE',$data);
  }
  
  public function get_companies(){
    $this->db->select('*');
    $this->db->from('T_CMPNY');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_company($id){
    $this->db->select('*');
    $query = $this->db->get_where('T_CMPNY', array('id' => $id));
    return $query->row_array();
  }

  public function get_nace_code($id){
      $this->db->select('T_NACE_CODE.code,T_NACE_CODE.name');
      $this->db->from('T_NACE_CODE');
      $this->db->join('T_CMPNY_NACE_CODE', 'T_CMPNY_NACE_CODE.nace_code_id = T_NACE_CODE.id');
      $this->db->join('T_CMPNY', 'T_CMPNY.id = T_CMPNY_NACE_CODE.cmpny_id');
      $this->db->where('T_CMPNY.id', $id); 
      $query = $this->db->get();
      return $query->result_array();
  }

  public function get_company_proj($id){
      $this->db->select('T_PRJ.name,T_PRJ.id as proje_id');
      $this->db->from('T_PRJ');
      $this->db->join('T_PRJ_CMPNY', 'T_PRJ_CMPNY.prj_id = T_PRJ.id');
      $this->db->join('T_CMPNY', 'T_CMPNY.id = T_PRJ_CMPNY.cmpny_id');
      $this->db->where('T_CMPNY.id', $id); 
      $query = $this->db->get();
      return $query->result_array();
  }

  public function get_company_workers($id){
      $this->db->select('T_USER.name,T_USER.surname,T_USER.id,T_USER.user_name');
      $this->db->from('T_USER');
      $this->db->join('T_CMPNY_PRSNL', 'T_CMPNY_PRSNL.user_id = T_USER.id');
      $this->db->join('T_CMPNY', 'T_CMPNY.id = T_CMPNY_PRSNL.cmpny_id');
      $this->db->where('T_CMPNY.id', $id); 
      $query = $this->db->get();
      return $query->result_array();
  }


  public function company_search($q){
    $this->db->select('T_CMPNY.name,T_CMPNY.id');
    $this->db->from('T_CMPNY');
    $this->db->like('name', $q); 
    $query = $this->db->get();
     if($query->num_rows > 0){
      foreach ($query->result_array() as $row){
        $new_row['label']=htmlentities(stripslashes($row['name']));
        $new_row['value']=htmlentities(stripslashes($row['id']));
        $row_set[] = $new_row; //build an array
      }
      return json_encode($row_set); //format the array into json data
    }
  }
}
?>
