<?php
if (isset($_GET['staffid'])) {
    include('school_staff_header.php');
    $id = $_SESSION['staff_id'];
    $results = mysql_query("select * from tbl_school_adminstaff where id=" . $staff_id . "");
    $school_admin = mysql_fetch_array($results);
    $sc_id = $school_admin['school_id'];
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $sql = "DELETE FROM  tbl_studentpointslist WHERE sc_id='$id' and school_id='$sc_id'";
        mysql_query($sql);
        header("location:activitylist.php?name=$name");
    }
} else {
    include('scadmin_header.php');
    $id = $_SESSION['id'];
    $fields = array("id" => $id);
    $table = "tbl_school_admin";
    $smartcookie = new smartcookie();
    $results = $smartcookie->retrive_individual($table, $fields);
    $school_admin = mysql_fetch_array($results);
    $sc_id = $school_admin['school_id'];
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $sql = "DELETE FROM  tbl_studentpointslist WHERE sc_id='$id' and school_id='$sc_id'";
        mysql_query($sql);
        $deletemessage="Record Deleted Successfully";
        echo "<script type=text/javascript>window.location='activitylist.php?deletemessage=$deletemessage'</script>";
    }
}
?>