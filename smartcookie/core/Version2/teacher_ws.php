<?php  
$json = file_get_contents('php://input');
$obj = json_decode($json);
$format = 'json';
$arr="";
$msg="";

$school_id=$obj->{'school_id'};
$teacher_id=$obj->{'t_id'};

include 'conn.php';


if(function_exists($_GET['f'])){
	switch($_GET['f']) {
	case 'teacherMyBranch':
		$arr=$_GET['f']($obj->{'school_id'},$obj->{'t_id'});
		break;
	case 'teacherMySemester':
		$arr=$_GET['f']($obj->{'school_id'},$obj->{'t_id'});
		break;
	case 'teacherMySubjects':
		$arr=$_GET['f']($obj->{'school_id'},$obj->{'t_id'},$obj->{'Division_id'},$obj->{'Semester_id'},$obj->{'Branches_id'},$obj->{'Department_id'},$obj->{'CourseLevel'});
		break;
		
		case 'teacherallsubjects':
		$arr=$_GET['f']($obj->{'school_id'},$obj->{'t_id'},$obj->{'Division_id'},$obj->{'Semester_id'},$obj->{'Branches_id'},$obj->{'Department_id'},$obj->{'CourseLevel'});
		break;
		
		case 'teacherMystudentsforsubject':
		$arr=$_GET['f']($obj->{'school_id'},$obj->{'t_id'},$obj->{'Division_id'},$obj->{'Semester_id'},$obj->{'Branches_id'},$obj->{'Department_id'},
		$obj->{'CourseLevel'},$obj->{'subjcet_code'});
		break;
		
		case 'rewardlog':
		$arr=$_GET['f']($obj->{'school_id'},$obj->{'t_id'});
		break;
		
		case 'teacher_particular_subjectsforstudent':
		$arr=$_GET['f']($obj->{'school_id'},$obj->{'t_id'},$obj->{'std_PRN'});
		break;
		
	}
}

function teacherMyBranch($school_id,$teacher_id){
	$arr=mysql_query("select distinct st.Branches_id from `tbl_teacher_subject_master` st JOIN `tbl_academic_Year` Y ON st.AcademicYear = Y.Year where st.school_id='$school_id' and st.teacher_id='$teacher_id' and Y.Enable = '1'");
	return $arr; 
}
function teacherMySemester($school_id,$teacher_id){
	$arr=mysql_query("select distinct st.Semester_id from `tbl_teacher_subject_master` st JOIN `tbl_academic_Year` Y ON st.AcademicYear = Y.Year where st.school_id='$school_id' and st.teacher_id='$teacher_id' and Y.Enable = '1'");
	return $arr; 	
}
function teacherMySubjects($school_id,$teacher_id,$Division_id,$Semester_id,$Branches_id,$Department_id,$CourseLevel){
		$query="SELECT  distinct st.Branches_id,st.school_id, st.subjcet_code, st.subjectName,st.AcademicYear, st.Division_id, st.Semester_id, st.Department_id, st.CourseLevel
		FROM `tbl_teacher_subject_master` st
	 INNER JOIN tbl_academic_Year Y ON st.AcademicYear = Y.Year
		WHERE st.school_id = '$school_id'
		AND  st.teacher_id = '$teacher_id'
		AND Y.school_id = '$school_id'
		AND Y.Enable = '1'";
		if($Division_id!=""){
			$query .="AND st.Division_id='$Division_id'";
		}
		if($Semester_id!=""){
			$query .="AND st.Semester_id='$Semester_id'";
		}
		if($Branches_id!=""){
			$query .="AND st.Branches_id='$Branches_id'";
		}
		if($Department_id!=""){
			$query .="AND st.Department_id='$Department_id'";
		}
		if($CourseLevel!=""){
			$query .="AND st.CourseLevel='$CourseLevel'";
		}
		$query .="order by st.subjectName";
		//echo $query;die;
		$arr=mysql_query($query);
		return $arr; 
}


function teacherallsubjects($school_id,$teacher_id,$Division_id,$Semester_id,$Branches_id,$Department_id,$CourseLevel){
		$query="SELECT  distinct st.Branches_id,st.school_id, st.subjcet_code, st.subjectName,st.AcademicYear, st.Division_id, st.Semester_id, st.Department_id, st.CourseLevel
		FROM `tbl_teacher_subject_master` st
	 
		WHERE st.school_id = '$school_id'
		AND  st.teacher_id = '$teacher_id'";
		
		if($Division_id!=""){
			$query .="AND st.Division_id='$Division_id'";
		}
		if($Semester_id!=""){
			$query .="AND st.Semester_id='$Semester_id'";
		}
		if($Branches_id!=""){
			$query .="AND st.Branches_id='$Branches_id'";
		}
		if($Department_id!=""){
			$query .="AND st.Department_id='$Department_id'";
		}
		if($CourseLevel!=""){
			$query .="AND st.CourseLevel='$CourseLevel'";
		}
		$query .="order by st.subjectName";
		//echo $query;die;
		$arr=mysql_query($query);
		return $arr; 
}



	//	$arr1=mysql_query("SELECT distinct st.Branches_id,st.`subjectName`,st.subjcet_code,st.Division_id,st.AcademicYear FROM `tbl_teacher_subject_master` st inner join tbl_academic_Year Y on st.AcademicYear=Y.Year    WHERE st.`teacher_id` ='$t_id' and st.school_id='$school_id' and Y.Enable='1' and Y.school_id='$school_id' and st.Semester_id='$Semester_id' and st.CourseLevel='$CourseLevel' and st.Branches_id='$branch_name'");


function teacherMystudentsforsubject($school_id,$teacher_id,$Division_id,$Semester_id,$Branches_id,$Department_id,$CourseLevel,$subject_code)
{
	$arr=mysql_query("SELECT distinct ss.student_id,std_complete_name,std_name,std_lastname,std_img_path FROM tbl_student_subject_master ss left outer  join`tbl_teacher_subject_master` st on ss.`subjcet_code`=st.subjcet_code inner join tbl_academic_Year Y on st.AcademicYear=Y.Year and Y.Enable='1' inner join tbl_semester_master s on s.Semester_Name=st.Semester_id and st.Branches_id=s.Branch_name and s.CourseLevel=st.CourseLevel left outer join tbl_student on std_PRN=ss.student_id  WHERE  ss.school_id='$school_id' and ss.`teacher_id` ='$teacher_id' and ss.Semester_id='$Semester_id'  and ss.Branches_id='$Branches_id' and ss.subjcet_code='$subject_code' and ss.Division_id='$Division_id' order by std_name");

	return $arr; 	
}


function teacher_particular_subjectsforstudent($school_id,$t_id,$std_PRN)
{

$arr=mysql_query("SELECT distinct subjcet_code,subjectName,Semester_id,Branches_id,teacher_ID FROM tbl_student_subject_master sm JOIN tbl_academic_Year a ON sm.AcademicYear = a.Year WHERE sm.student_id ='$std_PRN' AND sm.school_id='$school_id' AND Enable='1' AND sm.teacher_ID='$t_id'");

//$arr=mysql_query("SELECT distinct subjcet_code, subjectName  FROM tbl_student_subject_master sm JOIN tbl_academic_Year a ON sm.AcademicYear = a.Year 
//WHERE  sm.school_id = '$school_id' AND sm.student_id = '$std_PRN' AND Enable = '1' AND sm.teacher_ID='$t_id'");

	return $arr; 	


}


function rewardlog($school_id,$t_id)
{
$arr=mysql_query("select st.sc_point,s.std_complete_name,st.point_date,
						
IF(st.activity_type ='subject', (SELECT subjectName from tbl_teacher_subject_master where subjcet_code=sc_studentpointlist_id and school_id='$school_id' and teacher_id='$t_id'), (SELECT sc_list FROM tbl_studentpointslist WHERE sc_id = sc_studentpointlist_id ) ) AS reason
						 from tbl_student_point st  join tbl_student s on  s.std_PRN=st.sc_stud_id
 where st.sc_teacher_id='$t_id' and st.sc_entites_id='103' and s.school_id='$school_id' ORDER BY st.id DESC");
 
 return $arr;
}

    if($arr)
	{
		$count=mysql_num_rows($arr);
						
  			$posts = array();
  			if(mysql_num_rows($arr)>=1) {
    			while($post = mysql_fetch_assoc($arr)) {
					
      				 $posts[] = $post;
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
  @mysql_close($con);	
	
		
  ?>