<?php

include("scadmin_header.php");

if (isset($_GET["deleteCourseLevelId"])) {
    $deleteCourseLevelId=$_GET['deleteCourseLevelId'];
    $id = $_SESSION['id'];
    $fields = array("id" => $id);
    $table = "tbl_school_admin";
    $smartcookie = new smartcookie();
    $results = $smartcookie->retrive_individual($table, $fields);
    $result = mysql_fetch_array($results);
    $sc_id = $result['school_id'];
    $sql1 = "delete from tbl_CourseLevel where id='$deleteCourseLevelId' and school_id='$sc_id' ";
    $row = mysql_query($sql1);
    header('Location: ' ."/core/list_school_course_level.php" );
}
if (isset($_GET["CourseLevelId"])) {
    $id = $_SESSION['id'];
    $fields = array("id" => $id);
    $table = "tbl_school_admin";
    $smartcookie = new smartcookie();
    $results = $smartcookie->retrive_individual($table, $fields);
    $result = mysql_fetch_array($results);
    $sc_id = $result['school_id'];
    //fetch courseLevel data from database
    $CourseLevelId = $_GET["CourseLevelId"];
    $sql1 = "select * from tbl_CourseLevel where id='$CourseLevelId' and school_id='$sc_id' ";
    $row = mysql_query($sql1);
    $arr = mysql_fetch_array($row);
    $CourseLevel = $arr['CourseLevel'];
    $ExtCourseLevelID = $arr['ExtCourseLevelID'];

    // GET FORM DATA
    if (isset($_POST['submit'])) {

        if (empty($_POST["CourseLevel"])) {
            $ErrCourseLevel = "CourseLevel is required";
        } else {
            $CourseLevel = $_POST['CourseLevel'];
        }

        if (empty($_POST["ExtCourseLevelID"])) {
            $ErrCourseLevel = "ExtCourseLevelID is required";
        } else {
            $ExtCourseLevelID = $_POST['ExtCourseLevelID'];
        }

        if ($CourseLevel != '' && $ExtCourseLevelID != '' && $CourseLevelId != '') {
            $sql = mysql_query("SELECT school_id,CourseLevel FROM `tbl_CourseLevel` WHERE `school_id`='$sc_id' and `CourseLevel`='$CourseLevel' ");
            $row = mysql_fetch_row($sql);
            if ($row != '') {
                $errorreport = "This CourseLevel is already present ";
            } else {
                if(mysql_query("update tbl_CourseLevel set CourseLevel='$CourseLevel', ExtCourseLevelID = '$ExtCourseLevelID' where id=$CourseLevelId")){
                    $report="Updeted Course Level successfully";
                }else{
                    $errorreport="Please Try Again";
                }
            }
        } else {
            $errorreport = "All fields are requird";
        }
    }
    ?>

    <html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
    </head>
    <body align="center">
    <div class="container" style="padding:10px;" align="center">
        <div class="row">
            <div class="col-md-3">
            </div>
            <div style="padding:2px -20px 122px -42px;border:0px solid #CCCCCC; border:0px solid #CCCCCC;box-shadow: 0px 1px 1px 1px #C3C3C4;">
                <div class="container">
                    <div style="padding:2px 2px 2px 2px;border:1px solid #CCCCCC; border:0px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4;background-color:#F8F8F8 ;">
                        <form method="post">
                            <div style="background-color:#F8F8F8 ;">
                                <div class="row">
                                    <div class="col-md-12 " align="center" style="color:#663399;">
                                        <h2>Update Course Level</h2>
                                    </div>
                                </div>

                                <div class="row" style="padding-top:30px;">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-2" style="color:#808080; font-size:18px;"> Course Level<span style="color:red;font-size: 25px;">*</span></div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="CourseLevel" id="CourseLevel" value="<?php echo $CourseLevel;?>">
                                    </div>
                                </div>

                                <div class="col-md-4 col-md-offset-5"  style="color:#F00; text-align: center;">
                                    <span class="error"><?php echo $ErrorCourseLevel; ?></span>
                                </div>

                                <div class="row" style="padding-top:30px;">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-2" style="color:#808080; font-size:18px;"> ExtcourseLevelID<span
                                            style="color:red;font-size: 25px;">*</span></div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="ExtCourseLevelID" id="ExtCourseLevelID" value="<?php echo $ExtCourseLevelID; ?>">
                                    </div>
                                </div>

                                <div class="col-md-4 col-md-offset-5"  style="color:#F00; text-align: center;">
                                    <span class="error"><?php echo $ErrExtcourseLevelID; ?></span>
                                </div>

                                <div class="row" style="padding-top:60px;">
                                    <div class="col-md-5"></div>
                                    <div class="col-md-1"><input type="submit" name="submit" value="Update" class="btn btn-success"></div>
                                    <div class="col-md-1"><a href="list_school_course_level.php"><input type="button" value="Back" class="btn btn-danger"></a></div>
                                </div>

                                <div class="row" style="padding:30px;padding-left:450px;">
                                    <div class="col-md-4" style="color:#F00;" align="center" id="error">
                                        <b><?php echo $errorreport; ?></b>
                                    </div>
                                </div>

                                <div class="row" style="padding:30px;padding-left:450px;">
                                    <div class="col-md-4" style="color:#008000;" align="center" id="error">
                                        <b><?php echo $report; ?></b>
                                    </div>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </body>
    </html>
<?php }

?>

