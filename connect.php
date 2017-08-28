<?php
	$con = new mysqli('localhost','id2685478_tool','P@ssword','id2685478_mydb');
	if ($con->connect_errno) {
		echo "Error - Failed to connect to MySQL: " . $con->connect_error;
		die();
	}
?>