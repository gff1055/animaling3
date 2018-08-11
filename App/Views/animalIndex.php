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
	<br>
</div>

<div>
	<br>
	<?php // mostrandp a quantidade de publicações, seguidores e usuarios sendo seguidos?>
	publicacoes (<?php echo $numeroPosts?>)<br>
	<a href="../public/<?php echo $dadosAnimal['nick']?>/seguidores" id="countFollowers">
		Seguidores <span id="countFollower">(<?php echo $numeroSeguidores;?>)</span>
	</a>
	<br>
	<a href="../public/<?php echo $dadosAnimal['nick']?>/seguindo" id="countFollowing">
		Seguindo <span id="countFollowing">(<?php echo $numeroSeguindo;?>)</span>
	</a>
	
</div>

<?php

// verificando se quem esta acessando o perfil é o proprio usuario
if($acessoUsuarioSessao) {?>
	<form method="post" action="">
		<input type="text" name="novoPost"/>
		<input type="submit" value="Postar">
	
	</form>
	<?php
}

// se não for o usuario, verifica se o acesso é de um usuário logado.
elseif(!$acessoNaoLogado){
	?>
	<input type="button" name="btnFollow" id="btnSeguir" value="<?php echo $relacionamento ?>" />
	<input type="hidden" id=hdnPerfil value="<?php echo $dadosAnimal['codigo'] ?>">
	<input type="hidden" id=hdnSessaoUsuario value="<?php echo $_SESSION['id'] ?>">
<?php } ?>

<div>
	<?php

	// exibindo as postagens
	if($posts){
		foreach($posts as $post){
		// exibindo as opções de edicao, exclusão e o post?>
			<br><br><br>
			<a href="<?php echo Init::$urlRoot.'/'.$dadosAnimal['nick']?>">
				<?php echo $post['nomeAnimal']?>
			</a><br>
			<a href="<?php echo Init::$urlRoot.'/'.$dadosAnimal['nick'].'/'.$post['codigoPost']?>">
				Editar
			</a>
			<a href="<?php echo Init::$urlRoot.'/'.$dadosAnimal['nick'].'/'.$post['codigoPost'].'/delete'?>">Excluir</a><br>
			<a href="<?php echo Init::$urlRoot.'/'.$dadosAnimal['nick'].'/'.$post['codigoPost']?>">
				<?php echo $post['dataStatus']?>
			</a><br>
			<?php echo $post['conteudo']?><br>
			<?php
		}
	}
	else // no caso de nao haver postagens
		echo "<br>Nenhuma postagem<br>";
	?>

</div>
<script src="../src/js/support.js">
</script>

