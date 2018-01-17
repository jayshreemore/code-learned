<?php include 'index_header.php'; ?>
<?php
$cc = 91;
$report = "";
$user_type = '';
$name = '';
$email = '';
$cc = 91;
$phone = '';

require 'conn.php';
//require "twilio.php";
function checkIfUserExist($user_type, $email, $phone)
{
    switch ($user_type) {
        case 'student':
            $q = "select count(1) as exist from tbl_student where std_email like '$email' or std_phone='$phone'";
            break;
        case 'teacher':
            $q = "select count(1) as exist from tbl_teacher where t_email like '$email' or t_phone='$phone'";
            break;
        case 'sponsor':
            $q = "select count(1) as exist from tbl_sponsorer where sp_email like '$email' or sp_phone='$phone'";
            break;
    }
    $res1 = mysql_query($q) or die(mysql_error());
    $res = mysql_fetch_array($res1);
    if ($res['exist'] >= 1) {
        return true;
    } else {
        return false;
    }
}

function addUser($user_type, $name, $email, $cc, $phone, $password, $lat, $lon , $college_name)
{

    $name1 = explode(" ", $name);

    $FirstName = $name1[0];

    $date = date('m/d/Y', time());

    $q_country = mysql_query("select country from tbl_country where calling_code='$cc' order by country  desc limit 1") or die(mysql_error());
    $country1 = mysql_fetch_array($q_country);
    $country = $country1['country'];

    switch ($user_type) {
        case 'student':
            $sql = "insert into tbl_student(std_school_name,std_complete_name, std_name, std_email, std_phone, std_country, country_code, latitude, longitude, std_password, std_date,school_id,RegistrationSource ) values('$college_name','$name','$firstName','$email','$phone','$country','$cc','$lat', '$lon', '$password', '$date','OPEN','SELF')";
            $results = mysql_query($sql) or die(mysql_error());
            $id=mysql_insert_id();
            $update ="UPDATE tbl_student SET  std_PRN= $id WHERE id = $id";
            $updateResults=mysql_query($update);
            break;
        case 'teacher':
            $sql = "insert into tbl_teacher(t_current_school_name,t_complete_name, t_name, t_email, CountryCode, t_phone, t_country, t_password, t_date ,school_id) values('$college_name','$name','$firstName','$email','$cc','$phone','$country','$password', '$date','OPEN')";
            $results = mysql_query($sql) or die(mysql_error());
            $id=mysql_insert_id();
            $update ="UPDATE tbl_teacher SET  t_id = $id WHERE id = $id";
            $updateResults=mysql_query($update);
            break;
        case 'sponsor':
            $sql = "insert into tbl_sponsorer(sp_name, sp_company, sp_email, CountryCode, sp_phone, sp_password, sp_date, lat, lon, register_throught, sp_country) values('$name','$name','$email','$cc','$phone', '$password','$date','$lat', '$lon', 'website', '$country' )";
            $results = mysql_query($sql) or die(mysql_error());
            break;
    }
   // $res = mysql_query($sql) or die(mysql_error());
   //  $id=mysql_insert_id();
    // echo "<pre>";
   //  die(print_r($id,true));
    if ($updateResults) {
        return true;
    } else {
        return false;
    }
}

function emailUser($user_type, $email, $password)
{
    $to = $email;
    $from = "smartcookiesprogramme@gmail.com";
    $subject = "SmartCookie Registration";
    $message = "Dear " . $user_type . ",\r\n\r\n" .
        "Thanks for your registration with Smart Cookie as " . $user_type . "\r\n" .
        "Your Username is: " . $email . "\n\n" .
        "Your Password is: " . $password . "\n\n" .
        "Regards,\r\n" .
        "Smart Cookie Admin \n" . "www.smartcookie.in";

    if (mail($to, $subject, $message)) {
        return true;
    } else {
        return false;
    }
}

function messageUser($cc, $phone, $email, $password)
{
    switch ($cc) {
        case 91:
            $Text = "CONGRATULATIONS%21,+You+are+now+a+registered+User+of+Smart+Cookie+-+A+Student/Teacher+Rewards+Program.+Your+Username+is+" . $email . "+and+Password+is+" . $password . ".";
            $url = "http://www.smswave.in/panel/sendsms.php?user=blueplanet&password=123123&sender=PHUSER&PhoneNumber=$phone&Text=$Text";
            file_get_contents($url);
            break;
        case 1:
            $ApiVersion = "2010-04-01";
            // set our AccountSid and AuthToken
            $AccountSid = "ACf8730e89208f1dfc6f741bd6546dc055";
            $AuthToken = "45e624a756b26f8fbccb52a6a0a44ac9";
            // instantiate a new Twilio Rest Client
            $client = new TwilioRestClient($AccountSid, $AuthToken);
            $number = "+1" . $phone;
            $message = "CONGRATULATIONS!,You are now a registered User of Smart Cookie.Your Username is " . $email . " and Password is " . $password . ".";
            $response = $client->request("/$ApiVersion/Accounts/$AccountSid/SMS/Messages",
                "POST", array(
                    "To" => $number,
                    "From" => "732-798-7878",
                    "Body" => $message
                ));
            break;
    }
}


function randomPassword()
{
    $alphabet = 'abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

if (isset($_POST['submit'])) {
	
    $user_type = $_POST['user_type'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $cc = $_POST['cc'];
    $phone = $_POST['phone'];
    $lat = $_POST['lat'];
    $lon = $_POST['lon'];
	$selected_college_name = $_POST['select_college_name'];
	$college_name_by_user = $_POST['college_name_by_user'];

	
	if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0){  
		$msg="<span style='color:red'>The Validation code does not match!</span>";// Captcha verification is incorrect.		
	}else{// Captcha verification is Correct. Final Code Execute here!		
		
	if($college_name_by_user!=''){
		$college_name = $college_name_by_user;
	}
	elseif($selected_college_name!='')
	{
		$college_name = $selected_college_name;
	}
	else{
		$college_name = '';
	}

    if (empty($user_type) or empty($name) or empty($email) or empty($cc) or empty($phone)) {
        $report = "<span id='error' class='red'>All Fields Are Mandatory.</span>";
    } else {
        $mob = "/^[789][0-9]{9}$/";
        $emailval = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
        $fullname = '/^[a-zA-Z\s]+$/';
        if (!preg_match($fullname, $name)) {
            $report = "<span id='error' class='red'>Name must only contain letters.</span>";
        }
        if (!preg_match($emailval, $email)) {
            $report = "<span id='error' class='red'>Check your email.</span>";
        }
        if (!preg_match($mob, $phone)) {
            $report = "<span id='error' class='red'>Check your Mobile number.</span>";
        }
        $isExist = checkIfUserExist($user_type, $email, $phone);
        if ($isExist) {
            $report = "<span id='error' class='red'>User Already Exists.</span>";
        }
        if ($report == "") {
            $password = randomPassword();
            $add = addUser($user_type, $name, $email, $cc, $phone, $password, $lat, $lon , $college_name);
            if ($add) {
                emailUser($user_type, $email, $password);
                messageUser($cc, $phone, $email, $password);
                $report = "<span id='success' class='green'>Success, Registration Message/Email sent. <br/> Please login with credentials provided.</span>";
            } else {
                $report = "<span id='error' class='red'>Error Occured</span>";
            }
        }

    }
	}
}

?>
    <style>
        .bgwhite {
            background-color: #fff;
        }

        .padtop10 {
            padding-top: 10px;
        }

        .red {
            color: #f00;
        }

        tr {
            padding-top: 10px;
        }

        .green {
            color: #0f0;
        }
		.panel-info
		{
			width:1000px;
		}
    </style>
	 <script>
	 function refreshCaptcha(){
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
	function unioversity_name_blur(){
		var selected_college_name = document.getElementById("university_name").value;
		if(selected_college_name!='')
		{
			 document.getElementById("enter_college_name").disabled = true;
		}
	}
	
	function college_name_blur(){
		var selected_college_name = document.getElementById("enter_college_name").value;
		if(selected_college_name!='')
		{
			 document.getElementById("university_name").disabled = true;
		}
	}
	 </script>
    <script>
	   $(document).ready(function () {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
            $("#button").click(function(){
					$.ajax({
					url: "search_collegename.php",
					type:'post',
					data:$("#university_name").serialize(),
					success: function(result){
					$("#select_college_name").html(result);
						}});
					});


        });
        function showPosition(position) {
            document.getElementById("lat").value = position.coords.latitude;
            document.getElementById("lon").value = position.coords.longitude;
        }
    </script>
    <div class='row bgwhite padtop10'>
        <div class='col-md-10 col-md-offset-2'>
            <div class='panel panel-info'>
                <div class='panel-heading'>
                    <div class='panel-title'>
                        Express Registration
                    </div>
                </div>
                <div class='panel-body'>
                    <form method="post">
                        <table class='table '>
                            <tr>
                                <td>User Type<span class='red'>*</span></td>
                                <td>
                                    <select id='user_type' name='user_type' style='width:200px'>
                                        <option value='' <?php if ($user_type == "") {
                                            echo 'selected';
                                        } ?>>Select
                                        </option>
                                        <option value='student' <?php if ($user_type == "student") {
                                            echo 'selected';
                                        } ?>>Student
                                        </option>
                                        <option value='teacher' <?php if ($user_type == "teacher") {
                                            echo 'selected';
                                        } ?>>Teacher
                                        </option>
                                        <option value='sponsor' <?php if ($user_type == "sponsor") {
                                            echo 'selected';
                                        } ?>>Sponsor
                                        </option>
                                        <option value='mentor' <?php if ($user_type == "mentor") {
                                            echo 'selected';
                                        } ?>>Mentor
                                        </option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>Full Name<span class='red'>*</span></td>
                                <td><input type='text' id='name' name='name' style='width:200px'  value='<?php echo $name; ?>'/></td>
                            </tr>
                            <tr>
                                <td>Email Address<span class='red'>*</span></td>
                                <td><input type='email' id='email' name='email' style='width:200px'  value='<?php echo $email; ?>'/></td>
                            </tr>
                            <tr>
                                <td>Phone Number<span class='red'>*</span></td>
                                <td>
                                    <select id='cc' name='cc'>
                                        <option value="91" <?php if ($cc == 91) {
                                            echo 'selected';
                                        } ?>>+91
                                        </option>
                                        <option value="1" <?php if ($cc == 1) {
                                            echo 'selected';
                                        } ?>>+1
                                        </option>
                                    </select>
                                    <input type='number' style='width:150px' id='phone' name='phone' value='<?php echo $phone; ?>'/>
                                </td>
                            </tr>
                            <tr>
                                <td>university name</td>
                                <td>
                                    <input type='text' name='university_name' style='width:200px' class="university_name" id="university_name" onblur="unioversity_name_blur()"/>
                                </td>
                                <td><input type='button' class="go" name='go' id="button" value="Go"/></td>

                            </tr>
                            <tr>
                                <td>Select College name</td>

                                <td>
                                   <select id="select_college_name" class="college_name" name="select_college_name" style='width:400px'>
										<option>Select Option</option>
                                   </select>
                                </td>

                            </tr>
							  <tr>
                                <td>Enter College name</td>

                                <td>
								<input type='text' id='college_name_by_user' name='college_name_by_user' style='width:200px' onblur="college_name_blur()"/>
                                  
                                </td>

                            </tr>
							<tr>
							<?php include 'phpcaptcha/demo.php'; ?>
							</tr>
                            <tr>
                                <td>
                                    <input type='hidden' id='lat' name='lat' value=''/>
                                    <input type='hidden' id='lon' name='lon' value=''/>
                                    <input type='submit' name='submit' class='btn btn-success' value='Register'/>
                                </td>
                                <td>
                                    <?php echo $report; ?>
                                </td>
                            </tr>

                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            alert("jquery Runing");
            });
        });
    </script>


<?php include 'index_footer.php'; ?>