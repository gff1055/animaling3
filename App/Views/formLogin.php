<?php
	use App\Init;
?>


<form action="<?php echo Init::$urlRoot?>/logon" method="post" id="formLogin">

	<fieldset>
		<legend><span id = "logo">Animaling</span></legend>
		<label for="name" class="formField">Login/Email:</label>
		<input type="text" name="formLogin"/>
	
		<br>
		<br>
	
		<label for="name" class="formField">Senha:</label>
		<input type="password" name="formSenha"/>
	
		<br>
		<br>

		<input type="submit" value="Entrar">
		<?php if(!empty($_GET['erro'])) echo "ocorreu um erro"; ?>
	</fieldset>
</form>

Não possui conta? Cadastre-se <a href="<?php echo Init::$urlRoot?>/register">aqui</a>