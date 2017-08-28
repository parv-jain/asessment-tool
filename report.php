<?php
require 'nav.php';
//require 'session.php';
require 'connect.php';
echo '<div class="container"><div class="row">welcome '.$_GET['id'];
echo '<div class="right"> <a href="logout.php">Logout</a></div></div></div>';
//if(teacher_session()){
  if(isset($_GET['id']) && isset($_GET['report']) && !empty($_GET['class_name'])){
  ?>
  <div class="container">
  <div class="row">
  <div class="col m9">
  <?php
  $id=$_GET['id'];
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
  <br>
  <a href="reportinpdf.php"><i class="material-icons">
swap_vertical_circle</i></a>

  </div>
  </div>
  </div>

<div class="container">
  <div class="row">
    <div class="col m12">
      <h5 class="indigo-text">Bar Graph</h5>
      <canvas id="mycanvas"></canvas>
    </div>
  </div>
</div>

  <div class="container">
  <div class="row">
  <div class="col m12">
  <h5 class="indigo-text">Your Report</h5>
  <?php
  $q6="SELECT DISTINCT(parameter_id) FROM rating WHERE teacher_id='".$row2['teacher_id']."' ORDER BY(parameter_id)";
  $r6=mysqli_query($con,$q6);
  if(mysqli_num_rows($r6)==0){
    echo '<h5 class="indigo-text">No Response found</h5>';
  }
  ?>
  <table class="striped">
      <thead>
        <tr>
            <th>Parameter Id</th>
            <th>Categry</th>
            <th>Parameter</th>
            <th>Average Rating</th>
        </tr>
      </thead>

      <tbody>
  <?php
  $grades=array();
  $rating_get=0;
  $rating_tot=mysqli_num_rows($r6) * 5 ;
  $discount=mysqli_num_rows($r6);
  $inc=2;
  while($row6=mysqli_fetch_assoc($r6)){
    $q9="SELECT avg(rating) FROM rating WHERE parameter_id='".$row6['parameter_id']."' AND teacher_id='".$row2['teacher_id']."' AND class_name='".$_GET['class_name']."'";
    $r9=mysqli_query($con,$q9);
    $row9=mysqli_fetch_assoc($r9);
    $grades[$row6['parameter_id']]=$row9['avg(rating)'];
    $rating_get+=$row9['avg(rating)'];
  }
  if($rating_get > ($rating_tot - $discount)){
    $inc=10;
  }
  else if($rating_get > ($rating_tot - 1.5*$discount)){
    $inc=8;
  }
  else if($rating_get > ($rating_tot - 1.75*$discount)){
    $inc=8;
  }
  else if($rating_get > ($rating_tot - 2.0*$discount)){
    $inc=4;
  }

  echo '<h5 class="indigo-text">SECTION 1:</h5><br> Keeping in mind the wide array of parameters on which the students assessed you, your performance reflects that you are executing your job with good moral, joy, interest and passion. You engage the students with your way of teaching within the confines of classroom. You build a great rapport with your students and help them achieve more in life. You are helping in building a better future for the students a well as the nation.<br> Based on your evaluation by students: '.$inc.'% increment in your annual income<br><br>';


  foreach ($grades as $x=>$y){
    $q7="SELECT * FROM parameters WHERE parameter_id='".$x."'";
    $r7=mysqli_query($con,$q7);
    $row7=mysqli_fetch_assoc($r7);
    $q8="SELECT * FROM category WHERE category_id='".$row7['category_id']."'";
    $r8=mysqli_query($con,$q8);
    $row8=mysqli_fetch_assoc($r8);
          echo '<tr>
            <td>'.$x.'</td>
            <td>'.$row8['category_name'].'</td>
            <td>'.$row7['parameter_name'].'</td>
            <td>'.$y.'</td>
          </tr>';
          $q9="INSERT INTO temp (id,parameter,rating) VALUES ('".$x."','".$row7['parameter_name']."','".$y."')";
          mysqli_query($con,$q9);

  }


  ?>
      </tbody>
  </table>
  <br><br>
 <?php
  echo '<h5 class="indigo-text">SECTION 2:<br> Brief description about your teaching traits in which you are good enough to deliver your job: </h5><br>';
  foreach ($grades as $x=>$y){
    $q7="SELECT * FROM parameters WHERE parameter_id='".$x."'";
    $r7=mysqli_query($con,$q7);
    $row7=mysqli_fetch_assoc($r7);
    $q8="SELECT * FROM category WHERE category_id='".$row7['category_id']."'";
    $r8=mysqli_query($con,$q8);
    $row8=mysqli_fetch_assoc($r8);
    if($y>=3.5){
      $qb="SELECT * FROM parameter_desc_good WHERE parameter_id='".$row7['parameter_id']."'";
      $rb=mysqli_query($con,$qb);
      $rowb=mysqli_fetch_assoc($rb);
      echo '<p>'.'<u>'.$row7['parameter_name'].'</u>: '.$rowb['parameter_desc'].'</p><br>';
    }
  }
  echo '<br><br>';
  echo '<h5 class="indigo-text">SECTION 3:<br> Brief description about your teaching traits in which you require improvement: </h5><br>';
  foreach ($grades as $x=>$y){
    $q7="SELECT * FROM parameters WHERE parameter_id='".$x."'";
    $r7=mysqli_query($con,$q7);
    $row7=mysqli_fetch_assoc($r7);
    $q8="SELECT * FROM category WHERE category_id='".$row7['category_id']."'";
    $r8=mysqli_query($con,$q8);
    $row8=mysqli_fetch_assoc($r8);
    if($y<3.5){
      $qa="SELECT * FROM parameter_desc WHERE parameter_id='".$row7['parameter_id']."'";
      $ra=mysqli_query($con,$qa);
      $rowa=mysqli_fetch_assoc($ra);
      echo '<p>'.'<u>'.$row7['parameter_name'].'</u>: '.$rowa['parameter_desc'].'</p><br>';
    }
  }

  ?>
</div>
</div>
</div>

  <?php

  }
  else{
    ?>
  	<script type="text/javascript">
  		alert('Choose class first');
  		window.location="time-table.php";
  	</script>
  	<?php
  }
/*}
else{
  ?>
	<script type="text/javascript">
		alert('No don\'t have teacher privillages, Try login again as teacher');
		window.location="login.php";
	</script>
	<?php
}*/
require 'footer.php';
?>
<script type="text/javascript">
  $(document).ready(function() {
    $('select').material_select();
		$('.collapsible').collapsible();
  });
</script>
<script type="text/javascript" src="js/Chart.min.js"></script>
<script type="text/javascript" src="js/app.js"></script>
