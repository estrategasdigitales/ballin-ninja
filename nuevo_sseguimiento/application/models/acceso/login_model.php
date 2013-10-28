<?php
    
class Login_model extends CI_Model
{	

    function __construct()
    {	    
     	parent::__construct();
     	$this->load->database();
    }                        

    /*
    public function acceso($username, $pass)
    {                              												
    	$query = $this->db->query("select id,username,pass from seg_dec_usuarios where username = '".mysql_real_escape_string($username)."' and pass = '".mysql_real_escape_string($pass)."'");                       
        if($query->num_rows()>0)
        {                                                                                                        
            return $query->row();                            
        }                                                                
        else
        {                                                                                   
            return NULL;                                    
        }   		
    }	*/

    public function acceso($username,$pass)
    {                                                                                                       
        $this->db->select('usu.id,usu.username,usu.pass,acc.users,acc.preinscritos,acc.inscritos,acc.casos_cerrados,acc.casos_inconclusos,acc.informes');
        $this->db->from('seg_dec_usuarios as usu');                                                  
        $this->db->join('seg_dec_accesos as acc','acc.id_role = usu.tipo', 'left');
        $this->db->where('username',$username);
        $this->db->where('pass',$pass);
        $query = $this->db->get();            
        if($query->num_rows()>0)
        {                                                                 
            return $query->row();
        }else{      
            return FALSE;
        }
    }

}