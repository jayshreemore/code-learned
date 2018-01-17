<?php $this->load->view('sp/header'); 
//print_r($myData);
?>
<script>
$(document).ready(function(){
	$("#phone_edit").hide();
	$("#email_edit").hide();
	$("#email_otp").hide();
	$("#phone_otp").hide();
	$("#pass_edit").hide();
	$("#selectImage1").hide();
	
	$("#p").click(function(){
        $("#phone_edit").toggle();
		$("#phone_otp").toggle();	
		
	});

    $("#e").click(function(){
        $("#email_edit").toggle();
		$("#email_otp").toggle();		
    });
	
	$("#otp_phone").click(function(){        	
		$("#phone_otp").hide();
		$("#phone_edit").hide();
    });

	$("#otp_email").click(function(){        	
		$("#email_otp").hide();
		$("#email_edit").hide();
    });
		
	$("#cp").click(function(){
        $("#pass_edit").toggle();		
	});
	
	$("#up_logo").click(function(){
        $("#selectImage1").toggle();		
	});
	
});


</script>
<script>
$(document).ready(function(){
	$("#up_phone").click(function(){
		var phone= document.getElementById('phone').value;
		var cc= document.getElementById('cc').value;		
		$.ajax({
		type: "POST",
		url: "<?php echo base_url(); ?>" + "/Csponsor/send_otp_phone",
		data:{phone:phone,cc:cc},		
		beforeSend: function(){
			$("#phone").css("background","#FFF url(images/LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#otp-message").html(data);
		}
		});
	});
});

</script>

<script>
$(document).ready(function(){
	$("#up_email").click(function(){
		var email= document.getElementById('email').value;
		$.ajax({
		type: "POST",
		url: "<?php echo base_url(); ?>" + "/Csponsor/send_otp_email",
		data:{email:email},	
		beforeSend: function(){
			$("#email").css("background","#FFF url(images/LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#otp-email-status").html(data);
		}
		});
	});
});

</script>
<script>
$(document).ready(function(){
	$("#otp_phone").click(function(){
		var sent_phone_otp= document.getElementById('sent_phone_otp').value;
		$.ajax({
		type: "POST",
		url: "<?php echo base_url(); ?>" + "/Csponsor/verify_phone",
		data:{sent_phone_otp:sent_phone_otp},		
		beforeSend: function(){
			$("#sent_phone_otp").css("background","#FFF url(images/LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#otp-message").html(data);
		}
		});
	});
});

</script>
<script>
$(document).ready(function(){
	$("#otp_email").click(function(){
		var sent_email_otp= document.getElementById('sent_email_otp').value;		
		$.ajax({
		type: "POST",
		url:  "<?php echo base_url(); ?>" + "/Csponsor/verify_email",
		data:{sent_email_otp:sent_email_otp},		
		beforeSend: function(){
			$("#sent_email_otp").css("background","#FFF url(images/LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#otp-email-status").html(data);
		}
		});
	});
});

</script>
<script>
$(document).ready(function(){
	$("#up_pass").click(function(){
		var oldpass= document.getElementById('oldpass').value;
		var newpass= document.getElementById('newpass').value;
		var confpass= document.getElementById('confpass').value;		
		$.ajax({
		type: "POST",
		url:  "<?php echo base_url(); ?>" + "/Csponsor/change_password",
		data:{oldpass:oldpass, newpass:newpass, confpass:confpass},		
		beforeSend: function(){
			$("#confpass").css("background","#FFF url(images/LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#err_pass").html(data);
		}
		});
	});
});

</script>
 <script>
$(document).ready(function (e) {
// Function to preview image after validation
$(function() {
	$("#file").change(function() {
		$("#message").empty(); // To remove the previous error message
		var file = this.files[0];
		var imagefile = file.type;
		var match= ["image/jpeg","image/png","image/jpg"];
		if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
		{
			$('#previewing').attr('src','noimage.png');
			$("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
			return false;
		}
		else
		{
			var reader = new FileReader();
			reader.onload = imageIsLoaded;
			reader.readAsDataURL(this.files[0]);
			
									
				$.ajax({
				url: "<?php echo base_url(); ?>" + "/Csponsor/update_profile_image", 
				type: "POST",             // Type of request to be send, called as method
				data: {file: file}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
				contentType: false,       // The content type used when sending data to the server.
				cache: false,             // To unable request pages to be cached
				processData:false,        // To send DOMDocument or non processed data file it is set to false
				success: function(data)   // A function to be called if request succeeds
				{
				$('#loading').hide();
				$("#message").html(data);
				}
				});

		}
	});
});
function imageIsLoaded(e) {
	$("#file").css("color","green");
	$('#image_preview').css("display", "block");
	$('#previewing').attr('src', e.target.result);
	$('#previewing').attr('width', '250px');
	$('#previewing').attr('height', '230px');
};
});
</script>

<?php
$logoUrl=@get_headers(base_url('/Assets/images/sp/profile/'.$myData[0]->sp_img_path));
if($logoUrl[0] !='HTTP/1.1 404 Not Found' && !strpos($logoUrl[0],'404') && $myData[0]->sp_img_path!='' && !strpos($myData[0]->sp_img_path,'uploaded_logo')){
	$logoexist=base_url('/Assets/images/sp/profile/'.$myData[0]->sp_img_path);
}else{
	$logoexist=base_url('/Assets/images/sp/profile/newlogo.png');;
}
?>
	<div class="panel panel-violet">
		<div class="panel-heading">
		<h2 class="panel-title"><strong>Profile</strong></h2>
		</div>
		<div class="panel-body">
			<div class="col-md-12">	
			<div class="col-md-5">
				<div id="image_preview">
					<img id="previewing" class="image_preview1"
					src="<?php echo $logoexist;?>" style="max-height:120px; max-width:210.5px;" class="img-responsive pull-left" />				
				</div>			 
			<div class="col-xs-6">
			<button class="btn btn-default btn-xs" name="up_logo" id="up_logo">Change Logo</button>	
			<br/><small>Max Image Size 100KB, image Width X Height should be less than 1024 X 900 pixels.</small>
			</div><span style='color:red;' ><?php echo $myData[0]->fileerror; ?></span>	
<?php $attributes1 = array('id' => 'profimg');
	echo form_open_multipart('Csponsor/update_profile_image', $attributes1); ?>  			
			<input type="hidden" name="proimg" id='proimg' value="<?php echo $logoexist;?>">
			<div id="selectImage1">	
			<div id="selectImage">					
				<input type="file" name="file" id="file" />
			</div>
				<span style='color:red;' ><?php echo $myData[0]->fileerror; ?></span>	
				<input type="submit" value="Update" class="btn btn-success btn-xs" />
			</div>
			</div>
	</form>
			<div class="col-md-7" style="padding-left:20px;">			
			<h3 class="text-capitalize">
				<?=$myData[0]->sp_company; ?></h3>			 	
			<br>
			</div>
			
			</div>
		
		
			<table class="table table-hover">
			
			<tbody>
			<tr>
				<td style="font-weight:bold;">
					Mobile Number
				</td>				
				<td>
					<?=$myData[0]->sp_phone; ?> &nbsp;<button class="btn btn-default btn-xs" name="p" id="p">Change</button>
					<div id="otp-message"></div>
				</td>
			</tr>
			<tr style="display: table-row;" id="phone_edit">
				<td style="font-weight:bold;">					
				</td>
				<td>
					<div class="row">							
						<div class="col-md-3">
							<select class="form-control" id="cc" name="cc" > 
								<?php foreach ($calling_code as $key => $value): ?>						 	
								   <option value="<?php echo '+'.$calling_code[$key]; ?>" ><?php echo '+'.$calling_code[$key]; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="col-md-5">
					<input name="phone" id="phone" class="form-control" value="<?=$myData[0]->sp_phone; ?>" onkeypress="return isNumberKey(event)" type="text">
						</div>
					
						<div class="col-md-4">
							<button class="btn btn-warning btn-sm" name="up_phone" id="up_phone" onclick="">Send OTP</button>
						</div>						
					</div>
					<div class="row text-danger" id="err_phone" align="center"></div>
				</td>
			</tr>
			<tr style="display: none;" id="phone_otp">
				<td style="font-weight:bold;">
					
				</td>
				<td><div id="otp-message"></div>
				<div class="row">							
					<div class="col-md-3">
						<input name="sent_phone_otp" id="sent_phone_otp" placeholder='OTP' class="form-control" value="" type="text">
					</div>
					<div class="col-md-3">
					&nbsp;<button class="btn btn-success btn-xs" name="otp_phone" id="otp_phone">Update</button>
					</div>
				</div>
				</td>
			</tr>
			<tr>
				<td style="font-weight:bold;">
					Landline Number
				</td>				
				<td>
					<?=$myData[0]->sp_landline; ?>
					
				</td>
			</tr>
			<tr>
				<td style="font-weight:bold;">
					Email
				</td>
				<td>
					<?=$myData[0]->sp_email; ?>	&nbsp;<button class="btn btn-default btn-xs" name="e" id="e">Change</button>
					<div id="otp-email-status"></div>				</td>
			</tr>
			<tr style="display: table-row;" id="email_edit">
				<td style="font-weight:bold;">
					
				</td>
				<td>
					<input name="email" id="email" class="form-control" value="<?=$myData[0]->sp_email; ?>" type="email">
					<div class="row text-danger" id="err_email" align="center"></div>
					&nbsp;<button class="btn btn-warning btn-xs" name="up_email" id="up_email">Send Verification Code</button>
				</td>
			</tr>
			<tr style="display: none;" id="email_otp">
				<td style="font-weight:bold;">
					
				</td>
				<td><div id="otp-email-status"></div>
					<input name="sent_email_otp" id="sent_email_otp" placeholder='Verification Code' class="form-control" value="" type="text">
					&nbsp;<button class="btn btn-success btn-xs" name="otp_email" id="otp_email">Update</button>
				</td>
			</tr>
	<tr>
				<td style="font-weight:bold;">
					Website
				</td>
				<td>
					<a href="<?=$myData[0]->sp_website; ?>" target="_blank"><?=$myData[0]->sp_website; ?></a>
				</td>
			</tr>
			<!--<tr>
				<td style="font-weight:bold;">
					Date of Birth (DD/MM/YYYY)
				</td>
				<td><?php
					if($myData[0]->sp_dob!=''){
					$vu1=explode('/',$myData[0]->sp_dob);
					$vu=$vu1[1].'/'.$vu1[0].'/'.$vu1[2];
					echo $vu;
					}
				?></td>
			</tr>
			<tr>
				<td style="font-weight:bold;">
					Gender
				</td>
				<td class="text-capitalize">
				<?=$myData[0]->sp_gender; ?></td>
			</tr>
			<tr>
				<td style="font-weight:bold;">
					Occupation
				</td>
				<td class="text-capitalize">
				<?=$myData[0]->sp_occupation; ?></td>
			</tr>-->
			<tr>
				<td style="font-weight:bold;">
					Default Product Category
				</td>
				<td class="text-capitalize">
					<?php echo @$myData[0]->v_category; ?></td>
			</tr>
			<tr>
				<td style="font-weight:bold;">
					Address
				</td>
				<td class="text-capitalize">
					<?=$myData[0]->sp_address; ?></td>
			</tr>
			<tr>
				<td style="font-weight:bold;">
					City
				</td>
				<td class="text-capitalize">
				<?=$myData[0]->sp_city; ?></td>
			</tr>
			<tr>
				<td style="font-weight:bold;">
					State
				</td>
				<td class="text-capitalize">
				<?=$myData[0]->sp_state; ?></td>
			</tr>
			<tr>
				<td style="font-weight:bold;">
					Country
				</td>
				<td class="text-capitalize">
				<?=$myData[0]->sp_country; ?></td>
			</tr>
			<tr>
				<td style="font-weight:bold;">
					ZIP / PIN
				</td>
				<td class="text-capitalize">
				<?=$myData[0]->pin; ?></td>
			</tr>
			<tr>
				<td style="font-weight:bold;">
					Registration Date
				</td>
				<td class="text-capitalize">
				<?php
					$rd1=explode('/',@$myData[0]->sp_date);
					$rd=@$rd1[1].'/'.@$rd1[0].'/'.@$rd1[2];
					echo @$rd;
				?></td>
			</tr>
			<tr>
				<td style="font-weight:bold;">
					Password
				</td>
				<td class="text-capitalize">
						<button class="btn btn-default btn-xs" name="cp" id="cp">Change Password</button>
				</td>
			</tr>
			<tr style="display: table-row;" id="pass_edit">
				<td style="font-weight:bold;">					
				</td>
				<td>
					<div class="row">							
						<div class="col-md-3">
							<input name="oldpass" id="oldpass" class="form-control" value="" placeholder="Old Password" type="password">
						</div>
						<div class="col-md-3">
							<input name="newpass" id="newpass" class="form-control" value="" placeholder="New Password" type="password">
						</div>
						<div class="col-md-3">
							<input name="confpass" id="confpass" class="form-control"  value="" placeholder="Confirm Password" type="password">
						</div>		
						<div class="col-md-3">
							<button class="btn btn-warning btn-sm" name="up_pass" id="up_pass">Change</button>
						</div>						
					</div>
					<div class="row text-danger" id="err_pass" align="center"></div>
				</td>
			</tr>
			</tbody></table>
<a href="<?php echo site_url("Csponsor/page/edit_profile"); ?>">
<input value="Edit" name="submit" class="btn btn-success" type="submit"></a>
<a href="<?=site_url('Csponsor');?>"><input value="Back" name="cancel" class="btn btn-warning" type="button"></a>
		</div>
	</div>