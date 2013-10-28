<?
foreach($areas AS $i => $area){
       $are = $area['area_id'];
     	  
        foreach ($ubicaciones  AS $i => $ubicacion) {
         	
      $sqlQuery = "SELECT empresa_id,
                          almacen_id,
                          area_id,
                          ubicacion_id,
                          descripcion,
                          localizacion,
                          estatus
                  FROM   inventario_cat_almacenes_ubicaciones
                  WHERE  almacen_id    = '" . $almacen_id . "'
                  AND    ubicacion_id  = '" . $ubicacion["ubicacion_id"] . "'
                  AND    area_id       = '" . $are . "'";
                  
				if (!Database::ExistRecord($rs, $sqlQuery, $Sistem->Database)) {
						 	
      	   $sqlQuery = "INSERT INTO inventario_cat_almacenes_ubicaciones
                             (empresa_id,
                              almacen_id,
                              area_id,
                              ubicacion_id,
                              descripcion,
                              localizacion,
                              estatus,
                              actualizacion_usuario_id,
                              actualizacion_fecha)
                      VALUES (" . Database::BlankToNull($Sistem->Empresa->GetAttribute("empresa_id")) . ",
                              " . Database::BlankToNull($almacen_id) . ",
                              " . Database::BlankToNull($are) . ",
                              " . Database::BlankToNull($ubicacion["ubicacion_id"]) . ",
                              " . Database::BlankToNull($ubicacion["descripcion"]) . ",
                              " . Database::BlankToNull($ubicacion["localizacion"]) . ",
                              " . Database::BlankToNull($ubicacion["estatus"]) . ",
                              " . Database::BlankToNull($Sistem->Usuario->GetAttribute("usuario_id")) . ",
                              current_timestamp)";
						
              }  
                          
         else{
       	
            $sqlQuery = "UPDATE inventario_cat_almacenes_ubicaciones SET
                            descripcion   = " . Database::BlankToNull($ubicacion["descripcion"]) . ",
                            localizacion  = " . Database::BlankToNull($ubicacion["localizacion"]) . ",
                            estatus       = " . Database::BlankToNull($ubicacion["estatus"]) . ",
                            actualizacion_usuario_id = " . Database::BlankToNull($Sistem->Usuario->GetAttribute("usuario_id")) . ",
                            actualizacion_fecha      = current_timestamp
                         WHERE empresa_id = " . Database::BlankToNull($Sistem->Empresa->GetAttribute("empresa_id")) . "
                         AND   almacen_id = " . Database::BlankToNull($almacen_id) . "
                         AND   area_id    = " . Database::BlankToNull($are);
								 
								 
			}
         $db->Command($sqlQuery);            
      }
     
     }

     ?>