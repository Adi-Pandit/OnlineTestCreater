<?php
require('db.php');
if(!isset($_SESSION['USER_NAME']))
{
   header('location:tlogin.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
   <title>Document</title>
   <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="addstudent.css">
</head>
<body>
   <input type="checkbox" id="sidebar-toggle">
   <div class="sidebar">
      <div class="sidebar-header">
         <h3 class="brand">
            <span class="ti-unlink"></span>
            <span>ONLINE TEST CREATOR</span>
         </h3>
         <label for="sidebar-toggle" class="ti-menu-alt"><img src="icons/menu24px.png"></label>
      </div>
      <div class="sidebar-menu">
         <ul>
            <!--li>
               <a href="index.php">
                  <img src="" class="ti-home"></span>
                  <span>Home</span>
               </a>
            </li-->
            <li>
               <a href="tindex.php">
                  <img src="" class="ti-home"></span>
                  <span>Course</span>
               </a>
            </li>
            <li>
               <a href="exam.php">
                  <img src="" class="ti-face-smile"></span>
                  <span>Exam</span>
               </a>
            </li>
            <li>
               <a href="student.php">
                  <img src="" class="ti-clipboard"></span>
                  <span>Student</span>
               </a>
            </li>
            <li>
               <a href="aresult.php">
                  <img src="" class="ti-clipboard"></span>
                  <span>Results</span>
               </a>
            </li>
         </ul>
      </div>
   </div>
   <div class="main-content">
      <header>
         <div class="search-wrapper">
            <img src="icons/loupe24px.png" class="ti-search"></span>
            <input type="search" placeholder="Search">
         </div>
         <div class="social-icons">
            <!-- <a href="notification.php"><img src="icons/bell24px.png" class="ti-bell"></a>
            <a href="chat.png"><img src="icons/messenger.png" class="ti-message"></a> -->
            <a href="tlogout.php"><img src="icons/logout24px.png" class="ti-logout"></a>
            <div></div>
         </div>
      </header>
   
   