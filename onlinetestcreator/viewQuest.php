<?php
require('top.php');
if(isset($_GET["vid"])){
$_SESSION['vid']=$_GET['vid'];
}
$vid = $_SESSION['vid'];
// if(isset($_GET["vid"])){
//    $vid = $_GET["vid"];
//    echo "received vid";
// }
if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id']))
{
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    mysqli_query($conn, "delete from question_paper where eqt_id ='$id'");
}
$res = mysqli_query($conn, "select * from question_paper where exam_id='$vid'");
$qno1 = mysqli_query($conn,"select ex_questlimit_display from examination where exam_id = '$vid'");
while ($row = mysqli_fetch_assoc($qno1)) {
    $qn1 = $row['ex_questlimit_display'];
}
$qno2 = mysqli_query($conn,"select * from question_paper where exam_id='$vid'");
$qn2 = mysqli_num_rows($qno2);
if($qn2 < $qn1)
{
   $a=0;
    $msg = "$qn2/$qn1 questions added in exam.If questions added are less than questions specified in exam than exam will not be displayed to student!!!";
}
if($qn2 > $qn1)
{
         $a=0;
         $msg = "$qn2/$qn1 questions added, are more than question no. specified!!!.Delete a question or increase the specified question no. count.";
}
if($qn2==$qn1){
        $a=1;
        $msg = "$qn2/$qn1 questions added!!!.No more than specified questions can be added.If you want to add more questions increase the question no count";
}
?>
<main>
         <h2 class="dash-title">Overview</h2>
         <div class="dash-cards">
            <div class="card-single">
               <div class="card-body">
                  <span class="ti-briefcase"></span>
                  <div>
                     <h5>add Question</h5>
                  </div>
               </div>
               <div class="card-footer">
                  <a href="addQuest.php?vid=<?php echo $vid?>">click here to add</a>
               </div>
            </div>
         </div>

         <section class="recent">
            <div class="activity-grid">
               <div class="activity-card">
                  <h3>recent activity</h3>
                  <span><div id="msg" style="color:<?php print($a>0) ? "Green" : "Red";?>;font-weight:5px;"><?php echo $msg?></div></span>

                     <div class="table-responsive">
                        <table>
                           <thead>
                           <tr>
                              <th>S.No</th>
                              <!--th>Question id</th-->
                              <!--th>EXAM NAME</th-->
                              <th>QUESTION</th>
                              <th>OPT 1</th>
                              <th>OPT 2</th>
                              <th>OPT 3</th>
                              <th>OPT 4</th>
                              <th>ANS</th>
                              <!--th>STATUS</th-->
                              <th>OPERATIONS</th>
                              <!-- <th>STUDENTS</th>  -->
                           </tr>
                           </thead>
                           <tbody>
                           <?php
                              $i=1;
                              while($row=mysqli_fetch_assoc($res)){?>
                                 <tr class="active-row">
                                    <td><?php echo $i?></td>
                                    <!--td><?php //echo $row['eqt_id']?></td-->
                                    <!--td><?php 
											            // $exid =  $row['exam_id']; 
											            /*$seleid = mysqli_query($conn, "SELECT ex_title FROM exam_tbl WHERE exam_id='$vid'");
                                             while($crow=mysqli_fetch_assoc($seleid)){
												            echo $crow['ex_title'];*/
											            
									            ?></td-->
                                    <td><?php echo $row['exam_question']?></td>
									         <td><?php echo $row['exam_ch1']?></td>
									         <td><?php echo $row['exam_ch2']?></td>
									         <td><?php echo $row['exam_ch3']?></td>
									         <td><?php echo $row['exam_ch4']?></td>
                                    <td><?php echo $row['exam_answer']?></td>
                                    <!--td><?php echo $row['exam_status']?></td-->
                                    <td><a href="addQuest.php?id=<?php echo $row['eqt_id']?>">Edit</a> <a href="viewQuest.php?id=<?php echo $row['eqt_id']?>&type=delete">Delete</a></td>
                                    </td>
                                    <!-- <td><button><a href="addQuest.php?id=<?php //echo $row['exam_id']?>">ADD</a></button></td> -->
                                    <!-- <td><button><a href="student.php">VIEW</a></button></td> -->
                              </tr>
                              <?php 
									$i++;
									} ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
            </div>
            
         </section>
      </main>
   </div>
</body>
</html>