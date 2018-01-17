
<?php 
include("smartcookiefunction.php");
include_once("header.php");
//header("Refresh:2");
$server_name = $_SERVER['SERVER_NAME'];
if(!isset($_SESSION['id']))
	 {
	 	header('Location:login.php');
	 }
	   $query = mysql_query("select * from tbl_teacher where id = ".$_SESSION['id']);
	 $value = mysql_fetch_array($query);
	 $school_id=$value['school_id'];
	 $id=$value['id'];
	 $t_id=$value['t_id'];
	 $report="";
	 $report1="";
	 $reward_points=$value['tc_balance_point'];

	 if(isset($_POST['submit']))
	 {
	$student_id=$_POST['student_id'];
	$requestdate=$_POST['requestdate'];
	
	  $ss=mysql_query("select * from tbl_request  where stud_id1='$student_id' and stud_id2='$id' and entitity_id='112' and flag='P' and school_id='$school_id'");
if(mysql_num_rows($ss)==0)
{
	$accept_date=Date('d/m/Y');
			//$sql2=mysql_query("update tbl_request set flag='Y' where stud_id1='$student_id' and stud_id2='$id' and entitity_id='112' and flag='N' and school_id='$school_id' ");

              $s=mysql_query("select * from tbl_coordinator where stud_id='$student_id' and school_id='$school_id' status='Y'");  
			//echo "select * from tbl_coordinator stud_id='$student_id' and school_id='$school_id'";
			///echo mysql_num_rows($s);die;
if(mysql_num_rows($s)>1){


			 echo "data already exists";

			}
			
			else{
				
				$sql3=mysql_query("insert into tbl_coordinator (teacher_id,stud_id,pointdate,status,school_id) values('$id','$student_id','$accept_date','Y','$school_id')");
             $sql2=mysql_query("update tbl_request set flag='Y' where stud_id1='$student_id' and stud_id2='$id' and entitity_id='112' and flag='N' and school_id='$school_id' ");
			}
	
		$report="Request successfully accepted";
}

else
{
	echo"<script>alert('You Alredy Decline Request')</script>";
}

//header('Location: coordinatorrequest_fromstudent.php?report='.$report); 
	 }

	 if(isset($_POST['decline']))
	 {
	$student_id=$_POST['student_id'];

	$requestdate=$_POST['requestdate'];

	$sql2=mysql_query("update tbl_request set flag='P' where stud_id1='$student_id' and stud_id2='$id' and entitity_id='112' and flag='N' and school_id='$school_id' ");

	echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Decline Request')
				window.location.href='http://$server_name/core/coordinatorrequest_fromstudent.php';
			    //header('Location: http://absolute.uri/file.ext');
			  
			</SCRIPT>");


//echo "update tbl_request set flag='P' where stud_id1='$student_id' and stud_id2='$id' and entitity_id='105' and flag='N' and reason like '$reason'";die;

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
</style>
</head>
<body style="background-color:#FFFFFF;">
<div class="container">
<?php 
 $arr1=mysql_query("select stud_id1 as stud_id,requestdate,points,reason,activity_type from tbl_request where stud_id2='$id' and flag='N' and entitity_id='112' and school_id='$school_id' order by id desc");
 if(mysql_num_rows($arr1)!=0 && !isset($_GET['report']) )
 { 
 ?>
<center>
  <h3 style="padding-top:20px;color:#2F329F;">Requests For Assigning Coordinator</h3></center>
  <?php
	while($post = mysql_fetch_assoc($arr1))
	{
	 $st_id=$post['stud_id'];
	 	$sql=mysql_query("select std_name,std_Father_name,std_lastname,std_complete_name,std_img_path from tbl_student where id='$st_id' and school_id='$school_id'");
		$value=mysql_fetch_array($sql);
	 ?>
 <div class="container" >  

 <div class="row" style="padding-top:20px;">
 <div class="col-md-2"></div>
<div class="col-md-10"  style="padding:20px; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4;">	
         <form method="post">    
             <div class="row">
            <div class="col-md-3">
            <?php if($value['std_img_path'] != ''){?>
                <img src="<?php echo $value['std_img_path'];?>" style="height:60;width:60;" class="preview">
                <?php }else {?> <img src="image/avatar_2x.png" width="50" height="50" style="border:1px solid #CCCCCC;" class="preview" alt="Responsive image"/> <?php }?></div>
                <div class="col-md-7"><b>
               <?php if($value['std_complete_name']=="")

				{

				echo ucwords(strtolower($value['std_name']." ".$value['std_Father_name']." ".$value['std_lastname']));
				}
				else
				{
				echo  ucwords(strtolower($value['std_complete_name']));	
				}

				?></b>
                </div>

                    <div class="col-md-2">  <input type="hidden" name="student_id" id="student_id" value="<?php echo $st_id?>" /></div>
            <div class="col-md-3" style="padding-top:10px;"><b>Request Date:</b></div>

                <div class="col-md-2" style="padding-top:10px;"> <input type="hidden" name="requestdate" id="requestdate" value="<?php echo $post['requestdate']?>" /><?php echo $post['requestdate']?></div>

              <div class="col-md-2" style="padding-top:40px;"><input type="submit" name="submit" value="Accept" class="btn btn-primary"></div>

               <div class="col-md-2" style="padding-top:40px;"><input type="submit" name="decline" value="Decline" class="btn btn-danger"></div>
             </div>

          </div>

             </div>

			 </div>

			 </form>
			 <?php }?>

			  <div style="color:#FF0000; font-weight:bold;padding-top:20px;" align="center" id="errorreport"><?php echo $report;?></div>
			 <?php }
			 if(isset($_GET['report']))
			 {?>
			  <div class="container" style="padding-top:150px;">
 <div class="row">
 <div class="col-md-3"></div>
 <div class="col-md-6"  style=" border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4; background-color:#FFFFFF;color:#FF0000; font-weight:bold;" align="center" >
  <div style="height:20px;"></div>
 <?php
 $report="Request successfully accepted";
  echo $report;  ?>
 <div style="height:20px;"></div>
 <div class="row">
 <div class="col-md-7"></div>
 <div class="col-md-5" style="font-size:12px;"> 
 <a href="coordinatorrequest_fromstudent.php"> Pending Requests</a>
 </div>
 </div>
 </div>
 </div>
 </div>			<?php }



			 if(mysql_num_rows($arr1)==0 && !isset($_GET['report']))



			 {



			 ?>



			 



			 <div class="container" style="padding-top:150px;">



 <div class="row">



 <div class="col-md-3"></div>



 



 <div class="col-md-6"  style=" border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4; background-color:#FFFFFF;color:#FF0000; font-weight:bold;" align="center" >



  <div style="height:20px;"></div>



 <?php echo "You don't have any request";  ?>



 <div style="height:20px;"></div>



 </div>



 



 



 



 



 </div>



 



 </div>



			 <?php } 



			 



			 ?>



</div>



</body>



</html>



