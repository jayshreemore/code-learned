<?php include("header.php");



$teacher_id=$_SESSION['id'];



$sql=mysql_query("select id,t_id,school_id from tbl_teacher where id='$teacher_id'");

$result=mysql_fetch_array($sql);

$t_id=$result['t_id'];
$teacher_id=$result['id'];
 $school_id=$result['school_id'];

 if(!isset($_SESSION['id']))

	{

		header('location:login.php');

	}

	

	

	

	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Untitled Document</title>





 <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">

        <meta name="viewport" content="width=device-width, initial-scale=1">

 

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  

  

		<script src="js/jquery-1.11.1.min.js"></script>

        <script src="js/jquery.dataTables.min.js"></script>









<head>





    <script>

	

        $(document).ready(function() {

            $('#example').dataTable( {

		

				

         });

			$('#example1').dataTable( {

		

				

         });

			

  

        } );

		

		

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

<body style="background-color:#FFFFFF;">

<div class="container">

    <div  style="width:100%;">

      

    	<div style=" background-color:#ccc; border:1px solid #CCCCCC;" align="left">

        	<h2 style="padding:7px 0px; font-size:22px ;margin:5px 0px; color:white;text-align:center;background-color:#2F329F;">My Blue Points Recieved Log   </h2>

      

       </div>
 

                <table id="example" class="col-md-10 table-bordered table-striped table-condensed cf" align="center" style="width:100%">

        	<thead class="cf">

            	<tr style="background-color:#6666CC; color:#FFFFFF; height:30px;">

                	<th>Sr. No.</th>

                    <th>Name</th>
                    <th><?php echo $dynamic_student.'/'.$dynamic_teacher.'/'.$dynamic_school_admin?></th>

	
					
                     <th>ThanQ Reason</th>

                    <th>Points</th>

               

                    <th>Point Date</th>

                   

                </tr>

               </thead>

 <?php
 $sum=0;
		$i=0;
	$arr = mysql_query("select t.name,sp.sc_thanqupointlist_id,t.school_id, sp.sc_point,sp.point_date from tbl_teacher_point sp join tbl_school_admin t where sp.assigner_id=t.id and sp.`sc_entities_id`='102' and sp.sc_teacher_id='$t_id'  order by sp.id desc");
           
		//echo"select t.name,sp.sc_thanqupointlist_id,t.school_id, sp.sc_point,sp.point_date from tbl_teacher_point sp join tbl_school_admin t where sp.assigner_id=t.id and sp.`sc_entities_id`='102' and sp.sc_teacher_id='$t_id'  order by sp.id desc";		
		while($row = mysql_fetch_array($arr))

				{

				$i++;
				 $sum = $sum + $row['sc_point'];

				?>

                <tr>

                	<td ><b><?php echo $i;?></b></td>

                   

                    <td ><b><?php echo $row['name'];?></b></td>
                    <td><b>Admin</b></td>

                    <td ><b><?php  $sc_thanqupointlist_id=$row['sc_thanqupointlist_id'];

					$school_id=$row['school_id'];

					$sql=mysql_query("select t_list from tbl_thanqyoupointslist where id='$sc_thanqupointlist_id' and school_id='$school_id'");

					$result=mysql_fetch_array($sql);

					echo ucfirst($result['t_list']);
				 ?></b></td>
                <td ><b><?php echo $row['sc_point'];?></b></td>
                
                <td ><b><?php echo $row['point_date'];?></b></td>
                
                
            </tr>
           

                <?php

				}

    $arr=mysql_query( "select t.std_name,t.std_Father_name,t.std_lastname ,t.std_complete_name ,t.school_id,sp.sc_thanqupointlist_id, sp.sc_point,sp.point_date from tbl_teacher_point sp join tbl_student t where sp.assigner_id=t.std_PRN and sp.`sc_entities_id`='105' and sp.sc_teacher_id='$t_id' and t.school_id='$school_id' and sp.sc_thanqupointlist_id!=0 order by sp.id desc" ); 
	//echo"select t.std_name,t.std_Father_name,t.std_lastname ,t.std_complete_name ,t.school_id,sp.sc_thanqupointlist_id, sp.sc_point,sp.point_date from tbl_teacher_point sp join tbl_student t where sp.assigner_id=t.std_PRN and sp.`sc_entities_id`='105' and sp.sc_teacher_id='$t_id' and t.school_id='$school_id' and sp.sc_thanqupointlist_id!=0 order by sp.id desc ";

	$j=$i;

while($row = mysql_fetch_array($arr))

				{

				$j++;
				$sum = $sum + $row['sc_point'];
				?>

				

                <tr>

                <td ><b><?php echo $j;?></b></td>

                   

                    <td ><b><?php

					if($row['std_complete_name']=="")

					{

					 $std_name=ucwords(strtolower($row['std_name']." ".$row['std_Father_name']." ".$row['std_lastname']));

					}

					else

					{

						$std_name=ucwords(strtolower($row['std_complete_name'])); 
						

					}

					

					echo $std_name ; 

					?> </b></td>
                    <td><b><?php echo $dynamic_student; ?></b></td>

                    <td ><b><?php  $sc_thanqupointlist_id=$row['sc_thanqupointlist_id'];

					$sql=mysql_query("select t_list from tbl_thanqyoupointslist where id='$sc_thanqupointlist_id' and school_id='$school_id'");

					$result=mysql_fetch_array($sql);

					echo ucfirst($result['t_list']);

					

					

					 ?>
                     </b>
                     </td>

                 

                    <td ><b><?php echo $row['sc_point'];?></b></td>

                 

                     <td ><b><?php echo $row['point_date'];?></b></td>

              </tr>

           

                <?php

				}?>
                
                <?php
                $k=$j;
				
				$arr= mysql_query("select t.t_complete_name,sp.reason,sp.sc_point,sp.point_date,sp.assigner_id from tbl_teacher t join tbl_teacher_point sp on t.id=sp.sc_teacher_id where sp.sc_teacher_id='$teacher_id' and sp.sc_entities_id='103'");
		
				
				while($row = mysql_fetch_array($arr))
				{
					 $assigner_name= $row['assigner_id'];
					$arr1= mysql_query("select t.t_complete_name from tbl_teacher t join tbl_teacher_point sp on t.id=sp.sc_teacher_id where sp.sc_teacher_id='$assigner_name' and sp.sc_entities_id='103'");
					
					$res=mysql_fetch_array($arr1);
					
					$k++;
				 $sum = $sum + $row['sc_point'];

					?>
					<tr>
                    <td ><b><?php echo $k;?></b></td>
					     <td ><b><?php echo $res['t_complete_name'];?></b></td>
                         <td><b>Teaher</b></td>
                        <?php  $sc_thanqupointlist_id=$row['sc_thanqupointlist_id'];

					$school_id=$row['school_id'];

					$sql=mysql_query("select t_list from tbl_thanqyoupointslist where id='$sc_thanqupointlist_id' and school_id='$school_id'");

					$result=mysql_fetch_array($sql);

					echo ucfirst($result['t_list']);

					

					

					 ?>
                     <td ><b><?php echo $row['reason'];?></b></td>
                    
					   <td ><b><?php echo $row['sc_point'];?></b></td>
                      
                     <td ><b><?php echo $row['point_date'];?></b></td>
					 </tr>

           

                <?php

				}?>
                
                <?php
                
				
				$i=$k;
	//"select t.std_name,t.std_Father_name,t.std_lastname ,t.std_complete_name ,t.school_id,sp.sc_thanqupointlist_id, sp.sc_point,sp.point_date from tbl_teacher_point sp join tbl_student t where sp.assigner_id=t.std_PRN and sp.`sc_entities_id`='105' and sp.sc_teacher_id='$t_id' and t.school_id='$school_id' and sp.sc_thanqupointlist_id!=0 order by sp.id desc"
	
	$sql=mysql_query("select id,t_id,school_id from tbl_teacher where id='$teacher_id'");

$result=mysql_fetch_array($sql);

$school_id=$result['school_id'];
	/*echo "select p.name,p.Father_name,sp.sc_thanqupointlist_id, sp.sc_point,sp.point_date from tbl_teacher_point sp join tbl_parent p on sp.assigner_id=p.Id  where sp.`sc_entities_id`='106' and sp.sc_teacher_id='$t_id'  and sp.sc_thanqupointlist_id!=0 order by sp.id desc ";*/
	//echo  "select p.name,p.Father_name,sp.sc_thanqupointlist_id, sp.sc_point,sp.point_date from tbl_teacher_point sp join tbl_parent p on sp.assigner_id=p.Id  where sp.`sc_entities_id`='106' and sp.sc_teacher_id='$t_id' and p.school_id='$school_id' and sp.sc_thanqupointlist_id!=0 order by sp.id desc ";
				
		$arr1 = mysql_query( "select p.name,p.Father_name,sp.sc_thanqupointlist_id, sp.sc_point,sp.point_date from tbl_teacher_point sp join tbl_parent p on sp.assigner_id=p.Id  where sp.`sc_entities_id`='106' and sp.sc_teacher_id='$t_id' and p.school_id='$school_id' and sp.sc_thanqupointlist_id!=0 order by sp.id desc ");
				
				while($row1 = mysql_fetch_array($arr1))

				{

				$i++;
				 $sum = $sum + $row1['sc_point'];

				?>

                <tr>

                	<td ><b><?php echo $k;?></b></td>

                   

                    <td ><b><?php echo $row1['name'];?></b></td>
                    <td><b>parent</b></td>
                 

                    <td ><b><?php  $sc_thanqupointlist_id=$row1['sc_thanqupointlist_id'];

					//$school_id=$row1['school_id'];
					
					
				

					$sql=mysql_query("select t_list from tbl_thanqyoupointslist where id='$sc_thanqupointlist_id' and school_id='$school_id'");
					//echo "select t_list from tbl_thanqyoupointslist where id='$sc_thanqupointlist_id' and school_id='$school_id'";

					$result=mysql_fetch_array($sql);

					echo ucfirst($result['t_list']);
				 ?></b></td>

                   
                <td ><b><?php echo $row1['sc_point'];?></b></td>
                
                <td ><b><?php echo $row1['point_date'];?></b></td>
                
                
            </tr>
				
				<?php
				}
				?>
                
                            
                
<div class="container">
  
<center> <h2>Total</h2> <button type="button" class="btn btn-primary"> <span class="badge"><?php echo $sum;?></span></button></center>
                            
</table>
    </div>

    

  </div>

</div>
               </div> 





</body>



</html>

