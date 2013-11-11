<?php

class Programas_model extends CI_Model
{                                                             
    function __construct()
    {                                                                   
        parent::__construct();
        $this->load->database();
    }           					
                            
    public function get_tipos_programas($user_uuid,$id_discipline)
    {                                                                                                                                                                                                                                  
        $this->db->select('pro_tipos.program_type,pro_tipos.type');
        $this->db->from('seg_dec_programas_tipos as pro_tipos');                                                                    
        $this->db->join('seg_dec_programas as pro','pro.program_type = pro_tipos.program_type','inner');
        $this->db->join('seg_dec_usuarios_programas as up','up.id_discipline = pro.id_discipline and up.id_program = pro.id_program','inner');
        $this->db->where('up.user_uuid',$user_uuid);              
        $this->db->where('pro.id_discipline',$id_discipline);                                                                                                                                                                                                                    
        $this->db->group_by('pro_tipos.program_type');                                                                                                                                                                                                                                           
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

    public function get_tipos_programas_all($id_discipline)
    {                                                                                                                                                                                                                                 
        $this->db->select('pro_tipos.program_type,pro_tipos.type');     
        $this->db->from('seg_dec_programas_tipos as pro_tipos');                                                                     
        $this->db->join('seg_dec_programas as pro','pro.program_type = pro_tipos.program_type','inner');
        $this->db->where('pro.id_discipline',$id_discipline);         
        $this->db->group_by("pro_tipos.program_type");                                                                                                                                     
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

    public function get_programas($user_uuid,$id_discipline,$program_type)
    {                                                                                                                                                                                                        
        $this->db->select('pro.id_program,pro.program_name');                       
        $this->db->from('seg_dec_programas as pro');                                                                                                                                       
        $this->db->join('seg_dec_usuarios_programas as up','up.id_discipline = pro.id_discipline and up.id_program = pro.id_program','inner');                        
        $this->db->where('up.id_discipline',$id_discipline);                                         
        $this->db->where('pro.program_type',$program_type);                  
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

    public function get_programas_all($id_discipline,$program_type)
    {                                                                                                                                                                                     
        $this->db->select('id_program,program_name'); 
        $this->db->where('id_discipline',$id_discipline); 
        $this->db->where('program_type',$program_type);             
        $query = $this->db->get('seg_dec_programas');
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