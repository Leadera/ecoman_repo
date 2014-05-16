<?php
class Homepage extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->load->view('template/header');
		$this->load->view('homepage/index');
		$this->load->view('template/footer');
	}
}