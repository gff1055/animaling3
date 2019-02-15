<?php
	use App\Init
?>

<div>
	<?php
	if (!$seguidos)
		echo "<br>Ninguem segue esta conta<br><br>";
	else{?>
		<br>
		<h3>Animais que <?php echo $dadosAnimal['nome']?> segue</h3>
		<div class="divUserListing">
			<?php
			foreach($seguidos as $seguido){?>
				<div class="divUserListPhoto">
					<img src="<?php echo $seguido['fotoSeguido'] ?>" />
				</div>
				<div class="divUserListName">
					<a href="<?php echo Init::$urlRoot.'/'.$seguido['nickAnimal']?>" class="generalStyle">
						<?php echo $seguido['nomeSeguido'] ?>
					</a>
				</div>
				<div class="divUserListDesc">
					<a href="<?php echo Init::$urlRoot.'/'.$seguido['nickAnimal']?>" class="infoSecond">
						<?php echo $seguido['descricaoSeguido'] ?>
					</a>
				</div>
			<?php }?>
		</div>
	<?php }?>
</div>