<?php 
use App\Init;
?>
<h6>Abra uma conta</h6>

<div>
<form action="<?php echo Init::$urlRoot?>/signup" method="post">

	<label for="name" class="formField">Nome:</label>
	<input type="text" id="name" name="name"/>
	<br><br>
	<label for="email" class="formField">Email:</label>
	<input type="text"  id="email" name="email"/>
	<br><br>
	<label for="password" class="formField">Senha:</label>
	<input type="password" id="password" name="password"/>
	<br><br>
	<label for="checkPassword" class="formField">Conf. Senha:</label>
	<input type="password" id="checkPassword" name="checkPassword"/>
	<br><br>
	<label for="dateBirth" class="formField">Data de nascimento:</label><br>
	<input type="date" id="birthDate" name="birthDate"/>
	<br><br>
	<label for="genre" class="formField">Sexo:</label>
	<select name="genre" id="genre">
		<option value="m">Masculino</option>
		<option value="f">Feminino</option>
	</select>
	<br><br>
	
	<input type="submit" value="Cadastrar" class="submitFormLogin"/>
</form>
</div>