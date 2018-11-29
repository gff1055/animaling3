<?php
namespace App\Controllers;

use App\Models\ModelAnimal;
use App\Models\ModelStatus;
use App\Models\Status;
use App\Init;
use App\Models\Animal;


class ControllerTeste{
	public function index(){
		//$modelAnimal = new ModelAnimal(Init::getDB());
		
		
		//$pAnimal = new Animal();
		
		//$animal->setNick("fidoumaegua");
		//$animal->setEmail("fidoumageua@gmail.com");

		//echo $modelAnimal->existe("nick","Fido",ModelAnimal::NOVO_CADASTRO);
		//echo $modelAnimal->verifica($animal, ModelAnimal::NOVO_CADASTRO);

		//echo $modelAnimal->geraUsuario();

//		$pAnimal->setCodigo(30);
//		$pAnimal->setNick("Veludo");
//		$pAnimal->setSenha("veludo2");
//		$pAnimal->setNome("Veludo");
//		$pAnimal->setNascimento("2011-07-01");
//		$pAnimal->setSexo("M");
//		$pAnimal->setEmail("veludo2@gmail.com");
//		$pAnimal->setDescricao("sou peludo a beça");

		//echo $modelAnimal->changePassword("Fido",88888);

		/*$modelStatus = new ModelStatus(Init::getDB());
		$status = new Status();
		$status->setCodigo(14);
		$codeUser = 456;


		if($modelStatus->IsItExistUserPost($status->getCodigo(), $codeUser))
			echo "OK";
		else echo "NULL";*/


		$pasta_dir = "../src/img/data_users/";	//diretorio dos arquivos
		//se nao existir a pasta ele cria uma
		if(!file_exists($pasta_dir)){
			mkdir($pasta_dir,0775);
			echo "mkdir";
			//echo exec('whoami');
		}

	}
}
?>