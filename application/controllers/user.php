<?php
class User extends CI_Controller {
	
	public function user_register(){
		$this->load->library('form_validation');
		

		$this->form_validation->set_rules('name','Name','trim|required|xss_clean|alpha');
		$this->form_validation->set_rules('surname','Surname','trim|required|xss_clean|alpha');
		$this->form_validation->set_rules('jobTitle','Job Title','required|trim|xss_clean');
		$this->form_validation->set_rules('jobDescription','Job Description','required|trim|xss_clean');
		$this->form_validation->set_rules('email', 'e-mail' ,'trim|required|valid_email|is_unique[T_USER.email]');
		$this->form_validation->set_rules('cellPhone', 'Cell Phone Number', 'required|numeric|min_length[11]|xss_clean|');
		$this->form_validation->set_rules('workPhone', 'Work Phone Number', 'required|numeric|min_length[11]|xss_clean|');
		$this->form_validation->set_rules('fax', 'Fax Number', 'required|numeric|min_length[11]|xss_clean|');


		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required');

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
