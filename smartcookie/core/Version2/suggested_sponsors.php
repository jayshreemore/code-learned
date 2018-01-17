<?php
$json = file_get_contents('php://input');
$obj = json_decode($json);
$format = 'json';
include 'conn.php';

$entity=$obj->{'entity'};
$user_id=$obj->{'user_id'};

$v_category=$obj->{'v_category'};  
$lk_sp_lat=$obj->{'lk_sp_lat'};
$lk_sp_long=$obj->{'lk_sp_long'};

$lk_sp_country=$obj->{'lk_sp_country'};
$lk_sp_state=$obj->{'lk_sp_state'};
$lk_sp_city=$obj->{'lk_sp_city'};

if($entity!='' and $user_id!=''){


	if($lk_sp_long==0 and $lk_sp_lat==0){		
		$address_selected=$lk_sp_city.", ".$lk_sp_state.", ".$lk_sp_country;	
		$prepAddr_selected = urlencode($address_selected);
		$geocode_selected=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr_selected.'&sensor=false');
		$output_selected= json_decode($geocode_selected);
		$lat2 = $output_selected->results[0]->geometry->location->lat;
		$lon2 = $output_selected->results[0]->geometry->location->lng;		
	}else{
		$lat2=$lk_sp_lat;
		$lon2=$lk_sp_long;
	}
	
	if($v_category!='' or $v_category!=0){
		$su =mysql_query("SELECT id,sp_name,v_category,sp_phone,sp_email,sp_address,sp_state,sp_city,sp_country,v_status,v_likes,lat,lon FROM  tbl_sponsorer WHERE `v_status`='Inactive' and v_category='$v_category' ORDER BY id DESC");
	}else{
		$su =mysql_query("SELECT id,sp_name,v_category,sp_phone,sp_email,sp_address,sp_state,sp_city,sp_country,v_status,v_likes,lat,lon FROM  tbl_sponsorer WHERE `v_status`='Inactive' ORDER BY id DESC");
	}	
	
	include 'distance.php';
	
	$posts = array();
	$iii=0;
	while($r=mysql_fetch_array($su)){
		$lat=$r['lat'];
		$lon=$r['lon'];
		
		$sp_id=$r['id'];	
		$sp_address=$r['sp_address'];
		$sp_state=$r['sp_state'];
		$sp_city=$r['sp_city'];
		$sp_country=$r['sp_country'];
		
		$sp_name=$r['sp_name'];
		$v_category=$r['v_category'];
		$sp_phone=$r['sp_phone'];
		$sp_email=$r['sp_email'];
		
		$v_likes=$r['v_likes'];
		$v_status=$r['v_status'];

		
				
		if($lat==0 or $lon==0){				
			$geocode_selected=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.urlencode($sp_address.", ".$sp_city.", ".$sp_state.", ".$sp_country).'&sensor=false');
			$output_selected= json_decode($geocode_selected);
			$lat = $output_selected->results[0]->geometry->location->lat;
			$lon = $output_selected->results[0]->geometry->location->lng;	
		}

		$miles=calculateDistance($lat, $lon, $lat2, $lon2);
		$kilometers = round(($miles * 1.609344),2);
		
		if($kilometers){
			
		$l=mysql_query("select * from tbl_like_status where from_entity='$entity' and from_user_id='$user_id' and to_entity='4' and to_user_id='$sp_id'"); 
		$liked = mysql_affected_rows();
		if($liked > 0 ){
			$like_status='liked';
		}else{
			$like_status='like';
		}
				$posts[] =array("v_id"=>$sp_id,
					"v_name"=>$sp_name,
					"v_category"=>$v_category,
					"v_email"=>$sp_email,
					"v_address"=>$sp_address,
					"v_likes"=>$v_likes,
					"v_status"=>$v_status,
					"kilometers"=>"'".$kilometers."'",
					"like_status"=>$like_status
					); 
					$iii++;
		}			
	}
	if($iii==0){
		$postvalue['responseStatus']=204;
		$postvalue['responseMessage']="No Response";
		$postvalue['posts']=null;
	}else{
		$postvalue['responseStatus']=200;
		$postvalue['responseMessage']="OK";
		$postvalue['posts']=$posts;	
	}

}else{
			$postvalue['responseStatus']=1000;
			$postvalue['responseMessage']="Invalid Input";
			$postvalue['posts']=null;
}		
 header('Content-type: application/json');
 echo json_encode($postvalue);						
						
  @mysql_close($con);
?>