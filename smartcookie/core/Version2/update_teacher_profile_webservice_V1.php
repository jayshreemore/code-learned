<?php  
//$json=$_GET ['json'];
$json = file_get_contents('php://input');
$obj = json_decode($json);
 $format = 'json'; //xml is the default

include 'conn.php';
  
  $key = $obj->{'key'};
  
 if($key!='' )
{
  
			if($obj->{'key'}=='Email')
			  {
				  $nik ="select id from `tbl_teacher` where t_email = '".$obj->{'User_email'}."'";
					$arr = mysql_query($nik);
			  }
		    if($obj->{'key'}=='member-id')
			  {
					$arr = mysql_query("select id from `tbl_teacher` where id = '".$obj->{'User_Meid'}."'");
			  }
		    if($obj->{'key'}=='phone-number')
			  {
					$arr = mysql_query("select id from `tbl_teacher` where 	User_Phone = '".$obj->{'User_Phone'}."' and CountryCode= '".$obj->{'CountryCode'}."'");
			  }
	        if($obj->{'key'}=='employee-id')
		      {
				$arr = mysql_query("select id from `tbl_teacher` where t_id = '".$obj->{'employee_id'}."' and  school_id= '".$obj->{'school_id'}."'");
		      }
  $count = mysql_num_rows($arr);
  $row = mysql_fetch_array($arr);
  
  
  if($count == 1)
  {

	$id = $row['id'];
    if($obj->{'User_imagebase64'}!='' and $obj->{'User_Image'}!='')
		{
			 $sc_id= $obj->{'school_id'};
  
			  $imageDataEncoded=$obj->{'User_imagebase64'};
			  $image = $obj->{'User_Image'};
  
				$filename = $_FILES['filUpload']['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
					$img= $_FILES['filUpload']['name'];
						$ex_img = explode(".",$image);
						 $img_name = $ex_img[0].".".$ex_img[1];
				 
						$year=date('Y');
						$entity="Teacher";
						$start_dir="Images";
						$full_name_path=$start_dir.'/'.$sc_id.'/'.$entity.'/'.$sc_id.'_';
						if(!file_exists($full_name_path))
						{
							mkdir($full_name_path, 0777, true);
						}
					
					$filenm=$full_name_path.$img_name;
				 
					move_uploaded_file($_FILES['filUpload']['tmp_name'],$filenm);				
			  $imageData = base64_decode($imageDataEncoded);
			  $source = imagecreatefromstring($imageData);
			$imageSave = imagejpeg($source,$imageName,100);
  }


  if($obj->{'key'}=='Email')
	  {
			$test = mysql_query("update `tbl_teacher` set t_complete_name = '".$obj->{'User_Complete_Name'}."', t_name ='".$obj->{'User_FName'}."',t_lastname ='".$obj->{'User_LName'}."', t_dob = '".$obj->{'User_dob'}."', t_address = '".$obj->{'User_address'}."', t_city = '".$obj->{'User_city'}."', t_country = '".$obj->{'User_country'}."',state = '".$obj->{'state'}."', t_gender = '".$obj->{'User_gender'}."',t_pc = '$filenm',	t_phone = '".$obj->{'User_Phone'}."', t_password = '".$obj->{'User_password'}."' , CountryCode = '".$obj->{'CountryCode'}."'  where t_email = '".$obj->{'User_email'}."'");
	  }
  if($obj->{'key'}=='member-id')
	  {
			$test = mysql_query("update `tbl_teacher` set t_complete_name = '".$obj->{'User_Complete_Name'}."', t_name ='".$obj->{'User_FName'}."',t_lastname ='".$obj->{'User_LName'}."', t_dob = '".$obj->{'User_dob'}."', t_address = '".$obj->{'User_address'}."', t_city = '".$obj->{'User_city'}."', t_country = '".$obj->{'User_country'}."',state = '".$obj->{'state'}."', t_gender = '".$obj->{'User_gender'}."',t_pc = '$filenm',	t_phone = '".$obj->{'User_Phone'}."', t_password = '".$obj->{'User_password'}."' , CountryCode = '".$obj->{'CountryCode'}."' where id = '".$obj->{'User_Meid'}."'");
	  }
  if($obj->{'key'}=='phone-number')
	  {
			$test = mysql_query("update `tbl_teacher` set t_complete_name = '".$obj->{'User_Complete_Name'}."', t_name ='".$obj->{'User_FName'}."',t_lastname ='".$obj->{'User_LName'}."', t_dob = '".$obj->{'User_dob'}."', t_address = '".$obj->{'User_address'}."', t_city = '".$obj->{'User_city'}."', t_country = '".$obj->{'User_country'}."',state = '".$obj->{'state'}."', t_gender = '".$obj->{'User_gender'}."',t_pc = '$filenm',	t_phone = '".$obj->{'User_Phone'}."', t_password = '".$obj->{'User_password'}."' where 	t_phone = '".$obj->{'User_Phone'}."' , CountryCode = '".$obj->{'CountryCode'}."'  and CountryCode= '".$obj->{'CountryCode'}."'");
	  }
  if($obj->{'key'}=='employee-id')
	  {
			$test = mysql_query("update `tbl_teacher` set t_complete_name = '".$obj->{'User_Complete_Name'}."', t_name ='".$obj->{'User_FName'}."',t_lastname ='".$obj->{'User_LName'}."', t_dob = '".$obj->{'User_dob'}."', t_address = '".$obj->{'User_address'}."', t_city = '".$obj->{'User_city'}."', t_country = '".$obj->{'User_country'}."',state = '".$obj->{'state'}."', t_gender = '".$obj->{'User_gender'}."',t_pc = '$filenm',	t_phone = '".$obj->{'User_Phone'}."', t_password = '".$obj->{'User_password'}."', CountryCode = '".$obj->{'CountryCode'}."'  where t_id = '".$obj->{'employee_id'}."' and  school_id= '".$obj->{'school_id'}."'");
	  }
  
  if($key!='' )
{
  
  if($obj->{'key'}=='Email')
	  {
		  $nik ="select * from `tbl_teacher` where t_email = '".$obj->{'User_email'}."'";
			$arr = mysql_query($nik);
	  }
  if($obj->{'key'}=='member-id')
	  {
			$arr = mysql_query("select * from `tbl_teacher` where id = '".$obj->{'User_Meid'}."'");
	  }
  if($obj->{'key'}=='phone-number')
	  {
			$arr = mysql_query("select * from `tbl_teacher` where 	User_Phone = '".$obj->{'User_Phone'}."' and CountryCode= '".$obj->{'CountryCode'}."'");
	  }
  if($obj->{'key'}=='employee-id')
	  {
			$arr = mysql_query("select * from `tbl_teacher` where t_id = '".$obj->{'employee_id'}."' and  school_id= '".$obj->{'school_id'}."'");
	  }
$row = mysql_fetch_array($arr);

mysql_close($con);
//$posts[]="successfully updated";
$data=array(
"User_Meid"=>$row['id'],
"User_Complete_Name"=>$row['t_complete_name'],
"User_FName"=>$row['t_name'],
"User_LName"=>$row['t_lastname'],
"User_address"=>$row['t_address'],
"User_dob"=>$row['t_dob'],
"User_city"=>$row['t_city'],
"User_country"=>$row['t_country'],
"state"=>$row['state'],
"User_Phone"=>$row['t_phone'],
"User_password"=>$row['t_password'],
"CountryCode"=>$row['CountryCode'],
"User_email"=>$row['t_email'],
"User_Image_Path"=>$row['t_pc'],
"User_Image_Name"=>$obj->{'User_Image'}

);
$posts[]= $data;
$postvalue['responseStatus']=200;
				$postvalue['responseMessage']="OK"; 
				$postvalue['posts']=$posts;

}
  }
  
}
  else
  {
  	$postvalue['responseStatus']=204;
				$postvalue['responseMessage']="No Response";
				$postvalue['posts']=null;
  }
  //
  //$posts = array($json);
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
  
	@mysql_close($con);
	
	
	
		
  ?>