<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
        
class Programas extends CI_Controller
{
	public function __construct()
    {					                                                                                                                                                 
        parent::__construct();  
        //$this->acceso();             
        $this->load->library('layout','layout_main');                                  
        $this->load->model('admin/programas_model');  				                                                    
    }

    public function get_tipos_programas_ax()
    {                  
        if(!$this->input->is_ajax_request()){               
            show_404(); 
        }                                             

        $id_discipline = $this->input->post('id_discipline'); 

        if($this->accesos->admin()){             
            $data['tipos_programas'] = $this->programas_model->get_tipos_programas_all($id_discipline);                                         
        }else{                                                                                                  
            $data['tipos_programas'] = $this->programas_model->get_tipos_programas($this->session->userdata('user_uuid'),$id_discipline);                                         
        }                                                                        
        $this->load->view('admin/users/tipos_programas_ax',$data);                         
    }                       			

    public function get_programas_ax()
    {                                    
        if(!$this->input->is_ajax_request()){
            show_404();
        }                          
                                                                             
        $id_discipline = $this->input->post('id_discipline'); 
        $program_type  = $this->input->post('program_type');

        if($this->accesos->admin()){                         
            $data['programas'] = $this->programas_model->get_programas_all($id_discipline,$program_type);
        }else{                                                                           
            $data['programas'] = $this->programas_model->get_programas($this->session->userdata('user_uuid'),$id_discipline,$program_type);
        }                                                                                                                                                            

        if(!empty($data['programas'])){     
            $this->load->view('admin/users/programas_ax',$data);
        }else{
            $this->load->view('admin/users/option_select',$data);
        }                                                                                                                                                 
    }                                                   			

}
?>