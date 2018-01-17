<?php
//forgot sp password

/* Array ( [0] => stdClass Object ( [id] => 349 [sp_name] => Sudhir Deshmukh [sp_address] => shivajinagar [sp_city] => Pune [sp_dob] => 10/01/1992 [sp_gender] => male [sp_country] => India [sp_state] => Maharashtra [sp_email] => sudhirp@roseland.com [sp_phone] => 9922449794 [sp_password] => 123 [sp_date] => 08/16/2015 [sp_occupation] => [sp_company] => Sudhirs Shop [sp_website] => www.sudhirdeshmukh.in [sp_img_path] => images/uploaded_logo/SC_51639952c2de0ed6eda1b739a88ae983.png [school_id] => [register_throught] => [lat] => 18.5308 [lon] => 73.8475 [pin] => 411038 [sales_person_id] => 0 [expiry_date] => [amount] => [v_status] => [v_likes] => [v_category] => Food [temp_phone] => [otp_phone] => 1 [temp_email] => [otp_email] => 1 ) )  */

$json = file_get_contents('php://input');
$obj = json_decode($json);
include 'conn.php';

$sp_email = $obj->{'sp_email'};


function random_password( $length = 8 ) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$password = substr( str_shuffle( $chars ), 0, $length );
	return $password;
}

if($sp_email != ""){


	$mail_check_query = mysql_query("select * from tbl_sponsorer where sp_email='$sp_email'");
	$mail_check_query_result = mysql_num_rows($mail_check_query);
	//$sp_id = $obj->{'sp_id'};
	if($mail_check_query_result>=1)
	{
			$sp_password=random_password();

			/* $q=mysql_query("update tbl_sponsorer set `sp_password`='$sp_password',`otp_email`='1' where id='$sp_id' and sp_email='$sp_email'")or die(mysql_error());
			 */
			$q=mysql_query("update tbl_sponsorer set `sp_password`='$sp_password',`otp_email`='1' where sp_email='$sp_email'")or die(mysql_error());

				if($q){
						$to=$sp_email;
						$subject="Smartcookies Password Change";
						$message="Dear Sponsor,\r\n\r\n".
							 "Congratulations! You've successfully changed your password\r\n".
							  "Your Username is: ".$sp_email."\r\n".
							  "Your Password is: ".$sp_password."\n\n".
							  "Regards,\r\n".
							  "Smart Cookie Admin \n"."www.smartcookie.in";
						$headers = 'From: smartcookiesprogramme@gmail.com' . "\r\n" .
								'X-Mailer: PHP/' . phpversion();
						$m=mail($to, $subject, $message, $headers);
						if($m){
								$m = 'mail sent successfully';
						}else{
								$m = 'mail not sent';
						}
						$postvalue['responseStatus']=200;
						$postvalue['responseMessage']="OK";
						$postvalue['posts']=$m;
				}
}
else{
		$postvalue['responseStatus']=204;
		$postvalue['responseMessage']="User not exists";
		$postvalue['posts']=null;
	}

}else{
	$postvalue['responseStatus']=1000;
	$postvalue['responseMessage']="Invalid Input";
	$postvalue['posts']=null;
}
header('Content-type: application/json');
echo  json_encode($postvalue);

?>
