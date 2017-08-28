<?php
require_once 'connect.php';
if(isset($_POST['next'])){
	if(!empty($_POST['regkey'])){
		$regkey=htmlentities($_POST['regkey']);
		$flag=0;
		$q1="SELECT * FROM organization";
		$r1=mysqli_query($con,$q1);
		while($row=mysqli_fetch_assoc($r1)){
			if($regkey==$row['registration_key'] && $row['registrar_id']==NULL){
				$flag=1;
				break;
			}
		}
		if($flag==1){
    		session_start();
    		$_SESSION['regkey']=$regkey;			     
    		header('location:register2.php');
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
			alert('Input Key');
			window.location='register2.php';
		</script>
		<?php
	}
}
else{
	?>
	<script type='text/javascript'> 
		alert('Input Key');
		window.location='register2.php';
	</script>
	<?php
}
?>