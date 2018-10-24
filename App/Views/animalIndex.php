<?php
use App\Models\Status;
use App\Init;

?>

<div>
	<span id = "nameUser"><?php echo $dadosAnimal['nome']?></span>
	<br>
	<br>
	<?php echo $dadosAnimal['descricao']?><br>
</div>

<div id = "followBar" class="generalStyle">
	<div>
		<?php // mostrandp a quantidade de publicações, seguidores e usuarios sendo seguidos?>
		publicacoes (<?php echo $numeroPosts?>)
	</div>
	<div>
		<a href="../public/<?php echo $dadosAnimal['nick']?>/seguidores">
		Seguidores (<span id="countFollowers"><?php echo $count['followers']?></span>)
		</a>
	</div>
	<div>
	<a href="../public/<?php echo $dadosAnimal['nick']?>/seguindo" >
		Seguindo (<?php echo $count['followings']?>)
	</a>
	</div>
	

	<?php // verificando se quem esta acessando o perfil é o proprio usuario
	if($acessoUsuarioSessao) {?>
		<form method="post" action="">
			<input type="text" name="novoPost"/>
			<input type="submit" value="Postar">
	
		</form>
	<?php }

	// se não for o usuario da sessão, verifica se o acesso é de alguem que está logado.
	elseif(!$acessoNaoLogado){
		?>
		<form>
			<input type="button" name="btnFollow" id="btnSeguir" value="<?php echo $relacionamento ?>" />
			<input type="hidden" id=hdnPerfil value="<?php echo $dadosAnimal['codigo'] ?>">
			<input type="hidden" id=hdnSessaoUsuario value="<?php echo $_SESSION['id'] ?>">
		</form>
	<?php } ?>
</div>


	<?php

	// exibindo as postagens
	if($posts){
		foreach($posts as $post){
		// exibindo as opções de edicao, exclusão e o post?>
		<div class="postArea">
			<a href="<?php echo Init::$urlRoot.'/'.$dadosAnimal['nick']?>" class="generalStyle">
				<?php echo $post['nomeAnimal']?>
			</a>
			<br>
			<br>
			<?php
			if($acessoUsuarioSessao){?>
				<a href="<?php echo Init::$urlRoot.'/'.$dadosAnimal['nick'].'/'.$post['codigoPost'].'/edit'?>">Editar</a>
				<a href="<?php echo Init::$urlRoot.'/'.$dadosAnimal['nick'].'/'.$post['codigoPost'].'/delete'?>">Excluir</a><br>
			<?php } ?>
			<?php echo $post['conteudo']?>
			<br>
			<br>
			<br>
			<a href="<?php echo Init::$urlRoot.'/'.$dadosAnimal['nick'].'/'.$post['codigoPost']?>" class="postDate">
				<?php echo "Postado em ".$post['dataStatus']?>
			</a><br>
		</div>
			<?php
		}
	}
	else{ // no caso de nao haver postagens?>
		<div>
		<?php echo "<br>Nenhuma postagem<br>";?>
		</div>
	<?php } ?>
<script src="<?php echo Init::$urlSources.'/src/js/support.js'?>">
</script>

