<?php

use App\Init;

// mostra o nome do usuario logado
if (isset($_GET["pesquisa"])){
	$showTerm = $_GET["pesquisa"];
}
else $showTerm = "";

if (isset($_SESSION['login'])){?>
	<div class="topMenu">
		<div><a href="<?php echo Init::$urlRoot.'/'?>">Home</a></div>
		<div><form method="get" action="<?php echo Init::$urlRoot?>/busca">
			<input type="text" name="pesquisa" value="<?php echo $showTerm ?>" id="txtTerm"/>

			<input type="submit" value="Buscar" id = "btnSearch"/>
			<!--<input type="hidden" name="tipoPesquisa" value="Tudo"> -->
		</form></div>
		<div><a href="<?php echo Init::$urlRoot.'/'.$_SESSION['login']?>"><?php echo $_SESSION['name']?></a></div>
		<div><a href="<?php echo Init::$urlRoot.'/'.$_SESSION['login'].'/setup'?>">Configurações</a></div>
		<div><a href="<?php echo Init::$urlRoot?>/logout">Fazer Logoff</a></div>
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