<?php
include 'coupon.inc.php';
include 'lib/phpqrcode/qrlib.php'; 
// phpqrcode.php 
 
$user_id= $_SESSION['id'];
$entity = $_SESSION['entity'];

		if($entity==3){
			$u=mysql_query("SELECT std_name FROM tbl_student WHERE `id`=$user_id");
			$un= mysql_fetch_array($u);
			$uname=$un['std_name'];
		}elseif($entity==2){
			$u=mysql_query("SELECT t_complete_name FROM tbl_teacher WHERE `id`=$user_id");
			$un= mysql_fetch_array($u);
			$uname=$un['t_complete_name'];
		} 
$get_selected_vendor_coupons=mysql_query("SELECT * FROM tbl_selected_vendor_coupons svc 
													join tbl_sponsorer s on svc.sponsor_id=s.id 
													join tbl_sponsored spd on svc.coupon_id=spd.id WHERE svc.`entity_id`=$entity  and 
`user_id`=$user_id and `used_flag`=\"unused\"");
$num_rows=@mysql_num_rows($get_selected_vendor_coupons);

if(isset($_GET['sa'])){
	$cpn=$_GET['sa'];
	$q=mysql_query("UPDATE `tbl_selected_vendor_coupons` SET `used_flag`='used', `timestamp`=CURRENT_TIMESTAMP WHERE `id`=$cpn and `user_id`=$user_id ");
	$r=mysql_affected_rows();
	if($r>0){
			echo 'success';
	}
	header("Location:view_print_coupons.php");
}



if($num_rows>=1){
	
?>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="js/html2canvas.js"></script>
<script type="text/javascript" src="js/jquery.plugin.html2canvas.js"></script>




<script>
function capture() {
    $('#target').html2canvas({
        onrendered: function (canvas) {
            //Set hidden field's value to image data (base-64 string)
            $('#img_val').val(canvas.toDataURL("image/png"));
            //Submit the form manually
            document.getElementById("myForm").submit();
        }
    });
}
</script>
<script>
function really(xxx){
	
	var y = confirm("You must be present at sponsor's place to use this coupon now.");
	if(y){
	window.location="view_print_coupons.php?sa="+xxx;
	}
}
</script>

<div class="middle_container" >
      <div class="container" > 
			<input type="submit" class="btn btn-primary" style="margin-bottom:20px;" value="Email Coupons" onclick="capture();" />
			<form method="POST" enctype="multipart/form-data" action="save.php" id="myForm">
			<input type="hidden" name="img_val" id="img_val" value="" />
			</form>
       <div class="row" id="target"> 
<?php
while($svc= mysql_fetch_array($get_selected_vendor_coupons)){
	
	$sid=$svc['id'];
	$cid=$svc['coupon_id'];
	$ppp=$svc['for_points'];
	$time=$svc['timestamp'];
	$ts=explode(' ',$time);
	$date=$ts[0];
	$tm=$ts[1];
	$code=$svc['code'];
	$used_flag=$svc['used_flag'];
	$sponsored1=mysql_query("SELECT * FROM `tbl_sponsored` WHERE `id`=$cid");	
	$sponsored=mysql_fetch_array($sponsored1);	
	$sp_id=$sponsored['sponsor_id'];
	$product=$sponsored['Sponser_product'];
	$pro_img=$sponsored['product_image'];
	$discount=$sponsored['discount'];
	$buy=$sponsored['buy'];
	$buy_get=$sponsored['get'];
	$saving=$sponsored['saving'];
	$valid_until=$sponsored['valid_until'];
	$sp_cat=$sponsored['category'];
	$offerdes=$sponsored['offer_description'];
$sp_cur=$sponsored['currency'];
$cr=mysql_query("SELECT `currency` FROM `currencies` WHERE `id`='$sp_cur'");
	$cur1=mysql_fetch_array($cr);
	$cur=$cur1['currency'];
	$sp=mysql_query("SELECT * FROM tbl_sponsorer WHERE `id`='$sp_id' ")or die(mysql_query());
	$s=mysql_fetch_array($sp);
	
	$logo=$s['sp_img_path'];
	$company=$s['sp_company'];

	$address=$s['sp_address'];


	if($company!='' ){	

?>

<style>
@font-face { font-family: free3of9; src: url(free3of9.ttf) format("truetype"); } 

.bgcode {
font-family: free3of9;
}
</style>

	<div class="col-xs-12 col-sm-4 col-md-3" >
	  <div class="coup_box2" style="">
	  <?php if(file_exists($logo)){ ?><img src="<?php echo $logo;?>" class="sp_logo img-responsive" style="height:83px;"/><?php } 
		else { ?><img src="image/newlogo1.png" class="sp_logo img-responsive" style="height:83px;"/><?php }  ?>
	  <?php /* if(file_exists($pro_img)){ ?><img src="<?php echo $pro_img;?>" class="sp_prod img-responsive"  style="height:140px;"/><?php }  
	   else { ?><img src="image/imgnotavl.png" class="sp_prod img-responsive"  style="height:140px;"/><?php }*/ ?>
	  <div class="coup_txtbox" style="height:350px;" >
	  <!--
	  <p class="couptxt1"><?php if($company!=""){  echo  "<font color=\"black\">".strtoupper($company)."</font>"; }else{ echo "<font color=\"red\"> NA </font>"; } ?></p>
	  <p class="couptxt1"><?php echo strtoupper($product);?></p>
		   <p><span class="couptxt2"><?php if($discount!=0 or $discount!=0){ 
												echo $discount."% Off"; 
											} 
											if($buy!=0 and $buy_get!=0){ 
												if($discount!=0){ 
													echo ' Or ';
												} 
												echo 'Buy '.$buy.' Get '.$buy_get.' Free'; 
											} 
									?></span> <span class="couptxt3">(On <?php echo $ppp; ?> Points)</span></p>
		   <?php if($saving!=0){ ?><p class="couptxt4">SAVE <?php echo $saving; ?>/-</p> <?php }else{?>
			<p class="couptxt4" style="visibility:hidden;">SAVE <?php echo $saving; ?>/-</p><?php   } ?>
			<?php if($offerdes!=null){ ?><p><?php echo $offerdes; ?></p> <?php }else{ ?>
			<p style="visibility:hidden; padding:0px 5px 5px 5px;" ><?php echo $offerdes; ?></p><?php   } ?>
			-->
			<div class="box_content" style="text-align:left">
			<p align="left" style="padding:0px 5px 5px 5px; ">
			<?php if($company!=""){  echo  "<font color=\"black\">".strtoupper($company)."</font><br/>"; }else{ echo "<font color=\"red\"> NA </font><br/>";} ?>
			<?php echo strtoupper($product)."<br/>";?>
			<strong>
			<?php if($discount!=0 or $discount!=0){ 
												echo $discount."% Off"; 
											} 
											if($buy!=0 and $buy_get!=0){ 
												if($discount!=0){ 
													echo ' Or ';
												} 
												echo 'Buy '.$buy.' Get '.$buy_get.' Free'; 
											} 
			?><br/>
			<?php if($saving!=0){ echo "Save ".$cur.' '.$saving."</br>";}?></strong>
			<?php if($offerdes!=""){ echo "Offer Description: ".$offerdes."</br>";}?>
			<table><tr><td>Product ID:<?php echo $cid;?><br/>Code#:<br/><b><?php echo $code; ?></b></td><td><?php	
				$qrfile=$code.'.png';
				$dir='Images/coupon_qr/';
				QRcode::png($code, $dir.$qrfile); 
				echo '<img src='.$dir.$qrfile.' />'; ?></td></tr></table>				
		<!--	<iframe src="html/BCGcode39.php?id=<?php echo $code; ?>" id="coupons" frameBorder="0" style="width:100%;height:80px;"/></iframe>-->
	<!--	<img src="barcode_coupon.php?code=<?php echo '*'.$code.'*';?>" width="180px">	-->
			<span style="font-size:11px">
			Issued To: <?php echo $uname;?><br/>
			On: <?php echo $date;?></br>
			Time: <?php echo $tm;?></br>
			Valid Until: <?php echo $valid_until;?></br>
			Address:<?php echo $address;?></span></p>	
			</div>
		  <div class="clearfix" ></div>
		  <div class="btn_use">
		  <button name="self_accept" id="self_accept" onClick="really(<?php echo $sid; ?>)" class="btn btn-primary visible-xs visible-sm hidden-print" style="margin-bottom: 0px;">Use Now</button>
		  </div>
		</div>
		
	  </div>
	</div>

	<?php 

}  } ?>
</div></div></div>
<?php }else{ ?> <div class="alert alert-danger" role="alert" align="center">
	<span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"> &nbsp;&nbsp;&nbsp;&nbsp;
	</span>You haven't selected coupons yet.</div><?php header( " url=coupons.php" ); } ?>
       
