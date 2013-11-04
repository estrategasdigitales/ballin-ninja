<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
        
class Users extends CI_Controller {
                                                                                    
    public function __construct()
    {					                                                                                                                                                 
        parent::__construct();  
        //$this->acceso();             
        $this->load->library('layout','layout_main');                                  
        $this->load->model('admin/users_model');  				                                                    
    }                                    			                   	                                                                                                                                                                                                                          
											
    private function acceso()
    {                           		                      
        if(!$this->accesos->acceso())
        {                                                                                            
              redirect('admin/no_acceso');             
        }                                                                                                                                             
    }  
	
	public function exportar(){
		//$parametros = $this->input->get();			
		//print_r($parametros);												
		//echo $parametros['rows'];	
																	
		 // Load libreria							
		$this->load->library('PHPExcel/Classes/PHPExcel');
		                      
		// Setiar la solapa que queda actia al abrir el excel
		$this->phpexcel->setActiveSheetIndex(0);
		// Solapa excel para trabajar con PHP         
		$sheet = $this->phpexcel->getActiveSheet();									
		$sheet->setTitle("Titulo Demo Pestana");												
		$sheet->getColumnDimension('A')->setWidth(20);
		$sheet->setCellValue('A1','Nombre');
		$sheet->setCellValue('B1','Apellido');					
		$sheet->setCellValue('A2','Pepe Luis');
		$sheet->setCellValue('B2','Gomez');
		$sheet->setCellValue('A3','Alejandro');
		$sheet->setCellValue('B3','Mandre');                         
		// Salida                                                                                                                     					      
		header("Content-Type: application/vnd.ms-excel, charset=utf-8");
		/*$nombreArchivo = 'export_lisatdo_'.date('YmdHis');
		header("Content-Disposition: attachment; filename=\"$nombreArchivo.xls\"");
		header("Cache-Control: max-age=0");		*/																											
		//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="pruebas.xls"');                                               
header('Cache-Control: max-age=0');                                 
        // Genera Excel                                             							                                   			       			     
		$writer = PHPExcel_IOFactory::createWriter($this->phpexcel, "Excel5");
		// Escribir												
		$writer->save('php://output');			
		exit;										
	}								

	public function excel()
	{							       									
		$this->load->helper('php-excel'); 
        $parametros = $this->input->get();            
                                                                                      
        $users_excel = $this->users_model->users_excel($parametros['sidx'],$parametros['sord']);                          
                        
        $fields = (
            $field_array[] = array ("nombre", "Notificacion", "Activo","Rol")
        );                                      
        foreach ($users_excel as $row)
        {
        $data_array[] = array($row->nombre,$row->notificacion,$row->activo,$row->rol);
        }                           
        $xls = new Excel_XML;
        $xls->addArray ($field_array);
        $xls->addArray ($data_array);
        $xls->generateXML("output_name");                         				
    }                                                                                                          		                                 		        												       
                                                                                                                                                                                                                                                                                                                                                                                                                                     
    public function index()
    {                                    
        $this->show();
    }	                                                                                                                                                                                                                                                 

    public function show()
    {                                                                                                                                                                                                     
        $this->layout->view('admin/users/show_users');                                                                                                               
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
                                                                                                                                     
        if($this->input->post("_search") == "false")
        {                                         
           
           $total_users = $this->users_model->total_users();

        }else{                                                                                       
            $searchOper   = $this->input->post('searchOper');
            $searchField  = $this->input->post('searchField');
            $searchString = $this->input->post('searchString');

            $where = search($searchOper,$searchField,$searchString);                                                                         
            $total_users = $this->users_model->total_search_users($where);                          
        }                                                                                                                                                                         
                                                                             
        $total_pages = total_pages($total_users,$limit);                                                                                                                                                                                                   
                                                                                                                                                                
        if($page>$total_pages){              
            $page = $total_pages;                         
        }                          

        $start = ($limit * $page) - $limit;               
        $start = ($start>0)?$start:0; 
                                                                                                
        if($this->input->post("_search") == "false"){                                                             
            $users = $this->users_model->show_users($start,$limit,$sidx,$sord);                                        
        }else{                                                                                                               
            $users = $this->users_model->search_users($where,$start,$limit,$sidx,$sord);
        }                                                                                                                                                                                                                                  

        $data = new stdClass();                 
        $data->pages   = $page;
        $data->total   = $total_pages;
        $data->records = $total_users;
             
        if(!empty($users))
        {                                                                                                                                                                                                                                                             
            foreach($users as $key => $user){               
                $data->rows[$key]['id']   = $user->user_uuid;                                                                                                   
                $data->rows[$key]['cell'] = array($user->nombre,$user->rol,img('includes/admin/images/application_edit.png'),$user->notificacion,$user->activo,"<a href='delete/$user->user_uuid'>".img('includes/admin/images/delete.png')."</a>");
            }       
        }else{                                                                                                    
            $data->msg = msj('No existen registros.','message');                                                                 
        }                                                                                                                                                                                    

        echo json_encode($data);                                                                                                     
    }                                                                                                                                                                                                                                                                                                                                                                                                                                       

    public function update_notificacion()
    {       
        $user_uuid = $this->input->post('user_uuid');
        $value     = $this->input->post('value');
        $user = $this->users_model->get_nombre_user($user_uuid);
                                           
        if($this->users_model->update_notificacion($user_uuid,$value))
        {                                                                                                                                                                                           
            $msj = ($value == 1)?'El usuario '.$user->nombre.' recibirá notificaciones.':'El usuario '.$user->nombre.' dejará de recibir notificaciones.';                                                                                                                          
            echo json_encode(array('success'=>true,'message'=>msj($msj,'message')));   
        }                                                                                                            
    }                                                          

    public function update_activo()
    {                                                     
        $user_uuid = $this->input->post('user_uuid');
        $value     = $this->input->post('value');
        if($this->users_model->update_activo($user_uuid,$value))
        {                                                                                                                                        
            echo json_encode(array('success'=>true,'message'=>msj('El registro se actualizó correctamente','message')));   
        }                                                                                              
    }                                                                 

    public function delete()
    {               
        $user_uuid = $this->input->post('id');
        $user = $this->users_model->checar_existe($user_uuid);                                                     
        if(empty($user))
        {                                                   
            echo json_encode(array('success'=>false,'message'=>msj('El usuario no existe.','error')));
        }
        else
        {          
            if($this->users_model->delete_user($user_uuid))
            {                                 
                echo json_encode(array('success'=>true,'message'=>msj('El registro se eliminó correctamente','message')));
            }                                                  
        }                                                                                                                                                                                                             
    }                                              

    public function get_programas_ax()
    {                                    
        if(!$this->input->is_ajax_request())
        {
            show_404();
        }
        else
        {                                                                          
            $id_discipline = $this->input->post('id_discipline'); 
            $program_type  = $this->input->post('program_type');
            $data['programas'] = $this->users_model->get_programas($id_discipline,$program_type);
                    
            if(!empty($data['programas'])){     
                $this->load->view('admin/users/programas_ax',$data);
            }else{                          
                $this->load->view('admin/users/option_select',$data);
            }                                                                                      
        }                                                            
    }                                                   

    public function get_tipos_programas_ax()
    {                  
        if(!$this->input->is_ajax_request())
        {               
            show_404(); 

        }else{

            $data['tipos_programas'] = $this->users_model->get_tipos_programas();                                         
            $this->load->view('admin/users/tipos_programas_ax',$data);
        }                            
    }                                                     

    public function add()
    {                                                                       
        $this->load->library('form_validation');  
                                                                                                                                                       
        $this->form_validation->set_rules('tipo','Tipo de usuario','required|callback_tipo_usuario_check');                                                                                   
        $this->form_validation->set_rules('username','Username','required|callback_login_check');       
        $this->form_validation->set_rules('pass','Password','required|matches[repass]');                           
        $this->form_validation->set_rules('repass','Confirmar Password','required');        
        $this->form_validation->set_rules('nombre','Nombre','required');                                                                               
        $this->form_validation->set_rules('a_paterno','Apellido paterno','required');   
        $this->form_validation->set_rules('a_materno','Apellido Materno');                    
        $this->form_validation->set_rules('descripcion','Descripción','required');                                       
        $this->form_validation->set_rules('email_1','Correo electronico principal','required|valid_email|callback_email_check['.$this->input->post('email_2').']');         
        $this->form_validation->set_rules('email_2','Correo electronico secundario','valid_email');                          
        $this->form_validation->set_rules('notificacion','Notificación');           
        $this->form_validation->set_rules('programas','Agregar Programas','callback_programas_val['.$this->input->post('tipo').']');
                                                                                                                                                                                                                                                                                                                                                                                                                                                       
        $data['tipos']       = $this->users_model->users_roles(); 
        $data['disciplinas'] = $this->users_model->get_disciplinas();                                    
                        
        if($this->form_validation->run() == FALSE)        
        {                                                                             
            if(!$this->input->post())
            {       
                $this->layout->view('admin/users/add_user',$data);
            }else{                                    
                echo json_encode(array("success" => false, "msg" => msj(validation_errors(),'error')));
            }                                                                                

        }else{                                                                            
                                                                                                                                                                                                                                                                 
            $data['username']  = $this->input->post('username',true);                     
            $data['pass']      = $this->input->post('pass',true);        
            $data['tipo']      = $this->input->post('tipo',true);        
            $data['nombre']    = $this->input->post('nombre',true);                                      
            $data['a_paterno'] = $this->input->post('a_paterno',true);
            $data['a_materno'] = $this->input->post('a_materno',true);
            $data['email_1']   = $this->input->post('email_1',true);
            $data['email_2']   = $this->input->post('email_2',true);
            $data['descripcion']   = $this->input->post('descripcion',true);
            $data['notificacion']  = $this->input->post('notificacion',true);
            $programas = $this->input->post('programas',true); 
            $data['programas'] = json_decode($programas);                         
                                
            if($user_uuid = $this->users_model->add_user($data))
            {                                                                                                                                                                                     
                $this->session->set_flashdata('msj',msj('El registro se agregó correctamente.','message'));                            
                echo json_encode(array("success" => true, "redirect" => base_url('admin/users/edit/'.$user_uuid))); 
            }                                                                                                                                                                                                                                                                                                                                                                                                                                            
        }                                                                              
    }                                                  

    public function delete_usuario_programa()
    {                         
        $id_usuario_programa = $this->input->post('id_usuario_programa'); 
        if($this->users_model->delete_usuario_programa($id_usuario_programa))
        {                          
            echo json_encode(array('success'=>true,'msg'=>'El programa se eliminó correctamente'));
        }                                    
    }                                          
                                                    
    public function login_check($str)
    {                                               
        $login = $this->users_model->login_check($str);                                     
        if(!empty($login))
        {                                                                                                                                  
            $this->form_validation->set_message('login_check', 'El login ingresado ya existe.');
            return FALSE;                                   
        }else{                                                                                                                    
            return TRUE;    
        }                                                                                                                                                           
    }   

    public function programas_val($str,$tipo_usuario)
    {                                                                                                  
        if($str==false && $tipo_usuario!=1)
        {                                                                                                                                                                                                                            
            $this->form_validation->set_message('programas_val', 'Debes agregar programas al usuario.');
            return FALSE;                                   
        }else{                  
            return TRUE;    
        }                                                                                                                                                                                 
    }                                                                        

    public function tipo_usuario_check($str)
    {                                                                                                                             
        if($str==0)
        {                                                                                                                                                                        
            $this->form_validation->set_message('tipo_usuario_check', 'El campo %s es obligatorio');
            return FALSE;                                   
        }else{                                                                                                                    
            return TRUE;    
        }                                                                                                                                                           
    }                                                                                   

    public function email_check($str1,$str2)
    {                                                                                                                 
        if($str1==$str2)                
        {                                                                                      
            $this->form_validation->set_message('email_check', 'El correo secundario no se puede repetir.');
            return FALSE;                                   
        }else{                                                                                                                                                 
            return TRUE;    
        }                                                                                                                                    
    }                                                                                                                                                                    

    public function edit($user_uuid)
    {                                                                                                                                                  
        $user = $this->users_model->get_user($user_uuid);
        $data['usuarios_programas'] = $this->users_model->get_usuarios_programas($user_uuid);
        $data['tipos'] = $this->users_model->users_roles(); 
        $data['disciplinas'] = $this->users_model->get_disciplinas();                                    
                                                                                            
        if(empty($user))
        {                                                                                                                                
            $data['msj'] = msj('El usuario no existe.','error');
            $this->layout->view('admin/msj',$data);
                                
        }else{                                                                                                                                                                                                                          

            $data['tipo_selected']  = $user->tipo;
            $data['user_uuid'] = $user->user_uuid;
            $data['username']  = $user->username;
            $data['pass']      = $user->pass;
            $data['nombre']    = $user->nombre;
            $data['a_paterno'] = $user->a_paterno;
            $data['a_materno'] = $user->a_materno;
            $data['email_1']   = $user->email_1;
            $data['email_2']   = $user->email_2;
            $data['descripcion']   = $user->descripcion;
            $data['notificacion']  = $user->notificacion;

            $data['msj'] = $this->session->flashdata('msj');                
            $this->layout->view('admin/users/edit_user',$data);      
        }                                                                                                                                                                                                              
    }                                                               

    public function update()
    {                                                                                                                               
        $this->load->library('form_validation');

        $this->form_validation->set_rules('tipo','Tipo de usuario','required|callback_tipo_usuario_check');                                                                                   
        $this->form_validation->set_rules('username','Usernamme','required');
        $this->form_validation->set_rules('pass','Password','required|matches[repass]'); 
        $this->form_validation->set_rules('repass','Confirmar Password','required');        
        $this->form_validation->set_rules('nombre','Nombre','required');                                         
        $this->form_validation->set_rules('a_paterno','Apellido paterno','required');   
        $this->form_validation->set_rules('a_materno','Apellido Materno');   
        $this->form_validation->set_rules('descripcion','Descripción','required');                                                      
        $this->form_validation->set_rules('email_1','Correo electronico principal','required|valid_email|callback_email_check['.$this->input->post('email_2').']');         
        $this->form_validation->set_rules('email_2','Correo electronico secundario','valid_email');   
        $this->form_validation->set_rules('notificacion','Notificación'); 
                           

        $data['user_uuid'] = $this->input->post('user_uuid');       
        $data['username']  = $this->input->post('username',true);       
        $data['tipo']      = $this->input->post('tipo');        
        $data['pass']      = $this->input->post('pass');
        $data['nombre']    = $this->input->post('nombre',true);                 
        $data['a_paterno'] = $this->input->post('a_paterno',true);      
        $data['a_materno'] = $this->input->post('a_materno',true);
        $data['email_1']   = $this->input->post('email_1',true);
        $data['email_2']   = $this->input->post('email_2',true);
        $data['descripcion']   = $this->input->post('descripcion',true);
        $data['notificacion']  = $this->input->post('notificacion',true);
        $programas = $this->input->post('programas',true); 
        $data['programas'] = json_decode($programas);
                            
        if($this->form_validation->run() == FALSE)        
        {                                                                                          
            echo json_encode(array("success" => false, "msg" =>msj(validation_errors(),'error')));
        }else{                                                                                   

            if($this->users_model->update_user($data))
            {                                                                                      
                $this->session->set_flashdata('msj',msj('El registro se actualizó correctamente.','message'));                                   
                echo json_encode(array("success" => true, "redirect" => base_url('admin/users/edit/'.$data['user_uuid'])));
            }                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
        }                                                                                                                                                              
    }                                                                                                                               
                                                                                                                                                                                                                                                              
}