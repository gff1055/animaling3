<?php 
use App\Init;
?>
<?php echo $dadosAnimal['nome']?>

<form action="<?php echo Init::$urlRoot?>/updatedata" method="post">

	<label for="name" class="formField">Nome para exibição:</label>
	<input type="text" id="name" name="name" value = "<?php echo $dadosAnimal['nome']?>"/>
	<br><br>
	<label for="email" class="formField">Email:</label>
	<input type="text"  id="email" name="email" value = "<?php echo $dadosAnimal['email']?>"/>
	<br><br>
	<label for="nick" class="formField">Usuario:</label>
	<input type="text" id="nick" name="nick" value = "<?php echo $dadosAnimal['nick']?>"/>
	<br><br>
	<label for="password" class="formField">Senha:</label>
	<input type="password" id="password" name="password" value = "<?php echo $dadosAnimal['senha']?>"/>
	<br><br>
	<label for="dateBirth" class="formField">Data de nascimento:</label>
	<input type="date" id="birthDate" name="birthDate" value = "<?php echo $dadosAnimal['nascimento']?>"/>
	<br><br>
	<label for="genre" class="formField">Sexo:</label>
	<select name="genre" id="genre">
		<option value="m">Masculino</option>
		<option value="f">Feminino</option>
	</select>
	<br><br>
	
	<input type="submit" value="Atualizar Dados" class="styleButton"/>
</form>