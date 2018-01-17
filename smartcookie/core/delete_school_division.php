<?php
              include('conn.php');					 
			 
			  $div_id=$_GET['id'];
		  
  mysql_query("delete  from tbl_school_division where id='$div_id'");
		//		 header("Location:list_school_division.php");
	

?>

      <script>
          window.history.go(-1);
      </script>