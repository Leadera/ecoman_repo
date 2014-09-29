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
			$reference = $this->input->post('reference');
			$unit_reference = $this->input->post('unit_reference');
			$kpi = $this->input->post('kpi');
			$unit_kpi = $this->input->post('unit_kpi');
			$kpi_error = $this->input->post('kpi_error');

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
				'importance_env_impact'=>$importance_env_impact,
				'reference' => $reference,
				'unit_reference' => $unit_reference,
				'kpi' => number_format($kpi,4),
				'unit_kpi' => $unit_kpi,
				'kpi_error' => $kpi_error
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
			$data['allocation_output'][] = $this->cpscoping_model->get_allocation_from_allocation_id_output($ids['allocation_id']);
			$data['active'][$ids['allocation_id']] = $this->cpscoping_model->get_is_candidate_active_position($ids['allocation_id']);
		}
		$this->load->view('template/header');
		$this->load->view('cpscoping/show',$data);
		$this->load->view('template/footer');
	}

	public function kpi_calculation_chart($prjct_id,$cmpny_id){
		$allocation_id_array = $this->cpscoping_model->get_allocation_id_from_ids($cmpny_id,$prjct_id);
		$data['allocation'] = array();
		foreach ($allocation_id_array as $ids) {
			$data['allocation'][] = $this->cpscoping_model->get_allocation_from_allocation_id($ids['allocation_id']);
		}
		header("Content-Type: application/json", true);
		echo json_encode($data);
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

	public function cost_ep_value($prcss_id,$prjct_id,$cmpny_id){
		$allocation_ids = $this->cpscoping_model->get_allocation_id_from_ids($cmpny_id,$prjct_id);
		$array = array();
		$index = 0;
		$cost_value_alt = 0.0;
		$cost_value_ust = 0.0;
		$ep_value_alt = 0.0;
		$ep_value_ust = 0.0;
		$prcss_name = "";
		foreach ($allocation_ids as $allo_id) {
			$array[$index] = $this->cpscoping_model->get_allocation_from_allocation_id($allo_id['allocation_id']);
			if($array[$index]['prcss_id'] == $prcss_id){
				$doviz_array = $this->dolar_euro_parse();
				$unit = $array[$index]['unit_cost'];
				$allocation_cost = $array[$index]['allocation_cost'];
				$allocation_env_impact = $array[$index]['allocation_env_impact'];

				if($unit == "Dolar"){
					$cost_value_alt += ($array[$index]['cost'] * ((100-$allocation_cost)/100)) * number_format(($doviz_array['dolar'] / $doviz_array['euro']),4);
					$cost_value_ust += ($array[$index]['cost'] * ((100+$allocation_cost)/100)) * number_format(($doviz_array['dolar'] / $doviz_array['euro']),4);
				}else if($unit == "TL"){
					$cost_value_alt += ($array[$index]['cost'] * ((100-$allocation_cost)/100)) * $doviz_array['euro'];
					$cost_value_ust += ($array[$index]['cost'] * ((100+$allocation_cost)/100)) * $doviz_array['euro'];
				}else{
					$cost_value_alt += ($array[$index]['cost'] * ((100-$allocation_cost)/100));
					$cost_value_ust += ($array[$index]['cost'] * ((100+$allocation_cost)/100)) * $doviz_array['euro'];
				}

				$prcss_name = $array[$index]['prcss_name'];
				$ep_value_alt += $array[$index]['env_impact'] * ((100-$allocation_env_impact)/100);
				$ep_value_ust += $array[$index]['env_impact'] * ((100+$allocation_env_impact)/100);
			}
			$index++;
		}
		$return_array = array(
			'prcss_name' => $prcss_name,
			'ep_value_alt' => $ep_value_alt,
			'ep_value_ust' => $ep_value_ust,
			'cost_value_alt' => $cost_value_alt,
			'cost_value_ust' => $cost_value_ust
		);
		header("Content-Type: application/json", true);
		echo json_encode($return_array);
	}

	public function dolar_euro_parse(){
		$sayac = 0;
		$array_temp = array();
		$this->load->library('simple_html_dom');
		$raw = file_get_html('http://www.doviz.com/');
		foreach($raw->find('div') as $element){
		 	foreach ($element->find('ul') as $key) {
		  		foreach ($key->find('li') as $value) {
		  			foreach ($value->find('span') as $sp) {
		  				$sayac++;
		  				if($sayac == 8){
		  					$array_temp['dolar'] = str_replace(',', '.', $sp->plaintext);
		  				}else if($sayac == 13){
		  					$array_temp['euro'] = str_replace(',', '.', $sp->plaintext);
		  				}
			  		}
		  		}
		  	}
		}
		return $array_temp;
	}

	public function cp_is_candidate_control($allocation_id){
		$return_array['control'] = $this->cpscoping_model->cp_is_candidate_control($allocation_id);
		header("Content-Type: application/json", true);
		echo json_encode($return_array);
	}

	public function cp_is_candidate_insert($allocation_id,$buton_durum){
		$result = $this->cpscoping_model->cp_is_candidate_control($allocation_id);
		$is_candidate_array = array(
			'allocation_id' => $allocation_id,
			'active' => $buton_durum
		);
		if($result == 0){
			$this->cpscoping_model->cp_is_candidate_insert($is_candidate_array);
		}else{
			$this->cpscoping_model->cp_is_candidate_update($is_candidate_array,$allocation_id);
		}
	}

	public function cp_scoping_file_upload($prjct_id,$cmpny_id){
		$file_name = $this->input->post('file_name');

		$uzanti = $_FILES['userfile']['name'];
		$uzanti = explode('.',$uzanti);
		$eklenti = $uzanti[sizeof($uzanti)-1];

		$last_file_name = explode(' ',$file_name);
		$f_name = "";
		for($i = 0 ; $i < sizeof($last_file_name) ; $i++){
			if($i == sizeof($last_file_name)-1){
				$f_name .= $last_file_name[$i];
			}else{
				$f_name .= $last_file_name[$i]."_";
			}
		}
		
		ini_set('upload_max_filesize','20M'); 
		$config['upload_path'] = './assets/cp_scoping_files/';
		$config['allowed_types'] = $eklenti;
		$config['max_size']	= '500000';
		$config['file_name']	= $f_name.'.'.$eklenti;
		$this->load->library('upload', $config);

		//Resmi servera yükleme
		if (!$this->upload->do_upload())
		{
			echo $this->upload->display_errors();
			exit;
		}else{
			$cp_scoping_files = array(
				'prjct_id' => $prjct_id,
				'cmpny_id' => $cmpny_id,
				'file_name' => $f_name.'.'.$eklenti
			);
			$this->cpscoping_model->insert_cp_scoping_file($cp_scoping_files);
			redirect(base_url('kpi_calculation/'.$prjct_id.'/'.$cmpny_id),'refresh');
		}
	}

	public function search_result($prjct_id,$cmpny_id){
		$search = $this->input->post('search');
		$data['result'] = $this->cpscoping_model->search_result($search);
		$data['prjct_id'] = $prjct_id;
		$data['cmpny_id'] = $cmpny_id;
		$this->load->view('template/header');
		$this->load->view('cpscoping/search_result',$data);
		$this->load->view('template/footer');
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

	public function kpi_calculation($prjct_id,$cmpny_id){
		$data['cp_files'] = $this->cpscoping_model->get_cp_scoping_files($prjct_id,$cmpny_id);
		$allocation_ids = $this->cpscoping_model->get_allocation_id_from_ids($cmpny_id,$prjct_id);
		foreach ($allocation_ids as $allocation_id) {
			$data['kpi_values'][] = $this->cpscoping_model->get_allocation_from_allocation_id($allocation_id['allocation_id']);
		}
		$this->load->view('template/header');
		$this->load->view('cpscoping/kpi_calculation',$data);
		$this->load->view('template/footer');
	}

	public function kpi_insert($prjct_id,$cmpny_id,$flow_id,$flow_type_id,$prcss_id){
		$this->form_validation->set_rules('benchmark_kpi', 'Benchmark Kpi', 'trim|xss_clean');
		$this->form_validation->set_rules('best_practice', 'Best Practice', 'trim|xss_clean');

		$allocation_ids = $this->cpscoping_model->get_allocation_id_from_ids($cmpny_id,$prjct_id);

		if ($this->form_validation->run() !== FALSE){
			$benchmark_kpi = $this->input->post('benchmark_kpi');
			$best_practice = $this->input->post('best_practice');

			foreach ($allocation_ids as $allo_id) {
				$query = $this->cpscoping_model->get_allocation_from_allocation_id($allo_id['allocation_id']);
				if($query['flow_id'] == $flow_id && $query['flow_type_id'] == $flow_type_id && $query['prcss_id'] == $prcss_id){
					$insert_array = array(
				      'benchmark_kpi' => $benchmark_kpi,
				      'best_practice' => $best_practice
				    );
				    $this->cpscoping_model->kpi_insert($insert_array,$allo_id['allocation_id']);
				}
			}
		}

		foreach ($allocation_ids as $allocation_id) {
			$data['kpi_values'][] = $this->cpscoping_model->get_allocation_from_allocation_id($allocation_id['allocation_id']);
		}
		$data['cp_files'] = $this->cpscoping_model->get_cp_scoping_files($prjct_id,$cmpny_id);

		$this->load->view('template/header');
		$this->load->view('cpscoping/kpi_calculation',$data);
		$this->load->view('template/footer');
	}
}