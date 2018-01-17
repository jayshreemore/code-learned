
<?php $this->load->view('sp/header'); ?>

<script>
$(document).ready(function(){
	
    $('#myTable').DataTable();
	
});
</script>
<script>
function confirmation(xxx, product){	
    var answer = confirm("Are you sure to delete "+product+"?");
    if (answer){        
       // window.location = <?php echo base_url();?>+"/Csponsor/del/tbl_sponsored/"+xxx;
		window.location ="<?php echo site_url('Csponsor/del/log_generated_coupons/tbl_sponsored/'); ?>"+'/'+xxx;
    }
    else{       
    }
}
</script>
<script>
function edit_product(xxx){	
   window.location ="<?php echo site_url('Csponsor/edit_coupon/'); ?>"+'/'+xxx;
}
</script>
<div class="panel panel-violet">
  <div class="panel-heading">
  Generated Coupons <span class="badge"><?=$count_generated_coupons;?></span>
  </div>
  <div class="panel-body">		
	<div class="table-responsive" id="no-more-tables">
	<table class="table table-bordered table-striped table-condensed cf" id="myTable">
	<thead class="cf">
	<tr><th >Sr.No</th>
	<!--<th>ID</th>-->
	<th>Product</th>
		<th>Discount</th>
	<th>Points</th>
	<th>Start Date<br/><font size="1">(DD/MM/YYYY)</font></th>
	<th>End Date<br/><font size="1">(DD/MM/YYYY)</font></th>
	<th>Category</th>
	<th>Price</th>

	<th>Buy</th>
	<th>Buy_Get</th>
	<th>Status</th>
	<th>Edit</th>
	<th>Delete</th>
	</tr>
	</thead>
	<tbody>
<?php 
$sr=1;
foreach ($log_generated_coupons as $key => $value): 
//print_r($value);
		$vu1=explode('/',@$value->valid_until);
		$vu=@$vu1[1].'/'.@$vu1[0].'/'.@$vu1[2];
		
		$sd1=explode('/',@$value->sponsered_date);
		$sd=@$sd1[1].'/'.@$sd1[0].'/'.@$sd1[2];
?>

<tr>
	<td data-title="Sr." ><?=$sr;?></td>
	<!--<td data-title="Coupon ID" ><?=$value->id;?></td>-->
	
	<td data-title="Discount" >
	<?php if(is_numeric($value->Sponser_product)){ 
			//echo $value->Sponser_product.'%'; 
			echo '-';
		}elseif(strpos($value->Sponser_product, '%') !== false){
			//echo $value->Sponser_product;
			echo '-';
		}else{
			echo $value->Sponser_product;
		} ?>
	</td>
		<td data-title="Discount" ><?php if(is_numeric($value->discount)){ 
			echo $value->discount.'%'; 
		}elseif(strpos($value->discount, '%') !== false){
			echo $value->discount;
	} ?></td>
	<td data-title="Purchase Points" ><?=$value->points_per_product; ?></td>
	<td data-title="Start Date(DD/MM/YYYY)" ><?=$sd; ?></td>
	<td data-title="End Date(DD/MM/YYYY)" ><?=$vu; ?></td>	
	<td data-title="Category" ><?=$value->category; ?></td>
	<td data-title="Price" ><?=$value->currency.' '.$value->product_price; ?></td>	

	<td data-title="Buy" ><?=$value->buy; ?></td>
	<td data-title="Buy_Get" ><?=$value->get; ?></td>
	<td data-title="Buy_Get" ><?=strtoupper($value->validity); ?></td>
	<td data-title="Edit" >					
		<a onclick="edit_product('<?=$value->id;?>')">
			<span class="glyphicon glyphicon-pencil"></span>
		</a>
	</td>
	<td data-title="Delete" >
		<a onclick="confirmation('<?=$value->id;?>','<?=$value->Sponser_product;?>')">
		<span class="glyphicon glyphicon-trash"></span></a>
	</td>
</tr>
<?php 
	$sr++;
	endforeach;
?>	

</tbody>
</table></div></div>
	</div>
	
