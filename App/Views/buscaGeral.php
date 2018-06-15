<?php
use App\Init;
?>

<form method="Post" action="">
	<input type="text" name="pesquisa" value="<?php echo $_POST['pesquisa']?>"/>
	<input type="submit" value="Buscar"/>
	<br> Pesquisar por: &nbsp
	<input type="radio" name="tipoPesquisa" value="Tudo" checked>Tudo 
	<input type="radio" name="tipoPesquisa" value="Animais">Animais
	<input type="radio" name="tipoPesquisa" value="Posts">Posts
</form>

<?php
$possuiResultados = 0;
if(!empty($_POST['pesquisa'])){
	
	if($ocorrenciasAnimal){
		echo "<h3>Animais</h3>";
		foreach($ocorrenciasAnimal as $animal){
			echo
			"<br><a href=".Init::$urlRoot."/".$animal['nick']."><b>".$animal['nome']."</b></a>
			<br>".$animal['descricao']."<br>";
		}
		$possuiResultados+=1;
	}

	if($ocorrenciasPost){
		echo "<h3>Posts</h3>";
		foreach($ocorrenciasPost as $postagem){
			echo
			"<br><a href=".Init::$urlRoot."/".$postagem['nick']."><b>".$postagem['nomeAnimal']."</b></a>
			<br>".$postagem['dataStatus']."
			<br>".$postagem['acontAgora']."<br>
			<br>";
		}
		$possuiResultados+=1;
	}
	
	if (!$possuiResultados){
		echo "NA FORAM ACHADOS RESULTADOS";
	}
}
?>