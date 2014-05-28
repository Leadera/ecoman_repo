<?php
class User_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }

  public function create_user($data){
    $this->db->insert('T_USER', $data);
  }

  public function get_userinfo_by_username($username){
    $this->db->from('T_USER');
    $this->db->where('user_name',$username);
    return $this->db->get()->row_array();
  }

  public function check_user($username,$password){
  	$this->db->from('T_USER');
  	$this->db->where('user_name',$username);
  	$this->db->where('psswrd',$password);
  	$query = $this->db->get();

  	if($query -> num_rows() == 1)
  	{
  		return $query->row_array();
  	}
  	else
  	{
  		return false;
  	}
  }

  public function get_consultants(){


    $this->db->select('T_USER.id as id,T_USER.user_name as user_name,T_USER.name as name,T_USER.surname as surname');
    $this->db->from('T_USER');
    $this->db->join('T_ROLE', 'T_ROLE.id = T_USER.role_id');
    $this->db->where('T_ROLE.short_code', 'CNS'); 
    $query = $this->db->get();
    return $query->result_array();

  }

  public function get_company_users($cmpny_id){
    $this->db->select('T_USER.name as name,T_USER.surname as surname,T_USER.id as id,T_CMPNY.name as cmpny_name');
    $this->db->from('T_CMPNY_PRSNL');
    $this->db->join('T_CMPNY', 'T_CMPNY.id = T_CMPNY_PRSNL.cmpny_id');
    $this->db->join('T_USER', 'T_USER.id = T_CMPNY_PRSNL.user_id');
    $this->db->where('T_CMPNY_PRSNL.cmpny_id', $cmpny_id); 
    $query = $this->db->get();
    return $query->result_array();
  }

  // Session dan acik olan kisinin username bilgisi aliniyor ve bu username e sahip
  // kisinin butun bilgileri controller a return ediliyor.
  public function update_profile(){
    if ($this->session->userdata('user_in') !== FALSE){
      $tmp = $this->session->userdata('user_in');

      $this->db->from('T_USER');
      $this->db->where('user_name',$tmp['username']);
      $query = $this->db->get();

      if($query -> num_rows() == 1)
      {
        return $query->row_array();
      }
      else
      {
        return false;
      }
    }
  }

  public function get_user($id){
    $this->db->select('*');
    $this->db->from('T_USER');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_projects_from_userid($id){
      $this->db->select('T_PRJ.name,T_PRJ.id as proje_id');
      $this->db->from('T_PRJ');
      $this->db->join('T_PRJ_CNTCT_PRSNL', 'T_PRJ_CNTCT_PRSNL.prj_id = T_PRJ.id');
      $this->db->join('T_USER', 'T_USER.id = T_PRJ_CNTCT_PRSNL.usr_id');
      $this->db->where('T_USER.id', $id); 
      $query = $this->db->get();
      return $query->result_array();
  }
}
?>
