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
        $this->db->join('seg_dec_usuarios_programas as up','up.id_discipline = pre.id_discipline and up.id_program = pre.id_program', 'left');
        $this->db->join('seg_dec_programas as pro','up.id_discipline = pro.id_discipline and up.id_program = pro.id_program', 'left');
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito', 'left');
        $this->db->where('user_uuid',$user_uuid);
        $this->db->where('status.pago_realizado',1);  
        $this->db->from('seg_dec_preinscritos as pre');
        return $this->db->count_all_results();                  
    }                                                                                                                                                                                                                                                                                               

    public function show_inscritos($user_uuid,$start,$limit,$sidx,$sord)
    {                                                                                                                                                                                                                                                    
        $this->db->select('pre.id_preinscrito,pre.nombre,pre.a_paterno,pre.a_materno,pre.fecha_registro,up.user_uuid,up.id_discipline,up.id_program,pro.program_name,status.primer_contacto,status.documentos,status.envio_decse,status.envio_claves,status.pago_realizado');
        $this->db->from('seg_dec_preinscritos as pre');                                      
        $this->db->join('seg_dec_usuarios_programas as up','up.id_discipline = pre.id_discipline and up.id_program = pre.id_program', 'left');
        $this->db->join('seg_dec_programas as pro','up.id_discipline = pro.id_discipline and up.id_program = pro.id_program', 'left');                  
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito', 'left');
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
				
    public function total_search_inscritos($where,$user_uuid)
    {                                                                                                                                                                                                                                                    
        $query = $this->db->query("select COUNT(*) as total 
                                  from seg_dec_preinscritos as pre 
                                  left join seg_dec_usuarios_programas as up on (up.id_discipline=pre.id_discipline and up.id_program=pre.id_program) 
                                  left join seg_dec_programas as pro on (up.id_discipline=pro.id_discipline and up.id_program=pro.id_program)
                                  left join seg_dec_pasos_status as status on status.id_preinscrito = pre.id_preinscrito       
                                  $where 
                                  and up.user_uuid='$user_uuid' 
                                  and status.pago_realizado=1");                                                   
        if ($query->num_rows()>0)                                                                                                                                                                                                   
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
        $query = $this->db->query("select pre.id_preinscrito,pre.nombre,pre.a_paterno,pre.a_materno,pre.fecha_registro,up.user_uuid,up.id_discipline,up.id_program,pro.program_name,status.primer_contacto,status.documentos,status.envio_decse,status.envio_claves,status.pago_realizado  
                                  from seg_dec_preinscritos as pre     				
                                  left join seg_dec_usuarios_programas as up on (up.id_discipline=pre.id_discipline and up.id_program=pre.id_program) 
                                  left join seg_dec_programas as pro on (up.id_discipline=pro.id_discipline and up.id_program=pro.id_program)
                                  left join seg_dec_pasos_status as status on status.id_preinscrito = pre.id_preinscrito                
                                  $where                
                                  and up.user_uuid='$user_uuid' 
                                  and status.pago_realizado=1 
                                  order by $sidx $sord");                                                          
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

    /*                      
        ////show_preinscritos
    select 
    pre.id_preinscrito,up.id_discipline,up.id_program,up.user_uuid,pre.nombre,pre.a_paterno,pre.a_materno from seg_dec_usuarios_programas as up left join seg_dec_preinscritos as pre on (up.id_discipline=pre.id_discipline and up.id_program=pre.id_program) where up.user_uuid='76d6b6af-37fb-11e3-a5d7-3085a9f08421'

        
    select 
    pre.id_preinscrito,pre.nombre,pre.a_paterno,pre.a_materno,up.user_uuid,up.id_discipline,up.id_program from seg_dec_preinscritos  as pre left join seg_dec_usuarios_programas as up on (up.id_discipline=pre.id_discipline and up.id_program=pre.id_program) where up.user_uuid='76d6b6af-37fb-11e3-a5d7-3085a9f08421'
    

    select 
    pre.id_preinscrito,pre.nombre,pre.a_paterno,pre.a_materno,up.user_uuid,up.id_discipline,up.id_program,pro.program_name from seg_dec_preinscritos  as pre left join seg_dec_usuarios_programas as up on (up.id_discipline=pre.id_discipline and up.id_program=pre.id_program) left join seg_dec_programas as pro on (up.id_discipline=pro.id_discipline and up.id_program=pro.id_program) where up.user_uuid='76d6b6af-37fb-11e3-a5d7-3085a9f08421'
    */                  
} 

?>              