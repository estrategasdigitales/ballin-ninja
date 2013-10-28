<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
        
class No_acceso extends CI_Controller{
    		 		                
    public function __construct()
    {                                                                                                                     
        parent::__construct();                                                                             
    }											

    public function index()
    {			
    	$this->load->view('admin/no_acceso');
    }
}

?>