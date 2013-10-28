<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
        
class Casos_inconclusos extends CI_Controller {
                                                                                         
    public function __construct()
    {                                                                                                                                                           
        parent::__construct();          
        $this->load->library('layout','layout_main');                                  
        $this->load->model('admin/casos_inconclusos_model');
        if(!$this->session->userdata('username'))
        {                                                                                                                                                                                                                                                                                                                                                                        
            redirect(base_url('acceso/login'));                     
        }                                                                 
    }                                                                                      

    public function show()
    {   													                                             
        $user_uuid = $this->session->userdata('user_uuid');                                                                             
        $total_casos_inconclusos = $this->casos_inconclusos_model->total_casos_inconclusos($user_uuid);
        if(empty($total_casos_inconclusos)){                           
            $data['msj'] = 'No existen preinscritos.';                                                                                 
            $this->layout->view('admin/msj',$data);  
        }else{                                                                                                                                                           
            $data['msj'] = $this->session->flashdata('msj');                                                                                 
            $this->layout->view('admin/casos_inconclusos/show_casos_inconclusos',$data); 
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
            $total_casos_inconclusos = $this->casos_inconclusos_model->total_casos_inconclusos($user_uuid);
        }else{      													
            $searchOper   = $this->input->post('searchOper');
            $searchField  = $this->input->post('searchField');
            $searchString = $this->input->post('searchString');

            $where = search($searchOper,$searchField,$searchString);                                                                         
            $total_casos_inconclusos = $this->casos_inconclusos_model->total_search_casos_inconclusos($where,$user_uuid)->total;     
        }                                                                                    

        $total_pages = total_pages($total_casos_inconclusos,$limit);                                                                                                                                                                

        if($page>$total_pages){                               
            $page  = $total_pages;                         
        }                                     

        $start = ($limit * $page) - $limit;               
        $start = ($start>0)?$start:0; 
                                                            
        if($this->input->post("_search") == "false")
        {                                                                                                     
            $casos_inconclusos = $this->casos_inconclusos_model->show_casos_inconclusos($user_uuid,$start,$limit,$sidx,$sord);                                                                                                                                                          
                                
        }else{                                                                                                                     
            $searchOper   = $this->input->post('searchOper');
            $searchField  = $this->input->post('searchField');
            $searchString = $this->input->post('searchString');

            $where = search($searchOper,$searchField,$searchString);
            $casos_inconclusos = $this->casos_inconclusos_model->search_casos_inconclusos($where,$user_uuid,$start,$limit,$sidx,$sord);
        }                                                                                                                                                                                                                                                                                                             

        $data = new stdClass();                 
        $data->pages   = $page;
        $data->total   = $total_pages;
        $data->records = $total_casos_inconclusos;
                                                                 
        if(!empty($casos_inconclusos))
        {                                                                                                                                                                                                                                                                                                                                                            
            foreach($casos_inconclusos as $key => $caso_inconcluso){               
                $data->rows[$key]['id']   = $caso_inconcluso->id_preinscrito;                                                                                                   
                $data->rows[$key]['cell'] = array($caso_inconcluso->nombre,$caso_inconcluso->a_paterno,$caso_inconcluso->a_materno,$caso_inconcluso->program_name,$caso_inconcluso->fecha_registro,$caso_inconcluso->primer_contacto,$caso_inconcluso->documentos,$caso_inconcluso->envio_decse,$caso_inconcluso->envio_claves,$caso_inconcluso->pago_realizado,'eliminar');
            }						

        }else{                                                                         
            $data->msg = msj('No existen registros.','message');    				    						                                                           
        }                                                                                                                                                                                                    
        echo json_encode($data);                                                                                                     
    }                                                               

    public function delete_preinscrito(){                      
        $id_preinscrito = $this->input->post('id');
        $preinscrito = $this->casos_inconclusos_model->checar_existe($id_preinscrito); 
        if(empty($preinscrito))                                    
        {                                                                                                                      
            echo json_encode(array('success'=>false,'message'=>msj('El registro no existe.','error')));
        }else{                        

            if($this->casos_inconclusos_model->delete_caso_inconcluso($id_preinscrito))
            {                                                   
                echo json_encode(array('success'=>true,'message'=>msj('El registro se eliminó correctamente','message')));
            }                                                                       		
        }   
    }                                                              
}    