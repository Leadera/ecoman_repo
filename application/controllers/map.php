<?php
class Map extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	public function index(){   
            //print_r($this->session->userdata['user_in']);
            if(isset($this->session->userdata['user_in'])) {
               if(empty($this->session->userdata['user_in'])){
			redirect(base_url('login'),'refresh');
		} 
            } else {
                redirect(base_url('login'),'refresh');
            }
                
            /*if(isset($this->session->userdata['project_id'])) {
                if($this->session->userdata['project_id']==null || $this->session->userdata['project_id']==''){
                    redirect(base_url('projects'), 'refresh');
                }
            } else {
                redirect(base_url('projects'), 'refresh');
            }*/
            
            /*if(isset($this->session->userdata['user_in']['role_id'])) {
                if(($this->session->userdata['user_in']['role_id']==null || $this->session->userdata['user_in']['role_id']=='')
                         || $this->session->userdata['user_in']['role_id']!=1){
                       redirect(base_url('company'), 'refresh');
		}
            } else {
                //redirect(base_url('company'), 'refresh');
            }*/

            $this->load->view('template/header_map');
            $this->load->view('map/index');
            $this->load->view('template/footer_map');
	}
        
        public function mapHeader(){   
            //print_r($this->session->userdata['user_in']);
            if(isset($this->session->userdata['user_in'])) {
               if(empty($this->session->userdata['user_in'])){
			redirect(base_url('login'),'refresh');
				} 
            } else {
                redirect(base_url('login'),'refresh');
            }
                
            /*if(isset($this->session->userdata['project_id'])) {
                if($this->session->userdata['project_id']==null || $this->session->userdata['project_id']==''){
                    redirect(base_url('projects'), 'refresh');
                }
            } else {
                redirect(base_url('projects'), 'refresh');
            }*/
            
            /*if(isset($this->session->userdata['user_in']['role_id'])) {
                if(($this->session->userdata['user_in']['role_id']==null || $this->session->userdata['user_in']['role_id']=='')
                         || $this->session->userdata['user_in']['role_id']!=1){
                       redirect(base_url('company'), 'refresh');
				}
            } else {
                //redirect(base_url('company'), 'refresh');
            }*/

            $this->load->view('map/mapHeader');
           
	}

	
        
      
}