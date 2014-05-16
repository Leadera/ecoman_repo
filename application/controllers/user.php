<?php
class User extends CI_Controller {
	
	public function user_register(){
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', 'Username', 'trim|required|min_length[5]|max_length[12]|xss_clean');
		$this->form_validation->set_rules('surname', 'Password', 'required');
		$this->form_validation->set_rules('email', 'Email' ,'trim|required|valid_email');
		if ($this->form_validation->run() !== FALSE)
		{

			redirect('okoldu', 'refresh');
		}

		$this->load->view('template/header');
		$this->load->view('user/create_user');
		$this->load->view('template/footer');
	}

}
?>