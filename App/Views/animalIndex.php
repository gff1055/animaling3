<?php
use App\Models\Status;
use App\Init;

?>

<div class="photoUserDescDiv">
	<div class="photoDiv">
		<img src="<?php echo $dadosAnimal['foto']?>" /> 
	</div>
	<div class="userDiv">
		<span id = "nameUser"><?php echo $dadosAnimal['nome']?></span>
	</div>
	<div class="descriptionDiv">
		<?php echo $dadosAnimal['descricao']?><br>
	</div>
</div>

<div class="generalStyle followBar">
	<div class="divCountPublications">
		<?php // mostrandp a quantidade de publicações, seguidores e usuarios sendo seguidos?>
		publicacoes (<?php echo $numeroPosts?>)
	</div>
	<div class="divCountFollowers">
		<a href="../public/<?php echo $dadosAnimal['nick']?>/seguidores">
		Seguidores (<span id="countFollowers"><?php echo $count['followers']?></span>)
		</a>
	</div>
	<div class="divCountFollowing">
		<a href="../public/<?php echo $dadosAnimal['nick']?>/seguindo" >
			Seguindo (<?php echo $count['followings']?>)
		</a>
	</div>
	
	<div class="divPostBtnFollow">
		<?php // verificando se quem esta acessando o perfil é o proprio usuario
		if($acessoUsuarioSessao) {?>
			<br>
			<fieldset>
				<legend>t</legend>
<!--			<div class="divPostBtnFollow">-->
				<form method="post" action="" class="formToPost">
					<textarea rows="4" name="novoPost" placeholder="O que está acontecendo?"></textarea>
					<br>
					<input type="submit" value="Postar" class="styleButton">
	
				</form>
			</fieldset>
				<!--</div>-->
		<?php
		}

		// se não for o usuario da sessão, verifica se o acesso é de alguem que está logado.
		elseif(!$acessoNaoLogado){
		?>
			<form>
				<input type="button" name="btnFollow" id="btnSeguir" class="styleButton" value="<?php echo $relacionamento ?>" />
				<input type="hidden" id=hdnPerfil value="<?php echo $dadosAnimal['codigo'] ?>">
				<input type="hidden" id=hdnSessaoUsuario value="<?php echo $_SESSION['id'] ?>">
			</form>
		<?php
		}?>
	</div>
</div>


	<?php

	// exibindo as postagens
	if($posts){
		foreach($posts as $post){
		// exibindo as opções de edicao, exclusão e o post?>
		<div class="postArea">
			<div class="divUserPhotoPost">
				<img src="<?php echo $dadosAnimal['foto']?>" /> 
			</div>
			<div class="divUserNameDatePost">
				<a href="<?php echo Init::$urlRoot.'/'.$dadosAnimal['nick']?>" class="generalStyle">
					<?php echo $post['nomeAnimal']?>
				</a>
				<br>
				<a href="<?php echo Init::$urlRoot.'/'.$dadosAnimal['nick'].'/'.$post['codigoPost']?>" class="infoSecond">
				<?php echo  date('d/m/Y H:i:s', strtotime($post['dataStatus']))?></a>
			</div>
			<div class="divContentPost">
				<?php echo $post['conteudo']?>
				<br>
				<?php
				if($acessoUsuarioSessao){?>
					<a href="<?php echo Init::$urlRoot.'/'.$dadosAnimal['nick'].'/'.$post['codigoPost'].'/edit'?>" class="infoSecond">Editar</a>
					<a href="<?php echo Init::$urlRoot.'/'.$dadosAnimal['nick'].'/'.$post['codigoPost'].'/delete'?>" class="infoSecond">Excluir</a><br>
				<?php } ?>
				
				
			</div>
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

