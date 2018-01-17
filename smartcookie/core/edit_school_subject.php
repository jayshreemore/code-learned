<?php
$report = "";
include("scadmin_header.php");
if (!isset($_SESSION['id'])) {
    header('location:login.php');
}
$id = $_SESSION['id'];
$fields = array("id" => $id);
$table = "tbl_school_admin";
$smartcookie = new smartcookie();
$results = $smartcookie->retrive_individual($table, $fields);
$result = mysql_fetch_array($results);
$sc_id = $result['school_id'];
if (isset($_GET["subject"])) {
    $subject_id = $_GET['subject'];
    //echo "select * from tbl_school_subject where id='$subject_id' and school_id='$sc_id'";
    $sql1 = "select * from tbl_school_subject where id='$subject_id' and school_id='$sc_id'";
    $row = mysql_query($sql1);
    $arr = mysql_fetch_array($row);
    $id = $arr['id'];
    $subject = $arr['subject'];
    $branchName = $arr['Branch_ID'];
    $Subject_Code = $arr['Subject_Code'];
    $course_level = $arr['Course_Level_PID'];
    $semester = $arr['Semester_id'];
    $select = $arr['Year'];

    if (isset($_POST['submit'])) {
        $Subject_Code = $_POST['Subject_Code'];
        $subject = $_POST['subject'];
        $Branch = $_POST['Branch'];
        $course_level = $_POST['course_level'];
        $Year = $_POST['Year'];
//        $semester = $_POST['Semester_id'];
//                           echo "update tbl_school_subject set Subject_Code='$Subject_Code', subject='$subject', Course_Level_PID='$course_level',Branch_ID='$Branch' where id='$id' and school_id='$sc_id'";
//        die;
        $sql3 = "update tbl_school_subject set Subject_Code='$Subject_Code', subject='$subject', Course_Level_PID='$course_level',Branch_ID='$Branch', Year_ID='$Year' where id='$id' and school_id='$sc_id'";
        if (mysql_query($sql3)) {
			echo '<script type="text/javascript"> alert("Records  updated successfully.") </script>';
          //  echo "Records  updated successfully.";
        } else {
			echo '<script type="text/javascript"> alert("ERROR: Could not able to execute") </script>';
           // echo "ERROR: Could not able to execute ";
        }
    } ?>
    <html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
        <script>
            function valid() {
                var subject = document.getElementById("subject").value;
                if (subject == "") {
                    document.getElementById('error').innerHTML = 'Please Enter Subject';
                    return false;
                }
                regx = /^[0-9]*$/;
                //validation of subject
                if (regx.test(subject)) {
                    document.getElementById('error').innerHTML = 'Please Enter valid Subject';
                    return false;
                }
            }
        </script>
    </head>
    <body align="center">
    <div class="container" style="padding:10px;" align="center">
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <div class="container" style="padding:25px;">
                    <div style="padding:2px 2px 2px 2px;border:1px solid #CCCCCC; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4;background-color:#F8F8F8 ;">
                        <form method="post">
                            <div class="row"
                                 style="color: #666;height:100px;font-family: 'Open Sans',sans-serif;font-size: 12px;">
                                <h2>Edit <?php echo $dynamic_subject; ?></h2>
                            </div>
                            <div class="row ">

                                <div class="col-md-3 col-md-offset-2" align="left" style="color:#003399;font-size:16px">
                                    <b> Introduce YearID</b>
                                </div>
                                <div class="col-md-5 form-group">
                                    <input type="text" name="Introduce_YearID" id="Introduce_YearID" class="form-control" style="width:100%; padding:5px;" placeholder="Introduce YearID" value="<?php echo $Introduce_YearID; ?>"/>
                                </div>

                                <div class="col-md-3 col-md-offset-2" align="left" style="color:#003399;font-size:16px">
                                    <b> <?php echo $dynamic_subject; ?> code</b>
                                </div>
                                <div class="col-md-5 form-group">
                                    <input type="text" name="Subject_Code" id="Subject_Code" class="form-control" style="width:100%; padding:5px;" placeholder="Enter <?php echo $dynamic_subject; ?>" value="<?php echo $Subject_Code; ?>"/>
                                </div>

                                <div class="col-md-3 col-md-offset-2" align="left" style="color:#003399;font-size:16px">
                                    <b> <?php echo $dynamic_subject; ?></b>
                                </div>
                                <div class="col-md-5 form-group">
                                    <input type="text" name="subject" id="subject" class="form-control" style="width:100%; padding:5px;" placeholder="Enter <?php echo $dynamic_subject; ?>" value="<?php echo $subject; ?>"/>
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-md-3 col-md-offset-2" align="left" style="color:#003399;font-size:16px">
                                    <b>Branch Name</b>
                                </div>
                                <div class="col-md-5 form-group">
                                    <input type="text" name="Branch" id="Branch" class="form-control" style="width:100%; padding:5px;" placeholder="Enter Branch" value="<?php echo $branchName; ?>"/>
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-md-3 col-md-offset-2" align="left" style="color:#003399;font-size:16px">
                                    <b>course level</b>
                                </div>
                                <div class="col-md-5 form-group">
                                    <input type="text" name="course_level" id="course_level" class="form-control" style="width:100%; padding:5px;" placeholder="course_level" value="<?php echo $course_level; ?>"/>
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-md-3 col-md-offset-2" align="left" style="color:#003399;font-size:16px">
                                    <b>Year</b>
                                </div>
                                <div class="col-md-5 form-group">
                                    <select class="form-control" name='Year'>
                                        <?php
                                        $list = mysql_query("select DISTINCT  Year from tbl_academic_Year WHERE school_id='$sc_id' order by Year asc");
                                        while ($row_list = mysql_fetch_assoc($list)) {
                                            ?>
                                            <option value="<?php echo $row_list['Year']; ?>" <?php if ($row_list['c_id'] == $select) {
                                                echo "selected";
                                            } ?>>
                                                <?php echo $row_list['Year']; ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-md-8 form-group col-md-offset-3" id="error" style="color:red;"><?php echo $report; ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-md-offset-2" style="padding:10px;">
                                    <input type="submit" name="submit" class='btn-lg btn-primary' style="width:100%;background-color:#0080C0; color:#FFFFFF;" value="submit" onClick="return valid()"/>
                                </div>
                                <div class="col-md-3 col-md-offset-1" style="padding:10px;">
                                    <a href="list_school_subject.php"><input type="button" class='btn-lg btn-danger' name="Back" value="Back" style="width:100%;background-color:#0080C0; color:#FFFFFF;"/></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>
<?php } ?>