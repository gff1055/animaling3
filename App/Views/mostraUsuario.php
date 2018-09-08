<?php

use App\Init;

// mostra o nome do usuario logado
if (isset($_GET["pesquisa"])){
	$showTerm = $_GET["pesquisa"];
}
else $showTerm = "";

if (isset($_SESSION['login'])){?>
		<a href="<?php echo Init::$urlRoot.'/'.$_SESSION['login']?>"><?php echo $_SESSION['login']?></a>
		
		<a href="<?php echo Init::$urlRoot?>/logout">Fazer Logoff</a>
		<form method="get" action="<?php echo Init::$urlRoot?>/busca">
			<input type="text" name="pesquisa" value="<?php echo $showTerm ?>" id="txtTerm"/>
			<input type="submit" value="Buscar" id = "btnSearch"/>
			<!--<input type="hidden" name="tipoPesquisa" value="Tudo"> -->
		</form>
	<?php
	}
else
	{
	?>
	<!--<a href="<?php echo Init::$urlRoot?>">Login</a>-->
	<h1>nome</h1>
<form action="<?php echo Init::$urlRoot?>/logon" method="post">
login:<input type="text" name="formLogin"/>
<br>
senha:<input type="password" name="formSenha"/>
<br>
<input type="submit" value="Entrar">
<?php if(!empty($_GET['erro'])) echo "ocorreu um erro"; ?>
</form>
<?php }?>