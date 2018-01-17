<?php
             
			
  
		include('scadmin_header.php');
$report="";

$id=$_SESSION['id'];
           $fields=array("id"=>$id);
		   $table="tbl_school_admin";
		   
		   $smartcookie=new smartcookie();
		   
$results=$smartcookie->retrive_individual($table,$fields);
$result=mysql_fetch_array($results);
$school_id=$result['school_id'];


if(isset($_GET["id"]))
	{
		$school_id= $_GET["id"];
		$sc_lists=array();
		$sc_types=array();
		$i=0;
		
		 $sql=mysql_query("select * from tbl_studentpointslist where school_id='0'");
		while($result=mysql_fetch_array($sql))
		{
		$sc_lists[$i]=$result['sc_list'];
		
		$sc_type[$i]=$result['sc_type'];
		
		
		  $results=mysql_query("select * from tbl_studentpointslist where school_id='$school_id'  and sc_list like '$sc_lists[$i]' and sc_type='$sc_type[$i]'  ");
		  $count=mysql_num_rows($results);
		  
		  if($count==0)
		  { 
		
		$query=mysql_query("insert into tbl_studentpointslist(sc_list,sc_type,school_id) values('$sc_lists[$i]','$sc_type[$i]','$school_id')");
		$i++;
		}
		else
		{
		 $report="Activities are already added...";
		}
		}
		header("location:activitylist.php");
	}
?>
 