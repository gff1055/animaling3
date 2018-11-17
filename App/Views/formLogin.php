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
		<?php
			if(!empty($_GET['register'])){?>
					<h6>Sign up to see photos and videos from your friends.</h6>
					<form action="<?php echo Init::$urlRoot?>/signup" method="post" class="formLogin">

						<input type="text" id="name" name="name" placeholder="Nome" class="requireField"/>
						<span id="fieldCheckName">*</span>
						<br>
						<input type="text"  id="email" name="email" placeholder="Email" class="requireField"/>
						<span id="fieldCheckEmail">*</span>
						<br>
						<input type="password" id="password" name="password" placeholder="Senha" class="requireField"/>
						<span id="fieldCheckPassword1">*</span>
						<br>
						<input type="password" id="checkPassword" name="checkPassword" placeholder="Redigite senha" class="requireField"/>
						<span  id="fieldCheckPassword2">*</span>
						<!--<br><br>
						<label for="date">Nascimento:</label><br>
						<input type="date" id="birthDate" name="birthDate"/>
						<br><br>
						<label for="genre">Sexo:</label><br>
						<select name="genre" id="genre">
							<option value="m">Masculino</option>
							<option value="f">Feminino</option>
						</select>-->
						<br><br>
	
						<input type="submit" value="Cadastrar" class="submitFormLogin" id="btnRegister"/>
					</form>

					<div class="naoCadastrado">Se já possuir conta, faça o login <a href="<?php echo Init::$urlRoot?>">aqui</a>
					</div>
					<br>
			<?php 
			}
			else{ ?>
				
					<form action="<?php echo Init::$urlRoot?>/logon" method="post" class="formLogin">
						<input type="text" name="formLogin" placeholder="Login ou Email" />
						<br>
	
						<input type="password" name="formSenha" placeholder="Senha"/>
						<br>
						<br>
		
							<input type="submit" value="Entrar" class="submitFormLogin">
							<?php
							if(!empty($_GET['erro'])) echo "<br><br>Usuario e/ou senha não existem";
							else echo "<br><br> &nbsp";
							?>
						
					</form>

					<div class="naoCadastrado">Não possui conta? Cadastre-se <a href="<?php echo Init::$urlRoot?>?register=1">aqui</a>
					</div>
					<br>
				
			<?php
			}
			?>
		</div>
		</div>
</div>

