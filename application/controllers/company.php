<?php
	
	class Company extends CI_Controller{
		
		public function new_company(){
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('companyName', 'Company Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('naceCode', 'Nace Code', 'trim|required|xss_clean|regex_match[/^\d{2}\.\d{2}\.\d{2}$/]');

			$this->load->library('googlemaps');

$config['center'] = '37.4419, -122.1419';
$config['zoom'] = '13';
$config['onclick'] = 'createMarker_map({ map: map, position:event.latLng });';
$this->googlemaps->initialize($config);
$data['map'] = $this->googlemaps->create_map();


			//$this->form_validation->set_rules('surname', 'Password', 'required');
			//$this->form_validation->set_rules('email', 'Email' ,'trim|required|valid_email');
			
			if ($this->form_validation->run() !== FALSE)
			{
				redirect('okoldu', 'refresh');
			}


			$this->load->view('template/header', $data);
			$this->load->view('company/create_company', $data);
			$this->load->view('template/footer');
		}
	}

?>