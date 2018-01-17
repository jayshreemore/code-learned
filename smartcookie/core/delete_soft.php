<?php

include 'conn.php';
$id=$_GET['softid'];
mysql_query("delete from `softreward` where `softrewardId`='$id'");
$message = "Softreward has been deleted successfully..";
echo "<script type=text/javascript>alert('$message'); window.location='softrewardslist.php'</script>";
//header('Location:softrewardslist.php');
//echo "<script type=text/javascript>alert('');window.location=''</script>";

?>