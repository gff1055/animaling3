<?php

namespace App\Models;

use App\Models\Animal;
use App\Init;


class ModelAnimal
{
	private $conexao;

	//constante usada para verificar se a alteracao a ser feita no banco é um cadastro
	const NOVO_CADASTRO = 1;
	const ALTERACAO_DADOS = 2;
	const EXCLUSAO = -3;
	const NO_RESULTS = 0;
	const NOME_JA_CADASTRADO=4;
	const OK=5;
	
	function __construct($pConex){
		$this->conex=$pConex;
	}

	function __destruct(){
		$this->conex = null;
	}

	
	// Exibe dados de um usuario
	public function exibirDadosAnimal($pNick){

		//preparando a query do banco de dados
		$resultado=$this->conex->prepare(
			"select codigo,nome,nick,descricao,foto,email,senha
			from animal
			where nick=?"
			);
		//RESULTADO=CONEXAO->prepare("SENTENCA SQL")
		
		//FAZENDO O BIND DOS INDICES NA QUERY COM OS VALORES
		$resultado->bindValue(1,$pNick);
		
		//EXECUTANDO A QUERY
		$resultado->execute();
		
		//resgatando o resultado da consulta linha a linha(fetch)
		//cada linha é tratada como um objeto
		if($resultado->rowCount() > 0){
			while($linha=$resultado->fetch(\PDO::FETCH_ASSOC)){
				return $linha;
			}			
		}
		
		else{
			return self::NO_RESULTS;
		}
	}	

	//metodo que retorna o codigo baseado no nick
	public function getCodFromNick($pNick){
		try{
			$query = "select codigo from animal where nick = ?";
			$result = $this->conex->prepare($query);
			$result->bindValue(1,$pNick);
			$result->execute();
		}catch(PDOException $e){
			echo "ERRO: ".$e.getMessage();

		}

		if($result->rowCount()>0){
			$cod = $result->fetch(\PDO::FETCH_ASSOC);
			return $cod['codigo'];
		}
		else
			return -1;
	}

	// metodo para fazer o logar no site
	public function logar($us,$senh){
		$query = "select nome,nick,codigo,senha from animal where (nick=? or email=?) and binary senha=?";
		try{
			$result=$this->conex->prepare($query);
			$result->bindValue(1,$us); //EFETUANDO BIND DE VALORES NA QUERY
			$result->bindValue(2,$us); //EFETUANDO BIND DE VALORES NA QUERY
			$result->bindValue(3,$senh); //EFETUANDO BIND DE VALORES NA QUERY

			$result->execute(); //EXECUCAO DA QUERY COM OS VALORES
		}catch(PDOException $erro){
			echo "ERRO: ".$erro->getmessage();
		}
		
		//VERIFICA A QUANTIDADE DE LINHAS RETORNADAS DA EXECUCAO DA QUERY
		if($result->rowCount()>0){
			$check = $result->fetch(\PDO::FETCH_ASSOC);
			return $check;
		}
		
		//RETORNA SE O USUARIO NAO EXISTE		
		else{
			return false;
		}
	}

	// FUNCAO PARA VERIFICAR SE UM DADO EXISTE NO BANCO
	public function existe($campo,$dado,$codOcorrencia){
		$query = "select * from animal where $campo=?";
		try{
			if($codOcorrencia == ModelAnimal::NOVO_CADASTRO || $codOcorrencia == ModelAnimal::EXCLUSAO){
				$result=$this->conex->prepare($query);
			}
			else{
				$query = $query." and codigo<>?";
				$result=$this->conex->prepare($query);
				$result->bindValue(2,$codOcorrencia);
			}
			//EFETUANDO BIND DE VALORES NA QUERY
			$result->bindValue(1,$dado);
			//EXECUCAO DA QUERY COM OS VALORES
			$result->execute();
		}catch(PDOException $erro){
			echo "ERRO: ".$erro->getmessage();
		}
		

		//VERIFICA A QUANTIDADE DE LINHAS RETORNADAS DA EXECUCAO DA QUERY
		if($result->rowCount()>0){
			return true;
		}
		
		//RETORNA SE O USUARIO NAO EXISTE		
		else{
			return false;
		}
	}

	// verifica se ja tem usuarios com o mesmo nome/email
	public function verifica($pAnimal, $operacao){
		if($operacao == ModelAnimal::ALTERACAO_DADOS){
			$operacao = $pAnimal->getCodigo();
		}

		//existe o usuario
		if($this->existe("nick", $pAnimal->getNick(),$operacao)){
			return "Nick existe";
		}

		//existe o email
		else if($this->existe("email", $pAnimal->getEmail(),$operacao)){
			return "Email existe";
		}
	
		else{
			return false;
		}
		
	}

	/*metodo para gerar o nick(user) para um usuario*/
	public function geraNick(){
		//preparando e executando a query
		$result = $this->conex->prepare("select max(codigo) as maiorCodigo from animal");
		$result->execute();
		//recebendo o resultado
		$linha = $result->fetch(\PDO::FETCH_OBJ);
		//gerando o ID do usuario disponivel
		$userDisp = $linha->maiorCodigo+1;
		return "user".$userDisp;
	}


	/*public function inserirAnimal($pAnimal){
		$query = "insert into animal(nome,nick,descricao,senha,email,foto)values(?,?,?,?,?,?)";
		$pAnimal->setNick($this->geraNick());
		$newUser = $this->gerenciarAnimal($pAnimal,$query,$this::NOVO_CADASTRO);

		// Criando a pasta do usuario
		if($this->createFolder($newUser)){
			return $newUser;
		}
		else{
			return false;
		}
	}*/

	/* Metodo para inserir animais */
	public function inserirAnimal($pAnimal){
		$query = "insert into animal(nome,nick,descricao,senha,email,foto)values(?,?,?,?,?,?)";
		$pAnimal->setNick($this->geraNick());
		$newUser = $this->gerenciarAnimal($pAnimal,$query,$this::NOVO_CADASTRO);

		// Criando a pasta do usuario
		if($this->createFolder($newUser)){
			return $newUser;
		}
		else{
			return false;
		}
	}

	/* Metodo para alterar dados de animais */
	public function alterarDadosAnimal($pAnimal){
		$query = "update animal set nome=?,nick=?,descricao=?,senha=?,email=? where codigo=?";
		$alteracao = $this->gerenciarAnimal($pAnimal,$query,$this::ALTERACAO_DADOS);
		return $alteracao;
	}


	private function gerenciarAnimal($pAnimal, $query, $op){
		try{

			// verifica se as informacoes de um usuario sao validas
			$haErro = $this->verifica($pAnimal, $op);

			// verifica se os dados inseridos são validos (duplicados)
			if($haErro)
				return false;
			else{
				$result = null;
				$result = $this->conex->prepare($query);

				// testando se a operacao é uma atualizacao
				if($op == ModelAnimal::ALTERACAO_DADOS){
					$result->bindValue(6,$pAnimal->getCodigo());
				}

				// testando se a operação é um novo cadastro
				elseif($op == ModelAnimal::NOVO_CADASTRO){
					$result->bindValue(6, $pAnimal->getFoto());
				}

				else{
					header("location: ".Init::$urlRoot."/error");
				}
				$result->bindValue(1,$pAnimal->getNome());
				$result->bindValue(2,$pAnimal->getNick());
				$result->bindValue(3,$pAnimal->getDescricao());
				$result->bindValue(4,$pAnimal->getSenha());
				$result->bindValue(5,$pAnimal->getEmail());
				$result->execute();
				return $pAnimal->getNick();
			}

		}catch(PDOException $erro){
			echo "erro: ".$erro->getMessage();
			return false;
		}
	}

	/*Metodo para criacao da pasta do usuario recem cadastrado*/
	public function createFolder($pNick){
		try{
			// pegando o codigo do usuario
			$result = $this->conex->prepare("select codigo from animal where nick=?");
			$result->bindValue(1,$pNick);
			$result->execute();

			//verificando se houve retorno
			if($result->rowCount()>0){
				$row = $result->fetch(\PDO::FETCH_ASSOC);
				$userFolder = "../src/img/data_users/".$row["codigo"];
				// caminho da pasta do usuario

				// verificando se ja existe alguma pasta com o nome especificado
				if(!file_exists($userFolder)){
					mkdir($userFolder,0775);
					// criando a pasta
					return true;
					// retorna verdadeiro quando a criacao da pasta ocorrerd
				}
					
			}
		}catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
	}

	public function createLeftFolders(){
		try{
			$result = $this->conex->prepare("select codigo from animal");
			$result->execute();
			echo $result->rowCount(); 
			if($result->rowCount()>0){
				while($row = $result->fetch(\PDO::FETCH_ASSOC)){
					$userFolder = "../src/img/data_users/".$row["codigo"];
					if(!file_exists($userFolder)){
						mkdir($userFolder,0775);
					}
				}
				return true;
			}
		}catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
	}

	/*Metodo para alterar a foto de perfil do usuario*/
	public function changeProfilePhoto($data, $codeUser){
		
		// atribuindo o caminho da pasta do usuario
		$folderUser = "/src/img/data_users/".$codeUser."/";
		// variavel para acesso local do servidor
		$serverLocalDir = "..";
		// atribuindo o caminho da foto (endereco da pasta + endereco da foto)
		$photoPath = $folderUser.$_FILES['foto']['name'];
		// movendo a foto para a pasta local do usuario
		move_uploaded_file($_FILES['foto']['tmp_name'],$serverLocalDir.$photoPath);
		try{
			$result = null;
			$result = $this->conex->prepare("update animal set foto=? where codigo=?");
			// usando constante $urlSources usada para acesso aos recursos (resources)
			$result->bindValue(1,Init::$urlSources.$photoPath);
			$result->bindValue(2,$codeUser);
			$result->execute();
			return true;
		}catch(PDOException $erro){
			return false;
		}
	}

/*metodo para alteracao das credenciais (usuario e senha)*/
	public function changeCredentials($nick, $password, $code){
		try{
			$result = null;
			$result = $this->conex->prepare("update animal set senha=?,nick=? where codigo=?");
			$result->bindValue(1,$password);
			$result->bindValue(2,$nick);
			$result->bindValue(3,$code);	
			$result->execute();
			return true;
		}catch(PDOException $erro){
			echo "erro: ".$erro->getMessage();
			return false;
		}
	}

/*metodo para exclusao de usuarios*/
	public function excluir($codigo)
	{
		try{
			//$resultado=$this->conex->getConnection()->prepare("delete from animal where codigo = ?");
			$modelPosts = new ModelStatus(Init::getDB());
			$modelConnections = new ModelInteracao(Init::getDB());
			$deletedPosts=$modelPosts->deleteAllPosts($codigo);
			$deletedConnections = $modelConnections->deleteAllConnections($codigo);
			if($deletedPosts and $deletedConnections){
				$resultado=$this->conex->prepare("delete from animal where codigo = ?");
				$resultado->bindValue(1,$codigo);
				$resultado->execute();

				/* excluindo a pasta associada ao usuario */
				if($this->deleteUserFolder($codigo)){
					return true;
				}
			}
			else return false;
		}catch(PDOException $erro){
			return false;
		}
	}


	/*Metodo para apagar a pasta do usuario do site*/
	public function deleteUserFolder($pCode){
		
		$pathFolder = "../src/img/data_users/".$pCode."/";

		// verifica se o caminho colocado é um diretorio
		if(is_dir($pathFolder)){
			// variavel diretorio recebe a instancia 'diretorio' associada ao caminho colocado
			$directory = dir($pathFolder);
			
			// lendo cada um dos arquvos do diretorio
			while($file = $directory->read()){
				if(($file != '.') && ($file != '..')){
					unlink($pathFolder.$file);
					// apagando o arquivo da pasta
					echo 'Arquivo '.$arquivo.' foi apagado com sucesso. <br />';
					// exibindo confimacao
				}
			}

			// fechando o diretorio
			$directory->close();

			// removendo a pasta
			if(rmdir($pathFolder)){	
				// a pasta foi excluida
				return true;
			}

			else{
				// o comando nao funcionou
				return false;
			}
		}
		else{
			// a pasta nao existe
			return false;
			
		}
	}

	
	public function buscarPrincipaisAnimais($termo){
		$query = "
			select nome,descricao,nick
			from animal
			where upper(nome) like ?
			limit 3";
		return $this->buscarAnimal($termo, $query);	
				
	}


	public function buscarTodosAnimais($termo){
		$query = "
			select nome,descricao,nick,foto
			from animal
			where upper(nome) like ?";
		return $this->buscarAnimal($termo, $query);					
	}

	public function buscarAnimal($termo, $query){
		$resultado=$this->conex->prepare($query);
		//preparando a query do banco de dados

		$resultado->bindValue(1,"%".$termo."%");
		//FAZENDO O BIND DOS INDICES NA QUERY COM OS VALORES
		//RESULTADO->bindValue(INDICE, VALOR)
		
		//EXECUTANDO A QUERY
		$resultado->execute();

		//resgatando o resultado da consulta linha a linha(fetch)
		//cada linha é tratada como um objeto
		$arr = array();
		if($resultado->rowCount() > 0){
			while($linha=$resultado->fetch(\PDO::FETCH_ASSOC)){

				//ADICIONANDO O REGISTRO NO ARRAY DE OBJETOS
				array_push($arr,$linha);
			}			
		}
		
		else{
			
			return 0;
		}
		
		return $arr;
	}
}
?>