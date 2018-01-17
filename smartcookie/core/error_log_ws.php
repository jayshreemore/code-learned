<?php
$json = file_get_contents('php://input');
$obj = json_decode($json);
include 'conn.php';
$error_type = $obj->{'error_type'};
$error_description = $obj->{'error_description'};
$data = $obj->{'data'};
$datetime = $obj->{'datetime'};
$user_type = $obj->{'user_type'};
$member_id = $obj->{'member_id'};
$name = $obj->{'name'};
$phone = $obj->{'phone'};
$email = $obj->{'email'};
$app_name = $obj->{'app_name'};
$subroutine_name = $obj->{'subroutine_name'};
$line = $obj->{'line'};
$status = $obj->{'status'};
$lst_prog_name= $obj->{'last_prog_name'};
$web_name = $obj->{'webservice_name'};
$web_met_name = $obj->{'webmethod_name'};
$prog_err_msg = $obj->{'prog_err_msg'};
$school_ID= $obj->{'school_id'};




if($error_description != "" and $data !="" and $app_name !=""){

	$q=mysql_query("insert into tbl_error_log(`error_type`,`error_description`,`data`,`datetime`,`user_type`,`member_id`,`name`, `phone`, `email`,`app_name`,`subroutine_name`,`line`,`status`,`last_programmer_name`,`webservice_name`,`webmethod_name`,`programmer_error_message`,`school_id`) values('$error_type', '$error_description', '$data', '$datetime', '$user_type', '$member_id', '$name', '$phone', '$email','$app_name', '$subroutine_name', '$line', '$status','$lst_prog_name','$web_name','$web_met_name','$prog_err_msg','$school_ID')")or die(mysql_error());
	$i=mysql_insert_id();
	$posts = array();
	if($i){
		$posts['error_id']=$i;
		$postvalue['responseStatus']=200;
		$postvalue['responseMessage']="OK";
		$postvalue['posts']=$posts;
	}else{
		$postvalue['responseStatus']=204;
		$postvalue['responseMessage']="No Response";
		$postvalue['posts']=null;
	}
}else{
	$postvalue['responseStatus']=1000;
	$postvalue['responseMessage']="Invalid Input";
	$postvalue['posts']=null;
}				  
header('Content-type: application/json');
echo  json_encode($postvalue); 

?>