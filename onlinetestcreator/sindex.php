
<?php
require('stop.php');
$exmneId = $_SESSION['STU_ID'];
$res1 = mysqli_query($conn,"SELECT * FROM student WHERE stud_id='$exmneId' ");
while($row=mysqli_fetch_assoc($res1)){
$stucourse =  $row['cou_id'];
}        
$res2 = mysqli_query($conn,"SELECT * FROM examination WHERE cou_id='$stucourse' ORDER BY exam_id DESC ");

?>
<main>
         <section class="recent">
            <div class="activity-grid">
               <div class="activity-card">
                  <h3>recent activity</h3>

                  <div class="table-responsive">
                        <table>
                           <thead>
                           <tr>
                              <th>S.No</th>
                              <!--th>EXAM ID</th-->
                              <th>Course Name</th>
                              <th>EXAM TITLE</th>
                              <th>START TIME</th>
                              <th>EXAM DURATION</th>
                              <th>NO. OF QUESTIONS</th>
                              <th>EXAM DESCRIPTION</th>
                              <th>STATUS</th>
                              <th>OPERATIONS</th>
                              <!-- <th>STUDENTS</th>  -->
                           </tr>
                           </thead>
                           <tbody>
                           <?php
                              $i=1;
                              while($row=mysqli_fetch_assoc($res2)){
                                 $Id=$row['exam_id'];
                                 $qno1 = mysqli_query($conn,"SELECT ex_questlimit_display from examination where exam_id='$Id'");
                                 while ($ro = mysqli_fetch_assoc($qno1)) {
                                 $qn1 = $ro['ex_questlimit_display'];
                                 }
                                 $qno2 = mysqli_query($conn,"SELECT * from question_paper where exam_id='$Id'");
                                 $qn2 = mysqli_num_rows($qno2);
                                 if($qn2==$qn1){
                                 ?>
                                 <tr class="active-row">
                                    <td><?php echo $i?></td>
                                    <!--td><?php// echo $row['exam_id'];?></td-->
                                    <td><?php 
											            $courseId =  $row['cou_id']; 
											            $selCourse = mysqli_query($conn, "SELECT cou_name FROM course WHERE cou_id='$courseId'");
                                             while($crow=mysqli_fetch_assoc($selCourse)){
												            echo $crow['cou_name'];
											            }
									            ?></td>
                                    <td><?php echo $row['ex_title']?></td>
                                    <td><?php echo $row['ex_start_time'];?></td>
									         <td><?php echo $row['ex_time_limit']?></td>
									         <td><?php echo $row['ex_questlimit_display']?></td>
									         <td><?php echo $row['ex_description']?></td>
                                    <td><?php
                                    	$res=mysqli_query($conn,"SELECT * from exam_attempt where exam_id='{$row['exam_id']}' and stud_id='$exmneId'");
                                       $count=mysqli_num_rows($res);
                                       if($count>0){
                                             while($r=mysqli_fetch_assoc($res)){
												            $stat=$r['examat_status'];
											            }
                                             echo $stat;
                                       }
                                    else{
                                       echo "pending";
                                    }
                                    ?></td>
									         <td><button><a href="sexam.php?id=<?php echo $row['exam_id'];?>">START</a></button></td>
                              </tr>
                              <?php 
                                 }
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

