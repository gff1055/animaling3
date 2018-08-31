<?php
use App\Init;

?>

<div id = "spaceResults">
<?php
$possuiResultados = 0; // flag para a existencia ou nao de resultados

//testando se a busca retornou algum resultado
if($ocorrenciasAnimal){
	echo "<h3>Animais</h3>";
	foreach($ocorrenciasAnimal as $animal){ // percorrendo os resultados
		echo
		"<br><a href=".Init::$urlRoot."/".$animal['nick']."><b>".$animal['nome']."</b></a>
		<br>".$animal['descricao']."<br>"; //exibindo os dados
	}
	$possuiResultados+=1;
}

// testando se a busca nos posts retornou algum resultado
//if(count($ocorrenciasPost)){
	//echo "<br>";
	/*echo "<h3>Posts</h3>";
	foreach($ocorrenciasPost as $postagem){ // percorrendo os resultados
		echo
		"<br><a href=".Init::$urlRoot."/".$postagem['nick']."><b>".$postagem['nomeAnimal']."</b></a>
		<br>".$postagem['dataStatus']."
		<br>".$postagem['acontAgora']."<br>
		<br>";
	}
	$possuiResultados+=1;*/
//}

// testando se nao houve nenhum resultado	
if (!$possuiResultados){
	echo "NA FORAM ACHADOS RESULTADOS";
}
?>
</div>