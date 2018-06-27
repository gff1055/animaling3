<?php

namespace App\Views;


class Cabecalho{
	
	public function abertura($titulo){
		?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $titulo ?></title>
</head>
<body>
<?php
if(isset($_SESSION['login'])) echo "Usuario: ".$_SESSION['login'];
else echo "OPA<br>";
	}


	public function fechamento(){
		?>
</body>
</html>
		<?php
	}
}
?>