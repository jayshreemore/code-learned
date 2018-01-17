<?php
	include("cookieadminheader.php");
	
	$query = mysql_query("select * from tbl_school_admin where id = ".$_SESSION['id']);
		$value = mysql_fetch_array($query);
    		$school_id=$value['school_id'];
	        	$id=$_SESSION['id'];
				
				
				
if(isset($_POST['search']))
{
 
	$from_date = $_POST['from_date'];
	$to_date = $_POST['to_date'];

         //echo "</br>SELECT id,user_id,userType,school_id,reward_id,point,date FROM purcheseSoftreward where  date between '$from_date' and '$to_date'";
	if(!empty($from_date) && !empty($to_date))
	{
		$fetch_softreward=mysql_query("SELECT id,user_id,userType,school_id,reward_id,point,date FROM purcheseSoftreward where  date between '$from_date' and '$to_date'");
	}else{
		echo "<script type=text/javascript>alert('sry.. you didn't enter start and end date.'); window.location=''</script>";
	}
	//$getrow=mysql_query($fetch_softreward);
	
}
else
{


	$fetch_softreward=mysql_query("select * from purcheseSoftreward order by id");
	//$getrow=@mysql_query($fetch_softreward);
}


?>
<!DOCTYPE html><head>
 
   
  <!-- <link href='css/jquery.dataTables.css' rel='stylesheet' type='text/css'>

    <script src='js/jquery-1.11.1.min.js' type='text/javascript'></script>
    <script src='js/jquery.dataTables.min.js' type='text/javascript'></script>
    <script src="js/dataTables.responsive.min.js"></script>
    <script src="js/dataTables.bootstrap.js"></script>-->
   
      <script>
      $(document).ready(function(){
     $('#example').dataTable()
		  ({ 	
    		});
		});
	
   </script>
<style>
@media only screen and (max-width: 800px) {
    
    /* Force table to not be like tables anymore */
	#no-more-tables table, 
	#no-more-tables thead, 
	#no-more-tables tbody, 
	#no-more-tables th, 
	#no-more-tables td, 
	#no-more-tables tr { 
		display: block; 
	}
 
	/* Hide table headers (but not display: none;, for accessibility) */
	#no-more-tables thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
 
	#no-more-tables tr { border: 1px solid #ccc; }
 
	#no-more-tables td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
		white-space: normal;
		text-align:left;
	}
 
	#no-more-tables td:before { 
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
		text-align:left;
		
	}
 
	/*
	Label the data
	*/
	#no-more-tables td:before { content: attr(data-title); }
}
</style>



</head>

 

<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
 <link rel="stylesheet" href="css/bootstrap.min.css">
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
 
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script>
  $(function() {
    $( "#from_date" ).datepicker({
	  
      changeMonth: true,
      changeYear: true
    });
  });
  
  $(function() {
    $( "#to_date" ).datepicker({
	  
      changeMonth: true,
      changeYear: true,
	  
    });
  });
  </script>
<body>
<div class="container" >
<div class="row">

<div style="height:10px;"></div>

			
        	
        <div style="height:20px;"></div>
        
   <div style="height:10px;" ></div>
    	<div style="height:50px; background-color:#FFFFFF; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4;" align="left">
        	<h2 style="padding-left:20px; margin-top:2px;color:#666">Soft Reward Log</h2>
        </div>
        <div align="center">
        	        <form method="post" action="">
<label for="from">From</label>
<input type="text" id="from_date" name="from_date" placeholder="MM/DD/YYYY">
<label for="to">to</label>
<input type="text" id="to_date" name="to_date" placeholder="MM/DD/YYYY">
 &nbsp;&nbsp;
 <input type="submit" value="Search" name="search" id="search" />
 </form> </div>
      <div   class="container" style="padding-top:20px;">
       <?php
			
					
				
		/*	$i=0;
			$old_id=0;
			$sum=0;
			$teacher_id=0;
			$teachers_id=array();*/
			
			

             /*  $arrs = mysql_query("SELECT t.id,t.t_id, t_complete_name, tc_balance_point, sc_point, sc_entites_id FROM tbl_teacher t
LEFT JOIN tbl_student_point st ON t.id = st.sc_teacher_id WHERE (`t_emp_type_pid`='133' or `t_emp_type_pid`='132') AND school_id = '$school_id' and t.tc_balance_point!=0 ORDER BY t.t_complete_name ASC "); */
 

                /*$teachers_id=array();
				$teachers_name=array();
				$teachers_assign_point=array();
				$teachers_balance_point=array();
				while($teacher = mysql_fetch_array($arrs))
				{
				
					   $teacher_id=$teacher['t_id'];
					  
					   if($old_id==0)
					   {
					   $old_id =$teacher_id;
					   
					   }
			      if($teacher_id==$old_id)
				  {
				     $sum=$sum+$teacher['sc_point'];
				  }
				  
				 if($teacher_id!=$old_id)
				  {
				   $sum=0;
				   $i++;
				  }  
					 $teachers_id[$i]= $teacher_id; 
					 $teachers_name[$i] = $teacher['t_complete_name'];
					 $teachers_assign_point[$i]= $sum; 
					 $teachers_balance_point[$i]= $teacher['tc_balance_point'];
					 $old_id=$teacher_id;				 
				}
			*/
			
		                  
						
						  
						       
			  ?>
                 
                <table id="example" class="table-bordered table-striped table-condensed cf" align="center" style="width:100%">
           
       <thead>
        			
        	<tr style="background-color:#428BCA; color:#FFFFFF; height:30px;">
                	<th>Sr. No.</th>
                    <th>User Name</th>
                    <th>User type</th>
                    <th>Reward Name</th>
                    <th>Reward Image</th>
                    <th>Price</th>
                     <th>Purchase Date</th>
             </tr>
        			
       </thead>
       
       <tbody align="center">
               
                <?php 
				        $j="0";
				  
						                   while($getrow=mysql_fetch_array($fetch_softreward))
										   {
										             $user_id=$getrow['user_id'];
													 $userType=$getrow['userType'];
													 $school_id=$getrow['school_id'];
													 $reward_id=$getrow['reward_id'];
													 $price=$getrow['point'];
													 $purchaseDate=$getrow['date'];
										   
										 //  echo "select std_complete_name from tbl_student where std_PRN='$user_id'";
					 $fetch_softreward1=mysql_query("select std_complete_name from tbl_student where std_PRN='$user_id'");
						                   while($getrow1=mysql_fetch_array($fetch_softreward1))
										   {
										             $studentName=$getrow1['std_complete_name'];
													
										   }
				   $fetch_softreward2=mysql_query("select rewardType,imagepath from softreward where softrewardId='$reward_id'");
										   while($getrow2=mysql_fetch_array($fetch_softreward2))
										   {
													 $typereward=$getrow2['rewardType'];
													 $rewardimage=$getrow2['imagepath'];
													
										   }
				?>
                 <tr>
				    <td><?php echo $j+1; ?></td>
                    <td><?php echo ucwords($studentName); ?></td>
                    <td><?php echo ucwords($userType); ?></td>
                    <td><?php echo ucwords($typereward);?></td>
                    <td ><img src="<?php echo  $rewardimage ?>" name="star" height="75" width="75" class="img-responsive" ></td>
                    <td><?php echo $price;?></td>
                    <td><?php echo $purchaseDate; ?></td>
                </tr>
				
			
              
               
               <?php
			   $j++;
			   }
               
			   ?>
                </tbody>
        	   </table>
       </div>
      </div>
  </div>
  </div>
  </div>
  
</body>
  



</html>
