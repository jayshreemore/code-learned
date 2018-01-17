<?php
include('cookieadminheader.php');
?>

<!DOCTYPE>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="utf-8">
    <title>Smart Cookies</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
    <script>
        $(document).ready(function () {
            $('#example').dataTable({});
        });
    </script>
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
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
           /*Label the data*/
            #no-more-tables td:before {
                content: attr(data-title);
            }
        }
    </style>
</head>
<body>

<div style="bgcolor:#CCCCCC">
    <div class="" style="padding:30px;">
        <div style="border:1px solid #CCCCCC; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4;">
            <div style="background-color:#F8F8F8 ;">
                <div class="row">
                    <div class="col-md-0 " style="color:#700000 ;padding:5px;">&nbsp;&nbsp;&nbsp;&nbsp;
                        <!-- <a href="Add_degree.php"> <input type="submit" class="btn btn-primary" name="submit" value="Add Degree" style="font-weight:bold;font-size:14px;"/></a>      -->
                    </div>

                    <div class="col-md-10 " align="center">

                        <h2>Login Status </h2>

                    </div>


                </div>

                <div class="row" style="padding:10px;">

                    <div class="col-md-12  " id="no-more-tables">

                        <table id="example" class="display" width="100%" cellspacing="0">
                            <thead>
                            <th>Sr. No.</th>
                            <th>log track no</th>
                            <th>Name</th>
                            <th>Entity Type/SchoolID</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            
                            <!--<th>FirstLoginTime</th>
                            <th>FirstMethod</th>
                            <th>FirstDeviceDetails</th>
                            <th>FirstPlatformOS</th>
                            <th>FirstIPAddress</th>
                            <th>FirstLatitude</th>
                            <th>FirstLongitude</th>
                            <th>FirstBrowser</th>-->
                            <th>Login Time</th>
                            <th>Logout Time</th>
                            <!--<th>LatestMethod</th>-->
                            <th>Device Details</th>
                            <th>Platform OS</th>
                            <th>IP Address</th>
                            <!--<th>LatestLatitude</th>
                            <th>LatestLongitude</th>-->
                           <!-- <th>Browser</th>-->

                            <!--<th>CountryCode</th> -->
                            </thead>

                            <tbody>
                            <?php
                            $i = 1;
                            $table = "";
                            $ent_type = "";
                            $name = "";
                            function checkEntity($entity)
                            {
                                $data = array();
                                switch ($entity) {
                                    case 105:
                                        $data['table'] = "tbl_student";
                                        $data['ent_type'] = "STUDENT";
                                        $data['name'] = "std_complete_name";
                                        $data['fname'] = "std_name";
                                        $data['mname'] = "std_Father_name";
                                        $data['lname'] = "std_lastname";
                                        break;
                                    case 103:
                                        $data['table'] = "tbl_teacher";
                                        $data['ent_type'] = "TEACHER";
                                        $data['name'] = "t_complete_name";
                                        $data['fname'] = "t_name";
                                        $data['mname'] = "t_middlename";
                                        $data['lname'] = "t_lastname";
                                        break;
                                    case 108:
                                        $data['table'] = "tbl_sponsorer";
                                        $data['ent_type'] = "SPONSOR";
                                        $data['name'] = "sp_name";
                                        break;
                                    case 116:
                                        $data['table'] = "tbl_salesperson";
                                        $data['ent_type'] = "SALESPERSON";
                                        $data['name'] = "p_name";
                                        break;
									case 113:
                                        $data['table'] = "tbl_cookieadmin";
                                        $data['ent_type'] = "cookieadmin";
                                        $data['name'] = "admin_email";
                                        break;
									case 102:
                                        $data['table'] = "tbl_school_admin";
                                        $data['ent_type'] = "schooladmin";
                                        $data['name'] = "name";
                                        break;
									case 115:
                                        $data['table'] = "tbl_school_adminstaff";
                                        $data['ent_type'] = "schooladminstaff";
                                        $data['name'] = "stf_name";
                                        break;
									case 114:
                                        $data['table'] = "tbl_cookie_adminstaff";
                                        $data['ent_type'] = "cookieadminstaff";
                                        $data['name'] = "stf_name";
                                        break;
									case 106:
                                        $data['table'] = "tbl_parent";
                                        $data['ent_type'] = "parent";
                                        $data['name'] = "Name";
                                        break;

                                }
                                return $data;
                            }

                            $sql = "SELECT `RowID`,`EntityID`,`Entity_type`,`LatestLoginTime`,`LogoutTime`,`LatestMethod`,`LatestDeviceDetails`,`LatestPlatformOS`,`LatestIPAddress`,`LatestBrowser`,`school_id`,`LatestLatitude`,`LatestLongitude` FROM `tbl_LoginStatus` ORDER BY RowID DESC ";
                            $query = mysql_query($sql);
                            while ($row = mysql_fetch_assoc($query)) {
                                $data = checkEntity($row['Entity_type']);
                                 $entity_type = $data['ent_type'];
                                if($entity_type=='STUDENT' || $entity_type=='TEACHER' ){
                                    $sql1 = "SELECT " . $data['name'] . " as name," . $data['fname'] . " as f," . $data['lname'] . " as l from " . $data['table'] . " WHERE id='" . $row['EntityID'] . "'";
                                }elseif($entity_type=='SPONSOR'){
                                    $sql1 = "SELECT " . $data['name']." as name from ".$data['table'] . " WHERE id='" . $row['EntityID'] . "'";
                                }elseif($entity_type=='SALESPERSON'){
                                    $sql1 = "SELECT " . $data['name']." as name from ".$data['table'] . " WHERE person_id='" . $row['EntityID'] . "'";
                                }
								elseif($entity_type=='cookieadmin'){
                                    $sql1 = "SELECT " . $data['name']." as name from ".$data['table'];
                                }
								elseif($entity_type=='schooladmin'){
                                    $sql1 = "SELECT " . $data['name']." as name from ".$data['table'] . " WHERE id='" . $row['EntityID'] . "'";
                                }
								elseif($entity_type=='schooladminstaff'){
                                    $sql1 = "SELECT " . $data['name']." as name from ".$data['table'] . " WHERE id='" . $row['EntityID'] . "'";
                                }
								elseif($entity_type=='cookieadminstaff'){
                                    $sql1 = "SELECT " . $data['name']." as name from ".$data['table'] . " WHERE id='" . $row['EntityID'] . "'";
                                }
								elseif($entity_type=='parent'){
                                    $sql1 = "SELECT " . $data['name']." as name from ".$data['table'] . " WHERE id='" . $row['EntityID'] . "'";
                                }
								
                                $q = mysql_query($sql1);
                                $row1 = mysql_fetch_array($q);

                                ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $row['RowID']; ?></td>
                                    <td><?php if ($row1['name'] != "") {
                                            echo strtoupper($row1['name']);
                                        }else {
                                            echo strtoupper($row1['f']) . " " . strtoupper($row1['l']);
                                        } ?></td>
                                    <td><?php echo $entity_type;echo "<br>"; if($row['school_id']!=''){echo '('.$row['school_id'].')';}else{}?></td>
                                    <td>
                                        <a href="loginlogout_status_details.php?lat=<?php echo $row['LatestLatitude'];?>&long=<?php echo $row['LatestLongitude'];?>">
                                            <?php if($row['LatestLatitude']!=''){echo $row['LatestLatitude'];}else{} ?>
                                        </a>
                                    </td>

                                    <td><a herf="loginlogout_status_details.php?lat=<?php echo $row['LatestLatitude'];?>&long=<?php echo $row['LatestLongitude'];?>"><?php if($row['LatestLongitude']!=''){echo $row['LatestLongitude'];}else{}  ?></a></td>
                                    <td><?php echo $row['LatestLoginTime']; ?></td>
                                    <td><?php if ($row['LogoutTime'] != "") {
                                            echo $row['LogoutTime'];
                                        } else {
                                            echo "<div style='color:#694489'>Running</div>";
                                        } ?></td>
                                    <!--<td><?php echo $row['LatestMethod']; ?></td>  -->
                                    <td><?php echo $row['LatestDeviceDetails']; ?></td>
                                    <td><?php echo $row['LatestPlatformOS']; ?></td>
                                    <td><?php echo $row['LatestIPAddress']; ?></td>
                                    <!--<td><?php //echo $row['LatestBrowser']; ?></td>-->
                                </tr>

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