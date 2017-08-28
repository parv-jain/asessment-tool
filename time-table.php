<?php
require 'session.php';
require 'connect.php';
require 'nav.php';
echo '<div class="container"><div class="row">welcome '.$_SESSION['id'].' '.$_SESSION['user_type'];
echo '<div class="right"> <a href="logout.php">Logout</a></div></div></div>';
if(teacher_session()){
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
  ?>
  </div>
  <div class="col m3">
  <img src="images/user.png" class="responsive-img" width="70%" height="70%">
  </div>
  </div>
  </div>
  <div class="container">
  <div class="row">
  <div class="col m12">
  <h5 class="indigo-text">Select class for report</h5>
  <?php
  $q6="SELECT DISTINCT(class_name) FROM subject WHERE teacher_id='".$row2['teacher_id']."'";
  $r6=mysqli_query($con,$q6);
  ?>
  <form action="report.php" >
    <input type="text" hidden name="id" value="<?php echo $id; ?>">
    <div class="input-field col s12">
   <select name="class_name">
     <option value="" disabled selected>Choose your option</option>
     <?php
     while($row6=mysqli_fetch_assoc($r6)){
       echo '<option value="'.$row6['class_name'].'">'.$row6['class_name'].'</option>';
     }
     ?>
   </select>
   <label>Select Class</label>
  </div>
  <button class="waves-effect waves-green btn-flat" name="report">View Report</button>
 </form>
 </div>
 </div>
 </div>
 <?php
}
else if(registrar_session()){
  ?>
  <div class="container">
  <div class="row">
  <div class="col m9">
  <?php
  $id=$_SESSION['id'];
//  if(isset($_GET['id']))
  $tid=$_GET['id'];
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
  $qa="SELECT * FROM users WHERE user_id='".$tid."' AND user_type='teacher'";
  $ra=mysqli_query($con,$qa);
  $rowa=mysqli_fetch_assoc($ra);
	?>
  </div>
  <div class="col m3">
  <img src="images/user.png" class="responsive-img" width="70%" height="70%">
  </div>
  </div>
  </div>
  <div class="container">
  <div class="row">
  <div class="col m12">
  <h5 class="indigo-text">Select class for report</h5>
  <?php
  $q4="SELECT * FROM subject WHERE teacher_id='".$tid."'";
  $r4=mysqli_query($con,$q4);

  ?>
  <form action="report.php" >
  <div class="input-field col s12">
    <input type="text" hidden name="id" value="<?php echo $rowa['id']; ?>">

   <select name="class_name">
     <option value="" disabled selected>Choose your option</option>
     <?php
     while($row4=mysqli_fetch_assoc($r4)){
       echo '<option value="'.$row4['class_name'].'">'.$row4['class_name'].'</option>';
     }
     ?>
   </select>
   <label>Select Class</label>
  </div>
  <button class="waves-effect waves-green btn-flat" name="report">View Report</button>
 </form>
 </div>
 </div>
 </div>
  <?php
}

else{
  ?>
	<script type="text/javascript">
		alert('No don\'t have teacher privillages, Try login again as teacher');
		window.location="login.php";
	</script>
	<?php
}
require 'footer.php';
?>
<script type="text/javascript">
  $(document).ready(function() {
    $('select').material_select();
  });
</script>
