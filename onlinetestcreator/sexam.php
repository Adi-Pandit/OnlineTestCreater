
<?php 
    require('db.php');
    if(!isset($_SESSION['USER_ID']))
    {
        header('location:slogin.php');
        die();
    }
    if(isset($_GET['id'])){
        $examId = $_GET['id'];
        }
        $_SESSION['eid'] = $examId;
    $isattempt = mysqli_query($conn,"select examat_status from exam_attempt where exam_id='$examId' and stud_id='{$_SESSION['STU_ID']}'");
    $count=mysqli_num_rows($isattempt);
    // if($count>0){
    //     header('location:sindex.php');
    // }
    if(isset($_POST["submit"])){
        $eid = $_SESSION['eid'];
            $sid = $_SESSION['STU_ID'];
            foreach($_REQUEST['answer'] as $key => $value) {
                $value = $value['correct'];
                $insAns = mysqli_query($conn,"INSERT INTO student_answer(stud_id,exam_id,eqt_id,exans_answer) VALUES('$sid','$eid','$key','$value')");
            }
            mysqli_query($conn,"insert into exam_attempt(stud_id,exam_id,examat_status)values('$sid','{$_SESSION['eid']}','attempted')");
                $selScore = mysqli_query($conn,"SELECT * FROM question_paper eqt INNER JOIN student_answer ea ON eqt.eqt_id = ea.eqt_id AND eqt.exam_answer = ea.exans_answer  WHERE ea.stud_id='{$_SESSION['STU_ID']}' AND ea.exam_id='{$_SESSION['eid']}'");
                $score = mysqli_num_rows($selScore);
                $o = mysqli_query($conn,"select * from question_paper where exam_id='{$_SESSION['eid']}'");
                $over = mysqli_num_rows($o);
                $ans = $score / $over * 100;
                $insr = mysqli_query($conn,"insert into result(stud_id,exam_id,result)values(".$_SESSION['STU_ID'].",".$_SESSION['eid'].",'$ans')");
            header('location:sindex.php');
    }

    $conn = new PDO("mysql:host=localhost; dbname=online_examination_system","mysqli","Aditya@1234");
    $selExam = $conn->query("SELECT * FROM examination WHERE exam_id='$examId' ")->fetch(PDO::FETCH_ASSOC);
    $cou_id = $selExam['cou_id'];
    $examdate = $selExam['ex_date'];
    $examtime = $selExam['ex_start_time'];
    $selExamTimeLimit = $selExam['ex_time_limit'];
    $exDisplayLimit = $selExam['ex_questlimit_display'];
    $currdate = date("Y-m-d");
    date_default_timezone_set('Asia/Kolkata');
    $currtime = date("h:ia");
    $strtt = strtotime($currtime);
    $eT = strtotime($examtime);
?>
<script type="text/javascript">
 var currT = <?php echo $strtt; ?>;
 var exT = <?php echo $eT; ?>;
 var currD = <?php echo $currdate; ?>; 
 var exD = <?php echo $examdate; ?>;
 var eattempted = <?php echo $count ?>;
 if(eattempted > 0)
 {
     alert('exam already attempted.');
     window.location.href = "sindex.php";
 }
 else if(currD != exD || currT < exT)
 {
     alert('exam not yet started...');
     window.location.href = "sindex.php";
 }
</script>
<link rel="stylesheet" href="estyle.css">
<main>
 <h1 align="center" style="background-color:red;"><span id="countdown"></span></h1>
                        <div align="center">
                            EXAM TITLE : <?php echo $selExam['ex_title']; ?>
                            <div>
                              <?php 
                              $selcon = $conn->query("SELECT * FROM course WHERE cou_id='$cou_id' ")->fetch(PDO::FETCH_ASSOC);
                              $cou_name = $selcon['cou_name'];
                              echo $cou_name;
                              ?> Test
                            </div>
                        </div>   
        <form method="POST" name="myform" id="myform">
        <table style="margin-left: auto;margin-right: auto;background-color:grey;">
        <?php 
            $selQuest = $conn->query("SELECT * FROM question_paper WHERE exam_id='$examId'");
            // ORDER BY rand() LIMIT $exDisplayLimit 
            if($selQuest->rowCount() > 0)
            {
                $i = 1;
                while ($selQuestRow = $selQuest->fetch(PDO::FETCH_ASSOC)) { ?>
                      <?php $questId = $selQuestRow['eqt_id']; ?>
                    <tr align="centre">
                        <td align="centre">
                        <div class="dash-cards">
                            <div class="card-single">
                                <div class="card-body">
                                    <div>
                            <h5 style="color:black;"><p><b><?php echo $i++ ; ?> .) <?php echo $selQuestRow['exam_question']; ?></b></p></h5>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <br>
                        <div class="card-footer">
                                <input name="answer[<?php echo $questId; ?>][correct]" class="form_data" value="<?php echo $selQuestRow['exam_ch1']; ?>" type="radio" value="" >
                                
                                <label>
                                    <?php echo $selQuestRow['exam_ch1']; ?>
                                </label>
                                </div>
                                <br>
                                <div class="card-footer">
                                <input name="answer[<?php echo $questId; ?>][correct]" class="form_data" value="<?php echo $selQuestRow['exam_ch2']; ?>" type="radio" value="" >
                                
                                <label>
                                    <?php echo $selQuestRow['exam_ch2']; ?>
                                </label>
                </div>
                                <br>
                                <div class="card-footer">
                                <input name="answer[<?php echo $questId; ?>][correct]" class="form_data" value="<?php echo $selQuestRow['exam_ch3']; ?>" type="radio" value="" >
                                
                                <label>
                                    <?php echo $selQuestRow['exam_ch3']; ?>
                                </label> 
                </div>                          
                                <br>
                                <div class="card-footer">
                                <input name="answer[<?php echo $questId; ?>][correct]" class="form_data" value="<?php echo $selQuestRow['exam_ch4']; ?>" type="radio" value="" >

                                <label>
                                    <?php echo $selQuestRow['exam_ch4']; ?>
                                </label>  
                </div>                        

                        </td>
                    </tr>

                <?php }
                ?>
                       <tr>
                             <td style="padding: 10px;">
                                 <button><input name="submit" class="form_data" id="submitAnswerFrmBtn" type="submit" value="submit"></button>
                             </td>
                         </tr>
                <?php
            }
            else
            { ?>
                <b>No question at this moment</b>
            <?php }
         ?>   
              </table>
        </form>  
</main> 
        <script type="text/javascript">
            const startingMinutes = <?php echo $selExamTimeLimit; ?>;
            let time = startingMinutes * 60; //minutes * 60 seconds
            let refreshIntervalId = setInterval(updateCountdown, 1000);
            function updateCountdown() {
                const minutes = Math.floor(time / 60); // rounds a number DOWN to the nearest integer
                let seconds = time % 60;
                seconds = seconds < 10 ? '0' + seconds : seconds; 
                const contdownEl = document.getElementById("countdown"); 
                contdownEl.innerHTML = `${minutes}:${seconds}`;
                time--;
                if (time<0) { //stop the setInterval whe time = 0 for avoid negative time
                    clearInterval(refreshIntervalId);
                    document.getElementById("submitAnswerFrmBtn").click(); // Simulates button click   
                    alert('time over!!!')
                }
            }
</script>

