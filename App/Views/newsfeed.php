<div>

<?php
use App\Init;

if($arrayNewsFeed){
	foreach($arrayNewsFeed as $userNews){
		echo "<br><br><br><a href=".Init::$urlRoot."/".$userNews['nick']."><b>".$userNews['name']."</b></a>";
		echo "<br><br>".$userNews['content'];
		echo "<h6>".$userNews['date']."</h6>";
	}
}

else{
	echo "<br>Nenhuma publicação ainda!<br>";
}

?>

</div>