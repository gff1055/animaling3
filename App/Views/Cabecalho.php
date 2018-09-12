<?php

namespace App\Views;


class Cabecalho{
	
	public function abertura($titulo){
		?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $titulo ?></title>

<link rel="stylesheet" href="../src/css/style.css"/>
<link rel="stylesheet" href="../src/css/reset.css"/>
</head>
<body>
<?php

	}


	public function fechamento(){
		?>
</body>
</html>
		<?php
	}
}
?>