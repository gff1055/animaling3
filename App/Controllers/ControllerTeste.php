<?php
namespace App\Controllers;

use App\Models\ModelAnimal;
use App\Init;
use App\Models\Animal;


class ControllerTeste{
	public function index(){
		$modelAnimal = new ModelAnimal(Init::getDB());
		
		
		$pAnimal = new Animal();
		
		//$animal->setNick("fidoumaegua");
		//$animal->setEmail("fidoumageua@gmail.com");

		//echo $modelAnimal->existe("nick","Fido",ModelAnimal::NOVO_CADASTRO);
		//echo $modelAnimal->verifica($animal, ModelAnimal::NOVO_CADASTRO);

		//echo $modelAnimal->geraUsuario();

		$pAnimal->setNick("bia2912");
		$pAnimal->setSenha("291bia2");
		$pAnimal->setNome("beatriz2");
		$pAnimal->setNascimento("16-06-2006");
		$pAnimal->setSexo("F");
		$pAnimal->setEmail("beatriz2@gmail.com");
		$pAnimal->setDescricao("");

		echo $modelAnimal->inserirAnimal($pAnimal);

	}
}
?>