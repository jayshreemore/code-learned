<?php
include_once("scadmin_header.php");
$results = $smartcookie->retrive_individual($table, $fields);
$result = mysql_fetch_array($results);
$school_id = $result['school_id'];


?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Smart Cookie </title>
<!--<script src='js/bootstrap.min.js' type='text/javascript'></script>-->
<link href="css/style.css" rel="stylesheet">
 <link rel="stylesheet" href="/lib/w3.css">
<style>
.shadow{
   box-shadow: 1px 1px 1px 2px  #428BCA;
}

.shadow:hover{

 box-shadow: 1px 1px 1px 3px  #428BCA;
}
.radius{
    border-radius: 80px;
}
.hColor{
    padding:3px;
    border-radius:5px 5px 0px 0px;
    color:#fff;
    background-color: rgba(105,68,137, 0.8);
}

</style>
</head>
<body>


<div class="container" style="width:100%">
<div class="row">

<div class="col-md-15" style="padding-top:15px;">
<div class="radius " style="height:50px; width:100%; background-color:#428BCA;" align="center">
        	<h2 style="padding-left:20px;padding-top:15px; margin-top:20px;color:white"> Smartcookies Analytics</h2>
        </div>

</div>
</div>

<div class="row" style="padding-top:10px; width:100%;">

<div  style="padding-top:20px;">
 <div class="col-sm-1" style="padding-top:20px;" ></div>

 <a href="sc_teacher_login_Details.php" style="text-decoration:none";>
    <div class="col-md-3 shadow radius" style="background-color:#FFFFFF; border:1px solid #428BCA;">
                	<h4 class="" align="center">Teachers Logged in </h4>
                            <div align="center" style="font-size:54px;padding-left:5px;color:#428BCA;font-weight:bold;">
									<?php $row=mysql_query("SELECT count(Entity_type) as teacher FROM tbl_LoginStatus where Entity_type='103' AND school_id = '$school_id'");
									//SELECT DISTINCT  * FROM techindi_Dev.tbl_LoginStatus where  Entity_type=103 
                                             $result=mysql_fetch_array($row);
                                                 echo $result['teacher'];


                                    ?>

                        		</div>

                </div></a>
</div>

<div class="col-sm-1" style="padding-top:20px;" ></div>
 <a  href="sc_student_login_Details.php" style="text-decoration:none";>
    <div class="col-md-3 shadow radius" style="background-color:#FFFFFF; border:1px solid #428BCA;">
                	<h4 align="center">Students Logged in</h4>
                            <div align="center" style="font-size:54px;padding-left:5px;color:#428BCA;font-weight:bold;">
									<?php
                $result = mysql_query("SELECT count(Entity_type) AS student FROM tbl_LoginStatus where Entity_type='105' AND school_id = '$school_id'");
				$row = mysql_fetch_array($result);
			echo $row['student'];

				?>

                        		</div>

                </div></a>



<div class="col-sm-1" style="padding-top:20px;"></div>
 <a href="sc_soft_reward_purchase_teacher.php" style="text-decoration:none";>
    <div class="col-md-3 shadow radius" style="background-color:#FFFFFF; border:1px solid #428BCA; ">
                	<h4 align="center">Soft Rewards Purchased By Teachers</h4>
                            <div align="center" style="font-size:54px;padding-left:5px;color:#428BCA;font-weight:bold;">
									 <?php
                $result =mysql_query("SELECT COUNT(id) AS total FROM purcheseSoftreward where userType='Teacher' AND school_id = '$school_id'");
				///SELECT * FROM techindi_Dev.purcheseSoftreward where userType='Student';
				$row = mysql_fetch_array($result);
				
		 			    echo $row['total'];
				?>

                        		</div>

                </div></a>
</div>


<div class="row" style="padding-top:10px; width:100%;">

<div  style="padding-top:40px;">
<div class="col-sm-1" style="padding-top:20px;" ></div>
 <a href="sc_soft_reward_purchase_student.php" style="text-decoration:none";>
    <div class="col-md-3 shadow radius" style="background-color:#FFFFFF; border:1px solid #428BCA;">
                	<h4 align="center">Soft Rewards Purchased By Students</h4>
                            <div align="center" style="font-size:54px;padding-left:5px;color:#428BCA;font-weight:bold;">
									<?php
									    $row=mysql_query("SELECT COUNT(id) AS total FROM purcheseSoftreward where userType='Student' AND school_id ='$school_id'");
                                            $result = mysql_fetch_array($row);
                                                echo $result['total'];


                                    ?>

                        		</div>

                </div></a>
</div>


<div class="col-sm-1" style="padding-top:20px;"></div>
 <a href="sc_vendor_coupon_purchased_teacher.php" style="text-decoration:none";>
    <div class="col-md-3 shadow radius" style="background-color:#FFFFFF; border:1px solid #428BCA; ">
                	<h4 align="center">Vendor Coupons Used By Teachers</h4>
                            <div align="center" style="font-size:54px;padding-left:5px;color:#428BCA;font-weight:bold;">
									<?php $row=mysql_query("SELECT * FROM tbl_selected_vendor_coupons where  entity_id='2' AND used_flag ='used' AND school_id = '$school_id'");
									//SELECT * FROM techindi_Dev.tbl_selected_vendor_coupons where  user_id='498';
                                             $result=mysql_num_rows($row);
                                              echo $result;


                                    ?>

                        		</div>

                </div></a>

				
				

<div class="col-sm-1" style="padding-top:20px;"></div>
 <a href="sc_vendor_coupon_purchased_student.php" style="text-decoration:none";>
    <div class="col-md-3 shadow radius" style="background-color:#FFFFFF; border:1px solid #428BCA; ">
                	<h4 align="center">Vendor Coupons Used By Students</h4>
                            <div align="center" style="font-size:54px;padding-left:5px;color:#428BCA;font-weight:bold;">
									<?php $row=mysql_query("SELECT * FROM tbl_selected_vendor_coupons where  entity_id='3' AND used_flag ='used' AND school_id = '$school_id'");
                                             $result=mysql_num_rows($row);
                                              echo $result;


                                    ?>

                        		</div>

                </div></a>
</div>


<div class="row" style="padding-top:10px; width:100%;">

<div  style="padding-top:20px;">
 <div class="col-sm-1" style="padding-top:20px;" ></div>

 <a href="sc_analytics_details_smartcookie_coupons_used_by_student.php" style="text-decoration:none";>
    <div class="col-md-3 shadow radius" style="background-color:#FFFFFF; border:1px solid #428BCA;">
                	<h4 class="" align="center">Smartcookie Coupon Used By Students </h4>
                            <div align="center" style="font-size:54px;padding-left:5px;color:#428BCA;font-weight:bold;">
									<?php $result=mysql_query("SELECT * FROM tbl_coupons as student_smartcookie_used where (status = 'no' or status = 'p') AND school_id = '$school_id' ");
									//SELECT DISTINCT  * FROM techindi_Dev.tbl_LoginStatus where  Entity_type=103 
                                             $row=mysql_num_rows($result);
                                                 echo $row;


                                    ?>

                        		</div>

                </div></a>
</div>

<div class="col-sm-1" style="padding-top:20px;" ></div>
 <a  href="sc_analytics_details_smartcookie_coupons_used_by_teacher.php" style="text-decoration:none";>
    <div class="col-md-3 shadow radius" style="background-color:#FFFFFF; border:1px solid #428BCA;">
                	<h4 align="center">Smartcookie Coupon Used By Teachers </h4>
                            <div align="center" style="font-size:54px;padding-left:5px;color:#428BCA;font-weight:bold;">
									<?php
                $result = mysql_query("SELECT * FROM techindi_Dev.tbl_teacher_coupon where (status='no' or  status='p') AND school_id = '$school_id'");
				$row = mysql_num_rows($result);
			echo $row;

				?>

                        		</div>

                </div></a>

				
<div class="col-sm-1" style="padding-top:20px;" ></div>
 <a  href="sc_analytics_details_green_points_distributed_by_cookieadmin.php" style="text-decoration:none";>
    <div class="col-md-3 shadow radius" style="background-color:#FFFFFF; border:1px solid #428BCA;">
                	<h4 align="center">Green Points Distributed To Teachers By School Admin </h4>
                            <div align="center" style="font-size:54px;padding-left:5px;color:#428BCA;font-weight:bold;">
									<?php
                $result = mysql_query("SELECT SUM(sc_point) as teacher_green_points FROM tbl_teacher_point where school_id='$school_id' AND sc_entities_id=102 AND reason = 'assigned by school admin'");
				$row = mysql_fetch_array($result);
			echo $row['teacher_green_points'];

				?>

                        		</div>

                </div></a>				
</div>




<div class="row" style="padding-top:20px; width:100%;">

<div class="col-sm-1" style="padding-top:20px;" ></div>
 <a  href="sc_analytics_details_blue_points_distributed_by_cookieadmin.php" style="text-decoration:none";>
    <div class="col-md-3 shadow radius" style="background-color:#FFFFFF; border:1px solid #428BCA;">
                	<h4 align="center">Blue Points Distributed To Students By School Admin </h4>
                            <div align="center" style="font-size:54px;padding-left:5px;color:#428BCA;font-weight:bold;">
									<?php
                $result = mysql_query("SELECT SUM(sc_point) as student_blue_points FROM  tbl_student_point where sc_entites_id=102 AND type_points='blue_point'");
				$row = mysql_fetch_array($result);
			echo $row['student_blue_points'];

				?>

                        		</div>

                </div></a>				




<div class="col-sm-1" style="padding-top:20px;"></div>
 <a href="sc_analytics_details_teachers_without_email.php" style="text-decoration:none";>
    <div class="col-md-3 shadow radius" style="background-color:#FFFFFF; border:1px solid #428BCA; ">
                	<h4 align="center">Teachers Without Email Id</h4>
                            <div align="center" style="font-size:54px;padding-left:5px;color:#428BCA;font-weight:bold;">
									 <?php
                $result =mysql_query("SELECT COUNT(id) AS total FROM tbl_teacher where t_email='' AND school_id = '$school_id'");
				//SELECT * FROM techindi_Dev.tbl_teacher where t_email='';
				///SELECT * FROM techindi_Dev.purcheseSoftreward where userType='Student';
				$row = mysql_fetch_array($result);
				
		 			    echo $row['total'];
				?>

                        		</div>

                </div></a>
				<div class="col-sm-1" style="padding-top:20px;"></div>
 <a href="sc_analytics_details_teachers_without_phone.php" style="text-decoration:none";>
    <div class="col-md-3 shadow radius" style="background-color:#FFFFFF; border:1px solid #428BCA; ">
                	<h4 align="center">Teachers Without Phone</h4>
                            <div align="center" style="font-size:54px;padding-left:5px;color:#428BCA;font-weight:bold;">
									 <?php
                $result =mysql_query("SELECT COUNT(id) AS total FROM tbl_teacher where t_phone='' AND school_id = '$school_id'");
				///SELECT * FROM techindi_Dev.purcheseSoftreward where userType='Student';
				$row = mysql_fetch_array($result);
				
		 			    echo $row['total'];
				?>

                        		</div>

                </div></a>
</div>
<div class="row" style="padding-top:20px; width:100%;">

<div class="col-sm-1" style="padding-top:20px;" ></div>
 <a  href="sc_analytics_details_teachers_without_email_phone.php" style="text-decoration:none";>
    <div class="col-md-3 shadow radius" style="background-color:#FFFFFF; border:1px solid #428BCA;">
                	<h4 align="center">Teachers Without Email And Phone No </h4>
                            <div align="center" style="font-size:54px;padding-left:5px;color:#428BCA;font-weight:bold;">
									<?php
                $result = mysql_query("SELECT * FROM tbl_teacher where t_email ='' and t_phone='' AND school_id = '$school_id'");
				$row = mysql_num_rows($result);
			echo $row;

				?>

                        		</div>

                </div></a>				




<div class="col-sm-1" style="padding-top:20px;"></div>
 <a href="sc_analytics_details_students_without_email.php" style="text-decoration:none";>
    <div class="col-md-3 shadow radius" style="background-color:#FFFFFF; border:1px solid #428BCA; ">
                	<h4 align="center">Students Without Email Id</h4>
                            <div align="center" style="font-size:54px;padding-left:5px;color:#428BCA;font-weight:bold;">
									 <?php
                $result =mysql_query("SELECT COUNT(id) AS total FROM tbl_student where std_email='' AND school_id = '$school_id'");
				//SELECT * FROM techindi_Dev.tbl_teacher where t_email='';
				///SELECT * FROM techindi_Dev.purcheseSoftreward where userType='Student';
				$row = mysql_fetch_array($result);
				
		 			    echo $row['total'];
				?>

                        		</div>

                </div></a>
				<div class="col-sm-1" style="padding-top:20px;"></div>
 <a href="sc_analytics_details_students_without_phone.php" style="text-decoration:none";>
    <div class="col-md-3 shadow radius" style="background-color:#FFFFFF; border:1px solid #428BCA; ">
                	<h4 align="center">Students Without Phone</h4>
                            <div align="center" style="font-size:54px;padding-left:5px;color:#428BCA;font-weight:bold;">
									 <?php
                $result =mysql_query("SELECT COUNT(id) AS total FROM tbl_student where std_phone='' AND school_id = '$school_id'");
				///SELECT * FROM techindi_Dev.purcheseSoftreward where userType='Student';
				$row = mysql_fetch_array($result);
				
		 			    echo $row['total'];
				?>

                        		</div>

                </div></a>
</div>
<div class="row" style="padding-top:20px; width:100%;">

<div class="col-sm-1" style="padding-top:20px;" ></div>
 <a  href="sc_analytics_details_students_without_email_phone.php" style="text-decoration:none";>
    <div class="col-md-3 shadow radius" style="background-color:#FFFFFF; border:1px solid #428BCA;">
                	<h4 align="center">Students Without Email And Phone No </h4>
                            <div align="center" style="font-size:54px;padding-left:5px;color:#428BCA;font-weight:bold;">
									<?php
                $result = mysql_query("SELECT * FROM tbl_student where std_phone ='' and std_email='' AND school_id = '$school_id' ;");
				$row = mysql_num_rows($result);
			echo $row;

				?>

                        		</div>

                </div></a>				








</div>










</body>
</html>







<!--
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Smart Cookie </title>
<link href="css/style.css" rel="stylesheet">
<style>
.shadow{
   box-shadow: 1px 1px 1px 2px  rgba(150,150,150, 0.4);
}

.shadow:hover{

 box-shadow: 1px 1px 1px 3px  rgba(150,150,150, 0.5);
}
.radius{
    border-radius: 5px;
}
.hColor{
    padding:3px;
    border-radius:5px 5px 0px 0px;
    color:#fff;
    background-color: rgba(105,68,137, 0.8);
}

</style>

</head>
<body>
<div class="container" style="width:100%">
<div class="row">

<div class="col-md-15" style="padding-top:15px;">
<div style="height:50px; width:100%; background-color:#FFFFFF;box-shadow: 0px 1px 3px 1px #666666;" align="left">
        	<h2 style="padding-left:20px;padding-top:10px; margin-top:20px;">Dashboard</h2>
        </div>

</div>
</div>

<div class="row" style="padding-top:10px; width:100%;padding-left:15px;">

<div  style="padding-top:20px;">
 <div class="col-sm-1" style="padding-top:20px;" ></div>

 <a href="school_list.php" style="text-decoration:none";>
    <div class="col-md-3 " style="background-color:#FFFFFF; border:1px solid #CCCCCC; box-shadow: 0px 1px 3px 1px #666666;">
                	<h4 align="center">No. of Schools</h4>
                            <div align="center" style="font-size:54px;padding-left:5px;color:#308C00;font-weight:bold;">
									<?php $row=mysql_query("select * from tbl_school_admin where school_id!='0'");
                                             $result=mysql_num_rows($row);
                                                 echo $result;


                                    ?>

                        		</div>

                </div></a>
</div>


<div class="col-sm-1" style="padding-top:20px;" ></div>
 <a href="teacher_list.php" style="text-decoration:none";>
    <div class="col-md-3" style="background-color:#FFFFFF; border:1px solid #CCCCCC; box-shadow: 0px 1px 3px 1px #666666;">
                	<h4 align="center">No. of Teachers</h4>
                            <div align="center" style="font-size:54px;padding-left:5px;color:#308C00;font-weight:bold;">
									<?php
                $result = mysql_query('SELECT COUNT(id) AS total_teachers FROM tbl_teacher where school_id!=""');
				$row = mysql_fetch_array($result);
			echo $row['total_teachers'];

				?>

                        		</div>

                </div></a>



<div class="col-sm-1" style="padding-top:20px;"></div>
 <a href="student_list.php" style="text-decoration:none";>
    <div class="col-md-3" style="background-color:#FFFFFF; border:1px solid #CCCCCC; box-shadow: 0px 1px 3px 1px #666666;">
                	<h4 align="center">No. of Students</h4>
                            <div align="center" style="font-size:54px;padding-left:5px;color:#308C00;font-weight:bold;">
									 <?php
                $result = mysql_query('SELECT COUNT(id) AS total_students FROM tbl_student where school_id!=""');
				$row = mysql_fetch_array($result);
		 			    echo $row['total_students'];
				?>

                        		</div>

                </div></a>
</div>


<div class="row" style="padding-top:10px; width:100%;">

<div  style="padding-top:40px;">
<div class="col-sm-1" style="padding-top:20px;" ></div>
 <a href="sponsor_list.php" style="text-decoration:none";>
    <div class="col-md-3" style="background-color:#FFFFFF; border:1px solid #CCCCCC; box-shadow: 0px 1px 3px 1px #666666;">
                	<h4 align="center">No. of Sponsors</h4>
                            <div align="center" style="font-size:54px;padding-left:5px;color:#308C00;font-weight:bold;">
									<?php
									    $row=mysql_query("select * from tbl_sponsorer");
                                             $result=mysql_num_rows($row);
                                                 echo $result;


                                    ?>

                        		</div>

                </div></a>
</div>


<div class="col-sm-1" style="padding-top:20px;"></div>
 <a href="parent_list.php" style="text-decoration:none";>
    <div class="col-md-3" style="background-color:#FFFFFF; border:1px solid #CCCCCC; box-shadow: 0px 1px 3px 1px #666666;">
                	<h4 align="center">No. of Parents</h4>
                            <div align="center" style="font-size:54px;padding-left:5px;color:#308C00;font-weight:bold;">
									<?php $row=mysql_query("select * from tbl_parent");
                                             $result=mysql_num_rows($row);
                                              echo $result;


                                    ?>

                        		</div>

                </div></a>


<div class="col-sm-1" style="padding-top:20px;"></div>
 <a href="CookieAdminStaff_list.php" style="text-decoration:none";>
    <div class="col-md-3" style="background-color:#FFFFFF; border:1px solid #CCCCCC; box-shadow: 0px 1px 3px 1px #666666;">
                	<h4 align="center">No. of Staff</h4>
                            <div align="center" style="font-size:54px;padding-left:5px;color:#308C00;font-weight:bold;">
									<?php $row=mysql_query("select * from tbl_cookie_adminstaff");
                                             $result=mysql_num_rows($row);
                                              echo $result;


                                    ?>

                        		</div>

                </div></a>
</div>


</div>









</div>

</body>
</html>





-->
