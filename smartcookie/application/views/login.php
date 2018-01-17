<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link href="<?php echo base_url();?>Assets/vendors/bootstrap/css/bootstrap.css" rel="stylesheet">
	<script src="<?php echo base_url();?>Assets/js/jquery-1.11.1.min.js"></script>
	<script src="<?php echo base_url();?>Assets/vendors/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<style>
body{
	background-color:#cdcdcd;
}
.padtop100{
	padding-top:100px;
}
.padtop10{
	padding-top:10px;	
}
.bg-red{
	background-color:#F0483E;
}
.red{
	color:#f00;
}
.color-white{
	color:white;
}
.panel{
	border-radius:10px;	
	box-shadow: 10px 10px 5px #888888;
}
.title-text{
	padding-top:10px;
	padding-bottom:10px;	
}
.form-content{
	padding-top:10px;
}
.no-top-padding{
	padding-top:0px;
}
</style>
<script>
$(document).ready(function(){
	//EmailInput
	//NumberInput
	//OrganisationInput
	//PhoneInput
	//SocialLogin
	//PasswordInput
	//SubmitInput
	//ForgotPassord

	
		var user='<?php echo @$entity; ?>';

	$("#OptEmailID").hide();
	$("#OptEmployeeID").hide();
	$("#OptPhoneNumber").hide();
	
	switch(user){
		case 'student':
	$("#OptEmailID").show();
	$("#OptEmployeeID").show();
	$("#OptPhoneNumber").show();		
			break;
			case 'employee':
	$("#OptEmailID").show();
	$("#OptEmployeeID").show();
	$("#OptPhoneNumber").show();		
			break;		
		case 'sponsor':
	$("#OptEmailID").show();
	$("#OptEmployeeID").hide();
	$("#OptPhoneNumber").show();			
			break;	
		case 'salesperson':
	$("#OptEmailID").show();
	$("#OptEmployeeID").hide();
	$("#OptPhoneNumber").show();			
			break;	
		
		default:
	$("#OptEmailID").hide();
	$("#OptEmployeeID").hide();
	$("#OptPhoneNumber").hide();
			break;
	}
	
 	$("#EmailInput").hide();
	$("#NumberInput").hide();
	$("#OrganisationInput").hide();
	$("#PhoneInput").hide();
	$("#SocialLogin").hide();
	
	$("#PasswordInput").hide();
	$("#SubmitInput").hide();
	$("#ForgotPassord").hide(); 
	

	
	function loginHideShow(LoginOption){
				switch(LoginOption){
			case 'SocialLogin':	
					$("#EmailInput").hide();
					$("#NumberInput").hide();
					$("#OrganisationInput").hide();
					$("#PhoneInput").hide();
					$("#SocialLogin").show();					
					$("#PasswordInput").hide();
					$("#SubmitInput").hide();
					$("#ForgotPassord").hide();		
					$("#MemberID").hide();
					$("#PasswordInput").removeClass("padtop10");
				break;
			case 'EmailID':	
					$("#EmailInput").show();
					$("#NumberInput").hide();
					
						var user='<?php echo @$entity; ?>';
						switch(user){
							case 'student':
						$("#OrganisationInput").show();
								break;
							default:
						$("#OrganisationInput").hide();
								break;
						}	
					
					$("#PhoneInput").hide();
					$("#SocialLogin").hide();					
					$("#PasswordInput").show();
					$("#SubmitInput").show();
					$("#ForgotPassord").show();	
					$("#MemberID").hide();
					$("#PasswordInput").removeClass("padtop10");
				break;	
			case 'EmployeeID':	
					$("#EmailInput").hide();
					$("#NumberInput").show();
					$("#OrganisationInput").show();
					$("#PhoneInput").hide();
					$("#SocialLogin").hide();					
					$("#PasswordInput").show();
					$("#SubmitInput").show();
					$("#ForgotPassord").show();	
					$("#MemberID").hide();
					$("#PasswordInput").removeClass("padtop10");
				break;			
			case 'PhoneNumber':	
					$("#EmailInput").hide();
					$("#NumberInput").hide();
					$("#OrganisationInput").hide();
					$("#PhoneInput").show();
					$("#SocialLogin").hide();					
					$("#PasswordInput").show();
					$("#SubmitInput").show();
					$("#ForgotPassord").show();
					$("#MemberID").hide();
					$("#PasswordInput").addClass("padtop10");
						
				break;	
			case 'memberId':	
					$("#EmailInput").hide();
					$("#NumberInput").hide();
					$("#OrganisationInput").hide();
					$("#PhoneInput").hide();
					$("#SocialLogin").hide();					
					$("#PasswordInput").show();
					$("#SubmitInput").show();
					$("#ForgotPassord").show();
					$("#MemberID").show();
					
					$("#PasswordInput").addClass("padtop10");
						
				break;					
		}
	}
	
	var LoginOption=$("#LoginOption").val();
	loginHideShow(LoginOption);	
	
	$("#LoginOption").change(function(){
		var LoginOption=$("#LoginOption").val();
		loginHideShow(LoginOption);
	});	
	
		getLocation();
});
</script>
<script>
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
function showPosition(position) {
    $("#lat").val(position.coords.latitude);
    $("#lon").val(position.coords.longitude);
}
</script>
	<div class='container-fluid bgcolor'>
		<div class='row'>
			<div class='col-md-4 col-md-offset-4 padtop100'>
				<div class='panel panel-primary'>						
					<div class='panel-body'>										
						<div class='row text-center'>							
							<div class="visible-sm visible-lg visible-md">
								<img src="<?php echo base_url();?>Assets/images/logo/250_86.png" />
							</div>
							<div class="visible-xs">
								<img src="<?php echo base_url();?>Assets/images/logo/220_76.png" />
							</div>
						</div>
						<div class='row bg-red text-center title-text'>
							<span class='panel-title color-white'><?php echo ucfirst(@$entity); ?> Login</span>
						</div>
						<div class='row form-content'>						
						<?php echo form_open('Clogin/login_validation');?>
							<div class='col-md-12'>
							<div class='form-group'>
								<label for='LoginOption' >Login With</label>
										<select name='LoginOption' id='LoginOption' class='form-control'>
											<option id='OptEmailID' value='EmailID' <?php if(@$LoginOption=='EmailID'){ echo 'selected';} ?>>Email ID</option>
											<option id='OptEmployeeID' value='EmployeeID' <?php if(@$LoginOption=='EmployeeID'){ echo 'selected';} ?>>PRN / EmployeeID</option>
											<option id='OptPhoneNumber' value='PhoneNumber' <?php if(@$LoginOption=='PhoneNumber'){ echo 'selected';} ?>>Phone Number</option>
											<option id='OptPhoneNumber' value='memberId' <?php if(@$LoginOption=='memberId'){ echo 'selected';} ?>>Member Id</option>
											<!--<option value='SocialLogin' <?php if(@$LoginOption=='SocialLogin'){ echo 'selected';} ?>>Social Login</option>-->
										</select>
								
							</div>
							<div class='form-group' id='EmailInput'>								
										<input type='text' name='EmailID'  id='EmailID' class='form-control' value='<?php echo @$EmailID; ?>' placeholder='Email ID'/>								
							</div>
							
							<div class='form-group' id='OrganisationInput'>
										<input type='text' name='OrganizationID' id='OrganizationID' class='form-control' value='<?php echo @$OrganizationID; ?>' placeholder='Institute ID / Organization ID'/>	
							</div>
							<div class='form-group' id='NumberInput'>
										<input type='text' name='EmployeeID' id='EmployeeID' class='form-control' value='<?php echo @$EmployeeID; ?>' placeholder='PRN / EmployeeID'/>	
							</div>
							<div class='form-group' id='NumberInput'>
										<input type='text' name='MemberID' id='MemberID' class='form-control' value='<?php echo @$MemberID; ?>' placeholder='MemberID'/>	
							</div>
                            
							</div>
							<div class='form-group' id='PhoneInput'>								
								<div class='col-md-3'>									
										<select name='CountryCode' id='CountryCode' class='form-control'style=" width:103%">
												<option value='91' <?php if(@$CountryCode==91){ echo 'selected';} ?>>+91</option>
												<option value='1' <?php if(@$CountryCode=='1'){ echo 'selected';} ?>>+1</option>
										</select>									
								</div>
								<div class='col-md-9' style="width:75%">
										<input type='text' name='PhoneNumber' class='form-control' value='<?php echo @$PhoneNumber; ?>' placeholder='Phone Number'/>	
								</div>									
							</div>							
							<div  class='col-md-12'>
							<div class='form-group' id='SocialLogin'>
										Facebook<br/>
										Twitter<br/>
										LinkedIn<br/>
										Google<br/>										
							</div>
							<div class='form-group' id='PasswordInput'>
										<input type='password' name='Password' id='Password' class='form-control' value='<?php echo @$Password; ?>' placeholder='Password'/>	
							</div>
							<div class='form-group' id='Report'>
									<?php echo @$report; ?>	
							</div>
							<div class='form-group' id='SubmitInput'>
								<input type='hidden' name='entity' id='entity' value='<?php echo @$entity;?>'/>	
							
				<input type='submit' name='submit' id='submit' class='btn btn-primary' value='Login' />					<input type='hidden' name='lat' id='lat' value='<?php echo @$lat;?>'/>					<input type='hidden' name='lon' id='lon' value='<?php echo @$lon;?>'/>
							</div>
							<div class='form-group' id='ForgotPassord'>
									<!--<a id="link-forgot-passwd" href="forgetpassword.php">Forgot password?</a>-->
							</div>
							</div>
							</form>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>