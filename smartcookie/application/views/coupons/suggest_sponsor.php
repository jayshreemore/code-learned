<script>
$(document).ready(function(){ 

//getLocation();

$("#state").change(function(){
		var state=$(this).val();
		var country=$("#country").val();
		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>" + "Ccoupon/country_state_city",
			dataType: 'text',
			data: { country: country, state: state},
			success: function(res) {
				if (res)
				{
					//alert(res);
 					obj = JSON && JSON.parse(res) || $.parseJSON(res);
					$("#city").empty();
						$.each(obj, function () {
							$.each(this, function (name, value) {
								//console.log(name + '=' + value);
									$('#city')
									 .append($("<option></option>")
									 .attr("value",value)
									 .text(value));
									
							});
						});
					//positionError();					}
				}
			}
});

});
	
});
</script>
<script>
	   function valid()  
       {
			var regx1=/^[A-z ]+$/;
			var regx2=/^[0-9]+$/;
			//var regx3=;

			var vendor_name=document.getElementById("name").value; 
			if(vendor_name==null||vendor_name==""){
				document.getElementById('errorname').innerHTML='Enter sponsor name.';
				return false;
			}else{
				document.getElementById('errorname').innerHTML='';
			}
			
			
			var vendor_address=document.getElementById("vendor_address").value;
			if (vendor_address== null || vendor_address == ""){
				document.getElementById('errorvendor_address').innerHTML='Please enter sponsor address.';
				return false;
			}else{
				document.getElementById('errorvendor_address').innerHTML='';
			}
			
			var product_type=document.getElementById("cat").value;
			if (product_type== null || product_type == ""){
				document.getElementById('errorproduct_type').innerHTML='Please select category.';
				return false;
			}else{
				document.getElementById('errorproduct_type').innerHTML='';
			}
			
			var phone_number=document.getElementById("phone_number").value;
			
			if (phone_number== null || phone_number == ""){
				document.getElementById('errorphone_number').innerHTML='Please enter phone number.';
				return false;
			}else{
				document.getElementById('errorphone_number').innerHTML='';
			}
			
			if(!regx2.test(phone_number)){
				document.getElementById('errorphone_number').innerHTML='Please enter valid phone number.';
				return false;
			}else{
				document.getElementById('errorphone_number').innerHTML="";
			}

 }
</script>
<script>
$(document).ready(function(){ 
	getLocation();
});

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, positionError);
    } else {
        positionError();
    }
}

function showPosition(position){
	document.getElementById('lat').value=position.coords.latitude;
	document.getElementById('lon').value=position.coords.longitude;	
}
function positionError(position){
	document.getElementById('lat').value='';
	document.getElementById('lon').value='';	
}

</script>
<style>
sup{
	color:red;
}
</style>
<div class='panel panel-default'>
<div class='panel-heading'>
Suggest New Sponsor
</div>
<div class='panel-body'>
<?php 
	echo form_open('Ccoupon/suggest_new_sponsor'); ?>  
<div class="col-sm-6">

	<div class="form-group">
	<label for="name">Sponsor Name : <sup>*</sup></label>
	<input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name'); ?>" placeholder='Sponsor Name'>	
	<?php echo form_error('name', "<span style='color:red;' id='errorname' >", "</span>"); ?>
	</div>
	
	<div class="form-group">
	<label for="company">Company Name : <sup>*</sup></label>
	<input type="company" class="form-control" name="company" id="company" placeholder="Company Name">	
	<?php echo form_error('company', "<span style='color:red;' id='errorcompany' >", "</span>"); ?>
	</div>

	<div class="form-group" >
	<label for="product_type">Sponsor Category / Type : <sup>*</sup></label>
	<select class="form-control btn-sm" name="cat" id="cat">
	<option value=''>Select</option>
	<?php foreach ($categories as $key => $value): ?>						 	
	<option value="<?php echo $categories[$key]->id; ?>" <?php if($catsel==$categories[$key]->id){ echo 'selected';} ?> ><?php echo $categories[$key]->category; ?></option>
	<?php endforeach; ?>  
	</select>
	<?php echo form_error('cat', "<span style='color:red;' id='errorproduct_type' >", "</span>"); ?>
	</div>

	<div class="form-group">
	<label for="phone_number">Phone Number : <sup>*</sup></label>
	<input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number" 
	value="<?php echo set_value('phone_number'); ?>">	
	<?php echo form_error('phone_number', "<span style='color:red;' id='errorphone_number' >", "</span>"); ?>
	</div>
	
	<div class="form-group">
	<label for="email">Email ID : </label>
	<input type="email" class="form-control" name="email" id="email"  value="<?php echo set_value('email'); ?>" placeholder="Email ID ( Not mandatory)">	
	<?php echo form_error('email', "<span style='color:red;' id='erroremail' >", "</span>"); ?>
	</div>
	
	
						  
</div>
<!-- right side start -->
						 
<div class="col-sm-6">

<div class="form-group">
	<label>Sponsor Address:<sup>*</sup></label>
	<input type='hidden' name='country' id='country' value='<?=$userinfo[0]->country; ?>'>					
	<input type='hidden' name='lat' id='lat' value=''>					
	<input type='hidden' name='lon' id='lon' value=''>					

<div class="row">

	<div class="col-md-3" >
	<select class="form-control" id="state" name="state" required >	
	<?php foreach ($states as $key => $value): ?>						 	
	<option value="<?php echo $states[$key]->state; ?>" <?php if($statesel==$states[$key]->state){ echo 'selected';} ?> ><?php echo $states[$key]->state; ?></option>
	<?php endforeach; ?>
	</select>
	</div>

	<div class="col-md-3" >	
	<select class="form-control" id="city" name="city" required>
	<?php foreach ($cities as $key => $value): ?>						 	
	<option value="<?php echo $cities[$key]->sub_district; ?>" <?php if($citysel==$cities[$key]->sub_district){ echo 'selected';} ?> ><?php echo $cities[$key]->sub_district; ?></option>
	<?php endforeach; ?>
	</select>
	</div>
</div>	
</div>

<div class="form-group">
	<label>Address:<sup>*</sup></label>
	<textarea class="form-control" rows="3" name="vendor_address" id="vendor_address" value='<?php echo set_value('vendor_address'); ?>' placeholder="Address goes here..." > </textarea>	
	<?php echo form_error('vendor_address', "<span style='color:red;' id='errorvendor_address' >", "</span>"); ?>
</div> 
<div class="form-group">
<?php
	$js = 'onClick="getLocation()"';
echo form_checkbox('iscurrent', 'current', FALSE, $js)."   I am at sponsors.";
?>
</div> 
<div class="form-group">
	<input type="Submit" name="submit" class="btn btn-success btn-sm" onClick="return valid()" value="Suggest"/> 
	<a href="<?php echo base_url("Ccoupon/suggested_sponsors");?>"><button type="button" class="btn btn-danger btn-sm">Cancel</button></a> 
</div> 

</div>  						   
</form>  
</div>	
</div>