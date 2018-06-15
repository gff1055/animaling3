<?php
use App\Init;
?>
<form method="Post" action="">
	<input type="text" name="pesquisa" value="<?php echo $_POST['pesquisa']?>" />
	<input type="submit" value="Buscar"/>
	<br> Pesquisar por: &nbsp
	<input type="radio" name="tipoPesquisa" value="Tudo">Tudo 
	<input type="radio" name="tipoPesquisa" value="Animais">Animais
	<input type="radio" name="tipoPesquisa" value="Posts" checked>Posts
</form>

<?php
if(!empty($_POST['pesquisa'])){
	if($ocorrenciasPosts){
		foreach($ocorrenciasPosts as $postagem){
			echo 
			"<br>
			<a href=".Init::$urlRoot."/".$postagem['nick']."><b>".$postagem['nomeAnimal']."</b></a>
			<br>".$postagem['dataStatus']."
			<br>".$postagem['acontAgora']."
			<br><br>";
		}
	}
	else{
		echo "sem ocorrencias";
	}
}
?>