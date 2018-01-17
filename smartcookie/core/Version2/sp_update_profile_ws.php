<?php  
/* Array ( [0] => stdClass Object ( [id] => 349 [sp_name] => Sudhir Deshmukh [sp_address] => shivajinagar [sp_city] => Pune [sp_dob] => 10/01/1992 [sp_gender] => male [sp_country] => India [sp_state] => Maharashtra [sp_email] => sudhirp@roseland.com [sp_phone] => 9922449794 [sp_password] => 123 [sp_date] => 08/16/2015 [sp_occupation] => [sp_company] => Sudhirs Shop [sp_website] => www.sudhirdeshmukh.in [sp_img_path] => images/uploaded_logo/SC_51639952c2de0ed6eda1b739a88ae983.png [school_id] => [register_throught] => [lat] => 18.5308 [lon] => 73.8475 [pin] => 411038 [sales_person_id] => 0 [expiry_date] => [amount] => [v_status] => [v_likes] => [v_category] => Food [temp_phone] => [otp_phone] => 1 [temp_email] => [otp_email] => 1 ) )  */

$json = file_get_contents('php://input');
$obj = json_decode($json);
$sp_password=@$obj->{'sp_password'};
//echo $json;
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
		}
//Save
if($obj->{'sp_company'} != '' && $obj->{'sp_address'} != '' && $sp_password!='')
{
	/* sp_id
	sp_company
	sp_occupation
	sp_name
	sp_website
	sp_address
	sp_city
	sp_state
	sp_country
	sp_email
	sp_phone
	sp_img_path	*/
	
	
include 'conn.php';

		$sp_id=@$obj->{'sp_id'};
		$sp_company=mysql_escape_string(@$obj->{'sp_company'});
		$sp_occupation=@$obj->{'sp_occupation'};
		$sp_name=mysql_escape_string(@$obj->{'sp_name'});
		$sp_website=@$obj->{'sp_website'};
		$sp_address=@$obj->{'sp_address'};
		$sp_city=@$obj->{'sp_city'};
		$sp_state=@$obj->{'sp_state'};
		$sp_country=@$obj->{'sp_country'};
		$sp_email=@$obj->{'sp_email'};
		$sp_phone=@$obj->{'sp_phone'};
		
		
		$User_Image=@$obj->{'User_Image'};
		
		

  $img = $obj->{'User_Image'};
  
  
  
 $imageDataEncoded=$obj->{'User_imagebase64'};
 if( $img!="" and $imageDataEncoded!=""){
  $ex_img = explode(".",@$img);
  $img_name = @$ex_img[0]."_".@$sp_id."_".date('mdY').".".@$ex_img[1];
  //$img_name = @$ex_img[0]."_".@$sp_id."_".date('mdY').".png";
  $full_name_path = "Assets/images/sp/profile/".$img_name;
  $imageName = "../../".$full_name_path;
  $imageData = base64_decode($imageDataEncoded); 
 //header('Content-Type: image/png');
  $source = imagecreatefromstring($imageData);  
  
  // $imageSave =   imagepng($source,$imageName,100);
$imageSave = imagejpeg($source,$imageName,100);	
 }else{
	 $img_name='';
 }	

	 if($User_Image!=''){
		 $sql="update tbl_sponsorer set sp_company='$sp_company',sp_password='$sp_password', sp_occupation='$sp_occupation', sp_name='$sp_name',  sp_website='$sp_website', sp_address='$sp_address', sp_city='$sp_city', sp_state='$sp_state', sp_country='$sp_country', sp_email='$sp_email', sp_phone='$sp_phone', sp_img_path='$img_name'
	 where id='$sp_id'"; 
	 }else{
		 $sql="update tbl_sponsorer set sp_company='$sp_company',sp_password='$sp_password', sp_occupation='$sp_occupation', sp_name='$sp_name',  sp_website='$sp_website', sp_address='$sp_address', sp_city='$sp_city', sp_state='$sp_state', sp_country='$sp_country', sp_email='$sp_email', sp_phone='$sp_phone' where id='$sp_id'";  
	 }
	
	 $result=mysql_query($sql)or die(mysql_error());
	  
	  $i=mysql_query("select * from tbl_sponsorer where id='$sp_id'");
	  $posts = array();
	  $posts[]=mysql_fetch_assoc($i);
	  
	              $postvalue['responseStatus']=200;
			$postvalue['responseMessage']="OK";
			$postvalue['posts']=$posts;

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