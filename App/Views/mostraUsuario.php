<?php

use App\Init;

// mostra o nome do usuario logado
if (isset($_SESSION['login'])){
		echo "Usuário: ".$_SESSION['login'];?>
		<a href="<?php echo Init::$urlRoot?>/logout">Fazer Logoff</a>
<?php }
else
	{
	?><a href="<?php echo Init::$urlRoot?>">Login</a>
<?php } ?>