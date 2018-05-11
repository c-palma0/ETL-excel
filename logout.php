
<?php

	session_start();
	unset ($SESSION['name']);
	unset ($SESSION['email']);
	unset ($SESSION['puesto']);
	unset ($SESSION['id']);
	session_destroy();
	header('Location: http://localhost:8080/etl/login.php');

?>
