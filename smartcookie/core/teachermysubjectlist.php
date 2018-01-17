
<?php
error_reporting(0);
include('header.php');?>

<?php
$report="";
$query = mysql_query("select * from tbl_teacher where id = ".$_SESSION['id']);
$value = mysql_fetch_array($query);
$school_id=$value['school_id'];

$t_id=$value['t_id'];


if(isset($_POST['submit']))
{
	$info=$_POST['info'];
	if($info=="1")
	{
		$arr="SELECT DISTINCT  st.Branches_id,st.`subjectName`,st.ExtSemesterId,st.subjcet_code,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st inner join tbl_academic_Year Y on st.AcademicYear=Y.Year    WHERE st.`teacher_id` ='$t_id' and st.school_id='$school_id' and Y.Enable='1' and Y.school_id='$school_id'";
		
	}
	elseif($info=="2")
	{
		
	$arr="SELECT  DISTINCT st.Branches_id,st.`subjectName`,st.subjcet_code,st.ExtSemesterId,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st   WHERE st.`teacher_id` ='$t_id' and st.school_id='$school_id' ";
	
	}
	elseif($info=="3")
	
	{
		/*echo "SELECT  st.Branches_id,st.`subjectName`,st.subjcet_code,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear  FROM `tbl_teacher_subject_master` st  inner join tbl_semester_master s  on st.Semester_id=s.Semester_Name   WHERE st.`teacher_id` ='$t_id' and st.school_id='$school_id' and s.school_id='$school_id' and s.Is_enable='1'";
		*/
		/*
		echo "SELECT  st.Branches_id,st.`subjectName`,st.subjcet_code,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st inner join tbl_academic_Year Y on st.AcademicYear=Y.Year inner join tbl_semester_master s  on st.Semester_id=s.Semester_Name   WHERE st.`teacher_id` ='$t_id' and st.school_id='$school_id' and Y.Enable='1' and Y.school_id='$school_id' and s.Is_enable='1'";*/
		
	/*$arr="SELECT  st.Branches_id,st.`subjectName`,st.subjcet_code,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st inner join tbl_academic_Year Y inner join tbl_semester_master s  on st.AcademicYear=Y.Year  and  st.Semester_id=s.Semester_Name   WHERE st.`teacher_id` ='$t_id' and st.school_id='$school_id' and Y.Enable='1' and Y.school_id='$school_id' and s.Is_enable='1'";	
		
		$arr="SELECT   DISTINCT st.Branches_id,st.`subjectName`,st.subjcet_code,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st
		inner join tbl_academic_Year Y on st.AcademicYear=Y.Year
		inner join tbl_semester_master s  on st.Semester_id=s.Semester_Name 
		WHERE st.`teacher_id` ='$t_id'
		and st.school_id='$school_id' 
		and Y.Enable='1'
		and Y.school_id='$school_id'
		and s.Is_enable='1'";
		//inner join  tbl_teacher_subject_master tsm on s.ExtSemesterId=tsm.ExtSemesterId/*/
		
		
		
		$arr="SELECT   DISTINCT st.Branches_id,st.`subjectName`,st.subjcet_code,st.ExtSemesterId,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st
		inner join tbl_academic_Year Y on st.AcademicYear=Y.Year
		inner join tbl_semester_master s on s.ExtSemesterId=st.ExtSemesterId 
		
		WHERE st.`teacher_id` ='$t_id'
		and st.school_id='$school_id' 
		and Y.Enable='1'
		and Y.school_id='$school_id'
		and s.Is_enable='1'
		and s.ExtSemesterId <> 0";
		
		
		
		
		/*
		echo "SELECT  st.Branches_id,st.`subjectName`,st.subjcet_code,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st inner join tbl_semester_master s on st.Semester_id=s.Semester_Name   WHERE st.`teacher_id` ='$t_id' and st.school_id='$school_id' and s.Is_enable='1'";*/
		
		/*$arr1="SELECT  st.Branches_id,st.`subjectName`,st.subjcet_code,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st inner join tbl_semester_master s on st.Semester_id=s.Semester_Name   WHERE st.`teacher_id` ='$t_id' and st.school_id='$school_id' and s.Is_enable='1'";*/
		
	/*$arr="SELECT  st.Branches_id,st.`subjectName`,st.subjcet_code,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st   WHERE st.`teacher_id` ='$t_id' and st.school_id='$school_id'and st.AcademicYear='2015'";*/
	
	}
	elseif($info=="4")
	{
		/*echo "SELECT  st.Branches_id,st.`subjectName`,st.subjcet_code,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st   WHERE st.`teacher_id` ='$t_id' and st.school_id='$school_id' and st.AcademicYear='2016'";*/
		
	
		$arr="SELECT   DISTINCT st.Branches_id,st.`subjectName`,st.subjcet_code,st.ExtSemesterId,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st inner join tbl_academic_Year Y on st.AcademicYear=Y.Year inner join tbl_semester_master s  on st.Semester_id=s.Semester_Name   WHERE st.`teacher_id` ='$t_id' and st.school_id='$school_id' and Y.Enable='1' and Y.school_id='$school_id'";
	}
	
	
	
	
}
else
{
	
	$arr="SELECT  st.Branches_id,st.`subjectName`,st.subjcet_code,st.Division_id,st.ExtSemesterId,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st inner join tbl_academic_Year Y on st.AcademicYear=Y.Year    WHERE st.`teacher_id` ='$t_id' and st.school_id='$school_id' and Y.Enable='1' and Y.school_id='$school_id'";
	//$arr="SELECT std.std_PRN, std.std_name, std.std_Father_name, std.std_lastname, std.std_complete_name, semester.student_id, semester.SemesterName, semester.BranchName, semester.Specialization, semester.DeptName, semester.CourseLevel, semester.DivisionName, semester.AcdemicYear FROM StudentSemesterRecord AS semester JOIN tbl_student AS std ON std.std_PRN = semester.student_id JOIN tbl_academic_Year a ON semester.AcdemicYear=a.Year where semester.school_id='$sc_id' and semester.`IsCurrentSemester`='1' and a.Enable='1' and a.school_id='$sc_id' ORDER BY std.std_name,std.std_complete_name";

}

//echo $arr;
?>

<!doctype html>
<html lang="en-US">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html">
  <title>Simple Table Sorting with jQuery - Treehouse Demo</title>
  <meta name="author" content="Jake Rocheleau">
  <link rel="shortcut icon" href="http://d15dxvojnvxp1x.cloudfront.net/assets/favicon.ico">
  <link rel="icon" href="http://d15dxvojnvxp1x.cloudfront.net/assets/favicon.ico">
  <script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">

  <style>

  body { 
  background: #eee url('bg.png'); /* http://subtlepatterns.com/weave/ */
  font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
  
  line-height: 1;
  color: #585858;
  
  padding-bottom: 55px;
}

h1 { 
  font-family: 'Amarante', Tahoma, sans-serif;
  font-weight: bold;
  font-size: 3.6em;
  line-height: 1.7em;
  margin-bottom: 10px;
  text-align: center;
}


/** page structure **/
#wrapper {
  display: block;
  width: 100%;
  background: #fff;
  margin: 0 auto;
  padding: 10px 17px;
  -webkit-box-shadow: 2px 2px 3px -1px rgba(0,0,0,0.35);
}

#keywords {
  margin: 0 auto;
  font-size: 1.2em;
  margin-bottom: 15px;
}


#keywords thead {
  cursor: pointer;
  background: #c9dff0;
}
#keywords thead tr th { 
  font-weight: bold;
  padding: 12px 30px;
  padding-left: 12px;
}


#keywords tbody tr { 
  color: #555;
}


 
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
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
		text-align:left;
		
	}
 
	/*
	Label the data
	*/
	#no-more-tables td:before { content: attr(data-title); }
}
</style>
  
  
</head>

<body>
<center><div class="heading"style="background-color:rgb(47, 50, 159);height:40px;">
 <center><h3 style="color:#fff";><?php echo $dynamic_subject;?></h3></center>
</div>
</center>

</div>
<?php 
if($pos !== false)
{?>

<div style="padding-top:10px;">
 <div id="wrapper">
  <div class="row"><div class="col-md-4"></div><div class="col-md-5" style="font-size:30px;color:#2F329F;" ></div><div class="col-md-3"></div> <div class="col-md-3"></div></div>
  
    <form method="post">
	<?php if($school_type=='school'){?>
				    <div class="col-md-3"></div>
				  <?php
                  echo ($_SESSION['usertype']=='Manager')? '':' <div class="col-md-2">Select Semester</div>';
				  ?>
				  
				  <div class="col-md-3">
				  <select name="info" class="form-control">
				  
				  <?php $select_option_value= $_POST['info'] ?>
					<option value="1" <?php if($select_option_value == "1") echo "selected"; ?>>Current Year</option>
					<option value="2" <?php if($select_option_value == "2") echo "selected"; ?>>All Year</option>
					<option value="3" <?php if($select_option_value == "3") echo "selected"; ?>>Current Semester</option>
					<option value="4" <?php if($select_option_value == "4") echo "selected"; ?>>All Semester</option>
				  </select>
				  </div>
				  <div class="col-md-2">
				  <input type="submit" name="submit" value="Submit" class="btn btn-success">
				  </div>
	<?php } ?> 
				  
				  </form>
  

  <div style="padding-top:10px;">
    <div id="no-more-tables" style="padding-top:10px;">
  <table  id="keywords" class="table-bordered"  style="width:100%; border-color:#000000;" align="center">
    <thead class="cf">
     <tr style="background-color:#555;color:#FFFFFF;height:30px;">
						<th style="width:50px;" ><center>Sr.No</center></th>
                        <th style="width:150px;" ><center><?php echo $dynamic_subject.' Name';?></center></th>
						<th style="width:150px;" ><center><?php echo $dynamic_subject.' Code';?></center></th>
						<th style="width:350px;" ><center>Department Name</center></th>
                         <?php if($school_type=='school'){?>
        <th style="width:350px;" ><center>Branch Name</center></th>
						
  
						<th style="width:50px;" ><center>Course Level</center></th>
						
		
       <th style="width:100px;" ><center>Semester Name</center></th>
		
		<th style="width:100px;" ><center>Semester Code</center></th>
       
						<th style="width:100px;" ><center>Division Name</center></th>
  	
						<th style="width:100px;" ><center>Academic Year</center></th>
						 <?php }?>
					</tr>
    </thead>
    <tbody>

		 <?php
				 
				   $i=1;
//$arr="SELECT std.std_PRN, std.std_name, std.std_Father_name, std.std_lastname, std.std_complete_name, semester.student_id, semester.SemesterName, semester.BranchName, semester.Specialization, semester.DeptName, semester.CourseLevel, semester.DivisionName, semester.AcdemicYear FROM StudentSemesterRecord AS semester JOIN tbl_student AS std ON std.std_PRN = semester.student_id JOIN tbl_academic_Year a ON semester.AcdemicYear=a.Year where semester.school_id='$sc_id' and semester.`IsCurrentSemester`='1' and a.Enable='1' and a.school_id='$sc_id' ORDER BY std.std_name,std.std_complete_name"?>
                  <?php
$arr1=mysql_query($arr);
				  while($row=mysql_fetch_array($arr1))
				  {
				      // $fullName=ucwords(strtolower($row['std_name']." ".$row['std_Father_name']." ".$row['std_lastname']));
				  ?>
				  
				  <tr 				  style="height:30px;color:#808080;">
				
               
                    <td data-title="Sr.No" style="width:50px;"><b><center><?php echo $i;?></center></b></td>
                    <td data-title="Student Name" style="width:50px;" ><center><?php echo $row['subjectName'];?></center></td>
					<td data-title="Student PRN" style="width:50px;" ><center><?php echo $row['subjcet_code'];?> </center></td>
                    <td data-title="Department Name" style="width:420px;"><center><?php echo $row['Department_id'];?></center> </td>
					  <?php if($school_type=='school'){?>
					<td data-title="Branch Name" style="width:420px;"><center><?php echo $row['Branches_id'];?></center> </td>
					
					
			
        <td data-title="Course" style="width:50px;"><center><?php echo $row['CourseLevel'];?></center> </td>
   
					<td data-title="Semester" style="width:100px;"><center><?php echo $row['Semester_id'];?></center> </td>
					<td data-title="Semester" style="width:100px;"><center><?php echo $row['ExtSemesterId'];?></center> </td>
   
        <td data-title="Division" style="width:100px;"><center><?php echo $row['Division_id'];?></center> </td>
   
					 <td data-title="Year" style="width:100px;"><center><?php echo $row['AcademicYear'];?></center> </td>
					  <?php }?>
                 </tr>
                <?php $i++;?>
                 <?php }?>
                  
		
		
        
          
    </tbody>
  </table>
  </div>
  </div>
 </div> 
 </div>
 <script type="text/javascript">
$(function(){
  $('#keywords').dataTable(); 
});
</script>
 
 <?php }else
 {?>
 
 <div class="container" style="padding-top:150px;">
 <div class="row">
 <div class="col-md-3"></div>
 
 <div class="col-md-6"  style=" border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4; background-color:#FFFFFF;color:#FF0000; font-weight:bold;" align="center" >
  <div style="height:20px;"></div>
 <?php echo "You do not have permission to Share blue Points !...  "?>
 <div style="height:20px;"></div>
 </div>
 
 
 
 
 </div>
 
 </div>
 
  <?php }
 ?>

</body>
</html>