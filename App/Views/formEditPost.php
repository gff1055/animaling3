<?php
use App\Init;
?>

<h3>Editar publicação</h3>

<form action="<?php echo Init::$urlRoot.'/'.$_SESSION['login'].'/updatepost'?>" method="post">
	<textarea rows='5' cols='30'>
		<?php
		$arrayData['conteudo'];
		?>
	</textarea>
	<br>
	<input type="submit" value ="Atualizar publicação"/>
</form>
