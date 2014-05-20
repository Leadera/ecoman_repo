<?php
	
	class Project extends CI_Controller{
		
		public function new_project(){
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('projectName', 'Project Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');


			//$this->form_validation->set_rules('surname', 'Password', 'required');
			//$this->form_validation->set_rules('email', 'Email' ,'trim|required|valid_email');
			
			if ($this->form_validation->run() !== FALSE)
			{
				redirect('okoldu', 'refresh');
			}


			$this->load->view('template/header');
			$this->load->view('project/create_project');
			$this->load->view('template/footer');
		}
	}

?>