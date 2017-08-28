<?php
require 'connect.php';
require 'fn.php';
if(isset($_POST['signup'])){
	if(!empty($_POST['name']) && !empty($_POST['org']) && !empty($_POST['email']) && !empty($_POST['mobno'])){
		$name=mysqli_real_escape_string($con,htmlentities($_POST['name']));
		 $orgid=mysqli_real_escape_string($con,htmlentities($_POST['org']));
		 $deptid=mysqli_real_escape_string($con,htmlentities($_POST['dept']));

$choice=mysqli_real_escape_string($con,htmlentities($_POST['choice']));
		 $email=mysqli_real_escape_string($con,htmlentities($_POST['email']));
		 $mobno=mysqli_real_escape_string($con,htmlentities($_POST['mobno']));
		 $q1="INSERT INTO teacher (name,email,mobile_no,dept_id,organization_id) VALUES('".$name."','".$email."','".$mobno."','".$deptid."','".$orgid."')";
	if(mysqli_query($con,$q1)){
		 	    $q2="SELECT teacher_id FROM teacher WHERE name='".$name."' AND mobile_no='".$mobno."' AND email='".$email."'";
		 	    $r2=mysqli_query($con,$q2);
		 	    $row=mysqli_fetch_assoc($r2);

if($choice=='yes'){
    $q3="UPDATE department SET hod_id='".$row['teacher_id']."' WHERE dept_id='".$deptid."'";
    mysqli_query($con,$q3);
    }
		 	$password=password_generator($name,$mobno);
						$username=$email;
						$user_type='teacher';				
						$q4="INSERT INTO users (username,password,user_type,user_id) VALUES ('".$username."','".$password."','".$user_type."','".$row['teacher_id']."')";
						$to=$email;
						$headers='From : no-reply@assessment.co';
						$subject='Login Details';
						$body='Username : '.$username." \r\nPassword : ".$password;
						mail($to,$subject,$body,$headers);
						if(mysqli_query($con,$q4)){
							?><script type="text/javascript">
							alert('Registration Success, Username and password sent to your email id, Please login to validate your account'); window.location='login.php';
							</script><?php
		     }
		     else{
		     	 ?><script type="text/javascript">
							alert('Error 0'); window.location='index.php';
							</script><?php
		     }
		 }
		 else{
		 	 ?><script type="text/javascript">
							alert('Error 1'); window.location='index.php';
							</script><?php
		 }
	}
	else{
		 ?><script type="text/javascript">
							alert('Fill all the fields'); window.location='teacher-signup.php';
							</script><?php
	}
}
else{
	 ?><script type="text/javascript">
							alert('Fill all the fields'); window.location='teacher-signup.php';
							</script><?php
}


?>