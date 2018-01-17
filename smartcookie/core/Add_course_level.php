<?php
include('scadmin_header.php');
$report = "";
$smartcookie = new smartcookie();
$results = $smartcookie->retrive_individual($table, $fields);
$result = mysql_fetch_array($results);
$sc_id = $result['school_id'];
if (isset($_POST['submit'])) {
    $course = $_POST['course'];
    $ExtCourseLevelID = $_POST['ExtCourseLevelID'];
    $results = mysql_query("SELECT * FROM `tbl_CourseLevel` WHERE `school_id`='$sc_id' and CourseLevel='$course' ");
    if (mysql_num_rows($results) == 0) {
        $query = "insert into `tbl_CourseLevel` (CourseLevel,school_id,ExtCourseLevelID) values('$course','$sc_id','$ExtCourseLevelID') ";
        $rs = mysql_query($query);
        $successreport = "Record inserted Successfully";
    } else {
        $errorreport = 'Error while inserting Record';
    }
}
?>

<html>
<head>

</head>
<body>
<div class="container" style="padding:25px;"
" >

<div style="padding:2px 2px 2px 2px;border:1px solid #CCCCCC; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4;background-color:#F8F8F8;">

    <form method="post">

        <div class="row">

            <div class="col-md-3 col-md-offset-1" style="color:#700000 ;padding:5px;"></div>

            <div class="col-md-3 " align="center" style="color:#663399;">

                <h2>Add Course Level</h2>
                <!-- <h5 align="center"><a href="Add_SubjectSheet_updated_20160109PT.php" >Add Excel Sheet</a></h5>  -->
                <br><br>
            </div>


        </div>

        <div class="row formgroup" style="padding:5px;">

            <div class="col-md-3 col-md-offset-4">

                <input type="text" name="course" class="form-control " id="0" placeholder="Course Level" required>

            </div>

            <br/><br/>


            <div class="col-md-3 col-md-offset-4">

                <input type="text" name="ExtCourseLevelID" class="form-control " id="0" placeholder="ExtCourseLevelID">

            </div>

            <br/><br/>

            <!--<div class="col-md-3 col-md-offset-4">

                <input type="text" name="Batch ID" class="form-control " id="0" placeholder="Batch ID">

            </div>-->

        </div>


        <div id="error" style="color:#F00;text-align: center;" align="center"></div>


        <div class="row" style="padding-top:15px;">


            <div class="col-md-2 col-md-offset-4 ">

                <input type="submit" class="btn btn-primary" name="submit" value="Add "
                       style="width:80px;font-weight:bold;font-size:14px;" onClick="return valid()"/>

            </div>


            <div class="col-md-3 " align="left">

                <a href="list_school_course_level.php" style="text-decoration:none;"> <input type="button"
                                                                                             class="btn btn-primary"
                                                                                             name="Back" value="Back"
                                                                                             style="width:80px;font-weight:bold;font-size:14px;"/></a>

            </div>


        </div>


        <div class="row" style="padding-top:15px;">

            <div class="col-md-4">

                <input type="hidden" name="count" id="count" value="1">

            </div>

            <div class="col-md-11" style="color:#FF0000;" align="center" id="error">


                <?php echo $errorreport; ?>
            </div>

            <div class="col-md-11" style="color:#063;" align="center" id="error">

                <?php echo $successreport; ?>

            </div>

        </div>

    </form>

</div>


</body>
</html>