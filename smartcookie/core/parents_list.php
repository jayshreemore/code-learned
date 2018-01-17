<?php
error_reporting(0);
include('scadmin_header.php');?>

<?php
$report="";

/*$id=$_SESSION['id'];*/
           $fields=array("id"=>$id);
		  /* $table="tbl_school_admin";*/
		   
		   $smartcookie=new smartcookie();

$results=$smartcookie->retrive_individual($table,$fields);
$result=mysql_fetch_array($results);

$sc_id=$result['school_id'];
/*echo $sc_id;*/
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">

<title>Untitled Document</title>
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
</head>
<script>
$(document).ready(function() {
    $('#example').dataTable( {
        "pagingType": "full_numbers"
    } );
} );

</script>
<!--
<script>
function confirmation(xxx) {
    var answer = confirm("Are you sure you want to delete")
    if (answer){
        
        window.location = "delete_school_subject.php?id="+xxx;
    }
    else{
       
     }
}
</script>
-->
<body bgcolor="#CCCCCC">
<div style="bgcolor:#CCCCCC">
<div>

</div>
<div class="container" style="padding:25px;" >
        	
            
            	<div style="padding:2px 2px 2px 2px;border:1px solid #CCCCCC; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4;">
                   
                    
                    <div style="background-color:#F8F8F8 ;">
                    <div class="row">
                    <div class="col-md-3 "  style="color:#700000 ;padding:5px;" >&nbsp;&nbsp;&nbsp;&nbsp;
                    <!--<a href="add_school_subject.php">   <input type="submit" class="btn btn-primary" name="submit" value="Add Subject" style="width:110px;font-weight:bold;font-size:14px;"/></a>-->
               			 </div>
              			 <div class="col-md-6 " align="center"  >
                         	
                   				<h2>List of Parents</h2>
								<h5 align="center"><a href="Add_ParentSheet.php" >Add Excel Sheet</a></h5>
               			 </div>
                         
                     </div>
                  
                  
                   
                  
               <div class="row">

               <div class="col-md-2">
               </div>
              <div class="col-md-12" id="no-more-tables" >
               <?php $i=0;?>
                    <table id="example" class="display" width="100%" cellspacing="0">
                     <thead>
                    	<tr >
						<th style="width:50px;" ><center>Sr.No</center></th>						
						<th style="width:40px;" ><center>Parent Name</center></th>	
                        <th style="width:150px;" ><center>Student PRN</center></th>					
						<th style="width:350px;" ><center>Student Name</center></th>
						
						
						<th style="width:50px;" ><center>Phone</center></th>
						<th style="width:100px;" ><center>Occupation</center></th>
						<th style="width:100px;" ><center>FamilyIncome</center></th>
					</tr>
					</thead>
				<tbody>
                 <?php
				 
				   $i=1;
				  $arr=mysql_query("select Name,std_PRN,Phone,Occupation,FamilyIncome from `tbl_parent` where school_id='$sc_id' ORDER BY `Name` ASC");?>
                  <?php while($row=mysql_fetch_array($arr)){?>
                 <tr onmouseover="this.style.cursor='pointer';this.style.textDecoration='underline';this.style.color='dodgerblue'"

				  onmouseout="this.style.textDecoration='none';this.style.color='black';" 

				  onclick="window.location='#'" 

				  style="cursor: pointer; text-decoration: underline; color: dodgerblue; background-color: rgb(239, 243, 251);height:30px;color:#808080;">
                    <td data-title="Sr.No" style="width:50px;"><center><?php echo $i;?></center></td>
					<td data-title="Fathers Name" style="width:250px;"><center><?php echo ucwords(strtolower($row['Name']));?></center> </td>
                    <td data-title="Student PRN" style="width:50px;" ><center><?php echo $row['std_PRN'];?> </center></td>

					<?php 
					$query=mysql_query("select std_name,std_Father_name,std_lastname,std_complete_name from tbl_student where std_PRN='".$row['std_PRN']."'");
					$result=mysql_fetch_array($query);
					
					if($result['std_complete_name']=="")
					{
						$std_name=ucwords(strtolower($result['std_name']))." ".ucwords(strtolower($result['std_Father_name']))." ".ucwords(strtolower($result['std_lastname']));
					}
					
					else
					{
						$std_name=ucwords(strtolower($result['std_complete_name']));
					}
					
					
                    ?>
					<td data-title="Student Name" style="width:420px;"><center><?php echo $std_name;?></center> </td>	
														<td data-title="Phone" style="width:50px;"><center><?php echo $row['Phone'];?></center> </td>
					<td data-title="Occupation" style="width:100px;"><center><?php echo $row['Occupation'];?></center> </td>
                    <td data-title="Family Income" style="width:100px;"><center><?php echo $row['FamilyIncome'];?></center> </td>
                 </tr>
                <?php $i++;?>
                 <?php }?>
                  
                  </tbody>
                  </table>
                  </div>
                  </div>
                  
                  
                   <div class="row" style="padding:5px;">
                   <div class="col-md-4">
               </div>
                  <div class="col-md-3 "  align="center">
                   
                   </form>
                   </div>
                    </div>
                     <div class="row" >
                     <div class="col-md-4">
                     </div>
                      <div class="col-md-3" style="color:#FF0000;" align="center">
                      
                      <?php echo $report;?>
               			</div>
                 
                    </div>
                      
                
                  
                 
                    
                    
                  
               </div>
               </div>
</body>
</html>
