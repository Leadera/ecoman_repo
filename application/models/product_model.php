<?php 
class Product_model extends CI_Model {
//asdasda
	public function __construct()
	{
		$this->load->database();
	}

	public function register_pro($productname,$producttype,$quan,$productunit,$productdesc){
		$data = Array(
				'name'=>$productname, 
				'type'=>$producttype, 
				'quantity'=>$quan, 
				'unit'=>$productunit, 
				'description'=>$productdesc
			);
		$this->db->insert('products', $data);
	}

	public function register_flow($flowname,$ei,$cost,$amount){
		$data = Array(
				'name'=>$flowname, 
				'ei'=>$ei, 
				'cost'=>$cost, 
				'amount'=>$amount, 
			);
		$this->db->insert('flows', $data);
	}

	public function register_component($componentname){
		$data = Array(
				'name'=>$componentname, 
			);
		$this->db->insert('components', $data);
	}

	public function product_list(){
		$this->db->select("*");
		$this->db->from("products");
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function component_list(){
		$this->db->select("*");
		$this->db->from("components");
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function flow_list(){
		$this->db->select("*");
		$this->db->from("flows");
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}

}