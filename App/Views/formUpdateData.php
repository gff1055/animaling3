<?php 
use App\Init;
?>
<div class="divUpdate">
	<div class="divPhotoUpdate">
		<br>
		<h2> Foto de perfil </h2>
		<br>
		<form action="<?php echo Init::$urlRoot.'/'.$_SESSION['login']?>/updatephoto" method="post" enctype = "multipart/form-data">
			<img src="<?php echo $dadosAnimal['foto']?>" />
			<br><br>
			<label for="foto" class="labelUpdatePhoto">Carregar foto</label>
			<input type="file" id="foto" name='foto'/>
			<input type="submit" value="Atualizar Foto" class="styleButton"/>
		</form>
	</div>
	
	<div class="divDataFormUpdate">
	<br>
	<h2> Dados do Perfil </h2>
	<br>
		<form action="<?php echo Init::$urlRoot.'/'.$_SESSION['login']?>/updatedata" method="post">
			<label for="name">Nome para exibição:</label><br>
			<input type="text" id="name" name="name" value = "<?php echo $dadosAnimal['nome']?>"/>
			<br><br>
	
			<label for="email">Email:</label><br>
			<input type="text"  id="email" name="email" value = "<?php echo $dadosAnimal['email']?>"/>
			<br><br>
	
			<label for="description">Descrição:</label>
			<textarea id="description" name="description" rows="10" cols="50"><?php echo $dadosAnimal['descricao']?></textarea>
			<br><br>
	
			<!--<label for="nick" class="formField">Usuario:</label>
			<input type="text" id="nick" name="nick" value = "<?php echo $dadosAnimal['nick']?>"/>
			<br><br>
	
			<label for="password" class="formField">Senha:</label>
			<input type="text" id="password" name="password" value = "<?php echo $dadosAnimal['senha']?>"/>
			<br><br>-->
			<!--
			<label for="dateBirth" class="formField">Data de nascimento:</label>
			<input type="date" id="birthDate" name="birthDate" value = "<?php echo $dadosAnimal['nascimento']?>"/>
			<br><br>
	
			<label for="genre" class="formField">Sexo:</label>
			<select name="genre" id="genre">
				<option value="m">Masculino</option>
				<option value="f">Feminino</option>
			</select>
			<br><br>-->	
			<input type="submit" value="Atualizar Dados" class="styleButton"/>
		</div>
	</form>
	<br>
</div>
<div>
<a href="<?php echo Init::$urlRoot.'/'?>">&laquo; Voltar para Home</a></div>
<div class = "divUpdateCredentials">
	<br>
	<h2>Usuario e Senha</h2>
	<br>

	<form action="<?php echo Init::$urlRoot.'/'.$_SESSION['login']?>/updatecredentials" method="post">

		<label for="user" class="formField">Usuario:</label>
		<input type="text" id="user" name="user" value="<?php echo $dadosAnimal['nick']?>"/>
		<br><br>

		<label for="oldPassword" class="formField">Senha atual:</label>
		<input type="text" id="oldPassword" name="oldPassword"/>
		<br><br>
	
		<label for="newPassword" class="formField">Nova senha:</label>
		<input type="password" id="newPassword" name="newPassword"/>
		<br><br>
	
		<label for="checkNewPassword" class="formField">Confirme a nova senha:</label>
		<input type="password" id="checkNewPassword" name="checkNewPassword"/>
		<br><br>
	
		<a href="<?php echo Init::$urlRoot.'/'?>">&laquo; Voltar para Home</a>
		<input type="submit" value="Atualizar Senha" class="styleButton"/>
	</form>
	<br>
	<br>
</div>

<div class="deleteAccount">
	<a href="<?php echo Init::$urlRoot.'/'.$_SESSION['login'].'/delete' ?>">Excluir conta permanentemente</a>
</div>
<br>