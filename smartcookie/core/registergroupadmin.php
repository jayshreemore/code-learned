<html>
<head>
    <meta charset="utf-8">
    <title>Smart Cookies</title>
<!--    <link href='css/datepicker.min.css' rel='stylesheet' type='text/css'>-->
     <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/city_state.js" type="text/javascript"></script>
<!--    <script src='js/bootstrap-datepicker.min.js' type='text/javascript'></script>-->
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
    <!-- Load jQuery and bootstrap datepicker scripts -->
     <script src="js/jquery-1.11.1.min.js"></script>
     <script src="js/bootstrap-datepicker.min.js"></script>
    
    <style>
        textarea {
            resize: none;
        }
    </style>



   


</head>
<script>
function ValidateForm()
{
	event.preventDefault();
	//alert("hi");
	var group_name = document.getElementById("group_name").value;
	var group_id = document.getElementById("group_id").value;
	var email_id = document.getElementById("email_id").value;
	var mobile_no = document.getElementById("mobile_no").value;
	var address = document.getElementById("address").value;
	//alert(address);
	
	if(group_name == '')
	{
		//alert("Please enter group name");
		document.getElementById('errorgroupname').innerHTML="*Please enter a group name*";
		return false;
	}
	else if (!group_name.match(/^[a-zA-Z ]+[a-zA-Z]*$/)) 
    {
        alert('Only characters are allowed in Group Name');
        return false;
    }
   if(group_id == '')
	{
		alert("Please Enter Group ID");
		return false;
	}
	else if (!group_id.match(/^[a-zA-Z0-9]+$/)) 
    {
        alert('Only charactors or numbers are allowed in Group Id');
        return false;
    }
	
	if(email_id == '')
	{
		alert("Please enter Email Id ");
		
		return false;
	}
	else if (!email_id.match(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/))
	{
		alert('Please enter a valid email address');
		
		return false;
	}
	if(mobile_no == '')
	{
		alert("Please enter mobile number ");
		return false;
	}
	else if (!mobile_no.match(/^([0|\+[0-9]{1,5})?([7-9][0-9]{9})$/))
	{
		alert('Please enter a valid mobile number');
		return false;
	}
	if(address == '')
	{
		alert("Please enter address ");
		return false;
	}
	else if (!address.match(/^[`~.<>;':"\/\[\]\|{}=_+-]/))
	{
		alert("Please enter address in proper format");
		return false;
	}
}
</script>

<?php
$report = "";
include("cookieadminheader.php");
if (isset($_POST['submit'])) {
    
    $group_name = trim($_POST['group_name']);
    $group_id = trim($_POST['group_id']);
    $email_id = trim($_POST['email_id']);
    $mobile_no = trim($_POST['mobile_no']);
    $address = $_POST['address'];
    
    $counts = 0;
	
	
} 
?>

<body>
<div id="head"></div>
<div id="login">

    <form action="" method="post">
        <div class='container' style="padding-top:20px;">
            <div class='panel panel-primary dialog-panel'
                 style="background-color:radial-gradient(ellipse at center center , #E5E5E5 0%, #FFF 100%) repeat scroll 0% 0% transparent;">
                <div style="color:green;font-size:20px;font-weight:bold;margin-top:10px;background-color:radial-gradient(ellipse at center center , #E5E5E5 0%, #FFF 100%) repeat scroll 0% 0% transparent;"
                     align="center"> <?php echo $report; ?></div>
                <div class='panel-heading' style="background-color:radial-gradient(ellipse at center center , #E5E5E5 0%, #FFF 100%) repeat scroll 0% 0% transparent;">
                    <h3 align="center">Register</h3>
                    


                </div>
                <div class='panel-body' >
                    <form class='form-horizontal' role='form' method="POST">
                        


                        <div class="row form-group" >
                            <label class='control-label col-md-3 col-md-offset-1'> Group Name <font color="red">*</font></label>
                            <div id="catList"></div>
							
                            <div class='col-md-3'  style="color:#FF0000" align="center">
                                <div class='form-group internal '>
                                    <input class='form-control' id='group_name' name="group_name"
                                           placeholder='Enter Group Name' type='text'
                                           value="<?php if (isset($_POST['group_name'])) {
                                               echo $_POST['group_name'];
                                           } ?>">
										   <span  id="errorgroupname" style='margin-left:10%;'></span>
                                </div>
                            </div>

                         

                            <div class='col-md-3'></div>
                            <div class='col-md-3 ' id="errorname" style="color:#FF0000" align="center">
							
							</div>
                        </div>
                        

                        
						<div class='row form-group'>
                            <label class='control-label col-md-3 col-md-offset-1'>Group ID <font color="red">*</font></label>
                            <div class='col-md-3 form-group internal'>
                                <input class='form-control' id='group_id' name="group_id" placeholder='Enter Group ID'
                                       type='text' 
									   value="<?php if (isset($_POST['group_id'])) {
                                           echo $_POST['group_id'];
                                       } ?>">
                            </div>

                            <div class='col-md-3 indent-small' id="errorphone" style="color:#FF0000"></div>

                        </div>

                       
						<div class="row form-group">
                            <label class='control-label col-md-3 col-md-offset-1'>Email ID <font color="red">*</font></label>
                            <div id="catList"></div>

                            <div class='col-md-3 form-group internal'>
                                
                                    <input class='form-control' id='email_id' name="email_id"
                                           placeholder='Enter Email' type='text'
                                           value="<?php if (isset($_POST['email_id'])) {
                                               echo $_POST['email_id'];
                                           } ?>">
                               
                            </div>

                         

                            <div class='col-md-3'></div>
                            <div class='col-md-3 ' id="errorname" style="color:#FF0000" align="center"></div>
                        </div>
						
                        <div class='row form-group'>
                            <label class='control-label col-md-3 col-md-offset-1'>Mobile No.<font color="red">*</font></label>
                            <div class='col-md-3 form-group internal'>
                                <input class='form-control' id='mobile_no' name="mobile_no" placeholder='Enter mobile no' type='text'
                                       value="<?php if (isset($_POST['mobile_no'])) {
                                           echo $_POST['mobile_no'];
                                       } ?>">
                            </div>

                            <div class='col-md-3 indent-small' id="errorphone" style="color:#FF0000"></div>

                        </div>
                        <div class="row form-group">
                            <label class='control-label col-md-3 col-md-offset-1'>Address<font color="red">*</font></label>
                            <div class='col-md-3'>
                               <textarea class = 'form-control' id='address' name='address' placeholder='Enter address'type='text' rows='3' value="<?php if (isset($_POST['address'])) {
                                           echo $_POST['address'];
                                       } ?>" ></textarea>
                            </div>
                            <div class='col-md-2 indent-small' id='erroraddress' style="color:#FF0000"></div>
                        </div>




                        <div class='form-group row'>
                            <div class='col-md-2 col-md-offset-3' style= "margin-top:2%; margin-left:32%;">
                                <input class='btn-lg btn-primary' type='submit'  value="Submit" name="submit" onclick ="ValidateForm()"/>
                            </div>
                            <div class='col-md-1' style= "margin-top:2%;">
                                <a href="addschool.php">
                                    <button class='btn-lg btn-danger' type='Reset'>Reset</button>
                                </a>
                            </div>
                        </div>

                    </form>
                </div>
			</div>
		</div>
</body>
</html> 