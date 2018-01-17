
<?php include("header.php");



$query = mysql_query("select * from tbl_teacher where id = ".$_SESSION['id']);
$value = mysql_fetch_array($query);
$id=$value['id'];
$school_id=$value['school_id'];

$sql=mysql_query("select thanqu_flag from tbl_school_admin where school_id='$school_id'");
$result=mysql_fetch_array($sql);
$thanqu_flag=$result['thanqu_flag'];
$te="Te";
$pos = strpos($thanqu_flag,$te);



?>
<!doctype html>
<html lang="en-US">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html">
  <title>Simple Table Sorting with jQuery - Treehouse Demo</title>
  <meta name="author" content="Jake Rocheleau">
  <link rel="shortcut icon" href="http://d15dxvojnvxp1x.cloudfront.net/assets/favicon.ico">
  <link rel="icon" href="http://d15dxvojnvxp1x.cloudfront.net/assets/favicon.ico">
  <script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script>
 function openwindow(t_id)
 {

if(t_id!="")
{

window.location = "shareblue.php?t_id="+t_id;
}
 
 }
 
</script>

<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">

  <style>

  body { 
  background: #eee url('bg.png'); /* http://subtlepatterns.com/weave/ */
  font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
  
  line-height: 1;
  color: #585858;
  
  padding-bottom: 55px;
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

<body>
<?php 
if($pos !== false)
{?>

<div style="padding-top:10px;">
 <div id="wrapper">
  <div class="row"><div class="col-md-4"></div><div class="col-md-5" style="font-size:30px;color:#2F329F;" >Share Points</div><div class="col-md-3"></div> <div class="col-md-3"><a href="sharebluepointlog.php?id=<?php echo $id;?>" style="text-decoration:none"><input type="button" class="btn" name="my_shared_blue_points" value="My shared points"></a></div></div>

  <div style="padding-top:10px;">
    <div id="no-more-tables" style="padding-top:10px;">
  <table  id="keywords" class="table-bordered"  style="width:100%; border-color:#000000;" align="center">
    <thead class="cf">
      <tr align="center">
        <th style='color:white;background-color:#2F329F;'ss>Sr.No</th>
        <th style="width:15%;color:white;background-color:#2F329F;" align="center">MIS</th>
        <th style="width:20%;color:white;background-color:#2F329F;">Name</th>
        <th style= "width:10%;color:white;background-color:#2F329F;">Email ID</th>
        <th style= "width:10%;color:white;background-color:#2F329F;">Mobile No.</th>
        <th style="width:12%;color:white;background-color:#2F329F;">Balance Blue Points</th>
        <th style="width:12%;color:white;background-color:#2F329F;">Assign</th>
      
      </tr>
    </thead>
    <tbody>

		<?php 
		$sql=mysql_query("select * from tbl_teacher where school_id='$school_id' AND (`t_emp_type_pid`='133' or `t_emp_type_pid`='134') and id!='$id' order by t_complete_name, t_name ASC");
		
		$i=0;
		while($result=mysql_fetch_array($sql))
		{
				$i++;
				    $fullName=$result['t_complete_name'];
					
				?>
                <tr>
                	<td data-title="Sr.No" width="5px;" align="center" ><b><?php echo $i;?></b></td>
                    <td data-title="Sr.No" width="5px;" align="center" ><b><?php echo $result['t_id'];?></b></td>
                   
                    <td data-title="Name"><b><?php if($fullName=="")
					                         {
											    echo $name=$result['t_name']." ".$result['t_middlename']." ".$result['t_lastname'];
											 }
											 else
											 {
											   echo $fullName;
											 }
											 ?></b></td>
                      <td data-title="Email" width="20px;" ><b><?php echo $result['t_internal_email'];?></b></td>
                   
                    <td data-title="Phone No." ><b><?php echo $result['t_phone'];?></b></td>
                    <td data-title="Balance blue points" width="20px;" align="center"><b><?php echo $result['balance_blue_points'];?></b></td>
                  
                       <td align="center"> <a class="txt-button" onClick="openwindow(<?php echo $result['t_id'];?>);"><input type="button" value="Share" class="btn btn-primary"style="color:white;background-color:#2F329F;" ></a></td>
                    
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
 
 <?php }else
 {?>
 
 <div class="container" style="padding-top:150px;">
 <div class="row">
 <div class="col-md-3"></div>
 
 <div class="col-md-6"  style=" border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4; background-color:#FFFFFF;color:#FF0000; font-weight:bold;" align="center" >
  <div style="height:20px;"></div>
 <?php echo "You do not have permission to Share blue Points !...  "?>
 <div style="height:20px;"></div>
 </div>
 
 
 
 
 </div>
 
 </div>
 
  <?php }
 ?>

</body>
</html>