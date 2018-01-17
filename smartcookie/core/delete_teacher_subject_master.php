<?php
              include('conn.php');					 
			 
			 $id=$_GET['id'];
			 
			    //echo $id;die;
				$row=mysql_query("delete from tbl_student_subject_master where id='$id'");
					
		        mysql_query($row);
				 header("Location:list_student_subject.php");
?>
          <script> 
		        window.history.go(-1);
		   </script>