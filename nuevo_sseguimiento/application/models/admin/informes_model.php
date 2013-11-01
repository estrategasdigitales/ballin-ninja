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
        $this->db->join('seg_dec_usuarios_programas as up','up.id_program = pre.id_program', 'left');
        $this->db->join('seg_dec_programas as pro','up.id_program = pro.id_program', 'left');
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito', 'left');
        $this->db->where('user_uuid',$user_uuid);
        $this->db->where('status.informes',1);                
        $this->db->from('seg_dec_preinscritos as pre');
        return $this->db->count_all_results();                  
    }       

    public function total_informes_admin()
    {                                                                                                                                           
        $this->db->join('seg_dec_programas as pro','pro.id_program = pre.id_program', 'inner');
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito', 'inner');                                                          
        $this->db->from('seg_dec_preinscritos as pre'); 
        $this->db->where('status.informes',1);                                                                                                                      
        return $this->db->count_all_results();                
    }                                                                                                                                                                                                                                                                                                                                 

    public function show_informes($user_uuid,$start,$limit,$sidx,$sord)
    {                                                                                                                                                                                                                                                           
        $this->db->select('pre.id_preinscrito,pre.nombre,pre.a_paterno,pre.a_materno,pre.fecha_registro,pro.program_name,status.atendido');
        $this->db->from('seg_dec_preinscritos as pre');                                      
        $this->db->join('seg_dec_usuarios_programas as up','up.id_program = pre.id_program', 'left');
        $this->db->join('seg_dec_programas as pro','up.id_program = pro.id_program', 'left');                  
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito', 'left');
        $this->db->where('status.informes',1);                       
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

    public function show_informes_admin($start,$limit,$sidx,$sord)
    {                                                                                                                                                                                                                                                                                                                      
        $this->db->select('pre.id_preinscrito,pre.nombre,pre.a_paterno,pre.a_materno,pre.fecha_registro,pro.program_name,status.atendido');
        $this->db->from('seg_dec_preinscritos as pre');                                                                                                                                                                                                                                                                                                                                               
        $this->db->join('seg_dec_programas as pro','pro.id_program = pre.id_program','inner');                                                          
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito','inner');                                                                                                                                                                                                           
        $this->db->where('status.pago_realizado',1);                    
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
                
                        
    public function total_search_informes($where,$user_uuid)
    {                                                                                                                                                                                                                                                    
        $query = $this->db->query("select COUNT(*) as total 
                                  from seg_dec_preinscritos as pre 
                                  left join seg_dec_usuarios_programas as up on up.id_program = pre.id_program 
                                  left join seg_dec_programas as pro on up.id_program = pro.id_program                  
                                  left join seg_dec_pasos_status as status on status.id_preinscrito = pre.id_preinscrito       
                                  ".$where."                
                                  and up.user_uuid='".$user_uuid."' 
                                  and status.informes=1");                                                   
        if ($query->num_rows()>0)                                                                                                                                                                                                                           
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
                                  from seg_dec_preinscritos as pre 
                                  inner join seg_dec_programas as pro on pre.id_program = pro.id_program 
                                  inner join seg_dec_pasos_status as status on status.id_preinscrito = pre.id_preinscrito   
                                  ".$where."                    
                                  and status.informes=1");                                                                                                                                                                                                                                                  
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
        $query = $this->db->query("select pre.id_preinscrito,pre.nombre,pre.a_paterno,pre.a_materno,pre.fecha_registro,pro.program_name,status.atendido  
                                  from seg_dec_preinscritos as pre                  
                                  left join seg_dec_usuarios_programas as up on up.id_program = pre.id_program 
                                  left join seg_dec_programas as pro on up.id_program = pro.id_program
                                  left join seg_dec_pasos_status as status on status.id_preinscrito = pre.id_preinscrito                
                                  ".$where."                       
                                  and up.user_uuid='".$user_uuid."' 
                                  and status.informes=1 
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
        $query = $this->db->query("select pre.id_preinscrito,pre.nombre,pre.a_paterno,pre.a_materno,pre.fecha_registro,pro.program_name,status.atendido    
                                  from seg_dec_preinscritos as pre                  
                                  inner join seg_dec_programas as pro on pre.id_program = pro.id_program 
                                  inner join seg_dec_pasos_status as status on status.id_preinscrito = pre.id_preinscrito          
                                  ".$where."                                 
                                  and status.informes=1              
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

    public function get_contacto($id_preinscrito)
    {                                      
        $this->db->select('con.paterno,con.materno,con.nombre,con.correo,con.comentario');
        $this->db->from('seg_dec_contacto as con');                 
        $this->db->where('con.id',$id_preinscrito);                                                                                                                             
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
                
} 

?>              