<?php

ob_start();
echo 'This is a secure data, which only logged in users can see.';
ob_get_clean();
ob_flush();
$t = ob_get_contents();
ob_end_clean();
/*
if(is_logged_in()) {
	echo $t;
} else {
	header("Location:login.php");
}
*/
echo '456';
echo '<br />';
echo $t;

