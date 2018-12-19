<?php

namespace App\Controllers; //declarando o namespace

// declarando as classes
use App\Views\Cabecalho;
use App\Models\ModelAnimal;
use App\Models\Animal;
use App\Models\ModelInteracao;
use App\Init;


class ControllerIndex{

	private $cab;

	function __construct(){ // construtor da classe
		$this->cab = new Cabecalho();
	}

	// pagina inicial
	public function index(){
		$arrMountPage = array();	// iniciando array para montagem da pagina

		session_start();
		if(isset($_SESSION['login'])){	// verificando se tem alguem logado
			$arrayNewsFeed = array();	// iniciando array que conterá as postagens dos amigos do usuario logado
			$objInteraction = new ModelInteracao(Init::getDB());	// declaracao de objeto de acesso à tabela de interação
			$arrayNewsFeed = $objInteraction->newsFeed($_SESSION['id']);	//array recebe as postagens dos amigos do usuario logado
			$titleBar = "Animaling";	//	Barra de titulo

			/*Alimentando Array que montará as páginas na tela*/
			$arrMountPage[] = "../App/Views/mostraUsuario.php";
			$arrMountPage[] = "../App/Views/newsfeed.php";
			//$page = "../App/Views/newsfeed.php";
		}
		else{	// Acesso vem de alguem que não está logado
			$titleBar = "Animaling - Entre ou cadastre-se";
			
			$arrMountPage[] = "../App/Views/formLogin.php";
		}
		$this->cab->abertura($titleBar); // cabecalho da pagina
		foreach($arrMountPage as $mountPage){
			include_once $mountPage;
		};
		//include_once "../App/Views/mostraUsuario.php";
		//if(isset($page)) include_once $page; // conteudo
		$this->cab->fechamento(); // fechando a pagina
	}

	public function register(){
		$this->cab->abertura("Cadastre-se");
		include_once "../App/Views/formCadastro.php";
		$this->cab->fechamento();
	}

	// metodo que cadastra as informações de um usuario no banco de dados
	public function signup(){
		$dataUser = new Animal();
		$modelAnimal = new ModelAnimal(Init::getDB());
		
		// recebendo as informacoes
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$checkPassword = $_POST['checkPassword'];

		// setando as informacoes recebidas
		$dataUser->setNome($name);
		$dataUser->setEmail($email);
		//$dataUser->setSexo($genre);
		$dataUser->setSenha($password);
		//$dataUser->setNascimento($birthDate);
		$dataUser->setDescricao("");
		$dataUser->setFoto("../src/img/data_users/profile_photo_default/profile.jpg");

		// inserindo os dados e retornando o resultado da insercao
		$isItSuccess = $modelAnimal->inserirAnimal($dataUser);
		

		// verificando se os dados foram salvos
		if($isItSuccess != false){
			//header("location:".Init::$urlRoot."/".$isItSuccess);	// acessando a pagina de perfil do usuario
			$post["formLogin"] = $isItSuccess;	// carregando login
			$post["formSenha"] = $dataUser->getSenha();	// carregando senha
			$this->logon($post);	// efetuando o logon
		}

		else
			header("location: facebook.com");

		//include_once "../App/Views/sohcriapasta.php";
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
			$_SESSION['login'] = strtolower($isOk['nick']);
			$_SESSION['senha'] = $isOk['senha'];
			$_SESSION['id'] = $isOk['codigo'];
			$_SESSION['name'] = $isOk['nome'];
			echo "<br>SESSION[id] =". $isOk['codigo'];

			header("location: ../public/"); // redirecionando para a pagina inicial
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
		unset($_SESSION['id']);
		header("location: ".Init::$urlRoot);
	}
}

?>