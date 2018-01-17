<?php
@include 'conn.php';
@include 'cart_login_inc.php';
$user_id=$_SESSION['id'];
$entity=$_SESSION['entity'];
	if(!isset($_SESSION['id'])){
		if($_SESSION['entity']!=3 or $_SESSION['entity']!=2){
			echo 'Please login to continue..';
			header( "refresh:2;url=login.php" );	
		}
	}
	
$rid=@$_SESSION['rid'];
$school_id=@$_SESSION['school_id'];

if($entity==3){
	@require 'stud_header.php';
}elseif($entity==2){
	@require 'header.php';
}elseif($entity==4){
	@require 'sponsor_header.php';
}
upcartonlogin($entity,$user_id, $rid, $school_id);
class data{
function locationByAddress($entity, $id){
	$latitude=0;
	$longitude=0;
	$arr=array();
	if($entity==3){
		$q=mysql_query("SELECT std_city, std_country, latitude, longitude, std_state FROM `tbl_student` WHERE `id`=\"$id\" ");
		$s=mysql_fetch_array($q);
		
		$country_selected=$s['std_country'];
		$state_selected=$s['std_state'];
		$city_selected=$s['std_city'];		
		$latitude=$s['latitude'];
		$longitude=$s['longitude'];
	}	
	
	if($entity==2){
		$q=mysql_query("SELECT t_city, t_country, state FROM `tbl_teacher` WHERE `id`=\"$id\" ");
		$s=mysql_fetch_array($q);
		
		$country_selected=$s['t_country'];
		$state_selected=$s['state'];
		$city_selected=$s['t_city'];		
	}
	if($country_selected!=""){
		$val=$this->calLatLongByAddress($country_selected,$state_selected,$city_selected);			
		return $val;
	}elseif($latitude!=0){
		$arr[0]=$latitude;
		$arr[1]=$longitude;
		return $arr;
	}	
}

function calLatLongByAddress($country, $state, $city){	
	$addr=$city.", ".$state.", ".$country;
	$add= urlencode($addr);
	//$geocode_selected=file_get_contents('
//https://maps.google.com/maps/api/geocode/json?address=$address');
$geocode_selected=file_get_contents('https://maps.google.com/maps/api/geocode/json?key=AIzaSyCNK5sD4wCE1AfX9QhMQYoREiu7LVLtUT8&address='.$add.'&sensor=false');
	/*$geocode_selected = curl_init("http://maps.google.com/maps/api/geocode/json?address='.$add.'&sensor=false"); 	
					
					
	$data_string = json_encode($geocode_selected);    
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");    
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);      
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_string))); $result = json_decode(curl_exec($ch),true);
	*/
	
	
	
	
	
	
	$output_selected= json_decode($geocode_selected);
	//var_dump($output_selected);
	$latlong=array();
	$latlong[0] = $output_selected->results[0]->geometry->location->lat;
	$latlong[1] = $output_selected->results[0]->geometry->location->lng;
	return $latlong;	
}

function currentGeoLocation(){

	?>
 <script>

</script>
<?php
}

function currentGeoLocationOnInit(){
	?>
<script>
$(document).ready(function(){ 

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert("Geolocation is not supported by this browser.");
	}

});
</script>
<?php
}

	
}


?>