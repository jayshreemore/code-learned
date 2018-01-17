<?php  
//require_once('loader.php');
require_once('function.php');
require_once('config.php');
error_reporting(0);
//$json=$_GET ['json'];
$json = file_get_contents('php://input');
$obj = json_decode($json);
$format = 'json'; 

include 'conn.php';
							/* $con = mysql_connect('SmartCookies.db.7121184.hostedresource.com','SmartCookies','Bpsi@1234') 
								   or die('Cannot connect to the DB');
							mysql_select_db('SmartCookies',$con); */

   $t_id1=$obj->{'t_id'};         // Sender ID
   $t_id2=$obj->{'t_id2'};  // Receiver ID
   $points=$obj->{'points'};
   $reason=$obj->{'reason'};
   $school_id=$obj->{'school_id'};   $select_opt=$obj->{'point_type'};
   $posts = array();
if($t_id1!="" && $t_id2!="" && $points!="" && $reason!="" && $school_id!="") 
{	if($select_opt=='Bluepoint')	{
					$query = mysql_query("select id,balance_blue_points from tbl_teacher where t_id ='$t_id1' and school_id='$school_id' ");
					$result=mysql_fetch_array($query);
					$balance_blue_points=$result['balance_blue_points'];
					$teacher_id1=$result['id'];
					if($points<=$balance_blue_points)
					{
						$date=Date('Y/m/d');
						$sql=mysql_query("select id,balance_blue_points from tbl_teacher where t_id ='$t_id2' and school_id='$school_id' ");
						$result=mysql_fetch_array($sql);
						$teacher_id2=$result['id'];
						$sc_final_point=$result['balance_blue_points']+$points;
						$sql1=mysql_query("update tbl_teacher set balance_blue_points='$sc_final_point' where t_id='$t_id2' and school_id='$school_id' ");
						$sc_share_point=$balance_blue_points-$points;
						$query=mysql_query("update tbl_teacher set balance_blue_points='$sc_share_point' where t_id='$t_id1' and school_id='$school_id' ");
						$test=mysql_query("insert into tbl_teacher_point(sc_entities_id,sc_point,sc_teacher_id,assigner_id,reason,point_date,school_id,point_type) values('103','$points','$teacher_id2','$teacher_id1','$reason','$date','$school_id','$select_opt')");
						$report="Points are shared succesfully";
								$posts[]=array('report'=>$report);
								$postvalue['responseStatus']=200;
								$postvalue['responseMessage']="OK";
								$postvalue['posts']=$posts;
					}					else{
								$postvalue['responseStatus']=204;
								$postvalue['responseMessage']="No Response";
								$postvalue['posts']=null;
						}
	}	elseif($select_opt=='Waterpoint')	{					
	
	$query = mysql_query("select water_point,id from tbl_teacher where t_id ='$t_id1' and school_id='$school_id' ");			
	$result=mysql_fetch_array($query);			
	$water_point=$result['water_point'];				
	$teacher_id1=$result['id'];				
	if($points<=$water_point)				
		{					
	$date=Date('Y/m/d');						
	$sql=mysql_query("select id,balance_blue_points from tbl_teacher where t_id ='$t_id2' and school_id='$school_id' ");	
	$result=mysql_fetch_array($sql);				
	$teacher_id2=$result['id'];					
	$sc_final_point=$result['balance_blue_points']+$points;			
	$sql1=mysql_query("update tbl_teacher set balance_blue_points='$sc_final_point' where t_id='$t_id2' and school_id='$school_id' ");			
	$sc_share_point=$water_point-$points;					
	$query=mysql_query("update tbl_teacher set water_point='$sc_share_point' where t_id='$t_id1' and school_id='$school_id' ");			
	$test=mysql_query("insert into tbl_teacher_point(sc_entities_id,sc_point,sc_teacher_id,assigner_id,reason,point_date,school_id,point_type) values('103','$points','$teacher_id2','$teacher_id1','$reason','$date','$school_id','$select_opt')");						$report="Points are shared succesfully";								$posts[]=array('report'=>$report);								$postvalue['responseStatus']=200;								$postvalue['responseMessage']="OK";								$postvalue['posts']=$posts;					}					else{								$postvalue['responseStatus']=204;								$postvalue['responseMessage']="No Response";								$postvalue['posts']=null;						}						}
		 
		 
		 
}
if($format == 'json') {							header('Content-type: application/json');    						 echo json_encode($postvalue);						}


else{
	   
	   
	   $postvalue['responseStatus']=1000;
				$postvalue['responseMessage']="Invalid Input";
				$postvalue['posts']=null;
			  
			  header('Content-type: application/json');
   			  echo  json_encode($postvalue); 
	   
	 }
//
  //$posts = array($json);
  
	
		
  ?>