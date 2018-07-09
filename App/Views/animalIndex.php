<?php
use App\Models\Status;
use App\Init;

?>

<div>
	<br>
	<?php echo $dadosAnimal['nome']?><br>
	<?php echo $dadosAnimal['sexo']?><br>
	<?php echo $dadosAnimal['nascimento']?><br>
	<?php echo $dadosAnimal['descricao']?><br>
	<?php echo "dadosAnimal".$dadosAnimal['nick']?><br>
	<?php echo "SESSION".$_SESSION['login']?><br>

	
	<br>
</div>

<div>
	<br>
	publicacoes(<?php echo $numeroPosts?>)<br>
	<a href="../public/<?php echo $dadosAnimal['nick']?>/seguidores">Seguidores(<?php echo $numeroSeguidores;?>)</a><br>
	<a href="../public/<?php echo $dadosAnimal['nick']?>/seguindo">Seguindo(<?php echo $numeroSeguindo;?>)</a>
</div>

<!--<form method="post" action="../public/<?php echo $dadosAnimal['nick']?>/newpost"> -->
<!-- verificando se ha alguem ja está logado.-->
<?php if((isset($_SESSION['login'])) and ($_SESSION['login'] == $dadosAnimal['nick'])) {?>
<form method="post" action="">
	<input type="text" name="novoPost"/>
	<input type="submit" value="Postar">
	
</form>
<?php } ?>

<div>
	<?php
	// exibe as postagens
	if($posts){
		foreach($posts as $post){
			?>
			<br><br><br>
			<a href="<?php echo Init::$urlRoot.'/'.$dadosAnimal['nick']?>"><?php echo $post['nomeAnimal']?></a><br>
			<a href="<?php echo Init::$urlRoot.'/'.$dadosAnimal['nick'].'/'.$post['codigoPost']?>">Editar</a>
			<a href="<?php echo Init::$urlRoot.'/'.$dadosAnimal['nick'].'/'.$post['codigoPost'].'/delete'?>">Excluir</a><br>
			<a href="<?php echo Init::$urlRoot.'/'.$dadosAnimal['nick'].'/'.$post['codigoPost']?>"><?php echo $post['dataStatus']?></a><br>
			<?php echo $post['conteudo']?><br>
			<?php
		}
	}
	else
		echo "<br>Nenhuma postagem<br>";
	?>

</div>

