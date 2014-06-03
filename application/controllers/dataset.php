<?php
class Dataset extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('product_model');
		$this->load->model('flow_model');
		$this->load->model('process_model');
		$this->load->model('equipment_model');
		$this->load->library('form_validation');
	}

	public function product(){
		$data['product_list'] = $this->product_model->product_list();

		$this->load->view('template/header');
		$this->load->view('dataset/product',$data);
		$this->load->view('template/footer');
	}

	public function new_product()
	{


		$data['products']=$this->product_model->get_product_list();

		$this->load->library('form_validation');

		
		$this->form_validation->set_rules('product', 'Product name', 'trim|required|xss_clean|strip_tags');

		if($this->form_validation->run() == FALSE) {
			$this->load->view('template/header');
			$this->load->view('dataset/dataSetLeftSide');
			$this->load->view('dataset/new_product',$data);
			$this->load->view('template/footer');
		}
		else{
			$product = $this->input->post('product');

			
			$this->product_model->register_product_to_company();

			redirect(base_url('new_product'), 'refresh');
		}
	}

	public function new_flow($companyID)
	{
		$data['flownames'] = $this->flow_model->get_flowname_list();
		$data['flowtypes'] = $this->flow_model->get_flowtype_list();

		$data['company_flows']=$this->flow_model->get_company_flow_list($companyID);
		$data['companyID'] = $companyID;

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

			redirect(base_url('new_flow/'.$data['companyID']), 'refresh'); // tablo olusurken ajax kullanılabilir. 
			//şuan sayfa yenileniyor her seferinde database'den satırlar ekleniyor.

		}else{

			$this->load->view('template/header');
			$this->load->view('dataset/dataSetLeftSide',$data);
			$this->load->view('dataset/new_flow',$data);
			$this->load->view('template/footer');
		}




	}

	public function new_component()
	{
		
		$this->form_validation->set_rules('componentname', 'Component name', 'trim|required|xss_clean|strip_tags');
	
		if($this->form_validation->run() == FALSE) {
			$this->load->view('template/header');
			$this->load->view('dataset/dataSetLeftSide');
			$this->load->view('dataset/new_component');
			$this->load->view('template/footer');
		}
		else{
			$componentname = $this->input->post('componentname');

			$this->product_model->register_component($componentname);

			redirect(base_url('flow_and_component'), 'refresh');
		}
	}

	public function flow_and_component(){

		$data['flow_list'] = $this->product_model->flow_list();
		$data['component_list'] = $this->product_model->component_list();


		$this->load->view('template/header');
		$this->load->view('dataset/flow_and_component', $data);
		$this->load->view('template/footer');
	}


	public function new_process($companyID){
		$data['process'] = $this->process_model->get_process();
		$data['company_flows']=$this->flow_model->get_company_flow_list($companyID);
		$data['cmpny_flow_prcss'] = $this->process_model->get_cmpny_flow_prcss($companyID);
		$data['companyID'] = $companyID;

		$this->form_validation->set_rules('process','Process','required');


		if ($this->form_validation->run() !== FALSE)
		{
			$used_flows = $this->input->post('usedFlows');
			$process_id = $this->input->post('process');

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

			redirect('new_process/'.$companyID, 'refresh');
		}
		
		$this->load->view('template/header');
		$this->load->view('dataset/dataSetLeftSide',$data);
		$this->load->view('dataset/new_process',$data);
		$this->load->view('template/footer');
	}

	public function new_equipment($companyID){
		$data['companyID'] = $companyID;
		$data['equipmentName'] = $this->equipment_model->get_equipment_name($companyID);
		
		$this->load->view('template/header');
		$this->load->view('dataset/dataSetLeftSide',$data);
		$this->load->view('dataset/new_equipment');
		$this->load->view('template/footer');
	}
}