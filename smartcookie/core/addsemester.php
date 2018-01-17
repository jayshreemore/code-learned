
<?php  include('scadmin_header.php');
$id=$_SESSION['id'];

$sql=mysql_query("select school_id from tbl_school_admin where id='$id'");
$result=mysql_fetch_array($sql);
$sc_id=$result['school_id'];


?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script>
function validation()
{
	var semname=document.getElementById("semname").value;
	var dept=document.getElementById("dept").value;
	var branch=document.getElementById("branch").value;
	
	var semester_credit=document.getElementById("Semester_credit").value;
	 regx=/^[0-9]*$/;
	
	if(semname=="")
	{
	document.getElementById("errorsemester").innerHTML="Please enter semester";	
		return false;
		
	}
	else
	{
		document.getElementById("errorsemester").innerHTML="";	
		
	}
	if(dept=="")
	{
	document.getElementById("errordept").innerHTML="Please select department";	
		return false;
		
	}
	else
	{
		document.getElementById("errordept").innerHTML="";	
		
	}
	if(branch=="")
	{
	document.getElementById("errorbranch").innerHTML="Please select branch";	
		return false;
		
	}
	else
	{
		document.getElementById("errorbranch").innerHTML="";	
		
	}
	var corselevel=document.getElementById("courselevel").value;
	if(corselevel=="")
	{
	document.getElementById("errorcourselevel").innerHTML="Please select courselevel";	
		return false;
		
	}
	else
	{
		document.getElementById("errorcourselevel").innerHTML="";	
		
	}
	
	
	if(document.getElementById("regular1").checked || document.getElementById("regular2").checked)
	{
	document.getElementById("errorisregular").innerHTML="";	
	
		
	}
	else
	{
		document.getElementById("errorisregular").innerHTML="select regular semester yes or no ";	
		return false;
	}
	
	 if(semester_credit=="")
	 {
			document.getElementById("errorsemestercredit").innerHTML="Enter semester credit";	
		return false;	
	 }
	if(!regx.test(semester_credit))
		{
			
		document.getElementById("errorsemestercredit").innerHTML="Enter valid semester credit";	
		return false;
		
	}
	else
	{
		document.getElementById("errorsemestercredit").innerHTML="";	
		
	}
	if(document.getElementById("isenable1").checked || document.getElementById("isenable2").checked)
	{
	document.getElementById("errorisenable").innerHTML="";	
		
		
	}
	else
	{
		document.getElementById("errorisenable").innerHTML="Please select isenable or not";	
		return false;
	}
	
}
</script>

<?php
$report="";
if(isset($_POST['submit']))
{
 $semester=trim($_POST['semname']);
	 $dept=$_POST['department'];
	 $branch=$_POST['branch'];
	 $isregular=$_POST['isregular'];
$Semester_credit=$_POST['Semester_credit'];
	 $isenable=$_POST['isenable'];
	 $courselevel=trim($_POST['courselevel']);
	if($semester!="" && $dept!="" && ($isregular==0 || $isregular==1)  && is_numeric($Semester_credit) && is_numeric($isenable)&& $branch!="")
	{
		$class="";
		
			
   $row=mysql_query("insert into tbl_semester_master(school_id,Department_Name,Semester_Name,Branch_name,Is_regular_semester,Semester_credit,Is_enable,CourseLevel,class) values('$sc_id','$dept','$semester','$branch','$isregular','$Semester_credit','$isenable','$courselevel','$class')");
	
	echo "<script>alert('Successfully added')</script>";
	}
	else
	{
		
		echo "<script>alert('Please enter all valid parameter')</script>";
	}
	
	
}
?>
 

</head>

<body>
<div class="container" style="padding:25px;"" >
        	<div class="container" style="padding:25px;">
        	
            
            	<div style="padding:2px 2px 2px 2px;border:1px solid #CCCCCC; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4; background-color:#F8F8F8 ;">
                   
                  <div style="color:#FC2338;font-size:16px;margin-top:10px;" align="center">  <?php echo $errorreport;?></div>
                   <div style="color:#090;font-size:16px;margin-top:10px;" align="center">  <?php echo $successeport;?></div>
                    
                 	<div style="margin-top:10px;" class="h1"><center>Add Semester</center></div>
                     <h5 align="center"><a href="addsemestersheet.php">Add Excel Sheet</a></h5>
                 
                   <form method="post" >
                     
                     <div class="row" >
<div class="col-md-2"></div>


<div class="col-md-4" style="color:#808080; font-size:18px;">
Semester Name</div><span style="color:red;font-size: 25px;">*</span>

<div class="col-md-4" >


<input class="form-control" name="semname" id="semname"  type="text">

</div>

<div class="col-md-3" style="color:#FF0000;"></div>
</div>
 <div class="row" >
<div class="col-md-6"></div>


<div class="col-md-4" style="color:#FC2338; font-size:18px;" id="errorsemester">

</div></div>
                      <div class="row" style="padding-top:10px;">
<div class="col-md-2"></div>


<div class="col-md-4" style="color:#808080; font-size:18px;">
Department Name</div><span style="color:red;font-size: 25px;">*</span>

<div class="col-md-4">
<select name="department" class="form-control " id="dept">
<option value="">Select</option>
<?php  $row=mysql_query("select * from tbl_department_master  where school_id='$sc_id' ");
while($value=mysql_fetch_array($row))
{
?>
<option value="<?php echo $value['Dept_Name'];?>"><?php echo $value['Dept_Name']?></option>
<?php }?>
</select>
</div>

<div class="col-md-3" style="color:#FF0000;"></div>
</div>
 <div class="row" >
<div class="col-md-6"></div>


<div class="col-md-6" style="color:#FC2338; font-size:18px;" id="errordept">

</div></div>
 
                <div class="row" style="padding-top:10px;">
<div class="col-md-2"></div>


<div class="col-md-4" style="color:#808080; font-size:18px;">
Branch Name</div><span style="color:red;font-size: 25px;">*</span>

<div class="col-md-4">
<select name="branch" class="form-control " id="branch">
<option value="">Select</option>
<?php  $row=mysql_query("select Branch_code,branch_Name from  tbl_branch_master  where school_id='$sc_id' ");
while($value=mysql_fetch_array($row))
{
?>
<option value="<?php echo $value['branch_Name'];?>"><?php echo $value['branch_Name']?></option>
<?php }?>
</select>
</div>
</div>

 <div class="row" >
<div class="col-md-6"></div>


<div class="col-md-6" style="color:#FC2338; font-size:18px;" id="errorbranch">

</div></div>
<div class="row" style="padding-top:10px;">
<div class="col-md-2"></div>


<div class="col-md-4" style="color:#808080; font-size:18px;">
Course level</div><span style="color:red;font-size: 25px;">*</span>

<div class="col-md-4">



<select name="courselevel" class="form-control " id="courselevel">
<option value="">Select</option>
  <?php 
			 $sql_course=mysql_query("select CourseLevel from tbl_CourseLevel where school_id='$sc_id' order by id");
			 while($result_course=mysql_fetch_array($sql_course))
			 {?>
				 <option value="<?php echo $result_course['CourseLevel']?>"><?php echo $result_course['CourseLevel']?></option>
				 <?php }
			 ?>
</select>
</div>
</div>

 <div class="row" >
<div class="col-md-6"></div>


<div class="col-md-6" style="color:#FC2338; font-size:18px;" id="errorcourselevel">

</div></div>

  

   <div class="row" style="margin-top:10px;">
<div class="col-md-2"></div>


<div class="col-md-4" style="color:#808080; font-size:18px;">
Is_regular_semester</div><span style="color:red;font-size: 25px;">*</span>


<div class="col-md-3">
Yes &nbsp;<input type="radio" name="isregular" value="1" id="regular1"/> &nbsp;
No &nbsp;<input type="radio" name="isregular" value="0" id="regular2"/>
</div>
</div>

 <div class="row" >
<div class="col-md-6"></div>


<div class="col-md-6" style="color:#FC2338; font-size:18px;" id="errorisregular">

</div></div>

 <div class="row" style="padding-top:20px;">
<div class="col-md-2"></div>


<div class="col-md-4" style="color:#808080; font-size:18px;">
Semester credit</div><span style="color:red;font-size: 25px;">*</span>

<div class="col-md-3">
<input class="form-control" name="Semester_credit" id="Semester_credit"  type="text">
</div>
</div>
 <div class="row" >
<div class="col-md-6"></div>


<div class="col-md-6" style="color:#FC2338; font-size:18px;" id="errorsemestercredit">

</div></div>
<div class="row" style="padding-top:10px;">
<div class="col-md-2"></div>


<div class="col-md-4" style="color:#808080; font-size:18px;">
Is Enabled</div><span style="color:red;font-size: 25px;">*</span>

<div class="col-md-3">
Yes&nbsp;&nbsp; <input type="radio" name="isenable" id="isenable1" value="1"> &nbsp;&nbsp;No&nbsp; &nbsp;&nbsp;<input type="radio" name="isenable"id="isenable2" value="0">
</div>
</div>

 <div class="row" >
<div class="col-md-6"></div>


<div class="col-md-6" style="color:#FC2338; font-size:18px;" id="errorisenable">

</div></div>





<div class="row" style="padding-top:10px;">
<div class="col-md-5"></div>

<div class="col-md-2"><input name="submit" value="Save" class="btn btn-success" type="submit" onClick="return validation()"></div>


<div class="col-md-2"><a href="list_semester.php"><input name="cancel" value="Cancel" class="btn btn-danger" type="button"></a></div>
</div>
                  
                 
                 <div class="row" style="padding-top:30px;"><center style="color:#006600;">
                 
                 </center>
                 </div>
                 
                    
                    </form>
                  
               </div>
               </div>
            
            	

</body>
</html>