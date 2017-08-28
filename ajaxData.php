<?php
	require_once 'connect.php';
	if(isset($_GET['orgid']) && !empty($_GET['orgid'])){
		$orgid=$_GET['orgid'];
		$q2="SELECT * FROM department WHERE organization_id = '".$orgid."' ORDER BY(dept_name)";
		$r2=mysqli_query($con,$q2);
		if(mysqli_num_rows($r2)>0){	
			echo 'Select Department';			
			while($row=mysqli_fetch_assoc($r2)){
				echo '<p><input value="'.$row['dept_id'].'" name="dept" type="radio" id="dept'.$row['dept_id'].'" required/>
      				<label for="dept'.$row['dept_id'].'">'.$row['dept_name'].'</label></p>';
			}
			echo 'Are you HOD of Department?';
			echo '<p><input value="yes" name="choice" type="radio" id="choice1" required>
			<label for="choice1">Yes</label> <input value="no" name="choice" type="radio" id="choice2" required>
			<label for="choice2">No</label> </p>';
        }
	}
?>