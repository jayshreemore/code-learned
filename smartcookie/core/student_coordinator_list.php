

<?php include("header.php");







$query = mysql_query("select * from tbl_teacher where id = ".$_SESSION['id']);

$value = mysql_fetch_array($query);

$id=$value['id'];

$school_id=$value['school_id'];











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



.dataTables_info



{



padding-left:275px;

}

.dataTables_paginate paging_simple_numbers



{

padding-right:255px;



}



#keywords_paginate

{

padding-right:255px;



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



<body style="background-color:#FFFFFF;">





<div style="padding-top:50px;">

 <div  class="container">

  <div class="row" style="padding-top:20px;"><div class="col-md-4"></div>

  <div class="col-md-6" style="font-size:30px;color:#2F329F;" ><?php /*?><?php echo ($_SESSION['usertype']=='Manager')? 'Employee':'Student';?><?php */?>Coordinator List</div>

  </div>



  <div style="padding-top:30px;">

    <div id="no-more-tables" style="padding-top:15px;">

  <table  id="keywords" class="table-bordered"  style="border-color:#000000;" align="center">

    <thead class="cf">

      <tr align="center">

        <th style='color:white;background-color:#2F329F;'><center>Sr.No</center></th>

        <th style='color:white;background-color:#2F329F;'>Coordinator Name</th>

          <th style='color:white;background-color:#2F329F;'>Date</th>

      

      </tr>

    </thead>

    <tbody>



		<?php 

	
			
			/*echo "select DISTINCT s.id,s.std_name,s.std_lastname,c.stud_id,s.std_complete_name,s.std_Father_name,
			c.pointdate from tbl_coordinator c join tbl_student s on c.stud_id=s.std_PRN or c.stud_id=s.id where
			c.teacher_id='$id' and c.status='Y' and c.school_id='$school_id' ORDER BY STR_TO_DATE( `pointdate` , '%d-%m-%Y' ) DESC";*/
			
			
		/*echo "select DISTINCT s.id,s.std_name,s.std_lastname,c.stud_id,s.std_complete_name,s.std_Father_name,
			c.pointdate from tbl_coordinator c join tbl_student s on c.stud_id=s.std_PRN or c.stud_id=s.id where
			c.teacher_id='$id' and c.status='Y' and c.school_id='$school_id' ORDER BY STR_TO_DATE( `pointdate` , '%d-%m-%Y' ) DESC ";	*/
			
			$sql=mysql_query("select DISTINCT s.std_name,s.std_lastname,c.stud_id,s.std_complete_name,s.std_Father_name,
			c.pointdate from tbl_coordinator c join tbl_student s on c.stud_id=s.std_PRN or c.stud_id=s.id where
			c.teacher_id='$id' and c.status='Y' and c.school_id='$school_id' ORDER BY STR_TO_DATE( `pointdate` ,   '%d/%m/%Y'  ) DESC ");
/*$sql=mysql_query("select s.std_name,s.std_lastname,c.stud_id,s.std_complete_name,s.std_Father_name,c.pointdate from  tbl_student s join tbl_coordinator c on c.teacher_id='$id' where c.teacher_id='$id' and c.status='Y' and c.school_id='$school_id'");*/
		

		$i=0;

		

		while($result=mysql_fetch_array($sql))

		{

				

		

					 $i++;

				?>

                 <tr  onmouseover="this.style.cursor='pointer';this.style.textDecoration='underline';this.style.color='dodgerblue'" onmouseout="this.style.textDecoration='none';this.style.color='black';"  onclick="window.location='assigngreenpointbycoordinator.php?stud_id=<?php echo $result['stud_id'];?>'"class="d0" style="padding-top:2px;color:#808080">

                	<td data-title="Sr.No" ><b><center><?php echo $i;?></center></b></td>

                    <td data-title="Coordinator" ><b><?php

					

					if($result['std_complete_name']=="")

					{

					 echo ucwords(strtolower($result['std_name']))." ".ucwords(strtolower($result['std_Father_name']))." ".ucwords(strtolower($result['std_lastname']));

					

					}

					

					

					else

					{

					

					echo ucwords(strtolower($result['std_complete_name']));

					}

					

					?></b></td>

                  

                    <td data-title="Date" ><b><?php echo $result['pointdate'];?></b></td>

                   

                   

                    

                </tr>

                <?php

				 }

				

				?>

		

		

		

        

          

    </tbody>

  </table>

  </div>

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