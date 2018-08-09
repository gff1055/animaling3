<?php

if (!$seguidos)
	echo "<br>Ninguem segue esta conta";
else{
	?>
	<h3>Animais que <?php echo $dadosAnimal['nome']?> segue</h3>
	<?php
	foreach($seguidos as $seguindo){?>
		<a href="../<?php echo $seguindo['nickAnimal']?>"><?php echo "<b>".$seguindo['nomeSeguido']."</b><br>";?></a>
		<?php echo $seguindo['descricaoSeguido']."<br>";
		echo "<br>";
	}
}

?>