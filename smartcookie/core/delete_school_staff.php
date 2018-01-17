<?php
              include('conn.php');					 
						
			 
			$staff_id=$_GET['id'];
				
	   
		 $sql="DELETE FROM tbl_school_adminstaff where id='$staff_id'";
		 $test=mysql_query($sql);
		
	//echo '<script type="text/javascript"> alert("echo '<script type="text/javascript"> alert("Successfully deleted")</script>';")</script>';
			//$succesreport="Successfully deleted";
							
				 header("Location:schoolAdminStaff_list.php?successreport=$succesreport");
		

?>