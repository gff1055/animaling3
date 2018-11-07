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
		<div id="divLogoImage" >
			<img src="../src/img/logo-image.png"/>
		</div>
		<div>
		<form action="<?php echo Init::$urlRoot?>/logon" method="post" id="formLogin">
			<input type="text" name="formLogin" placeholder="Login ou Email" />
				<br>
				<br>
	
				<input type="password" name="formSenha" placeholder="Senha"/>
	
				<br>
				<div id="submitFormLogin">
					<input type="submit" value="Entrar">
				<?php if(!empty($_GET['erro'])) echo "<br><br>Usuario e/ou senha não existem"; ?>
				</div>
		</form>

		<div class="naoCadastrado">Não possui conta? Cadastre-se <a href="<?php echo Init::$urlRoot?>/register">aqui</a></div>

		<br>
		
		</div>
	</div>
</div>

