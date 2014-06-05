<?php
class Project extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('project_model');
		$this->load->model('company_model');
		$this->load->model('user_model');
	}

	public function new_project(){
		$temp = $this->session->userdata('user_in');
		if($temp['id'] == null){
			redirect('', 'refresh');
		}

		$data['companies']=$this->company_model->get_companies();
		$data['consultants']=$this->user_model->get_consultants();
		$data['project_status']=$this->project_model->get_active_project_status();

		$this->load->library('form_validation');

		$this->form_validation->set_rules('projectName', 'Project Name', 'trim|required|xss_clean|is_unique[T_PRJ.name]');
		$this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
		$this->form_validation->set_rules('assignCompany','Assign Company','required');
		$this->form_validation->set_rules('assignConsultant','Assign Consultant','required');

		//$this->form_validation->set_rules('surname', 'Password', 'required');
		//$this->form_validation->set_rules('email', 'Email' ,'trim|required|valid_email');
		if ($this->form_validation->run() !== FALSE)
		{
			$project = array(
			'name'=>$this->input->post('projectName'),
			'description'=>$this->input->post('description'),
			'start_date'=>date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('datepicker')))), // mysql icin formatını ayarladık
			'status_id'=>$this->input->post('status'),
			'active'=>1 //default active:1 olarak kaydediyoruz.
			);
			$last_inserted_project_id = $this->project_model->create_project($project);

			$companies = array ($_POST['assignCompany']); // multiple select , secilen company'ler

			foreach ($companies[0] as $company) {
				$prj_cmpny=array(
					'prj_id' => $last_inserted_project_id,
					'cmpny_id' => $company
					);
				$this->project_model->insert_project_company($prj_cmpny);
			}

			$consultants = $_POST['assignConsultant']; // multiple select , secilen consultant'lar

			foreach ($consultants as $consultant) {
				$prj_cnsltnt=array(
					'prj_id' => $last_inserted_project_id,
					'cnsltnt_id' => $consultant,
					'active' => 1
					);
				$this->project_model->insert_project_consultant($prj_cnsltnt);
			}

			$contactuser= $this->input->post('assignContactPerson');
			$prj_cntct_prsnl=array(
				'prj_id' => $last_inserted_project_id,
				'usr_id' => $contactuser
			);

			$this->project_model->insert_project_contact_person($prj_cntct_prsnl);

			redirect('projects', 'refresh');
		}

		$this->load->view('template/header');
		$this->load->view('project/create_project',$data);
		$this->load->view('template/footer');
	}

	public function contact_person(){
		$cmpny_id=$this->input->post('company_id'); // 1,2,3 şeklinde company id ler alındı
		$user = array();
		if($cmpny_id != 'null'){
			$cmpny_id_arr = explode(",", $cmpny_id); // explode ile parse edildi. array icinde company id'ler tutuluyor.

			foreach ($cmpny_id_arr as $cmpny_id) {
				$user[] = $this->user_model->get_company_users($cmpny_id);
			}
			//foreach dongusu icinde tek tek company id'ler gonderilip ilgili user'lar bulunacak.
			//suanda sadece ilk company id ' yi alıp user ları donuyor.
		}
		echo json_encode($user);
	}

	public function show_all_project(){
		$data['projects'] = $this->project_model->get_projects();

		$this->load->view('template/header');
		$this->load->view('project/show_all_project',$data);
		$this->load->view('template/footer');
	}

	public function view_project($prj_id){
		$data['projects'] = $this->project_model->get_project($prj_id);
		$data['status'] = $this->project_model->get_status($prj_id);
		$data['constant'] = $this->project_model->get_prj_consaltnt($prj_id);
		$data['companies'] = $this->project_model->get_prj_companies($prj_id);
		$data['contact'] = $this->project_model->get_prj_cntct_prsnl($prj_id);

		$this->load->view('template/header');
		$this->load->view('project/project_show_detailed',$data);
		$this->load->view('template/footer');
	}


	public function update_project($term){
		$data['projects'] = $this->project_model->get_project($term);
		$data['companies']=$this->company_model->get_companies();
		$data['consultants']=$this->user_model->get_consultants();
		$data['project_status']=$this->project_model->get_active_project_status();
		$data['assignedCompanies'] = $this->project_model->get_prj_companies($term);
		$data['assignedConsultant'] = $this->project_model->get_prj_consaltnt($term);
		$data['assignedContactperson'] = $this->project_model->get_prj_cntct_prsnl($term);

		//print_r($data['assignedCompanies'] );

		$companyIDs=array();
		foreach ($data['assignedCompanies'] as $key) { // bu kısımda sadece id lerden olusan array i alıyorum
			$companyIDs[] = $key['id'];
		}
		$data['companyIDs']=$companyIDs;

		$consultantIDs = array();
		foreach ($data['assignedConsultant'] as $key) { // bu kısımda sadece id lerden olusan array i alıyorum
			$consultantIDs[] = $key['id'];
		}
		$data['consultantIDs']=$consultantIDs;

		$contactIDs = array();
		foreach ($data['assignedContactperson'] as $key) { // bu kısımda sadece id lerden olusan array i alıyorum
			$contactIDs[] = $key['id'];
		}
		$data['contactIDs']=$contactIDs;

		foreach ($companyIDs as $cmpny_id) {
			$contactusers[]= $this->user_model->get_company_users($cmpny_id);
		}

		$newArray= array_shift($contactusers); // ilk elemanı kaydırmak için gerekliydi. daha akılcı çözüm bulunabilir.

		$data['contactusers']= $contactusers;

		$this->load->library('form_validation');


		$this->form_validation->set_rules('projectName', 'Project Name', 'trim|required|xss_clean'); // buraya isunique kontrolü ge
		$this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
		$this->form_validation->set_rules('assignCompany','Assign Company','required');
		$this->form_validation->set_rules('assignConsultant','Assign Consultant','required');

		//$this->form_validation->set_rules('surname', 'Password', 'required');
		//$this->form_validation->set_rules('email', 'Email' ,'trim|required|valid_email');
		if ($this->form_validation->run() !== FALSE)
		{

			date_default_timezone_set('UTC');

			$project = array(
			'name'=>$this->input->post('projectName'),
			'description'=>$this->input->post('description'),
			'start_date'=>date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('datepicker')))), // mysql icin formatını ayarladık
			'status_id'=>$this->input->post('status'),
			'active'=>1 //default active:1 olarak kaydediyoruz.
			);
			$this->project_model->update_project($project,$term);

			$companies = $_POST['assignCompany']; // multiple select , secilen company'ler

			$this->project_model->remove_company_from_project($term);	// once hepsini siliyoruz projeye bağlı companylerin

			foreach ($companies as $company) {
				$prj_cmpny=array(
					'prj_id' => $term,
					'cmpny_id' => $company
					);
				$this->project_model->insert_project_company($prj_cmpny);
			}

			$consultants = $_POST['assignConsultant']; // multiple select , secilen consultant'lar

			$this->project_model->remove_consultant_from_project($term);

			foreach ($consultants as $consultant) {
				$prj_cnsltnt=array(
					'prj_id' => $term,
					'cnsltnt_id' => $consultant,
					'active' => 1
					);
				$this->project_model->insert_project_consultant($prj_cnsltnt);
			}

			$this->project_model->remove_contactuser_from_project($term);

			$contactuser= $this->input->post('assignContactPerson');
			$prj_cntct_prsnl=array(
				'prj_id' => $term,
				'usr_id' => $contactuser
			);

			$this->project_model->insert_project_contact_person($prj_cntct_prsnl);
			redirect('projects', 'refresh');
		}
		$this->load->view('template/header');
		$this->load->view('project/update_project',$data);
		$this->load->view('template/footer');
	}
}
?>
