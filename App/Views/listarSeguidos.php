<?php

if (!$seguidos)
	echo "Esta conta nao possui seguidores";
else{
	?>
	<h3>Animais que seguem <?php echo $dadosAnimal['nome']?></h3>
	<?php
	foreach($seguidos as $seguindo){?>
		<a href="../<?php echo $seguindo['nickAnimal']?>"><?php echo "<b>".$seguindo['nomeSeguido']."</b><br>";?></a>
		<?php echo $seguindo['descricaoSeguido']."<br>";
		echo "<br>";
	}
}

?>