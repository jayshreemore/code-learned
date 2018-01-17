<?php
ini_set("max_execution_time", "-1");
ini_set("memory_limit", "-1");
ignore_user_abort(true);
set_time_limit(0);
include("smartcookiefunction.php");
 include_once("header.php");
$server_name = $_SERVER['SERVER_NAME'];
 if(!isset($_SESSION['id']))
	{
		header('location:login.php');
	}

//echo "select * from tbl_user where t_email = '".$_SESSION['username']."' and t_password = '".$_SESSION['password']."'";die;
$query = mysql_query("select * from tbl_teacher where id = ".$_SESSION['id']);
$value = mysql_fetch_array($query);
$teacher_id=$value['t_id'];
$teacher_name='';
$school_id1=$value['school_id'];
if(isset($_POST['submit']))
{
	//echo "<script>alert('1');</script>";
	$sender_entity_id=103;
	$receiver_entity_id=$_POST['user_entity'];
	$receiver_country_code=$_POST['receiver_country_code'];
	$receiver_mobile_number=$_POST['receiver_mobile_number'];
	$receiver_email_id=$_POST['receiver_email_id'];
	$firstname=$_POST['firstname'];
	$middlename=$_POST['middlename'];
	$lastname=$_POST['lastname'];
	$platform_source='web';
	$request_status='request_sent';
//echo "<script>alert('2');</script>";

	$data = array('sender_name'=>'nikita',
	'sender_member_id'=>$_SESSION['id'],
	'sender_entity_id'=>103,
	'receiver_entity_id'=>$receiver_entity_id,
	'receiver_country_code'=>$receiver_country_code,
	'receiver_mobile_number'=>$receiver_mobile_number,
	'receiver_email_id'=>$receiver_email_id ,
	'firstname'=>$firstname ,
	'middlename'=>$middlename ,
	'platform_source'=>$platform_source,
	'lastname'=>$lastname,
	'request_status'=>$request_status
	 );
	//echo var_dump($data)."<br>";
	 //echo"teacher_id";
	 //echo"t_id";
	// echo "<script>alert('3');</script>";
					$ch = curl_init("https://$server_name/core/Version2/send_request_to_join_smartcookie.php");
					//echo "<script>alert('4');</script>";
					$data_string = json_encode($data);
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Content-Type: application/json',
					'Content-Length: ' . strlen($data_string))
					);
					$result = json_decode(curl_exec($ch),true);
          //	echo "<script>alert('5');</script>";
					//var_dump($result);
					$responce = $result["responseStatus"];
        //  echo "<script>alert('6');</script>";
                //  echo "<script>alert('$responce');</script>";
					if($responce==200)
						{
					echo "<script>alert('Request Send succesfully');location.assign('https://$server_name/core/form.php');
					</script>";
					}
          elseif($responce==409)
						{
					echo "<script>alert('user already exists');location.assign('https://$server_name/core/form.php');
					</script>";
					}
          elseif($responce==204)
						{
					echo "<script>alert('No Response');location.assign('https://$server_name/core/form.php');
					</script>";
					}
          elseif($responce==1000)
						{
					echo "<script>alert('Ivalide Inputs');location.assign('https://$server_name/core/form.php');
					</script>";
					}
          elseif($responce==208)
						{
					echo "<script>alert('User already Requested');location.assign('https://$server_name/core/form.php');
					</script>";
					}
          elseif($responce=='')
						{
					echo "<script>alert('Something Went Wrong');location.assign('https://$server_name/core/form.php');
					</script>";
					}

					//echo '2';
					/*if($responce==200)
				    {
					echo "<script>alert('request Send Succesfully');location.assign('http://$server_name/core/form.php');
					</script>";
					}	*/

}

?>




<html>
<head>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
function form_validation(){
var user_entity = $('#user_entity').val();
var firstname = $('#firstname').val();
var middlename = $('#middlename').val();
var lastname = $('#lastname').val();
var receiver_email_id = $('#receiver_email_id').val();
var receiver_country_code = $('#receiver_country_code').val();
var receiver_mobile_number = $('#receiver_mobile_number').val();
var msg = '';
if(firstname == '')
{
  msg += 'Please Enter First Name<br />';
}
var firstname_patt =  /^[a-zA-Z]*$/;
var firstname_res = firstname_patt.test(firstname);
if(firstname_res == false)
{
    msg += 'Please Enter Only Alphabates In First Name Field<br />';
}
if(user_entity == '')
{
  msg += 'Please Select User<br />';
}
if(middlename == '')
{
  msg += 'Please Enter Middle Name<br />';
}
var middlename_patt =  /^[a-zA-Z]*$/;
var middlename_res = middlename_patt.test(middlename);
if(middlename_res == false)
{
    msg += 'Please Enter Only Alphabates In Middle Name Field<br />';
}
if(lastname == '')
{
  msg += 'Please Enter Last Name<br />';
}
var lastname_patt =  /^[a-zA-Z]*$/;
var lastname_res = lastname_patt.test(lastname);
if(lastname_res == false)
{
    msg += 'Please Enter Only Alphabates In Last Name Field<br />';
}
if(receiver_email_id == '')
{
  msg += 'Please Enter Email Id Of Receiver<br />';
}
var email_patt =  /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
var email_res = email_patt.test(receiver_email_id);
if(email_res == false)
{
    msg += 'Please Enter Valid Email Id<br />';
}
if(receiver_country_code == '')
{
  msg += 'Please Enter Country Code Of Receiver<br />';
}
if(receiver_mobile_number == '')
{
  msg += 'Please Enter Mobile Number Of Receiver<br />';
}


if(msg !='')
{
$('#error_msg_box').show();
$("#error_msg_box").append("<b>" + msg + "</b>");
return false;
}
else {
//  alert('123');
  return true;
}


}
</script>
<!-- Latest compiled JavaScript -->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
</head>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">


                </div>
                <div class="panel-body">
                  <div style='border:1px solid black;padding:30px'>
                    <form class="form-horizontal" role="form" method='post' onSubmit='return form_validation()'>

						<div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Select User<span style="color:red;font-size:20px">*</span></label>
                            <div class="col-sm-9">
                               <select name='user_entity' id='user_entity' required>
							   <option value=''>choose</option>
							   <option value='105'><?php echo $dynamic_student;?></option>
							   <option value='103'><?php echo $dynamic_teacher;?></option>
							   </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Firstname<span style="color:red;font-size:18px">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="firstname" value="" required>
                            </div>
                        </div>
						<div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Middlename<span style="color:red;font-size:18px">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="middlename" name="middlename" placeholder="middlename Name"  value="" required>
                            </div>
                        </div>
						<div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Lastname<span style="color:red;font-size:18px">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="lastname" name="lastname"  placeholder="lastname" value="" required>
                            </div>
                        </div>
						<div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Email id<span style="color:red;font-size:18px">*</span></label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="receiver_email_id"  name="receiver_email_id" placeholder="receiver_email_id" value="" required>
                            </div>
                        </div>

						<div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Country Code<span style="color:red;font-size:18px">*</span></label>
                            <div class="col-sm-9">
                                <select id="receiver_country_code" name="receiver_country_code" required>
                                  <option value=''>Choose</option>
                                  <option value='91'>91</option>
                                  <option value='1'>1</option>
                                </select>
                            </div>
                        </div>
						<div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Mobile no<span style="color:red;font-size:18px">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="receiver_mobile_number" name="receiver_mobile_number"placeholder="receiver_mobile_number"  value="" required>
                            </div>
                        </div>

                        <div class="form-group">
                           <!-- <div class="col-sm-offset-3 col-sm-9">
                                <div class="checkbox">
                                    <label class="">
                                        <input type="checkbox" class="">Remember me</label>
                                </div>
                            </div>-->
                        </div>
                        <div class="form-group last">
                            <div class="col-sm-offset-3 col-sm-9">
                                <input  type="submit"  value="Submit" name='submit' class="btn btn-success btn-sm">

                            </div>
                        </div>
                    </form>
                    <div>
                </div>
                <div id='error_msg_box' style='display:none;padding:10px;border:1px solid red;color:red'>
                </div>
               <!-- <div class="panel-footer">Not Registered? <a href="#" class="">Register here</a>
                </div>-->
            </div>
        </div>
    </div>
</div>
</html>
