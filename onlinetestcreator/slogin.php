<?php
require('db.php');
$msg="";
if(isset($_POST['email']) && isset($_POST['password'])){
        $email=mysqli_real_escape_string($conn,$_POST['email']);
        $password=mysqli_escape_string($conn,$_POST['password']);
	$res=mysqli_query($conn,"select * from student where stud_email='$email' and stud_password='$password'");
        $count=mysqli_num_rows($res);
        if($count>0){
                $row=mysqli_fetch_assoc($res);
                $_SESSION['STU_ID']=$row['stud_id'];
                $_SESSION['USER_ID']=$row['stud_email'];
                $_SESSION['USER_PASSWORD']=$row['stud_password'];
                header('location:sindex.php');
		die();
		
        }else{
                $msg="Please enter correct login details";
        }
}
?>

<html>
   
   <head>
     <link rel="stylesheet" href="login.css">
   </head>
   <body>
                                <div class="wrapper">
                        <h3 align="center">STUDENT LOGIN</h3>
                  <form method="POST">
                     
                        
                 
                                <div id="msg" style="color:red;"><?php echo $msg?></div>
                        <div style="text-align: center;">
                                <div style="display: inline-block; text-align: left;">
                                        <label>Email</label><br />
                                        <input type="email" name="email" placeholder="Email" style="text-align:left;" required/>
                                </div>
                        </div>
                
                        
                    <br>
                <div style="text-align: center;">
                                <div style="display: inline-block; text-align: left;">
                                        <label>Password</label><br />
                                        <input type="password" name="password" placeholder="password" style="text-align:left;" required/>
                                </div>
                </div> 
                  <br>      

                     
                     <h1><button type="submit">log in</button></h1>
</div>
                  </div>
   </body>
</html>


