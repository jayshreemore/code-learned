
<?php
 include("conn.php");
$id=$_SESSION['id'];

$sql=mysql_query("select school_id from tbl_school_admin where id='$id'");
$result=mysql_fetch_array($sql);
$sc_id=$result['school_id'];

switch($_GET['fn']){
	
	
	
	case 'fun_course':
		$row=mysql_query("select `Dept_Name` from  tbl_department_master where school_id='$sc_id' order by id"); 
			echo "<option>select</option>";
		  while($val=mysql_fetch_array($row))
		  {
		  	  echo "<option value='$val[Dept_Name]'> $val[Dept_Name]</option>";
		   }
		  
		break;	
		
		
		case 'fun_dept':
		$row=mysql_query("select distinct Branch_name from  tbl_semester_master where Department_Name='".$_GET['value']."' and school_id='$sc_id' and Is_enable='1' "); 
			echo "<option>select</option>";
		  while($val=mysql_fetch_array($row))
		  {
		  	  echo "<option value='$val[Branch_name]'> $val[Branch_name]</option>";
		   }
		  
		break;	
		
		case 'fun_branch':		
		$row=mysql_query("select distinct Semester_Name from  tbl_semester_master where Branch_name='".$_GET['value']."' and school_id='$sc_id' and Is_enable='1' "); 
			echo "<option>select</option>";
		  while($val=mysql_fetch_array($row))
		  {
		  	  echo "<option value='$val[Semester_Name]'> $val[Semester_Name]</option>";
		   }
		  
		break;	
		
		
		case 'fun_subject':
		
		$row=mysql_query("select distinct Subject_Code from   tbl_school_subject where subject='".$_GET['value']."' and school_id='$sc_id'"); 
		echo "<option>select</option>";
		  while($val=mysql_fetch_array($row))
		  {
		  	  echo "<option value='$val[Subject_Code]'> $val[Subject_Code]</option>";
		   }
		  
		break;	


		
}






 




?>
