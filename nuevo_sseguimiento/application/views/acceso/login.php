<!--<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8"/>
	<title>Sistema de seguimiento</title>
	<link rel="stylesheet" href="<?php echo base_url('includes/admin/css/estilos.css'); ?>" media="screen">
</head>														
<div id="contenedor">			
	<?php echo form_open('acceso/login/acceso'); ?>	 									
			<table align="center">		
				<tr>		
					<td colspan="2" align="center">
						<div class="error_login">					
							<span><?php echo validation_errors(); ?></span>  
							<span><?php echo isset($error)?$error:''; ?></span>			
						</div>								
					</td>																
				</tr>			
				<tr>									
					<td colspan="2" align="center" id="td_red">				
						Ibero
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
				<tr>											
					<td colspan="2" align="center">																		
						<input name="submit" type="submit" value="Entrar" class="botones">
					</td>																		
				</tr>									
			</table>											
	</form>							
 </div>	
</body>
</html>-->	
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8"/>
	<title>Sistema de seguimiento</title>
	<style>
									
	.login{									
		border:1px solid #666666;
		width:270px;					
		margin:110px auto;
	}																								

	.divIn{
		display:block;
		margin-bottom: 5px;
	}																			

	label{							
		display:inline-block;
		width: 80px;	
		text-align: right;
		margin-right: 2px;		
		color: red;		 		
	}		
				
	.error_login{
		color: red;
		padding-left: 15px;	
		padding-top: 10px;				 	
	}							
															
	#inputs{				
		display: block;					
		padding-left: 15px;
		margin-top: 20px;					
		margin-bottom: 10px;
		font-size: 14px;			
	}																																

	.logo{		
		display: block;
		background: red;
		color:#FFFFFF;
		width:100%;
		height:35px;		
		font-family: Verdana,Geneva,sans-serif;
    	font-size: 20px;
    	padding-top: 2px;
	}											

	.logo span{
		margin:5px;
	}																								

	#button_submit{
		text-align: center;
	}																																											
	</style>
</head>
<body>			
	<div class="login">	
		<?php echo form_open('acceso/login/acceso'); ?>	
			<div class="logo">
				<span>IBERO</span>		
			</div>												
			<div class="error_login">					
				<span><?php echo validation_errors(); ?></span>  
				<span><?php echo isset($error)?$error:''; ?></span>			
			</div>																														 
			<div id="inputs">																														
				<div class="divIn"><label>Usuario:</label><input type="text" name="username" id="username"/></div>
				<div class="divIn"><label>Password:</label><input type="password" name="pass" id="pass"/></div>	
				<div id="button_submit"><input name="submit" type="submit" value="Entrar" class="botones"></div>
			</div>					
		</form>						
	</div>					
</body>
</html>			