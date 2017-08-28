<?php
@session_start();
if(!isset($_SESSION['id']) || !isset($_SESSION['user_type'])){
?><script type='text/javascript'>alert('Access Denied. Please Login First');window.location='login.php';</script>
<?php
}
function admin_session(){
	if($_SESSION['user_type'] != 'admin'){
		return false;
	}
	else{
		return true;
	}
}
function registrar_session(){
	if($_SESSION['user_type'] != 'registrar'){
		return false;
	}
	else{
		return true;
	}
}
function teacher_session(){
	if($_SESSION['user_type'] != 'teacher'){
		return false;
	}
	else{
		return true;
	}
}
function student_session(){
	if($_SESSION['user_type'] != 'student'){
		return false;
	}
	else{
		return true;
	}
}

?>