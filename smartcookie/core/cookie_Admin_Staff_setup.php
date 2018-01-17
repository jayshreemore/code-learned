                                                                                      <?php
$report="";

include("cookieadminheader.php");

    if(isset($_POST['submit']))
    {

          $email = $_POST['id_email'];


        $row=mysql_query("select * from tbl_cookie_adminstaff where email='$email'");
        if(mysql_num_rows($row)<=0)
        {
        $id_first_name = $_POST['id_first_name'];
        $id_last_name = $_POST['id_last_name'];

        $name=$id_first_name." ".$id_last_name;
        $education =$_POST['id_education'];
        $experience=$_POST['experience'];
        $designation=$_POST['Designation'];
        $date = $_POST['dob'];

        //$gender = $_POST['id_gender'];
        //retrive school_id and name school_admin
        //$arrs=$smartcookie->retrive_scadmin_profile();
        //$fields=array("id"=>$id);
        //$table="tbl_school_adminstaff";
        //$smartcookie=new smartcookie();
        //$results=$smartcookie->retrive_individual($table,$fields);
        //$arrs=mysql_fetch_array($results);
        //$school_id=$arrs['school_id'];
        //$school_name=$arrs['school_name'];
        //$class = $_POST['class1'];
        //$subject = $_POST['subject'];

        $email = $_POST['id_email'];
        $phone = $_POST['id_phone'];
        $gender=$_POST['gender'];
    	$address = $_POST['address'];
        $country = $_POST['country'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $dates = date('m/d/Y');

        $password = $id_first_name."123";
        $permision=implode(' ',$_POST['permission']);

         list($month,$day,$year) = explode("/",$date);
        $year_diff  = date("Y") - $year;
        $month_diff = date("m") - $month;
        $day_diff   = date("d") - $day;
        if ($day_diff < 0 || $month_diff < 0) $year_diff--;
        $age= $year_diff;

    $currentdate = date('Y-m-d H:i:s');




        $sqls="INSERT INTO `tbl_cookie_adminstaff` (`id`, `stf_name`, `exprience`, `designation`, `add`, `country`, `city`, `statue`, `dob`, `age`, `gender`, `email`, `phone`, `pass`, `userPoint`, `qualification`,`dataTime`) VALUES (NULL, '$name', '$experience', '$designation', '$address', '$country', '$city', '$state', '$date', '$age', '$gender', '$email', '$phone', '$password', '123', '$education', '$currentdate');";

    $count = mysql_query($sqls) or die(mysql_error());




    $sql1 = mysql_query("select id,stf_name from tbl_cookie_adminstaff where email='$email' or phone='$phone'");
    $result=mysql_fetch_array($sql1);

    $cookie_admin_staf_id=$result['id'];
    $cookie_staf_name=$result['stf_name'];



     $sql="INSERT INTO `tbl_permission` (`permission_id`, `school_id`, `s_a_st_id`, `cookie_admin_staff_id`,`school_staff_name`, `cookie_staff_name`, `permission`, `current_date`) VALUES (NULL, NULL, NULL, '$cookie_admin_staf_id', NULL, '$cookie_staf_name', '$permision', '$currentdate')";
        $report=mysql_query($sql) or die(mysql_error());
        if($count>=1){

   /*
   //
		wrong messege send to user so this email is commented
   //
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

       mail($to,$subject, $message);*/

					// mail format changed by Pravin 2017-08-16
					$site = $_SERVER['HTTP_HOST'];
					$msgid='cookiestaff';
						$res = file_get_contents("http://$site/core/clickmail/sendmail.php?email=$email&msgid=$msgid&site=$site&pass=$password");


            echo "<script>alert('Successfully Added New Staff');window.location.href='cookie_Admin_Staff_setup.php'</script>";
      //  $report1="successfully updated";
      //  header("Location:cookie_Admin_Staff_setup.php");
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
function toggle(source) {
  checkboxes = document.getElementsByName('permission[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}

function checkMaster(source) {
  checkboxes = document.getElementsByClassName('subMaster');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}

function checkSponsor(source) {
  checkboxes = document.getElementsByClassName('subSponsor');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
 </script>
 <script>
$(function () {
        // add multiple select / deselect functionality
      /*  $("#master").click(function () {

            $('.subMaster').attr('checked', this.checked);
        });*/
        // if all checkbox are selected, then check the select all checkbox
        // and viceversa
        $(".subMaster").click(function () {

           if($(".subMaster:checked").length!=0) {
                  $("#master").attr("checked", "checked");
            }
			else
			{
			 $("#master").removeAttr("checked");
			}

        });
    });

    $(function () {
        // add multiple select / deselect functionality
       /* $("#sponsor").click(function () {
            $('.subSponsor').attr('checked', this.checked);
        });*/
        // if all checkbox are selected, then check the select all checkbox
        // and viceversa
        $(".subSponsor").click(function () {

           if($(".subSponsor:checked").length!=0) {
                  $("#sponsor").attr("checked", "checked");
            }
			else
			{
			 $("#sponsor").removeAttr("checked");
			}

        });
    });
</script>



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

        if(first_name==null || first_name=="" || last_name==null || last_name=="" )
            {

                document.getElementById('errorname').innerHTML='Please Enter Name';

                return false;
            }

        regx1=/^[A-z ]+$/;
                //validation for name
                if(!regx1.test(first_name) || !regx1.test(last_name))
                {
                document.getElementById('errorname').innerHTML='Please Enter valid Name';
                    return false;
                }

                     var id_checkin=document.getElementById("id_checkin").value;
                if(id_checkin=="")
            {


                document.getElementById('errordob').innerHTML='Please Enter Date of Birth';

                return false;
            }
        var experience=document.getElementById("experience").value;
        if(experience==null||experience=="")
            {

                document.getElementById('errorexperience').innerHTML='Please Enter Experience';

                return false;
            }
            var gender1=document.getElementById("gender1").checked;

            var gender2=document.getElementById("gender2").checked;

        if(gender1==false && gender2==false)
            {
                document.getElementById('errorgender').innerHTML='Please Select gender';
                return false;
            }





        var subject=document.getElementById("subject").value;
        if(subject==null||subject=="")
            {

                document.getElementById('errorsubject').innerHTML='Please Enter Subject';

                return false;
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
                if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=x.length) {
                    document.getElementById('erroremail').innerHTML='Please enter valid Email Id';
                    return false;
                }




        var address=document.getElementById("id_address").value;
        if(address==null||address=="")
            {

                document.getElementById('erroraddress').innerHTML='Please Enter address';

                return false;
            }
        var country=document.getElementById("country").value;

        if(country=="-1")
            {

                document.getElementById('errorcountry').innerHTML='Please Enter country';

                return false;
            }

        var state=document.getElementById("state").value;
        if(state==null||state=="")
            {

                document.getElementById('errorstate').innerHTML='Please Enter state';

                return false;
            }
        var city=document.getElementById("id_city").value;

        if(city==null||city=="")
            {

                document.getElementById('errorcity').innerHTML='Please Enter city';

                return false;
            }




    }
</script>

</head>
<body >
  <div class='container' >
    <div class='panel panel-primary dialog-panel' style="background-color:#FFFFFF;border:1px solid #694489">
   <div style="color:red;font-size:15px;font-weight:bold;margin-top:10px;"><?php if(isset($_GET['report'])){ echo $_GET['report']; };?></div>
      <div class='panel-heading'>

            <h3 align="center" style="padding-left:20px; margin-top:2px;color:white;background-color:#694489;padding-top:10px;padding-bottom:10px">Cookie Admin Staff</h3>

            <div class='row' align="center"  style="color:#FF0000"><?php echo $report;?></div>

           <!--
           <div class='row' align="center"  style="color:green"><?php echo $report1;?></div>
           <h5 align="center"><a href="Add_teacherSheet.php" >Add Excel Sheet</a></h5>-->
    </div>
      <div class='panel-body'>
        <form class='form-horizontal' role='form' method="post">


        <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' for='id_title' style="text-align:left;">Staff Name<span style='color:red;font-weight:bold;font-size: 17px;'>&#9913</span></label>
            <div class='col-md-8'>

              <div class='col-md-3 '>
                <div class='form-group internal'>
                  <input class='form-control' id='id_first_name' name="id_first_name" placeholder='First Name' type='text' value='<?php if(isset($_POST['id_first_name'])) { echo $_POST['id_first_name'];}?>'>
                </div>
              </div>
              <div class='col-md-3 col-sm-offset-1'>
                <div class='form-group internal'>
                  <input class='form-control' id='id_last_name' name="id_last_name" value='<?php if(isset($_POST['id_last_name'])) { echo $_POST['id_last_name'];}?>' placeholder='Last Name' type='text'>
                </div>
              </div>
              <div class='col-md-4 indent-small' id="errorname" style="color:#FF0000">

              </div>
            </div>
          </div>






           <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' for='id_service' style="text-align:left;">Education</label>
            <div class='col-md-2'>
              <select class='multiselect  form-control' id='id_service' value='<?php if(isset($_POST['id_service'])) { echo $_POST['id_service'];}?>' name="id_education" >
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




            <label class='control-label col-md-2 '>Experience<span style='color:red;font-weight:bold;font-size: 17px;'>&#9913</span></label>

              <div class='col-md-2'>

                  <input class='form-control col-md-8' id='experience' value='<?php if(isset($_POST['experience'])) { echo $_POST['experience'];}?>' name='experience' placeholder='Experience' type='text'>

              </div>
             <div class='col-md-2 indent-small' id="errorexperience" style="color:#FF0000"></div>


          </div>

          <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' for='id_title' style="text-align:left;">Designation</label>


                <div class='col-md-8'>
           <input class='form-control col-md-8' style="width:20%;" id='Designation' value="" value='<?php if(isset($_POST['Designation'])) { echo $_POST['Designation'];}?>' name="Designation" placeholder='Designation' type='text'>
                </div>
                </div>



            <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' for='id_checkin' style="text-align:left;">Date Of Birth</label>
            <div class='col-md-8'>
              <div class='col-md-5'>
                <div class='form-group internal input-group'>

               <input class='form-control datepicker' id="id_checkin" value="" value='<?php if(isset($_POST['dob'])) { echo $_POST['dob'];}?>' name="dob" class="form-control">

                </div>

                <div class='col-md-15' id="errordob" style="color:#FF0000"></div>
              </div>

            </div>
          </div>


          <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' for='id_pets' style="text-align:left;">Gender<span style='color:red;font-weight:bold;font-size: 17px;'>&#9913</span></label>
           <div class='col-md-2' style="font-weight: 600;
color: #777;">
           <input type="radio" name="gender" id="gender1" value='<?php if(isset($_POST['gender'])) { echo $_POST['gender'];}?>' value="Male">
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
            <label class='control-label col-md-2 col-md-offset-2' for='id_email' style="text-align:left;" >Email<span style='color:red;font-weight:bold;font-size: 17px;'>&#9913</span></label>
            <div class='col-md-6'>
              <div class='form-group'>
                <div class='col-md-6'>
                  <input class='form-control' id='id_email' name="id_email" value='<?php if(isset($_POST['id_email'])) { echo $_POST['id_email'];}?>' placeholder='E-mail' type='text'>
                </div>
                <div class='col-md-3 indent-small' id="erroremail" style="color:#FF0000">

              </div>
              </div>
            </div>
          </div>

            <div class='form-group '>
                <label class='control-label col-md-2 col-md-offset-2' for='id_email' style="text-align:left;" >Contact</label>
                <div class='col-md-6'>
                    <div class='form-group'>
                        <div class='col-md-6'>
                    <input class='form-control' id='phone' name="id_phone" value='<?php if(isset($_POST['id_phone'])) { echo $_POST['id_phone'];}?>' placeholder='Mobile No' type='text' onChange="PhoneValidation(this);">
                </div>
                <div class='col-md-3 indent-small' id="errorphone" style="color:#FF0000">
                </div>
            </div>
                </div>
            </div>




          <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' for='id_comments' style="text-align:left;">Address<span style='color:red;font-weight:bold;font-size: 17px;'>&#9913</span></label>
            <div class='col-md-4'>
              <textarea class='form-control' id='id_address' name="address" value='<?php if(isset($_POST['address'])) { echo $_POST['address'];}?>' placeholder='Address' rows='3'></textarea>
            </div>
            <div class='col-md-2 indent-small' id="erroraddress" style="color:#FF0000"></div>
          </div>



         <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' style="text-align:left;" >Country<span style='color:red;font-weight:bold;font-size: 17px;'>&#9913</span></label>
            <div class='col-md-3'>
                  <select id="country" name="country" value='<?php if(isset($_POST['country'])) { echo $_POST['country'];}?>' class='form-control'></select>
                </div>


            <div class='col-md-3 indent-small' id="errorcountry" style="color:#FF0000"></div>
           </div>
        <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' style="text-align:left;">State<span style='color:red;font-weight:bold;font-size: 17px;'>&#9913</span></label>
            <div class='col-md-3'>
                  <select name="state" id="state" value='<?php if(isset($_POST['state'])) { echo $_POST['state'];}?>' class='form-control'></select>
                </div>

              <div class='col-md-3 indent-small' id="errorstate" style="color:#FF0000"></div>

          </div>
          <script language="javascript">
            populateCountries("country", "state");
            populateCountries("country2");
        </script>






         <div class='form-group'>
            <label class='control-label col-md-2 col-md-offset-2' for='id_accomodation' style="text-align:left;" >City<span style='color:red;font-weight:bold;font-size: 17px;'>&#9913</span></label>
            <div class='col-md-3'>
              <input type="text" class='form-control' value='<?php if(isset($_POST['city'])) { echo $_POST['city'];}?>' id='id_city' name="city" placeholder="City">
            </div>
             <div class='col-md-3 indent-small' id="errorcity" style="color:#FF0000"></div>
          </div>
       <div class='form-group'>

            <fieldset style="border:thick;    margin :20px;">
    <legend>Permissions:</legend>
                       <!--<input type="checkbox" name="permission[]" value="Leader Board"> Leader Board&nbsp;
                       <input type="checkbox" name="permission[]" value="Master"> Master&nbsp;
                       <input type="checkbox" name="permission[]" value="school"> school &nbsp;

                       <input type="checkbox" name="permission[]" value="Log"> Log<br></p>
                       <input type="checkbox" name="permission[]" value="Sponsor Map"> Sponsor Map
                       <input type="checkbox" name="permission[]" value="Purchese Coupons"> Purchese Coupons
                       <input type="checkbox" name="permission[]" value="Profile"> Profile
                       <input type="checkbox" name="permission[]" value="Start Board" > Start Board<br>-->

   <div class="form-group internal" align="center" style="padding:10px;"> <td style="background-color:#B2B2B2;  border-radius:5px;"><input type="checkbox" onClick="toggle(this)">Select All</td></div>
  <table id="perm" class="table table-bordered" style="border-radius:8px; border:1px solid #777;box-shadow: 1px 1px 1px 2px  rgba(150,150,150, 0.4);">
                           <tr style="background-color:#9F5F9F;color:white;box-shadow: 1px 1px 1px 2px  rgba(150,150,150, 0.6);">
                               <td>

                                   <input id="master" onclick="checkMaster(this) " type="checkbox" name="permission[]" value="Master"> Master


                               </td>
                               <td>

                                   <input type="checkbox" name="permission[]" value="Map"> Map   &nbsp;


                               </td>
                               <td>

                                   <input type="checkbox" name="permission[]" value="Gift Card"> Gift Card


                               </td>
                               <td>

                                   <input type="checkbox" name="permission[]" value="Colleges"> Colleges


                               </td>
                               <td>

                                   <input  id="sponsor" onclick="checkSponsor(this)" type="checkbox" name="permission[]" value="Sponsor"> Sponsor

                               </td>
                               <td>

                                   <input type="checkbox" name="permission[]" value="Social Footprint"> Social Footprint


                               </td>
                               <td>

                                   <input type="checkbox" name="permission[]" value="Log"> Log


                               </td>
                               <td>

                                   <input type="checkbox" name="permission[]" value="Leader Board"> Leader Board



                               </td>
                               <td>

                                   <input type="checkbox" name="permission[]" value="Error"> Error Log Report


                               </td>

                               <td>

                                   <input type="checkbox" name="permission[]" value="Account"> Account


                               </td>

                           </tr>
                           <tr>
                                <td>
                                     <ul style="list-style-type:none;margin-left: -41px;">
                                       <li>

                                           <input class="subMaster" type="checkbox" name="permission[]" value="School"> School/Sponsor

                                       </li>
                                       <li>

                                           <input class="subMaster" type="checkbox" name="permission[]" value="Sales Person"> Sales Person

                                       </li>
                                       <li>

                                           <input class="subMaster" type="checkbox" name="permission[]" value="Blue Points"> Blue Points

                                      </li>
                                       <li>

                                           <input class="subMaster" type="checkbox" name="permission[]" value="Activity"> Activity

                                       </li>
                                       <li>

                                           <input class="subMaster" type="checkbox" name="permission[]" value="Add Staff"> Add Staff

                                       </li>
                                       <li>

                                           <input class="subMaster" type="checkbox" name="permission[]" value="Type"> Activity Type

                                       </li>
                                       <li>

                                           <input class="subMaster" type="checkbox" name="permission[]" value="Soft Rewards"> Soft Rewards

                                       </li>
                                       <li>

                                           <input class="subMaster" type="checkbox" name="permission[]" value="ThanQ List"> ThanQ List

                                       </li>
                                       <li>

                                           <input class="subMaster" type="checkbox" name="permission[]" value="Categories & Currencies"> Categories & Currencies

                                       </li>
                                       <li>

                                           <input class="subMaster" type="checkbox" name="permission[]" value="Rule Engine"> Rule Engine

                                       </li>
                                     </ul>
                                </td>
                                <td></td>
                                <td></td>
                                <td>All India College List</td>
                                <td>
                                    <ul style="list-style-type:none;margin-left: -41px;">
                                        <li>

                                           <input class="subSponsor" type="checkbox" name="permission[]" value="Registered"> Registered Sponsers

                                        </li>
										<li>


                                           <input class="subSponsor" type="checkbox" name="permission[]" value="SponsorProfileSummery">Sponsor Profile Summary


                                        </li>
                                        <li>

                                           <input class="subSponsor" type="checkbox" name="permission[]" value="Suggested"> Suggested

                                        </li>
                                        <li>

                                           <input class="subSponsor" type="checkbox" name="permission[]" value="Location"> Location & Coupons

                                        </li>
                                        <li>

                                           <input class="subSponsor" type="checkbox" name="permission[]" value="Statistics"> Statistics

                                        </li>
                                    </ul>
                                </td>
                                <td></td>
                                <td>Soft Rewards</td>
                                <td></td>
                                <td></td>
                           </tr>
                      </table>
                  </fieldset>

           </div>



                            <div class='form-group row'>
           <div class='col-md-2 col-md-offset-4' >
                 <input class='btn-lg btn-primary' type='submit' value="Submit" name="submit" onClick="return valid()" style="padding:5px;"/>
                </div> <div class='col-md-1'>




              <div class='col-md-1'>

                     <a href="create_account.php"><button class='btn-lg btn-danger'  type='submit' style="padding:5px;">Cancel</button></a>

                  </div>


        </form>
      </div>

    </div>
  </div>
</body>
