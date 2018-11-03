<?php
	use App\Init;
?>

<div id="pageLoginDiv">
	<div id="mainImageDiv">
		<div>
			<img src="../src/img/conectar.png" class="subMainImage" /> Conecte-se
			
		</div>
		<div>
			<img src="../src/img/viva.png" class="subMainImage" /> Viva
			
		</div>
		<div>
			<img src="../src/img/compartilhe.png" class="subMainImage" /> Compartilhe
		</div>
		<div>
			<img src="../src/img/adote.png" class="subMainImage" /> Adote
		</div>
		
	</div>

	<div>
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
		<br>
		Não possui conta? Cadastre-se <a href="<?php echo Init::$urlRoot?>/register">aqui</a>
	</div>
</div>

