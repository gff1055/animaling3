<?php

namespace App;

class Init{

	private $rotas;
	private $con;
	public static $urlRoot='/animaling3/public';
	public static $urlSources = '/animaling3';
	public static $rotaVar=3;

	function __construct(){
		$urlAcessada=$this->urlDigit();
		$urlDividida = $this->getParamRoute($urlAcessada);
		$this->inicializarRotas($urlDividida);
		print_r($urlDividida);
		$this->run($urlAcessada);
	}

	public function inicializarRotas($pUrlDividida){
		

		$arrayRotasAux['iniciando'] = array(
			'route'=>Init::$urlRoot.'/',
			'controller'=>'controllerIndex',
			'action'=>'index',
			'value'=>''
		);

		$arrayRotasAux['register'] = array(
			'route' => Init::$urlRoot.'/register',
			'controller' => 'controllerIndex',
			'action' =>  'register',
			'value' => ''
		);

		$arrayRotasAux['signup'] = array(
			'route' => Init::$urlRoot.'/signup',
			'controller' => 'controllerIndex',
			'action' =>  'signup',
			'value' => ''
		);

		$arrayRotasAux['saindo'] = array(
			'route'=>Init::$urlRoot.'/logout',
			'controller'=>'controllerIndex',
			'action'=>'logout',
			'value'=>''
		);

		$arrayRotasAux['autenticacao'] = array(
			'route'=>Init::$urlRoot.'/logon',
			'controller'=>'controllerIndex',
			'action'=>'logon',
			'value'=>$_POST
		);

		$arrayRotasAux['teste'] = array(
			'route'=>Init::$urlRoot.'/teste',
			'controller'=>'controllerTeste',
			'action'=>'index',
			'value'=>''
		);

		$arrayRotasAux['buscaIndex'] = array(
			'route'=>Init::$urlRoot.'/busca',
			'controller'=>'controllerBusca',
			'action'=>'index',
			'value'=>''
		);

		$arrayRotasAux['getSearch'] = array(
			'route' => Init::$urlRoot.'/getsearch',
			'controller' => 'controllerBusca',
			'action' => 'getSearch',
			'value' => ''
		);

		/*$arrayRotasAux['buscaTemp'] = array(
			'route'=>Init::$urlRoot.'/',
			'controller'=>'controllerBusca',
			'action'=>'pagina',
			'value'=>''
		);*/

		$arrayRotasAux['pagProfAnimal'] = array(
			'route'=>Init::$urlRoot.'/'.$pUrlDividida[Init::$rotaVar],
			'controller'=>'controllerAnimal',
			'action'=>'index',
			'value'=>$pUrlDividida[3]
		);

		$arrayRotasAux['seguidores'] = array(
			'route'=>Init::$urlRoot.'/'.$pUrlDividida[Init::$rotaVar].'/seguidores',
			'controller'=>'controllerAnimal',
			'action'=>'seguidores',
			'value'=>$pUrlDividida[3]
		);

		$arrayRotasAux['admSeguidores'] = array(
			'route'=> Init::$urlRoot.'/'.$pUrlDividida[Init::$rotaVar].'/followstate',
			'controller'=> 'controllerAnimal',
			'action'=> 'followstate',
			'value'=>''
		);

		$arrayRotasAux['admSeguidores'] = array(
			'route'=> Init::$urlRoot.'/'.$pUrlDividida[Init::$rotaVar].'/someactionfollow',
			'controller'=> 'controllerAnimal',
			'action'=> 'someactionfollow',
			'value'=>''
		);

		$arrayRotasAux['seguindo'] = array(
			'route'=>Init::$urlRoot.'/'.$pUrlDividida[Init::$rotaVar].'/seguindo',
			'controller'=>'controllerAnimal',
			'action'=>'seguindo',
			'value'=>$pUrlDividida[3]
		);

		$arrayRotasAux['countFollow'] = array(
			'route' => Init::$urlRoot.'/'.$pUrlDividida[Init::$rotaVar].'/countfollow',
			'controller' => 'controllerAnimal',
			'action' => 'countFollow',
			'value' => ''
		);

		$arrayRotasAux['setup'] = array(
			'route' => Init::$urlRoot.'/'.$pUrlDividida[Init::$rotaVar].'/setup',
			'controller' => 'controllerAnimal',
			'action' => 'setup',
			'value' => $pUrlDividida[3]
		);

		$arrayRotasAux['updateData'] = array(
			'route' => Init::$urlRoot.'/'.$pUrlDividida[Init::$rotaVar].'/updatedata',
			'controller' => 'controllerAnimal',
			'action' => 'updateData',
			'value' => $_POST
		);

		$arrayRotasAux['updatePassword'] = array(
			'route' => Init::$urlRoot.'/'.$pUrlDividida[Init::$rotaVar].'/updatepassword',
			'controller' => 'controllerAnimal', 
			'action' => 'updatePassword',
			'value' => $_POST
		);

		/*$arrayRotasAux['admSeguidos'] = array(
			'route'=> Init::$urlRoot.'/'.$pUrlDividida[3].'/opseguindo',
			'controller'=> 'controllerAnimal',
			'action'=> 'opSeguindo',
			'value'=>''
		);*/

		// Verifica se o endereco possui mais subdominios
		
		if(count($pUrlDividida)==Init::$rotaVar+2)
		$arrayRotasAux['verPostAnimal'] = array(
			'route'=>Init::$urlRoot.'/'.$pUrlDividida[Init::$rotaVar].'/'.$pUrlDividida[Init::$rotaVar+1],
			'controller'=>'controllerAnimal',
			'action'=>'verPost',
			'value'=>$pUrlDividida[Init::$rotaVar+1]
		);

		elseif(count($pUrlDividida)==Init::$rotaVar+3){
			$arrayRotasAux['excluirPost'] = array(
				'route'=>Init::$urlRoot.'/'.$pUrlDividida[Init::$rotaVar].'/'.$pUrlDividida[Init::$rotaVar+1].'/delete',
				'controller'=>'controllerAnimal',
				'action'=>'deletarPost',
				'value'=>$pUrlDividida[Init::$rotaVar+1]
			);

			$arrayRotasAux['editPost'] = array(
				'route'=>Init::$urlRoot.'/'.$pUrlDividida[Init::$rotaVar].'/'.$pUrlDividida[Init::$rotaVar+1].'/edit',
				'controller'=>'controllerAnimal',
				'action'=>'editPost',
				'value'=>$pUrlDividida[Init::$rotaVar+1]
			);

			$arrayRotasAux['updatePost'] = array(
				'route' => Init::$urlRoot.'/'.$pUrlDividida[Init::$rotaVar].'/'.$pUrlDividida[Init::$rotaVar+1].'/updatepost',
				'controller' => 'controllerAnimal',
				'action' => 'updatePost',
				'value' => $_POST
			);


		}


		$this->configurarRotas($arrayRotasAux);

	}

//chamando a funcao associada a rota
	public function run($url){
		$achou = 0;
		foreach($this->rotas as $rota){ // percorrendo o array em busca da rota
			if($rota['route'] == $url && !$achou){
				$achou=1;
				$classe = 'App\Controllers\\'.ucfirst($rota['controller']);
				$action = $rota['action'];
				$controller = new $classe;
				$controller->$action($rota['value']);
			}
		}
	}


	public function urlDigit(){
		return parse_url($_SERVER["REQUEST_URI"],PHP_URL_PATH);
	}

	public function getParamRoute($url){
		//echo "<br>".$url."<br>";
		$url = explode ("/", $url);
		return $url; //veja como fica a saída
	}

	public function configurarRotas(array $pRotas){
		$this->rotas = $pRotas;
	}


	public static function getDB(){
		try{
			//conexao com o banco de dados
			$con = new \PDO("mysql:host=localhost; dbname=bdanimalnet;charset=utf8","root","");
		}catch(PDOException $e){
			echo "erro".$e->getMessage();
		}
		return $con;
	}

	public function log(){
		
	}

}


?>