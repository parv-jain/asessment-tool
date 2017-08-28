<?php
	require_once('connect.php');
	if(isset($_POST['login'])){
		if(!empty($_POST['username']) &&!empty($_POST['password']) &&!empty($_POST['user_type'])){
			$username=mysqli_real_escape_string($con,htmlentities($_POST['username']));
			$password=mysqli_real_escape_string($con,htmlentities($_POST['password']));
			$user_type=mysqli_real_escape_string($con,htmlentities($_POST['user_type']));
			$query="SELECT * FROM users WHERE username='".$username."' AND password='".$password."' AND user_type='".$user_type."'";
			$result=mysqli_query($con,$query);
			if(mysqli_num_rows($result)==1){
				$row=mysqli_fetch_assoc($result);
				session_start();
				$_SESSION['id']=$row['id'];
				$_SESSION['user_type']=$row['user_type'];
				header('location:panel.php');
			}
			else{   ?>
			        <script language='javascript'> 
				alert('No Email Password match found');
				window.location="login.php";
				</script><?php
			}
		}
		else{   ?>
	            <script language='javascript'> 
			alert('Fields left empty');
			window.location="login.php";
			</script><?php
		}
	}
	else{   ?>
	        <script language='javascript'> 
		alert('Form Not Submitted');
		window.location="login.php";
		</script><?php
	}	    
?>