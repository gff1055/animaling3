<?php

namespace App\Controllers; //declarando o namespace

use App\Views\Cabecalho;

class ControllerIndex{

	private $cab;

	function __construct(){
		$this->cab = new Cabecalho();
	}

	public function index(){
		$this->cab->abertura("Animaling - Entre ou cadastre-se");
		include_once "../App/Views/login.php";
		$this->cab->fechamento();
	}

	public function logon(){
		echo "oi";
	}


}

?>