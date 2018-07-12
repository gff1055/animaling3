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

		// carregando os dados do animal
		$modelAnimal = new ModelAnimal(Init::getDB());
		$dadosAnimal = $modelAnimal->exibirDadosAnimal($nick);


		// carregando a quantidades de seguidores/seguidos
		$modelInteracao = new ModelInteracao(Init::getDB());
		$numeroSeguidores = $modelInteracao->contSeguidores($dadosAnimal['codigo']);
		$numeroSeguindo = $modelInteracao->contSeguidos($dadosAnimal['codigo']);

		$modelStatus = new ModelStatus(Init::getDB());
		if((isset($_SESSION['login'])) and ($_SESSION['login'] == $dadosAnimal['nick'])) {
		
			$perfilUsuarioSessao = true;

			//verificando se o usuario da sessao postou novas mensagens
			if(!empty($_POST['novoPost'])){ // se houver nova postagem, ela é cadastrada
				$status = new Status();
				$status->setCodigoAnimal($dadosAnimal['codigo']); // setando codigo do usuario
				$status->setConteudo($_POST['novoPost']); // setando conteudo do post
				$status->setDataStatus(Status::NOVO_STATUS); // setando a data do post
				$modelStatus->inserirStatus($status); // inserindo o status
			}
		}

		else $perfilUsuarioSessao = false;

		//EXIBINDO TODOS OS POSTS
		$posts = $modelStatus->exibirTodosStatus($nick);
		$numeroPosts = $modelStatus->contPosts($nick);
		
		//se o animal possuir posts
		if($dadosAnimal==ModelAnimal::NO_RESULTS){
			$cab->abertura("Pagina não encontrada");
			include_once "../App/Views/formBusca.php";
			include_once "../App/Views/paginaNaoExiste.php";
		}

		//se o animal nao possui posts
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
		$modelAnimal = new ModelAnimal(Init::getDB());
		$dadosAnimal = $modelAnimal->exibirDadosAnimal($pNick); //carregando informacoes do animal
		$modelIntegracao = new ModelInteracao(Init::getDB());
		$seguidores = $modelIntegracao->listarSeguidores($dadosAnimal['codigo']); // carregando a lista de seguidores
		
		$cab = new Cabecalho();
		$cab->abertura($dadosAnimal['nome']); // inserindo o cabecalho com o nome do usuario
		include_once "../App/Views/listarSeguidores.php"; // inserindo a pagina que vai listar os seguidores
		$cab->fechamento();
	}
	
	
	public function seguindo($pNick){  //metodo para a listagem dos seguidos
		$modelAnimal = new ModelAnimal(Init::getDB());
		$dadosAnimal = $modelAnimal->exibirDadosAnimal($pNick); // carregando informacoes do animal
		$modelIntegracao = new ModelInteracao(Init::getDB()); // carregando a lista de seguidos
		$seguidos = $modelIntegracao->listarSeguidos($dadosAnimal['codigo']);

		$cab = new Cabecalho();
		$cab->abertura($dadosAnimal['nome']); // inserindo o cabecalho com o nome do usuario
		include_once "../App/Views/listarSeguidos.php"; // inserindo a pagina que vai listar os seguidos
		$cab->fechamento();
	}
}


?>