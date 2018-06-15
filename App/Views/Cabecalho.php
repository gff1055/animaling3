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
<body><?php
	}


	public function fechamento(){
		?>
</body>
</html>
		<?php
	}
}
?>