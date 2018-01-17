<?php
error_reporting(0);
include('conn.php');
$email= trim( $_GET['email']);
$e_lenght=strlen(trim(($email)));
$School_id=$_GET['school_id'];
$Email_status=$_GET['status'];
$name = $_GET['name'];
if($e_lenght>0 && filter_var($email, FILTER_VALIDATE_EMAIL))
{
	$query2="select std_PRN,std_name,std_complete_name, std_lastname,school_id, std_Father_name, std_email, std_phone, std_password, std_school_name, email_status from `tbl_student` where (std_email='$email' or Email_Internal='$email') and school_id='$School_id'";  //query for getting last batch_id what else if are inserting first time data
	$row2=mysql_query($query2);
	$value2=mysql_fetch_array($row2);
	$password=$value2['std_password'];
	$status=$value2['send_unsend_status'];
	$school_name=$value2['std_school_name'];
	$email_status=$value2['email_status'];
	$std_name=$value2['std_name'];
	$std_Father_name=$value2['std_Father_name'];
	$std_lastname=$value2['std_lastname'];
	$std_complete_name=$value2['std_complete_name'];
	$school_id=$value2['school_id'];
	if ($std_complete_name=="")
		{
			 $name=$std_name." ".$std_Father_name." ".$std_lastname;
			  
			   $std_complete_name= urlencode($name);
		}
		else
		{
			  $std_complete_name = urlencode($std_complete_name);
		}
	
	$s_name=explode(" ",$school_name);
    $sc_name=$s_name[0]."".$s_name[1]."".$s_name[2]."".$s_name[3];
	/*if($email_status=="Unsend")
	{*/
		$site = $_SERVER['HTTP_HOST'];
				$msgid='welcomestudentfromscadmin';
						$res = file_get_contents("http://$site/core/clickmail/sendmail.php?email=$email&msgid=$msgid&site=$site&pass=$password&studentname=$std_complete_name&school_id=$school_id&school_name=".urlencode($school_name)."");
						
						if(stripos($res,"Mail sent successfully"))
						{
							echo "<script type=text/javascript>alert('Email has been sent Successfully on $email'); window.location='Send_Msg_Student.php'</script>";
                            $date=(new \DateTime())->format('Y-m-d H:i:s');
							 $sql_update="UPDATE `tbl_student` SET email_status='Send_Email',email_time_log='$date' WHERE (std_email='$email' or Email_Internal='$email') AND school_id='$School_id'";
							$retval = mysql_query($sql_update) or die('Could not update data: ' . mysql_error());
						}
						else
						{
							echo "<script type=text/javascript>alert('Email not sent  on $email'); window.location='Send_Msg_Student.php'</script>";
						}
	/*}
	else
		{
			echo "<script type=text/javascript>alert('You have already sent Email on $email. Thank You....! '); window.location='Send_Msg_Student.php'</script>";	
		}*/

}
else
{
	echo "<script type=text/javascript>alert('Sorry, Invalid Email ID'); window.location='Send_Msg_Student.php'</script>";
}


               
?>


