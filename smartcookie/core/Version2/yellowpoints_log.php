<?php  
//$json=$_GET ['json'];
$json = file_get_contents('php://input');
$obj = json_decode($json);

 $format = 'json'; //xml is the default


include 'conn.php';

  $std_PRN=$obj->{'std_PRN'};
 
 
	if( $std_PRN !="" )
		{
			//retrive info from  tbl_accept_coupon
			
		 $sql="select s.std_PRN,s.std_name,s.std_lastname,s.std_complete_name,sp.sc_point,sp.reason,sp.point_date from tbl_student_point sp join tbl_student s where sp.sc_stud_id=s.std_PRN and sp.sc_entites_id='105' and sp.sc_teacher_id='$std_PRN' order by sp.id desc";
 			 $arr = mysql_query($sql);
  			$count=mysql_num_rows($arr);
  				/* create one master array of the records */
  			$posts = array();
  			if($count>=1) 
			{
    			while($post = mysql_fetch_assoc($arr))
				{
					$std_complete_name=ucwords(strtolower($post['std_complete_name']));
					$points=$post['sc_point'];
					$reason=$post['reason'];
					$date=$post['point_date'];
      				if($std_complete_name=="")
						{
							$std_complete_name=ucwords(strtolower($post['std_name']))." ".ucwords(strtolower($post['std_lastname']));
						}
      				$posts[] = array('std_name'=>$std_complete_name,'points'=>$points,'reason'=>$reason,'date'=>$date);
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
						//	echo '';
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
  
 