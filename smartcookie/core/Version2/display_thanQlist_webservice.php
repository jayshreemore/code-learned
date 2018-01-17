<?php  

$json = file_get_contents('php://input');
$obj = json_decode($json);

 $format = 'json'; //xml is the default

include 'conn.php';

 $school_id=$obj->{'school_id'};
 
	if($school_id != "")
		{
			//retrive info from  tbl_accept_coupon
			
			
		 $sql= "SELECT id,t_list FROM tbl_thanqyoupointslist  WHERE school_id= '$school_id'  ORDER BY id";
 			 $arr = mysql_query($sql);
  
  				/* create one master array of the records */
  			$posts = array();
  			if(mysql_num_rows($arr)>=1) {
    			while($post = mysql_fetch_assoc($arr)) {
					
					$id=$post['id'];
					$t_list=$post['t_list'];
					$posts[] = array('id'=>$id,'t_list'=>$t_list);
					
						$postvalue['responseStatus']=200;
				$postvalue['responseMessage']="OK";
				$postvalue['posts']=$posts;
      				
    			}
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


































