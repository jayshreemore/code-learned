<?php
       if(isset($_GET['edit_id']))
	   {
		 $t_id=$_GET['edit_id'];
		 $report="";					 
		include_once("school_staff_header.php");
		
		if(isset($_POST['Update']))
		{
	      $t_id=$_GET['edit_id'];
	      $email = $_POST['id_email'];
		 
		//$row=mysql_query("select * from tbl_teacher where t_email like '$email' ");
	    //if(mysql_num_rows($row)<=0)
		//{
		$id_first_name = $_POST['id_first_name'];
		$id_last_name = $_POST['id_last_name'];
		$name=$id_first_name." ".$id_last_name;
	    $education =$_POST['id_education'];
		$experience=$_POST['experience'];
		$date = $_POST['dob'];
		
		
			
		$class = $_POST['class1'];
		$subject = $_POST['subject'];
		$email = $_POST['id_email'];
		$phone = $_POST['id_phone'];
		$gender=$_POST['gender'];
    	$address = $_POST['address'];
        if($_POST['country']==-1)
			{
		$country=$_POST['country1'];
			}
			else
			{
		$country=$_POST['country'];
			}
			if(isset($_POST['state']) && $_POST['state']!='')
			{
		$state=$_POST['state'];
			}
			else
			{
		$state=$_POST['state1'];
			}
      $city = $_POST['city'];
		$dates = date('m/d/Y');
	$password = $id_first_name."123";
		list($month,$day,$year) = explode("/",$date);
           $year_diff  = date("Y") - $year;
            $month_diff = date("m") - $month;
            $day_diff   = date("d") - $day;
        if ($day_diff < 0 || $month_diff < 0) $year_diff--;
            $age= $year_diff;
	 $sqls= "update tbl_teacher set t_name='$name',t_exprience='$experience',t_qualification='$education',t_address='$address',t_city='$city',t_dob='$date',t_age='$age',t_gender='$gender',t_country='$country',t_email='$email',t_phone='$phone',state='$state' where id=".$t_id."";
		
	$count = mysql_query($sqls) or die(mysql_error()); 
		if($count>=1){
	$to=$email;
	$from="smartcookiesprogramme@gmail.com";
	$subject="Succesful Registration";
	$message="Hello ".$id_first_name." ".$id_last_name."\r\n\r\n".
		 "Thanks for registration with Smart Cookie as teacher\r\n".
		  "your Username is: ".$email."\n\n".
		  "your password is: ".$password."\n\n".
		  "your School ID is: ".$school_id."\n\n".
		  "Regards,\r\n".
   	      "Smart Cookie Admin";
		  
       mail($to, $subject, $message);
		
		$report="Successfully updated"; 
		header("Location:teacherlist_sc.php");
		}
		}
		else
		{
		$report="Email ID is already present";
		}
	   
	//}
?>	
<script>
function showOrhide()
{

if(document.getElementById("firstBtn"))
{

document.getElementById('text_country1').style.display="block";
document.getElementById('text_country').style.display="none";
document.getElementById('text_state1').style.display="block";
document.getElementById('text_state').style.display="none";
return false;
}


}

</script>
<script type="text/javascript"> 

$(document).ready(function() { 

$('#country').change(function() { 

	var  country=document.getElementById("country").value;
    
		if(country=='-1')
			{
			    document.getElementById('errorcountry').innerHTML='Please enter country';
				return false;
			}else
	  {
	   document.getElementById('errorcountry').innerHTML='';
	  }
   }); 
}); 
</script> 


<script type="text/javascript"> 
$(document).ready(function() { 
$('#state').change(function() { 
   var  state=document.getElementById("state").value;
if(state==null|| state=="")
	  {
		 document.getElementById('errorstate').innerHTML='Please enter State';
		 return false;
	  }
       else
	  {
	   document.getElementById('errorstate').innerHTML='';
	  }
}); 
}); 
</script> 

<!DOCTYPE html>
<head>
<style>
  body 
 {
  background-color:#F8F8F8;
   }
  .indent-small {
  margin-left: 5px;
}
.form-group.internal {
  margin-bottom: 0;
}
.dialog-panel {
  margin: 10px;
}
.panel-body {  
font: 600 15px "Open Sans",Arial,sans-serif;
}

label.control-label {
  font-weight: 600;
  color: #777;  
}
</style>
 <script src='js/bootstrap-datepicker.min.js' type='text/javascript'></script>
<script src="js/city_state.js" type="text/javascript"></script>
<link href='css/datepicker.min.css' rel='stylesheet' type='text/css'>
<script>
$(document).ready(function() {  
   
  $('.datepicker').datepicker();  
});


 var reg = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;  
      function PhoneValidation(phoneNumber)
      {  
        var OK = reg.exec(phoneNumber.value);  
        if (!OK)  
         document.getElementById('errorphone').innerHTML='Please Enter Valid Phone Number';
		 return false;
       
      }
function valid()
	{
	
		var first_name=document.getElementById("id_first_name").value;
		
		var last_name=document.getElementById("id_last_name").value;
		
		
		
		
		if(first_name==null||first_name=="" || last_name==null|| last_name=="" )
			{
			   
				document.getElementById('errorname').innerHTML='Please Enter Name';
				
				return false;
			}else{
				document.getElementById('errorname').innerHTML='';
			}
		
		regx1=/^[A-z ]+$/;
				//validation for name
				if(!regx1.test(first_name) || !regx1.test(last_name))
				{
				document.getElementById('errorname').innerHTML='Please Enter valid Name';
					return false;
				}else{
				document.getElementById('errorname').innerHTML='';
			}
				
					
			
			
				
				
		var experience=document.getElementById("experience").value; 
		if(experience==null||experience=="")
			{
			   
				document.getElementById('errorexperience').innerHTML='Please Enter Experience';
				
				return false;
			}
			else if(experience <0)
			{
				document.getElementById('errorexperience').innerHTML='Please Enter valid Experience';
				
				return false;
				
				}
			else
			{
				document.getElementById('errorexperience').innerHTML='';
			}
			
			 var id_checkin=document.getElementById("id_checkin").value;
					 
					 var myDate = new Date(id_checkin);
				var today = new Date();
				if(id_checkin=="")
			{
	
			   
				document.getElementById('errordob').innerHTML='Please Enter Date of Birth';
				
				return false;
			}
			else if (myDate>=today)
					  { 
					  //something else is wrong
					   document.getElementById("errordob").innerHTML ="You cannot enter a date in the future!";
						return false;
					  }
					  else
					  {
						   document.getElementById("errordob").innerHTML ="";
						  
						 }
		
			
			var gender1=document.getElementById("gender1").checked;
		
			var gender2=document.getElementById("gender2").checked;
			
		if(gender1==false && gender2==false)
			{
				document.getElementById('errorgender').innerHTML='Please Select gender';
				return false;
			}else{
				document.getElementById('errorgender').innerHTML='';
			}
	
		
		/*var subject=document.getElementById("subject").value;
		if(subject==null||subject=="")
			{
			   
				document.getElementById('errorsubject').innerHTML='Please Enter Subject';
				
				return false;
			}else{
				document.getElementById('errorsubject').innerHTML='';
			}*/
		var email=document.getElementById("id_email").value;
		if(email==null||email=="")
			{
			   
				document.getElementById('erroremail').innerHTML='Please Enter email';
				
				return false;
			}
			
			  //validation of email
				var atpos = email.indexOf("@");
				var dotpos = email.lastIndexOf(".");
				if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=x.length) {
					document.getElementById('erroremail').innerHTML='Please enter valid Email Id';
					return false;
				}else{
				document.getElementById('erroremail').innerHTML='';
			}
			
			
			
			var phone=document.getElementById("phone").value;
			
			if(phone.length>10 || phone.length<10 || isNaN(phone))
			{
				document.getElementById('errorphone').innerHTML='Please Enter Valid Phone Number';
				return false;	
			}

		var address=document.getElementById("id_address").value;
		if(address==null||address=="")
			{
			   
				document.getElementById('erroraddress').innerHTML='Please Enter address';
				
				return false;
			}else{
				document.getElementById('erroraddress').innerHTML='';
			}
		var country=document.getElementById("country").value;
		
		if(country=="-1")
			{
			   
				document.getElementById('errorcountry').innerHTML='Please Enter country';
				
				return false;
			}else{
				document.getElementById('errorcountry').innerHTML='';
			}
			
		var state=document.getElementById("state").value;
		if(state==null||state=="")
			{
			   
				document.getElementById('errorstate').innerHTML='Please Enter state';
				
				return false;
			}else{
				document.getElementById('errorstate').innerHTML='';
			}	
		var city=document.getElementById("id_city").value;
		
		if(city==null||city=="")
			{
			   
				document.getElementById('errorcity').innerHTML='Please Enter city';
				
				return false;
			}else{
				document.getElementById('errorcity').innerHTML='';
			}
			
		}
</script>

</head>
                                   <?php
								         
										 
								        $get_teacher=mysql_query("SELECT * FROM `tbl_teacher` WHERE id=".$t_id."");
									    $get_row_t=mysql_fetch_array($get_teacher);
										
										$name=explode(" ",$get_row_t['t_name']);
										   
										   
										   $name['0'];
										   $name['1'];
										     
                                   
								   ?>
<body>
  <div class='container' >
    <div class='panel panel-primary dialog-panel' style="background-color:#FFFFFF;background-image=""">
   <div style="color:#060;font-size:15px;font-weight:bold;margin-top:10px;"> <?php if(isset($_GET['report'])){ echo $_GET['report']; };?></div>
      <div class='panel-heading'>
         
           <!-- <h3 align="center">Edit Teacher Setup</h3>
        
        
            <h5 align="center"><a href="Add_teacherSheet.php?id=<?//=$school_id?>" >Add Excel Sheet</a></h5>-->
          </div>
      <div class='panel-body'>
        <form class='form-horizontal' role='form' method="post">
        
        
        <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' for='id_title' style="text-align:left;">Teacher Name</label>
            <div class='col-md-8'>
            
              <div class='col-md-3 '>
                <div class='form-group internal'>
                  <input class='form-control' id='id_first_name' value="<?=$name['0'];?>" name="id_first_name" placeholder='First Name' type='text'>
                </div>
              </div>
              <div class='col-md-3 col-sm-offset-1'>
                <div class='form-group internal'>
                  <input class='form-control' id='id_last_name' value="<?=$name['1'];?>" name="id_last_name" placeholder='Last Name' type='text'>
                </div>
              </div>
              <div class='col-md-4 indent-small' id="errorname" style="color:#FF0000">
                
              </div>
            </div>
          </div>
        
                       <?php 
					         if(isset($get_row_t['t_qualification'])!="0")
	                       {
							   ?>
                                <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' for='id_service' style="text-align:left;">Education</label>
            <div class='col-md-2'>
              <select class='multiselect  form-control' id='id_service' name="id_education" >
              <option value='<?=$get_row_t['t_qualification']?>'><?=$get_row_t['t_qualification']?></option>
                <option value='BA'>BA</option>
                <option value='BCom'>BCom</option>
                <option value='BSc'>BSc</option>
                <option value='MA'>MA</option>
                <option value='MCom'>MCom</option>
                <option value='MSc'>MSc</option>
                <option value='B.ED'>B.ED</option>
                <option value='D.ED'>D.ED</option>
              </select>
            </div>
                               <?php
							   }
							   else
							   {
					           ?>
                 
           <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' for='id_service' style="text-align:left;">Education</label>
            <div class='col-md-2'>
              <select class='multiselect  form-control' id='id_service' name="id_education" >
                <option value='BA'>BA</option>
                <option value='BCom'>BCom</option>
                <option value='BSc'>BSc</option>
                <option value='MA'>MA</option>
                <option value='MCom'>MCom</option>
                <option value='MSc'>MSc</option>
                <option value='B.ED'>B.ED</option>
                <option value='D.ED'>D.ED</option>
              </select>
            </div>
             
                    <?php
	                   }
		            ?>
            
            <label class='control-label col-md-2 '>Experience(in Months)</label>
            
              <div class='col-md-2'>
               
                  <input class='form-control col-md-8' id='experience' value="<?=$get_row_t['t_exprience']?>" name='experience' placeholder='Experience' type='text'>
              
              </div>
             <div class='col-md-2 indent-small' id="errorexperience" style="color:#FF0000"></div>
           
       
          </div>
          
          
          
           
          
         
            <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' for='id_checkin' style="text-align:left;">Date Of Birth</label>
            <div class='col-md-8'>
              <div class='col-md-5'>
                <div class='form-group internal input-group'>
              
               <input class='form-control datepicker' value="<?=$get_row_t['t_dob']?>" id="id_checkin" name="dob" class="form-control">
                
                </div>
                
                <div class='col-md-15' id="errordob" style="color:#FF0000"></div>
              </div>
               
            </div>
          </div>
          
          
          <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' for='id_pets' style="text-align:left;">Gender</label>
           <div class='col-md-2' style="font-weight: 600;
color: #777;">
           <input type="radio" name="gender" <?php echo ($get_row_t['t_gender']=="Male")?"checked":"" ?> id="gender1" value="Male"> 
                  Male
             </div>
             <div class='col-md-3' style="font-weight: 600;
color: #777;">
             <input type="radio" name="gender" <?php echo ($get_row_t['t_gender']=="Female")?"checked":"" ?> id="gender2" value="Female">
            Female
              </div>
              
                <div class='col-md-2 indent-small' id="errorgender" style="color:#FF0000">
          </div>
          </div>
          
       
         <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' for='id_email' style="text-align:left;" >Contact</label>
            <div class='col-md-6'>
              <div class='form-group'>
                <div class='col-md-6'>
                  <input class='form-control' id='id_email' value="<?=$get_row_t['t_email']?>" name="id_email" placeholder='E-mail ID' type='text'>
                </div>
                <div class='col-md-3 indent-small' id="erroremail" style="color:#FF0000">
                
              </div>
              </div>
              <div class='form-group '>
                <div class='col-md-6'>
                  <input class='form-control' id='phone' name="id_phone" value="<?=$get_row_t['t_phone']?>" placeholder='Mobile No' type='text' onChange="PhoneValidation(this);">
                </div>
                <div class='col-md-3 indent-small' id="errorphone" style="color:#FF0000">
                
              </div>
              </div>
            </div>
          </div>
         <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' for='id_comments' style="text-align:left;">Address</label>
            <div class='col-md-4'>
              <textarea class='form-control' id='id_address'  name="address" placeholder='Address' rows='3'><?=$get_row_t['t_address']?></textarea>
            </div>
      <div class='col-md-2 indent-small' id="erroraddress" style="color:#FF0000"></div>
          </div>
        
       <div class="row" align="center" id='erroraddress' style="color:#FF0000;"></div>


<div class="row" style="padding-top:7px;" id="text_country" style="display:block">

<div class="col-md-5"><h4  align="left">Country:</h4></div> 
<div class="col-md-5"><input type="text" class='form-control' id="country1" name="country1" style="width:100%;" value="<?=$get_row_t['t_country']?>" readonly >
</div>
<div class="col-md-1" id="firstBtn"><a href="" onclick="return showOrhide()">Edit</a></div>
   
</div>

        <div class='row ' style="padding-top:7px; display:none" id="text_country1">
            <div class="col-md-5"><h4  align="left">Country </h4></div> 
    <div class='col-md-5'>
                  <select id="country" name="country" class='form-control' ></select>
                </div>
            
             
            <div class='col-md-3 indent-small' id="errorcountry" style="color:#FF0000"></div>
         </div>
         
         


<div class='row ' style="padding-top:7px; display:none" id="text_state1">
            <div class="col-md-5"><h4  align="left">State </h4></div> 
    <div class='col-md-5'>
                  <select id="state" name="state" class='form-control' ></select>
                </div>
            
             
            <div class='col-md-3 indent-small' id="errorstate" style="color:#FF0000"><?php // echo $report4; ?></div>
         </div>
       


<div class="row" style="padding-top:7px;" id="text_state" style="display:block">
<div class="col-md-5"><h4  align="left"> State:</h4></div> 
<div class="col-md-5"> <input type="text" id="state1" name="state1"  class='form-control' style="width:100%;" value="<?=$get_row_t['state']?>" readonly>


</div> 



</div>
          <script language="javascript">
            populateCountries("country", "state");
            populateCountries("country2");
        </script>

         <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' for='id_accomodation' style="text-align:left;" >City</label>
            <div class='col-md-3'>
              <input type="text" class='form-control' value="<?=$get_row_t['t_city']?>" id='id_city' name="city" placeholder="City">
            </div>
             <div class='col-md-3 indent-small' id="errorcity" style="color:#FF0000"></div>
          </div>
      
          
          
           
          
         <div class='form-group row'>
           <div class='col-md-2 col-md-offset-4' >
   <input class='btn-lg btn-primary' type='submit' value="Update" name="Update" onClick="return valid()" style="padding:5px;"/>
                </div>
                
                 <div class='col-md-1'>
                    
       <a href="teacherlist_sc.php"><input type="button" class='btn-lg btn-danger' value="Cancel" name="cancel"  style="padding:5px;" /></a>
                    
                  </div>
          
          
          
          
          
          
        </form>
      </div>
      <div class='row' align="center"  style="color:#F00;"><?php echo $report;?></div>
    </div>
  </div>
</body>
		<?php 
	   }
	   else
	   	if(isset($_GET['id']))
		{
		$report="";					 
		include_once("school_staff_header.php");
		
		if(isset($_POST['submit']))
		{
	   $id=$_GET['id'];
	    $email = $_POST['id_email'];
		 
		$row=mysql_query("select * from tbl_teacher where t_email like '$email'  ");
		if(mysql_num_rows($row)<=0)
		{
		$id_first_name = $_POST['id_first_name'];
		$id_last_name = $_POST['id_last_name'];
		$name=$id_first_name." ".$id_last_name;
	    $education =$_POST['id_education'];
		$experience=$_POST['experience'];
		$date = $_POST['dob'];
		
		//$gender = $_POST['id_gender'];
		//retrive school_id and name school_admin
		//$arrs=$smartcookie->retrive_scadmin_profile();
		
		
		$results=mysql_query("select * from tbl_school_adminstaff where id=".$id."");
        $arrs=mysql_fetch_array($results);
		$staff_id=$arrs['id'];
		$school_id=$arrs['school_id'];
		$getSCname=mysql_query("select * from tbl_school where id=".$school_id."");
		   $r=mysql_fetch_array($getSCname);
		$school_name=$r['school_name'];
			
		$class = $_POST['class1'];
		$subject = $_POST['subject'];
		$email = $_POST['id_email'];
		$phone = $_POST['id_phone'];
		$gender=$_POST['gender'];
    	$address = $_POST['address'];
        $country = $_POST['country'];
		$state = $_POST['state'];
		$city = $_POST['city'];
		$dates = date('m/d/Y');
		
                            $password = $id_first_name."123";
		
		
		 list($month,$day,$year) = explode("/",$date);
           $year_diff  = date("Y") - $year;
            $month_diff = date("m") - $month;
          $day_diff   = date("d") - $day;
    if ($day_diff < 0 || $month_diff < 0) $year_diff--;
    $age= $year_diff;
	

	
	  $sqls= "INSERT INTO `tbl_teacher`(t_name, t_current_school_name,school_id,t_school_staff_id,t_exprience 
	  ,t_subject,t_class,t_qualification, t_address, t_city, t_dob, t_gender,t_age, t_country, t_email,t_date,state,t_phone,t_password) VALUES ('$name', '$school_name','$school_id','$staff_id','$experience','$subject','$class','$education','$address','$city','$date','$gender','$age' ,'$country', '$email',  '$dates','$state','$phone','$password')";
		
	$count = mysql_query($sqls) or die(mysql_error()); 
		if($count>=1){
		
	$to=$email;
	$from="smartcookiesprogramme@gmail.com";
	$subject="Succesful Registration";
	$message="Hello ".$id_first_name." ".$id_last_name."\r\n\r\n".
		 "Thanks for registration with Smart Cookie as teacher\r\n".
		  "your Username is: "  .$email.  "\n\n".
		  "your password is: ".$password."\n\n".
		  "your School ID is: ".$school_id."\n\n".
		  "Regards,\r\n".
   	      "Smart Cookie Admin";
		  
       mail($to, $subject, $message);
		
		$report="successfully updated"; 
		header("Location:teacher_setup.php?name=t&report=".$report."&id=".$id);
		}
		}
		else
		{
		
		$report="Email ID is already present";
		}
	   
	}
?>	
<!DOCTYPE html>
<head>
 
 
 
  <style>
  body {
   background-color:#F8F8F8;
   }
  .indent-small {
  margin-left: 5px;
}
.form-group.internal {
  margin-bottom: 0;
}

.dialog-panel {
  margin: 10px;
}


.panel-body {  
  


  font: 600 15px "Open Sans",Arial,sans-serif;
}

label.control-label {
  font-weight: 600;
  color: #777;  
}
</style>
 <script src='js/bootstrap-datepicker.min.js' type='text/javascript'></script>
<script src="js/city_state.js" type="text/javascript"></script>
<link href='css/datepicker.min.css' rel='stylesheet' type='text/css'>
<script>
$(document).ready(function() {  
   
  $('.datepicker').datepicker();  
});


 var reg = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;  
      function PhoneValidation(phoneNumber)
      {  
        var OK = reg.exec(phoneNumber.value);  
        if (!OK)  
         document.getElementById('errorphone').innerHTML='Please Enter Valid Phone Number';
		 return false;
       
      }
function valid()
	{
	
		var first_name=document.getElementById("id_first_name").value;
		
		var last_name=document.getElementById("id_last_name").value;
		
		if(first_name==null||first_name=="" || last_name==null|| last_name=="" )
			{
			   
				document.getElementById('errorname').innerHTML='Please Enter Name';
				
				return false;
			}else{
				document.getElementById('errorname').innerHTML='';
			}
		
		regx1=/^[A-z ]+$/;
				//validation for name
				if(!regx1.test(first_name) || !regx1.test(last_name))
				{
				document.getElementById('errorname').innerHTML='Please Enter valid Name';
					return false;
				}else{
				document.getElementById('errorname').innerHTML='';	
				}
				
					 var id_checkin=document.getElementById("id_checkin").value;
				if(id_checkin=="")
			{
	
			   
				document.getElementById('errordob').innerHTML='Please Enter Date of Birth';
				
				return false;
			}
			
			var myDate = new Date(id_checkin);
				var today = new Date();
				
				if (myDate>=today)
					  { 
					  //something else is wrong
					   document.getElementById("errordob").innerHTML ="You cannot enter a date in the future!";
						return false;
					  }
					  else
					  {
						   document.getElementById("errordob").innerHTML ="";
						  
						 }
		var experience=document.getElementById("experience").value; 
		if(experience==null||experience=="")
			{
			   
				document.getElementById('errorexperience').innerHTML='Please Enter Experience';
				
				return false;
			}else{
				document.getElementById('errorexperience').innerHTML='';	
				}
			var gender1=document.getElementById("gender1").checked;
		
			var gender2=document.getElementById("gender2").checked;
			
		if(gender1==false && gender2==false)
			{
				document.getElementById('errorgender').innerHTML='Please Select gender';
				return false;
			}else{
				document.getElementById('errorgender').innerHTML='';	
				}
	
		
		var subject=document.getElementById("subject").value;
		if(subject==null||subject=="")
			{
			   
				document.getElementById('errorsubject').innerHTML='Please Enter Subject';
				
				return false;
			}else{
				document.getElementById('errorsubject').innerHTML='';	
				}
		var email=document.getElementById("id_email").value;
		if(email==null||email=="")
			{
			   
				document.getElementById('erroremail').innerHTML='Please Enter email';
				
				return false;
			}
			
			  //validation of email
				var atpos = email.indexOf("@");
				var dotpos = email.lastIndexOf(".");
				if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=email.length) {
					document.getElementById('erroremail').innerHTML='Please enter valid Email Id';
					return false;
				}else{
				document.getElementById('erroremail').innerHTML='';	
				}
				
				
				var phone=document.getElementById("phone").value;
			
			if(phone.length>10 || phone.length<10 || isNaN(phone))
			{
				document.getElementById('errorphone').innerHTML='Please Enter Valid Phone Number';
				return false;	
			}

		var address=document.getElementById("id_address").value;
		if(address==null||address=="")
			{
			   
				document.getElementById('erroraddress').innerHTML='Please Enter address';
				
				return false;
			}else{
				document.getElementById('erroraddress').innerHTML='';	
				}
		var country=document.getElementById("country").value;
		
		if(country=="-1")
			{
			   
				document.getElementById('errorcountry').innerHTML='Please Enter country';
				
				return false;
			}else{
				document.getElementById('errorcountry').innerHTML='';	
				}
			
		var state=document.getElementById("state").value;
		if(state==null||state=="")
			{
			   
				document.getElementById('errorstate').innerHTML='Please Enter state';
				
				return false;
			}	else{
				document.getElementById('errorstate').innerHTML='';	
				}
		var city=document.getElementById("id_city").value;
		
		if(city==null||city=="")
			{
			   
				document.getElementById('errorcity').innerHTML='Please Enter city';
				
				return false;
			}else{
				document.getElementById('errorcity').innerHTML='';	
				}
			
		}
</script>

</head>
<body>
  <div class='container' >
    <div class='panel panel-primary dialog-panel' style="background-color:#FFFFFF;background-image=""">
   <div style="color:red;font-size:15px;font-weight:bold;margin-top:10px;"> <?php if(isset($_GET['report'])){ echo $_GET['report']; };?></div>
      <div class='panel-heading'>
         
            <h3 align="center">Teacher Setup</h3>
        
        
            <h5 align="center"><a href="Add_teacherSheet_20152006PT.php?id=<?=$school_id?>" >Add Excel Sheet</a></h5>
          </div>
      <div class='panel-body'>
        <form class='form-horizontal' role='form' method="post">
        
        
        <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' for='id_title' style="text-align:left;">Teacher Name</label>
            <div class='col-md-8'>
            
              <div class='col-md-3 '>
                <div class='form-group internal'>
                  <input class='form-control' id='id_first_name' name="id_first_name" placeholder='First Name' type='text'>
                </div>
              </div>
              <div class='col-md-3 col-sm-offset-1'>
                <div class='form-group internal'>
                  <input class='form-control' id='id_last_name' name="id_last_name" placeholder='Last Name' type='text'>
                </div>
              </div>
              <div class='col-md-4 indent-small' id="errorname" style="color:#FF0000">
                
              </div>
            </div>
          </div>
        

                 
           <div class='form-group'>
		   <div class='row'>
            <label class='control-label col-md-2 col-md-offset-2' for='id_service' style="text-align:left;">Education</label>
            <div class='col-md-2'>
              <select class='multiselect  form-control' id='id_service' name="id_education" >
                <option value='BA'>BA</option>
                <option value='BCom'>BCom</option>
                <option value='BSc'>BSc</option>
                <option value='MA'>MA</option>
                <option value='MCom'>MCom</option>
                <option value='MSc'>MSc</option>
                <option value='B.ED'>B.ED</option>
                <option value='D.ED'>D.ED</option>
              </select>
            </div>
             
            
            
            <label class='control-label col-md-2 '  >Experience</label>
            
              <div class='col-md-2'>
               
                  <input class='form-control col-md-8' id='experience' name='experience' placeholder='Experience' type='text'>
              
              </div>
             <div class='col-md-2 indent-small' id="errorexperience" style="color:#FF0000"></div>
           
			</div>
          </div>
          
         
            <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' for='id_checkin' style="text-align:left;">Date Of Birth</label>
            <div class='col-md-8'>
              <div class='col-md-5'>
                <div class='form-group internal input-group'>
              
               <input class='form-control datepicker' id="id_checkin" name="dob" class="form-control">
                
                </div>
                
                <div class='col-md-15' id="errordob" style="color:#FF0000"></div>
              </div>
               
            </div>
          </div>
          
          
          <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' for='id_pets' style="text-align:left;">Gender</label>
           <div class='col-md-2' style="font-weight: 600;
color: #777;">
           <input type="radio" name="gender" id="gender1" value="Male"> 
                  Male
             </div>
             <div class='col-md-3' style="font-weight: 600;
color: #777;">
             <input type="radio" name="gender" id="gender2" value="Female">
            Female
              </div>
              
                <div class='col-md-2 indent-small' id="errorgender" style="color:#FF0000">
          </div>
          </div>
          
       
         <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' for='id_email' style="text-align:left;" >Contact</label>
            <div class='col-md-6'>
              <div class='form-group'>
                <div class='col-md-6'>
                  <input class='form-control' id='id_email' name="id_email" placeholder='E-mail' type='text'>
                </div>
                <div class='col-md-3 indent-small' id="erroremail" style="color:#FF0000">
                
              </div>
              </div>
              <div class='form-group '>
                <div class='col-md-6'>
                  <input class='form-control' id='phone' name="id_phone" placeholder='Mobile No' type='text' onChange="PhoneValidation(this);">
                </div>
                <div class='col-md-3 indent-small' id="errorphone" style="color:#FF0000">
                
              </div>
              </div>
            </div>
          </div>
         
        
        
         
           
          <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' for='id_comments' style="text-align:left;">Address</label>
            <div class='col-md-4'>
              <textarea class='form-control' id='id_address' name="address" placeholder='Address' rows='3'></textarea>
            </div>
            <div class='col-md-2 indent-small' id="erroraddress" style="color:#FF0000"></div>
          </div>
         <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' style="text-align:left;" >Country</label>
            <div class='col-md-3'>
                  <select id="country" name="country" class='form-control'></select>
                </div>
            
             
            <div class='col-md-3 indent-small' id="errorcountry" style="color:#FF0000"></div>
           </div>
        <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' style="text-align:left;">State</label>
            <div class='col-md-3'>
                  <select name="state" id="state" class='form-control'></select>
                </div>
            
              <div class='col-md-3 indent-small' id="errorstate" style="color:#FF0000"></div>

          </div>
          <script language="javascript">
            populateCountries("country", "state");
            populateCountries("country2");
        </script>
         <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' for='id_accomodation' style="text-align:left;" >City</label>
            <div class='col-md-3'>
              <input type="text" class='form-control' id='id_city' name="city" placeholder="City">
            </div>
             <div class='col-md-3 indent-small' id="errorcity" style="color:#FF0000"></div>
          </div>
      
          
          
           
          
         <div class='form-group row'>
           <div class='col-md-2 col-md-offset-4' >
   <input class='btn-lg btn-primary' type='submit' value="Submit" name="submit" onClick="return valid()" style="padding:5px;"/>
                </div>
                 <div class='col-md-1'>
                    
       <a href="teacherlist_sc.php"><input type="button" class='btn-lg btn-danger' value="Cancel" name="cancel"  style="padding:5px;" /></a>
                    
                  </div>
          
          
          
          
          
          
        </form>
      </div>
      <div class='row' align="center"  style="color:#FF0000"><?php echo $report;?></div>
    </div>
  </div>
</body>

<!-- Admin Header -->

<?php
}
					 else
					 {
                      ?>
                      <?php
$errorreport="";
include_once("function.php");
if(isset($_GET['name']))
{
	include_once("school_staff_header.php");
}
else
{
	include_once("hr_header.php");
}	


	if(isset($_POST['submit']))
	{
	
	      $email = $_POST['id_email'];
		 $t_id=$_POST['t_id'];
		$row=mysql_query("select * from tbl_teacher where t_email like '$email'  ");
		if(mysql_num_rows($row)<=0)
		{
			$row_id=mysql_query("select * from tbl_teacher where t_id='$t_id' ");
			if(mysql_num_rows($row_id)<=0)
			{
				$id_first_name = $_POST['id_first_name'];
				$id_last_name = $_POST['id_last_name'];
				$name=$id_first_name." ".$id_last_name;
				$education =$_POST['id_education'];
				$experience=$_POST['experience'];
				$date = $_POST['dob'];
				
				
				// $gender = $_POST['id_gender'];
				//retrive school_id and name school_admin
				//$arrs=$smartcookie->retrive_scadmin_profile();
				$fields=array("id"=>$id);
				   $table="tbl_school_admin";
				   
				   $smartcookie=new smartcookie();
				   
		$results=$smartcookie->retrive_individual($table,$fields);
		$arrs=mysql_fetch_array($results);
					$school_id=$arrs['school_id'];
					$school_name=$arrs['school_name'];
				$class = $_POST['class1'];
				$subject = $_POST['subject'];
				$email = $_POST['id_email'];
				$phone = $_POST['id_phone'];
				$gender=$_POST['gender'];
				$address = $_POST['address'];
				$country = $_POST['country'];
				$state = $_POST['state'];
				$city = $_POST['city'];
				$dates = date('m/d/Y');
				
		 $password = $id_first_name."123";
				
				
				 list($month,$day,$year) = explode("/",$date);
			$year_diff  = date("Y") - $year;
			$month_diff = date("m") - $month;
			$day_diff   = date("d") - $day;
			if ($day_diff < 0 || $month_diff < 0) $year_diff--;
			$age= $year_diff;
			
			
			
			  $sqls= "INSERT INTO `tbl_teacher`(t_id,t_name,t_lastname,t_complete_name, t_current_school_name,school_id,t_exprience ,t_subject,t_class,t_qualification, t_address, t_city, t_dob, t_gender,t_age, t_country, t_email,  t_date,state,t_phone,t_password,t_emp_type_pid) VALUES ('$t_id','$id_first_name', '$id_last_name','$name','$school_name','$school_id','$experience','$subject','$class','$education','$address','$city','$date','$gender','$age' ,'$country', '$email',  '$dates','$state','$phone','$password','134')";
				
			$count = mysql_query($sqls) or die(mysql_error()); 
				if($count>=1){
				
			$to=$email;
			$from="smartcookiesprogramme@gmail.com";
			$subject="Succesful Registration";
			$message="Hello ".$id_first_name." ".$id_last_name."\r\n\r\n".
				 "Thanks for registration with Smart Cookie as teacher\r\n".
				  "your Username is: "  .$email.  "\n\n".
				  "your password is: ".$password."\n\n".
				  "your School ID is: ".$school_id."\n\n".
				  "Regards,\r\n".
				  "Smart Cookie Admin";
				  
			   mail($to, $subject, $message);
				
				$successreport="Successfully updated"; 
				header("Location:teacher_setup.php?successreport=".$successreport);
				}
			}
			else
			{
				$errorreport="Employee code is already present";
			}
		}
		else
		{
		
		$errorreport="Email ID is already present";
		}
	   
	}
?>

<!DOCTYPE html>
<head>
 
 
 
  <style>
  body {
   background-color:#F8F8F8;
   }
  .indent-small {
  margin-left: 5px;
}
.form-group.internal {
  margin-bottom: 0;
}

.dialog-panel {
  margin: 10px;
}


.panel-body {  
  


  font: 600 15px "Open Sans",Arial,sans-serif;
}

label.control-label {
  font-weight: 600;
  color: #777;  
}
</style>
 <script src='js/bootstrap-datepicker.min.js' type='text/javascript'></script>
<script src="js/city_state.js" type="text/javascript"></script>
<link href='css/datepicker.min.css' rel='stylesheet' type='text/css'>
<script>
$(document).ready(function() {  
   
  $('.datepicker').datepicker();  
});


 var reg = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;  
      function PhoneValidation(phoneNumber)
      {  
        var OK = reg.exec(phoneNumber.value);  
        if (!OK)  
         document.getElementById('errorphone').innerHTML='Please Enter Valid Phone Number';
		 return false;
       
      }
function valid()
	{
	
				
	 var phone=document.getElementById("phone").value;
			
		
		var first_name=document.getElementById("id_first_name").value;
		
		var last_name=document.getElementById("id_last_name").value;
		
		
		
		if(first_name==null||first_name=="" || last_name==null|| last_name=="" )
			{
			   
				document.getElementById('errorname').innerHTML='Please enter name';
				
				return false;
			}
		
		regx1=/^[A-z ]+$/;
				//validation for name
				if(!regx1.test(first_name) || !regx1.test(last_name))
				{
				document.getElementById('errorname').innerHTML='Please enter valid name';
					return false;
				}
				else
				{
					document.getElementById('errorname').innerHTML='';
				}
				
					var id_service=document.getElementById("id_service").value; 
		if(id_service==null||id_service=="")
			{
			   
				document.getElementById('errorexperience').innerHTML='Please select education';
				
				return false;
			}
			else
			{
				document.getElementById('errorexperience').innerHTML='';
			}
				var experience=document.getElementById("experience").value; 
		if(experience==null||experience=="")
			{
			   
				document.getElementById('errorexperience').innerHTML='Please enter experience';
				
				return false;
			}
			else if(experience <0 || experience%1!=0)
			{
				document.getElementById('errorexperience').innerHTML='Please enter valid experience';
				
				return false;
				
				}
			else
			{
				document.getElementById('errorexperience').innerHTML='';
			}
					 var id_checkin=document.getElementById("id_checkin").value;
					 var myDate = new Date(id_checkin);
			
				var today = new Date();
				if(id_checkin=="")
			{
	
			   
				document.getElementById('errordob').innerHTML='Please enter date of birth';
				
				return false;
			}
			
			
			else	if(myDate.getFullYear()>=today.getFullYear())
				{
					
					if(myDate.getFullYear()==today.getFullYear())
				   {
					
						if(myDate.getMonth()==today.getMonth())
						{
							if(myDate.getDate()>=today.getDate())
							{
								
							document.getElementById("errordob").innerHTML ="please enter valid birth date";
						return false;
							}	
							else
							{
								document.getElementById("errordob").innerHTML ="";
							}
							
							
						}	
						else if(myDate.getMonth()>today.getMonth())
						{
							document.getElementById("errordob").innerHTML ="please enter valid birth date";
						return false;
							
						}
						else
				           {
							   document.getElementById("errordob").innerHTML ="";
							 }
				   }
				  else
					  {
						   document.getElementById("errordob").innerHTML ="";
						  
						 }
						 var gender1=document.getElementById("gender1").checked;
					
						var gender2=document.getElementById("gender2").checked;
						
						if(gender1==false && gender2==false)
						{
							document.getElementById('errorgender').innerHTML='Please select gender';
							return false;
						}
						else
						{
							
							document.getElementById('errorgender').innerHTML='';
						}
						
						var t_id=document.getElementById("t_id").value;
						regx2=/^[A-z0-9 ]+$/;
							if(t_id==null||t_id=="")
						{
						   
							document.getElementById('errort_id').innerHTML='Please enter employee code';
							
							return false;
						}
						else if(!regx2.test(t_id))
						{
							document.getElementById('errort_id').innerHTML='Please enter valid  employee code';
							
							return false;
						}
						else
						{
							document.getElementById('errort_id').innerHTML='';
						}
			
		
			
			
				
			
			
		
	/*	 
		
		var subject=document.getElementById("subject").value;
		if(subject==null||subject=="")
			{
			   
				document.getElementById('errorsubject').innerHTML='Please Enter Subject';
				
				return false;
			}*/
		var email=document.getElementById("id_email").value;
		if(email==null||email=="")
			{
			   
				document.getElementById('erroremail').innerHTML='Please Enter email';
				
				return false;
			}
			
			
			  //validation of email
				/*var atpos = email.indexOf("@");
				var dotpos = email.lastIndexOf(".");
				
				if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=email.length) {
					document.getElementById('erroremail').innerHTML='Please enter valid Email Id';
					return false;
				}*/
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
			
			
			if(phone.length>10 || phone.length<10 || isNaN(phone))
			{
				document.getElementById('errorphone').innerHTML='Please Enter Valid Phone Number';
				return false;	
			}
			else
			{
				
				document.getElementById('errorphone').innerHTML='';
			}
			

		var address=document.getElementById("id_address").value;
		if(address==null||address=="")
			{
			   
				document.getElementById('erroraddress').innerHTML='Please Enter address';
				
				return false;
			}
			else
			{
				document.getElementById('erroraddress').innerHTML='';
			}
		var country=document.getElementById("country").value;
		
		if(country=="-1")
			{
			   
				document.getElementById('errorcountry').innerHTML='Please Enter country';
				
				return false;
			}
			else
			{
				document.getElementById('errorcountry').innerHTML='';
				
			}
			
		var state=document.getElementById("state").value;
		if(state==null||state=="")
			{
			   
				document.getElementById('errorstate').innerHTML='Please Enter state';
				
				return false;
			}	
			else
			{
				document.getElementById('errorstate').innerHTML='';
				
			}
		var city=document.getElementById("id_city").value;
		
		if(city==null||city=="" )
			{
			   
				document.getElementById('errorcity').innerHTML='Please Enter city';
				
				return false;
			}
			else if(!regx1.test(city))
			{
				document.getElementById('errorcity').innerHTML='Please Enter valid  city';
				
				return false;
				}
				else
				{
					document.getElementById('errorcity').innerHTML='';
				
					}
		
								
			  
		
	}
	
	function process(date){
   var parts = date.split("/");
   return new Date(parts[2], parts[1] - 1, parts[0]);
}
</script>
</head>
<body >
  <div class='container' >
    <div class='panel panel-primary dialog-panel' style="background-color:#FFFFFF;background-image=""">
   <div style="color:#063;font-size:15px;font-weight:bold;margin-top:20px;" align="center"> <?php if(isset($_GET['successreport'])){ echo $_GET['successreport']; };?></div>
   <div style="color:red;font-size:15px;font-weight:bold;margin-top:20px;" align="center"> <?php if(isset($_GET['successreport'])){ echo $_GET['errorreport']; };?></div>
      <div class='panel-heading'>
         
            <h3 align="center">Manager Setup</h3>
        
                   <h5 align="center"><a href="Add_teacherSheet_updated_20160103PT.php" >Add Excel Sheet</a></h5>
           <!-- <h5 align="center"><a href="addteacher_excelsheet.php" >Add Excel Sheet</a></h5>-->
          </div>
      <div class='panel-body'>
        <form class='form-horizontal' role='form' method="post">
        
        
        <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' for='id_title' style="text-align:left;">Manager Name</label>
            <div class='col-md-8'>
            
              <div class='col-md-3 '>
                <div class='form-group internal'>
                  <input class='form-control' id='id_first_name' name="id_first_name" placeholder='First Name' type='text'>
                </div>
              </div>
              <div class='col-md-3 col-sm-offset-1'>
                <div class='form-group internal'>
                  <input class='form-control' id='id_last_name' name="id_last_name" placeholder='Last Name' type='text'>
                </div>
              </div>
              <div class='col-md-4 indent-small' id="errorname" style="color:#FF0000">
                
              </div>
            </div>
          </div>
        

                 
           <div class='form-group'>
		   <div claass='row'>
            <label class='control-label col-md-2 col-md-offset-2' for='id_service' style="text-align:left;">Education</label>
            <div class='col-md-2'>
              <select class='multiselect  form-control' id='id_service' name="id_education" >
              <option value=''>Select</option>
                <option value='BA'>BE</option>
                <option value='BCom'>BCom</option>
                <option value='MA'>MBA</option>
                <option value='MCom'>MCom</option>
                <option value='B.Tech'>B.Tech</option>
                <option value='M.Tech'>M.Tech</option>
                <option value='Ph.D'>Ph.D</option>
              </select>
            </div>
             
            
            
            <label class='control-label col-md-3 '  >Experience(in months)</label>
            
              <div class='col-md-2'>
               
                  <input class='form-control col-md-8' id='experience' name='experience' placeholder='Experience' type='text'>
              
              </div>
             <div class='col-md-2 ' id="errorexperience" style="color:#FF0000"></div>
           
        </div>
          </div>
          
         
            <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' for='id_checkin' style="text-align:left;">Date Of Birth</label>
            <div class='col-md-8'>
              <div class='col-md-5'>
                <div class='form-group internal input-group'>
              
               <input class='form-control datepicker' id="id_checkin" name="dob" class="form-control">
                
                </div>
                
                <div class='col-md-15' id="errordob" style="color:#FF0000"></div>
              </div>
               
            </div>
          </div>
          
          
          <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' for='id_pets' style="text-align:left;">Gender</label>
           <div class='col-md-2' style="font-weight: 600;
color: #777;">
           <input type="radio" name="gender" id="gender1" value="Male"> 
                  Male
             </div>
             <div class='col-md-3' style="font-weight: 600;
color: #777;">
             <input type="radio" name="gender" id="gender2" value="Female">
            Female
              </div>
              
                <div class='col-md-2 indent-small' id="errorgender" style="color:#FF0000">
          </div>
          </div>
          
        
          
              
               <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' for='id_accomodation' style="text-align:left;" >Employee Code</label>
            <div class='col-md-3'>
              <input type="text" class='form-control' id='t_id' name="t_id" placeholder="Employee code">
            </div>
             <div class='col-md-3 indent-small' id="errort_id" style="color:#FF0000"></div>
          </div>
          
       
         <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' for='id_email' style="text-align:left;" >Contact</label>
            <div class='col-md-6'>
              <div class='form-group'>
                <div class='col-md-6'>
                  <input class='form-control' id='id_email' name="id_email" placeholder='E-mail' type='text'>
                </div>
                <div class='col-md-3 indent-small' id="erroremail" style="color:#FF0000">
                
              </div>
              </div>
              <div class='form-group '>
                <div class='col-md-6'>
                  <input class='form-control' id='phone' name="id_phone" placeholder='Mobile No' type='text' onChange="PhoneValidation(this);">
                </div>
                <div class='col-md-3 indent-small' id="errorphone" style="color:#FF0000">
                
              </div>
              </div>
            </div>
          </div>
         
        
        
         
           
          <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' for='id_comments' style="text-align:left;">Address</label>
            <div class='col-md-4'>
              <textarea class='form-control' id='id_address' name="address" placeholder='Address' rows='3'></textarea>
            </div>
            <div class='col-md-2 indent-small' id="erroraddress" style="color:#FF0000"></div>
          </div>
         <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' style="text-align:left;" >Country</label>
            <div class='col-md-3'>
                  <select id="country" name="country" class='form-control'></select>
                </div>
            
             
            <div class='col-md-3 indent-small' id="errorcountry" style="color:#FF0000"></div>
           </div>
        <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' style="text-align:left;">State</label>
            <div class='col-md-3'>
                  <select name="state" id="state" class='form-control'></select>
                </div>
            
              <div class='col-md-3 indent-small' id="errorstate" style="color:#FF0000"></div>

          </div>
          <script language="javascript">
            populateCountries("country", "state");
            populateCountries("country2");
        </script>
         <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' for='id_accomodation' style="text-align:left;" >City</label>
            <div class='col-md-3'>
              <input type="text" class='form-control' id='id_city' name="city" placeholder="City">
            </div>
             <div class='col-md-3 indent-small' id="errorcity" style="color:#FF0000"></div>
          </div>
      
          
          
           
          
         <div class='form-group row'>
           <div class='col-md-2 col-md-offset-4' >
   <input class='btn-lg btn-primary' type='submit' value="Submit" name="submit" onClick="return valid()" style="padding:5px;"/>
                </div>
                 <div class='col-md-1 ' >
                 <a href="teacherlist.php" style="text-decoration:none;">
   <input class='btn-lg btn-danger' type='button' value="Back" name="back"  style="padding:5px;"/>
   </a>
                </div>
                
                 <!--<div class='col-md-1'>
                    
       <input type="reset" class='btn-lg btn-danger' value="Cancel" name="cancel"  style="padding:5px;" />
                    
                  </div>
          -->
          
          
          
          
          
        </form>
      </div>
      <div class='row' align="center"  style="color:#FF0000"><?php echo $errorreport;?></div>
    </div>
  </div>
</body>


<?php
					 }
?>					  