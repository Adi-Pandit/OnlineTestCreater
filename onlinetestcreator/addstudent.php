<?php
require('top.php');
$exnm='';
$cou_id ='';
$gender = '';
$dob = '';
//$yr = '';
$mail = '';
$pass = '';
$id='';
$sub2='';
if(isset($_GET['id'])){
    $id=mysqli_real_escape_string($conn,$_GET['id']);
    $res=mysqli_query($conn,"select * from student where stud_id='$id'");
    $row=mysqli_fetch_assoc($res);
    $exnm =$row["stud_fullname"];
    $cou_id =$row["cou_id"];
    //$gender = $row["stud_gender"];
    //$dob = $row["stud_birthdate"];
    //$yr = $row["stud_year_level"];
    $mail= $row["stud_email"];
    $pass = $row["stud_password"];
    $sub2 = 1;
}
if(isset($_POST["exnm"]) && isset($_POST["cou_id"]) && isset($_POST["mail"]) && isset($_POST["pass"])){
    $exnm =$_POST["exnm"];
    $cou_id =$_POST["cou_id"];
    //$gender = $_POST["gender"];
    //$dob = $_POST["dob"];
    //$yr = $_POST["yr"];
    $mail= $_POST["mail"];
    $pass = $_POST["pass"];
    if($id>0){
        $sql="UPDATE student SET stud_fullname='$exnm', cou_id='$cou_id', stud_email='$mail', stud_password='$pass' WHERE stud_id='$id'";
        mysqli_query($conn,$sql);
        header('location:student.php');
        die();
    }
    else{
        echo "successfull";
        $conn = new PDO("mysql:host=localhost; dbname=online_examination_system","mysqli","Aditya@1234");
        $data = array(
            ':exnm' =>$_POST["exnm"],
            ':cou_id' =>$_POST["cou_id"],
            ':mail'=> $_POST["mail"],
            ':pass' => $_POST["pass"]
        );
        $sql = "INSERT INTO student(stud_fullname,cou_id,stud_email,stud_password) VALUES(:exnm,:cou_id,:mail,:pass) ";
        
        $statement = $conn->prepare($sql);
        $statement->execute($data);
    }
        
       
}

?>

<main>     
    <div class="wrapper">                  
        <form method="post" name="mform" id="stu_form">
            <div>
                <h1><center><strong>Student Form</strong></center></h1>
            </div>
            
            
                <div style="display: inline-block; text-align: left;">
                    NAME<br><input type="text" class="form_data" id="exnm" name="exnm" value="<?php echo $exnm?>" placeholder="" required/>
                    <br>
                </div>
                <br>
                <br>
                        
                <div style="display: inline-block; text-align: left;">
                    Course Name<br><select class="form_data" id="cou_id" name="cou_id" required/>
				    <option value="">Select course</option>
					    <?php
					       $res=mysqli_query($conn,"select * from course order by cou_name desc");
						        
                            while($row=mysqli_fetch_assoc($res)){
                                if($cou_id==$row['cou_id']){
                                    echo "<option selected='selected' value=".$row['cou_id'].">".$row['cou_name']."</option>";
                                }
                                else{
									echo "<option value=".$row['cou_id'].">".$row['cou_name']."</option>";
                                }
						    }
					    ?>
			            </select>
                        <br>
                </div>
                <br>
                <br>
                        
                <!--div style="display: inline-block; text-align: left;">
                    GENDER<br><input type="radio" class="form_data" id="gender" name="gender" <?php //if(isset($gender) && $gender=="male")  echo"checked";?> value="male"-->
                   <!--label for="male">MALE</label>MALE
                    <input type="radio" class="form_data" id="gender" name="gender" <?php// if(isset($gender) && $gender=="female") echo"checked"; ?> value="female">
                    <label for="female">FEMALE</label>FEMALE
                   <br>
                </div>
                <br>
                <br-->
                              
                <!--div style="display: inline-block; text-align: left;">
                    BIRTH-DATE<br><input type="date" class="form_data" id="dob" name="dob" value="<?php //echo $dob?>" placeholder="" required/>
                    <br>
                </div>
                <br>
                <br-->

                <!--div style="display: inline-block; text-align: left;">
                    AGE<br><input type="text" class="form_data" id="yr" name="yr" value="<?php //echo $yr?>" placeholder="" required/>
                    <br>
                </div>
                <br>
                <br-->
                                
                <div style="display: inline-block; text-align: left;">
                    MAIL<br><input type="email" class="form_data" id="mail" name="mail" value="<?php echo $mail?>" placeholder="" required/>                            
                    <br>
                </div>
                <br>
                <br>
                                
                <div style="display: inline-block; text-align: left;">
                    PASSWORD<br><input type="password" class="form_data" id="pass" name="pass" value="<?php echo $pass?>" placeholder="" required/>
                    <br>
                </div>
                <br>
                <br>
                                
                <center>
                <div style="display: inline-block; align: center;">
                    <?php if($sub2==1){ ?>
                        <button id="submit" type="submit" >
                        <span>submit</span>
                        </button>       
                    <?php }else{ ?>
                        <button id="submit" type="submit" onclick="save_data(); return false;">
                        <span>submit</span>
                        </button>
                   <?php } ?>
                </div> 
                </center> 
			</form>
        </div>
    </div>

    
</main>



<script>
    function save_data(){
        var form_elt = document.getElementsByClassName('form_data');
        var form_data = new FormData();
        for(var count = 0 ; count<form_elt.length ; count++){
            form_data.append(form_elt[count].name,form_elt[count].value);
        }
        document.getElementById('submit').disabled = true;
        
        var ajax_request = new XMLHttpRequest();
        ajax_request.open('POST','addstudent.php');
    
        ajax_request.send(form_data);
       
        ajax_request.onreadyatatechange = function(){
            if(ajax_request.readyState == 4 && ajax_request.status == 200)
            {
                document.getElementById('submit').disable = false;
                document.getElementById('stu_form').reset();
            }
        }
        window.location.href = "student.php";      
    }
</script>

