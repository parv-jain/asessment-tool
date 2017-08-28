<?php
require 'session.php';
require 'connect.php';
if(student_session()){
  if(isset($_POST['submit'])){
    if(!empty($_POST['teacher']) && !empty($_POST['orgid']) && !empty($_POST['class_name'])){
      $teacher=$_POST['teacher'];
      $orgid=$_POST['orgid'];
      $class_name=$_POST['class_name'];
      $q1="SELECT * FROM organization_parameters WHERE organization_id='".$orgid."'";
      $r1=mysqli_query($con,$q1);
      $flag=0;
      while($row1=mysqli_fetch_assoc($r1)){
        if(isset($_POST[$row1['parameter_id']])){
          $rating=$_POST[$row1['parameter_id']];
          $q2="INSERT INTO rating (organization_id,teacher_id,class_name,parameter_id,rating) VALUES('".$orgid."','".$teacher."','".$class_name."','".$row1['parameter_id']."','".$rating."')";
          if(mysqli_query($con,$q2)){
            $flag=1;
          }
        }
      }
      if($flag==1){
        ?>
        <script type="text/javascript">
        alert('Your response has been recorded');
        window.location="assess.php?orgid=<?php echo $orgid; ?>&class_name=<?php echo $class_name; ?>&next=";
        </script>
        <?php
      }
    }
    else{
      ?>
      <script type="text/javascript">
      alert('Fill all the fields');
      window.location="assess.php?orgid=<?php echo $orgid; ?>&class_name=<?php echo $class_name; ?>&next=";
      </script>
      <?php
    }
  }
  else{
  ?>
    <script type="text/javascript">
    alert('Form not submitted');
    window.location="assess.php?orgid=<?php echo $orgid; ?>&class_name=<?php echo $class_name; ?>&next=";
    </script>
    <?php
  }
}
else{
  ?>
  <script type="text/javascript">
  alert('You don\'t have student privillages. Please login as student');
  window.location="login.php";
  </script>
  <?php
}
?>