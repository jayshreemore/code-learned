<?php
$json = file_get_contents('php://input');
$obj = json_decode($json);
include('conn.php');
	$t_id = $obj->{'t_id'};
	$school_id = $obj->{'school_id'};
	$points = $obj->{'points'};
	$reason = $obj->{'reason'};
	$student_id = $obj->{'student_PRN'};
	$activity_type1=$obj->{'activity_type'};
	$reason_id=$obj->{'reason_id'};
	$accept_date=Date('d/m/Y');

	 $query = mysql_query("select tc_balance_point from tbl_teacher where t_id ='$t_id' and school_id = '$school_id'");
	 
	 $value = mysql_fetch_assoc($query);
	 $reward_points=$value['tc_balance_point'];

	if($t_id!='' && $school_id!='' && $points!='' && $reason!='' && $student_id!='' && $activity_type1!='' && $reason_id!='')
	{
			if($reward_points >= $points)
			{
					$final_points=$reward_points-$points;
					$test=mysql_query("update tbl_teacher set tc_balance_point='$final_points' where t_id='$t_id'");
				 
					$arr=mysql_query("select * from tbl_student_reward where sc_stud_id='$student_id' ");
					$arr1=mysql_fetch_array($arr);
				 
				  
					$sc_final_point=$arr1['sc_total_point']+$points;
					$sql1=mysql_query("update tbl_student_reward set sc_total_point='$sc_final_point' where sc_stud_id='$student_id'");
				
					$sql2=mysql_query("update tbl_request set flag='Y' where stud_id1='$student_id' and stud_id2='$t_id' and entitity_id='103' and flag='N' and reason like '$reason_id' and school_id='$school_id'");
					
					$sql3=mysql_query("insert into tbl_student_point(sc_stud_id,sc_entites_id,sc_teacher_id,sc_studentpointlist_id,sc_point,point_date,method,activity_type,school_id) values('$student_id','103','$t_id','$reason','$points','$accept_date','1','$activity_type1','$school_id')");
					
					$postvalue['responseStatus']=200;
					$postvalue['responseMessage']="OK";
					$postvalue['posts']=null;
				
			}
			else
			{
					$postvalue['responseStatus']=204;
					$postvalue['responseMessage']="insufficient points";
					$postvalue['posts']=null;
			}
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