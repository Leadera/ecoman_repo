<?php
class Cpscoping extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('project_model');		
		$this->load->model('process_model');
		$this->load->model('cpscoping_model');
		$this->load->library('form_validation');
	}

	public function index(){
		$this->load->view('template/header');
		$c_user = $this->user_model->get_session_user();
		$data['c_projects']=$this->user_model->get_consultant_projects_from_userid($c_user['id']);
		$this->load->view('cpscoping/index',$data);
		$this->load->view('template/footer');
	}

	//Getting project companies from ajax
	public function p_companies($pid){
		$com_array = $this->project_model->get_prj_companies($pid);
		header("Content-Type: application/json", true);
		/* Return JSON */
		echo json_encode($com_array);
	}

	public function cp_allocation($project_id,$company_id){
		$this->form_validation->set_rules('amount', 'Coordinates Latitude', 'trim|xss_clean');
		$this->form_validation->set_rules('allocation', 'Allocation', 'trim|xss_clean');
		if ($this->form_validation->run() !== FALSE){
			$prcss_name = $this->input->post('prcss_name');
			$flow_name = $this->input->post('flow_name');
			$flow_type_name = $this->input->post('flow_type_name');
			$amount = $this->input->post('amount');
			$allocation_amount = $this->input->post('allocation_amount');
			$importance_amount = $this->input->post('importance_amount');
			$cost = $this->input->post('cost');
			$allocation_cost = $this->input->post('allocation_cost');
			$importance_cost = $this->input->post('importance_cost');
			$env_impact = $this->input->post('env_impact');
			$allocation_env_impact = $this->input->post('allocation_env_impact');
			$importance_env_impact = $this->input->post('importance_env_impact');

			$array_allocation = array(
				'prcss_id'=>$prcss_name,
				'flow_id'=>$flow_name,
				'flow_type_id'=>$flow_type_name,
				'amount'=>$amount,
				'allocation_amount'=>$allocation_amount,
				'importance_amount'=>$importance_amount,
				'cost'=>$cost,
				'allocation_cost'=>$allocation_cost,
				'importance_cost'=>$importance_cost,
				'env_impact'=>$env_impact,
				'allocation_env_impact'=>$allocation_env_impact,
				'importance_env_impact'=>$importance_env_impact
			);
			$this->cpscoping_model->set_cp_allocation($array_allocation);

			redirect('cpscoping/'.$project_id.'/'.$company_id.'/allocation');
		}
		$data['project_id'] = $project_id;
		$data['company_id'] = $company_id;
		$data['prcss_info'] = $this->process_model->get_cmpny_flow_prcss($company_id);

		$this->load->view('template/header');
		$this->load->view('cpscoping/allocation',$data);
		$this->load->view('template/footer');
	}

	public function cp_allocation_array($company_id){
		$allocation_array = $this->process_model->get_cmpny_flow_prcss($company_id);
		header("Content-Type: application/json", true);
		echo json_encode($allocation_array);
	}

	public function deneme(){
		$this->load->view('template/header');
		$this->load->view('cpscoping/deneme');
		$this->load->view('template/footer');
	}

	public function deneme_json(){
		$c_user = $this->user_model->get_session_user();
		$allocation_array = $this->user_model->deneme_json($c_user['id']);
		$i = 0;
		foreach ($allocation_array as $p) {
			$array = $this->project_model->deneme_json_2($p['id']);
			$allocation_array[$i]['children'] = $array;
			$i++;
		}
		header("Content-Type: application/json", true);
		echo json_encode($allocation_array);
	}
}