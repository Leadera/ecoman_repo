<?php
class Reporting extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('company_model');
		$this->load->library('form_validation');
		$this->config->set_item('language', $this->session->userdata('site_lang'));
	}

	public function show_single($report_id){
		//reportidyi kullanarak otomatik link oluşturur. report/20 gibi.
		//burada php kodu kullanabilirsiniz. data arrayinin içini doldurabilirsiniz. Diğer controllerlarda örnekler mevcuttur.
		$this->load->view('template/header');
		$this->load->view('reporting/single',$data);
		$this->load->view('template/footer');
	}

	public function show_all(){
		//burada php kodu kullanabilirsiniz. data arrayinin içini doldurabilirsiniz.
		$this->load->view('template/header');
		$this->load->view('reporting/all',$data);
		$this->load->view('template/footer');
	}
}
?>
