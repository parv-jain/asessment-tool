<?php
require 'session.php';
require 'connect.php';
if(registrar_session()){
	if(isset($_POST['setup'])){
		if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_GET['orgid'])){
			$orgid=mysqli_real_escape_string($con,htmlentities($_GET['orgid']));
			$username=mysqli_real_escape_string($con,htmlentities($_POST['username']));
			$password=mysqli_real_escape_string($con,htmlentities($_POST['password']));
			$user_type='student';
			$user_id=$orgid;
			$q1="INSERT INTO users (username,password,user_type,user_id) VALUES ('".$username."','".$password."','".$user_type."','".$user_id."')";
			if(mysqli_query($con,$q1)){
				?>
	    	    <script type="text/javascript">
	    	    alert('Student Login Setup Success');
	    	    window.location='panel.php';
	    	    </script>
	    	    <?php
			}
			else{
    	    	    ?>
    	    	    <script type="text/javascript">
    	    	    alert('Error');
    	    	    window.location='panel.php';
    	    	    </script>
    	    	    <?php
    	    }
		}
        else{
		    ?>
	    	<script type="text/javascript">
	    	    	alert('Fill all the fields');
	    	    	window.location='panel.php';
	    	</script>
	    	<?php
		}
	}
	else{
        ?>
        <script type="text/javascript">
                alert('Form Not Submitted');
                window.location='panel.php';
        </script>
        <?php
    }	
}
else{
	 ?>
	<script type="text/javascript">
	    	alert('You don\'t have registrar privillages');
	    	window.location='panel.php';
	</script><?php
}
?>