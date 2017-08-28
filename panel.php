<?php
require 'session.php';
require 'nav.php';
echo '<div class="container"><div class="row">welcome '.$_SESSION['id'].' '.$_SESSION['user_type'];
echo '<div class="right"> <a href="logout.php">Logout</a></div></div></div>';
if(admin_session()){
	?>
	<div class="container">
	<div class="row">
	<div class="col m9">
	</div>
	<div class="col m3">
	<img src="images/user.png" class="responsive-img" width="70%" height="70%">
	</div>
	</div>
	</div>
	<div class="container">
	<div class="row">

	<?php
	if(isset($_POST['generate'])){
		require_once 'connect.php';
		mysqli_query($con,'SET character_set_results=latin1');
	        mysqli_query($con,'SET names=latin1');
	        mysqli_query($con,'SET character_set_client=latin1');
                mysqli_query($con,'SET character_set_connection=latin1');
	        mysqli_query($con,'SET character_set_results=latin1');
	        mysqli_query($con,'SET collation_connection=latin1');

		$query="SELECT * FROM organization";
		$result=mysqli_query($con,$query);
		$flag=0;
		again:
		$key=uniqid();
		while($row=mysqli_fetch_assoc($result)){
			if($key==$row['registration_key'])
				$flag=1;
		}
		if($flag==1)
			goto again;
		else{
			$q="INSERT INTO organization (registration_key) VALUES ('".$key."')";
			if(mysqli_query($con,$q))
			{
				echo "\r\n".'Registration Key '.$key.' added ';
			}
			else{
				echo "\r\n".'error'.mysqli_error($con);
			}
		}
	}
	?>
	</div>
	</div>

	<div class="container"><div class="row">
	<br><hr><br>
	</div></div>

	<div class="container">
	 <div class="row">
	   <h5 class="indigo-text">Generate Key</h5>
	   <form class="col s12" action="panel.php" method="post">
	   <button class="waves-effect waves-green btn-flat" name="generate">Generate Key</button>
	   </form>
	 </div>
	</div>
	<?php
}
else if(registrar_session()){
	require_once('connect.php');
	?>
	<div class="container">
	<div class="row">
	<div class="col m9">
	<?php
	$id=$_SESSION['id'];
	$q1="SELECT * FROM users WHERE id = '".$id."'";
	$r1=mysqli_query($con,$q1);
	$row1=mysqli_fetch_assoc($r1);
	$q2="SELECT * FROM registrar WHERE registrar_id = '".$row1['user_id']."'";
	$r2=mysqli_query($con,$q2);
	$row2=mysqli_fetch_assoc($r2);
	echo '<br>Your Name : '.$row2['name'];
	echo '<br>Your Designation : '.$row2['designation'];
	echo '<br>Your Mobile no. : '.$row2['mobile_no'];
	echo '<br>Your Email : '.$row2['email'];
	$q3="SELECT * FROM organization WHERE organization_id='".$row2['organization_id']."'";
	$r3=mysqli_query($con,$q3);
	$row3=mysqli_fetch_assoc($r3);
	echo '<br>Organization Name : '.$row3['name'];
	echo '<br><br><a href="teachers.php">View Teachers Reports</a>';

	?>
	</div>
	<div class="col m3">
	<img src="images/user.png" class="responsive-img" width="70%" height="70%">
	</div>
	</div>
	</div>
	<div class="container">
	<div class="row">
	<table class="striped">
			<h5 class="indigo-text">Department Details</h5>
	        <thead>
	          <tr>
	              <th>Department</th>
	              <th>HOD</th>
	              <th>ORGANIZATION</th>
	          </tr>
	        </thead>

	        <tbody>
	<?php
	$q4="SELECT * FROM department WHERE organization_id='".$row3['organization_id']."'";
	$r4=mysqli_query($con,$q4);
	while($row4=mysqli_fetch_assoc($r4))
	{
	?>
	          <tr>
	            <td><?php echo $row4['dept_name']; ?></td>
	            <td><?php if($row4['hod_id']==0) echo 'Not Found';
	            	      else{
	            	      		$q5="SELECT * FROM teacher WHERE teacher_id='".$row4['hod_id']."'";
	            	      		$r5=mysqli_query($con,$q5);
	            	      		$row5=mysqli_fetch_assoc($r5);
	            	      		echo $row5['name'];
	            	      	} 	?></td>
	            <td><?php echo $row3['name']; ?></td>
	          </tr>
	<?php
	}
	?>
	        </tbody>
	</table>
	</div>
	</div>

	<div class="container"><div class="row">
	<br><hr><br>
	</div></div>

	<div class="container">
	<div class="row">
		<h5 class="indigo-text">Give Department Details about your organization.</h5>
	    <form action="add_dept.php?orgid=<?php echo $row3['organization_id']?>"; class="col s12" method="post">
	      <div class="row">
	        <div class="input-field col s12">
	          <input id="dept_name" type="text" class="validate" name="dept_name">
	          <label for="dept_name">Department Name</label>
	        </div>
	      </div>
	      <button class="waves-effect waves-green btn-flat" name="save">Save</button>
	    </form>
	  </div>
	</div>

	<div class="container"><div class="row">
	<br><hr><br>
	</div></div>

	<div class="container">
	<div class="row">
	<table class="striped">
			<h5 class="indigo-text">Parameters Details</h5>
					<thead>
						<tr>
								<th>Category</th>
								<th>Parameter</th>
						</tr>
					</thead>

					<tbody>
	<?php
	$pq3="SELECT * FROM organization_parameters WHERE organization_id='".$row3['organization_id']."'";
	$pr3=mysqli_query($con,$pq3);
	while($prow3=mysqli_fetch_assoc($pr3))
	{
						$pq4="SELECT * FROM category WHERE category_id='".$prow3['category_id']."'";
						$pr4=mysqli_query($con,$pq4);
						$prow4=mysqli_fetch_assoc($pr4);
						$pq5="SELECT * FROM parameters WHERE parameter_id='".$prow3['parameter_id']."'";
						$pr5=mysqli_query($con,$pq5);
						$prow5=mysqli_fetch_assoc($pr5);
	?>
						<tr>
							<td><?php echo $prow4['category_name']; ?></td>
							<td><?php echo $prow5['parameter_name']?></td>
						</tr>
	<?php
	}
	?>
					</tbody>
	</table>
	</div>
	</div>


	<div class="container"><div class="row">
	<br><hr><br>
	</div></div>

<div class="container">
	<div class="row">
		<h5 class="indigo-text">Set up parameters for evaluation of performance of teacher's of your organization.</h5>
			<form action="setup-parameters.php?orgid=<?php echo $row3['organization_id'];?>"; class="col s12" method="post">
				<div class="row">
				    	<?php
							$pq1="SELECT * FROM category";
							$pr1=mysqli_query($con,$pq1);
							echo '<ul class="collapsible" data-collapsible="accordion">';
							while($prow1=mysqli_fetch_assoc($pr1)){
								$pq2="SELECT * FROM parameters WHERE category_id='".$prow1['category_id']."'";
								$pr2=mysqli_query($con,$pq2);
								echo '<li>
									<div class="collapsible-header">'.$prow1['category_name'].' (click to expand)</div>
									<div class="collapsible-body"><span>';
								while($prow2=mysqli_fetch_assoc($pr2)){
									echo '<p><input type="checkbox" id="'.$prow2['parameter_id'].'" name="'.$prow2['parameter_id'].'"/><label for="'.$prow2['parameter_id'].'">'.$prow2['parameter_name'].'</label></p>';
								}
								echo '</span></div></li>';
							}
							echo '</ul>';
							?>
	      </div>
				<button class="waves-effect waves-green btn-flat" name="setup">Set Up</button>
			</form>
		</div>
	</div>


	<div class="container"><div class="row">
	<br><hr><br>
	</div></div>

	<?php
	$q6="SELECT * FROM users WHERE user_type='student' AND user_id='".$row3['organization_id']."'";
	$r6=mysqli_query($con,$q6);
	?>
	<div class="container">
	<div class="row">
	<table class="striped">
			<h5 class="indigo-text">Student Account Details for your organization</h5>
	        <thead>
	          <tr>
	              <th>Username</th>
	              <th>Password</th>
	          </tr>
	        </thead>

	        <tbody>
	<?php
	while($row6=mysqli_fetch_assoc($r6))
	{
	?>
	          <tr>
	            <td><?php echo $row6['username']; ?></td>
	            <td><?php echo $row6['password']; ?></td>
	          </tr>
	<?php
	}
	?>
	        </tbody>
	</table>
	</div>
	</div>

	<div class="container"><div class="row">
	<br><hr><br>
	</div></div>

	<div class="container">
	<div class="row">
		<h5 class="indigo-text">Set up student login for assessment of teachers of your organization.</h5>
	    <form action="setup-student.php?orgid=<?php echo $row3['organization_id'];?>"; class="col s12" method="post">
	      <div class="row">
	        <div class="input-field col s12">
	          <input id="username" type="text" class="validate" name="username">
	          <label for="username">Username</label>
	        </div>
	      </div>
	      <div class="row">
	        <div class="input-field col s12">
	          <input id="password" type="text" class="validate" name="password">
	          <label for="password">Password</label>
	        </div>
	      </div>
	      <button class="waves-effect waves-green btn-flat" name="setup">Set Up</button>
	    </form>
	  </div>
	</div>


<?php
}
else if(teacher_session()){
	require_once('connect.php');
	?>
	<div class="container">
	<div class="row">
	<div class="col m9">
	<?php
	$id=$_SESSION['id'];
	$q1="SELECT * FROM users WHERE id = '".$id."'";
	$r1=mysqli_query($con,$q1);
	$row1=mysqli_fetch_assoc($r1);
	$q2="SELECT * FROM teacher WHERE teacher_id = '".$row1['user_id']."'";
	$r2=mysqli_query($con,$q2);
	$row2=mysqli_fetch_assoc($r2);
	echo '<br>Your Name : '.$row2['name'];
	echo '<br>Your Mobile No. : '.$row2['mobile_no'];
	echo '<br>Your Email : '.$row2['email'];
	$q3="SELECT * FROM organization WHERE organization_id='".$row2['organization_id']."'";
	$r3=mysqli_query($con,$q3);
	$row3=mysqli_fetch_assoc($r3);
	echo '<br>Organization Name : '.$row3['name'];
	$q4="SELECT * FROM department WHERE dept_id='".$row2['dept_id']."'";
	$r4=mysqli_query($con,$q4);
	$row4=mysqli_fetch_assoc($r4);
	echo '<br>Department Name : '.$row4['dept_name'];
	$q5="SELECT * FROM subject WHERE teacher_id='".$row2['teacher_id']."'";
	$r5=mysqli_query($con,$q5);
	echo '<br><br><a href="time-table.php">View Your Report</a>';
	?>
	</div>
	<div class="col m3">
	<img src="images/user.png" class="responsive-img" width="70%" height="70%">
	</div>
	</div>
	</div>
	<div class="container">
	<div class="row">
	<table class="striped">
			<h5 class="indigo-text">Your Time Table</h5>
	        <thead>
	          <tr>
	              <th>CLASS</th>
	              <th>SUBJECT</th>
	          </tr>
	        </thead>

	        <tbody>
	<?php
	while($row5=mysqli_fetch_assoc($r5))
	{
	?>
	          <tr>
	            <td><?php echo $row5['class_name']; ?></td>
	            <td><?php echo $row5['subject_name']; ?></td>
	          </tr>
	<?php
	}
	?>
	        </tbody>
	</table>
	</div>
	</div>

	<div class="container"><div class="row">
	<br><hr><br>
	</div></div>

	<div class="container">
	<div class="row">
		<h5 class="indigo-text">Give details about your subject and classes.</h5>
	    <form action="add_subject.php?orgid=<?php echo $row3['organization_id'];?>&teacherid=<?php echo $row2['teacher_id'];?>" class="col s12" method="post">
	      <div class="row">
	        <div class="input-field col s12">
	          <input id="sub_name" type="text" class="validate" name="sub_name">
	          <label for="sub_name">Subject Name</label>
	        </div>
	      </div>
	      <div class="row">
	        <div class="input-field col s12">
	          <input id="class_name" type="text" class="validate" name="class_name">
	          <label for="class_name">Class Name</label>
	        </div>
	      </div>
	      <button class="waves-effect waves-green btn-flat" name="save">Save</button>
	    </form>
	  </div>
	</div>
<?php
}
else if(student_session()){
require_once('connect.php');
?>
<div class="container">
<div class="row">
<div class="col s9">
	<?php
	$id=$_SESSION['id'];
	$q1="SELECT * FROM users WHERE id = '".$id."'";
	$r1=mysqli_query($con,$q1);
	$row1=mysqli_fetch_assoc($r1);
	$q2="SELECT * FROM organization WHERE organization_id = '".$row1['user_id']."'";
	$r2=mysqli_query($con,$q2);
	$row2=mysqli_fetch_assoc($r2);
	echo '<br>Organization Name : '.$row2['name'];
	?>
</div>
<div class="col m3">
<img src="images/user.png" class="responsive-img" width="70%" height="70%">
</div>
</div>
</div>
	<?php
	$q3="SELECT DISTINCT(class_name) FROM subject WHERE organization_id = '".$row1['user_id']."'";
	$r3=mysqli_query($con,$q3);
	?>
<div class="container">
<div class="row">
<h5 class="indigo-text">Give following details.</h5>
<form action="assess.php" method="get">
      <div class="input-field col s12">
          <input id="orgid" type="text" class="validate" value="<?php echo $row2['organization_id'];?>" name="orgid" readonly>
              <label for="orgid">Organization Id</label>
      </div>
      <div class="input-field col s12">
      <select name="class_name">
      <option value="" disabled selected>Choose your class</option>
	<?php
	while($row3=mysqli_fetch_assoc($r3)){
	?>
        <option value="<?php echo $row3['class_name']; ?>"><?php echo $row3['class_name']; ?></option>
	<?php
	}
	?>
      </select>
      <label>Select Class</label>
      </div>
<div class="input-field col s12">
    <button class="waves-effect waves-green btn-flat" name="next">Next</button>
</div>
</form>
</div>
</div>
<?php
}
else{
	?>
	<script type="text/javascript">
		alert('No session exists, Try login again');
		window.location="login.php";
	</script>
	<?php
}
require 'footer.php';
?>
<script type="text/javascript">
  $(document).ready(function() {
    $('select').material_select();
		$('.collapsible').collapsible();
  });
</script>
