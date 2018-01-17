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

$sc_id = $result['school_id'];
//echo  $sc_id ;

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">


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

    }

</style>


<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Untitled Document</title>

</head>

<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">

<link rel="stylesheet" href="css/bootstrap.min.css">

<script src="js/jquery-1.11.1.min.js"></script>

<script src="js/jquery.dataTables.min.js"></script>


<script>

    $(document).ready(function () {

        $('#example').dataTable({});

    });


</script>


<script>


    function confirmation(xxx) {


        var answer = confirm("Are you sure you want to delete?")

        if (answer) {
            //alert('DELETE FROM tbl_teacher where id='+xxx);
            alert('record deleted successfully');
            window.location.assign("delete_teacher.php?id=" + xxx);
            // window.location.assign = ;


        }

        else {


        }

    }


</script>


<style>

    .preview {

        border-radius: 50% 50% 50% 50%;

        box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);

        -webkit-border-radius: 99em;

        -moz-border-radius: 99em;

        border-radius: 99em;

        border: 5px solid #eee;

        width: 100px;

    }

</style>


<body bgcolor="#CCCCCC">

<div style="bgcolor:#CCCCCC">


    <div class="container" style="padding:30px;">


        <div style="border:1px solid #CCCCCC; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4;">

            <div style="background-color:#F8F8F8 ;">

                <div class="row">

                    <div class="col-md-3" style="color:#700000 ;padding:5px;">&nbsp;&nbsp;&nbsp;&nbsp;

                        <a href="teacher_setup.php"><input type="submit" class="btn btn-primary" name="submit"
                                                           value="Add <?php echo $dynamic_teacher; ?>"
                                                           style="width:150;font-weight:bold;font-size:14px;"/></a>
                    </div>
                    <div class="col-md-6 " align="center">
                        <h2>List of <?php echo $dynamic_teacher; ?> </h2>
                    </div>


                    <div class="row" align="center" style="margin-top:3%;">
                        <form method="post">
                            <div class="col-md-4"></div>
                            <div class="col-md-3">
                                <select name="info" class="form-control"> 
								<?php $select_option_value= $_POST['info'] ?>
									<option value="Current" <?php if($select_option_value == "Current") echo "selected"; ?>>Current year</option>
                                    <option value="All" <?php if($select_option_value == "All") echo "selected"; ?>>All years</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input type="submit" name="submit" value="Submit" class="btn btn-success">
                            </div>
                        </form>
                    </div>


                </div>

                <div class="row" style="padding:10px;">

                    <div class="col-md-12" id="no-more-tables">

                        <?php $i = 0; ?>


                        <table class="table-bordered  table-condensed cf" id="example" width="100%;">
                            <thead>

                            <tr style="background-color:#555;color:#FFFFFF;height:30px;">
                                <th>Sr.No</th>
                                <th>Profile Picture</th>
                                <th><?php echo $dynamic_teacher; ?> ID</th>
                                <th><?php echo $dynamic_teacher; ?> Name</th>
                                <th>Email ID/Phone No.</th>
                                
                                <th>Department</th>
                                <th>No of <?php echo $dynamic_subject; ?></th>
								<th>No of <?php echo $dynamic_student; ?></th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>

                            </thead>
                            <tbody>

                            <?php


                            $i = 1;
                            //echo "select * from tbl_teacher where (`t_emp_type_pid`='133' or `t_emp_type_pid`='134') and school_id='$sc_id' order by t_complete_name ASC";
                            $arr = mysql_query("select * from tbl_teacher where (`t_emp_type_pid`='133' or `t_emp_type_pid`='134') and school_id='$sc_id' order by t_complete_name ASC"); ?>

                            <?php while ($row = mysql_fetch_array($arr)) {

                                $teacher_id = $row['id'];

                                $t_id = $row['t_id'];

                                $fullname = ucwords(strtolower($row['t_complete_name']));

                                ?>

                                <tr
                                        onmouseover="this.style.cursor='pointer';this.style.textDecoration='underline';this.style.color='dodgerblue'"
                                        onmouseout="this.style.textDecoration='none';this.style.color='black';"
                                        style="cursor: pointer; text-decoration: underline; color: dodgerblue; background-color: rgb(239, 243, 251);height:30px;color:#808080;"
                                >


                                    <td><?php echo $i; ?></td>
                                    <td>
									  <object data="<?php echo $row['t_pc']; ?>" style="width:70px;height:70px;">
											<img src="http://smartcookie.in/core/Images/avatar_2x.png" style="width:70px;height:70px;"/>
									   </object>
									 
									 </td>
                                    <td>
                                        <a href="display_teach_subject.php?t_id=<?php echo $row['t_id']; ?>&school_id=<?php echo $row['school_id']; ?>"><?php echo $row['t_id']; ?></a>
                                    </td>


                                    <td>
                                        <!--                                        <a href="scadmin_teacher_edit.php?t_id=-->
                                        <?php //echo $row['t_id']; ?><!--">--><?php //$teacher_name = ucwords(strtolower($row['t_name'] . " " . $row['t_middlename'] . " " . $row['t_lastname'])); ?>
                                        <a href="edit_teacher_details.php?t_id=<?php echo $row['t_id']; ?>"><?php $teacher_name = ucwords(strtolower($row['t_name'] . " " . $row['t_middlename'] . " " . $row['t_lastname'])); ?>

                                            <?php if ($fullname == "") {

                                                echo $teacher_name;

                                            } else {

                                                echo $fullname;

                                            }


                                            ?></a></td>



                                    <td><?php echo $row['t_email'];echo "</br>";echo $row['t_phone']; ?> </td>


                                    


                                    <td><?php echo $row['t_dept']; ?> </td>


                                    <?php
                                    /* SELECT COUNT(CustomerID) AS OrdersFromCustomerID7 FROM Orders
                WHERE CustomerID=7;*/

                                    //echo "select count(s.tch_sub_id) as count from tbl_teacher_subject_master s join  tbl_academic_Year y on s.AcademicYear=y.Academic_Year and s.`ExtYearID`=y.ExtYearID and y.Enable='1' where s.teacher_id='$t_id' and y.school_id='$sc_id'";
                                    //echo "select count(s.tch_sub_id) As tch_sub_id from tbl_teacher_subject_master s join  tbl_academic_Year y on s.AcademicYear=y.Year  where s.teacher_id='4198005007' and y.school_id='$sc_id' and y.Enable='1'";

                                    //$sql=mysql_query("select count(s.tch_sub_id) as count from tbl_teacher_subject_master s join  tbl_academic_Year y on s.AcademicYear=y.Academic_Year and s.`ExtYearID`=y.ExtYearID and y.Enable='1' where s.teacher_id='$t_id' and y.school_id='$sc_id'");

									 $sql = mysql_query("SELECT DISTINCT  st.Branches_id,st.`subjectName`,st.ExtSemesterId,st.subjcet_code,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st inner join tbl_academic_Year Y on st.AcademicYear=Y.Year    WHERE st.`teacher_id` ='$t_id' and st.school_id='$sc_id' and Y.Enable='1' and Y.school_id='$sc_id'");

									 
                                    if(isset($_POST['submit'])) {
                                        if ($_POST['info'] == 'Current') {
                                            $sql = mysql_query("SELECT DISTINCT  st.Branches_id,st.`subjectName`,st.ExtSemesterId,st.subjcet_code,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st inner join tbl_academic_Year Y on st.AcademicYear=Y.Year    WHERE st.`teacher_id` ='$t_id' and st.school_id='$sc_id' and Y.Enable='1' and Y.school_id='$sc_id'");
                                        } elseif ($_POST['info'] == 'All') {
                                            $sql = mysql_query("SELECT DISTINCT  st.Branches_id,st.`subjectName`,st.ExtSemesterId,st.subjcet_code,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st inner join tbl_academic_Year Y on st.AcademicYear=Y.Year    WHERE st.`teacher_id` ='$t_id' and st.school_id='$sc_id'  and Y.school_id='$sc_id'");
                                        } else {
                                             $sql = mysql_query("SELECT DISTINCT  st.Branches_id,st.`subjectName`,st.ExtSemesterId,st.subjcet_code,st.Division_id,st.Semester_id,st.Department_id,st.CourseLevel,st.AcademicYear FROM `tbl_teacher_subject_master` st inner join tbl_academic_Year Y on st.AcademicYear=Y.Year    WHERE st.`teacher_id` ='$t_id' and st.school_id='$sc_id' and Y.Enable='1' and Y.school_id='$sc_id'");
                                        }
                                    }

                                    $result = mysql_num_rows($sql);
									if(isset($_POST['info']))
										{
											$selection_value=  $_POST['info'];
										}
									else {
										$selection_value= "Current";
										}
                                    ?>

                                    <td>
									<?php 
									
									$fullname = ucwords(strtolower($row['t_complete_name']));
									if ($fullname == "") {

                                                $t_name =  ucwords(strtolower($row['t_name'] . " " . $row['t_middlename'] . " " . $row['t_lastname']));

                                            } else {

                                                $t_name = $fullname;

                                            }


                                            ?>
                                        <a href="display_teach_subject.php?t_id=<?php echo $row['t_id']; ?>&school_id=<?php echo $row['school_id']; ?>&selection=<?php echo $selection_value; ?>&t_name=<?php echo $t_name; ?>"> <?php echo $result; ?></a>
                                    </td>
									
									
									
									
									    <?php
                                   $sql_student = mysql_query("SELECT DISTINCT s.std_complete_name,st.subjectName,st.student_id,st.CourseLevel,st.AcademicYear FROM tbl_student_subject st inner join tbl_student s on st.student_id=s.std_PRN inner join tbl_academic_Year as y on st.AcademicYear=y.Academic_Year where  st.teacher_ID='$t_id'and st.school_id='$sc_id' and y.Enable=1 and st.AcademicYear=(SELECT Year FROM tbl_academic_Year where Enable=1 and school_id='$sc_id' order by id desc limit 1)");

									 
                                    if(isset($_POST['submit'])) {
                                        if ($_POST['info'] == 'Current') {
                                            $sql_student = mysql_query("SELECT DISTINCT s.std_complete_name,st.subjectName,st.student_id,st.CourseLevel,st.AcademicYear FROM tbl_student_subject st inner join tbl_student s on st.student_id=s.std_PRN inner join tbl_academic_Year as y on st.AcademicYear=y.Academic_Year where  st.teacher_ID='$t_id'and st.school_id='$sc_id' and y.Enable=1 and st.AcademicYear=(SELECT Year FROM tbl_academic_Year where Enable=1 and school_id='$sc_id' order by id desc limit 1)");
                                        } elseif ($_POST['info'] == 'All') {
                                            $sql_student = mysql_query("SELECT DISTINCT s.std_complete_name,st.subjectName,st.student_id,st.CourseLevel,st.AcademicYear FROM tbl_student_subject st inner join tbl_student s on st.student_id=s.std_PRN inner join tbl_academic_Year as y on st.AcademicYear=y.Academic_Year where  st.teacher_ID='$t_id'and st.school_id='$sc_id'");
                                        } else {
                                             $sql_student = mysql_query("SELECT DISTINCT s.std_complete_name,st.subjectName,st.student_id,st.CourseLevel,st.AcademicYear FROM tbl_student_subject st inner join tbl_student s on st.student_id=s.std_PRN inner join tbl_academic_Year as y on st.AcademicYear=y.Academic_Year where  st.teacher_ID='$t_id'and st.school_id='$sc_id' and y.Enable=1 and st.AcademicYear=(SELECT Year FROM tbl_academic_Year where Enable=1 and school_id='$sc_id' order by id desc limit 1)");
                                        }
                                    }

                                    $result_student = mysql_num_rows($sql_student);
									 
                                    ?>

                                    <td><?php echo $result_student;?></td>
									

                                    <td><a href="edit_teacher_details.php?t_id=<?php echo $row['t_id']; ?>">
                                            <center><img src="Images/edit.png" height="20px" width="20px">
                                        </a></center></td>

                                    <td>
                                        <center><img src="Images/cancel.png" style=" width:25px;height:25px;"
                                                     alt="Cancel" id="<?php echo $row['id']; ?>"
                                                     onclick="return confirmation(this.id)"></center>
                                    </td>


                                </tr>

                                <?php

                                $i++;

                                ?>

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
