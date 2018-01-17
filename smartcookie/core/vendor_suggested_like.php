<?php
include 'coupon.inc.php';
include 'sp_list_coupon_cat.php';
//
//var_dump($_SESSION);
$distance="";

if(isset($_GET['lk'])){
	$lk=$_GET['lk'];
	$user_member_id = $_SESSION['id'];
	echo "select * from tbl_like_status where from_entity='$entity' and from_user_id='$user_member_id' and to_entity='4' and to_user_id='$lk' and active_status='0'"; 
	$l=mysql_query("select * from tbl_like_status where from_entity='$entity' and from_user_id='$user_id' and to_entity='4' and to_user_id='$lk' and active_status='0'"); 
	$like_count_by_this_user = mysql_num_rows($l);
	echo $like_count_by_this_user;
	
	if(!($like_count_by_this_user=='1'))
	 {
		 //echo "<script>alert('65423')</script>";
	 mysql_query("update `tbl_sponsorer` set v_likes = v_likes + 1 where `id`='$lk'");
	mysql_query("insert into tbl_like_status (id,from_entity,from_user_id,to_entity,to_user_id,active_status) values(null,'$entity','$user_id','4','$lk','0')");
	//header("Location:vendor_suggested_like.php");
	 
	 }
	 else
	 {
		 echo "<script>alert('already liked')</script>";
		 //header("Location:vendor_suggested_like.php");
	 }
}


if(isset($_GET['getlat']) && isset($_GET['getlong'])){	
	$lat21=$_GET['getlat'];
	$lon21=$_GET['getlong'];
	setcookie("lat2_vlist", $lat21, time()+3600);
	setcookie("lon2_vlist", $lon21, time()+3600);
	header("Location:".htmlspecialchars($_SERVER['PHP_SELF']));
}

if(!isset($_COOKIE['lat2_vlist']) and !isset($_COOKIE['lon2_vlist'])){
	$data= new data();
	$data->currentGeoLocationOnInit();	
}

	
	if(isset($_COOKIE['distance_vlist'])){
	$distance=$_COOKIE['distance_vlist'];
	}else{
	$distance=10;	
	}
	if($distance!="no_limit"){
		$chk_dist=$distance;
	}elseif($distance=='no_limit'){
		$chk_dist=1000;
	}else{
		$chk_dist=5;
	}
	
?>
<link href="css/vendor_suggested_list.css" rel="stylesheet">
<!----========================= middle_container Start----->
 <div class="middle_container">
      <div class="container">  
	  <div class="whitemid-box clearfix">
	  
	  <div class="heading-sec clearfix">
	<span class="pull-left text-s">Suggested Sponsors</span> 	  
	  </div>
	  
	  
	  
       <div class="row">  

	   
                  <div class="row-sec clearfix"> <!--row-sec start here--> 
	<?php	
$meters="";
$tc_check=0;
include 'distance.php';
while($r=mysql_fetch_array($su)){

$v_id=$r['id'];
$v_name=$r['sp_name'];
$v_category=$r['v_category'];

$v_address=$r['sp_address'];	
$v_likes=$r['v_likes'];	
$v_status=$r['v_status'];

$sp_country=$r['sp_country'];
$sp_state=$r['sp_state'];
$sp_city=$r['sp_city'];	
	
	$addr=$sp_city.", ".$sp_state.", ".$sp_country;
	$add= urlencode($addr);
	$geocode_selected=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$add.'&sensor=false');
	$output_selected= json_decode($geocode_selected);
	$lat1 = $output_selected->results[0]->geometry->location->lat;
	$lon1 = $output_selected->results[0]->geometry->location->lng;
	
	$lat2=@$_COOKIE['lat2_vlist'];
	$lon2=@$_COOKIE['lon2_vlist'];
	
	$miles=calculateDistance($lat1, $lon1, $lat2, $lon2);
	
	$kilometers = $miles * 1.609344;
	
	if($kilometers >= 0){
		$meters = $miles * 1609.34;
	}
	

	
	if($kilometers <= $chk_dist){
		$dist_acceptable=1;
	}else{
		$dist_acceptable=0;
	}
	
	if($dist_acceptable && $v_status=='Inactive' && $v_name!=""){

?>	
                   <div class="col-xs-12 col-sm-6 col-md-4"><!--box-one start here-->
                     <div class="box-vendor clearfix">
					  <div class="col-xs-1 col-sm-1 col-md-2 padding-lf">
					 <div class="color-sec">
					 <div class="color-code">
					 
					 </div>
					 </div>
					  </div>
					  
					  <div class="col-xs-11 col-sm-11 col-md-10 padding-lf">
				  <div class="col-xs-8 col-sm-7 col-md-7 padding-lf">
				  <div class="add-ress clearfix">
				  <p><?php if($v_name!=""){ echo $v_name; }?><br>
				  <?php if($v_address!=""){ echo $v_address; }?><br>
				  <?php if($sp_city!=""){ echo $sp_city; }?><br>
				  <?php if($sp_state!=""){ echo $sp_state; }?>
				    </p>
				  </div>
				  </div>
				  
				    <div class="col-xs-4 col-sm-5 col-md-5">
				 <div class="like-sec clearfix">
				<?php ?> <?php 
				 
	$l=mysql_query("select * from tbl_like_status where from_entity='$entity' and from_user_id='$user_id' and to_entity='4' and to_user_id='$v_id' and active_status='0'"); 
	$liked = mysql_fetch_array($l);
	$fe=$liked['from_entity']; 	
	$fu=$liked['from_user_id']; 	
	$te=$liked['to_entity']; 	
	$tu=$liked['to_user_id']; 	
	$ts=$liked['active_status']; 
	 
	if($ts==0 && $fe==$entity && $fu==$user_id && $te=='4' && $tu==$v_id){ ?>
	<a class="lke-btn">Liked<span class="badge" style="background-color:#fff; color:#000;">
	<?php if($v_likes!=""){ echo $v_likes; }?></span></a>	
	
	<?php }else{ ?>
	<a href="vendor_suggested_like.php?lk=<?php echo $v_id; ?>" class="lke-btn">Likes
	<span class="badge" style="background-color:#fff; color:#000;">
	<?php if($v_likes!=""){ echo $v_likes; }?></span></a>
	<?php } ?><?php ?>
    <?php  
	
	
	$l1=mysql_query("select sp_name,sp_address,sp_city,sp_state from tbl_sponsorer");
	//$value= mysql_fetch_array($l1);
	
	
	while ($row = mysql_fetch_assoc($l1)) {
    echo $row['row'];
	}
	
	?>			
				  </div>
				  </div>
				  </div>
					  </div>
					  
					 </div><!--box-one end here-->
<?php  $tc_check++;  } }  
if($tc_check==0){
	?>
	<div class="alert alert-info" role="alert" align="center">
	<span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"> &nbsp;&nbsp;&nbsp;&nbsp;
	</span><strong>There are no suggested vendors</strong></div>
<?php	
}
?>


				
					 
					 </div><!--row-sec end here--> 
			
					 
				 </div>
                 <a href="vendor_new_suggest.php">Suggest newly if not listed</a> 
               
			   <div class="readmsg-pagination clearfix">
			      <div class="col-xs-12 col-sm-7 col-md-8">
			   <p>With this number of likes we can approach vendors  to be partner with us.</p>
			     </div>

			   </div>
                   
             </div>
			 </div>
           </div>

     
</body>
</html>