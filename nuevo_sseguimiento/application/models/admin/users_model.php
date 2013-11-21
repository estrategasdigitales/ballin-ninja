<?php
    
class Users_model extends CI_Model
{                                          
    private $key = 'sistema_seguimiento';
                
    function __construct()
    {                                                                                  
        parent::__construct();
        $this->load->database();
    }                                                                                                                                                                                          

	/*                     
    public function acceso($username,$pass)
    {                          
        $this->db->select('usu.user_uuid,usu.nombre,usu.tipo,acc.users,acc.preinscritos,acc.inscritos,acc.casos_cerrados,acc.casos_inconclusos,acc.informes');               
        $this->db->from('seg_dec_usuarios as usu');                                   
        $this->db->join('seg_dec_accesos as acc','acc.id_role = usu.tipo', 'left');                                                 
        $this->db->where('usu.username', $username);                      
        $this->db->where("usu.pass", "AES_ENCRYPT('{$pass}','{$this->key}')",FALSE);
        $this->db->where('usu.activo', 1); 
        $query = $this->db->get();                                                                                          
        if ($query->num_rows()>0)                                                                                                                             
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
             return $query->row();                             
        }                                                                                                                                                                                                                                                                                                                 
        else
        {                                                                                                                                                                                 
            return FALSE;            
        }                                                                    
    }    
    */  
	
	public function acceso($username,$pass)
    {                                                                            							               
        $this->db->select('usu.user_uuid,usu.nombre,usu.tipo,acc.users,acc.preinscritos,acc.inscritos,acc.casos_cerrados,acc.casos_inconclusos,acc.informes,acc.graficas');               
        $this->db->from('seg_dec_usuarios as usu');                                   
        $this->db->join('seg_dec_accesos as acc','acc.id_role = usu.tipo', 'left');                                                 
        $this->db->where('usu.username',$username);					 		  																																						                   
        $this->db->where("AES_DECRYPT(usu.pass,'{$this->key}')",$pass);													
        $this->db->where('usu.activo', 1);																															 								
        $query = $this->db->get();                                                                                          
        if ($query->num_rows()>0)                                                                                                                             
        {       						              					 						       				  	                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
             return $query->row();                             
        }                                                                                                                                                                                                                                                                                                                                                       
        else
        {                                                                                                                                                                                 
            return FALSE;            
        }               		                                                                    
    }                        
	
    public function total_users()
    {                                                                                                                                                                                                          
        return  $this->db->count_all("seg_dec_usuarios");          
    }  

    public function total_search_users($search)
    {                                                                                                                                                                                                                                                                                                                               
        $query = $this->db->query("select COUNT(*) as total from seg_dec_usuarios 
                                   left join seg_dec_usuarios_roles on seg_dec_usuarios_roles.id_tipo=seg_dec_usuarios.tipo 
                                   ".$search."");                                                                             
        if ($query->num_rows()>0)                                                                                                                             
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
             return $query->row()->total;                             
        }                                                                                                                                                                                                                                                                                   
        else
        {                                                                                                                                                                              
            return FALSE;            
        }                                                      
    }                                                                                                                                                                                                                   
                                                       
    public function show_users($start,$limit,$sidx,$sord)
    {                                                                                                                                                                                                                                                  
        $this->db->select('u.user_uuid,u.nombre,u.notificacion,u.activo,ur.rol');               
        $this->db->from('seg_dec_usuarios as u');                                                                                                                                                                               
        $this->db->join('seg_dec_usuarios_roles as ur','ur.id_tipo = u.tipo', 'left');
        $this->db->order_by($sidx,$sord);   
        $this->db->limit($limit,$start);                                                                                                                                                                           
        $query = $this->db->get();
        if ($query->num_rows()>0)                                                                                                                             
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
            return $query->result();                             
        }                                                                                                                                                                                                                                                                                                                                    
        else
        {                                                                                                                                                                                     
            return FALSE;            
        }                                        
    }               

    public function get_disciplinas()
    {                                                    
        $this->db->select('id_discipline,discipline');               
        $query = $this->db->get('seg_dec_disciplinas');
        if ($query->num_rows()>0)                                                                                                                                    
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
             return $query->result();                             
        }                                                                                                                                                                                                                                                                                                                       
        else
        {                                                                                                                                                                                     
            return FALSE;            
        }                       
    }

    public function get_tipos_programas()
    {                                                                                                                                                                           
        $this->db->select('program_type,type');              
        $query = $this->db->get('seg_dec_programas_tipos');
        if ($query->num_rows()>0)                                                                                                                                           
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
             return $query->result();                             
        }                                                                                                                                                                                                                                                                                                                                 
        else
        {                                                                                                                                                                                                           
            return FALSE;            
        }                   
    }    

    public function get_programas($id_discipline,$program_type)
    {                                                                                                                                                                              
        $this->db->select('id_program,program_name'); 
        $this->db->where('id_discipline',$id_discipline); 
        $this->db->where('program_type',$program_type);             
        $query = $this->db->get('seg_dec_programas');
        if ($query->num_rows()>0)                                                                                                                                           
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
             return $query->result();                             
        }                                                                                                                                                                                                                                                                                                                     
        else
        {                                                                                                                                                                                                                          
            return FALSE;            
        }                                                                
    }  

    public function add_usuarios_programas($data){

        $this->db->insert_batch('seg_dec_usuarios_programas', $data);
    }                                                                  

    public function update_notificacion($user_uuid,$value)
    {       
        $this->db->set('notificacion',$value);
        $this->db->from('seg_dec_usuarios');
        $this->db->where('user_uuid',$user_uuid);
        return $this->db->update();
    }                                                                                                               

    public function update_activo($user_uuid,$value)
    {                                                                     
        $this->db->set('activo',$value);
        $this->db->from('seg_dec_usuarios');
        $this->db->where('user_uuid',$user_uuid);
        return $this->db->update();
    }   

    public function users_roles()
    {                                              
        $this->db->select('id_tipo,rol');
        $this->db->from('seg_dec_usuarios_roles');        
        $query = $this->db->get();                                
        return $query->result();    
    }                                                                                    

    public function search_users($search,$start,$limit,$sidx,$sord)
    {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
        $query = $this->db->query("select user_uuid,nombre,notificacion,activo,rol 
                                  from seg_dec_usuarios 
                                  left join seg_dec_usuarios_roles on seg_dec_usuarios_roles.id_tipo=seg_dec_usuarios.tipo 
                                  ".$search."                       
                                  order by ".$sidx." 
                                  ".$sord."                     
                                  limit ".$start.",".$limit."");                                                   
        if($query->num_rows()>0)                                                                                                                                                                
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
             return $query->result();                             
        }                                                                                                                                                                                                                                                                            
        else
        {                                                                                                                                                                                  
            return FALSE;            
        }                             
    }                                                                                               

    public function add_user($data)
    {                                          
        $this->db->trans_start();

        $this->db->set('user_uuid', 'UUID()', FALSE); 
        $this->db->set('tipo',$data['tipo']);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
        $this->db->set('username',$data['username']);
        $this->db->set('pass',"AES_ENCRYPT('{$data['pass']}','{$this->key}')",FALSE);                                      
        $this->db->set('nombre',$data['nombre']);                                           
        $this->db->set('a_paterno',$data['a_paterno']);                                    
        $this->db->set('a_materno',$data['a_materno']);                                    
        $this->db->set('email_1',$data['email_1']);                                    
        $this->db->set('email_2',$data['email_2']);                                    
        $this->db->set('descripcion',$data['descripcion']);                                    
        $this->db->set('notificacion',$data['notificacion']); 
        $this->db->set('activo',1);                                                                      
        $this->db->insert('seg_dec_usuarios');      
                                                                
        $user_uuid = $this->get_user_uuid($this->db->insert_id()); 
                
        $programas = $this->array_programas($user_uuid,$data['programas']); 
                      
        if(!empty($programas)){                       
            $this->db->insert_batch('seg_dec_usuarios_programas', $programas);                                                                                                 
        }                                                      

        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE)
        {                                                                                         
            return FALSE;
        }else
        {                                                                                               
            return $user_uuid; 
        }                                                                                                                          
    }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   

    public function array_programas($user_uuid,$programas)
    {                    
        if(!empty($programas)){                                                                                                                                                                                                                                                                         
            foreach($programas as $key => $value){
                        $data[] =array("user_uuid"=>$user_uuid,"id_discipline"=>$value->id_discipline,"id_program"=>$value->id_program);
            }                          
        }else{                            
            $data='';                   
        }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
        return $data;                                                                                                                                                                                                                                                                                                                                                             
    }                                         

    public function unico_usuario_programa($user_uuid,$id_discipline,$id_program)
    {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
        $this->db->select('id_usuario_programa');
        $this->db->from('seg_dec_usuarios_programas');                
        $this->db->where('user_uuid',$user_uuid); 
        $this->db->where('id_discipline',$id_discipline);
        $this->db->where('id_program',$id_program);
        $query = $this->db->get();                           
        if ($query->num_rows()>0)                                                                                         
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                            
             return $query->row();                             
        }                                                                                                                                                                                                                                                                    
        else
        {                                                                                                                                         
            return FALSE;            
        }                                                                                              
    }    

    public function update_user($data)
    {                           
        $this->db->trans_start();

        $this->db->set('tipo',$data['tipo']);                                                                                                                                                                                                                                                                                                               
        $this->db->set('username',$data['username']);
        $this->db->set('pass',"AES_ENCRYPT('{$data['pass']}','{$this->key}')",FALSE);                                      
        $this->db->set('nombre',$data['nombre']);                                           
        $this->db->set('a_paterno', $data['a_paterno']);                                    
        $this->db->set('a_materno', $data['a_materno']);                                    
        $this->db->set('email_1', $data['email_1']);                                    
        $this->db->set('email_2', $data['email_2']);                                    
        $this->db->set('descripcion', $data['descripcion']);                                    
        $this->db->set('notificacion', $data['notificacion']);
        $this->db->where('user_uuid', $data['user_uuid']);                                      
        $this->db->update('seg_dec_usuarios'); 

        if(!empty($data['programas'])){                                                    
            $programas = $this->array_programas($data['user_uuid'],$data['programas']);                                
            $this->db->insert_batch('seg_dec_usuarios_programas', $programas);    
        }                                                                        

        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE)
        {                                                                                                
            return FALSE;
        }else
        {                                                                                           
            return TRUE; 
        }                                                                                                                 
    }     
                                                                                                                                                                          
    public function get_user_uuid($id)
    {                                                                                                                                                                                                                       
        $this->db->select('user_uuid');
        $this->db->from('seg_dec_usuarios');
        $this->db->where('id_usuario',$id); 
        $query = $this->db->get();                                              
        return $query->row()->user_uuid;                                                       
    }                                                                                              

    public function get_user($user_uuid)
    {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
        $this->db->select("AES_DECRYPT(pass,'$this->key') as pass", FALSE);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
        $this->db->select('user_uuid,username,nombre,a_paterno,a_materno,email_1,email_2,descripcion,notificacion,tipo');
        $this->db->from('seg_dec_usuarios');                
        $this->db->where('user_uuid',$user_uuid); 
        $query = $this->db->get();
        if ($query->num_rows()>0)                                                                                         
        {                                                                                                                                                                                                                                                                                                                                                                                                                                             
             return $query->row();                             
        }                                                                                                                                                                                                                                                             
        else
        {                                                                                                                                            
            return FALSE;            
        }                                                                                        
    }           

    public function get_usuarios_programas($user_uuid)
    {              
        $this->db->select('up.id_discipline');
        $this->db->select('up.id_program');
        $this->db->select('pro.program_name');        
        $this->db->select('up.id_usuario_programa');
        $this->db->from('seg_dec_usuarios_programas as up');                                         
        $this->db->join('seg_dec_programas as pro','pro.id_program = up.id_program', 'left');                
        $this->db->where('up.user_uuid',$user_uuid);                                                 
        $query = $this->db->get();                                                                                                                                        
        if ($query->num_rows()>0)                                                                                         
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
            return $query->result();                             
        }                                                                                                                                                                                                                                                                                                                 
        else
        {                                                                                                                                                          
            return FALSE;            
        }             
    }

    public function get_nombre_user($user_uuid)
    {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
        $this->db->select('nombre');
        $this->db->from('seg_dec_usuarios');                
        $this->db->where('user_uuid',$user_uuid); 
        $query = $this->db->get();
        if ($query->num_rows()>0)                                                                                         
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                        
             return $query->row();                             
        }                                                                                                                                                                                                                                                             
        else
        {                                                                                                                                         
            return FALSE;            
        }                                                                                                       
    }

    public function checar_existe($user_uuid)
    {                                                                             
        $this->db->select('user_uuid');
        $this->db->from('seg_dec_usuarios');
        $this->db->where('user_uuid',$user_uuid);
        $query = $this->db->get();
        if($query->num_rows()>0)
        {
            return $query->row();
        }else{
            return FALSE;
        }
    }              

    public function login_check($username)
    {                                  
        $this->db->select('username');
        $this->db->from('seg_dec_usuarios');
        $this->db->where('username',$username);
        $query = $this->db->get();
        if($query->num_rows()>0)
        {
            return $query->row();
        }else{
            return FALSE;
        }                    
    }

    public function delete_usuario_programa($id_usuario_programa)
    {                               
        $this->db->where('id_usuario_programa',$id_usuario_programa);
        return $this->db->delete('seg_dec_usuarios_programas');   
    }                                                                     

    public function delete_user($user_uuid)
    {              
        $this->db->trans_start();

        $delete = array('seg_dec_usuarios','seg_dec_usuarios_programas');
        $this->db->where('user_uuid',$user_uuid);
        $this->db->delete($delete);   

        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE)
        {                                                                                                
            return FALSE;
        }else
        {                                                                                                  
            return TRUE; 
        }                                                                                                                     
    }                                                                                                                                                                                     

    public function excel($sidx,$sord)
    {                                                                                                                                                                                                                                                                                                          
        $this->db->select('u.nombre,u.notificacion,u.activo,ur.rol');               
        $this->db->from('seg_dec_usuarios as u');                                                                                                                                                                               
        $this->db->join('seg_dec_usuarios_roles as ur','ur.id_tipo = u.tipo', 'left');
        $this->db->order_by($sidx,$sord);                                                                                                                                                                                         
        $query = $this->db->get();
        if ($query->num_rows()>0)                                                                                                                             
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
            return $query->result();                             
        }                                                                                                                                                                                                                                                                                                                                    
        else
        {                                                                                                                                                                                     
            return FALSE;            
        }                                                                      
    }                                      

    public function excel_search($search,$sidx,$sord)
    {                                                                                                                                                                                                                                                                                                          
         $query = $this->db->query("select user_uuid,nombre,notificacion,activo,rol 
                                  from seg_dec_usuarios 
                                  left join seg_dec_usuarios_roles on seg_dec_usuarios_roles.id_tipo=seg_dec_usuarios.tipo 
                                  ".$search."                       
                                  order by ".$sidx." 
                                  ".$sord."");                                                   
        if($query->num_rows()>0)                                                                                                                                                                                            
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
             return $query->result();                             
        }                                                                                                                                                                                                                                                                            
        else
        {                                                                                                                                                                                  
            return FALSE;            
        }                                                                 
    }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
}