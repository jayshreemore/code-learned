<?php  

$json = file_get_contents('php://input');
$obj = json_decode($json);

$sponsor_id = $obj->{'sp_id'};
$rolling_message= $obj->{'rolling_message'};
$field_message= $obj->{'field_message'};
$dates = date('Y/m/d');


if( $sponsor_id!= ''&&  $rolling_message!= ''&& $field_message!= '' )
{

include 'conn.php';
  
 $query="update `tbl_sponsorer` set rolling_message = '$rolling_message', field_message='$field_message' where id = $sponsor_id";
  $result=mysql_query($query);
 
							$posts = "Messages successfully  updated ";
							$postvalue['responseStatus']=200;
							$postvalue['responseMessage']="OK";
							$postvalue['posts']=$posts;
							header('Content-type: application/json');
							echo  json_encode($postvalue); 
	
	
}
else
{
							$postvalue['responseStatus']=1000;
							$postvalue['responseMessage']="Invalid Input";
							$postvalue['posts']=null;
							 header('Content-type: application/json');
							echo  json_encode($postvalue);
}
			  	
mysql_close($con);		
  ?>