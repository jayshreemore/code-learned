<?php
error_reporting(0);
         /*  include_once("school_staff_header.php");*/
        /* include_once("scadmin_header.php");
	       $staff_id=$_SESSION['staff_id'];


           $results= $results=mysql_query("select * from tbl_school_adminstaff where id=". $staff_id."");
           $result=mysql_fetch_array($results);
          $school_id=$result['school_id'];*/


          	include_once("scadmin_header.php");
	      /* $id=$_SESSION['id'];
           $fields=array("id"=>$id);
		   $table="tbl_school_admin";
           $smartcookie=new smartcookie();*/

$results=$smartcookie->retrive_individual($table,$fields);
$result=mysql_fetch_array($results);
 $school_id=$result['school_id'];
    	 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
<title>Smart Cookie Program</title>


</head>

<body>

<div class="container" style="padding-top:30px;">

<div class="row" style="padding-top:20px;">

<div class="col-md-3"><a href="teacherlist.php" style="text-decoration:none;">
<div class="panel panel-info ">
  <div class="panel-heading">
    <h3 class="panel-title" align="center"><b>No. of Teachers</b> </h3>
  </div>
  <div class="panel-body" style="font-size:x-large" align="center">
  <?php
				$sql_t1="select count(t_id) as count from tbl_teacher where (`t_emp_type_pid`=133 or `t_emp_type_pid`=134 )and school_id='$school_id'";
				 $row_t1=mysql_query($sql_t1);
				 $count1=mysql_fetch_array($row_t1);
				            echo $count1['count'];
				?>
  </div>
</div></a>
</div>

<div class="col-md-3"><a href="Nonteacherlist.php" style="text-decoration:none;">
<div class="panel panel-info ">
  <div class="panel-heading">
    <h3 class="panel-title" align="center"><b>No.of Non Teaching Staff</b> </h3>
  </div>
  <div class="panel-body" style="font-size:x-large" align="center">
  <?php
	$sql_t1="select count(t_id) as count from tbl_teacher where `t_emp_type_pid`!=133 and `t_emp_type_pid`!=134 and school_id='$school_id'";
				 $row_t1=mysql_query($sql_t1);
				 $count1=mysql_fetch_array($row_t1);
				            echo $count1['count'];

				?>
  </div>
</div></a>
</div>


<div class="col-md-3"><a href="studentlist.php" style="text-decoration:none;">
<div class="panel panel-info ">
  <div class="panel-heading">
    <h3 class="panel-title" align="center"><b>No. of Students</b> </h3>
  </div>
  <div class="panel-body" style="font-size:x-large" align="center">
  <?php

				$sql_t="select count(id) from tbl_student where school_id='$school_id'";
				 $row_t=mysql_query($sql_t);
				$r=mysql_fetch_array($row_t);
				echo $c_parent=$r['0'];

				?>
  </div>
</div></a>
</div>


<div class="col-md-3"><a href="parents_list.php" style="text-decoration:none;">
<div class="panel panel-info ">
  <div class="panel-heading">
    <h3 class="panel-title" align="center"><b>No. of Parents</b> </h3>
  </div>
  <div class="panel-body" style="font-size:x-large" align="center">
  <?php
				$s=mysql_query("SELECT count(id) FROM tbl_parent WHERE school_id='$school_id'");
				$r=mysql_fetch_array($s);
				echo $c_parent=$r['0'];
				?>
  </div>
</div></a>
</div>





</div>



<div class="row" style="padding-top:20px;">

<div class="col-md-3"><a href="list_school_department.php" style="text-decoration:none;">
<div class="panel panel-info ">
  <div class="panel-heading">
    <h3 class="panel-title" align="center"><b>No. of Departments</b> </h3>
  </div>
  <div class="panel-body" style="font-size:x-large" align="center">

                 <?php
				 $sql_sp="select count(id) as count from  tbl_department_master where school_id='$school_id' ";
				 $row_sp=mysql_query($sql_sp);
				 $count_sp=mysql_fetch_array($row_sp);
				  echo $count_sp['count'];?>
  </div>
</div></a>
</div>

<div class="col-md-3"><a href="list_school_branch.php" style="text-decoration:none;">
<div class="panel panel-info ">
  <div class="panel-heading">
    <h3 class="panel-title" align="center"><b>No. of Branches</b> </h3>
  </div>
  <div class="panel-body" style="font-size:x-large" align="center">
 <?php
				 $sql_sp="select count(id) as count from tbl_branch_master where school_id='$school_id' ";
				 $row_sp=mysql_query($sql_sp);
				 $count_sp=mysql_fetch_array($row_sp);
				   echo $count_sp['count'];?>
  </div>
</div></a>
</div>


<div class="col-md-3"><a href="list_semester.php" style="text-decoration:none;">
<div class="panel panel-info ">
  <div class="panel-heading">
    <h3 class="panel-title" align="center"><b>No. of Semesters</b> </h3>
  </div>
  <div class="panel-body" style="font-size:x-large" align="center">
  <?php


				 $sql_sp="select count(Semester_Id) as count from tbl_semester_master where school_id='$school_id'";
				 $row_sp=mysql_query($sql_sp);
				 $count_sp=mysql_fetch_array($row_sp);
				  echo $count_sp['count'];?>
  </div>
</div></a>
</div>


<div class="col-md-3"><a href="list_school_class.php" style="text-decoration:none;">
<div class="panel panel-info ">
  <div class="panel-heading">
    <h3 class="panel-title" align="center"><b>No. of Classes</b> </h3>
  </div>
  <div class="panel-body" style="font-size:x-large" align="center">  <?php
				$s=mysql_query("SELECT count(id) FROM Class WHERE school_id='$school_id'");
				$r=mysql_fetch_array($s);
				echo $c_parent=$r['0'];

				?>

  </div>
</div></a>
</div>





</div>



<div class="row" style="padding-top:20px;">

<div class="col-md-3"><a href="list_teacher_subject.php" style="text-decoration:none;">
<div class="panel panel-info ">
  <div class="panel-heading">
    <h3 class="panel-title" align="center"><b>No. of Teacher Subjects</b> </h3>
  </div>
  <div class="panel-body" style="font-size:x-large" align="center">

                 <?php
				 $sql_sp="select count(tch_sub_id) as count from  tbl_teacher_subject_master where school_id='$school_id' ";
				 $row_sp=mysql_query($sql_sp);
				 $count_sp=mysql_fetch_array($row_sp);
				  echo $count_sp['count'];?>
  </div>
</div></a>
</div>

<div class="col-md-3"><a href="sponsorlist.php" style="text-decoration:none;">
<div class="panel panel-info ">
  <div class="panel-heading">
    <h3 class="panel-title" align="center"><b>No. of Sponsors</b> </h3>
  </div>
  <div class="panel-body" style="font-size:x-large" align="center">
 <?php
				 $sql_sp="select count(id) as count from tbl_sponsorer ";
				 $row_sp=mysql_query($sql_sp);
				 $count_sp=mysql_fetch_array($row_sp);
				   echo $count_sp['count'];?>
  </div>
</div></a>
</div>


<div class="col-md-3"><a href="list_school_subject.php" style="text-decoration:none;">
<div class="panel panel-info ">
  <div class="panel-heading">
    <h3 class="panel-title" align="center"><b>No. of Subjects</b> </h3>
  </div>
  <div class="panel-body" style="font-size:x-large" align="center">
  <?php


				 $sql_sp="select count(id) as count from tbl_school_subject where school_id='$school_id'";
				 $row_sp=mysql_query($sql_sp);
				 $count_sp=mysql_fetch_array($row_sp);
				  echo $count_sp['count'];?>
  </div>
</div></a>
</div>


<div class="col-md-3"><a href="student_semester_record.php" style="text-decoration:none;">
<div class="panel panel-info ">
  <div class="panel-heading">
    <h3 class="panel-title" align="center"><b>No. of Students per Semester</b> </h3>
  </div>
  <div class="panel-body" style="font-size:x-large" align="center">  <?php
				$s=mysql_query("SELECT count(id) FROM StudentSemesterRecord WHERE school_id='$school_id'");
				$r=mysql_fetch_array($s);
				echo $c_parent=$r['0'];

				?>

  </div>
</div></a>
</div>





</div>





<div class="row" style="padding-top:20px;">

<div class="col-md-3"><a href="list_student_subject.php" style="text-decoration:none;">
<div class="panel panel-info ">
  <div class="panel-heading">
    <h3 class="panel-title" align="center"><b>No. of Students per Subject</b> </h3>
  </div>
  <div class="panel-body" style="font-size:x-large" align="center">

               <?php


				 $sql_sp="select count(id) as count from  tbl_student_subject_master where school_id='$school_id'";
				 $row_sp=mysql_query($sql_sp);
				 $count_sp=mysql_fetch_array($row_sp);
				 echo $count_sp['count'];?>
  </div>
</div></a>
</div>

<div class="col-md-3"><a href="list_class_subject.php" style="text-decoration:none;">
<div class="panel panel-info ">
  <div class="panel-heading">
    <h3 class="panel-title" align="center"><b>No. of Class Subject</b> </h3>
  </div>
  <div class="panel-body" style="font-size:x-large" align="center">

               <?php


				 $sql_sp="SELECT count(id) as count FROM `tbl_class_subject_master` WHERE `school_id` ='$school_id'";
				 $row_sp=mysql_query($sql_sp);
				 $count_sp=mysql_fetch_array($row_sp);
				 echo $count_sp['count'];?>
  </div>
</div></a>
</div>






</div>


</div>

</body>
</html>


<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
<title>Smart Cookie Program</title>

<!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>

<body style="background-color:#F8F8F8;">
<div align="center">
	<div style="width:100%">
    	<div style="height:10px;"></div>
    	<div style="height:50px; border-bottom: thin solid #CCCCCC;" align="left">
        	<h1 style="padding-left:20px; margin-top:2px;"></h1>
        </div>
    	<div style="height:15px;"></div>


        <div class="container">
        <div class="row">

        <div class="col-md-6">
        <form method="post" name="product">
        	<div style="background-color:#FFFFFF; border:1px solid #CCCCCC; padding-left:30px;box-shadow: 0px 1px 3px 1px #C3C3C4;" align="left">
            	<div style="height:10px;"></div>

				<div>	<h3> No.of Teachers</h3>  </div>


            	<div style="color:#663366;font-size:60px;">


                <?php $row=mysql_query("select * from tbl_school_adminstaff where id=".$_SESSION['staff_id']);
				         $result=mysql_fetch_array($row);

								$school_id=$result['school_id'];

					//echo "select count(id) as count from tbl_teacher where school_id=$school_id ";
				$sql_t="select count(id) as count from tbl_teacher where school_id=$school_id ";
				 $row_t=mysql_query($sql_t);
				 $count=mysql_fetch_array($row_t);
				            echo $count['count'];

				?>
                </div>
              </div>
                <div style="height:10px;"></div>
          </form>
                 </div>



                 <div class="col-md-6">
              <form method="post" name="product">

        	<div  style="background-color:#FFFFFF; border:1px solid #CCCCCC; padding-left:30px;box-shadow: 0px 1px 3px 1px #C3C3C4;" align="left">
            	<div style="height:5px;"></div>
            	<div>
					<h3>No.of Students</h3>
                </div>
                <div style="color:#663366;font-size:60px;">
             <?php


				$sql_t="select count(id) as count from tbl_student where school_id=$school_id ";
				 $row_t=mysql_query($sql_t);
				 $count=mysql_fetch_array($row_t);
				            echo $count['count'];

				?></div>


                </div>
                <div style="height:10px;"></div>
               </form>
                </div>



                </div>
         </div>


             <div class="container">
             <div class="row">
     <div class="col-md-6">
        <form method="post" name="product">
        	<div style=" background-color:#FFFFFF; border:1px solid #CCCCCC; padding-left:30px;box-shadow: 0px 1px 3px 1px #C3C3C4;" align="left">
            	<div style="height:10px;"></div>

				<div>	<h3>No.of Sponsors</h3>  </div>


            	<div style="color:#663366;font-size:60px;">
                <?php


				 $sql_sp="select count(id) as count from tbl_sponsorer ";
				 $row_sp=mysql_query($sql_sp);
				 $count_sp=mysql_fetch_array($row_sp);
				       ?>  <blink>   <?php echo $count_sp['count'];?></blink>
                </div>
                </div>
              <div style="height:10px;"></div>
                </form>
            </div>


              <div class="col-md-6">
                <form method="post" name="product">
        	<div style=" background-color:#FFFFFF; border:1px solid #CCCCCC; padding-left:30px;box-shadow: 0px 1px 3px 1px #C3C3C4;padding:5px;" align="left">
            	<div style="height:5px;"></div>
            	<div>
					<h3>Top 3 Students</h3>
                </div>

               <?php

						$sql2="SELECT s.sc_stud_id, s.sc_total_point, t.std_name
								FROM  `tbl_student_reward` s
								JOIN tbl_student t
								WHERE t.id = s.`sc_stud_id` and t.school_id='$school_id'
								ORDER BY  `sc_total_point` DESC
								LIMIT 0 , 3" ;


						$result=mysql_query($sql2);



               ?>

              <table align="center" cellpadding="1" width="100%">
            	<tr  style="color:#003399;font-size:14px">
               <th>Student ID</th>
               		<th>Student Name</th>
                    <th>Points</th></tr>
                    <?php while($row=mysql_fetch_array($result)){?>
               <tr ><td> <?php echo $row['sc_stud_id'];?></td>
               		<td> <?php echo $row['std_name'];?></td>
                    <td> <?php echo $row['sc_total_point'];?></td></tr>
                    <?php } ?>
               </table>

                </div>
                <div style="height:10px;"></div>
                </form>
                </div>
                </div>
             </div>


    </div>
</div>
<?php include("footer.php");?>
</body>
</html>
-->