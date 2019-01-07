<?php
namespace App\Controllers;

use App\Models\ModelAnimal;
use App\Models\ModelStatus;
use App\Models\Status;
use App\Init;
use App\Models\Animal;


class ControllerTeste{

	public function front(){
		?>
		<form action="<?php echo Init::$urlRoot?>/teste" method="post" enctype = "multipart/form-data">

			
			<label for="codigo" class="formField">Codigo:</label>
			<input type="input" id="codigo" name="codigo" value = ""/>
			<br><br>
	
			<label for="foto" class="formField">Foto de perfil:</label>
			<input type="file" id="foto" name="foto"/>
			<br><br>

			<input type="submit" value="Cadastrar" class="submitFormLogin" id="btnRegister"/>

		<br><br>-->
	</form>
		<?php
	}

	public function index($pArrayDataUser){

		$modelUser = new ModelAnimal(Init::getDB());
		$objUser = new Animal();

/*		print_r($pArrayDataUser);
		print_r($_FILES);*/

		/* Carregando os novos dados inseridos*/
		$objUser->setCodigo($pArrayDataUser['codigo']);
		/*$folderUser = "../src/img/data_users/".$objUser->getCodigo()."/";
		$photoPath = $folderUser.$_FILES['foto']['name'];
		move_uploaded_file($_FILES['foto']['tmp_name'],$photoPath);
*/

		//$objUser->setEmail($pArrayDataUser['email']);
		//$objUser->setFoto($photoPath);
		//$objUser->setSenha($pArrayDataUser['password']);
		//$objUser->setNascimento($pArrayDataUser['birthDate']);

		// Testando se os dados foram alterados
		if($modelUser->changeProfilePhoto($pArrayDataUser)){
			
			//if(!file_exists($folderUser)){
			//	mkdir($folderUser, 0775);
			//}

			//echo "perfil salvo";
			
			//header("location: ".Init::$urlRoot."/".$_SESSION['login']);	// redirecionamento para a pagina do usuario
			echo "FUNCIONOU :-D";
		}
		else 
			echo "erro";

	/*	$modelAnimal = new ModelAnimal(Init::getDB());
		if($modelAnimal->createLeftFolders()){
			echo "foi";
		}
		else
			echo "nao foi";*/
		
		
		/*$pAnimal = new Animal();
		$modelAnimal = new ModelAnimal(Init::getDB());
		
		$pAnimal->setCodigo(66);
		$pAnimal->setNick("user66");
		$pAnimal->setSenha("dois");
		$pAnimal->setNome("Kyuminha");
		$pAnimal->setFoto("../src/img/data_users/66/mypic.jpg");
		$pAnimal->setEmail("dois@gmail.com");
		$pAnimal->setDescricao("Eletrica, atletica, ama tênis e futebol americano");

		/*if($modelAnimal->changeCredentials(
			$pAnimal->getNick(),
			$pAnimal->getSenha(),
			$pAnimal->getCodigo()
		)){
			echo "FUNCIONOU :-)";
		}

		else echo "NAO FUNCIONOU :-(";*/

		/*if($modelAnimal->alterarDadosAnimal($pAnimal)){
			echo "FUNCIONOU :-D";
		}
		else{
			echo "Nao funcionou :-/";
		}
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
	/*}*/
		
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
		}*/
	

	}
}
?>