<?php
include ("conn.php");
echo $sc_id = $_GET['sc_id'];
$sql = "DELETE FROM `tbl_school_admin` WHERE school_id='$sc_id'";
mysql_query($sql);


header("Location: cookie_list_school.php");

?>