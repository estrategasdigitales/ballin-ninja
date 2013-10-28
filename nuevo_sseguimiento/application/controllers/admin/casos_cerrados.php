<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
        
class Casos_cerrados extends CI_Controller {
                    				                                                                
    public function __construct()
    {                                                                                                                                                                      
        parent::__construct();                
        $this->load->library('layout','layout_main');                                  
        $this->load->model('admin/casos_cerrados_model');
        if(!$this->session->userdata('username'))
        {                                                                                                                                                                                                                                                                                                                                               
            redirect(base_url('acceso/login'));                     
        }                                                                                                                         
    }                                                                                                                                                                         

    public function show()
    {                                                                                         
        $user_uuid = $this->session->userdata('user_uuid');                                                                             
        $total_casos_cerrados = $this->casos_cerrados_model->total_casos_cerrados($user_uuid);
        if(empty($total_casos_cerrados)){                                       
            $data['msj'] = 'No existen inscritos.';                                                                                 
            $this->layout->view('admin/msj',$data);  
        }else{                                                                                                                                                                                       
            $data['msj'] = $this->session->flashdata('msj');                                                                                 
            $this->layout->view('admin/casos_cerrados/show_casos_cerrados',$data); 
        }                                                                                                                                      
    }                                                                                                                                                      

    public function jqGrid()
    {                                                                                                                                                                                                                               
        //obtener la página solicitada                          
        $page  = ($this->input->post('page'))?$this->input->post('page'):1;    
        //Número de fila que queremos obtener en el grid                
        $limit = ($this->input->post('rows'))?$this->input->post('rows'):5;                                
        //el campo para ordenar                                                                                                                                                                                       
        $sidx  = ($this->input->post('sidx'))?$this->input->post('sidx'):'user_uuid';                         
        //obtiene la dirección                                                                                                        
        $sord  = ($this->input->post('sord'))?$this->input->post('sord'):'asc';                         
                                                        
        $user_uuid = $this->session->userdata('user_uuid');                                                          
        
        if($this->input->post("_search") == "false"){ 
            $total_casos_cerrados = $this->casos_cerrados_model->total_casos_cerrados($user_uuid);
        }else{              
            $searchOper   = $this->input->post('searchOper');
            $searchField  = $this->input->post('searchField');
            $searchString = $this->input->post('searchString');

            $where = search($searchOper,$searchField,$searchString);                                                                         
            $total_casos_cerrados = $this->casos_cerrados_model->total_search_casos_cerrados($where,$user_uuid)->total;     
        }                                                                                                                     

        $total_pages = total_pages($total_casos_cerrados,$limit);                                                                                                                                                                

        if($page>$total_pages){                               
            $page  = $total_pages;                         
        }                                     

        $start = ($limit * $page) - $limit;               		
        $start = ($start>0)?$start:0; 
                                                            
        if($this->input->post("_search") == "false")
        {                                                                                                                               
            $caso_cerrado = $this->casos_cerrados_model->show_casos_cerrados($user_uuid,$start,$limit,$sidx,$sord);                                                                                                                                                          
        }
        else
        {			                                                                                                                       
            $searchOper   = $this->input->post('searchOper');
            $searchField  = $this->input->post('searchField');
            $searchString = $this->input->post('searchString');

            $where = search($searchOper,$searchField,$searchString);
            $caso_cerrado = $this->casos_cerrados_model->search_caso_cerrado($where,$user_uuid,$start,$limit,$sidx,$sord);
        }						                                                                                                                                                                                                                                                                                                               

        $data = new stdClass();                 
        $data->pages   = $page;
        $data->total   = $total_pages;
        $data->records = $total_casos_cerrados;
                                
        if(!empty($caso_cerrado))
        {                                                                                                                                                                                                                                                                                                                                                                                                           
            foreach($caso_cerrado as $key => $c_cerrado){               
                $data->rows[$key]['id']   = $c_cerrado->id_preinscrito;                                                                                              														     
                $data->rows[$key]['cell'] = array($c_cerrado->nombre,$c_cerrado->a_paterno,$c_cerrado->a_materno,$c_cerrado->program_name,$c_cerrado->fecha_registro,$c_cerrado->primer_contacto,$c_cerrado->documentos,$c_cerrado->envio_decse,$c_cerrado->envio_claves,$c_cerrado->pago_realizado,'eliminar');
            }          									                                                                                             
        }else{                                                                                 
            $data->msg = msj('No existen registros.','message');                                                                   
        }                                                                                                                                                                                         
        echo json_encode($data);                                                                                                     
    }                                                 

    public function delete_caso_cerrado(){                      
        $id_preinscrito = $this->input->post('id');
        $caso_cerrado = $this->casos_cerrados_model->checar_existe($id_preinscrito); 
        if(empty($caso_cerrado))                                				    
        {                                                                                                                                                              
            echo json_encode(array('success'=>false,'message'=>msj('El registro no existe.','error')));
        }else{                                          

            if($this->casos_cerrados_model->delete_caso_cerrado($id_preinscrito))
            {                                                   
                echo json_encode(array('success'=>true,'message'=>msj('El registro se eliminó correctamente','message')));
            }                                                                       
        }   
    }                                                              
}    