<?php
session_start();
// unset($_SESSION['ROLE']);
unset($_SESSION['STU_ID']);
unset($_SESSION['USER_ID']);
unset($_SESSION['USER_NAME']);
header('location:index.php');
die();
?>