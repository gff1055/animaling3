<?php

namespace App\Models;

use App\Init;


class ModelStatus{

	private $conex;

	//constante usada para verificar se a alteracao a ser feita no banco é um cadastro
	const NOVO_STATUS = 1;
	const OK = 2;
	const EXCLUSAO = 3;
	const NO_RESULTS = 0;
	
	
	function __construct($pConex){
		$this->conex=$pConex;
	}

	function __destruct(){
		$this->conex = null;
	}

	
	public function exibirTodosStatus($pNick){

		try{

			$resultado=$this->conex->prepare("
				select s.codigo as codigoPost, a.nome as nomeAnimal, s.conteudo as conteudo, s.dataStatus as dataStatus 
				from animal as a
				inner join status as s 
				on a.codigo=s.codigoAnimal
				where a.nick=?
				order by dataStatus desc");
			$resultado->bindValue(1,$pNick);
			$resultado->execute();

			$todosStatus=array();

			//verifica se foi encontrado algum status associado ao animal
			if($resultado->rowCount()>0 ){
				while($linha=$resultado->fetch(\PDO::FETCH_ASSOC)){
					array_push($todosStatus,$linha);
				}

				return $todosStatus;
			}
			else return 0;
		
		}catch(PDOException $e){
			return  "ERRO: ".$erro->getmessage();
		}
	}

	public function contPosts($pNick){
		try{

			$resultado=$this->conex->prepare("
				select count(*) as quantidadePosts
				from animal as a
				inner join status as s 
				on a.codigo=s.codigoAnimal
				where a.nick=?");
			$resultado->bindValue(1,$pNick);
			$resultado->execute();

			$todosStatus=$resultado->fetch(\PDO::FETCH_ASSOC);
			return $todosStatus['quantidadePosts'];
		}catch(PDOException $e){
			return  "ERRO: ".$erro->getmessage();
		}
	}

	public function exibirUmStatus($codigoStatus){
		try{
			$resultado=$this->conex->prepare("
				select a.nome as nomeAnimal, s.conteudo as conteudoPost, s.dataStatus as dataStatus, a.nick as nickAnimal
				from animal as a
				inner join status as s
				on a.codigo=s.codigoAnimal
				where s.codigo=?");
			$resultado->bindValue(1,$codigoStatus);
			$resultado->execute();

			if($resultado->rowCount()>0){
				$linha = $resultado->fetch(\PDO::FETCH_ASSOC);
				return $linha;
			}
			else
				return null;
		}catch(PDOException $e){
			return "ERRO".$erro->getmessage();
		}
	}

	public function inserirStatus($pStatus){
	
		$query = "insert into status(conteudo, codigoAnimal, dataStatus) values (?,?,?)";
		$novoStatus = $this->gerenciarStatus($pStatus, $query, true);		
		return $novoStatus;
	}


	public function atualizarStatus($pStatus){
	
		$query = "update status set conteudo=? where codigo=?";
		$atualizarStatus = $this->gerenciarStatus($pStatus, $query, false);
		return $atualizarStatus;
	}


	private function gerenciarStatus($pStatus,$query,$novoStatus){
	
		try{

			//preparacao a query
			$resultado=$this->conex->prepare($query);

			//fazendo o binding do codigo, data de status e do conteudo
			$resultado->bindValue(1,$pStatus->getConteudo());
			
			// se for um novo status śerá preciso a data e o "animal" que postou
			if($novoStatus){
				$resultado->bindValue(2,$pStatus->getCodigoAnimal());	
				$resultado->bindValue(3,$pStatus->getDataStatus());
			}

			// se for editar um status já existente é necessario apenas o codigo
			else{
				$resultado->bindValue(2,$pStatus->getCodigo());
			}
			
			//executando a query
			$resultado->execute();
			
			return $this::OK;

		}catch(PDOException $erro){
			return "Erro:".$erro->getMessage();
		}
	}

	
	public function excluirStatus($pStatus){

		try{

			$resultado=$this->conex->prepare("delete from status where codigo=?");
			$resultado->bindValue(1,$pStatus);
			$resultado->execute();
			return true;


		}catch(PDOException $erro){

			echo "Erro: ".$erro.getMessage();
			return false;
		}
	}
	

	public function buscarPrincipaisStatus($termo){
		$query ="select a.nome as nomeAnimal, s.conteudo as acontAgora, nick, s.dataStatus
		from animal as a
		inner join status as s
		on a.codigo = s.codigoAnimal
		where a.nome like ? or s.conteudo like ?
		order by s.dataStatus DESC
		limit 3";
		return $this->buscarStatus($termo, $query);
	}

	public function buscarTodosStatus($termo){
		$query =
		"select a.nome as nomeAnimal, s.conteudo as acontAgora, nick, s.dataStatus
		from animal as a
		inner join status as s
		on a.codigo = s.codigoAnimal
		where a.nome like ? or s.conteudo like ?
		order by s.dataStatus DESC";
		return $this->buscarStatus($termo, $query);	
	}


	private function buscarStatus($termo,$query){
		$resultado=$this->conex->prepare($query);
		//preparando a query do banco de dados

		$resultado->bindValue(1,"%".$termo."%");
		$resultado->bindValue(2,"%".$termo."%");
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
			
			$arr = self::NO_RESULTS;
		}
		
		return $arr;	
	}
}


?>