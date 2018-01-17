<?php  
//$json=$_GET ['json'];
$json = file_get_contents('php://input');
$obj = json_decode($json);

 $format = 'json'; 

include 'conn.php';

//input from user
  $input_type=$obj->{'input_type'};
 $input_id=$obj->{'input_id'};
 $stud_id=$obj->{'stud_id'};   // row id
 
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
			$base_url=$_SERVER['HTTP_HOST'];		
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
		}

	
    	if( $input_type != "" &&  $input_id != "" )
		{
			
			if($input_type=='VENDOR_INFO')
			{
				$sql="select id,sp_company,sp_address,sp_city,sp_country,sp_email,sp_phone,lat,lon,v_category,sp_img_path,v_status from tbl_sponsorer where (v_status='Active' or v_status is null) and id='$input_id'"; //id will be act  as sponsor id
				 $arr = mysql_query($sql)or die(mysql_error());  
  				/* create one master array of the records */
				$posts = array();
				if(mysql_num_rows($arr)>=1) 
				{
					while($test = mysql_fetch_assoc($arr))
					{
					
							$lat2=@$test['lat'];
							$lon2=@$test['lon'];
							$sp_company=$test['sp_company'];
							$sp_address=$test['sp_address'];
				
		
							$sp_city=$test['sp_city'];
							$sp_country=$test['sp_country'];
							$sp_email=$test['sp_email'];
							$sp_phone=$test['sp_phone'];
							$v_category=$test['v_category'];
						
							$sp_id=$test['id'];				
				
	
							$posts[]= array(
											'post'=>array('id'=>$sp_id,
											'sp_company'=>$sp_company,
											'sp_address'=>$sp_address,
											'sp_city'=>$sp_city,
											'sp_country'=>$sp_country,
											'sp_email'=>$sp_email,
											'sp_phone'=>$sp_phone,
											'lat'=>$lat2,
											'lon'=>$lon2,
											'distance'=>$km,
											'category'=>$v_category,
											'sp_img_path'=>imageurl($test['sp_img_path'],'sclogo','sp_profile')
											));
					}	
							$postvalue['responseStatus']=200;
							$postvalue['responseMessage']="OK";
							$postvalue['posts']=$posts;
				}		
				
					
			}else if($input_type=='COUPON_INFO')
			{
				$sql1 = "SELECT svc.id as sel_id,svc.timestamp,svc.code,validity, spd.id, sp_img_path, sp_company, Sponser_product, lat,lon, points_per_product, sponsered_date, spd.sponsor_id, product_image, spd.valid_until,product_price, discount,spd.currency, daily_counter, daily_limit FROM tbl_sponsorer sp JOIN tbl_sponsored spd ON sp.id = spd.sponsor_id JOIN tbl_selected_vendor_coupons svc on svc.sponsor_id=sp.id WHERE svc.user_id='$stud_id' and svc.used_flag='unused' and spd.id='$input_id' group by spd.id";// and `validity`<>'invalid'"; //id will be act  as product id
											
												
												$arr1   = mysql_query($sql1);
												$posts = array();
												
												if (mysql_num_rows($arr1) >= 1) 
												{
													while ($post = mysql_fetch_assoc($arr1))
													{
														
														
																	$coupon_id            = $post['id'];
																	$sp_img_path          = imageurl($post['sp_img_path'], 'sclogo', 'sp_profile');
														
																	$sp_company           = $post['sp_company'];
																	$sponser_product      = $post['Sponser_product'];
																	$points_per_product   = $post['points_per_product'];
																	
																	$sponsor_id           = $post['sponsor_id'];
																	$product_image        = imageurl($post['product_image'], '', 'product');
																	$valid_until          = $post['valid_until'];
																	$validity             = $post['validity'];
																	$category             = $post['category'];
																	$product_price        = $post['product_price'];
																	$discount             = $post['discount'];
																	
																	$currid               = $post['currency'];
																	$coupon_code          = $post['code'];
																	$timestamp          = $post['timestamp'];
																	$selid          = $post['sel_id'];
														
														if ($currid != 0 or $currid != null) {
															$curre    = mysql_query("SELECT `currency` FROM `currencies` WHERE `id`=$currid");
															$curr     = mysql_fetch_array($curre);
															$currency = $curr['currency'];
														} else {
															$currency = null;
														}
														
												
														
														
													
																
																$posts[]                      = array(
																	"coupon_id" => $coupon_id,
																	"sp_img_path" => $sp_img_path,
																	"sp_company" => $sp_company,
																	"sponser_product" => $sponser_product,
																	"validity" => $validity,
																	"points_per_product" => $points_per_product,
																	"sponsered_date" => $sponsered_date,
																	"sponsor_id" => $sponsor_id,
																	"product_image" => $product_image,
																	"valid_until" => $valid_until,
																	"category" => $category,
																	"product_price" => $product_price,
																	"discount" => $discount,
																	"currency" => $currency,
																	"coupon_code" => $coupon_code,
																	"timestamp" => $timestamp,
																	"sel_id" => $selid 
																	
																);

															
														}
													
													if(count($posts)>=1){
														$postvalue['responseStatus']  = 200;
														$postvalue['responseMessage'] = "OK";
														$postvalue['posts']           = $posts;
													}else{
														$postvalue['responseStatus']  = 204;
														$postvalue['responseMessage'] = "No Response";
														$postvalue['posts']           = null;			
													}
														
														
														
										} else
											 {
												 
											 
			$sql = "SELECT validity, spd.id, sp_img_path, sp_company, Sponser_product, lat,lon, points_per_product, sponsered_date, sponsor_id, product_image, valid_until,product_price, discount,spd.currency, daily_counter, daily_limit
														 FROM tbl_sponsorer sp 
														 JOIN tbl_sponsored spd ON sp.id = spd.sponsor_id 
													
														 WHERE spd.id='$input_id'";// and `validity`<>'invalid'"; //id will be act  as product id
											
												
												$arr   = mysql_query($sql);
												$posts = array();
												
												if (mysql_num_rows($arr) >= 1) 
												{
													while ($post = mysql_fetch_assoc($arr))
														{
																	$coupon_id            = $post['id'];
																	$sp_img_path          = imageurl($post['sp_img_path'], 'sclogo', 'sp_profile');
														
																	$sp_company           = $post['sp_company'];
																	$sponser_product      = $post['Sponser_product'];
																	$points_per_product   = $post['points_per_product'];
																	
																	$sponsor_id           = $post['sponsor_id'];
																	$product_image        = imageurl($post['product_image'], '', 'product');
																	$valid_until          = $post['valid_until'];
																	$validity             = $post['validity'];
																	$category             = $post['category'];
																	$product_price        = $post['product_price'];
																	$discount             = $post['discount'];
																	
																	$currid               = $post['currency'];
														
														if ($currid != 0 or $currid != null) {
															$curre    = mysql_query("SELECT `currency` FROM `currencies` WHERE `id`=$currid");
															$curr     = mysql_fetch_array($curre);
															$currency = $curr['currency'];
														} else {
															$currency = null;
														}
														
												
														
														
													
																
																$posts[]                      = array(
																	"coupon_id" => $coupon_id,
																	"sp_img_path" => $sp_img_path,
																	"sp_company" => $sp_company,
																	"sponser_product" => $sponser_product,
																	"validity" => $validity,
																	"points_per_product" => $points_per_product,
																	"sponsered_date" => $sponsered_date,
																	"sponsor_id" => $sponsor_id,
																	"product_image" => $product_image,
																	"valid_until" => $valid_until,
																	"category" => $category,
																	"product_price" => $product_price,
																	"discount" => $discount,
																	"currency" => $currency
																	
																);

															
														}
													}
													if(count($posts)>=1){
														$postvalue['responseStatus']  = 200;
														$postvalue['responseMessage'] = "OK";
														$postvalue['posts']           = $posts;
													}else{
														$postvalue['responseStatus']  = 204;
														$postvalue['responseMessage'] = "No Response";
														$postvalue['posts']           = null;			
													}
											 }	
											
			} else {
						$postvalue['responseStatus']  = 204;
						$postvalue['responseMessage'] = "Invalid Params";
						$postvalue['posts']           = null;
												}
											
										
				
				
			
      				
    		
	
  					/* output in necessary format */
  					
  					if($format == 'json') {
    					header('Content-type: application/json');
    					 echo json_encode($postvalue);
  					}
 				 else {
   				 		header('Content-type: text/xml');
    					echo '';
   					 	foreach($posts as $index => $post) {
     						 if(is_array($post)) {
       							 foreach($post as $key => $value) {
        							  echo '<',$key,'>';
          								if(is_array($value)) {
            								foreach($value as $tag => $val) {
              								echo '<',$tag,'>',htmlentities($val),'</',$tag,'>';
            											}
         									}
         							  echo '</',$key,'>';
        						}
      						}
    				}
   			 echo '';
 				 }
		}
	else
			{
			 $postvalue['responseStatus']=1000;
				$postvalue['responseMessage']="Invalid Input";
				$postvalue['posts']=null;
			  
			  header('Content-type: application/json');
   			  echo  json_encode($postvalue); 
			}	
			
			
			
 
  /* disconnect from the db */
  @mysql_close($link);	
	
		
  ?>
