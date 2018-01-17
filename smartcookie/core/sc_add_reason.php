<?php

include('scadmin_header.php');
include('conn.php');
$school_id = $_SESSION['school_id'];


if(isset($_POST['submit']))
		{
			$reason_name=$_POST['reason'];
			
			$res=mysql_query("select * from tbl_student_recognition where student_recognition='$reason_name' and school_id='$school_id'");
			
			$test=mysql_num_rows($res);
			if($test<=0)
			{
			$query="insert into tbl_student_recognition(student_recognition,school_id) values('$reason_name','$school_id')";
			$rs = mysql_query( $query );
							if($rs)
							{
								echo "<script>alert('$reason_name Successfully Added')</script>";
							}
							else
							{
								echo "<script>alert('Error While Inserted')</script>";
							}
			
			}
			else
			{
				 echo "<script>alert('$reason_name is Already Exists')</script>";
			}
		}
		
		

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
<title>Smart Cookies</title>
</head>

<link href="css/style.css" rel="stylesheet">
 <link rel="stylesheet" href="css/bootstrap.min.css">
 
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>

</head>

<body style="background-color:#F8F8F8;">
<div align="center">
	<div style="width:100%">
    	
        
        	<div style="height:10px;"></div>
    		<div style="height:50px; border-bottom: thin solid #CCCCCC;" align="left">
        	<h1 style="padding-left:20px; margin-top:2px;color:#666">Reason</h1>
        	</div>
    	<div style="height:30px;"></div>
    	
         <div class="container">
        <div class="row">
         <div class="col-md-6">
		 <form method="post" name="product">
        	<div style=" background-color:#FFFFFF; border:1px solid #CCCCCC; padding-left:30px;" align="left">
            	<div style="height:10px;"></div>
            	<div>
					<h2 style="color:#666;">Add Reason</h2>
                </div>
                <div style="height:10px;"></div>
            	<div>
      <input type="text" id="reason"  name="reason" style="width:50%; height:30px; padding:5px;" placeholder="Enter Reason" /></br></br>
                </div>
				
				<div>
                <input type="submit" name="submit" class="btn btn-primary" style="width:20%;" value="Submit" />
                &nbsp;&nbsp;&nbsp;
           <a href="sc_stud_activity.php"><input type="button" style="width:20%;" value="Back" class="btn btn-danger"></a>
                
                </div>
			</div>
		</div>
	</div>
	</div>
</div>
</div>
</body>
</html>
