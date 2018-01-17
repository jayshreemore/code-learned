<?php
include("conn.php");
if(isset($_GET["id"]))
	{
		$id= $_GET["id"];
		
		 $sql="DELETE FROM  tbl_studentpointslist WHERE sc_id='$id'";
		mysql_query($sql);
		header("location:System_level_activity.php");
	}
?>