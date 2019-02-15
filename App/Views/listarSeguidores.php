<?php 
	use App\Init 
?>

<div>
	<h3>Animais que seguem <?php echo $dadosAnimal['nome']?></h3>
	<?php
	if(!$seguidores)
		echo "<br>Esta conta não possui seguidores<br><br>";
	else{
	?>
		<br>
		
			<?php
			foreach($seguidores as $seguidor){?>
				<div class="divUserListing">
					<!--<div class="postAread">-->
					<div class="divUserListPhoto">
						<img src="<?php echo $seguidor['fotoSeguidor']?>" /> 
					</div>
					<div class="divUserListName">
						<a href="<?php echo Init::$urlRoot.'/'.$seguidor['nickAnimal']?>" class="generalStyle">
							<?php echo $seguidor['nomeSeguidor']?>
						</a>
					</div>
					<div class="divUserDesc">
						<a href="<?php echo Init::$urlRoot.'/'.$seguidor['nickAnimal']?>"class="infoSecond">
							<?php echo $seguidor['descricaoSeguidor'] ?>
						</a>
					</div>
				</div>
				
					
			<!--</div>-->
			<?php } ?>
			
		

	<?php } ?>
</div>