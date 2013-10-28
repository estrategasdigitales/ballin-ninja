<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		
class Login extends CI_Controller {
															
	public function __construct(){						
		parent::__construct();						
		$this->load->model('admin/users_model');
	}     								                                                                                                  					

    public function index(){
        $this->acceso();
    }                   							

	public function acceso(){						
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username','Usernamme','required');
        $this->form_validation->set_rules('pass', 'Password', 'required');   

        if($this->form_validation->run() == FALSE)        
        {						
			$this->load->view('acceso/login');    

        }else{              				    												
 
            $username = $this->input->post('username',TRUE);             
            $pass     = $this->input->post('pass',TRUE);         

            if($user = $this->users_model->acceso($username,$pass)) 
            {                                                                                                                                 					

                $sesion = array('username'  => $username,
                                'nombre'    => $user->nombre,
                                'user_uuid' => $user->user_uuid);							

                $this->session->set_userdata($sesion);
                redirect('admin/users/show','refresh');

            }else{                                                                      				  

                $this->session->destroy();
                $data = array('error'=>'Login y password erroneos');  
                $this->load->view('acceso/login',$data);                  
            }                      
        }									        
	}                  																
}