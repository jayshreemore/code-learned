<?php include_once("header.php");

  if(!isset($_SESSION['id']))
	 {
	 	header('Location:login.php');
	 }
	 $server_name = $_SERVER['SERVER_NAME'];
$id=$_SESSION['id'];
$rid=$_SESSION['rid'];
//echo var_dump($_SESSION)."<br>";;
$report="";
$report1="";
$t_id=$_GET['t_id'];
$query=mysql_query("select * from tbl_teacher where t_id='$t_id'");
$result=mysql_fetch_array($query);
$teacher_id=$result['id'];
$t_name=$result['t_complete_name'];
$school_id=$result['school_id'];
$name=$result['t_name'];

 $test=mysql_query("select t_complete_name, balance_blue_points ,t_id from  tbl_teacher  where id='$id'");
  $results=mysql_fetch_array($test);
		   $sc_total_point=$results['balance_blue_points'];
		    $t_complete_name=$results['t_complete_name'];



if(isset($_POST['submit']))
	{
		
	/*$date=Date('m/d/Y');
	$points=$_POST['points'];
	$comment=$_POST['comment'];
	
	if($points<=$sc_total_point)
	{
	    
		
		
		$sc_final_point=$result['balance_blue_points']+$points;
		$sql1=mysql_query("update tbl_teacher set balance_blue_points='$sc_final_point' where id='$t_id'");
		
		
		
		
		
		$sc_share_point=$sc_total_point-$points;
		$query=mysql_query("update tbl_teacher set balance_blue_points='$sc_share_point' where id='$id'");
		


		$test=mysql_query("insert into tbl_teacher_point(sc_entities_id,sc_point,sc_teacher_id,assigner_id,reason,point_date) values('103','$points','$t_id','$id','$comment','$date')");
	
        

	  $report="$points Points are shared succesfully";
	header("Location:shareblue.php?report=".$report."&t_id=".$t_id);
	
	}
	else
	{
	 $report1="Points are insufficient for sharing ";
	}
	*/
	$data = array('t_id'=>$_SESSION['rid'],
	't_id2'=>$_GET['t_id'],
	'points'=>$_POST['points'],
	'reason'=>$_POST['comment'],
	 'point_type'=>$_POST['point_type'],
	 'school_id'=>$_SESSION['school_id']);	
	//echo var_dump($data)."<br>";
	 //echo"teacher_id";
	 //echo"t_id";
					$ch = curl_init("https://$server_name/core/Version2/teacher_share_points.php"); 						
					$data_string = json_encode($data);      
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     						
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  						
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      						
					curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                        							
					'Content-Type: application/json',                                                                                							
					'Content-Length: ' . strlen($data_string))                                                                					
					); 						
					$result = json_decode(curl_exec($ch),true);						
					//var_dump($result);					
					echo $responce = $result["responseStatus"];						
					//echo '2';											
					if($responce==200)						{							
				//	$server_name = $_SERVER['SERVER_NAME'];
					//echo $server_name;
					
					echo "<script>alert('point assign successfully');location.assign('https://$server_name/core/share_blue_points.php');
					</script>";	
					}					
					//echo "78654";
					
					
					
				
								 ///calling  master action log
			 
			 /*$sq=mysql_query("select t_complete_name,id from tbl_teacher where t_id='$id' and school_id='$school_id'");
									$rows1=mysql_fetch_assoc($sq);
									$t_id1=$rows1['id'];
									$t_name1=$rows1['t_complete_name'];*/
			 
			 $server_name = $_SERVER['SERVER_NAME'];
			 
							
									$data = array('Action_Description'=>'Share points with Teacher',
												'Actor_Mem_ID'=>$id,
												'Actor_Name'=>$t_complete_name,
												'Actor_Entity_Type'=>103,
												'Second_Receiver_Mem_Id'=>$teacher_id,
												'Second_Party_Receiver_Name'=>$t_name,
												'Second_Party_Entity_Type'=>103,
												'Third_Party_Name'=>'',
												'Third_Party_Entity_Type'=>'',
												'Coupon_ID'=>'',
												'Points'=>$_POST['points'],
												'Product'=>'',
												'Value'=>'',
												'Currency'=>''
							);
							
							$ch = curl_init("https://$server_name/core/Version2/master_action_log_ws.php"); 	
							
							
							$data_string = json_encode($data);    
							curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");    
							curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);  
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);      
							curl_setopt($ch, CURLOPT_HTTPHEADER, array('ContentType: application/json','ContentLength: ' . strlen($data_string)));
							$result = json_decode(curl_exec($ch),true);
			 
			 //end	
	
	}
	
	







?>
<head>

 <script>
	function valid()
	{
		
if ( document.getElementsByName('point_type')[0].value == 'Select' )
{
	
			document.getElementById('errorreport').innerHTML="Please select point";
	       return false;
	
	
}
		/*var point_type=document.getElementById('point_type').value;
		if(point_type=='Bluepoint'  || point_type=='Waterpoint')
		{
			
			document.getElementById('errorreport').innerHTML="Please select point";
	       return false;
			
		}
		else
	   {
	   document.getElementById('errorreport').innerHTML='';
	   }*/
		
		
		
	var points=document.getElementById('points').value;
		var comment=document.getElementById('comment').value;
		
		if(comment=="" || comment==null)
	{
	document.getElementById('errorreport').innerHTML="Please enter Reason";
	return false;
	
	}
	
	var letters =   /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
   if(!comment.match(letters))  
     {  
	 document.getElementById('errorreport').innerHTML='Please Enter valid Reason';
      return false;  
     }  
	 else
	 {
	 document.getElementById('errorreport').innerHTML='';
	 }
		
	
	if(points=="" || points==null )
	{
	document.getElementById('errorreport').innerHTML="Please enter Points";
	return false;
	
	}
	
	if(points==0)
	
	{
	 document.getElementById('errorreport').innerHTML="Please enter valid Points";
      return false;  
	}
	else
	{
	 document.getElementById('errorreport').innerHTML="";
	}
	
	var numbers = /^[0-9]+$/;  
      if(!points.match(numbers))  
      {  
    document.getElementById('errorreport').innerHTML="Please enter valid Points";
      return false;  
      }  

	
	
	
	
	
	
	}
	</script>
    
    <script>

		
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
</script>
<script>
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

</script>


</head>

<body style="background-color:#fff;">
<div class="container" style="padding-top:50px;">
<div class="row">
	 <div class="col-sm-3" style="padding:10px; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4;">
         <div  style="height:50px; background-color:#6666CC; border:1px solid #6666CC;color:#FFFFFF" align="left">
        		<div style="float:left;"><h4 style="padding-left:20px; margin-top:10px;"> My Balance Blue Points</h4></div>
          </div> 
           <div align="center" style="padding-top:20px;font-size:40px;color:#0066FF;">
           <?php $sql=mysql_query("select balance_blue_points from  tbl_teacher  where id='$id'");
		   $results=mysql_fetch_array($sql);
		   $sc_total_point=$results['balance_blue_points'];
		   echo $sc_total_point ;
		    ?> 
		  
           
            </div>  
              <div align="center" style="color:#6666CC;font-size:20px;margin-top:15px;">Points</div>    
       	    </div><div class="col-md-2"></div>
		<div class="col-md-5" style="border:1px ridge #999999;">
        <div class="row" align="center" ><h3 style="margin-top:15px"><?php if($result['t_complete_name']=="")
		{
			echo ucwords(strtolower($result['t_name']." ".$result['t_middlename']." ".$result['t_lastname']));
		}
else{
	echo ucwords(strtolower($result['t_complete_name']));
}		
		
		
		?></h3></div>
		<?php $sql2=mysql_query("select t_complete_name,t_name,t_middlename,t_lastname from tbl_teacher where t_id='$t_id' and school_id='$school_id'");
		   $result=mysql_fetch_array($sql2);
		   $t_complete_name=$result['t_complete_name'];
		   echo $t_complete_name;
		   if($result['t_complete_name']=="")
		   {
			  ?><b>teacher name:</b> <?php echo ucwords(strtolower($result['t_name']." ".$result['t_middlename']." ".$result['t_lastname'])); 
			   
		   }?>
		   <!--addedd name-->
        
        <div class="row" style="padding-top:10px;">
        <div class="col-md-5"><b><?php echo ($_SESSION['usertype']=='Manager')? 'Organization Name:':'School Name:';?></b></div>
		
		   <div class="col-md-5">
		<?php echo $_SESSION['school_id'];?></div>
        </div>
        
         
      
     
        
        
        <div class="row" style="padding-top:20px;">
        <div class="col-md-5"><b>Balance Blue Points:</b></div>
		
		   <div class="col-md-3"><?php 
		 
		   $sql2=mysql_query("select balance_blue_points from tbl_teacher where t_id='$t_id' and school_id='$school_id'");
		   $result=mysql_fetch_array($sql2);
		   $balance_blue_points=$result['balance_blue_points'];
		   echo $balance_blue_points;
		   ?>
           
		</div>
        </div>
        
        <form method="post">
         <div class="row" style="padding-top:10px;">
        <div class="col-md-5"><b>Reason:</b></div>
		<div class="col-md-12">
		   <br><textarea class="form-control" rows="5" id="comment" name="comment" style="resize:none"></textarea><br><br>
		    <b>Select point</b>
			<select name='point_type' id='point_type'>
  <option value='Select'>Select Option</option>  
  <option value='Bluepoint'>Blue points</option> 
  <option value='Waterpoint'>Water Points</option> 
  </select>
        
        
        
        
        <div class="row" style="padding-top:5px;">
        <div class="col-md-2"><b>Points:</b></div>
		
        
		   <div class="col-md-5">
        <input type="text" name="points" id="points" class="form-control"  onkeypress="return isNumberKey(event)">
		</div>
        </div>
        
        
        
        <div class="row" style="padding-top:30px;" align="center">
       <input type="submit" name="submit" id="submit" value="Share" class="btn btn-primary" onClick="return valid();">
  <a href="share_blue_points.php" style="text-decoration:none"> <input type="button" name="cancel" id="submit" value="Back" class="btn btn-danger" ></a>
		</div>
        </form>
       <div style="color:#060; font-weight:bold;padding-top:10px;" align="center" ><?php if(isset($_GET['report'])){ echo $_GET['report']; }?></div>
       
       <div style="color:#FF0000; font-weight:bold;padding-top:20px;" align="center" id="errorreport"><?php echo $report1;?></div>
        <div class="row" style="padding-top:10px;"></div>
        </div>
 <?php 
	if(isset($_GET['report']))
	{

	$test1=mysql_query("select * from tbl_teacher_point where sc_teacher_id='12' and assigner_id='1'and sc_entities_id='103' order by id desc limit 1");
	$result1=mysql_fetch_array($test1);
	
	?>
	 <a href="https://twitter.com/share" class="twitter-share-button" data-url="https://smartcookie.in" data-text="I am sharing my <?php echo $result1['sc_point'];?> Blue points to <?php echo $name;?> for <?php  echo $result1['reason'];?>" data-size="large" data-hashtags="smartcookieprogram">Tweet</a>
<?php	}
	
	
	?>


</div>
</div>
</body>

