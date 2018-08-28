<?php

foreach($arrayNewsFeed as $userNews){
	echo "<br><br><br><b>".$userNews['name']."</b>";
	echo "<br><br>".$userNews['content'];
	echo "<h6>".$userNews['date']."</h6>";
}

?>