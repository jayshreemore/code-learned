<?php
//include 'conn.php';
require_once("dbcontroller.php");
$db_handle = new DBController();

if(!empty($_POST["country_keyword"])) {	
	
$query_c="SELECT country FROM `tbl_country` where country like '" . $_POST["country_keyword"] . "%' and is_enabled='1' ORDER BY country ASC LIMIT 0,6";

$result = $db_handle->runQuery($query_c);
if(!empty($result)) {
		echo "<ul id='state-list'>";
		foreach($result as $countries) {	?>
<li onClick="selectCountry('<?php echo $countries["country"]; ?>');"><?php echo $countries["country"]; ?></li>
<?php }
		echo "</ul>";
}else{
	echo "<ul id='state-list'><li>Enter Valid Country</li></ul>";
} 
}

if(!empty($_POST["state_keyword"])) {
	$c=$_POST['c'];	
	
	$sid=mysql_query("select country_id from tbl_country where country='$c'");
	$stid=mysql_fetch_array($sid);
	$country_id=$stid['country_id'];
	
	$query ="SELECT state FROM tbl_state WHERE state like '" . $_POST["state_keyword"] . "%' and country_id='$country_id' ORDER BY state ASC LIMIT 0,6";
	$result = $db_handle->runQuery($query);
	if(!empty($result)) {
		echo "<ul id='state-list'>";
		foreach($result as $states) {	?>
<li onClick="selectState('<?php echo $states["state"]; ?>');"><?php echo $states["state"]; ?></li>
<?php }
		echo "</ul>";
}else{
	echo "<ul id='state-list'><li>Enter Valid State</li></ul>";
} 
} 
 

if(!empty($_POST["city_keyword"])) {
	$s=$_POST['s'];
	$c=$_POST['c'];	
	
	$sid=mysql_query("select country_id from tbl_country where country='$c'");
	$stid=mysql_fetch_array($sid);
	$country_id=$stid['country_id'];	

$sid=mysql_query("select state_id from tbl_state where state='$s' and country_id='$country_id'");
$stid=mysql_fetch_array($sid);
$state_id=$stid['state_id'];


$query ="SELECT distinct sub_district FROM tbl_city WHERE sub_district like '" . $_POST["city_keyword"] . "%' and state_id='$state_id' and country_id='$country_id' ORDER BY sub_district ASC LIMIT 0,6";
$result = $db_handle->runQuery($query);

if(!empty($result)) {
	echo "<ul id='city-list'>";
	foreach($result as $city) {
?>
<li onClick="selectCity('<?php echo $city["sub_district"]; ?>');"><?php echo $city["sub_district"]; ?></li>
<?php } 
echo "</ul>";
}else{
	echo "<ul id='state-list'><li>Enter Valid City</li></ul>";
}
} ?>
