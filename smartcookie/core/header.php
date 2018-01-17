<?php
//header("Refresh:0");
include_once('conn.php');
$school_type = $_SESSION['school_type'];
$dynamic_teacher = $school_type == "school" ? "Teacher" : ( $school_type == "organization" ?  "Manager" :  ( $school_type == "NYKS" ? "Volunteer":""));
$dynamic_school_admin = $school_type == "school" ? "School Admin" : ( $school_type == "organization" ?  "Organization Admin" :  ( $school_type == "NYKS" ? "Club Admin":""));
$dynamic_school = $school_type == "school" ? "School" : ( $school_type == "organization" ?  "Organization" :  ( $school_type == "NYKS" ? "Club":""));
$dynamic_student = $school_type == "school" ? "Student" : ( $school_type == "organization" ?  "Employee" :  ( $school_type == "NYKS" ? "Beneficiary":""));
$dynamic_student_prn = $school_type == "school" ? "Std_PRN" : ( $school_type == "organization" ?  "Emp_ID" :  ( $school_type == "NYKS" ? "Benef_ID":""));
$dynamic_subject = $school_type == "school" ? "Subject" : ( $school_type == "organization" ?  "Project" :  ( $school_type == "NYKS" ? "Project":""));

if(!isset($_SESSION['teacher_id'])){
  header("Location: login.php");
}
$row=mysql_query("select * from tbl_teacher where id=".$_SESSION['id']);
$value=mysql_fetch_array($row);
$id=$value['id'];
$school_id=$value['school_id'];
$t_id=$value['t_id'];
$t_current_school_name=$value['t_current_school_name'];

$t_name=$value['t_name']." ".$value['t_lastname']."".$value['t_middlename'];
$tc__name=$value['tc_name'];?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="utf-8">
<title>Smart Cookies::<?php echo ($_SESSION['usertype']=='Manager')? 'Manager':'Teacher';?></title>

 <link href="bootstrap.css" rel="stylesheet">
<link href="css/coupon_style.css" rel="stylesheet">

 <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

<script src='js/bootstrap.min.js' type='text/javascript'></script>

<!-- Global site tag (gtag.js) - Google Analytics  Tell By Rakesh Sir-->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-110935994-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-110935994-1');
</script>
<!-- Code complete here- Google Analytics  Tell By Rakesh Sir-->

<style>
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

.navbar-inverse .navbar-nav>li>a {
color: #FFFFFF;
font-weight:bold;
padding-left:17px;
}
.navbar-inverse{

    border-color:#FFFFFF;
}
.navbar-nav
{
margin-left:-27px;
}

.preview
{
border-radius:50% 50% 50% 50%;
height:100px;
box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);
-webkit-border-radius: 99em;
  -moz-border-radius: 99em;
  border-radius: 99em;
  border: 5px solid #eee;
  width:100px;
}
.brwon-clr{ background-color:#8B4513!important;}
.brwon-clr h3{color:#fff;}


.panel-success > .panel-heading
{
background-color:#3dbd2f !important;


}
.navbar-collapse .navbar-nav.navbar-left:first-child {

margin-left:150px;
}
.title
{
	font-family:"Bodoni MT";
    color:#257CC1;
}
</style>


</head>

<body>
<!-- header-->
<div class="container-fluide" >
        <div class="row">
		<div><center style=:"margin-right:60px;color:rgb(0,0,255);"><h1><?php echo $t_current_school_name;?></h1></center></div>
		<div class="col-md-12">
        		<div class="col-md-4 logo pull-left">
				<div class='row'>
				<div class='col-md-12' >
				   <img style='float:left' src="Images/400_132_logo.png" class="img-responsive">
				   <h2 class='title' style='padding-top:30px'>SMART COOKIE</h2>
				   <?php if($school_type=='school'){?>
				   <h5><b>Student/Teacher Reward program</b></h5>
				   <?php }
				   else if($school_type=='organization'){
				   ?>
				    <h5><b>Employee/Manager Reward program</b></h5>
				   <?php }
				   else if($school_type=='NYKS'){
				   ?>
				   <h5><b>Neharu Yuva Kendra Reward program</b></h5>
				   <?php } ?>
				</div>
		   </div>
		    </div>





              <div class="col-md-2" style="padding-right:10px;" >

            	<center><div style="padding:5px; width:100%;" align="center">

                <?php if($value['t_pc'] != ''){?>
                <img src="<?php echo $value['t_pc'];?>" width="70" height="70" class="preview" />
                <?php }else {?> <img src="image/avatar_2x.png" width="70" height="70" style="border:1px solid #CCCCCC;" class="preview" alt="Responsive image"/> <?php }?>
                &nbsp;
                </div></center>
             </div>
			 <div class="col-md-2" style="margin-top:60px;color:green;font-size:20px;" >

         </div>
             <div class="col-md-4" align="center">
                    <div class="row" style="height:40px;background-color:#203CB6; padding-top:5px; ; border-radius: 3px 3px 5px 5px; margin-bottom:10px; margin-top:-2px; color:#FFFFFF; font-size:12px;">


		 <h5> Welcome <?php $name=$value['t_complete_name']; if($name!=""){echo $name;}else{echo $t_name;}?></h5>
		<h5><?php echo $dynamic_teacher.' Login';?></h5>

                    </div>

                   <div style="font-weight:bold;font-size:12px;"><?php echo $value['t_current_school_name'];?></div>
                    <div  class="row" style="font-size:12px;height:30px;">
                     	Member ID :<?php
						echo "T".str_pad($_SESSION['id'],11,"0",STR_PAD_LEFT);
						?>
                    </div >
                    <div class="row" style="padding-right:10px;  font-weight:bold;font-size:12px;">
                      <h4> <?php /*?> <?php echo ($_SESSION['usertype']=='Manager')? 'Manager':'Teacher';?> Login</h4>

        <?php */?>
                    </div>
                    <div class="row" style="height:29px;background-color:#203CB6; padding-top:5px; ; border-radius: 7px; margin-bottom:10px; margin-top:-2px; color:#FFFFFF; font-size:12px;width:100px;">
                     <h5><a style="color:white" href="logout.php" style="text-decoration:none; color:#85D3A1;">Sign Out</a></h5>&nbsp;
</div>
		   </div>

                </div>

        </div>
 </div>




                <div class=" navbar-inverse" role="navigation" style="background-color:#203CB6;width:100%;">



                <div class="navbar-header">

                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#b-menu-1">

                    <span class="sr-only">Toggle navigation</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                  </button>


                </div>

                <div class="collapse navbar-collapse" id="b-menu-1" style="border-color:#6666CC;">

                  <ul class="nav navbar-nav navbar-left" style="margin-left:70px;">

  <?php
   if($_SESSION['usertype']=='Manager'){
		   ?>

		   <li><a href="dashbord_emp.php" style="text-decoration:none;">Dashboard</a></li>

		<?php
		   }
		   else{
	?>
     <li><a href="dashboard.php" style="text-decoration:none;">Dashboard</a></li>
    <?php
	 }
	 ?>
       <?php
   if($_SESSION['usertype']=='Manager'){
		   ?>

		<?php
		   }
		   else{
	?>
    <?php /*?> <li><a href="allstudentlist.php" style="text-decoration:none;">Other list</a></li><?php */?>
    <?php
	 }
	 ?>




   <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Logs</a>
   <ul class="dropdown-menu">
   <li><a href="teacher_profile_points.php">Rewards Log</a></li>
    <li><a href="soft_reward.php"> soft Rewards Log</a></li>
					<li><a href="sharebluepointlog.php">My Shared Points</a></li>
					<li><a href="teacher_blue_pointlog.php">My ThanQ Points</a></li>
                    <li><a href="#">My Blue Points</a></li>
					<ul><li><a href="used_point.php"> Used  thanq Points log</a></li>
                    <li><a href="earn_blue_point.php">Points provide by admin friend ,parent and student</a></li></ul>
                     <li><a href="#">My Green Points </a></li>
					<ul><li><a href="teacher_profile_points.php">Used Green Points log</a></li>
                 <li><a href="earn_green_point.php">Green point given by school admin</a></li>  </ul>
				 <li><a href="#">My Brown Points </a></li>
					<ul><li><a href="earned_brown_points.php">Earned Brown Points log</a></li></ul>
             </ul>


   </li>





               <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Coupons</a>
              <ul class="dropdown-menu">
					<li><a href="coupons.php">Select Coupons</a></li>
					<li><a href="cart.php">My Cart</a></li>
					<li><a href="view_print_coupons.php">Unused Coupons</a></li>
					<li><a href="used_vendor_coupons.php">Used Coupons</a></li>
             </ul>
			</li>

<li> <a href="bluepoint_generate_coupon.php" style="text-decoration:none;">Generate Coupon</a></li>
<li><a href="#"  class="dropdown-toggle" data-toggle="dropdown">Other Activities</a>

             <ul class="dropdown-menu">
               <?php

					  $arr1=mysql_query("select stud_id1 as stud_id,requestdate,points,reason from tbl_request where stud_id2='$t_id' and flag='N' and entitity_id='103'");
					  $count=mysql_num_rows($arr1);
					  ?>
 <?php /*?> <li><a href="add_teachsubject.php" style="text-decoration:none">Add <?php echo ($_SESSION['usertype']=='Manager')? 'Projects':'Subjects';?></a></li><?php */?>


  <li><a href="teachermysubjectlist.php" style="text-decoration:none">My <?php echo $dynamic_subject;?></a></li>
  <?php /*?> <li><a href="teachermysubjectlist.php" style="text-decoration:none">My Subject</a></li>
  <?php */?>
              <li><a href="share_blue_points.php" style="text-decoration:none">Share Points</a></li>

              <li><a href="teacher_soft_reward.php" style="text-decoration:none"> Soft Reward</a></li>
                <li><a href="purchased_water_point.php" style="text-decoration:none"> Purchase Water Point</a></li>
               <li><a href="add_subject_J.php" style="text-decoration:none">Add <?php echo $dynamic_teacher.' '.$dynamic_subject;?></a></li>





                     <li><a href="student_coordinator_list.php" style="text-decoration:none;">Coordinator List</a>
					 <li><a href="form.php" style="text-decoration:none;">Request to join smartcookie</a>
                     <li><a href="requestlist_fromstudents.php" style="text-decoration:none;">Requests from <?php echo $dynamic_student.'s';?><span class="badge"><?php echo $count;?></span></a>

                  </li>
                   <?php

					  $arr1=mysql_query("select stud_id1 as stud_id,requestdate,points,reason,activity_type from tbl_request where stud_id2='$t_id' and flag='N' and entitity_id='117' and school_id='$school_id' order by id desc");
					  $count=mysql_num_rows($arr1);
					  ?>
          <?php
   if($_SESSION['usertype']=='Manager'){
		   ?>



		<?php
		   }
		   else{
	?>
    <li><a href="requestlist_fromstudentsforconection.php" style="text-decoration:none;">Requests from  other <?php echo $dynamic_student.'s'?><span class="badge"><?php echo $count;?></span></a>

                  </li>
    <?php
	 }
	 ?>

                   <?php

					  $arr2=mysql_query("select stud_id1 as stud_id,requestdate,points,reason from tbl_request where stud_id2='$id' and flag='N' and entitity_id='112'");
					  $count2=mysql_num_rows($arr2);
					  ?>

                   <li><a href="coordinatorrequest_fromstudent.php" style="text-decoration:none;">Requests For Coordinator<span class="badge"><?php echo $count2;?></span></a>

                  </li>
                  </ul></li>

<li><a href="#"  class="dropdown-toggle" data-toggle="dropdown">Sponsors</a>
             <ul class="dropdown-menu">
                      <li><a href="teacher_sponsor_map.php"><?php echo ($_SESSION['usertype']=='Manager')? 'Organization':'School';?> & Sponsor Map</a></li>
                      <li><a href="vendor_suggested_like.php">Suggest Sponsor</a></li>
              </ul></li>

 <?php
   if($_SESSION['usertype']=='Manager'){
		   ?>


		<?php
		   }
		   else{
	?>
    <li><a href="top10_stud_teacher.php" style="text-decoration:none;">Leaderboard</a></li>

    <?php
	 }
	 ?>
            <?php
   if($_SESSION['usertype']=='Manager'){
		   ?>

		   <li><a href="teacher_profile.php" style="text-decoration:none;">My Profile</a></li>

		<?php
		   }
		   else{
	?>
     <li><a href="teacher_profile.php" style="text-decoration:none;">My Profile</a></li>
    <?php
	 }
	 ?>
            <li><a href="dashboardlist.php" style="text-decoration:none;">Search
			<?php echo $dynamic_student;?></a></li>
			 <li><a href="searchallstudent.php" style="text-decoration:none;">Search All
			<?php echo $dynamic_student;?></a></li>
               </div>


            </div>
   <?php
              //echo "select tc_balance_point form tbl_teacher where school_id=$school_id AND t_id='$t_id'";

           $sql=mysql_query("SELECT tc_balance_point,tc_used_point,balance_blue_points,used_blue_points,water_point,brown_point FROM tbl_teacher WHERE school_id ='$school_id' AND t_id = '$t_id'");
			       $result=mysql_fetch_array($sql);
				            $used_points=$result['tc_used_point'];
							 $water_point=$result['water_point'];
					    	$distrubution_point=$result['tc_balance_point'];
							//$broun_point=$result['used_blue_points'];
						   /* $water_point=0;*/
							$broun_point=$result['brown_point'];;
							$ThnQ_point=$result['balance_blue_points'];
   ?>
<div class="container" style="padding-top:5px;">
<div class="row">
<div class="col-md-3">
<a href="teacher_profile_points.php" style="text-decoration:none;"><div class="panel panel-success" style="background-color:#3DBD2F">
  <div class="panel-heading" style="background-color:3DBD2F; border-color:3DBD2F">
  <h3 class="panel-title" style="color:#FFFFFF;">
  <table>
  <tr>
  <td> <span style="color:#fff !important;">For Distribution :</span></td><td> <span style="color:#fff !important;"><?php echo $distrubution_point;?></span></td></tr></table></h3>
  </div>

</div></a>
</div>

<div class="col-md-3">
<a href="teacher_blue_pointlog.php" style="text-decoration:none;"><div class="panel panel-primary">
<div class="panel-heading" style="background-color:#203CB6;border-color:#203CB6;">
<h3 class="panel-title" >
<table>
  <tr><td>ThanQ Points : </td><td>
<?=$ThnQ_point ?></td></tr></table></h3></div>
</div></a>

</div>


<div class="col-md-3">
<div class="panel panel-default">
  <div class="panel-heading brwon-clr" style="background-color:#7C3826;border-color:#7C3826;">
<h3 class="panel-title" >
<table>
  <tr><td> Brown Points : </td><td> <?php echo $broun_point;?></td></tr></table></h3>
  </div>

</div>
</div>


<div class="col-md-3">
<div class="panel panel-warning">
  <div class="panel-heading" style="background-color:#D4EFFF;border-color:#D4EFFF;">
    <h3 class="panel-title"  style="color:#000000;"><table>
  <tr><td>Water Points : </td><td><?php echo $water_point;?></td></tr></table></h3>
  </div>

</div>
</div>
</div>
</div>
           </body>
