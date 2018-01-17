<?php
$report="";
$report1="";
 
	 include("conn.php");

	  
	  if(isset($_POST['submit']))
	  {
	  
	  
	  $entity=$_POST['entity'];
	  $email=$_POST['email'];
	
	  //for School Admin
	  
	  if($entity==1)
	  {
	  
	   $sql=mysql_query("select * from tbl_school_admin where email='$email'");
	   
	   if(mysql_num_rows($sql)>0)
	{
	
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
 $password = substr( str_shuffle( $chars ), 0, 8 );
 
	 $from="smartcookiesprogramme@gmail.com";
	 $to=$email;
	$subject="Reset Password";
	$message="Hello ".$name."\r\n\r\n".
		 "Your new password for Smartcookie as School Admin is \n\n".
		
		  "your Username is: "  .$email.  "\n\n".
		  "your password is: ".$password."\n\n".
		  
		  "Regards,\r\n".
   	      "Smart Cookie Admin";
		  
       mail($to, $subject, $message);
	   
	   
	   $query=mysql_query("update tbl_school_admin set password='$password' where email='$email'");
	   $report1="Your password has been sent to your registered Email ID";
	
	}
	else
	{
	$report="Email ID is not registered";
	}
	   
	  
	  
	  }


//for Teacher	  
	  if($entity==2)
	  {
	  
	    $sql=mysql_query("select * from tbl_teacher where t_email='$email'");
	   
	   if(mysql_num_rows($sql)>0)
	{
	
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
 $password = substr( str_shuffle( $chars ), 0, 8 );
 
	 $from="smartcookiesprogramme@gmail.com";
	 $to=$email;
	$subject="Reset Password";
	$message="Hello ".$name."\r\n\r\n".
		 "Your new password for Smartcookie as Teacher is \n\n".
		
		  "your Username is: "  .$email.  "\n\n".
		  "your password is: ".$password."\n\n".
		  
		  "Regards,\r\n".
   	      "Smart Cookie Admin";
		  
       mail($to, $subject, $message);
	   
	   
	   $query=mysql_query("update tbl_teacher set t_password='$password' where t_email='$email'");
	    $report1="Your password has been sent to your registered Email ID";
	
	}
	else
	{
	$report="Email ID is not registered";
	}
	  
	   
	  
	  
	  }
	  
	  // for student
	   if($entity==3)
	  {
	 
	  $sql=mysql_query("select * from tbl_student where std_email='$email'");
	  
	if(mysql_num_rows($sql)>0)
	{
	
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
 $password = substr( str_shuffle( $chars ), 0, 8 );
 
	 $from="smartcookiesprogramme@gmail.com";
						  $to=$email;
	$subject="Reset Password";
	$message="Hello ".$name."\r\n\r\n".
		 "Your new password for Smartcookie as Student is \n\n".
		
		  "your Username is: "  .$email.  "\n\n".
		  "your password is: ".$password."\n\n".
		  
		  "Regards,\r\n".
   	      "Smart Cookie Admin";
		  
       mail($to, $subject, $message);
	   
	   
	   $query=mysql_query("update tbl_student set std_password='$password' where std_email='$email'");
	    $report1="Your password has been sent to your registered Email ID";
	
	}
	else
	{
	$report="Email ID is not registered";
	}
	  
	  
	  }
	  
	  
	  //for Sponsor
	   if($entity==4)
	  {
	  
	  
	  $sql=mysql_query("select * from tbl_sponsorer where sp_email='$email'");
	  
	if(mysql_num_rows($sql)>0)
	{
	
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
 $password = substr( str_shuffle( $chars ), 0, 8 );
 
	 $from="smartcookiesprogramme@gmail.com";
						  $to=$email;
	$subject="Reset Password";
	$message="Hello ".$name."\r\n\r\n".
		 "Your new password for Smartcookie as Sponsor is \n\n".
		
		  "your Username is: "  .$email.  "\n\n".
		  "your password is: ".$password."\n\n".
		  
		  "Regards,\r\n".
   	      "Smart Cookie Admin";
		  
       mail($to, $subject, $message);
	   
	   
	   $query=mysql_query("update tbl_sponsorer set sp_password='$password' where sp_email='$email'");
	    $report1="Your password has been sent to your registered Email ID";
	
	}
	else
	{
	$report="Email ID is not registered";
	}
	  
	  
	  
	  
	  }
	  
	   if($entity==5)
	  {
	  
	   $sql=mysql_query("select * from tbl_parent where email_id='$email'");
	  
	if(mysql_num_rows($sql)>0)
	{
	
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
 $password = substr( str_shuffle( $chars ), 0, 8 );
 
	 $from="smartcookiesprogramme@gmail.com";
						  $to=$email;
	$subject="Reset Password";
	$message="Hello ".$name."\r\n\r\n".
		 "Your new password for Smartcookie as Parent is \n\n".
		
		  "your Username is: "  .$email.  "\n\n".
		  "your password is: ".$password."\n\n".
		  
		  "Regards,\r\n".
   	      "Smart Cookie Admin";
		  
       mail($to, $subject, $message);
	   
	   
	   $query=mysql_query("update tbl_parent set Password='$password' where email_id='$email'");
	    $report1="Your password has been sent to your registered Email ID";
	
	}
	else
	{
	$report="Email ID is not registered";
	}
	  
	  
	  
	  
	  }
	  
	  
	  
	  }
	  
	  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
.drop-shadow {
        -webkit-box-shadow: 0 0 5px 2px rgba(0, 0, 0, .5);
        box-shadow: 0 0 5px 2px rgba(0, 0, 0, .5);
    }
    .container.drop-shadow {
        padding-left:0;
        padding-right:0;
    }

</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Resetpassword</title>
<link rel="stylesheet" href="css/bootstrap.min.css">

<script>

function valid()
{
var entity=document.getElementById('entity').value;


if(entity=="select")
{

document.getElementById('errorselect').innerHTML='Please select Role';
				
				return false;
}


else
{
document.getElementById('errorselect').innerHTML='';


}







var email=document.getElementById('email').value;

 
		if(email==null||email=="")
			{
			   
				document.getElementById('erroremail').innerHTML='Please enter email ID';
				
				return false;
			}	
	  
	  
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
			  if(!email.match(mailformat))  
				{  
				document.getElementById('erroremail').innerHTML='Please Enter valid email ID';

				return false;  
				} 
	  
	  
	  else
	  
	  {
	   document.getElementById('erroremail').innerHTML='';
				
				
	  }


}

</script>
</head>

<body>



 <div class='container' style="padding-top:100px;" >
 <div class='panel panel-primary' >
  
  
  <form method="post">
  <div class="w3-panel w3-blue w3-card-8">
 <!-- <div class="row" style="padding-top:20px;font-size:24px;">-->
  <center><p><font size="10px">Smartcookie Account Help</font></p></center>
  </div>
  
  
  <div class="row" style="padding-top:50px;">
  <div class="col-md-2"></div>
  <div class="col-md-3" style="font-size:18px;">
  
<b>Select Role in Smartcookie </b><span style="color:#FF0000;">*</span></div>
<div class="col-md-3"><select name="entity" id="entity" class="form-control greenColor">



 <?php if(isset($_POST['entity'])){
								      if($_POST['entity']=="1")
									  {?>
									  <option value="1">School admin</option>
									 <?php }
									  if($_POST['entity']=="2")
									  {?>
									  <option value="2">Teacher</option>
									 <?php  }
									  if($_POST['entity']=="3")
									  {?>
									  	  <option value="3" >Student</option>
									  <?php }
									  if($_POST['entity']=="4")
									  {?>
									  	<option value="4">Sponsorer</option>
									  <?php }
									  if($_POST['entity']=="5")
									  {?>
									  	<option value="5" selected="selected">Parent</option>
									<?php }
								
								
								
								} ?>
									

<option value="select"> Select </option>
				<option value="3" >Student</option>
				<option value="1" >School admin</option>
				<option value="2">Teacher</option>
				<option value="4" >Sponsor</option>
				<option value="5" >Parent</option>
				
</select>
     
     
     </div>
     
     <div class="col-md-3" id="errorselect" style="color:#FF0000;"></div>
     
     
     
     </div>
     
     
     <div class="row" style="padding-top:25px;"><div class="col-md-2"></div><div class="col-md-3" style="font-size:18px;"><b>Enter Email ID </b><span style="color:#FF0000;">*</span></div><div class="col-md-3"><input type="text" name="email" id="email" class="form-control" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>"  ></div>
     
     <div class="col-md-3" id="erroremail" style="color:#FF0000;"><?php echo $report;?></div>
     </div>
     
     <div class"row" style="padding-top:30px;">
     
     <center><input type="submit" name="submit" value="Continue" class="btn btn-success" onclick="return valid()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="login.php"><input type="button"  value="Back" class="btn btn-danger" style="width:7%;"></a></center>
     </div>
     
     <div class="row" style="padding-top:30px; color:#009933;">
     
     <center><?php echo $report1;?></center>
     </div>
     
     <div class="row" style="padding-top:20px;"></div>
     
     
    
     
     
  </form>

  </div>
  
   </div> 
  
  
  
  
</body>
</html>
