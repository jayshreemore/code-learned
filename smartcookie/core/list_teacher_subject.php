<?php
include_once('scadmin_header.php');

$report = "";


/*$smartcookie=new smartcookie();

           $id=$_SESSION['id'];

           $fields=array("id"=>$id);

		   $table="tbl_school_admin";

		   $smartcookie=new smartcookie();*/


$results = $smartcookie->retrive_individual($table, $fields);

$result = mysql_fetch_array($results);

$school_id = $result['school_id']; ?>

<?php


if (isset($_POST['submit'])) {
    $info = $_POST['info'];
    if ($info == "1") {
        $arr = "SELECT DISTINCT st.teacher_id,tc.t_complete_name, st.Branches_id,st.`subjectName`,st.ExtSemesterId,st.subjcet_code,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st inner join tbl_academic_Year Y on st.AcademicYear=Y.Year join tbl_teacher tc on tc.t_id=st.teacher_id    WHERE  st.school_id='$school_id' and Y.Enable='1' and Y.school_id='$school_id'";

    } elseif ($info == "2") {

        $arr = "SELECT  DISTINCT st.teacher_id, tc.t_complete_name,st.Branches_id,st.`subjectName`,st.subjcet_code,st.ExtSemesterId,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st  join tbl_teacher tc on tc.t_id=st.teacher_id  WHERE  st.school_id='$school_id' ";

    } elseif ($info == "3") {
        /*echo "SELECT  st.Branches_id,st.`subjectName`,st.subjcet_code,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear  FROM `tbl_teacher_subject_master` st  inner join tbl_semester_master s  on st.Semester_id=s.Semester_Name   WHERE st.`teacher_id` ='$t_id' and st.school_id='$school_id' and s.school_id='$school_id' and s.Is_enable='1'";
        */
        /*
        echo "SELECT  st.Branches_id,st.`subjectName`,st.subjcet_code,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st inner join tbl_academic_Year Y on st.AcademicYear=Y.Year inner join tbl_semester_master s  on st.Semester_id=s.Semester_Name   WHERE st.`teacher_id` ='$t_id' and st.school_id='$school_id' and Y.Enable='1' and Y.school_id='$school_id' and s.Is_enable='1'";*/

        /*$arr="SELECT  st.Branches_id,st.`subjectName`,st.subjcet_code,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st inner join tbl_academic_Year Y inner join tbl_semester_master s  on st.AcademicYear=Y.Year  and  st.Semester_id=s.Semester_Name   WHERE st.`teacher_id` ='$t_id' and st.school_id='$school_id' and Y.Enable='1' and Y.school_id='$school_id' and s.Is_enable='1'";

            $arr="SELECT   DISTINCT st.Branches_id,st.`subjectName`,st.subjcet_code,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st
            inner join tbl_academic_Year Y on st.AcademicYear=Y.Year
            inner join tbl_semester_master s  on st.Semester_id=s.Semester_Name
            WHERE st.`teacher_id` ='$t_id'
            and st.school_id='$school_id'
            and Y.Enable='1'
            and Y.school_id='$school_id'
            and s.Is_enable='1'";
            //inner join  tbl_teacher_subject_master tsm on s.ExtSemesterId=tsm.ExtSemesterId/*/


        $arr = "SELECT   DISTINCT st.teacher_id,tc.t_complete_name,  st.Branches_id,st.`subjectName`,st.subjcet_code,st.ExtSemesterId,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st
		inner join tbl_academic_Year Y on st.AcademicYear=Y.Year
		inner join tbl_semester_master s on s.ExtSemesterId=st.ExtSemesterId 
		join tbl_teacher tc on tc.t_id=st.teacher_id 
		WHERE st.school_id='$school_id' 
		and Y.Enable='1'
		and Y.school_id='$school_id'
		and s.Is_enable='1'
		and s.ExtSemesterId <> 0";


        /*
        echo "SELECT  st.Branches_id,st.`subjectName`,st.subjcet_code,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st inner join tbl_semester_master s on st.Semester_id=s.Semester_Name   WHERE st.`teacher_id` ='$t_id' and st.school_id='$school_id' and s.Is_enable='1'";*/

        /*$arr1="SELECT  st.Branches_id,st.`subjectName`,st.subjcet_code,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st inner join tbl_semester_master s on st.Semester_id=s.Semester_Name   WHERE st.`teacher_id` ='$t_id' and st.school_id='$school_id' and s.Is_enable='1'";*/

        /*$arr="SELECT  st.Branches_id,st.`subjectName`,st.subjcet_code,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st   WHERE st.`teacher_id` ='$t_id' and st.school_id='$school_id'and st.AcademicYear='2015'";*/

    } elseif ($info == "4") {
        /*echo "SELECT  st.Branches_id,st.`subjectName`,st.subjcet_code,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st   WHERE st.`teacher_id` ='$t_id' and st.school_id='$school_id' and st.AcademicYear='2016'";*/


        $arr = "SELECT   DISTINCT st.teacher_id, tc.t_complete_name, st.Branches_id,st.`subjectName`,st.subjcet_code,st.ExtSemesterId,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st inner join tbl_academic_Year Y on st.AcademicYear=Y.Year inner join tbl_semester_master s  on st.Semester_id=s.Semester_Name join tbl_teacher tc on tc.t_id=st.teacher_id    WHERE  st.school_id='$school_id' and Y.Enable='1' and Y.school_id='$school_id'";
    }


} else {

    $arr = "SELECT  st.teacher_id, tc.t_complete_name,st.Branches_id,st.`subjectName`,st.subjcet_code,st.Division_id,st.ExtSemesterId,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st inner join tbl_academic_Year Y on st.AcademicYear=Y.Year  join tbl_teacher tc on tc.t_id=st.teacher_id   WHERE  st.school_id='$school_id' and Y.Enable='1' and Y.school_id='$school_id'";
    //$arr="SELECT std.std_PRN, std.std_name, std.std_Father_name, std.std_lastname, std.std_complete_name, semester.student_id, semester.SemesterName, semester.BranchName, semester.Specialization, semester.DeptName, semester.CourseLevel, semester.DivisionName, semester.AcdemicYear FROM StudentSemesterRecord AS semester JOIN tbl_student AS std ON std.std_PRN = semester.student_id JOIN tbl_academic_Year a ON semester.AcdemicYear=a.Year where semester.school_id='$sc_id' and semester.`IsCurrentSemester`='1' and a.Enable='1' and a.school_id='$sc_id' ORDER BY std.std_name,std.std_complete_name";

}
//$teacher_id=$arr1['teacher_id'];

//echo $arr;
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
    
    <title>Student Semester Records</title>
    <style>
        @media only screen and (max-width: 800px) {

            /* Force table to not be like tables anymore */
            #no-more-tables table,
            #no-more-tables thead,
            #no-more-tables tbody,
            #no-more-tables th,
            #no-more-tables td,
            #no-more-tables tr {
                display: block;
            }

            /* Hide table headers (but not display: none;, for accessibility) */
            #no-more-tables thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            #no-more-tables tr {
                border: 1px solid #ccc;
            }

            #no-more-tables td {
                /* Behave  like a "row" */
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
                white-space: normal;
                text-align: left;
                font: Arial, Helvetica, sans-serif;
            }

            #no-more-tables td:before {
                /* Now like a table header */
                position: absolute;
                /* Top/left values mimic padding */
                top: 6px;
                left: 6px;

                padding-right: 10px;
                white-space: nowrap;

            }

            /*
            Label the data
            */
            #no-more-tables td:before {
                content: attr(data-title);
            }
            div {
                overflow:auto;
            }
        }
    </style>
</head>
<script>
    $(document).ready(function () {
        $('#example').dataTable({
            "pagingType": "full_numbers"
        });
    });

</script>
<!--
<script>
function confirmation(xxx) {
    var answer = confirm("Are you sure you want to delete")
    if (answer){
        
        window.location = "delete_school_subject.php?id="+xxx;
    }
    else{
       
     }
}

</script>
-->
<body bgcolor="#CCCCCC">
<div style="bgcolor:#CCCCCC">
    <div>

    </div>
    <div class="container" style="padding:25px;">


        <div style="padding:2px 2px 2px 2px;border:1px solid #CCCCCC; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4;">


            <div style="background-color:#F8F8F8;overflow-y: scroll; "   >
                <div class="row">
                    <div class="col-md-22 " style="color:#700000 ;padding:5px;">&nbsp;&nbsp;&nbsp;&nbsp;
                        <!--      <a href="add_school_subject.php">   <input type="submit" class="btn btn-primary" name="submit" value="Add Subject" style="width:110px;font-weight:bold;font-size:14px;"/></a>-->
                    </div>
                    <div class="col-md-8 " align="center">
                        <div class="col-md-4 " style="color:#700000 ;padding:5px;">&nbsp;&nbsp;&nbsp;&nbsp;

<!--                            <a href="add_school_subject.php?id=--><?//= $staff_id; ?><!--"><input type="submit" class="btn btn-primary" name="submit" value="Add Subject" style="width:100px;font-weight:bold;font-size:14px;"/></a>-->
                            <a href="Add_teacher_subject.php"><input type="submit" class="btn btn-primary" name="submit" value="Add Teacher <?php echo $dynamic_subject;?>" style="width:170px;font-weight:bold;font-size:14px;"/></a>
                        </div>
                        <h2><?php echo $dynamic_teacher." ".$dynamic_subject;?> List</h2>
                    </div>

                </div>

                <div class="row" align="center" style="margin-top:3%;">
                    <form method="post">
                        <div class="col-md-3"></div>

                        <?php
                        echo ($_SESSION['usertype'] == 'Manager') ? '' : '<div class="col-md-2">Select Semester</div>';
                        ?>

                        <div class="col-md-3">
                            <select name="info" class="form-control">

                                <option value="1" <?php if (isset($_POST['info'])) {
                                    if ($_POST['info'] == "1") ?> selected <?php } ?>>Current Year
                                </option>
                                <option value="2" <?php if (isset($_POST['info'])) {
                                    if ($_POST['info'] == "2") ?> selected <?php } ?>>All Year
                                </option>

                                <option value="3" <?php if (isset($_POST['info'])) {
                                    if ($_POST['info'] == "3") ?> selected <?php } ?>>Current Semester
                                </option>
                                <option value="4" <?php if (isset($_POST['info'])) {
                                    if ($_POST['info'] == "4") ?> selected <?php } ?>> All Semester
                                </option>

                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="submit" name="submit" value="Submit" class="btn btn-success">
                        </div>


                    </form>
                </div>


                <div class="row" style="margin-top:3%;">

                    <div class="col-md-2">
                    </div>
                    <div class="col-md-12" id="no-more-tables" style="margin:2px" >
                        <?php $i = 0; ?>
                        <table class="table-bordered  table-condensed cf" id="example" width="100%;">
                            <thead>
                            <tr style="background-color:#555;color:#FFFFFF;height:30px;">
                                <th style="width:50px;">
                                    <center>Sr.No</center>
                                </th>
                                <th style="width:150px;">
                                    <center> <?php echo $dynamic_teacher;?> Id</center>
                                </th>
                                <th style="width:150px;">
                                    <center> <?php echo $dynamic_teacher;?> Name</center>
                                </th>
                                <th style="width:150px;">
                                    <center><?php echo $dynamic_subject;?>
                                        Name
                                    </center>
                                </th>
                                <th style="width:150px;">
                                    <center><?php echo $dynamic_subject;?>
                                        Code
                                    </center>
                                </th>
                                <?php
                                if ($_SESSION['usertype'] == 'Manager') {
                                    ?>

                                    <th style="width:350px;">
                                        <center>Department Name</center>
                                    </th>

                                    <?php
                                } else {
                                    ?>
                                    <th style="width:350px;">
                                        <center>Branch Name</center>
                                    </th>
                                    <th style="width:350px;">
                                        <center>Department Name</center>
                                    </th>
                                    <?php
                                }
                                ?>

                                <th style="width:50px;">
                                    <center>Course Level</center>
                                </th>
                                <?php
                                if ($_SESSION['usertype'] == 'Manager') {
                                    ?>


                                    <?php
                                } else {
                                    ?>
                                    <th style="width:100px;">
                                        <center>Semester Name</center>
                                    </th>

                                    <th style="width:100px;">
                                        <center>Semester Code</center>
                                    </th>
                                    <?php
                                }
                                ?>
                                <?php
                                if ($_SESSION['usertype'] == 'Manager') {
                                    ?>


                                    <?php
                                } else {
                                    ?>

                                    <th style="width:100px;">
                                        <center>Division Name</center>
                                    </th>
                                    <?php
                                }
                                ?>


                                <th style="width:100px;">
                                    <center><?php echo ($_SESSION['usertype'] == 'Manager') ? 'Evaluation' : 'Academic'; ?>
                                        Year
                                    </center>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            $i = 1;
                            //$arr="SELECT std.std_PRN, std.std_name, std.std_Father_name, std.std_lastname, std.std_complete_name, semester.student_id, semester.SemesterName, semester.BranchName, semester.Specialization, semester.DeptName, semester.CourseLevel, semester.DivisionName, semester.AcdemicYear FROM StudentSemesterRecord AS semester JOIN tbl_student AS std ON std.std_PRN = semester.student_id JOIN tbl_academic_Year a ON semester.AcdemicYear=a.Year where semester.school_id='$sc_id' and semester.`IsCurrentSemester`='1' and a.Enable='1' and a.school_id='$sc_id' ORDER BY std.std_name,std.std_complete_name"?>

                            <?php
                            $arr1 = mysql_query($arr);


                            while ($row = mysql_fetch_array($arr1)) {
                                // $fullName=ucwords(strtolower($row['std_name']." ".$row['std_Father_name']." ".$row['std_lastname']));
                                $teacher_id = $row['teacher_id'];
                                ?>

                                <tr style="height:30px;color:#808080;">


                                    <td data-title="Sr.No" style="width:50px;"><b>
                                            <center><?php echo $i; ?></center>
                                        </b></td>
                                    <td data-title="Sr.No" style="width:50px;"><b>
                                            <center><?php echo $row['teacher_id']; ?></center>
                                        </b></td>

                                    <td style="width:100px;">
                                        <center><?php echo $row['t_complete_name']; ?> </center>
                                    </td>

                                    <td data-title="Student Name" style="width:50px;">
                                        <center><?php echo $row['subjectName']; ?></center>
                                    </td>
                                    <td data-title="Student PRN" style="width:50px;">
                                        <center><?php echo $row['subjcet_code']; ?> </center>
                                    </td>

                                    <td data-title="Branch Name" style="width:420px;">
                                        <center><?php echo $row['Branches_id']; ?></center>
                                    </td>

                                    <td data-title="Department Name" style="width:420px;">
                                        <center><?php echo $row['Department_id']; ?></center>
                                    </td>

                                    <?php
                                    if ($_SESSION['usertype'] == 'Manager') {
                                        ?>

                                        <?php
                                    } else {
                                        ?>
                                        <td data-title="Course" style="width:50px;">
                                            <center><?php echo $row['CourseLevel']; ?></center>
                                        </td>
                                        <?php
                                    }
                                    ?>

                                    <?php
                                    if ($_SESSION['usertype'] == 'Manager') {
                                        ?>


                                        <?php
                                    } else {
                                        ?>

                                        <td data-title="Semester" style="width:100px;">
                                            <center><?php echo $row['Semester_id']; ?></center>
                                        </td>
                                        <td data-title="Semester" style="width:100px;">
                                            <center><?php echo $row['ExtSemesterId']; ?></center>
                                        </td>
                                        <?php
                                    }
                                    ?>




                                    <?php
                                    if ($_SESSION['usertype'] == 'Manager') {
                                        ?>


                                        <?php
                                    } else {
                                        ?>
                                        <td data-title="Division" style="width:100px;">
                                            <center><?php echo $row['Division_id']; ?></center>
                                        </td>
                                        <?php
                                    }
                                    ?>


                                    <td data-title="Year" style="width:100px;">
                                        <center><?php echo $row['AcademicYear']; ?></center>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="row" style="padding:5px;">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-3 " align="center">

                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-3" style="color:#FF0000;" align="center">

                        <?php echo $report; ?>
                    </div>

                </div>


            </div>
        </div>
</body>
</html>
