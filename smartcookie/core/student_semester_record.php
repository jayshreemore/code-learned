<?php
error_reporting(0);
include('scadmin_header.php');?>

<?php
$report="";

/*$id=$_SESSION['id']; */
           $fields=array("id"=>$id);
		  /* $table="tbl_school_admin";  */
		   
		   $smartcookie=new smartcookie();
		   
$results=$smartcookie->retrive_individual($table,$fields);
$result=mysql_fetch_array($results);

$sc_id=$result['school_id'];

if(isset($_POST['submit']))
{
	$info=$_POST['info'];
	if($info==1)
	{
	$arr="SELECT DISTINCT std.std_PRN, std.std_name, std.std_Father_name, std.std_lastname, std.std_complete_name, semester.student_id, semester.SemesterName, semester.BranchName, semester.Specialization, semester.DeptName, semester.CourseLevel, semester.DivisionName, semester.AcdemicYear FROM StudentSemesterRecord  semester JOIN tbl_student std ON std.std_PRN = semester.student_id JOIN tbl_academic_Year a ON semester.ExtYearID=a.ExtYearID where semester.school_id='$sc_id' and std.school_id='$sc_id' and semester.`IsCurrentSemester`='1' and a.Enable='1' and a.school_id='$sc_id' ORDER BY std.std_name,std.std_complete_name";
		
	}
	
	
	if($info==2)
	{
		$arr="SELECT DISTINCT std.std_PRN, std.std_name, std.std_Father_name, std.std_lastname, std.std_complete_name, semester.student_id, semester.SemesterName, semester.BranchName, semester.Specialization, semester.DeptName, semester.CourseLevel, semester.DivisionName, semester.AcdemicYear FROM StudentSemesterRecord  semester JOIN tbl_student std ON std.std_PRN = semester.student_id JOIN tbl_academic_Year a ON semester.ExtYearID=a.ExtYearID where semester.school_id='$sc_id' and std.school_id='$sc_id' and a.school_id='$sc_id' ORDER BY std.std_name,std.std_complete_name";
	}
	
	if($info==3)
	{
		$arr="SELECT DISTINCT std.std_PRN, std.std_name, std.std_Father_name, std.std_lastname, std.std_complete_name, semester.student_id, semester.SemesterName, semester.BranchName, semester.Specialization, semester.DeptName, semester.CourseLevel, semester.DivisionName, semester.AcdemicYear FROM StudentSemesterRecord  semester JOIN tbl_student std ON std.std_PRN = semester.student_id JOIN tbl_academic_Year a ON semester.ExtYearID=a.ExtYearID where semester.school_id='$sc_id' and std.school_id='$sc_id' and semester.`IsCurrentSemester`='1' and a.Enable='1' and semester.SemesterName='Semester I'and a.school_id='$sc_id' ORDER BY std.std_name,std.std_complete_name";
		
		/*$arr="SELECT  DISTINCT std.std_PRN, std.std_name, std.std_Father_name, std.std_lastname, std.std_complete_name, semester.student_id, semester.SemesterName, semester.BranchName, semester.Specialization, semester.DeptName, semester.CourseLevel, semester.DivisionName, semester.AcdemicYear FROM StudentSemesterRecord  semester JOIN tbl_student  std ON std.std_PRN = semester.student_id JOIN tbl_academic_Year a ON semester.AcdemicYear=a.Year where semester.school_id='$sc_id' and std.school_id='$sc_id' and semester.`IsCurrentSemester`='1' and a.Enable='1' and a.school_id='$sc_id'and semester.SemesterName='Semester I' ORDER BY std.std_name,std.std_complete_name";*/
	}
	if($info==4)
	{
		
		$arr="SELECT DISTINCT std.std_PRN, std.std_name, std.std_Father_name, std.std_lastname, std.std_complete_name, semester.student_id, semester.SemesterName, semester.BranchName, semester.Specialization, semester.DeptName, semester.CourseLevel, semester.DivisionName, semester.AcdemicYear FROM StudentSemesterRecord  semester JOIN tbl_student std ON std.std_PRN = semester.student_id JOIN tbl_academic_Year a ON semester.ExtYearID=a.ExtYearID where semester.school_id='$sc_id' and std.school_id='$sc_id' and semester.`IsCurrentSemester`='1' and a.Enable='1' and semester.SemesterName='Semester II'and a.school_id='$sc_id' ORDER BY std.std_name,std.std_complete_name";
		/*$arr="SELECT DISTINCT std.std_PRN, std.std_name, std.std_Father_name, std.std_lastname, std.std_complete_name, semester.student_id, semester.SemesterName, semester.BranchName, semester.Specialization, semester.DeptName, semester.CourseLevel, semester.DivisionName, semester.AcdemicYear FROM StudentSemesterRecord  semester JOIN tbl_student  std ON std.std_PRN = semester.student_id JOIN tbl_academic_Year a ON semester.AcdemicYear=a.Year where semester.school_id='$sc_id' and std.school_id='$sc_id' and semester.`IsCurrentSemester`='1' and a.Enable='1' and a.school_id='$sc_id'and semester.SemesterName='Semester II' ORDER BY std.std_name,std.std_complete_name";*/
	}
	if($info==5)
	{
		$arr="SELECT DISTINCT std.std_PRN, std.std_name, std.std_Father_name, std.std_lastname, std.std_complete_name, semester.student_id, semester.SemesterName, semester.BranchName, semester.Specialization, semester.DeptName, semester.CourseLevel, semester.DivisionName, semester.AcdemicYear FROM StudentSemesterRecord  semester JOIN tbl_student std ON std.std_PRN = semester.student_id JOIN tbl_academic_Year a ON semester.ExtYearID=a.ExtYearID where semester.school_id='$sc_id' and std.school_id='$sc_id' and semester.`IsCurrentSemester`='1' and a.Enable='1' and semester.SemesterName='Semester III'and a.school_id='$sc_id' ORDER BY std.std_name,std.std_complete_name";
		
		/*$arr="SELECT DISTINCT std.std_PRN, std.std_name, std.std_Father_name, std.std_lastname, std.std_complete_name, semester.student_id, semester.SemesterName, semester.BranchName, semester.Specialization, semester.DeptName, semester.CourseLevel, semester.DivisionName, semester.AcdemicYear FROM StudentSemesterRecord  semester JOIN tbl_student  std ON std.std_PRN = semester.student_id JOIN tbl_academic_Year a ON semester.AcdemicYear=a.Year where semester.school_id='$sc_id' and std.school_id='$sc_id' and semester.`IsCurrentSemester`='1' and a.Enable='1' and a.school_id='$sc_id'and semester.SemesterName='Semester III' ORDER BY std.std_name,std.std_complete_name";*/
	}
	if($info==6)
	{
		
		$arr="SELECT DISTINCT std.std_PRN, std.std_name, std.std_Father_name, std.std_lastname, std.std_complete_name, semester.student_id, semester.SemesterName, semester.BranchName, semester.Specialization, semester.DeptName, semester.CourseLevel, semester.DivisionName, semester.AcdemicYear FROM StudentSemesterRecord  semester JOIN tbl_student std ON std.std_PRN = semester.student_id JOIN tbl_academic_Year a ON semester.ExtYearID=a.ExtYearID where semester.school_id='$sc_id' and std.school_id='$sc_id' and semester.`IsCurrentSemester`='1' and a.Enable='1' and semester.SemesterName='Semester IV'and a.school_id='$sc_id' ORDER BY std.std_name,std.std_complete_name";
		
		/*$arr="SELECT DISTINCT std.std_PRN, std.std_name, std.std_Father_name, std.std_lastname, std.std_complete_name, semester.student_id, semester.SemesterName, semester.BranchName, semester.Specialization, semester.DeptName, semester.CourseLevel, semester.DivisionName, semester.AcdemicYear FROM StudentSemesterRecord  semester JOIN tbl_student  std ON std.std_PRN = semester.student_id JOIN tbl_academic_Year a ON semester.AcdemicYear=a.Year where semester.school_id='$sc_id' and std.school_id='$sc_id' and semester.`IsCurrentSemester`='1' and a.Enable='1' and a.school_id='$sc_id'and semester.SemesterName='Semester IV' ORDER BY std.std_name,std.std_complete_name";*/
	}
	if($info==7)
	{
		$arr="SELECT DISTINCT std.std_PRN, std.std_name, std.std_Father_name, std.std_lastname, std.std_complete_name, semester.student_id, semester.SemesterName, semester.BranchName, semester.Specialization, semester.DeptName, semester.CourseLevel, semester.DivisionName, semester.AcdemicYear FROM StudentSemesterRecord  semester JOIN tbl_student std ON std.std_PRN = semester.student_id JOIN tbl_academic_Year a ON semester.ExtYearID=a.ExtYearID where semester.school_id='$sc_id' and std.school_id='$sc_id' and semester.`IsCurrentSemester`='1' and a.Enable='1' and semester.SemesterName='Semester V'and a.school_id='$sc_id' ORDER BY std.std_name,std.std_complete_name";
		/*$arr="SELECT DISTINCT std.std_PRN, std.std_name, std.std_Father_name, std.std_lastname, std.std_complete_name, semester.student_id, semester.SemesterName, semester.BranchName, semester.Specialization, semester.DeptName, semester.CourseLevel, semester.DivisionName, semester.AcdemicYear FROM StudentSemesterRecord  semester JOIN tbl_student  std ON std.std_PRN = semester.student_id JOIN tbl_academic_Year a ON semester.AcdemicYear=a.Year where semester.school_id='$sc_id' and std.school_id='$sc_id' and semester.`IsCurrentSemester`='1' and a.Enable='1' and a.school_id='$sc_id'and semester.SemesterName='Semester V' ORDER BY std.std_name,std.std_complete_name";*/
	}
	if($info==8)
	{
		
		$arr="SELECT DISTINCT std.std_PRN, std.std_name, std.std_Father_name, std.std_lastname, std.std_complete_name, semester.student_id, semester.SemesterName, semester.BranchName, semester.Specialization, semester.DeptName, semester.CourseLevel, semester.DivisionName, semester.AcdemicYear FROM StudentSemesterRecord  semester JOIN tbl_student std ON std.std_PRN = semester.student_id JOIN tbl_academic_Year a ON semester.ExtYearID=a.ExtYearID where semester.school_id='$sc_id' and std.school_id='$sc_id' and semester.`IsCurrentSemester`='1' and a.Enable='1' and semester.SemesterName='Semester VI'and a.school_id='$sc_id' ORDER BY std.std_name,std.std_complete_name";
		/*$arr="SELECT DISTINCT std.std_PRN, std.std_name, std.std_Father_name, std.std_lastname, std.std_complete_name, semester.student_id, semester.SemesterName, semester.BranchName, semester.Specialization, semester.DeptName, semester.CourseLevel, semester.DivisionName, semester.AcdemicYear FROM StudentSemesterRecord  semester JOIN tbl_student  std ON std.std_PRN = semester.student_id JOIN tbl_academic_Year a ON semester.AcdemicYear=a.Year where semester.school_id='$sc_id' and std.school_id='$sc_id' and semester.`IsCurrentSemester`='1' and a.Enable='1' and a.school_id='$sc_id' and semester.SemesterName='Semester VI' ORDER BY std.std_name,std.std_complete_name";*/
	}
	
	
	
}
else
{
	$arr="SELECT DISTINCT std.std_PRN, std.std_name, std.std_Father_name, std.std_lastname, std.std_complete_name, semester.student_id, semester.SemesterName, semester.BranchName, semester.Specialization, semester.DeptName, semester.CourseLevel, semester.DivisionName, semester.AcdemicYear FROM StudentSemesterRecord  semester JOIN tbl_student std ON std.std_PRN = semester.student_id JOIN tbl_academic_Year a ON semester.ExtYearID=a.ExtYearID where semester.school_id='$sc_id' and std.school_id='$sc_id' and semester.`IsCurrentSemester`='1' and a.Enable='1' and a.school_id='$sc_id' ORDER BY std.std_name,std.std_complete_name";

}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">

<title>Untitled Document</title>
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
        	
            
            	<div style="padding:2px 2px 2px 2px;border:1px solid #CCCCCC; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4; width:107%;">
                   
                    
                    <div style="background-color:#F8F8F8 ;">
                    <div class="row">
                    <div class="col-md-3 "  style="color:#700000 ;padding:5px;" >&nbsp;&nbsp;&nbsp;&nbsp;
                 <!--      <a href="add_school_subject.php">   <input type="submit" class="btn btn-primary" name="submit" value="Add Subject" style="width:110px;font-weight:bold;font-size:14px;"/></a>-->
               			 </div>
              			 <div class="col-md-6 " align="center"  >
                         	
                   				<h2>Student Semester Records</h2>
               			 </div>
                         
                     </div>
                  
                  <div class="row" align="center" style="margin-top:3%;">
				  <form method="post">
				    <div class="col-md-3"></div>
				  <div class="col-md-2">Select Semester</div>
				  
				  <div class="col-md-3">
				  <select name="info" class="form-control">
				  
				  <option value="1" <?php if(isset($_POST['info'])){ if($_POST['info']==1)?> selected <?php } ?>>Current</option>
				  <option value="2" <?php if(isset($_POST['info'])){ if($_POST['info']==2)?> selected <?php } ?>>All</option>
                  
                  <option value="3" <?php if(isset($_POST['info'])){ if($_POST['info']==3)?> selected <?php } ?>>Semester I</option>
                  <option value="4" <?php if(isset($_POST['info'])){ if($_POST['info']==4)?> selected <?php } ?>>Semester II</option>
                  <option value="5" <?php if(isset($_POST['info'])){ if($_POST['info']==5)?> selected <?php } ?>>Semester III</option>
                  <option value="6" <?php if(isset($_POST['info'])){ if($_POST['info']==6)?> selected <?php } ?>>Semester IV</option>
                  <option value="7" <?php if(isset($_POST['info'])){ if($_POST['info']==7)?> selected <?php } ?>>Semester V</option>
                  <option value="8" <?php if(isset($_POST['info'])){ if($_POST['info']==8)?> selected <?php } ?>>Semester VI</option>
				  </select>
				  </div>
				  <div class="col-md-2">
				  <input type="submit" name="submit" value="Submit" class="btn btn-success">
				  </div>
				  
				  
				  </form>
				  </div>
                   
                  
               <div class="row" style="margin-top:3%;">

               <div class="col-md-0">
               </div>
              <div class="col-md-12" id="no-more-tables" >
               <?php $i=0;?>
                   <table id="example" class="display" width="100%" cellspacing="0">
                     <thead>
					    <tr >
						<th  ><center>Sr.No</center></th>
                        <th ><center>Student Name</center></th>
						<th ><center>Student PRN</center></th>
                        <th ><center>Branch Name</center></th>
						<th><center>Specialization</center></th>
						<th ><center>Department Name</center></th>
						<th><center>Course Level</center></th>
						<th><center>Semester Name</center></th>
						<th><center>Division Name</center></th>
						<th><center>Academic Year</center></th>
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
				       $fullName=ucwords(strtolower($row['std_name']." ".$row['std_Father_name']." ".$row['std_lastname']));
				  ?>
				  
				  <tr class="active" 
				  onmouseover="this.style.cursor='pointer';this.style.textDecoration='underline';this.style.color='dodgerblue'"
				  onmouseout="this.style.textDecoration='none';this.style.color='black';" 
				  onclick="window.location='studentinformation.php?id=<?php echo $row['student_id'];?>'" 
				  style="cursor: pointer; text-decoration: underline; color: dodgerblue; background-color: rgb(239, 243, 251);height:30px;color:#808080;"
				>

                    <td data-title="Sr.No"><b><center><?php echo $i;?></center></b></td>
                    <td data-title="Student PRN" ><center><?php
															//$std_PRN=$row['student_id'];
															$std_name=$row['std_complete_name']; 
															if($std_name=="")
															 {
															 echo ucwords(strtolower($row['std_name']." ".$row['std_Father_name']." ".$row['std_lastname']));
															 }
															 else
															 {
															 echo $std_name;
															 }
															 ?></center></td>
					<td data-title="Student PRN" ><center><?php echo $row['student_id'];?> </center></td>

					<td data-title="Student Name" ><center><?php echo $row['BranchName'];?></center> </td>
					<td data-title="Fathers Name" ><center><?php echo $row['Specialization'];?></center> </td>
					<td data-title="Email ID" ><center><?php echo $row['DeptName'];?></center> </td>
					<td data-title="Phone" ><center><?php echo $row['CourseLevel'];?></center> </td>
					<td data-title="Occupation" ><center><?php echo $row['SemesterName'];?></center> </td>
                    <td data-title="Family Income" ><center><?php echo $row['DivisionName'];?></center> </td>
					 <td data-title="Family Income" ><center><?php echo $row['AcdemicYear'];?></center> </td>
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
