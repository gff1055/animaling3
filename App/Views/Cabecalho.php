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
<link rel="stylesheet" href="<?php echo Init::$urlSources.'/src/css/style.css'?>"/>


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