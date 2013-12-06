<?php                         
class Informes_model extends CI_Model
{                                                                            
    function __construct()
    {                                                                                      
        parent::__construct();
        $this->load->database();
    }                                                                                                                                                                                                                                                                                                    

    public function total_informes($user_uuid)
    {                                                                                                             
        $this->db->join('seg_dec_usuarios_programas as up','up.id_program = con.id_program', 'inner');
        $this->db->join('seg_dec_programas as pro','up.id_program = pro.id_program', 'inner');
        $this->db->where('up.user_uuid',$user_uuid);                                                          
        $this->db->from('seg_dec_contacto as con');   
        return $this->db->count_all_results();                     
    }       

    public function total_informes_admin()
    {                                                                                                                                                   
        $this->db->join('seg_dec_programas as pro','pro.id_program = con.id_program', 'inner');
        $this->db->from('seg_dec_contacto as con');                                                                                                                                              
        return $this->db->count_all_results();                
    }   

    public function show_informes($user_uuid,$start,$limit,$sidx,$sord)
    {                                                                                                                                                                                                                                                                      
        $this->db->select('con.id,con.paterno,con.materno,con.nombre,con.correo,con.comentario,con.comentario_encargado,pro.program_name,con.atendido,con.acepta_aviso');
        $this->db->from('seg_dec_contacto as con');                                                                      
        $this->db->join('seg_dec_usuarios_programas as up','up.id_program = con.id_program', 'inner');
        $this->db->join('seg_dec_programas as pro','up.id_program = pro.id_program', 'inner');                                      
        $this->db->where('up.user_uuid',$user_uuid);                                                        
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

    public function update_contacto($data)
    {                      
        $this->db->set('comentario_encargado',$data['comentario_encargado']);
        $this->db->set('atendido',$data['atendido']);
        $this->db->from('seg_dec_contacto');                
        $this->db->where('id',$data['id']);
        return $this->db->update();           
    }

    public function show_informes_admin($start,$limit,$sidx,$sord)
    {                                                                                                                                                                                                                                                                                                                                                 
        $this->db->select('con.id,con.paterno,con.materno,con.nombre,con.correo,con.comentario,con.comentario_encargado,pro.program_name,con.atendido,con.acepta_aviso');
        $this->db->from('seg_dec_contacto as con');                                                                                                                                                                                                                                                                                                                                                                
        $this->db->join('seg_dec_programas as pro','pro.id_program = con.id_program','inner');                                                                           
        $this->db->order_by($sidx,$sord);                                                                                                                                                                                                                           
        $this->db->limit($limit,$start);                                                            
        $query = $this->db->get();                                                                                                            
        if($query->num_rows()>0)                                                                                                                                                   
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
            return $query->result();                             
        }                                                                                                                                                                                                                                                                                                                                                                                                                    
        else
        {                                                                                                                                                                                                              
            return FALSE;            
        }                                                  
    }  

    public function delete_informes($id)
    {                                                                                                                           
        return $this->db->delete('seg_dec_contacto',array('id'=>$id));                  
    }                                                                                                                    

    public function total_search_informes($where,$user_uuid)
    {                                                                                                                                                                                                                                                                                                                    
        $query = $this->db->query("select COUNT(*) as total 
                                  from seg_dec_contacto as con                        
                                  inner join seg_dec_usuarios_programas as up on up.id_program = con.id_program 
                                  inner join seg_dec_programas as pro on up.id_program = pro.id_program                  
                                  ".$where."                                    
                                  and up.user_uuid='".$user_uuid."'");                                                   
        if($query->num_rows()>0)                                                                                                                                                                                                                               
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
             return $query->row();                             
        }                                                                                                                                                                                                                                                                                   
        else
        {                                                                                                                                                                              
            return FALSE;            
        }       
    }       

    public function total_search_informes_admin($where)
    {                                                                                                                                                                                                                                                                          
       $query = $this->db->query("select COUNT(*) as total                                                 
                                  from seg_dec_contacto as con                
                                  inner join seg_dec_programas as pro on con.id_program = pro.id_program 
                                  ".$where."");                                                                                                                                                                                                                                                  
        if($query->num_rows()>0)                                                                                                                                                                                                                                                 
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
             return $query->row();                             
        }                                                                                                                                                                                                                                                                                                                                                                  
        else
        {                                                                                                                                                                                                  
            return FALSE;            
        }           
    }  

    public function search_informes($where,$user_uuid,$start,$limit,$sidx,$sord)
    {                                                                                                                                                                                                                                                                                          
        $query = $this->db->query("select con.id,con.paterno,con.materno,con.nombre,con.correo,con.comentario,con.comentario_encargado,pro.program_name,con.atendido,con.acepta_aviso  
                                  from seg_dec_contacto as con                                          
                                  left join seg_dec_usuarios_programas as up on up.id_program = con.id_program 
                                  left join seg_dec_programas as pro on up.id_program = pro.id_program
                                  ".$where."                       
                                  and up.user_uuid='".$user_uuid."' 
                                  order by ".$sidx." 
                                  ".$sord."
                                  limit ".$start.",".$limit."");                                                          
        if ($query->num_rows()>0)                                                                                                                                                                                                                         
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
             return $query->result();                             
        }                                                                                                                                                                                                                                                                                        
        else
        {                                                                                                                                                                              
            return FALSE;            
        }                                                                    
    }      

    public function search_informes_admin($where,$start,$limit,$sidx,$sord)
    {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
        $query = $this->db->query("select con.id,con.paterno,con.materno,con.nombre,con.correo,con.comentario,con.comentario_encargado,pro.program_name,con.atendido,con.acepta_aviso      
                                  from seg_dec_contacto as con                          
                                  inner join seg_dec_programas as pro on con.id_program = pro.id_program 
                                  ".$where."                                                          
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

    public function get_contacto($id)
    {                                                                                                                               
        $this->db->select('con.id,con.paterno,con.materno,con.nombre,con.correo,con.comentario,con.comentario_encargado,con.atendido,pro.program_name');
        $this->db->join('seg_dec_programas as pro','pro.id_program = con.id_program','inner'); 
        $this->db->from('seg_dec_contacto as con');                                                
        $this->db->where('con.id',$id);                                                                                                                                  
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

    public function ex_user($user_uuid,$sidx,$sord)
    {                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
        $this->db->select('con.id,con.paterno,con.materno,con.nombre,con.correo,con.comentario,con.comentario_encargado,pro.program_name,con.atendido,con.acepta_aviso');
        $this->db->from('seg_dec_contacto as con');                                                                                                                                                                                                                                                                                                                                                                                                                                                
        $this->db->join('seg_dec_usuarios_programas as up','up.id_program = con.id_program','inner');
        $this->db->join('seg_dec_programas as pro','up.id_program = pro.id_program','inner');                                                        
        $this->db->where('up.user_uuid',$user_uuid);  
        $this->db->order_by($sidx,$sord);                                                                                                                                                                                                                                           
        $query = $this->db->get();                                                                                                                             
        if($query->num_rows()>0)                                                                                                                                                   
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
            return $query->result();                             
        }                                                                                                                                                                                                                                                                                                                                                                                 
        else
        {                                                                                                                                                                                                         
            return FALSE;            
        }                                                                      
    }                      

    public function ex_admin($sidx,$sord)
    {                                                                                                                                                                                                                                                                                                                                                                                                                          
        $this->db->select('con.id,con.paterno,con.materno,con.nombre,con.correo,con.comentario,con.comentario_encargado,pro.program_name,con.atendido,con.acepta_aviso');
        $this->db->from('seg_dec_contacto as con');                                                                                                                                                                                                                                                                                                                                                                      
        $this->db->join('seg_dec_programas as pro','pro.id_program = con.id_program','inner');                                                              
        $this->db->order_by($sidx,$sord);                                                                                                                                                                                                                                            
        $query = $this->db->get();                                                                                                            
        if($query->num_rows()>0)                                                                                                                                                   
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
            return $query->result();                             
        }                                                                                                                                                                                                                                                                                                                                                                                                                    
        else
        {                                                                                                                                                                                                                             
            return FALSE;            
        }                                   
    }                
      
    public function ex_user_search($where,$user_uuid,$sidx,$sord)
    {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
        $query = $this->db->query("select con.id,con.paterno,con.materno,con.nombre,con.correo,con.comentario,con.comentario_encargado,pro.program_name,con.atendido,con.acepta_aviso    
                                  from seg_dec_contacto as con                     
                                  inner join seg_dec_usuarios_programas as up on up.id_program = con.id_program 
                                  inner join seg_dec_programas as pro on up.id_program = pro.id_program 
                                  ".$where."                                                                                                                            
                                  and up.user_uuid='".$user_uuid."'         
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

    public function ex_admin_search($where,$sidx,$sord)
    {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
        $query = $this->db->query("select con.id,con.paterno,con.materno,con.nombre,con.correo,con.comentario,con.comentario_encargado,pro.program_name,con.atendido,con.acepta_aviso      
                                  from seg_dec_contacto as con                                    
                                  inner join seg_dec_programas as pro on con.id_program = pro.id_program  
                                  ".$where."                   
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