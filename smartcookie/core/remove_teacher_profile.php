<?php
              include('conn.php');					 
			$teacher_id=$_SESSION['id'];
			
			
			$t_id=$_GET['id'];
			//echo "delete t_pc from   tbl_teacher where where t_id='$t_id'";
			 $sql="update tbl_teacher set t_pc = null where t_id='$t_id'";
			   $retval = mysql_query( $sql);
			 
			 // mysql_query("update tbl_teacher set t_pc='$filenm'   where id='$t_id'");
			 
		 // $retval = mysql_query( $sql);
		 if($retval)
		 {
			 
			 echo"<script>alert('profile remove  succesfully')</script>";
			 
		 }
		 else
		 {
			 echo"<script>alert('profile not remove succesfully')</script>";
			
			 
			 }		 
		/*header( "refresh:1;url=Location:http://tsmartcookies.bpsi.us/core/teacher_profile.php" );*/
			 header('Location:teacher_profile.php');
							
				
			
			
			
			
			/*if(isset($_POST['id']))
			{
			 
			  //$subject_id=$_GET['subid'];
			  //$sc_id=$_GET['sc_id'];
			  
			$id=$_POST['id'];
		
	
		 //$sql="DELETE FROM tbl_subject  where subject='$subject_id' and teacher_id='$teacher_id' and school_id='$sc_id'";
		
		 //$test=mysql_query($sql);
		 
		 $sql="delete from  tbl_teacher_subject_master where id='$id'";
		  $retval = mysql_query( $sql);
		 if($retval)
		 {
			 
			 echo"record deleted succesfully";
			 
		 }
		 else
		 {
			  echo"record not deleted succesfully";
			 
			 }		 
		
			}
			
							
				 header("Location:dashboard.php");*/
		

?>