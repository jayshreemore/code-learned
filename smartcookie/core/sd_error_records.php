<?php 
	require 'conn.php';
	require 'sd_upload_function.php';		
			
	if(isset($_GET['proc']) && isset($_GET['batch_id']) && isset($_GET['school_id']) && isset($_GET['pro']) && $_GET['pro']=="dwnld"){		
		
		$table=trim($_GET['proc']);
		$batch_id=trim($_GET['batch_id']);
		$school_id=trim($_GET['school_id']);
		
			$data=upload_info($table);
			
			$qd=@mysql_query("select ".$data['fields'].",upload_date, uploaded_by, batch_id, status from ".$data['raw_table']." where batch_id='".$batch_id."' and status not in ('Insert', 'Update') ")or die(mysql_error());
			header("Content-type: application/vnd.ms-excel; charset=utf-8");
			header("Content-disposition: attachment; filename=".$school_id.'-'.$data['filename'].'-'.date("Ymd").".xls");
			
			echo "<table border='1'>";
			echo "<tr><th>";
			echo str_replace(",","</th><th>",$data['display_fields']);
			echo "</th><th>upload_date</th><th>uploaded_by</th><th>batch_id</th><th>status</th></tr>";

			while($er=@mysql_fetch_assoc($qd)){					
					echo "<tr>";
					foreach($er as $field=>$value){
						echo "<td>".$value."</td>";
					}
					echo "</tr>";				
			}			
			echo "</table>";				
	}		


?>