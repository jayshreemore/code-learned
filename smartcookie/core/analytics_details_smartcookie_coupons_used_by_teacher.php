<?php
include('cookieadminheader.php');
$result =  mysql_query("SELECT * FROM techindi_Dev.tbl_teacher_coupon where status='no' or  status='p'");
?>
<html>
<head>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

<!--tr:nth-child(even) {
    background-color: #dddddd;
}-->

</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
				
         dateFormat: 'dd/mm/yy',     
            });

  } );
  </script
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

  
  <script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js"></script>
  
 <script>
 $(document).ready(function() 
 {

    $('#example').DataTable(
	{
	"pageLength": 5
	});
	
	$('#example1').DataTable(
	{
	"pageLength": 5
	});
} );
</script>

</head>
<body>

<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading" align='center'><h3>Smartcookie coupons Used By Teacher</h3></div>
		<div class="panel-body">
			<div id="no-more-tables" style="padding-top:20px;">
			<table id="example" class="display" width="100%" cellspacing="0">
				<thead style="background-color:#FFFFFF;">
									
					<tr>
					<th>Sr.No.</th>
					<th>Teacher Name</th>
					<th>School Id</th>
					<th>Coupon Id</th>
					<th>amount</th>
					
					</tr>
				</thead>
				<tbody>
					 <?php
						$i = 1;
						while ($row= mysql_fetch_array($result)){
							$id=$row['user_id'];
							//echo "select t_complete_name where id='$id'";
							$q=mysql_query("select t_complete_name,school_id from tbl_teacher where id='$id'");
							$result1=mysql_fetch_array($q);
					 ?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $result1['t_complete_name']; ?></td>
							<td><?php echo $result1['school_id']; ?></td>
							<td><?php echo $row['coupon_id']; ?></td>
							<td><?php echo $row['amount']; ?></td>
						</tr>
					<?php $i++;} ?>     
				</tbody>
			</table>

			</div>
		</div>
	</div>
</div>
</body>
</html>