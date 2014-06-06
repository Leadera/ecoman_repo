<?php
class User extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('form_validation');

	}

	public function user_register(){
		

		//form kontroller
		$this->form_validation->set_rules('name','Name','trim|required|xss_clean	');
		$this->form_validation->set_rules('surname','Surname','trim|required|xss_clean');
		$this->form_validation->set_rules('jobTitle','Job Title','required|trim|xss_clean');
		$this->form_validation->set_rules('description','Description','trim|xss_clean');
		$this->form_validation->set_rules('email', 'e-mail' ,'trim|required|valid_email|is_unique[T_USER.email]');
		$this->form_validation->set_rules('cellPhone', 'Cell Phone Number', 'required|callback_alpha_dash_space|min_length[5]|xss_clean');
		$this->form_validation->set_rules('workPhone', 'Work Phone Number', 'required|callback_alpha_dash_space|min_length[5]|xss_clean');
		$this->form_validation->set_rules('fax', 'Fax Number', 'required|callback_alpha_dash_space|min_length[5]|xss_clean');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]|xss_clean|is_unique[T_USER.user_name]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|matches[rePassword]|trim|xss_clean');

		if ($this->form_validation->run() !== FALSE)
		{
			//inserting data to database
			$data = array(
				'name'=>$this->input->post('name'),
				'surname'=>$this->input->post('surname'),
				'title'=>$this->input->post('jobTitle'),
				'description'=>$this->input->post('description'),
				'email'=>$this->input->post('email'),
				'phone_num_1'=>$this->input->post('cellPhone'),
				'phone_num_2'=>$this->input->post('workPhone'),
				'fax_num'=>$this->input->post('fax'),
				'user_name'=>$this->input->post('username'),
				'psswrd'=>md5($this->input->post('password'))
				//'photo'=>$this->input->post('username').'.jpg'
			);
			$last_inserted_user_id = $this->user_model->create_user($data);


			//file properties
			$config['upload_path'] = './assets/user_pictures/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '5000';
			$config['file_name']	= $last_inserted_user_id.'.jpg';
			$this->load->library('upload', $config);

			//Resmi servera yükleme
			if (!$this->upload->do_upload())
			{
				print_r($this->upload->display_errors());
				exit;
			}

			//Yüklenen resmi boyutlandırma ve çevirme
			$config['image_library'] = 'gd2';
			$config['source_image']	= './assets/user_pictures/'.$last_inserted_user_id.'.jpg';
			$config['maintain_ratio'] = TRUE;
			$config['width']	 = 200;
			$config['height']	 = 200;
			$this->load->library('image_lib', $config);

			$this->image_lib->resize();


			$photo = array(
				'photo'=>$last_inserted_user_id.'.jpg'
			);
			$this->user_model->set_user_image($last_inserted_user_id,$photo);

			//process completed
			redirect('okoldu', 'refresh');
		}

		$this->load->view('template/header');
		$this->load->view('user/create_user');
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

	public function user_login(){
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|xss_clean|trim|callback_check_user');


		if ($this->form_validation->run() !== FALSE)
		{
			$username= $this->input->post('username');
			$password=md5($this->input->post('password'));
			$userInfo = $this->user_model->check_user($username,$password);

			//session ayaları ve atama
			$session_array= array(
				'id' => $userInfo['id'],
				'username' => $userInfo['user_name'],
				'email' => $userInfo['email']
				);
			$this->session->set_userdata('user_in',$session_array);

			//Redirect after login
			redirect('user/'.$username, 'refresh');
		}

		$this->load->view('template/header');
		$this->load->view('user/login_user');
		$this->load->view('template/footer');
	}

	public function check_user()
	{
		$username= $this->input->post('username');
		$password=md5($this->input->post('password'));
		$userInfo=$this->user_model->check_user($username,$password);

		if($userInfo!== FALSE){
			return true;
		}else{
			$this->form_validation->set_message('check_user', 'Şifre veya E-posta hatalı.');
			return false;
		}
	}

	public function user_profile($username){
		$data['userInfo']=$this->user_model->get_userinfo_by_username($username);
		$data['projects'] = $this->user_model->get_projects_from_userid($data['userInfo']['id']);
		$this->load->view('template/header');
		$this->load->view('user/profile',$data);
		$this->load->view('template/footer');
	}

	public function user_logout(){
		$this->session->sess_destroy();
		redirect('', 'refresh');
	}

	// Database de kayıtlı olan user kullanıcısının bilgilerini view sayfasına gönderiliyor
	// User önceden hangi bilgileri girdigini unutmus ise hatırlatma amaclida kullanilir
	public function user_profile_update(){


		$data = $this->user_model->get_session_user();

		//form kontroller
		$this->form_validation->set_rules('name','Name','trim|required|xss_clean	');
		$this->form_validation->set_rules('surname','Surname','trim|required|xss_clean');
		$this->form_validation->set_rules('jobTitle','Job Title','required|trim|xss_clean');
		$this->form_validation->set_rules('description','Description','trim|xss_clean');
		$this->form_validation->set_rules('email', 'e-mail' ,'trim|required|valid_email|callback_email_check');
		$this->form_validation->set_rules('cellPhone', 'Cell Phone Number', 'required|callback_alpha_dash_space|min_length[11]|xss_clean');
		$this->form_validation->set_rules('workPhone', 'Work Phone Number', 'required|callback_alpha_dash_space|min_length[11]|xss_clean');
		$this->form_validation->set_rules('fax', 'Fax Number', 'required|callback_alpha_dash_space|min_length[11]|xss_clean');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]|xss_clean|callback_username_check');
		
		if ($this->form_validation->run() !== FALSE)
		{

			$update = array(
				'name'=>$this->input->post('name'),
				'surname'=>$this->input->post('surname'),
				'title'=>$this->input->post('jobTitle'),
				'description'=>$this->input->post('description'),
				'email'=>$this->input->post('email'),
				'phone_num_1'=>$this->input->post('cellPhone'),
				'phone_num_2'=>$this->input->post('workPhone'),
				'fax_num'=>$this->input->post('fax'),
				'user_name'=>$this->input->post('username'),
				'psswrd'=>$data['psswrd']
			);

			$this->user_model->update_user($update);

			//file properties

			//@unlink('./assets/user_pictures/'.$data['photo']); //  silmeye gerek yok. overwrite true islemi bunu yapıyor zaten

			$config['upload_path'] = './assets/user_pictures/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '5000';
			$config['file_name']	= $data['photo'];
			$this->load->library('upload', $config);
			$this->upload->overwrite = true;

			//Resmi servera yükleme
			if (!$this->upload->do_upload())
			{
				//print_r($this->upload->display_errors());
				//hata vermeye gerek yok , resim secmeyebilir.
			}

			//Yüklenen resmi boyutlandırma ve çevirme
			$config['image_library'] = 'gd2';
			$config['source_image']	= './assets/user_pictures/'.$data['photo'];
			$config['maintain_ratio'] = TRUE;
			$config['width']	 = 200;
			$config['height']	 = 200;
			$this->load->library('image_lib', $config);

			$this->image_lib->resize();


			//session ayaları ve atama 
			//username ve email degistigi icin session tekrar olusturuluyor.
			$session_array= array(
				'id' => $data['id'],
				'username' => $update['user_name'],
				'email' => $update['email']
				);
			$this->session->set_userdata('user_in',$session_array);
			redirect('', 'refresh');
		}

		
		$this->load->view('template/header');
		$this->load->view('user/profile_update',$data);
		$this->load->view('template/footer');
	}

	function email_check(){
		$emailForm = $this->input->post('email'); // formdan gelen yeni girilen email

		$tmp = $this->session->userdata('user_in');
		$emailSession = $tmp['email']; // session'da tutulan önceki email, şuan database'de de bu var.
		$check_user_email = $this->user_model->check_user_email($emailForm);  // email varsa true , yoksa false
		if(($emailForm == $emailSession) || !$check_user_email ){
			return true;
		}
		else{
			$this->form_validation->set_message('email_check', 'Please provide an acceptable email address.');
			return false;
		} 

	}

	function username_check(){
		$usernameForm = $this->input->post('username'); // formdan gelen yeni girilen username

		$tmp = $this->session->userdata('user_in');
		$usernameSession = $tmp['username']; // session'da tutulan önceki username, şuan database'de de bu var.
		$check_username = $this->user_model->check_username($usernameForm);  // username varsa true , yoksa false
		if(($usernameForm == $usernameSession) || !$check_username ){
			return true;
		}
		else{
			$this->form_validation->set_message('username_check', 'Please provide an acceptable username.');
			return false;
		} 
	}

	public function become_consultant(){
		$tmp = $this->session->userdata('user_in');
		if(empty($tmp) || $this->user_model->is_user_consultant($tmp['id'])){
			redirect('', 'refresh');
		}
		else{
			$this->user_model->make_user_consultant($tmp['id'],$tmp['username']);
			redirect('user/'.$tmp['username'], 'refresh');
		}
	}

}
?>
