<div>
<?php
if (!$seguidores)
	echo "<br>Esta conta não possui seguidores<br><br>";
else{
	?>
	
		<br>
		<h3>Animais que seguem <?php echo $dadosAnimal['nome']?></h3>
		<br>
		<?php
		foreach($seguidores as $seguidor){?>
			<a href="../<?php echo $seguidor['nickAnimal']?>"><?php echo "<b>".$seguidor['nomeSeguidor']."</b><br>";?></a>
			<?php
			echo $seguidor['descricaoSeguidor']."<br>";
			echo "<br>";
		}
}

?>
</div>