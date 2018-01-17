<?php
include('scadmin_header.php');
$report = "";
$results = $smartcookie->retrive_individual($table, $fields);
$result = mysql_fetch_array($results);
$sc_id = $result['school_id'];
$d_id = $_GET['d_id'];
$de_code = $_GET['d_code'];
//echo $d_id;die;
$result = "";
if (isset($_POST['submit'])) {
    $d_name = $_POST['dept_name'];
    $d_code = $_POST['dept_code'];
    $phone_no = $_POST['phone_no'];
    //$department_id = $_POST['department_id'];
    $FaxNo = $_POST['FaxNo'];
    $email = $_POST['email_id'];
    $isenable = $_POST['isenable'];
//echo phone_no;
if($de_code == $d_code)
{
	
	$sql = "UPDATE `tbl_department_master` SET Dept_Name='$d_name', Dept_code='$d_code',PhoneNo='$phone_no',Fax_No='$FaxNo', Email_Id='$email' WHERE id='$d_id'";
	//echo "<script>alert('123') </script>";
}
else
{
$sql1 = mysql_query("select * from tbl_department_master where school_id='$sc_id' and Dept_code='$d_code'");

if (mysql_num_rows($sql1) > 0) {
    echo "<script>alert('Record already present') </script>";
}
else
{
	$sql = "UPDATE `tbl_department_master` SET Dept_Name='$d_name', Dept_code='$d_code',PhoneNo='$phone_no',Fax_No='$FaxNo', Email_Id='$email' WHERE id='$d_id'";
}
}
    //$sql = "UPDATE `tbl_department_master` SET Dept_Name='$d_name', Dept_code='$d_code',PhoneNo='$phone_no',Fax_No='$FaxNo', Email_Id='$email' WHERE id='$d_id'";
   // echo "UPDATE `tbl_department_master` SET Dept_Name='$d_name', Dept_code='$d_code',PhoneNo='$phone_no',ExtDeptId='$department_id',Fax_No='$FaxNo', Email_Id='$email' WHERE id='$d_id'";
	if($sql!='')
	{
    $r = mysql_query($sql);
    if (mysql_affected_rows() > 0) {
        echo "<script>alert('Record Updated Successfully..!!') </script>";
    } else {
        echo "<script>alert('There is no change while updating record') </script>";
    }
	}
	
}

$sql = mysql_query("select * from tbl_department_master where school_id='$sc_id' and id='$d_id'");
if (mysql_num_rows($sql) > 0) {
    $result = mysql_fetch_assoc($sql);
}

?>

<body bgcolor="#CCCCCC">
<div style="bgcolor:#CCCCCC">
    <div>
    </div>
    <div class="container" style="padding:25px;">
        <div style="padding:2px 2px 2px 2px;border:1px solid #CCCCCC; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4; background-color:#F8F8F8 ;">
            <h2 style="padding-top:30px;">
                <center>Edit Department</center>
            </h2>
            <form method="post">
                <div class="row" style="padding-top:50px;">
                    <div class="col-md-4"></div>
                    <div class="col-md-2" style="color:#808080; font-size:18px;">Department Name</div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="dept_name" id="dept_name" value="<?php echo $result['Dept_Name'] ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-md-offset-5" id="errordept" style="color:#F00;"></div>
                </div>


                <div class="row" style="padding-top:30px;">
                    <div class="col-md-4"></div>
                    <div class="col-md-2" style="color:#808080; font-size:18px;">Department Code</div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="dept_code" id="dept_code" value="<?php echo $result['Dept_code'] ?>">
                    </div>
                    <div class="col-md-3" style="color:#FF0000;"><?php echo $report1; ?></div>
                </div>

                <div class="row">
                    <div class="col-md-2 col-md-offset-5" id="errordeptcode" style="color:#F00;"></div>
                </div>

                <div class="row" style="padding-top:30px;"><div class="col-md-4"></div>
                    <div class="col-md-2" style="color:#808080; font-size:18px;">Phone no</div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="phone_no" id="phone_no"
                               value="<?php if (isset ($result['Dept_code'])) {
                                   echo $result['PhoneNo'];
                               } ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2 col-md-offset-6" id="errorphone" style="color:#F00;"></div>
                </div>

              <!--  <div class="row" style="padding-top:30px;">
                    <div class="col-md-4"></div>

                    <div class="col-md-2" style="color:#808080; font-size:18px;">Department id</span></div>
                    <div class="col-md-3">
                        <input type="hidden" class="form-control" name="department_id" id="department_id"
                               value="<?php if (isset ($result['ExtDeptId'])) {
                                   echo $result['ExtDeptId'];
                               } ?>">
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-md-3 col-md-offset-6" id="errordepartment_id" style="color:#F00;"></div>
                </div>

                <div class="row" style="padding-top:30px;"><div class="col-md-4"></div>
                    <div class="col-md-2" style="color:#808080; font-size:18px;">Fax no</div>

                    <div class="col-md-3">
                        <input type="text" class="form-control" name="FaxNo" id="FaxNo"
                               value="<?php if (isset ($result['Fax_No'])) {
                                   echo $result['Fax_No'];
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
                        <input type="text" class="form-control" name="email_id" id="email_id" value="<?php echo $result['Email_Id'] ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2 col-md-offset-5" id="erroremail" style="color:#F00;"></div>
                </div>

                <div class="col-md-4"></div>
                <div class="row" style="padding-top:10px;">
                    <div class="col-md-4"></div>
                    <div class="col-md-2" style="color:#808080; font-size:18px;">Is Enabled</div>
                    <div class="col-md-3">Yes&nbsp;&nbsp; <input type="radio" name="isenable" id="isenable1" class="isenable" value="1" <?php echo ($result['Is_Enabled']=='1')?'checked':'' ?>> &nbsp;&nbsp;No&nbsp;
                        &nbsp;&nbsp;<input type="radio" name="isenable" id="isenable2" class="isenable" value="0" <?php echo ($result['Is_Enabled']=='0
                        ')?'checked':'' ?> >
                    </div>
                </div>

                <div class="row" style="padding-top:60px;">
                    <div class="col-md-5"></div>
                    <div class="col-md-1"><input type="submit" name="submit" value="Update"  class="btn btn-success"  onClick="return valid()"></div>
                  
				<div class="col-md-1"><a href="list_school_department.php"><input type="button" value="Back" class="btn btn-danger"></a></div>

                    <!--<div class="col-md-2"><input type="reset" name="cancel" value="Cancel"  class="btn btn-danger"></div>-->
                </div>


                <div class="row" style="padding-top:30px;">
                    <center style="color:#006600;"><?php echo $errorreport ?></center>
                    <center style="color:#093;"><?php echo $successreport ?></center>
                </div>


            </form>

        </div>
    </div>
</body>
</html>
