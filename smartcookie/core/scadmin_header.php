<?php
error_reporting(0);
session_start();
$school_type = $_SESSION['school_type'];
// master page
$dynamic_teacher = $school_type == "school" ? "Teachers" : ( $school_type == "organization" ?  "Manager" : ( $school_type == "NYKS" ?  "Volunteer" :  ""));
$dynamic_school_admin = $school_type == "school" ? "School Admin" : ( $school_type == "organization" ?  "Organization Admin" : ( $school_type == "NYKS" ?  "Club Admin" :  "") );
$dynamic_school = $school_type == "school" ? "School" : ( $school_type == "organization" ?  "Organization" : ( $school_type == "NYKS" ?  "Club" :  ""));
$dynamic_student = $school_type == "school" ? "Students" : ( $school_type == "organization" ?  "Employee" : ( $school_type == "NYKS" ?  "Beneficiary" :  ""));
$dynamic_student_prn = $school_type == "school" ? "Std_PRN" : ( $school_type == "organization" ?  "Emp_ID" : ( $school_type == "NYKS" ?  "Benef_ID" :  ""));
$dynamic_subject = $school_type == "school" ? "Subjects" : ( $school_type == "organization" ?  "Project" : ( $school_type == "NYKS" ?  "Project" :  ""));
$dynamic_teacher_Subject= $school_type == "school" ? "Teacher Subjects" : ( $school_type == "organization" ?  "Manager Project" : ( $school_type == "NYKS" ?  "Volunteer Project" :  ""));
$dynamic_student_Subject= $school_type == "school" ? "Student Subjects  " : ( $school_type == "organization" ?  "employee Project" : ( $school_type == "NYKS" ?  "Beneficiary Project" :  ""));
$dynamic_student_reason= $school_type == "school" ? "Student reason" : ( $school_type == "organization" ?  "employee Reason" : ( $school_type == "NYKS" ?  "Beneficiary Reason" :  ""));
$dynamic_school_admin_staff= $school_type == "school" ? "School Admin Staff" : ( $school_type == "organization" ?  "organization Admin staff" : ( $school_type == "NYKS" ?  "Club Admin Staff" :  ""));
$dynamic_school_admin_staff_access= $school_type == "school" ? "School Admin Staff Access" : ( $school_type == "organization" ?  "organization Admin staff access" : ( $school_type == "NYKS" ?  "Club Admin Staff Access" :  ""));
$dynamic_Generate_Student_Subject_Master= $school_type == "school" ? "Generate Student Subject Master" : ( $school_type == "organization" ?  "Generate Employee Project master" : ( $school_type == "NYKS" ?  "Generate Beneficiary Project Master" :  ""));

// master for Points

$dynamic_green_points_to_students= $school_type == "school" ? "Green Points to students" : ( $school_type == "organization" ?  "Green Points to Employees" : ( $school_type == "NYKS" ?  "Green Points to Beneficiaries" :  ""));
$dynamic_blue_points_to_student= $school_type == "school" ? "Blue Points to Student" : ( $school_type == "organization" ?  "Blue Points to Employees" : ( $school_type == "NYKS" ?  "Bue Points to Beneficiaries" :  ""));
$dynamic_green_points_to_teacher= $school_type == "school" ? "Green Points to Teacher" : ( $school_type == "organization" ?  "Green Points to Manager" : ( $school_type == "NYKS" ?  "Green Points to Volunteer" :  ""));
$dynamic_blue_points_to_teacher= $school_type == "school" ? "Blue Points to Teacher" : ( $school_type == "organization" ?  "Blue Points to Manager" : ( $school_type == "NYKS" ?  "Blue Points to Volunteer" :  ""));

// point status
$dynamic_green_points_given_to_teacher_for_distribution  = $school_type == "school" ? "Green Points Given to Teacher for Distribution" : ( $school_type == "organization" ?  "Green Points Given to Manager for Distribution" : ( $school_type == "NYKS" ?  "Green Points Given to Volunteer for Distribution" :  ""));
$dynamic_blue_points_given_to_student_for_distribution  = $school_type == "school" ? "Blue Points Given to Student for Distribution" : ( $school_type == "organization" ?  "Blue Points Given to Employee for Distribution" : ( $school_type == "NYKS" ?  "Blue Points Given to Beneficiary for Distribution" :  ""));

// logs
$dynamic_Green_Points_given_to_Teachers_for_Distribution  = $school_type == "school" ? "Green Points Given to Teachers for Distribution" : ( $school_type == "organization" ?  "Green Points Given to Manager for Distribution" : ( $school_type == "NYKS" ?  "Green Points Given to volunteers for Distribution" :  ""));
$dynamic_Green_Points_given_to_Students_as_rewards  = $school_type == "school" ? "Green Points Given to Students as Rewards" : ( $school_type == "organization" ?  "Green Points Given to Employee as Rewards" : ( $school_type == "NYKS" ?  "Green Points Given to   Beneficiary as Rewards" :  ""));
$dynamic_Blue_Points_given_to_Teachers_as_Rewards  = $school_type == "school" ? "Blue Points Given to Teachers as Rewards" : ( $school_type == "organization" ?  "Blue Points Given to Manager as Rewards" : ( $school_type == "NYKS" ?  "Blue Points Given to volunteers as Rewards" :  ""));
$dynamic_Blue_Points_Given_to_Students_for_Distribution  = $school_type == "school" ? "Blue Points Given to Students for Distribution" : ( $school_type == "organization" ?  "Blue Points Given to Employee for Distribution" : ( $school_type == "NYKS" ?  "Blue Points Given to Beneficiary for Distribution" :  ""));

$server_name = $_SERVER['SERVER_NAME'];

include_once('function.php');

include_once('school_function.php');

//
$smartcookie = new smartcookie();

/*if(!isset($_SESSION['id']))

{

    header('location:login.php');

}*/

if (isset($_SESSION['entity'])) {
    $entity = $_SESSION['entity'];
    /*echo "ent".$entity; */
    if ($entity == 1) {
        if (!isset($_SESSION['school_admin_id'])) {
            header('location:login.php');
        }

        $id = $_SESSION['id'];
        $fields = array("id" => $id);
        $table = "tbl_school_admin";
        $results = $smartcookie->retrive_individual($table, $fields);
        $scadmin = mysql_fetch_array($results);
        $scadmin_name = $scadmin['name'];
        $school_name = $scadmin['school_name'];
        $address = $scadmin['address'];
        $staff_name = "School Admin";
        $name = "Cookie Admin";
        $flag = true;
    }
    if ($entity == 7) {
        if (!isset($_SESSION['staff_id'])) {
            header('location:login.php');
        }

        $id = $_SESSION['staff_id'];
        /* echo $id;*/
        $table = "tbl_school_adminstaff";
        $fields = array("id" => $id);
        $results = $smartcookie->retrive_individual($table, $fields);

        $scadmin = mysql_fetch_array($results);

        $scadmin_name = $scadmin['stf_name'];

        $school_name = "";

        $address = "";
        $name = "Admin Staff";
        $flag = false;
    }
}
if ($scadmin_name == "") {
    header('location:login.php');
}


//print_r(phpinfo());


/*
 $id=$_SESSION['id'];
*/


/*$table="tbl_school_admin"; */


?>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Smart Cookies:School Admin</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

    <script src='js/bootstrap.min.js' type='text/javascript'></script>

    <script>

        (function ($) {
            $(document).ready(function () {
                $('ul.dropdown-menu [data-toggle=dropdown]').on('mouseover', function (event) {
                    $(this).parent().siblings().removeClass('open');
                    $(this).parent().toggleClass('open');
                });
            });
        })(jQuery);

    </script>


    <style>

        a {
            cursor: pointer;

        }

        .carousel {

            height: 300px;

            margin-bottom: 50px;

        }

        .carousel-caption {

            z-index: 10;

        }

        .carousel .item {

            background-color: rgba(0, 0, 0, 0.8);

            height: 300px;

        }

        .navbar-inverse .navbar-nav > li > a {

            color: #FFFFFF;

            font-weight: bold;

        }

        .navbar-inverse {

            border-color: #FFFFFF;

        }

        .preview {

            border-radius: 50% 50% 50% 50%;

            height: 100px;

            box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);

            -webkit-border-radius: 99em;

            -moz-border-radius: 99em;

            border-radius: 99em;

            border: 5px solid #eee;

            width: 100px;

        }

        .width-menu {
            min-width: 184px !important;
        }

        .left-drop {
            left: 140px !important;
            top: -0px !important;
            width: 230px;
        }

        .nav-li-a {

            padding: 38px 17px;

        }

    </style>


</head>


<body>


<!-- header-->

<div class="container" align="center">

    <div class="row">
            <div class="col-md-2" style="float:left; padding:10px; font-size:21px; font-weight:bold;"><img src="/image/Smart_Cookies_Logo001.jpg" width="100%" height="70" class="img-responsive" alt="Responsive image"/>
        </div>

        <div class="col-md-5" align="left">

            <h1 style="color:#666666;font-weight:bold;font-family:" Times New Roman", Times, serif;">

            <?php echo $school_name; ?></h1>

            <h4><?php echo $address; ?><h4>


        </div>

        <div class="col-md-2" style="padding-right:10px;">

            <div style="padding:5px; width:100%;" align="center">


                <?php if ($scadmin['img_path'] != "") { ?>

                    <img src='<?php echo $scadmin['img_path'] ?>' height="70" ; width="70" class="preview"/>

                <?php } else { ?>

                    <img src="image/avatar_2x.png" width="70" height="70" class="preview"/>

                <?php } ?>

            </div>

        </div>

        <div class="col-md-3">

            <div class="row" style="background-color:#428BCA; padding-top:5px; background-color:; border-radius: 3px 3px 5px 5px; margin-bottom:10px; margin-top:-2px; color:#FFFFFF; font-size:12px;">

                Welcome
                <?php echo $scadmin_name; ?> | <a href="logout.php" style="text-decoration:none; color:#FFFFFF;">Sign Out</a>&nbsp;


            </div>

            <div class="row" style="font-size:12px;height:30px;">

                Member ID :<?php

                echo "SA" . str_pad($id, 11, "0", STR_PAD_LEFT);

                ?>

            </div>

            <div class="row" style="padding-right:10px;  font-weight:bold;font-size:12px;">

                <?php echo $dynamic_school;?> Admin

            </div>

        </div>


    </div>

</div>
<?php $url = $_SERVER['REQUEST_URI'];
/*echo $url; */
$arr = explode('/', $url);
$pagename = $arr[count($arr) - 1];
?>


<div class=" navbar-inverse" role="navigation" style="background-color:#428BCA;width:100%;">

    <div class="container">

        <div class="navbar-header">

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#b-menu-1">

                <span class="sr-only">Toggle navigation</span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

            </button>

        </div>

        <?php
        $getpermision = mysql_query("select * from tbl_permission where s_a_st_id=" . $id . "");
        $fetchpermision = mysql_fetch_array($getpermision);
        $perm = $fetchpermision['permission'];

        ?>

        <div class="collapse navbar-collapse" id="b-menu-1" style="border-color:#428BCA;">

            <ul class="nav navbar-nav ">
                <?php $Lb = "LDBRD";
                $Mst = strpos($perm, $Lb);

                if ($Mst !== false || $flag) { ?>
                    <li color:#FFFFF <?php if ($pagename == 'top10_stud_scadmin.php') { ?> style=";"<?php } ?>>
                        <a href="top10_stud_scadmin.php">Leaderboard</a></li>

                <?php } ?>

                <?php if ($entity == 1) { ?>
                    <li color:#FFFFF id="dashboard" <?php if ($pagename == 'scadmin_dashboard.php') { ?> style=""<?php } ?> ><a
                                href="scadmin_dashboard.php">Dashboard</a></li>
                <?php } else { ?>
                    <li color:#FFFFF
                        id="dashboard1" <?php if ($pagename == 'scadmin_dashboard.php') { ?> style="background-color: #080808;"<?php } ?> >
                        <a href="school_staff_dashboard.php">Dashboard</a></li>
                <?php } ?>

                <?php $Masters = "Master";
                $Mstr = strpos($perm, $Masters);
                if ($Mstr !== false || $flag)
                {
                ?>
                <li <?php if ($pagename == 'teacherlist.php' || $pagename == 'studentlist.php' || $pagename == 'parents_list.php' || $pagename == 'list_semester.php' || $pagename == 'student_semester_record.php' || $pagename == 'list_student_subject.php' || $pagename == 'list_teacher_subject.php' || $pagename == 'school_master_table.php' || $pagename == 'activitylist.php' || $pagename == 'list_school_subject.php' || $pagename == 'list_school_branch.php' || $pagename == 'list_school_department.php' || $pagename == 'student_semester_record.php') { ?> style="background-color: #080808;"<?php } ?>>
                    <a id="master" class="dropdown-toggle" data-toggle="dropdown" href="#">Masters</a>
                    <ul class="dropdown-menu">
<?php if ($school_type == 'school'){?>

						 <?php $Division = "year";
                        $Div = strpos($perm, $Division);
                        if ($Div !== false || $flag) {
                            ?>
                            <li><a href="list_school_academic_year.php">Academic Year</a></li>
                        <?php } ?>
                         
                        <?php } ?>
						
						<?php $Activity = "Activity";
                        $Activi = strpos($perm, $Activity);
                        if ($Activi !== false || $flag) {
                            ?>
                            <li><a href="activitylist.php">Activity</a></li>

                        <?php } ?>
						
						 <?php $Branch = "Branch";
                        $Degs = strpos($perm, $Branch);
                        if ($Degs !== false || $flag) {
                            ?>
                            <li><a href="list_school_branch.php">Branch</a></li>
                        <?php } ?>
						
						<?php $BrSubjects = "BrSubjects";
                        $Dep = strpos($perm, $BrSubjects);
                        if ($Dep !== false || $flag) {
                            ?>
                            <li><a href="branch_subject_master.php">Branch Subject</a></li>
                        <?php } ?>
						
						<?php $Class = "Class";
                        $Cla = strpos($perm, $Class);
                        if ($Cla !== false || $flag) {
                            ?>
                            <li><a href="list_school_class.php">Class</a></li>
                        <?php } ?>
						
						<?php $CSub = "CSub";
                        $St = strpos($perm, $CSub);
                        if ($St !== false || $flag) {
                            ?>
                            <li><a href="list_class_subject.php">Class Subject</a></li>
                        <?php } ?>
						
						<?php $BrSubjects = "Course";
                        $Dep = strpos($perm, $BrSubjects);
                        if ($Dep !== false || $flag) {
                            ?>

                            <li><a href="list_school_course_level.php">Course Level</a></li>

                        <?php } ?>
						
						<?php } ?>
                        <?php $cre = "create";
                        $Than = strpos($perm, $cre);
                        if ($Than !== false || $flag) {
                            ?>
                            <li><a href="extract_data.php">Create Excel Files</a></li>
                        <?php } ?>
                       
						
						
						<?php $BrSubjects = "Degree";
                        $Dep = strpos($perm, $BrSubjects);
                        if ($Dep !== false || $flag) {
                            ?>

                            <li><a href="list_school_degree.php">Degree</a></li>

                        <?php } ?>
						
						<?php $Departments = "Departments";
                        $Dep = strpos($perm, $Departments);
                        if ($Dep !== false || $flag) {
                            ?>
                            <li><a href="list_school_department.php">Department</a></li>

                        <?php } ?>
						
						<?php $Division = "Division";
                        $Div = strpos($perm, $Division);
                        if ($Div !== false || $flag) {
                            ?>
                            <li><a href="list_school_division.php">Division</a></li>
                        <?php } ?>
						 <li><a href="merge_student_subject.php"><?php echo $dynamic_Generate_Student_Subject_Master;?></a></li>
						<?php $Parents = "Parents";
                        $St = strpos($perm, $Parents);
                        if ($St !== false || $flag) {
                            ?>
                            <li><a href="parents_list.php">Parents</a></li>
                        <?php } ?>
						
						<?php $ScholM = "School Master";
                        $SM = strpos($perm, $ScholM);
                        if ($SM !== false || $flag) {
                            ?>

                            <li><a href="school_master_table.php">Rule Engine</a></li>
                        <?php } ?>
						
						<?php $Division = "access";
                        $Div = strpos($perm, $Division);
                        if ($Div !== false || $flag) {
                            ?>
                            <li><a href="schoolAdminStaff_list.php"><?php echo $dynamic_school_admin_staff;?></a></li>
                        <?php } ?>
                        <li><a href="access.php"><?php echo $dynamic_school_admin_staff_access;?></a></li>
                        
						<li><a href="admin_rule_engine.php">School Rule Engine</a></li>
                        
                        <?php $Semester = "Semester";
                        $St = strpos($perm, $Semester);
                        if ($St !== false || $flag) {
                            ?>
                            <li><a href="list_semester.php">Semester</a></li>
                        <?php } ?>

                         <?php $ThanQ = "sms";
                        $Than = strpos($perm, $ThanQ);
                        if ($Than !== false || $flag) {
                            ?>
                            <li><a href="Send_Msg_Teacher.php">Send SMS/Email</a></li>
                        <?php } ?>
						
						<?php $Student = "Student1";
                        $St = strpos($perm, $Student);
                        if ($St !== false || $flag) {
                            ?>
                            <li><a href="studentlist.php"><?php echo $dynamic_student;?></a></li>
                        <?php } ?>
						
						<?php $Recognition = "Student Recognition";
                        $Recgn = strpos($perm, $Recognition);
                        if ($Recgn !== false || $flag) {
                            ?>
                            <li><a href="sc_stud_activity.php"><?php echo $dynamic_student_reason;?></a></li>
                        <?php } ?>
						
						
                        <?php $StuSem = "StuSem";
                        $St = strpos($perm, $StuSem);
                        if ($St !== false || $flag) {
                            ?>
                            <li><a href="student_semester_record.php">Student Semester</a></li>
                        <?php } ?>

						<?php $SSub = "SSub";
                        $St = strpos($perm, $SSub);
                        if ($St !== false || $flag) {
                            ?>
                            <li><a href="list_student_subject.php"><?php echo $dynamic_student_Subject;?></a></li>
                        <?php } ?>
						
						<?php $Subject = "Subject1";
                        $Sub = strpos($perm, $Subject);
                        if ($Sub !== false || $flag)
                        {
                        ?>

                        <li><a href="list_school_subject.php"><?php echo $dynamic_subject;?></a></li>
                        <?php } ?>
						
						<?php $Teacher = "Teacher1";
                        $Tch = strpos($perm, $Teacher);
                        if ($Tch !== false || $flag) {
                            ?>
                            <li><a href="teacherlist.php"><?php echo $dynamic_teacher;?></a></li>
                        <?php } ?>
						
						<?php $TSub = "TSub";
                        $St = strpos($perm, $TSub);
                        if ($St !== false || $flag) {
                            ?>

                            <li><a href="list_teacher_subject.php"> <?php echo $dynamic_teacher_Subject;?></a></li>

                        <?php } ?>
						
						<?php $ThanQ = "ThanQ";
                        $Than = strpos($perm, $ThanQ);
                        if ($Than !== false || $flag) {
                            ?>

                            <li><a href="thanqyoulist.php">ThanQ Reason List </a></li>
                        <?php } ?>
						
						<?php $up = "Upload Panel";
                        $W = strpos($perm, $up);
                        if ($W !== false || $flag) {
                            ?>
                            <li><a href="sd_upload_panel.php">Upload Panel</a></li>


                        <!-- <li><a href="Menu_list.php">Add Menu</a></li>-->

                        <!--  <li><a href="Sub_menu_list.php">Add Sub Menu</a></li>-->

                        
                        <!-- <li><a href="school_settings.php">Who Assign Blue Points?</a></li>
                         <li><a href="get_list_teacher_error_file.php">Get Teacher Error file</a></li>-->
 
                    </ul>
                </li>
<?php } ?>
            
                <?php $Points = "Points";
                $P = strpos($perm, $Points);
                if ($P !== false || $flag) {
                    ?>
                    <li <?php if ($pagename == 'teacherassign.php' || $pagename == 'assignbluepointsstud.php' || $pagename == 'teacher_thanQ_points.php' || $pagename == 'assigngreenpoint.php') { ?> style="background-color: #080808;"<?php } ?>>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Points</a>

                        <ul class="dropdown-menu width-menu">
                            <?php $BPTs = "Distribution";
                            $BP = strpos($perm, $BPTs);
                            if ($BP !== false || $flag) {
                                ?>
                                <li class="dropdown dropdown-submenu" style="margin-left:0px;"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Distribution Points</a>

                                    <ul class="dropdown-menu left-drop" style="left:0px;">

                                        <li class="dropdown dropdown-submenu" style="margin-left:0px;"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $dynamic_green_points_to_teacher;?></a>
                                            <ul class="dropdown-menu left-drop" style="left:0px;">
                                                <li class="kopie"><a href="teacherassign.php">List</a></li>
                                                <li class="kopie"><a href="search_teacher_points.php">Search</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown dropdown-submenu" style="margin-left:0px;"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $dynamic_blue_points_to_student;?></a>
                                            <ul class="dropdown-menu left-drop" style="left:0px;">
                                                <li class="kopie"><a href="assignbluepointsstud.php">List</a></li>
                                                <li class="kopie"><a href="search_student_points.php">Search</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            <?php } ?>

                            <?php $BPTs = "Reward";
                            $BP = strpos($perm, $BPTs);
                            if ($BP !== false || $flag) {
                                ?>
                                <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">As Rewards</a>
                                    <ul class="dropdown-menu left-drop" style="left:0px;">
                                        <li class="dropdown dropdown-submenu" style="margin-left:0px;"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $dynamic_blue_points_to_teacher;?></a>
                                            <ul class="dropdown-menu left-drop" style="left:0px;">
                                                <li class="kopie"><a href="teacher_thanQ_points.php">List</a></li>
                                                <li class="kopie"><a href="search_teacher_reward_points.php">Search</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown dropdown-submenu" style="margin-left:0px;"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $dynamic_green_points_to_students;?> </a>
                                            <ul class="dropdown-menu left-drop" style="left:0px;">
                                                <li class="kopie"><a href="assigngreenpointsstud.php">List</a></li>
                                                <li class="kopie"><a href="search_student_reward_points.php">Search</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>     <?php } ?>

                <?php $Points_Status = "Points Status";
                $L = strpos($perm, $Points_Status);
                if ($L !== false || $flag) {
                    ?>
                    <li <?php if ($pagename == 'log_distribution.php' || $pagename == 'student_log.php' || $pagename == 'sponsorer_log.php' || $pagename == 'bluepoints_teacher_log.php') { ?> style="background-color: #080808;"<?php } ?>>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Points Status</a>
                        <ul class="dropdown-menu">
                            <?php $TGP = "TGP1";
                            $BGP = strpos($perm, $TGP);
                            if ($BGP !== false || $flag) {
                                ?>
                                <li><a href="log_distribution.php"><?php echo $dynamic_green_points_given_to_teacher_for_distribution;?></a>
                                </li>
                            <?php } ?>
                            <?php $TeacherBluePoint = "Teacher Green Point";
                            $TeacherBPoint = strpos($perm, $TeacherBluePoint);
                            if ($TeacherBPoint !== false || $flag) {
                                ?>
                                <li><a href="blue_point_student_distribution.php"><?php echo $dynamic_blue_points_given_to_student_for_distribution;?></a></li>
                            <?php } ?>

                        </ul>
                    </li>
                <?php } ?>

                <?php $Sponsor = "Sponsor Map";
                $s = strpos($perm, $Sponsor);
                if ($s !== false || $flag) {
                    ?>
                    <li <?php if ($pagename == 'school_sponsor_map.php') { ?> style="background-color: #080808;"<?php } ?>>
                        <a href="school_sponsor_map.php">Sponsor Map</a></li>
                <?php } ?>


                <!-- <li><a href="scadmin_purchase_point.php">Purchase Points</a></li>-->
                <?php $Purches = "purchesC";
                $Pches = strpos($perm, $Purches);
                if ($Pches !== false || $flag)
                {
                ?>
                <li <?php if ($pagename == 'scadmin_greenpoint_coupon.php' || $pagename == "scadmin_bluepoint_coupon.php") { ?> style="background-color: #080808;"<?php } ?>>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Purchase Points</a>
                    <?php } ?>
                    <ul class="dropdown-menu">

                        <?php $GeenPointscoupones = "Gpc1";
                        $GeenPscoupones = strpos($perm, $GeenPointscoupones);
                        if ($GeenPscoupones !== false || $flag) {
                            ?>

                            <li><a href="scadmin_greenpoint_coupon.php">Green Points</a></li>
                        <?php } ?>

                        <?php $BluePointscoupones = "Bpc2";
                        $Bluecoupones = strpos($perm, $BluePointscoupones);
                        if ($Bluecoupones !== false || $flag) {
                            ?>
                            <li><a href="scadmin_bluepoint_coupon.php">Blue Points </a></li>
                        <?php } ?>


                    </ul>
                </li>


                <li <?php if ($pagename == 'schooladminprofile.php') { ?> style="background-color: #080808;"<?php } ?> >
                    <a href="schooladminprofile.php">Profile</a></li>


                <?php $Logs = "Logs";
                $L = strpos($perm, $Logs);
                if ($L !== false || $flag) {
                    ?>
                    <li <?php if ($pagename == 'teacherlog.php' || $pagename == 'student_log.php' || $pagename == 'sponsorer_log.php' || $pagename == 'bluepoints_teacher_log.php') { ?> style="background-color: #080808;"<?php } ?>>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Log</a>


                        <ul class="dropdown-menu">
                            <?php $TGP = "TGP1";
                            $BGP = strpos($perm, $TGP);
                            if ($BGP !== false || $flag) {
                                ?>
                                <li><a href="teacherlog.php"><?php echo $dynamic_Green_Points_given_to_Teachers_for_Distribution;?></a></li>

                            <?php } ?>
                            <?php $SGP = "S2gp";
                            $SG1 = strpos($perm, $SGP);
                            if ($SG1 !== false || $flag) {
                                ?>
                                <li><a href="student_log.php"><?php echo $dynamic_Green_Points_given_to_Students_as_rewards;?></a></li>
                            <?php } ?>

                            <?php $Sponsor = "Sponsor1";
                            $Sponsor1 = strpos($perm, $Sponsor);
                            if ($Sponsor1 !== false || $flag) {
                                ?>
                                <li><a href="sponsorer_log.php">Sponsor</a></li>
                            <?php } ?>
                            <?php $TeacherBluePoint = "Teacher Blue Point";
                            $TeacherBPoint = strpos($perm, $TeacherBluePoint);
                            if ($TeacherBPoint !== false || $flag) {
                                ?>
                                <li><a href="bluepoints_teacher_log.php"><?php echo $dynamic_Blue_Points_given_to_Teachers_as_Rewards;?></a>
                                </li>
                            <?php } ?>

                            <?php $TeacherBluePoint = "Teacher Green Point";
                            $TeacherBPoint = strpos($perm, $TeacherBluePoint);
                            if ($TeacherBPoint !== false || $flag) {
                                ?>
                                <li><a href="blue_points_logstudent.php"><?php echo $dynamic_Blue_Points_Given_to_Students_for_Distribution;?></a></li>
                            <?php } ?>

                            <?php $BM = "status";
                            $T = strpos($perm, $BM);
                            if ($T !== false || $flag) {
                                ?>
                                <li><a href="loginStatus.php">Login Status Log</a></li>
                            <?php } ?>

                            <?php $BM = "actLog";
                            $T = strpos($perm, $BM);
                            if ($T !== false || $flag) {
                                ?>
                                <li><a href="ActivityLog.php">Activity Log</a></li>
                            <?php } ?>

                            <?php $BM = "Recalculate";
                            $T = strpos($perm, $BM);
                            if ($T !== false || $flag) {
                                ?>
                                <li><a href="recalculate.php">Recalculate</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
                <!-- </li> -->
                <?php $Purches = "Report";
                $Pches = strpos($perm, $Purches);
                if ($Pches !== false || $flag) {
                    ?>
                    <li <?php if ($pagename == 'Batch_Master_PT.php' || $pagename == "teachersubjectreport.php" || $pagename == "Studentsubjectreport.php" || $pagename == "teacher_report_PT.php" || $pagename == "student_report_PT.php") { ?> style="background-color: #080808;"<?php } ?>>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Report</a>

                        <ul class="dropdown-menu">
                            <?php $BM = "BM";
                            $T = strpos($perm, $BM);
                            if ($T !== false || $flag) {
                                ?>
                                <li><a href="Batch_Master_PT.php">Batch Master</a></li>
                            <?php } ?>

                            <?php $BM = "TSR";
                            $T = strpos($perm, $BM);
                            if ($T !== false || $flag) {
                                ?>

                                <li><a href="teachersubjectreport.php"><?php echo $dynamic_teacher_Subject;?></a></li>
                            <?php } ?>

                            <?php $BM = "SSR";
                            $T = strpos($perm, $BM);
                            if ($T !== false || $flag) {
                                ?>
                                <li><a href="Studentsubjectreport.php"><?php echo $dynamic_student_Subject;?></a></li>
                            <?php } ?>

                            <?php $BM = "TR1";
                            $T = strpos($perm, $BM);
                            if ($T !== false || $flag) {
                                ?>
                                <li><a href="teacher_report_PT.php"><?php echo $dynamic_teacher;?></a></li>
                            <?php } ?>

                            <?php $BM = "SR1";
                            $T = strpos($perm, $BM);
                            if ($T !== false || $flag) {
                                ?>
                                <li><a href="student_report_PT.php"><?php $dynamic_student;?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
                <li>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Search</a>
                    <ul class="dropdown-menu">
                        <li><a href="displaystudsubject.php"><?php echo $dynamic_student_Subject;?></a></li>
                        <li><a href="teacherdisplaysub.php"><?php echo $dynamic_teacher_Subject;?></a></li>
                        <li><a href="student_search_engine.php"><?php $dynamic_student;?></a></li>
                        <li><a href="teacher_search_engine.php"><?php echo $dynamic_teacher;?></a></li>
                        <li><a href="searching.php"><?php echo $dynamic_teacher."/".$dynamic_student;?></a></li>
                    </ul>
                </li>
				
				
				<?php if ($Mst !== false || $flag) { ?>
                    <li color:#FFFFF <?php if ($pagename == 'school_admin_analytics.php') { ?> style=";"<?php } ?>>
                        <a href="school_admin_analytics.php">School Analytics</a></li>

                <?php } ?>
				
            </ul>
        </div> <!-- /.nav-collapse -->
    </div> <!-- /.container -->
</div>
