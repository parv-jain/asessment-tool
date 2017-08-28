<?php
session_start();
if(!isset($_SESSION['regkey']))
{
header('location:register.php');
}
require 'nav.php';
?>
<div class="container">
 <div class="row">
   <h5 class="indigo-text">Key Validated. Input Registrar and Institute Information</h5>
    <form class="col s12" action="register-confirm.php" method="post">
      <div class="row">
        <div class="input-field col s12">
          <input value="<?php echo $_SESSION['regkey']; ?>" id="regkey" type="text" name="regkey" class="validate" readonly>
          <label for="regkey">Registration Key</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="name" type="text" class="validate" name="name" required>
          <label for="name" data-error="wrong" data-success="right">Your Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <select class="icons" name="designation" required>
            <option value="" disabled selected>Choose your Designation</option>
            <option value="principal" data-icon="images/user.png" class="circle">Principal</option>
            <option value="director" data-icon="images/user.png" class="circle">Director</option>
            <option value="dean" data-icon="images/user.png" class="circle">Dean</option>
            <option value="manager" data-icon="images/user.png" class="circle">Manager</option>
          </select>
           <label>Select Designation</label>
        </div>
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
      <div class="row">
        <div class="input-field col s12">
          <input id="orgname" type="text" class="validate" name="orgname" required>
          <label for="orgname" data-error="wrong" data-success="right">Institute/College/School Name</label>
        </div>
      </div>     
      <button class="waves-effect waves-green btn-flat" name="register">Register</button>
    </form>
  </div>
</div>

<?php
session_destroy();
require 'footer.php';
?>
<script type="text/javascript">
  $(document).ready(function() {
    $('select').material_select();
  });
</script>