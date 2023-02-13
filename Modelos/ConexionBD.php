<?php

class ConexionBD{

	static public function cBD(){

		$bd = new PDO("mysql:host=localhost:3307;dbname=clinica", "root", "root");

		$bd -> exec("set names utf8");  //EDITAR SEGUN SU SERVIDOR

		return $bd;

	}

}