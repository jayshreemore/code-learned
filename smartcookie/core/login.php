<?php
$report = "";
$LoginOption = "EmailID";
$EmailID = "";
$OrganizationID = "";
$EmployeeID = "";
$CountryCode = "";
$PhoneNumber = "";
$Password = "";
$entity = 0;
$user = '';
$lat = '';
$lon = '';
session_start();
$index_url = 'http://' . $_SERVER['HTTP_HOST'];
require 'conn.php';
require 'getBrowser.php';

if (isset($_POST['entity'])) {
    $a = array('1', '2', '5', '6', '7', '8', '9', '10', '11', '12');
    if (!in_array($_POST['entity'], $a)) {
        header("Location: $index_url");
    }
} else {
    header("Location: $index_url");
}
function entity_type($entity)
{
    $index_url = 'http://' . $_SERVER['HTTP_HOST'];
    switch ($entity) {
        case 1:
            $user = 'School Admin';
            break;
        case 2:
            $user = 'Teacher';
            break;
        case 10:
            $user = 'Manager';
            break;
        case 5:
            $user = 'Parent';
            break;
        case 6:
            $user = 'Cookie Admin';
            break;
        case 8:
            $user = 'Cookie Admin Staff';
            break;
        case 7:
            $user = 'School Admin Staff';
            break;
        case 9:
            $user = 'Sales Person';
            break;
        case 11:
            $user = 'HR Admin';
            break;
        case 12:
            $user = 'Group Admin';
            break;
        default:
            $user = '';
            header("Location: $index_url");
            break;
    }
    return $user;
}

function upcartonlogin($entity, $id, $rid, $school_id)
{
    if ($entity == 2 or $entity == 10) {
        //teacher
        $get_points = mysql_query("select * from `tbl_teacher` where id ='$id'");
        $pts1 = mysql_fetch_array($get_points);
        $pts_blue = $pts1['balance_blue_points'];
        //$pts_yellow=$pts1['yellow_points'];
        //$pts_purple=$pts1['purple_points'];
        //$pts=$pts_green+$pts_yellow+$pts_purple;
        $pts = $pts_blue;
        //$q="true";
    }
    if ($entity == 5) {
        //parent
        /* $get_points= mysql_query("select sc_total_point,yellow_points,purple_points from `tbl_student_reward` where sc_stud_id = $id");
            $pts1=mysql_fetch_array($get_points);
            $pts_green=$pts1['sc_total_point'];
            $pts_yellow=$pts1['yellow_points'];
            $pts_purple=$pts1['purple_points'];
            $pts=$pts_green+$pts_yellow+$pts_purple;	 */
    }
    //$p=mysql_query("DELETE FROM `cart` WHERE `entity_id`= $entity and `user_id`=$id ");
    $r = @mysql_query("select id from cart where entity_id='2' and user_id='$id' and coupon_id is null");
    if (@mysql_num_rows($r)) {
        $q = mysql_query("update `cart` set `timestamp`=CURRENT_TIMESTAMP, `available_points`='$pts' where entity_id='2' and user_id='$id' and coupon_id is null");
    } else {
        $q = mysql_query("INSERT INTO `cart` (`id`, `entity_id`, `user_id`, `coupon_id`, `for_points`, `timestamp`, `available_points`) VALUES (NULL, '2', \"$id\", NULL, NULL, CURRENT_TIMESTAMP, \"$pts\" )");
    }

    if ($q) {
        return true;
    } else {
        return false;
    }
}

function setLoginLogoutStatus($TblEntityID, $UserID, $lat, $lon, $CountryCode)
{
    /*`RowID`, `EntityID`, `Entity_type`, `FirstLoginTime`, `FirstMethod`, `FirstDevicetype`, `FirstDeviceDetails`, `FirstPlatformOS`, `FirstIPAddress`, `FirstLatitude`, `FirstLongitude`, `FirstBrowser`, `LatestLoginTime`, `LatestMethod`, `LatestDevicetype`, `LatestDeviceDetails`, `LatestPlatformOS`, `LatestIPAddress`, `LatestLatitude`, `LatestLongitude`, `LatestBrowser`, `LogoutTime`, `CountryCode`, `school_id`
    SELECT * FROM `tbl_LoginStatus` WHERE 1*/

    /*$geocode=file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lon&sensor=false");

    $output= json_decode($geocode);
    for($j=0;$j<count($output->results[0]->address_components);$j++){
                    if($output->results[0]->address_components[$j]->types[0]=='country')
                    {
                        $calculated_country = $output->results[0]->address_components[$j]->long_name;
                        break;
                    }
                }
    if($calculated_country=='India')
    {
        date_default_timezone_set("Asia/Calcutta");
            $date = date("Y-m-d h:i:s A");
    }
    elseif($calculated_country=='United States')
    {
        date_default_timezone_set("America/Boa_Vista");
            $date = date("Y-m-d h:i:s A");
    }*/


    global $OrganizationID;
    $school_id = $OrganizationID;

    $details = getBrowser();
    $browsername = $details['name'];
    $browserdetails = $details['name'] . " " . $details['version'];
    $date = date("Y-m-d h:i:s");
    $ip = getIP();
    $os = getOS();

    //$date=date('Y-m-d H:i:s');
    $_SESSION['login_UserID'] = $UserID;
    $_SESSION['login_TblEntityID'] = $TblEntityID;
    //$_SESSION['calculated_country']=$calculated_country;

    //echo "select * from `tbl_LoginStatus` where EntityID='$UserID' and Entity_type='$TblEntityID' ORDER BY `RowID` DESC  limit 1";//echo "</br>";

    $arr = mysql_query("select * from `tbl_LoginStatus` where EntityID='$UserID' and Entity_type='$TblEntityID' ORDER BY `RowID` DESC  limit 1");
    $result_arr = mysql_fetch_assoc($arr);

    if (mysql_num_rows($arr) == 0) {
        $LoginStatus = mysql_query("insert into tbl_LoginStatus (EntityID,  Entity_type,  FirstLoginTime, FirstMethod, FirstDevicetype, FirstDeviceDetails, FirstPlatformOS,    FirstIPAddress, FirstLatitude, FirstLongitude, FirstBrowser,   LatestLoginTime,   LatestMethod, LatestDevicetype,  LatestDeviceDetails, LatestPlatformOS, LatestIPAddress, LatestLatitude, LatestLongitude, LatestBrowser, LogoutTime, CountryCode,   school_id)
	                                     values('$UserID','$TblEntityID','$date',		'web',             '',       '$os',    			'$os',       		'$ip',      	'$lat',   '$lon',   	'$browserdetails',   '$date',            'web',           '',          '$os',    		'$os',     			'$ip',      '$lat',     '$lon',   	'$browsername',   '',     '$CountryCode','$school_id')");


    } else {

        $LoginStatus = mysql_query("insert into tbl_LoginStatus (EntityID,  Entity_type,  FirstLoginTime, FirstMethod, FirstDevicetype, FirstDeviceDetails, FirstPlatformOS,    FirstIPAddress, FirstLatitude, FirstLongitude, FirstBrowser,   LatestLoginTime,   LatestMethod, LatestDevicetype,  LatestDeviceDetails, LatestPlatformOS, LatestIPAddress, LatestLatitude, LatestLongitude, LatestBrowser, LogoutTime, CountryCode,school_id)
	                                     values('" . $result_arr['EntityID'] . "','" . $result_arr['Entity_type'] . "','" . $result_arr['FirstLoginTime'] . "',		'" . $result_arr['FirstMethod'] . "',             '" . $result_arr['FirstDevicetype'] . "','" . $result_arr['FirstDeviceDetails'] . "',    			'" . $result_arr['FirstPlatformOS'] . "',       		'" . $result_arr['FirstIPAddress'] . "',      	'" . $result_arr['FirstLatitude'] . "',   '" . $result_arr['FirstLongitude'] . "',   	'" . $result_arr['FirstBrowser'] . "',   '$date',            'web',           '',          '$os',    		'$os',     			'$ip',      '$lat',     '$lon',   	'$browsername',   '',     '$CountryCode','$school_id')");

        if ($result_arr['LogoutTime'] == '') {
            $LoginStatus_old = mysql_query("update `tbl_LoginStatus` set LogoutTime='$date' where EntityID='$UserID' and Entity_type='$TblEntityID' and RowID=" . $result_arr['RowID'] . " ");
        }
    }
    if ($LoginStatus) {
        return true;
    } else {
        return false;
    }


    /*$sql=mysql_query("SELECT * FROM tbl_LoginStatus WHERE EntityID = '$UserID' AND Entity_type= '$TblEntityID' ")or die(mysql_error());

    if(mysql_num_rows($sql)>0){

        $q=mysql_query("update tbl_LoginStatus set calculated_country='$calculated_country',LatestLoginTime ='$date', LatestMethod ='web', LatestDevicetype='',LatestDeviceDetails='$os',LatestPlatformOS='$os',LatestIPAddress='$ip',LatestLatitude='$lat',LatestLongitude='$lon',LatestBrowser='$browserdetails' where EntityID = '$UserID' AND Entity_type= '$TblEntityID' ")or die(mysql_error());
    }
    else{

    $p="insert into tbl_LoginStatus (EntityID,  Entity_type,  FirstLoginTime, FirstMethod, FirstDevicetype, FirstDeviceDetails, FirstPlatformOS,    FirstIPAddress, FirstLatitude, FirstLongitude, FirstBrowser,   LatestLoginTime,   LatestMethod, LatestDevicetype,  LatestDeviceDetails, LatestPlatformOS, LatestIPAddress, LatestLatitude, LatestLongitude, LatestBrowser, LogoutTime, CountryCode,   school_id,calculated_country)
                                     values('$UserID','$TblEntityID','$date',		'web',             '',       '$os',    			'$os',       		'$ip',      	'$lat',   '$lon',   	'$browserdetails',   '$date',            'web',           '',          '$os',    		'$os',     			'$ip',      '$lat',     '$lon',   	'$browsername',   '',     '$CountryCode','$school_id','$calculated_country')";

        $q=mysql_query($p)or die(mysql_error());

    }
    if($q){
        return true;
    }else{
        return false;
    }*/
}


function setSessionAndForward($entity, $record, $lat, $lon, $CountryCode)
{
  
    $index_url = 'http://' . $_SERVER['HTTP_HOST'];
    if ($record[0]['TotalUser'] > 1) {
        mysql_query("insert into `tbl_error_log` (`id`, `error_type`, `error_description`, `data`, `datetime`, `user_type`, `last_programmer_name`) values(NULL, 'More Than 1 User', 'Login.php', '$record', CURRENT_TIMESTAMP, '$entity', 'Sudhir')");
        echo "Unexpected Error Occured With Error Code: " . mysql_insert_id();
        header("Refresh: 20; url=http://beta.smartcookie.in");

    }

    switch ($entity) {
        case 1:
            $user = 'School Admin';
            setcookie('usertype', 'SchoolAdmin');
            $_SESSION['school_admin_id'] = $record[0]['id'];
            $_SESSION['id'] = $record[0]['id'];
            setLoginLogoutStatus(102, $record[0]['id'], $lat, $lon, $CountryCode);
            $_SESSION['school_id'] = $record[0]['school_id'];
            $_SESSION['school_type'] = $record[0]['group_status'];
            $_SESSION['entity'] = 1;
            $_SESSION['usertype'] = 'School Admin';
            $_SESSION['username'] = $record[0]['email'];
            header("Location:scadmin_dashboard.php");
            break;
        case 2:
            $user = 'Teacher';
           // echo $_COOKIE[$cookie_name];
            if (!isset($_COOKIE[$cookie_name])) {
                $_SESSION['teacher_id'] = $record[0]['id'];
                $_SESSION['id'] = $record[0]['id'];
                $_SESSION['rid'] = $record[0]['t_id'];
                setLoginLogoutStatus(103, $record[0]['id'], $lat, $lon, $CountryCode);
                $_SESSION['school_id'] = $record[0]['school_id'];
				$sch_id = $_SESSION['school_id'];
				$school_query = mysql_query("select * from tbl_school_admin where school_id='$sch_id'");
				$school_query_row = mysql_fetch_assoc($school_query);
				$_SESSION['school_type'] = $school_query_row['group_status'];
				$_SESSION['school_type'];
                $_SESSION['entity'] = 2;
                $_SESSION['usertype'] = 'Teacher';
                setcookie('usertype', 'teacher');

                $_SESSION['username'] = $record[0]['t_email'];
                if (upcartonlogin($entity, $record[0]['id'], $record[0]['t_id'], $record[0]['school_id'])) {
                    header("Location:dashboard.php");
                } else {
                    $msg = 'Error Occured';
                }
            } else {
                echo "<script>alert('user already exists')</script>";

            }
            /*if(!(isset($_SESSION['id']) && $_SESSION['id'] != '')){
     header("Location:dashboard.php");
        }*/


            break;
        case 10:
            $user = 'Manager';
            setcookie('usertype', 'manager');
            $_SESSION['teacher_id'] = $record[0]['id'];
            $_SESSION['id'] = $record[0]['id'];
            $_SESSION['rid'] = $record[0]['t_id'];
            setLoginLogoutStatus(103, $record[0]['id'], $lat, $lon, $CountryCode);
            $_SESSION['school_id'] = $record[0]['school_id'];
            $_SESSION['entity'] = 10;
            $_SESSION['usertype'] = 'Manager';
            $_SESSION['username'] = $record[0]['t_email'];
            if (upcartonlogin($entity, $record[0]['id'], $record[0]['t_id'], $record[0]['school_id'])) {
                //header("Location:dashboard.php");
                header("Location:dashbord_emp.php");
            } else {
                $msg = 'Error Occured';
            }
            break;
        case 5:
            $user = 'Parent';
            setcookie('usertype', 'parent');
            $_SESSION['parent_id'] = $record[0]['Id'];
            $_SESSION['id'] = $record[0]['Id'];
            $_SESSION['entity'] = 5;
            setLoginLogoutStatus(106, $record[0]['Id'], $lat, $lon, $CountryCode);
            if ($record[0]['email_id'] != '') {
                $_SESSION['username'] = $record[0]['email_id'];
            } else {
                $_SESSION['username'] = $record[0]['Phone'];
            }
            header("Location:purchase_point.php");
            break;
        case 6:
            $user = 'Cookie Admin';
            //setcookie('usertype', 'Cookie Admin');
            $_SESSION['cookie_admin_id'] = $record[0]['id'];
            $_SESSION['id'] = $record[0]['id'];
            $_POST['username'] = $record[0]['admin_email'];
            setLoginLogoutStatus(113, $record[0]['id'], $lat, $lon, $CountryCode);
            $_SESSION['entity'] = 6;
            header("Location:new_login.php");

            break;
        case 8:
            $user = 'Cookie Admin Staff';
            //setcookie('usertype', 'teacher');
            $_SESSION['cookieStaff'] = $record[0]['id'];
            $_SESSION['username'] = $record[0]['email'];
            setLoginLogoutStatus(114, $record[0]['id'], $lat, $lon, $CountryCode);
            $_SESSION['entity'] = 8;
            header("Location:home_cookieadmin_staff.php");
            break;
        case 7:
            $user = 'School Admin Staff';
            $_SESSION['staff_id'] = $record[0]['id'];
            $_SESSION['username'] = $record[0]['email'];
            setLoginLogoutStatus(115, $record[0]['id'], $lat, $lon, $CountryCode);
            $_SESSION['entity'] = 7;
            header("Location:school_staff_dashboard.php");
            break;
      /*  case 9:
            $user = 'Sales Person';
            $_SESSION['salespersonid'] = $record[0]['person_id'];
            $_SESSION['username'] = $record[0]['p_email'];
            setLoginLogoutStatus(116, $record[0]['person_id'], $lat, $lon, $CountryCode);
            $_SESSION['entity'] = 9;
            header("Location:registered_sponsors_list.php");
            break;   */
        case 11:
            $user = 'HR Admin';
            $_SESSION['school_admin_id'] = $record[0]['id'];
            $_SESSION['id'] = $record[0]['id'];
            setLoginLogoutStatus(102, $record[0]['id'], $lat, $lon, $CountryCode);
            $_SESSION['school_id'] = $record[0]['school_id'];
            $_SESSION['entity'] = 11;
            $_SESSION['usertype'] = 'HR Admin';
            $_SESSION['username'] = $record[0]['email'];
            header("Location:hradmin_dashboard.php");
            break;
        case 12:
            $user = 'Group Admin';
            //setcookie('usertype', 'Group Admin');
            $_SESSION['data']=$record;
            $_SESSION['group_admin_id'] = $record[0]['id'];
            $_SESSION['id'] = $record[0]['id'];
            $_POST['username'] = $record[0]['admin_email'];
            $_SESSION['entity'] = 12;
            setLoginLogoutStatus(113, $record[0]['id'], $lat, $lon, $CountryCode);

            header("Location:group_admin/home_groupadmin.php");
            break;
        default:
            $user = '';
            header("Location: $index_url");
            break;
    }

}

function searchUser($group_id,$LoginOption, $entity, $Password, $EmailID = "", $OrganizationID = "", $EmployeeID = "", $CountryCode = "", $PhoneNumber = "", $memberId = "", $school_id = "")
{
    $table = '';
    $FieldPassword = '';
    $FieldEmail = '';
    $FieldOrg = '';
    $FieldEmployeeID = '';
    $FieldCountryCode = '';
    $FieldPhoneNumber = '';
    $Fieldmemberid = '';
    $Fieldschool_id = '';
    $Group_status='status';
    switch ($entity) {
        case 2:
            $table = 'tbl_teacher';
            $FieldPassword = 't_password';
            //$FieldEmail='t_internal_email';
            $FieldEmail = 't_email';
            $FieldOrg = 'school_id';
            $FieldEmployeeID = 't_id';
            //$FieldCountryCode='t_id';
            $FieldPhoneNumber = 't_phone';
            $Fieldmemberid = 'id';
            $Fieldschool_id = 'school_id';
            break;
        case 10:
            $table = 'tbl_teacher';
            $FieldPassword = 't_password';
            //$FieldEmail='t_internal_email';
            $FieldEmail = 't_email';
            $FieldOrg = 'school_id';
            $FieldEmployeeID = 't_id';
            //$FieldCountryCode='t_id';
            $FieldPhoneNumber = 't_phone';
            $Fieldschool_id = 'school_id';
            break;
        case 1:
            $table = 'tbl_school_admin';
            $FieldPassword = 'password';
            $FieldEmail = 'email';
            $FieldOrg = 'school_id';
            //$FieldEmployeeID='t_id';
            //$FieldCountryCode='t_id';
            $FieldPhoneNumber = 'mobile';
            break;
        case 5:
            $table = 'tbl_parent';
            $FieldPassword = 'Password';
            $FieldEmail = 'email_id';
            //$FieldOrg='school_id';
            //$FieldEmployeeID='t_id';
            //$FieldCountryCode='t_id';
            $FieldPhoneNumber = 'Phone';
            $Fieldmemberid = 'Id';
            break;
        case 6:
            $table = 'tbl_cookieadmin';
            $FieldPassword = 'admin_password';
            $FieldEmail = 'admin_email';
            //$FieldOrg='school_id';
            //$FieldEmployeeID='t_id';
            //$FieldCountryCode='t_id';
            //$FieldPhoneNumber='Phone';
            break;
        case 8:
            $table = 'tbl_cookie_adminstaff';
            $FieldPassword = 'pass';
            $FieldEmail = 'email';
            //$FieldOrg='school_id';
            //$FieldEmployeeID='t_id';
            //$FieldCountryCode='t_id';
            $FieldPhoneNumber = 'phone';
            break;
        case 7:
            $table = 'tbl_school_adminstaff';
            $FieldPassword = 'pass';
            $FieldEmail = 'email';
            $FieldOrg = 'school_id';
            //$FieldEmployeeID='t_id';
            //$FieldCountryCode='t_id';
            $FieldPhoneNumber = 'phone';
            break;
        case 9:
            $table = 'tbl_salesperson';
            $FieldPassword = 'p_password';
            $FieldEmail = 'p_email';
            //$FieldOrg='school_id';
            //$FieldEmployeeID='t_id';
            //$FieldCountryCode='t_id';
            $FieldPhoneNumber = 'p_phone';
            break;
        case 11:
            $table = 'tbl_school_admin';
            $FieldPassword = 'password';
            $FieldEmail = 'email';
            $FieldOrg = 'school_id';
            //$FieldEmployeeID='t_id';
            //$FieldCountryCode='t_id';
            $FieldPhoneNumber = 'mobile';
            break;
        case 12:
            $table = 'tbl_cookieadmin';
            $FieldPassword = 'admin_password';
            $FieldEmail = 'admin_email';
            $Group_status='status';
            //$FieldEmployeeID='t_id';
            //$FieldCountryCode='t_id';
            //$FieldPhoneNumber='Phone';
            break;
    }
    $q = "select *,count(1) as TotalUser from " . $table . " where ";

    if ($EmailID != "" && $LoginOption == 'EmailID') {
        if ($entity == 2 and $school_id != '') {
            $q .= $FieldEmail . "='" . $EmailID . "' and " . $FieldPassword . "='" . $Password ."' and " . $Fieldschool_id . "='" . $school_id ."'";
        } elseif($entity == 12 and $group_id !='') {
            $q .= $FieldEmail . "='" . $EmailID . "' and " . $FieldPassword . "='" . $Password ."' and " . $Group_status . "='" . $group_id . "'";
            //echo $q; die;
        }elseif($entity == 6 ) {
            $admin="admin";
            $q .= $FieldEmail . "='" . $EmailID . "' and " . $FieldPassword . "='" . $Password ."' and " . $Group_status . "='".$admin."'";
        }else {
            $q .= $FieldEmail . "='" . $EmailID . "' and " . $FieldPassword . "='" . $Password . "'";
        }
    }

    if ($EmployeeID != "" && $LoginOption == 'EmployeeID') {
        $q .= $FieldEmployeeID . "='" . $EmployeeID . "' and " . $FieldOrg . "='" . $OrganizationID . "' and " . $FieldPassword . "='" . $Password . "'";
    }
    if ($memberId != "" && $LoginOption == 'memberId') {
        $q .= $Fieldmemberid . "='" . $memberId . "' and " . $FieldPassword . "='" . $Password . "'";
    }

    if ($PhoneNumber != "" && $LoginOption == 'PhoneNumber') {
        if ($FieldCountryCode != "") {
            $q .= $FieldPhoneNumber . "='" . $PhoneNumber . "' and " . $FieldCountryCode . "='" . $CountryCode . "' and " . $FieldPassword . "='" . $Password . "'";
        } else {
            $q .= $FieldPhoneNumber . "='" . $PhoneNumber . "' and " . $FieldPassword . "='" . $Password . "'";
        }
    }
    //echo $q."<br/>";
    $r1 = mysql_query($q) or die(mysql_error());
    $res = array();
    while ($result = mysql_fetch_array($r1)) {
        $res[] = $result;
    }
    return $res;
}

if (isset($_POST['submit'])) {
    $LoginOption = trim($_POST['LoginOption']);
    $EmailID = trim($_POST['EmailID']);
    $group_id = trim($_POST['group_id']);

    $OrganizationID = trim($_POST['OrganizationID']);
    $EmployeeID = trim($_POST['EmployeeID']);

    $CountryCode = trim($_POST['CountryCode']);
    $PhoneNumber = trim($_POST['PhoneNumber']);
    $school_id = trim($_POST['school_id']);

    $inputMemberId = trim($_POST['memberID']);
    $memberId = substr($inputMemberId, 1);

    $Password = trim($_POST['Password']);
    $entity = trim($_POST['entity']);


    $ip = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
    $url = "http://freegeoip.net/json/$ip";
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    $data = curl_exec($ch);
    curl_close($ch);

    if ($data) {
        $location = json_decode($data);
        $lat = $location->latitude;
        $lon = $location->longitude;
    }


    //$lat=trim($_POST['lat']);
    //$lon=trim($_POST['lon']);

    $user = entity_type($entity);

    if ($entity != 0 and $Password != "" and (($EmailID != "" and $entity != 2) or ($EmailID != "" and $entity = 2 and $school_id != '') or ($CountryCode != "" and $PhoneNumber != "") or ($OrganizationID != "" and $EmployeeID != "") or $memberId != "" and $group_id!="" )) {
        if ($EmailID != "" && $LoginOption == 'EmailID') {
            //$emailval = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
            //if(!preg_match($emailval, $EmailID)){
            //$report="<span id='error' class='red'></span>";
            //}
        }
        if ($PhoneNumber != "" && $LoginOption == 'PhoneNumber') {
            $mob = "/^[789][0-9]{9}$/";
            if (!preg_match($mob, $PhoneNumber)) {
                $report = "<span id='error' class='red'>Check your Mobile number.</span>";
            }
        }
        if ($memberId != "" && $LoginOption == 'memberId' && $entity == '2') {
            if (!(stripos($inputMemberId, "t") === 0)) {

                $report = "<span id='error' class='red'>Check your Member Id.</span>";

            }

        }
        if ($memberId != "" && $LoginOption == 'memberId' && $entity == '5') {
            if (!(stripos($inputMemberId, "p") === 0)) {

                $report = "<span id='error' class='red'>Check your Member Id.</span>";

            }

        }
        if ($report == "") {
          //  echo $group_id;die;
            $res = searchUser($group_id,$LoginOption, $entity, $Password, $EmailID, $OrganizationID, $EmployeeID, $CountryCode, $PhoneNumber, $memberId, $school_id);
            if ($res[0]['TotalUser'] < 1) {
                $data=array(
                        "Group id"=>$group_id,
                        "Login Option"=>$LoginOption,
                        "entity"=>$entity,
                        "EmailID"=>$EmailID,
                        "PhoneNumber"=>$PhoneNumber,
                        "school_id "=>$school_id,
                         );
                    $dates = date("Y-m-d h:i:s A");
                    $data=json_encode($data);
                    $query="insert into tbl_error_log (error_type,error_description,datetime,user_type,email) values('Login Fails','$data','$dates','$entity','$EmailID') ";
					$rs = mysql_query($query );
                $report = "<span id='error' class='red'>Invalid Credentials!</span>";

            } else {
                setSessionAndForward($entity, $res, $lat, $lon, $CountryCode);

            }

        }
    } else {
        $report = "<span id='error' class='red'>All Fields Are Mandatory.</span>";
    }
}

if (isset($_POST['entity'])) {
    $entity = $_POST['entity'];
    $user = entity_type($entity);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
<script>
    $(document).ready(function () {
        if (navigator.geolocation) {

            navigator.geolocation.getCurrentPosition(showPosition);

        } else {

            x.innerHTML = "Geolocation is not supported by this browser.";

        }
    });

    function showPosition(position) {

        document.getElementById("lat").value = position.coords.latitude;

        document.getElementById("lon").value = position.coords.longitude;

    }

</script>

<style>
    body {
        background-color: #cdcdcd;
    }

    .padtop100 {
        padding-top: 100px;
    }

    .padtop10 {
        padding-top: 10px;
    }

    .bg-red {
        background-color: #F0483E;
    }

    .red {
        color: #f00;
    }

    .color-white {
        color: white;
    }

    .panel {
        border-radius: 10px;
        box-shadow: 10px 10px 5px #888888;
    }

    .title-text {
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .form-content {
        padding-top: 10px;
    }

    .no-top-padding {
        padding-top: 0px;
    }
</style>
<script>
    $(document).ready(function () {
        //EmailInput
        //NumberInput
        //OrganisationInput
        //PhoneInput
        //SocialLogin
        //PasswordInput
        //SubmitInput
        //ForgotPassord
        var user = '<?php echo $user; ?>';

        $("#OptEmailID").hide();
        $("#OptEmployeeID").hide();
        $("#OptPhoneNumber").hide();

        switch (user) {
            case 'School Admin':
                $("#group_id").hide();
                $("#OptEmailID").show();
//	$("#OptEmployeeID").show();
                $("#OptPhoneNumber").show();
                break;
            case 'HR Admin':
                $("#group_id").hide();
                $("#OptEmailID").show();
//	$("#OptEmployeeID").show();
                $("#OptPhoneNumber").show();
                break;
            case 'Teacher':
                $("#group_id").hide();
                $("#OptEmailID").show();
                $("#OptEmployeeID").show();
                $("#OptPhoneNumber").show();
                break;
            case 'Manager':
                $("#OptEmailID").show();
                $("#OptEmployeeID").show();
                $("#OptPhoneNumber").show();
                $("#group_id").hide();
                break;
            case 'Parent':
                $("#group_id").hide();
                $("#OptEmailID").show();
                $("#OptEmployeeID").hide();
                $("#OptPhoneNumber").show();
                break;
            case 'Cookie Admin':
                $("#group_id").hide();
                $("#OptEmailID").show();
                $("#OptEmployeeID").hide();
                $("#OptPhoneNumber").hide();
                $("#school_id").hide();
                break;
            case 'Cookie Admin Staff':
                $("#group_id").hide();
                $("#OptEmailID").show();
                $("#OptEmployeeID").hide();
                $("#OptPhoneNumber").hide();
                $("#school_id").hide();
                break;
            case 'Group Admin':
                $("#OptEmailID").show();
                $("#OptEmployeeID").hide();
                $("#OptPhoneNumber").hide();
                $("#school_id").hide();
                break;
            case 'School Admin Staff':
                $("#group_id").hide();
                $("#OptEmailID").show();
//	$("#OptEmployeeID").show();
                $("#OptPhoneNumber").show();
                break;
            case 'Sales Person':
                $("#group_id").hide();
                $("#OptEmailID").show();
                $("#OptEmployeeID").hide();
                $("#OptPhoneNumber").show();
                break;
            default:
                $("#group_id").hide();
                $("#OptEmailID").hide();
                $("#OptEmployeeID").hide();
                $("#OptPhoneNumber").hide();
                break;
        }

        $("#EmailInput").hide();
        $("#NumberInput").hide();
        $("#OrganisationInput").hide();
        $("#PhoneInput").hide();
        $("#SocialLogin").hide();

        $("#PasswordInput").hide();
        $("#SubmitInput").hide();
        $("#ForgotPassord").hide();


        function loginHideShow(LoginOption) {
            switch (LoginOption) {
                case 'SocialLogin':
                    $("#EmailInput").hide();
                    $("#NumberInput").hide();
                    $("#OrganisationInput").hide();
                    $("#PhoneInput").hide();
                    $("#SocialLogin").show();
                    $("#PasswordInput").hide();
                    $("#SubmitInput").hide();
                    $("#ForgotPassord").hide();
                    $("#memberID").hide();
                    $("#school_id").hide();
                    $("#PasswordInput").removeClass("padtop10");
                    break;
                case 'EmailID':

                    var user = '<?php echo $user; ?>';

                    switch (user) {
                        case 'Cookie Admin':
                            $("#school_id").hide();
                            $("#group_id").hide();
                            break;
                        case 'School Admin':
                            $("#school_id").hide();
                            break;
                        case 'Group Admin':
                            $("#school_id").hide();
                            break;
                        case 'Cookie Admin Staff':
                            $("#school_id").hide();
                            break;
                        default :
                            $("#school_id").show();
                    }

                    $("#EmailInput").show();
                    $("#NumberInput").hide();
                    $("#OrganisationInput").hide();
                    $("#PhoneInput").hide();
                    $("#SocialLogin").hide();
                    $("#PasswordInput").show();
                    $("#SubmitInput").show();
                    $("#ForgotPassord").show();
                    $("#memberID").hide();

                    $("#PasswordInput").removeClass("padtop10");
                    break;
                case 'EmployeeID':
                    $("#EmailInput").hide();
                    $("#NumberInput").show();
                    $("#OrganisationInput").show();
                    $("#PhoneInput").hide();
                    $("#SocialLogin").hide();
                    $("#PasswordInput").show();
                    $("#SubmitInput").show();
                    $("#ForgotPassord").show();
                    $("#memberID").hide();
                    $("#school_id").hide();
                    $("#PasswordInput").removeClass("padtop10");
                    break;
                case 'PhoneNumber':
                    $("#EmailInput").hide();
                    $("#NumberInput").hide();
                    $("#OrganisationInput").hide();
                    $("#PhoneInput").show();
                    $("#SocialLogin").hide();
                    $("#PasswordInput").show();
                    $("#SubmitInput").show();
                    $("#ForgotPassord").show();
                    $("#memberID").hide();
                    $("#school_id").hide();
                    $("#PasswordInput").addClass("padtop10");

                    break;
                case 'memberId':
                    $("#EmailInput").hide();
                    $("#NumberInput").hide();
                    $("#OrganisationInput").hide();
                    $("#PhoneInput").hide();
                    $("#SocialLogin").hide();
                    $("#PasswordInput").show();
                    $("#SubmitInput").show();
                    $("#ForgotPassord").show();
                    $("#school_id").hide();
                    $("#memberID").show();

                    $("#PasswordInput").addClass("padtop10");

                    break;
            }
        }

        var LoginOption = $("#LoginOption").val();
        loginHideShow(LoginOption);

        $("#LoginOption").change(function () {
            var LoginOption = $("#LoginOption").val();
            loginHideShow(LoginOption);
        });


    });
</script>
<div class='container-fluid bgcolor'>
    <div class='row'>
        <div class='col-md-4 col-md-offset-4 padtop100'>
            <div class='panel panel-primary'>
                <div class='panel-body'>
                    <div class='row text-center'>
                        <div class="visible-sm visible-lg visible-md">
                            <a href='<?php echo $index_url; ?>'><img src="Images/250_86.png"/></a>
                        </div>
                        <div class="visible-xs">
                            <a href='<?php echo $index_url; ?>'><img src="Images/220_76.png"/></a>
                        </div>
                    </div>
                    <div class='row bg-red text-center title-text'>
                        <span class='panel-title color-white'><?php echo $user; ?> Login</span>
                    </div>
                    <div class='row form-content'>
                        <form method='post' id=''>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label for='LoginOption'>Login With</label>
                                    <select name='LoginOption' id='LoginOption' class='form-control'
                                            onclick='cleardata()'>
                                        <option id='OptEmailID' value='EmailID' <?php if ($LoginOption == 'EmailID') {
                                            echo 'selected';
                                        } ?>>Email ID
                                        </option>
                                        <option id='OptEmployeeID'
                                                value='EmployeeID' <?php if ($LoginOption == 'EmployeeID') {
                                            echo 'selected';
                                        } ?>>PRN / EmployeeID
                                        </option>
                                        <option id='OptPhoneNumber'
                                                value='PhoneNumber' <?php if ($LoginOption == 'PhoneNumber') {
                                            echo 'selected';
                                        } ?>>Phone Number
                                        </option>
                                        <option id='OptPhoneNumber'
                                                value='memberId' <?php if ($LoginOption == 'memberId') {
                                            echo 'selected';
                                        } ?>>Member Id
                                        </option>
                                        <!--<option value='SocialLogin' <?php if ($LoginOption == 'SocialLogin') {
                                            echo 'selected';
                                        } ?>>Social Login</option>-->
                                    </select>

                                </div>
                                <div class='form-group' id='EmailInput'>
                                    <input type='text' name='EmailID' id='EmailID' class='form-control'
                                           value='<?php echo $EmailID; ?>' placeholder='Email ID' autocomplete="off"/>
                                </div>

                                <div class='form-group' id='group_id'>
                                     <input type='text' name='group_id' id='group_id' class='form-control' value='' placeholder='Group ID' autocomplete="off"/>
                                 </div>
                                <div class='form-group' id='OrganisationInput'>
                                    <input type='text' name='OrganizationID' id='OrganizationID' class='form-control'
                                           value='<?php echo $OrganizationID; ?>'
                                           placeholder='Institute ID / Organization ID' autocomplete="off"/>
                                </div>
                                <div class='form-group' id='NumberInput'>
                                    <input type='text' name='EmployeeID' id='EmployeeID' class='form-control'
                                           value='<?php echo $EmployeeID; ?>' placeholder='PRN / EmployeeID'
                                           autocomplete="off"/>
                                </div>
                                <div class='form-group' id='MembreIdInput'>
                                    <input type='text' name='memberID' id='memberID' class='form-control'
                                           value='<?php echo $memberID; ?>' placeholder='Member ID'/autocomplete="off">
                                </div>
                                <div class='form-group' id='school_id'>
                                    <input type='text' name='school_id' id='school_id' class='form-control'
                                           value='<?php echo $school_id; ?>' placeholder='School Id'/autocomplete="off">
                                </div>
                            </div>
                            <div class='form-group' id='PhoneInput'>
                                <div class='col-md-4'>
                                    <select name='CountryCode' id='CountryCode' class='form-control'>
                                        <option value='91' <?php if ($CountryCode == 91) {
                                            echo 'selected';
                                        } ?>>+91
                                        </option>
                                        <option value='1' <?php if ($CountryCode == '1') {
                                            echo 'selected';
                                        } ?>>+1
                                        </option>
                                    </select>
                                </div>
                                <div class='col-md-8'>
                                    <input type='text' name='PhoneNumber' class='form-control'
                                           value='<?php echo $PhoneNumber; ?>' placeholder='Phone Number'/>
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group' id='SocialLogin'>
                                    Facebook<br/>
                                    Twitter<br/>
                                    LinkedIn<br/>
                                    Google<br/>
                                </div>
                                <div class='form-group' id='PasswordInput'>
                                    <input type='password' name='Password' id='Password' class='form-control'
                                           value='<?php echo $Password; ?>' placeholder='Password'/>
                                </div>
                                <div class='form-group' id='Report'>
                                    <?php echo $report; ?>
                                </div>
                                <div class='form-group' id='SubmitInput'>
                                    <input type='hidden' name='entity' id='entity' value='<?php echo $entity; ?>'/>
                                    <input type='hidden' name='lat' id='lat' value='<?php echo $lat; ?>'/>
                                    <input type='hidden' name='lon' id='lon' value='<?php echo $lon; ?>'/> <label>

                                        <input type="checkbox" name="remember_me" id="remember_me">
                                        Remember me
                                    </label>

                                    <input type='submit' name='submit' id='submit' class='btn btn-primary'
                                           value='Login'/>
                                </div>
                                <div class='form-group' id='ForgotPassord'>
                                    <a id="link-forgot-passwd" href="forgetpassword.php">Forgot password?</a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>

    function cleardata() {
        var frm = document.getElementByName('loginform')[0];

        frm.reset();  // Reset

    }

    function submitForm() {
        // Get the first form with the name
        // Hopefully there is only one, but there are more, select the correct index
        var frm = document.getElementByName('loginform')[0];
        frm.submit(); // Submit
        frm.reset();  // Reset
        return false; // Prevent page refresh
    }
</script>
</body>
</html>
