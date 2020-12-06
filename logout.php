<?php
require('connection.inc.php'); 
require('function.inc.php');
if(isset($_POST['signout'])){
session_start();
session_unset();
// unset();
session_destroy();
header('location:inde.php');
}
// die();
?>
