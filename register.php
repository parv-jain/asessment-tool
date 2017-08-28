<?php
require 'nav.php';
?>
<div class="container">
 <div class="row">
   <h5 class="indigo-text">Register your college/institute</h5>
    <form class="col s12" action="validatekey.php" method="post">
      <div class="row">
        <div class="input-field col s12">
          <input id="regkey" type="text" class="validate" name="regkey" required>
          <label for="regkey" data-error="wrong" data-success="right">Enter Registration Key</label>
        </div>
      </div>
      <button class="waves-effect waves-green btn-flat" name="next">Next</button>
    </form>
  </div>
</div>
<?php
require 'footer.php';
?>