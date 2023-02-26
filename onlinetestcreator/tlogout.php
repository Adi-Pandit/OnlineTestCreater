<?php
session_start();
// unset($_SESSION['ROLE']);
unset($_SESSION['USER_ID']);
unset($_SESSION['USER_NAME']);
unset($_SESSION['vid']);
header('location:index.php');
die();
?>