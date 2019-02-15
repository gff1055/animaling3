<?php
use App\Init;

?>

<div id = "spaceResults">
<?php
$possuiResultados = 0; // flag para a existencia ou nao de resultados

//testando se a busca retornou algum resultado
if($ocorrenciasAnimal){
	echo "<br><h3>Busca por ".$termo."</h3>";
	foreach($ocorrenciasAnimal as $animal){ // percorrendo os resultados?>

		<div class="divUserListing">
			<div class="divUserListPhoto">
				<img src="<?php echo $animal['foto']?>" /> 
			</div>

			<div class="divUserListName">
				<a href="<?php echo Init::$urlRoot.'/'.$animal['nick']?>">
					<b><?php echo $animal['nome']?></b>					
				</a>
			</div>

			<div class="divUserDesc">
				<a href="<?php echo Init::$urlRoot.'/'.$animal['nick']?>" class="infoSecond">
						<?php echo $animal['descricao'] ?>
				</a>
			</div>
		</div>
		<?php
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
<script src="../src/js/search.js"></script>