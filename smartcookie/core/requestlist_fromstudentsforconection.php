<?php 
include("smartcookiefunction.php");
include_once("header.php");
if(!isset($_SESSION['id']))
	 {
	 	header('Location:login.php');
	 }
	 //teacher info
		 $query = mysql_query("select * from tbl_teacher where id = ".$_SESSION['id']);
		 $value = mysql_fetch_array($query);
		 $school_id=$value['school_id'];
		 $id=$value['id'];
		 $t_id=$value['t_id'];
		 $reward_points=$value['tc_balance_point'];
		 
//init	
	$report="";
	 $report1="";
	 
	 
	 
	//accept request 
	 if(isset($_POST['submit']))
	 {
	$student_id=$_POST['student_id'];
	$requestdate=$_POST['requestdate'];
	$accept_date=Date('d/m/Y');

		$sql2=mysql_query("update tbl_request set flag='Y' where stud_id1='$student_id' and stud_id2='$t_id' and entitity_id='117' and flag='N' and school_id='$school_id'");
		
		$report="Request successfully accepted";
		header('Location: requestlist_fromstudentsforconection.php?report='.$report); 
	}
	
//decline request	
	if(isset($_POST['decline']))
	{
	$points=$_POST['points'];
	$reason=$_POST['reason'];
	$student_id=$_POST['student_id'];
	$requestdate=$_POST['requestdate'];
	$activity_type1=$_POST['activity_type'];
	$accept_date=Date('d/m/Y');
	$sql2=mysql_query("update tbl_request set flag='P' where stud_id1='$student_id' and stud_id2='$t_id' and entitity_id='117' and flag='N' and school_id='$school_id'");
	
		$report="Request declined";
		header('Location: requestlist_fromstudentsforconection.php?report='.$report); 
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Request List</title>
<style>
.preview
{
border-radius:50% 50% 50% 50%;  
height:100px;
box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);
-webkit-border-radius: 99em;
  -moz-border-radius: 99em;
  border-radius: 99em;
  border: 5px solid #eee;
  width:100px;
}
.btn
{
padding: 5px 20px;
}
.row{
	padding-top:10px;
}
</style>
</head>
<body style="background-color:#FFFFFF;">
<?php if(isset($_GET['report'])){ ?>
<div class="container">
	<div class="row">
		<div class="panel panel-info">
		<div class="panel-body">
			<p class="text-center"><?php echo $_GET['report']; ?></p>
		</div>
		</div>
	</div>
</div>
<?php } ?>

<div class="container">
<?php 
 $arr1=mysql_query("select stud_id1 as stud_id,requestdate,points,reason,activity_type from tbl_request where stud_id2='$t_id' and flag='N' and entitity_id='117' and school_id='$school_id' order by id desc");
 if(mysql_num_rows($arr1)!=0) 
 { 
 ?>
<center><h3 style="padding-top:20px;">Requests for connection</h3></center>
  <?php
	while($post = mysql_fetch_assoc($arr1))
	{
	 $st_id=$post['stud_id'];
	 	$sql=mysql_query("select std_PRN, std_name,std_Father_name,std_lastname,std_complete_name,std_img_path from tbl_student where std_PRN='$st_id' and school_id='$school_id'");
		$value=mysql_fetch_array($sql);
	 ?>
 <div class="container" >  
 <div class="row" style="">

<div class="col-md-12"  style="border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4;">	
         <form method="post">    

             <div class="row">
			 
            <div class="col-md-3">
				<?php if($value['std_img_path'] != ''){?>
				<img src=<?php echo $value['std_img_path'];?>" width="50" height="50" style="border:1px solid #CCCCCC;" class="preview" alt="Responsive image"/> 
					<?php }else {?> 
				<img src="image/avatar_2x.png" width="50" height="50" style="border:1px solid #CCCCCC;" class="preview" alt="Responsive image"/> 	
					<?php }?>
			</div>
			
			<div class="col-md-5"><b>
			
		   <?php if($value['std_complete_name']==""){
				echo ucwords(strtolower($value['std_name']." ".$value['std_Father_name']." ".$value['std_lastname']));
			}else{
				echo  ucwords(strtolower($value['std_complete_name']));	
			}
			?></b>
			</div>
				
				<div class="col-md-3" style="padding-top:10px;"><b>Request Date:</b> </div>
                <div class="col-md-2" style="padding-top:10px;"><?php echo $post['requestdate']?></div>
				<input type="hidden" name="requestdate" id="requestdate" value="<?php echo $post['requestdate']?>" />
				<input type="hidden" name="student_id" id="student_id" value="<?php echo $value['std_PRN']?>" />
				
				<div class="col-md-2" style="padding-top:40px;"><input type="submit" name="submit" value="Accept" class="btn btn-primary"></div>
               <div class="col-md-2" style="padding-top:40px;"><input type="submit" name="decline" value="Decline" class="btn btn-danger"></div>
             </div>
             </div>
             </div>
			 </div>
		 </form>
			 <?php }?>
			 
 <?php }else{
	 ?>
<div class="container">
	<div class="row" >
		<div class="panel panel-info">
		<div class="panel-body">
			<p class="text-center">You Don't Have Any Requests.</p>
		</div>
		</div>
	</div>
</div>
<?php
 }
?>
 <a href="requestlist_fromstudents.php"> Pending Requests</a>
 </div>
 </div>
 </div>
 </div>
 </div>

</div>
</body>
</html>