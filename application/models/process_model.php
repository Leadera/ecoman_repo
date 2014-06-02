<?php 
class Process_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_process(){
		$this->db->select('*');
    $this->db->from('T_PRCSS');
    $query = $this->db->get();
    return $query->result_array();
	}

}

?>