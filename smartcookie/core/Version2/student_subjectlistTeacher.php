<?php  
//$json=$_GET ['json'];
$json = file_get_contents('php://input');
$obj = json_decode($json);

 $format = 'json'; 

include 'conn.php';

//input from user
    $std_PRN=$obj->{'std_PRN'};
	$school_id=$obj->{'school_id'};


	
	
    if($std_PRN!="" && $school_id!="" )
	{
			//retrive info from tbl_school_subject
				 $arr = mysql_query("SELECT subjcet_code, subjectName,Semester_id,Branches_id,teacher_ID,AcademicYear  FROM tbl_student_subject_master sm JOIN tbl_academic_Year a ON sm.AcademicYear = a.Year
WHERE student_id = '$std_PRN' AND sm.school_id = '$school_id' AND Enable = '1' AND a.school_id = '$school_id'");
  
  				/* create one master array of the records */
  			$posts = array();
  			if(mysql_num_rows($arr)>=1) {
    			while($post = mysql_fetch_assoc($arr)) {
					$subjcet_code=$post['subjcet_code'];
					$subjectName=$post['subjectName'];
					$teacher_id= $post['teacher_ID'];
					$semesterName=$post['Semester_id'];
					$Year=$post['AcademicYear'];
$query=mysql_query("select id,t_pc,t_name,t_middlename,t_lastname from tbl_teacher where t_id='$teacher_id'");

$test=mysql_fetch_array($query);
$teacher_name=$test['t_name']." ".$test['t_middlename']." ".$test['t_lastname'];
$teacher_image=$test['t_pc'];
						
				
					$posts[] = array(
					'SubjectCode'=>$subjcet_code,
					'subjectName'=>$subjectName,
					'teacher_id'=>$teacher_id,
					'teacher_name'=>$teacher_name,
					'teacher_image'=>$teacher_image,
					'semesterName'=>$semesterName,
					'Year'=>$Year);
					
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
