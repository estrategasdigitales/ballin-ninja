<?php
/*
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
* Archivo: config.controller.php
* Fecha: 28/06/2013
* Creador: Eric Bravo para Estrategas Digitales
* Descripcion: Objeto para configurar nuestra conexión a la Base de Datos
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
* Historico
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
* 
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */
		
Class Conf{
	private $_userdb;
	private $_passdb;
	private $_hostdb;
	private $_db;
	private $_enckey;

	static $_instance;

	private function __construct(){
		require 'config.php';
		$this->_userdb = $user;
		$this->_passdb = $password;
		$this->_hostdb = $host;
		$this->_db = $db;
	}			

	private function __clone(){}

	public static function getInstance(){
		if(!(self::$_instance instanceof self)){
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function getUserDB(){
		$var = $this->_userdb;
		return $var;
	}

	public function getHostDB(){
		$var = $this->_hostdb;
		return $var;
	}

	public function getPassDB(){
		$var = $this->_passdb;
		return $var;
	}

	public function getDB(){
		$var = $this->_db;
		return $var;
	}
}

?>
