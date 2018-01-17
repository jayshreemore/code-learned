<?php include("header.php");



$teacher_id=$_SESSION['id'];



$sql=mysql_query("select t_id,school_id from tbl_teacher where id='$teacher_id'");

$result=mysql_fetch_array($sql);

$t_id=$result['t_id'];
$school_id=$result['school_id'];
//echo $school_id;

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

        	<h2 style="padding:7px 0px; font-size:22px ;margin:5px 0px; color:#666;text-align:center;">My Blue Points</h2>

      

       </div>

       

       

       <ul class="nav nav-tabs" style="padding-top:20px;">

         <li class="active"><a data-toggle="tab" href="#menu1"><?php echo $dynamic_student;?></a></li>

    <li ><a data-toggle="tab" href="#home"><?php echo $dynamic_school_admin;?></a></li>

   

  

  </ul>



         

  <div class="tab-content">

    <div id="home" class="tab-pane fade">

     

       <div id="no-more-tables" style="padding-top:20px;">

          

                <table id="example" class="col-md-10 table-bordered table-striped table-condensed cf" align="center" style="width:100%">

        	<thead class="cf">

            	<tr style="background-color:#6666CC; color:#FFFFFF; height:30px;">

                	<th>Sr. No.</th>

                    <th><?php echo $dynamic_school_admin;?> Name</th>

                     <th>ThanQ Reason</th>

                    <th>Points</th>

               

                    <th>Point Date</th>

                   

                </tr>

               </thead>

 <?php

				

			$i=0;

			

				$arr = mysql_query("select t.name,sp.sc_thanqupointlist_id,t.school_id, sp.sc_point,sp.point_date from tbl_teacher_point sp join tbl_school_admin t where sp.assigner_id=t.id and sp.`sc_entities_id`='102' and sp.sc_teacher_id='$t_id'  order by sp.id desc");

				while($row = mysql_fetch_array($arr))

				{

				$i++;

				?>

                <tr>

                	<td ><?php echo $i;?></td>

                   

                    <td ><?php echo $row['name'];?></td>

                    <td ><?php  $sc_thanqupointlist_id=$row['sc_thanqupointlist_id'];

					//$school_id=$row['school_id'];

					$sql=mysql_query("select t_list from tbl_thanqyoupointslist where id='$sc_thanqupointlist_id' and school_id='$school_id'");

					$result=mysql_fetch_array($sql);

					echo ucfirst($result['t_list']);

					

					

					 ?></td>

                 

                    <td ><?php echo $row['sc_point'];?></td>

                 

                     <td ><?php echo $row['point_date'];?></td>

                    

                </tr>

                <?php

				}

				?>

            </table>

            </div>

            

    </div>

    <div id="menu1"   class="tab-pane fade in active">

 <?php   

 
//echo  "select t.std_name,t.std_Father_name,t.std_lastname ,t.std_complete_name ,t.school_id,sp.sc_thanqupointlist_id, sp.sc_point,sp.point_date from tbl_teacher_point sp join tbl_student t where t.school_id='$school_id',sp.assigner_id=t.std_PRN and sp.`sc_entities_id`='105' and sp.sc_teacher_id='$t_id' and  and sp.sc_thanqupointlist_id!=0 order by sp.id desc" ;
 

    $arr=mysql_query("select t.std_name,t.std_Father_name,t.std_lastname ,t.std_complete_name ,t.school_id,sp.sc_thanqupointlist_id, sp.sc_point,sp.point_date from tbl_teacher_point sp join tbl_student t where t.school_id='$school_id' and sp.assigner_id=t.std_PRN and sp.`sc_entities_id`='105' and sp.sc_teacher_id='$t_id' and sp.sc_thanqupointlist_id!=0 order by sp.id desc"); 

	$j=0;

	?>

      

      <div id="no-more-tables" style="padding-top:20px;">

          

                  <table id="example1" class="col-md-10 table-bordered table-striped table-condensed cf" align="center" style="width:100%">

                		<thead class="cf">

           	<tr style="background-color:#6666CC; color:#FFFFFF; height:30px;">

                	<th>Sr. No.</th>

                    <th><?php echo $dynamic_student;?> Name</th>

                     <th>ThanQ Reason</th>

                    <th>Points</th>

               

                    <th>Point Date</th>

                   

                </tr>

               </thead>

                	

		<?php		while($row = mysql_fetch_array($arr))

				{

				$j++;?>

				

                <tr>

                <td ><?php echo $j;?></td>

                   

                    <td ><?php

					if($row['std_complete_name']=="")

					{

					 $std_name=ucwords(strtolower($row['std_name']." ".$row['std_Father_name']." ".$row['std_lastname']));

					}

					else

					{

						$std_name=ucwords(strtolower($row['std_complete_name']));

					}

					

					echo $std_name;

					?></td>

                    <td ><?php  $sc_thanqupointlist_id=$row['sc_thanqupointlist_id'];

					//$school_id=$row['school_id'];

					$sql=mysql_query("select t_list from tbl_thanqyoupointslist where id='$sc_thanqupointlist_id' and school_id='$school_id'");

					$result=mysql_fetch_array($sql);

					echo ucfirst($result['t_list']);

					

					

					 ?></td>

                 

                    <td ><?php echo $row['sc_point'];?></td>

                 

                     <td ><?php echo $row['point_date'];?></td>

                </tr>

           

                <?php

				}?>

				     </table>

            </div>

    </div>

    

  </div>

</div>

                 

               

       

                  </div> 



      









            

            

          



<div align="center" style="padding-top:20px; "><a href="dashboard.php" style="text-decoration:none"><input type="button"  value="Back" class="btn btn-danger" style="width:10%;"/></input></a></div>

</div>

                









</div>

</div>

</body>



</html>

