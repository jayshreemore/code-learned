<?php

$json = file_get_contents('php://input');
$obj = json_decode($json);


	$subject_key = $obj->{'subject_key'};
	$school_id = $obj->{'school_id'};
	//$Subject_Code = $obj->{'Subject_Code'};
	//$User_pwd = $obj->{'std_pwd'};
	$condition = "";

   $number_of_posts = isset($_GET['num']) ? intval($_GET['num']) : 10; //10 is the default
  $format = 'json';

include 'conn.php';

//

 if(!empty($school_id) && !empty($subject_key))

    /*if((!empty($school_id) && !empty($subject)) || (!empty($school_id) &&!empty($Subject_Code)))*/
	{
		
		$query="SELECT SubjectCode,SubjectTitle,DivisionName,SemesterName,BranchName,DeptName,CourseLevel,Year FROM `Branch_Subject_Division_Year` where school_id='$school_id' and IsEnable='1' and (SubjectCode like '%$subject_key%' or SubjectTitle LIKE '%$subject_key%')";
		
		/*$query="SELECT Subject_Code,subject,Semester_id,Course_Level_PID FROM `tbl_school_subject` where ";
		
		if(!empty($subject) && !empty($Subject_Code))
		{
			
			$query = $query . " subject LIKE '$subject%' and school_id='$school_id' and Subject_Code='$Subject_Code'";	
		}
		elseif(!empty($subject))
		{
			
			$query = $query . " subject LIKE '$subject%' and school_id='$school_id'";	
		}
		elseif(!empty($Subject_Code))
		{
			
			$query = $query . " school_id='$school_id'and Subject_Code='$Subject_Code'";	
		}
*/
		$result = mysql_query($query,$con) or die('Errant query:  '.$query);
		/* create one master array of the records */
		$posts = array();
		if(mysql_num_rows($result)>=1)
		{
			while($post = mysql_fetch_assoc($result))
			{
			$posts[] = $post;

			}
			/*$posts[] = "SELECT Subject_Code,subject,Semester_id,Course_Level_PID FROM `tbl_school_subject` where school_id='$school_id' and (Subject_Code='$Subject_Code' or subject LIKE '$subject%')";*/
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
  /* disconnect from the db */

  		}
	else
			{

			   $postvalue['responseStatus']=1000;
				$postvalue['responseMessage']="Invalid Input";
				$postvalue['posts']=null;

			  header('Content-type: application/json');
   			  echo  json_encode($postvalue);


			}


  @mysql_close($con);

?>