<?php
class User_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }

  public function create_user($data){
    $this->db->insert('T_USER', $data);
    return $this->db->insert_id();
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
    if($query->num_rows() > 0)
    {
      return $query->result_array();
    }
    else
    {
      return false;
    }
  }

  // Session dan acik olan kisinin username bilgisi aliniyor ve bu username e sahip
  // kisinin butun bilgileri controller a return ediliyor.
  public function get_session_user(){
    if ($this->session->userdata('user_in') !== FALSE){
      $tmp = $this->session->userdata('user_in');

      $this->db->from('T_USER');
      $this->db->where('id',$tmp['id']);
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

  public function get_worker_projects_from_userid($id){
      $this->db->select('T_PRJ.name,T_PRJ.id as proje_id');
      $this->db->from('T_PRJ');
      $this->db->join('T_PRJ_CNTCT_PRSNL', 'T_PRJ_CNTCT_PRSNL.prj_id = T_PRJ.id');
      $this->db->join('T_USER', 'T_USER.id = T_PRJ_CNTCT_PRSNL.usr_id');
      $this->db->where('T_USER.id', $id);
      $query = $this->db->get();
      return $query->result_array();
  }

  public function get_consultant_projects_from_userid($id){
      $this->db->select('T_PRJ.name,T_PRJ.id as proje_id');
      $this->db->from('T_PRJ');
      $this->db->join('T_PRJ_CNSLTNT', 'T_PRJ_CNSLTNT.prj_id = T_PRJ.id');
      $this->db->join('T_USER', 'T_USER.id = T_PRJ_CNSLTNT.cnsltnt_id');
      $this->db->where('T_USER.id', $id);
      $query = $this->db->get();
      return $query->result_array();
  }

  public function update_user($update){
    if ($this->session->userdata('user_in') !== FALSE){
      $tmp = $this->session->userdata('user_in');
      $this->db->where('id', $tmp['id']);
      $this->db->update('T_USER', $update);
    }
  }

  public function make_user_consultant($id,$username=FALSE){
    if(empty($username)){
      $username = "Username";
    }

    // T_cnsltnt'a ekleme
    $data = array(
      'user_id' => $id,
      'description' => $username,
      'active' => '1'
    );
    $this->db->insert('T_CNSLTNT', $data);

    //T_USER'ı güncelleme
    $data = array(
      'role_id' => '1'
    );
    $this->db->where('id', $id);
    $this->db->update('T_USER', $data);
  }

  public function is_user_consultant($id){
    //kullanıcı consultant ise true değilse false döndürür
    $this->db->select('*');
    $this->db->from('T_USER');
    $this->db->where('id', $id);
    $query = $this->db->get()->row_array();
    if($query['role_id']=="1"){
      return TRUE;
    }
    else{
      return FALSE;
    }
  }

  public function check_user_email($email){
    $this->db->from('T_USER');
    $this->db->where('email',$email);
    $query = $this->db->get();

    if($query -> num_rows() == 1)
      return true;
    else
      return false;
  }

  public function check_username($username){
    $this->db->from('T_USER');
    $this->db->where('user_name',$username);
    $query = $this->db->get();

    if($query -> num_rows() == 1)
      return true;
    else
      return false;
  }

  public function set_user_image($userId,$photo){
    $this->db->where('id', $userId);
    $this->db->update('T_USER', $photo);
  }

  public function users_without_company(){
    $this->db->select('*')->from('T_USER');
    $this->db->where('`id` NOT IN (SELECT `user_id` FROM `T_CMPNY_PRSNL`)', NULL, FALSE);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function do_consultant($id){
    $this->db->select('T_ROLE.short_code');
    $this->db->from('T_ROLE');
    $this->db->join('T_USER','T_USER.role_id = T_ROLE.id');
    $this->db->where('T_USER.id',$id);
    $query = $this->db->get();
    return $query->row_array();
  }

  //Bir danışmanın danışman olduğu şirketleri listeler
  public function do_edit_company_consultant($user_id){
    $this->db->select('T_PRJ_CMPNY.cmpny_id as cmpnyID');
    $this->db->from('T_PRJ_CNSLTNT');
    $this->db->join('T_PRJ_CMPNY', 'T_PRJ_CMPNY.prj_id = T_PRJ_CNSLTNT.prj_id');
    $this->db->where('T_PRJ_CNSLTNT.cnsltnt_id',$user_id);
    $query = $this->db->get()->result_array();
    return $query;
  }

  //Bir kullanıcı bir şirketin danışmanı mıdır?
  public function is_consultant_of_company_by_user_id($user_id,$company_id){
    $this->db->select('T_PRJ_CMPNY.cmpny_id as cmpnyID');
    $this->db->from('T_PRJ_CNSLTNT');
    $this->db->join('T_PRJ_CMPNY', 'T_PRJ_CMPNY.prj_id = T_PRJ_CNSLTNT.prj_id');
    $this->db->where('T_PRJ_CNSLTNT.cnsltnt_id',$user_id);
    $this->db->where('T_PRJ_CMPNY.cmpny_id',$company_id);
    $query = $this->db->get()->result_array();
    if(empty($query)){
      return FALSE;
    }else{
      return TRUE;
    }
  }
  public function is_consultant_of_project_by_user_id($user_id,$prj_id){
    $this->db->select('*');
    $this->db->from('T_PRJ_CNSLTNT');
    $this->db->where('T_PRJ_CNSLTNT.cnsltnt_id',$user_id);
    $this->db->where('T_PRJ_CNSLTNT.prj_id',$prj_id);
    $query = $this->db->get()->result_array();
    if(empty($query)){
      return FALSE;
    }else{
      return TRUE;
    }
  }


  public function cmpny_prsnl($user_id){
    $this->db->select('cmpny_id');
    $this->db->from('T_CMPNY_PRSNL');
    $this->db->where('user_id',$user_id);
    $query = $this->db->get();
    return $query->row_array();
  }

  //Firmanın contact person'ı mı?
  public function is_contact_by_userid($user_id,$company_id){
    $this->db->select('*');
    $this->db->from('T_CMPNY_PRSNL');
    $this->db->where('user_id',$user_id);
    $this->db->where('cmpny_id', $company_id);
    $this->db->where('is_contact', '1');
    $query = $this->db->get()->row_array();
    if(empty($query))
      return FALSE;
    else
      return TRUE;
  }

  //verilen user'ın verilen şirketi edit edip edemeyeceğine dair bilgiyi verir
  public function can_edit_company($user_id,$company_id){
    $consultant = $this->is_consultant_of_company_by_user_id($user_id,$company_id);
    $contact = $this->is_contact_by_userid($user_id,$company_id);
    return $consultant || $contact;
  }

}
?>
