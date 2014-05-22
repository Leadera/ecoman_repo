<?php
	
	class Project extends CI_Controller{
		
		function __construct(){
			parent::__construct();
			$this->load->model('project_model');
			$this->load->model('company_model');
			$this->load->model('user_model');

		}
		public function new_project(){
			

			$data['companies']=$this->company_model->get_companies();
			$data['consultants']=$this->user_model->get_consultants();


			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('projectName', 'Project Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
			$this->form_validation->set_rules('assignCompany','Assign Company','required');
			$this->form_validation->set_rules('assignConsultant','Assign Consultant','required');

			//$this->form_validation->set_rules('surname', 'Password', 'required');
			//$this->form_validation->set_rules('email', 'Email' ,'trim|required|valid_email');
			
			if ($this->form_validation->run() !== FALSE)
			{
				redirect('okoldu', 'refresh');
			}


			$this->load->view('template/header');
			$this->load->view('project/create_project',$data);
			$this->load->view('template/footer');
		}
	}

?>