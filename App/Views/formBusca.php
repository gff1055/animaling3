<?php
use App\Init;

// mostra o nome do usuario logado
if (isset($_SESSION['login'])){
	?>
	<form method="Post" action="<?php echo Init::$urlRoot?>/busca">
		<input type="text" name="pesquisa"/>
		<input type="submit" value="Buscar"/>
		<input type="hidden" name="tipoPesquisa" value="Tudo">
	</form>
	<?php
}?>


