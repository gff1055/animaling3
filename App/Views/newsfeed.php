<div>

<?php
use App\Init;

if($arrayNewsFeed){
	foreach($arrayNewsFeed as $userNews){?>
		<div class="postArea">
			<div class="divUserPhotoPost">
				<img src="<?php echo $userNews['foto']?>" /> 
			</div>

			<div class="divUserNameDatePost">
				<a href="<?php echo Init::$urlRoot.'/'.$userNews['nick']?>" class="generalStyle">
					<?php echo $userNews['name']?>
				</a>
				<br>
				<a href="<?php echo Init::$urlRoot.'/'.$dadosAnimal['nick'].'/'.$post['codigoPost']?>" class="infoSecond">
				<?php echo  date('d/m/Y H:i:s', strtotime($userNews['date']))?></a>

				<?php /*echo "<a href=".Init::$urlRoot."/".$userNews['nick']."><b>".$userNews['name']."</b></a>";*/?>
			</div>

			<div class="divContentPost">
				<?php echo $userNews['content']?>
				
				
			</div>

		</div>
		<?php
		/*
		echo "<br><br>".$userNews['content'];
		echo "<h6>".$userNews['date']."</h6>";*/
	}
}

else{
	echo "<br>Nenhuma publicação ainda!<br>";
}

?>

</div>