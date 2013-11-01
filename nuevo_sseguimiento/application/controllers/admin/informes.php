<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
        
class Informes extends CI_Controller {
    
    private $error;  

    public function __construct()
    {                                                                                                                     
        parent::__construct();          
        $this->load->library('layout','layout_main');                                  
        $this->load->model('admin/informes_model'); 
        $this->acceso();                                                                        
    }                                         

    public function acceso()
    {                                                        
        if(!$this->accesos->acceso())
        {                                 
            redirect('acceso/login');           
        }                                                                                                   
    }                                                       		

    public function show()
    {                                                                                                                                  
        $this->layout->view('admin/informes/show_informes'); 
    }                                                 

    public function jqGrid()
    {                                                                                                                                                                                                                                                   
        //obtener la página solicitada                          
        $page  = ($this->input->post('page'))?$this->input->post('page'):1;    
        //Número de fila que queremos obtener en el grid                
        $limit = ($this->input->post('rows'))?$this->input->post('rows'):5;                                
        //el campo para ordenar                                                                                                                                                                                            
        $sidx  = ($this->input->post('sidx'))?$this->input->post('sidx'):'id_preinscrito';                         
        //obtiene la dirección                                                                                                              
        $sord  = ($this->input->post('sord'))?$this->input->post('sord'):'desc';                         
                                                        
        $user_uuid = $this->session->userdata('user_uuid');                                                          
                
        if($this->input->post("_search") == "false")
        { 
            if($this->accesos->admin())
            {                                         
                $total_informes = $this->informes_model->total_informes_admin();
            }else{                          
                $total_informes = $this->informes_model->total_informes($user_uuid);
            }
        }                       
        else            
        {                                                          
            $searchOper   = $this->input->post('searchOper');
            $searchField  = $this->input->post('searchField');
            $searchString = $this->input->post('searchString');

            $where = search($searchOper,$searchField,$searchString); 
            if($this->accesos->admin())
            {                              
                $total_informes = $this->informes_model->total_search_informes_admin($where)->total;     
            }else{                                                                                                                
                $total_informes = $this->informes_model->total_search_informes($where,$user_uuid)->total;     
            }
        }                                                                                   

        $total_pages = total_pages($total_informes,$limit);                                                                                                                                                                

        if($page>$total_pages)
        {                               
            $page  = $total_pages;                         
        }                                     

        $start = ($limit * $page) - $limit;               
        $start = ($start>0)?$start:0; 
                                                            
        if($this->input->post("_search") == "false")
        {   
            if($this->accesos->admin())
            {
                $informes = $this->informes_model->show_informes_admin($start,$limit,$sidx,$sord);                                                                                                                                                          
            }else{                                                                                                                                                                              
                $informes = $this->informes_model->show_informes($user_uuid,$start,$limit,$sidx,$sord);                                                                                                                                                          
            }
        }       
        else
        {                                                                                                                                
            if($this->accesos->admin())
            {       
                $informes = $this->informes_model->search_informes_admin($where,$start,$limit,$sidx,$sord);
            }else{
                $informes = $this->informes_model->search_informes($where,$user_uuid,$start,$limit,$sidx,$sord);
            }               
        }                                                                                                                                                                                                                                                                                        

        $data = new stdClass();                 
        $data->pages   = $page;
        $data->total   = $total_pages;
        $data->records = $total_informes;
        
        if(!empty($informes))      
        {                                                                                                                                                                                                                                                                                                                                                            
            foreach($informes as $key => $informe){               
                $data->rows[$key]['id']   = $informe->id_preinscrito;                                                                                                   
                $data->rows[$key]['cell'] = array($informe->nombre,$informe->a_paterno,$informe->a_materno,$informe->program_name,$informe->fecha_registro,$informe->atendido,'eliminar');
            }                                                                        
        }                     
        else
        {
            $data->msg = msj('No existen registros.','message');                                                                   
        }          
                                                                                                                                                                                                              
        echo json_encode($data);                                                                                                     
    }

    public function informes_contacto($id_preinscrito = NULL)
    {
        $data['msj'] = $this->session->flashdata('msj');                                                                
        $data['preinscrito'] = $this->informes_model->get_contacto($id_preinscrito);
                                     
        if(empty($data['preinscrito']))                                                     
        {                                                                                        
            $data['msj'] = 'No existen comentarios.';                                                                                 
            $this->load->view('admin/msj',$data); 
            return false;                                      
        }                                                                                 

        $this->load->view('admin/informes/informes_contacto',$data);     
    }                                  

}    