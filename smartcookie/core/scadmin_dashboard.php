<?php
include_once("scadmin_header.php");
error_reporting(0);
/* $id=$_SESSION['id'];
 $fields=array("id"=>$id);
 $table="tbl_school_admin";
 $smartcookie=new smartcookie();*/
$results = $smartcookie->retrive_individual($table, $fields);
$result = mysql_fetch_array($results);
$school_id = $result['school_id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smart Cookie Program</title>


</head>

<body>

<div class="container" style="padding-top:30px;">

    <div class="row" style="padding-top:20px;">

        <div class="col-md-3"><a href="teacherlist.php" style="text-decoration:none;">
                <div class="panel panel-info ">
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center"><b><?php echo $dynamic_teacher;?></b></h3>
                    </div>
                    <div class="panel-body" style="font-size:x-large" align="center">
                        <?php
                        $sql_t1 = "select count(t_id) as count from tbl_teacher where (`t_emp_type_pid`=133 or `t_emp_type_pid`=134 )and school_id='$school_id'";
                        $row_t1 = mysql_query($sql_t1);
                        $count1 = mysql_fetch_array($row_t1);
                        echo $count1['count'];
                        ?>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3"><a href="studlist.php" style="text-decoration:none;">
                <div class="panel panel-info ">
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center"><b><?php echo $dynamic_student;?></b></h3>
                    </div>
                    <div class="panel-body" style="font-size:x-large" align="center">
                        <?php
                        $sql_t = "select count(id) from tbl_student where school_id='$school_id'";
                        $row_t = mysql_query($sql_t);
                        $r = mysql_fetch_array($row_t);
                        echo $c_parent = $r['0'];
                        ?>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3"><a href="list_school_department.php" style="text-decoration:none;">
                <div class="panel panel-info ">
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center"><b>Departments</b></h3>
                    </div>
                    <div class="panel-body" style="font-size:x-large" align="center">

                        <?php
                        $sql_sp = "select count(id) as count from  tbl_department_master where school_id='$school_id' ";
                        $row_sp = mysql_query($sql_sp);
                        $count_sp = mysql_fetch_array($row_sp);
                        echo $count_sp['count']; ?>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3"><a href="list_teacher_subject.php" style="text-decoration:none;">
                <div class="panel panel-info ">
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center"><b><?php echo $dynamic_teacher_Subject;?></b></h3>
                    </div>
                    <div class="panel-body" style="font-size:x-large" align="center">

                        <?php
                        $sql_sp = "select count(tch_sub_id) as count from  tbl_teacher_subject_master where school_id='$school_id' ";
                        $row_sp = mysql_query($sql_sp);
                        $count_sp = mysql_fetch_array($row_sp);
                        echo $count_sp['count']; ?>
                    </div>
                </div>
            </a>
        </div>

    </div>


    <div class="row" style="padding-top:20px;">


        <div class="col-md-3"><a href="sponsorlist.php" style="text-decoration:none;">
                <div class="panel panel-info ">
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center"><b>Sponsors</b></h3>
                    </div>
                    <div class="panel-body" style="font-size:x-large" align="center">
                        <?php
                        $sql_sp = "select count(id) as count from tbl_sponsorer ";
                        $row_sp = mysql_query($sql_sp);
                        $count_sp = mysql_fetch_array($row_sp);
                        echo $count_sp['count']; ?>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-md-3"><a href="list_school_subject.php" style="text-decoration:none;">
                <div class="panel panel-info ">
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center"><b><?php echo $dynamic_subject;?></b></h3>
                    </div>
                    <div class="panel-body" style="font-size:x-large" align="center">
                        <?php
                        $sql_sp = "select count(id) as count from tbl_school_subject where school_id='$school_id'";
                        $row_sp = mysql_query($sql_sp);
                        $count_sp = mysql_fetch_array($row_sp);
                        echo $count_sp['count']; ?>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3"><a href="list_student_subject.php" style="text-decoration:none;">
                <div class="panel panel-info ">
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center"><b><?php echo $dynamic_student;?> per <?php echo $dynamic_subject;?></b></h3>
                    </div>
                    <div class="panel-body" style="font-size:x-large" align="center">

                        <?php
                        $sql_sp = "select count(id) as count from  tbl_student_subject_master where school_id='$school_id'";
                        $row_sp = mysql_query($sql_sp);
                        $count_sp = mysql_fetch_array($row_sp);
                        echo $count_sp['count']; ?>
                    </div>
                </div>
            </a>
        </div>

        <?php if ($school_type == 'school'){?>

        <div class="col-md-3"><a href="list_school_academic_year.php" style="text-decoration:none;">
                <div class="panel panel-info ">
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center"><b>Academic Years</b></h3>
                    </div>
                    <div class="panel-body" style="font-size:x-large" align="center">
                        <?php
                        $sql_sp = "SELECT count(id) as count FROM `tbl_academic_Year` WHERE `school_id` ='$school_id'";
                        $row_sp = mysql_query($sql_sp);
                        $count_sp = mysql_fetch_array($row_sp);
                        echo $count_sp['count']; ?>
                    </div>
                </div>
            </a>
        </div>


    </div>

    <div class="row" style="padding-top:20px;">



        <div class="col-md-3"><a href="Nonteacherlist.php" style="text-decoration:none;">
                <div class="panel panel-info ">
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center"><b>Non Teaching Staff</b></h3>
                    </div>
                    <div class="panel-body" style="font-size:x-large" align="center">
                        <?php
                        $sql_t1 = "select count(t_id) as count from tbl_teacher where `t_emp_type_pid`!=133 and `t_emp_type_pid`!=134 and school_id='$school_id'";
                        $row_t1 = mysql_query($sql_t1);
                        $count1 = mysql_fetch_array($row_t1);
                        echo $count1['count'];
                        ?>
                    </div>
                </div>
            </a>
        </div>





        <div class="col-md-3"><a href="list_school_branch.php" style="text-decoration:none;">
                <div class="panel panel-info ">
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center"><b>Branches</b></h3>
                    </div>
                    <div class="panel-body" style="font-size:x-large" align="center">
                        <?php
                        $sql_sp = "select count(id) as count from tbl_branch_master where school_id='$school_id' ";
                        $row_sp = mysql_query($sql_sp);
                        $count_sp = mysql_fetch_array($row_sp);
                        echo $count_sp['count']; ?>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-md-3"><a href="list_semester.php" style="text-decoration:none;">
                <div class="panel panel-info ">
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center"><b>Semesters</b></h3>
                    </div>
                    <div class="panel-body" style="font-size:x-large" align="center">
                        <?php


                        $sql_sp = "select count(Semester_Id) as count from tbl_semester_master where school_id='$school_id'";
                        $row_sp = mysql_query($sql_sp);
                        $count_sp = mysql_fetch_array($row_sp);
                        echo $count_sp['count']; ?>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-md-3"><a href="list_school_class.php" style="text-decoration:none;">
                <div class="panel panel-info ">
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center"><b>Classes</b></h3>
                    </div>
                    <div class="panel-body" style="font-size:x-large" align="center">  <?php
                        $s = mysql_query("SELECT count(id) FROM Class WHERE school_id='$school_id'");
                        $r = mysql_fetch_array($s);
                        echo $c_parent = $r['0'];

                        ?>

                    </div>
                </div>
            </a>
        </div>


    </div>


    <div class="row" style="padding-top:20px;">
        <div class="col-md-3"><a href="student_semester_record.php" style="text-decoration:none;">
                <div class="panel panel-info ">
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center"><b>Students per Semester</b></h3>
                    </div>
                    <div class="panel-body" style="font-size:x-large" align="center">  <?php
                        /*//	$s=mysql_query("SELECT count(sm.id) as count FROM StudentSemesterRecord sm JOIN tbl_academic_Year a ON sm.AcdemicYear=a.Academic_Year WHERE sm.school_id='$school_id'  and  sm.`IsCurrentSemester`='1' and a.Enable='1' and a.school_id='$school_id'");
                            $countstudent=mysql_query("SELECT COUNT(`student_id`) as total FROM `StudentSemesterRecord` WHERE `school_id`=$school_id and `IsCurrentSemester`='1'");
                            //	$arr="SELECT std.std_PRN, std.std_name, std.std_Father_name, std.std_lastname, std.std_complete_name, semester.student_id, semester.SemesterName, semester.BranchName, semester.Specialization, semester.DeptName, semester.CourseLevel, semester.DivisionName, semester.AcdemicYear FROM StudentSemesterRecord AS semester JOIN tbl_student AS std ON std.std_PRN = semester.student_id JOIN tbl_academic_Year a ON semester.AcdemicYear=a.Year where semester.school_id='$sc_id' and semester.`IsCurrentSemester`='1' and a.Enable='1' and a.school_id='$sc_id' ORDER BY std.std_name,std.std_complete_name";
                            $results=mysql_fetch_array($countstudent);
                             echo $results['total'];*/
                        $sql_sp = "SELECT DISTINCT std.std_PRN, std.std_name, std.std_Father_name, std.std_lastname, std.std_complete_name, semester.student_id, semester.SemesterName, semester.BranchName, semester.Specialization, semester.DeptName, semester.CourseLevel, semester.DivisionName, semester.AcdemicYear FROM StudentSemesterRecord  semester JOIN tbl_student std ON std.std_PRN = semester.student_id JOIN tbl_academic_Year a ON semester.ExtYearID=a.ExtYearID where semester.school_id='$school_id' and std.school_id='$school_id' and semester.`IsCurrentSemester`='1' and a.Enable='1' and a.school_id='$school_id' ORDER BY std.std_name,std.std_complete_name";
                        $row_sp = mysql_query($sql_sp);
                        $count_sp = mysql_num_rows($row_sp);
                        echo $count_sp; ?>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3"><a href="list_class_subject.php" style="text-decoration:none;">
                <div class="panel panel-info ">
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center"><b>Class Subjects</b></h3>
                    </div>
                    <div class="panel-body" style="font-size:x-large" align="center">
                        <?php
                        $sql_sp = "SELECT count(id) as count FROM `tbl_class_subject_master` WHERE `school_id` ='$school_id'";
                        $row_sp = mysql_query($sql_sp);
                        $count_sp = mysql_fetch_array($row_sp);
                        echo $count_sp['count']; ?>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3"><a href="parents_list.php" style="text-decoration:none;">
                <div class="panel panel-info ">
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center"><b>Parents</b></h3>
                    </div>
                    <div class="panel-body" style="font-size:x-large" align="center">
                        <?php
                        $s = mysql_query("SELECT count(id) FROM tbl_parent WHERE school_id='$school_id'");
                        $r = mysql_fetch_array($s);
                        echo $c_parent = $r['0'];
                        ?>
                    </div>
                </div>
            </a>
        </div>



        <div class="col-md-3"><a href="branch_subject_master.php" style="text-decoration:none;">
                <div class="panel panel-info ">
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center"><b>Branch Subject Division Year</b></h3>
                    </div>
                    <div class="panel-body" style="font-size:x-large" align="center">
                        <?php
                        $sql_sp = "SELECT count(id) as count FROM `Branch_Subject_Division_Year` WHERE `school_id` ='$school_id'";
                        $row_sp = mysql_query($sql_sp);
                        $count_sp = mysql_fetch_array($row_sp);
                        echo $count_sp['count']; ?>
                    </div>
                </div>
            </a>
        </div>
        <?php } ?>
    </div>
</div>
</body>
</html>
