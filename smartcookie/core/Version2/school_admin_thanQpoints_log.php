<?php  
 $json = file_get_contents('php://input');

$obj = json_decode($json);


 $format = 'json';

include 'conn.php';

 $t_id = $obj->{'t_id'};
 $school_id=$obj->{'school_id'};
 
 

if($school_id != "" && $t_id != "" )

		{




	$sql=mysql_query("select t.name,sp.sc_thanqupointlist_id,t.school_id, sp.sc_point,sp.point_date from tbl_teacher_point sp join tbl_school_admin t where sp.assigner_id=t.id and sp.`sc_entities_id`='102' and sp.sc_teacher_id='$t_id' order by sp.id desc");



	$posts = array();
	
  			if(mysql_num_rows($sql)>=1) 
			{
    			while($post = mysql_fetch_array($sql)) {
					
			$std_name=$post['name'];
	$sc_thanqupointlist_id=$post['sc_thanqupointlist_id'];
	$sql_query=mysql_query("select t_list from tbl_thanqyoupointslist where id='$sc_thanqupointlist_id' and school_id='$school_id'");
	$result=mysql_fetch_array($sql_query);
	$reason=ucfirst($result['t_list']);
	
	$points=$post['sc_point'];
	$point_date=$post['point_date'];


    $posts[] = array('name'=>$std_name,'reason'=>$reason,'points'=>$points,'point_date'=>$point_date);
	  
	
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
			?>
 
