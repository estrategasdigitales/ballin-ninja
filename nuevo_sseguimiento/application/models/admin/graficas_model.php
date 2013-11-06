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
        $this->db->join('seg_dec_usuarios_programas as up','up.id_discipline = dis.id_discipline','left'); 
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
}
?>	 