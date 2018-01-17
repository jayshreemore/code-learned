<?php  
//$json=$_GET ['json'];
$json = file_get_contents('php://input');
$obj = json_decode($json);
//echo $obj->{'User_FName'};die;
//Save
 $format = 'json';

$email_id=$obj->{'email'};
$entity_id=$obj->{'entity_id'};

include 'conn.php';

 
if( $email_id!="" && $entity_id!="")
{
  
  $posts=array();
  
  if($entity_id==1)
  
  {			
 
  
  $arr=mysql_query("select * from tbl_student where std_email='$email_id'");
  $count = mysql_num_rows($arr);
  if($count>0)
  {
  
  $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
 $password = substr( str_shuffle( $chars ), 0, 8 );
 
	/* $from="smartcookiesprogramme@gmail.com";
	 $to=$email_id;
	$subject="Reset Password";
	$message="Dear Student,\r\n\r\n".
						 "Thanks for your registration with Smart Cookie as student\r\n".
						  "Your Username is: ".$email_id."\n\n".
						  "Your Password is: ".$password."\n\n".
						  "Regards,\r\n".
						  "Smart Cookie Admin \n"."www.smartcookie.in";
		  
       mail($to, $subject, $message);*/
	   
						$site = $_SERVER['HTTP_HOST'];
						$msgid='forgotpasswordstudent';
						$res = file_get_contents("http://$site/core/clickmail/sendmail.php?email=$email_id&msgid=$msgid&site=$site&pass=$password");
	   
	   
	   $query=mysql_query("update tbl_student set std_password='$password' where std_email='$email_id'");
	    $report="Your password has been sent to your registered Email ID";
		
		
					  $posts[]=array('report'=>$report);
					  
		$postvalue['responseStatus']=200;
				$postvalue['responseMessage']="OK";
				$postvalue['posts']=$posts;
  
  
  }
  else
  {
  $postvalue['responseStatus']=204;
								$postvalue['responseMessage']="No Response";
								$postvalue['posts']=null;
  
  }
  
  
  if($format == 'json') {
							header('Content-type: application/json');
    						 echo json_encode($postvalue);
						}
					 
  
 }
 
   if($entity_id==2)
   
   {
   
   
    $arr=mysql_query("select * from tbl_teacher where t_email='$email_id'");
	$count = mysql_num_rows($arr);
  if($count>0)
  {
	
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
 $password = substr( str_shuffle( $chars ), 0, 8 );
 
	 /*$from="smartcookiesprogramme@gmail.com";
	 $to=$email_id;
	$subject="Reset Password";
		$message="Dear Teacher,\r\n\r\n".
						 "Thanks for your registration with Smart Cookie as teacher\r\n".
						  "Your Username is: ".$email_id."\n\n".
						  "Your Password is: ".$password."\n\n".
						  "Regards,\r\n".
						  "Smart Cookie Admin \n"."www.smartcookie.in";
		  
       mail($to, $subject, $message);*/
	   	   
						$site = $_SERVER['HTTP_HOST'];
						$msgid='forgotpasswordteacher';
						$res = file_get_contents("http://$site/core/clickmail/sendmail.php?email=$email_id&msgid=$msgid&site=$site&pass=$password");   
	   
	   $query=mysql_query("update tbl_teacher set t_password='$password' where t_email='$email_id'");
	    $report="Your password has been sent to your registered Email ID";
		  $posts[]=array('report'=>$report);
					  
		$postvalue['responseStatus']=200;
				$postvalue['responseMessage']="OK";
				$postvalue['posts']=$posts;
	
	}
	else
	{
						$postvalue['responseStatus']=204;
								$postvalue['responseMessage']="No Response";
								$postvalue['posts']=null;
	}
	  
	  
	  
	  if($format == 'json') {
							header('Content-type: application/json');
    						 echo json_encode($postvalue);
						}
					 
 
   }      
  
		
}

		
	else 
			{
			   $postvalue['responseStatus']=1000;
				$postvalue['responseMessage']="Invalid Input";
				$postvalue['posts']=null;
			  
			  header('Content-type: application/json');
   			  echo  json_encode($postvalue); 
			 
			}	
			
			
			  
			
	
		
  ?>

		
