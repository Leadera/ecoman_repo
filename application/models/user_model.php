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


    $this->db->select('T_USER.user_name as user_name,T_USER.name as name,T_USER.surname as surname');
    $this->db->from('T_USER');
    $this->db->join('T_ROLE', 'T_ROLE.id = T_USER.role_id');
    $this->db->where('T_ROLE.short_name', 'CONS'); 
    $query = $this->db->get();
    return $query->result_array();

  }
}
?>
