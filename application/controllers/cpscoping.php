<?php
class Cpscoping extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('project_model');
		$this->load->model('process_model');
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
		$this->load->view('template/header');

		print_r($this->process_model->get_cmpny_flow_prcss($company_id));
		
		$this->load->view('cpscoping/allocation');
		$this->load->view('template/footer');
	}


}