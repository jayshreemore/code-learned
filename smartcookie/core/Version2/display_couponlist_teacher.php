<?php  
//$json=$_GET ['json'];
$json = file_get_contents('php://input');
$obj = json_decode($json);

 $format = 'json'; //xml is the default

include 'conn.php';

 $teacherid=$obj->{'teacherid'};
  
	if( $teacherid != "" )
		{
			//retrive info from tbl_sponsored
			//echo "select id,amount,coupon_id,status from tbl_teacher_coupon where user_id= '$teacherid' ORDER BY id desc";die;
			 $arr=mysql_query("select id,amount,coupon_id,status,issue_date,validity_date from tbl_teacher_coupon where user_id= '$teacherid' ORDER BY id desc");
			
  				/* create one master array of the records */
  			$posts = array();
  			if(mysql_num_rows($arr)>=1) {
    			while($post = mysql_fetch_array($arr)) {
					$status=$post['status'];
					if($status=="p")
					{
						$status="Partially Used";
					}
					if($status=="unused")
					{
						$status="Unused";
					}
					
      				$posts[] = array('coupon_point'=>$post['amount'],'coupon_id'=>$post['coupon_id'],'status'=>$status,'issue_date'=>$post['issue_date'],'validity_date'=>$post['validity_date']);
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
