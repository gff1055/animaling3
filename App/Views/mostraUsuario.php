<?php

use App\Init;

// mostra o nome do usuario logado
if (isset($_GET["pesquisa"])){
	$showTerm = $_GET["pesquisa"];
}
else $showTerm = "";

if (isset($_SESSION['login'])){
		echo "Usuário: ".$_SESSION['login'];?>
		<a href="<?php echo Init::$urlRoot?>/logout">Fazer Logoff</a>
		<form method="get" action="<?php echo Init::$urlRoot?>/busca">
			<input type="text" name="pesquisa" value="<?php echo $showTerm ?>" id="txtTerm"/>
			<input type="submit" value="Buscar" id = "btnSearch"/>
			<!--<input type="hidden" name="tipoPesquisa" value="Tudo"> -->
		</form>
	<?php
	}
else
	{
	?><a href="<?php echo Init::$urlRoot?>">Login</a>
<?php }?>