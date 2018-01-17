<?php 
require "scadmin_header.php";
require 'sd_upload_function.php';
$sca=get_school_id($_SESSION['id']);
$uploaded_by=$sca['name'];
$school_id=$sca['school_id']; 
 
if(isset($_GET['proc']) && isset($_GET['batch_id']) && isset($_GET['school_id']) && isset($_GET['pro']) ){	
		$table=trim($_GET['proc']);
		$batch_id=trim($_GET['batch_id']);
		$school_id=trim($_GET['school_id']);
		$data=process_record($table,$batch_id,$school_id);

		if($_GET['pro']=="scan"){
			if($data['scan']!=""){
				$q=mysql_query($data['scan'])or die(mysql_error());
				if($q){
					header("Location: sd_process_report.php");
				}
			}
		}elseif($_GET['pro']=="process"){
			if($data['process']!=""){
				//echo $data['process'];die;
				$q=mysql_query($data['process'])or die(mysql_error());
				if($q){				
					$redurl="Batch_Master_PT.php?table_name=".$table;
					header("Location: $redurl");
				}				
			}
		}
 }
 
?> 
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function()
 {
    $('#example').dataTable();
   });
</script>   
<div class='container-fluid'>
	<div class='row bgwhite padtop10'>
		<div class='col-md-12'>
			<div class='panel panel-info'>
				<div class='panel-heading'>
					<div class='panel-title'>
						Batch Upload Status <a href='sd_upload_panel.php' class='btn btn-default'>Upload Panel</a> | <a href='sd_process_report.php' class='btn btn-default'>Batch Scanning Status</a>
					</div>
				</div>
				<div class='panel-body'>
				<form method="post">
			
				<table class='table table-condensed  cf' id='example'>
				<thead>
				<tr>
					<th>#</th>
					<th>BatchID</th>
					<th>TimeStamp</th>
					<th>FileName</th>
					<th>Uploaded By</th>
					<th>Total Records</th>			
					<th></th>			
					<th></th>			
					<th></th>			
				</tr>
				</thead>
				<tbody>
				<?php 			
					$Query_ScanningReport=mysql_query("select * from tbl_Batch_Master where school_id='$school_id' order by id desc");
					$sr=1;
					while($res=mysql_fetch_array($Query_ScanningReport)){			
				?>
				<tr>
					<td><?php echo $sr; ?></td>
					<td><?php echo $res['batch_id']; ?></td>
					<td><?php echo $res['uploaded_date_time']; ?></td>
					<td><?php echo $res['input_file_name']; ?></td>
					<td><?php echo $res['uploaded_by']; ?></td>
					<td><?php echo $res['num_records_uploaded']; ?></td>			
					<td><a href="<?php echo $_SERVER['PHP_SELF'].'?proc='.trim($res['db_table_name']).'&batch_id='.$res['batch_id'].'&school_id='.$res['school_id'].'&pro=scan'; ?>" class='btn btn-default btn-sm'>Scan</a></td>			
					<td><a href="<?php echo $_SERVER['PHP_SELF'].'?proc='.trim($res['db_table_name']).'&batch_id='.$res['batch_id'].'&school_id='.$res['school_id'].'&pro=process'; ?>" class='btn btn-default btn-sm'>Process</a></td>			
					<td><a href="<?php echo 'sd_error_records.php?proc='.trim($res['db_table_name']).'&batch_id='.$res['batch_id'].'&school_id='.$res['school_id'].'&pro=dwnld'; ?>" target='_blank' class='btn btn-default btn-sm'>Download Error Records</a></td>			
				</tr>
				<?php $sr++; } ?>				
				</tbody>								
				</table>			
				</form>			
				</div>
			</div>
		</div>
	</div>
</div>