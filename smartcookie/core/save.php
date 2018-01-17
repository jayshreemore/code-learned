<?php
include 'coupon.inc.php';

//Get the base-64 string from data
$filteredData=substr($_POST['img_val'], strpos($_POST['img_val'], ",")+1);
 
//Decode the string
$unencodedData=base64_decode($filteredData);

 $user=$_SESSION['id'];
 $entity=$_SESSION['entity'];

 if($entity==3){
	$p= mysql_query("SELECT std_name,std_email FROM `tbl_student` WHERE `id`=$user");
	$q=mysql_fetch_array($p);
	$email=$q['std_email'];
	$name=$q['std_name'];
 }elseif($entity==2){
	$p= mysql_query("SELECT t_name,t_complete_name,t_middlename,t_lastname,t_email FROM `tbl_teacher` WHERE `id`=$user");
	$q=mysql_fetch_array($p);
	$email=$q['t_email'];
	$t_complete_name=$q['t_complete_name'];
	$t_name=$q['t_name'];
	$t_middlename=$q['t_middlename'];
	$t_lastname=$q['t_lastname'];
	if($t_complete_name!=""){	
	$name=$t_complete_name;
	}else{
	$name=$t_name.' '.$t_middlename.' '.$t_lastname;	
	}
 }
 
 
	$im='C'.$entity.'_'.$user.'_'.time();

file_put_contents('images/mailed_coupons/'.$im.'.png', $unencodedData);
 echo "<div id='div_print'>";
echo '<img src="http://'.$_SERVER['HTTP_HOST'].'/images/mailed_coupons/'.$im.'.png">';
echo '</div>';

$message = '
<html>
<body>
	<p>Hello <strong>'.$name.'</strong>,<br /> Here are your unused SmartCookie coupons.<br/>Print them and use them at vendor\'s place. </p>
	<p>
  <img src="'.$_SERVER['HTTP_HOST'].'/images/mailed_coupons/'.$im.'.png">
  </p><br/><p>
  Thanks & Regards,<br/>
	Cookies Team<br/>
	<a href="http://www.smartcookie.in">www.smartcookie.in</a>	
  </p>
</body>
</html>
';


$to  = $email; // note the comma


$subject = 'Smartcookie Sponsor Coupons';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'To: '.trim($name).' <'.$email.'>'. "\r\n";
$headers .= 'From: SmartCookie <sudhirp@roseland.com>' . "\r\n";
//$headers .= 'Bcc: sudhirp@roseland.com' . "\r\n";


// Mail it
if(mail($to, $subject, $message, $headers)){
	echo "<script>
	alert('Email sent to ".$to."');
	</script>";
}else{
	echo "<script>
	alert('Unable to send email');
	</script>";
}

?>
<head>
<link rel="stylesheet" type="text/css" href="bootstrap.css">
<script language="javascript">
function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
</script>
</head>
<input class="btn btn-primary" name="b_print" type="button" class="ipt"   onClick="printdiv('div_print');" value=" Print ">
<a href="view_print_coupons.php"><button class="btn btn-primary" >Go back</button></a>