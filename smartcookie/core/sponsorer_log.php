
<?Php
                   if(isset($_GET['name']))
				   {
					   include_once("school_staff_header.php");
$id=$_SESSION['staff_id'];
$rec_limit = 10;
/* Get total number of records */
$sql = "SELECT count(id) FROM tbl_sponsored  ";
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
<!DOCTYPE html>
<html>
<head>


    
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
<body>
<div class="container">
    <div  style="width:100%;">
        <div style="height:10px;"></div>
    	<div style="height:50px; background-color:#FFFFFF; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4;" align="left">
        	<h2 style="padding-left:20px; margin-top:2px;color:#666">Sponsor Log</h2>
      
       </div>
<div id="no-more-tables" style="padding-top:20px;">
            <table class="col-md-12 table-bordered table-striped table-condensed cf" align="center" style="width:100%">
        		<thead class="cf">
        			
        				<tr  style="background-color:#428BCA; color:#FFFFFF; height:30px;">
                                <th>Sr. No.</th>
                                <th>Sponsor Name</th>
                                <th>Sponsored Product type</th>
                                <th>Sponsored Product/Discount</th>
                                <th>Points Per Product/Discount</th>                </tr>
        			
        		</thead>
                
                <?php
				
			$i=$rec_limit*$page;
				$arrs = mysql_query("select s.id ,s.sp_company,sp.Sponser_type,sp.Sponser_product,sp.points_per_product from tbl_sponsored sp join tbl_sponsorer s on s.id = sp.sponsor_id  ORDER BY sp.id LIMIT $offset, $rec_limit");
                
				while($sponser = mysql_fetch_array($arrs))
				{
				$i++;
				?>
                <tbody>
                
                <tr>
                	<td data-title="Sr.No" ><?php echo $i;?></td>
                    <td data-title="Sponsorer Name" ><?php echo $sponser['sp_company'];?></td>
                    <td data-title="Sponsorer Type" ><?php echo $sponser['Sponser_type'];?></td>
                    <td data-title="Sponsorer Product" ><?php echo $sponser['Sponser_product'];?></td>
                    <td data-title="Points Per Product" ><?php echo $sponser['points_per_product'];?></td>
                   
                 
                </tr>     
                </tbody>
               
                <?php
				}?>
            </table>
            
            <div align="center">
			<?php
if( $page > 0 )
{
   $last = $page - 2;
   echo  "<a href=\"sponsorer_log.php?page=$last\">Last 10 Records</a> |";
   echo "<a href=\"sponsorer_log.php?page=$page\">Next 10 Records</a>";
}
else if( $page == 0 )
{
   echo "<a href=\"sponsorer_log.php?page=$page\">Next 10 Records</a>";
}
else if( $left_rec < $rec_limit )
{
   $last = $page - 2;
   echo "<a href=\"sponsorer_log.php?page=$last\">Last 10 Records</a>";
}

?></div>
</div>
                




</div>
</div>
</body>
<footer>
<?php
 include_once('footer.php');?>
 </footer>
</html>
<?php
   }
   else
   {
	 include("scadmin_header.php");
$id=$_SESSION['id'];
$rec_limit = 10;
/* Get total number of records */
$sql = "SELECT count(id) FROM tbl_sponsored  ";
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
<!DOCTYPE html>
<html>
<head>


    
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
<body>
<div class="container">
    <div  style="width:100%;">
        <div style="height:10px;"></div>
    	<div style="height:50px; background-color:#FFFFFF; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4;" align="center">
        	<h2 style="padding-left:20px; margin-top:2px;color:#666">Sponsor Log</h2>
      
       </div>
<div id="no-more-tables" style="padding-top:20px;">
            <table class="col-md-12 table-bordered table-striped table-condensed cf" align="center" style="width:100%">
        		<thead class="cf">
        			
        				<tr  style="background-color:#428BCA; color:#FFFFFF; height:30px;">
                                <th>Sr. No.</th>
                                <th>Sponsor Name</th>
                                <th>Sponsored Product type</th>
                                <th>Sponsored Product/Discount</th>
                                <th>Points Per Product/Discount</th>                </tr>
        			
        		</thead>
                
                <?php
				
			$i=$rec_limit*$page;
				$arrs = mysql_query("select s.id ,s.sp_company,sp.Sponser_type,sp.Sponser_product,sp.points_per_product from tbl_sponsored sp join tbl_sponsorer s on s.id = sp.sponsor_id  ORDER BY sp.id LIMIT $offset, $rec_limit");
                
				while($sponser = mysql_fetch_array($arrs))
				{
				$i++;
				?>
                <tbody>
                
                <tr>
                	<td data-title="Sr.No" ><?php echo $i;?></td>
                    <td data-title="Sponsorer Name" ><?php echo $sponser['sp_company'];?></td>
                    <td data-title="Sponsorer Type" ><?php echo $sponser['Sponser_type'];?></td>
                    <td data-title="Sponsorer Product" ><?php echo $sponser['Sponser_product'];?></td>
                    <td data-title="Points Per Product" ><?php echo $sponser['points_per_product'];?></td>
                   
                 
                </tr>     
                </tbody>
               
                <?php
				}?>
            </table>
            
            <div align="center">
			<?php
if( $page > 0 )
{
   $last = $page - 2;
   echo  "<a href=\"sponsorer_log.php?page=$last\">Last 10 Records</a> |";
   echo "<a href=\"sponsorer_log.php?page=$page\">Next 10 Records</a>";
}
else if( $page == 0 )
{
   echo "<a href=\"sponsorer_log.php?page=$page\">Next 10 Records</a>";
}
else if( $left_rec < $rec_limit )
{
   $last = $page - 2;
   echo "<a href=\"sponsorer_log.php?page=$last\">Last 10 Records</a>";
}

?></div>
</div>
                




</div>
</div>
</body>
<footer>
<?php
 include_once('footer.php');?>
 </footer>
</html>
<?php
					}
?>





  
