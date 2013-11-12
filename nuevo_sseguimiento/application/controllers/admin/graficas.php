<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');      
		
class Graficas extends CI_Controller 
{		
    private $disciplinas;   
	               		                 			
    public function __construct()
    {                                                                                                                                                               
        parent::__construct();          
        $this->load->library('layout','layout_main');                                  
        $this->load->model('admin/graficas_model');
       	$this->acceso();     

        if($this->accesos->admin()){                                                          
            $this->disciplinas = $this->graficas_model->get_disciplinas_all();                                                                                                                                                        
        }else{                                                                                                                                                    
            $this->disciplinas = $this->graficas_model->get_disciplinas($this->session->userdata('user_uuid')); 
        }                                                                                                                                                             
    }                                                     

    public function acceso()
    {                                                              
        if(!$this->accesos->acceso()){                                 
            redirect('acceso/login');           
        }                                                                                                                                                          
    }														

    public function index()
    {	
    	$this->area();		 
    }                                                                                             																										

    public function area()
    {		          
        $this->layout->view('admin/graficas/show_graficas',array('disciplinas'=>$this->disciplinas)); 
    }                                                                                       	                  

    public function nacionalidad()
    {                                                                                                                                                           
        $this->layout->view('admin/graficas/nacionalidad',array('disciplinas'=>$this->disciplinas)); 
    }

    public function nivel_academico()
    {                          
        $this->layout->view('admin/graficas/nivel_academico',array('disciplinas'=>$this->disciplinas));         
    }                                                                   

    public function exalumno_ibero()
    {                          
        $this->layout->view('admin/graficas/exalumno',array('disciplinas'=>$this->disciplinas));         
    }                      

    public function como_se_entero()
    {                                                 
        $this->layout->view('admin/graficas/como_se_entero',array('disciplinas'=>$this->disciplinas));         
    }    

    public function status_proceso()
    {                                                                                                                                    
        $this->layout->view('admin/graficas/status_proceso',array('disciplinas'=>$this->disciplinas));         
    }                                                                                                             

    public function get_tipos_programas()
    {                                                                                         
        if(!$this->input->is_ajax_request()){               
            show_404(); 
        }                                                                        

        $id_discipline = $this->input->post('id_discipline'); 

        if($this->accesos->admin()){                             
            $data['tipos_programas'] = $this->graficas_model->get_tipos_programas_all($id_discipline);                                         
        }else{                                                                                                  
            $data['tipos_programas'] = $this->graficas_model->get_tipos_programas($this->session->userdata('user_uuid'),$id_discipline);                                         
        }                                                      

        if(!empty($data['tipos_programas'])){     
            $this->load->view('admin/users/tipos_programas_ax',$data);
        }else{                                                
            $this->load->view('admin/users/option_select',$data);
        }                                                                                        
    }        

    public function get_programas()
    {                                                                          
        if(!$this->input->is_ajax_request()){
            show_404();
        }                                                 
                                                                             
        $id_discipline = $this->input->post('id_discipline'); 
        $program_type  = $this->input->post('program_type');

        if($this->accesos->admin()){                         
            $data['programas'] = $this->graficas_model->get_programas_all($id_discipline,$program_type);
        }else{                                                                                 
            $data['programas'] = $this->graficas_model->get_programas($this->session->userdata('user_uuid'),$id_discipline,$program_type);
        }                                                                                                                                                                                                                                                           

        if(!empty($data['programas'])){     
            $this->load->view('admin/users/programas_ax',$data);
        }else{      
            $this->load->view('admin/users/option_select',$data);
        }                                                                                                                                                 
    }                                                                                                      									

    public function area_grafica()
    {		
        if(!$this->input->is_ajax_request()){               
            show_404(); 
        }                                                                                                     

        $id_discipline = $this->input->get('id_discipline'); 	
		$fecha_inicio  = $this->input->get('fecha_inicio');
		$fecha_fin 	   = $this->input->get('fecha_fin');
											
		$success = FALSE;		       
		$dis_pro = array();
		$total 	 = array();
																											
		if($fecha_inicio!=FALSE && $fecha_fin!=FALSE)
		{																	
			$fecha_inicio = new DateTime($fecha_inicio);
			$fecha_inicio = $fecha_inicio->format('Y-m-d');	
			$fecha_fin 	  = new DateTime($fecha_fin);
			$fecha_fin 	  = $fecha_fin->format('Y-m-d');								
		}																																																																			
																																																																																						
        if($id_discipline==0){
        																			
              	if($this->accesos->admin())
            	{
    				$disciplinas_graficas = $this->graficas_model->disciplinas_ad($fecha_inicio,$fecha_fin); 					
    			}else
                {                   										
    				$disciplinas_graficas = $this->graficas_model->disciplinas_us($this->session->userdata('user_uuid'),$fecha_inicio,$fecha_fin); 	
    			}                            																														  	                                                                 																	
               				
               	$title = "Disciplinas";
    										
    			if(!empty($disciplinas_graficas))
    			{																												 									
    	            foreach($disciplinas_graficas as $value) {      
    	               $dis_pro[] = $value->discipline;   
    	               $total[]   = (int)$value->total; 	             
    	            }                        					
    				$success = TRUE;
    			}								
																																							    										            						                    						                                                                                                                                                                                   								
		}else{
																																							
              	if($this->accesos->admin())
            	{																
    				$programas_grafica = $this->graficas_model->programas_ad($id_discipline,$fecha_inicio,$fecha_fin);         		
    			}else
                {                         	              																																													  	                                                                 																	
                	$programas_grafica = $this->graficas_model->programas_us($this->session->userdata('user_uuid'),$id_discipline,$fecha_inicio,$fecha_fin); 
    			}
    			
    			$title = "Programas";						
    																													
    			if(!empty($programas_grafica))							
    			{                    																				 									
    	            foreach($programas_grafica as $value){      
    	               $dis_pro[] = $value->program_name; 						  
    	               $total[]   = (int)$value->total; 	             
    	            }												
    				$success = TRUE;
    			}			                     																																																												    										            						                    						                                                                                                                                                                                   								
		}         																																						 										
  		echo json_encode(array('success' => $success,'title' => $title,'dis_pro'=>$dis_pro,'total'=>$total));                                          						
    }       

    public function nacionalidad_grafica()
    {                                           
        $id_discipline = $this->input->get('id_discipline'); 
        $program_type  = $this->input->get('program_type');  
        $id_program    = $this->input->get('id_program');         
        $fecha_inicio  = $this->input->get('fecha_inicio');
        $fecha_fin     = $this->input->get('fecha_fin');

        $success = FALSE;              
        $dis_pro = array();
        $total   = array();
                                                                                                            
        if($fecha_inicio!=FALSE && $fecha_fin!=FALSE)
        {                                                                   
            $fecha_inicio = new DateTime($fecha_inicio);
            $fecha_inicio = $fecha_inicio->format('Y-m-d'); 
            $fecha_fin    = new DateTime($fecha_fin);
            $fecha_fin    = $fecha_fin->format('Y-m-d');                                
        }                           

        if($this->accesos->admin())
        {                                                                                                                                                 
            $nacionalidad = $this->graficas_model->nacionalidad_ad($id_discipline,$program_type,$id_program,$fecha_inicio,$fecha_fin); 
        }else{                      
            $nacionalidad = $this->graficas_model->nacionalidad_us($this->session->userdata('user_uuid'),$id_discipline,$program_type,$id_program,$fecha_inicio,$fecha_fin); 
        }           
                
        $title = "Nacionalidad";                       
                                                                                                                        
        if(!empty($nacionalidad))                          
        {                                                                                                                                                       
            foreach($nacionalidad as $value){            
                $dis_pro[] = ($value->nacionalidad)?$value->nacionalidad:'No especificado';                         
                $total[]   = (int)$value->total;                                        
            }                                                                                                                                                                        
            $success = TRUE;
        }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
                                                                                                                                                                                                           
        echo json_encode(array('success' => $success,'title' => $title,'dis_pro'=>$dis_pro,'total'=>$total));       
    }        

    public function nivel_academico_grafica()
    {                                                              
        $id_discipline = $this->input->get('id_discipline'); 
        $program_type  = $this->input->get('program_type');  
        $id_program    = $this->input->get('id_program');         
        $fecha_inicio  = $this->input->get('fecha_inicio');
        $fecha_fin     = $this->input->get('fecha_fin');

        $success = FALSE;              
        $dis_pro = array();
        $total   = array();
                                                                                                            
        if($fecha_inicio!=FALSE && $fecha_fin!=FALSE)
        {                                                                   
            $fecha_inicio = new DateTime($fecha_inicio);
            $fecha_inicio = $fecha_inicio->format('Y-m-d'); 
            $fecha_fin    = new DateTime($fecha_fin);
            $fecha_fin    = $fecha_fin->format('Y-m-d');                                
        }      

        if($this->accesos->admin())
        {                                                                                                                                                                                                                           
            $nivel_academico = $this->graficas_model->nivel_academico_ad($id_discipline,$program_type,$id_program,$fecha_inicio,$fecha_fin); 
        }else{                                  
            $nivel_academico = $this->graficas_model->nivel_academico_us($this->session->userdata('user_uuid'),$id_discipline,$program_type,$id_program,$fecha_inicio,$fecha_fin); 
        }

        $title = "Nivel academico";                       
                                                                                                                                 
        if(!empty($nivel_academico))                          
        {                                                                                                                                                             
            foreach($nivel_academico as $value){            
                $dis_pro[] = ($value->grado_academico)?$value->grado_academico:'No especificado';                         
                $total[]   = (int)$value->total;                  
            }                                                                                                                                                                                      
            $success = TRUE;
        }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
        echo json_encode(array('success' => $success,'title' => $title,'dis_pro'=>$dis_pro,'total'=>$total));       
    }                                                                                                       

    public function exalumno_grafica()
    {                                                              
        $id_discipline = $this->input->get('id_discipline'); 
        $program_type  = $this->input->get('program_type');  
        $id_program    = $this->input->get('id_program');         
        $fecha_inicio  = $this->input->get('fecha_inicio');
        $fecha_fin     = $this->input->get('fecha_fin');

        $success = FALSE;              
        $dis_pro = array();
        $total   = array();
                                                                                                            
        if($fecha_inicio!=FALSE && $fecha_fin!=FALSE)
        {                                                                                  
            $fecha_inicio = new DateTime($fecha_inicio);
            $fecha_inicio = $fecha_inicio->format('Y-m-d'); 
            $fecha_fin    = new DateTime($fecha_fin);
            $fecha_fin    = $fecha_fin->format('Y-m-d');                                
        }                                      
        
        if($this->accesos->admin())
        {                                                                                                                                                                                                                           
            $exalumno = $this->graficas_model->exalumno_ad($id_discipline,$program_type,$id_program,$fecha_inicio,$fecha_fin); 
        }else{
            $exalumno = $this->graficas_model->exalumno_us($this->session->userdata('user_uuid'),$id_discipline,$program_type,$id_program,$fecha_inicio,$fecha_fin); 
        }                               


        $title = "Ex alumno";                                            
                                                                                                                                 
        if(!empty($exalumno))                          
        {                                                                                                                                                                                                                                       
            foreach($exalumno as $value){            
                $dis_pro[] = ($value->exalumno)?$value->exalumno:'No especificado';                         
                $total[]   = (int)$value->total;                                  
            }                                                                                                                                                                                                                                                    
            $success = TRUE;
        }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
        echo json_encode(array('success' => $success,'title' => $title,'dis_pro'=>$dis_pro,'total'=>$total));       
    } 

    public function se_entero_grafica()
    {                                                                                                            
        $id_discipline = $this->input->get('id_discipline'); 
        $program_type  = $this->input->get('program_type');  
        $id_program    = $this->input->get('id_program');         
        $fecha_inicio  = $this->input->get('fecha_inicio');
        $fecha_fin     = $this->input->get('fecha_fin');

        $success = FALSE;              
        $dis_pro = array();
        $total   = array();
                                                                                                            
        if($fecha_inicio!=FALSE && $fecha_fin!=FALSE)
        {                                                                                         
            $fecha_inicio = new DateTime($fecha_inicio);
            $fecha_inicio = $fecha_inicio->format('Y-m-d'); 
            $fecha_fin    = new DateTime($fecha_fin);
            $fecha_fin    = $fecha_fin->format('Y-m-d');                                
        }                                      
        
        if($this->accesos->admin())
        {                                                                                                                                                                                                                                                                                   
            $como_se_entero = $this->graficas_model->se_entero_ad($id_discipline,$program_type,$id_program,$fecha_inicio,$fecha_fin); 
        }else{
            $como_se_entero = $this->graficas_model->se_entero_us($this->session->userdata('user_uuid'),$id_discipline,$program_type,$id_program,$fecha_inicio,$fecha_fin); 
        }

        $title = "Ex alumno";                                            
                                                                                                                                 
        if(!empty($como_se_entero))                          
        {                                                                                                                                                                                                                                                                                                  
            foreach($como_se_entero as $value){                 
                $dis_pro[] = ($value->como_se_entero)?$value->como_se_entero:'No especificado';                         
                $total[]   = (int)$value->total;                                                
            }                                                                                                                                                                                                                                    
            $success = TRUE;
        }                              

        echo json_encode(array('success' => $success,'title' => $title,'dis_pro'=>$dis_pro,'total'=>$total));       
    }                

    public function status_proceso_grafica()
    {                                                                                                                                                                                                                                             
        $id_discipline = $this->input->get('id_discipline'); 
        $program_type  = $this->input->get('program_type');  
        $id_program    = $this->input->get('id_program');         
        $fecha_inicio  = $this->input->get('fecha_inicio');
        $fecha_fin     = $this->input->get('fecha_fin');

        $success = FALSE;              
        $dis_pro = array();
        $total   = array();
                                                                                                                                
        if($fecha_inicio!=FALSE && $fecha_fin!=FALSE)
        {                                                                                                                               
            $fecha_inicio = new DateTime($fecha_inicio);
            $fecha_inicio = $fecha_inicio->format('Y-m-d'); 
            $fecha_fin    = new DateTime($fecha_fin);
            $fecha_fin    = $fecha_fin->format('Y-m-d');                                
        }                                                                                      
        
        if($this->accesos->admin())
        {                                                                                                                                                                                                                                                                                                
            $status = $this->graficas_model->status_ad($id_discipline,$program_type,$id_program,$fecha_inicio,$fecha_fin); 
            $casos_abiertos = $this->graficas_model->casos_abiertos_ad($id_discipline,$program_type,$id_program,$fecha_inicio,$fecha_fin); 
            $casos_cerrados = $this->graficas_model->casos_cerrados_ad($id_discipline,$program_type,$id_program,$fecha_inicio,$fecha_fin); 
            $casos_inconclusos = $this->graficas_model->casos_inconclusos_ad($id_discipline,$program_type,$id_program,$fecha_inicio,$fecha_fin); 
                                                                                                                                                                                                 
        }else
        {                                                       
            $status = $this->graficas_model->status_us($this->session->userdata('user_uuid'),$id_discipline,$program_type,$id_program,$fecha_inicio,$fecha_fin); 
            $casos_abiertos = $this->graficas_model->casos_abiertos_us($this->session->userdata('user_uuid'),$id_discipline,$program_type,$id_program,$fecha_inicio,$fecha_fin); 
            $casos_cerrados = $this->graficas_model->casos_cerrados_us($this->session->userdata('user_uuid'),$id_discipline,$program_type,$id_program,$fecha_inicio,$fecha_fin); 
            $casos_inconclusos = $this->graficas_model->casos_inconclusos_us($this->session->userdata('user_uuid'),$id_discipline,$program_type,$id_program,$fecha_inicio,$fecha_fin); 
        }                                                                                                                                                                                                                                                                                                                                          
                                                                                                                                                         
        if(!empty($status))                          
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
            $dis_pro   = array('Preinscritos','Inscritos','Casos cerrados','Casos inconclusos','informes');                                              
            $total     = array((int)$status->preinscritos,(int)$status->inscritos,(int)$status->casos_cerrados,(int)$status->casos_inconclusos,(int)$status->informes);                      
            $title = "Estatus";              
            $success = TRUE;        
            $array_status['status'] = array('success' => $success,'title' => $title,'dis_pro'=>$dis_pro,'total'=>$total);
        }                                                                                                

        if(!empty($casos_abiertos))                          
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
            $dis_pro   = array('Primer contacto','Documentos','Enviar a decse','Envio de claves','Pago realizado','Informes');                                              
            $total     = array((int)$casos_abiertos->primer_contacto,(int)$casos_abiertos->documentos,(int)$casos_abiertos->envio_decse,(int)$casos_abiertos->envio_claves,(int)$casos_abiertos->pago_realizado,(int)$casos_abiertos->informes);                      
            $title = "Casos Abiertos";                                                                                       
            $success = TRUE;                                                                                                            
            $array_status['casos_abiertos'] = array('success' => $success,'title' => $title,'dis_pro'=>$dis_pro,'total'=>$total);
        }     

        if(!empty($casos_cerrados))                          
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
            $dis_pro   = array('Primer contacto','Documentos', 'Envio de claves');                                                    
            $total     = array((int)$casos_cerrados->primer_contacto,(int)$casos_cerrados->documentos,(int)$casos_cerrados->envio_claves);                      
            $title = "Casos Cerrados";                                                                                                                                
            $success = TRUE;                                                                                                                                    
            $array_status['casos_cerrados'] = array('success' => $success,'title' => $title,'dis_pro'=>$dis_pro,'total'=>$total);
        }                     

        if(!empty($casos_inconclusos))                          
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
            $dis_pro   = array('Primer contacto','Documentos', 'Envio de claves');                                                    
            $total     = array((int)$casos_inconclusos->primer_contacto,(int)$casos_inconclusos->documentos,(int)$casos_inconclusos->envio_claves);                      
            $title = "Casos Inconclusos";                                                                                                                                       
            $success = TRUE;                                                                                                                                                             
            $array_status['casos_inconclusos'] = array('success' => $success,'title' => $title,'dis_pro'=>$dis_pro,'total'=>$total);
        }                                                                                         
                                                                                                                                                                       
        echo json_encode($array_status);       
    }                    
}					
?>	    		