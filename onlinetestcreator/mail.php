<?php
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    //echo "<script>alert('hello')</script>";         
    //Load Composer's autoloader
    require('PHPMailer/Exception.php');
    require('PHPMailer/SMTP.php');
    require('PHPMailer/PHPMailer.php');
    require('top.php');

                    
    if(isset($_GET['id']))
    {
        $id=mysqli_real_escape_string($conn,$_GET['id']);
        $res=mysqli_query($conn,"select * from student where stud_id='$id'");
        $row=mysqli_fetch_assoc($res);
        
        $name = $row["stud_fullname"];
        $email= $row["stud_email"];
        $password = $row["stud_password"];

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try 
        {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = '****************';                     //SMTP username
            $mail->Password   = '****************';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('***************', '**************');
            $mail->addAddress('**************');     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Login Credentials';
            $mail->Body = "Name: $name <br> Username: $email <br> Password: $password";
                        
            if($mail->send())
            {
                echo "<script>
                alert('Mail has been sent');
                window.location.href = 'student.php';
                </script>";
            }
        }
        catch (Exception $e)
        {
            echo "<script>alert('Mail could not be sent. Mailer Error: {$mail->ErrorInfo}')</script>";
        }
    }                
    ?>
