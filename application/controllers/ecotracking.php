<?php
class Ecotracking extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('ecotracking_model');
				$this->config->set_item('language', $this->session->userdata('site_lang'));

	}

	public function save($company_id,$machine_id,$powera,$powerb,$powerc){
		$this->ecotracking_model->save($company_id,$machine_id,$powera,$powerb,$powerc);
		redirect('ecotracking/'.$company_id.'/'.$machine_id);
	}

	public function show($company_id,$machine_id){
		$data['veriler'] = $this->ecotracking_model->get($company_id,$machine_id);
		$this->load->view('template/header');
		$this->load->view('ecotracking/show',$data);
		$this->load->view('template/footer');
	}

	public function index(){

		$this->load->view('template/header');
		$this->load->view('ecotracking/index');
		$this->load->view('template/footer');
	}

	public function json($company_id,$machine_id){
		header("Content-Type: application/json", true);
		/* Return JSON */
		$data['veriler'] = $this->ecotracking_model->get($company_id,$machine_id);
		//print_r($data);

		$numItems = count($data['veriler']);
		$i = 0;
		$defer="[";
		foreach ($data['veriler'] as $d) {
			$date1000=strtotime($d['date'])*1000;
			if(++$i === $numItems) {
				$defer.="[".$date1000.",".$d['powera']."]";
			}else{
			$defer.="[".$date1000.",".$d['powera']."],";
			}
		}
		$defer.="]";

		echo $defer;
	}

	
}
?>
