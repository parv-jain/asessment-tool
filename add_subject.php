<?php
require_once 'session.php';
require_once 'connect.php';
teacher_session();
if(teacher_session()){
    if(isset($_POST['save'])){
    	    if(!empty($_POST['sub_name']) && !empty($_POST['class_name']) && !empty($_GET['orgid']) && !empty($_GET['teacherid'])){
    	    	    $sub_name=mysqli_real_escape_string($con,htmlentities($_POST['sub_name']));
                    $class_name=mysqli_real_escape_string($con,htmlentities($_POST['class_name']));
                    $orgid=mysqli_real_escape_string($con,htmlentities($_GET['orgid']));
                    $teacherid=mysqli_real_escape_string($con,htmlentities($_GET['teacherid']));
    	    	    $q1="INSERT INTO subject (subject_name,class_name,organization_id,teacher_id) VALUES ('".$sub_name."','".$class_name."','".$orgid."','".$teacherid."')";
    	    	    if(mysqli_query($con,$q1)){
    	    	    	    ?>
    	    	    	    <script type="text/javascript">
    	    	    	    alert('Subject and Class Details added');
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
        	    	    	alert('Fields cannot be empty');
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
	    	alert('You don\'t have teacher privillages');
	    	window.location='panel.php';
	</script><?php
}
?>