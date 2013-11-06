<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('total_pages'))
{                                                                                   																											
    function total_pages($total_registros,$limit)
    {                                               
        if($total_registros>0)
        {                                                                                     
            $total_pages  = ceil($total_registros/$limit);
        }else{                                   
            $total_pages = 0;
        }   
        return $total_pages;
    }                      
}                                                 		

if(!function_exists('search'))
{                                  
	function search($searchOper,$searchField,$searchString)
    {                   
        $operations = array(
            'eq' => "= '%s'",            // Equal
            'ne' => "<> '%s'",           // Not equal
            'lt' => "< '%s'",            // Less than
            'le' => "<= '%s'",           // Less than or equal
            'gt' => "> '%s'",            // Greater than
            'ge' => ">= '%s'",           // Greater or equal
            'bw' => "like '%s%%'",       // Begins With
            'bn' => "not like '%s%%'",   // Does not begin with
            'in' => "in ('%s')",         // In
            'ni' => "not in ('%s')",     // Not in
            'ew' => "like '%%%s'",       // Ends with
            'en' => "not like '%%%s'",   // Does not end with
            'cn' => "like '%%%s%%'",     // Contains
            'nc' => "not like '%%%s%%'", // Does not contain
            'nu' => "is null",           // Is null
            'nn' => "is not null"        // Is not null
        );                                                                             
                                                                     
        $where = sprintf("where %s ".$operations[$searchOper], $searchField, mysql_real_escape_string($searchString));                                     
        return $where;
    }                                                                                                     
}                                                                                
                                                           
if(!function_exists('msj'))
{        
    function msj($msj,$div)
    {                                                                                                                                                                              
        return "<div id='".$div."'>".$msj."</div>";
    }                      		    
}     

if(!function_exists('get_disciplinas'))
{                                                  
    function get_disciplinas($msj,$div)
    {                                                                                                                                                                              
        return "<div id='".$div."'>".$msj."</div>";
    }                               
}                                                                                        
/* fin func_helper */
                                     