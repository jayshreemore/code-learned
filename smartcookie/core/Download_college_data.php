<?php
$id=$_GET['id'];
$value=explode(",",$id);
$batch_id=$value[0];
$error=$value[1];


include('conn.php');
$sql=mysql_query("select batch_id from tbl_Batch_Master where id='$batch_id' ");
$result=mysql_fetch_array($sql);
$batch_id=$result['batch_id'];




if($error=='C')
{
	
	
	
	
	
		header("Content-disposition: attachment; filename=Correct_records_".$batch_id.date("d/m/Y").".xls");
		 echo 'DTE Code' . "\t" . 'School ID' . "\t" .'school Name'."\t". 'School admin Name' . "\t" . 'Stream' . "\t". 'Address' . "\t" . 'Email_ID' . "\t". 'Phone'."\t" .'batch_no'."\n";
		
		
		$sql1=mysql_query("select * from tbl_school_admin where batch_id='$batch_id'");
		while($results=mysql_fetch_array($sql1))
		{
			
		echo '"'.$results['DTECode'].'"' . "\t" . '"'.$results['school_id'].'"' . "\t" . '"'.$results['school_name'].'"'  . "\t" . '"'.$results['name'].'"' . "\t" . '"'.$results['stream'].'"'. "\t" . '"'.$results['address'].'"'."\t". '"'.$results['email'].'"'. "\t".'"'.$results['mobile'].'"'."\t". '"'.$results['batch_id'].'"'."\n";
		
		}
	

	
}
if($error=='E')
{
			
		  header("Content-disposition: attachment; filename=Error_records_".$batch_id.date("d/m/Y").".xls");
		 
		    echo 'DTE Code' . "\t" . 'School ID' . "\t" .'school Name'."\t". 'School admin Name' . "\t" . 'Stream' . "\t". 'Address' . "\t" . 'Email_ID' . "\t". 'Phone'."\t".'Warning'."\t" .'batch_no'."\n";
		  
		  
		
		$sql1=mysql_query("select * from  tbl_school_admin_raw where batch_id='$batch_id'");
		while($results=mysql_fetch_array($sql1))
		{
			
			echo '"'.$results['DTECode'].'"' . "\t" . '"'.$results['school_id'].'"' . "\t" . '"'.$results['school_name'].'"'  . "\t" . '"'.$results['name'].'"' . "\t" . '"'.$results['stream'].'"'. "\t" . '"'.$results['address'].'"'."\t". '"'.$results['email'].'"'. "\t".'"'.$results['mobile'].'"'."\t". '"'.$results['error_code'].'"'."\t".'"'.$results['batch_id'].'"'."\n";
	
		
}

}
if($error=='D')
{
			
			
		  header("Content-disposition: attachment; filename=upload_college_excelsheet_format_".date("d/m/Y").".xls");
		  
		  
		  echo 'DTE Code' . "\t" . 'School ID' . "\t" .'school Name'."\t". 'School admin Name' . "\t" . 'Stream' . "\t". 'Address' . "\t" . 'Email_ID' . "\t". 'Phone'."\t". 'school_type'."\n";
		  
		
		
								


		

}

?>





