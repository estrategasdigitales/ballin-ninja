<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
        
class Casos_inconclusos extends CI_Controller {
                                                                                         
    public function __construct()
    {                                                                                                                                                           
        parent::__construct();          
        $this->load->library('layout','layout_main');                                  
        $this->load->model('admin/casos_inconclusos_model');
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
        $data['filtro'] = false;                        													                                                                                                                          
        $this->layout->view('admin/casos_inconclusos/show_casos_inconclusos',$data);                                                                                       
    }                                                                                        

    public function jqGrid()
    {                                                                                                                                                                                                                                       
        //obtener la página solicitada                          
        $page  = ($this->input->post('page'))?$this->input->post('page'):1;    
        //Número de fila que queremos obtener en el grid                
        $limit = ($this->input->post('rows'))?$this->input->post('rows'):20;                                
        //el campo para ordenar                                                                                                                                                                                       
        $sidx  = ($this->input->post('sidx'))?$this->input->post('sidx'):'id_preinscrito';                         
        //obtiene la dirección                                                                                                        
        $sord  = ($this->input->post('sord'))?$this->input->post('sord'):'desc';                         
                                                                                               
        $user_uuid = $this->session->userdata('user_uuid');                                                          
                    
        if($this->input->post("_search") == "false")
        {                
            if($this->accesos->admin())
            {        
                $total_casos_inconclusos = $this->casos_inconclusos_model->total_casos_inconclusos_admin();
            }else{                                        
                $total_casos_inconclusos = $this->casos_inconclusos_model->total_casos_inconclusos($user_uuid);
            }
        }else
        {      													
            $searchOper   = $this->input->post('searchOper');
            $searchField  = $this->input->post('searchField');
            $searchString = $this->input->post('searchString');

            $where = search($searchOper,$searchField,$searchString); 
            if($this->accesos->admin())
            {                                                
                $total_casos_inconclusos = $this->casos_inconclusos_model->total_search_casos_inconclusos_admin($where)->total;     
            }else{                                                                              
                $total_casos_inconclusos = $this->casos_inconclusos_model->total_search_casos_inconclusos($where,$user_uuid)->total;     
            }
        }                                                                                                             

        $total_pages = total_pages($total_casos_inconclusos,$limit);                                                                                                                                                                

        if($page>$total_pages){                               
            $page  = $total_pages;                         
        }                                     

        $start = ($limit * $page) - $limit;               
        $start = ($start>0)?$start:0; 
                                                            
        if($this->input->post("_search") == "false")
        {     
            if($this->accesos->admin()){
                 $casos_inconclusos = $this->casos_inconclusos_model->show_casos_inconclusos_admin($start,$limit,$sidx,$sord);                                                                                                                                                          
            }else{                                                                                                                               
                $casos_inconclusos = $this->casos_inconclusos_model->show_casos_inconclusos($user_uuid,$start,$limit,$sidx,$sord);                                                                                                                                                          
            }                                           
        }else{                                                                                                                                                                                        
         
            if($this->accesos->admin()){
                $casos_inconclusos = $this->casos_inconclusos_model->search_casos_inconclusos_admin($where,$start,$limit,$sidx,$sord);
            }else{                                                     
                $casos_inconclusos = $this->casos_inconclusos_model->search_casos_inconclusos($where,$user_uuid,$start,$limit,$sidx,$sord);
            }                                             
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

    public function delete_preinscrito()
    {                                     
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

    public function excel()
    {                                                                                                                                                      
        $this->load->helper('php-excel'); 
        $file = 'Casos inconclusos-'.date('YmdHis');
        $data_array = array();                           
        $parametros = $this->input->get(); 

        if($parametros["_search"]=="true")
        {                                      
            $casos_inconclusos = search($parametros['searchOper'],$parametros['searchField'],$parametros['searchString']);   
        }                                                                                                                                                                                                     

        if($this->accesos->admin())
        {          
            if(!isset($search))
            {                                                                                                                                                                                                                            
                $casos_inconclusos = $this->casos_inconclusos_model->ex_admin($parametros['sidx'],$parametros['sord']);                                                                                                                                                          
            }else{                
                $casos_inconclusos = $this->casos_inconclusos_model->ex_admin_search($search,$parametros['sidx'],$parametros['sord']);                                                                                                                                                          
            }                                                                   

        }else{                               

            if(!isset($search))
            {                                                
                $casos_inconclusos = $this->casos_inconclusos_model->ex_user($this->session->userdata('user_uuid'),$parametros['sidx'],$parametros['sord']);                                                                                                                                                          
            }else{                                                                                                                       
                $casos_inconclusos = $this->casos_inconclusos_model->ex_user_search($search,$this->session->userdata('user_uuid'),$parametros['sidx'],$parametros['sord']);                                                                                                                                                          
            }                                                                              
        }                                                                                                

        $fields = (                                         
            $field_array[] = array ('Nombre','Apellido paterno','Apellido materno','Fecha de registro','Nombre del programa','Primer contacto','Documentos','Enviar a decse','Envio de claves','Pago realizado')
        );                                          

        if(!empty($casos_inconclusos))
        {                                              
            foreach ($casos_inconclusos as $row)
            {                                                                                                
                $row->primer_contacto = ($row->primer_contacto)?'Si':'No';
                $row->documentos      = ($row->documentos)?'Si':'No';
                $row->envio_decse     = ($row->envio_decse )?'Si':'No';
                $row->envio_claves    = ($row->envio_claves )?'Si':'No';
                $row->pago_realizado  = ($row->pago_realizado)?'Si':'No';                                                                     
                $data_array[] = array($row->nombre,$row->a_paterno,$row->a_materno,$row->fecha_registro,$row->program_name,$row->primer_contacto,$row->documentos,$row->envio_decse,$row->envio_claves,$row->pago_realizado);
            }                                      
        }                                                                                                                                                                                         

        $xls = new Excel_XML;
        $xls->addArray ($field_array);
        $xls->addArray ($data_array);
        $xls->generateXML($file);                                       
    }                                                                              
}    