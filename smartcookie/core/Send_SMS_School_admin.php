<?php
error_reporting(0);
include("cookieadminheader.php");
include('conn.php');
require "twilio.php";
$phone=$_GET['phone'];
$p_lenght=strlen(trim(($phone)));
$School_id=$_GET['school_id'];
$Sms_status=$_GET['status'];
$Country=$_GET['country'];
//$email = $_GET['email'];
$msgid = $_GET['msgid'];
$pass = $_GET['pass'];
$site = $_GET['site'];
$query2="select * from `tbl_school_admin` where mobile='$phone' and school_id='$School_id'";
$row2=mysql_query($query2);
$value2=mysql_fetch_array($row2);
$password=$value2['password'];
$email=$value2['email'];
$status=$value2['send_sms_status'];
$school_name=$value2['school_name'];
$group_status=$value2['group_status'];
$s_name=explode(" ",$school_name);
$sc_name=$s_name[0]."".$s_name[1]."".$s_name[2]."".$s_name[3];
$site = $_SERVER['HTTP_HOST'];

if($Country!='')
{
    if($Country=='India' || $Country=='india' || $Country=='IN')   // India
    {
        $cc=91;
        if($p_lenght>0 && $p_lenght==10)
        {
            function messageUser($cc,$phone,$email,$password,$group_status)
            {
                $Text="CONGRATULATIONS!+,+You+are+registered+as+a+admin+-+".$group_status."+in+Smart+Cookie+-+A+Student+/+Teacher+Rewards+Program.+Username+:+".$email."++Password+:+".$password."";
                $url="http://www.smswave.in/panel/sendsms.php?user=blueplanet&password=123123&sender=PHUSER&PhoneNumber=$phone&Text=$Text";
                file_get_contents($url);
            }
            messageUser($cc,$phone,$email,$password,$group_status);
            $date=(new \DateTime())->format('Y-m-d H:i:s');

            $sql_update="UPDATE `tbl_school_admin` SET send_sms_status='Send_SMS',sms_time_log='$date' WHERE mobile='$phone' AND school_id='$School_id'";
            $retval = mysql_query($sql_update) or die('Could not update data: ' . mysql_error());
            echo "<script type=text/javascript>alert('SMS has been sent Successfully on $phone'); window.location='Send_Mail_School_admin.php'</script>";
        }
        else
        {
            echo "<script type=text/javascript>alert('Sorry,Invalid Phone No.'); window.location='Send_Mail_School_admin.php'</script>";
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
        $Text="CONGRATULATIONS You are registered as School Admin in Smartcookie your UserID: $email , Password: $password <br>Thanks ";
        $res = $client->request("/$ApiVersion/Accounts/$AccountSid/SMS/Messages",
            "POST", array(
                "To" => $number,
                "From" => "732-798-7878",
                "Body" => $Text
            ));
        echo "<script type=text/javascript>alert('SMS has been sent Successfully on $number'); window.location='Send_Mail_School_admin.php'</script>";
        $date=(new \DateTime())->format('Y-m-d H:i:s');
        $sql_update="UPDATE `tbl_teacher` SET send_unsend_status='Send_SMS',sms_time_log='$date' WHERE t_phone='$phone' AND school_id='$School_id'";
        $retval = mysql_query($sql_update) or die('Could not update data: ' . mysql_error());
    }
}
else
{
    echo "<script type=text/javascript>alert('Sorry,Unable to send message without Country name'); window.location='Send_Mail_School_admin.php'</script>";
}
?>