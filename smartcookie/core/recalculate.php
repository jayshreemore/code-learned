<?php
 include("scadmin_header.php");
$id=$_SESSION['id'];
$rec_limit = 10;
$rows=mysql_query("select * from tbl_school_admin where id='$id'");
$value=mysql_fetch_array($rows);
$school_id=$value['school_id'];
/* Get total number of records */
 $sql = "SELECT count(id) FROM tbl_teacher_point where sc_entities_id='102' ";
$retval = mysql_query( $sql);
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
 <link rel="stylesheet" href="css/bootstrap.min.css">


<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>

  <style>
 input[type="submit"]
        {

           background-color: #FFFFFF;
           width:250px;
           height:45px;
           border-radius: 5px;
           font-size: 17px;
           box-shadow:0px 0px 2px 3px #FFCC33;
           background: linear-gradient(#FFF,#CCC);
        }
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
        

  
      <script>
       $(document).ready(function() {
	  
	    $('#example').DataTable();
} );
        </script>
  
</head>

<body>
    <div class="row">
<div class="container" style="padding-top:20px;width:100%;">

<div style="width:100%; height:50px; background-color:#f9f9f9; border:1px solid #CCCCCC;" align="center" >
  	<h1 style="padding-left:20px; margin-top:4px;color:#800080;">List Of All Points</h1>
        </div>

         <div style="height:20px;"></div>


<a href="recalculate.php"><input type="submit" name="btnSubmit" id="submitId" value="Recalculate Points" style="font-size:16px;font-family: Georgia, serif"/> </a>     

              <div id="no-more-tables" style="padding-top:20px;">


  <table id="example" class="col-md-12 table-bordered table-striped " >



        				<thead>
        			<tr style="background-color:#708090;color:#FFFFFF;">
                	<th>Sr. No.</th>
                    <th>Student Name</th>
                    <th>School Name</th>
                    <th>Recalculate Points</th>




                </tr>
                </thead>



             <?php $i=1;
                $sql=mysql_query("SELECT ts.`school_id`,ts.std_complete_name,ts.std_name,ts.std_Father_name,ts.std_lastname,tsp.sc_point,ts.std_PRN,ts.            std_complete_name,ts.std_school_name FROM tbl_student ts left join tbl_student_point tsp on ts.std_PRN=tsp.sc_stud_id and ts.`school_id`=tsp.`school_id`
				where ts.`school_id`='$school_id' group by std_complete_name order by std_complete_name ");
					 while($result=mysql_fetch_array($sql))
                     {
                          $std_PRN=$result['std_PRN'];


					?>
					<tr  onClick="document.location='recalculate_log.php?s_id=<?php echo $result['std_PRN'];?>&sc_id=<?php echo $result['school_id'];?>'">
					<td  width="5%" data-title="Sr.No."><?php echo $i;?></td>
					<td width="24%" data-title="Teacher Name"><?php if($result['std_complete_name']==""){echo 
					strtoupper($result['std_name'])." ".strtoupper($result['std_lastname']);}else{ echo strtoupper($result['std_complete_name']);}?></td>
					<td width="24%" data-title="School Name"><?php if($result['std_school_name']==""){echo $school_id;}else{ echo $result['std_school_name'];}?></td>


					<td data-title="Green Points">
					    <div class="row" style="padding-bottom:5px;padding-left:8px;">
											<div class="col-md-1 " style="background-color:#92C81A;" >
                        &nbsp;
                        </div>
                       <?php


                        $sql1=mysql_query("SELECT SUM(sc_point) as agg FROM tbl_student_point where sc_stud_id='$std_PRN' AND (sc_entites_id=102 or sc_entites_id=103) AND school_id='$school_id' and activity_type!=''");
                             $sum1=mysql_fetch_array($sql1);

                       ?>

                        <div  class="col-md-3">
                           <?php if($sum1['agg']==""){echo "0";}else{echo $sum1['agg'];}?>
                        </div>



                        <div style="background-color:#0F15D2;" class="col-md-1">
                        &nbsp;
                        </div>
                        <?php


                        $sql2=mysql_query("SELECT SUM(sc_point) as agg1 FROM tbl_student_point where sc_stud_id='$std_PRN' AND sc_entites_id=102  AND school_id='$school_id' and activity_type=''");
                          $sum2=mysql_fetch_array($sql2);
                       ?>
                        <div  class="col-md-3">

                          <?php if($sum2['agg1']==""){echo "0";}else{echo $sum2['agg1'];}?>

                        </div>
						 <div style="background-color:#990099;" class="col-md-1">
                           &nbsp;
                        </div>
                        <?php
                       

                         $sql3=mysql_query("SELECT SUM(sc_point) as agg2 FROM tbl_student_point where (sc_stud_id='$std_PRN' AND sc_entites_id=106 AND school_id='$school_id')");
                           $sum3=mysql_fetch_array($sql3);
                       ?>
                        <div  class="col-md-3">

                          <?php if($sum3['agg2']==""){echo "0";}else{echo $sum3['agg2'];}?>

                        </div>
					    </div>
                        </td>

<!--<td data-title="Used Blue Points"><?php //echo $result['used_blue_points'];?></td>-->
                        </tr>
                        <?php
                        $i++;
                        }
                        ?>
</table>
</div>
</div>
</div>
</body>
</html>
