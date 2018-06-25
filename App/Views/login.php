<?php 
use App\Init;
?> 
<h1>nome</h1>
<form action="<?php echo Init::$urlRoot?>/logon" method="post">
login:<input type="text" name="formLogin"/>
<br>
senha:<input type="password" name="formSenha"/>
<br>
<input type="submit" value="Entrar">
</form>