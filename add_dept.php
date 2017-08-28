<?php
require_once 'session.php';
require_once 'connect.php';
registrar_session();
if(registrar_session()){
    if(isset($_POST['save'])){
    	    if(!empty($_POST['dept_name']) && !empty($_GET['orgid'])){
    	    	    $dept_name=mysqli_real_escape_string($con,htmlentities($_POST['dept_name']));
                    $orgid=mysqli_real_escape_string($con,htmlentities($_GET['orgid']));
    	    	    $q1="INSERT INTO department (dept_name,organization_id) VALUES ('".$dept_name."','".$orgid."')";
    	    	    if(mysqli_query($con,$q1)){
    	    	    	    ?>
    	    	    	    <script type="text/javascript">
    	    	    	    alert('Department added');
    	    	    	    window.location='panel.php';
    	    	    	    </script>
    	    	    	    <?php
    	    	    }
    	    	    else{
                  echo mysqli_error($con);
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
    	    	    	alert('Department name cannot be empty');
    	    	    	window.location='panel.php';
    	    	</script>
    	    	<?php
    	     }
    }
    else{
    	    ?>
    	    	<script type="text/javascript">
    	    	    	alert('Department name cannot be empty');
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
