<?php include_once('header.php');

 if(!isset($_SESSION['id']))
	{
		header('location:login.php');
	}
	$id=$_SESSION['id'];

?>
<!DOCTYPE html>
<script>
$(document).ready(function() {

    $('#example').DataTable();
} );
</script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    <link href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.css" rel="stylesheet" type="text/css"></link>


<head>

<link rel="stylesheet" type="text/css" href="css/student_dashboard_test.css">
    
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
<body>
<div class="container">
    <div  style="width:100%;">
     
    	<div style="height:50px; background-color:#FFFFFF; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4;" align="left">
        	<h2 style="padding-left:20px; margin-top:4px;color:white;text-align:center;background-color:#2F329F;">My Shared Points</h2>
      
       </div>
<div id="no-more-tables" style="padding-top:40px;" style="padding-top:10px;">
            <table id="example" class="" align="center" style="width:100%;pa">
        	<thead>
            	<tr style="background-color:#2F329F; color:white
                ; height:30px;">
                	<th>Sr. No.</th>
                    <th><?php echo $dynamic_teacher;?> Name</th>
                    <th>Points</th>
                    <th>Reason</th>
                    <th>Point Date</th>
                   
                </tr>
               </thead>
 <?php
			
			$i=0;
				$arr = mysql_query("select s.t_complete_name,s.t_name,s.t_middlename,s.t_lastname,sp.sc_point,sp.reason,sp.point_date from tbl_teacher_point sp join tbl_teacher s where sp.sc_teacher_id=s.id and sp.sc_entities_id='103' and sp.assigner_id='$id' order by sp.id desc"  );
				while($row = mysql_fetch_array($arr))
				{
				$i++;
				?>
                <tr>
                	<td data-title="Sr.No"><b><?php echo $i;?></b></td>
                   
                    <td  data-title="Name"><b><?php  if($row['t_complete_name']=="")
					
					{
						$row['t_complete_name']=ucwords(strtolower($row['t_name']." ".$row['t_middlename']." ".$row['t_lastname']));
					}
					echo ucwords(strtolower($row['t_complete_name']));
					
					?></b></td>
                   
                 
                    <td data-title="Points"><b><?php echo $row['sc_point'];?></b></td>
                    <td data-title="Reason"><b><?php echo $row['reason'];?></b></td>
                     <td  data-title="Date"><b><?php echo $row['point_date'];?></b></td>
                    
                </tr>
                <?php
				}
				?>
            </table>
            
 
<div align="center" style="padding-top:20px; "><a href="dashboard.php" style="text-decoration:none"><input type="button"  value="Back" class="btn btn-danger" style="width:10%;"/></a></div>
</div>
                




</div>
</div>
</body>
<footer>
<?php
 include_once('footer.php');?>
 </footer>
</html>