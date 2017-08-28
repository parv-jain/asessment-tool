<?php
require 'nav.php';
?>
<div class="container">
 <div class="row">
   <h5 class="indigo-text">Login</h5>
      <div class="row">
        <form class="col s12" action="login-confirm.php" method="post">
          <div class="row">
              <p>Select User Type</p>
              <input name="user_type" type="radio" id="user_type1" value="registrar" required/>
              <label for="user_type1">Registrar</label>
          
              <input name="user_type" type="radio" id="user_type2" value="teacher"  required/>
              <label for="user_type2">Teacher</label>

              <input name="user_type" type="radio" id="user_type3" value="student"  required/>
              <label for="user_type3">Student</label>

              <input name="user_type" type="radio" id="user_type4" value="admin"  required/>
              <label for="user_type4">Admin</label>
         
          </div>
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">account_circle</i>
              <input id="username" type="text" class="validate" name="username" required>
              <label for="username">Username</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">lock</i>
              <input id="password" type="password" class="validate" name="password" required>
              <label for="password">Password</label>
            </div>
          </div>
          <button class="waves-effect waves-green btn-flat" name="login">Login</button>
        </form>
  </div>
  </div>
</div>
<?php
require 'footer.php';
?>