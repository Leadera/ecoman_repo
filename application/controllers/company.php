<?php
class Company extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('company_model');
		$this->load->model('user_model');
		$this->load->model('cluster_model');	
		$this->load->model('flow_model');	
		$this->load->model('process_model');	
		$this->load->model('component_model');	
		$this->load->model('equipment_model');
		$this->load->model('product_model');
		$this->load->library('form_validation');
	}

	public function new_company(){
		$temp = $this->session->userdata('user_in');
		if($temp['id'] == null){
			redirect('', 'refresh');
		}
		if($this->create_company_control() == FALSE){
			redirect('', 'refresh');
		}

		$this->load->library('googlemaps');
		//alert("1:" + event.latLng.lat() + " 2:" + event.latLng.lng());
		$config['center'] = '39.98280915242299, 32.73923635482788';
		$config['zoom'] = '15';
		$config['map_type'] = "HYBRID";
		$config['onclick'] = '$("#latId").val("Lat:" + event.latLng.lat()); $("#longId").val("Long:" + event.latLng.lng()); $("#lat").val(event.latLng.lat()); $("#long").val(event.latLng.lng());';
		$config['places'] = TRUE;
		$config['placesRadius'] = 20;
		$this->googlemaps->initialize($config);

		$data['map'] = $this->googlemaps->create_map();

		$this->form_validation->set_rules('lat', 'Coordinates Latitude', 'trim|required|xss_clean');
		$this->form_validation->set_rules('long', 'Coordinates Longitude', 'trim|required|xss_clean');
		$this->form_validation->set_rules('companyName', 'Company Name', 'trim|required|xss_clean|is_unique[T_CMPNY.name]');
		$this->form_validation->set_rules('naceCode', 'Nace Code', 'trim|required|xss_clean|callback_is_in_nace|regex_match[/^\d{2}\.\d{2}\.\d{2}$/]');
		$this->form_validation->set_rules('companyDescription', 'Company Description', 'trim|xss_clean');
		$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|is_unique[T_CMPNY.email]');
		$this->form_validation->set_rules('cellPhone', 'Cell Phone Number', 'required|callback_alpha_dash_space|min_length[5]|xss_clean');
		$this->form_validation->set_rules('workPhone', 'Work Phone Number', 'required|callback_alpha_dash_space|min_length[5]|xss_clean');
		$this->form_validation->set_rules('fax', 'Fax Number', 'required|callback_alpha_dash_space|min_length[5]|xss_clean');
		$this->form_validation->set_rules('address', 'Address', 'trim|xss_clean');

		if ($this->form_validation->run() !== FALSE)
		{
			$data = array(
				'name'=>$this->input->post('companyName'),
				'phone_num_1'=>$this->input->post('cellPhone'),
				'phone_num_2'=>$this->input->post('workPhone'),
				'fax_num'=>$this->input->post('fax'),
				'address'=>$this->input->post('address'),
				'description'=>$this->input->post('companyDescription'),
				'email'=>$this->input->post('email'),
				'latitude'=>$this->input->post('lat'),
				'longitude'=>$this->input->post('long'),
				'active'=>'1'
			);
			$code = $this->input->post('naceCode');
			$last_id = $this->company_model->insert_company($data);

			$cmpny_data = array(
				'cmpny_id' => $last_id,
				'description' => $data['description']
			);

		    $this->company_model->insert_cmpny_data($cmpny_data);
		    $nace_code_id = $this->company_model->search_nace_code($code);

		    $cmpny_nace_code = array(
		    	'cmpny_id' => $last_id,
		    	'nace_code_id' => $nace_code_id
		    );

		    $this->company_model->insert_cmpny_prsnl($last_id);
		    $this->company_model->insert_cmpny_nace_code($cmpny_nace_code);

		    $config['upload_path'] = './assets/company_pictures/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '5000';
			$config['file_name'] = $last_id.'.jpg';
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload())
			{
				redirect('company', 'refresh');
				exit;
			}

			$config['image_library'] = 'gd2';
			$config['source_image']	= './assets/company_pictures/'.$last_id.'.jpg';
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 200;
			$config['height'] = 200;
			$this->load->library('image_lib', $config);

			$this->image_lib->resize();

			$logo = array(
				'logo'=>$last_id.'.jpg'
			);
			$this->company_model->set_company_image($last_id,$logo);

			redirect('company', 'refresh');
		}

		$this->load->view('template/header');
		$this->load->view('company/create_company',$data);
		$this->load->view('template/footer');
	}

	//bu kod telefon numaralarına - boşluk ve _ koymaya yarar
	function alpha_dash_space($str_in = '')
	{
		if (! preg_match("/^([-a-z0-9_ ])+$/i", $str_in)){
			$this->form_validation->set_message('_alpha_dash_space', 'The %s field may only contain alpha-numeric characters, spaces, underscores, and dashes.');
			return FALSE;
		}
		else{
			return TRUE;
		}
	}

	function is_in_nace($nace)
	{
		$degisken= $this->company_model->is_in_nace($nace);

		if($degisken){
			return TRUE;
		}
		else{
			$this->form_validation->set_message('is_in_nace', 'NACE code is wrong');
			return FALSE;
		}
	}

	public function show_all_companies(){
		$cluster_id = $this->input->post('cluster');
		
		if($cluster_id == null || $cluster_id == 0){
			$data['cluster_name']['name'] = 'All Companies';
			$data['companies'] = $this->company_model->get_companies();
		}
		else{
			$data['companies'] = $this->company_model->get_companies_with_cluster($cluster_id);
			$data['cluster_name'] = $this->cluster_model->get_cluster_name($cluster_id);
		}		
		$data['clusters'] = $this->cluster_model->get_clusters();

		$this->load->view('template/header');
		$this->load->view('company/show_all_companies',$data);
		$this->load->view('template/footer');
	}

	public function companies($term){
		$this->load->library('googlemaps');

		$temp = $this->session->userdata('user_in');
		if($temp['id'] == null){
			$data['valid'] = "0";
		}else{
			$data['valid'] = "1";
		}

		$data['company_flows'] = $this->flow_model->get_company_flow_list($term);
		$data['company_prcss'] = $this->process_model->get_cmpny_flow_prcss($term);
		$data['company_component'] = $this->component_model->get_cmpnnt($term);
		$data['company_equipment'] = $this->equipment_model->all_information_of_equipment($term);
		$data['company_product'] = $this->product_model->get_product_list($term);
		
		$data['companies'] = $this->company_model->get_company($term);
			$config['center'] = $data['companies']['latitude'].','. $data['companies']['longitude'];
	    $config['zoom'] = '15';
	    $config['places'] = TRUE;
	    $config['placesRadius'] = 20;
	    $marker = array();
			$marker['position'] = $data['companies']['latitude'].','. $data['companies']['longitude'];
			$this->googlemaps->add_marker($marker);
			$this->googlemaps->initialize($config);

		$data['map'] = $this->googlemaps->create_map();
		$data['nacecode'] = $this->company_model->get_nace_code($term);
		$data['prjname'] = $this->company_model->get_company_proj($term);
		$data['cmpnyperson'] = $this->company_model->get_company_workers($term);
		$data['users_without_company']= $this->user_model->users_without_company();

		//kullanıcının company'i editleme hakkı varmı kontrolü
		$kullanici = $this->session->userdata('user_in');
		$data['have_permission'] = $this->user_model->can_edit_company($kullanici['id'],$term);

		$this->load->view('template/header');
		$this->load->view('company/company_show_detailed',$data);
		$this->load->view('template/footer');
	}


	public function company_search(){
		if (isset($_GET['term'])){
      		$q = strtolower($_GET['term']);
      		$results = $this->company_model->company_search($q);
   		}
		// and return to autocomplete
		echo $results;
	}

	public function addUsertoCompany($term){
		//kullanıcının company'i editleme hakkı varmı kontrolü
		$kullanici = $this->session->userdata('user_in');
		if(!$this->user_model->can_edit_company($kullanici['id'],$term)){
			redirect(base_url(),'refresh');
		}

		$this->form_validation->set_rules('users','User','required');
		if ($this->form_validation->run() !== FALSE)
		{
			$user = array(
				'user_id' => $this->input->post('users'),
      	'cmpny_id' => $term,
      	'is_contact' => 0
    	);
    	$this->company_model->add_worker_to_company($user);
		}

		redirect('company/'.$term, 'refresh');

	}

	public function update_company($term){

		//kullanıcının company'i editleme hakkı varmı kontrolü
		$kullanici = $this->session->userdata('user_in');
		if(!$this->user_model->can_edit_company($kullanici['id'],$term)){
			redirect(base_url(),'refresh');
		}

		$data['companies'] = $this->company_model->get_company($term);
		$data['nace_code'] = $this->company_model->get_nace_code($term);

		$this->load->library('googlemaps');

		$config['center'] = '39.98280915242299, 32.73923635482788';
		$config['zoom'] = '15';
		$config['map_type'] = "HYBRID";
		$config['places'] = TRUE;
		$config['placesRadius'] = 20;

		$marker = array();
		$marker['position'] = $data['companies']['latitude'].','. $data['companies']['longitude'];
		$this->googlemaps->add_marker($marker);
   		$this->googlemaps->initialize($config);

		$data['map'] = $this->googlemaps->create_map();

		$this->form_validation->set_rules('lat', 'Coordinates Latitude', 'trim|required|xss_clean');
		$this->form_validation->set_rules('long', 'Coordinates Longitude', 'trim|required|xss_clean');
		$this->form_validation->set_rules('companyName', 'Company Name', 'trim|required|xss_clean|callback_name_control');
		$this->form_validation->set_rules('naceCode', 'Nace Code', 'trim|required|xss_clean|callback_is_in_nace|regex_match[/^\d{2}\.\d{2}\.\d{2}$/]');
		$this->form_validation->set_rules('coordinates', 'Coordinates', 'trim|xss_clean');
		$this->form_validation->set_rules('companyDescription', 'Company Description', 'trim|xss_clean');
		$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|callback_is_unique_email');
		$this->form_validation->set_rules('cellPhone', 'Cell Phone Number', 'required|callback_alpha_dash_space|min_length[5]|xss_clean');
		$this->form_validation->set_rules('workPhone', 'Work Phone Number', 'required|callback_alpha_dash_space|min_length[5]|xss_clean');
		$this->form_validation->set_rules('fax', 'Fax Number', 'required|callback_alpha_dash_space|min_length[5]|xss_clean');
		$this->form_validation->set_rules('address', 'Address', 'trim|xss_clean');

		if ($this->form_validation->run() !== FALSE)
		{
			$config['upload_path'] = './assets/company_pictures/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '5000';
			$config['file_name']	= $this->uri->segment(2).'.jpg';
			$this->load->library('upload', $config);
			$this->upload->overwrite = true;
			//Resmi servera yükleme
			if (!$this->upload->do_upload())
			{
				print_r($this->upload->display_errors());
				//hata vermeye gerek yok , resim secmeyebilir.
			}
			//Yüklenen resmi boyutlandırma ve çevirme
			$config['image_library'] = 'gd2';
			$config['source_image']	= './assets/company_pictures/'.$this->uri->segment(2).'.jpg';
			$config['maintain_ratio'] = TRUE;
			$config['width']	 = 200;
			$config['height']	 = 200;
			$this->load->library('image_lib', $config);

			$this->image_lib->resize();

			$data2 = array(
				'name'=>$this->input->post('companyName'),
				'phone_num_1'=>$this->input->post('cellPhone'),
				'phone_num_2'=>$this->input->post('workPhone'),
				'fax_num'=>$this->input->post('fax'),
				'address'=>$this->input->post('address'),
				'description'=>$this->input->post('companyDescription'),
				'email'=>$this->input->post('email'),
				'postal_code'=>'NULL',
				'logo'=>$this->uri->segment(2).'.jpg',
				'active'=>'1',
				'latitude'=>$this->input->post('lat'),
				'longitude'=>$this->input->post('long')
			);

	    $this->company_model->update_company($data2,$term);

	    $code = $this->input->post('naceCode');

			$cmpny_data = array(
				'cmpny_id' => $data['companies']['id'],
      	'description' => $data['companies']['description']
    	);

		  $this->company_model->update_cmpny_data($cmpny_data,$data['companies']['id']);

		  $nace_code_id = $this->company_model->search_nace_code($code);

	    $cmpny_nace_code = array(
	    	'cmpny_id' => $data['companies']['id'],
	    	'nace_code_id' => $nace_code_id
	    );
	    $this->company_model->update_cmpny_nace_code($cmpny_nace_code,$data['companies']['id']);
	    redirect('company', 'refresh');
	  }
		$this->load->view('template/header');
		$this->load->view('company/update_company',$data);
		$this->load->view('template/footer');
	}

	public function is_unique_email(){
		$email = $this->input->post('email');
		$cmpny_id = $this->uri->segment(2);
		if($this->company_model->unique_control_email($email,$cmpny_id) == true)
			return true;
		else{
			$this->form_validation->set_message('is_unique_email','Email must be unique.');
			return false;
		}
	}

	public function create_company_control(){
		$temp = $this->session->userdata('user_in');
		$cmpny = $this->user_model->cmpny_prsnl($temp['id']);
		if(count($cmpny) == 0){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	function name_control(){
		$cmpny_id = $this->uri->segment(2);
		$cmpny_name = $this->input->post('companyName');
		if($this->company_model->have_project_name($cmpny_id,$cmpny_name)){
			return true;
		}
		else{
			$this->form_validation->set_message('name_control','Company Name must be required');
			return false;
		}
	}
}
?>
