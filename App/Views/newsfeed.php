<?php

foreach($arrayNewsFeed as $userNews){
	echo "<b>".$userNews['name']."</b>";
	echo "<br><br>".$userNews['content'];
	echo "<h6>".$userNews['date']."</h6>";
	echo "<br><br><br>";
}

?>