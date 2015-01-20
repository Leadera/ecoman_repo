<?php
class Cost_benefit extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('cost_benefit_model');
		$this->load->model('cpscoping_model');
	}

	public function new_cost_benefit($prjct_id,$cmpny_id){
		// $data = array();
		// $allocation_ids = $this->cost_benefit_model->get_is_candidates();
		// print_r($allocation_ids);
		// foreach ($allocation_ids as $allo_id) {
		// 	if($this->cost_benefit_model->get_allocation_ids($allo_id['allocation_id'],$prjct_id,$cmpny_id) == true){
		// 		$data['cost_benefit'][] = $this->cpscoping_model->get_allocation_from_allocation_id($allo_id['allocation_id']);
		// 	}
		// }

		$data['allocation']=$this->cpscoping_model->get_cost_benefit_info($cmpny_id,$prjct_id);
		$this->load->view('template/header');
		$this->load->view('cost_benefit/index',$data);
		$this->load->view('template/footer');
	}
}
?>