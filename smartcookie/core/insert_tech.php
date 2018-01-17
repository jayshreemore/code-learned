<?php
 include('conn.php');	


 /*& $t_id<?php echo $t_id;?>
					   & $SubjectTitle<?php echo $row['SubjectTitle'];?> 
					   & $DivisionName<?php echo $row['DivisionName'];?>
					   & $SemesterName<?php echo $row['SemesterName'];?> 
					   & $BranchName<?php echo $row['BranchName'];?>
					    & $DeptName<?php echo $row['DeptName']?>
						 $CourseLevel<?php echo $row['CourseLevel'];?>
						  $Year<?php echo $row['Year'];?>">
                         <input type="submit" value="Add" name="Add" class="btn btn-primary"
					    style="color:white;background-color:#2F329F;">*/
 
				//$teacher_id=$_SESSION['id'];
					         $school_id=$_SESSION['school_id'];
						     $SubjectCode=$_REQUEST['subcode'];
					         $SubjectTitle=$_REQUEST['SubjectTitle'];
					        $DivisionName=$_REQUEST['DivisionName'];
					         $SemesterName=$_REQUEST['SemesterName'];
					       $BranchName=$_REQUEST['BranchName'];
					        $DeptName=$_REQUEST['DeptName'];
							  $t_id=$_REQUEST['t_id'];
						 $CourseLevel=$_REQUEST['CourseLevel'];
	
						 $Year=$_REQUEST['Year'];
						 
						 
					  
                  $server_name = $_SERVER['SERVER_NAME'];
					/*$sql=mysql_query("insert into tbl_teacher_subject_master (ExtYearID,teacher_id,school_id,subjcet_code,subjectName,Division_id,Semester_id,Branches_id,Department_id,CourseLevel,AcademicYear,upload_date,uploaded_by) values('$ExtYearID','$t_id','$sc_id','','$subject_code','$subject_name','$division','$semester','$branch','$department','$course','$academic_year','$upload_date','$uploadedBy')");*/
				//echo"insert into tbl_teacher_subject_master (subjcet_code,	teacher_id,school_id,subjectName,Semester_id,CourseLevel) values('$Subject_Code','$t_id','$school_id','$subject','$Semester_id','$Course_Level_PID')";	
			
			$sql=mysql_query("insert into tbl_teacher_subject_master (school_id,teacher_id,subjcet_code,subjectName,Division_id,Semester_id,Branches_id,Department_id,CourseLevel,AcademicYear)
			values('$school_id','$t_id','$SubjectCode','$SubjectTitle','$DivisionName','$SemesterName','$BranchName','$DeptName','$CourseLevel','$Year')");
			
			//$sql=mysql_query("insert into tbl_teacher_subject_master (school_id,teacher_id,subjcet_code,subjectName,Division_id,Semester_id,Branches_id,Department_id,CourseLevel,AcademicYear))
			//values('$school_id','$t_id','$SubjectCode','$SubjectTitle','$DivisionName','$SemesterName','$BranchName','$DeptName','$CourseLevel','$Year')");		
			/*$sql=mysql_query("insert into tbl_teacher_subject_master (subjcet_code,	teacher_id,school_id,subjectName,Semester_id,CourseLevel,Department_id,Branches_id,AcademicYear) values('$Subject_Code','$t_id','$school_id','$subject','$Semester_id','$Course_Level_PID','$Department_Name',' $Branch_name','$Academic_Year')");	*/
				if($sql)
				{
					
					echo "<script>
window.location.href='https://$server_name/core/add_subject_J.php';
alert('Subject Added succesfully');
</script>";
				}
				else
				 {
					 
					 echo"<script>alert('Subject  Not Added succesfully')</script>";
				}
					 
					 
					 
					 
					 
					 
					 ?>