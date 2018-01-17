<?php
error_reporting(0);
include ('conn.php');

require "twilio.php";

$i = 0;
$success = 0;
$invalid_phone = 0;
$country_name_missing = 0;
$batch_id = $_GET['batch_id'];

// $p_lenght=strlen(trim(($phone)));

$School_id = $_GET['school_id'];
$site = $_SERVER['HTTP_HOST'];

if ($site == 'dev.smartcookie.in')
	{
	$teachershortside = "https://goo.gl/MWbV2E";
	}
elseif ($site == 'test.smartcookie.in')
	{
	$teachershortside = "https://goo.gl/CaEhf8";
	}
  else
	{
	$teachershortside = "https://goo.gl/HdVtLL";
	}

$androidlink = "https://goo.gl/r4YMt4";
$ioslink = "https://goo.gl/HNqrPR";
$query2 = "select std_country,std_phone,std_password,std_email,std_school_name from `tbl_student` where school_id='$School_id' and batch_id like '$batch_id'";
$row2 = mysql_query($query2);

while ($value2 = mysql_fetch_array($row2))
	{
	$Country = strtoupper($value2['std_country']);
	$phone = $value2['std_phone'];
	$p_lenght = strlen(trim(($phone)));
	$password = $value2['std_password'];
	$email = $value2['std_email'];
	$school_name = $value2['std_school_name'];
	$s_name = explode(" ", $school_name);
	$sc_name = $s_name[0] . "" . $s_name[1] . "" . $s_name[2] . "" . $s_name[3];
	$url2="For App Download click here: http://".$site."/Download";
	if ($Country != '')
		{
		
		if ($Country == "INDIA") // India
			{
				
			$cc = 91;
			if ($p_lenght > 0 && $p_lenght == 10)
				{
				function messageUser($cc, $phone, $email, $password, $teachershortside,$site,$School_id)
					{
					//$url2 = "+Android+app+" . $androidlink . "+ios+app+" . $ioslink . "";
					//$url1 = "+Please+visit+" . $teachershortside . "";
					$url2="For App Download click here: http://".$site."/Download";
					
					$Text1 = "CONGRATULATIONS!, You are registered as a student in Smart Cookie - A Student/Teacher Rewards Program. Your Username is ".$phone." and Password is ".$password." College/School_id is ."$School_id." ".$url2;
					$Text = urlencode($Text1);
					$url = "http://www.smswave.in/panel/sendsms.php?user=blueplanet&password=123123&sender=PHUSER&PhoneNumber=$phone&Text=$Text";
					file_get_contents($url);
					}

				messageUser($cc, $phone, $email, $password, $teachershortside,$site,$School_id);
				$date = date('Y-m-d H:i:s');
				$sql_update = "UPDATE `tbl_student` SET send_unsend_status='SMS sent',sms_time_log='$date' WHERE std_phone='$phone' AND school_id='$School_id'";
				$retval = mysql_query($sql_update) or die('Could not update data: ' . mysql_error());
				$success++;
				}
			  else
				{
				$invalid_phone++;
				}
			}
		  else
		if ($Country == 'US' || $Country == 'USA') // for USA
			{
			$ApiVersion = "2010-04-01";

			// set our AccountSid and AuthToken

			$AccountSid = "ACf8730e89208f1dfc6f741bd6546dc055";
			$AuthToken = "45e624a756b26f8fbccb52a6a0a44ac9";

			// instantiate a new Twilio Rest Client

			$client = new TwilioRestClient($AccountSid, $AuthToken);
			$number = "+1" . $phone;
			$Text = "Your college is now a member of a Student Teacher Reward platform that rewards you for  your accomplishments as a student and also enables you to thank your Teachers for all the motivation, mentoring etc. UserID: $phone and Password: $password College/School_id is $School_id $url2 ";
			$res = $client->request("/$ApiVersion/Accounts/$AccountSid/SMS/Messages", "POST", array(
				"To" => $number,
				"From" => "732-798-7878",
				"Body" => $Text
			));
			$success++;
			$sql_update = "UPDATE `tbl_student` SET send_unsend_status='SMS sent' WHERE std_phone='$phone' AND school_id='$School_id'";
			$retval = mysql_query($sql_update) or die('Could not update data: ' . mysql_error());
			}
		}
	  else
		{
		$country_name_missing++;
		}
	}

echo "<script type=text/javascript>alert('$success massages sent successfully , $invalid_phone massages failed because of invalid phone number , $country_name_missing massages failed because of missing country name'); window.location='Send_Msg_Student.php'</script>";
?>