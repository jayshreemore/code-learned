
<?php
 include('conn.php');					 
				$teacher_id=$_SESSION['id'];
					$school_id=$_SESSION['school_id'];
					 $softrewardId=$_GET['softrewardid'];
					 $fromRange=$_GET['fromrange'];
					 
$server_name = $_SERVER['SERVER_NAME'];
			
			
/*$sql=mysql_query("select softrewardId,user,rewardType,fromRange,imagepath from softreward where user='Teacher' and softrewardId=$softrewardId");
$result=mysql_query($sql);

//$softrewardId=$result['softrewardId'];
$user=$result['user'];
$rewardType= $result['rewardType'];
$fromRange= $result['fromRange'];

$img= $result['imagepath'];*/

	
	
	//echo "INSERT INTO purcheseSoftreward(user_id,userType,school_id,reward_id,point) VALUES ('$teacher_id', 'Teacher','$school_id','$softrewardId','$fromRange')";

	 $sql2=mysql_query("select balance_blue_points from tbl_teacher where id='$teacher_id' and school_id='$school_id'");
		   $result=mysql_fetch_array($sql2);
		   $balance_blue_points=$result['balance_blue_points'];
		   $remaining_point= $balance_blue_points-$fromRange;
		   //echo"update tbl_teacher set balance_blue_points='$remaining_point' where id='$teacher_id'";
		   if($fromRange<= $balance_blue_points)
		   {
		  $sql3=mysql_query("update tbl_teacher set balance_blue_points='$remaining_point' where id='$teacher_id'");
		   
	
	$sql=mysql_query("INSERT INTO purcheseSoftreward(user_id,userType,school_id,reward_id,point) VALUES ('$teacher_id', 'Teacher','$school_id','$softrewardId','$fromRange')");
		


		if($sql)
				{
					
					echo "<script>
window.location.href='https://$server_name/core/teacher_soft_reward.php';
alert('Reward  purchased succesfully');
</script>";
				}
				else
				 {
					 
					 echo"<script>alert('Reward Not  purchased succesfully')</script>";
				}
				//echo "select balance_blue_points from tbl_teacher where id='$teacher_id' and school_id='$school_id'";
				/* $sql2=mysql_query("select balance_blue_points from tbl_teacher where id='$teacher_id' and school_id='$school_id'");
		   $result=mysql_fetch_array($sql2);
		   $balance_blue_points=$result['balance_blue_points'];
		   $remaining_point= $balance_blue_points-$fromRange;
		   echo"update tbl_teacher set balance_blue_points='$remaining_point' where id='$t_id'";
		  $sql3=mysql_query("update tbl_teacher set balance_blue_points='$remaining_point' where id='$t_id'");
		   */
		   }
		   else
		   {
			    echo "<script>
window.location.href='https://$server_name/core/teacher_soft_reward.php';
alert('Reward Not  purchased succesfully');</script>";
		   }
		   
		   $sql1=mysql_query("select * from tbl_teacher where id='$teacher_id' ");
		  $row1= mysql_num_rows(sql1);
		  $t_name=$row1['t_complete_name'];

	 $server_name = $_SERVER['SERVER_NAME'];
			 
							
									$data = array('Action_Description'=>'Purchased soft reward',
												'Actor_Mem_ID'=>$teacher_id,
												'Actor_Name'=>$t_name,
												'Actor_Entity_Type'=>103,
												'Second_Receiver_Mem_Id'=>'',
												'Second_Party_Receiver_Name'=>'',
												'Second_Party_Entity_Type'=>'',
												'Third_Party_Name'=>'',
												'Third_Party_Entity_Type'=>'',
												'Coupon_ID'=>'',
												'Points'=>'',
												'Product'=>'',
												'Value'=>'',
												'Currency'=>''
							);
							
							$ch = curl_init("https://$server_name/core/Version2/master_action_log_ws.php"); 	
							
							
							$data_string = json_encode($data);    
							curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");    
							curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);  
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);      
							curl_setopt($ch, CURLOPT_HTTPHEADER, array('ContentType: application/json','ContentLength: ' . strlen($data_string)));
							$result = json_decode(curl_exec($ch),true);
			 
			 //end	
	


 //header("Location:http://tsmartcookies.bpsi.us/core/teacher_soft_reward.php");
				



?>