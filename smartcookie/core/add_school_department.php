<?php


if (isset($_GET['name'])) {
    include('school_staff_header.php');
    $table = "tbl_school_adminstaff";
} else {
    include('scadmin_header.php');
    $table = "tbl_school_admin";
}

$successreport = "";
$errorreport = "";
$report1 = "";
/* include('scadmin_header.php');
$id=$_SESSION['id'];*/
$fields = array("id" => $id);
/*  $table="tbl_school_admin"; */

$smartcookie = new smartcookie();

$results = $smartcookie->retrive_individual($table, $fields);
$result = mysql_fetch_array($results);
$sc_id = $result['school_id'];


if (isset($_POST['submit'])) {
    $dept_code = $_POST['dept_code'];
    $dept_name = $_POST['dept_name'];
    $year = $_POST['year'];
    $department_id = $_POST['department_id'];
    $FaxNo = $_POST['FaxNo'];
    $email_id = $_POST['email_id'];
    $isenable = $_POST['isenable'];
    $phone_no = $_POST['phone_no'];

    if ($_POST['dept_code'] != '') {
		
		$query= "select * from registration WHERE ExtDeptId=='$department_id'";
					$query_run = mysqli_query($conn,$query);
					
					if(mysqli_num_rows($query_run)>0)
					{
						// there is already a user with the same username
						echo '<script type="text/javascript"> alert("User already exists.. try another username") </script>';
					}
        $sql = mysql_query("select  Dept_code from tbl_department_master where school_id='$sc_id' and Dept_code='$dept_code'");
        $result = mysql_num_rows($sql);
        if ($result == 0) {
            $query = mysql_query("insert into tbl_department_master (PhoneNo,Dept_code,Dept_Name,Establiment_Year,ExtDeptId,`Fax_No`,Email_Id,School_ID,Is_Enabled) values('$phone_no','$dept_code','$dept_name','$year','$department_id','$FaxNo','$email_id','$sc_id','$isenable')");
            $successreport = "$dept_name is successfully Inserted";
        } else {
            $errorreport = "$dept_code Department Code is already exists";
        }
    } else {
        $errorreport = "Department Code is must";
    }
}
?>
<html>
<head>
    <script>
        function valid() {
            //Department Name Validation
            var dept_name = document.getElementById("dept_name").value;
            regx1 = /^[A-z ]+$/;
            if (dept_name == null || dept_name == "") {
                document.getElementById('errordept').innerHTML = 'Please Enter Department';
                return false;
            }
            else if (!regx1.test(dept_name)) {
                document.getElementById('errordept').innerHTML = 'Please Enter valid  Department';
                return false;
            } else {
                document.getElementById('errordept').innerHTML = '';
            }

            //Department Code Validation
            var dept_code = document.getElementById("dept_code").value;
            if (dept_code == null || dept_code == "") {
                document.getElementById('errordeptcode').innerHTML = 'Please Enter dept code';
                return false;
            } else {
                document.getElementById('errordeptcode').innerHTML = '';
            }

            //Establishment Year Validation
            var year = document.getElementById("year").value;
            if (year == null || year == "") {
                document.getElementById('erroryear').innerHTML = 'Please select year';
                return false;
            } else {
                document.getElementById('erroryear').innerHTML = '';
            }

            //Phone  Validation
            var phone = document.getElementById("phone_no").value;

            if (phone.length > 10 || phone.length < 10 || isNaN(phone)) {
                document.getElementById('errorphone').innerHTML = 'Please Enter Valid Phone Number';
                return false;
            }
            else {
                document.getElementById('errorphone').innerHTML = '';
            }

            //Department Id  Validation
            var department_id = document.getElementById("department_id").value;
            if (department_id == null || department_id == "") {
                document.getElementById('errordepartment_id').innerHTML = 'Please Enter dept id';
                return false;
            } else {
                document.getElementById('errordepartment_id').innerHTML = '';
            }

            // Fax number  Validation
            var FaxNo=document.getElementById("FaxNo").value;
            if(FaxNo=='')
            {
                document.getElementById('errorfax').innerHTML='Please enter a Fax number';
                return false;
            }
            if(isNaN(FaxNo))
            {
                document.getElementById('errorfax').innerHTML='Please enter valid fax number';
                return false;
            }
            else
            {
                document.getElementById('errorfax').innerHTML='';
            }

            // Email Validation
            var email = document.getElementById("email_id").value;
            if (email == null || email == "") {
                document.getElementById('erroremail').innerHTML = 'Please Enter email';
                return false;
            }
            var atpos = email.indexOf("@");
            var dotpos = email.lastIndexOf(".");
            if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
                document.getElementById('erroremail').innerHTML = 'Please enter valid Email Id';
                return false;
            }
            else {
                document.getElementById('erroremail').innerHTML = '';
            }

            //Is Enable Validation
            var isenable = document.getElementsByClassName("isenable").value;
            if (isenable == null || isenable == "") {
                document.getElementById('error_is_enable').innerHTML = 'Please select  is enable';
                return false;
            } else {
                document.getElementById('error_is_enable').innerHTML = '';
            }
        }
    </script>
</head>

<body bgcolor="#CCCCCC">
<div style="bgcolor:#CCCCCC">
    <div>
    </div>
    <div class="container" style="padding:25px;">
        <div style="padding:2px 2px 2px 2px;border:1px solid #CCCCCC; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4; background-color:#F8F8F8 ;">
            <h2 style="padding-top:30px;">
                <center>Add Department</center>
            </h2>

            <form method="post">
                <div class="row" style="padding-top:50px;">
                    <div class="col-md-4"></div>
                    <div class="col-md-2" style="color:#808080; font-size:18px;">Department Name <span style="color:red;font-size: 25px;">*</span></div>

                    <div class="col-md-3">
                        <input type="text" class="form-control" name="dept_name" id="dept_name"
                               value="<?php if (isset ($_POST['dept_name'])) {
                                   echo $_POST['dept_name'];
                               } ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-md-offset-5" id="errordept" style="color:#F00; text-align: center;"></div>
                </div>

                <div class="row" style="padding-top:30px;">
                    <div class="col-md-4"></div>

                    <div class="col-md-2" style="color:#808080; font-size:18px;">Department Code <span style="color:red;font-size: 25px;">*</span></div>

                    <div class="col-md-3">
                        <input type="text" class="form-control" name="dept_code" id="dept_code"
                               value="<?php if (isset ($_POST['dept_code'])) {
                                   echo $_POST['dept_code'];
                               } ?>">
                    </div>

                    <div class="col-md-3" style="color:#FF0000; text-align: center;"><?php echo $report1; ?></div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-md-offset-6" id="errordeptcode" style="color:#F00;text-align: center;"></div>
                </div>

                <div class="row" style="padding-top:30px;">
                    <div class="col-md-4"></div>
                    <div class="col-md-2" style="color:#808080; font-size:18px;">Establishment Year<span style="color:red;font-size: 25px;">*</span></div>
                    <?php $date = date('Y'); ?>
                    <div class="col-md-3">
                        <select name="year" class="form-control" id='year'>
                            <option value="">Select Year</option>
                            <?php
                            for ($i = $date; $i > 1900; $i--) {
                                ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2 col-md-offset-6" id="erroryear" style="color:#F00;"></div>
                </div>

                <div class="row" style="padding-top:30px;"><div class="col-md-4"></div>
                    <div class="col-md-2" style="color:#808080; font-size:18px;">Phone no<span style="color:red;font-size: 25px;">*</span></div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="phone_no" id="phone_no"
                               value="<?php if (isset ($_POST['phone_no'])) {
                                   echo $_POST['phone_no'];
                               } ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2 col-md-offset-6" id="errorphone" style="color:#F00;"></div>
                </div>


                <div class="row" style="padding-top:30px;">
                    <div class="col-md-4"></div>

                    <div class="col-md-2" style="color:#808080; font-size:18px;">Department id<span style="color:red;font-size: 25px;">*</span></div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="department_id" id="department_id"
                               value="<?php if (isset ($_POST['department_id'])) {
                                   echo $_POST['department_id'];
                               } ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-md-offset-6" id="errordepartment_id" style="color:#F00;"></div>
                </div>

                <div class="row" style="padding-top:30px;"><div class="col-md-4"></div>
                <div class="col-md-2" style="color:#808080; font-size:18px;">Fax no</div>

                    <div class="col-md-3">
                        <input type="text" class="form-control" name="FaxNo" id="FaxNo"
                               value="<?php if (isset ($_POST['FaxNo'])) {
                                   echo $_POST['FaxNo'];
                               } ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2 col-md-offset-6" id="errorFaxNo" style="color:#F00;"></div>
                </div>


                <div class="row" style="padding-top:30px;">
                    <div class="col-md-4"></div>
                    <div class="col-md-2" style="color:#808080; font-size:18px;">Email Id</div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="email_id" id="email_id"
                               value="<?php if (isset ($_POST['email_id'])) {
                                   echo $_POST['email_id'];
                               } ?>">
                    </div>
                  </div>

                <div class="col-md-4"></div>
                <div class="row" style="padding-top:10px;">
                    <div class="col-md-4"></div>
                    <div class="col-md-2" style="color:#808080; font-size:18px;">Is Enabled</div>
                    <div class="col-md-3">Yes&nbsp;&nbsp; <input type="radio" name="isenable" id="isenable1" class="isenable" value="1"> &nbsp;&nbsp;No&nbsp;
                        &nbsp;&nbsp;<input type="radio" name="isenable" id="isenable2" class="isenable" value="0">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2 col-md-offset-5" id="error_is_enable" style="color:#F00;"></div>
                </div>


                <div class="row" style="padding-top:60px;">
                    <div class="col-md-5"></div>
                    <div class="col-md-1"><input type="submit" name="submit" value="Save" class="btn btn-success" onClick="return valid()"></div>
                    <div><a href="list_school_department.php" style="text-decoration:none;">
                            <input type="button" class="btn btn-primary" name="Back" value="Back" style="width:80px;font-weight:bold;font-size:14px;"/>
                        </a>
                    </div>
                    <!--<div class="col-md-2"><input type="reset" name="cancel" value="Cancel"  class="btn btn-danger"></div>-->
                </div>

                <div class="row" style="padding-top:30px;">
                    <center style="color:#FF0000;"><?php echo $errorreport ?></center>
                    <center style="color:#093;"><?php echo $successreport ?></center>
                </div>

            </form>
        </div>
    </div>
</body>

</html>


