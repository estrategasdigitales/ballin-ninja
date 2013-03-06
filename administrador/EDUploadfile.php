<?php
/*
*
* File: EDUploadFile.php
* Author: Juan Luis Almazo
* Copyright: Estrategas Digitales 2011
* Date: 29/10/2011
* 
*/

$GLOBALS['normalizeChars'] = array(
	'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
	'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
	'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
	'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
	'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
	'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
	'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f', 'ñ'=>'n', ':'=>'-', ','=>'-',
	';'=>'-'
);
 
function cleanForShortURL($fileName) {
	$fileName2 = str_replace('&', '-and-', $fileName);
	$fileName2 = str_replace(' ', '_', $fileName);
   
	return strtr($fileName2, $GLOBALS['normalizeChars']);
}


function uploadImage($fileID, $directory, $imageWidth, $imageHeight, $thumbWidth, $thumbHeight){
	
	/*
	echo "imageWidth = |" . $imageWidth . "|<br />";
	echo "imageHeight = |" . $imageHeight . "|<br />";
	echo "thumbWidth = |" . $thumbWidth . "|<br />";
	echo "thumbHeight = |" . $thumbHeight . "|<br />";	
	*/
	
	$FILE = $_FILES[$fileID]['tmp_name'];
	$FILE_NAME = $_FILES[$fileID]['name'];
	
	//-----
	$nombre_N = explode(".",$FILE_NAME);
		
	$file_name_cool = utf8_decode($nombre_N[0]);
	$file_name_cool0 = str_replace(' ','_',$file_name_cool);
	$file_name_cool1 = str_replace('á','a',$file_name_cool0);
	$file_name_cool2 = str_replace('é','e',$file_name_cool1);
	$file_name_cool3 = str_replace('í','i',$file_name_cool2);
	$file_name_cool4 = str_replace('ó','o',$file_name_cool3);
	$file_name_cool5 = str_replace('ú','u',$file_name_cool4);
	$file_name_cool6 = str_replace('ñ','ni',$file_name_cool5);
	$file_name_cool7 = str_replace('Á','A',$file_name_cool6);
	$file_name_cool8 = str_replace('É','E',$file_name_cool7);
	$file_name_cool9 = str_replace('Í','I',$file_name_cool8);
	$file_name_cool10 = str_replace('Ó','O',$file_name_cool9);
	$file_name_cool11 = str_replace('Ú','U',$file_name_cool10);
	$file_name_cool12 = str_replace('Ñ','NI',$file_name_cool11);
	
	//$random_suffix = generatePassword(5,2);
	
	//$FILE_NAME = $file_name_cool12."_".$random_suffix.".".$nombre_N[1];

	//-----
	
	$fileName_final = cleanForShortURL($FILE_NAME);
	
	if($FILE != NULL){

		//////////// BIG IMAGE  /////////////////////////////////////////////////////////
		
		// If big image is required.
		if($imageWidth != NULL || $imageHeight != NULL){
	
			if(is_numeric($imageWidth) || is_numeric($imageHeight)){
						
				// resample image
				$image = new SimpleImage();
				$image->load($FILE);
									
				if(is_numeric($imageWidth) && is_numeric($imageHeight)){
					
					if (($image->getWidth() > $imageWidth) || ($image->getHeight() > $imageHeight)) 
					{
						if($image->getWidth() > $imageWidth){
							
							$image->resizeToWidth($imageWidth);
						}
						
						if($image->getHeight() > $imageHeight){
							
							$image->resizeToHeight($imageHeight);
						}
					}
					
				}else{
	
					if(is_numeric($imageWidth) && !is_numeric($imageHeight)){
						
						if ($image->getWidth() > $imageWidth){ 
							$image->resizeToWidth($imageWidth);
						}
						
					}else{
						
						if(!is_numeric($imageWidth) && is_numeric($imageHeight)){
							
							if($image->getHeight() > $imageHeight){
								$image->resizeToHeight($imageHeight);
							}
						}
						
					}
				}
											
				// if directory doesn't exist, it is created.
				if(!file_exists($directory)){
					mkdir($directory, 0777, true);
				}
				
				// save image into directory.
				$image->save($directory . $fileName_final);
				
			}// close: if(!is_numeric($imageWidth) && !is_numeric($imageHeight))
			
		}

		//////////// THUMBNAIL  /////////////////////////////////////////////////////////
		
		// If thumbnail is required.
		if($thumbWidth != NULL || $thumbHeight != NULL){

			if(is_numeric($thumbWidth) || is_numeric($thumbHeight)){
		
				// resample thumbnail
				$thumb = new SimpleImage();
				$thumb->load($FILE);
									
				if(is_numeric($thumbWidth) && is_numeric($thumbHeight)){
					
					if (($thumb->getWidth() > $thumbWidth) || ($thumb->getHeight() > $thumbHeight)) 
					{
						if($thumb->getWidth() > $thumbWidth){
							
							$thumb->resizeToWidth($thumbWidth);
						}
						
						if($thumb->getHeight() > $thumbHeight){
							
							$thumb->resizeToHeight($thumbHeight);
						}
					}
					
				}else{

					if(is_numeric($thumbWidth) && !is_numeric($thumbHeight)){
						
						if ($thumb->getWidth() > $thumbWidth){ 
							$thumb->resizeToWidth($thumbWidth);
						}
						
					}else{
						
						if(!is_numeric($thumbWidth) && is_numeric($thumbHeight)){
							
							if($thumb->getHeight() > $thumbHeight){
								$thumb->resizeToHeight($thumbHeight);
							}
						}
						
					}
				}
							
				$thumbnailsDirectory = $directory . "thumbs/";
				
				// if directory doesn't exist, it is created.
				if(!file_exists($thumbnailsDirectory)){
					mkdir($thumbnailsDirectory, 0777, true);
				}
				
				// save thumb into thumbnails directory.
				$thumb->save($thumbnailsDirectory . $fileName_final);
				
			}// close: if(!is_numeric($thumbWidth) && !is_numeric($thumbHeight))
			
		}// close: if($thumbWidth != NULL || $thumbHeight != NULL)
		
		//////////// THUMBNAIL ENDS HERE /////////////////////////////////////////////////

		// delete temporary uploaded file.
		unlink($FILE);
		
		return $fileName_final;
		
	} else{ // close: if($FILE != NULL)
		
		return NULL;
		
	}
}


function uploadFile($fileID, $directory){
	
	$FILE = $_FILES[$fileID]['tmp_name'];
	$FILE_NAME = $_FILES[$fileID]['name'];
	
	$fileName_final = cleanForShortURL($FILE_NAME);
	
	if($FILE != NULL){
		
		// if directory doesn't exist, it is created.
		if(!file_exists($directory)){
			mkdir($directory, 0777, true);
		}
		
		$full_path = $directory . $fileName_final;
		
		// save the file into directory
		move_uploaded_file($FILE, $full_path);
		
		// delete temporary uploaded file.
		unlink($FILE);
		
		return $fileName_final;
	} else{
		
		return NULL;
	}
}

?>
