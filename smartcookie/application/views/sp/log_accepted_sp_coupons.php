<?php $this->load->view('sp/header'); 
$this->load->helper('imageurl');
?>

<script>
$(document).ready(function(){
	
    $('#myTable').DataTable();
	
});
</script>

<div class="panel panel-violet">
  <div class="panel-heading">
  Accepted Sponsored Coupons <span class="badge"><?=$count_accepted_sp_coupons;?></span>
  </div>
  <div class="panel-body">		
	<div class="table-responsive" id="no-more-tables">
	<table class="table table-bordered table-striped table-condensed cf" id="myTable">
	<thead class="cf">
	<tr>
	<th>Sr.No</th>
	<th>Image</th>
	<th>Used By</th>
	<th>User Type</th>
	<th>Code</th>
	<th>Product</th>
	<th>Discount</th>
	<th>Points</th>
	<th>Date<br/>(DD/MM/YYYY)</th>
	</tr>
	</thead>
	<tbody>
<?php 
$sr=1;
foreach ($log_accepted_sp_coupons as $key => $value): 
//print_r($value);
		$dt=explode(' ',$value->timestamp);
		$d=$dt[0];
		$dts=explode('-',$d);
//dd/mm/yyyy
		$tm=$dts[2].'/'.$dts[1].'/'.$dts[0];
?>
<tr>
	<td data-title="Sr." ><?=$sr;?></td>


        <td data-title="Image" ><img src="<?php
            if($value->photo!=''){

            echo base_url().'core/'.$value->photo;
}
else
{
echo imageurl($value->photo,'avatar');
}?>" height="64px" width="64px"></td>

    <? if($value->cmp_name!='')
    {?>
        <td data-title="Used By" ><?=$value->cmp_name;?></td>
    <? }
    else{
        ?>
        <td data-title="Used By" ><?=$value->name;?></td>
    <? }?>
	<td data-title="User Type" ><?=$value->user_type;?></td>
	<td data-title="Code" ><?=$value->code;?></td>
	<td data-title="Product" ><?php if(!is_numeric($value->Sponser_product) and strpos($value->Sponser_product, '%') == false){ echo $value->Sponser_product; } ?></td>	
	<td data-title="Discount" >
	<?php if(is_numeric($value->discount)){ 
			echo $value->discount.'%'; 
		}elseif(strpos($value->discount, '%') !== false){
			echo $value->discount;
	} ?></td>	
	<td data-title="Points" ><?=$value->for_points;?></td>
	<td data-title="Date(DD/MM/YYYY)" ><?=$tm;?></td>	
</tr>
<?php 
$sr++;
endforeach;
 ?>		

</tbody>
</table></div></div>
	</div>
	
