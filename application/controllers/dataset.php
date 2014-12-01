<?php
class Dataset extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('product_model');
		$this->load->model('user_model');
		$this->load->model('company_model');
		$this->load->model('flow_model');
		$this->load->model('process_model');
		$this->load->model('equipment_model');
		$this->load->model('component_model');
		$this->load->library('form_validation');

		$kullanici = $this->session->userdata('user_in');
		if($this->user_model->can_edit_company($kullanici['id'],$this->uri->segment(2)) == FALSE && $this->uri->segment(1) != "get_equipment_type" && $this->uri->segment(1) != "get_equipment_attribute"&& $this->uri->segment(1) != "get_sub_process"){
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
		$data['company_info'] = $this->company_model->get_company($companyID);


		$this->load->view('template/header');
		$this->load->view('dataset/dataSetLeftSide',$data);
		$this->load->view('dataset/new_product',$data);
		$this->load->view('template/footer');
	}

	public function new_flow($companyID)
	{
		$this->form_validation->set_rules('flowname', 'Flow Name', 'trim|alpha_dash|required|xss_clean|strip_tags');
		$this->form_validation->set_rules('flowtype', 'Flow Type', 'trim|required|xss_clean|strip_tags');
		$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|xss_clean|strip_tags|numeric');
		$this->form_validation->set_rules('quantityUnit', 'Quantity Unit', 'trim|required|xss_clean|strip_tags');
		$this->form_validation->set_rules('cost', 'Cost', 'trim|required|xss_clean|strip_tags|numeric');
		$this->form_validation->set_rules('costUnit', 'Cost Unit', 'trim|required|xss_clean|strip_tags');
		$this->form_validation->set_rules('ep', 'EP', 'trim|required|xss_clean|strip_tags|numeric');
		$this->form_validation->set_rules('epUnit', 'EP Unit', 'trim|required|xss_clean|strip_tags');

		if($this->form_validation->run() !== FALSE) {

			$flowID = $this->input->post('flowname');
			$flowtypeID = $this->input->post('flowtype');
			$flowfamilyID = $this->input->post('flowfamily');
			$ep = $this->input->post('ep');
			$epUnit = $this->input->post('epUnit');
			$cost = $this->input->post('cost');
			$costUnit = $this->input->post('costUnit');
			$quantity = $this->input->post('quantity');
			$quantityUnit = $this->input->post('quantityUnit');
			
			$cf = $this->input->post('cf');
			$availability = $this->input->post('availability');
			$conc = $this->input->post('conc');
			$pres = $this->input->post('pres');
			$ph = $this->input->post('ph');
			$state = $this->input->post('state');
			$quality = $this->input->post('quality');
			$oloc = $this->input->post('oloc');
			//$odis = $this->input->post('odis');
			//$otrasmean = $this->input->post('otrasmean');			
			//$sdis = $this->input->post('sdis');
			//$strasmean = $this->input->post('strasmean');
			//$rtech = $this->input->post('rtech');
			$desc = $this->input->post('desc');
			$spot = $this->input->post('spot');
			$comment = $this->input->post('comment');

			//CHECK IF PROCESS IS NEW?
			$flowID = $this->process_model->is_new_flow($flowID,$flowfamilyID);

			if(!$this->flow_model->has_same_flow($flowID,$flowtypeID,$companyID)){
				redirect(base_url('new_flow/'.$companyID));
			}
			$flow = array(
				'cmpny_id'=>$companyID,
				'flow_id'=>$flowID,
				'qntty'=>$quantity,
				'qntty_unit_id'=>$quantityUnit,
				'cost' =>$cost,
				'cost_unit_id' =>$costUnit,
				'ep' => $ep,
				'ep_unit_id' => $epUnit,
				'flow_type_id'=> $flowtypeID,
				'chemical_formula' => $cf,
				'availability' => $availability,
				'concentration' => $conc,
				'pression' => $pres,
				'ph' => $ph,
				'state_id' => $state,
				'quality' => $quality,
				'output_location' => $oloc,
				'substitute_potential' => $spot,
				'description' => $desc,
				'comment' => $comment
			);
			$this->flow_model->register_flow_to_company($flow);

			//redirect(base_url('new_flow/'.$data['companyID']), 'refresh'); // tablo olusurken ajax kullanılabilir.
			//şuan sayfa yenileniyor her seferinde database'den satırlar ekleniyor.

		}

		$data['flownames'] = $this->flow_model->get_flowname_list();
		$data['flowtypes'] = $this->flow_model->get_flowtype_list();
		$data['flowfamilys'] = $this->flow_model->get_flowfamily_list();

		$data['company_flows']=$this->flow_model->get_company_flow_list($companyID);
		$data['companyID'] = $companyID;
		$data['company_info'] = $this->company_model->get_company($companyID);


		$data['units'] = $this->flow_model->get_unit_list();

		$this->load->view('template/header');
		$this->load->view('dataset/dataSetLeftSide',$data);
		$this->load->view('dataset/new_flow',$data);
		$this->load->view('template/footer');

	}

	public function new_component($companyID){
		
		$this->form_validation->set_rules('component_name', 'Component Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('flowtype', 'Flow Type', 'trim|required|xss_clean');

		if($this->form_validation->run() !== FALSE) {
			$component_array = array(
				'cmpny_id' => $companyID,
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
		
		$data['component_name'] = $this->component_model->get_cmpnnt($companyID);
		$data['companyID'] = $companyID;
		$data['company_info'] = $this->company_model->get_company($companyID);
		$data['flow_and_flow_type'] = $this->component_model->get_cmpny_flow_and_flow_type($companyID);

		$this->load->view('template/header');
		$this->load->view('dataset/dataSetLeftSide',$data);
		$this->load->view('dataset/new_component',$data);
		$this->load->view('template/footer');
	}

	public function new_process($companyID){

		$this->form_validation->set_rules('process','Process','required');
		$this->form_validation->set_rules('usedFlows','Used Flows','required');


		if ($this->form_validation->run() !== FALSE)
		{
			$used_flows = $this->input->post('usedFlows');
			$process_id = $this->input->post('process');

			//CHECK IF PROCESS IS NEW?
			$process_id = $this->process_model->is_new_process($process_id);

			$cmpny_prcss_id = $this->process_model->can_write_cmpny_prcss($companyID,$process_id);
			
			if($cmpny_prcss_id == false){
				$cmpny_prcss = array(
					'cmpny_id' => $companyID,
					'prcss_id' => $process_id
				);
				$cmpny_prcss_id['id'] = $this->process_model->cmpny_prcss($cmpny_prcss);
			}

			foreach($used_flows as $flow) {
				if($this->process_model->can_write_cmpny_flow_prcss($flow,$cmpny_prcss_id['id']) == true){
					$cmpny_flow_prcss = array(
						'cmpny_flow_id' => $flow,
						'cmpny_prcss_id' => $cmpny_prcss_id['id']
					);
					$this->process_model->cmpny_flow_prcss($cmpny_flow_prcss);
				}
			}
		}

		$data['process'] = $this->process_model->get_main_process();
		$data['company_flows']=$this->flow_model->get_company_flow_list($companyID);
		$data['cmpny_flow_prcss'] = $this->process_model->get_cmpny_flow_prcss($companyID);
		$data['companyID'] = $companyID;
		$data['company_info'] = $this->company_model->get_company($companyID);

		$this->load->view('template/header');
		$this->load->view('dataset/dataSetLeftSide',$data);
		$this->load->view('dataset/new_process',$data);
		$this->load->view('template/footer');
	}

	public function new_equipment($companyID){				

		$this->form_validation->set_rules('usedprocess','Used Process','required');
		$this->form_validation->set_rules('equipment','Equipment Name','required');
		$this->form_validation->set_rules('equipmentTypeName','Equipment Type Name','required');
		$this->form_validation->set_rules('equipmentAttributeName','Equipment Attribute Name','required');

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
		$data['company_info'] = $this->company_model->get_company($companyID);
		
		$this->load->view('template/header');
		$this->load->view('dataset/dataSetLeftSide',$data);
		$this->load->view('dataset/new_equipment',$data);
		$this->load->view('template/footer');
	}

	public function delete_product($companyID,$id){
		$this->product_model->delete_product($id);
		redirect('new_product/'.$companyID, 'refresh');
	}
	public function delete_flow($companyID,$id){
		$cmpny_flow_prcss_id_list = $this->process_model->cmpny_flow_prcss_id_list($id);
		$this->process_model->delete_cmpny_flow_process($id);	

		foreach ($cmpny_flow_prcss_id_list as $cmpny_flow_prcss_id) {
			if(!$this->process_model->still_exist_this_cmpny_prcss($cmpny_flow_prcss_id['cmpny_prcss_id'])){
				$this->equipment_model->delete_cmpny_equipment($cmpny_flow_prcss_id['cmpny_prcss_id']);
				$this->process_model->delete_cmpny_process($cmpny_flow_prcss_id['cmpny_prcss_id']);
			}
		}

		$this->component_model->delete_flow_cmpnnt_by_flowID($id);
		$this->flow_model->delete_flow($id);
		redirect('new_flow/'.$companyID, 'refresh');
	}

	public function delete_component($companyID,$id){
		$this->component_model->delete_flow_cmpnnt_by_cmpnntID($id);
		$this->component_model->delete_cmpnnt($companyID,$id);
		redirect('new_component/'.$companyID, 'refresh');
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

	public function get_sub_process(){
		$processID = $this->input->post('processID');
		$process_list = $this->process_model->get_process_from_motherID($processID);
		echo json_encode($process_list);
	}

	public function delete_process($companyID,$company_process_id,$company_flow_id){
		
		$this->process_model->delete_company_flow_prcss($company_process_id,$company_flow_id);
		
		if(!$this->process_model->still_exist_this_cmpny_prcss($company_process_id))
		{
			$this->equipment_model->delete_cmpny_equipment($company_process_id);
			$this->process_model->delete_cmpny_process($company_process_id);
		}
		/*
			$this->process_model->delete_cmpny_prcss_eqpmnt_type($id['id']);
		$this->process_model->delete_cmpny_prcss($companyID);
		$this->process_model->delete_cmpny_eqpmnt($companyID)*/
		redirect('new_process/'.$companyID);
	}

	public function delete_equipment($cmpny_id,$cmpny_eqpmnt_id){

		$this->equipment_model->delete_cmpny_prcss_eqpmnt_type($cmpny_eqpmnt_id);
		$this->equipment_model->delete_cmpny_eqpmnt($cmpny_eqpmnt_id);
		redirect('new_equipment/'.$cmpny_id,'refresh');
	}


}
