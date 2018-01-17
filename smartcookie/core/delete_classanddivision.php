<?php
              include('conn.php');					 
			$id=$_SESSION['id'];
			
			
			$class_id=$_GET['classid'];
			  $div_id=$_GET['divid'];
			  
			
			
			  if($div_id==0)
			{
			
			
			 $query=mysql_query("delete from tbl_division where class_id='$class_id' and division='' and teacher_id='$id'");
			
			
			}
			else
			{
	
			  $sql=mysql_query("select * from tbl_school_division where id='$div_id'");
			  
			  $result=mysql_fetch_array($sql);
			  $class_id=$result['class_id'];
			 
			  $query=mysql_query("delete from tbl_division where class_id='$class_id' and division='$div_id'and teacher_id='$id'");
			 
			}
				
				 header("Location:dashboard.php");
		

?>