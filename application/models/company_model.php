<?php
class Company_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }

  public function create_company($data,$code){
  	// newcompany ekraninda doldurulan alanlar T_CMPNY tablosuna insert ediliyor.
    $this->db->insert('T_CMPNY',$data); 

    /*  
    	id auto_increment oldugu icin eklenen company için id degeri aliniyor
    	bu id degeri ile ekrandan alinan description alani T_CMPNY_DATA tablosuna
    	insert ediliyor.
    */
    $id=$this -> db -> select('id')-> where('name', $data['name'])-> limit(1)-> get('T_CMPNY')-> result_array()[0]['id'];
    $data2 = array(
    	'cmpny_id' => $id,
    	'description' => $data['description']
    );
    $this->db->insert('T_CMPNY_DATA',$data2);

    /*
		newcompany ekraninda girilen nace_code T_NACE_CODE tablosunda aranıyor o tablo önceden doldurulmuş olacak
		bulunan verinin id degeri alınıyor ve company_id si ile birlikte T_CMPNY_NACE_CODE tablosuna insert ediliyor.
    */
    $nace_id=$this -> db -> select('id')-> where('code', $code)-> limit(1)-> get('T_NACE_CODE')-> result_array()[0]['id'];
    $data3 = array(
    	'cmpny_id' => $id,
    	'nace_code_id' => $nace_id
    );
    $this->db->insert('T_CMPNY_NACE_CODE',$data3);
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
    return $query->result_array();
  }

  public function get_nace_code($id){
      $this->db->select('code');
      $this->db->from('T_NACE_CODE');
      $this->db->join('T_CMPNY_NACE_CODE', 'T_CMPNY_NACE_CODE.nace_code_id = T_NACE_CODE.id');
      $this->db->join('T_CMPNY', 'T_CMPNY.id = T_CMPNY_NACE_CODE.cmpny_id');
      $this->db->where('T_CMPNY.id', $id); 
      $query = $this->db->get();
      return $query->result_array();
  }

  public function get_company_proj($id){
      $this->db->select('T_PRJ.name');
      $this->db->from('T_PRJ');
      $this->db->join('T_PRJ_CMPNY', 'T_PRJ_CMPNY.prj_id = T_PRJ.id');
      $this->db->join('T_CMPNY', 'T_CMPNY.id = T_PRJ_CMPNY.cmpny_id');
      $this->db->where('T_CMPNY.id', $id); 
      $query = $this->db->get();
      return $query->result_array();
  }

  public function get_company_workers($id){
      $this->db->select('T_USER.name,T_USER.surname');
      $this->db->from('T_USER');
      $this->db->join('T_CMPNY_PRSNL', 'T_CMPNY_PRSNL.user_id = T_USER.id');
      $this->db->join('T_CMPNY', 'T_CMPNY.id = T_CMPNY_PRSNL.cmpny_id');
      $this->db->where('T_CMPNY.id', $id); 
      $query = $this->db->get();
      return $query->result_array();
  }
}
?>
