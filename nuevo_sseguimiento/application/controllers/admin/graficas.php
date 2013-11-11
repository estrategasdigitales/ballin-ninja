<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');      
		
class Graficas extends CI_Controller 
{		
    private $error;   
						
    public function __construct()
    {                                                                                                                                    
        parent::__construct();          
        $this->load->library('layout','layout_main');                                  
        $this->load->model('admin/graficas_model');
       	$this->acceso();                                                                   
    }                                   

    public function acceso()
    {                                                              
        if(!$this->accesos->acceso())
        {                                 
            redirect('acceso/login');           
        }                                                                                                                                                          
    }														

    public function index()
    {	
    	$this->show();		 
    }																										

    public function show()
    {
        $data['filtro'] = false;                                        
    	$user_uuid = $this->session->userdata('user_uuid');			
    	           
        if($this->accesos->admin())
        { 											
    		$data['disciplinas'] = $this->graficas_model->get_disciplinas_all();                                                                                                                                                        
        }else{																			
        	$data['disciplinas'] = $this->graficas_model->get_disciplinas($user_uuid); 
        }
        $this->layout->view('admin/graficas/show_graficas',$data); 
    }											

    public function get_programas_ax()
    {                                    
        if(!$this->input->is_ajax_request()){
            show_404();
        }               
                                                                             
        $id_discipline = $this->input->post('id_discipline'); 
        $program_type  = $this->input->post('program_type');
        $data['programas'] = $this->graficas_model->get_programas($id_discipline,$program_type);
                    
        if(!empty($data['programas']))              
        {     
            $this->load->view('admin/users/programas_ax',$data);
        }else{				                          
            $this->load->view('admin/users/option_select',$data);
        }			                                                                                                                                                 
    }                                                   

    public function get_tipos_programas_ax()
    {                  
        if(!$this->input->is_ajax_request()){               
            show_404(); 
        }	

        $data['tipos_programas'] = $this->graficas_model->get_tipos_programas();                                         
        $this->load->view('admin/users/tipos_programas_ax',$data);                         
    }

    public function area_programa()
    {																																												            		        
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
			}else{										
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
			}else{																																														  	                                                                 																	
            	$programas_grafica = $this->graficas_model->programas_us($this->session->userdata('user_uuid'),$id_discipline,$fecha_inicio,$fecha_fin); 
			}
			
			$title = "Programas";						
																													
			if(!empty($programas_grafica))							
			{																				 									
	            foreach($programas_grafica as $value) {      
	               $dis_pro[] = $value->program_name; 						  
	               $total[]   = (int)$value->total; 	             
	            }												
				$success = TRUE;
			}																																																															    										            						                    						                                                                                                                                                                                   								
		}																																						
 		 										
  		echo json_encode(array('success' => $success,'title' => $title,'dis_pro'=>$dis_pro,'total'=>$total));                                          						
    }                       				   				   
}					
?>	    		