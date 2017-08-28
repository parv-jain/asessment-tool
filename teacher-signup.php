<?php
require 'nav.php';
?>
<div class="container">
 <div class="row">
   <h5 class="indigo-text">Input Your Information</h5>
    <form class="col s12" action="signup-confirm.php" method="post">
      <div class="row">
        <div class="input-field col s12">
          <input id="name" type="text" class="validate" name="name" required>
          <label for="name" data-error="wrong" data-success="right">Your Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <select name="org" id="org" required>
            <option value="" disabled selected>Choose your Organization</option>
            <?php
            require_once 'connect.php';
            $q1="SELECT * FROM organization WHERE name!='' ORDER BY(name)";
            $r1=mysqli_query($con,$q1);
            while($row=mysqli_fetch_assoc($r1)){
            ?>
            <option value="<?php echo $row['organization_id']; ?>"> <?php echo $row['name']; ?> </option>
            <?php
            }
            ?>
          </select>
           <label>Select Organization</label>
        </div>
      </div>
      <div class="row" id="dept">
          
      </div>
      
      <div class="row">
        <div class="input-field col s12">
          <input id="email" type="email" class="validate" name="email" required>
          <label for="email" data-error="wrong" data-success="right">Your Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="mobno" type="tel" pattern="[\+]\d{2}[789][0-9]{9}" class="validate" name="mobno" required>
          <label for="mobno" data-error="wrong" data-success="right">Your Mobile no.(+91xxxxxxxxxx)</label>
        </div>
      </div>
      <button class="waves-effect waves-green btn-flat" name="signup">Sign-Up</button>
    </form>
  </div>
</div>

<?php
require 'footer.php';
?>
<script type="text/javascript">
  $(document).ready(function() {
    $('select').material_select();
    $('#org').on('change',function(){
        var orgID = $(this).val();
        if(orgID){
            $.ajax({
                type:'GET',
                url:'ajaxData.php',
                data:'orgid='+orgID,
                success:function(html){
                    $('#dept').html(html);
                }
            }); 
        }
        else{
           $('#dept').html('Select Organization First'); 
        }
    });
  });
</script>