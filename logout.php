<?php
require 'db.php';

unset($_SESSION['logged_user']);
setcookie('logged_user', '', time()-1);

header('location: /login.php')

?>