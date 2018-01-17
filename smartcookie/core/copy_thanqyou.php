<?php
include('scadmin_header.php');
$report="";

$id=$_SESSION['id'];
           $fields=array("id"=>$id);
		   $table="tbl_school_admin";
		   
		   $smartcookie=new smartcookie();
		   
$results=$smartcookie->retrive_individual($table,$fields);
$result=mysql_fetch_array($results);
$sc_id=$result['school_id'];


if(isset($_GET["id"]))
	{
		$school_id= $_GET["id"];
		$t_lists=array();
		
		$i=0;
		
		 $sql=mysql_query("select * from tbl_thanqyoupointslist where school_id='0'");
		while($result=mysql_fetch_array($sql))
		{
		$t_lists[$i]=$result['t_list'];
		
		
		
		
		  $results=mysql_query("select * from tbl_thanqyoupointslist where school_id='$school_id'  and t_list like '$t_lists[$i]' ");
		  $count=mysql_num_rows($results);
		  
		  if($count==0)
		  { 
		
		$query=mysql_query("insert into tbl_thanqyoupointslist(t_list,school_id) values('$t_lists[$i]','$school_id')");
		$i++;
		}
		
		else
		{
		 $report="Thanq you name are already added...";
		
		}
		
		}
		
		header("location:thanqyoulist.php");
	}
?>