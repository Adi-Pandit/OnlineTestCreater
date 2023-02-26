<?php
    include('stop.php');
    
    $dispr = mysqli_query($conn,"select * from result where stud_id='{$_SESSION['STU_ID']}'");
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
                              <!--th>RESULT ID</th-->
                              <th>Course Name</th>
                              <th>EXAM TITLE</th>
                              <th>TOTAL QUESTIONS</th>
                              <th>QUESTIONS ATTEMPTED</th>
                              <th>CORRECT ANSWER</th>
                              <th>MARKS</th>
                           </tr>
                           </thead>
                           <tbody>
                           <?php
                              $i=1;
                              while($row=mysqli_fetch_assoc($dispr)){?>
                                 <tr class="active-row">
                                    <td><?php echo $i?></td>
                                    <!--td><?php// echo $row['r_id']?></td-->
                                    <td><?php $cn=mysqli_query($conn,"select * from course where cou_id=(select cou_id from student where stud_id={$row['stud_id']})");
							        while($r1=mysqli_fetch_assoc($cn)){
                                        $cnn = $r1['cou_name']; 
                                    }
                                    echo $cnn;
                                        ?></td>
                                    <td><?php $ei = $row['exam_id'];
                                    $et=mysqli_query($conn,"select * from examination where exam_id='$ei'");
							        while($r2=mysqli_fetch_assoc($et)){
                                        $ett = $r2['ex_title']; 
                                    }
                                    echo $ett; ?></td>
                                    <td><?php //$ei = $row['exam_id'];
                                        $tq = mysqli_query($conn,"select * from examination where exam_id='$ei'");
                                        while($r3=mysqli_fetch_assoc($tq)){
                                            $tqq = $r3['ex_questlimit_display']; 
                                        }
                                        echo $tqq;
                                    ?></td>
                                    <td>
                                    <?php
                                        $qa = mysqli_query($conn,"select * from student_answer where exam_id='$ei' and stud_id='{$row['stud_id']}'");
                                        $qaa = mysqli_num_rows($qa);
                                        echo $qaa;
                                    ?>
                                    </td>
                                    <td><?php
                                        $selScore = mysqli_query($conn,"SELECT * FROM question_paper eqt INNER JOIN student_answer ea ON eqt.eqt_id = ea.eqt_id AND eqt.exam_answer = ea.exans_answer  WHERE ea.stud_id='{$_SESSION['STU_ID']}' AND ea.exam_id='{$_SESSION['eid']}'");
                                        $correctans = mysqli_num_rows($selScore);
                                        echo $correctans;
                                        ?>
                                        </td>
                                    <td>
                                    <?php
                                    echo "(".$correctans."/".$tqq.")*100=";
                                    echo "<br>".$row['result'];?>
                                    </td>
                                 </td>
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

