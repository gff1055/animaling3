<?php

if (!$seguidores)
	echo "<br>Esta conta não possui seguidores";
else{
	?>
	<h3>Animais que <?php echo $dadosAnimal['nome']?> segue</h3>
	<?php
	foreach($seguidores as $seguidor){?>
		<a href="../<?php echo $seguidor['nickAnimal']?>"><?php echo "<b>".$seguidor['nomeSeguidor']."</b><br>";?></a>
		<?php
		echo $seguidor['descricaoSeguidor']."<br>";
		echo "<br>";
	}
}

?>