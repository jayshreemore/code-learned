<?php $this->load->view('sp/header'); ?>

<style>

.row{

	padding-top:10px;

}	


</style>
<script>
function bigImg(x) {
    x.style.height = "300px";
    x.style.width = "300px";
}

function normalImg(x) {
    x.style.height = "32px";
    x.style.width = "32px";
}
</script>
<script>

$(document).ready(function(){

	

    $('#myTable').DataTable();

	

});

</script>

<script>

$(document).ready(function(){

	

    $('#myTable1').DataTable();

	

});

</script>

<script>

function confirmation(xxx, product){	

    var answer = confirm("Are you sure to delete "+product+"?");

    if (answer){        

       // window.location = <?php echo base_url();?>+"/Csponsor/del/tbl_sponsored/"+xxx;

		window.location ="<?php echo site_url('Csponsor/del/product_setup/tbl_sponsored/'); ?>"+'/'+xxx;

    }

    else{       

    }

}

</script>

<script>

function edit_product(id, pro, dis, point){

	oFormObject = document.forms['add_product'];

	oFormObject.elements["iproduct"].value =pro;

	oFormObject.elements["prodis"].value =dis;

	oFormObject.elements["pointsp"].value =point;

	oFormObject.elements["edit_pid"].value =id;

}

</script>

<script>

function edit_discount(id, pro, point){

	oFormObject = document.forms['add_discount'];

	oFormObject.elements["idiscount"].value =pro;

	oFormObject.elements["pointsd"].value =point;

	oFormObject.elements["edit_did"].value =id;

}

</script>

<div class="row">



<div class="col-md-6">

	<div class="panel panel-violet">

		<div class="panel-heading">

			Add Product

		</div>

		<div class="panel-body">

		<div class="row">	

			<div class="col-md-12">			

			<div class="col-md-6">

			<?php $attributes = array('id' => 'add_product');

			 echo form_open_multipart('Csponsor/add_product', $attributes); ?>

			<!-- product name-->

			<div class="row">

				<input class="form-control" name="iproduct" id="iproduct" placeholder="Enter Product"  value="<?php echo set_value('iproduct');?>" type="text">

			</div>

			<?php echo form_error('iproduct', "<span style='color:red;' id='errord' >", "</span>"); ?>

			<!-- end product name-->

				

			<!-- product discount-->	

			<div class="row">

				

				

			<div class="input-group">

			<input class="form-control" name="prodis" id="prodis" placeholder="Discount Per Product" onkeypress="return isNumberKey(event)" value="<?php echo set_value('prodis');?>" type="number" min="1" max="100">

			  <span class="input-group-addon" id="basic-addon2">%</span>

			</div>

				

				

			</div>			

			<?php echo form_error('prodis', "<span style='color:red;' id='errord' >", "</span>"); ?>

			

			

			

			

			<!-- end discount-->

			

			<!-- points-->

			<div class="row">

				<input class="form-control" name="pointsp" id="pointsp" placeholder="Points Per Product" onkeypress="return isNumberKey(event)" value="<?php echo set_value('pointsp');?>" type="number" min="1">

			</div>		

			<?php echo form_error('pointsp', "<span style='color:red;' id='errord' >", "</span>"); ?>

			<?php // echo validation_errors("<span style='color:red;'>", "</span>"); ?>

			<!--end points-->

			

			<!-- proimg-->

			<div class="row">

			Product Image

				<input class="form-control" name="proimg" id="proimg" placeholder="Product Image" type="file" >

				<br/><small>Max Image Size 100KB, image Width X Height should be less than 1024 X 900 pixels.</small>

			</div>		

			<?php echo form_error('proimg', "<span style='color:red;' id='errorproimg' >", "</span>"); ?>		

			<!--end proimg-->

				<span style="color:red;"><?php echo $up['proimg']['upload_error']; ?></span>

			

			<input name="edit_pid" id="edit_pid" value="<?php echo set_value('edit_pid');?>" type="hidden">

			

			<div class="row">

				<input class="btn btn-success" name="submit_product" value="Submit" onclick="return validp()" type="submit"/> <a href="<?php echo base_url('Csponsor'); ?>">

				<input class="btn btn-warning" name="Cancel" value="Cancel" type="button"></a>
				
         <input class="btn btn-success" name="product_gallery" value="Product Gallery" onclick="location.href='<?php echo base_url();?>Csponsor/product_gallery'"type="button"/>
				

			</div>

			<div class="row text-success"></div>

			

			</form>

            </div>

			</div>

			</div>

		<div class="row">	

		<div class="col-md-12">

				<div class="row">

				<div class="table-responsive" id="no-more-tables" style="overflow-x: scroll;">

				<table class="table table-bordered table-striped table-condensed cf" id="myTable">

				<thead class="cf">

				

						<tr >

						<th >Sr.No</th>

						<th >Products</th>
						
						<th >Image</th>

						<th >Discount %</th>

						<th >Points</th>

						<th >Edit</th>

						<th >Delete</th>

						</tr>

				</thead>

					<tbody>

					<?php 

					$sr=1;

					foreach($product as $key=>$value): ?>

					<tr>

						<td data-title="Sr." ><?=$sr;?></td>

						<td data-title="Product"><?=$product[$key]->Sponser_product;?></td>
						
						<td data-title="Productimage" >
						
					
						<img onmouseover="bigImg(this)" onmouseout="normalImg(this)" border="0" src="<?php if($product[$key]->product_image!=''):echo base_url().'Assets/images/sp/productimage/'.$product[$key]->product_image;  else: echo base_url().'Assets/images/avatar/avatar_2x.png'; endif;?>"  width="40" height="40">
						</td>
						<td data-title="Discount"><?=$product[$key]->discount;?></td>

						<td data-title="Points" ><?=$product[$key]->points_per_product;?></td>

						<td data-title="Edit" >	

					

							<a onclick="edit_product('<?=$product[$key]->id;?>','<?=$product[$key]->Sponser_product;?>','<?=$product[$key]->discount;?>','<?=$product[$key]->points_per_product;?>','<?=$product[$key]->product_image;?>')">

								<span class="glyphicon glyphicon-pencil"></span>

							</a>

						</td>

						<td data-title="Delete" >

							<a onclick="confirmation('<?=$product[$key]->id;?>','<?=$product[$key]->Sponser_product;?>')">

							<span class="glyphicon glyphicon-trash"></span></a>

						</td>

					</tr>

					<?php $sr++; 

					endforeach; 
					?>

					</tbody>

				</table>

				</div>

			</div>

		</div>		

			

		</div>

	</div>

</div>

</div>

<div class="col-md-6">

<div class="panel panel-violet">

		<div class="panel-heading">

			Add Discount

		</div>

		<div class="panel-body">

		<div class="row">

			<div class="col-md-12">			

			<div class="col-md-6">	

			<?php $attributes1 = array('id' => 'add_discount');

		 echo form_open_multipart('Csponsor/add_discount', $attributes1); ?>

			

			<div class="row">

								

				<div class="input-group">

 <input class="form-control" name="idiscount" id="idiscount" placeholder="Enter Discount" onkeypress="return isNumberKey(event)" value="<?php echo set_value('idiscount');?>"  type="number" min="1" max="100">

  <span class="input-group-addon" id="basic-addon2">%</span>

</div>

			</div>

			<?php echo form_error('idiscount', "<span style='color:red;' id='errord' >", "</span>"); ?>

			<div class="row">

				<input class="form-control" name="pointsd" id="pointsd" placeholder="Points"  value="<?php echo set_value('pointsd');?>" onkeypress="return isNumberKey(event)" type="number" min="0">

				

			</div>	

			<?php echo form_error('pointsd', "<span style='color:red;' id='errord' >", "</span>"); ?>

			

			<!-- proimg-->

			<div class="row">

			Product Image

				<input class="form-control" name="disimg" id="disimg" placeholder="Product Image" type="file" >

				<br/><small>Max Image Size 100KB, image Width X Height should be less than 1024 X 900 pixels.</small>

			</div>		

			<span style="color:red;"><?php echo $up['disimg']['upload_error']; ?></span>		

			<!--end proimg-->

			

			<input name="edit_did" id="edit_did" value="<?php echo set_value('edit_did');?>" type="hidden">

			<div class="row">

				<input class="btn btn-success" name="submit_discount" value="Submit" onclick="return validd()" type="submit"> <a href="<?php echo base_url('Csponsor'); ?>"> 

				<input class="btn btn-warning" name="Cancel" value="Cancel" type="button"></a>

			</div>

			<div class="row text-success"></div>

			</form>

            </div>			

			</div>

		</div>

			<div class="row">

			<div class="col-md-12">

				<div class="row">

				<div class="table-responsive" id="no-more-tables" style="overflow-x: scroll;">

				<table class="table table-bordered table-striped table-condensed cf" id="myTable1" >

				<thead class="cf">

						<tr>

							<th>Sr.No</th>

							<th>Discount%</th>

							<th>Points</th>

							<th>Edit</th>

							<th>Delete</th>

						</tr>

					</thead>

					<tbody>	

					<?php 

					$sr1=1;

					foreach($discount as $key=>$value): ?>

						<tr>

						<td data-title="Sr." ><?=$sr1;?></td>

						<td data-title="Discount" ><?=$discount[$key]->Sponser_product;?></td>

						<td data-title="Points" ><?=$discount[$key]->points_per_product;?></td>

						<td data-title="Edit">

							<a onclick="edit_discount('<?=$discount[$key]->id;?>','<?=$discount[$key]->Sponser_product;?>','<?=$discount[$key]->points_per_product;?>' )">

							<span class="glyphicon glyphicon-pencil"></span>

							</a>												

						</td>

						<td data-title="Delete" ><a onclick="confirmation('<?=$discount[$key]->id;?>','<?=$discount[$key]->Sponser_product;?>')">

							<span class="glyphicon glyphicon-trash"></span></a>

						</td>

						</tr>

						<?php $sr1++; 

					endforeach; ?>

						</tbody>

				</table></div>

				</div>

			</div>

			</div>

		</div>

	</div>

</div>



</div>

