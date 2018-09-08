<?php

if($arrayNewsFeed){
	foreach($arrayNewsFeed as $userNews){
		echo "<br><br><br><b>".$userNews['name']."</b>";
		echo "<br><br>".$userNews['content'];
		echo "<h6>".$userNews['date']."</h6>";
	}
}

else{
	echo "<br>Nenhuma publicação ainda!<br>";
}

?>