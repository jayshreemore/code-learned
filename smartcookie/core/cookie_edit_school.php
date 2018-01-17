<?php
include("cookieadminheader.php");


$s_id = $_GET['s_id'];
$emailErr="";
if (isset($_POST['submit'])) {

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Validate Email

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }else{
            $emailid=$_POST["email"];
        }
    }

    // valied school name

    if (empty($_POST["s_name"])) {
        $nameErr = "School Name is required";
    } else {
        $name = test_input($_POST["s_name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $nameErr = "Only letters and white space allowed";
        }else{
            $scName=$_POST["s_name"];
        }
    }

    // school head name

   if (empty($_POST["s_head"])) {
       $scheadnameErr = "School head Name is required";
    } else {
        $name = test_input($_POST["s_head"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $scheadnameErr = "Only letters and white space allowed";
        }else{
            $scheadName=$_POST["s_head"];
        }
    }

       //phone validations

            if (empty($_POST["phone"])) {
                $phoneErr = "phone Name is required";
            } else {
                if (preg_match("/^\d{10}$/", $_POST["phone"])) {
                    $phone = $_POST['phone'];
                } else {
                    $phoneErr = 'Invalid Number!';
                }
            }

    if(empty($_POST["Country_Code"])){
        $ErrorCountry_Code="please select Country Code";
    }else{
        $Country_Code=$_POST["Country_Code"];
    }



    if(!empty($scName) && !empty($phone) && !empty($scheadName) && !empty($emailid)&& !empty($Country_Code)){
            $sql1 = "UPDATE `tbl_school_admin` SET  school_id='" . $_POST['id'] . "', school_name='$scName' ,name='$scheadName' ,email='$emailid',mobile='$phone',CountryCode='$Country_Code',address='" . $_POST['address'] . "'  WHERE id='" . $s_id . "'";
            mysql_query($sql1);
            if (mysql_affected_rows() > 0) {
                echo "<script>alert('Data Updated Successfully')</script>";
                header("Location: cookie_list_school.php");
            } else {
                echo "<script>alert('There is no change while updating')</script>";
            }
        }
}

$sql = "SELECT * FROM  `tbl_school_admin` WHERE id = '$s_id'";
$res = mysql_query($sql);
$val = mysql_fetch_array($res);


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
     <!--<script src="js/jquery-1.11.1.min.js"></script>-->
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <!--  <script src="js/bootstrap-datepicker.min.js"></script>-->
    <script type="text/javascript">
        // When the document is ready
        $(document).ready(function () {
            $('#example1').datepicker({});
        });
    </script>
    <style>
        textarea {
            resize: none;
        }
        .error {color: #FF0000;}
    </style>
</head>
<body>
<div id="head"></div>
<div id="login">

    <form action="" method="post">
        <div class='container' style="padding-top:20px;">
            <div class='panel panel-primary dialog-panel'
                 style="background-color:radial-gradient(ellipse at center center , #E5E5E5 0%, #FFF 100%) repeat scroll 0% 0% transparent;">
                <div style="color:red;font-size:15px;font-weight:bold;margin-top:10px;background-color:radial-gradient(ellipse at center center , #E5E5E5 0%, #FFF 100%) repeat scroll 0% 0% transparent;" align="center"> <?php echo $report; ?></div>
                <div class='panel-heading' style="background-color:radial-gradient(ellipse at center center , #E5E5E5 0%, #FFF 100%) repeat scroll 0% 0% transparent;">
                    <h3 align="center">Edit School Details</h3>
                </div>
                <div class='panel-body'>
                    <form class='form-horizontal' role='form' id="target" method="post">
                        <div class="row form-group">
                            <label class='control-label col-md-3 col-md-offset-1'>School ID</label>
                            <div class='col-md-3'>
                                <div class='form-group internal '>
                                    <input class='form-control' id='c_name' name="id" placeholder='School ID'
                                           type='text' value="<?php echo $val['school_id']; ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class='control-label col-md-3 col-md-offset-1'>School Name</label>
                            <div class='col-md-3'>
                                <div class='form-group internal '>
                                    <input class='form-control' id='c_name' name="s_name" placeholder='School Name'
                                           type='text' value="<?php echo $val['school_name']; ?>" >
                                    <span class="error"><?php echo $nameErr;?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class='control-label col-md-3 col-md-offset-1'>School Head</label>
                            <div class='col-md-3'>
                                <div class='form-group internal '>
                                    <input class='form-control' id='id_first_name' name="s_head"
                                           placeholder='School Head' type='text' value="<?php echo $val['name']; ?>">
                                    <span class="error"><?php echo $scheadnameErr;?></span>
                                </div>
                            </div>
                        </div>

                        <div class='row form-group'>
                            <label class='control-label col-md-3 col-md-offset-1'>Email</label>
                            <div class='col-md-3 form-group internal'>
                                <input class='form-control' id='email_id' name="email" placeholder='Email' type='text'
                                        value="<?php echo $val['email']; ?>" >
                                <span class="error"><?php echo $emailErr;?></span>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <label class='control-label col-md-3 col-md-offset-1'>Country Code</label>
                            <div class='col-md-3 form-group internal'>
                                <select name="Country_Code" class='form-control'>
                                    <option value="91" <?php if($val['CountryCode']=='91'){echo "selected";}else{}?> >91</option>
                                    <option value="1" <?php if($val['CountryCode']=='1'){echo "selected";}else{}?> >1</option>
                                </select>
                                <span class="error"><?php echo $ErrorCountry_Code;?></span>
                            </div>
                        </div>


                        </div>

                        <div class="row form-group">
                            <label class='control-label col-md-3 col-md-offset-1'>Phone No</label>
                            <div class='col-md-3 '>
                                <input class='form-control' id='phone_no' name="phone" placeholder='Phone' type='text' value="<?php echo trim($val['mobile']); ?>">
                                <span class="error"><?php echo $phoneErr;?></span>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class='control-label col-md-3 col-md-offset-1'>Address</label>
                            <div class='col-md-3 '>
                                <textarea class='form-control' id='id_address' name="address" placeholder='Address'
                                          rows='3' required><?php echo trim($val['address']); ?> </textarea>
                            </div>
                        </div>


                        <div class='form-group row'>
                            <div class='col-md-2 col-md-offset-3'>
                                <input class='btn-lg btn-primary' id="formsubmit" onClick="return valid()" type='submit' value="Update" name="submit"/>
                            </div>
                            <div class='col-md-1'>
                                <a href="cookie_list_school.php"><input type="button" value="Cancel" class='btn-lg btn-danger'></input></a>
                            </div>
                        </div>
                    </form>
                </div>
</body>
</html>