<?php 

if(isset($_POST['submit']))
{
  if($_POST['login_option']=='School')
{
header("Location:home_cookieadmin.php");
}
else
{
header("Location:corporate_home_cookieadmin.php");
}
}
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link href="css/bootstrap.css" rel="stylesheet">
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
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
<div class='container-fluid bgcolor'>
		<div class='row'>
			<div class='col-md-4 col-md-offset-4 padtop100'>
				<div class='panel panel-primary'>						
					<div class='panel-body'>										
						<div class='row text-center'>							
							<div class="visible-sm visible-lg visible-md">
								<img src="Images/250_86.png" />
							</div>
							<div class="visible-xs">
								<img src="Images/220_76.png" />
							</div>
						</div>
						<div class='row bg-red text-center title-text'>
							<span class='panel-title color-white'> Cookie Admin Login</span>
						</div>
						<div class='row form-content'>
						<form method='POST' action="">
							<div class='col-md-12'>
							<div class='form-group'>
								<label>Login For
								</label>
										<select name='login_option' id='Login_Option' class='form-control'>
											<option  value="School">School</option>
											<option  value="Organisation">Organisation</option>
											<!--<option value='SocialLogin'>Social Login</option>-->
										</select>
										
							</div>
							</div>
							<div align="center" class='form-group' id='SubmitInput'>
							<input type='submit' name='submit' id='submit' class='btn btn-primary' value='Login' />	
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