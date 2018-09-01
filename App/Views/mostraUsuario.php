<?php

use App\Init;

// mostra o nome do usuario logado
if (isset($_SESSION['login'])){
		echo "Usuário: ".$_SESSION['login'];?>
		<a href="<?php echo Init::$urlRoot?>/logout">Fazer Logoff</a>
		<form method="Post" action="<?php echo Init::$urlRoot?>/busca">
			<input type="text" name="pesquisa" id = "txtTerm"/>
			<input type="button" value="Buscar" id = "btnSearch"/>
			<!--<input type="hidden" name="tipoPesquisa" value="Tudo"> -->
		</form>
	<?php
	}
else
	{
	?><a href="<?php echo Init::$urlRoot?>">Login</a>
<?php } ?>