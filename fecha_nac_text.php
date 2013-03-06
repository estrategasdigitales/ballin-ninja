<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.js"></script>
<script>
var anio_f=00;
var mes_f=00;
var dia_f=00;
function populate_month(dia){
		if(dia==31){
		$('select#mes_nac').html('<option selected="selected" disabled="disabled">- Mes -</option><option value="01">Enero</option><option value="03">Marzo</option><option value="05">Mayo</option><option value="07">Julio</option><option value="08">Agosto</option><option value="10">Octubre</option><option value="12">Diciembre</option>');
		}else if(dia==30){
		$('select#mes_nac').html('<option selected="selected" disabled="disabled">- Mes -</option><option value="01">Enero</option><option value="03">Marzo</option><option value="04">Abril</option><option value="05">Mayo</option><option value="06">Junio</option><option value="07">Julio</option><option value="08">Agosto</option><option value="09">Septiembre</option><option value="10">Octubre</option><option value="11">Noviembre</option><option value="12">Diciembre</option>');
		}else{
		$('select#mes_nac').html('<option selected="selected" disabled="disabled">- Mes -</option><option value="01">Enero</option><option value="02">Febrero</option><option value="03">Marzo</option><option value="04">Abril</option><option value="05">Mayo</option><option value="06">Junio</option><option value="07">Julio</option><option value="08">Agosto</option><option value="09">Septiembre</option><option value="10">Octubre</option><option value="11">Noviembre</option><option value="12">Diciembre</option>');
		}
		dia_f=dia;
}
function populate_year(mes){
	if(($('select#dia_nac').val()==29)&&(mes==02)){
		$('select#anio_nac').html('<option value="08">2008</option><option value="04">2004</option><option value="00">2000</option><option value="96">1996</option><option value="92">1992</option><option value="88">1988</option><option value="84">1984</option><option value="80">1980</option><option value="76">1976</option><option value="72">1972</option><option value="68">1968</option><option value="64">1964</option><option value="60">1960</option><option value="56">1956</option><option value="52">1952</option><option value="48">1948</option><option value="44">1944</option><option value="40">1940</option><option value="36">1936</option><option value="32">1932</option><option value="28">1928</option><option value="24">1924</option><option value="20">1920</option><option value="16">1916</option><option value="12">1912</option><option value="08">1908</option><option value="04">1904</option><option value="00">1900</option>');
	}else{
		$('select#anio_nac').html('<option selected="selected" disabled="disabled">- Año -</option><option value="11">2011</option><option value="10">2010</option><option value="09">2009</option><option value="08">2008</option><option value="07">2007</option><option value="06">2006</option><option value="05">2005</option><option value="04">2004</option><option value="03">2003</option><option value="02">2002</option><option value="01">2001</option><option value="00">2000</option><option value="99">1999</option><option value="98">1998</option><option value="97">1997</option><option value="96">1996</option><option value="95">1995</option><option value="94">1994</option><option value="93">1993</option><option value="92">1992</option><option value="91">1991</option><option value="90">1990</option><option value="89">1989</option><option value="88">1988</option><option value="87">1987</option><option value="86">1986</option><option value="85">1985</option><option value="84">1984</option><option value="83">1983</option><option value="82">1982</option><option value="81">1981</option><option value="80">1980</option><option value="79">1979</option><option value="78">1978</option><option value="77">1977</option><option value="76">1976</option><option value="75">1975</option><option value="74">1974</option><option value="73">1973</option><option value="72">1972</option><option value="71">1971</option><option value="70">1970</option><option value="69">1969</option><option value="68">1968</option><option value="67">1967</option><option value="66">1966</option><option value="65">1965</option><option value="64">1964</option><option value="63">1963</option><option value="62">1962</option><option value="61">1961</option><option value="60">1960</option><option value="59">1959</option><option value="58">1958</option><option value="57">1957</option><option value="56">1956</option><option value="55">1955</option><option value="54">1954</option><option value="53">1953</option><option value="52">1952</option><option value="51">1951</option><option value="50">1950</option><option value="49">1949</option><option value="48">1948</option><option value="47">1947</option><option value="46">1946</option><option value="45">1945</option><option value="44">1944</option><option value="43">1943</option><option value="42">1942</option><option value="41">1941</option><option value="40">1940</option><option value="39">1939</option><option value="38">1938</option><option value="37">1937</option><option value="36">1936</option><option value="35">1935</option><option value="34">1934</option><option value="33">1933</option><option value="32">1932</option><option value="31">1931</option><option value="30">1930</option><option value="29">1929</option><option value="28">1928</option><option value="27">1927</option><option value="26">1926</option><option value="25">1925</option><option value="24">1924</option><option value="23">1923</option><option value="22">1922</option><option value="21">1921</option><option value="20">1920</option><option value="19">1919</option><option value="18">1918</option><option value="17">1917</option><option value="16">1916</option><option value="15">1915</option><option value="14">1914</option><option value="13">1913</option><option value="12">1912</option><option value="11">1911</option><option value="10">1910</option><option value="09">1909</option><option value="08">1908</option><option value="07">1907</option><option value="06">1906</option><option value="05">1905</option><option value="04">1904</option><option value="03">1903</option><option value="02">1902</option><option value="01">1901</option><option value="00">1900</option>');
	}
	mes_f=mes;
}
function populate_rfc(anio){
	var pat = $('input#paterno').val().substr(0,2);
	var mat = $('input#materno').val().substr(0,1);
	var nom = $('input#nombre').val().substr(0,1);
	var rfc_siglas = pat.toUpperCase()+mat.toUpperCase()+nom.toUpperCase();
	$('input#rfc01').attr('value',rfc_siglas);
	var rfc_numbers = anio+mes_f+dia_f;
	$('input#rfc02').attr('value',rfc_numbers);
}
function unpopulate_rfc(){
	$('input#rfc01').attr('value','');
	$('input#rfc02').attr('value','');
}
</script>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
	<p>
		<input name="nombre" type="text" id="nombre" value="" />
	nombre</p>
	<p>
		<input type="text" name="paterno" id="paterno" value="" />
	paterno</p>
	<p>
		<input type="text" name="materno" id="materno" value="" />
	materno</p>
	<table width="300" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<select name="dia_nac" id="dia_nac" onchange="populate_month(this.value); unpopulate_rfc();">
					<option selected="selected" disabled="disabled">- Día -</option>
					<option value="01">1</option>
					<option value="02">2</option>
					<option value="03">3</option>
					<option value="04">4</option>
					<option value="05">5</option>
					<option value="06">6</option>
					<option value="07">7</option>
					<option value="08">8</option>
					<option value="09">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
					<option value="25">25</option>
					<option value="26">26</option>
					<option value="27">27</option>
					<option value="28">28</option>
					<option value="29">29</option>
					<option value="30">30</option>
					<option value="31">31</option>
				</select> 
			</td>
			<td>
				<select name="mes_nac" id="mes_nac" onchange="populate_year(this.value); unpopulate_rfc();">
				</select>
			</td>
			<td>
				<select name="anio_nac" id="anio_nac" onchange="populate_rfc(this.value);">
				</select>
			</td>
		</tr>
	</table>
	<p>
		<input name="rfc01" type="text" id="rfc01" value="" size="4" maxlength="4" />
		<input name="rfc02" type="text" id="rfc02" value="" size="6" maxlength="6" />
		<input name="rfc03" type="text" id="rfc03" value="" size="3" maxlength="3" />
	</p>
</form>
</body>
</html>