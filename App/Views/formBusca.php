<?php
use App\Init;
?>

<form method="Post" action="../public/busca">
	<input type="text" name="pesquisa"/>
	<input type="submit" value="Buscar"/>
	<input type="hidden" name="tipoPesquisa" value="Tudo">
</form>
<?php

// mostra o nome do usuario logado
if (isset($_SESSION['login']))
			echo "Usuário: ".$_SESSION['login'];
		else
			echo "Usuário: Não conectado";
?>

<a href="<?php echo Init::$urlRoot?>/logout">Fazer Logoff</a>
