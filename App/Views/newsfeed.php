<?php

foreach($arrayNewsFeed as $userNews){
	echo $userNews['name'];
	echo "<br>".$userNews['date'];
	echo "<br><br>".$userNews['content'];
	echo "<br><br><br>";
}

?>