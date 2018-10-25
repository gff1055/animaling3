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
<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">-->
<link rel="stylesheet" href="<?php echo Init::$urlSources.'/src/css/style.css'?>"/>
<link rel="stylesheet" href="<?php echo Init::$urlSources.'/src/css/formLogin.css'?>"/>


</head>
<body>
<?php

	}


	public function fechamento(){
		?>
		<br><br>Copyright 2018 (c)<br><br>
</body>
</html>
		<?php
	}
}
?>