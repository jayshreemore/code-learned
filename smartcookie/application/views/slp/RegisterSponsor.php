<?php $this->load->view('slp/header'); ?>

<!DOCTYPE html>
<html>
<body>

<script>
var x = document.getElementByClass("submit");

function getLocation() {
	
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude + 
    "<br>Longitude: " + position.coords.longitude;
	
	
}
</script>

</body>
</html>

<script>
$(document).ready(function(){
	$("#sp_country").change(function(){
		var cntr=$(this).val();
		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>" + "Csalesperson/country_state",
			dataType: 'text',
			data: { country: cntr},
			success: function(res) {
				if (res)
				{
					//alert(res);
 					obj = JSON && JSON.parse(res) || $.parseJSON(res);
					$("#sp_state").empty();
					$("#sp_city").empty();
					
						$.each(obj, function () {
							$.each(this, function (name, value) {
								//console.log(name + '=' + value);
									$('#sp_state')
									 .append($("<option></option>")
									 .attr("value",value)
									 .text(value));
							});
						});				

				}
			}
		});
	});	
});
</script>
<script>
$(document).ready(function(){
	$("#sp_state").change(function(){
		var sp_state=$(this).val();
		var sp_country=$("#sp_country").val();
		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>" + "Csalesperson/country_state_city",
			dataType: 'text',
			data: { country: sp_country, state: sp_state},
			success: function(res) {
				if (res)
				{
					//alert(res);
 					obj = JSON && JSON.parse(res) || $.parseJSON(res);
					$("#sp_city").empty();
						$.each(obj, function () {
							$.each(this, function (name, value) {
								//console.log(name + '=' + value);
									$('#sp_city')
									 .append($("<option></option>")
									 .attr("value",value)
									 .text(value));
							});
						});
				}
			}
		});
	});
	});
</script>



<style>
.required, .error{
	color:red;
}

label {
    
    color: black;
	font-weight:bold;
    
}
</style>
	<div class="panel panel-violet">
		<div class="panel-heading">
		<h2 class="panel-title"><strong>Register Sponsor</strong></h2>
		</div>
		<div class="panel-body">
	
	<div class='row'>	
	<div class='col-md-6 '>	
			<?php $attributes = array('id' => '');
			echo form_open_multipart('Csalesperson/RegisterSponsor', $attributes); ?>

			<table class="table table-hover">
			<tr>
				<td>
					<label for="sponsor_name">Sponsor Name <span class="required">*</span></label>
				</td>
				<td>
					<input id="sponsor_name" type="text" class='form-control' name="sponsor_name" maxlength="50" value="<?php echo set_value('sponsor_name'); ?>" required />
					<?php echo form_error('sponsor_name'); ?>							
				</td>
				</tr>
				<td>
					<label for="sp_company">Company Name <span class="required">*</span></label>
				</td>
				<td>
					<input id="sp_company" type="text" class='form-control' name="sp_company" maxlength="50" value="<?php echo set_value('sp_company'); ?>" required />
					<?php echo form_error('sp_company'); ?>							
				</td>
			</tr>
			<tr>
				<td>
					<label for="sp_phone">Mobile <span class="required">*</span></label>
				</td>
				<td>
				<input id="sp_phone" type="tel" class='form-control' name="sp_phone" maxlength="15" value="<?php echo set_value('sp_phone'); ?>" required />
			
					<?php echo form_error('sp_phone'); ?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="sp_landline">Landline</label>
				</td>
				<td>				
					
					<input id="sp_landline" type="tel" class='form-control' name="sp_landline" maxlength="20" value="<?php echo set_value('sp_landline'); ?>"  />
					<?php echo form_error('sp_landline'); ?>
					
				</td>
			</tr>
			<tr>
				<td>
					<label for="sp_email">Email </label>
				</td>
				<td>						
					
					<input id="sp_email" type="email" class='form-control' name="sp_email" maxlength="60" value="<?php echo set_value('sp_email'); ?>"  />
					<?php echo form_error('sp_email'); ?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="v_category">Product Category <span class="required">*</span></label>
				</td>
				<td>		
									
						<?php 
						$cats=array();
						$cats['']='Please Select Category';	
						foreach ($categories as $key => $value){						 	
									$cats[$value->id]=$value->category;					
									
						} ?>				

					<?php echo form_dropdown('v_category', $cats, set_value('v_category'),'class="form-control" id="v_category" required="required"')?>
					<?php echo form_error('v_category'); ?>	
				</td>
			</tr>
			<tr>
				<td>
					<label for="sp_website">Website</label>
				</td>
				<td>					
					<input id="sp_website" type="url" class='form-control' name="sp_website" maxlength="60" value="<?php echo set_value('sp_website'); ?>"  />
					<?php echo form_error('sp_website'); ?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="sp_address">Address <span class="required">*</span></label>
				</td>
				<td>					
				<?php echo form_textarea( array( 'name' => 'sp_address', 
												'rows' => '5', 
												'cols' => '80', 
												'value' => set_value('sp_address'),			
												'class' => 'form-control'	
				) )?>
				<?php echo form_error('sp_address'); ?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="sp_pin">Pin <span class="required">*</span></label>
				</td>
				<td>
				<input id="sp_pin" type="tel" class='form-control' name="sp_pin" maxlength="15" value="<?php echo set_value('sp_pin'); ?>" required />
			
					<?php echo form_error('sp_pin'); ?>
				</td>
			</tr>
			<tr>
				<td>
					
				</td>
				<td class="text-capitalize">
						<div class="row">							
						  <div class="col-md-4">
					<label for="sp_country">Country <span class="required">*</span></label>
									
					<?php // Change the values in this array to populate your dropdown as required ?>
						<?php 
						$cntry=array();
						$cntry['']='Select';	
						foreach ($countries as $key => $value){						 	
									$cntry[$value->country]=$value->country;					
									
						} ?>	
					<br /><?php echo form_dropdown('sp_country', $cntry, set_value('sp_country'),'class="form-control" id="sp_country" required="required"')?>
							<?php echo form_error('sp_country'); ?>	
						 </div> 
						 
							<div class="col-md-4">
					<label for="sp_state">State <span class="required">*</span></label>			
					
					<?php // Change the values in this array to populate your dropdown as required ?>
					<?php 
					if(uri_string()=='Csalesperson/RegisterSponsor'){						
						$options=array();
						foreach ($states as $key => $value){						 	
									$options[$value->state]=$value->state;					
									
						}
					}else{
						$options = array(
										  ''  => '',
										);
					}															?>													
					<br /><?php echo form_dropdown('sp_state', @$options, set_value('sp_state'),'class="form-control" id="sp_state" required="required"')?>
						<?php echo form_error('sp_state'); ?>
							</div>
						   <div class="col-md-4">
					<label for="sp_city">City <span class="required">*</span></label>
					
					
					<?php // Change the values in this array to populate your dropdown as required ?>
					<?php 					
					if(uri_string()=='Csalesperson/RegisterSponsor'){						
						$options1=array();
						foreach ($cities as $key => $value){						 	
							$options1[$value->sub_district]=$value->sub_district;
						}
					}else{
						$options1 = array(''  => '');
					}	?>
					<br /><?php echo form_dropdown('sp_city', @$options1, set_value('sp_city'),'class="form-control" id="sp_city" required="required"')?>
					<?php echo form_error('sp_city'); ?>
							</div>
						  </div>

						  <div class="clearfix"></div>
				</td>
			</tr>
			<tr>
				<td>
					<label for="sp_password">Password <span class="required">*</span></label>
				</td>
				<td>					
					<input id="sp_password" type="password" class='form-control' name="sp_password" maxlength="20" value="<?php echo set_value('sp_password'); ?>" required />
					<?php echo form_error('sp_password'); ?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="sp_password1">Confirm Password <span class="required">*</span></label>
				</td>
				<td>					
					<input id="sp_password1" type="password" class='form-control' name="sp_password1" maxlength="20" value="<?php echo set_value('sp_password1'); ?>" required />
					<?php echo form_error('sp_password1'); ?>
				</td>
			</tr>
			
			<tr>
				<td>
					<label for="image">Profile Image </label>
				</td>
				<td>					
					<input id="image" type="file" class='form-control' name="image" value="<?php echo set_value('image'); ?>"  />
					<br/><small>Max Image Size 100KB, image Width X Height should be less than 1024 X 900 pixels.</small>
					<?php echo form_error('image'); ?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="v_status">Select Status</label>
				</td>
				<td>
						<?php 
						$v_stat=array(
							''=>'Please Select Status',
							'Active'=>'Interested',
							'Inactive'=>'Not Interested',
							'Suggested'=>'Call Back/Come Later'					
						);
						 ?>				

					<?php echo form_dropdown('v_status', $v_stat, set_value('v_status'),'class="form-control" id="v_status" required="required"')?>
					<?php echo form_error('v_status'); ?>	
				</td>
			</tr>
			<tr>
				<td>
					<label for="p_mode">Payment Mode</label>
				</td>
				<td>
						<?php 
						$p_mode=array(
							''=>'Please Select Payment Mode',
							'Free Register'=>'Free Register',
							'Cheque'=>'By Cheque',
							'Cash'=>'By Cash'					
						);
						 ?>				

					<?php echo form_dropdown('p_mode', $p_mode, set_value('p_mode'),'class="form-control" id="p_mode" required="required"')?>
					<?php echo form_error('p_mode'); ?>	
				</td>
			</tr>
			
			
			<tr>
				<td>
					<label for="amount">Registration Cost</label>
				</td>
				<td>					
					<input id="amount" type="number" class='form-control' name="amount"  min='0' value="<?php echo set_value('amount'); ?>"  />
					<?php echo form_error('amount'); ?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="source">Source</label>
				</td>
				<td>
					<input id="source" type="text" class='form-control' name="source" maxlength="60" value="<?php echo set_value('source'); ?>"/>
                   
                    <?php echo form_error('source'); ?>
                    
				</td>
			</tr>
			<tr>
				<td>
					<label for="source">Comment</label>
				</td>
				<td>
					<input id="comment" type="text" class='form-control' name="comment" maxlength="60" value="<?php echo set_value('comment'); ?>"/>
                   
                    <?php echo form_error('comment'); ?>
                    
				</td>
			</tr>
			
			
			
			
			<tr>
				<td>
					<label for="discount">Discount</label>
				</td>
				<td>
					<div class='row'>
						<div class='col-md-6'>
						<div class="input-group">
							<input id="discount" type="number" class='form-control' name="discount"  min='0' max='100' value="<?php echo set_value('discount'); ?>" placeholder='Discount' />
							<?php echo form_error('discount'); ?>
						<span class="input-group-addon" id="basic-addon2">%</span>
						</div>
						</div>
						<div class='col-md-6'>
							<input id="points" type="number" class='form-control' name="points"  min='0' value="<?php echo set_value('points'); ?>" placeholder='Points' />
							<?php echo form_error('points'); ?>
						</div>
					</div>
				</td>
			</tr>
			
			<!--<tr>
				<td>
					<label for="product_image">Product Image </label>
				</td>
				<td>					
					<input id="product_image" type="file" class='form-control' name="product_image" value="<?php echo set_value('product_image'); ?>"  />
					<br/><small>Max Image Size 100KB, image Width X Height should be less than 1024 X 900 pixels.</small>
					<?php echo form_error('product_image'); ?>
				</td>
			</tr>-->
			
			<tr>
				<td>
				
				</td>
				<td><span class='error'><?php  if(isset($error)){echo $error;}else{}?></span><br/>
					<input id="editID" type="hidden" name="editID" value="<?php echo set_value('editID'); ?>"  />
					<?php echo form_submit('submit', 'Submit',"class='btn btn-success submit'"); ?> &nbsp; <input type="reset" value="Reset" class='btn btn-warning'/>
				</td>
			</tr>
	

			
			</table>				
	<?php echo form_close(); ?>
	
		</div>
		</div>
		</div>
	</div>