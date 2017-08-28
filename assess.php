<?php
require 'session.php';
require 'connect.php';
require 'nav.php';
echo '<div class="container"><div class="row">welcome '.$_SESSION['id'].' '.$_SESSION['user_type'];
echo '<div class="right"> <a href="logout.php">Logout</a></div></div></div>';
if(student_session()){

		if(!empty($_GET['class_name']) && !empty($_GET['orgid'])){
		?>
		<div class="container">
		<div class="row">
		<div class="col s9">
			<?php
			$id=$_SESSION['id'];
			$q1="SELECT * FROM users WHERE id = '".$id."'";
			$r1=mysqli_query($con,$q1);
			$row1=mysqli_fetch_assoc($r1);
      if($row1['user_id'] != $_GET['orgid']){
      ?>
      <script type="text/javascript">
      alert('You don\'t have privillages for this organization');
      window.location="panel.php";
      </script>
      <?php
      }
			$q2="SELECT * FROM organization WHERE organization_id = '".$row1['user_id']."'";
			$r2=mysqli_query($con,$q2);
			$row2=mysqli_fetch_assoc($r2);
			echo '<br>Organization Name : '.$row2['name'];
      echo '<br>Class : '.$_GET['class_name'];


			?>
			<a href="#modal2">Click here to read instructions.</a>
		</div>
		<div class="col m3">
			<img src="images/user.png" class="responsive-img" width="70%" height="70%">

		</div>
		</div>
		</div>

		<?php
                    $class_name=mysqli_real_escape_string($con,htmlentities($_GET['class_name']));
                    $orgid=mysqli_real_escape_string($con,htmlentities($_GET['orgid']));
    	    	        $q1="SELECT * FROM subject WHERE class_name='".$class_name."' AND organization_id='".$orgid."'";
                    $r1=mysqli_query($con,$q1);
		?>
		<div class="container">
			<div class="row">
				<table class="striped">
					<h5 class="indigo-text">Teacher and Subject Details</h5>
					<thead>
					  <tr>
					      <th>Subject</th>
					      <th>Teacher</th>
					      <th>Class</th>
                <th>Assess</th>
					  </tr>
					</thead>

					<tbody>
					<?php
	    	    while($row1=mysqli_fetch_assoc($r1)){
	    	    $q2="SELECT * FROM teacher WHERE teacher_id='".$row1['teacher_id']."'";
            $r2=mysqli_query($con,$q2);
            $row2=mysqli_fetch_assoc($r2);
					?>
					  <tr>
					    <td><?php echo $row1['subject_name']; ?></td>
					    <td><?php echo $row2['name']; ?></td>
					    <td><?php echo $row1['class_name']; ?></td>
              <td><a href="#modal1"><i class="tiny material-icons">launch</i></a></td>
					  </tr>
				  	<?php
				  	    }
				  	?>
					</tbody>
				</table>
			</div>
		</div>


<div id="modal1" class="modal">
    <div class="modal-content">
    <?php
    $q3="SELECT * FROM organization_parameters WHERE organization_id='".$orgid."'";
    $r3=mysqli_query($con,$q3);
		?>
		<div class="container-fluid">
		<div class="row">
		<form action="insert_rating.php" method="post">
			<table class="striped">
					<h5 class="indigo-text">Feedback</h5>
					<div class="row">
		        <div class="input-field col s4">
		          <input value="<?php echo $_GET['orgid']; ?>" id="orgid" name="orgid" type="text" class="validate" readonly>
		          <label for="orgid">Organization Id</label>
		        </div>
            <div class="input-field col s4">
		          <input value="<?php echo $_GET['class_name']; ?>" id="class_name" name="class_name" type="text" class="validate" readonly>
		          <label for="class_name">Class Name</label>
		        </div>
		        <div class="input-field col s4">
		          <input value="<?php echo $row2['teacher_id']; ?>" id="teacher" name="teacher" type="text" class="validate" readonly>
		          <label for="teacher">Teacher Id</label>
		        </div>
					</div>

							<thead>
								<tr>
										<th>Category</th>
										<th>Parameter</th>
										<th>Input Rating</th>
								</tr>
							</thead>

							<tbody>
			<?php
			while($row3=mysqli_fetch_assoc($r3))
			{
								$q4="SELECT * FROM category WHERE category_id='".$row3['category_id']."'";
								$r4=mysqli_query($con,$q4);
								$row4=mysqli_fetch_assoc($r4);
								$q5="SELECT * FROM parameters WHERE parameter_id='".$row3['parameter_id']."'";
								$r5=mysqli_query($con,$q5);
								$row5=mysqli_fetch_assoc($r5);
			?>
								<tr>
									<td><?php echo $row4['category_name']; ?></td>
									<td><?php echo $row5['parameter_name']?></td>
									<td width="40%"><p>
										<input value="1" name="<?php echo $row5['parameter_id']; ?>" type="radio" id="<?php echo $row5['parameter_id'].'1'; ?>" required/>
										<label for="<?php echo $row5['parameter_id'].'1'; ?>">1</label>
										<input value="2" name="<?php echo $row5['parameter_id']; ?>" type="radio" id="<?php echo $row5['parameter_id'].'2'; ?>" required/>
										<label for="<?php echo $row5['parameter_id'].'2'; ?>">2</label>
										<input value="3" name="<?php echo $row5['parameter_id']; ?>" type="radio" id="<?php echo $row5['parameter_id'].'3'; ?>" required/>
										<label for="<?php echo $row5['parameter_id'].'3'; ?>">3</label>
										<input value="4" name="<?php echo $row5['parameter_id']; ?>" type="radio" id="<?php echo $row5['parameter_id'].'4'; ?>" required/>
										<label for="<?php echo $row5['parameter_id'].'4'; ?>">4</label>
										<input value="5" name="<?php echo $row5['parameter_id']; ?>" type="radio" id="<?php echo $row5['parameter_id'].'5'; ?>" required/>
										<label for="<?php echo $row5['parameter_id'].'5'; ?>">5</label>
									</p></td>
								</tr>
			<?php
			}
			?>
							</tbody>
			</table>
      <button class="waves-effect waves-green btn-flat right" name="submit" onclick="disable(<?php echo $row2['name']; ?>)">Submit</button>
		  </form>
	  </div>
	  </div>
	  </div>
    <div class="modal-footer">
      Thanks for your feedback.
    </div>
  </div>

	<div id="modal2" class="modal">
	    <div class="modal-content">
				<ul>
					<li>You can give grade to teacher only once.</li>
					<li>Press assess button in front of each teacher to give feedback to them.</li>
					<li>Your feedback should not be biased, based on any emotional attachment and physical appearance.</li>
			</div>

		  <div class="modal-footer">
		    Read instructions carefully.
		  </div>
	</div>

	<?php
        }
				else{
					?>
					<script type="text/javascript">
					alert('Fill all the fields');
					window.location="panel.php";
					</script>
					<?php
				}
}
else{
	?>
	<script type="text/javascript">
	alert('You don\'t have privillages for student');
	window.location="panel.php";
	</script>
	<?php
}
unset($_SESSION['otp']);
require 'footer.php';
?>
<script type="text/javascript">
$(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
 });
</script>
