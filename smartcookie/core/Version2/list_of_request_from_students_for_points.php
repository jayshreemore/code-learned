<?php
include('conn.php');
$json = file_get_contents('php://input');
$obj = json_decode($json);


$t_id = $obj->{'t_id'};
$school_id = $obj->{'school_id'};

$arr=mysql_query("select stud_id1 as stud_id,requestdate,points,reason,activity_type from tbl_request where stud_id2='$t_id' and flag='N' and entitity_id='103' and activity_type!='' and school_id='$school_id' order by id desc") or die(mysql_error());
$count = mysql_num_rows($arr);
//$post = mysql_fetch_assoc($arr);
//$nik =$post['stud_id'];
 if(mysql_num_rows($arr)>=1)
 { 

	
	while($post = mysql_fetch_assoc($arr))
	{
		$reason = $post['reason'];
		
		 if( $post['activity_type']=="activity")
		{
			
			$query1 = mysql_query("select sc_list,sc_id from tbl_studentpointslist where sc_id = '$reason' and school_id='$school_id'");
			$resultset=mysql_fetch_array($query1);		
			$activity_type=$resultset['sc_list'];
		}
		elseif($post['activity_type']=="subject")
		{
			$query1 = mysql_query("select distinct subject from tbl_school_subject where Subject_Code = '$reason' and school_id='$school_id'");
			$resultset=mysql_fetch_array($query1);
			$activity_type=$resultset['subject'];
		}


		$st_id=$post['stud_id'];
	 	$sql=mysql_query("select std_name,std_Father_name,std_lastname,std_complete_name,std_img_path from tbl_student where std_PRN='$st_id' and school_id='$school_id'");
		$value=mysql_fetch_assoc($sql);
		$value['requestdate'] = $post['requestdate'];
		$value['points'] = $post['points'];
		$value['activity_type'] = $post['activity_type'];
		$value['reason'] = $activity_type;
		$value['student_PRN'] = $st_id;
		$value['reason_id'] = $reason;
		$posts[] = $value;
	}
	$postvalue['responseStatus']=200;
	$postvalue['responseMessage']="OK";
	$postvalue['posts']=$posts;	
 }
 else
 {
	$postvalue['responseStatus']=204;
	$postvalue['responseMessage']="No records found";
	$postvalue['posts']=null;
 }

header('Content-type: application/json');	
echo json_encode($postvalue);
@mysql_close($con);


?>