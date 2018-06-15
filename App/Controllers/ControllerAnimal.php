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

		$cab = new Cabecalho($nick);

		$modelAnimal = new ModelAnimal(Init::getDB());
		$dadosAnimal = $modelAnimal->exibirDadosAnimal($nick);

		//carregando lista de seguidores e seguidos
		$modelInteracao = new ModelInteracao(Init::getDB());

		//mostrando a quantidades de seguidores/seguidos
		$numeroSeguidores = $modelInteracao->contSeguidores($dadosAnimal['codigo']);
		$numeroSeguindo = $modelInteracao->contSeguidos($dadosAnimal['codigo']);
		
		//verificando se ha novas postagens
		$modelStatus = new ModelStatus(Init::getDB());
		if(!empty($_POST['novoPost'])){
			$status = new Status();
			$status->setCodigoAnimal($dadosAnimal['codigo']);
			$status->setConteudo($_POST['novoPost']);
			$status->setDataStatus(Status::NOVO_STATUS);
			$modelStatus->inserirStatus($status);	
		}

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
	

	public function newpost($pNick){

		$status = new Status();
		$modelStatus = new ModelStatus(Init::getDB());

		$status->setCodigoAnimal($_POST['codAn']);
		$status->setConteudo($_POST['novPost']);
		$status->setDataStatus(Status::NOVO_STATUS);
			
		$modelStatus->inserirStatus($status);
	}

	//metodo para a exclusao de postagens
	public function deletarPost($pCodigo){
		$modelStatus = new ModelStatus(Init::getDB());
		$post = $modelStatus->exibirUmStatus($pCodigo);
		$modelStatus->excluirStatus($pCodigo);
		echo "deletando post ".$pCodigo;
		include_once "../App/Views/excluiPost.php";		
	}
	
	public function atualizarStatus(){

	}
	
	//metodo para a listagem dos seguidores
	public function seguidores($pNick){
		
		//carregando informacoes do animal e de seus seguidores
		$modelAnimal = new ModelAnimal(Init::getDB());
		$dadosAnimal = $modelAnimal->exibirDadosAnimal($pNick);
		$modelIntegracao = new ModelInteracao(Init::getDB());
		$seguidores = $modelIntegracao->listarSeguidores($dadosAnimal['codigo']);

		//exibindo os dados
		$cab = new Cabecalho();
		$cab->abertura($dadosAnimal['nome']);
		include_once "../App/Views/listarSeguidores.php";
		$cab->fechamento();
	}
	
	//metodo para a listagens dos seguidos
	public function seguindo($pNick){
		//carregando informacoes do animal e de seus seguidores
		$modelAnimal = new ModelAnimal(Init::getDB());
		$dadosAnimal = $modelAnimal->exibirDadosAnimal($pNick);
		$modelIntegracao = new ModelInteracao(Init::getDB());
		$seguidos = $modelIntegracao->listarSeguidos($dadosAnimal['codigo']);

		//exibindo os dados
		$cab = new Cabecalho();
		$cab->abertura($dadosAnimal['nome']);
		include_once "../App/Views/listarSeguidos.php";
		$cab->fechamento();
	}
}


?>