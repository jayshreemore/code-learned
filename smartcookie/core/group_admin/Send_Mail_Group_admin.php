<?php
/**
 * Created by PhpStorm.
 * User: Bpsi-Rohit
 * Date: 9/24/2017
 * Time: 12:40 PM
 */
error_reporting(0);
include("groupadminheader.php");
/*$id = $_SESSION['id'];
$query = "select * from `tbl_school_admin` where id='$id'";       // uploaded by
$row1 = mysql_query($query);
$value1 = mysql_fetch_array($row1);
$uploaded_by = $value1['name'];
$smartcookie = new smartcookie();*/
/*$id=$_SESSION['id']; */
/*$fields = array("id" => $id);*/
/*$table="tbl_school_admin";*/
/*$smartcookie = new smartcookie();
$results = $smartcookie->retrive_individual($table, $fields);
$result = mysql_fetch_array($results);
$sc_id = $result['school_id'];*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo "http://".$server_name.'/css/jquery.dataTables.css';?>">
    <link rel="stylesheet" href="<?php echo "http://".$server_name.'/css/bootstrap.min.css';?>">
    <script src="<?php echo "http://".$server_name.'/js/jquery-1.11.1.min.js';?>"></script>
    <script src="<?php echo "http://".$server_name.'/js/jquery.dataTables.min.js';?>"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.cs">
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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Smart Cookie:Send SMS/EMAIL</title>
    <style>
        .dropdown1 {
            padding-left: 460px;
            margin-top: 15px;
        }
        .dropdown2 {
            padding-left: 500px;
            margin-top: 15px;
        }
    </style>
</head>
<script>
    $(document).ready(function () {
        $('#example').dataTable({});
    });
    function confirmEmail(Status,school_id,email,name) {
        //alert(email);return false;
        if (Status == 'Send_Email') {
            var answer = confirm("Are you sure,do you want to resend Email");
            if (answer) {
                window.location = "SendEmail_group_admin.php?email="+email+"&school_id="+school_id+"&name="+name;
            }
            else {
            }
        } else {
            window.location = "SendEmail_group_admin.php?email="+email+"&school_id="+school_id+"&name="+name;
        }
    }

    function confirmSMS(phone,school_id,Status,country) {
        if(Status=='Send_SMS'){
            var answer = confirm("Are you sure,do you want to resend SMS");
            if (answer) {
                window.location = "Send_SMS_group_admin.php?phone="+phone+"&school_id="+school_id+"&Status="+Status+"&country="+country;
            }
            else {
            }
        }else{
            window.location = "Send_SMS_group_admin.php?phone="+phone+"&school_id="+school_id+"&Status="+Status+"&country="+country;
        }
    }


</script>
<body bgcolor="#CCCCCC">
<div style="bgcolor:#CCCCCC">
    <div class="container" style="padding:30px;width:1500px">
        <div style="border:1px solid #CCCCCC; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4;">
            <div style="background-color:#F8F8F8 ;">
                <div class="row">
                    <div class="col-md-3 " style="color:#700000 ;padding:5px;">&nbsp;&nbsp;&nbsp;&nbsp;
                        <!--<a href="teacher_setup.php">   <input type="submit" class="btn btn-primary" name="submit" value="Add Teacher" style="width:150;font-weight:bold;font-size:14px;"/></a>-->
                    </div>
                    <div class="col-md-6 " align="center">
                        <h2>&nbsp&nbsp&nbsp&nbspSend Email to School Admin</h2>
                    </div>
                </div>
                <!--<div class="row">
                    <div class="col-md-4">
                        <div class="dropdown1">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">Send SMS/ Email to Students<span class="caret"></span></button>
                            <ul style='margin-left:600px' class="dropdown-menu " role="menu" aria-labelledby="dropdownMenu1">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="Send_Msg_Teacher.php">TEACHERS</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="Send_Msg_Student.php">STUDENTS </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>-->
                <!--<div class="col-md-4">
                    <div class="dropdown2">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="true">Batch ID's<span class="caret"></span></button>
                        <?php /*$sql1 = mysql_query("Select DISTINCT(batch_id) as batch_id,school_id,send_unsend_status,std_country from tbl_student where school_id='$sc_id' group by batch_id"); */?>
                        <ul class="dropdown-menu " role="menu" aria-labelledby="dropdownMenu2">
                            <?php /*while ($row = mysql_fetch_array($sql1)){ */?>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="SendMSG_allbatch_Student.php?batch_id=<?php /*echo $row['batch_id']; */?>&school_id=<?php /*echo $row['school_id']; */?>&status=<?php /*echo $row['send_unsend_status']; */?>&country=<?php /*echo $row['std_country']; */?>"><?php /*echo $row['batch_id']; */?><?php /*} */?> </a>
                            </li>
                        </ul>
                    </div>
                </div>-->
                <div class="row" style="padding:10px;">
                    <div class="col-md-12  " id="no-more-tables">
                        <?php $i = 0; ?>
                        <table class="table-bordered  table-condensed cf" style="border: 1px solid #ccc;" id="example" width="100%;">
                            <thead>
                            <tr style="background-color:#428BCA">
                                <th style="width:10%;"><b>Sr.No</b></th>
                                <th style="width:20%;"><b>Admin Name</b></th>
                                <th style="width:20%;">School Name.</th>
                                <th style="width:20%;">Email ID</th>
                                <th style="width:20%;">Mobile</th>
                                <th style="width:10%;">EMAIL Status</th>
                                <th style="width:10%;">SMS Status</th>
                                <th style="width:10%;">TimeStramp(SMS/Email)</th>
                                <th style="width:20%;">Send Email</th>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            $arr = mysql_query("select * from tbl_school_admin where group_status='$group_name' order by id"); ?>
                            <?php while ($row = mysql_fetch_array($arr)) {
                            $teacher_id = $row['id'];
                            ?>
                            <tr style="color:#808080;" class="active">
                                <td data-title="Sr.No" style="width:4%;"><b><?php echo $i; ?></b></td>
                                <td data-title="Teacher ID" style="width:6%;"><b><?php echo $row['name']; ?></b></td>
                                <td data-title="Name" style="width:12%;"><?php echo $row['school_name'];?></td>
                                <td data-title="Phone" style="width:8%;"><?php echo $row['email']; ?> </td>
                                <td data-title="Phone" style="width:6%;"><?php echo $row['mobile']; ?> </td>
                                <td data-title="Phone" style="width:5%;"><?php
                                    if ($row['email_status'] == 'Send_Email') {
                                    echo 'Email sent';
                                    } elseif ($row['email_status'] == 'Unsend') {
                                    echo 'Unsent';
                                    }
                                    ?> </td>
                                <td data-title="Send/Unsen Status" style="width:5%;"><?php
                                    if ($row['send_sms_status'] == 'Send_SMS') {
                                    echo 'SMS sent';
                                    } elseif ($row['send_sms_status'] == 'Unsend') {
                                    echo 'Unsent';
                                    }
                                    ?> </td>
                                <td><?php echo "SMS :".$row['sms_time_log']."<br>Email :".$row['email_time_log'];?></td>
                                <td data-title="Phone" style="width:10%;">
                                    <a onclick="confirmSMS( '<?php echo $row['mobile']; ?>','<?php echo $row['school_id']; ?>','<?php echo $row['send_sms_status'];?>','<?php echo $row['scadmin_country']; ?>');"><img src="<?php echo "http://".$server_name.'/core/images/S.png';?>"></a>
                                    <a onclick="confirmEmail('<?php echo $row['email_status'];?>','<?php echo $row['school_id']; ?>','<?php echo $row['email']; ?>','<?php echo $row['name']; ?>');" ><img src="<?php echo "http://".$server_name.'/core/images/E.png';?>"></a>
                                </td>
                            </tr>
                            <?php $i++;?>
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
















