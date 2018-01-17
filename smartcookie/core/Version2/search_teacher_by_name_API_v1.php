<?php
$json = file_get_contents('php://input');
$obj = json_decode($json);


$teacher_key = $obj->{'teacher_key'};
$school_id = $obj->{'school_id'};
$format = 'json';
include "conn.php";

if(!empty($teacher_key)){
	
	if(!empty($school_id))
	{
	
	$query="SELECT DISTINCT t.t_complete_name, t.t_name, t.t_middlename, t.t_lastname, t.t_dept, t.school_id, t.t_class FROM tbl_teacher as t WHERE (t_id LIKE '%$teacher_key%' OR t_complete_name LIKE '%$teacher_key%'OR t_lastname LIKE '%$teacher_key%'OR t_dept LIKE '%$teacher_key%' OR t_class LIKE '%$teacher_key%') AND school_id ='$school_id'";
	
	}
	else
	{
		$query="SELECT DISTINCT t.t_complete_name, t.t_name, t.t_middlename, t.t_lastname, t.t_dept, t.school_id, t.t_class FROM tbl_teacher as t WHERE (t_id LIKE '%$teacher_key%' OR t_complete_name LIKE '%$teacher_key%'OR t_lastname LIKE '%$teacher_key%'OR t_dept LIKE '%$teacher_key%' OR t_class LIKE '%$teacher_key%')";
	}
	$result = mysql_query($query,$con) or die('Errant query:  '.$query);
	$posts = array();
	
	
	
	if(mysql_num_rows($result) >= 1){
		
		while($post = mysql_fetch_assoc($result)){
			$posts[] = $post;
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