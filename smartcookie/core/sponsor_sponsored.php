<?php 
include("cookieadminheader.php");
@include 'conn.php'; 

?>
<!DOCTYPE html><html>
<head>
<title>Sponsors</title>
 <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
</head><body>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function(){
    $('#example').DataTable();
});
</script>
<?php
if(isset($_GET['del'])){
	$sp=$_GET['del'];
	mysql_query(" DELETE FROM `tbl_sponsorer` WHERE `id`= $sp ");
	//mysql_query(" DELETE FROM `tbl_sponsored` WHERE `sponsor_id`= $sp ");
	header("Location:sponsor_sponsored.php");
}

if(isset($_GET['sps'])){
	$sps=$_GET['sps'];	//$tsmart = mysql_connect("Tsmartcookies.db.7121184.hostedresource.com","Tsmartcookies","B@v!2018297");
	$smart = mysql_connect("SmartCookies.db.7121184.hostedresource.com","SmartCookies","b@V!2017297",true);
	if($_SERVER['HTTP_HOST']=='tsmartcookies.bpsi.us'){		
		$q=mysql_query("select * from `tbl_sponsorer` WHERE `id`='$sps'",$con)or die(mysql_error());	
		while($a=mysql_fetch_array($q)){		
			$p=mysql_query("insert into tbl_sponsorer (sp_name,sp_address,sp_city,sp_dob,sp_gender,sp_country,sp_state,sp_email,sp_phone,sp_password,sp_date,sp_occupation,sp_company,sp_website,sp_img_path,school_id,register_throught,lat,lon,pin,sales_person_id,expiry_date,amount,v_status,v_likes,v_category,temp_phone,otp_phone,temp_email,otp_email,sp_landline) values('".$a['sp_name']."', '".$a['sp_address']."','".$a['sp_city']."','".$a['sp_dob']."','".$a['sp_gender']."','".$a['sp_country']."','".$a['sp_state']."','".$a['sp_email']."','".$a['sp_phone']."','".$a['sp_password']."','".$a['sp_date']."','".$a['sp_occupation']."','".$a['sp_company']."','".$a['sp_website']."','".$a['sp_img_path']."','".$a['school_id']."','".$a['register_throught']."','".$a['lat']."','".$a['lon']."','".$a['pin']."','".$a['sales_person_id']."','".$a['expiry_date']."','".$a['amount']."','".$a['v_status']."','".$a['v_likes']."','".$a['v_category']."','".$a['temp_phone']."','".$a['otp_phone']."','".$a['temp_email']."','".$a['otp_email']."','".$a['sp_landline']."')",$smart)or die(mysql_error());
		} 

		
	}else{				mysql_select_db('SmartCookies', $smart);
		$q=mysql_query("select * from `tbl_sponsorer` WHERE `id`='$sps'",$smart)or die(mysql_error());	
		while($a=mysql_fetch_array($q)){		
			$p=mysql_query("insert into tbl_sponsorer (sp_name,sp_address,sp_city,sp_dob,sp_gender,sp_country,sp_state,sp_email,sp_phone,sp_password,sp_date,sp_occupation,sp_company,sp_website,sp_img_path,school_id,register_throught,lat,lon,pin,sales_person_id,expiry_date,amount,v_status,v_likes,v_category,temp_phone,otp_phone,temp_email,otp_email,sp_landline) values('".$a['sp_name']."', '".$a['sp_address']."','".$a['sp_city']."','".$a['sp_dob']."','".$a['sp_gender']."','".$a['sp_country']."','".$a['sp_state']."','".$a['sp_email']."','".$a['sp_phone']."','".$a['sp_password']."','".$a['sp_date']."','".$a['sp_occupation']."','".$a['sp_company']."','".$a['sp_website']."','".$a['sp_img_path']."','".$a['school_id']."','".$a['register_throught']."','".$a['lat']."','".$a['lon']."','".$a['pin']."','".$a['sales_person_id']."','".$a['expiry_date']."','".$a['amount']."','".$a['v_status']."','".$a['v_likes']."','".$a['v_category']."','".$a['temp_phone']."','".$a['otp_phone']."','".$a['temp_email']."','".$a['otp_email']."','".$a['sp_landline']."')",$con)or die(mysql_error());
		} 		
	}	
		if($p){
			echo "<script>alert('Succefully Copied')</script>";
		}else{
			echo "<script>alert('Error Occured')</script>";
		}
	
	

	//mysql_query(" DELETE FROM `tbl_sponsored` WHERE `sponsor_id`= $sp ");
	header("Location:sponsor_sponsored.php");
	
}

$result = mysql_query ("SELECT * FROM tbl_sponsorer ORDER BY sp_name ASC");

?>
<script>
function confirmation(xxx) {

    var answer = confirm("Are you sure you want to delete?")
    if (answer){
        
        window.location = "sponsor_sponsored.php?del="+xxx;
    }
    else{
       
    }
}
</script>
<div class="" style="background-color:#fff;">
<div class="panel panel-default" style="min-height:100%; overflow:hidden;">
  <!-- Default panel contents -->
  <div class="panel-heading"><h2 style="text-decoration: underline;" align="center">Sponsors List With Location And Coupons</h2></div>

<table class="table" id='example'>
<thead>
<tr><th>Sr.No.</th><th>Company</th><th>Address</th><th>City</th><th>State</th><th>Country</th><th>Phone</th><th>Email ID</th><th>Website</th><th>Copy</th><th>Location</th><th>Coupons</th><th>Delete</th></tr></thead><tbody>
<?php
//$start=$start_from+1;
$start=1;
while ($row = mysql_fetch_assoc($result)) {
	$sp_id=$row['id'];
	$get_cpn = mysql_query("SELECT * FROM tbl_sponsored WHERE `sponsor_id` = $sp_id ");
	$num_rows = mysql_num_rows($get_cpn);
	$a=$row['lat'];
	$b=$row['lon'];
?>
<tr align=”center”>
<td><?php echo $start; ?></td>
<td><?php echo $sp=$row['sp_company']; ?></td>
<td><?php echo $row['sp_address']; ?></td>
<td><?php echo $row['sp_city']; ?></td>
<td><?php echo $row['sp_state']; ?></td>
<td><?php echo $row['sp_country']; ?></td>
<td><?php echo $row['sp_phone']; ?></td>
<td><?php echo $row['sp_email']; ?></td>
<td><?php echo $row['sp_website']; ?></td>
<td><a href="sponsor_sponsored.php?sps=<?php echo  $sp_id; ?>"><?php if($_SERVER['HTTP_HOST']=='tsmartcookies.bpsi.us'){ echo "Copy2Smart"; } else{ echo "Copy2TSmart";}?> </td>
<td><a href="sponsor_location.php?a=<?php echo $a; ?>&b=<?php echo $b; ?>&sp=<?php echo $sp; ?>"><span class=' glyphicon glyphicon-map-marker'></span></a></td>
<?php if($num_rows >=1 ){ ?>
<td style=" float:left; "><a href="sponsored_coupons.php?cpns=<?php echo $sp_id; ?>"><span class='glyphicon glyphicon-tags'></span><span style="link-style:none; color:#000; font-size:20px; float:right;"><?php echo $num_rows;?></span></a></td>
<?php } else{ ?>
<td style=" float:left; "><span class='glyphicon glyphicon-tags'></span><span style="link-style:none; color:#000; font-size:20px; float:right;"><?php echo $num_rows;?></span></td>
<?php } ?>
<td >
<a href="#" ><button class='glyphicon glyphicon-trash' alt="Location" style="width:30px;height:42px;border:0" onClick="confirmation(<?php echo  $sp_id; ?>)"></button></a>
</td>
</tr>
<?php
$start++;
};
?></tbody>
</table>


</div>

</div>
</body>
</html>
