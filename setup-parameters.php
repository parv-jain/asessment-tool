<?php
require 'session.php';
require 'connect.php';
if(registrar_session()){
	if(isset($_POST['setup'])){
		if(!empty($_GET['orgid'])){
			$orgid=mysqli_real_escape_string($con,htmlentities($_GET['orgid']));
		  $q1="SELECT * FROM parameters";
			$r1=mysqli_query($con,$q1);
			while($row1=mysqli_fetch_assoc($r1)){
				if(isset($_POST[$row1['parameter_id']])){
					$q2="INSERT INTO organization_parameters(category_id,parameter_id,organization_id) VALUES ('".$row1['category_id']."','".$row1['parameter_id']."','".$orgid."')";
					mysqli_query($con,$q2);
				}
			}
				    ?>
	    	    <script type="text/javascript">
	    	    alert('Parameters Setup Success');
	    	    window.location='panel.php';
	    	    </script>
	    	    <?php
			  }
        else{
		    ?>
	    	<script type="text/javascript">
	    	    	alert('Fill at least one field');
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