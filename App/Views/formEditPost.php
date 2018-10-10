<?php
use App\Init;
?>

<h3>Editar publicação</h3>
<br>
<form action="<?php echo Init::$urlRoot.'/'.$_SESSION['login'].'/'.$post['codePost'].'/updatepost'?>" method="post">
	<textarea rows='5' cols='30'><?php echo $post['conteudoPost'];?></textarea>
	<br>
	<input type="submit" value ="Atualizar publicação"/>
</form>
