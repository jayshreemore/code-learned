<?php
$json = file_get_contents('php://input');
$obj = json_decode($json);

include 'conn.php';

$proid=$obj->{'coupon_id'};
$ppp=$obj->{'points_per_product'};
$entity=$obj->{'entity'};    
$user_id=$obj->{'user_id'};
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
if($proid!='' and $ppp!='' and $entity!='' and $user_id!=''){	
		if($entity=='3'){
			//get total pts with the user
			$q = mysql_query("select sum(sc_total_point + yellow_points + purple_points + balance_water_points) as totat_pts from tbl_student_reward sr left join tbl_student s on sr.sc_stud_id=s.std_PRN where s.id='$user_id'")or die(mysql_error());
			$tp1=mysql_fetch_array($q);
			$tp=$tp1['totat_pts'];
			
	
		}elseif($entity=='2'){
			$q = mysql_query("select balance_blue_points as blue, balance_blue_points as totat_pts from  tbl_teacher where id='$user_id'")or die(mysql_error());
			$tp1=mysql_fetch_array($q);
			$tp=$tp1['totat_pts'];
			
		}
			$ap=mysql_query("select sum(for_points) as usedpts from cart where user_id='$user_id' and entity_id='$entity' and `coupon_id` IS NOT NULL");
			$up1=mysql_fetch_array($ap)or die(mysql_error());
			$up=$up1['usedpts'];
				
			$rempts=$tp-$up;
						
		
		if($rempts>=$ppp){
				
				$counter1=mysql_query("select total_coupons, daily_counter from tbl_sponsored spd where spd.id='$proid'")or die(mysql_error());
				$counter=mysql_fetch_array($counter1);

				$total_coupons=$counter['total_coupons'];
				
				if($total_coupons!='unlimited' and $total_coupons!='NULL' and !$total_coupons<1 ){
					$total_coupons -=1;
					
				mysql_query("UPDATE tbl_sponsored SET total_coupons='$total_coupons' WHERE `id`='$proid'")or die(mysql_error());

				}				
				
				$daily_counter=$counter['daily_counter'];	
				
				if($daily_counter!='unlimited' and $daily_counter!='NULL' and !$daily_counter<1 ){
						$daily_counter -=1;
				mysql_query("UPDATE tbl_sponsored SET daily_counter='$daily_counter' WHERE `id`='$proid'")or die(mysql_error());
				}
			
			$i=mysql_query("INSERT INTO `cart` (`id`, `entity_id`, `user_id`, `coupon_id`, `for_points`, `timestamp`, `available_points`) VALUES (NULL, \"$entity\", \"$user_id\",\"$proid\" ,\"$ppp\", CURRENT_TIMESTAMP, \"$ppp\")")or die(mysql_error());
			$iid=mysql_insert_id();
			if($iid){
				$postvalue['responseStatus']=200;
				$postvalue['responseMessage']="OK";
				
				$cart=mysql_query("SELECT c.id, entity_id, user_id, coupon_id, for_points, timestamp, available_points, spd.Sponser_product, spd.product_image, s.sp_company, concat(s.sp_address, ', ', s.sp_city) as address, spd.sponsor_id, spd.valid_until FROM cart c JOIN tbl_sponsored spd ON spd.id=c.coupon_id JOIN tbl_sponsorer s ON s.id=spd.sponsor_id where c.id='$iid'");
				
				
				$res=mysql_fetch_array($cart);
				
						$posts[] =array("selid"=>$res['id'],
							"Sponser_product"=>$res['Sponser_product'],
							"sp_company"=>$res['sp_company'],
							"address"=>$res['address'],
							"entity_id"=>$res['entity_id'],
							"product_image"=>imageurl($res['product_image'],'','product'),
							"user_id"=>$res['user_id'],
							"sponsor_id"=>$res['sponsor_id'],
							"coupon_id"=>$res['coupon_id'],
							"points_per_product"=>$res['for_points'],
							"valid_until"=>$res['valid_until']
						);	
						
				$postvalue['posts']=$posts;			
			}else{
				$postvalue['responseStatus']=204;
				$postvalue['responseMessage']="No Response";//IF Coupon Not Inserted Into Cart
				$postvalue['posts']=null;				
			}
			
		}else{
			$postvalue['responseStatus']=204;
			$postvalue['responseMessage']="No Response";//No More Points
			$postvalue['posts']=null;
		}	
}else{
			$postvalue['responseStatus']=1000;
			$postvalue['responseMessage']="Invalid Input";
			$postvalue['posts']=null;
}			
header('Content-type: application/json');
echo json_encode($postvalue); 