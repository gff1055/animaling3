<?php

namespace App\Controllers;

use App\Models\ModelDono;
use App\Models\ModelAnimal;
use App\Models\ModelStatus;
use App\Views\Cabecalho;
use App\Init;

class ControllerBusca{

	public function pagina(){
		include_once "../App/Views/pagina.php";
	}

	public function index(){

		$cab = new Cabecalho();

		$termo = $_POST["pesquisa"];
		$tipo = $_POST["tipoPesquisa"];

		$cab->abertura("$termo - Pesquisa");
		
		if($tipo=="Tudo"){

			$modelAnimal = new ModelAnimal(Init::getDB());
			$ocorrenciasAnimal = $modelAnimal->buscarPrincipaisAnimais($termo);

			$modelPost = new ModelStatus(Init::getDB());
			$ocorrenciasPost = $modelPost->buscarPrincipaisStatus($termo);

			include_once "../App/Views/buscaGeral.php";
		}

		elseif($tipo=="Animais"){
			$modelAnimal = new ModelAnimal(Init::getDB());
			$ocorrenciasAnimal = $modelAnimal->buscarTodosAnimais($termo);
			include_once "../App/Views/buscarAnimal.php";
		}

		elseif($tipo=="Posts"){
			$modelPosts = new ModelStatus(Init::getDB());
			$ocorrenciasPosts = $modelPosts->buscarTodosStatus($termo);
			include_once "../App/Views/buscarPosts.php";	
		}

		else echo "OPA...";

		$cab->fechamento();
	}

}

?>