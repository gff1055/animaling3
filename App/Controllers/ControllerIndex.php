<?php

namespace App\Controllers; //declarando o namespace

// declarando as classes
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
		$this->cab->abertura("Animaling - Entre ou cadastre-se"); // cabecalho da pagina
		include_once "../App/Views/login.php"; // conteudo
		$this->cab->fechamento(); // fechando a pagina
	}

	// metodo para o processo de logon
	public function logon($pPost){
		$login = $pPost['formLogin']; // carregando o login digitado
		$senha = $pPost['formSenha']; // carregando a senha digitada

		$modelAnimal = new ModelAnimal(Init::getDB()); // declaracao do objeto de acesso ao banco
		$isOk = $modelAnimal->logar($login,$senha); // verificando se o usuario e senha digitados existem
		

		// no caso de existir
		if($isOk){
			session_start(); // inciando a sessão

			//os dados de login e senha são passados para a variavel de sessão
			$_SESSION['login'] = ucfirst(strtolower($pPost['formLogin']));
			$_SESSION['senha'] = $pPost['formSenha'];

			header("location: ../public/".$_SESSION['login']); // redirecionando para a pagina inicial
		}

		// no caso de nao existir o usuario e senha digitados
		else{
			header("location: ../public?erro=1"); // redireciona para um pagina de erro 
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