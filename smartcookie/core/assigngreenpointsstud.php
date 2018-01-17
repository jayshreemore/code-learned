<?php


			    include('scadmin_header.php');
                $bulk=$_POST['bulk_assign'];
				$result1="";

					$report="";
					$date = date('d/m/Y');
				
				$id=$_SESSION['id'];

				$query=mysql_query("select * from tbl_school_admin where id='$id'");

				$results=mysql_fetch_array($query);

				$school_id=$results['school_id'];



				$sql=mysql_query("select thanqu_flag from tbl_school_admin where school_id='$school_id'");

				$results=mysql_fetch_array($sql);

				$thanqu_flag=$results['thanqu_flag'];

				$st="St";

				$pos = strpos($thanqu_flag,$st);





?>

<html>

<!--<script>

$(document).ready(function() {

    $('#example').DataTable();

} );

</script>-->
<head>

<link href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.css" rel="stylesheet" type="text/css">
</link>

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>

<script>
  function select_choice()
{
		
		
	   var course =document.getElementById("bulk_assign").value;
	  		alert(course);
		if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
          }
        else
          {// code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
        xmlhttp.onreadystatechange=function()
          {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
			
         document.getElementById("Department1").innerHTML  =xmlhttp.responseText;
            }
          }
        xmlhttp.open("GET","get_branch_for_Student_asign_point.php?course="+course ,true);
        xmlhttp.send();
        
}
	  
</script>
    



<body>

<?php

if($pos !== false)

{ ?>

<!----Validation for Bluk Assign Point To Student ---->



<script>



 function validateForm()

  {

    

	 if(document.getElementById("bulk_assign").value == "")

   {

      alert("Please Select Dropdownlist For Assign Bluk Point To Students"); // prompt user

      document.getElementById("bulk_assign").focus(); //set focus back to control

      return false;

   }

   

   if(document.getElementById("point").value == "")

   {

      alert("Please Enter Point"); // prompt user

      document.getElementById("point").focus(); //set focus back to control

      return false;

   }

   

} 





</script>

<!------------------------END------------------------->

<!--------------------------------------------------------------------Show Site Bar--------------------------->


<?php





if(isset($_POST['Assign']))

{

		if(isset($_POST['point']) && $bulk=='all')

			 { 

			       
                    
			 		 //$Degree=$_POST['bulk'];
                    
					$sql=mysql_query("select school_balance_point,school_assigned_point from tbl_school_admin where id='$id' and school_id='$school_id'");

		            $arr=mysql_fetch_array($sql);

		             $school_balance_point=$arr['school_balance_point'];
					 $green_points_assigned=$arr['school_assigned_point'];

		

     				//echo "</br>select count(id) from tbl_teacher where school_id='$school_id' AND t_dept='$dept'";

					 $abc=mysql_query("select count(id) as total_count from tbl_student where school_id='$school_id'");

					 $ab=mysql_fetch_array($abc);

					
                      // echo $ab['total_count']."<br>";
					 //$ab['count(id)'];

					 //$nowrows=mysql_num_rows($abc);

				     $points=$_POST['point']*$ab['total_count'];

					 $point=$_POST['point'];
					 //echo $point."<br>";
                      // echo $points;
					if($points>=$school_balance_point)

					{

					$report="You have Insufficient Balance Points!!!";

					}

					 else

						{

					     $abc=mysql_query("select std_PRN from tbl_student where school_id='$school_id'");
					     while($row2=mysql_fetch_array($abc))
							{
								$stud_id=$row2['std_PRN'];
								if($points<=$school_balance_point)
								{
									$sql=mysql_query("Select sc_total_point from `tbl_student_reward` where sc_stud_id='$stud_id' and school_id='$school_id'");
									$result1=mysql_fetch_array($sql);
									$balance_greenstud_points=$result1['sc_total_point'];
									$final_greenstud_points=$balance_greenstud_points+$point;
									$get_stud_info=mysql_query("select `id` from tbl_student_reward where `sc_stud_id`='$stud_id' and school_id='$school_id'");
									if(mysql_num_rows($get_stud_info)==0)
								   {
									 $insert_stud_rewards="INSERT INTO `tbl_student_reward` (sc_total_point,sc_stud_id,sc_date,school_id)
									 VALUES ('$point','$stud_id','$date','$school_id')";
									 $result_insert11 = mysql_query($insert_stud_rewards) or die(mysql_error());
									}else{
									 
											 $sql1=mysql_query("update tbl_student_reward set sc_total_point='$final_greenstud_points' where sc_stud_id='$stud_id' and school_id='$school_id'");
											 $updatecount=mysql_affected_rows();
												 	 
												  
												 
									
									}
	
									

								}else{break;}
								
								    

	                            $log = "insert into `tbl_student_point` (sc_stud_id,sc_entites_id,sc_point,point_date,school_id,reason) values('$stud_id','$id','$points','$date','$school_id','assigned by school admin')" ;
                                $que= mysql_query($log);

							}
							    $report11="$points Points are given successfully";	
							    $final_green_points=$school_balance_point;
								$sql1=mysql_query("update tbl_school_admin set school_balance_point='$final_green_points' where id='$id'");
								$result1="Sucessfully Assigned Point To All Students.. ";
								$school_assigned_point=$green_points_assigned+$points;
								$b=mysql_query("update tbl_school_admin set school_assigned_point='$school_assigned_point' where id='$id'");
												
						}  
			 }
			   else 	   

			   {
                  if(isset($_POST['point']))	
				  {
					  						 
						 
						$sql=mysql_query("select school_balance_point,school_assigned_point from tbl_school_admin where id='$id' and school_id='$school_id'");
						$arr=mysql_fetch_array($sql);
						$school_balance_point=$arr['school_balance_point'];
						$assigned_points_details=$arr['assigned_points_details'];
						
						 $abc=mysql_query("select count(id) as total_count from tbl_student where school_id='$school_id' and std_branch='$bulk'");
						 $ab=mysql_fetch_array($abc);

						 $points=$_POST['point']*$ab['total_count'];
						
						 $point=$_POST['point'];
						 

							if($points>=$school_balance_point)

							{

							 $report="You have Insufficient Balance Points!!!";

							}else

								{
									
	 
									 $abc=mysql_query("select std_PRN from tbl_student where school_id='$school_id' and std_branch='$bulk'");
									 while($row2=mysql_fetch_array($abc))
										{
											 $stud_id=$row2['std_PRN'];
											if($points<=$school_balance_point)
											{
												$sql=mysql_query("Select sc_total_point from `tbl_student_reward` where sc_stud_id='$stud_id' and school_id='$school_id'");
												$result1=mysql_fetch_array($sql);
												$balance_greenstud_points=$result1['sc_total_point'];
												$final_greenstud_points=$balance_greenstud_points+$point;
												$get_stud_info=mysql_query("select `id` from tbl_student_reward where `sc_stud_id`='$stud_id' and school_id='$school_id'");
												if(mysql_num_rows($get_stud_info)==0)
											   {
												 $insert_stud_rewards="INSERT INTO `tbl_student_reward` (sc_total_point,sc_stud_id,sc_date,school_id)
												 VALUES ('$point','$stud_id','$date','$school_id')";
												 $result_insert11 = mysql_query($insert_stud_rewards) or die(mysql_error());
												}else{
											 
													 $sql1=mysql_query("update tbl_student_reward set sc_total_point='$final_greenstud_points' where sc_stud_id='$stud_id' and school_id='$school_id'");
													 $updatecount=mysql_affected_rows(); 
													
										           
													}
	 
									

											}else{break;}
                                             $log = "insert into `tbl_student_point` (sc_stud_id,sc_entites_id,sc_point,point_date,school_id) values('$stud_id','102','$points','$date','$school_id')" ;
                                             $que= mysql_query($log);
										}
										$report11="$points Points are given successfully";	
										$final_green_points=$school_balance_point-$points;
										$a=mysql_query("update tbl_school_admin set school_balance_point='$final_green_points' where id='$id'");
										$result1="Sucessfully Assigned Point to all $bulk branch Students.. ";
										$school_assigned_point=$assigned_points_details+$points;
										$b=mysql_query("update tbl_school_admin set school_assigned_point='$school_assigned_point' where id='$id'");  
								    
 
	 

								

							}   
		   
				  }
	            // header("location:teacherassign.php"); 

				}

 
}
 
?>

</head>

<script>

$(function() {   



    $("#teacher").change(function() {

  var bulk= document.getElementById('teacher').value;

	// document.category.submit();

	   // document.forms["category"].submit();

	  	   		MyAlert(bulk);



    })



});

</script>

 <script>

       $(document).ready(function() 

	   {

	    $('#example').DataTable();

});

        </script>

<body>

<div class="container">

<div class="row" style="padding-top:10px;"></div>

<div class="col-md-12">

<div class="col-md-4">



<div class="panel panel-default">

<div class="panel-heading h4"><center><?php echo $dynamic_school;?> Points</center></div>



<div class="panel-body">

		<a href="#" class="list-group-item">Balance Points

        <span class="badge">

		

       <?php

    

		$sql=mysql_query("select school_balance_point from tbl_school_admin where school_id='$school_id'");

		$arr=mysql_fetch_array($sql);

		$school_balance_point=$arr['school_balance_point'];

		echo $school_balance_point;

		

		?>  

        </span></a>

      

		

         <a href="#" class="list-group-item">Assigned Points

        <span class="badge"><?php



		$sql1=mysql_query("select school_assigned_point from tbl_school_admin where school_id='$school_id'");

		$arr1=mysql_fetch_array($sql1); 

		$school_assigned_point=$arr1['school_assigned_point'];

		echo $school_assigned_point;

		

		?>  </span></a>

         

        </div>

    </div>

<form action="" name="bulk" id="bulk" method="POST" onSubmit="return validateForm()"> 

<div class="panel panel-default">

<div class="panel-heading h4"><center>Bulk Assign Point</center></div>



<div class="panel-body">





<div class="row1 form-inline" style="padding-top:20px;"> 

<div style="float:left" style="padding-top:30px;">Select <?php echo $dynamic_student;?></div>

	     
        
          <select name="bulk_assign" id="bulk_assign" class="form-control" style="width:140px;" ><!--onChange="select_choice()"-->
           
		   <?php $sql11=mysql_query("SELECT DISTINCT `std_branch`,school_id FROM `tbl_student` where `std_branch`!=' ' AND `school_id`='$school_id'");?>
           
		   <option value="" disabled selected>Select</option>
          
           <option value="all">All Students</option>
		     <?php while($r=mysql_fetch_array($sql11)){ ?> 
           <option value="<?php echo $r['std_branch']; ?>"><?php echo $r['std_branch']; ?></option>
            <?php }?>
           </select>

          

    </div>

&nbsp;

  <div id="Department1">

 </div> 

 

  

    <div class="row1 form-inline" style="padding-top:20px;">  

		 <div style="float:left">Enter Points</div>&nbsp;&nbsp;

     <input type="text" name="point" id="point"  style="width:120px;" class="form-control" >

     </div>

       </br><div align="center"><input type="submit" class="btn btn-default btn-sm" name="Assign" id="Assign" value="Assign"></div>

	    </form>
         <div style="color:#006600;" class="row1">

		 <?php 
           echo $report11."<br>";
		   
		   echo  $report; 

		   echo  $result1;

		 ?> 

       

       

        </div>

        </div></div>

        </div>





<div class="col-md-8"> 





<!--------------------------------------------------Show Blue Point Of Student List------->

<div class="container" style="padding-top:70px;">

<table id="example" class="display" cellspacing="0" width="100%">

        <thead>
						
            <tr>

            <th style="width:5%">Sr.No</th>

                <th><?php echo $dynamic_student;?> ID</th>

                <th><?php echo $dynamic_student;?> Name</th>

                <th style="width:20%">Email ID</th>

               <!--<th style="width:10%">Class</th>-->

               <!-- <th style="width:15%">Used Green Points</th>-->

                <th style="width:20%">Balance Green Points</th>
					<th style="width:20%">Assign</th>
             </tr>

        </thead>

 <tbody>

        <?php
//echo "Select s.school_id,s.id,std_email,std_PRN,std_complete_name,std_name,std_Father_name,std_lastname,rs.`sc_total_point` from tbl_student s LEFT JOIN tbl_student_reward rs on rs.`sc_stud_id`=s.id where s.school_id='$school_id' group by s.std_PRN order by s.std_name ASC ";
		$sql=mysql_query("Select s.school_id,s.id,std_email,std_PRN,std_complete_name,std_name,std_Father_name,std_lastname,rs.`sc_total_point` from tbl_student s LEFT JOIN tbl_student_reward rs on rs.`sc_stud_id`=s.std_PRN where s.school_id='$school_id' group by s.std_PRN order by s.std_name ASC  ");

		$i=1;

						 while($result=mysql_fetch_array($sql))

						 { 

									  $firstname=$result['std_name'];

									  $fathrname=$result['std_Father_name'];

									  $lastname=$result['std_lastname'];

									  $studentName=$firstname." ".$fathrname." ".$lastname;

						 ?>

<!--<tr onClick="document.location = 'studassigngreenpoints.php?std_id=<?php //echo $result['std_PRN'];?>&sc_id=<?php// echo $result['school_id'];?>&row_id=<?php //echo $result['id'];?>'">  -->

                             <td><?php echo $i;?></td>

                             </td><td ><?php echo $result['std_PRN'];?></td>

                             <td><?php $coplitename=$result['std_complete_name'];

									 if($coplitename=="")

									 {echo ucwords(strtolower($studentName)); } else { echo ucwords(strtolower($coplitename));}

									  ?></td>

                             <td><?php echo $result['std_email'];?></td>

                             <!--<td><?php //echo $result['used_blue_points'];?> </td>-->

                             <td> <?php if($result['sc_total_point']==""){ echo "0";}else { echo $result['sc_total_point'];  }?> </td>
								
								<td>
                                <center>
								   <a href="studassigngreenpoints.php?std_id=<?php echo $result['std_PRN'];?>&sc_id=<?php echo $result['school_id'];?>&row_id=<?php echo $result['id'];?>">
                                        <input type="button" value="Assign" name="assign"/></a>
										
								</center>
                            </td>
                       </tr></a>

                  <?php $i++; }?>

        </tbody>

</table>

</div>



<?php 

 }
 
 else 
 
 {
	 
	 ?>

 

 <div class="container" style="padding-top:150px;">

 <div class="row">

 <div class="col-md-3"></div>

 <div class="col-md-6"  style=" border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4; background-color:#FFFFFF;color:#FF0000; font-weight:bold;" align="center" >

 <div style="height:20px;"></div>

 <?php echo "You do not have permission to assign Green Points to Student!...  "?>

 <div style="height:20px;"></div>

 </div>

 </div>

 </div>

<?php
 
 }

 ?>


</body>

</html>





