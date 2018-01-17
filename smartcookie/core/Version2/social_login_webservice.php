<?php  

$json = file_get_contents('php://input');
$obj = json_decode($json);$method =$obj->{'method'};         // Android or iOS or Web			  $device_type =$obj->{'device_type'};    // phone or Tab			  $device_details =$obj->{'device_details'};    // version or entire device details			  $platform_OS =$obj->{'platform_OS'};    // OS name			  $ip_add =$obj->{'ip_address'};			  $lat = $obj->{'lat'};			  $long = $obj->{'long'};			  $country_code=$obj->{'country_code'};
include 'conn.php';error_reporting(0);
 include("emailfunction.php");

$User_Email = $obj->{'User_Email'};  
 $date = date('d-m-Y H:i:s');
     $posts = array();
  
 $format = 'json'; 
 
 if($User_Email != "")
		{
   $First_Name = $obj->{'First_Name'};
   $Last_Name = $obj->{'Last_Name'};
   $img = $obj->{'User_Image'};
   $full_name=$First_Name." ".$Last_Name;
	
   $query=mysql_query("select id from tbl_student where std_email='$User_Email'");
   $count=mysql_num_rows($query);
		 
if($count>=1)
{
	
	 $query = "SELECT * FROM tbl_student where std_email='$User_Email'";
  $result = mysql_query($query);
  

  if(mysql_num_rows($result)==1) 
  {
    while($post = mysql_fetch_assoc($result)) 
	{
      $posts[] = $post;	  $std_row_id=$post["id"];	  $sch_id= $post["school_id"];
    }			  				$arr = mysql_query("select  EntityID from `tbl_LoginStatus` where EntityID='$std_row_id' and Entity_type='105'");    		        if(mysql_num_rows($arr)==0)    	        	{						                         $login_details=mysql_query("INSERT INTO `tbl_LoginStatus` (EntityID,Entity_type,FirstLoginTime,FirstMethod,FirstDeviceDetails,                                FirstPlatformOS,FirstIPAddress,FirstLatitude,FirstLongitude,LatestLoginTime,LatestMethod,LatestDeviceDetails,LatestPlatformOS,LatestIPAddress,LatestLatitude,                                                LatestLongitude,CountryCode,school_id)                                            values ('$std_row_id','105','$date','$method','$device_details','$platform_OS',											'$ip_add','$lat','$long','$date',                                            '$method','$device_details','$platform_OS','$ip_add','$lat','$long',											'$country_code','$sch_id')");                    }                    else{                                $test = mysql_query("update `tbl_LoginStatus` set `LatestLoginTime` = '$date',LatestMethod='$method',                                LatestDeviceDetails='$device_details',LatestPlatformOS='$platform_OS',LatestIPAddress='$ip_add',LatestLatitude='$lat',LatestLongitude='$long',CountryCode='$country_co'								,school_id='$sch_id',LogoutTime=''                                  where EntityID='$std_row_id' and Entity_type='105'");                    }
	
   }
}
else
{
	
	$User_Type=$obj->{'UserType'};
	$fb_id=$obj->{'fb_id'};
	$gplus_id=$obj->{'gplus_id'};
	$linkedin_id=$obj->{'linkedin_id'};
	
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
 $password = substr( str_shuffle( $chars ), 0, 8 );
 
	$test = mysql_query("INSERT INTO `tbl_student` 
	(std_name,std_lastname,std_complete_name,std_img_path,std_email,std_password,fb_id,gplus_id,linkedin_id) 
	VALUES('$First_Name','$Last_Name','$full_name','$img','$User_Email','$password','$fb_id','$gplus_id','$linkedin_id')");
	
	$arr1 = mysql_query("SELECT * FROM tbl_student where std_email='$User_Email' order by id desc");
$row1 = mysql_fetch_array($arr1);
$memberid = $row1['id'];
	
	
	 $emailfunction=new emailfunction();
	$to=$User_Email;
	  $type="Student";
		$results=$emailfunction->registrationemail($to,$password,$type);

	
	 $imageDataEncoded=$obj->{'User_imagebase64'};
   $ex_img = explode(".",$img);
  $img_name = $ex_img[0]."_".$id."_".date('mdY');
  $full_name_path = "image/".$img_name.".".$ex_img[1];
  $imageName = "../".$full_name_path;
  $imageData = base64_decode($imageDataEncoded);
  $source = imagecreatefromstring($imageData);
  $imageSave = imagejpeg($source,$imageName,100);
  
  mysql_query("update `tbl_student` set std_img_path = '$full_name_path' where id = $memberid");
  
	
		 $query = "SELECT * FROM tbl_student where std_email='$User_Email' order by id desc";
  $result = mysql_query($query);
  /* create one master array of the records */
  
  if(mysql_num_rows($result)==1) 
  {
    while($post = mysql_fetch_assoc($result)) 
	{
      $posts[] = $post;	  $std_row_id=$post["id"];	  $sch_id= $post["school_id"];
    }	$arr = mysql_query("select  EntityID from `tbl_LoginStatus` where EntityID='$std_row_id' and Entity_type='105'");    		        if(mysql_num_rows($arr)==0)    	        	{                         $login_details=mysql_query("INSERT INTO `tbl_LoginStatus` (EntityID,Entity_type,FirstLoginTime,FirstMethod,FirstDeviceDetails,                                                             FirstPlatformOS,FirstIPAddress,FirstLatitude,                                            FirstLongitude,LatestLoginTime,LatestMethod,LatestDeviceDetails,LatestPlatformOS,LatestIPAddress,LatestLatitude,                                                LatestLongitude,CountryCode,school_id)                                            values ('$std_row_id','105','$date','$method','$device_details','$platform_OS','$ip_add','$lat','$long','$date',                                            '$method','$device_details','$platform_OS','$ip_add','$lat','$long',											'$country_code','$sch_id')");                    }                    else{                                $test = mysql_query("update `tbl_LoginStatus` set `LatestLoginTime` = '$date',LatestMethod='$method',                                LatestDeviceDetails='$device_details',LatestPlatformOS='$platform_OS',LatestIPAddress='$ip_add',LatestLatitude='$lat',LatestLongitude='$long',CountryCode='$country_co'								,school_id='$sch_id',LogoutTime=''                                  where EntityID='$std_row_id' and Entity_type='105'");                    }
	
   }
 
	
	
	
	
}


 
  
	
	$postvalue['responseStatus']=200;
				$postvalue['responseMessage']="OK";
				$postvalue['posts']=$posts;
				
				
  
 
  /* output in necessary format */
  if($format == 'json') {
   					 header('Content-type: application/json');
   					 echo json_encode($postvalue);
  }

  /* disconnect from the db */
  
  		}
	else
			{
			
			$postvalue['responseStatus']=1000;
				$postvalue['responseMessage']="Invalid Input";
				$postvalue['posts']=null;
			  
			  header('Content-type: application/json');
   			  echo  json_encode($postvalue); 
			  
			
			}
  
  
  @mysql_close($con);

?>