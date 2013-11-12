<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Detalle_preinscrito
{

	function __construct()
    {               
        $this->CI =& get_instance();
        $this->CI->load->model('admin/preinscritos_model');
    }																																											

    function detalle($id_preinscrito)				
    {                                  							             
        $data['msj'] = $this->CI->session->flashdata('msj');                                                                
        $data['preinscrito'] = $this->CI->preinscritos_model->get_preinscrito($id_preinscrito);
        $data['archivos'] = $this->CI->preinscritos_model->get_documentos($id_preinscrito);
                            													
        if(empty($data['preinscrito']))                                                     
        {     
            $data['msj'] = 'El usuario no existe.';                                                                                 
            $this->CI->layout->view('admin/msj',$data);  

        }else{															                            

            $this->CI->load->view('admin/preinscritos/preinscrito_detalle',$data);    
        }                                                                                                                  
    }  

   	function editar($id_preinscrito = NULL)
    {									        
                                                                                                  
        $preinscrito = $this->CI->preinscritos_model->get_preinscrito($id_preinscrito);

        if(empty($preinscrito))
        {     
            $data['msj'] = 'El usuario no existe.';                                                                                 
            $this->CI->layout->view('admin/msj',$data); 

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

            $data['archivos'] = $this->CI->preinscritos_model->get_documentos($id_preinscrito);

            $data['comment_primercontacto'] =  $this->get_comentario($id_preinscrito,1);
            $data['comment_documentos'] =  $this->get_comentario($id_preinscrito,2);
            $data['comment_decse'] =  $this->get_comentario($id_preinscrito,3);                  
            $data['comment_envioclaves'] =  $this->get_comentario($id_preinscrito,4);
            $data['comment_pagorealizado'] =  $this->get_comentario($id_preinscrito,5);

            $this->CI->load->view('admin/preinscritos/preinscrito_editar',$data);    
        }                                                                                                                                                                             
    } 

    function update()
    {                                              
        $this->CI->load->library('form_validation');  

        $this->CI->form_validation->set_rules('nombre','Nombre','required');
        $this->CI->form_validation->set_rules('a_paterno','Apellido paterno','required');
        $this->CI->form_validation->set_rules('a_materno','Apellido materno','required');
        $this->CI->form_validation->set_rules('fecha_registro','Fecha de registro','required'); 
        $this->CI->form_validation->set_rules('rfc','Rfc','required'); 
        $this->CI->form_validation->set_rules('correo','Correo','required');                

        $data['id_preinscrito'] = $this->CI->input->post('id_preinscrito',TRUE);    
        $data['nombre'] = $this->CI->input->post('nombre',TRUE); 
        $data['a_paterno'] = $this->CI->input->post('a_paterno',TRUE); 
        $data['a_materno'] = $this->CI->input->post('a_materno',TRUE);      
        $data['fecha_registro'] = $this->CI->input->post('fecha_registro',TRUE); 
        $data['calle_numero'] = $this->CI->input->post('calle_numero',TRUE); 
        $data['del_mpo'] = $this->CI->input->post('del_mpo',TRUE); 
        $data['cp'] = $this->CI->input->post('cp',TRUE); 
        $data['ciudad'] = $this->CI->input->post('ciudad',TRUE); 
        $data['estado'] = $this->CI->input->post('estado',TRUE); 
        $data['telefono'] = $this->CI->input->post('telefono',TRUE); 
        $data['celular'] = $this->CI->input->post('celular',TRUE); 
        $data['rfc'] = $this->CI->input->post('rfc',TRUE);       
        $data['correo'] = $this->CI->input->post('correo',TRUE);                 
        $data['institucion_estudios'] = $this->CI->input->post('institucion_estudios',TRUE); 
        $data['nacionalidad'] = $this->CI->input->post('nacionalidad',TRUE); 
        $data['grado_academico'] = $this->CI->input->post('grado_academico',TRUE); 
        $data['exalumno'] = $this->CI->input->post('exalumno',TRUE); 
        $data['como_se_entero'] = $this->CI->input->post('como_se_entero',TRUE); 
        $data['porque_la_ibero'] = $this->CI->input->post('porque_la_ibero',TRUE); 
        $data['empresa'] = $this->CI->input->post('empresa',TRUE); 
        $data['puesto'] = $this->CI->input->post('puesto',TRUE);                 
        $data['direccion_empresa'] = $this->CI->input->post('direccion_empresa',TRUE); 
        $data['telefono_empresa'] = $this->CI->input->post('telefono_empresa',TRUE);

        $data['primer_contacto'] = $this->CI->input->post('primer_contacto'); 
        $data['documentos'] = $this->CI->input->post('documentos'); 
        $data['envio_decse'] = $this->CI->input->post('envio_decse'); 
        $data['envio_claves'] = $this->CI->input->post('envio_claves'); 
        $data['pago_realizado'] = $this->CI->input->post('pago_realizado'); 

        $data['comment_primercontacto'] =  $this->CI->input->post('comment_primercontacto');
        $data['comment_documentos'] =  $this->CI->input->post('comment_documentos');
        $data['comment_decse'] =  $this->CI->input->post('comment_decse');
        $data['comment_envioclaves'] =  $this->CI->input->post('comment_envioclaves');
        $data['comment_pagorealizado'] =  $this->CI->input->post('comment_pagorealizado');

        $data['caso_cerrado'] = $this->CI->input->post('caso_cerrado'); 
        $data['caso_inconcluso'] = $this->CI->input->post('caso_inconcluso');
        $data['informes'] = $this->CI->input->post('informes');
        $data['atendido'] = $this->CI->input->post('atendido'); 


        $data['comentario_general'] = $this->CI->input->post('comentario_general',TRUE);                       

        $data['program_name'] = $this->CI->preinscritos_model->get_program_name($data['id_preinscrito'])->program_name;                                                                                                      

        if($this->CI->form_validation->run() === FALSE)        
        {                                                                                        
            $this->CI->load->view('admin/preinscritos/preinscrito_editar',$data);            

        }else{                                                                                                                                                                  

            if(!empty($_FILES['documento_upload']['name'][0]) OR !empty($_FILES['documento_upload']['name'][1]) OR !empty($_FILES['documento_upload']['name'][2]))                             
            {                    					                                                                                                                                                   
                if(!$data['documento_upload'] = $this->upload($data['id_preinscrito'],$this->CI->input->post('doc_type',TRUE)))
                {                                                                                                                                                                                                                                                                                                                     
                    $data['msj']  = msj($this->error,'error');      
                    $this->CI->load->view('admin/preinscritos/preinscrito_editar',$data);
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

            if($this->CI->preinscritos_model->update_preinscrito($data))
            {						                                                                                                              
                $this->CI->session->set_flashdata('msj',msj('El registro se modificó correctamente.','message'));                                    
                redirect('admin/preinscritos/detalle/'.$data['id_preinscrito']);
            }      									                                                                                             
        }								                                                                                                                                     
    }					           

    function get_id_comentario($id_preinscrito,$id_paso)
    {                                                                                                                                                                                                                                              
        $comentario = $this->CI->preinscritos_model->get_id_comentario($id_preinscrito,$id_paso);   
        if(!empty($comentario)){
            return $comentario->id_comentario;
        }                 			                                                                                                                                                         
        return FALSE;                                                                  
    }                                               

   function get_comentario($id_preinscrito,$id_paso)
    {                                                                                                                                                                                                                                              
        $comentario = $this->CI->preinscritos_model->get_comentario($id_preinscrito,$id_paso);   
        if(!empty($comentario)){		
            return $comentario->comentario;
        }                                                                                                                                                           
        return FALSE;                                                            
    } 		           					                                                   

    function upload($id_preinscrito,$doc_type)
    {      					                                                                                                                                                                                                                                                                            
        $config['upload_path'] = FCPATH.'includes/admin/documentos';
        $config['allowed_types'] = 'doc|docx|xml|png|jpg';
        $config['max_size'] = '1024';                   
        $config['max_width']  = '1024';     
        $config['max_height']  = '768';
                                                                                                                           
        $this->CI->load->library('upload', $config);

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
                                                                                                     
                    if(!$this->CI->upload->do_upload())
                    {                                                                            
                        $this->error = $this->CI->upload->display_errors();
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

    function ext($file)
    { 		                                                               
        $ext   = explode('.',$file);
        $count = count($ext);
        return $ext[$count-1];
    }   			     
                					          	

}