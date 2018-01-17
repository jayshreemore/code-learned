<?php  
//$json=$_GET ['json'];
$json = file_get_contents('php://input');
$obj = json_decode($json);

 $format = 'json'; //xml is the default


include 'conn.php';

//input from user
    $stud_id=$obj->{'stud_id'};
	
	$sql=mysql_query("select std_PRN,school_id from tbl_student where id='$stud_id'");
	$result=mysql_fetch_array($sql);
	$std_PRN=$result['std_PRN'];
	$sc_id=$result['school_id'];

	/* create one master array of the records */
				$posts = array();
	
	//id of student stud_id
	
    if($stud_id!="" )
	{
	
		 $arr = mysql_query("SELECT sc_point, sc_studentpointlist_id, t.t_complete_name , point_date,(select method_name from tbl_method where id=method)as method,activity_type, IF( activity_type =  'subject', (SELECT subject from tbl_school_subject where Subject_Code=sc_studentpointlist_id and school_id='$sc_id' limit 1), (SELECT sc_list FROM tbl_studentpointslist WHERE sc_id = sc_studentpointlist_id and school_id='$sc_id' limit 1) ) AS sc_list FROM tbl_student_point sp JOIN tbl_teacher t ON sc_teacher_id = t.t_id WHERE sp.sc_entites_id =103 AND sp.sc_stud_id ='$std_PRN' ORDER BY sp.id DESC ");
			 
					
				if(mysql_num_rows($arr)>=1) {
					while($post = mysql_fetch_assoc($arr)) {
					$total_point=$post['sc_point'];
					$sc_studentpointlist_id=$post['sc_studentpointlist_id'];
					$t_name=$post['t_complete_name'];
					$Date=$post['point_date'];
					$sc_list=$post['sc_list'];
					$method=$post['method'];
					$activity_type=$post['activity_type'];
					$posts[] = array('total_point'=>$total_point,'sc_studentpointlist_id'=>$sc_studentpointlist_id,'t_name'=>$t_name, 'Date'=>$Date,'method'=>$method,'activity_type'=>$activity_type,'sc_list'=>$sc_list );
	  
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
