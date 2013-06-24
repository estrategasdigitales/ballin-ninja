<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="container">
  <div id="header">
    <div id="logos">
      <div style="float:left;"><a href="http://uia.mx/" target="_blank"><img src="imagenes/logo_UIA.jpg" alt="logo" width="100" height="78" border="0" /></a> <a href="../index.php"><img src="imagenes/logo_DEC.jpg" alt="DEC" width="90" height="78" border="0" /></a></div>
      <div style="float:left; margin:10px;" >
        <h1>Sistema de seguimiento de preinscripciones</h1>
        <h2>Administrador del área Arquitectura </h2>
      </div>
      <div id="home_link">
        <form action="" method="post" name="form2" id="form2">
          <table width="100%" cellspacing="0" cellpadding="0" border="0">
            <tbody>
              <tr>
                <td valign="top" align="right"><label>Área:
                    <select onchange="MM_jumpMenu('parent', this, 0);" id="area_select" name="area_select" class="contenido_diplo">
                      <option value="s_seguimiento.php?discipline=1&amp;id_program=0">Arquitectura</option>
                      <option value="s_seguimiento.php?discipline=2&amp;id_program=0">Arte</option>
                      <option value="s_seguimiento.php?discipline=3&amp;id_program=0">Diseño</option>
                      <option value="s_seguimiento.php?discipline=4&amp;id_program=0">Comunicación</option>
                      <option value="s_seguimiento.php?discipline=5&amp;id_program=0">Desarrollo Humano</option>
                      <option value="s_seguimiento.php?discipline=6&amp;id_program=0">Salud</option>
                      <option value="s_seguimiento.php?discipline=7&amp;id_program=0">Política y Derecho</option>
                      <option value="s_seguimiento.php?discipline=8&amp;id_program=0">Negocios</option>
                      <option value="s_seguimiento.php?discipline=9&amp;id_program=0">Tecnología</option>
                      <option value="s_seguimiento.php?discipline=10&amp;id_program=0">Humanidades</option>
                      <option value="s_seguimiento.php?discipline=11&amp;id_program=0">Gastronomía</option>
                      <option value="s_seguimiento.php?discipline=12&amp;id_program=0">Preparatoria Abierta</option>
                      <option value="s_seguimiento.php?discipline=13&amp;id_program=0">Xochitla</option>
                      <option value="s_seguimiento.php?discipline=14&amp;id_program=0">Idiomas</option>
                      <option value="s_seguimiento.php?discipline=15&amp;id_program=0">Ibero Online</option>
                      <option value="s_seguimiento.php?discipline=16&amp;id_program=0">Atención Integral a Empresas</option>
                      <option value="s_seguimiento.php?discipline=17&amp;id_program=0">Atención Integral al Sector Público</option>
                      <option value="s_seguimiento.php?discipline=18&amp;id_program=0">Ciencias Religiosas</option>
                      <option value="s_seguimiento.php?discipline=19&amp;id_program=0">Casa Barragán</option>
                    </select>
                  </label></td>
              </tr>
              <tr>
                <td valign="top" align="right"><select onchange="MM_jumpMenu('parent', this, 0);" id="area_select" name="area_select" class="contenido_diplo">
                    <option value="s_seguimiento.php?discipline=&amp;id_program=0">Todos los programas</option>
                    <option disabled="disabled">-------DIPLOMADOS-------</option>
                    <option disabled="disabled">---------CURSOS---------</option>
                  </select></td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>
    <div class="espacio"> </div>
  </div>
  <div id="menu">
    <ul>
      <li><a href="#">Preinscritos</a></li>
      <li><a href="#">Inscritos</a></li>
      <li><a href="#">Casos Cerrados</a></li>
      <li><a href="#">Casos inconclusos</a></li>
      <li><a href="#">Informes</a></li>
      <li><a href="#">Gráficas</a></li>
      <li>
        <input name="buscar" type="text" id="buscar" />
        <input type="submit" name="enviar" id="enviar" value="Enviar">
      </li>
    </ul>
  </div>
  <h3>Arquitectura + Diplomado Interiores + Preinscritos </h3>
  <table width="100%" border="0" cellpadding="5" cellspacing="0" class="tablas">
    <tr class="titulo_tabla">
      <td>Nombre</td>
      <td>Programa de interés </td>
      <td>Fecha de preinscripción</td>
      <td>Primer Contacto</td>
      <td>Negociación académica</td>
      <td>Documentos</td>
      <td>Envío de claves</td>
      <td>Pago Realizado</td>
      <td>&nbsp;</td>
    </tr>
    <tr class="blanco_tabla">
      <td>Taylor Pressman, Maura Adrienne </td>
      <td>Diplomado - Diseño de espacios interiores </td>
      <td>10/ene/12</td>
      <td ><img src="imagenes/greenBall.jpg" width="15" height="15" /></td>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td>&nbsp;</td>
      <td >&nbsp;</td>
      <td><input type="submit" name="eliminar" id="eliminar" value="Eliminar"></td>
    </tr>
    <tr class="gris_tabla">
      <td>Gomez, Pedro </td>
      <td>Diplomado - Diseño de espacios interiores </td>
      <td>10/ene/12</td>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td ><img src="imagenes/greenBall.jpg" width="15" height="15" /></td>
      <td>&nbsp;</td>
      <td >&nbsp;</td>
      <td><input type="submit" name="eliminar" id="eliminar" value="Eliminar"></td>
    </tr>
    <tr class="blanco_tabla">
      <td>Taylor Pressman, Maura Adrienne </td>
      <td>Diplomado - Diseño de espacios interiores </td>
      <td>10/ene/12</td>
      <td ><img src="imagenes/greenBall.jpg" width="15" height="15" /></td>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td>&nbsp;</td>
      <td >&nbsp;</td>
      <td><input type="submit" name="eliminar" id="eliminar" value="Eliminar"></td>
    </tr>
  </table>
  <div class="espacio"> </div>
  <ul id="pagination-flickr">
    <li class="previous-off">« Anterior</li>
    <li class="active">1</li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#">6</a></li>
    <li><a href="#">7</a></li>
    <li class="next"><a href="#">Siguiente »</a></li>
  </ul>
</div>
</body>
</html>
