<?php

namespace App\Controllers; //declarando o namespace

use App\Views\Cabecalho;
use App\Models\ModelAnimal;
use App\Init;

class ControllerIndex{

	private $cab;

	function __construct(){ // construtor da classe
		$this->cab = new Cabecalho();
	}

	// pagina inicial
	public function index(){
		$this->cab->abertura("Animaling - Entre ou cadastre-se");
		include_once "../App/Views/login.php";
		$this->cab->fechamento();
	}

	public function logon($pPost){
		$login = $pPost['formLogin'];
		$senha = $pPost['formSenha'];

		$modelAnimal = new ModelAnimal(Init::getDB());
		$isOk = $modelAnimal->logar($login,$senha);
		if($isOk){
			session_start();
			$_SESSION['login'] = $pPost['formLogin'];
			$_SESSION['senha'] = $pPost['formSenha'];
			header("location: ../public/".$_SESSION['login']);
		}
		else{
			header("location: ../public?erro=1");	
		}
	}

	public function logout(){
		session_start();
		unset($_SESSION['login']);
		unset($_SESSION['senha']);
		header("location: ".Init::$urlRoot);
	}
}

?>