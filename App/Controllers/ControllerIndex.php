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
		echo $modelAnimal->logar($login,$senha);
		/*session_start();
		$_SESSION['login'] = $pPost['formLogin'];
		header("location: ../public/".$_SESSION['login']);*/

	}


}

?>