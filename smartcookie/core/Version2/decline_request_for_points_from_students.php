<?php
$json = file_get_contents('php://input');
$obj = json_decode($json);
include('conn.php');

	$t_id = $obj->{'t_id'};
	$school_id = $obj->{'school_id'};
	$student_id = $obj->{'student_PRN'};
	$reason_id=$obj->{'reason_id'};
	$accept_date=Date('d/m/Y');



	if($t_id!='' && $school_id!='' && $reason_id!='' && $student_id!='')
	{
		$sql2=mysql_query("update tbl_request set flag='P' where stud_id1='$student_id' and stud_id2='$t_id' and entitity_id='103' and flag='N' and reason like '$reason_id' and school_id='$school_id'");
		$postvalue['responseStatus']=200;
		$postvalue['responseMessage']="ok";
		$postvalue['posts']=null;
	}
	else
	{
		$postvalue['responseStatus']=1000;
		$postvalue['responseMessage']="invalid inputs";
		$postvalue['posts']=null;
	}
	
	header('content-type:application/json');
	echo  json_encode($postvalue);
	@mysql_close($conn);
?>