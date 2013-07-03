  <?php
/*
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
* Archivo: db.model.php
* Fecha: 27/06/2013
* Creador: Eric Bravo para Estrategas Digitales
* Descripcion: Modelo para conexión a la Base de Datos
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
* Historico
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
* 
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */

Class Db{

  private $host;
	private $database;
	private $user;
	private $passwd;
	private $link;
	private $stmt;
	private $array;

	static $_instance;


	private function __construct(){
		$this->setConexion();
		$this->conectar();
	}

	/*private function __destruct(){

	}*/
		
	//Método para establecer los parámetros de la conexión
	private function setConexion(){
		require 'config.class.php';
		$conf = Conf::getInstance();
		$this->host = $conf->getHostDB();
		$this->database = $conf->getDB();
		$this->user = $conf->getUserDB();
		$this->passwd = $conf->getPassDB();
	}


	//Evitamos el clonaje del objeto. De acuerdo al patrón de Diseño Singleton
	private function __clone(){}


	//Función encargada de crear, si es necesario, el objeto.  Esta es la función que debemos llamar desde fuera de la clase para instanciar el objeto, y así, poder utilizar sus métodos.
	public static function getInstance(){
		if(!(self::$_instance instanceof selft)){
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function conectar(){
		$this->link = mysql_connect($this->host, $this->user, $this->passwd) or die("¡Ups! Esta página no se encuentra disponible por el momento, intenta más tarde.");
		mysql_select_db($this->database, $this->link);
		@mysql_query("SET NAMES 'utf-8'");
		@mysql_query("SET time_zone= '-5:00'");
	}

	public function liberarMySQL(){

	}

	//Método para ejecutar las sentencias SQL
	public function ejecutar($sql){
		$this->stmt = mysql_query($sql, $this->link);
		return $this->stmt;
	}

	//Método para obtener una fila de resultados de las sentencias SQL
	public function obtener_fila($stmt, $fila){
		if($fila == 0){
			$this->array = mysql_fetch_object($stmt);
		}else{
			mysql_data_seek($stmt, $fila);
			$this->array = mysql_fetch_object($stmt);
		}

		return $this->array;
	}

	//Método que devuelve el último id del insert introducido
	public function lastID(){
		return mysql_insert_id($this->link);
	}


}

?>
