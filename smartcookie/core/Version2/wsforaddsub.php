<?php

 $json = file_get_contents('php://input');
$obj = json_decode($json);
    error_reporting(0);
    $SubjectCode = $obj->{'Subject_Code'};
	$school_id = $obj->{'school_id'};
	$SubjectTitle = $obj->{'SubjectTitle'};
	$DivisionName = $obj->{'DivisionName'};
	$SemesterName = $obj->{'Semester_id'};
	$t_id= $obj->{'t_id'};
	$BranchName = $obj->{'BranchName'};
	$DeptName = $obj->{'DeptName'};
	$CourseLevel = $obj->{'Course_Level_PID'};
	$Year = $obj->{'year'};
	


  $number_of_posts = isset($_GET['num']) ? intval($_GET['num']) : 10; //10 is the default
  $format = 'json';

include 'conn.php';




 if($SubjectCode!=='' && $school_id!==''&& $SubjectTitle!==''&& $DivisionName !==''&& $SemesterName!==''&&$t_id!==''&& $BranchName!==''&& $DeptName!==''&& $CourseLevel!==''&& $Year!=='')
	{
       //$insertsoftreward=mysql_query("insert into tbl_teacher_subject_master (subjcet_code,teacher_id,school_id,subjectName,Semester_id,CourseLevel,AcademicYear) values('$Subject_Code','$t_id','$school_id','$subject','$Semester_id','$Course_Level_PID','$Academic_Year')");
             $insertsoftreward=mysql_query("insert into tbl_teacher_subject_master (school_id,teacher_id,subjcet_code,subjectName,Division_id,Semester_id,Branches_id,Department_id,CourseLevel,AcademicYear)
			values('$school_id','$t_id','$SubjectCode','$SubjectTitle','$DivisionName','$SemesterName','$BranchName','$DeptName','$CourseLevel','$Year')");
			                
                  //$arr =mysql_query($insertsoftreward);             
				  if(mysql_affected_rows()>0)
                                 {
                                        	
                                        $postvalue['responseStatus']=200;
                        				$postvalue['responseMessage']="subject added successfully.";
                        				$postvalue['posts']=null;
                                         header('Content-type: application/json');
                           				 echo json_encode($postvalue);
                                 
								 }

                            else
                            {
                                        $postvalue['responseStatus']=204;
                        				$postvalue['responseMessage']="No Response";
                        				$postvalue['posts']=null;
                                         header('Content-type: application/json');
                           				 echo json_encode($postvalue);

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


  @mysql_close($con);

?>