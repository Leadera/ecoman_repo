<?php
class Password_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }

  public function do_similar_pass($user_id,$pass){
  	$this->db->select('psswrd');
  	$this->db->from('T_USER');
  	$this->db->where('id',$user_id);
  	$query = $this->db->get()->row_array();
    if($query['psswrd'] == $pass)
    	return true;
    else
    	return false;
  }

  public function change_pass($user_id,$data){
    $this->db->where('id', $user_id);
    $this->db->update('T_USER', $data);
  }

  public function get_email($user_id){
  	$this->db->select('email');
  	$this->db->from('T_USER');
  	$this->db->where('id',$user_id);
  	$query = $this->db->get()->row_array();
    return $query; 
	}
}
?>
