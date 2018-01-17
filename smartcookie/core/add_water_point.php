
<?php

 include('conn.php');
 
 
 if(isset($_SESSION['id']))
{
//echo "select * from tbl_user where t_email = '".$_SESSION['username']."' and t_password = '".$_SESSION['password']."'";
$query = mysql_query("select * from tbl_teacher where id = ".$_SESSION['id']);
$value = mysql_fetch_array($query);
$sc_id=$value['school_id'];
$teacher_id=$value['id'];
$t_id=$value['t_id'];
$id=$_SESSION['id'];
$balance_water_points=$value['water_point'];


$report= "Could not find!!!!";
}
  $server_name = $_SERVER['SERVER_NAME'];

 if(isset($_POST['purchase']));
 {
	 $card_no=trim($_POST['card_no']);
	// echo"select * from tbl_giftcards where card_no='$card_no' and status='Unused'";
	 $sql=mysql_query("select * from tbl_giftcards where card_no='$card_no' and status='Unused'");
	 $value = mysql_fetch_array($sql);
	
	 $amount=$value['amount'];
	 //echo"$amount";
	   $card_no1=$value['card_no'];
	 $issue_date=$value['issue_date'];
	   $valid_to=$value['valid_to'];
	    $id=$value['id'];
		
		$totalamount= $balance_water_points + $amount;
		/*echo"$totalamount";
		echo"$valid_to";
		echo"$amount";
		echo"$issue_date";*/// echo"$count";
		 //$count = mysql_num_rows($sql);
		 //$query=mysql_query("update tbl_giftcards set amount='0' and status ='Used'");
		 
		 if($card_no==$card_no1)
		 {
			
		//echo"update tbl_teacher set water_point='$totalamount' where t_id='$t_id' and school_id='$sc_id'";
	$sql1=mysql_query("update tbl_teacher set water_point='$totalamount' where t_id='$t_id' and school_id='$sc_id'");
	//echo"update tbl_giftcards set amount=0 and status='Used' where card_no='$card_no' and status='Unused'";
	$sq=mysql_query("select t_complete_name,id from tbl_teacher where t_id='$t_id' and school_id='$sc_id'");
									$rows1=mysql_fetch_assoc($sq);
									$t_id1=$rows1['id'];
									$t_name=$rows1['t_complete_name'];
			 //echo "select t_complete_name,id from tbl_teacher where id='$id'";
			 $server_name = $_SERVER['SERVER_NAME'];
							
									$data = array('Action_Description'=>'Purchase Water Points',
												'Actor_Mem_ID'=>$_SESSION['id'],
												'Actor_Name'=>$t_name,
												'Actor_Entity_Type'=>103,
												'Second_Receiver_Mem_Id'=>'',
												'Second_Party_Receiver_Name'=>'',
												'Second_Party_Entity_Type'=>'',
												'Third_Party_Name'=>'',
												'Third_Party_Entity_Type'=>'',
												'Coupon_ID'=>$card_no1,
												'Points'=>$amount,
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
	 $query=mysql_query("update tbl_giftcards set amount=0,status='Used' where card_no='$card_no' and status='Unused'");
		/*$sql1=mysql_query("insert into  tbl_teacher(water_point)values('$totalamount')");*/
	if($sql1)
	{
		echo "<script>
window.location.href='https://$server_name/core/purchased_water_point.php';
alert('Water point  purchased succesfully');
</script>";
	}
	else
	{
		echo "<script> alert('water point not purched ')</script>";
	}
		 }
		 else
		 {
			 echo "<script> alert('error')</script>";
		 }
		
	 
	 
 }
 
 
 
 
?>