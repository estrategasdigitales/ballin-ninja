<?php
class Preinscritos_model extends CI_Model
{                                                          
    function __construct()
    {                                                                   
        parent::__construct();
        $this->load->database();
    }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
	
    public function total_preinscritos($user_uuid)
    {                                                                                                                                                                                                                                                                                                            
        $this->db->join('seg_dec_usuarios_programas as up','up.id_program = pre.id_program and up.id_discipline = pre.id_discipline', 'inner');
        $this->db->join('seg_dec_programas as pro','pro.id_program = pre.id_program and (pro.id_discipline = pre.id_discipline OR pro.id_discipline_alterna = pre.id_discipline)', 'inner');
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito', 'inner');                                                      
        $this->db->where('status.pago_realizado',0); 
        $this->db->where('status.caso_cerrado',0); 
        $this->db->where('status.caso_inconcluso',0);                                                                       
        $this->db->where('up.user_uuid',$user_uuid);                                                                                                                                                                                                     															
        $this->db->from('seg_dec_preinscritos as pre');         
        return $this->db->count_all_results();  								
    }                                                                                                                                                                                                                                                                                                                                                                                                             

    public function total_preinscritos_admin()
    {                                                                                                                                                                                                                        
        $this->db->join('seg_dec_programas as pro','pro.id_program = pre.id_program and (pro.id_discipline = pre.id_discipline OR pro.id_discipline_alterna = pre.id_discipline)', 'inner');
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito', 'inner');  
        $this->db->where('status.pago_realizado',0);                                        
        $this->db->where('status.caso_cerrado',0);              
        $this->db->where('status.caso_inconcluso',0);                                                         
        $this->db->from('seg_dec_preinscritos as pre');                                                                                                                                      
        return $this->db->count_all_results();           
    }                                                                                                                                                                                                                                  		          									                                                                                                                                         

    public function show_preinscritos($user_uuid,$start,$limit,$sidx,$sord)
    {                              		             				             									                 									                           									                                                                                                                                                                   
        $this->db->select('pre.id_preinscrito,pre.nombre,pre.a_paterno,pre.a_materno,pre.fecha_registro,pre.codigo,pro.program_name,status.primer_contacto,status.documentos,status.envio_decse,status.envio_claves,status.pago_realizado');
        $this->db->from('seg_dec_preinscritos as pre');                                                                                                                  						   																			 										  									   				     									                                                     
        $this->db->join('seg_dec_usuarios_programas as up','up.id_program = pre.id_program and up.id_discipline = pre.id_discipline', 'inner');
        $this->db->join('seg_dec_programas as pro','pro.id_program = pre.id_program and (pro.id_discipline = pre.id_discipline OR pro.id_discipline_alterna = pre.id_discipline)', 'inner');                                 				          
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito', 'inner');
        $this->db->where('status.pago_realizado',0);                 
        $this->db->where('status.caso_cerrado',0); 
        $this->db->where('status.caso_inconcluso',0); 
        $this->db->where('up.user_uuid',$user_uuid);                                                                                     																																		     					                                            
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

    public function show_preinscritos_admin($start,$limit,$sidx,$sord)
    {                                                                                                                                                                                                                                                                                                                                                                                                              
        $this->db->select('pre.id_preinscrito,pre.nombre,pre.a_paterno,pre.a_materno,pre.fecha_registro,pro.program_name,pre.codigo,status.primer_contacto,status.documentos,status.envio_decse,status.envio_claves,status.pago_realizado');
        $this->db->from('seg_dec_preinscritos as pre');                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
        $this->db->join('seg_dec_programas as pro','pro.id_program = pre.id_program and (pro.id_discipline = pre.id_discipline OR pro.id_discipline_alterna = pre.id_discipline)','inner');                                                          
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito','inner');                                                                                                                                                                                                           
        $this->db->where('status.pago_realizado',0);                                        
        $this->db->where('status.caso_cerrado',0); 
        $this->db->where('status.caso_inconcluso',0); 
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
							
    public function total_search_preinscritos($where,$user_uuid)
    {                                                                                                                                                                                                                                                                                                                                                                          
        $query = $this->db->query("select COUNT(*) as total 
                                  from seg_dec_preinscritos as pre          
                                  inner join seg_dec_usuarios_programas as up on up.id_program = pre.id_program and up.id_discipline = pre.id_discipline
                                  inner join seg_dec_programas as pro on pro.id_program = pre.id_program and (pro.id_discipline = pre.id_discipline OR pro.id_discipline_alterna = pre.id_discipline)             
                                  inner join seg_dec_pasos_status as status on status.id_preinscrito = pre.id_preinscrito      
                                  ".$where."  
                                  and status.pago_realizado = 0
                                  and status.caso_cerrado = 0                             
                                  and status.caso_inconcluso = 0                                                                                                              
                                  and up.user_uuid='".$user_uuid."'");                                                                                            
        if($query->num_rows()>0)                                                                                                                                                                                                                                                                                                                                                                                                                                
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
             return $query->row();                             
        }                                                                                                                                                                                                                                                                                          
        else
        {                                                                                                                                                                                                                                   
            return FALSE;            
        }                       
    }                                            

    public function total_search_preinscritos_admin($where)
    {                                                                                                                                                                                                                                                                                                                                          
        $query = $this->db->query("select COUNT(*) as total                                 
                                  from seg_dec_preinscritos as pre                                                                  
                                  inner join seg_dec_programas as pro on pro.id_program = pre.id_program and (pro.id_discipline = pre.id_discipline OR pro.id_discipline_alterna = pre.id_discipline)
                                  inner join seg_dec_pasos_status as status on status.id_preinscrito = pre.id_preinscrito 
                                  and status.pago_realizado = 0
                                  and status.caso_cerrado = 0                             
                                  and status.caso_inconcluso = 0  
                                  ".$where."");                                                                                                                                                                                                                                                  
        if($query->num_rows()>0)                                                                                                                                                                                                                      
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
             return $query->row();                             
        }                                                                                                                                                                                                                                                                                                                                                                  
        else
        {                                                                                                                                                                                                    
            return FALSE;            
        }                                                                               
    }                 

    public function search_preinscritos($where,$user_uuid,$start,$limit,$sidx,$sord)
    {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
        $query = $this->db->query("select pre.id_preinscrito,pre.nombre,pre.a_paterno,pre.a_materno,pre.fecha_registro,pro.program_name,pre.codigo,status.atendido,status.primer_contacto,status.documentos,status.envio_decse,status.envio_claves,status.pago_realizado    
                                  from seg_dec_preinscritos as pre                    
                                  inner join seg_dec_usuarios_programas as up on up.id_program = pre.id_program and up.id_discipline = pre.id_discipline     
                                  inner join seg_dec_programas as pro on pro.id_program = pre.id_program and (pro.id_discipline = pre.id_discipline OR pro.id_discipline_alterna = pre.id_discipline)  
                                  inner join seg_dec_pasos_status as status on status.id_preinscrito = pre.id_preinscrito             
                                  ".$where." 
                                  and status.pago_realizado = 0
                                  and status.caso_cerrado = 0                             
                                  and status.caso_inconcluso = 0                                                                                                                                                                                                                                                                                                                                                                                                                   
                                  and up.user_uuid='".$user_uuid."'      
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

    public function search_preinscritos_admin($where,$start,$limit,$sidx,$sord)
    {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
        $query = $this->db->query("select pre.id_preinscrito,pre.nombre,pre.a_paterno,pre.a_materno,pre.fecha_registro,pro.program_name,pre.codigo,status.primer_contacto,status.documentos,status.envio_decse,status.envio_claves,status.pago_realizado    
                                  from seg_dec_preinscritos as pre                                                                                                                                          
                                  inner join seg_dec_programas as pro on pro.id_program = pre.id_program and (pro.id_discipline = pre.id_discipline OR pro.id_discipline_alterna = pre.id_discipline) 
                                  inner join seg_dec_pasos_status as status on status.id_preinscrito = pre.id_preinscrito          
                                  ".$where." 
                                  and status.pago_realizado = 0
                                  and status.caso_cerrado = 0                             
                                  and status.caso_inconcluso = 0
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

    public function get_preinscrito($id_preinscrito)
    {                                                                                                                                                                                                                             
        $this->db->select('pre.id_preinscrito,pre.nombre,pre.a_paterno,pre.a_materno,pre.fecha_registro,pre.como_se_entero,pre.calle_numero,pre.colonia,pre.del_mpo,pre.cp,pre.ciudad,pre.estado,pre.rfc,pre.telefono,pre.celular,pre.correo,pre.nacionalidad,pre.grado_academico,pre.institucion_estudios,pre.exalumno,pre.porque_la_ibero,pre.empresa,pre.puesto,pre.direccion_empresa,pre.telefono_empresa,pre.codigo,pre.edad,pro.program_name,status.atendido');
        $this->db->select('status.primer_contacto,status.documentos,status.envio_decse,status.envio_claves,status.pago_realizado,status.caso_cerrado,status.caso_inconcluso,status.informes,status.atendido,status.comentario_general');
        $this->db->from('seg_dec_preinscritos as pre');                                                                                                                                                                                                                                                                                                                        
        $this->db->join('seg_dec_programas as pro','pro.id_program = pre.id_program and (pro.id_discipline = pre.id_discipline OR pro.id_discipline_alterna = pre.id_discipline)', 'inner');                  
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito', 'inner');            
        $this->db->where('pre.id_preinscrito',$id_preinscrito);                                                                                                                                                                  
        $query = $this->db->get();                                                                                                                                                                                                                                                                                               
        if($query->num_rows()>0)                                                                                                                                        
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
            return $query->row();                             
        }                                                                                                                                                                                                                                                                                                                                                                                                                           
        else
        {                                                                                                                                                                                                                                                          
            return FALSE;            
        }                                                      
    }                              				

    public function get_documents($id_preinscrito)
    {                                                                
        $this->db->select('doc.id_preinscrito,pre.nombre,pre.a_paterno,pre.a_materno,pre.fecha_registro,pre.como_se_entero,pre.calle_numero,pre.colonia,pre.del_mpo,pre.cp,pre.ciudad,pre.estado,pre.rfc,pre.telefono,pre.celular,pre.correo,pre.nacionalidad,pre.grado_academico,pre.institucion_estudios,pre.exalumno,pre.porque_la_ibero,pre.empresa,pre.puesto,pre.direccion_empresa,pre.telefono_empresa,pre.codigo,pre.edad,up.user_uuid,up.id_discipline,up.id_program,pro.program_name,status.atendido');
        $this->db->from('seg_dec_preinscritos as pre');                                                                                                                            
        $this->db->where('pre.id_preinscrito',$id_preinscrito);                                                                                                                                                                  
        $query = $this->db->get();                                                                                                                                                                                                                                                                           
        if($query->num_rows()>0)                                                                                                                                        
        {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
            return $query->row();                             
        }                                                                                                                                                                                                                                                                                                                                                                             
        else
        {                                                                                                                                                                                                                  
            return FALSE;            
        }                                               
    } 

    public function update_preinscrito($data)
    {                                      
        $this->db->trans_start();

        $this->db->set('nombre',$data['nombre']);                                                                                                                                                                                                                                                                                                               
        $this->db->set('a_paterno',$data['a_paterno']);                                                                                                                  
        $this->db->set('a_materno', $data['a_materno']);                                                                                           
        $this->db->set('fecha_registro', $data['fecha_registro']);                                    
        $this->db->set('calle_numero', $data['calle_numero']);
        $this->db->set('del_mpo',$data['del_mpo']);
        $this->db->set('cp',$data['cp']);
        $this->db->set('ciudad',$data['ciudad']);
        $this->db->set('estado',$data['estado']);
        $this->db->set('telefono',$data['telefono']);
        $this->db->set('celular',$data['celular']);
        $this->db->set('rfc',$data['rfc']);     
        $this->db->set('correo',$data['correo']);
        $this->db->set('institucion_estudios',$data['institucion_estudios']);
        $this->db->set('nacionalidad',$data['nacionalidad']);
        $this->db->set('grado_academico',$data['grado_academico']);
        $this->db->set('exalumno',$data['exalumno']);   
        $this->db->set('como_se_entero',$data['como_se_entero']); 
        $this->db->set('porque_la_ibero',$data['porque_la_ibero']); 
        $this->db->set('empresa',$data['empresa']); 
        $this->db->set('puesto',$data['puesto']);
        $this->db->set('direccion_empresa',$data['direccion_empresa']);
        $this->db->set('telefono_empresa',$data['telefono_empresa']); 

        $this->db->where('id_preinscrito', $data['id_preinscrito']);                                      
        $this->db->update('seg_dec_preinscritos');

        $this->db->set('primer_contacto',$data['primer_contacto']);
        $this->db->set('documentos',$data['documentos']);                                                                                                                                                                                                                                                                                                               
        $this->db->set('envio_decse',$data['envio_decse']);                                                                                                                  
        $this->db->set('envio_claves', $data['envio_claves']);                                                                                           
        $this->db->set('pago_realizado', $data['pago_realizado']); 

        $this->db->set('caso_cerrado', $data['caso_cerrado']);      
        $this->db->set('caso_inconcluso', $data['caso_inconcluso']); 
        $this->db->set('informes', $data['informes']);       
        $this->db->set('atendido', $data['atendido']);                                            
        $this->db->set('comentario_general', $data['comentario_general']); 

        $this->db->where('id_preinscrito', $data['id_preinscrito']);                                      
        $this->db->update('seg_dec_pasos_status');

        if(isset($data['documento_upload']))
        {                                                                          
            $this->db->insert_batch('seg_dec_documentos', $data['documento_upload']);           
        }                                                                                                                                      

        if(isset($data['comment_insert']))
        {
            $this->db->insert_batch('seg_dec_comentarios', $data['comment_insert']); 
        }                                                                                                                                                              

        if(isset($data['comment_update']))
        {                                                                 
             $this->db->update_batch('seg_dec_comentarios', $data['comment_update'],'id_comentario'); 
        }                                                                                                                                                                                                      

        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE)
        {                                                                                                                                             
            return FALSE;
        }else
        {                                                                                                                             
            return TRUE; 
        }                                                                                                                                                                                
    }                          

    public function get_id_comentario($id_preinscrito,$id_paso)
    {                                                                                                                                                                                                                                    
        $this->db->select('id_comentario');                       
        $this->db->from('seg_dec_comentarios');                  
        $this->db->where('id_preinscrito',$id_preinscrito);
        $this->db->where('id_paso',$id_paso);
        $query = $this->db->get();                                                                                            
        if($query->num_rows()>0)                                                                                
        {                                                                                
            return $query->row();
        }else{                                    
            return FALSE;
        }                                
    }          

    public function get_comentario($id_preinscrito,$id_paso)
    {                                                                                                                                                                                                                                                                            
        $this->db->select('comentario');                       
        $this->db->from('seg_dec_comentarios');                  
        $this->db->where('id_preinscrito',$id_preinscrito);
        $this->db->where('id_paso',$id_paso);
        $query = $this->db->get();                                                                                            
        if($query->num_rows()>0)                                                                                
        {                                                                                
            return $query->row();
        }else{                  
            return FALSE;
        }                                 
    }  

    public function comentarios_pasos($id_preinscrito)
    {                                                                                                                                                                                                                                                                                                                      
        $this->db->select('id_paso,comentario');                       
        $this->db->from('seg_dec_comentarios');                          
        $this->db->where('id_preinscrito',$id_preinscrito);
        $query = $this->db->get();                                                                                                      
        if($query->num_rows()>0)                                                                                
        {                                                                                                                             
            return $query->result();
        }else{                  
            return FALSE;
        }                                 
    }                               

    public function get_documentos($id_preinscrito)
    {                       
        $this->db->select('id_documento,doc_type,archivo');                       
        $this->db->from('seg_dec_documentos');         
        $this->db->where('id_preinscrito',$id_preinscrito);
        $query = $this->db->get();                                                                                  
        if($query->num_rows()>0)                                                                                
        {                                                             
            return $query->result();
        }else{                  
            return FALSE;
        }                 
    }                                     

    public function get_program_name($id_preinscrito)
    {                                          
        $this->db->select('pro.program_name');      
        $this->db->join('seg_dec_programas as pro','pre.id_program = pro.id_program', 'left');                  
        $this->db->from('seg_dec_preinscritos as pre');         
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
        $this->db->trans_start();

        $delete = array('seg_dec_preinscritos','seg_dec_pasos_status');
        $this->db->where('id_preinscrito',$id_preinscrito);
        $this->db->delete($delete);  

        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE)
        {                                                                                                                                                      
            return FALSE;
        }else
        {                                                                                                      
            return TRUE; 
        }                   
    }               


    public function ex_user($user_uuid,$sidx,$sord)
    {                                                                                                                                                                                                                                                                                                                                                                      
        $this->db->select('pre.id_preinscrito,pre.nombre,pre.a_paterno,pre.a_materno,pre.fecha_registro,pre.codigo,pro.program_name,status.primer_contacto,status.documentos,status.envio_decse,status.envio_claves,status.pago_realizado');
        $this->db->from('seg_dec_preinscritos as pre');                                                                                                                                                                                                                                                                                                                                                                                                                         
        $this->db->join('seg_dec_usuarios_programas as up','up.id_program = pre.id_program and up.id_discipline = pre.id_discipline', 'inner');
        $this->db->join('seg_dec_programas as pro','pro.id_program = pre.id_program and (pro.id_discipline = pre.id_discipline OR pro.id_discipline_alterna = pre.id_discipline)', 'inner');                                                        
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito', 'inner');                                                                                                                                                                                                                                                                                      
        $this->db->where('status.pago_realizado',0);                
        $this->db->where('status.caso_cerrado',0); 
        $this->db->where('status.caso_inconcluso',0); 
        $this->db->where('up.user_uuid',$user_uuid);                                                                                                                                                                                                                                                                                                                      
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
        $this->db->join('seg_dec_programas as pro','pro.id_program = pre.id_program and (pro.id_discipline = pre.id_discipline OR pro.id_discipline_alterna = pre.id_discipline)','inner');                                                          
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito','inner');                                                                                                                                                                                                           
        $this->db->where('status.pago_realizado',0); 
        $this->db->where('status.caso_cerrado',0); 
        $this->db->where('status.caso_inconcluso',0); 
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
                                  inner join seg_dec_usuarios_programas as up on up.id_program = pre.id_program and up.id_discipline = pre.id_discipline 
                                  inner join seg_dec_programas as pro on pro.id_program = pre.id_program and (pro.id_discipline = pre.id_discipline OR pro.id_discipline_alterna = pre.id_discipline)                    
                                  inner join seg_dec_pasos_status as status on status.id_preinscrito = pre.id_preinscrito          
                                  ".$where."                                
                                  and status.pago_realizado = 0
                                  and status.caso_cerrado = 0                             
                                  and status.caso_inconcluso = 0                                                                                                                                                           
                                  and up.user_uuid='".$user_uuid."'      
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
                                  inner join seg_dec_programas as pro on pro.id_program = pre.id_program and (pro.id_discipline = pre.id_discipline OR pro.id_discipline_alterna = pre.id_discipline)
                                  inner join seg_dec_pasos_status as status on status.id_preinscrito = pre.id_preinscrito          
                                  ".$where." 
                                  and status.pago_realizado = 0
                                  and status.caso_cerrado = 0                             
                                  and status.caso_inconcluso = 0
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
        $this->db->join('seg_dec_preinscritos as pre','up.id_program = pre.id_program and up.id_discipline = pre.id_discipline','inner'); 
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito','inner'); 
        $this->db->where('status.pago_realizado',0); 
        $this->db->where('status.caso_cerrado',0); 
        $this->db->where('status.caso_inconcluso',0); 
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
        $this->db->join('seg_dec_usuarios_programas as up','up.id_program = pro.id_program  and (up.id_discipline = pro.id_discipline OR up.id_discipline = pro.id_discipline_alterna)','inner');
        $this->db->join('seg_dec_preinscritos as pre','up.id_program = pre.id_program and up.id_discipline = pre.id_discipline','inner');
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito','inner'); 
        $this->db->where('up.user_uuid',$user_uuid);                                                                                                                                                                                                                             
        $this->db->where('pre.id_discipline',$id_discipline);                                                                                                                                                                                                                          
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
        $this->db->join('seg_dec_preinscritos as pre','pro.id_program = pre.id_program and (pre.id_discipline = pro.id_discipline OR pre.id_discipline = pro.id_discipline_alterna)','inner');
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito','inner');
        $this->db->where('pre.id_discipline',$id_discipline);                                                                             
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
        $this->db->join('seg_dec_usuarios_programas as up','up.id_program = pro.id_program and (up.id_discipline = pro.id_discipline OR up.id_discipline = pro.id_discipline_alterna)','inner');                        
        $this->db->join('seg_dec_preinscritos as pre','up.id_program = pre.id_program and up.id_discipline = pre.id_discipline','inner');               
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito','inner');
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
        $this->db->join('seg_dec_preinscritos as pre','pro.id_program = pre.id_program and (pre.id_discipline = pro.id_discipline OR pre.id_discipline = pro.id_discipline_alterna)','inner');
        $this->db->join('seg_dec_pasos_status as status','status.id_preinscrito = pre.id_preinscrito','inner');                        
        $this->db->where('pre.id_discipline',$id_discipline);                                                                                                                         
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