<?php

use App\Init;

/* Mostra o termo inserido na barra de busca */
if (isset($_GET["pesquisa"])){
	$showTerm = $_GET["pesquisa"];
}
else $showTerm = "";

// mostra o nome do usuario logado ou uma mensagem de acesso nao logado

if (isset($_SESSION['login'])){?>
	<div class="topMenu">
		<div class="divLogo">
			<a href="<?php echo Init::$urlRoot.'/'?>">
				<img src="<?php echo Init::$urlSources?>/src/img/title-image.png" class="nameImage">
			</a>
		</div>
		<div class="divSearchForm">
			<form method="get" action="<?php echo Init::$urlRoot?>/busca">
			<input type="text" name="pesquisa" value="<?php echo $showTerm ?>" id="txtTerm"/>

			<input type="submit" value="Buscar" id = "btnSearch" class="styleButton"/>
			<!--<input type="hidden" name="tipoPesquisa" value="Tudo"> -->
		</form></div>
		<div class="divIcons">
			<ul>
				<li><a href="<?php echo Init::$urlRoot.'/'.$_SESSION['login']?>">
				<img src="<?php echo Init::$urlSources.'/src/img/profile.png' ?>" class="imgIcon"/>
				<?php /*echo $_SESSION['name']*/?></a></li>
				<li>
				<a href="<?php echo Init::$urlRoot.'/'.$_SESSION['login'].'/setup'?>">
				<img src="<?php echo Init::$urlSources.'/src/img/profile.png' ?>" class="imgIcon"/>
				<!--Configurações--></a>
				</li>
				<li>
				<a href="<?php echo Init::$urlRoot?>/logout">
				<img src="<?php echo Init::$urlSources.'/src/img/profile.png' ?>" class="imgIcon"/>
			<!--Fazer Logoff--></a>
				</li>
			</ul>
		</div>
	</div>
		
	<?php
	}
else
	{
	?>
	Você não está logado. Faça <a href="<?php echo Init::$urlRoot?>">Login</a> ou <a href="<?php echo Init::$urlRoot?>/register">Cadastre-se</a>
	
	<!-- Adicionar na pagina inicial -->
	
	<!--<span id = "logo">Animaling</span>
	<form action="<?php echo Init::$urlRoot?>/logon" method="post" id="formLogin">
	
		<label for="name">Login/Email:</label>
		<input type="text" name="formLogin"/>
	
		&nbsp
		&nbsp
	
		<label for="name">Senha:</label>
		<input type="password" name="formSenha" class="formField"/>
	
		&nbsp
		&nbsp
	
		<input type="submit" value="Entrar">
		<?php if(!empty($_GET['erro'])) echo "ocorreu um erro"; ?>
	</form>-->
<?php }?>