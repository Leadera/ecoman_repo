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
}
?>
