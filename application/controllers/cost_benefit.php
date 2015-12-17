<?php
class Cost_benefit extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('cost_benefit_model');
		$this->load->model('cpscoping_model');
		$this->load->model('user_model');
		$this->load->model('company_model');
		$this->load->model('project_model');
		$c_user = $this->user_model->get_session_user();
		if($this->cpscoping_model->can_consultant_prjct($c_user['id']) == false){
			redirect('','refresh');
		}
				$this->config->set_item('language', $this->session->userdata('site_lang'));

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
		$data['company']=$this->company_model->get_company($cmpny_id);
		$data['allocation']=$this->cpscoping_model->get_cost_benefit_info($cmpny_id,$prjct_id);
		$data['is']=$this->cpscoping_model->get_cost_benefit_info_is($cmpny_id,$prjct_id);
		//print_r($data['allocation']);
		$this->load->view('template/header');
		$this->load->view('cost_benefit/index',$data);
		$this->load->view('template/footer');
	}

	public function index(){
		$data['com_pro'] = $this->project_model->get_prj_companies($this->session->userdata('project_id'));

		$this->load->view('template/header');
		$this->load->view('cost_benefit/list',$data);
		$this->load->view('template/footer');
	}

	//cost-benefit analysis form saving
	public function save($prjct_id,$cmpny_id,$id,$cp_or_is){
		$this->form_validation->set_rules('capexold', 'CAPEX old option', 'required|numeric|trim|xss_clean');		
		$this->form_validation->set_rules('ltold', 'Lifetime old option', 'required|numeric|trim|xss_clean');
		$this->form_validation->set_rules('capexnew', 'CAPEX new option', 'required|numeric|trim|xss_clean');
		$this->form_validation->set_rules('ltnew', 'Lifetime new option', 'required|numeric|trim|xss_clean');
		$this->form_validation->set_rules('disrate', 'Discount rate', 'required|numeric|trim|xss_clean');		
		$this->form_validation->set_rules('ecoben', 'Ecological Benefit', 'required|numeric|trim|xss_clean');		
		$this->form_validation->set_rules('marcos', 'Marginal Cost', 'required|numeric|trim|xss_clean');
		$this->form_validation->set_rules('newcons', 'Estimated new consumption', 'required|numeric|trim|xss_clean');		

		if ($this->form_validation->run() !== FALSE){
			$capexold = $this->input->post('capexold');
			$ltold = $this->input->post('ltold');
			$capexnew = $this->input->post('capexnew');
			$ltnew = $this->input->post('ltnew');
			$disrate = $this->input->post('disrate');
			$newcons = $this->input->post('newcons');
			$ecoben = $this->input->post('ecoben');
			$marcos = $this->input->post('marcos');


			$opexold = $this->input->post('opexold');
			$opexnew = $this->input->post('opexnew');
			$anncostold = $this->input->post('acold');
			$anncostnew = $this->input->post('acnew');
			$ecocosben = $this->input->post('eco');
			$unit1 = "Euro/Year";
			$oldtotalcons = $this->input->post('oldcons');
			$oldtotalcost = $this->input->post('oldcost');
			$oldtotalep = $this->input->post('oldep');
			$unit2 = $this->input->post('unit2');
			$ecobenunit = "EIP/Year";
			$marcosunit = "$/EIP";

			$this->cost_benefit_model->set_cba($capexold,$ltold,$capexnew,$ltnew,$disrate,$newcons,$marcos,$ecoben,$id,$cp_or_is,$opexold,$opexnew,$anncostold,$anncostnew,$ecocosben,$unit1,$oldtotalcons,$oldtotalcost,$oldtotalep,$unit2,$ecobenunit,$marcosunit);
		}
		redirect('cost_benefit/'.$prjct_id.'/'.$cmpny_id);
	}

}
?>
