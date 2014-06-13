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

	public function cmpny_flow_prcss($data){
		$this->db->insert('T_CMPNY_FLOW_PRCSS',$data);
	}

	public function cmpny_prcss($data){
		$this->db->insert('T_CMPNY_PRCSS',$data);
		return $this->db->insert_id();
	}

	public function get_cmpny_flow_prcss($id){
		$this->db->select('T_FLOW.name as flowname, T_PRCSS.name as prcessname,T_FLOW_TYPE.name as flow_type_name, T_PRCSS.id as prcessid');
		$this->db->from('T_CMPNY_FLOW_PRCSS');
		$this->db->join('T_CMPNY_FLOW','T_CMPNY_FLOW.id = T_CMPNY_FLOW_PRCSS.cmpny_flow_id');
		$this->db->join('T_FLOW','T_FLOW.id = T_CMPNY_FLOW.flow_id');
		$this->db->join('T_CMPNY_PRCSS','T_CMPNY_PRCSS.id = T_CMPNY_FLOW_PRCSS.cmpny_prcss_id');
		$this->db->join('T_FLOW_TYPE','T_FLOW_TYPE.id = T_CMPNY_FLOW.flow_type_id');
		$this->db->join('T_PRCSS','T_PRCSS.id = T_CMPNY_PRCSS.prcss_id');
		$this->db->where('T_CMPNY_FLOW.cmpny_id',$id);
		$query = $this->db->get();
	    return $query->result_array();
	}

	public function can_write_cmpny_prcss($cmpny_id,$prcss_id){
		$this->db->select('id');
	    $this->db->from('T_CMPNY_PRCSS');
	    $this->db->where('cmpny_id',$cmpny_id);
	    $this->db->where('prcss_id',$prcss_id);
	    $query = $this->db->get()->row_array();
	    if(empty($query))
	    	return false;
	    else
	    	return $query;
	}

	public function can_write_cmpny_flow_prcss($cmpny_flow_id,$cmpny_prcss_id){
		$this->db->select('*');
    $this->db->from('T_CMPNY_FLOW_PRCSS');
    $this->db->where('cmpny_flow_id',$cmpny_flow_id);
    $this->db->where('cmpny_prcss_id',$cmpny_prcss_id);
    $query = $this->db->get()->row_array();
    if(empty($query)){
			return true;
		}
		return false;
	}
	public function cmpny_flow_prcss_id_list($id){
		$this->db->select('cmpny_prcss_id');
	    $this->db->from('T_CMPNY_FLOW_PRCSS');
	    $this->db->where('cmpny_flow_id',$id);
	    $query = $this->db->get();
	    return $query->result_array();
	}

	public function delete_cmpny_flow_process($cmpny_flow_id){
		$this->db->where('cmpny_flow_id', $cmpny_flow_id);
    	$this->db->delete('T_CMPNY_FLOW_PRCSS'); 
	}

	public function delete_cmpny_process($cmpny_prcss_id){
		$this->db->where('id', $cmpny_prcss_id);
    	$this->db->delete('T_CMPNY_PRCSS'); 
	}
	public function still_exist_this_cmpny_prcss($cmpny_prcss_id){
		$this->db->select('*');
	    $this->db->from('T_CMPNY_FLOW_PRCSS');
	    $this->db->where('cmpny_prcss_id',$cmpny_prcss_id);
	    $query = $this->db->get()->row_array();
	    if(empty($query))
	    	return false;
	    else
	    	return true;
	}

	public function delete_company_flow_prcss($cmpny_prcss_id){
		$this->db->where('cmpny_prcss_id', $cmpny_prcss_id);
		$this->db->delete('T_CMPNY_FLOW_PRCSS'); 
	}

	public function delete_cmpny_prcss_eqpmnt_type($cmpny_prcss_id){
		$this->db->where('cmpny_prcss_id',$cmpny_prcss_id);
		$this->db->delete('T_CMPNY_PRCSS_EQPMNT_TYPE');
	}

	public function delete_cmpny_prcss($company_id){
		$this->db->where('cmpny_id',$company_id);
		$this->db->delete('T_CMPNY_PRCSS');
	}

	public function get_cmpny_prcss_id($cmpny_id){
		$this->db->select('id');
		$this->db->from('T_CMPNY_PRCSS');
		$this->db->where('cmpny_id',$cmpny_id);
		$query = $this->db->get()->result_array();
		return $query;
	}

	public function delete_cmpny_eqpmnt($companyID){
		$this->db->where('cmpny_id',$companyID);
		$this->db->delete('T_CMPNY_EQPMNT');
	}
}
?>