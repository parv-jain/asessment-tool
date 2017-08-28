<?php
function password_generator($name,$mobno){
	$password=substr($name, 0, strpos($name, ' ')).substr($mobno,8);
	return $password;
}
?>