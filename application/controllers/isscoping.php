<?php
class Isscoping extends CI_Controller {

	function __construct(){
		parent::__construct();
                //test
                // test2
                //test3
	}

	public function index(){
		$this->load->view('template/header');
		$this->load->view('isscoping/index');
		$this->load->view('template/footer');
	}

	public function auto(){
		$this->load->view('template/header');
		$this->load->view('isscoping/auto');
		$this->load->view('template/footer');
	}
        
        public function tooltip(){
		//$this->load->view('template/header');
		$this->load->view('isscoping/tooltip');
		//$this->load->view('template/footer');
	}
        
         public function tooltipscenarios(){
		//$this->load->view('template/header');
		$this->load->view('isscoping/tooltipscenarios');
		//$this->load->view('template/footer');
	}
}