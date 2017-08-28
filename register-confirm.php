<?php
require_once 'connect.php';
require_once 'fn.php';
if(isset($_POST['register'])){
	if(!empty($_POST['regkey']) && !empty($_POST['name']) &&!empty($_POST['designation']) && !empty($_POST['email']) && !empty($_POST['mobno']) && !empty($_POST['orgname'])){
		$regkey=mysqli_real_escape_string($con,htmlentities($_POST['regkey']));
		$name=mysqli_real_escape_string($con,htmlentities($_POST['name']));
		$designation=mysqli_real_escape_string($con,htmlentities($_POST['designation']));
		$email=mysqli_real_escape_string($con,htmlentities($_POST['email']));
		$mobno=mysqli_real_escape_string($con,htmlentities($_POST['mobno']));
		$orgname=mysqli_real_escape_string($con,htmlentities($_POST['orgname']));
		$q0="SELECT * FROM organization";
		$r0=mysqli_query($con,$q0);
		$flag=0;
		while($row=mysqli_fetch_assoc($r0)){
			if($regkey==$row['registration_key'] && $row['registrar_id']==NULL){
				$flag=1;
				break;
			}
		}
		if($flag==1){
	    	$q1="UPDATE organization SET name='".$orgname."' WHERE registration_key='".$regkey."'";
			if(mysqli_query($con,$q1)){
				$q2="SELECT * FROM organization WHERE registration_key='".$regkey."'";
				$r2=mysqli_query($con,$q2);
				$row=mysqli_fetch_assoc($r2);
				$q3="INSERT INTO registrar (name,designation,email,mobile_no,organization_id) VALUES ('".$name."','".$designation."','".$email."','".$mobno."','".$row['organization_id']."')";
				if(mysqli_query($con,$q3)){
					$q4="SELECT * FROM registrar WHERE organization_id='".$row['organization_id']."'";
					$r4=mysqli_query($con,$q4);
					$row_next=mysqli_fetch_assoc($r4);
					$q5="UPDATE organization SET registrar_id='".$row_next['registrar_id']."' WHERE registration_key='".$regkey."'";
					if(mysqli_query($con,$q5)){
						$password=password_generator($name,$mobno);
						$username=$email;
						$user_type='registrar';				
						$q6="INSERT INTO users (username,password,user_type,user_id) VALUES ('".$username."','".$password."','".$user_type."','".$row_next['registrar_id']."')";
						$to=$email;
						$headers='From : no-reply@assessment.co';
						$subject='Login Details';
						$body='Username : '.$username." \r\nPassword : ".$password;
						mail($to,$subject,$body,$headers);
						if(mysqli_query($con,$q6)){
							?><script type="text/javascript">
							alert('Registration Success, Username and password sent to your email id, Please login to validate your account'); window.location='login.php';
							</script><?php
						}
						else{
							echo 'Error 0';
						}
					}
					else{
						echo 'Error 1';
					}
				}
				else{
					echo 'Error 2';
				}
			}
			else{
				echo 'Error 3';
			}
		}
		else{
			?>
			<script type='text/javascript'> 
				alert('Invalid Key');
				window.location='register.php';
			</script>
			<?php
		}
	}
	else{
		?>
		<script type='text/javascript'> 
			alert('Fields Left Empty');
			window.location='register2.php';
		</script>
		<?php
	}
}
else{
	?>
	<script type='text/javascript'> 
		alert('Key not pressed');
		window.location='register2.php';
	</script>
	<?php
}