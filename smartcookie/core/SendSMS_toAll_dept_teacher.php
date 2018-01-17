<?php
error_reporting(0);
include("scadmin_header.php");
include('conn.php');
require "twilio.php";
$i=0;
$fail = 0;
$success= 0;
$School_id=$_GET['school_id'];
$dept=$_GET['t_dept'];
$Sms_status=$_GET['status'];
$Country=strtoupper($_GET['country']);

$query2="select t_email,t_phone,t_password,t_current_school_name,send_unsend_status from `tbl_teacher` where t_dept = '$dept' and school_id='$School_id'";
$row2=mysql_query($query2);

				function messageUser($cc,$site,$phone,$email,$password,$teachershortside,$School_id)
							{
								
						 $url2="For App Download click here: http://".$site."/Download";
							 $url1=""; //"Please visit ".$teachershortside."";
									
							  $Text1="CONGRATULATIONS!,You are registered as a teacher in Smart Cookie - A Student/Teacher Rewards Program. Your Username is ".$phone." and Password is ".$password." College/School_id is ".$School_id." ".$url2." ".$url1; 
							
						 $Text = urlencode($Text1);
							
							
							$url="http://www.smswave.in/panel/sendsms.php?user=blueplanet&password=123123&sender=PHUSER&PhoneNumber=$phone&Text=$Text";
								$response = file_get_contents($url);
								return $response;
							}
while($value2=mysql_fetch_array($row2))
{	
$password=$value2['t_password'];
$phone=$value2['t_phone'];
$email=$value2['t_email'];
$p_lenght=strlen(trim(($phone)));
$status=$value2['send_unsend_status'];
$school_name=$value2['t_current_school_name'];
$s_name=explode(" ",$school_name);
$sc_name=$s_name[0]."".$s_name[1]."".$s_name[2]."".$s_name[3];
$site = $_SERVER['HTTP_HOST'];
if ($site=='dev.smartcookie.in')
					{
						$teachershortside="https://goo.gl/MWbV2E";
					}
			else if($site=='test.smartcookie.in')
					{
						$teachershortside="https://goo.gl/CaEhf8";
					}
			else 
					{
						$teachershortside="https://goo.gl/HdVtLL";
					}	
//$androidlink="https://goo.gl/71F2hc";
//$ioslink="https://goo.gl/cdi711";
	if($Country!='')
	{
		
			if($Country=='INDIA')   // India
			{	
				
					$cc=91;
					
					if($p_lenght>0 && $p_lenght==10)
						{
							
							$response = messageUser($cc,$site,$phone,$email,$password,$teachershortside,$School_id);
                            $date=(new \DateTime())->format('Y-m-d H:i:s');
							//echo $site;die;
							$sql_update="UPDATE `tbl_teacher` SET send_unsend_status='Send_SMS',sms_time_log='$date',sms_response = '$response' WHERE t_dept = '$dept' AND t_phone='$phone' AND school_id='$School_id'";
							$retval = mysql_query($sql_update) or die('Could not update data: ' . mysql_error());
							
							$success++;
							///echo "<script type=text/javascript>alert('SMS has been sent Successfully on $phone')</script>";
							
							//echo "<script type=text/javascript>'window.location='Send_Msg_Teacher.php'</script>";
						}
						else
						{
						echo "<script type=text/javascript>alert('Sorry,Invalid Phone No.')</script>";
						$fail++;
						//window.location='Send_Msg_Teacher.php'</script>";
						}
			}
			elseif($Country=='US' || $Country=='USA')                // for USA
			{
						$ApiVersion = "2010-04-01";
								// set our AccountSid and AuthToken
						$AccountSid = "ACf8730e89208f1dfc6f741bd6546dc055";
						$AuthToken = "45e624a756b26f8fbccb52a6a0a44ac9";
								// instantiate a new Twilio Rest Client
						$client = new TwilioRestClient($AccountSid, $AuthToken);
						$number="+1".$phone;
						//$Text="Welcome in Smartcookie as Teacher UserID: $phone and Password: $password android app $androidlink iOS app $ioslink";
						$Text="Your college is now a member of a Student-Teacher Reward platform (SMART COOKIE) that rewards you for your accomplishments as a teacher/mentor. It also enables you to reward your Students for their good deeds in Studies & Extracurricular activities.  UserID: $phone and Password: $password College/School_id is $School_id $url2 ";
						$res = $client->request("/$ApiVersion/Accounts/$AccountSid/SMS/Messages", 
										"POST", array(
										"To" => $number,
										"From" => "732-798-7878",
										"Body" => $Text
									));
								echo "<script type=text/javascript>alert('SMS has been sent Successfully on $number'); window.location='Send_Msg_Teacher.php'</script>";
                        $date=(new \DateTime())->format('Y-m-d H:i:s');
						$sql_update="UPDATE `tbl_teacher` SET send_unsend_status='Send_SMS',sms_time_log='$date' WHERE t_phone='$phone' AND school_id='$School_id'";
						$retval = mysql_query($sql_update) or die('Could not update data: ' . mysql_error());
			}
			else{
				
			}
	}
		else
		{
			echo "<script type=text/javascript>alert('Sorry,Unable to send message without Country name'); window.location='Send_Msg_Teacher.php'</script>";
		}
}
echo "<script type=text/javascript>alert('$success SMS sent successfully , $fail SMS fails by sendmail library'); window.location='Send_Msg_Teacher.php'</script>";

?>