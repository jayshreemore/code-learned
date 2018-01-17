<?php 


  $id=$_SESSION['id'];
include 'coupon.inc.php';

	$likes=0;

	$msg="";

	$name="";

	$v_category="";

	$phone_number="";

	$email="";

	$vendor_address="";	

	$sp_state="";

	$sp_country="";

	$sp_city="";

	
$server_name = $_SERVER['SERVER_NAME'];
	

	if(isset($_POST['submit'])){ 

	$name=trim(strip_tags($_POST['name']));

	$v_category=trim(strip_tags($_POST['product_type']));

	$phone_number=trim(strip_tags($_POST['phone_number']));

	$email=trim(strip_tags($_POST['email']));

	$vendor_address=trim(strip_tags($_POST['vendor_address']));

	$sp_state=trim(strip_tags($_POST['sp_state']));

	$sp_country=trim(strip_tags($_POST['sp_country']));

	$sp_city=trim(strip_tags($_POST['sp_city']));

	
	
	
	
	
	
	
	
	
	
   $calculated_json =file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$vendor_address&sensor=false&region=$region");
   $calculated_json = json_decode($calculated_json);

   $calculated_lat = $calculated_json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
   $calculated_lon = $calculated_json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
	
	
	
	if($vendor_address !='' && $sp_city !='' && $sp_state!='' && $sp_country!='')
  {

$geocode_selected=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.urlencode($vendor_address.", ".$sp_city.", ".$sp_state.", ".$sp_country).'&sensor=false');
$output_selected= json_decode($geocode_selected);

$lat = $output_selected->results[0]->geometry->location->lat;
$lon = $output_selected->results[0]->geometry->location->lng;	
}
	
	

	/*$data= new data();

	$latlong=$data->calLatLongByAddress($sp_country, $sp_state, $sp_city);
	//$latlong=calLatLongByAddress($sp_country, $sp_state, $sp_city);

	$lat=$latlong[0];
	$lon=$latlong[1];*/
 //$date=date("Y/m/d");
  $date = date('Y/m/d H:i:s');
	

$check_ex = mysql_query("select c.country_id from tbl_city c join tbl_state s on s.state_id=c.state_id join tbl_country con on con.country_id=c.country_id where con.country='$sp_country' and s.state='$sp_state' and c.sub_district='$sp_city'");

$rows=mysql_num_rows($check_ex);



$v_status='Inactive';



if(!empty($name)&&!empty($v_category)&&!empty($phone_number)&&!empty($vendor_address ) && ($rows>=1) ){



 $chkexi=mysql_query("select DISTINCT `id` from `tbl_vendor_suggested` where `sp_company`=\"$name\" and `v_category`=\"$v_category\" and `sp_phone`=\"$phone_number\" and `sp_email`=\"$email\" and ((`sp_address`=\"$vendor_address\" and `sp_city`='$sp_city' and `sp_state`='$sp_state' and `sp_country`='$sp_country') or(`lat`='$lat' and `lon`='$lon'  ) )  ");





if(mysql_affected_rows() > 0){

	$msg="<span style='color:red;'>".'Already suggested'."</span>";

}else{ 

$likes+=1;				
 // echo "INSERT INTO `tbl_sponsorer`(`id`, `sp_name`, `v_category`, `sp_phone`, `sp_email`, `sp_address`, `v_status`, `v_likes`,`sp_city`,`sp_state`,`sp_country`,`lat`,`lon`,`entity_id`,`user_memeber_id`) VALUES (NULL, \"$name\", \"$v_category\", \"$phone_number\", \"$email\", \"$vendor_address\", \"$v_status\", \"$likes\", \"$sp_city\",\"$sp_state\",\"$sp_country\",\"$lat\",\"$lon\",103,\"$id\");
$insert = mysql_query("INSERT INTO `tbl_sponsorer`(`id`,`sp_company`,`sp_name`, `v_category`, `sp_phone`, `sp_email`, `sp_address`, `v_status`, `v_likes`,`sp_city`,`sp_state`,`sp_country`,`lat`,`lon`,`entity_id`,`user_member_id`,`platform_source`,`calculated_lat`,`calculated_lon`,`sp_date`,`sales_p_lat`,`sales_p_lon`) VALUES (NULL,'$name', \"$name\", \"$v_category\", \"$phone_number\", \"$email\", \"$vendor_address\", \"$v_status\", \"$likes\", \"$sp_city\",\"$sp_state\",\"$sp_country\",\"$lat\",\"$lon\",103,'$id','Teacher Web',\"$calculated_lat\",\"$calculated_lon\",'$date','$lat','$lon')");


//new webservice call for master action log
$sq=mysql_query("select t_id,t_complete_name from tbl_teacher where id='$id'");
	$rows=mysql_fetch_assoc($sq);
	$uname=$rows['t_complete_name'];
	$id=$rows['id'];

$data = array('Action_Description'=>'suggest sponsor',
												'Actor_Mem_ID'=>$id,
												'Actor_Name'=>$uname,
												'Actor_Entity_Type'=>103,
												'Second_Receiver_Mem_Id'=>'',
												'Second_Party_Receiver_Name'=>'cookie Admin',
												'Second_Party_Entity_Type'=>113,
												'Third_Party_Name'=>'',
												'Third_Party_Entity_Type'=>'',
												'Coupon_ID'=>'',
												'Points'=>'',
												'Product'=>'',
												'Value'=>'',
												'Currency'=>''
							);
							
							$ch = curl_init("http://$server_name/core/Version2/master_action_log_ws.php"); 	
							
							
							$data_string = json_encode($data);    
							curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");    
							curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);  
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);      
							curl_setopt($ch, CURLOPT_HTTPHEADER, array('ContentType: application/json','ContentLength: ' . strlen($data_string)));
							$result = json_decode(curl_exec($ch),true);


///end 
if($insert)
{
	$suggested=mysql_query("select * from tbl_sponsorer where user_member_id='$id'");
	//echo"select * from tbl_sponsorer where user_member_id='$id'"
	while($row1=mysql_fetch_assoc($suggested))
	{
	 $sponser_id=$row1['id'];
	}
	 	
	$sugg_sponsor='suggested_sponsor';
	$receiver_entity_id=108;
	$sender_entity_id=103;
	$data = array('request_status'=>$sugg_sponsor,
	'sender_entity_id'=>$sender_entity_id,
	'receiver_entity_id'=>$receiver_entity_id,
	'sender_member_id'=>$id,
	 'receiver_member_id'=>$sponser_id,
	 'receiver_employee_id'=>$sponser_id );	
	//echo var_dump($data)."<br>";
	 //echo"teacher_id";
	 //echo"t_id";
					$ch = curl_init("http://$server_name/core/Version2/assign_promotion_points.php"); 						
					$data_string = json_encode($data);      
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     						
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  						
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      						
					curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                        							
					'Content-Type: application/json',                                                                                							
					'Content-Length: ' . strlen($data_string))                                                                					
					); 						
					$result = json_decode(curl_exec($ch),true);						
					//var_dump($result);					
					echo $responce = $result["responseStatus"];						
					//echo '2';											
					if($responce==200)					
						{							
					echo "<script>alert('You Get Point For suggested Sponsor');location.assign('http://$server_name/core/vendor_new_suggest.php');
					</script>";	
					}					
	//echo "78654";
	
}
//echo"INSERT INTO `tbl_sponsorer`(`id`, `sp_company`, `v_category`, `sp_phone`, `sp_email`, `sp_address`, `v_status`, `v_likes`,`sp_city`,`sp_state`,`sp_country`,`lat`,`lon`) VALUES (NULL, \"$name\", \"$v_category\", \"$phone_number\", \"$email\", \"$vendor_address\", \"$v_status\", \"$likes\", \"$sp_city\",\"$sp_state\",\"$sp_country\",\"$lat\",\"$lon\") ";


$ins_like=mysql_query("insert into tbl_like_status (id,from_entity,from_user_id,to_entity,to_user_id,active_status) values(null,'$entity','$user_id','4','$likes','0')");

		$count1 = mysql_affected_rows();

		

		if( $count1  >= 1 and $insert and $ins_like){

			

			$msg="<script>alert('Suggested Successfully');</script>";

			

			header("Refresh:1; url=vendor_suggested_like.php");	



		}else{ 

		

		$msg="<span style='color:red;'>".'Error: Please Try Again Later'."</span>"; 

		

		}

					

		}



}else{ $msg="<span style='color:red;'>".'Please Fill In The Blanks.'."</span>"; }





	}
	
	
	
	/*///webservice call
	$request_status = $obj->{'request_status'};
	$sender_entity_id = $obj->{'sender_entity_id'};
	$receiver_entity_id = $obj->{'receiver_entity_id'};
	$sender_member_id = $obj->{'sender_member_id'};
	$receiver_member_id = $obj->{'receiver_member_id'};
	$receiver_employee_id = $obj->{'receiver_employee_id'};
	*/
	

?>



<script>

	   function valid()  

       {	var regx1=new RegExp('/^[A-z ]+$/');

			var regx2=new RegExp('/^[0-9]+$/');

			
			
		   var phone_number=document.getElementById("phone_number").value; 
			
			//var phone_number=document.getElementById("phone_number").value;
			

			

			/*if(!regx2.test(phone_number) || phone_number.length < 8){

				document.getElementById('errorphone_number').innerHTML='Please enter valid phone Number';

				return false;

		   }

		   else

			{

				document.getElementById('errorphone_number').innerHTML="";

			}
			*/
			
			if ( phone_number.length >10 )
			{
				document.getElementById('errorphone_number').innerHTML='Please enter valid phone Number';
       return false;	
			}
			
			
			
			if(phone_number.length <10)
			{  
			document.getElementById('errorphone_number').innerHTML='Please enter valid phone Number';
       return false;
			}



			var vendor_name=document.getElementById("name").value; 
			
			

		   if(vendor_name.trim()==null||vendor_name.trim()=="") 

		   {

				document.getElementById('errorname').innerHTML='Enter Sponsor Name';				

				return false;

			}else{

				document.getElementById('errorname').innerHTML="";

			}

			



			

			var vendor_address=document.getElementById("vendor_address").value;

			 if (vendor_address.trim()== null || vendor_address.trim() == "")

			{

		      

				document.getElementById('errorvendor_address').innerHTML='Please enter Sponsor Address';

				return false;

			}

			

			var product_type=document.getElementById("product_type").value;

			 if (product_type.trim()== null || product_type.trim() == "")

			{

		      

				document.getElementById('errorproduct_type').innerHTML='Please enter Category';

				return false;

			}else{

				document.getElementById('errorproduct_type').innerHTML='';

			}

			

		





 }

</script>

<?php include 'country_state_city.inc.php'; ?>





	 <div class="container">  

                  <div class="row"> 

                  <div class="col-md-12">                

                      <div class="midd_form">

                      

                       <div class="col-sm-12">

                       <h1 class="htxt1">Suggest New Sponsor</h1>

                      

                       </div>

                       <form class="form" method="post">

                       <div class="col-sm-6">                      

                      
                           


                           <div class="form-group">

                            <label for="name">Sponsor Name : <span color='red'><sub style="color:red;font-size:30px;">*</sub></span> </label>

                            <input type="text" class="form-control" id="name" name="name" value="<?=$name;?>">

							<div  id="errorname" style="color:#FF0000" align="center"></div>

						  </div>

      

						  <div class="form-group" >

                            <label for="product_type">Sponsor Category / Type :<span style="color:red;font-size:30px;"><sub>*</sub></span> </label>

                           

					      <select class="form-control " id="cat" name="product_type" placeholder="Select By Category">  

                         <option >Select Category</option>

					<?php $catfromtbl=mysql_query("SELECT * FROM `categories`"); 

						while($cats=mysql_fetch_array($catfromtbl)){

							$cat_id=$cats['id'];

							$cat_cat=$cats['category'];

					?>

                         

                     <option value="<?php echo $cat_id; ?>" <?php if($cat_id==$v_category){ echo 'selected'; }?>><?php echo $cat_cat; ?></option>

						<?php } ?> 

						</select>

							

							<div  id="errorproduct_type" style="color:#FF0000" align="center"></div>

                          </div>

						  

						<div class="form-group">

                            <label for="phone_number">Phone Number :</label>

                            <input type="number" class="form-control" id="phone_number" name="phone_number" minlength='8' maxlength='15' placeholder="Phone Number" value="<?=$phone_number;?>" required='required'/>

							<div  id="errorphone_number" style="color:#FF0000" align="center"></div>

						 </div>

                          <div class="form-group">

                            <label for="email">Email ID : </label>

                            <input type="email" class="form-control" name="email" id="email"  value="<?=$email;?>" placeholder="Email ID ( Not mandatory)">

                         <div  id="erroremail" style="color:#FF0000" align="center"></div>

						 </div>

                          

							    						  

                          </div>

                          <!-- right side start -->

						 

                          <div class="col-md-6">

						  <div class="row"><div class="col-md-12"><label>Sponsor Address:<span style="color:red;font-size:30px;"><sub>*</sub></span></label></div></div>

						

						<?php include 'country_state_city.form.inc.php';?>

						

						<div class="form-group">

                           <textarea class="form-control" rows="3" name="vendor_address" id="vendor_address" placeholder="Sponsor Address"  value="<?=$vendor_address;?>"></textarea>

                          <div  id="errorvendor_address" style="color:#FF0000" align="center"></div>

						  </div> 



                         

						  

                           <div class="col-md-12" style="padding-top:10px;">

							<div class="row"><?php if(isset($_POST['submit'])){ ?>

							<div class="form-group alert alert-warning" role="alert"><?php echo $msg; ?></div><?php } ?></div>

                        <input type="Submit" name="submit" class="btn btn-success" onClick="return valid()" value="SUGGEST"/> 

                            <a href="student_dashboard.php"> <button type="reset" class="btn btn-danger">CANCEL</button></a> 

                           </div> 

 </div>  						   

                        </form>  

                        

                        <div class="clearfix"></div>        

                      </div>   

                  </div>

           </div>

       </div>