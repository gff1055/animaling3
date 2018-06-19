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

		$pAnimal->setCodigo(30);
		$pAnimal->setNick("Veludo");
		$pAnimal->setSenha("veludo2");
		$pAnimal->setNome("Veludo");
		$pAnimal->setNascimento("2011-07-01");
		$pAnimal->setSexo("M");
		$pAnimal->setEmail("veludo2@gmail.com");
		$pAnimal->setDescricao("sou peludo a beça");

		echo $modelAnimal->alterarDadosAnimal($pAnimal);

	}
}
?>