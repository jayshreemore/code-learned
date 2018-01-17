<?php $this->load->view('slp/header'); ?>

<script>
$(document).ready(function(){
	
    $('#myTable').DataTable();
	
});
</script>


<script>
function confirmationToActivate(xxx){	
    var answer = confirm("Are you sure to activate SP"+xxx+"?");
    if (answer){ 
		window.location ="<?php echo site_url('Csalesperson/activateSponsor/'); ?>"+'/'+xxx;
    }
    else{ 
	
    }
}
</script>
<!--
<script>
function edit_product(xxx){	
   window.location ="<?php echo site_url('Csponsor/edit_coupon/'); ?>"+'/'+xxx;
}
</script>
-->
<div class="panel panel-violet">
  <div class="panel-heading">
  Registered Sponsors List <span class="badge"><?=$count_RegisteredSponsorsList;?></span>
  </div>
  <div class="panel-body">		
	<div class="table-responsive" id="no-more-tables">
	<table class="table table-bordered table-striped table-condensed cf" id="myTable">
	<thead class="cf">
	<tr>
	<th>#</th>
	<th>ID</th>
	<th>Name</th>
	<th>Phone</th>
	<th>Email</th>
	<th>Address</th>
	<th>City</th>
	<th>State</th>
	<th>Country</th>
	<th>Amount</th>
	<th>Registered Date<br/><font size="1">(DD/MM/YYYY)</font></th>
	<th>Activate</th>
<!--	<th></th>-->
	</tr>
	</thead>
	<tbody>
<?php 
$sr=1;
foreach ($RegisteredSponsorsList as $key => $value): 
		$vu1=explode('/',@$value->sp_date);
		$vu=@$vu1[1].'/'.@$vu1[0].'/'.@$vu1[2];
		
	switch($value->v_status){
		case 'called':
			$color='#ff0000';
			break;
		case 'Active':
			$color='#228B22';
			break;	
		case 'Inactive':
			$color='#CCCC00';
			break;	
		default:
			$color='#228B22';				
	}	
?>

<tr>
	<td data-title="Sr." ><?=$sr;?></td>
	<td data-title="ID" ><span style='background-color:<?=$color;?>; color:#fff' ><?='SP'.$value->id; ?></span></td>
	<td data-title="Name" ><?=$value->sp_company; ?></td>
	<td data-title="Phone" ><?=$value->sp_phone; ?></td>
	<td data-title="Email" ><?=$value->sp_email; ?></td>
	<td data-title="Address" ><?=$value->sp_address; ?></td>
	<td data-title="City" ><?=$value->sp_city; ?></td>
	<td data-title="State" ><?=$value->sp_state; ?></td>
	<td data-title="State" ><?=$value->sp_country; ?></td>
	<td data-title="Amount" ><?=$value->amount; ?></td>
	<td data-title="Registration Date(DD/MM/YYYY)" ><?=$vu; ?></td>		
	<td data-title="Active" >	
	<?php if($value->v_status!='Active'){ ?>
		<a onclick="confirmationToActivate('<?=$value->id;?>')">
			<span class="glyphicon glyphicon-ok-circle"></span>
		</a>
	<?php }else{
		echo $value->v_status;
	} ?>
	</td>
<!--	<td data-title="Delete" >
		<a onclick="confirmation('<?=$value->id;?>')">
		<span class="glyphicon glyphicon-trash"></span></a>
	</td>-->
</tr>
<?php 
	$sr++;
	endforeach;
?>	

</tbody>
</table></div></div>
	</div>