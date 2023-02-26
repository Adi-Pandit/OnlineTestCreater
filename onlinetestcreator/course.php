<?php
require('top.php');
    $id = '';
    $cou_name = '';
    $sub2='';
    if(isset($_GET['id'])){
        $id=mysqli_real_escape_string($conn,$_GET['id']);
        $res=mysqli_query($conn,"select * from course where cou_id='$id'");
        $row=mysqli_fetch_assoc($res);
        $cou_name=$row['cou_name'];
        $sub2 = 1;
    }
	if(isset($_POST["cou_name"])){
        $cou_name=mysqli_real_escape_string($conn,$_POST['cou_name']);
	    if($id>0){
		    $sql="UPDATE course SET cou_name='$cou_name' WHERE cou_id='$id'";
            mysqli_query($conn,$sql);
	        header('location:tindex.php');
	        die();
	    }
        else{  
            $conn = new PDO("mysql:host=localhost; dbname=online_examination_system","mysqli","Aditya@1234");       
		    $data = array(
		    ':cou_name' => $_POST["cou_name"]
		    );
		    $sql = "insert into course(cou_name) values(:cou_name)";
	        //mysqli_query($conn,$sql);
            $statement = $conn->prepare($sql);
            $statement->execute($data);
	    }
    }    
?>
<!-- <html>
    <head>
        <link rel="stylesheet" href="addstudent.css">
</head> -->

    <main>
       
            <div class="wrapper">
                       
                <form method="post" name="mform" id="stu_form">
                <div>
        <h1><center><strong>COURSE NAME</strong></center></h1>
</div>
<br>
<br>
                             
<div style="display: inline-block; text-align: left;">
Course Name<br>    <input type="text" value="<?php echo $cou_name;?>" class="form_data" id="cou_name" name="cou_name" placeholder="enter course name" required></input>
                           
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
        ajax_request.open('POST','course.php');
        ajax_request.send(form_data);
        ajax_request.onreadyatatechange = function(){
            if(ajax_request.readyState == 4 && ajax_request.status == 200)
            {
                document.getElementById('submit').disable = false;
                document.getElementById('cou_form').reset();
            }
        }
        window.location.href = "tindex.php";
    }
    </script>