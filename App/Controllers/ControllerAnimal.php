<?php
namespace App\Controllers;

use App\Models\ModelAnimal;
use App\Models\ModelStatus;
use App\Models\ModelInteracao;
use App\Models\Status;
use App\Views\Cabecalho;
use App\Init;

class ControllerAnimal{

	public function index($nick){

		session_start();
		$cab = new Cabecalho($nick);

		include_once "../App/Views/mostraUsuario.php"; 	// exibe (ou nao) o nome do usuario logado

		// carregando os dados do usuario
		$modelAnimal = new ModelAnimal(Init::getDB());
		$dadosAnimal = $modelAnimal->exibirDadosAnimal($nick);

		// carregando a quantidades de seguidores/seguidos
		$modelInteracao = new ModelInteracao(Init::getDB());
		$numeroSeguidores = $modelInteracao->contSeguidores($dadosAnimal['codigo']);
		$numeroSeguindo = $modelInteracao->contSeguidos($dadosAnimal['codigo']);
		
		// declarando objeto do model Status
		$modelStatus = new ModelStatus(Init::getDB());

		$acessoNaoLogado = false;	// flag que indica se o usuario que acessou a pagina esta logado
		$acessoUsuarioSessao = null;	// flag que indica que o usuario da sessão esta acessando seu próprio perfil

		if(isset($_SESSION['login'])) {
			
			// verificando se o usuario da sessão esta acessando o proprio perfil
			if(($_SESSION['login'] == $dadosAnimal['nick'])){
				$acessoUsuarioSessao = true;
				
				echo "<br>sessao".$_SESSION['login'];
				echo "<br>animal".$dadosAnimal['nick'];
				
				//verificando se o usuario da sessao postou novas mensagens
				if(!empty($_POST['novoPost'])){ // se houver nova postagem, ela é cadastrada
					$status = new Status();
					$status->setCodigoAnimal($dadosAnimal['codigo']);	// setando codigo do usuario
					$status->setConteudo($_POST['novoPost']);	// setando conteudo do post
					$status->setDataStatus(Status::NOVO_STATUS);	// setando a data do post
					$modelStatus->inserirStatus($status);	// inserindo o status
				}
			}

			// verificando se usuario da sessao e o usuario do perfil seguem entre si
			else{
				$acessoUsuarioSessao = false;
				$situacao = $modelInteracao->situacaoUsuarios($_SESSION['id'], $dadosAnimal['codigo']);
				if($situacao == $modelInteracao::SEGUINDO)
					$relacionamento = "seguindo";
				elseif($situacao == $modelInteracao::SEG_VOLTA)
					$relacionamento = "seguir de volta";
				elseif($situacao == $modelInteracao::NAO_SEGUE)
					$relacionamento = "seguir";
				else echo "<BR>ALGO ERRADO <BR>";
			}
		}

		else{
			$acessoNaoLogado = true;
		}

		//Carregando os posts e a quantidade
		$posts = $modelStatus->exibirTodosStatus($nick);
		$numeroPosts = $modelStatus->contPosts($nick);
		
		//verificando se o animal possui posts
		if($dadosAnimal==ModelAnimal::NO_RESULTS){
			$cab->abertura("Pagina não encontrada");
			include_once "../App/Views/formBusca.php";
			include_once "../App/Views/paginaNaoExiste.php";
		}
		else{
			$cab->abertura($dadosAnimal['nome']." - Página Inicial");
			include_once "../App/Views/formBusca.php";
			include_once "../App/Views/animalIndex.php";
		}

		$cab->fechamento();

	}

	//metodo para visualizacao dos posts
	public function verPost($codigo){

		//preparacao dos dados para exibicao
		$cab = new Cabecalho();
		$modelPost = new ModelStatus(Init::getDB());
		$post = $modelPost->exibirUmStatus($codigo);

		//exibindo o post
		$cab->abertura($post['nomeAnimal']);
		include_once "../App/Views/exibePost.php";
		$cab->fechamento();
	}
	
	// metodo para cadastar o post de um usuario
	public function newpost($pNick){

		$status = new Status(); // declarando objeto para o status
		$modelStatus = new ModelStatus(Init::getDB()); // declarando objeto do model

		$status->setCodigoAnimal($_POST['codAn']); // objeto status recebendo o codigo do usuario
		$status->setConteudo($_POST['novPost']); // objeto status recebendo o codigo do post
		$status->setDataStatus(Status::NOVO_STATUS);// objeto status recebendo a data do post
		
		$modelStatus->inserirStatus($status); // inserindo o status n banco de dados
	}

	
	public function deletarPost($pCodigo){ //metodo para a exclusao de postagens
		$modelStatus = new ModelStatus(Init::getDB());
		$post = $modelStatus->exibirUmStatus($pCodigo);
		$modelStatus->excluirStatus($pCodigo);
		echo "deletando post ".$pCodigo;
		include_once "../App/Views/excluiPost.php";		
	}
	
	public function atualizarStatus(){

	}

	
	public function seguidores($pNick){ //metodo para a listagem dos seguidores

		session_start();

		$modelAnimal = new ModelAnimal(Init::getDB());
		$dadosAnimal = $modelAnimal->exibirDadosAnimal($pNick); //carregando informacoes do animal
		$modelIntegracao = new ModelInteracao(Init::getDB());
		$seguidores = $modelIntegracao->listarSeguidores($dadosAnimal['codigo']); // carregando a lista de seguidores
		
		$cab = new Cabecalho();
		$cab->abertura($dadosAnimal['nome']); // inserindo o cabecalho com o nome do usuario
		include_once "../App/Views/mostraUsuario.php";
		include_once "../App/Views/formBusca.php";
		include_once "../App/Views/listarSeguidores.php"; // inserindo a pagina que vai listar os seguidores
		$cab->fechamento();
	}
	
	
	public function seguindo($pNick){  //metodo para a listagem dos seguidos

		session_start();

		$modelAnimal = new ModelAnimal(Init::getDB());
		$dadosAnimal = $modelAnimal->exibirDadosAnimal($pNick); // carregando informacoes do animal
		$modelIntegracao = new ModelInteracao(Init::getDB()); // carregando a lista de seguidos
		$seguidos = $modelIntegracao->listarSeguidos($dadosAnimal['codigo']);

		$cab = new Cabecalho();
		$cab->abertura($dadosAnimal['nome']); // inserindo o cabecalho com o nome do usuario
		include_once "../App/Views/mostraUsuario.php";
		include_once "../App/Views/formBusca.php";
		include_once "../App/Views/listarSeguidos.php"; // inserindo a pagina que vai listar os seguidos
		$cab->fechamento();
	}

	public function followstate(){
		$modelInteracao = new ModelInteracao(Init::getDB());
		$temp = $modelInteracao->situacaoUsuarios($_GET['user'], $_GET['prof']);
		if($temp == $modelInteracao::SEGUINDO)
			echo "Seguindo";
		elseif($temp == $modelInteracao::SEG_VOLTA)
			echo "Seguir de volta";
		elseif($temp == $modelInteracao::NAO_SEGUE)
			echo "Seguir";
		else
			echo "ERROR: ";
	}

	public function followmanage(){
	}

	public function opSeguindo(){
		echo "seguido";
	}
}


?>