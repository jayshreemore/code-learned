<?php
$report="";
include("corporate_cookieadminheader.php");
	if(isset($_POST['submit']))
	{
	    $user_type=$_POST['entity'];
		$email = $_POST['id_email'];
		$counts=0;
		//for sponsor
		if($user_type==4)
		{
		  $row1=mysql_query("select * from tbl_sponsorer where sp_email='$email'");
		  if(mysql_num_rows($row1)>0)
		  {
		  $counts=1;
		  
		  }
		}
		
	else if($user_type==1)
		{
		  $row1=mysql_query("select * from tbl_school_admin where email='$email'");
		  if(mysql_num_rows($row1)>0)
		  {
		echo "</br>counts".  $counts=1;
		  }
		}
		
		
	if($counts>0)
		{
			$report="email_id is already present";
		}
		else
		{
				$counts=0;
					if($user_type==4)
					{
							$company_name = $_POST['company_name'];
						 
							
						$phone = $_POST['id_phone'];
						$gender=$_POST['gender1'];
                        $category=$_POST['category'];
						$address = $_POST['address'];
						//echo "</br>password-->".$password = $_POST['password'];
						$country =mysql_real_escape_string( $_POST['country']);
						$state = mysql_real_escape_string($_POST['state']);
						$city = mysql_real_escape_string($_POST['city']);
						$dates = date('m/d/Y');
							
						
							
					}
					else
					{
					
                 $id_first_name = $_POST['id_first_name'];
                $id_last_name = $_POST['id_last_name'];
				$name=$id_first_name." ".$id_last_name;
				 $date = $_POST['dob'];
							// $password = $_POST['password'];
				$phone = $_POST['id_phone'];
				$gender=$_POST['gender1'];
				$address = $_POST['address'];
				$country = mysql_real_escape_string($_POST['country']);
				$state = mysql_real_escape_string($_POST['state']);
				$city = mysql_real_escape_string($_POST['city']);
				$dates = date('m/d/Y');
							
							
						
							 list($month,$day,$year) = explode("/",$date);
								$year_diff  = date("Y") - $year;
								$month_diff = date("m") - $month;
								$day_diff   = date("d") - $day;
							if ($day_diff < 0 || $month_diff < 0) $year_diff--;
										$age= $year_diff;
					}
					
			
				
			 if($user_type==1)
				{	
				 $password =$id_first_name."123";
				 $from="smartcookiesprogramme@gmail.com";
				 $to=$email;
	             $subject="Successful Registration";
	            $message="Hello ".$name."\r\n\r\n".
		 "Thanks for registration with Smart Cookie as School\r\n".
		 "your Username is: "  .$email.  "\n\n".
		  "your password is: ".$password."\n\n".
		  
		  "Regards,\r\n".
   	      "Smart Cookie Admin";
		  
       mail($to, $subject, $message);
					 $sqls= "INSERT INTO `tbl_school_admin`(name,address, scadmin_city,scadmin_dob, scadmin_gender,scadmin_age, scadmin_country, email,  reg_date,scadmin_state,mobile,password) VALUES ('$name','$address','$city','$dob','$gender','$age','$country', '$email','$dates','$state','$phone','$password')";
					 $count = mysql_query($sqls) or die(mysql_error());
					 //retrive current inserted record id
						$arr=mysql_query("select id from tbl_school_admin ORDER BY id DESC limit 1"); 
						$result=mysql_fetch_array($arr);
							if($count>=1){$report="successfully updated";
					 header("Location:addschool2.php?user_type=".$user_type."& id=".$result['id']);}
				}
				
				
				else if($user_type==4)
				{
				
				$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
						 $password =$sp_name."123";
						 
						  $from="smartcookiesprogramme@gmail.com";
						  $to=$email;
					$subject="Successful Registration";
				$message="Hello ".$company_name."\r\n\r\n".
						 "Thanks for registration with Smart Cookie as Sponsor\r\n".
		
		 			 "your Username is: "  .$email.  "\n\n".
		 			 "your password is: ".$password."\n\n".
		  
				  "Regards,\r\n".
   	      "Smart Cookie Admin";
		  
       mail($to, $subject, $message);
				
					$prepAddr = str_replace(' ','+',$address);
					
					 $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
			    	 $output= json_decode($geocode);	 
					$lat = $output->results[0]->geometry->location->lat;
					$long = $output->results[0]->geometry->location->lng;
					
					
					$sqls= "INSERT INTO `tbl_sponsorer`(sp_name,sp_address,sp_city,sp_country,sp_email,sp_date,lat,lon,sp_password,v_category) VALUES ('$company_name','$address','$city','$country', '$email','$dates','$lat','$long','$password','$category')";
					$count = mysql_query($sqls) or die(mysql_error()); 
					
					//retrive current inserted record id
							$arr=mysql_query("select id from tbl_sponsorer ORDER BY id DESC limit 1"); 
						$result=mysql_fetch_array($arr);
							if($count>=1){$report="successfully updated"; header("Location:addschool2.php?user_type=".$user_type."& id=".$result['id']);}
				}
				
				else
				{
					  echo "Please select User Type";
				}
			 }
          }
?>
<html>
<head>
<meta charset="utf-8">
<title>Smart Cookies</title>
<link href='css/datepicker.min.css' rel='stylesheet' type='text/css'>

  
<!-- <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>-->
<script src="js/city_state.js" type="text/javascript"></script>

 <script src='js/bootstrap-datepicker.min.js' type='text/javascript'></script>
   
  
          <!-- Load jQuery and bootstrap datepicker scripts -->
       <!-- <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/bootstrap-datepicker.min.js"></script>-->
        <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {

                $('#example1').datepicker({

                });



            });

             $(document).ready(function () {

                $('#catdiv').hide();
                });
        </script>
        <style>
		textarea {
   resize: none;
}
		</style>

<script type="text/javascript">
/*$(document).ready(function() {
    $('.multiselect').multiselect();


});*/



 var reg = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
      function PhoneValidation(phoneNumber)
      {
        var OK = reg.exec(phoneNumber.value);
        if (!OK)
		{
         document.getElementById('errorphone').innerHTML='Please Enter Valid Phone Number';
		return false;
		}
		else
		{
		 document.getElementById('errorphone').innerHTML='';
		return true;
		}

      }
function valid()
	{
	 if(document.getElementById("entity").value==4)
			{
				var company_name=document.getElementById("company_name").value;
				if(company_name==null|| company_name=="")
				{
					document.getElementById('errorname').innerHTML='';
					return false;
				}
				else
				{
		 			document.getElementById('errorname').innerHTML='Please Enter Company Name';

				}

                var cat=document.getElementById("category").value;
                 if(cat==null||cat=="")
				{

					document.getElementById('errorcat').innerHTML='';

					return false;
				}
				else
				{

				document.getElementById('errorcat').innerHTML='Please Select Category';

				}
					regx1=/^[A-z ]+$/;
		      var email=document.getElementById("id_email").value;

			   if(email=="")
				{

					document.getElementById('erroremail').innerHTML='';

					return false;
				}
				else
				{

				document.getElementById('erroremail').innerHTML='Please Enter email';
				}
				$regx2=/^[0-9 ]+$/
				var phone=document.getElementById("phone").value;
				if(phone==null || phone=="")
				{
				document.getElementById('errorphone').innerHTML='Please enter phone';
				return false;
				}
				else if(!regx2.test(phone))
				{
				document.getElementById('errorphone').innerHTML='';
					return false;
				}
				else
				{
					document.getElementById('errorphone').innerHTML='Please enter valid phone';
				}
			var address=document.getElementById("id_address").value;
	         	alert(address);

			}
	  else
	  {

		var first_name=document.getElementById("id_first_name").value;

		var last_name=document.getElementById("id_last_name").value;

		var state=document.getElementById("state").value;



		//var last_name=document.getElementById("id_last_name").value;
		regx1=/^[A-z ]+$/;
		var email=document.getElementById("id_email").value;

		var  country=document.getElementById("country").value;
		var city=document.getElementById("id_city").value;

		var password=document.getElementById("password").value;
	  var cnfpassword=document.getElementById("cnfpassword").value;

		if(first_name==null||first_name=="" || last_name==null|| last_name=="" )
			{

				document.getElementById('errorname').innerHTML='Please Enter Name';

				return false;
			}


				//validation for name
			else	if(!regx1.test(first_name) || !regx1.test(last_name))
				{
				document.getElementById('errorname').innerHTML='Please Enter valid Name';
					return false;
				}
				else
				{

				document.getElementById('errorname').innerHTML='';
				}



				if(email==null||email=="")
				{

					document.getElementById('erroremail').innerHTML='Please Enter email';

					return false;
				}
				else
				{

				document.getElementById('erroremail').innerHTML='';

				}
				$regx2=/^[0-9 ]+$/
				var phone=document.getElementById("phone").value;
				if(phone==null || phone=="")
				{
				document.getElementById('errorphone').innerHTML='Please enter phone';

					return false;

				}
				else if(!regx2.test(phone))
				{

				document.getElementById('errorphone').innerHTML='Please enter valid phone';

					return false;
				}
				else
				{
					document.getElementById('errorphone').innerHTML='';



				}


			var address=document.getElementById("id_address").value;

				if(address==null||address==" ")
				{

					document.getElementById('erroraddress').innerHTML='Please Enter address';

					return false;
				}
			  else
				{

					document.getElementById('erroraddress').innerHTML='';
				}

		 if(country=='-1')
			{

				document.getElementById('errorcountry').innerHTML='Please Enter country';

				return false;
			}
		  else
			{
			    document.getElementById('errorcountry').innerHTML='';

			}


	      if(state==null||state=="")
			{

				document.getElementById('errorstate').innerHTML='Please Enter state';

				return false;
			}
			else
			{

			  document.getElementById('errorstate').innerHTML='';

			}

		    if(city==null||city=="")
			{

				document.getElementById('errorcity').innerHTML='Please Enter city';

				return false;
			}
			else
			{
			  document.getElementById('errorcity').innerHTML='';


			}


		 if(password!=cnfpassword)
			{

				document.getElementById('errorpassword').innerHTML='Password does not match the confirm password';

				return false;
			}
		else
		{

			document.getElementById('errorpassword').innerHTML='';

		}
		}

	}

	function validemail()
	{
	       var email=document.getElementById("id_email").value;

			//validation of email
				//var atpos = email.indexOf("@");
				//var dotpos = email.lastIndexOf(".");
				//if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=x.length) {
				//	document.getElementById('erroremail').innerHTML='Please enter valid Email Id';
				//	return false;
				//}
				if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))  
				  {  
					return (true);  
				  }  
					alert("You have entered an invalid email address!")  
					return (false);
				//else
				//{
				//document.getElementById('erroremail').innerHTML='';

				//}
	           }


$(document).ready(function(){
		$('#entity').change(function(){


		 if(document.getElementById("entity").value==4)
			{
  			  $('#genderdiv').hide();
			  $('#datediv').hide();
			  $('#id_last_name').hide();

			   $('#id_first_name').hide();
               $('#catdiv').show();
 			 }
		 else{
			 	$('#genderdiv').show();
			  $('#datediv').show();
			  $('#id_last_name').show();
			  	  $('#id_first_name').show();
                  $('#catdiv').hide();

			 }
		});
	});



</script>

<script type="text/javascript">

$(document).ready(function() {

$('#entity').change(function() {

var num = $('#entity').val();

var html = ''; //string variable for html code for fields

if(num==4) {

html +=  ' <div class="col-md-3" >  <div class="form-group internal "> <input class="form-control" type="text" name="company_name" placeholder="Company Name" id="company_name" value="<?php if(isset($_POST['company_name'])){echo $_POST['company_name'];}?>" /></div></div>';
}

//insert this html code into the div with id catList
$('#catList').html(html);
});
});
</script>


</head>
<body>
<div id="head"></div>
<div id="login">

<form action="" method="post">
<div class='container' style="padding-top:20px;">

    <div class='panel panel-primary dialog-panel' style="background-color:radial-gradient(ellipse at center center , #E5E5E5 0%, #FFF 100%) repeat scroll 0% 0% transparent;">
   <div style="color:red;font-size:15px;font-weight:bold;margin-top:10px;background-color:radial-gradient(ellipse at center center , #E5E5E5 0%, #FFF 100%) repeat scroll 0% 0% transparent;" align="center"> <?php echo $report;?></div>
      <div class='panel-heading' style="background-color:radial-gradient(ellipse at center center , #E5E5E5 0%, #FFF 100%) repeat scroll 0% 0% transparent;">

            <h3 align="center">Registration</h3>
            <p align="center"><a href="Add_school_dataexcel.php">Add Excel sheet</a></p>



          </div>
      <div class='panel-body' >
        <form class='form-horizontal' role='form' method="post">
       <div class="row form-group">

                <label class='control-label col-md-3 col-md-offset-1' >User Type</label>
                <div class='col-md-3'>
                        <div class='form-group internal '>
                                <select required name="entity" id='entity' class='form-control' >
                                <?php if(isset($_POST['entity'])){
								      if($_POST['entity']=="1")
									  {?>
									  <option value="1" selected="selected">HR</option>
                                      <option value="4">Sponsor</option>
									 <?php }


									  if($_POST['entity']=="4")
									  {?>
                                      <option value="1" >HR</option>
									  <option value="4" selected="selected">Sponsor</option>
                                      <?php
                                      }
								}else{ ?><option value="1" selected="selected">HR</option>
                                      <option value="4">Sponsor</option><?php }?>
                              </select>
                        </div>
               </div>
         </div>

         <div class="row form-group">
           <label class='control-label col-md-3 col-md-offset-1' > Name</label>

           <div  id="catList"></div>


                      <div class='col-md-3' >
                        <div class='form-group internal '>
                 <input class='form-control' id='id_first_name' name="id_first_name" placeholder='Admin first name' type='text'value="<?php if(isset($_POST['id_first_name'])){echo $_POST['id_first_name'];}?>">

                        </div>

                     </div>
                      <div class='col-md-3 indent-small' >
                            <div class='form-group internal '>
                               <input class='form-control' id='id_last_name' name="id_last_name" placeholder='Admin last name' type='text' value="<?php if(isset($_POST['id_last_name'])){echo $_POST['id_last_name'];}?>">
                            </div>
                  </div>
                  <div class='col-md-3'></div>
                  <div class='col-md-3 ' id="errorname" style="color:#FF0000" align="center">

                  </div>



         </div>

          <div class="row form-group" id="catdiv">

            <label class='control-label col-md-3 col-md-offset-1' >Category</label>

              <div class='col-md-3'>
                <div class='form-group internal'>

                 <select required name="category" id='category' class='form-control' >
                                      <option value="" disabled selected="selected">Select Category</option>
                                <?php
                                    $sql = mysql_query("SELECT * FROM  `categories` ");
                                    while($cat = mysql_fetch_assoc($sql))
                                    {
									  ?>

                                      <option value="<?php echo $cat['id'] ?>"><?php echo $cat['category']; ?></option>
									 <?php }  ?>
                 </select>


                </div>
                  <!--<div  id="errorcat" style="color:#FF0000" align="center">      -->

             </div>
             <div  id="errorcat" style="color:#FF0000" align="center">  </div>
         </div>

         <div class="row form-group" id="datediv">

            <label class='control-label col-md-3 col-md-offset-1' >Date Of Birth</label>

              <div class='col-md-3'>
                <div class='form-group internal'>

 <input  type="text" class='form-control' placeholder="Date of Birth" name="dob" id="example1" value="<?php if(isset($_POST['dob'])){echo $_POST['dob'];}?>">
                </div>

             </div>
         </div>

          <div class='row form-group' id='genderdiv'>
            <label class='control-label col-md-3 col-md-offset-1'>Gender</label>
             <?php if(isset($_POST['gender1'])){
           if($_POST['gender1']=="Male"){?>
           <div class='col-md-1'>
          
                     Male <input type="radio" name="gender1" id="gender1" value="Male" checked >
                     </div>
                     <div class='col-md-2'>
                     Female <input type="radio" name="gender1" id="gender2" value="Female">
                      </div>
              <?php }else{?>
           <div class='col-md-1'>
          
                     Male <input type="radio" name="gender1" id="gender1" value="Male"  >
                     </div>
                     <div class='col-md-2'>
                     Female <input type="radio" name="gender1" id="gender2" value="Female" checked>
                      </div>
              <?php 
			  }
			  }
              else
              {
			?>
                  <div class='col-md-1'>
              
                  Male <input type="radio" name="gender1" id="gender1" value="Male" >
                     </div>
                     <div class='col-md-2'>
                     Female <input type="radio" name="gender1" id="gender2" value="Female">
                      </div>
              
              
           <?php   }?>
                <div class='col-md-2 indent-small' id="errorgender" style="color:#FF0000"> </div>
          </div>
          
           <div class='row form-group'>
            	<label class='control-label col-md-3 col-md-offset-1' >Email ID</label>
           
                <div class='col-md-3 form-group internal'>
                  <input class='form-control' id='id_email' name="id_email" placeholder='E-mail' type='text' onBlur="return validemail()">
                </div>
              
                <div class='col-md-3 indent-small' id="erroremail" style="color:#FF0000"></div>
           </div>
                
             
              <div class='row form-group'>
                      <label class='control-label col-md-3 col-md-offset-1' >Mobile No.</label>
                        <div class='col-md-3 form-group internal'>
                         <input class='form-control' id='phone' name="id_phone" placeholder='Enter mobile no' type='text' onChange="PhoneValidation(this);" value="<?php if(isset($_POST['id_phone'])){echo $_POST['id_phone'];}?>" >
                        </div>
              
                <div class='col-md-3 indent-small' id="errorphone" style="color:#FF0000"></div>
             
          </div>
          <div class="row form-group">
          	 <label class='control-label col-md-3 col-md-offset-1' >Address</label>
            <div class='col-md-3 '>
              <textarea class='form-control' id='id_address' name="address" placeholder='Address' rows='3' > </textarea>
            </div>
            <div class='col-md-2 indent-small' id='erroraddress' style="color:#FF0000"></div>
          </div>
          
          
         <div class='row form-group'>
            <label class='control-label col-md-3 col-md-offset-1' >Country</label>
            <div class='col-md-3'>
                  <select id="country" name="country" class='form-control' style="width:100%;" value=" <?php if(isset($_POST['country'])){echo $_POST['country'];}?>"></select>
                </div>
            
             
            <div class='col-md-3 indent-small' id="errorcountry" style="color:#FF0000"></div>
         </div>
         
         
        <div class='row form-group'>
            <label class='control-label col-md-3 col-md-offset-1'>State</label>
            <div class='col-md-3'>
                  <select name="state" id="state" class='form-control' style="width:100%;" value=" <?php if(isset($_POST['state'])){echo $_POST['state'];}?>"></select>
             </div>
            
              <div class='col-md-3 indent-small' id="errorstate" style="color:#FF0000"></div>
        </div>
          <script language="javascript">
            populateCountries("country", "state");
            populateCountries("country2");
        </script>
        <div class='row form-group'>
            <label class='control-label col-md-3 col-md-offset-1' for='id_accomodation'>City</label>
            <div class='col-md-3'>
              <input type="text" class='form-control' id='id_city' name="city" value=" <?php if(isset($_POST['city'])){echo $_POST['city'];}?>">
            </div>
             <div class='col-md-3 indent-small' id="errorcity" style="color:#FF0000"></div>
          </div>
          <?php /*?><div class='row form-group'>
                      <label class='control-label col-md-3 col-md-offset-1' >Password</label>
                        <div class='col-md-3 form-group internal'>
                          <input class='form-control' id='password' name='password' placeholder='Password' type='password'  v>
                        </div>
              
                
             
          </div>
           <div class='row form-group'>
                      <label class='control-label col-md-3 col-md-offset-1' >Confirm Password</label>
                        <div class='col-md-3 form-group internal'>
                          <input class='form-control' id='cnfpassword' name="cnfpassword" placeholder='Confirm Password' type='password'  >
                        </div>
              
              <div class='col-md-3 indent-small' id="errorpassword" style="color:#FF0000"></div>
             
          </div><?php */?>
          <div class='form-group row'>
           <div class='col-md-2 col-md-offset-3' >
                 <input class='btn-lg btn-primary' style='padding-left:25px;padding-right:25px' type='submit' value="Next" name="submit" onClick="return valid()" />
                </div>
                 <div class='col-md-1'>
                    
                    <a href="addschool.php">   <button class='btn-lg btn-danger'  type='submit' >Cancel</button></a>
                    
                  </div>
                
           
       
          </div>
         
        </form>
      </div>
     


</body>
</html>