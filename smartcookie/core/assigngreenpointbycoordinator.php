
<?php include("header.php");



$query = mysql_query("select * from tbl_teacher where id = ".$_SESSION['id']);
$value = mysql_fetch_array($query);
$id=$value['id'];
$school_id=$value['school_id'];
$t_id=$value['t_id'];


$stud_id=$_GET['stud_id'];

$sql=mysql_query("select std_name,std_PRN,std_Father_name,std_lastname,std_complete_name from tbl_student where id='$stud_id'");

$result1=mysql_fetch_array($sql);
$std_PRN=$result1['std_PRN'];

if($result1['std_complete_name']=="")
{
$name=$result1['std_name']." ".$result1['std_Father_name']." ".$result1['std_lastname'];



}

else
{
$name= $result1['std_complete_name'];
}


?>
<!doctype html>
<html lang="en-US">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html">
  <title>Green points by coordinator</title>
  <script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>


<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">

  <style>

  body { 
  background: #eee url('bg.png'); /* http://subtlepatterns.com/weave/ */
  font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
  
  line-height: 1;
  color: #585858;
 
}

h1 { 
  font-family: 'Amarante', Tahoma, sans-serif;
  font-weight: bold;
  font-size: 3.6em;
  line-height: 1.7em;
  margin-bottom: 10px;
  text-align: center;
}


/** page structure **/
#wrapper {
  display: block;
  width: 100%;
  background: #fff;
  margin: 0 auto;
  padding: 10px 17px;
  -webkit-box-shadow: 2px 2px 3px -1px rgba(0,0,0,0.35);
}

#keywords {
  margin: 0 auto;
  font-size: 1.2em;
  margin-bottom: 15px;
}


#keywords thead {
  cursor: pointer;
  background: #c9dff0;
}
#keywords thead tr th { 
  font-weight: bold;
  padding: 12px 30px;
  padding-left: 12px;
}


#keywords tbody tr { 
  color: #555;
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
  
  
</head>

<body style="background-color:#FFFFFF">

<div class="container">
<div style="padding-top:30px;">

  <div class="row" style="padding-top:20px;"><div class="col-md-2"></div><div class="col-md-10" style="font-size:30px" >Reward points distributed by <?php echo  ucwords(strtolower($name));?> Coordinator</div></div>

  <div style="padding-top:50px;">
    <div id="no-more-tables" style="padding-top:15px;">
  <table  id="keywords" class="table-bordered"  style="width:100%; border-color:#000000;" align="center">
    <thead class="cf">
      <tr align="center">
        <th>Sr.No</th>
   
        <th>Student Name </th>
        <th>Points</th>
        <th style="width:20%;">Activity/Subject</th>
        <th>Date</th>
      
      </tr>
    </thead>
    <tbody>

		<?php 
		//find out student coordinator of teacher login 
		
		
		$i=0;

				
				//retrive record where student coorinator give points to student
				$row=mysql_query("select sc_point,std_name,std_lastname,point_date,IF( activity_type =  'subject', (SELECT distinct(subjectName)
FROM tbl_student_subject_master
WHERE subjcet_code=sc_studentpointlist_id limit 1), (SELECT sc_list FROM tbl_studentpointslist WHERE sc_id = sc_studentpointlist_id ) ) AS sc_list from tbl_student_point sp join tbl_student s on  sp.sc_stud_id=s.std_PRN where  	sc_teacher_id='$t_id' and coordinate_id='$std_PRN' and sc_entites_id='111' order by sp.id desc ");
				 while($value=mysql_fetch_array($row))
				 {
					 $i++;
				?>
                <tr>
                	<td data-title="Sr.No" ><?php echo $i;?></td>
                       <td data-title="Student Name" ><?php echo ucwords(strtolower($value['std_name']))." ".ucwords(strtolower($value['std_lastname']));?></td>
                    <td data-title="Points" ><?php echo $value['sc_point'];?></td>
                    <td data-title="Activity/Subject" ><?php echo ucwords(strtolower($value['sc_list']));?></td>
                    <td data-title="Date" ><?php echo $value['point_date'];?></td>
                   
                   
                    
                </tr>
                <?php
				 }
				
				?>
		
		
		
        
          
    </tbody>
  </table>
  </div>
  </div>
  
  <div class="row" align="center" style="padding-top:30px;">
 <a href="student_coordinator_list.php" style="text-decoration:none">  <input type="button" class="btn btn-danger" value="Back"></a>
  
  </div>
  
 </div> 
 </div>
 <script type="text/javascript">
$(function(){
  $('#keywords').dataTable(); 
});
</script>

</body>
</html>