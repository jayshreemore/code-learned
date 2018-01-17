<?php
include("cookieadminheader.php");
@include 'conn.php';
$msg="";
if(isset($_GET['ecur'])){
$ecur=$_GET['ecur'];	
$cur1=mysql_query("SELECT * FROM `currencies` WHERE `id`=$ecur ");	
$cur=mysql_fetch_array($cur1);
$value=$cur['currency'];

}
if(isset($_POST['ecurrency'])){
	$currency=$_POST['currency'];
	
	$up=mysql_query("UPDATE `currencies` SET `currency`=\"$currency\" WHERE `id`=$ecur ");	
	if($up){ $msg='updated'; header("Location:edit_categories_currencies.php"); }
	
}
if(isset($_GET['ecat'])){
	$ecat=$_GET['ecat'];	
	$cat1=mysql_query("SELECT * FROM `categories` WHERE `id`=$ecat ");	
	$cat=mysql_fetch_array($cat1);
	$value=$cat['category'];

}
if(isset($_POST['ecategory'])){
	$category=$_POST['category'];
	
	
	$up=mysql_query("UPDATE `categories` SET `category`=\"$category\" WHERE `id`=$ecat ");	
	if($up){ $msg='updated'; header("Location:edit_categories_currencies.php"); }

}
if(isset($_GET['pri'])){
	$epri=$_GET['pri'];	
	$pri1=mysql_query("SELECT `sponsor_id`,`priority` FROM `tbl_sponsored` WHERE `id`=$epri ");	
	$pri=mysql_fetch_array($pri1);
	$value=$pri['priority'];
	$spid=$pri['sponsor_id'];

}
if(isset($_POST['epriority'])){
	$priority=$_POST['priority'];
	
	
	$up=mysql_query("UPDATE `tbl_sponsored` SET `priority`=\"$priority\" WHERE `id`=$epri ");	
	if($up){ $msg='updated'; header("Location:sponsored_coupons.php?cpns=$spid"); }

}
?>
<script>

  function valid()  
       {
		  

			regx1=/^[A-z ]+$/;
			regx2=/^[0-9 .]+$/;
			

			var category=document.getElementById('category').value; 
		   if(category == null || category == " ") 
		   {
		    document.getElementById('errorcat').innerHTML='Field cannot be left blank!';
				
				return false;
			}
			
			
			 if(!regx1.test(category))
		   {
				document.getElementById('errorcat').innerHTML='Enter Valid Value';
					return false;
		   }
		   else
			{
				document.getElementById('errorcat').innerHTML="";
			}
	}		
		
</script>
<script>
		function valid1()  
       {
		  

			regx1=/^[A-z ]+$/;
			regx2=/^[0-9 .]+$/;
			
	
			var currency=document.getElementById('currency').value; 
		   if(currency==null || currency==" ") 
		   { 
	   alert('sud');
		    document.getElementById('errorcur').innerHTML='Field cannot be left blank!';
				
				return false;
			}
			
			
			 if(!regx1.test(currency))
		   {
				document.getElementById('errorcur').innerHTML='Enter Valid Value';
					return false;
		   }
		   else
			{
				document.getElementById('errorcur').innerHTML="";
			}
			
	   }

</script>
<script>
		function valid2()  
       {
		  

			regx1=/^[A-z ]+$/;
			regx2=/^[0-9 .]+$/;
			
	
			var priority=document.getElementById('priority').value; 
		   if(priority==null || priority==" ") 
		   { 
	   alert('sud');
		    document.getElementById('errorpri').innerHTML='Field cannot be left blank!';
				
				return false;
			}
			
			
			 if(!regx2.test(priority))
		   {
				document.getElementById('errorpri').innerHTML='Enter Valid Value';
					return false;
		   }
		   else
			{
				document.getElementById('errorpri').innerHTML="";
			}
			
	   }

</script>
<div class="container">
	<div class="Jumbotron" style="padding-top:20px;" >
	<?php if(isset($_GET['ecat'])) { ?>
	<h2>Edit Category</h2>
	
	<form name="ecategory" method="post"  onSubmit="return valid()">
	<div class="form-inline" style="padding-top:20px;">
	<input type="text" class="form-control" name="category" id="category" style="width:250px;" value="<?php echo $value;?>">
	<button  type="submit" name="ecategory" id="ecategory"  class="btn btn-default">SET</button>
	<div  id="errorcat" style="color:#FF0000" align="center"></div>
	</div>
	</form>
	<?php } 
	if(isset($_GET['ecur'])) { ?>
	<h2>Edit Currency</h2>
	
	<form name="ecurrency" method="post"  onSubmit="return valid1()">
	<div class="form-inline" style="padding-top:20px;">
	<input type="text" class="form-control" name="currency" id="currency"  style="width:250px;" value="<?php echo $value;?>">
	<button type="submit" name="ecurrency" id="ecurrency"  class="btn btn-default">SET</button>
	<div  id="errorcur" style="color:#FF0000" align="center"></div>
	</div>
	</form>
	<?php } 
	
		if(isset($_GET['pri'])) { ?>
	<h2>Edit Priority</h2>
	
	<form name="epriority" method="post"  onSubmit="return valid2()">
	<div class="form-inline" style="padding-top:20px;">
	<input type="text" class="form-control" name="priority" id="priority"  style="width:250px;" value="<?php echo $value;?>">
	<button type="submit" name="epriority" id="epriority"  class="btn btn-default">SET</button>
	<div  id="errorpri" style="color:#FF0000" align="center"></div>
	</div>
	</form>
	<?php } ?>
	
	</div>
</div>