<?php



        if(isset($_GET['name']))

		{

		include('school_staff_header.php');

        $report="";



		  /* $id=$_SESSION['id'];

           $fields=array("id"=>$id);

		   $table="tbl_school_admin";

		   $smartcookie=new smartcookie();*/

	    	   

$results=mysql_query("select * from tbl_school_adminstaff where id=".$id."");

$result=mysql_fetch_array($results);



$sc_id=$result['school_id'];



$rec_limit = 10;

	$sql = "SELECT *  FROM tbl_studentpointslist sp JOIN tbl_activity_type a WHERE sp.school_id= '$sc_id'  AND a.id = sc_type order by sc_type";

$retval = mysql_query($sql);

if(!$retval)

{

  die('Could not get data: ' . mysql_error());

}

$row = mysql_fetch_array($retval, MYSQL_NUM );

$rec_count = $row[0];



if( isset($_GET{'page'} ) )

{

   $page = $_GET{'page'} + 1;

   $offset = $rec_limit * $page ;

}

else

{

   $page = 0;

   $offset = 0;

}

 $left_rec = $rec_count - ($page * $rec_limit);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">

<link rel="stylesheet" href="css/bootstrap.min.css">





<script src="js/jquery-1.11.1.min.js"></script>

<script src="js/jquery.dataTables.min.js"></script>

<script>



function confirmation(xxx) 

{



    var answer = confirm("Are you sure you want to delete?")

    if (answer){

         var a='0';    

        window.location = "delete_activity.php?id="+xxx+"&staffid="+a;

    }

    else{

       

    }

	}

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

		font:Arial, Helvetica, sans-serif;

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

        







<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Untitled Document</title>

</head>



	<script>

$(document).ready(function() {

    $('#example').dataTable( {

      

    } );

} );



</script>

<body bgcolor="#CCCCCC">

<div style="bgcolor:#CCCCCC">

<div>



</div>

<div class="container" style="padding:25px;" >

        	

            

        <div style="padding:2px 2px 2px 2px;border:1px solid #CCCCCC; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4;">

                   <div style="background-color:#F8F8F8 ;">

                    <div class="row" style="padding-left:30px;">

                    <div class="col-md-4 "  style="color:#700000 ;padding:5px;" >

                       <a href="activity.php?id=<?=$staff_id;?>">

                          <input type="submit" class="btn btn-primary" name="submit" value="Add Activity" style="width:150;font-weight:bold;font-size:14px;"/></a>

               			</div>

                        <div class="col-md-1"></div>

              			 <div class="col-md-4">

                         	 <h3>Activity List</h3>

               			 </div>

                        <div class="col-md-1"  style="color:#700000 ;padding:5px;" >

                  

 <a href="copy_activity.php?id=<?=$staff_id;?>"><input type="submit" class="btn btn-primary" name="copy" value="Copy from Cookieadmin" style="width:150;font-weight:bold;font-size:14px;"/></a>

                 

               			</div>

                         

                         

                        </div> 

                 

                <div class="row" style="padding-top:20px;">

                <div class="col-md-0"></div>

        

                    <div class="col-md-12">

      

        	

            	<div style="background-color:#FFFFFF; border:1px solid #CCCCCC;" align="right">

                

                

                 <table id="example" class="display" width="100%" cellspacing="0">

                                      

                    	<tr align="left" ><th>

                        Sr. No.</th><th>Activity Name</th><th>Activity Type</th><th>Edit</th><th>Delete</th></tr>

                        <?php

							$i=$rec_limit*$page;

							$sp_id1=$id;

$arr = mysql_query("SELECT * FROM tbl_studentpointslist sp JOIN tbl_activity_type a WHERE sp.school_id= '$sc_id'  AND a.id = sc_type ORDER BY sc_id LIMIT $offset, $rec_limit");

							while($row = mysql_fetch_array($arr))

							{

							$i++;

						?>

                        <tr align="left"><td><?php echo $i;?></td><td><?php echo $row['sc_list'];?></td><td><?php echo $row['activity_type'];?></td>

                         <td><a href="editschoolactivity.php?editactivity=<?php echo $row['sc_id'];  ?>" >Edit</a></td>

                     <td> <a onclick="confirmation(<?php echo $row['sc_id']; ?> )">Delete</a></td>

                    </tr>

                        <?php

							}

						?>

                    </table>

                	

                <?php echo $report;?>

                </div>

                

                

                 <div align="center">

        <?php

		                 $namea="Activity";

if( $page > 0 )

{

   $last = $page - 2;

   echo "<a href=\"activitylist.php?name=".$namea."&page=$last\">Last 10 Records</a> |";

   echo "<a href=\"activitylist.php?name=".$namea."&page=$page\">Next 10 Records</a>";

}

else if( $page == 0 )

{

   echo "<a href=\"activitylist.php?name=".$namea."&page=$page\">Next 10 Records</a>";

}

else if( $left_rec < $rec_limit )

{

   $last = $page - 2;

   echo "<a href=\"activitylist.php?name=".$namea."&page=$last\">Last 10 Records</a>";

}



?></div>

       <div style="height:50px;"></div>

            </div>

            

            

            </div>

            </div>

          </div>

        </div>

</body>

</html>

<?php

		  

			}

			else

			{

		include('hr_header.php');

$report="";



$id=$_SESSION['id'];

           $fields=array("id"=>$id);

		   $table="tbl_school_admin";

		   $smartcookie=new smartcookie();

		   

$results=$smartcookie->retrive_individual($table,$fields);

$result=mysql_fetch_array($results);

$sc_id=$result['school_id'];





$rec_limit = 10;

			$sql = "SELECT *  FROM tbl_studentpointslist sp JOIN tbl_activity_type a WHERE sp.school_id= '$sc_id'  AND a.id = sc_type order by sc_type";

$retval = mysql_query( $sql);

if(! $retval )

{

  die('Could not get data: ' . mysql_error());

}





$row = mysql_fetch_array($retval, MYSQL_NUM );

$rec_count = $row[0];



if( isset($_GET{'page'} ) )

{

   $page = $_GET{'page'} + 1;

   $offset = $rec_limit * $page ;

}

else

{

   $page = 0;

   $offset = 0;

}

 $left_rec = $rec_count - ($page * $rec_limit);









?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">

 <link rel="stylesheet" href="css/bootstrap.min.css">

<script>

$(document).ready(function() {

    $('#example').dataTable( {



    } );

} );

</script>



<script src="js/jquery-1.11.1.min.js"></script>

<script src="js/jquery.dataTables.min.js"></script>



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

        font:Arial, Helvetica, sans-serif;

    }



    #no-more-tables td:before {

        /* Now like a table header */

        position: absolute;

        /* Top/left values mimic padding */

        top: 6px;

        left: 6px;



        padding-right: 10px;

        white-space: nowrap;


    }



    /*

    Label the data

    */

    #no-more-tables td:before { content: attr(data-title); }

}

</style>







<script>



function confirmation(xxx) {



    var answer = confirm("Are you sure you want to delete?")

    if (answer)

	{



        window.location = "delete_activity.php?id="+xxx;

    }

    else{



    }

	}

	</script>


<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Untitled Document</title>

</head>



<body bgcolor="#CCCCCC">

<div style="bgcolor:#CCCCCC">

<div>



</div>

<div class="container" style="padding:25px;" >

        	

            

            	<div style="padding:2px 2px 2px 2px;border:1px solid #CCCCCC; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4;">

                   

                    

                    <div style="background-color:#F8F8F8 ;">

                    <div class="row" style="padding-left:30px;">

                    <div class="col-md-4 "  style="color:#700000 ;padding:5px;" >

                       <a href="activity.php">

                          <input type="submit" class="btn btn-primary" name="submit" value="Add Activity" style="width:150;font-weight:bold;font-size:14px;"/></a>

               			</div>

                        <div class="col-md-1 "></div>

              			 <div   class="col-md-4 ">

                         	

                   				<h3>Activity List </h3>

               			 </div>

                         

                          <div class="col-md-1 "  style="color:#700000 ;padding:5px;" >

                  

                 <a href = "copy_activity.php?id=<?php echo $sc_id;?>"><input type="submit" class="btn btn-primary" name="copy" value="Copy from Cookieadmin" style="font-weight:bold;font-size:14px;"/></a>

                 

               			</div>

                        </div> 

                 

                <div class="row" style="padding-top:20px;">

                <div class="col-md-0"></div>

        

                    <div class="col-md-12">

      



            	<div align="right">



                

                <table id="example" class="display" width="100%" cellspacing="0">

                                      
                        <thead>
                    	<tr align="left" ><th>

                        Sr. No.</th><th>Activity Name</th><th>Activity Type</th><th>Edit</th><th>Delete</th></tr>

                        </thead>
                        <tbody>

                        <?php

							$i=$rec_limit*$page;

							$sp_id1=$_SESSION['id'];

						

							

							$arr = mysql_query( "SELECT *  FROM tbl_studentpointslist sp JOIN tbl_activity_type a WHERE sp.school_id= '$sc_id'  AND a.id = sc_type ORDER BY sc_id LIMIT $offset, $rec_limit"  );

							while($row = mysql_fetch_array($arr))

							{

							$i++;

						?>

                        <tr align="left"><td><?php echo $i;?></td><td><?php echo $row['sc_list'];?></td><td><?php echo $row['activity_type'];?></td>

                         <td><a href="editschoolactivity.php?activity=<?php echo $row['sc_id'];  ?>" >Edit</a></td>

                     <td> <a onclick="confirmation(<?php echo $row['sc_id']; ?> )">Delete</a></td>

                    </tr>
                      </tbody>
                        <?php

							}

						?>

                    </table>



                <?php echo $report;?>

                </div>




      <!--
                 <div align="center">

        <?php

if( $page > 0 )

{

   $last = $page - 2;

   echo "<a href=\"activitylist.php?page=$last\">Last 10 Records</a> |";

   echo "<a href=\"activitylist.php?page=$page\">Next 10 Records</a>";

}

else if( $page == 0 )

{

   echo "<a href=\"activitylist.php?page=$page\">Next 10 Records</a>";

}

else if( $left_rec < $rec_limit )

{

   $last = $page - 2;

   echo "<a href=\"activitylist.php?page=$last\">Last 10 Records</a>";

}



?></div>-->

       <div style="height:50px;"></div>

            </div>





            </div>

            </div>















               </div>

               </div>

</body>

</html>





			<?php

			}

				?>





































































