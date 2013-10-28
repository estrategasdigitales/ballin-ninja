<html>
<title>&Aacute;rea de Administraci&oacute;n</title>
<head>
	<link rel="stylesheet" href="<?php echo base_url('includes/admin/css/estilos.css'); ?>" media="screen">
</head>						
<div id="contenedor">			
	<?php echo form_open('acceso/login/acceso'); ?>	 
			<div id="error_login">					
			<span class="red"><?php echo validation_errors(); ?></span>  
			<span class="red"><?php echo isset($error)?$error:''; ?></span>			
			</div>			
			<table align="center">
				<tr>									
					<td align="center" colspan="2">				
						Administrador
					</td>											
				</tr>			
				<tr>
					<td>	
						<span class="alert cont">Usuario</span>
					</td>
					<td>
						<input type="text" name="username" id="username"/>
					</td>		
				</tr>
				<tr>
					<td>

						<span class="alert">Password</span>
					</td>
					<td>
						<input type="password" name="pass" id="pass"/>
					</td>
				</tr>
			</table>							
			<div id="button_login">																		
			<input name=submit type=submit value="Entrar" class="botones">
			</div>					
	</form>							
 </div>	
</body>
</html>
