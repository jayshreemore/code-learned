<?php  
//show_selected_vendor_coupons_ws.php
//$json=$_GET ['json'];
$json = file_get_contents('php://input');
$obj = json_decode($json);

 $format = 'json'; //xml is the default



include 'conn.php';

  
$entity_id=$obj->{'entity'};
$user_id=$obj->{'user_id'}; 
$status=$obj->{'coupon_status'}; //unused //used

if( $entity_id != "" and $user_id !="")
		{
function imageurl($value,$type='',$img=''){
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
			$base_url='http://test.smartcookie.in/';
			$logoUrl=@get_headers($base_url.'/Assets/images/'.$path.$value);
			$tlogoUrl=@get_headers('http://tsmartcookies.bpsi.us/'.$value);
			$slogoUrl=@get_headers('http://www.smartcookie.in/'.$value);
			if($logoUrl[0] == 'HTTP/1.1 200 OK' && $value!='new-product.jpg' && $value!='' ){
				$logoexist=$base_url.'/Assets/images/'.$path.$value;
			}elseif($tlogoUrl[0] == 'HTTP/1.1 200 OK' && $value!=''){
				$logoexist='http://tsmartcookies.bpsi.us/'.$value;
			}elseif($slogoUrl[0] == 'HTTP/1.1 200 OK' && $value!=''){
				$logoexist='http://www.smartcookie.in/'.$value;
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
}
 $sql="SELECT spd.id, sp.sp_name, sp.sp_address, sp.sp_country, sp.sp_state, sp.sp_city, sp.sp_email, sp.sp_phone, sp.sp_company, sp.sp_website, sp.sp_img_path, sp.lat, sp.lon, sp.pin, spd.Sponser_type, spd.Sponser_product, spd.points_per_product, spd.sponsered_date, spd.product_image, svc.sponsor_id, svc.valid_until, cat.category, product_price, spd.discount, buy, spd.get, saving, offer_description, daily_limit, total_coupons, priority, coupon_code_ifunique, cur.currency, daily_counter, reset_date, validity, svc.id as sel_id, svc.timestamp, svc.code FROM `tbl_selected_vendor_coupons` svc JOIN tbl_sponsorer sp ON svc.sponsor_id=sp.id JOIN tbl_sponsored spd ON spd.id = svc.coupon_id LEFT JOIN categories cat ON cat.id = spd.category LEFT JOIN currencies cur ON cur.id = spd.currency WHERE `svc`.`used_flag`='$status' and `validity`<>'invalid' and svc.entity_id='$entity_id' and svc.user_id='$user_id'";
 			 $arr = mysql_query($sql);
  
  				/* create one master array of the records */
  			$posts = array();
  			if(mysql_num_rows($arr)>=1) {
    			while($post = mysql_fetch_assoc($arr)) {
					$posts[] =array(
					"sel_id"=>$post['sel_id'],
					"coupon_id"=>$post['id'],
					"sponsor_id"=>$post['sponsor_id'],
					"sp_address"=>$post['sp_address'],
					"sp_country"=>$post['sp_country'],
					"sp_state"=>$post['sp_state'],
					"sp_city"=>$post['sp_city'],
					"sp_company"=>$post['sp_company'],						
					"sponsered_date"=>$post['sponsered_date'],						
					"sp_email"=>$post['sp_email'],						
					"sp_phone"=>$post['sp_phone'],						
					"sp_name"=>$post['sp_name'],						
					"sp_website"=>$post['sp_website'],						
					"lat"=>$post['lat'],						
					"lon"=>$post['lon'],						
					"pin"=>$post['pin'],						
					"category"=>$post['category'],						
					"daily_limit"=>$post['daily_limit'],
					"sp_img_path"=>imageurl($post['sp_img_path'],'','sclogo'),	
					"Sponser_product"=>$post['Sponser_product'],						
					"product_price"=>$post['product_price'],						
					"points_per_product"=>$post['points_per_product'],
					"product_image"=>imageurl($post['product_image'],'','product'),						
					"valid_until"=>$post['valid_until'],
					"discount"=>$post['discount'],						
					"buy"=>$post['buy'],		
					"get"=>$post['get'],
					"saving"=>$post['saving'],
					"offer_description"=>$post['offer_description'],						
					"currency"=>$post['currency'],
					"timestamp"=>$post['timestamp'],
					"code"=>$post['code']
					);	
				}
				$postvalue['responseStatus']=200;
				$postvalue['responseMessage']="OK";
				$postvalue['posts']=$posts;	
  			}
  			else{
				$postvalue['responseStatus']=204 ;
				$postvalue['responseMessage']="No Response";//No More Points
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
echo json_encode($postvalue); 		
			
			
 
  /* disconnect from the db */
  @mysql_close($link);	
	
		
  ?>