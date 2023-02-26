<?php
require('top.php');
$cou_id ='';
$ext = '';
$exd = '';
$exst = '';
$extl = '';
$exql = '';
$exdec = '';
$id='';
$sub2=''; 
$today=date("Y-m-d");
if(isset($_GET['exam_id'])){
    $id=mysqli_real_escape_string($conn,$_GET['exam_id']);
    $res=mysqli_query($conn,"select * from examination where exam_id='$id'");
    $row=mysqli_fetch_assoc($res);
    $cou_id =$row["cou_id"];
    $ext = $row["ex_title"];
    $exd = $row["ex_date"];
    $exst = $row["ex_start_time"];
    $extl = $row["ex_time_limit"];
    $exql = $row["ex_questlimit_display"];
    $exdec = $row["ex_description"];
    $sub2 = 1;
}
if(isset($_POST["ex_title"]) && isset($_POST["cou_id"]) && isset($_POST["ex_date"]) && isset($_POST["ex_start_time"]) && isset($_POST["ex_time_limit"]) && isset($_POST["ex_questlimit_display"]) && isset($_POST["ex_description"])){
    $cou_id =$_POST["cou_id"];
    $ext = $_POST["ex_title"];
    $exd = $_POST["ex_date"];
    $exst = $_POST["ex_start_time"];
    $extl = $_POST["ex_time_limit"];
    $exql = $_POST["ex_questlimit_display"];
    $exdec = $_POST["ex_description"];
    if($id>0){
        $sql="UPDATE examination SET cou_id='$cou_id', ex_title='$ext',ex_date='$exd',ex_start_time='$exst' ,ex_time_limit='$extl', ex_questlimit_display='$exql' , ex_description='$exdec' WHERE  exam_id='$id' ";
        mysqli_query($conn,$sql);
        if($exd>=$today)
        {
            header('location:exam.php');
            die();
        }
        else
        {
            echo "<script>alert('Invalid date input')</script>";
        }
    }else{
        echo "successfull";
        $conn = new PDO("mysql:host=localhost; dbname=online_examination_system","mysqli","Aditya@1234");
        if($exd>=$today)
        {
            $data = array(
            ':cou_id' => $_POST["cou_id"],
            ':ext' => $_POST["ex_title"],
            ':exd' => $_POST["ex_date"],
            ':exst' => $_POST["ex_start_time"],
            ':extl' => $_POST["ex_time_limit"],
            ':exql' => $_POST["ex_questlimit_display"],
            ':exdec' => $_POST["ex_description"]
            );
            $sql = "INSERT INTO examination(cou_id,ex_title,ex_date,ex_start_time,ex_time_limit,ex_questlimit_display,ex_description) VALUES(:cou_id,:ext,:exd,:exst,:extl,:exql,:exdec) ";
            
            $statement = $conn->prepare($sql);
            $statement->execute($data);
        }
    }
}
?> 

<main>
<div class="wrapper">
<form method="post" name="mform" id="ex_form">
<br><br>
<br><br>
<div>
        <h1><center><strong>Exam Form</strong></center></h1>
</div>

<div style="display: inline-block; text-align: left;">
Exam Title<br><input type="text" class="form_data" id="ex_title" name="ex_title" value="<?php echo $ext?>" placeholder="" required></input>
                            <br>
                        </div>
                        <br>
                        <br>

                           
                                
                        <div style="display: inline-block; text-align: left;">
                                Course Name<br><select class="form_data" id="cou_id" name="cou_id" required >
				                <option value="">Select course</option>
					            <?php
							        $res=mysqli_query($conn,"select * from course order by cou_name desc");
							        while($row=mysqli_fetch_assoc($res)){
                                        if($cou_id==$row['cou_id']){
                                            echo "<option selected='selected' value=".$row['cou_id'].">".$row['cou_name']."</option>";
                                        }else{
									    echo "<option value=".$row['cou_id'].">".$row['cou_name']."</option>";
                                        }
							        }
					                ?>
			                    </select>
                                <br>
                                </div>
                                <br>
                                <br>

                                <div style="display: inline-block; text-align: left;">
                                EXAM DATE<br><input type="date" class="form_data" id="ex_date" name="ex_date" value="<?php echo $exd?>" placeholder="" required></input>
                                <br>
                                </div>
                                <br>
                                <br>

                                <div style="display: inline-block; text-align: left;">
                                START TIME<br><input type="time" class="form_data" id="ex_start_time" name="ex_start_time" value="<?php echo $exst?>" placeholder="" required></input>
                                <br>
                                </div>
                                <br>
                                <br>

                                <div style="display: inline-block; text-align: left;">
                                Exam Duration<br><input type="text" class="form_data" id="ex_time_limit" name="ex_time_limit" value="<?php echo $extl?>" placeholder="" required></input>
                                <br>
                                </div>
                                <br>
                                <br>

                                <div style="display: inline-block; text-align: left;">
                                No. of Questions<br><input type="text" class="form_data" id="ex_questlimit_display" name="ex_questlimit_display" value="<?php echo $exql?>" placeholder="" required></input>
                                <br>
                                </div>
                                <br>
                                <br>

                                
                                <div style="display: inline-block; text-align: left;">
                                Exam Description<br><input type="text" class="form_data" id="ex_description" name="ex_description" value="<?php echo $exdec?>" placeholder="" required></input>
                                <br>
                                </div>
                                <br>
                                <br>

                                <center>
                                <div style="display: inline-block; text-align: left;">
                                <?php if($sub2==1){ ?>
                                    <button id="submit" type="submit">
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
        ajax_request.open('POST','addexam.php');
        ajax_request.send(form_data);
        ajax_request.onreadyatatechange = function(){
            if(ajax_request.readyState == 4 && ajax_request.status == 200)
            {
                document.getElementById('submit').disable = false;
                document.getElementById('ex_form').reset();
            }
        }
        window.location.href = "exam.php";
    }
    </script>
