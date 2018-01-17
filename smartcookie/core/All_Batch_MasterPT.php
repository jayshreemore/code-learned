<?php

$batch_id=$_GET['batch_id'];
$tbl_name=$_GET['table_name'];
$uploaded_records=$_GET['records_size'];


if($tbl_name=='Teacher_Master')
{

	
include_once("scadmin_header.php");
$id=$_SESSION['id'];
           $fields=array("id"=>$id);
	       $table="tbl_school_admin";
		   
		   $smartcookie=new smartcookie();
		   
$results=$smartcookie->retrive_individual($table,$fields);
$result=mysql_fetch_array($results);
$sc_id=$result['school_id'];

?>
<html>
<head>
<style>
.dropdown {
    
    display: -webkit-flex; /* Safari */
    -webkit-align-items: center; /* Safari 7.0+ */
    display: flex;
    align-items: center;
}
.list-inline
{
display: inline-block; }
.dropdown{padding-left:600px;margin-top:15px;margin-bottom:30px;}
.panel-heading{margin-top:5px;}
.dropdown1{
	padding-left:710px;margin-top:15px;}



  </style>


</style>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src='js/bootstrap.min.js' type='text/javascript'></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.cs">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<title>Report Analysis::SMART COOKIES</title>
</head>

<div class="panel panel-default"><br>
  <!-- Default panel contents -->
  <div class="panel-heading" align="center"><b>Teacher Master Report</b></div><br>
  
  <!--                   ---------------- dropdown list                -- -->
  <div class="row">
  <div class="col-md-4">
<div class="dropdown1">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
Batch ID's
    <span class="caret"></span>
  </button>
  <?php $sql1=mysql_query("Select batch_id from tbl_raw_teacher where t_school_id='$sc_id' group by batch_id" );?>
  <ul class="dropdown-menu " role="menu" aria-labelledby="dropdownMenu1">
     <?php while($row=mysql_fetch_array($sql1)){ ?>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="teacher_report_PT.php?batch_id=<?php echo $row['batch_id'];?>"><?php echo $row['batch_id'];?><?php }?></a></li>
    
   
  </ul>
</div>
</div>
<!--                           End of dropdown ----------------------- --- -->
<br><br><br>
  <!-- Table -->
  
 <p><table border="1" align="center" width="450" height="300">
  <tr>
    <td align="center"><b>Report for <?php echo $batch_id ?></b></td>
    <td align="center"><b>No of Count</b></td>
  </tr>
  
  <!--   --------------               first row  ------------------------------------- -->
  <tr>
    <td align="center">No. of Records</td>
     <?php $Recordscount=mysql_query("select no_record_uploaded from  tbl_raw_teacher where batch_id='$batch_id'");
		            $Noofrecordcount=mysql_num_rows($Recordscount);
					$row=mysql_fetch_array($Noofrecordcount);
					 $uploaded=$row['no_record_uploaded'];
		 ?>
         
    <td align="center"><a href="#"><?=$Noofrecordcount?></a></td>
    
  </tr>
  <!--   ----------------      End of row ------------------------------------------------------ -->
  
  
  <!--   --------------               second row  ------------------------------------- -->
  <tr>
    <td align="center">Duplicate Records</td>
     <?php $Duplicate=mysql_query("select * from  tbl_raw_teacher where `error_records`='Duplicate' and batch_id='$batch_id'");
		            $Duplicatecount=mysql_num_rows($Duplicate);
					$row=mysql_fetch_array($Duplicate);
					 $duplicate=$row['error_records'];
		 ?>
         <?php
             if($duplicate=="Duplicate")
			 {
		 ?>
    <td align="center"><a href="show_report_teacher_PT.php?error=<?=$duplicate?>&batch_id=<?php echo $batch_id;?>"><?=$Duplicatecount?></a></td>
    <?php
           } 
		   else
		    {
			?> <td align="center"><?=$Duplicatecount?></a></td>
    <?php 
	 }
	?>
  </tr>
  <!--   ----------------      End of row ------------------------------------------------------ -->
  
   <tr>
        <td align="center">Error Records</td>
        <?php $teacher=mysql_query("select * from `tbl_raw_teacher` where (error_records like 'Err-Tid' OR error_records like 'Err-Name') and batch_id='$batch_id'");
		            $techercount=mysql_num_rows($teacher);
					$row1=mysql_fetch_array($teacher);
					 $teacher1=$row1['error_records'];
		 ?>
         <?php
             if($teacher1=="Err-Tid" || $teacher1=="Err-Name")
			 {
		 ?>
    <td align="center"><a href="show_error_report_teacher_PT.php?batch_id=<?php echo $B_id;?>"><?=$techercount?></a></td>
    <?php
           } 
		   else
		    {
			?> <td align="center"><?=$techercount?></a></td>
    <?php 
	 }
	?>
       
      </tr>
  
   


</table>
<br><br>
<?php
include"footer.php";
?>

                   

</div>
</body>
</html>

<?php } 


else if($tbl_name=='Student_Master')
{

include_once("scadmin_header.php");
$id=$_SESSION['id'];
           $fields=array("id"=>$id);
	       $table="tbl_school_admin";
		   
		   $smartcookie=new smartcookie();
		   
$results=$smartcookie->retrive_individual($table,$fields);
$result=mysql_fetch_array($results);
$sc_id=$result['school_id'];


/* $limit=mysql_query("select no_record_uploaded from tbl_raw_student where batch_id='$batch_id' and s_school_id='$sc_id'");
		            
					$row1=mysql_fetch_array($limit);
		
			$no_of_records=$row1['no_record_uploaded'];
			if($uploaded_records==$no_of_records)
			{	 */	
?>
<html>
<head>
<style>
.dropdown {
    
    display: -webkit-flex; /* Safari */
    -webkit-align-items: center; /* Safari 7.0+ */
    display: flex;
    align-items: center;
}
.list-inline
{
display: inline-block; }
.dropdown{padding-left:600px;margin-top:15px;margin-bottom:30px;}
.panel-heading{margin-top:5px;}
.dropdown1{padding-left:710px;margin-top:15px;}



  </style>


</style>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src='js/bootstrap.min.js' type='text/javascript'></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.cs">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<title>Report Analysis::SMART COOKIES</title>
</head>

<div class="panel panel-default"><br>
  <!-- Default panel contents -->
  <div class="panel-heading" align="center"><b>Student Master Report</b></div><br>

  <div class="row">
  <div class="col-md-4">
<div class="dropdown1">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
Batch ID's
    <span class="caret"></span>
  </button>
  <?php $sql1=mysql_query("Select batch_id from tbl_raw_student where s_school_id='$sc_id' group by batch_id" );?>
  <ul class="dropdown-menu " role="menu" aria-labelledby="dropdownMenu1">
     <?php while($row=mysql_fetch_array($sql1)){ ?>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="student_report_PT.php?batch_id=<?php echo $row['batch_id'];?>"><?php echo $row['batch_id'];?><?php }?></a></li>
    
   
  </ul>
</div>
</div>
<!--                           End of dropdown ----------------------- --- -->
<br><br><br>
  
  <!-- Table -->
  
 <p><table border="1" align="center" width="450" height="300">
  <tr>
    <td align="center"><b>Report for <?php echo $batch_id ?></b></td>
    <td align="center"><b>No of Count</b></td>
  </tr>
  
  <!--   --------------               first row  ------------------------------------- -->
  <tr>
    <td align="center">No. of Records</td>
     <?php $Recordscount=mysql_query("select no_record_uploaded from  tbl_raw_student where batch_id='$batch_id' and s_school_id='$sc_id'");
		            $Noofrecordcount=mysql_num_rows($Recordscount);
					$row=mysql_fetch_array($Noofrecordcount);
					 $uploaded=$row['no_record_uploaded'];
		 ?>
         
    <td align="center"><a href="#"><?=$Noofrecordcount?></a></td>
    
  </tr>
  <!--   ----------------      End of row ------------------------------------------------------ -->
  
  
  
  <tr>
    <td align="center">Duplicate Record</td>
     <?php $Duplicate=mysql_query("select * from  tbl_raw_student where `error_records`='Duplicate' and batch_id='$batch_id' and s_school_id='$sc_id'");
		            $Duplicatecount=mysql_num_rows($Duplicate);
					$row=mysql_fetch_array($Duplicate);
					 $duplicate=$row['error_records'];
		 ?>
         <?php
             if($duplicate=="Duplicate")
			 {
		 ?>
    <td align="center"><a href="show_report_student_PT.php?error=<?=$duplicate?>&batch_id=<?php echo $batch_id;?>"><?=$Duplicatecount?></a></td>
    <?php
           } 
		   else
		    {
			?> <td align="center"><?=$Duplicatecount?></a></td>
    <?php 
	 }
	?>
  </tr>
   <tr>
        <td align="center">Error Records</td>
        <?php $teacher=mysql_query("select * from tbl_raw_student where (error_records like 'Err-SPRN' OR error_records like 'Err-Name') and batch_id='$batch_id' and s_school_id='$sc_id'");
		            $studentcount=mysql_num_rows($teacher);
					$row1=mysql_fetch_array($teacher);
					$student1=$row1['error_records'];
		 ?>
         <?php
             if($student1=="Err-SPRN" || $student1=="Err-Name")
			 {
		 ?>
    <td align="center"><a href="show_error_report_student_PT.php?batch_id=<?php echo $batch_id;?>"><?=$studentcount?></a></td>
    <?php
           } 
		   else
		    {
			?> <td align="center"><?=$studentcount?></a></td>
			<?php 
			 }
			?>
       
      </tr>
 
    
	
</div>
<?php
include"footer.php";
?>

<?php }

 
else if($tbl_name=='Student_Subject')
{

include_once("scadmin_header.php");?>


<div class="panel panel-default"><br>
  <!-- Default panel contents -->
  <div class="panel-heading" align="center"><b>Student Subject Report</b></div><br>

  <!-- Table -->
  
 <p><table border="1" align="center" width="450" height="300">
  <tr>
    <td align="center"><b>Report Name</b></td>
    <td align="center"><b>No of Count</b></td>
  </tr>
  <tr>
    <td align="center">Duplicate Reocrd</td>
     <?php $Duplicate=mysql_query("select * from  tbl_student_subject where status='duplicate' and batch_id='$batch_id'");
		            $Duplicatecount=mysql_num_rows($Duplicate);
					$row=mysql_fetch_array($Duplicate);
					$duplicate1=$row['status'];
		 ?>
      <?php
             if($duplicate1=="duplicate")
			 {
		 ?>
    <td align="center"><a href="showreportstudent.php?error=<?=$duplicate1?>"><?=$Duplicatecount?></a></td>
    <?php
           } 
		   else
		    {
			?> <td align="center"><?=$Duplicatecount?></a></td>
    <?php 
	 }
	?>
  </tr>
   </tr>
        <td align="center">Student Not Match</td>
        <?php $teacher=mysql_query("select * from tbl_student_subject where status='Teacher_id Not Match' and batch_id='$batch_id'");
		            $techercount=mysql_num_rows($teacher);
					$row1=mysql_fetch_array($teacher);
					 $teacher1=$row1['status'];
		 ?>
      <?php
             if($teacher1=="Teacher_id Not Match")
			 {
		 ?>
    <td align="center"><a href="showreportstudent.php?error=<?=$teacher1?>"><?=$techercount?></a></td>
    <?php
           } 
		   else
		    {
			?> <td align="center"><?=$techercount?></a></td>
    <?php 
	 }
	?>
      </tr>
  <tr>
    <td align="center">Subject Not Match</td>
    <?php $subject=mysql_query("select * from tbl_student_subject where status='Subject Code' and batch_id='$batch_id'");
		            $subjecttecount=mysql_num_rows($subject);
					$row2=mysql_fetch_array($subject);
				$subject2=$row2['status'];
					
		 ?>
    <?php
             if($subject2=="Subject Code")
			 {
		 ?>
    <td align="center"><a href="showreportstudent.php?error=<?=$subject2?>"><?=$subjecttecount?></a></td>
    <?php
           } 
		   else
		    {
			?> <td align="center"><?=$subjecttecount?></a></td>
    <?php 
	 }
	?>
  </tr>
  <tr>
   <!-- <td align="center">Update Record</td>
     <?php //$updated=mysql_query("select status from tbl_student_subject where status='duplicate'");
		           // $updatedcount=mysql_num_rows($updated);
					 
					
		 ?>
    <td align="center"><a href="showreport.php?id=<>"><?//=$updatedcount?></a></td>
  </tr>-->
</table>

<!-- <table border="1">
                     <tr ><th><b>Teacher Not Match</b></th><th>Subject Not Match</th><th>Duplicate Record</th><th>Updated Record</th>
                        </thead><tbody>
                 
                    <tr>
                    <td data-title="Sr.No" ><b>22</b></td>
					<td data-title="Teacher ID" ><b>222</b></td>
                    <td data-title="Name" >333</td> 
                   
                   
                   </td>
                   </tr>
                   </thead>
                   <tbody>
                   
</table>-->
</div>
<?php
include"footer.php";
?>	
	
<?php } 

 
else
{

include_once("scadmin_header.php");?>


<div class="panel panel-default"><br>
  <!-- Default panel contents -->
  <div class="panel-heading" align="center"><b>Teacher Subject Report</b></div><br>

  <!-- Table -->
  
 <p><table border="1" align="center" width="450" height="300">
  <tr>
    <td align="center"><b>Report Name</b></td>
    <td align="center"><b>No of Count</b></td>
  </tr>
  <tr>
    <td align="center">Duplicate Reocrd</td>
     <?php $Duplicate=mysql_query("select * from tbl_teachr_subject_row where status='duplicate' and batch_id='$batch_id'");
		            $Duplicatecount=mysql_num_rows($Duplicate);
					$row=mysql_fetch_array($Duplicate);
					 $duplicate=$row['status'];
		 ?>
         <?php
             if($duplicate=="duplicate")
			 {
		 ?>
    <td align="center"><a href="showreportteacher.php?error=<?=$duplicate?>"><?=$Duplicatecount?></a></td>
    <?php
           } 
		   else
		    {
			?> <td align="center"><?=$Duplicatecount?></a></td>
    <?php 
	 }
	?>
  </tr>
   </tr>
        <td align="center">Teacher Not Match</td>
        <?php $teacher=mysql_query("select * from tbl_teachr_subject_row where status='Teacher_id Not Match' and batch_id='$batch_id'");
		            $techercount=mysql_num_rows($teacher);
					$row1=mysql_fetch_array($teacher);
					 $teacher1=$row1['status'];
		 ?>
         <?php
             if($teacher1=="Teacher_id Not Match")
			 {
		 ?>
    <td align="center"><a href="showreportteacher.php?error=<?=$teacher1?>"><?=$techercount?></a></td>
    <?php
           } 
		   else
		    {
			?> <td align="center"><?=$techercount?></a></td>
    <?php 
	 }
	?>
       
      </tr>
  <tr>
    <td align="center">Subject Not Match</td>
    <?php $subject=mysql_query("select * from tbl_teachr_subject_row where status='Subject Code' and batch_id='$batch_id'");
		            $subjecttecount=mysql_num_rows($subject);
					$row2=mysql_fetch_array($subject);
					 $subject2=$row2['status'];
		 ?>
         <?php
             if($subject2=="Subject Code")
			 {
		 ?>
    <td align="center"><a href="showreportteacher.php?error=<?=$subject2?>"><?=$subjecttecount?></a></td>
    <?php
           } 
		   else
		    {
			?> <td align="center"><?=$subjecttecount?></a></td>
    <?php 
	 }
	?>
   
  </tr>
<!--  <tr>
  <td align="center">Update Record</td>
     <?php //$updated=mysql_query("select status from tbl_teachr_subject_row where status='duplicate'");
		            //$updatedcount=mysql_num_rows($updated);
					 
					
		 ?>
    <td align="center"><a href="showreport.php?id=<>"><?//=$updatedcount?></a></td>
  </tr>-->
</table>

<!-- <table border="1">
                     <tr ><th><b>Teacher Not Match</b></th><th>Subject Not Match</th><th>Duplicate Record</th><th>Updated Record</th>
                        </thead><tbody>
                 
                    <tr>
                    <td data-title="Sr.No" ><b>22</b></td>
					<td data-title="Teacher ID" ><b>222</b></td>
                    <td data-title="Name" >333</td> 
                   
                   
                   </td>
                   </tr>
                   </thead>
                   <tbody>
                   
</table>-->
</div>
<?php
include"footer.php";
?>	
	
<?php } ?>	
	
	

	




