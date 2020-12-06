<?php
session_start();
unset($_SESSION['IS_LOGIN']);
// unset($_SESSION['ADMIN_USERNAME']);
session_destroy();
header('location:../inde.php');

?>