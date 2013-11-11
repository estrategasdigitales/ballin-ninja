<?php

class Inscritos_model extends CI_Model
{                                                             
    function __construct()
    {                                                                   
        parent::__construct();
        $this->load->database();
    }                                                                                                                                                                                                                                                                                          

    public function total_inscritos($user_uuid)
    {                                                                                                                       
        $this->db->join('seg_dec_usuarios_programas as up','up.id_program = pre.id_program', 'inner');
        $this->db->join('seg_dec_programas as pro','up.id_program = pro.id_program', 'inner');                   
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito', 'inner');
        $this->db->where('up.user_uuid',$user_uuid);
        $this->db->where('status.pago_realizado',1);  
        $this->db->from('seg_dec_preinscritos as pre');
        return $this->db->count_all_results();                  
    }				                                                                                                                                                                                                                                                                                                                                                                         

    public function show_inscritos($user_uuid,$start,$limit,$sidx,$sord)
    {                                                                                                                                                                                                                                                    
        $this->db->select('pre.id_preinscrito,pre.nombre,pre.a_paterno,pre.a_materno,pre.fecha_registro,pro.program_name,status.primer_contacto,status.documentos,status.envio_decse,status.envio_claves,status.pago_realizado');
        $this->db->from('seg_dec_preinscritos as pre');                                      
        $this->db->join('seg_dec_usuarios_programas as up','up.id_program = pre.id_program', 'inner');
        $this->db->join('seg_dec_programas as pro','up.id_program = pro.id_program', 'inner');                  
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito', 'inner');
        $this->db->where('status.pago_realizado',1);                    				   
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

    public function total_inscritos_admin()
    {                                                                                                    
        $this->db->join('seg_dec_programas as pro','pro.id_program = pre.id_program', 'inner');
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito', 'inner');                                                          
        $this->db->from('seg_dec_preinscritos as pre'); 
        $this->db->where('status.pago_realizado',1);                                                                                                                
        return $this->db->count_all_results();           
    }                                                                                 

    public function show_inscritos_admin($start,$limit,$sidx,$sord)
    {                                                                                                                                                                                                                                                                      
        $this->db->select('pre.id_preinscrito,pre.nombre,pre.a_paterno,pre.a_materno,pre.fecha_registro,pro.program_name,status.primer_contacto,status.documentos,status.envio_decse,status.envio_claves,status.pago_realizado');
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
				
    public function total_search_inscritos($where,$user_uuid)
    {                                                                                                                                                                                                                                                    
        $query = $this->db->query("select COUNT(*) as total 
                                  from seg_dec_preinscritos as pre 
                                  left join seg_dec_usuarios_programas as up on up.id_program = pre.id_program   
                                  left join seg_dec_programas as pro on up.id_program = pro.id_program                          
                                  left join seg_dec_pasos_status as status on status.id_preinscrito = pre.id_preinscrito       
                                  ".$where."                                                                      
                                  and up.user_uuid='".$user_uuid."' 
                                  and status.pago_realizado=1");                                                   
        if($query->num_rows()>0)                                                                                                                                                                                                   
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
             return $query->row();                             
        }                                                                                                                                                                                                                                                                                   
        else
        {                                                                                                                                                                                                     
            return FALSE;            
        } 
    }                

    public function total_search_inscritos_admin($where)
    {                                                                                                                                                                                                                                                                       
       $query = $this->db->query("select COUNT(*) as total                                 
                                  from seg_dec_preinscritos as pre 
                                  inner join seg_dec_programas as pro on  pre.id_discipline = pro.id_discipline and pre.id_program = pro.id_program 
                                  inner join seg_dec_pasos_status as status on status.id_preinscrito = pre.id_preinscrito   
                                  ".$where."
                                  and status.pago_realizado=1");                                                                                                                                                                                                                                                  
        if($query->num_rows()>0)                                                                                                                                                                                                                                             
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
             return $query->row();                             
        }                                                                                                                                                                                                                                                                                                                                                                  
        else
        {                                                                                                                                                                                                  
            return FALSE;            
        }           
    }                                                                
                                                

    public function search_inscritos($where,$user_uuid,$start,$limit,$sidx,$sord)
    {                                                                                                                                                                                                             
        $query = $this->db->query("select pre.id_preinscrito,pre.nombre,pre.a_paterno,pre.a_materno,pre.fecha_registro,pro.program_name,status.primer_contacto,status.documentos,status.envio_decse,status.envio_claves,status.pago_realizado  
                                  from seg_dec_preinscritos as pre     				
                                  left join seg_dec_usuarios_programas as up on up.id_program = pre.id_program 
                                  left join seg_dec_programas as pro on up.id_program = pro.id_program                          
                                  left join seg_dec_pasos_status as status on status.id_preinscrito = pre.id_preinscrito                
                                  ".$where."                                               
                                  and up.user_uuid='".$user_uuid."' 
                                  and status.pago_realizado=1  
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

    public function search_inscritos_admin($where,$start,$limit,$sidx,$sord)
    {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
        $query = $this->db->query("select pre.id_preinscrito,pre.nombre,pre.a_paterno,pre.a_materno,pre.fecha_registro,pro.program_name,status.primer_contacto,status.documentos,status.envio_decse,status.envio_claves,status.pago_realizado    
                                  from seg_dec_preinscritos as pre                  
                                  inner join seg_dec_programas as pro on pre.id_discipline = pro.id_discipline and pre.id_program = pro.id_program  
                                  inner join seg_dec_pasos_status as status on status.id_preinscrito = pre.id_preinscrito          		
                                  ".$where."                    
                                  and status.pago_realizado=1              
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

    public function checar_existe($id_preinscrito)
    {                                                                                                          
        $this->db->select('id_preinscrito');
        $this->db->from('seg_dec_preinscritos');
        $this->db->where('id_preinscrito',$id_preinscrito);
        $query = $this->db->get();      
        if($query->num_rows()>0)
        {                                                          
            return $query->row();
        }else{      
            return FALSE;
        }                   
    }        

    public function delete_preinscrito($id_preinscrito)
    {                                                                         
        $this->db->where('id_preinscrito',$id_preinscrito);
        return $this->db->delete('seg_dec_preinscritos'); 
    }

    public function ex_user($user_uuid,$sidx,$sord)
    {                                                                                                                                                                                                                                                                                                                                                                      
        $this->db->select('pre.id_preinscrito,pre.nombre,pre.a_paterno,pre.a_materno,pre.fecha_registro,pre.codigo,pro.program_name,status.primer_contacto,status.documentos,status.envio_decse,status.envio_claves,status.pago_realizado');
        $this->db->from('seg_dec_preinscritos as pre');                                                                                                                                                                                                                                                                                                                                                                                              
        $this->db->join('seg_dec_usuarios_programas as up','up.id_program = pre.id_program', 'inner');
        $this->db->join('seg_dec_programas as pro','up.id_program = pro.id_program', 'inner');                                                        
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito', 'inner');                                                                                                                                                                                                                                                                                      
        $this->db->where('up.user_uuid',$user_uuid);  
        $this->db->where('status.pago_realizado',1);                                                                                                                                                                                                                                                                                                      
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
        $this->db->select('pre.id_preinscrito,pre.nombre,pre.a_paterno,pre.a_materno,pre.fecha_registro,pro.program_name,pre.codigo,status.primer_contacto,status.documentos,status.envio_decse,status.envio_claves,status.pago_realizado');
        $this->db->from('seg_dec_preinscritos as pre');                                                                                                                                                                                                                                                                                                                                                        
        $this->db->join('seg_dec_programas as pro','pro.id_program = pre.id_program','inner');                                                          
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito','inner');                                                                                                                                                                                                           
        $this->db->where('status.pago_realizado',1);      
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
        $query = $this->db->query("select pre.id_preinscrito,pre.nombre,pre.a_paterno,pre.a_materno,pre.fecha_registro,pro.program_name,pre.codigo,status.atendido,status.primer_contacto,status.documentos,status.envio_decse,status.envio_claves,status.pago_realizado    
                                  from seg_dec_preinscritos as pre                  
                                  inner join seg_dec_usuarios_programas as up on up.id_program = pre.id_program 
                                  inner join seg_dec_programas as pro on up.id_program = pro.id_program 
                                  inner join seg_dec_pasos_status as status on status.id_preinscrito = pre.id_preinscrito          
                                  ".$where."                                                                                                             
                                  and up.user_uuid='".$user_uuid."'
                                  and status.pago_realizado=1       
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
        $query = $this->db->query("select pre.id_preinscrito,pre.nombre,pre.a_paterno,pre.a_materno,pre.fecha_registro,pro.program_name,pre.codigo,status.primer_contacto,status.documentos,status.envio_decse,status.envio_claves,status.pago_realizado    
                                  from seg_dec_preinscritos as pre                  
                                  inner join seg_dec_programas as pro on pre.id_program = pro.id_program 
                                  inner join seg_dec_pasos_status as status on status.id_preinscrito = pre.id_preinscrito          
                                  ".$where." 
                                  and status.pago_realizado=1
                                  order by ".$sidx." 
                                  ".$sord."");                                                         
        if ($query->num_rows()>0)                                                                                                                                                                                                                                                                                      
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
             return $query->result();                             
        }                                                                                                                                                                                                                                                                                                                                                                                
        else
        {                                                                                                                                                                                             
            return FALSE;            
        }                                                                          
    } 
					
	public function get_disciplinas($user_uuid)
    {                                                                                                                                                                                                                                               
        $this->db->select('dis.id_discipline,dis.discipline');
        $this->db->from('seg_dec_disciplinas as dis');                                                                                                                                                                                                    
        $this->db->join('seg_dec_usuarios_programas as up','up.id_discipline = dis.id_discipline','inner');               
        $this->db->join('seg_dec_preinscritos as pre','up.id_discipline = pre.id_discipline and up.id_program = pre.id_program','inner'); 
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito','inner'); 
        $this->db->where('status.pago_realizado',1);  									
        $this->db->where('up.user_uuid',$user_uuid);                                                                                                                                                                                                                                                                         
        $this->db->group_by('up.id_discipline');                                                                                                  
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

    public function get_disciplinas_all()
    {                                                    
        $this->db->select('id_discipline,discipline');               
        $query = $this->db->get('seg_dec_disciplinas');
        if($query->num_rows()>0)                                                                                                                                    
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
             return $query->result();                             
        }                                                                                                                                                                                                                                                                                                                                                                        
        else
        {                                                                                                                                                                                                        
            return FALSE;            
        }                       
    }		                 

    public function get_tipos_programas($user_uuid,$id_discipline)
    {                                                                                                                                                                                                                                                                                                                                                           
        $this->db->select('pro_tipos.program_type,pro_tipos.type');
        $this->db->from('seg_dec_programas_tipos as pro_tipos');                                                                                                                
        $this->db->join('seg_dec_programas as pro','pro.program_type = pro_tipos.program_type','inner');
        $this->db->join('seg_dec_usuarios_programas as up','up.id_discipline = pro.id_discipline and up.id_program = pro.id_program','inner');
        $this->db->join('seg_dec_preinscritos as pre','up.id_discipline = pre.id_discipline and up.id_program = pre.id_program','inner');
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito','inner');
		$this->db->where('status.pago_realizado',1);  				 
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
        $this->db->join('seg_dec_preinscritos as pre','pro.id_discipline = pre.id_discipline and pro.id_program = pre.id_program','inner');
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito','inner');
        $this->db->where('status.pago_realizado',1);  	
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
        $this->db->join('seg_dec_preinscritos as pre','up.id_discipline = pre.id_discipline and up.id_program = pre.id_program','inner');
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito','inner');
        $this->db->where('status.pago_realizado',1);  					
        $this->db->where('up.id_discipline',$id_discipline);                              
        $this->db->where('up.user_uuid',$user_uuid);                                                                                                                                                                   
        $this->db->where('pro.program_type',$program_type);
        $this->db->group_by("pro.id_program");                                                           
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
        $this->db->select('pro.id_program,pro.program_name'); 
        $this->db->from('seg_dec_programas as pro'); 
        $this->db->join('seg_dec_preinscritos as pre','pro.id_discipline = pre.id_discipline and pro.id_program = pre.id_program','inner');
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito','inner');                        
        $this->db->where('status.pago_realizado',1);  
        $this->db->where('pro.id_discipline',$id_discipline);                                                                                                    
        $this->db->where('pro.program_type',$program_type); 
        $this->db->group_by("pro.id_program");                                          
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

	
                                  
} 
?>              