<?php
class Company extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('company_model');
	}

	public function new_company(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('companyName', 'Company Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('naceCode', 'Nace Code', 'trim|required|xss_clean|regex_match[/^\d{2}\.\d{2}\.\d{2}$/]');
		$this->form_validation->set_rules('coordinates', 'Coordinates', 'trim|xss_clean');
		$this->form_validation->set_rules('companyDescription', 'Company Description', 'trim|xss_clean');
		$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|is_unique[T_CMPNY.email]');
		$this->form_validation->set_rules('cellPhone', 'Cell Phone Number', 'required|numeric|min_length[11]|xss_clean');
		$this->form_validation->set_rules('workPhone', 'Work Phone Number', 'required|numeric|min_length[11]|xss_clean');
		$this->form_validation->set_rules('fax', 'Fax Number', 'required|numeric|min_length[11]|xss_clean');
		$this->form_validation->set_rules('address', 'Address', 'trim|xss_clean');


		if ($this->form_validation->run() !== FALSE)
		{
			$config['upload_path'] = './assets/company_pictures/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '5000';
			$config['file_name']	= $this->input->post('companyName').'.jpg';
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload())
			{
				print_r($this->upload->display_errors());
				exit;
			}

			$config['image_library'] = 'gd2';
			$config['source_image']	= './assets/company_pictures/'.$this->input->post('companyName').'.jpg';
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 200;
			$config['height'] = 200;
			$this->load->library('image_lib', $config);

			$this->image_lib->resize();

			$data = array(
			'name'=>$this->input->post('companyName'),
			'phone_num_1'=>$this->input->post('cellPhone'),
			'phone_num_2'=>$this->input->post('workPhone'),
			'fax_num'=>$this->input->post('fax'),
			'address'=>$this->input->post('address'),
			'description'=>$this->input->post('companyDescription'),
			'email'=>$this->input->post('email'),
			'logo'=>$this->input->post('companyName').'.jpg',
			'active'=>'1'
			);
			$code = $this->input->post('naceCode');
			$this->company_model->create_company($data,$code);

			redirect('okoldu', 'refresh');
		}

		$this->load->view('template/header');
		$this->load->view('company/create_company');
		$this->load->view('template/footer');
	}
}
?>
