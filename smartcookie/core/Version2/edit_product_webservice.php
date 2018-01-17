<?php  
//$json=$_GET ['json'];
$json = file_get_contents('php://input');
$obj = json_decode($json);
//echo $json;

//Save
if($obj->{'id'} != '')
{
include 'conn.php';

	 $id=$obj->{'id'};
	 $product=$obj->{'product'};
	  $discount=$obj->{'discount'};
	  $points_per_product=$obj->{'points_per_product'};
	  
	  		$Image=$obj->{'Image'};
			$ImageBase64=$obj->{'ImageBase64'};
			
		if($Image!='' and $ImageBase64!=''){
	
	$ex_img = explode(".",@$Image);
	$img_name = @$ex_img[0]."_".@$sp_id."_".date('Ymd_h:m:s').".".@$ex_img[1];
	$full_name_path = "Assets/images/sp/productimage/".$img_name;
	$imageName = "../../".$full_name_path;
	$imageData = base64_decode($ImageBase64); 
	$source = imagecreatefromstring($imageData);  
	$imageSave = imagejpeg($source,$imageName,100);			
			
			 $sql="update tbl_sponsored set Sponser_product='$product', discount='$discount', points_per_product='$points_per_product', product_image='$img_name' where id=$id ";
			
		}else{
			$sql="update tbl_sponsored set Sponser_product='$product', discount='$discount', points_per_product='$points_per_product' where id=$id ";
		}
	 
	
		
	$result=mysql_query($sql);
	 $row=mysql_affected_rows();
	if($row>=1)
		  {
            $postvalue['responseStatus']=200;
			$postvalue['responseMessage']="OK";
			$postvalue['posts']=null;
		  }
		  else
		  {
		    $postvalue['responseStatus']=204;
			$postvalue['responseMessage']="No Response";
			$postvalue['posts']=null;
		   } 
mysql_close($con);
	
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