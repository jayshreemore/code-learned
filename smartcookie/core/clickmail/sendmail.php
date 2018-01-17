
<?php

error_reporting(0);
define("SMTP_HOST", "SMTP_HOST_NAME"); //Hostname of the mail server
define("SMTP_PORT", "SMTP_PORT"); //Port of the SMTP like to be 25, 80, 465 or 587
define("SMTP_UNAME", "VALID_EMAIL_ACCOUNT"); //Username for SMTP authentication any valid email created in your domain
define("SMTP_PWORD", "VALID_EMAIL_ACCOUNTS_PASSWORD"); //Password for SMTP authentication

//include 'library.php'; // include the library file
include "class.phpmailer.php"; // include the class name

$email = $_GET['email'];
//$name = $_GET['name'];
$msgid = $_GET['msgid'];
$site = $_GET['site'];
$pass = $_GET['pass'];
$platform_source=$_GET['platform_source'];
$device_type = $_GET['device_type'];
$user_type = $_GET['user_type'];
$link = $_GET['link'];
$school_name=urldecode($_GET['school_name']);
$invitation_sender_name = urldecode($_GET['invitation_sender_name']);
$viral_link = $_GET['viral_link'];
$platform_source = $_GET['platform_source'];
$status= $_GET['status'];
$stud_first_name=$_GET['studname'];
$teach_first_name=$_GET['techname'];
$t_complete_name=urldecode($_GET['teachername']);
$stud_complete_name=urldecode($_GET['studentname']);
$school_id=$_GET['school_id'];

$myFile ="emaillog.txt";//for email log
$mail = new PHPMailer; // call the class 
$mail->IsSMTP();
$mail->Host ="smartcookie.in"; //Hostname of the mail server 
$mail->Port = 465; //Port of the SMTP like to be 25, 80, 465 or 587
$mail->SMTPAuth = true; //Whether to use SMTP authentication
$mail->SMTPDebug = false;
$mail->SMTPSecure = 'ssl';

	//Username for SMTP authentication any valid email created in your domain
	$mail->Username = "admin1@smartcookie.in"; 
	//Password for SMTP authentication
	$mail->Password = "AzXerpG(%aE9"; 
	//reply-to address
	$mail->AddReplyTo("admin1@smartcookie.in", "Smartcookie"); 
	//From address of the mail
	$mail->SetFrom("admin1@smartcookie.in", "Smartcookie"); 


// put your while loop here like below,

/*echo "Email: " . $email ;
echo "<br>";
echo "name: " . $name ;
echo "<br>";
echo "msgid: " . $msgid ;
echo "<br>";
echo "site: " . $site ;
echo "<br>";
echo "pass: " . $pass ;
echo "<br>";*/

$mail->AddAddress( "$email", "$name"); //To address who will receive this email


// 1 = Welcome Message 
// 2 = Points Message 


switch ($msgid) {
    case "welcomesponsor":
			if ($site=='dev.smartcookie.in')
					{
						$sponsorshortside="https://goo.gl/7ZAMJN";
					}
			else if($site=='test.smartcookie.in')
					{
						$sponsorshortside="https://goo.gl/E3Wajm";
					}
			else 
					{
						$sponsorshortside="https://goo.gl/7DKq7w";
					}
						$mail->Subject = "SmartCookie Sponsor Registration" ;
						$mail->MsgHTML( "Dear Sir / Ma'am,
						<br/><br/>
						CONGRATULATIONS!, you are now a registered Sponsor of <b>Smartcookie</b>.
						<br/> 
						A Student/Teacher Rewards Program
						<br/>
						Your Username is: ".$email."
						<br/>
						Your Password is: ".$pass."
						<br/>
						Web Link: ".$sponsorshortside."
						<br/>
						Your registration is successful through the Sponsor ".$platform_source." app
						<br/><br/>
						Regards,
						<br/>
						Smart Cookie Admin
						<br/>".$site);
		case "sponsorapp":
			if ($site=='dev.smartcookie.in')
					{
						$sponsorshortside="https://goo.gl/7ZAMJN";
					}
			else if($site=='test.smartcookie.in')
					{
						$sponsorshortside="https://goo.gl/E3Wajm";
					}
			else 
					{
						$sponsorshortside="https://goo.gl/7DKq7w";
					}
        $mail->Subject = "SmartCookie Sponsor Registration" ;
		$mail->MsgHTML( "Dear Sir / Ma'am,
		<br/><br/>
		CONGRATULATIONS!, you are now a registered Sponsor of <b>Smartcookie</b>.
		<br/> 
		A Student/Teacher Rewards Program
		<br/>
		Your Username is: ".$email."
		<br/>
		Your Password is: ".$pass."
		<br/>
		Android App:  https://goo.gl/NKe62N 
		<br/>
		iOS App: https://goo.gl/CZzWQq
		<br/>
		Web Link: ".$sponsorshortside."
		<br/>
		Your registration is successful through the Salesperson " .$platform_source." app
		<br/><br/>
		Regards,
		<br/>
		Smart Cookie Admin
		<br/>".$site);

        break;
		
		
    case "forsendinglink":
		$mail->Subject = "Application link for smartcokie" ;
		$mail->MsgHTML( "Dear Sir / Ma'am,
		<br/><br/>
		Thank you for choosing smartcookie.
		<br/> 
		Following is link for <strong>$device_type<strong> $user_type application 
		<br/>
		You can download Now $link
		<br/><br/><br/>
		Regards,
		<br/>
		Smart Cookie Admin
		<br/>".$site);
        break;
		
	 case "promoting_smartcookie":
		$mail->Subject = "Invitation to join smartcokie" ;
		$mail->MsgHTML( "Dear Sir / Ma'am,
		<br/><br/>
		You are requested by ".$invitation_sender_name." to join Smartcookie,Student/Teacher Reward Program.
		<br/> 
		Click on following link to join ".$viral_link."
		<br/>
		sent through ".$platform_source."
		<br/><br/><br/>
		Regards,
		<br/>
		Smart Cookie Admin
		<br/>".$site);
        break;
		
    case "welcomestudentthroughquickregitrationws":
			
			if ($site=='dev.smartcookie.in')
					{
						$studentshortside="https://goo.gl/aowMUu";
					}
			else if($site=='test.smartcookie.in')
					{
						$studentshortside="https://goo.gl/geGvYy";
					}
			else 
					{
						$studentshortside="https://goo.gl/9y5ZCi";
					}
			
		$mail->Subject = "SmartCookie Student Registration";
		$mail->MsgHTML( "
		Congratulations $stud_first_name!
		<br/>
		<br/>
		Your registration is successful as a <b>Student</b> through quick registration on Smart Student ".$platform_source." App
		<br/> 
		Username - ".$email."
		<br/>
		Password - ".$pass."
		<br/>
		School Id - OPEN
		<br/>
		Android App:  https://goo.gl/r4YMt4 
		<br/>
		iOS App:  https://goo.gl/HNqrPR
		<br/>
		Web Link: ".$studentshortside."
		<br/>
		<br/>
		
		
		Thank You!
		<br/>
		Smart Cookie Team
		<br/>"); 
        break;
	
	case "welcometeacherthroughquickregitrationws":
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
        $mail->Subject = "SmartCookie Teacher Registration";
		$mail->MsgHTML( "
		Congratulations $teach_first_name!
		<br/>
		<br/>
		Your registration is successful as a <b>Teacher</b> through quick registration on Smart Teacher ".$platform_source." App
		<br/> 
		Username - ".$email."
		<br/>
		Password - ".$pass."
		<br/>
		School Id - OPEN
		<br/>
		Android App:  https://goo.gl/89Fr11 
		<br/>
		iOS App:  https://goo.gl/cdi711
		<br/>
		Web Link: ".$teachershortside."
		<br/>
		<br/>
		Thank You!
		<br/>
		Smart Cookie Team
		<br/>"); 
        break;
		
		
		case "cookiestaff":
		
					if ($site=='dev.smartcookie.in')
								{
									$cookiestaffshortside="https://goo.gl/JR1g1E";
								}
						else if($site=='test.smartcookie.in')
								{
									$cookiestaffshortside="https://goo.gl/aL8NyC";
								}
						else 
								{
									$cookiestaffshortside="https://goo.gl/jwBXrF";
								}
					$mail->Subject = "SmartCookie Cookie Staff Registeration" ;
					$mail->MsgHTML( "Dear Sir / Ma'am,
					<br/><br/>
					CONGRATULATIONS!, you are now a registered Cookie Staff of <b>Smartcookie</b>.
					<br/> 
					A Student/Teacher Rewards Program
					<br/>
					Your Username is: ".$email."
					<br/>
					Your Password is: ".$pass."
					<br/>
					Web Link: ".$cookiestaffshortside."
					<br/>
					Your registration is successful through the Cookie Admin 
					<br/><br/>
					Regards,
					<br/>
					Smart Cookie Admin
					<br/>".$site);
		
		break;
		
		case "welcometeacherfromscadmin":
			if ($site=='dev.smartcookie.in')
					{
						$teachershortside="https://goo.gl/MWbV2E";
					}
			else if($site=='test.smartcookie.in')
					{
						$teachershortside="https://goo.gl/CaEhf8";
					}
			else if($site=='localhost.smartcookie.in')
					{
						$teachershortside="https://goo.gl/DuiSvL";
					}
			else 
					{
						$teachershortside="https://goo.gl/HdVtLL";
					}
        $mail->Subject = "Welcome To Smartcokie";
		$mail->MsgHTML( "Dear ".$t_complete_name.",
		<br/><br/>
		Your college is now a member of a Student-Teacher Reward platform (SMART COOKIE) that rewards you for your accomplishments as a teacher/mentor. It also enables you to reward your Students for their good deeds in Studies & Extracurricular activities 
		<br/>
		<br/>
		These reward points can be redeemed at various sponsor outlets for discounts on food, lifestyle, electronic items etc.
		<br/><br/>
		Your login credentials:
		<br/>
		College/School Id: ".$school_id."
		<br/>
		UserId: ".$email."
		<br/>
		Password: ".$pass."
		<br/>
		<br/>
		<br/>
		Links:
		<br/>
		Web Link:  $teachershortside
		<br/><br/>
		Download the Apps from the following link
		<br/>
		Android App:  https://goo.gl/89Fr11
		<br/>
		iOS App:  https://goo.gl/cdi711
		<br/><br/>
		
		After downloading the app kindly follow the steps given below:
		<br/>
			&nbsp;&nbsp;1. Logon with the credentials given above .
		<br/>
		&nbsp;&nbsp;2. After logging in kindly verify the following:
		<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a.	The subjects you teach
			<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b.	Your Department
			<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c.	Current Active Semester
			<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;d.	Students you teach
			<br/><br/>
			
			You have received surprise points for yourself. Kindly check the same and generate a coupon for these points, once the coupon is generated you may redeem the same at any of our sponsors located around you that you see on the ‘Sponsors around you ‘section in the app.
			<br/><br/>
			For detailed help on the app kindly visit https://$site/help/apps/teacher
			<br/><br/>
			For detailed help on the web kindly visit https://$site/help/web/teacher
			<br/><br/>
			You are now ready to go!!!!! You can reward your students for their achievements. 
			<br/><br/>
			Happy Rewarding!!!!!!!!!!!!!!!
			</br>
			
		");
        break;
		
		case "welcomestudentfromscadmin":
			if ($site=='dev.smartcookie.in')
					{
						$studentshortside="https://goo.gl/aowMUu";
					}
			else if($site=='test.smartcookie.in')
					{
						$studentshortside="https://goo.gl/geGvYy";
					}
			else 
					{
						$studentshortside="https://goo.gl/9y5ZCi";
					}
        $mail->Subject = "Welcome To SmartCookie ";
		$mail->MsgHTML( "Dear ".$stud_complete_name.",
		<br/><br/>
		Your college is now a member of a Student Teacher Reward platform that rewards you for  your accomplishments as a student and also enables you to thank your Teachers for all the motivation, mentoring etc. 
		<br/>
		<br/>
		These reward points can be redeemed at various sponsor outlets for discounts on food, lifestyle, electronic items etc.
		<br/><br/>
		Your login credentials:
		<br/>
		College/School Id: ".$school_id."
		<br/>
		UserId: ".$email."
		<br/>
		Password: ".$pass."
		<br/>
		<br/>
		<br/>
		Links:
		<br/>
		Web Link:  $studentshortside
		<br/><br/>
		Download the Apps from the following link
		<br/>
		Android App:  https://goo.gl/Ze1btD
		<br/>
		iOS App:  https://goo.gl/HNqrPR
		<br/><br/>
		
		After downloading the app kindly follow the steps given below:
		<br/>
			&nbsp;&nbsp;1. Logon with the credentials given above .
		<br/>
		&nbsp;&nbsp;2. After logging in kindly verify the following:
		<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a.	The subjects you learn
			<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b.	Your Department
			<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c.	Current Active Semester
			<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;d.	Your Teachers
			<br/><br/>
			
			You have received surprise points for yourself. Kindly check the same and generate a coupon for these points, once the coupon is generated you may redeem the same at any of our sponsors located around you that you see on the ‘Sponsors around you ‘section in the app.
			<br/><br/>
			For detailed help on the app kindly visit https://$site/help/apps/student
			<br/><br/>
			For detailed help on the web kindly visit https://$site/help/web/student
			<br/><br/>
			You are now ready to go!!!!! You can thank your teachers for the motivation, mentoring etc. and receive reward points from your teachers.
			<br/><br/>
			Happy Rewarding!!!!!!!!!!!!!!!
			</br>
			"); 
        break;
		

		case "forgotpasswordstudent":
			
			if ($site=='dev.smartcookie.in')
					{
						$studentshortside="https://goo.gl/aowMUu";
					}
			else if($site=='test.smartcookie.in')
					{
						$studentshortside="https://goo.gl/geGvYy";
					}
			else 
					{
						$studentshortside="https://goo.gl/9y5ZCi";
					}
        $mail->Subject = "Forgot Password ";
		$mail->MsgHTML( "Dear Sir / Ma'am,
		<br/><br/>
		You recently requsted to reset your password for Smartcookie Students.
		<br/> 
		Your Username is: ".$email."
		<br/>
		Your Password is: ".$pass."
		<br/>
		Smart Cookie Admin
		<br/>".$site); 
		
		break;
		
		case "forgotpasswordteacher":
			
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
        $mail->Subject = "Forgot Password ";
		$mail->MsgHTML( "Dear Sir / Ma'am,
		<br/><br/>
		You recently requsted to reset your password for Smartcookie Teacher.
		<br/> 
		Your Username is: ".$email."
		<br/>
		Your Password is: ".$pass."
		<br/>
		Smart Cookie Admin
		<br/>".$site); 
		
		break;

    case "welcomeschooladmin":
        $mail->Subject = "Welcome in SmartCookie as School Admin ";
        $mail->MsgHTML( "Dear Sir / Ma'am,
		<br/><br/>
		".$school_name." is pleased to inform that you are part of SmartCookie Student/Teacher Rewards Program as Admin ".$status."  
		<br/>
		Your Username is: ".$email."
		<br/>
		Your Password is: ".$pass."
		<br/>
		Regards,
		<br/>
		Smart Cookie Admin
		<br/>".$site);
        break;

	default:
		$mail->Subject = "SmartCookie test mail" ;
		$mail->MsgHTML( "Dear Sir / Ma'am,
		<br/><br/>
		Welcome to <b>Smartcookie</b>.
		<br/> " );	        
}

$send =$mail->Send(); //Send the mails

if($send) {
	$stringEmailStatus.=" ".date("l jS \of F Y h:i:s A") . " Email ID: " . $email . "  :: Mail sent successfully";
    echo '<h3 style="color:#009933;">Mail sent successfully</h3>';
}
else {
	$stringEmailStatus.=" ".date("l jS \of F Y h:i:s A")."  Mail error:";
	echo '<h3 style="color:#FF3300;">Mail error: </h3>'.$mail->ErrorInfo;
}
echo "\n";
$fh =fopen($myFile,'a')or die("can't open file 2");
fwrite($fh,$stringEmailStatus);
fclose($fh);

?>
