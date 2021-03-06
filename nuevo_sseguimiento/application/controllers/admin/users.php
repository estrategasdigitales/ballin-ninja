<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
        
class Users extends CI_Controller {
                                                                                    
    public function __construct()
    {					                                                                                                                                                 
        parent::__construct();  
        $this->acceso();             
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
                                                                                                              		                                 		        												                                                                                                                                                                                                                                                                                                                                                                                                                               
    public function index()
    {                                    
        $this->show();
    }	                                                                                                                                                                                                                                                 

    public function show()
    {                          
        $data['filtro'] = false;                                                                                                                                                                                                                                                         
        $this->layout->view('admin/users/show_users',$data);                                                                                                               
    }                                                                                          
                                                                                                                                                 
    public function jqGrid()    
    {                                                                                                                                                                                                         
        $page  = ($this->input->post('page'))?$this->input->post('page'):1;    
        $limit = ($this->input->post('rows'))?$this->input->post('rows'):20;                                
        $sidx  = ($this->input->post('sidx'))?$this->input->post('sidx'):'user_uuid';                         
        $sord  = ($this->input->post('sord'))?$this->input->post('sord'):'desc';                         
                                                                                                                                                             
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
                                                                                                
        if($this->input->post("_search") == "false")
        {
            $users = $this->users_model->show_users($start,$limit,$sidx,$sord);                                        
        }else
        {                                                                                                                              
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
                $data->rows[$key]['cell'] = array($user->username,$user->rol,img('includes/admin/images/application_edit.png'),$user->notificacion,$user->activo,"<a href='delete/$user->user_uuid'>".img('includes/admin/images/delete.png')."</a>");
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
        $user      = $this->users_model->get_nombre_user($user_uuid);
                                                                               
        if($this->users_model->update_notificacion($user_uuid,$value))
        {                                                                                                                                                                                                        
            $msj = ($value == 1)?'El usuario '.$user->username.' recibirá notificaciones.':'El usuario '.$user->username.' dejará de recibir notificaciones.';                                                                                                                          
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

        if($user_uuid == $this->session->userdata('user_uuid'))
        {           
            echo json_encode(array('success'=>false,'message'=>msj('Imposible eliminarte.','error')));
            return false;                   
        }                                                                                                                                      

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

    public function get_programas()
    {                                    
        if(!$this->input->is_ajax_request()){
            show_404();
        }                                                        
                                                               
        $id_discipline = $this->input->post('id_discipline',true); 
        $data['programas'] = $this->users_model->get_programas($id_discipline);
                                                                                                          
        if(!empty($data['programas']))
        {     
            $response  = '';                                                                 
            $response .= '<option value="0">Selecciona un programa</option>';                                                                               
                                                                                                                                                                
            foreach($data['programas'] as $value){                                                                                  

                if($value->program_type=='diplomado'){
                    $diplomado[]= '<option value="'.$value->id_program.'">'.$value->program_name.'</option>'; 
                }           

                if($value->program_type=='curso'){
                    $curso[]= '<option value="'.$value->id_program.'">'.$value->program_name.'</option>'; 
                }   

                if($value->program_type=='programa'){
                    $programa[]= '<option value="'.$value->id_program.'">'.$value->program_name.'</option>'; 
                }    

                if($value->program_type=='programahp'){                   
                    $programahp[]= '<option value="'.$value->id_program.'">'.$value->program_name.'</option>'; 
                }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
            }                                                                                                    

            if(isset($diplomado))
            {                                                                                                                                                       
                $response.= '<option value="0" disabled="disabled">-----DIPLOMADO---</option>';   
                $response.= implode(' ',$diplomado);                    
            }               

            if(isset($curso))
            {                                                                   
                $response.= '<option value="0" disabled="disabled">-----CURSO---</option>';   
                $response.= implode(' ',$curso);                    
            }                   

            if(isset($programa))
            {                                                                   
                $response.= '<option value="0" disabled="disabled">-----PROGRAMA---</option>';    
                $response.= implode(' ',$programa);                 
            }                                       

            if(isset($programahp))
            {                                                                                                                                       
                $response.= '<option value="0" disabled="disabled">-----PROGRAMAS HP---</option>';    
                $response.= implode(' ',$programahp);                   
            }                                                                                                                                

            $response .= '</select>';

            echo $response;                      

        }else{                          
            $this->load->view('admin/users/option_select',$data);
        }                                                                                                                                                 
    }                                                   

    public function get_tipos_programas_ax()
    {                  
        if(!$this->input->is_ajax_request()){               
            show_404(); 
        }

        $data['tipos_programas'] = $this->users_model->get_tipos_programas();  
        if(!empty($data['tipos_programas'])){                                                
            $this->load->view('admin/users/tipos_programas_ax',$data); 
        }else{
            $this->load->view('admin/users/option_select',$data);
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
        $this->form_validation->set_rules('users_programas','Agregar Programas','callback_programas_val['.$this->input->post('tipo').']');
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
        $data['tipos']       = $this->users_model->users_roles(); 
        $data['disciplinas'] = $this->users_model->get_disciplinas();                                    

        if($this->form_validation->run() == FALSE)        
        {                                                                             
            if(!$this->input->post()){       
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
            $programas = $this->input->post('users_programas',true);                                               
            $data['users_programas'] = json_decode($programas);   
                                    
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
            echo json_encode(array('success'=>true,'msg'=>msj('El programa se eliminó correctamente','message')));
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
        $programas = $this->input->post('users_programas',true); 
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

    public function excel()
    {                                                                                                                              
        $this->load->helper('php-excel');
        $file = 'Usuarios-'.date('YmdHis');
        $data_array = array();                    
        $parametros = $this->input->get();                    
        
        if($parametros['_search']=='true')      
        {                                                                                                                
            $search = search($parametros['searchOper'],$parametros['searchField'],$parametros['searchString']); 
            $users  = $this->users_model->excel_search($search,$parametros['sidx'],$parametros['sord']);              
                
        }else{                                                                                      
            $users  = $this->users_model->excel($parametros['sidx'],$parametros['sord']); 
        }                                                                                                                                                                                                                                                                                                                                   
                        
        $fields = (                                                         
            $field_array[] = array('Nombre','Notificación de correo','Estatus','Rol')
        );                                                                                                                                    

        if(!empty($users))
        {                   
            foreach($users as $key => $row)
            {                                                                                                                                         
                $row->notificacion = ($row->notificacion)?'Si':'No';
                $row->activo       = ($row->activo)?'Activo':'Inactivo';                    

                $data_array[] = array($row->nombre,$row->notificacion,$row->activo,$row->rol);
            }                                                        
        }                                                                                                                 

        $xls = new Excel_XML;
        $xls->addArray($field_array);
        $xls->addArray($data_array);                                   
        $xls->generateXML($file);                                      
    }                                                                                                                                                               
                                                                                                                                                                                                                                                              
}