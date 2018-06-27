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
			"select codigo,nome,nick,sexo,nascimento,descricao
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


	// FUNCAO PARA VERIFICAR SE UM DADO EXISTE NO BANCO
	/*public function existeAnimal($pAnimal,$codOcorrencia){

		$query = "select * from animal where nick=?";
		try{

			
			if($codOcorrencia == ModelAnimal::NOVO_CADASTRO){
				$result=$this->conex->getConnection()->prepare($query);
			}

			else{
				$query = $query." and codigo<>?";
				$result=$this->conex->getConnection()->prepare($query);
				$result->bindValue(2,$pAnimal->getCodigo());
			}

			//EFETUANDO BIND DE VALORES NA QUERY
			$result->bindValue(1,$pAnimal->getNick());						

			//EXECUCAO DA QUERY COM OS VALORES
			$result->execute();
		}catch(PDOException $erro){
			echo "ERRO: ".$erro->getmessage();
		}


		
		//VERIFICA A QUANTIDADE DE LINHAS RETORNADAS DA EXECUCAO DA QUERY
		if($result->rowCount()>0){
			echo "existe";
			return true;
		}
		
		//RETORNA SE O USUARIO NAO EXISTE		
		else{
			echo "nao existe";
			return false;
		}
	}*/

	

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

	public function logar($us,$senh){
		$query = "select * from animal where nick=? and senha=?";
		try{
			$result=$this->conex->prepare($query);
			$result->bindValue(1,$us); //EFETUANDO BIND DE VALORES NA QUERY
			$result->bindValue(2,$senh); //EFETUANDO BIND DE VALORES NA QUERY

			$result->execute(); //EXECUCAO DA QUERY COM OS VALORES
		}catch(PDOException $erro){
			echo "ERRO: ".$erro->getmessage();
		}
		
		//VERIFICA A QUANTIDADE DE LINHAS RETORNADAS DA EXECUCAO DA QUERY
		if($result->rowCount()>0){
			return "existe";
			return "true";
		}
		
		//RETORNA SE O USUARIO NAO EXISTE		
		else{
			return "nao existe";
			return "false";
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


	public function inserirAnimal($pAnimal){
		$query = "insert into animal(nome,nick,descricao,nascimento,sexo,senha,email)values(?,?,?,?,?,?,?)";
		$pAnimal->setNick($this->geraNick());
		$insercao = $this->gerenciarAnimal($pAnimal,$query,$this::NOVO_CADASTRO);
		return $insercao;
	}


	public function alterarDadosAnimal($pAnimal){
		$query = "update animal set nome=?,nick=?,descricao=?,nascimento=?,sexo=?,senha=?,email=? where codigo=?";
		$alteracao = $this->gerenciarAnimal($pAnimal,$query,$this::ALTERACAO_DADOS);
		return $alteracao;
	}

	private function gerenciarAnimal($pAnimal, $query, $op){
		try{
			$haErro = $this->verifica($pAnimal, $op);
			if($haErro)
				return $haErro;
			else{
				$result = null;
				$result = $this->conex->prepare($query);
				if($op == ModelAnimal::ALTERACAO_DADOS){
					$result->bindValue(8,$pAnimal->getCodigo());
				}
				$result->bindValue(1,$pAnimal->getNome());
				$result->bindValue(2,$pAnimal->getNick());
				$result->bindValue(3,$pAnimal->getDescricao());
				$result->bindValue(4,$pAnimal->getNascimento());
				$result->bindValue(5,$pAnimal->getSexo());
				$result->bindValue(6,$pAnimal->getSenha());
				$result->bindValue(7,$pAnimal->getEmail());
				$result->execute();
				return "Concluido";
			}

		}catch(PDOException $erro){
			return "erro: ".$erro->getMessage();
		}
	}	


/*	private function gerenciaAnimal($pAnimal, $operacao, $query){
		$result = null;
		$haErro=$this->existeAnimal($pAnimal,$operacao);
		if($haErro){
			return $this::NOME_JA_CADASTRADO;
		}

		else{
			try{
				//print_r($pAnimal);
				$result=$this->conex->getConnection()->prepare($query);
				$result->bindValue(1,$pAnimal->getCodigoDono());
				$result->bindValue(2,$pAnimal->getNome());
				$result->bindValue(3,$pAnimal->getNick());
				$result->bindValue(4,$pAnimal->getEspecie());
				$result->bindValue(5,$pAnimal->getNascimento());
				$result->bindValue(6,$pAnimal->getSexo());
				if($operacao==$this::ALTERACAO_DADOS){
					$result->bindValue(7,$pAnimal->getCodigo());
				}
				$result->execute();
				return $this::OK;
			}catch(PDOException $erro){
				return "erro: ".$erro->getMessage();
			}
		}
	}*/


	public function excluir($pAnimal)
	{
		$excluido = false;
		
		try{
			$resultado=$this->conex->getConnection()->prepare("delete from animal where codigo = ?");
			$resultado->bindValue(1,$pAnimal->getCodigo());
			$resultado->execute();
			$excluido = true;
		}catch(PDOException $erro){
			return "Erro inesperado da aplicacao";
		}
	
		if($excluido){
			return "Animal excluido";
		}
	}
	
	

	public function buscarPrincipaisAnimais($termo){
		$query = "
			select nome,descricao,nick
			from animal
			where nome like ?
			limit 3";
		return $this->buscarAnimal($termo, $query);	
				
	}


	public function buscarTodosAnimais($termo){
		$query = "
			select nome,descricao,nick
			from animal
			where nome like ?";
		return $this->buscarAnimal($termo, $query);					
	}

	public function buscarAnimal($termo, $query)
	{
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