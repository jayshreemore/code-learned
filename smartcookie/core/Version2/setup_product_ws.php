<?php  
//$json=$_GET ['json'];
$json = file_get_contents('php://input');
$obj = json_decode($json);
//echo $json;

//Save

if($obj->{'product'} != "" && $obj->{'points'} != "" && $obj->{'sponsor_id'} != "" && $obj->{'product_type'} != ""  )
{
	include 'conn.php';
	
		$sp_id=$obj->{'sponsor_id'};
		$v_category1=mysql_query("select v_category from tbl_sponsorer where id='$sp_id'");
		$v_category =mysql_fetch_array($v_category1);
		$category=$v_category['v_category'];	
	
$arr = mysql_query("select id from tbl_sponsored where Sponser_product = '".$obj->{'product'}."' and sponsor_id='".$obj->{'sponsor_id'}."'");
  $count = mysql_num_rows($arr);
  if($count == 0)
  {
	  	$newdate1 = strtotime('+6 months', time()) ; // sponsored date
		$valid_until = date ("m/d/Y", $newdate1);
		$sponsored=date("m/d/Y",time()); // sponsored date
	
		  	$Image=$obj->{'Image'};
			$ImageBase64=$obj->{'ImageBase64'};
			
		if($Image!='' and $ImageBase64!=''){
	
	$ex_img = explode(".",@$Image);
	//date format changed by pravin 2017-08-20
	$img_name = @$ex_img[0]."_".@$sp_id."_".date('Ymd_h:m:s').".".@$ex_img[1];	 
	//$img_name = "product". "_" .@$sp_id . "_" . date('Y-m-d') ."_". $ex_img[0];
	$full_name_path = "Assets/images/sp/productimage/".$img_name;
	$imageName = "../../".$full_name_path;
	$imageData = base64_decode($ImageBase64); 
	$source = imagecreatefromstring($imageData);  
	$imageSave = imagejpeg($source,$imageName,100);		
	$test1 = mysql_query("INSERT INTO `tbl_sponsored` (Sponser_type,Sponser_product,points_per_product,sponsor_id,total_coupons,valid_until,sponsered_date,daily_limit,daily_counter,reset_date,category, discount,product_image) VALUES('".$obj->{'product_type'}."', '".$obj->{'product'}."', '".$obj->{'points'}."', '".$obj->{'sponsor_id'}."','unlimited','$valid_until','$sponsored','unlimited','unlimited','$sponsored','$category','".$obj->{'discount'}."','".$img_name."')");
		
		}
		else
		{
	
$test1 = mysql_query("INSERT INTO `tbl_sponsored` (Sponser_type,Sponser_product,points_per_product,sponsor_id,total_coupons,valid_until,sponsered_date,daily_limit,daily_counter,reset_date,category, discount) VALUES('".$obj->{'product_type'}."', '".$obj->{'product'}."', '".$obj->{'points'}."', '".$obj->{'sponsor_id'}."','unlimited','$valid_until','$sponsored','unlimited','unlimited','$sponsored','$category','".$obj->{'discount'}."')");
		}	
		
		$sid=mysql_insert_id();
		
		mysql_close($con);
		if($sid!=""){
			$postvalue['responseStatus']=200;
			$postvalue['responseMessage']="OK";
			$postvalue['posts']=null;			
		}else{
			$postvalue['responseStatus']=204;
			$postvalue['responseMessage']="No Response";
			$postvalue['posts']=null;			
		}

	}
	else
	{
			$postvalue['responseStatus']=409;
			$postvalue['responseMessage']="Conflict";
			$postvalue['posts']=null;
	}
}
else
{
			$postvalue['responseStatus']=1000;
			$postvalue['responseMessage']="Invalid Input";
			$postvalue['posts']=null;
}
header('Content-type: application/json');
echo  json_encode($postvalue); 	
	
		
  ?>