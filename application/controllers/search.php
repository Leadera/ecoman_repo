<?php
class Search extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('search_model','',TRUE);
	}

	public function search_pro($term = FALSE){
		if($term=="")
		{
			$term = $this->input->post('term');
			redirect(base_url('search/'.$term), 'refresh');
		}

		$data['companies'] = $this->search_model->search_company($term);
		$data['projects'] = $this->search_model->search_project($term);

		$this->load->view('template/header');
		$this->load->view('search/index',$data);
		$this->load->view('template/footer');
	}
}
?>