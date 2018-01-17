<?php

	include("scadmin_header.php");

	$report="";

	if(!isset($_SESSION['id']))

	{

		header('location:login.php');

	}

	$id=$_SESSION['id'];

	$teach_id=explode(",",$_GET['id']);

	$teacher_id=$teach_id[0];

	

	$arr = mysql_query("select school_id from tbl_school_admin  where id=$id");

	$result=mysql_fetch_array($arr);

	$school_id=$result['school_id'];



	

	

	

?>





 <?php

            

            if(isset($_POST['submit']))

				{

				if(isset($_POST['points']))

					{

					

					$sql=mysql_query("select school_balance_point from tbl_school_admin where school_id='$school_id'");

		$arr=mysql_fetch_array($sql);

		$school_balance_point=$arr['school_balance_point'];

		

     				 $point=$_POST['points'];

					 

					if($point>$school_balance_point)

					{

					 $report="You have Insufficient Balance Points!!!";

					

					}

	 

	 		else

			{

	  				$arrs=mysql_query("select tc_balance_point from tbl_teacher where t_id='$teacher_id' and school_id='$school_id' ");

      				$arr=mysql_fetch_array($arrs);

      				$tc_balance_point=$arr['tc_balance_point']+$point;



	  				mysql_query("update tbl_teacher set tc_balance_point='$tc_balance_point' where t_id='$teacher_id' and school_id='$school_id'");

					

					

					$result=mysql_query("select school_balance_point,school_assigned_point from tbl_school_admin where school_id='$school_id'");

					$sql=mysql_fetch_array($result);

					$school_balance_point=$sql['school_balance_point'];

					

					

					$school_balance_point=$sql['school_balance_point']-$point;

					$school_assigned_point=$sql['school_assigned_point']+$point;

					

					

					

					

					

					

					mysql_query("update tbl_school_admin set school_balance_point='$school_balance_point',school_assigned_point='$school_assigned_point' where school_id='$school_id'");

					mysql_query("update tbl_school_admin set  where school_id='$school_id'");

					

					

					$successreport="$point points assigned successfully";

					

			//	header('Refresh: 5; url=teacherassign.php');

	 

	 } 

	   

	   

	 

	            

	 // header("location:teacherassign.php"); 

	

	}

	}

	

 ?>

<html>

<head>



</head>

<script>



function valid()

{

var points=document.getElementById("points").value;

if(points==''||points==null)

{

 document.getElementById('errorpoints').innerHTML='Please enter Points';

return false;

}



var numbers = /^[0-9]+$/;  

 if(!points.match(numbers))

 {

document.getElementById('errorpoints').innerHTML='Please enter Valid Points';

 return false;

 

 }  







}

</script>



<body>



    <div class="container" style="padding-top:50px;">

    <div  style="width:100%;">

        <div style="height:10px;"></div>

    	<div style="height:60px; background-color:#FFFFFF; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4;" align="left">

        	<h2 style="padding-left:20px; margin-top:10px;">Assign  Green Points to Teacher</h2>

        </div>

              

         </div>

         

         

       </div

       

       

       

       ><div class="container" style="padding:20px; ">

    <div class="row" style="padding-top:30px;">

      <div class="col-md-1"></div>

    <div class="col-md-4">



<div style="background-color:#FFFFFF; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4;" align="left">

			

        	<h2 style="padding-left:20px; margin-top:6px;color:#009933"><center>School Points</center></h2>

        <div style="height:20px;"></div>

        

        <div class="row">

      

        <div class="col-sm-6">

        <h4 style="padding-left:2px;">Balance Points</h4>

        <p style="padding-left:2px;">&nbsp;</p>

        <h2 style="color:#009933;"><center><?php

    

		$sql=mysql_query("select school_balance_point from tbl_school_admin where school_id='$school_id'");

		$arr=mysql_fetch_array($sql);

		$school_balance_point=$arr['school_balance_point'];

		echo $school_balance_point;

		

		?></center></h2>

        

        

        </div>

         <div class="col-md-6">

        <h4> Assigned Points</h4>

        <p style="padding-left:2px;">&nbsp;</p>

        <h2 style="color:#009933"><center> <?php



		$sql1=mysql_query("select school_assigned_point from  tbl_school_admin where school_id='$school_id'");

		$arr1=mysql_fetch_array($sql1); 

		$school_assigned_point=$arr1['school_assigned_point'];

		echo $school_assigned_point;

		

		?>  </center></h2>

         

        </div>

        </div>

        </div>

</div>

        

       

         <?php 

            

            //retive child information using parent id

            

            $sql=mysql_query("select id,t_name,school_id,t_current_school_name,tc_balance_point from tbl_teacher where t_id='$teacher_id' and school_id='$school_id'");

			$sql1=mysql_fetch_array($sql);

			$teacher_id=$sql1['id'];

			$teacher_name=$sql1['t_name'];

			$sc_id=$sql1['school_id'];

			$sc_name=$sql1['t_current_school_name'];

			$balance_point=$sql1['tc_balance_point'];

			

			

			

		

			

					

				

		

			

			

		

			  ?>

		

       

        

        <div class="col-md-6">

<div style="padding:2px 2px 2px 2px;border:1px solid #CCCCCC; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4;">

<div style="background-color:#F8F8F8 ;">





<div class="row" style="padding-top:20px;padding-left:20px;">

<div class="col-md-5"><label>Teacher ID</label></div>

<div class="col-md-5"><?php echo $teacher_id;?></div>

</div>







<div class="row" style="padding-top:10px;padding-left:20px;">

<div class="col-md-5"><label>Name</label></div>

<div class="col-md-5"><?php echo $teacher_name;?></div>

</div>





<div class="row" style="padding-top:10px;padding-left:20px;">

<div class="col-md-5"><label>School ID</label></div>

<div class="col-md-5"><?php echo $sc_name;?></div>

</div>



<div class="row" style="padding-top:10px;padding-left:20px;">

<div class="col-md-5"><label>Balance Points</label></div>

<div class="col-md-5"><?php echo $balance_point;?></div>

</div>



<div class="row" style="padding-top:10px;padding-left:20px;">

<div class="col-md-5"><label>Assign Points</label></div>

<div class="col-md-5">

<form method="post">

<input type="text" class="form-control" name="points" id="points" width="20%;"></div></div>





<div class="row" style="padding-top:30px" align="center"><input type="submit" name="submit" value="Assign" class="btn btn-primary" onClick="return valid();">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="search_teacher_points.php" style="text-decoration:none;"><input type="button" value="Back" class="btn btn-danger"></a></div>

</form><div class="row" align="center" style="padding-top:40px;  font-weight:bold;"  id="errorpoints">
<div style="color:#090;"><?php echo $successreport;?> </div><div style="color:#FF0000;"><?php echo $report;?></div></div>









</div>



</div>

</div>

</div>

        

          

         

       

       

       

 </div>

      

 </div>      

       

</body>

</html>
