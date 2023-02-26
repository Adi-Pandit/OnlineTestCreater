<?php
require('top.php');
// if(isset($_GET['vid'])){
//     $vid = $_GET['vid'];
//     echo "received again";
// }
// $_SESSION['vid'] = $_GET["vid"];
$vid = $_SESSION['vid'];
// echo $vid;

$exam_id ='';
$eq = '';
$o1 = '';
$o2 = '';
$o3 = '';
$o4 = '';
$eans = '';
$id='';
$sub2='';
$qno1 = mysqli_query($conn,"select ex_questlimit_display from examination where exam_id = '$vid'");
while ($row = mysqli_fetch_assoc($qno1)) {
    $qn1 = $row['ex_questlimit_display'];
}
$qno2 = mysqli_query($conn,"select * from question_paper where exam_id='$vid'");
$qn2 = mysqli_num_rows($qno2);
$msg='';
if($qn2 < $qn1)
{
    $a=0;
    $msg = "$qn2/$qn1 questions added in exam.If questions added are less than questions specified in exam than exam will not be displayed to student!!!";
}
else{
    if($qn2 > $qn1)
    {
        $a=0;
        $msg = "$qn2/$qn1 questions added, are more than question no. specified!!!.Delete a question or increase the specified question no. count.";
        header('Refresh: 4; URL=viewQuest.php');
    }//else{
    //     $a=1;
    //     $msg = "$qn2/$qn1 questions added!!!.No more than specified questions can be added.If you want to add more questions increase the question no count";
    //     header('Refresh: 4; URL=viewQuest.php');
    // }
}
if(isset($_GET['id'])){
    $id=mysqli_real_escape_string($conn,$_GET['id']);
    $res=mysqli_query($conn,"select * from question_paper where eqt_id='$id'");
    $row=mysqli_fetch_assoc($res);
    $exam_id =$row["exam_id"];
    $eq = $row["exam_question"];
    $o1 = $row["exam_ch1"];
    $o2 = $row["exam_ch2"];
    $o3 = $row["exam_ch3"];
    $o4 = $row["exam_ch4"];
    $eans = $row["exam_answer"];
    $sub2 = 1;
}
if(isset($_POST["eq"]) && isset($_POST["o1"]) && isset($_POST["o2"]) && isset($_POST["o3"]) && isset($_POST["o4"]) && isset($_POST["eans"])){
    $exam_id =$vid;
    $eq = $_POST["eq"];
    $o1 = $_POST["o1"];
    $o2 = $_POST["o2"];
    $o3 = $_POST["o3"];
    $o4 = $_POST["o4"];
    $eans = $_POST["eans"];
    if($id>0){
        $sql="UPDATE question_paper SET exam_question='$eq', exam_ch1='$o1', exam_ch2='$o2', exam_ch3='$o3', exam_ch4='$o4',exam_answer='$eans' WHERE eqt_id='$id' ";
        mysqli_query($conn,$sql);
        header('location:viewQuest.php');
        die();
    }else{
        echo "successfull";
        $conn = new PDO("mysql:host=localhost; dbname=online_examination_system","mysqli","Aditya@1234");
        $data = array(
            ':vid'=>$exam_id,
            ':eq' => $_POST["eq"],
            ':o1' => $_POST["o1"],
            ':o2' => $_POST["o2"],
            ':o3' => $_POST["o3"],
            ':o4' => $_POST["o4"],
            ':eans' => $_POST["eans"]
        );
        $sql = "INSERT INTO question_paper(exam_id,exam_question,exam_ch1,exam_ch2,exam_ch3,exam_ch4,exam_answer) VALUES(:vid,:eq,:o1,:o2,:o3,:o4,:eans) ";
        $statement = $conn->prepare($sql);
        $statement->execute($data);
        // header('location:viewQuest.php');
    }
}
?>
<!-- <html>
    <head>
        <link rel="stylesheet" href="addstudent.css">
    </head> -->

    <main>
       
            <div class="wrapper">
            <span><div id="msg" style="color:<?php print($a>0) ? "Green" : "Red";?>;font-weight:5px;"><?php echo $msg?></div></span>    
                    <form method="post" name="mform" id="stu_form">
                    <div>
                            <h1><center><strong>Question Form</strong></center></h1>
                    </div>
                    <br>
                   

                                <div style="display: inline-block; text-align: left;">
                                Exam Question<br><input type="text" class="form_data" id="eq" name="eq" value="<?php echo $eq?>" placeholder="" required></input>
                                <br>
                                </div>
                                <br>
                               
                               

                                <div style="display: inline-block; text-align: left;">
                                Option 1<br><input type="text" class="form_data" id="o1" name="o1" value="<?php echo $o1?>" placeholder="" required></input>
                                <br>
                                </div>
                                <br>
                               

                                <div style="display: inline-block; text-align: left;">
                                Option 2<br><input type="text" class="form_data" id="o2" name="o2" value="<?php echo $o2?>" placeholder="" required/>
                                <br>
                                </div>
                                <br>
                               
                                <div style="display: inline-block; text-align: left;">
                                Option 3<br><input type="text" class="form_data" id="o3" name="o3" value="<?php echo $o3?>" placeholder="" required/>
                                <br>
                                </div>
                                <br>
                               

                                <div style="display: inline-block; text-align: left;">
                                Option 4<br><input type="text" class="form_data" id="o4" name="o4" value="<?php echo $o4?>" placeholder="" required/>
                                <br>
                                </div>
                                <br>
                                <br>
                               

                                <div style="display: inline-block; text-align: left;">
                                Correct Answer<br><input type="text" class="form_data" id="eans" name="eans" value="<?php echo $eans?>" placeholder="" required/>
                                <br>
                                </div>
                                <br>
                                <br>
                               


                                <center>
                                <div style="display: inline-block; align: center;">
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

<!-- <main>
                        <div><strong>Exam</strong><small> Form</small></div>
                        <span><div id="msg" style="color:<?php //print($a>0) ? "Green" : "Red";?>;font-weight:5px;"><?php //echo $msg?></div></span>
                           <form method="post" name="mform" id="Quest_form">
                                Exam Question<input type="text" class="form_data" id="eq" name="eq" value="<?php //echo $eq?>" placeholder="" required></input>
                                <br>
                                Option 1<input type="text" class="form_data" id="o1" name="o1" value="<?php //echo $o1?>" placeholder="" required></input>
                                <br>
                                Option 2<input type="text" class="form_data" id="o2" name="o2" value="<?php //echo $o2?>" placeholder="" required></input>
                                <br>
                                Option 3<input type="text" class="form_data" id="o3" name="o3" value="<?php //echo $o3?>" placeholder="" required></input>
                                <br>
                                Option 4<input type="text" class="form_data" id="o4" name="o4" value="<?php //echo $o4?>" placeholder="" required></input>
                                <br>
                                Correct Answer<input type="text" class="form_data" id="eans" name="eans" value="<?php //echo $eans?>" placeholder="" required></input>
                                <br>
                                <?php //if($sub2==1){ ?>
                                    <button id="submit" type="submit">
                                    <span>submit</span>
                                    </button>
                                <?php //}else{ ?>
                                    <button id="submit" type="submit" onclick="save_data(); return false;">
                                    <span>submit</span>
                                    </button>
                                <?php //} ?>
							  </form>
</main> -->
<script>
    function save_data(){
        var form_elt = document.getElementsByClassName('form_data');
        var form_data = new FormData();
        for(var count = 0 ; count<form_elt.length ; count++){
            form_data.append(form_elt[count].name,form_elt[count].value);
        }
        document.getElementById('submit').disabled = true;
        var ajax_request = new XMLHttpRequest();
        ajax_request.open('POST','addQuest.php');
        ajax_request.send(form_data);
        ajax_request.onreadyatatechange = function(){
            if(ajax_request.readyState == 4 && ajax_request.status == 200)
            {
                document.getElementById('submit').disable = false;
                document.getElementById('Quest_form').reset();
            }
        }
        window.location.href = "viewQuest.php";
    }
    </script>
