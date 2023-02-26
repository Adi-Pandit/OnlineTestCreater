<?php
require('top.php');
if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id'])){
	$id=mysqli_real_escape_string($conn,$_GET['id']);
	mysqli_query($conn,"delete from student where stud_id='$id'");
}
$res=mysqli_query($conn,"select * from student order by stud_id desc");
?>

      <main>
         <h2 class="dash-title">Overview</h2>
         <div class="dash-cards">
            <div class="card-single">
               <div class="card-body">
                  <span class="ti-briefcase"></span>
                  <div>
                     <h5>Add Student</h5>
                  </div>
               </div>
               <div class="card-footer">
                  <a href="addstudent.php">click here to add</a>
               </div>
            </div>
         </div>

         <section class="recent">
            <div class="activity-grid">
               <div class="activity-card">
                  <h3>recent activity</h3>

                     <div class="table-responsive">
                        <table>
                           <thead>
                              <tr>
                                 <th>SR. NO.</th>
                                 <!--th>ID</th-->
                                 <th>STUDENT NAME</th>
                                 <th>COURSE NAME</th>
                                 <!--th>GENDER</th>
                                 <th>DOB</th>
                                 <th>AGE</th-->
                                 <th>EMAIL</th>
                                 <th>PASSWORD</th>
                                 <th>STATUS</th>
                                 <th>OPERATIONS</th>
                                 <th>SEND MAIL</th>
                              </tr>
                           </thead>
                           <tbody>
                           <?php 
									$i=1;
									while($row=mysqli_fetch_assoc($res)){?>
                              <tr>
                                 <td><?php echo $i?></td>
                                 <!--td><?php //echo $row['stud_id']?></td-->
                                 <td><?php echo $row['stud_fullname']?></td>
                                 <td><?php 
											            $courseId =  $row['cou_id']; 
											            $selCourse = mysqli_query($conn, "SELECT cou_name FROM course WHERE cou_id='$courseId'");
                                             while($crow=mysqli_fetch_assoc($selCourse)){
												            echo $crow['cou_name'];
											            }
									            ?></td>
                                 <!--td><?php //echo $row['stud_gender']?></td>
                                 <td><?php //echo $row['stud_birthdate']?></td-->
                                 <!--td><?php //echo $row['stud_year_level']?></td-->
                                 <td><?php echo $row['stud_email']?></td>
                                 <td><?php echo $row['stud_password']?></td>
                                 <td><?php echo $row['stud_status']?></td>
                                 <td><a href="addstudent.php?id=<?php echo $row['stud_id']?>"><span class="badge success">edit</span></a> <a href="student.php?id=<?php echo $row['stud_id']?>&type=delete"><span class="badge success">delete</span></a></td>
                                 <td><a href="mail.php?id=<?php echo $row['stud_id']?>"><span class="badge success">send</span></a>
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
