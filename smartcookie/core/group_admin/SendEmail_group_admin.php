<?php
/**
 * Created by PhpStorm.
 * User: Bpsi-Rohit
 * Date: 9/24/2017
 * Time: 1:52 PM
 */
error_reporting(0);
include('conn.php');
$email= trim( $_GET['email']);
$e_lenght=strlen(trim(($email)));
$School_id=$_GET['school_id'];
$Email_status=$_GET['status'];
$name = $_GET['name'];
if($e_lenght>0 && filter_var($email, FILTER_VALIDATE_EMAIL))
{
    $query2="select * from `tbl_school_admin` where email='$email' and school_id='$School_id'";  //query for getting last batch_id what else if are inserting first time data
    $row2=mysql_query($query2);
    $value2=mysql_fetch_array($row2);
    $password=$value2['password'];
    $school_name=$value2['school_name'];
    $email_status=$value2['email_status'];
    $status=$value2['group_status'];
    $s_name=explode(" ",$school_name);
    $scadmin_name=$value2['name'];
    $site = $_SERVER['HTTP_HOST'];
    $msgid='welcomeschooladmin';
    $res = file_get_contents("http://$site/core/clickmail/sendmail.php?status=$status&email=$email&msgid=$msgid&site=$site&pass=$password&school_name=".urlencode($school_name)."");
    if(stripos($res,"Mail sent successfully"))
    {
        echo "<script type=text/javascript>alert('Email has been sent Successfully on $email'); window.location='Send_Mail_School_admin.php'</script>";
        $date=(new \DateTime())->format('Y-m-d H:i:s');
        $sql_update="UPDATE `tbl_school_admin` SET email_status='Send_Email',email_time_log='$date' WHERE email='$email' AND school_id='$School_id'";
        $retval = mysql_query($sql_update) or die('Could not update data: ' . mysql_error());
    }
    else
    {
        echo "<script type=text/javascript>alert('Email not sent  on $email'); window.location='SendEmail_group_admin.php'</script>";
    }
}
else
{
    echo "<script type=text/javascript>alert('Sorry, Invalid Email ID'); window.location='SendEmail_group_admin.php'</script>";
}
?>


