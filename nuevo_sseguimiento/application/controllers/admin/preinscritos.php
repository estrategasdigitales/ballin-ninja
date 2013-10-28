<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
        
class Preinscritos extends CI_Controller {
    
    private $error;                                                                                             
                        
    public function __construct()
    {                                                                                                                     
        parent::__construct();          
        $this->load->library('layout','layout_main');                                  
        $this->load->model('admin/preinscritos_model');
       	$this->session();                                                                       
   }																								        					

    public function session()
    {           
        $this->load->library('status');
		$controller = $this->uri->segment(2);
     	if(!$this->status->acceso($controller)){
			  redirect('acceso/login');     		
     	}												   				
    }    			
	
	                                                                                                                                          
    public function show()
    {                                 
        $user_uuid = $this->session->userdata('user_uuid');             		                                                                
        $total_preinscritos = $this->preinscritos_model->total_preinscritos($user_uuid);
        						
        if(empty($total_preinscritos))
        {                                        
            $data['msj'] = 'No existen preinscritos.';                                                                                 
            $this->layout->view('admin/msj',$data);  
        }               
        else
        {                                                                                                                                                                      
            $data['msj'] = $this->session->flashdata('msj');                                                                                 
            $this->layout->view('admin/preinscritos/show_preinscritos',$data); 
        }                                                                    
    }               		    		                                                                                                       
	
						
    public function jqGrid()
    {          							                                                                                                                                                                                                              
        //obtener la página solicitada                          
        $page = ($this->input->post('page'))?$this->input->post('page'):1;    
        //Número de fila que queremos obtener en el grid                
        $limit = ($this->input->post('rows'))?$this->input->post('rows'):5;                                
        //el campo para ordenar                                                                                                                                                                                       
        $sidx  = ($this->input->post('sidx'))?$this->input->post('sidx'):'id_preinscrito';                         
        //obtiene la dirección                         		                           		      	                                              
        $sord  = ($this->input->post('sord'))?$this->input->post('sord'):'desc';                         
       	 										                                                
        if($this->input->post("_search")=="false")
        { 		
            $total_preinscritos = $this->preinscritos_model->total_preinscritos($this->session->userdata('user_uuid'));
        }else
        {
            $searchOper   = $this->input->post('searchOper');
            $searchField  = $this->input->post('searchField');
            $searchString = $this->input->post('searchString');
							                        
            $where = search($searchOper,$searchField,$searchString);   						                                                                                       
            $total_preinscritos = $this->preinscritos_model->total_search_preinscritos($where,$this->session->userdata('user_uuid'))->total;     
        }				                                                                            

        $total_pages = total_pages($total_preinscritos,$limit);                                                                                                                                                                

        if($page>$total_pages)
        {                               
            $page = $total_pages;                         
        }           				                          

        $start = ($limit * $page) - $limit;               
        $start = ($start>0)?$start:0; 
                                                            
        if($this->input->post("_search") == "false")
        {									                                                                                                     		
            $preinscritos = $this->preinscritos_model->show_preinscritos($this->session->userdata('user_uuid'),$start,$limit,$sidx,$sord);                                                                                                                                                          
        
        }else{		 

            $searchOper   = $this->input->post('searchOper');
            $searchField  = $this->input->post('searchField');
            $searchString = $this->input->post('searchString');

            $where = search($searchOper,$searchField,$searchString);                           
            $preinscritos = $this->preinscritos_model->search_preinscritos($where,$this->session->userdata('user_uuid'),$start,$limit,$sidx,$sord);
        }							                           	                                                                                                                                                                                                                                                             

        $data = new stdClass();                 
        $data->pages   = $page;
        $data->total   = $total_pages;
        $data->records = $total_preinscritos;
            
        if(!empty($preinscritos))
        {                                                                                                                                                                                                                                                                                                                                                                                                         
            foreach($preinscritos as $key => $preinscrito)
            {               
                $data->rows[$key]['id']   = $preinscrito->id_preinscrito;                                                                                                   
                $data->rows[$key]['cell'] = array($preinscrito->nombre,$preinscrito->a_paterno,$preinscrito->a_materno,$preinscrito->program_name,$preinscrito->fecha_registro,$preinscrito->primer_contacto,$preinscrito->documentos,$preinscrito->envio_decse,$preinscrito->envio_claves,$preinscrito->pago_realizado,'eliminar');
            }  										                                                            
						
        }else{                                                                         
            $data->msg = msj('No existen registros.','message');                                                                   
        }                                                                                                                                                                                                
        echo json_encode($data);                                                                                                     
    }                                        
					
    public function delete_preinscrito()
    {                      
        $id_preinscrito = $this->input->post('id');
        $preinscrito = $this->preinscritos_model->checar_existe($id_preinscrito); 
        if(empty($preinscrito))                                    
        {                                                                                                                      
            echo json_encode(array('success'=>false,'message'=>msj('El registro no existe.','error')));
        }else{                                                              

            if($this->preinscritos_model->delete_preinscrito($id_preinscrito))
            {                                                   
                echo json_encode(array('success'=>true,'message'=>msj('El registro se eliminó correctamente','message')));
            }                                                                       
        }   
    }                                       

    public function edit()
    {                                                                               
        $id_preinscrito = $this->input->post('id_preinscrito');            
        $preinscrito = $this->preinscritos_model->get_preinscrito($id_preinscrito);
        
        if(!empty($preinscrito))
        {                                     
            echo json_encode(array('success'=>true,'msg'=>$preinscrito));    
        }                              
    }                   

    public function detalle($id_preinscrito = NULL)
    {                                               
        $data['msj'] = $this->session->flashdata('msj');                                                                
        $data['preinscrito'] = $this->preinscritos_model->get_preinscrito($id_preinscrito);
        $data['documentos'] = $this->preinscritos_model->get_documentos($id_preinscrito);
            
        if(empty($data['preinscrito']))                                                     
        {     
            $data['msj'] = 'El usuario no existe.';                                                                                 
            $this->layout->view('admin/msj',$data);  

        }else{              

            $this->load->view('admin/preinscritos/preinscrito_detalle',$data);    
        }                                                                                                                  
    }                                                          

    public function editar($id_preinscrito = NULL)
    {                                                                                            
        $preinscrito = $this->preinscritos_model->get_preinscrito($id_preinscrito);
                                        
        if(empty($preinscrito))
        {     
            $data['msj'] = 'El usuario no existe.';                                                                                 
            $this->layout->view('admin/msj',$data); 

        }else
        {                                                                                                 
            $data['id_preinscrito'] = $preinscrito->id_preinscrito; 
            $data['program_name'] = $preinscrito->program_name;    
            $data['nombre'] = $preinscrito->nombre; 
            $data['a_paterno'] = $preinscrito->a_paterno; 
            $data['a_materno'] = $preinscrito->a_materno;      
            $data['fecha_registro'] = $preinscrito->fecha_registro; 
            $data['calle_numero'] = $preinscrito->calle_numero; 
            $data['del_mpo'] = $preinscrito->del_mpo; 
            $data['cp'] = $preinscrito->cp; 
            $data['ciudad'] = $preinscrito->ciudad; 
            $data['estado'] = $preinscrito->estado; 
            $data['telefono'] = $preinscrito->telefono; 
            $data['celular'] = $preinscrito->celular; 
            $data['rfc'] = $preinscrito->rfc;       
            $data['correo'] = $preinscrito->correo;                 
            $data['institucion_estudios'] = $preinscrito->institucion_estudios; 
            $data['nacionalidad'] = $preinscrito->nacionalidad; 
            $data['grado_academico'] = $preinscrito->grado_academico; 
            $data['exalumno'] = $preinscrito->exalumno; 
            $data['como_se_entero'] = $preinscrito->como_se_entero; 
            $data['porque_la_ibero'] = $preinscrito->porque_la_ibero; 
            $data['empresa'] = $preinscrito->empresa; 
            $data['puesto'] = $preinscrito->puesto;                             
            $data['direccion_empresa'] = $preinscrito->direccion_empresa; 
            $data['telefono_empresa'] = $preinscrito->telefono_empresa; 

            $data['documentos'] = $preinscrito->documentos; 
            $data['envio_decse'] = $preinscrito->envio_decse; 
            $data['envio_claves'] = $preinscrito->envio_claves; 
            $data['pago_realizado'] = $preinscrito->pago_realizado; 

            $data['caso_cerrado'] = $preinscrito->caso_cerrado; 
            $data['caso_inconcluso'] = $preinscrito->caso_inconcluso;
            $data['informes'] = $preinscrito->informes;
            $data['atendido'] = $preinscrito->atendido;                 
                                                  
            $data['comentario_general'] = $preinscrito->comentario_general;

            $data['documentos'] = $this->preinscritos_model->get_documentos($id_preinscrito);

            $this->load->view('admin/preinscritos/preinscrito_editar',$data);    
        }                                                                                                                                               
    }  

    public function update()
    {                                              
        $this->load->library('form_validation');  

        $this->form_validation->set_rules('nombre','Nombre','required');
        $this->form_validation->set_rules('a_paterno','Apellido paterno','required');
        $this->form_validation->set_rules('a_materno','Apellido materno','required');
        $this->form_validation->set_rules('fecha_registro','Fecha de registro','required'); 
        $this->form_validation->set_rules('rfc','Rfc','required'); 
        $this->form_validation->set_rules('correo','Correo','required');                

        $data['id_preinscrito'] = $this->input->post('id_preinscrito',TRUE);    
        $data['nombre'] = $this->input->post('nombre',TRUE); 
        $data['a_paterno'] = $this->input->post('a_paterno',TRUE); 
        $data['a_materno'] = $this->input->post('a_materno',TRUE);      
        $data['fecha_registro'] = $this->input->post('fecha_registro',TRUE); 
        $data['calle_numero'] = $this->input->post('calle_numero',TRUE); 
        $data['del_mpo'] = $this->input->post('del_mpo',TRUE); 
        $data['cp'] = $this->input->post('cp',TRUE); 
        $data['ciudad'] = $this->input->post('ciudad',TRUE); 
        $data['estado'] = $this->input->post('estado',TRUE); 
        $data['telefono'] = $this->input->post('telefono',TRUE); 
        $data['celular'] = $this->input->post('celular',TRUE); 
        $data['rfc'] = $this->input->post('rfc',TRUE);       
        $data['correo'] = $this->input->post('correo',TRUE);                 
        $data['institucion_estudios'] = $this->input->post('institucion_estudios',TRUE); 
        $data['nacionalidad'] = $this->input->post('nacionalidad',TRUE); 
        $data['grado_academico'] = $this->input->post('grado_academico',TRUE); 
        $data['exalumno'] = $this->input->post('exalumno',TRUE); 
        $data['como_se_entero'] = $this->input->post('como_se_entero',TRUE); 
        $data['porque_la_ibero'] = $this->input->post('porque_la_ibero',TRUE); 
        $data['empresa'] = $this->input->post('empresa',TRUE); 
        $data['puesto'] = $this->input->post('puesto',TRUE);                 
        $data['direccion_empresa'] = $this->input->post('direccion_empresa',TRUE); 
        $data['telefono_empresa'] = $this->input->post('telefono_empresa',TRUE);

        $data['primer_contacto'] = $this->input->post('primer_contacto'); 
        $data['documentos'] = $this->input->post('documentos'); 
        $data['envio_decse'] = $this->input->post('envio_decse'); 
        $data['envio_claves'] = $this->input->post('envio_claves'); 
        $data['pago_realizado'] = $this->input->post('pago_realizado'); 

        $data['caso_cerrado'] = $this->input->post('caso_cerrado'); 
        $data['caso_inconcluso'] = $this->input->post('caso_inconcluso');
        $data['informes'] = $this->input->post('informes');
        $data['atendido'] = $this->input->post('atendido');   

        $data['comentario_general'] = $this->input->post('comentario_general',TRUE);                       

        $data['program_name'] = $this->preinscritos_model->get_program_name($data['id_preinscrito'])->program_name;                                                                                                      

        if($this->form_validation->run() == FALSE)        
        {                                                                            
            $this->load->view('admin/preinscritos/preinscrito_editar',$data);            

        }else{                                                                                                                          

            if(!empty($_FILES['documento_upload']['name']))
            {                               
                if(!$data['documento_upload'] = $this->upload($data['id_preinscrito'],$this->input->post('doc_type',TRUE)))
                {                                                                                                                                                                                                                                                                           
                    $data['msj']  = msj($this->error,'error');      
                    $this->load->view('admin/preinscritos/preinscrito_editar',$data);
                    return false;                      
                }                                   
            }else{                                                                                                                                      
                $data['documento_upload'] ='';           
            }                                                                                                                                                                                                                      

            if($this->preinscritos_model->update_preinscrito($data))
            {                                                                  
                $this->session->set_flashdata('msj',msj('El registro se modificó correctamente.','message'));                                    
                redirect('admin/preinscritos/detalle/'.$data['id_preinscrito']);
            }                                                             
        }                                                                                                                                     
    }             

    public function upload($id_preinscrito,$doc_type)
    {                                                                                                                                                                                                                                                                   
        $config['upload_path'] = FCPATH.'includes/admin/documentos';
        $config['allowed_types'] = 'doc|docx|xml|png|jpg';
        $config['max_size'] = '1024';                   
        $config['max_width']  = '1024';     
        $config['max_height']  = '768';
                                                                                                                           
        $this->load->library('upload', $config);

        $num_archivos = count($_FILES['documento_upload']['tmp_name']);

        if($num_archivos<=3)
        {                                                                          
            for($x=0;$x<$num_archivos;$x++)
            {                                                          

                if(!empty($doc_type[$x]))
                {               

                $file = uniqid(rand())."_".rand().".".$this->ext($_FILES['documento_upload']['name'][$x]);  

                $_FILES['userfile']['name']     = $file;
                $_FILES['userfile']['type']     = $_FILES['documento_upload']['type'][$x];
                $_FILES['userfile']['tmp_name'] = $_FILES['documento_upload']['tmp_name'][$x];
                $_FILES['userfile']['error']    = $_FILES['documento_upload']['error'][$x];
                $_FILES['userfile']['size']     = $_FILES['documento_upload']['size'][$x];
                                                                                                     

                    if(!$this->upload->do_upload())
                    {                                                              
                        $this->error = $this->upload->display_errors();
                        return false;       
                    }else{                                                                                                                                                                                                                                                                            
                        $archivos[] = array('id_preinscrito'=>$id_preinscrito,'doc_type'=>$doc_type[$x],'archivo'=>$file);
                    }                                                                                             

                }else{                 

                    $this->error = 'El campo tipo de documento no puede quedar vacío.';
                    return false;
                }                                                                                                                                                                                                                                                     
            }                                                         

        }else{                                    

            $this->error = 'Solo se pueden subir 3 archivos';
            return false;       
        }                                                                                                 
        return $archivos;                      
    }                                                     

    public function ext($file)
    {                                                               
        $ext   = explode('.',$file);
        $count = count($ext);
        return $ext[$count-1];
    }  


}    