
<?php

	session_start();
	unset ($SESSION['name']);
	session_destroy();
	header('Location: http://localhost:8080/etl/login.php');

?>
