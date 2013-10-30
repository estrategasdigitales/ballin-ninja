<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Accesos
{

    function __construct()
    {               
        $this->CI =& get_instance();
    }							

    function acceso()
    {																								
		$accesos 	= $this->CI->session->userdata('controllers');	
		$controller = $this->CI->uri->segment(2);								                		       
		if($this->CI->session->userdata('username'))
		{								
			if($accesos[$controller]){
				return true;
			}			
		}																     
		return false;
    }

    function admin()
    {														
    	if($this->CI->session->userdata('tipo')==1){			
    		return true;	
    	}																
    }					
					              																		                                             
}
?> 