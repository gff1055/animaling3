<?php

namespace App\Views;
use App\Init;


class Cabecalho{
	
	public function abertura($titulo){
		?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $titulo ?></title>

<link rel="stylesheet" href="<?php echo Init::$urlSources.'/src/css/reset.css'?>"/>
<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">-->


<link rel="stylesheet" href="<?php echo Init::$urlSources.'/src/css/bootstrap.css'?>"/>
<link rel="stylesheet" href="<?php echo Init::$urlSources.'/src/css/styleFonts.css'?>"/>
<link rel="stylesheet" href="<?php echo Init::$urlSources.'/src/css/formLogin.css'?>"/>
<link rel="stylesheet" href="<?php echo Init::$urlSources.'/src/css/style.css'?>"/>





</head>
<body>
<?php

	}


	public function fechamento(){
		?>
		<br><br>
		<div class="generalStyle footer">
		<a href="#"> Anúncios</a> &nbsp;
		<a href="#">Fale conosco</a> &nbsp;
		<a href="#"> Sobre nós</a> &nbsp;
		<a href="#"> Termos de serviço</a> &nbsp;
		<a href="#"> Privacidade</a>


		</div>
		<div class="footer">
			Todos os direitos reservados<br>
			Copyright 2018 &copy;
		</div>
		<br><br>
</body>
</html>
		<?php
	}
}
?>