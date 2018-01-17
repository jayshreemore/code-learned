<?php
$json = file_get_contents('php://input');
$obj = json_decode($json);
$student_key = $obj->{'student_key'};
$school_id = $obj->{'school_id'};
$offset = $obj->{'offset'};

$format = 'json';
include "conn.php";

if(!empty($student_key)){
	if(!empty($school_id))
	{
	$query="SELECT  DISTINCT  school_id,std_PRN,std_complete_name,std_dept,std_class FROM tbl_student 
	WHERE
	(std_PRN LIKE '%$student_key%'OR std_complete_name LIKE '%$student_key%' 
	OR std_lastname LIKE '%$student_key%' OR std_dept LIKE '$student_key%'	
	OR std_Father_name LIKE '%$student_key%' OR school_id LIKE '%$student_key%'
	OR std_name LIKE '%$student_key%' OR std_class LIKE '$student_key%') AND school_id = '$school_id' LIMIT 100 OFFSET $offset";
	}
	else{
	$query="SELECT  DISTINCT  school_id,std_PRN,std_complete_name,std_dept,std_class FROM tbl_student 
	WHERE
	(std_PRN LIKE '%$student_key%'OR std_complete_name LIKE '%$student_key%' 
	OR std_lastname LIKE '%$student_key%' OR std_dept LIKE '$student_key%'	
	OR std_Father_name LIKE '%$student_key%' OR school_id LIKE '%$student_key%'
	OR std_name LIKE '%$student_key%' OR std_class LIKE '$student_key%') LIMIT 100 OFFSET $offset";
	}
	
	$result = mysql_query($query,$con) or die('Errant query:  '.$query);
	$posts = array();
	
	if(mysql_num_rows($result) >= 1){
		while($post = mysql_fetch_assoc($result)){
			$res_school_id = htmlentities($post['school_id']);
			$res_std_PRN = htmlentities($post['std_PRN']);
			$res_std_complete_name = htmlentities($post['std_complete_name']);
			$res_std_dept = htmlentities($post['std_dept']);
			$res_std_class = htmlentities($post['std_class']);
			
			$posts[] =array("school_id"=>$res_school_id,"std_PRN"=>$res_std_PRN,"std_complete_name"=>$res_std_complete_name,"std_dept"=>$res_std_dept,"std_class"=>$res_std_class);
		}
		$postvalue['responseStatus'] = 200;
		$postvalue['responseMessage'] = "OK";
		$postvalue['posts'] = $posts;

	}
	else{
		$postvalue['responseStatus'] = 204;
		$postvalue['responsMessage'] = 'No Response';
		$postvalue['posts'] = NULL;
	}
	
	if($format = 'json'){
		header('Content-type: application/json');
		echo json_encode($postvalue);
	}
	
}
else{

	$postvalue['responseStatus']=1000;
	$postvalue['responseMessage']="Invalid Input";
	$postvalue['posts']=null;
	
	header('Content-type: application/json');
   	echo  json_encode($postvalue);
}

  @mysql_close($con);

?>