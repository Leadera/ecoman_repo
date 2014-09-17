<?php
class Cpscoping extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('project_model');		
		$this->load->model('process_model');
		$this->load->model('cpscoping_model');
		$this->load->model('flow_model');
		$this->load->library('form_validation');
	}

	public function index(){
		$c_user = $this->user_model->get_session_user();
		$data['c_projects']=$this->user_model->get_consultant_projects_from_userid($c_user['id']);
		$result = array(array());
		$com_array = array();
		$i = 0;
		foreach ($data['c_projects'] as $project_name) {
			$com_array = $this->project_model->get_prj_companies($project_name['proje_id']);
			foreach ($com_array as $c) {
				$com_pro = array(
					"project_name" => $project_name['name'],
					"company_name" => $c['name'],
					"project_id" => $project_name['proje_id'],
					"company_id" => $c['id']
				);
				$result[$i] = $com_pro;
				$i++;
			}
		}
		$deneme = array(array());
		$j = 0;
		foreach ($result as $r) {
			$flow_prcss = $this->cpscoping_model->get_allocation_values($r['company_id'],$r['project_id']);
			$deneme[$j] = $flow_prcss;
			$j++;
		}
		$data['flow_prcss'] = $deneme;
		$data['com_pro'] = $result;
		$this->load->view('template/header');
		$this->load->view('cpscoping/index',$data);
		$this->load->view('template/footer');
	}

	//Getting project companies from ajax
	public function p_companies($pid){
		$com_array = $this->project_model->get_prj_companies($pid);
		header("Content-Type: application/json", true);
		/* Return JSON */
		echo json_encode($com_array);
	}

	public function cp_allocation($project_id,$company_id){
		$this->form_validation->set_rules('amount', 'Coordinates Latitude', 'trim|xss_clean');
		$this->form_validation->set_rules('allocation', 'Allocation', 'trim|xss_clean');
		if ($this->form_validation->run() !== FALSE){
			$prcss_name = $this->input->post('prcss_name');
			$flow_name = $this->input->post('flow_name');
			$flow_type_name = $this->input->post('flow_type_name');
			$amount = $this->input->post('amount');
			$allocation_amount = $this->input->post('allocation_amount');
			$importance_amount = $this->input->post('importance_amount');
			$cost = $this->input->post('cost');
			$allocation_cost = $this->input->post('allocation_cost');
			$importance_cost = $this->input->post('importance_cost');
			$env_impact = $this->input->post('env_impact');
			$allocation_env_impact = $this->input->post('allocation_env_impact');
			$importance_env_impact = $this->input->post('importance_env_impact');
			$unit_amount = $this->input->post('unit_amount');
			$unit_cost = $this->input->post('unit_cost');
			$unit_env_impact = $this->input->post('unit_env_impact');

			$array_allocation = array(
				'prcss_id'=>$prcss_name,
				'flow_id'=>$flow_name,
				'flow_type_id'=>$flow_type_name,
				'amount'=>$amount,
				'unit_amount'=>$unit_amount,
				'allocation_amount'=>$allocation_amount,
				'importance_amount'=>$importance_amount,
				'cost'=>$cost,
				'unit_cost'=>$unit_cost,
				'allocation_cost'=>$allocation_cost,
				'importance_cost'=>$importance_cost,
				'env_impact'=>$env_impact,
				'unit_env_impact'=>$unit_env_impact,
				'allocation_env_impact'=>$allocation_env_impact,
				'importance_env_impact'=>$importance_env_impact
			);
			$this->cpscoping_model->set_cp_allocation($array_allocation);
			$allocation_array = array(
				'allocation_id' => $this->db->insert_id(),
				'prjct_id' => $project_id,
				'cmpny_id' => $company_id
			);
			$this->cpscoping_model->set_cp_allocation_main($allocation_array);

			redirect('cpscoping/'.$project_id.'/'.$company_id.'/show');
		}
		$data['project_id'] = $project_id;
		$data['company_id'] = $company_id;
		$data['prcss_info'] = $this->process_model->get_cmpny_flow_prcss($company_id);
		$data['unit_list'] = $this->flow_model->get_unit_list();

		$array_temp = array();
		$temp_index = 0;
		$kontrol = array();
		$index = 0;
		foreach ($data['prcss_info'] as $prcss_info) {
			$deneme = 0;
			$kontrol[$index] = $prcss_info['prcessname'];
			$index++;
			for($k = 0 ; $k < $index - 1 ; $k++){
				if($kontrol[$k] == $prcss_info['prcessname']){
					$deneme = 1;
				}
			}
			if($deneme == 0){
				$array_temp[$temp_index] = $prcss_info;
				$temp_index++;
			}
		}

		$data['prcss_info'] = $array_temp;
 
		$this->load->view('template/header');
		$this->load->view('cpscoping/allocation',$data);
		$this->load->view('template/footer');
	}

	public function cp_show_allocation($project_id,$company_id){
		$allocation_id_array = $this->cpscoping_model->get_allocation_id_from_ids($company_id,$project_id);
		$data['allocation'] = array();
		foreach ($allocation_id_array as $ids) {
			$data['allocation'][] = $this->cpscoping_model->get_allocation_from_allocation_id($ids['allocation_id']);
		}
		$this->load->view('template/header');
		$this->load->view('cpscoping/show',$data);
		$this->load->view('template/footer');
	}

	public function get_allo_from_fname_pname($flow_id,$process_id,$cmpny_id,$input_output,$prjct_id){
		if($process_id != 0){
			$kontrol = array();
			$array = array();

			$allocation_ids = $this->cpscoping_model->get_allocation_id_from_ids($cmpny_id,$prjct_id);
			foreach ($allocation_ids as $allo_id) {
				$kontrol = $this->cpscoping_model->get_allocation_prcss_flow_id($allo_id['allocation_id'],$input_output);
				if(!empty($kontrol)){
					if($kontrol['prcss_id'] == $process_id && $kontrol['flow_id'] == $flow_id){
						$array = $kontrol;
						break;
					}
				}
			}
			$i = 0;
			$kontrol = array();
			$array_copy = array();
			foreach ($allocation_ids as $allo_id) {
				$kontrol = $this->cpscoping_model->get_allocation_from_fname_pname_copy($flow_id,$allo_id['allocation_id'],$input_output);
				if(!empty($kontrol)){
					$array_copy[$i] = $kontrol;
					$i++;
				}
			}
			if($i != 0){
				$kontrol = array();
				$amount = 0.0;
				for($k = 0 ; $k < $i ; $k++){
					$amount += $array_copy[$k]["amount"];
				}
				$amount_temp = $array['amount'];
				$amount_temp = ($amount_temp * 100) / $amount;
				$amount_array = array('allocation_rate' => number_format($amount_temp,2));
				$array = array_merge($array,$amount_array);
			}
			/*$array = $this->cpscoping_model->get_allocation_from_fname_pname($flow_id,$process_id,$input_output);
			
			$cmpny_prcss_id = $this->process_model->get_cmpny_prcss_id($cmpny_id);
			$i = 0;
			$kontrol = array();
			foreach ($cmpny_prcss_id as $id) {
				$kontrol = $this->cpscoping_model->get_allocation_from_fname_pname($flow_id,$id['id'],$input_output);
				if(!empty($kontrol)){
					$array_copy[$i] = $kontrol;
					$i++;
				}
			}
			if($i != 0){
				$kontrol = array();
				$amount = 0.0;
				for($k = 0 ; $k < $i ; $k++){
					$amount += $array_copy[$k]["amount"];
				}
				$amount_temp = $array['amount'];
				$amount_temp = ($amount_temp * 100) / $amount;
				$amount_array = array('allocation_rate' => number_format($amount_temp,2));
				$array = array_merge($array,$amount_array);
			}*/
		}else{
			$kontrol = array();
			$array = array();
			$i = 0;

			$allocation_ids = $this->cpscoping_model->get_allocation_id_from_ids($cmpny_id,$prjct_id);
			foreach ($allocation_ids as $allo_id) {
				$kontrol = $this->cpscoping_model->get_allocation_from_fname_pname_copy($flow_id,$allo_id['allocation_id'],$input_output);
				if(!empty($kontrol)){
					$array[$i] = $kontrol;
					$i++;
				}
			}
			if($i != 0){
				$kontrol = array();
				$amount = 0.0;
				$cost = 0.0;
				$env_impact = 0.0;
				for($k = 0 ; $k < $i ; $k++){
					$amount += $array[$k]["amount"];
					$cost += $array[$k]["cost"];
					$env_impact += $array[$k]["env_impact"];
				}
				$kontrol = array(
					'amount' => $amount,
					'unit_amount'=>$array[0]["unit_amount"],
					'cost' => $cost,
					'unit_cost'=>$array[0]["unit_cost"],
					'env_impact' => $env_impact,
					'unit_env_impact'=>$array[0]["unit_env_impact"],
					'allocation_amount'=>"none"
				);
				$array = $kontrol;
			}
			/*$cmpny_prcss_id = $this->process_model->get_cmpny_prcss_id($cmpny_id);
			$i = 0;
			$kontrol = array();
			foreach ($cmpny_prcss_id as $id) {
				$kontrol = $this->cpscoping_model->get_allocation_from_fname_pname($flow_id,$id['id'],$input_output);
				if(!empty($kontrol)){
					$array[$i] = $kontrol;
					$i++;
				}
			}
			if($i != 0){
				$kontrol = array();
				$amount = 0.0;
				$cost = 0.0;
				$env_impact = 0.0;
				for($k = 0 ; $k < $i ; $k++){
					$amount += $array[$k]["amount"];
					$cost += $array[$k]["cost"];
					$env_impact += $array[$k]["env_impact"];
				}
				$kontrol = array(
					'amount' => $amount,
					'unit_amount'=>$array[0]["unit_amount"],
					'cost' => $cost,
					'unit_cost'=>$array[0]["unit_cost"],
					'env_impact' => $env_impact,
					'unit_env_impact'=>$array[0]["unit_env_impact"],
					'allocation_amount'=>"none"
				);
				$array = $kontrol;
			}*/
		}
		header("Content-Type: application/json", true);
		echo json_encode($array);
	}

	public function cp_allocation_array($company_id){
		$allocation_array = $this->process_model->get_cmpny_flow_prcss($company_id);
		header("Content-Type: application/json", true);
		echo json_encode($allocation_array);
	}

	public function deneme(){
		$this->load->view('template/header');
		$this->load->view('cpscoping/deneme');
		$this->load->view('template/footer');
	}

	public function deneme_json(){
		$c_user = $this->user_model->get_session_user();
		$allocation_array = $this->user_model->deneme_json($c_user['id']);
		$i = 0;
		foreach ($allocation_array as $p) {
			$array = $this->project_model->deneme_json_2($p['id']);
			$allocation_array[$i]['children'] = $array;
			$i++;
		}
		header("Content-Type: application/json", true);
		echo json_encode($allocation_array);
	}
}