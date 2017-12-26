<?php
	$con = new mysqli('localhost','root','parv1608','assessment');
	if ($con->connect_errno) {
		echo "Error - Failed to connect to MySQL: " . $con->connect_error;
		die();
	}
?>
