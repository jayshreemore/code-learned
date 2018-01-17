<?php
   include_once('scadmin_header.php');

     $report="";
	 $t_id=$_GET['t_id'];

	  $school_id=$_GET['school_id'];
	  $selection = $_GET['selection'];
	  $t_name = $_GET['t_name'];
	  
?>

<?php
		if($selection=='Current')
		{
		$arr="SELECT DISTINCT  st.Branches_id,st.`subjectName`,st.ExtSemesterId,st.subjcet_code,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st inner join tbl_academic_Year Y on st.AcademicYear=Y.Year    WHERE st.`teacher_id` ='$t_id' and st.school_id='$school_id' and Y.Enable='1' and Y.school_id='$school_id'";
		$Semester=$_POST['Semester'];
		
		if(isset($_POST['Semester'])){
			if($_POST['Semester']=='all')
			{
				$arr="SELECT DISTINCT  st.Branches_id,st.`subjectName`,st.ExtSemesterId,st.subjcet_code,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st inner join tbl_academic_Year Y on st.AcademicYear=Y.Year    WHERE st.`teacher_id` ='$t_id' and st.school_id='$school_id' and Y.Enable='1' and Y.school_id='$school_id'";
			}
			else{
				$arr="SELECT DISTINCT  st.Branches_id,st.`subjectName`,st.ExtSemesterId,st.subjcet_code,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st inner join tbl_academic_Year Y on st.AcademicYear=Y.Year    WHERE st.`teacher_id` ='$t_id' and st.school_id='$school_id' and Y.Enable='1' and Y.school_id='$school_id' and st.Semester_id='$Semester'";
			}
		}
		}
		elseif($selection=='All'){
			$arr="SELECT DISTINCT  st.Branches_id,st.`subjectName`,st.ExtSemesterId,st.subjcet_code,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st inner join tbl_academic_Year Y on st.AcademicYear=Y.Year    WHERE st.`teacher_id` ='$t_id' and st.school_id='$school_id'  and Y.school_id='$school_id'";
		$Semester=$_POST['Semester'];
		if(isset($_POST['Semester'])){
			if($_POST['Semester']=='all')
			{
				$arr="SELECT DISTINCT  st.Branches_id,st.`subjectName`,st.ExtSemesterId,st.subjcet_code,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st inner join tbl_academic_Year Y on st.AcademicYear=Y.Year    WHERE st.`teacher_id` ='$t_id' and st.school_id='$school_id'  and Y.school_id='$school_id'";
			}
			else{
			$arr="SELECT DISTINCT st.Branches_id,st.`subjectName`,st.ExtSemesterId,st.subjcet_code,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st inner join tbl_academic_Year Y on st.AcademicYear=Y.Year    WHERE st.`teacher_id` ='$t_id' and st.school_id='$school_id'  and Y.school_id='$school_id' and st.Semester_id='$Semester'";
			}
		}
		}

?>

<?php
                                   $sql_student = mysql_query("SELECT DISTINCT s.std_complete_name,st.subjectName,st.student_id,st.CourseLevel,st.AcademicYear FROM tbl_student_subject st inner join tbl_student s on st.student_id=s.std_PRN inner join tbl_academic_Year as y on st.AcademicYear=y.Academic_Year where  st.teacher_ID='$t_id'and st.school_id='$sc_id' and y.Enable=1 and st.AcademicYear=(SELECT Year FROM tbl_academic_Year where Enable=1 and school_id='$sc_id' order by id desc limit 1)");

									 
                                    if(isset($_POST['submit'])) {
                                        if ($_POST['info'] == 'Current') {
                                            $sql_student = mysql_query("SELECT DISTINCT s.std_complete_name,st.subjectName,st.student_id,st.CourseLevel,st.AcademicYear FROM tbl_student_subject st inner join tbl_student s on st.student_id=s.std_PRN inner join tbl_academic_Year as y on st.AcademicYear=y.Academic_Year where  st.teacher_ID='$t_id'and st.school_id='$sc_id' and y.Enable=1 and st.AcademicYear=(SELECT Year FROM tbl_academic_Year where Enable=1 and school_id='$sc_id' order by id desc limit 1)");
                                        } elseif ($_POST['info'] == 'All') {
                                            $sql_student = mysql_query("SELECT DISTINCT s.std_complete_name,st.subjectName,st.student_id,st.CourseLevel,st.AcademicYear FROM tbl_student_subject st inner join tbl_student s on st.student_id=s.std_PRN inner join tbl_academic_Year as y on st.AcademicYear=y.Academic_Year where  st.teacher_ID='$t_id'and st.school_id='$sc_id'");
                                        } else {
                                             $sql_student = mysql_query("SELECT DISTINCT s.std_complete_name,st.subjectName,st.student_id,st.CourseLevel,st.AcademicYear FROM tbl_student_subject st inner join tbl_student s on st.student_id=s.std_PRN inner join tbl_academic_Year as y on st.AcademicYear=y.Academic_Year where  st.teacher_ID='$t_id'and st.school_id='$sc_id' and y.Enable=1 and st.AcademicYear=(SELECT Year FROM tbl_academic_Year where Enable=1 and school_id='$sc_id' order by id desc limit 1)");
                                        }
                                    }

                                    $result_student = mysql_num_rows($sql_student);
									 
                                    ?>

                                    <td><?php echo $result_student;?></td>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
<script src='js/bootstrap.min.js' type='text/javascript'></script>
<title>Student Semester Records</title>
<style>
@media only screen and (max-width: 800px) {

    /* Force table to not be like tables anymore */
	#no-more-tables table,
	#no-more-tables thead,
	#no-more-tables tbody,
	#no-more-tables th,
	#no-more-tables td,
	#no-more-tables tr {
		display: block;
	}

	/* Hide table headers (but not display: none;, for accessibility) */
	#no-more-tables thead tr {
		position: absolute;
		top: -9999px;
		left: -9999px;
	}

	#no-more-tables tr { border: 1px solid #ccc; }

	#no-more-tables td {
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee;
		position: relative;
		padding-left: 50%;
		white-space: normal;
		text-align:left;
		font:Arial, Helvetica, sans-serif;
	}

	#no-more-tables td:before {
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;

		padding-right: 10px;
		white-space: nowrap;


	}

	/*
	Label the data
	*/
	#no-more-tables td:before { content: attr(data-title); }
}
</style>
</head>
<script>
$(document).ready(function() {
    $('#example').dataTable( {
        "pagingType": "full_numbers"
    } );
} );

</script>
<!--
<script>
function confirmation(xxx) {
    var answer = confirm("Are you sure you want to delete")
    if (answer){

        window.location = "delete_school_subject.php?id="+xxx;
    }
    else{

     }
}

</script>
-->
<body bgcolor="#CCCCCC">
<div style="bgcolor:#CCCCCC">
<div>

</div>
<div class="container" style="padding:25px;" >


            	<div style="padding:2px 2px 2px 2px;border:1px solid #CCCCCC; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4;">


                    <div style="background-color:#F8F8F8 ;">
                    <div class="row">
						<div class="col-md-3 "  style="color:#700000 ;padding:5px;" >&nbsp;&nbsp;&nbsp;
						  <a href="<?php echo $_SERVER['HTTP_REFERER'];?>" class="btn btn-danger btn-md">
								  <span class="glyphicon glyphicon-arrow-left"></span> Back
						  </a>
					 <!--      <a href="add_school_subject.php">   <input type="submit" class="btn btn-primary" name="submit" value="Add Subject" style="width:110px;font-weight:bold;font-size:14px;"/></a>-->
						</div>
              			 <div class="col-md-6 " align="center"  >

                   				<h2><?php echo ($_SESSION['usertype']=='Manager')? 'Project':'Subject';?> List of <?php echo $t_name; ?></h2>
               			 </div>

                     </div>

                  <div class="row" align="center" style="margin-top:3%;">
				  <form method="post">
				    <div class="col-md-3"></div>


				  <div class="col-md-3">

				  </div>
				  <div class="col-md-2">

				  </div>
				      <div class="col-md-12 " >
			      <div class="row" align="center" style="margin-top:3%;">
				  <form action="display_teach_subject.php" method="post">
				    <div class="col-md-12">
						<div class="col-md-4 col-md-offset-3">
						<label class="col-sm-4 control-label text-right" for="info">Semester Name </label>
							<select name="Semester" class="form-control" style="width:150px;">
								<?php $select_semester_option_value= $_POST['Semester'] ?>
								<option value="" >Choose</option>
								<option value="all" <?php if($select_semester_option_value == "all") echo "selected"; ?>>ALL</option>
								<option value="Semester I" <?php if($select_semester_option_value == "Semester I") echo "selected"; ?>>Semester I</option>
								<option value="Semester II" <?php if($select_semester_option_value == "Semester II") echo "selected"; ?>>Semester II</option>
								<option value="Semester III" <?php if($select_semester_option_value == "Semester III") echo "selected"; ?>>Semester III</option>
								<option value="Semester IV" <?php if($select_semester_option_value == "Semester IV") echo "selected"; ?>>Semester IV</option>
								<option value="Semester V" <?php if($select_semester_option_value == "Semester V") echo "selected"; ?>>Semester V</option>
								<option value="Semester VI" <?php if($select_semester_option_value == "Semester VI") echo "selected"; ?>>Semester VI</option>
								<option value="Semester VII" <?php if($select_semester_option_value == "Semester VII") echo "selected"; ?>>Semester VII</option>
								<option value="Semester VIII" <?php if($select_semester_option_value == "Semester VIII") echo "selected"; ?>>Semester VIII</option>
							</select>`
						</div>
					</div>

						<div class="col-md-2" style="float:left;">
							<input type="submit" name="submit" value="Submit" class="btn btn-success">
						</div>
				  </form>
				  </div>
			   </div>


				  </form>
				  </div>


               <div class="row" style="margin-top:3%;">

               <div class="col-md-2">
               </div>
              <div class="col-md-12" id="no-more-tables" >
               <?php $i=0;?>
                   <table class="table-bordered  table-condensed cf" id="example" width="100%;" >
                     <thead>
					    <tr style="background-color:#555;color:#FFFFFF;height:30px;">
						<th style="width:50px;" ><center>Sr.No</center></th>
                        <th style="width:150px;" ><center><?php echo ($_SESSION['usertype']=='Manager')? 'Project':'Subject';?> Name</center></th>
						<th style="width:150px;" ><center><?php echo ($_SESSION['usertype']=='Manager')? 'Project':'Subject';?> Code</center></th>
                         <?php
   if($_SESSION['usertype']=='Manager'){
		   ?>

		 <th style="width:350px;" ><center>Department Name</center></th>

		<?php
		   }
		   else{
	?>
        <th style="width:350px;" ><center>Branch Name</center></th>
						<th style="width:350px;" ><center>Department Name</center></th>
    <?php
	 }
	 ?>

						<th style="width:50px;" ><center>Course Level</center></th>
                           <?php
   if($_SESSION['usertype']=='Manager'){
		   ?>



		<?php
		   }
		   else{
	?>
       <th style="width:100px;" ><center>Semester Name</center></th>

		<th style="width:100px;" ><center>Semester Code</center></th>
    <?php
	 }
	 ?>
     <?php
   if($_SESSION['usertype']=='Manager'){
		   ?>



		<?php
		   }
		   else{
	?>

						<th style="width:100px;" ><center>Division Name</center></th>
						
						
    <?php
	 }
	 ?>


						<th style="width:100px;" ><center><?php echo ($_SESSION['usertype']=='Manager')? 'Evaluation':'Academic';?> Year</center></th>
						<th style="width:100px;" ><center>No Of students</center></th>
					</tr>
					</thead>
				<tbody>
                 <?php

				   $i=1;
//$arr="SELECT std.std_PRN, std.std_name, std.std_Father_name, std.std_lastname, std.std_complete_name, semester.student_id, semester.SemesterName, semester.BranchName, semester.Specialization, semester.DeptName, semester.CourseLevel, semester.DivisionName, semester.AcdemicYear FROM StudentSemesterRecord AS semester JOIN tbl_student AS std ON std.std_PRN = semester.student_id JOIN tbl_academic_Year a ON semester.AcdemicYear=a.Year where semester.school_id='$sc_id' and semester.`IsCurrentSemester`='1' and a.Enable='1' and a.school_id='$sc_id' ORDER BY std.std_name,std.std_complete_name"?>
                  <?php
                //  echo $arr;
$arr1=mysql_query($arr);
				  while($row=mysql_fetch_array($arr1))
				  {
					  $subject_name = $row['subjectName'];
					    
                                        if ($_POST['info'] == 'Current') {
                                            $sql_student1 = mysql_query("SELECT DISTINCT s.std_complete_name,st.subjectName,st.student_id,st.CourseLevel,st.AcademicYear FROM tbl_student_subject st inner join tbl_student s on st.student_id=s.std_PRN inner join tbl_academic_Year as y on st.AcademicYear=y.Academic_Year where  st.teacher_ID='$t_id'and st.school_id='$school_id' and y.Enable=1 and st.subjectName='$subject_name' and st.AcademicYear=(SELECT Year FROM tbl_academic_Year where Enable=1 and school_id='$school_id' order by id desc limit 1)");
                                        } elseif ($_POST['info'] == 'All') {
                                            $sql_student1 = mysql_query("SELECT DISTINCT s.std_complete_name,st.subjectName,st.student_id,st.CourseLevel,st.AcademicYear FROM tbl_student_subject st inner join tbl_student s on st.student_id=s.std_PRN inner join tbl_academic_Year as y on st.AcademicYear=y.Academic_Year where  st.teacher_ID='$t_id'and st.school_id='$school_id' and st.subjectName='$subject_name'");
                                        } else {
                                             $sql_student1 = mysql_query("SELECT DISTINCT s.std_complete_name,st.subjectName,st.student_id,st.CourseLevel,st.AcademicYear FROM tbl_student_subject st inner join tbl_student s on st.student_id=s.std_PRN inner join tbl_academic_Year as y on st.AcademicYear=y.Academic_Year where  st.teacher_ID='$t_id'and st.school_id='$school_id' and y.Enable=1 and st.subjectName='$subject_name' and st.AcademicYear=(SELECT Year FROM tbl_academic_Year where Enable=1 and school_id='$school_id' order by id desc limit 1)");
                                        }
                                    $result_student1 = mysql_num_rows($sql_student1);
				     ?>
					 
					 
					 
					 
					 
					 

					
				  

				  <tr style="height:30px;color:#808080;">
                    <td data-title="Sr.No" style="width:50px;"><b><center><?php echo $i;?></center></b></td>
					
                    <td data-title="Student Name" style="width:50px;" ><center><a href="display_student_subject.php?subjectName=<?php echo $row['subjectName'];?>& t_id=<?php echo $_GET['t_id'];?>& school_id=<?php echo $_GET['school_id'];?>&selection_value=<?php echo $selection;?>"><?php echo $row['subjectName'];?></center></td>
					<td data-title="Student PRN" style="width:50px;" ><center><?php echo $row['subjcet_code'];?> </center></td>
					<td data-title="Branch Name" style="width:420px;"><center><?php echo $row['Branches_id'];?></center> </td>
					<td data-title="Department Name" style="width:420px;"><center><?php echo $row['Department_id'];?></center> </td>
                     <?php
   if($_SESSION['usertype']=='Manager'){
		   ?>

		<?php
		   }
		   else{
	?>
        <td data-title="Course" style="width:50px;"><center><?php echo $row['CourseLevel'];?></center> </td>
    <?php
	 }
	 ?>

      <?php
   if($_SESSION['usertype']=='Manager'){
		   ?>

		<?php
		   }
		   else{
	?>
					<td data-title="Semester" style="width:100px;"><center><?php echo $row['Semester_id'];?></center> </td>
					
					
					<td data-title="Semester" style="width:100px;"><center><?php echo $row['ExtSemesterId'];?></center> </td>
    <?php
	 }
	 ?>

     <?php
   if($_SESSION['usertype']=='Manager'){
		   ?>

		<?php
		   }
		   else{
	?>
        <td data-title="Division" style="width:100px;"><center><?php echo $row['Division_id'];?></center> </td>
    <?php
	 }
	 ?>
					 <td data-title="Year" style="width:100px;"><center><?php echo $row['AcademicYear'];?></center> </td>
                 <td data-title="Year" style="width:100px;"><center><?php echo $result_student1;?></center> </td>
				 
				 
				 
				 
				 </tr>
                <?php $i++;?>
                 <?php }?>

                  </tbody>
                  </table>
                  </div>
                  </div>


                   <div class="row" style="padding:5px;">
                   <div class="col-md-4">
               </div>
                  <div class="col-md-3 "  align="center">

                   </form>
                   </div>
                    </div>
                     <div class="row" >
                     <div class="col-md-4">
                     </div>
                      <div class="col-md-3" style="color:#FF0000;" align="center">

                      <?php echo $report;?>
               			</div>

                    </div>

               </div>
               </div>
</body>
</html>