<?php
$report="";
include('conn.php');
$id=$_SESSION['id'];
$sql=mysql_query("select school_id from tbl_school_admin where id='$id'");
$result=mysql_fetch_array($sql);
$sc_id=$result['school_id'];

if(isset($_POST['submit']))
{
		$semester=trim($_POST['semname']);
		$dept=$_POST['department'];
		$branch=$_POST['branch'];
		$isregular=$_POST['isregular'];
		$Semester_credit=$_POST['Semester_credit'];
		$isenable=$_POST['isenable'];
		$courselevel=trim($_POST['courselevel']);
		$id=$_POST['id'];
	
	if($id!="" && $semester!="" && $dept!="" && ($isregular==0 || $isregular==1)  && is_numeric($Semester_credit) && is_numeric($isenable)&& $branch!="")
	{
		
		
		
			//echo "update  tbl_semester_master set Department_Name='$dept',Semester_Name='$semester',Branch_name='$branch',Is_regular_semester='$isregular',Semester_credit='$Semester_credit',Is_enable='$isenable',CourseLevel='$courselevel',class='$class' where Semester_Id='$id' and school_id='$sc_id'";die;
			//echo "update  tbl_semester_master set school_id='55',Department_Name='$dept',Semester_Name='$semester',Branch_name='$branch',Is_regular_semester='$isregular',Semester_credit='$Semester_credit',Is_enable='$isenable',CourseLevel='$courselevel',class='$class' where Semester_Id='$id'";

			
		
			$row=mysql_query("update  tbl_semester_master set Department_Name='$dept',Semester_Name='$semester',Branch_name='$branch',Is_regular_semester='$isregular',Semester_credit='$Semester_credit',Is_enable='$isenable',CourseLevel='$courselevel',class='$class' where Semester_Id='$id' and school_id='$sc_id'");
		
		echo "<script>alert('Please enter all valid parameter')</script>";
	}
	header("location:editsemester.php?report=$report&id=$id");
}
?>

