<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
        
class Preinscritos extends CI_Controller {
    
    private $error;                                                                                             
                        
    public function __construct()
    {                                                                                                                                    
        parent::__construct();          
        $this->load->library('layout','layout_main');                                  
        $this->load->model('admin/preinscritos_model');
       	$this->acceso();                                                                   
    }                                                                                           

    public function show()
    {                                                                                                                                                      
        $this->layout->view('admin/preinscritos/show_preinscritos');                                                           
    }    

    public function excel()
    {                                                                   
        $this->load->helper('php-excel'); 
        $parametros = $this->input->get();            
        if($this->accesos->admin())
        {                                                                                        
        $preinscritos = $this->preinscritos_model->excel_admin($parametros['sidx'],$parametros['sord']);                                                                                                                                                          
        }else{                          
            $preinscritos = $this->preinscritos_model->excel($this->session->userdata('user_uuid'),$parametros['sidx'],$parametros['sord']);                                                                                                                                                          
        }                                                 
        $fields = (
            $field_array[] = array ('nombre','a_paterno','a_materno','fecha_registro','codigo','program_name','primer_contacto','documentos','envio_decse','envio_claves','pago_realizado')
        );                                      
        foreach ($preinscritos as $row)
        {                                                                 
        $data_array[] = array($row->nombre,$row->a_paterno,$row->a_materno,$row->fecha_registro,$row->codigo,$row->program_name,$row->primer_contacto,$row->documentos,$row->envio_decse,$row->envio_claves,$row->pago_realizado);
        }                           
        $xls = new Excel_XML;
        $xls->addArray ($field_array);
        $xls->addArray ($data_array);
        $xls->generateXML("output_name");                                       
    }                                                                                                     																								        					

    public function acceso()
    {                                                        
     	if(!$this->accesos->acceso())
        {                                 
			redirect('acceso/login');     		
     	}                                     												   				
    }       	                    		
	                                                                                                                                                        		    		                                                                                                       					
    public function jqGrid()
    {                     							                                                                                                                                                                                                              
        //obtener la página solicitada                          
        $page = ($this->input->post('page'))?$this->input->post('page'):1;    
        //Número de fila que queremos obtener en el grid                
        $limit = ($this->input->post('rows'))?$this->input->post('rows'):20;                                
        //el campo para ordenar                                                                                                                                                                                       
        $sidx  = ($this->input->post('sidx'))?$this->input->post('sidx'):'id_preinscrito';                         
        //obtiene la dirección                         		                           		      	                                              
        $sord  = ($this->input->post('sord'))?$this->input->post('sord'):'desc';                         
       	 					              					                                                
        if($this->input->post("_search")=="false")
        {                    	                     	
            if($this->accesos->admin())
            {                                            
                $total_preinscritos = $this->preinscritos_model->total_preinscritos_admin();
            }else{                
                $total_preinscritos = $this->preinscritos_model->total_preinscritos($this->session->userdata('user_uuid'));
            }                                                                                            
        }else
        {                                     
            $searchOper   = $this->input->post('searchOper');
            $searchField  = $this->input->post('searchField');
            $searchString = $this->input->post('searchString');
							                        
            $where = search($searchOper,$searchField,$searchString);

            if($this->accesos->admin())
            {                                                                   						                                                                                       
                $total_preinscritos = $this->preinscritos_model->total_search_preinscritos_admin($where)->total;     
            }else
            {                                 
                $total_preinscritos = $this->preinscritos_model->total_search_preinscritos($where,$this->session->userdata('user_uuid'))->total;     
            }                                        
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
            if($this->accesos->admin())
            {                                                        
                $preinscritos = $this->preinscritos_model->show_preinscritos_admin($start,$limit,$sidx,$sord);
                                                                                            
            }else{            

                $preinscritos = $this->preinscritos_model->show_preinscritos($this->session->userdata('user_uuid'),$start,$limit,$sidx,$sord);                                                                                                                                                          
            }

        }else{		        

            if($this->accesos->admin())
            {                                      
                $preinscritos = $this->preinscritos_model->search_preinscritos_admin($where,$start,$limit,$sidx,$sord);
            }else{                                                                                                                    
                $preinscritos = $this->preinscritos_model->search_preinscritos($where,$this->session->userdata('user_uuid'),$start,$limit,$sidx,$sord);
            }                                              
        }             							                           	                                                                                                                                                                                                                                                             

        $data = new stdClass();                 
        $data->pages   = $page;
        $data->total   = $total_pages;
        $data->records = $total_preinscritos;
            
        if(!empty($preinscritos))
        {                                                                                                                                                                                                                                                                                                                                                                                                                
            foreach($preinscritos as $key => $preinscrito)
            {                              					             																		                            				
                $primer_contacto = ( $primer_contacto = $this->get_comentario($preinscrito->id_preinscrito,1))?$primer_contacto:'';
                $documentos = ($documentos = $this->get_comentario($preinscrito->id_preinscrito,2))?$documentos :'';
                $envio_decse = ($envio_decse = $this->get_comentario($preinscrito->id_preinscrito,3))?$envio_decse:'';
                $envio_claves = ($envio_claves = $this->get_comentario($preinscrito->id_preinscrito,4))?$envio_claves:'';		
                $pago_realizado = ($pago_realizado = $this->get_comentario($preinscrito->id_preinscrito,5))?$pago_realizado:'';
															
                $data->rows[$key]['id']   = $preinscrito->id_preinscrito;                                                                                                   
                $data->rows[$key]['cell'] = array($preinscrito->nombre,$preinscrito->a_paterno,$preinscrito->a_materno,$preinscrito->program_name,$preinscrito->fecha_registro,$preinscrito->codigo,$preinscrito->primer_contacto.'|'.$primer_contacto,$preinscrito->documentos.'|'.$documentos,$preinscrito->envio_decse.'|'.$envio_decse,$preinscrito->envio_claves.'|'.$envio_claves,$preinscrito->pago_realizado.'|'.$pago_realizado,'eliminar');
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
        }
        else
        {                                                                             
            if($this->preinscritos_model->delete_preinscrito($id_preinscrito))
            {                                                   
                echo json_encode(array('success'=>true,'message'=>msj('El registro se eliminó correctamente','message')));
            }                                                                       
        }   
    }                                                                     

    public function detalle($id_preinscrito = NULL)
    {                                               
        $data['msj'] = $this->session->flashdata('msj');                                                                
        $data['preinscrito'] = $this->preinscritos_model->get_preinscrito($id_preinscrito);
        $data['archivos'] = $this->preinscritos_model->get_documentos($id_preinscrito);
                            
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

            $data['primer_contacto'] = $preinscrito->primer_contacto; 
            $data['documentos'] = $preinscrito->documentos; 
            $data['envio_decse'] = $preinscrito->envio_decse; 
            $data['envio_claves'] = $preinscrito->envio_claves; 
            $data['pago_realizado'] = $preinscrito->pago_realizado; 

            $data['caso_cerrado'] = $preinscrito->caso_cerrado; 
            $data['caso_inconcluso'] = $preinscrito->caso_inconcluso;
            $data['informes'] = $preinscrito->informes;
            $data['atendido'] = $preinscrito->atendido;                 
                                                                 
            $data['comentario_general'] = $preinscrito->comentario_general;

            $data['archivos'] = $this->preinscritos_model->get_documentos($id_preinscrito);

            $data['comment_primercontacto'] =  $this->get_comentario($id_preinscrito,1);
            $data['comment_documentos'] =  $this->get_comentario($id_preinscrito,2);
            $data['comment_decse'] =  $this->get_comentario($id_preinscrito,3);                  
            $data['comment_envioclaves'] =  $this->get_comentario($id_preinscrito,4);
            $data['comment_pagorealizado'] =  $this->get_comentario($id_preinscrito,5);

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

        $data['comment_primercontacto'] =  $this->input->post('comment_primercontacto');
        $data['comment_documentos'] =  $this->input->post('comment_documentos');
        $data['comment_decse'] =  $this->input->post('comment_decse');
        $data['comment_envioclaves'] =  $this->input->post('comment_envioclaves');
        $data['comment_pagorealizado'] =  $this->input->post('comment_pagorealizado');

        $data['caso_cerrado'] = $this->input->post('caso_cerrado'); 
        $data['caso_inconcluso'] = $this->input->post('caso_inconcluso');
        $data['informes'] = $this->input->post('informes');
        $data['atendido'] = $this->input->post('atendido'); 


        $data['comentario_general'] = $this->input->post('comentario_general',TRUE);                       

        $data['program_name'] = $this->preinscritos_model->get_program_name($data['id_preinscrito'])->program_name;                                                                                                      

        if($this->form_validation->run() === FALSE)        
        {                                                                                        
            $this->load->view('admin/preinscritos/preinscrito_editar',$data);            

        }else{                                                                                                                                                                  

            if(!empty($_FILES['documento_upload']['name'][0]) OR !empty($_FILES['documento_upload']['name'][1]) OR !empty($_FILES['documento_upload']['name'][2]))                             
            {                                                                                                                                                                       
                if(!$data['documento_upload'] = $this->upload($data['id_preinscrito'],$this->input->post('doc_type',TRUE)))
                {                                                                                                                                                                                                                                                                                                  
                    $data['msj']  = msj($this->error,'error');      
                    $this->load->view('admin/preinscritos/preinscrito_editar',$data);
                    return false;                      
                }                   
            }                                                                                

            if($id_comentario = $this->get_id_comentario($data['id_preinscrito'],1)){
                $data['comment_update'][] = array('id_comentario'=>$id_comentario,'comentario'=>$data['comment_primercontacto'],'fecha'=>date('Y-m-d'));      
            }else{                                                                                                                                                                                                               
                $data['comment_insert'][] = array('id_preinscrito'=>$data['id_preinscrito'],'id_paso'=>1,'comentario'=>$data['comment_primercontacto'],'fecha'=>date('Y-m-d'));      
            }                                                                                                                     

            if($id_comentario = $this->get_id_comentario($data['id_preinscrito'],2)){
                $data['comment_update'][] = array('id_comentario'=>$id_comentario,'comentario'=>$data['comment_documentos'],'fecha'=>date('Y-m-d'));      
            }else{                                                                                
                $data['comment_insert'][] = array('id_preinscrito'=>$data['id_preinscrito'],'id_paso'=>2,'comentario'=>$data['comment_documentos'],'fecha'=>date('Y-m-d'));      
            }

            if($id_comentario = $this->get_id_comentario($data['id_preinscrito'],3)){
                $data['comment_update'][] = array('id_comentario'=>$id_comentario,'comentario'=>$data['comment_decse'],'fecha'=>date('Y-m-d'));      
            }else{                  
                $data['comment_insert'][] = array('id_preinscrito'=>$data['id_preinscrito'],'id_paso'=>3,'comentario'=>$data['comment_decse'],'fecha'=>date('Y-m-d'));      
            }                                                                       

            if($id_comentario = $this->get_id_comentario($data['id_preinscrito'],4)){
                $data['comment_update'][] = array('id_comentario'=>$id_comentario,'comentario'=>$data['comment_envioclaves'],'fecha'=>date('Y-m-d'));      
            }else{                                                                      
                $data['comment_insert'][] = array('id_preinscrito'=>$data['id_preinscrito'],'id_paso'=>4,'comentario'=>$data['comment_envioclaves'],'fecha'=>date('Y-m-d'));      
            }                                                                                                                                                             

            if($id_comentario = $this->get_id_comentario($data['id_preinscrito'],5)){
                $data['comment_update'][] = array('id_comentario'=>$id_comentario,'comentario'=>$data['comment_pagorealizado'],'fecha'=>date('Y-m-d'));      
            }else{                                                
                $data['comment_insert'][] = array('id_preinscrito'=>$data['id_preinscrito'],'id_paso'=>5,'comentario'=>$data['comment_pagorealizado'],'fecha'=>date('Y-m-d'));      
            }                                           

            if($this->preinscritos_model->update_preinscrito($data))
            {                                                                                                              
                $this->session->set_flashdata('msj',msj('El registro se modificó correctamente.','message'));                                    
                redirect('admin/preinscritos/detalle/'.$data['id_preinscrito']);
            }                                                                                                   
        }                                                                                                                                     
    }           

    public function get_id_comentario($id_preinscrito,$id_paso)
    {                                                                                                                                                                                                                                              
        $comentario = $this->preinscritos_model->get_id_comentario($id_preinscrito,$id_paso);   
        if(!empty($comentario)){
            return $comentario->id_comentario;
        }                                                                                                                                                                          
        return FALSE;                                                                  
    }                                               

    public function get_comentario($id_preinscrito,$id_paso)
    {                                                                                                                                                                                                                                              
        $comentario = $this->preinscritos_model->get_comentario($id_preinscrito,$id_paso);   
        if(!empty($comentario)){
            return $comentario->comentario;
        }                                                                                                                                                           
        return FALSE;                                                            
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

                $file = uniqid(rand())."-".rand().".".$this->ext($_FILES['documento_upload']['name'][$x]);  

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

    private function ext($file)
    {                                                               
        $ext   = explode('.',$file);
        $count = count($ext);
        return $ext[$count-1];
    }        


}    