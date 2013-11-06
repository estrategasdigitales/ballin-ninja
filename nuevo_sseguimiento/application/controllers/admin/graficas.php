<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');      
		
class Graficas extends CI_Controller 
{		
    private $error;   

    public function __construct()
    {                                                                                                                                    
        parent::__construct();          
        $this->load->library('layout','layout_main');                                  
        $this->load->model('admin/graficas_model');
       	//$this->acceso();                                                                   
    }														

    public function index()
    {	
    	$this->show();		 
    }																										

    public function show()
    {
    	$user_uuid = $this->session->userdata('user_uuid');			
    	if($this->accesos->admin())
        { 											
    		$data['disciplinas'] = $this->graficas_model->get_disciplinas_all();                                                                                                                                                        
        }else{																			
        	$data['disciplinas'] = $this->graficas_model->get_disciplinas($user_uuid); 
        }
        $this->layout->view('admin/graficas/show_graficas',$data); 
    }											

    public function get_programas_ax()
    {                                    
        if(!$this->input->is_ajax_request())
        {
            show_404();
        }               
                                                                             
        $id_discipline = $this->input->post('id_discipline'); 
        $program_type  = $this->input->post('program_type');
        $data['programas'] = $this->graficas_model->get_programas($id_discipline,$program_type);
                    
        if(!empty($data['programas']))              
        {     
            $this->load->view('admin/users/programas_ax',$data);
        }else{                          
            $this->load->view('admin/users/option_select',$data);
        }			                                                                                                                                                 
    }                                                   

    public function get_tipos_programas_ax()
    {                  
        if(!$this->input->is_ajax_request())
        {               
            show_404(); 
        }	

        $data['tipos_programas'] = $this->graficas_model->get_tipos_programas();                                         
        $this->load->view('admin/users/tipos_programas_ax',$data);                         
    }				   				   
}					
?>	    		