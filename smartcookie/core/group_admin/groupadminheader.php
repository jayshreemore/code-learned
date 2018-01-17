<?php
$server_name=$_SERVER['SERVER_NAME'];

include("/../conn.php");
session_start();
if(isset($_SESSION['entity']))
{
    $entity = $_SESSION['entity'];
    if($entity==12)
    {
        if(!isset($_SESSION['group_admin_id']))
        {
            header('location:login.php');
        }
        $id=$_SESSION['id'];
        $grouadmindata=$_SESSION['data'];
        $grouadmindata=$grouadmindata[0];
        $group_name=$grouadmindata['status'];
        $staff_name ="Group Admin";
        $name = "Group Admin";
        $flag = true;
    }
}
?>
<!DOCTYPE html >
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8">
    <title>Smart Cookies</title>
    <link rel="stylesheet" href="<?php echo "http://".$server_name.'/core/css/bootstrap.min.css';?>">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="<?php echo "http://".$server_name.'/core/js/bootstrap.min.js';?>" type='text/javascript'></script>
    <style>
        .carousel
        {
            height: 300px;
            margin-bottom: 50px;
        }
        .carousel-caption
        {
            z-index: 10;
        }
        .carousel .item {
            background-color: rgba(0, 0, 0, 0.8);
            height: 300px;
        }

        .navbar-inverse .navbar-nav>li>a {
            color: #FFFFFF;
            font-weight:bold;
        }
        .navbar-inverse{

            border-color:#FFFFFF;
        }
        .my_dropdown-content {
            display: none;
            position: absolute;
            top:320px;
            left:180px;
            background-color: #f9f9f9;
            min-width: 100%;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
        .my_dropdown-content a {
            color: black;
            padding: 5px 5px;
            text-decoration: none;
            display: block;
        }
        .my_dropdown:hover .my_dropdown-content {
            display: block;
        }
    </style>
</head>

<body background="#999999">
<!-- header-->
<div class="container-fluid" align="center" >
    <div class="row">
        <div class="col-md-2" style="float:left; padding:20px;padding-left:20px; font-size:21px; font-weight:bold;"><img src="<?php echo "http://".$server_name.'/core/images/logo.png';?>" class="img-responsive">
        </div>
        <div  class="col-md-5" style=" padding:5px;" align="center">
            <h1 style="color:#666666;font-weight:bold;font-family:"Times New Roman", Times, serif;"><?php echo $name; ?></h1>
        </div>
        <div class="col-md-2" style="padding-right:10px;" >
        </div>
        <div class="col-md-3">
            <div class="row" style="height:25px;background-color:#694489; padding-top:5px; background-color:; border-radius: 3px 3px 5px 5px; margin-bottom:10px; margin-top:-2px; color:#FFFFFF; font-size:12px;">Welcome <?php echo $staff_name; ?> | <a href="/../core/logout.php" style="text-decoration:none; color:#FFFFFF;">Sign Out</a>&nbsp;
            </div>
        </div>
        <div style="font-weight:bold;font-size:12px;"></div>
        <div  class="row" style="font-size:12px;height:30px;">
        </div>
        <div class="row" style="padding-right:10px;  font-weight:bold;font-size:12px;">
        </div>
    </div>
</div>
<div class=" navbar-inverse" role="navigation" style="background-color:#694489;width:100%;">
    <div class="container" >
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#b-menu-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="b-menu-1" style="border-color:#694489;">
            <ul class="nav navbar-nav navbar-right">
                    <li><a href="home_groupadmin.php" style="text-decoration:none";>Home</a></li>
                    <li><a class="dropdown-toggle" data-toggle="dropdown" href="#">Master</a>
                        <ul class="dropdown-menu">
                                <li><a href="club.php">Club</a></li>
                                <li><a href="cookie_list_school.php">Edit Club Info </a></li>
                                <li><a href="bluepoints.php">Blue Points</a></li>
                                <li><a href="greenpoints.php">Green Points</a></li>
                                <li><a href="System_level_activity.php">Activity</a></li>
                                <li><a href="System_level_activity_type.php">Activity Type</a></li>
                                <li><a href="softrewardslist.php">Soft Rewards</a></li>
                                <li><a href="thanqyou.php">ThanQ List</a></li>
                                <li><a href="student_reason.php">Beneficiary Recognization</a></li>
                                <li><a href="edit_categories_currencies.php">Categories & Currencies</a></li>
                                <li><a href="Send_Mail_Group_admin.php">SMS Email Sending</a></li>
                               <!-- <li class='my_dropdown'><a href="#">Rule Engine</a>
                                    <ul class="my_dropdown-content">
                                        <a href="admin_rule_engine.php">School Rule Engine</a>
                                        <a href="referal_activity_rule_engine.php">Referral Activity Rule Engine</a>
                                    </ul>`
                                </li>-->
                        </ul>
                    </li>
                    <li><a href="cookieadmin_school_sponsor_map.php" style="text-decoration:none";>Map</a></li>
                    <!--<li><a href="generatecoupon.php" style="text-decoration:none";>Gift Card</a></li>-->
                    <!--<li><a class="dropdown-toggle" data-toggle="dropdown"  href="#">Colleges</a>
                        <ul class="dropdown-menu">
                            <li><a href="colleges.php">All India College List</a></li>
                            <li><a href="college_list_DTE.php">DTE College List</a></li>
                        </ul>
                    </li>-->
                    <li><a class="dropdown-toggle" data-toggle="dropdown"  href="#">Sponsor</a>
                        <ul class="dropdown-menu">
                                <li><a href="sponsor_list.php">Registered Sponsors</a></li>
                                <li><a href="sponsor_profile_summery.php">Sponsor Profile Summery</a></li>
                                <li><a href="vendors_suggested.php">Suggested</a></li>
                                <li><a href="sponsor_sponsored.php">Location & Coupons</a></li>
                                <li><a href="stats.php">Statistics</a></li>
                        </ul>
                    </li>
                   <!-- <li><a href="socialfootprint.php" style="text-decoration:none";>Social Footprint</a></li>-->
                    <li><a class="dropdown-toggle" data-toggle="dropdown"  href="#">Log</a>
                        <ul class="dropdown-menu">
                            <li><a href="softrewardlog.php">Soft Reward Log</a></li>
<!--                            <li><a href="loginStatusCookie.php">Login Status</a></li>-->
                            <li><a href="assigned_green_points_log.php">Green Points Assigned Log</a></li>
                            <li><a href="assigned_blue_points_log.php">Blue Points Assigned Log</a></li>
                            <li><a href="blue_coupon_log.php">Blue Points Coupon Issued Log</a></li>
                            <li><a href="green_coupon_log.php">Green Points Coupon Issued Log</a></li>
                            <li><a href="water_coupon_log.php">Water Points Coupon Issued Log</a></li>
                            <li><a href="coupon_log.php">Used Coupon Log For Teacher</a></li>
                            <li><a href="used_coupon_log_student.php">Used Coupon Log For Student</a></li>
                            <li><a href="accepted_log.php">Accepted Coupon Log </a></li>
                            <li><a href="use_vervder_coupon_for_teacher.php">Used  Vendor Coupon Log  For Teacher  </a></li>
                            <li><a href="use_vervder_coupon_for_student.php">Used  Vendor Coupon Log  For Student  </a></li>
                            <li><a href="master_action_log.php">Master Action Log Layout </a></li>
                        </ul>
                    </li>
                    <li><a href="top10_stud_cookieadmin.php">Leaderboard</a></li>
<!--                    <li><a href="saleperson_summary.php" style="text-decoration:none";>Report</a></li>-->
            </ul>
        </div>
    </div>
</div>
</body>
</html>
