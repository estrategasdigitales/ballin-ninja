<?php
class Graficas_model extends CI_Model
{                                                             
    function __construct()
    {                                                                   
        parent::__construct();
        $this->load->database();
    }												

    public function get_disciplinas($user_uuid)
    {                                                                           
        $this->db->select('dis.id_discipline,dis.discipline');
        $this->db->from('seg_dec_disciplinas as dis');                                     
        $this->db->join('seg_dec_usuarios_programas as up','up.id_discipline = dis.id_discipline','inner');               
        $this->db->join('seg_dec_preinscritos as pre','up.id_discipline = pre.id_discipline and up.id_program = pre.id_program','inner'); 
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito','inner'); 
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
        if ($query->num_rows()>0)                                                                                                                                    
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
             return $query->result();                             
        }                                                                                                                                                                                                                                                                                                                                          
        else
        {                                                                                                                                                                                     
            return FALSE;            
        }                       
    }	

    public function disciplinas_us($user_uuid,$fecha_inicio,$fecha_fin)
    {											            							     							            						         								                            		                                                                                                                                                                                                                   
        $this->db->select('dis.discipline,count(pre.id_preinscrito) as total');            
        $this->db->from('seg_dec_disciplinas as dis');                                                                                                                                                                                                                           
        $this->db->join('seg_dec_usuarios_programas as up','up.id_discipline = dis.id_discipline','inner');               
        $this->db->join('seg_dec_preinscritos as pre','up.id_discipline = pre.id_discipline and up.id_program = pre.id_program','inner'); 
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito','inner');
		if($fecha_inicio!=FALSE && $fecha_fin!=FALSE){																																																																																																								
			$this->db->where("date_format(pre.fecha_registro,'%Y-%m-%d') >= '".$fecha_inicio."' and date_format(pre.fecha_registro,'%Y-%m-%d') <= '".$fecha_fin."'",NULL,FALSE);                                                                                                                                                                                                                                                                                			
		}																																																																																																							 				
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

	public function disciplinas_ad($fecha_inicio,$fecha_fin)
    {																            							     							            						         								                            		                                                                                                                                                                                                                   
        $this->db->select('dis.discipline,count(pre.id_preinscrito) as total');            
        $this->db->from('seg_dec_disciplinas as dis');         				  								                                                                                                                                                                                                                
        $this->db->join('seg_dec_preinscritos as pre','dis.id_discipline = pre.id_discipline','inner'); 
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito','inner');		
		if($fecha_inicio!=FALSE && $fecha_fin!=FALSE){																																																																																																								
			$this->db->where("date_format(pre.fecha_registro,'%Y-%m-%d') >= '".$fecha_inicio."' and date_format(pre.fecha_registro,'%Y-%m-%d') <= '".$fecha_fin."'",NULL,FALSE);                                                                                                                                                                                                                                                                                			
		}																																																																																																																																				 				
        $this->db->group_by('pre.id_discipline');                                                                                                  
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
		
	public function programas_us($user_uuid,$id_discipline,$fecha_inicio,$fecha_fin)
    {																																																																																																				            							     							            						         								                            		                                                                                                                                                                                                                   
        $this->db->select('count(pre.id_preinscrito) as total,pro.program_name');            
        $this->db->from('seg_dec_preinscritos as pre');																																								 																																																												                     					                                                                                                                                                                                                      
        $this->db->join('seg_dec_usuarios_programas as up','up.id_discipline = pre.id_discipline and up.id_program = pre.id_program','inner');               
        $this->db->join('seg_dec_programas as pro','up.id_program = pro.id_program','inner'); 
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito','inner');
		if($fecha_inicio!=FALSE && $fecha_fin!=FALSE){																																																																																																								
			$this->db->where("date_format(pre.fecha_registro,'%Y-%m-%d') >= '".$fecha_inicio."' and date_format(pre.fecha_registro,'%Y-%m-%d') <= '".$fecha_fin."'",NULL,FALSE);                                                                                                                                                                                                                                                                                			
		}			
		$this->db->where('up.user_uuid',$user_uuid);                                                                                                                                                                                                                                                                                																																																																																																																																													 				
        $this->db->where('up.id_discipline',$id_discipline); 
		$this->db->group_by('pre.id_program'); 									                                                                                                                                                                                                                                                                                                                                                                                 
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
						
	public function programas_ad($id_discipline,$fecha_inicio,$fecha_fin)
    {																																																																																																											            							     							            						         								                            		                                                                                                                                                                                                                   
        $this->db->select('count(pre.id_preinscrito) as total,pro.program_name');            
        $this->db->from('seg_dec_preinscritos as pre');																																														                     					                                                                                                                                                                                                      
        $this->db->join('seg_dec_programas as pro','pre.id_discipline = pro.id_discipline and pre.id_program = pro.id_program','inner'); 
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito','inner');		
		if($fecha_inicio!=FALSE && $fecha_fin!=FALSE){																																																																																																																													
			$this->db->where("date_format(pre.fecha_registro,'%Y-%m-%d') >= '".$fecha_inicio."' and date_format(pre.fecha_registro,'%Y-%m-%d') <= '".$fecha_fin."'",NULL,FALSE);                                                                                                                                                                                                                                                                                			
		}																																																																																																																																																				 				
        $this->db->where('pre.id_discipline',$id_discipline);                                                                                                                                                                                                                                                                                                                                                                                  
        $this->db->group_by('pre.id_program');                                                                                                  
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
}
?>	 