
<?php

$report=""; 
include('conn.php');
if(!isset($_SESSION['id']))
	{
		header('location:login.php');
	}
 $query = mysql_query("select * from tbl_teacher where id = ".$_SESSION['id']);
	 $value = mysql_fetch_array($query);
	         $teacher_id=$value['t_id'];
			  $sc_id=$value['school_id'];
			 
if(isset($_POST['submit']))
	{
		
		$id=$_GET['id'];
		$t_id=$_SESSION['id'];
		if($id==1)
		{
			
			
			//$allowed =  array('gif','png' ,'jpg');
$filename = $_FILES['filUpload']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

//echo $ext;


//echo "<script>alert($ext)</script>";die;
//if(!in_array($ext,$allowed) ) {
    //echo 'error';
//}

		
				if($filename!=""&& ($ext=='gif'||$ext=='png'||$ext=='jpg'))
				 {
				   $img= $_FILES['filUpload']['name'];
				 echo	$ex_img = explode(".",$img);
                    $img_name = $ex_img[0]."_".$id.".".$ex_img[1];
				 
$year=date('Y');
$entity="Teacher";
$college=trim($value['college_mnemonic']);
$start_dir="Images";
$path=$start_dir.'/'.$sc_id.'/'.$entity.'/'.$sc_id.'_';
if(!file_exists($path)){
	mkdir($path, 0777, true);
}
					
					$filenm=$path.$img_name;
				 
		 mysql_query("update tbl_teacher set t_pc='$filenm'   where id='$t_id'");
		move_uploaded_file($_FILES['filUpload']['tmp_name'],$filenm);
		if(mysql_affected_rows()>=0)
			  {
			  	$report="successfully accepted";
			  }
			  header('Location:teacher_profile.php');
			  

			  }
			  else
			  {
				  
				  echo "<h4 style='text-align:center;color:red;'>please select proper image</h4>";
			  }
				 
		}
		 if($id==2)
		 {
		     $t_name=$_POST['t_name'];
		
			  $date=$_POST['t_dob'];
			$dates = date('m/d/Y');
			 list($month,$day,$year) = explode("/",$date);
    $year_diff  = date("Y") - $year;
    $month_diff = date("m") - $month;
    $day_diff   = date("d") - $day;
    if ($day_diff < 0 || $month_diff < 0) $year_diff--;
    $age= $year_diff;
		 $t_gender=$_POST['t_gender'];
			
			 $arr= mysql_query("update tbl_teacher set t_name='$t_name',t_dob='$date',t_age='$age',t_gender='$t_gender' where id='$t_id'");
			  if(mysql_affected_rows()>=0)
			  {
			  	$report="successfully accepted";
			  }
			  header('Location:teacher_profile.php');
		 
		 
		   
		 }
		 if($id==4)
		 {
		 		$t_email=$_POST['t_email'];
				$t_address=$_POST['t_address'];
				$t_password=$_POST['t_password'];
				$t_phone=$_POST['t_phone'];
				$t_landline=$_POST['t_landline'];
				$t_internal_emailid=$_POST['t_internal_email'];
				$t_pincode=$_POST['t_pincode'];
				
				
				 $sql="update tbl_teacher set t_permanent_pincode='$t_pincode',t_internal_email='$t_internal_emailid',t_landline='$t_landline',t_password='$t_password', t_address='$t_address',t_email='$t_email',t_phone='$t_phone' where t_id='$teacher_id' and school_id='$sc_id'";
				 mysql_query($sql);
			  if(mysql_affected_rows()>=0)
			  {
			  $report="successfully accepted";
			 
			  }
				 header('Location:teacher_profile.php');
			}
		
		
		if($id==5)
		{
			$school_id=$_POST['t_current_school_name'];
			$sql2=mysql_query("select school_name from tbl_school where id='$school_id'");
			$test=mysql_fetch_array($sql2);
			$t_current_school_name=$test['school_name'];
			
				 
				$t_exprience=$_POST['t_exprience'];
				$t_dept=$_POST['t_dept'];		
				$t_ID=$_POST['t_id'];	
				$t_app_date=$_POST['t_date_app'];	
				$t_empid=$_POST['t_pid'];	
		    mysql_query("update tbl_teacher set t_current_school_name='$t_current_school_name',t_exprience='$t_exprience',school_id='$school_id',t_dept='$t_dept',t_id='$t_ID',t_date_of_appointment='$t_app_date',t_emp_type_pid='$t_empid' where t_id='$teacher_id' and school_id='$sc_id'");
		if(mysql_affected_rows()>=0)
			  {
			  
			  header('Location:teacher_profile.php');
			  }
		
		}
		
		
			
		if($id==6)
		{
			$t_qualification=$_POST['t_qualification'];
				
		    mysql_query("update tbl_teacher set t_qualification='$t_qualification' where id='$t_id'");
		if(mysql_affected_rows()>=0)
			  {
			  
			  header('Location:teacher_profile.php');
			  }
		
		}
		
		
		
		
		
		
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
 <style>

</style> 
<title>Update Teacher Profile </title>
 <script>
  $(function() {
    $( "#t_dob" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  });
  </script>
<script>
function validqualification()
{

var t_qualification=document.getElementById("t_qualification").value;
if(t_qualification==null||t_qualification=="")
 			{
			  
				document.getElementById('errorqualification').innerHTML='Please enter Qualification';
				
				return false;
			}
			regx1=/^[A-z ]+$/;
			
			if(!regx1.test(t_qualification))
				{
					document.getElementById('errorqualification').innerHTML='Please enter valid Qualification';
					return false;
				}
 
 
 else
			{
				document.getElementById('errorqualification').innerHTML='';
			}

}



function validBasic()
{

 var t_name=document.getElementById("t_name").value;
 
 var t_dob=document.getElementById("t_dob").value;
 var t_age=document.getElementById("t_age").value;
 alert("hi");
 regx1=/^[A-z ]+$/;
	regx2=/^[0-9 .]+$/;
	
 		var t_name=document.getElementById("t_name").value;
		   if(t_name==null||t_name=="") 
		   {
		    document.getElementById('errorname').innerHTML='Please enter Name';
				return false;
			}
			
			
			 if(!regx1.test(t_name))
		   {
				document.getElementById('errorname').innerHTML='Please enter valid Name';
					return false;
		   }
		   else
			{
				document.getElementById('errorname').innerHTML="";
			}
 
 

		if(t_dob=="")
			{
				alert('hi');
			 
				document.getElementById('errordob').innerHTML='Please enter Date of Birth';
				return false;
			}
			
				else
			{
				document.getElementById('errordob').innerHTML='';
			}
			
			
			if(t_age==null||t_age=="")
			{
				document.getElementById('errorage').innerHTML='Please enter Age';
				
				return false;
			}
			
				else
			{
				document.getElementById('errorage').innerHTML='';
			}
			
			
			regx=/^[0-9]{1,10}$/;
				//validation of mobile
				
				if(!regx.test(t_age))
				{
					document.getElementById('errorage').innerHTML='Please enter valid Age';
					return false;
				}
			
			else
			{
			document.getElementById('errorage').innerHTML='';
			}
		
}




function validcontact()
{


 var t_email=document.getElementById("t_email").value;
 var t_address=document.getElementById("t_address").value;
 var t_phone=document.getElementById("t_phone").value;
 var password=document.getElementById("t_password").value;
 var password1=document.getElementById("c_password").value;
 
 if((t_phone.length)!=10)
 {

 document.getElementById('errorphone').innerHTML='Please enter valid Phone Number';
 return false;
 }
 regx1=/^[A-z ]+$/;
if(t_address==null||t_address=="")
 			{
			  
				document.getElementById('erroraddress').innerHTML='Please enter Address';
				
				return false;
			}
			else
			{
			document.getElementById('erroraddress').innerHTML='';
			}
			
			if(password==null||password=="")
 			{
			  
				document.getElementById('errorpassword').innerHTML='Please enter Password';
				
				return false;
			}
			
			else
			{
			document.getElementById('errorpassword').innerHTML='';
			}
			
			if(password1==null||password1=="")
 			{
			  
				document.getElementById('errorcpassword').innerHTML='Please enter  Password';
				
				return false;
			}
			
			if(password!=password1)
			
			{
			
			document.getElementById('errorcpassword').innerHTML='Password and Confirm Password should be match' ;
				
				return false;
			
			}
			
				else
			{
			document.getElementById('errorcpassword').innerHTML='';
			}
			
			
			if(t_phone==null||t_phone=="" ||t_phone==0)
 			{
			  
				document.getElementById('errorphone').innerHTML='Please enter Phone Number';
				return false;
				
			}			
			
			
			else
			{
			document.getElementById('errorphone').innerHTML='';
			}
			
			if(t_email==null||t_email=="")
 			{
			  
				document.getElementById('erroremail').innerHTML='Please enter Email Address';
				
				return false;
			}			
			
			else
			{
			document.getElementById('erroremail').innerHTML='';
			}
			


                var atpos = t_email.indexOf("@");
				var dotpos = t_email.lastIndexOf(".");
				if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=x.length) {
					document.getElementById('erroremail').innerHTML='Please enter valid Email Id';
					return false;
				}

 
			
		
}
function valideducation()
{


	 var t_current_school_name=document.getElementById("t_current_school_name").value;
	
 			if(t_current_school_name=='select')
				{
				  
					document.getElementById('errorschoolname').innerHTML='Please select School';
				    return false;
				}
					else
			{
			document.getElementById('errorschoolname').innerHTML='';
			}
			
			
			
			
			 var t_exprience=document.getElementById("t_exprience").value;
	
 			if(t_exprience==null||t_exprience=="")
				{
				  
					document.getElementById('errorexperience').innerHTML='Please enter Experince';
				    return false;
				}
				
					else
			{
			document.getElementById('errorexperience').innerHTML='';
			}
			
				
				regx=/^[0-9]{1,10}$/;
				//validation of mobile
				
				if(!regx.test(t_exprience))
				{
					document.getElementById('errorexperience').innerHTML='Please enter valid Experience';
					return false;
				}
			
				else
			{
			document.getElementById('errorexperience').innerHTML='';
			}
			

}
</script>

 <script>
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

</script>

</head>

<body>
<div style="width:100%;">
<?php $id=$_GET['id'];

if($id==1)
	{?>


<div class="row">
   <div class="col-md-3">   </div>
 
    <div class="col-md-6" style="padding:80px;">
    <div class="panel panel-primary" align="center">
        <form name="f1" method="post" enctype="multipart/form-data">
          <div style="padding:10px 10px 10px 10px; background-image:url(image/index.jpg); color:#000000; border:1px solid #CCCCCC;">
                    <div style="padding:10px; height:20px;  font-size:18px; font-weight:bold;">Profile Picture</div>
                    <p style="font-size:24px; color:#0080FF;padding:10px;"> <div>
<input type="file" name="filUpload" id="filUpload" onchange="showimagepreview(this)" accept="image/*"/>
</div></p>
                 <div style="padding-top:20px;">   <input type='submit' value='Update' name='submit' /> &nbsp;&nbsp;   <a href="teacher_profile.php"><input type='button' value='Cancel' name='cancel'/></a></div>
           </div>
           </form>
           </div>
           </div>
  </div>
<?php	}

if($id==2)

{?>

<div class="row">
<div class="col-sm-4"></div>
<div class="col-sm-5" style="padding:40px;">
    <div class="panel panel-primary" >
<div class="">
	<form name="f1" method="post" enctype="multipart/form-data" >
		   <div style="padding:10px 10px 10px 10px; background-image:url(image/index.jpg); color:#000000; border:1px solid #CCCCCC;">
         <div style="padding:10px; height:20px;  font-size:18px; font-weight:bold;"><center>Basic Information</center></div>
			
			<div class="row" style="padding-top:40px;">
           <div class="col-md-2"></div>
				<div class="col-sm-4"><strong>Name</strong></div>
                
                
				<div class="col-sm-6">
					<input type="text"name="t_name" id="t_name" value='<?php echo $value['t_name']; ?>'/>
				</div>
			</div>
               
                     <div align="center" id="errorname" name="errorname" style="color:#FF0000;font-weight:bold;"></div>
             
			
            
            <div class="row" style="padding-top:20px;">
             <div class="col-md-2"></div>
            <div class="col-sm-4"><strong>Date of Birth</strong></div>
				
				<div class="col-sm-6">
					<?php $date=$value['t_dob'];?>
                    <input type="text" name="t_dob"  id="t_dob" value='<?php echo $value['t_dob'];?>'>
				</div>
			</div>
                     
			
               
            <div align="center" id='errordob' style="color:#FF0000;padding:5px;font-weight:bold;"></div>
            
            
            
                      
            
			<div class="row" style="padding-top:20px;">
            <div class="col-md-2"></div>
				 <div class="col-sm-4"><strong>Gender</strong></div>
                                <div class="col-sm-6">
                                     <?php  if( $value['t_gender']=='Male'){?>
                     
                          Male
                            <input type="radio" id='t_gender' name="t_gender" value="Male" checked >
                        
                       &nbsp; Female
                            <input type="radio" id='t_gender' name="t_gender" value="Female">
                        
                        <?php }else{?>
                         
                          Male
                            <input type="radio" id='t_gender' name="t_gender" value="Male" >
                        
                      &nbsp; Female
                            <input type="radio" id='t_gender' name="t_gender" value="Female" checked>
                        
                        <?php }?>
                                 </div>
				</div>
			
     
            
            
            
            
            
		
					 <div style="padding-top:40px;"><center>  <input type='submit' value='Update' name='submit' onClick="return validBasic()" /> &nbsp;&nbsp;  <a href="teacher_profile.php"><input type='button' value='Cancel' name='cancel' /></a></center></div>
			</div>	
	</form>
</div>
</div>
</div>
</div>


<?php  }if($id==4){?>
<div class="row" style="padding:30px;">
 <div class="col-sm-4" ></div>
 
 <div class="col-sm-5" >
    <div class="panel panel-primary" >
  
<div class="">
	<form name="f1" method="post" >
		  <div style="padding:10px 10px 10px 10px; background-image:url(image/index.jpg); color:#000000; border:1px solid #CCCCCC;">
         <div style="padding:10px;  font-size:18px; font-weight:bold;"><center>Contact Information</center></div>
         
         
         <div class="row" style="padding-top:20px;">
                     <div class="col-md-2"></div>
			 <div class="col-sm-4"><strong>Password</strong></div>
             
				<div class="col-sm-6">
					 <input type="password"  style="width:100%" name="t_password" id="t_password" value='<?php echo $value['t_password']; ?>' />
				</div>
			</div>
            
            
                     <div align="center" id='errorpassword' style="color:#FF0000;padding:5px;font-weight:bold;"></div>
                     
              <div class="row" style="padding-top:20px;">
                     <div class="col-md-2"></div>
			 <div class="col-sm-4"><strong>Confirm Password</strong></div>
             
				<div class="col-sm-6">
					 <input type="password"  style="width:100%" name="c_password" id="c_password" value='<?php echo $value['t_password']; ?>' />
				</div>
			</div>
            
             
			
                     <div align="center" id='errorcpassword' style="color:#FF0000;padding:5px;font-weight:bold;"></div>
         <?php $row=mysql_query("select t_phone,t_landline,t_email,t_internal_email,t_address,t_permanent_pincode from tbl_teacher where t_id='$teacher_id'"); 
						$result=mysql_fetch_array($row);
							$mob=$result['t_phone'];
							$landline=$result['t_landline'];
							$email=$result['t_email'];
							$internal_email=$result['t_internal_email'];
							$t_add=$result['t_address'];
							$pincode=$result['t_permanent_pincode'];?>
			
			<div class="row" style="padding-top:20px;">
                     <div class="col-md-2"></div>
			 <div class="col-sm-4"><strong>Mobile Number</strong></div>
             
				<div class="col-sm-6">
					 <input type="text"  style="width:100%" name="t_phone" id="t_phone" value='<?php echo $mob; ?>'  onkeypress="return isNumberKey(event)" />
				</div>
				</div>
				<div class="row" style="padding-top:20px;">
				<div class="col-md-2"></div>
			 <div class="col-sm-4"><strong>Landline</strong></div>
             
				<div class="col-sm-6">
					 <input type="text"  style="width:100%" name="t_landline" id="t_landline" value='<?php echo $landline; ?>'  onkeypress="return isNumberKey(event)" />
				</div>
			</div>
             
			
                     <div align="center" id='errorphone' style="color:#FF0000;padding:5px;font-weight:bold;"></div>
            
            <div class="row"  style="padding-top:20px;">
             <div class="col-md-2"></div>
         <div class="col-sm-4" ><strong>Email ID</strong></div>
			
		<div class="col-sm-6">
					<input type="text"  style="width:100%;" name="t_email" id="t_email" value='<?php echo $email; ?>' />
				</div>
			</div>
			            <div class="row"  style="padding-top:20px;">
			<div class="col-md-2"></div>
         <div class="col-sm-4" ><strong>Internal Email ID</strong></div>
			
		<div class="col-sm-6">
					<input type="text"  style="width:100%;" name="t_internal_email" id="t_internal_email" value='<?php echo $internal_email; ?>' />
				</div>
			</div>
                  <div align="center" id='erroremail' style="color:#FF0000;padding:5px;font-weight:bold;"></div>
            
            
			<div class="row"  style="padding-top:20px;">
            <div class="col-md-2"></div>
				<div  class="col-sm-4"><strong>Address</strong></div>
        
				<div class="col-md-6">
					<textarea name="t_address"  style="width:100%;resize:none;" id="t_address"> <?php echo $t_add; ?></textarea><!--min-width:235px;min-height:112px;max-width:235px;max-height:112px;-->
				</div>
				</div>
				<div class="row"  style="padding-top:20px;">
				 <div class="col-md-2"></div>
				
					<div class="col-sm-4" ><strong>Pincode</strong></div>
			
					<div class="col-sm-6">
					<input type="text"  style="width:100%;" name="t_pincode" id="t_pincode" value='<?php echo $pincode; ?>' />
				</div>
			</div>
               <div align="center" id='erroraddress' style="color:#FF0000;padding:5px;font-weight:bold;"></div>
            
            
         
      
   
            
            
			           
		
					   
                          <div style="padding-top:40px;" ><center>  <input type='submit' value='Update' name='submit' onclick="return validcontact()"/> &nbsp;&nbsp;  <a href="teacher_profile.php"><input type='button' value='Cancel' name='submit'/></a></center></div>
			</div>
	</form>
</div>
</div>
</div>
 
 </div>




<?php  }if($id==5){?>

<div class="row" style="padding:30px;">
 <div class="col-sm-4" ></div>
 
 <div class="col-sm-5" >
    <div class="panel panel-primary">
  
  
<div class="">
<form name="f1" method="post" >
		                     
                        
                          <div style="padding:10px 10px 10px 10px; background-image:url(image/index.jpg); color:#000000; border:1px solid #CCCCCC;">
         <div style="padding:10px;  font-size:18px; font-weight:bold;"><center>
           Work
         </center></div>
         
         
         <div class="row" style="padding-top:20px;">
                     <div class="col-md-2"></div>
			 <div class="col-sm-4"><strong>College Name</strong></div>
             
<div class="col-sm-6">
 
  <?php 
			        
			 $row=mysql_query("select * from tbl_school ");
			 ?>

		<select  id='t_current_school_name' name='t_current_school_name'  style="width:100%; height:26px;"  >
                 <option value='select'>Select</option>
                     <?php while($result=mysql_fetch_array($row)){
                     
                      if(isset($_GET['id']))
					  {?>
					  <option value="<?php echo $result['id'];?>" <?php if(($result['id'] == $value['school_id'])){
														?>selected="selected"<?php } ?> ><?php echo $result['school_name'];?></option>
					<?php   }else{
					  
					  ?>
                   <option value='<?php echo $result['id'];?>' ><?php echo $result['school_name'];?></option>  
					 <?php } }
					 ?>
              </select>
				
				</div>
			</div>
        <?php $row=mysql_query("select t_exprience,t_dept,t_id,t_emp_type_pid,t_date_of_appointment from tbl_teacher where t_id='$teacher_id'"); 
						$result=mysql_fetch_array($row);
							$e=$result['t_exprience'];
							$d=$result['t_dept'];
							$tid=$result['t_id'];
							$pid=$result['t_emp_type_pid'];
							$date=$result['t_date_of_appointment'];?>
                           <div align="center" id='errorschoolname' style="color:#FF0000;padding:5px;font-weight:bold;"></div>
                           
                            <div class="row" style="padding-top:20px;">
                     <div class="col-md-2"></div>
					 
			 <div class="col-sm-4"><strong>Experience</strong></div>
             
				<div class="col-sm-6">
					 <input type="text"  style="width:100%" name="t_exprience" id="t_exprience" style="margin-bottom:5px;" value='<?php echo $e; ?>' /><br/>
				</div>
				
				<div class="col-md-2"></div>
				<br>
			 <div class="col-sm-4"><strong>Department</strong></div>
             
				<div class="col-sm-6">
					 <input type="text"  style="width:100%" name="t_dept" id="t_dept" value="<?php echo $d;?>" /><br/>
				</div>
				
				<div class="col-md-2"></div><br>
			 <div class="col-sm-4"><strong>Teacher ID</strong></div>
             
				<div class="col-sm-6">
					 <input type="text"  style="width:100%" name="t_id" id="t_id" value='<?php echo $tid; ?>' />
				</div>
				<div class="col-md-2"></div><br>
			 <div class="col-sm-4"><strong>Date of Appointment</strong></div>
             
				<div class="col-sm-6">
					 <input type="text"  style="width:100%" name="t_date_app" id="t_date_app" value='<?php echo $date; ?>' />
				</div>
				<div class="col-md-2"></div><br>
				<div class="col-sm-4"><strong>Employee type ID</strong></div>
             
				<div class="col-sm-6">
					 <input type="text"  style="width:100%" name="t_pid" id="t_pid" value='<?php echo $pid; ?>' />
				</div>
			</div>
              	
                    
                        <div align="center" id='errorexperience' style="color:#FF0000;padding:15px;font-weight:bold;"></div>
                     
                    <div ><center>  <input type='submit' value='Update' name='submit' onclick="return valideducation()"/> &nbsp;&nbsp;  <a href="teacher_profile.php"><input type='button' value='Cancel' name='submit'/></a></center></div>
                </div>
           </div>
           </form>
           </div>
</div>
</div>
 
 </div>



<?php } if($id==6){?>
<div class="row" style="padding:30px;">
 <div class="col-sm-4" ></div>
 
 <div class="col-sm-5" >
    <div class="panel panel-primary">
  
  
<div class="">
<form name="f1" method="post" >


                          <div style="padding:10px 10px 10px 10px; background-image:url(image/index.jpg); color:#000000; border:1px solid #CCCCCC;">
         <div style="padding:10px;  font-size:18px; font-weight:bold;"><center>Qualification Details</center></div>
		         <div class="row" style="padding-top:20px;">
                     <div class="col-md-2"></div>
			 <div class="col-sm-4"><strong>Qualification</strong></div>
             
				<div class="col-sm-6">
					 <input type="text"  style="width:100%" name="t_qualification" id="t_qualification" value='<?php echo $value['t_qualification']; ?>' />
				</div>
			</div>

            
                   		
                        <div align="center" id='errorqualification' style="color:#FF0000;padding:5px;font-weight:bold;"></div>
                                                          
                     
                    <div style="padding-top:30px;">  <center><input type='submit' value='Update' name='submit' onclick="return validqualification()"/> 
                     &nbsp;&nbsp; <a href="teacher_profile.php"><input type='button' value='Cancel' name='submit'/></a></center></div>
                </div>
           </div>
           </form>
  </div>
</div>
</div>
 
 </div>


<?php }?>

</div>
</body>
</html>
