<?php  

$json = file_get_contents('php://input');
$obj = json_decode($json);

$format = 'json'; //xml is the default


include 'conn.php';

//display_sponsor_product_ws.php
require '../coupon_validity_check.php';


/* $coupon =mysql_query("SELECT * FROM tbl_sponsorer sp JOIN tbl_sponsored spd ON sp.id = spd.sponsor_id WHERE `points_per_product`!=0 and `category`=\"$catsid\" and `validity`<>'invalid' ORDER BY priority DESC");
$count = mysql_num_rows($coupon); */



$vendor_id=  $obj->{'vendor_id'};
$User_Sponser_type=  $obj->{'User_Sponser_type'};

	/*function imageurl($value,$type='',$img=''){
			//$logoUrl=@get_headers(base_url('/Assets/images/sp/profile/'.$value));
			if($img=='sp_profile'){
				$path='sp/profile/';
			}elseif($img=='product'){
				$path='sp/productimage/';
			}elseif($img=='spqr'){
				$path='sp/coupon_qr/';
			}else{
				$path='';
			}
			$base_url="http://".$_SERVER['HTTP_HOST'];	
			$logoUrl=@get_headers($base_url.'/Assets/images/'.$path.$value);
			$tlogoUrl=@get_headers('http://tsmartcookies.bpsi.us/'.$value);
			$slogoUrl=@get_headers('http://www.smartcookie.in/'.$value);
			if($logoUrl[0] == 'HTTP/1.1 200 OK' && $value!='new-product.jpg' && $value!='' ){
				$logoexist=$base_url.'/Assets/images/'.$path.$value;
			}elseif($tlogoUrl[0] == 'HTTP/1.1 200 OK' && $value!=''){
				$logoexist='http://tsmartcookies.bpsi.us/core/'.$value;
			}elseif($slogoUrl[0] == 'HTTP/1.1 200 OK' && $value!=''){
				$logoexist='http://www.smartcookie.in/core/'.$value;
			}else{
				if($type=='sclogo'){
					$logoexist=$base_url.'/Assets/images/sp/profile/newlogo.png';
				}elseif($type=='avatar'){
					$logoexist=$base_url.'/Assets/images/avatar/avatar_2x.png';
				}else{
					$logoexist=$base_url.'/Assets/images/sp/profile/imgnotavl.png';
				}				
			}
			return $logoexist;
		}*/
		
		function imageurl($value,$type='',$img=''){
			$base_url="http://".$_SERVER['HTTP_HOST'];
			
			if($img=="product"){
							if($value!=''){
							$logoexist="$base_url/Assets/images/sp/productimage/$value";					
							}else{
							$logoexist="$base_url/Assets/images/sp/profile/imgnotavl.png";							
							}	
			}elseif($img=="sp_profile"){
				         
							if($value!=''){
							$logoexist="$base_url/Assets/images/sp/profile/$value";	
							}else{
							$logoexist="$base_url/Assets/images/avatar/avatar_2x.png";
							}				      
				      }  
			
					return $logoexist;
				}

	if( $vendor_id !="")
		{
	
			if($User_Sponser_type!=""){
				$sql="SELECT spd.validity, spd.id, sp.sp_img_path, spd.Sponser_type, spd.Sponser_product, sp.lat,sp.lon, spd.points_per_product, spd.sponsered_date, spd.sponsor_id, spd.product_image, spd.valid_until, cat.category, spd.product_price, spd.discount, spd.buy, spd.get, spd.saving, spd.offer_description, spd.total_coupons, spd.priority, spd.coupon_code_ifunique, spd.currency, spd.daily_counter, spd.daily_limit
             FROM tbl_sponsorer sp 
			 JOIN tbl_sponsored spd ON sp.id = spd.sponsor_id 
			 JOIN categories cat ON cat.id = spd.category 
			 WHERE spd.sponsor_id='$vendor_id' and `validity`<>'invalid' and spd.Sponser_type='$User_Sponser_type' ORDER BY spd.points_per_product DESC";
				 
				 
				 
			}else{
			 $sql="SELECT spd.validity, spd.id, sp.sp_img_path, spd.Sponser_type, spd.Sponser_product, sp.lat,sp.lon, spd.points_per_product, spd.sponsered_date, spd.sponsor_id, spd.product_image, spd.valid_until, cat.category, spd.product_price, spd.discount, spd.buy, spd.get, spd.saving, spd.offer_description, spd.total_coupons, spd.priority, spd.coupon_code_ifunique, spd.currency, spd.daily_counter, spd.daily_limit
             FROM tbl_sponsorer sp 
			 JOIN tbl_sponsored spd ON sp.id = spd.sponsor_id 
			 JOIN categories cat ON cat.id = spd.category 
			 WHERE spd.sponsor_id='$vendor_id' and `validity`<>'invalid' ORDER BY spd.points_per_product DESC";
			}
			 
			 
 			 $arr = mysql_query($sql);

  				/* create one master array of the records */
				
  			$posts = array();
  			if(mysql_num_rows($arr)>=1) {
    			while($post = mysql_fetch_assoc($arr)) {
      				
					$coupon_id=$post['id'];
				
	
						$sp_img_path=imageurl($post['sp_img_path'],'sclogo','sp_profile');

						$sponser_type=$post['Sponser_type'];
						$sponser_product=$post['Sponser_product'];
						$points_per_product=$post['points_per_product'];
						$sponsered_date=$post['sponsered_date'];
						$sponsor_id=$post['sponsor_id'];
						
					
						$product_image=imageurl($post['product_image'],'','product');
				

						$valid_until=$post['valid_until'];
						$validity=$post['validity'];
						$category=$post['category'];
						$product_price=$post['product_price'];
						$discount=$post['discount'];
						$buy=$post['buy'];
						$get=$post['get'];
						$saving=$post['saving'];
						$offer_description=trim($post['offer_description']);
						$total_coupons=$post['total_coupons'];
						$daily_limit=$post['daily_limit'];
						$daily_counter=$post['daily_counter'];
						$priority=$post['priority'];
						$coupon_code_ifunique=$post['coupon_code_ifunique'];
						
						
	$currid=$post['currency'];	
	if($currid!=0 or $currid!=null){
	$curre=mysql_query("SELECT `currency` FROM `currencies` WHERE `id`=$currid ");	
	$curr=mysql_fetch_array($curre);
	$currency=$curr['currency'];
	}else{
		$currency="";		
	}

	
	$c_chk=$abc->counter_check($daily_counter);	

	
		
					if($c_chk){
					 $posts[] =array("coupon_id"=>$coupon_id,
					"sp_img_path"=>$sp_img_path,
					"sponser_type"=>$sponser_type,
					"sponser_product"=>$sponser_product,
					"validity"=>$validity,
					"points_per_product"=>$points_per_product,
					"sponsered_date"=>$sponsered_date,
					"sponsor_id"=>$sponsor_id,
					"product_image"=>$product_image,
					"valid_until"=>$valid_until,
					"category"=>$category,
					"product_price"=>$product_price,
					"discount"=>$discount,
					"buy"=>$buy,
					"get"=>$get,
					"saving"=>$saving,
					"offer_description"=>$offer_description,
					"total_coupons"=>$total_coupons,
					"priority"=>$priority,
					"coupon_code_ifunique"=>$coupon_code_ifunique,
					"currency"=>$currency,
					"daily_counter"=>$daily_counter,
					"daily_limit"=>$daily_limit
					); 
					}
				
      				
    			}
				$postvalue['responseStatus']=200;
				$postvalue['responseMessage']="OK";
				$postvalue['posts']=$posts;
				
  			}
  			else
  			{
  				$postvalue['responseStatus']=204;
				$postvalue['responseMessage']="No Response";
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
			
			
 
  /* disconnect from the db */
  @mysql_close($link);	
	
		
  ?>
