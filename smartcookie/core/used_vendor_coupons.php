<?php //include_once("header.php");


include 'coupon.inc.php';
if(!isset($_SESSION['id'])){
	header('Location:login.php');	
}

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
$get_selected_vendor_coupons=mysql_query("SELECT * FROM tbl_selected_vendor_coupons WHERE `entity_id`=$entity  and 
`user_id`=$user_id and `used_flag`=\"used\"");
$num_rows=mysql_num_rows($get_selected_vendor_coupons);
if($num_rows>=1){
	
?>

<div class="middle_container" id="divimage">
      <div class="container" > 
		
       <div class="row" > 
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

	
	$sp=@mysql_query("SELECT * FROM tbl_sponsorer WHERE `id`=$sp_id");
	$s=@mysql_fetch_array($sp);

	$logo=@$s['sp_img_path'];
	$company=@$s['sp_company'];
	$address=@$s['sp_address'];


?>
		<div class="col-xs-12 col-sm-4 col-md-3">
	  <div class="coup_box2">
	  <?php if(file_exists($logo)){ ?><img src="<?php echo $logo;?>" class="sp_logo img-responsive" style="height:83px;"/><?php } 
		else { ?><img src="image/newlogo1.png" class="sp_logo img-responsive" style="height:83px;"/><?php }  ?>
	  <?php if(file_exists($pro_img)){ ?><img src="<?php echo $pro_img;?>" class="sp_prod img-responsive"  style="height:140px;"/><?php }  
	   else { ?><img src="image/imgnotavl.png" class="sp_prod img-responsive"  style="height:140px;"/><?php }  ?>
	  <div class="coup_txtbox box_content" >
	  <p class="couptxt1"><?php if($company!=""){  echo  "<font color=\"black\">".strtoupper($company)."</font>"; }else{ echo "<font color=\"red\"> NA </font>";} ?></p>
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
		   <?php if($saving!=0){ ?><p class="couptxt4">SAVE  Rs. <?php echo $saving; ?>/-</p> <?php }else{?>
			<p class="couptxt4" style="visibility:hidden;">SAVE  Rs. <?php echo $saving; ?>/-</p><?php   } ?>
			<?php if($offerdes!=null){ ?><p><?php echo $offerdes; ?></p> <?php }else{?>
			<p style="visibility:hidden; padding:0px 5px 5px 5px;" ><?php echo $offerdes; ?></p><?php   } ?>
			<p align="left" style=" padding:0px 5px 5px 5px;">
			Product ID: <?php echo $cid;?><br/>
			Code#:<?php echo  $code; ?><br/>
			<!--<iframe src="html/BCGcode39.php?id=<?php echo $code; ?>" id="coupons" frameBorder="0" style="width:100%;height:80px;"/></iframe>-->
			Issued to: <?php echo $uname;?><br/>
			Used On: <?php echo $date;?></br>
			Used At Time: <?php echo $tm;?></br>
			Valid Until: <?php echo $valid_until;?></br>
			<span >Address: <?php echo $address;?></p>
		  <div class="clearfix" ></div>
		</div>
	  </div>
	</div>

	<?php 

	 }   ?>
</div></div></div>
<?php }else{ ?> <div class="alert alert-danger" role="alert" align="center">
	<span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"> &nbsp;&nbsp;&nbsp;&nbsp;
	</span>You haven't used any coupons yet.</div>
<?php }  ?>