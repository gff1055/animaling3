<?php
namespace App\Controllers;

use App\Models\ModelAnimal;
use App\Init;
use App\Models\Animal;


class ControllerTeste{
	public function index(){
		$modelAnimal = new ModelAnimal(Init::getDB());
		
		
		$animal = new Animal();
		$animal->setCodigo(1);
		$animal->setNick("fidoumaegua");
		$animal->setEmail("fidoumageua@gmail.com");

		//echo $modelAnimal->existe("nick","Fido",ModelAnimal::NOVO_CADASTRO);
		//echo $modelAnimal->verifica($animal, ModelAnimal::NOVO_CADASTRO);
		echo $modelAnimal->geraUsuario();

	}
}
?>