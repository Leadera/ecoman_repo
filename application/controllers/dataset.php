<?php
class Dataset extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('product_model');
		$this->load->model('user_model');
		$this->load->model('flow_model');
		$this->load->model('process_model');
		$this->load->model('equipment_model');
		$this->load->model('component_model');
		$this->load->library('form_validation');

		$kullanici = $this->session->userdata('user_in');
		if($this->user_model->can_edit_company($kullanici['id'],$this->uri->segment(2)) == FALSE && $this->uri->segment(1) != "get_equipment_type" && $this->uri->segment(1) != "get_equipment_attribute"){
			redirect(base_url(''), 'refresh');
		}

	}

	public function new_product($companyID)
	{
		$this->form_validation->set_rules('product', 'Product Field', 'trim|required|xss_clean');

		if($this->form_validation->run() !== FALSE) {
			$productArray = array(
					'cmpny_id' => $companyID,
					'name' => $this->input->post('product')
				);
			$this->product_model->set_product($productArray);
		}

		$data['product'] = $this->product_model->get_product_list($companyID);
		$data['companyID'] = $companyID;

		$this->load->view('template/header');
		$this->load->view('dataset/dataSetLeftSide',$data);
		$this->load->view('dataset/new_product',$data);
		$this->load->view('template/footer');
	}

	public function new_flow($companyID)
	{
		$this->form_validation->set_rules('flowname', 'Flow Name', 'trim|required|xss_clean|strip_tags');
		$this->form_validation->set_rules('flowtype', 'Flow Type', 'trim|required|xss_clean|strip_tags');
		$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|xss_clean|strip_tags|numeric');
		$this->form_validation->set_rules('cost', 'Cost', 'trim|required|xss_clean|strip_tags|numeric');
		$this->form_validation->set_rules('ep', 'EP', 'trim|required|xss_clean|strip_tags|numeric');

		if($this->form_validation->run() !== FALSE) {

			$flowID = $this->input->post('flowname');
			$flowtypeID = $this->input->post('flowtype');
			$ep = $this->input->post('ep');
			$cost = $this->input->post('cost');
			$quantity = $this->input->post('quantity');

			$flow = array(
				'cmpny_id'=>$companyID,
				'flow_id'=>$flowID,
				'qntty'=>$quantity,
				'cost' =>$cost,
				'ep' => $ep,
				'flow_type_id'=> $flowtypeID
			);
			$this->flow_model->register_flow_to_company($flow);

			//redirect(base_url('new_flow/'.$data['companyID']), 'refresh'); // tablo olusurken ajax kullanılabilir.
			//şuan sayfa yenileniyor her seferinde database'den satırlar ekleniyor.

		}

		$data['flownames'] = $this->flow_model->get_flowname_list();
		$data['flowtypes'] = $this->flow_model->get_flowtype_list();

		$data['company_flows']=$this->flow_model->get_company_flow_list($companyID);
		$data['companyID'] = $companyID;

		$this->load->view('template/header');
		$this->load->view('dataset/dataSetLeftSide',$data);
		$this->load->view('dataset/new_flow',$data);
		$this->load->view('template/footer');

	}

	public function new_component($companyID){
		
		$this->form_validation->set_rules('component_name', 'Component Name', 'trim|required|xss_clean');

		if($this->form_validation->run() !== FALSE) {
			$component_array = array(
					'name' => $this->input->post('component_name'),
					'name_tr' => $this->input->post('component_name'),
					'active' => '1'
				);
			$component_id = $this->component_model->set_cmpnnt($component_array);

			$cmpny_flow_cmpnnt = array(
					'cmpny_flow_id' => $this->input->post('flowtype'),
					'cmpnnt_id' => $component_id
				);
			$this->component_model->set_cmpny_flow_cmpnnt($cmpny_flow_cmpnnt);
		}
		
		$data['component_name'] = $this->component_model->get_cmpnnt($companyID);;
		$data['companyID'] = $companyID;
		$data['flow_and_flow_type'] = $this->component_model->get_cmpny_flow_and_flow_type($companyID);

		$this->load->view('template/header');
		$this->load->view('dataset/dataSetLeftSide',$data);
		$this->load->view('dataset/new_component',$data);
		$this->load->view('template/footer');
	}

	public function new_process($companyID){

		$this->form_validation->set_rules('process','Process','required');


		if ($this->form_validation->run() !== FALSE)
		{
			$used_flows = $this->input->post('usedFlows');
			$process_id = $this->input->post('process');

			$cmpny_prcss_id = $this->process_model->can_write_cmpny_prcss($companyID,$process_id);
			
			if($cmpny_prcss_id != false){
				$cmpny_prcss = array(
					'cmpny_id' => $companyID,
					'prcss_id' => $process_id
				);

				$cmpny_prcss_id = $this->process_model->cmpny_prcss($cmpny_prcss);

				foreach($used_flows as $flow) {
					$cmpny_flow_prcss = array(
							'cmpny_flow_id' => $flow,
							'cmpny_prcss_id' => $cmpny_prcss_id
						);
					$this->process_model->cmpny_flow_prcss($cmpny_flow_prcss);
				}

			}

			foreach($used_flows as $flow) {
				$cmpny_flow_prcss = array(
						'cmpny_flow_id' => $flow,
						'cmpny_prcss_id' => $cmpny_prcss_id['id']
					);
				$this->process_model->cmpny_flow_prcss($cmpny_flow_prcss);
			}
		}

		$data['process'] = $this->process_model->get_process();
		$data['company_flows']=$this->flow_model->get_company_flow_list($companyID);
		$data['cmpny_flow_prcss'] = $this->process_model->get_cmpny_flow_prcss($companyID);
		$data['companyID'] = $companyID;


		$this->load->view('template/header');
		$this->load->view('dataset/dataSetLeftSide',$data);
		$this->load->view('dataset/new_process',$data);
		$this->load->view('template/footer');
	}

	public function new_equipment($companyID){				

		$this->form_validation->set_rules('usedprocess','Used Process','required');
		$this->form_validation->set_rules('equipment','Equipment Name','required');

		if ($this->form_validation->run() !== FALSE)
		{
			$prcss_id = $this->input->post('usedprocess');
			$equipment_id = $this->input->post('equipment');
			$equipment_type_id = $this->input->post('equipmentTypeName');
			$equipment_type_attribute_id = $this->input->post('equipmentAttributeName');

			$cmpny_eqpmnt_type_attrbt = array(
					'cmpny_id' => $companyID,
					'eqpmnt_id' => $equipment_id,
					'eqpmnt_type_id' => $equipment_type_id,
					'eqpmnt_type_attrbt_id' => $equipment_type_attribute_id
				);
			$last_index = $this->equipment_model->set_info($cmpny_eqpmnt_type_attrbt);

			$cmpny_prcss_id = $this->equipment_model->get_cmpny_prcss_id($companyID,$prcss_id);

			$cmpny_prcss = array(
					'cmpny_eqpmnt_type_id' => $last_index,
					'cmpny_prcss_id' => $cmpny_prcss_id['id']
				);
			$this->equipment_model->set_cmpny_prcss($cmpny_prcss);
		}

		$data['companyID'] = $companyID;
		$data['equipmentName'] = $this->equipment_model->get_equipment_name();
		$data['process'] = $this->equipment_model->cmpny_prcss($companyID);
		$data['informations'] = $this->equipment_model->all_information_of_equipment($companyID);
		
		$this->load->view('template/header');
		$this->load->view('dataset/dataSetLeftSide',$data);
		$this->load->view('dataset/new_equipment',$data);
		$this->load->view('template/footer');
	}

	public function delete_product($companyID,$id){
		$this->product_model->delete_product($id);
		redirect('new_product/'.$companyID, 'refresh');
	}

	public function get_equipment_type(){
		$equipment_id = $this->input->post('equipment_id');
		$type_list = $this->equipment_model->get_equipment_type_list($equipment_id);
		echo json_encode($type_list);
	}

	public function get_equipment_attribute(){
		$equipment_type_id = $this->input->post('equipment_type_id');
		$attribute_list = $this->equipment_model->get_equipment_attribute_list($equipment_type_id);
		echo json_encode($attribute_list);
	}
}
