<?php
              include('conn.php');					 
			$student_id=$_GET['id'];
		$sql="DELETE FROM tbl_student where id='$student_id'";
		    $test=mysql_query($sql);
		
		//header("Location:teacher_setup.php");
?>
  <script>   
  window.history.back(-1)
  </script>