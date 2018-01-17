<?php
include("smartcookiefunction.php");
include_once("header.php");

//echo "select * from tbl_user where t_email = '".$_SESSION['username']."' and t_password = '".$_SESSION['password']."'";
$query = mysql_query("select * from tbl_teacher where id = ".$_SESSION['id']);
$value = mysql_fetch_array($query);
$sc_id=$value['school_id'];

$t_id=$value['t_id'];

$report= "Could not find!!!!";

?>

<html>
<head>
<title>Info Table</title>
<link href='//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
<script src='//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js'></script>
<script>
$(document).ready(function(){
    $('#myTable').DataTable();
});
</script>
</head>
<body>
<div class="row">
<div class="col-md-10 col-md-offset-2">
<form method="post" >
<input type="text" name="studentid" width="100%" placeholder=" <?php echo $dynamic_student.' PRN';?>" value="<?php if(isset($_POST['studentid'])) { echo $_POST['studentid']; }?>">

<input type="text" name="stdname" width="50%"  placeholder=" <?php echo $dynamic_student.' Name';?>" value="<?php if(isset($_POST['stdname'])) { echo $_POST['stdname']; }?>">
<input type="text" name="schoolid" width="100%" placeholder=" <?php echo $school_type.' Id';?>" value="<?php if(isset($_POST['schoolid'])) { echo $_POST['schoolid']; }?>">
<input type="submit" value="display" name="submit">
</form>
</div>
</div>
</body>
</html>




<?php
if(isset($_POST['submit']))
{
$studentid = trim($_POST['studentid']);
//$subjectname = trim($_POST['subjectname']);
//$brancheid = trim($_POST['brancheid']);
$schoolid = trim ($_POST['schoolid']);
$stdname = trim($_POST['stdname']);


$query="SELECT  DISTINCT  s.school_id,s.std_PRN,s.std_complete_name,s.std_img_path FROM tbl_student  as s  ";

$query1 = " WHERE ";

if($studentid==''  & $schoolid=='' & $stdname =='' )
	{
		echo "<script>window.alert('please enter a field')</script>";
		echo "<script>window.location.assign('searchallstudent.php')</script>";
	}
else
{
	$f = 0;
	if($studentid!='')
		{
			$query1.="s.std_PRN like '%$studentid%'";
			$f = 1;
		}
	if($schoolid!='')
		{
			if($f==1)
				{
					$query1.= ' and ';
				}
			$query1.=" s.school_id like '%$schoolid%'";
			$f=1;
		}
	if($stdname!='')
		{
			if($f==1)
				{
					$query1.= ' and ';
				}
			$query1.="( s.std_complete_name like '%$stdname%' or s.std_name like '%$stdname%' or s.std_lastname like '%$stdname%' or s.std_Father_name like '%$stdname%' or s.std_complete_father_name like '%$stdname%'  )";
			$f=1;
		}

	$query_final=$query.$query1;
	//echo $query_final;die;
	//echo $query_final;
	$sql = mysql_query($query_final);

	//$result=mysql_fetch_array($sql,MYSQL_NUM);



	if(mysql_num_rows($sql)>0)
		{

			?>
	<div class="row">
<div class="col-md-10 col-md-offset-1">

<?php
			echo "<table id='myTable'>";
			echo "<thead><tr><th>Sr.No</th>";
			if($_SESSION['usertype']=='Manager')

			{
			echo "<th>Employee Id</th>";
			echo "<th>Organization Id</th>";

			echo "<th>Employee Name</th>";


			}
			else
			{

				echo "<th>Student Id</th>";


				echo "<th>School Id</th>";

				echo "<th>Student Name</th>";
				echo "<th>Assign Point</th>";
			}

			echo "</tr></thead><tbody>";










			$c = 1;
			while($rows = mysql_fetch_array($sql))
				{
					echo "<tr>";

					echo "<td>$c</td>";

					/*foreach($rows as $k=>$v)
						{	*/
?>

								<td><?php echo $rows['std_PRN']; ?></td>
                               <td><?php  echo $rows['school_id'];?></td>

                              <td><?php echo $rows['std_complete_name'];?></td>
                             <td> <a href="assign_point_another_student.php?id=<?php echo $rows['std_PRN'];?>&school_id=<?php echo $rows['school_id'];?>" style="text-decoration:none;"><input type="button" class="myButton" value="Assign" /></a></td>


 <?php

						//}

					//echo "<td><a href='assign_point.php?id=".$result['student_id']."'><input type='button' value='Assign' class='btn btn-primary'></a><td>";
				$c++;
				echo "</tr>";
				}
			echo "</tbody></table>";?>
			</div></div><?php
			}

	else
		{
			echo "<script>window.alert('No records found')</script>";
			echo "<script>window.location.assign('searchallstudent.php')</script>";
		}

}

}



?>
