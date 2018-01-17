<?php
error_reporting(0);
include('conn.php');
$email=$_GET['email'];
$e_lenght=strlen(trim(($email)));
$School_id=$_GET['school_id'];

$Email_status=$_GET['status'];
if($e_lenght>0 && filter_var($email, FILTER_VALIDATE_EMAIL))
{
		$query2="select t_complete_name,t_password,t_name,t_middlename,t_lastname,school_id,email_status,t_current_school_name from `tbl_teacher` where t_email='$email' and school_id='$School_id'";  //query for getting last batch_id what else if are inserting first time data
		$row2=mysql_query($query2);
		$value2=mysql_fetch_array($row2);
		$password=$value2['t_password'];
		$t_complete_name=$value2['t_complete_name'];
		$t_name=$value2['t_name'];
		$t_middlename=$value2['t_middlename'];
		$t_lastname=$value2['t_lastname'];
		$status=$value2['email_status'];
		$school_id=$value2['school_id'];
		$school_name=$value2['t_current_school_name'];
		
		if ($t_complete_name=="")
		{
			 $name=$t_name." ".$t_middlename." ".$t_lastname;
			  
			   $t_complete_name= urlencode($name);
		}
		else
		{
			  $t_complete_name = urlencode($t_complete_name);
		}
		$s_name=explode(" ",$school_name);
		$sc_name=$s_name[0]."".$s_name[1]."".$s_name[2]."".$s_name[3];
				$site = $_SERVER['HTTP_HOST'];
				$msgid='welcometeacherfromscadmin';
				
						$res = file_get_contents("https://$site/core/clickmail/sendmail.php?email=$email&msgid=$msgid&site=$site&pass=$password&teachername=$t_complete_name&school_id=$school_id&school_name=".urlencode($school_name)."");
						
						if(stripos($res,"Mail sent successfully"))
						{
							echo "<script type=text/javascript>alert('Email has been sent Successfully on $email'); window.location='Send_Msg_Teacher.php'</script>";
                            $date=(new \DateTime())->format('Y-m-d H:i:s');
							$sql_update="UPDATE `tbl_teacher` SET email_status='Send_Email',email_time_log='$date' WHERE t_email='$email' AND school_id='$School_id'";
							$retval = mysql_query($sql_update) or die('Could not update data: ' . mysql_error());
						}
						else
						{
							echo "<script type=text/javascript>alert('Email not sent on $email'); window.location='Send_Msg_Teacher.php'</script>";
						}
}
else
{
  echo "<script type=text/javascript>alert('Sorry,Invalid Email ID..'); window.location='Send_Msg_Teacher.php'</script>";
}
?>
