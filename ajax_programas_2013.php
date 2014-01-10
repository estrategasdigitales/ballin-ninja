<?php require_once('Connections/nov2013.php');
						
	$id_discipline = $_GET['id_discipline'];
	$response = '';
																																		
	try{																																																																																											
	    $db = new PDO("mysql:host=$host;dbname=$dbname","$username","$password",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));																																													
	}catch(PDOException $e){															
		echo "Error !!: " . $e->getMessage() . "<br/>";
		die();																																									
	}																																																																																				

	$stmt = $db->prepare("SELECT id_program,program_name,program_type from seg_dec_programas where (id_discipline='".$id_discipline."' OR id_discipline_alterna='".$id_discipline."')"); 
    $stmt->execute();																																																							
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);					
    $response .= '<select name="id_program" id="id_program" style="width:540px; max-width:540px;">
		<option value="0" selected="selected" disabled="disabled">Selecciona un programa</option>';

	    foreach($result as $value){								  						
	    	if($value['program_type']=='programahp'){
	    		$programahp[]= '<option value="'.$value['id_program'].'">'.utf8_encode($value['program_name']).'</option>'; 
	    	}						

	    	if($value['program_type']=='diplomado'){
	    		$diplomado[]= '<option value="'.$value['id_program'].'">'.utf8_encode($value['program_name']).'</option>'; 
	    	}			

	    	if($value['program_type']=='curso'){
	    		$curso[]= '<option value="'.$value['id_program'].'">'.utf8_encode($value['program_name']).'</option>'; 
	    	}	

	    	if($value['program_type']=='programa'){
	    		$programa[]= '<option value="'.$value['id_program'].'">'.utf8_encode($value['program_name']).'</option>'; 
	    	}																																																																																																											
	    }																									

	    if(isset($programahp))
	    {																	
	    	$response.=	'<option disabled="disabled">-----PROGRAMAS HP---</option>';	
	    	$response.= implode(' ',$programahp);					
	    }	

	    if(isset($diplomado))
	    {																	
	    	$response.=	'<option disabled="disabled">-----DIPLOMADO---</option>';	
	    	$response.= implode(' ',$diplomado);					
	    }				

	    if(isset($curso))
	    {																	
	    	$response.=	'<option disabled="disabled">-----CURSO---</option>';	
	    	$response.= implode(' ',$curso);					
	    }

	    if(isset($programa))
	    {																	
	    	$response.=	'<option disabled="disabled">-----PROGRAMA---</option>';	
	    	$response.= implode(' ',$programa);					
	    }																																														
    $response .= '</select>';
    echo $response;																																																					
?>