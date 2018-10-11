<?php
namespace App\Controllers;

use App\Models\ModelAnimal;
use App\Models\Animal;
use App\Models\ModelStatus;
use App\Models\ModelInteracao;
use App\Models\Interacao;
use App\Models\Status;
use App\Views\Cabecalho;
use App\Init;

class ControllerAnimal{

	public function index($nick){

		session_start();
		$cab = new Cabecalho($nick);

		// carregando os dados do usuario
		$modelAnimal = new ModelAnimal(Init::getDB());
		$dadosAnimal = $modelAnimal->exibirDadosAnimal($nick);

		$modelInteracao = new ModelInteracao(Init::getDB());	// declaracao de variaval para acesso a tabela de Interacoes(seguidores seguidos)

		$count = $this->countInteractions($dadosAnimal['codigo']);	// variavel recebe array que contem a quantidade de seguidores e seguidos de um usuario
		
		$modelStatus = new ModelStatus(Init::getDB());	// declarando variavel para acesso a tabela de Status no banco


		$acessoNaoLogado = false;	// flag que indica se o acesso a página é de alguem nao logado
		$acessoUsuarioSessao = null;	// flag que indica se o usuario da sessão esta acessando seu próprio perfil

		/*Testando se o acesso é de alguem logado*/
		if(isset($_SESSION['login'])) {
			/*echo $_SESSION['login'];
				echo $dadosAnimal['nick'];*/			
			/*Testando se é o usuario da sessão esta acessando o proprio perfil*/
			if((strtolower($_SESSION['login']) == strtolower($dadosAnimal['nick']))){
				$acessoUsuarioSessao = true;
				
								
				/*Testando se o usuario postou novas mesnagens*/
				if(!empty($_POST['novoPost'])){
					$status = new Status();
					$status->setCodigoAnimal($dadosAnimal['codigo']);	// setando codigo do usuario
					$status->setConteudo($_POST['novoPost']);	// setando conteudo do post
					$status->setDataStatus(Status::NOVO_STATUS);	// setando a data do post
					$modelStatus->inserirStatus($status);	// inserindo o status
				}
			}

			// Testando a situacao do usuario do perfil e o usuario da sessão (se eles seguem entre si ou não)
			else{
				$acessoUsuarioSessao = false;
				$relacionamento = $this->labelSituationUsers($_SESSION['id'], $dadosAnimal['codigo']);
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
			include_once "../App/Views/mostraUsuario.php"; 	// exibe (ou nao) o nome do usuario logado
			//include_once "../App/Views/formBusca.php";
			include_once "../App/Views/paginaNaoExiste.php";
		}
		else{
			$cab->abertura($dadosAnimal['nome']." - Página Inicial");
			include_once "../App/Views/mostraUsuario.php"; 	// exibe (ou nao) o nome do usuario logado
			//include_once "../App/Views/formBusca.php";
			include_once "../App/Views/animalIndex.php";
		}

		$cab->fechamento();

	}


	/*Meotodo que mostra a situacao de dois usuarios qualquer (Se seguem ou nao entre si)*/
	public function labelSituationUsers($user1, $user2){
		$modelInteracao = new ModelInteracao(Init::getDB());
		$temp = $modelInteracao->situacaoUsuarios($user1, $user2);
		if($temp == $modelInteracao::SEGUINDO)
			return "Seguindo";
		elseif($temp == $modelInteracao::SEG_VOLTA)
			return "Seguir de volta";
		elseif($temp == $modelInteracao::NAO_SEGUE)
			return "Seguir";
		else
			return "ERROR: ";
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
		session_start();
		$modelStatus = new ModelStatus(Init::getDB());
		$post = $modelStatus->exibirUmStatus($pCodigo);
		$modelStatus->excluirStatus($pCodigo);
		header("location: ".Init::$urlRoot."/".$_SESSION['login']);	// Retornando para a pagina do usuario
		//echo "deletando post ".$pCodigo;
		//include_once "../App/Views/excluiPost.php";		
	}

	/* metodo ao acessar a pagina /edit do usuario (edição de posts) */
	public function editPost($pCode){
		session_start();
		$head = new Cabecalho();

		$head->abertura("Editar publicacao");
		include_once "../App/Views/mostraUsuario.php";	// mostrando o usuario
		$modelStatus = new ModelStatus(Init::getDB());
		$post = $modelStatus->exibirUmStatus($pCode);	// pegando os dados do status
		if($post['codeUser'] == $_SESSION['id']){	// verificando as credenciais do usuario
			include_once "../App/Views/formEditPost.php";
		}
		else
			echo "vc nao tem autorizacao";
		$head->fechamento();
	}
	
	
	public function countInteractions($user){
		// carregando a quantidades de seguidores/seguidos
		$modelInteracao = new ModelInteracao(Init::getDB());
		return array(
			'followings' => $modelInteracao->contSeguidos($user),
			'followers' => $modelInteracao->contSeguidores($user)
		);
	}


	/* metodo para a listagem dos seguidores */
	public function seguidores($pNick){ 

		session_start();

		$modelAnimal = new ModelAnimal(Init::getDB());
		$dadosAnimal = $modelAnimal->exibirDadosAnimal($pNick); //carregando informacoes do animal
		$modelIntegracao = new ModelInteracao(Init::getDB());
		$seguidores = $modelIntegracao->listarSeguidores($dadosAnimal['codigo']); // carregando a lista de seguidores
		
		$cab = new Cabecalho();
		$cab->abertura($dadosAnimal['nome']); // inserindo o cabecalho com o nome do usuario
		include_once "../App/Views/mostraUsuario.php";
		//include_once "../App/Views/formBusca.php";
		include_once "../App/Views/listarSeguidores.php";	// inserindo a pagina que vai listar os seguidores
		$cab->fechamento();
	}
	
	
	/* Metodo para a listagem dos seguidos */
	public function seguindo($pNick){
		session_start();
		$modelAnimal = new ModelAnimal(Init::getDB());
		$dadosAnimal = $modelAnimal->exibirDadosAnimal($pNick); // carregando informacoes do animal
		$modelIntegracao = new ModelInteracao(Init::getDB()); // carregando a lista de seguidos
		$seguidos = $modelIntegracao->listarSeguidos($dadosAnimal['codigo']);

		$cab = new Cabecalho();
		$cab->abertura($dadosAnimal['nome']); // inserindo o cabecalho com o nome do usuario
		include_once "../App/Views/mostraUsuario.php";
		//include_once "../App/Views/formBusca.php";
		include_once "../App/Views/listarSeguidos.php"; // inserindo a pagina que vai listar os seguidos
		$cab->fechamento();
	}


	/* metodo acionado quando o usuario acessa '/followstate' */
	public function followstate(){
		$modelInteracao = new ModelInteracao(Init::getDB());
		$temp = $this->labelSituationUsers($_SESSION['id'], $dadosAnimal['codigo']);
		echo $temp;
	}


	/*metodo acionado quando o usuario acessa /someactionfollow */
	public function someactionfollow(){
		
		$sessionUser = $_GET['user'];	// recebendo o codigo do usuario da sessao
		$profileUser = $_GET['prof'];	// recebendo o codigo do usuario do perfil
		$usersState = $_GET['state'];	// recebendo o status do relacionamento dos dois usuarios
		$arrayData = null;	// array responsavel por armazenar os dados requisitados pelos clientes
		$modelFollow = new ModelInteracao(Init::getDB());	// declaracao de objeto para acesso à classe model
		$relation = new Interacao();	// declaracao de variavel para acesso aos registros
		
		/*Setando o codigo do seguidor e do seguido no objeto*/
			$relation->setCodigoSeguido($profileUser);
			$relation->setCodigoSeguidor($sessionUser);

		/* Verificando o status dos usuarios (se eles seguem entre si ou nao) */
		if($usersState == "Seguindo"){
			$modelFollow->excluirSeguidor($relation);	//adicionando a nova ligacao no banco de dados
		}
		elseif($usersState == "Seguir" || $usersState == "Seguir de volta"){
			$modelFollow->adicionarSeguidor($relation);	//adicionando a nova ligacao no banco de dados
		}
		else{
			echo "ERROR: Erro interno do servidor";
			return false;
		}

		$arrayData = array(
			'indexNewState' => $this->labelSituationUsers($sessionUser, $profileUser),
			'indexCountFollowers' => $modelFollow->contSeguidores($profileUser)
		);
		$arrayJsonData = json_encode($arrayData);	//	codificando array que enviará os dados em formato JSON
		echo $arrayJsonData; // array em formato JSON sendo apresentada

	}

	// executa quando o usuario entra na pagina /setup do usuario
	public function setup($pNick){
		session_start();
		$cab = new Cabecalho();
		if(isset($_SESSION['login']) && $_SESSION['login'] == $pNick){	// verificando se o usuario esta logado
			$cab->abertura($pNick." - Configurações");
			include_once "../App/Views/mostraUsuario.php";
			$modelAnimal = new ModelAnimal(Init::getDB());
			$dadosAnimal = $modelAnimal->exibirDadosAnimal($pNick);	// carregando informacoes do animal
			include_once "../App/Views/formUpdateData.php";	// exibinindo os dados do usuario no formulario para atualizacao
		}
		else{
			$cab->abertura("Acesso negado");
			include_once "../App/Views/mostraUsuario.php";
			echo "Acesso negado!!!!";
		}
		$cab->fechamento();
	}

	public function updateData($pArrayDataUser){
		session_start();
		$modelUser = new ModelAnimal(Init::getDB());
		$objUser = new Animal();

		/* Carregando os novos dados inseridos*/
		$objUser->setCodigo($_SESSION['id']);
		$objUser->setNick($pArrayDataUser['nick']);
		$objUser->setNome($pArrayDataUser['name']);
		$objUser->setDescricao($pArrayDataUser['description']);
		$objUser->setEmail($pArrayDataUser['email']);
		$objUser->setSexo($pArrayDataUser['genre']);
		$objUser->setSenha($pArrayDataUser['password']);
		$objUser->setNascimento($pArrayDataUser['birthDate']);

		// Testando se os dados foram alterados
		if($modelUser->alterarDadosAnimal($objUser)){
			echo "perfil salvo";
			$_SESSION['login'] = $objUser->getNick();	// Atualizando o novo login
			header("location: ".Init::$urlRoot."/".$_SESSION['login']);	// redirecionamento para a pagina do usuario
		}
		else 
			echo "erro";
	}

	/* metodo quando é acessado a URL /updatepassword (atualizacao de senha) */
	public function updatePassword($pArrayDataUser){
		session_start();
		$modelUser = new ModelAnimal(Init::getDB());
		$modelUser->changePassword($pArrayDataUser['newPassword'], $_SESSION['id']);
		$_SESSION['senha'] = $pArrayDataUser['newPassword'];
		header("location: ".Init::$urlRoot."/".$_SESSION['login']);
	}

	public function updatePost($arrayDataPost){
		session_start();
		$modelPost = new ModelStatus(Init::getDB());
		$post = new Status();
		$post->setCodigo($arrayDataPost['formCodePost']);
		$post->setConteudo($arrayDataPost['formContentPost']);
		$modelPost->atualizarStatus($post);
		header("location: ".Init::$urlRoot.'/'.$_SESSION['login']);
	}

	public function opSeguindo(){
		echo "seguido";
	}
}


?>