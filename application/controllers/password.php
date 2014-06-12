<?php
class Password extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('password_model');
		$this->load->library('form_validation');
	}	

	public function change_pass(){

		$this->form_validation->set_rules('old_pass', 'Old Password', 'trim|xss_clean|required');
		$this->form_validation->set_rules('new_pass', 'New Password', 'trim|xss_clean|required|callback_password_check');
		$this->form_validation->set_rules('new_pass_again', 'New Password Again', 'trim|xss_clean|required');

		if ($this->form_validation->run() !== FALSE){
			
			$old_pass = $this->input->post('old_pass');
			$new_pass = $this->input->post('new_pass');

			$tmp = $this->session->userdata('user_in');
			$user_id = $tmp['id'];
			
			if($this->password_model->do_similar_pass($user_id,md5($old_pass)) == true){
				$data = array(
						'psswrd' => md5($new_pass)
					);
				$this->password_model->change_pass($user_id,$data);
			}

			$messasge = 'Sifreniz degistirildi. Yeni şifreniz: '.$new_pass;
			$email = $this->password_model->get_email($user_id);
			$this->sendMAil($messasge,$email['email']);
			redirect('change_pass','refresh');
		}
		$this->load->view('template/header');
		$this->load->view('password/change_pass');
		$this->load->view('template/footer');
	}

	public function sendMail($messasge,$email)
	{
		$config = Array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'ssl://smtp.googlemail.com',
		  'smtp_port' => 465,
		  'smtp_user' => 'ostimteknoloji@gmail.com', // change it to yours
		  'smtp_pass' => 'ostim321', // change it to yours
		  'mailtype' => 'html',
		  'charset' => 'iso-8859-1',
		  'wordwrap' => TRUE
		);

		$message = '';
        $this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from('ostimteknoloji@gmail.com'); // change it to yours
		$this->email->to($email);// change it to yours
		$this->email->subject('Bilgilendirme!');
		$this->email->message($messasge);
		if($this->email->send())
		{
			echo 'Email sent.';
		}
		else
		{
			echo 'olmadi';
			exit();
		}
	}

	public function password_check(){
		if($this->input->post('new_pass') == $this->input->post('new_pass_again')){
			return true;
		}
		else{
			$this->form_validation->set_message('password_check','Passwords aren\'t same.');
			return false;
		}
	}
}
?>

