<?php
use App\Init;
?>
<div>
<h3>Editar publicação</h3>
<br>

<form class="formToPost" action="<?php echo Init::$urlRoot.'/'.$_SESSION['login'].'/'.$post['codePost'].'/updatepost'?>" method="post">
	<input type="hidden" value="<?php echo $post['codePost']?>" name="formCodePost">
	<textarea rows='5' name="formContentPost"><?php echo $post['conteudoPost'];?></textarea>
	<br>
	<input type="submit" class="styleButton" value ="Atualizar descrição"/>
</form>
</div>
