<?php
use App\Init;

// mostra o nome do usuario logado
if (isset($_SESSION['login'])){
			echo "Usuário: ".$_SESSION['login'];
	?>
	<a href="<?php echo Init::$urlRoot?>/logout">Fazer Logoff</a>
	<form method="Post" action="../public/busca">
		<input type="text" name="pesquisa"/>
		<input type="submit" value="Buscar"/>
		<input type="hidden" name="tipoPesquisa" value="Tudo">
	</form>
	<?php
}
else
	echo "Usuário: Não conectado";
?>


