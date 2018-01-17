<?php  
//$json=$_GET ['json'];
error_reporting(0);
require_once('function.php');
require_once('config.php');
$json = file_get_contents('php://input');
$obj = json_decode($json);

 $format = 'json'; //xml is the default


include 'conn.php';

$date=date("d/m/Y");
//input from user
    $stud_id=$obj->{'stud_id'};
	$t_id=$obj->{'t_id'};
	$activity_type=$obj->{'activity_type'};
	if($activity_type==1)
	{
		$type="activity";
	}
	if($activity_type==2)
	{
		$type="subject";
	}
	$reason=$obj->{'reason'};
	$points=$obj->{'points'};
	
	
	
	
    if($stud_id!="" && $t_id!="" && $reason!="" && $points!="" && $activity_type!="")
	{
			
			
				 
				 $sql=mysql_query("select * from tbl_request where stud_id1='$stud_id' and stud_id2='$t_id' and reason like '$reason' and flag='N' and requestdate='$date' and points='$points' and entitity_id='103' and activity_type='$type'");
				 
				 
			 $count=mysql_num_rows($sql);
			 if($count==0)
			 {			
				$arr = mysql_query("insert into tbl_request(stud_id1,stud_id2,reason,points,requestdate,flag,entitity_id,activity_type) values('$stud_id1','$stud_id2','$reason','$points','$date','N','103','$type')");
				$report="Request Sent Successfully";
				
					
					 $posts[]=array('report'=>$report);
					
					$postvalue['responseStatus']=200;
				$postvalue['responseMessage']="OK";
				$postvalue['posts']=$posts;
	       
				
			}
				
				else
				{
				$postvalue['responseStatus']=204;
								$postvalue['responseMessage']="No Response";
								$postvalue['posts']=null;
				}
				
				if($format == 'json') {
    					header('Content-type: application/json');
   					 echo json_encode($postvalue);
  					}
		
				
		}
	else
			{
			  $postvalue['responseStatus']=1000;
				$postvalue['responseMessage']="Invalid Input";
				$postvalue['posts']=null;
			  
			  header('Content-type: application/json');
   			  echo  json_encode($postvalue);  
			
			}	
			
	  
  /* disconnect from the db */
  @mysql_close($link);	
	
		
  ?>
