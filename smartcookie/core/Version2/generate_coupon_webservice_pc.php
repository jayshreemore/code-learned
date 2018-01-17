<?php  
//$json=$_GET ['json'];
$json = file_get_contents('php://input');
$obj = json_decode($json);
//echo $json;
$format = 'json';
//Save
$cp_stud_id=$obj->{'cp_std_id'};
$cp_point=$obj->{'coupon_point'};

include 'conn.php';


//if student id is not empty
if( $cp_stud_id!= "" )
{
        //retrive total point of student
 	 $arr = mysql_query("select sc_total_point  from  tbl_student_reward where sc_stud_id =$cp_stud_id");
  		$row = mysql_fetch_array($arr);
			
 				$sc_total_point= $row['sc_total_point'];
		     		//check that total point is enough for genrating coupon
  					if($sc_total_point >=$cp_point)
 				 		{
							$arra = mysql_query("SELECT id FROM tbl_coupons ORDER BY id DESC LIMIT 1");
	    					$rows=mysql_fetch_array($arra);
							$cp_id= $rows['id']+1;
							$chars = "0123456789";
	 						$res = "";
    			 			for ($i = 0; $i < 9; $i++) {
     						 $res .= $chars[mt_rand(0, strlen($chars)-1)];     
    							}

        					$cp_id= $cp_id."".$res ;
							
							$cp_gen_date=date('d/m/Y');
						$d=strtotime("+6 Months -1 day");
						$validity=date("d/m/Y",$d);
							
						$posts = array();
							
							mysql_query("insert into tbl_coupons(cp_stud_id,cp_code,amount,cp_gen_date,validity) values('$cp_stud_id','$cp_id','$cp_point', '$cp_gen_date', '$validity')");
					  		//reduce student point after generate coupon
								$sc_total_point = $sc_total_point - $cp_point;
								
						 		//$test="successfully generated coupon";
						 		mysql_query("update tbl_student_reward set sc_total_point='$sc_total_point' where sc_stud_id='$cp_stud_id'");
								
								$c_id = mysql_query("select cp_code, amount , sc_total_point , cp_gen_date, validity from tbl_coupons c join tbl_student_reward s where cp_stud_id = sc_stud_id order by c.id desc");
								$test = mysql_fetch_assoc($c_id);
									$posts[] =array("cp_code"=>$test['cp_code'],"coupon_point"=>$test['amount'],"balance_point"=>$test['sc_total_point'],"cp_gen_date"=>$test['cp_gen_date'] ,"validity"=>$test['validity']);
								
								$postvalue['responseStatus']=200;
				$postvalue['responseMessage']="OK";
				$postvalue['posts']=$posts;
								
								//$test = $c_id_row['cp_code'];
						}
					else
						{
							$postvalue['responseStatus']=204;
				$postvalue['responseMessage']="No Response";
				$postvalue['posts']=null;
						}
						
						if($format == 'json') 
						
						{
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

 
	
	
		
  ?>
