<?php
namespace App\Controllers;

use App\Models\ModelAnimal;
use App\Models\ModelStatus;
use App\Models\Status;
use App\Init;
use App\Models\Animal;


class ControllerTeste{
	public function index(){
	/*	$modelAnimal = new ModelAnimal(Init::getDB());
		if($modelAnimal->createLeftFolders()){
			echo "foi";
		}
		else
			echo "nao foi";*/
		
		
		$pAnimal = new Animal();
		$modelAnimal = new ModelAnimal(Init::getDB());
		
		$pAnimal->setCodigo(6);
		$pAnimal->setNick("tigo");
		$pAnimal->setSenha("tigo");
		//$pAnimal->setNome("1");
		//$pAnimal->setFoto("../src/img/data_users/profile_photo_default/profile.jpg");
		//$pAnimal->setEmail("um1@gmail.com");
		//$pAnimal->setDescricao("eu sou o um (1)");

		if($modelAnimal->changeCredentials(
			$pAnimal->getNick(),
			$pAnimal->getSenha(),
			$pAnimal->getCodigo()
		)){
			echo "FUNCIONOU :-)";
		}

		else echo "NAO FUNCIONOU :-(";

		
		/*$modelStatus = new ModelStatus(Init::getDB());
		$status = new Status();
		$status->setCodigo(14);
		$codeUser = 456;


		if($modelStatus->IsItExistUserPost($status->getCodigo(), $codeUser))
			echo "OK";
		else echo "NULL";*/


		/*$pasta_dir = "../src/img/data_users/";	//diretorio dos arquivos
		//se nao existir a pasta ele cria uma
		if(!file_exists($pasta_dir)){
			mkdir($pasta_dir,0775);
			echo "mkdir";
			//echo exec('whoami');
		}*/
	}
		
	/*public function createFolder($pNick){
		try{
		$result = $this->conex->prepare("select codigo from animal where nick=?");
			$result->bindValue(1,$pNick);
			if($result->rowCount()>0){
				while($row = $result->fetch(\PDO::FETCH_ASSOC)){
					$userFolder = "../src/img/data_users/".$row["codigo"];
					if(!file_exists($userFolder)){
						mkdir($userFolder,0775);
						return true;
					}
				}	
			}
		}catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
	

	}*/
}
?>