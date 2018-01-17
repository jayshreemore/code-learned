<?php include("header.php"); ?>

<html lang="en">
<head>
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
  <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script>
	$(document).ready(function(){
		$('#myTable').DataTable();
	});
  </script>
</head>
<body>
 
<div class="container row">
	<div class='col-md-9 col-md-offset-4' align='center'>
	 <div class="panel-body">
	  <h4 style='background-color:#203CB6;color:white;text-decoration:underline;padding:10px'><b>Earned Brown Points Log</b></h4>
	 </div>
	  <div class="panel panel-default">
		<div class="panel-body">
			<table id='myTable'>
			<thead>
				<tr>
					<th>Reason</th>
					<th>Appointer Name</th>
					<th>Date</th>
					<th>Points</th>
				</tr>
			</thead>
			<tbody>
				
				<?php
				$t_id = $_SESSION['rid'];
				//var_dump($_SESSION);
					$query = mysql_query("select assigner_id,reason,point_date,sc_point,sc_entities_id from tbl_teacher_point  where  reason in ('suggested_sponsor','request_accepted','request_sent') and sc_teacher_id = '$t_id'");
					while($row=mysql_fetch_assoc($query)){
						$entity_id_from_table = $row['sc_entities_id'];
						$receiver_id = $row['assigner_id'];
				?>
					<tr>
					<td><?php echo $row['reason'];?></td>
						<?php
						if($entity_id_from_table == '108')
						{
							$receiver_data_query = mysql_query("select sp_name from tbl_sponsorer where id='$receiver_id'");
							$receiver_data_query_result = mysql_fetch_assoc($receiver_data_query);
						}
						?>
						<td><?php echo $receiver_data_query_result['sp_name'];?></td>
						<td><?php echo $row['point_date'];?></td>
						<td><?php echo $row['sc_point'];?></td>
					</tr>
				<?php
					}
				?>
			</tbody>
		</div>
	</div>
  </div>
</div>

</body>
</html>


