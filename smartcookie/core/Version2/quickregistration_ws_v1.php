<?php
ini_set("max_execution_time", "-1");
ini_set("memory_limit", "-1");
ignore_user_abort(true);
set_time_limit(0);
$json = file_get_contents('php://input');
$obj = json_decode($json);
$format = 'json'; //xml is the default
include 'conn.php';

require "twilio.php";

		$firstname = $obj->	{'firstname'};
		$middlename = $obj->{'middlename'};
		$lastname = $obj->{'lastname'};
		$password = $obj->{'password'};
		$phonenumber = $obj->{'phonenumber'};
		$emailid = $obj->{'emailid'};
		$countrycode = $obj->{'countrycode'};
		$platform_source=$obj->{'platform_source'};
		$type = $obj->{'type'};
						/*$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
						$password = substr(str_shuffle($chars) , 0, 8);*/
						

							// validation of input

							if ($phonenumber != "" && $emailid != "" && $firstname != "" && $lastname != "" && filter_var($emailid, FILTER_VALIDATE_EMAIL) && strlen($phonenumber) == 10)
								{

								// for student

								if ($type == "student")
									{
									$std_complete_name = $firstname . " " . $middlename . " " . $lastname;
									$row = mysql_query("select * from tbl_student where std_email like '$emailid' or std_phone='$phonenumber'");

									// email id and phone already exist

									if (mysql_num_rows($row) <= 0)
										{
										mysql_query("insert into tbl_student(std_complete_name,std_name,std_lastname,std_Father_name,std_phone,school_id,std_email,std_password,country_code) values ('$std_complete_name','$firstname','$lastname','$middlename','$phonenumber','OPEN','$emailid','$password','$countrycode')");
										
										$next_id = mysql_insert_id();
										mysql_query("update tbl_student set std_PRN='$next_id' where std_email='$emailid' and school_id='OPEN'");
										
										$row_student = mysql_query("select id, std_password,std_name from tbl_student where std_email like '$emailid'");
										
										/* create one master array of the records */
										$postvalue = array();
										if (mysql_num_rows($row_student) > 0)
											{
											while ($post = mysql_fetch_assoc($row_student))
												{
												$std_password = $post['std_password'];
												$student_name = $post['std_name'];
												$student_id = (int)$post['id'];
												
												$posts[] = array(
													'id' => $student_id,
													'password' => $std_password,
												);

												// mail to student

											/*	$to = $emailid;
												$from = "smartcookiesprogramme@gmail.com";
												$subject = "Smartcookies Registration";
												$message = "Dear Student,\r\n\r\n" . "Thanks for your registration with Smart Cookie as Student\r\n" . "Your Username is: " . $emailid . "\n\n" . "Your Password is: " . $password . "\n\n" . "Android APP:  https://goo.gl/r4YMt4 \n\n" . "iOS APP:  https://goo.gl/HNqrPR \n\n" . "Website: www.smartcookie.in \n\n" . "Regards,\r\n" . "Smart Cookie Admin";
												mail($to, $subject, $message);*/
												
												
												$site = $_SERVER['HTTP_HOST'];
												$msgid='welcomestudentthroughquickregitrationws';
												$res = file_get_contents("http://$site/core/clickmail/sendmail.php?email=$emailid&msgid=$msgid&site=$site&pass=$password&platform_source=$platform_source&studname=$student_name");
												if(stripos($res,"Mail sent successfully"))
												{
													$result_mail = 'mail sent successfully';
												}
												else{
													$result_mail = 'mail not sent';
												} 
												
												
												
												$StudentAndroidApp="https://goo.gl/r4YMt4";
												$StudentiOSApp="https://goo.gl/HNqrPR";
												$TeacherAndroidApp="https://goo.gl/89Fr11";
												$TeacheriOSApp="https://goo.gl/cdi711";
												
												if ($countrycode == 91)
													{
														$Text = "Congratulations!+" . $firstname . "+" . $lastname . "+Your+registration+is+successful+as+Student+through+quick+registration+on+www.smartcookie.in+Your+Username+is+" . $emailid . "+and+Password+is+" . $password . "+Android+App:+" . $StudentAndroidApp ."+iOS+App:+"  . $StudentiOSApp ."+on+" .$platform_source."+app";
														
													$url = "http://www.smswave.in/panel/sendsms.php?user=blueplanet&password=123123&sender=PHUSER&PhoneNumber=$phonenumber&Text=$Text";
													file_get_contents($url);
													}
												  else
												if ($countrycode == 1)
													{
													$ApiVersion = "2010-04-01";

													// set our AccountSid and AuthToken

													$AccountSid = "ACf8730e89208f1dfc6f741bd6546dc055";
													$AuthToken = "45e624a756b26f8fbccb52a6a0a44ac9";

													// instantiate a new Twilio Rest Client

													$client = new TwilioRestClient($AccountSid, $AuthToken);
													$number = "+1" . $phonenumber;

													$message = "Congratulations!" .$firstname . " " . $lastname . "Your registration is successful through quickregitration on www.smartcookie.in Your Username is" . $phonenumber . " and Password is " . $pass . "Android App:" . $StudentAndroidApp ."iOS APP:" .$StudentiOSApp ."on" . $platform_source . "app.";
													
													$response = $client->request("/$ApiVersion/Accounts/$AccountSid/SMS/Messages", "POST", array(
														"To" => $number,
														"From" => "732-798-7878",
														"Body" => $message
													));
													}
												  else
													{
													}
												}

											$postvalue['responseStatus'] = 200;
											$postvalue['responseMessage'] = "OK";
											$postvalue['mailstatus'] = $result_mail;
											$postvalue['posts'] = $posts ;
											header('Content-type: application/json');
											echo json_encode($postvalue);
											}
										  else
											{
											$postvalue['responseStatus'] = 204;
											$postvalue['responseMessage'] = "No Response";
											$postvalue['posts'] = null;
											header('Content-type: application/json');
											echo json_encode($postvalue);
											}
										}
									  else
										{
										$postvalue['responseStatus'] = 409;
										$postvalue['responseMessage'] = "conflict";
										$postvalue['posts'] = null;
										header('Content-type: application/json');
										echo json_encode($postvalue);
										}
									}

								// for teacher

								  else
								if ($type == "teacher")
									{
									$teacher_complete_name = $firstname . " " . $middlename . " " . $lastname;
									$row = mysql_query("select * from tbl_teacher where t_email like '$emailid' or t_phone='$phonenumber'");
									if (mysql_num_rows($row) <= 0)
										{
										mysql_query("insert into tbl_teacher(t_complete_name,t_name,t_lastname,t_middlename,t_phone,t_email,t_password,school_id) values ('$teacher_complete_name','$firstname','$lastname','$middlename','$phonenumber','$emailid','$password','OPEN')");
										$next_id = mysql_insert_id();
										mysql_query("update tbl_teacher set t_id='$next_id' where t_email='$emailid' and school_id='OPEN'");
										$row_teacher = mysql_query("select id,t_password,t_name from tbl_teacher where t_email like '$emailid'");
										if (mysql_num_rows($row_teacher) > 0)
											{
											while ($post = mysql_fetch_assoc($row_teacher))
												{
												$t_password = $post['t_password'];
												$t_name = $post['t_name'];
												$teacher_id = (int)$post['id'];
												$posts[] = array(
													'id' => $teacher_id,
													'password' => $t_password
												);

												// mail to student

												/*$to = $emailid;
												$from = "smartcookiesprogramme@gmail.com";
												$subject = "Smartcookies Registration";
												$message = "Dear Student,\r\n\r\n" . "Thanks for your registration with Smart Cookie as Teacher\r\n" . "Your Username is: " . $emailid . "\n\n" . "Your Password is: " . $password . "\n\n" . "Android APP: https://goo.gl/89Fr11  \n\n" . "iOS APP: https://goo.gl/cdi711  \n\n" . "Website: www.smartcookie.in \n\n" . "Regards,\r\n" . "Smart Cookie Admin ";
												mail($to, $subject, $message);
												*/
												
												
												
												$site = $_SERVER['HTTP_HOST'];
												$msgid='welcometeacherthroughquickregitrationws';
												$res = file_get_contents("http://$site/core/clickmail/sendmail.php?email=$emailid&msgid=$msgid&site=$site&pass=$password&platform_source=$platform_source&techname=$t_name");
												
												if(stripos($res,"Mail sent successfully"))
												{
													$result_mail = 'mail sent successfully';
												}
												else{
													$result_mail = 'mail not sent';
												}
										
												if ($countrycode == 91)
													{

													$Text = "Congratulations!+" . $firstname . "+" . $lastname . "+Your+registration+is+successful+as+Teacher+through+quickregitration+on+www.smartcookie.in+Your+Username+is+" . $emailid . "+and+Password+is+" . $password . "+Android+App:+" . $TeacherAndroidApp ."+iOS+App:+"  . $TeacheriOSApp ."+on+" .$platform_source."+app";
													
													$url = "http://www.smswave.in/panel/sendsms.php?user=blueplanet&password=123123&sender=PHUSER&PhoneNumber=$phonenumber&Text=$Text";
													file_get_contents($url);
													}
												  else
												if ($countrycode == 1)
													{
													$ApiVersion = "2010-04-01";

													// set our AccountSid and AuthToken

													$AccountSid = "ACf8730e89208f1dfc6f741bd6546dc055";
													$AuthToken = "45e624a756b26f8fbccb52a6a0a44ac9";

													// instantiate a new Twilio Rest Client

													$client = new TwilioRestClient($AccountSid, $AuthToken);
													$number = "+1" . $phonenumber;

													$message = "Congratulations!" .$firstname . " " . $lastname . "Your registration is successful through quickregitration on www.smartcookie.in Your Username is" . $phonenumber . " and Password is " . $pass . "Android App:" . $StudentAndroidApp ."iOS APP:" .$StudentiOSApp ."on" . $platform_source . "app.";
													
													$response = $client->request("/$ApiVersion/Accounts/$AccountSid/SMS/Messages", "POST", array(
														"To" => $number,
														"From" => "732-798-7878",
														"Body" => $message
													));
													}
												  else
													{
													}
												}

											$postvalue['responseStatus'] = 200;
											$postvalue['responseMessage'] = "OK";
											$postvalue['posts'] = $posts;
											header('Content-type: application/json');
											echo json_encode($postvalue);
											}
										  else
											{
											$postvalue['responseStatus'] = 204;
											$postvalue['responseMessage'] = "No Response";
											$postvalue['posts'] = null;
											header('Content-type: application/json');
											echo json_encode($postvalue);
											}
										}
									  else
										{
										$postvalue['responseStatus'] = 409;
										$postvalue['responseMessage'] = "conflict";
										$postvalue['posts'] = null;
										header('Content-type: application/json');
										echo json_encode($postvalue);
										}
									}
								}
							  else
								{
								$postvalue['responseStatus'] = 1000;
								$postvalue['responseMessage'] = "Invalid Input";
								$postvalue['posts'] = null;
								header('Content-type: application/json');
								echo json_encode($postvalue);
								}

							/* disconnect from the db */
							@mysql_close($con);
?>