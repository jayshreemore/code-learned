<?php

function get_school_id($id){

	$query="select * from tbl_school_admin where id='$id'";       // uploaded by

	$row=mysql_query($query);

	$value=mysql_fetch_array($row);

	return $value;

}



function get_last_batchid($school_id,$uploaded_by){
	

	$sql2=mysql_query("select batch_id from tbl_Batch_Master where school_id='$school_id' and batch_id like '".$school_id."-B-%' order by id desc limit 1");			

	$resultsql=mysql_fetch_array($sql2);

	$count=mysql_num_rows($sql2);

	

	if($count==""){
			
		$batch_id=$school_id."-"."B-1";

				 

	}else{	

		$batch_id=@$resultsql['batch_id'];

		$b_id=explode("-",$batch_id);

		$batch=@$b_id[2];

		$batch=$batch+1;

		$batch_id=$school_id."-"."B-".$batch;

	}

	return $batch_id;	

}



function upload_info($table){
	switch($table){		

		case 'tbl_teacher':			

				$data['display_table_name']=' Teacher';

				$data['filename']='Teacher';

				$data['raw_table']='tbl_raw_teacher';

				$data['fields']='t_school_id, t_id, t_complete_name, t_phone, t_dept, t_gender, t_email, t_country, t_city, t_address,t_dob,t_internal_email,t_landline,t_date_of_appointment,t_emp_type_pid';

				$data['display_fields']='SchoolID, EmployeeRegCode, EmployeeName, Mobile, DeptName, Gender, EmailID, Country, City, PermanentAddress, DOB, IntEmail, PhoneNo, AppointmentDate,EmployeeType';

	

			break;	

		case 'tbl_department_master':			

				$data['display_table_name']=' Department';

				$data['filename']='Department';

				$data['raw_table']='raw_tbl_department_master';

				$data['fields']='School_ID,Dept_code,Dept_Name,ExtDeptID,Establiment_Year,PhoneNo,FaxNo,Email_Id,Is_Enabled';

				$data['display_fields']='SchoolID, DepartmentCode, DepartmentName, DepartmentID, EstablimentYear, PhoneNo, FaxNo, EmailID, IsEnabled';

	

			break;	

		case 'tbl_academic_Year':	

				$data['display_table_name']=' Academic Year';

				$data['filename']='AcademicYear';

				$data['raw_table']='raw_tbl_academic_Year';				

				$data['fields']='school_id,ExtYearID,Academic_Year,Year,Enable';

				$data['display_fields']='SchoolID,YearID,AcademicYear,Year,IsEnabled';



			break;

		case 'tbl_semester_master':

				$data['display_table_name']=' Semester Master';

				$data['filename']='SemesterMaster';

				$data['raw_table']='raw_tbl_semester_master';

				$data['fields']='school_id, ExtBranchId, ExtSemesterId, Semester_Name, Semester_credit, Is_regular_semester, Branch_name, Department_Name, CourseLevel, class, Is_enable';

				$data['display_fields']='SchoolID, BranchID, SemesterID, SemesterName, SemesterCredit, IsRegularSemester, BranchName, DepartmentName, CourseLevel, Class, IsEnabled';

		

			break;

		case 'tbl_student_subject_master':
					
				$data['display_table_name']=' Student Subject';

				$data['filename']='StudentSubject';

				$data['raw_table']='tbl_student_subject';

				$data['fields']='school_id, student_id, subjcet_code, ExtSemesterId, ExtBranchId, ExtSchoolSubjectId, ExtYearID, ExtDivisionID, subjectName, Division_id, Semester_id, Branches_id, Department_id, CourseLevel, AcademicYear, teacher_ID';

				$data['display_fields']='SchoolID, StudentID, SubjectCode, SemesterID, BranchID, SubjectID, YearID, DivisionID, SubjectName, Division, Semester, Branch, Department, CourseLevel, AcademicYear, TeacherID';

		

				break;

		case 'tbl_teacher_subject_master':	

				$data['display_table_name']=' Teacher Subject';

				$data['filename']='TeacherSubject';

				$data['raw_table']='tbl_teachr_subject_row';

				$data['fields']='school_id, teacher_id, ExtSchoolSubjectId, subjcet_code, subjectName, ExtYearID, ExtDivisionID, Division_id, ExtSemesterId, Semester_id, ExtBranchId, Branches_id,ExtDeptId, Department_id, CourseLevel, AcademicYear';

				$data['display_fields']='SchoolID, TeacherID, SubjectID, SubjectCode, SubjectName, YearID, DivisionID, Division, SemesterID, Semester, BranchID, Branch,DepartmentID, Department, CourseLevel, AcademicYear';

	

				break;

		case 'tbl_degree_master':	

				$data['display_table_name']=' Degree Master';

				$data['filename']='DegreeMaster';

				$data['raw_table']='raw_tbl_degree_master';

				$data['fields']='school_id,ExtDegreeID,Degee_name,Degree_code,course_level';

				$data['display_fields']='SchoolID,DegreeID,DegreeName,DegreeCode,CourseLevel';



				break;

		case 'tbl_branch_master':	

				$data['display_table_name']=' Branch Master';

				$data['filename']='BranchMaster';

				$data['raw_table']='raw_tbl_branch_master';

				$data['fields']='school_id, ExtBranchId, branch_Name, Specialization, Duration, IsEnabled, DepartmentName, Course_Name';

				$data['display_fields']='SchoolID, BranchID, Branch, Specialization, Duration, IsEnabled, DepartmentName, CourseName';



				break;		

		case 'Division':	

				$data['display_table_name']=' Division Master';

				$data['filename']='DivisionMaster';

				$data['raw_table']='raw_Division';

				$data['fields']='school_id,ExtDivisionID,DivisionName';

				$data['display_fields']='SchoolID, DivisionID, Division';



				break;	

		case 'Class':	

				$data['display_table_name']=' Class Master';

				$data['filename']='Class';

				$data['raw_table']='raw_Class';

				$data['fields']='school_id,class,ExtClassID,course_level';

				$data['display_fields']='SchoolID, Class, ClassID, CourseLevel';				



				break;	

		case 'tbl_school_subject':	

				$data['display_table_name']=' Subject Master';

				$data['filename']='Subject';

				$data['raw_table']='raw_tbl_school_subject';

				$data['fields']='school_id, ExtSchoolSubjectId, Subject_Code, subject, Subject_type, Subject_short_name, subject_credit';

				$data['display_fields']='SchoolID, SubjectID, SubjectCode, Subject, SubjectType, SubjectShortName, SubjectCredit';



				break;	

		case 'tbl_CourseLevel':	

				$data['display_table_name']=' Course Level';

				$data['filename']='CourseLevel';

				$data['raw_table']='raw_tbl_CourseLevel';

				$data['fields']='school_id, ExtCourseLevelID, CourseLevel';

				$data['display_fields']='SchoolID, ExtCourseLevelID, CourseLevel';



				break;

		case 'StudentSemesterRecord':	

				$data['display_table_name']=' Student Semester';

				$data['filename']='StudentSemester';

				$data['raw_table']='raw_StudentSemesterRecord';

				$data['fields']='school_id, student_id, ExtSemesterId, SemesterName, ExtYearID, AcdemicYear, ExtDivisionID, DivisionName, ExtBranchId, BranchName, Specialization, ExtDeptId, DeptName, ExtCourseLevelID, CourseLevel, IsCurrentSemester';

				$data['display_fields']='SchoolID, StudentID, SemesterID, SemesterName, YearID, AcdemicYear, ExtDivisionID, Division, BranchID, Branch, Specialization, DepartmentID, Department, CourseLevelID, CourseLevel, IsCurrentSemester';



				break;

		case 'tbl_student':	

				$data['display_table_name']=' Student';

				$data['filename']='Student';

				$data['raw_table']='tbl_raw_student';

				$data['fields']='s_school_id,s_PRN,s_complete_name,s_phone,s_branch,s_year,s_gender,s_email,s_country,s_father_name,s_dob,s_class,s_permanant_address,s_city,s_temporary_address,s_permanant_village,s_permanant_taluka,s_permanant_district,s_permanant_pincode,s_internal_emailid,s_specialization,s_course_level,s_academic_year,s_dept';

				$data['display_fields']='SchoolID, StudentPRN,StudentName,PhoneNo,BranchName,YearID,Gender,EmailID,Country,FatherName,DOB,Class,PermanentAddress,City,TemporaryAddress,PermanentVillage,PermanentTaluka,PermanentDistrict,PermanentPincode,InternalEmailID,Specialization,CourseLevel,AcademicYear,Department';

	

				break;

		case 'tbl_parent':	

				$data['display_table_name']=' Parent';

				$data['filename']='Parent';

				$data['raw_table']='tbl_raw_parent';

				$data['fields']='school_id,std_PRN,Name,Phone,email_id,DateOfBirth,Gender,Address,country,FamilyIncome,Qualification,Occupation,p_img_path,state,city,Mother_name';

				$data['display_fields']='SchoolID, StudentPRN,ParentName,PhoneNo,EmailID,DOB,Gender,Address,Country,FamilyIncome,Qualification,Occupation,ParentProfileImage,State,City,Mother_name';

		

				break;	

		case 'Branch_Subject_Division_Year':	

				$data['display_table_name']=' Branch_Subject_Division_Year';

				$data['filename']='Branch_Subject_Division_Year';

				$data['raw_table']='raw_Branch_Subject_Division_Year';

				$data['fields']=' `school_id`,`Intruduce_YeqarID`,  ExtSchoolSubjectId, `SubjectTitle`,`SubjectCode`,`SubjectType`,`SubjectShortName`,`IsEnable`,`UpdatedBy`,`CourseLevelPID`,`CourseLevel`,`DeptId`,`DeptName`,`ExtBranchId`,`BranchName`,`ExtSemesterId`,`SemesterName`,`ExtDivisionID`,`DivisionName`,ExtYearID, `Year`';

				$data['display_fields']='SchoolID, Introduce_YearID, SubjectID, SubjectTitle, SubjectCode,SubjectType,SubjectShortName,IsEnabled,UpdatedBy,CourseLevelID,CourseLevel, DeptID,DeptName,BranchID,BranchName,SemesterID,SemesterName,DivisionId,DivisionName,YearID, Year';

			

				break;	



				

			

				}

	return $data;

}



function process_record($table,$batch_id,$school_id){
	

	switch($table){		

		case 'tbl_teacher':

				$data['scan']="call ScanRecordTeacher('".$batch_id."','".$school_id."')";

				$data['process']="call `UploadRecordTeacher`('".$batch_id."','".$school_id."')";



			break;	

		case 'tbl_department_master':			

				$data['scan']="call ScanRecordDepartment('".$batch_id."','".$school_id."')";

				$data['process']="call `uploadrecorddepartment`('".$batch_id."')";



			break;	

		case 'tbl_academic_Year':	

				$data['scan']="call ScanRecordAcademicYear('".$batch_id."','".$school_id."')";

				$data['process']="call `UploadRecordAcademicYear`('".$batch_id."')";



			break;

		case 'tbl_semester_master':

				$data['scan']="call ScanRecordSemester('".$batch_id."','".$school_id."')";

				$data['process']="call `UploadRecordSemester`('".$batch_id."')";



			break;

		case 'tbl_student_subject_master':

				$data['scan']="call ScanRecordStudentSubject('".$batch_id."','".$school_id."')";

				$data['process']="call `UploadRecordStudentSubject`('".$batch_id."')";



				break;

		case 'tbl_teacher_subject_master':
				
				$data['scan']="call ScanRecordTeacherSubject('".$batch_id."','".$school_id."')";
				$data['process']="call `UploadRecordTeacherSubject`('".$batch_id."')";



				break;

		case 'tbl_degree_master':	

				$data['scan']="call ScanRecordDegree('".$batch_id."','".$school_id."')";

				$data['process']="call `UploadRecordDegree`('".$batch_id."')";



				break;

		case 'tbl_branch_master':	

				$data['scan']="call ScanRecordBranch('".$batch_id."','".$school_id."')";

				$data['process']="call `UploadRecordBranch`('".$batch_id."')";



				break;		

		case 'Division':	

				$data['scan']="call ScanRecordDivision('".$batch_id."','".$school_id."')";

				$data['process']="call `UploadRecordDivision`('".$batch_id."')";



				break;	

		case 'Class':	

				$data['scan']="call ScanRecordClass('".$batch_id."','".$school_id."')";

				$data['process']="call `UploadRecordClass`('".$batch_id."')";



				break;	

		case 'tbl_school_subject':	

				$data['scan']="call ScanRecordSchoolSubject('".$batch_id."','".$school_id."')";

				$data['process']="call `UploadRecordSchoolSubject`('".$batch_id."')";



				break;	

		case 'tbl_CourseLevel':	

				$data['scan']="call ScanRecordCourseLevel('".$batch_id."','".$school_id."')";

				$data['process']="call `UploadRecordCourseLevel`('".$batch_id."')";



				break;

		case 'StudentSemesterRecord':	

				$data['scan']="call ScanRecordStudentSemester('".$batch_id."','".$school_id."')";

				$data['process']="call `UploadRecordStudentSemesterRecord`('".$batch_id."')";



				break;

		case 'tbl_student':	

				$data['scan']="call ScanRecordStudent('".$batch_id."','".$school_id."')";

				$data['process']="call `UploadRecordStudent`('".$batch_id."','".$school_id."')";



				break;

		case 'tbl_parent':	

				$data['scan']="call ScanRecordParent('".$batch_id."','".$school_id."')";

				$data['process']="call UploadRecordParent('".$batch_id."','".$school_id."')";



				break;	

		case 'Branch_Subject_Division_Year':	

				$data['scan']="call ScanRecordBranchSubjectDivisionYear('".$batch_id."','".$school_id."')";

				$data['process']="call UploadRecordBranchSubjectDivisionYear('".$batch_id."')";

				break;	

			default:

				$data['scan']='';

				$data['process']='';

				break;	

		}

	return $data;

}



?>