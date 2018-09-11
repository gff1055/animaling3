<?php 
use App\Init;
?> 
<h1>Abra uma conta</h1>
<form action="<?php echo Init::$urlRoot?>/logon" method="post">

<label for="name">Nome:</label>
<input type="text" id="name" name="name" value="hello" class="valueInput"/><br><br>
<label for="email">Email:</label>
<input type="text"  id="email" name="email" class="valueInput"/><br><br>
<label for="password">Senha:</label>
<input type="password" id="password" name="password" class="valueInput"/><br><br>
<label for="checkPassword">Conf. Senha:</label>
<input type="password" id="checkPassword" name="checkPassword" class="valueInput"/><br><br>
<label for="dateBirth">Data de nascimento:</label>
<input type="text" id="dateBirth" name="dateBirth" class="valueInput"/><br><br>

<fieldset>
	<legend>Sexo</legend>
	
	<input type="radio" name="genre" id="male" />
	<label for="genre">Masculino</label><br>
	
	<input type="radio" name="genre" id="female" />
	<label for="genre">Feminino</label><br>
</fieldset>

<br>

<input type="submit" />


</form>