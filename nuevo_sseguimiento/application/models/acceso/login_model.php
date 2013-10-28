<?php
    
class Login_model extends CI_Model
{	

    function __construct()
    {	    
     	parent::__construct();
     	$this->load->database();
    }                        

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
    }	

}