<?php
$json = file_get_contents('php://input');
$obj = json_decode($json);
include_once "conn.php";

$sender_member_id = $obj->{'sender_member_id'};
$sender_entity_id = $obj->{'sender_entity_id'};
$receiver_entity_id = $obj->{'receiver_entity_id'};
$receiver_country_code = $obj->{'receiver_country_code'};
$receiver_mobile_number = $obj->{'receiver_mobile_number'};
$receiver_email_id = $obj->{'receiver_email_id'};
$firstname = $obj->	{'firstname'};
$middlename = $obj->{'middlename'};
$lastname = $obj->{'lastname'};
$platform_source = $obj->{'platform_source'};
$request_status = $obj->{'request_status'};

if((($receiver_country_code!='' && $receiver_mobile_number!='') || $receiver_email_id!='') && $sender_member_id!='' && $sender_entity_id !='' && $receiver_entity_id!='' && $firstname!='' && $middlename!='' && $lastname!='' && $platform_source!='' && $request_status!='')
{
	$check_request_query = mysql_query("select referral_tracking_id from referral_activity_log where receiver_mobile_number='$receiver_mobile_number' or receiver_email_id='$receiver_email_id'");
	$count = mysql_num_rows($check_request_query);
	if($count == 0)
	{
			$server_name = $_SERVER['SERVER_NAME'];
			$acceptance_flag = 'N';
			$invitation_sent_datestamp = date("Ymd h:i:s");
			$password = $firstname.'123';
			$sender_type = $sender_entity_id == 103 ?  'teacher' : ( $sender_entity_id == 105 ? 'student' : 'sponsor');
			$receiver_type = $receiver_entity_id == 103 ?  'teacher' : ( $receiver_entity_id == 105 ? 'student' : 'sponsor');

			$data = array('firstname'=>$firstname,
						'middlename'=>$middlename,
						'lastname'=>$lastname,
						'password'=>$password,
						'phonenumber'=>$receiver_mobile_number,
						'emailid'=>$receiver_email_id,
						'countrycode'=>$receiver_country_code,
						'platform_source'=>$platform_source,
						'type'=>$receiver_type
					);

			$ch = curl_init("http://$server_name/core/Version2/quickregistration_ws_v1.php");
			$data_string = json_encode($data);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('ContentType: application/json','ContentLength: ' . strlen($data_string)));
			$result = json_decode(curl_exec($ch),true);
			$responce_from_quick_registration = $result["responseStatus"];
			$receiver_member_id = $result['posts']['0']['id'];
			if($responce_from_quick_registration == 200)
			{
				$viral_link1 = $server_name."/core/Version2/accept_request_to_join_smartcookie.php?id=$sender_member_id&senderentity=$sender_entity_id&receiverentity=$receiver_entity_id&receiver_member_id=$receiver_member_id";
						$viral_link = urlencode($viral_link1);
						$msgid='promoting_smartcookie';
						$res = file_get_contents("https://$server_name/core/clickmail/sendmail.php?email=$receiver_email_id&msgid=$msgid&invitation_sender_name=$invitation_sender_name_encoded&viral_link=$viral_link&platform_source=$platform_source&site=$server_name");


						if(stripos($res,"Mail sent successfully"))
						{
							$result_mail = 'mail sent successfully';
						}
						else{
							$server_name = $_SERVER['SERVER_NAME'];

									$data = array('error_type'=>'',
									'error_description'=>$res,
									'data'=>'',
									'datetime'=>$invitation_sent_datestamp,
									'user_type'=>$sender_type,
									'member_id'=>$sender_member_id,
									'name'=>$invitation_sender_name,
									'phone'=>'',
									'email'=>'',
									'app_name'=>'request_send_to_join_smartcookie_web_service',
									'subroutine_name'=>'',
									'line'=>'102',
									'status'=>''
							);

							$ch = curl_init("https://$server_name/core/Version2/error_log_ws.php");


							$data_string = json_encode($data);
							curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
							curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
							curl_setopt($ch, CURLOPT_HTTPHEADER, array('ContentType: application/json','ContentLength: ' . strlen($data_string)));
							$result = json_decode(curl_exec($ch),true);

							$result_mail = 'mail not sent';
						}

						function messageUser($cc,$phone,$invitation_sender_name,$viral_link,$platform_source){
						switch($cc){
							case 91:
								$Text="You+are+requested+by+".$invitation_sender_name."+to+join+smartcookie+click+on+following+link+to+join+smartcookie+".$viral_link."+sent+by".$platform_source;
								$url="http://www.smswave.in/panel/sendsms.php?user=blueplanet&password=123123&sender=PHUSER&PhoneNumber=$phone&Text=$Text";
								file_get_contents($url);
								break;
							case 1:
								$ApiVersion = "20100401";
								// set our AccountSid and AuthToken
								$AccountSid = "ACf8730e89208f1dfc6f741bd6546dc055";
								$AuthToken = "45e624a756b26f8fbccb52a6a0a44ac9";
								// instantiate a new Twilio Rest Client
								$client = new TwilioRestClient($AccountSid, $AuthToken);
								$number="+1".$phone;
								$message="You are requested by ".$invitation_sender_name." to join Smartcookie,student Teacher Reward program.click following link to join ".$viral_link."sent through ".$platform_source.".";
								$response = $client>request("/$ApiVersion/Accounts/$AccountSid/SMS/Messages",
								"POST", array(
								"To" => $number,
								"From" => "7327987878",
								"Body" => $message
								));
								break;
								}
						}
						messageUser($receiver_country_code,$receiver_mobile_number,$invitation_sender_name_encodedinvitation_sender_name_encoded,$viral_link,$platform_source);


						$ab = 0;

				if($sender_entity_id == 105 || $sender_entity_id == 103)
				{
					$ab = $ab+1;
					$data = array('request_status'=>$request_status,
						'sender_entity_id'=>$sender_entity_id,
						'receiver_entity_id'=>$receiver_entity_id,
						'sender_member_id'=>$sender_member_id,
						'receiver_member_id'=>$receiver_member_id,
						'receiver_employee_id'=>$receiver_member_id,
						'firstname'=>$firstname,
						'middlename'=>$middlename,
						'lastname'=>$lastname
					);

					$ch = curl_init("https://$server_name/core/Version2/assign_promotion_points.php");
					$data_string = json_encode($data);
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_HTTPHEADER, array('ContentType: application/json','ContentLength: ' . strlen($data_string)));
					$result = json_decode(curl_exec($ch),true);
					$assign_promotion_points = $result["responseStatus"];
	//$nik = $result["responseMessage"];
					if($assign_promotion_points == 200)
					{
						//$firstname = $obj->	{'firstname'};
///$middlename = $obj->{'middlename'};
//$lastname = $obj->{'lastname'};

						$referral_activity_log_query = mysql_query("insert into referral_activity_log (sender_member_id,sender_user_type,receiver_country_code,receiver_mobile_number,receiver_email_id,invitation_sent_datestamp,acceptance_flag,receiver_member_id,method,receiver_user_type,firstname,middlename,lastname) values
						('$sender_member_id','$sender_type','$receiver_country_code','$receiver_mobile_number','$receiver_email_id','$invitation_sent_datestamp','$acceptance_flag','$receiver_member_id','$platform_source','$receiver_type','$firstname','$middlename','$lastname')");


						$postvalue['responseStatus']  = 200;
						$postvalue['responseMessage'] = "ok";
						$postvalue['posts'] = $result_mail;
						header('Contenttype: application/json');
						echo json_encode($postvalue);
					}
					else
					{
						$postvalue['responseStatus']  = 1000;
						$postvalue['responseMessage'] = "Inalid inputs from assign point web service";
						$postvalue['posts'] = null;
						header('Contenttype: application/json');
						echo json_encode($postvalue);
					}
				}
				else
				{
						$referral_activity_log_query = mysql_query("insert into referral_activity_log (sender_member_id,sender_user_type,receiver_country_code,receiver_mobile_number,receiver_email_id,invitation_sent_datestamp,acceptance_flag,receiver_member_id,method,receiver_user_type,firstname,middlename,lastname) values ('$sender_member_id','$sender_type','$receiver_country_code','$receiver_mobile_number','$receiver_email_id','$invitation_sent_datestamp','$acceptance_flag','$receiver_member_id','$platform_source','$receiver_type','$firstname','$middlename','$lastname')");


						$postvalue['responseStatus']  = 200;
						$postvalue['responseMessage'] = "ok";
						$postvalue['posts'] = $result_mail;
						header('Contenttype: application/json');
						echo json_encode($postvalue);
				}

			}
			else if($responce_from_quick_registration == 204)
			{
						$postvalue['responseStatus'] = 204;
						$postvalue['responseMessage'] = "No Response";
						$postvalue['posts'] = null;
						header('Contenttype: application/json');
						echo json_encode($postvalue);
			}
			else if($responce_from_quick_registration == 409)
			{
						$postvalue['responseStatus'] = 409;
						$postvalue['responseMessage'] = "user already exists";
						$postvalue['posts'] = null;
						header('Contenttype: application/json');
						echo json_encode($postvalue);
			}
	}
	else

	{
						$postvalue['responseStatus'] = 208;
						$postvalue['responseMessage'] = "user already requested";
						$postvalue['posts'] = null;
						header('Contenttype: application/json');
						echo json_encode($postvalue);
	}


}
else
{
				$postvalue['responseStatus'] = 1000;
				$postvalue['responseMessage'] = "invalid imput";
				$postvalue['posts'] = null;
				header('Contenttype: application/json');
				echo json_encode($postvalue);
}

//$receiver_member_id = $obj>{'receiver_member_id'};
//$accepted_date = $obj>{'accepted_date'};



//$sender_user_type = $obj>{'sender_user_type'};
//$receiver_user_type = $obj>{'sender_user_type'};


?>
