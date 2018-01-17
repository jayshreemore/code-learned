<?php  
//$json=$_GET ['json'];
$json = file_get_contents('php://input');
$obj = json_decode($json);

 $format = 'json'; //xml is the default



include 'conn.php';




// wheen you test the webservice on local//

 



//at a time only one path select

//input from user
	
	$t_id=$obj->{'t_id'};
	$sc_id=$obj->{'school_id'};
	
	
	
	


 
	if( $t_id != "" && $sc_id!="" )
		{
	
	$arr=mysql_query("select st.comment,st.sc_point,s.std_name,s.std_complete_name,st.point_date,IF(st.activity_type =  'subject', (SELECT subject from tbl_school_subject where Subject_Code=sc_studentpointlist_id and school_id='$sc_id' limit 1),	(SELECT sc_list FROM tbl_studentpointslist WHERE sc_id = sc_studentpointlist_id and school_id='$sc_id' limit 1 ) )	AS reason from tbl_student_point st  join tbl_student s on  s.std_PRN=st.sc_stud_id where st.sc_teacher_id='$t_id' and st.sc_entites_id='103' and s.school_id='$sc_id' ORDER BY st.id DESC limit 20 ");
 			
  
  				/* create one master array of the records */
  		
  			if(mysql_num_rows($arr)>=1) {
    			while($post = mysql_fetch_assoc($arr)) {
					
						$points=(int)$post['sc_point'];
						$std_name=$post['std_complete_name'];
						$point_date=$post['point_date'];
						$reason=$post['reason'];						$comment=$post['comment'];
						
      				   $posts[] =array('points'=>$points,'std_name'=>$std_name,'point_date'=>$point_date,'reason'=>$reason,'comment'=>$comment);
    			}
				
				$postvalue['responseStatus']=200;
				$postvalue['responseMessage']="OK";
				$postvalue['posts']=$posts;
  			}
  			else
  				{$postvalue['responseStatus']=204;
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

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
 
	