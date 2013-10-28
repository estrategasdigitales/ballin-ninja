<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Status
{

    function __construct()
    {               
        $this->CI =& get_instance();
    }		

    function acceso($controller)
    {												
		$accesos = $this->CI->session->userdata('controllers_acceso') ;					                		       
		if($this->CI->session->userdata('username'))
		{
			
			return true;
		}										     
		return false;
    }					                 
	
	
																			
	                                             
}
?> 