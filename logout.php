<?php
require('session.php');
session_destroy();
?><script language='javascript'>alert('Logout Success ');window.location='login.php';</script>
