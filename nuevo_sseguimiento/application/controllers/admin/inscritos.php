<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
        
class Inscritos extends CI_Controller {
                                                                                    
    public function __construct()
    {                                                                                                                     
        parent::__construct();                
        $this->load->library('layout','layout_main');                                  
        $this->load->model('admin/inscritos_model');
        if(!$this->session->userdata('username'))
        {		                                                                                                                                                                                                                                                                                                                                        
            redirect(base_url('acceso/login'));                     
        }                                                                     
    }                                                                                                                

    public function show()
    {                                            
        $this->layout->view('admin/inscritos/show_inscritos');                                                                     
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
            $total_inscritos = $this->inscritos_model->total_inscritos($user_uuid);
        }else{
            $searchOper   = $this->input->post('searchOper');
            $searchField  = $this->input->post('searchField');
            $searchString = $this->input->post('searchString');

            $where = search($searchOper,$searchField,$searchString);                                                                         
            $total_inscritos = $this->inscritos_model->total_search_inscritos($where,$user_uuid)->total;     
        }                                                                                   

        $total_pages = total_pages($total_inscritos,$limit);                                                                                                                                                                

        if($page>$total_pages){                               
            $page  = $total_pages;                         
        }                                     

        $start = ($limit * $page) - $limit;               
        $start = ($start>0)?$start:0; 
                                                            
        if($this->input->post("_search") == "false")
        {                                                                                                     
            $inscritos = $this->inscritos_model->show_inscritos($user_uuid,$start,$limit,$sidx,$sord);                                                                                                                                                          
        }else{                                                                                                                     
            $searchOper   = $this->input->post('searchOper');
            $searchField  = $this->input->post('searchField');
            $searchString = $this->input->post('searchString');

            $where = search($searchOper,$searchField,$searchString);
            $inscritos = $this->inscritos_model->search_inscritos($where,$user_uuid,$start,$limit,$sidx,$sord);
        }                                                                                                                                                                                                                                                                                        

        $data = new stdClass();                 
        $data->pages   = $page;
        $data->total   = $total_pages;
        $data->records = $total_inscritos;
        
        if(!empty($inscritos))		
        {                                                                                                                                                                                                                                                                                                                                                            
            foreach($inscritos as $key => $inscrito){               
                $data->rows[$key]['id']   = $inscrito->id_preinscrito;                                                                                                   
                $data->rows[$key]['cell'] = array($inscrito->nombre,$inscrito->a_paterno,$inscrito->a_materno,$inscrito->program_name,$inscrito->fecha_registro,$inscrito->primer_contacto,$inscrito->documentos,$inscrito->envio_decse,$inscrito->envio_claves,$inscrito->pago_realizado,'eliminar');
            }      									                                                                                  					
        }else{										                                                                                 
            $data->msg = msj('No existen registros.','message');                                                                   
        }                                                                                                                                                                                         
        echo json_encode($data);                                                                                                     
    }                                                 

    public function delete_inscrito()
    {				                      
        $id_preinscrito = $this->input->post('id');
        $preinscrito = $this->inscritos_model->checar_existe($id_preinscrito); 
        if(empty($inscrito))                                    
        {                                                                                                                      
            echo json_encode(array('success'=>false,'message'=>msj('El registro no existe.','error')));
        }else{                        

            if($this->inscritos_model->delete_inscrito($id_preinscrito))
            {                                                   
                echo json_encode(array('success'=>true,'message'=>msj('El registro se eliminó correctamente','message')));
            }                                                                       
        }   
    }                                                              
}    