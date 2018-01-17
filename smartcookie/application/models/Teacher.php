<?php 
class Teacher extends CI_Model
{




			
			public function teacherinfo($t_id,$school_id)
{
	
	
	
	$this->db->select('*');
	$this->db->from('tbl_teacher');
	$this->db->where('t_id',$t_id);
	$this->db->where('school_id',$school_id);
	$query=$this->db->get();
	return $query->result();
	
}



public function teacherlist($std_PRN,$school_id)
{
	
	
							    
$this->db->distinct();
$this->db->select('sm.subjcet_code,sm.subjectName,sm.teacher_id,t.id,t. t_pc,t.t_name,t.t_middlename,t.t_lastname,t.t_complete_name');
$this->db->from('tbl_student_subject_master sm');
$this->db->join('tbl_teacher t','t.t_id=sm.teacher_id','left');
$this->db->join('tbl_academic_Year a','sm.AcademicYear = a.Year');
$this->db->where('sm.student_id',$std_PRN);
				$this->db->where('sm.school_id',$school_id);
				$this->db->where('a.school_id',$school_id);
				$this->db->where('t.school_id',$school_id);
				$this->db->where('a.Enable',1);
			//$str=$this->db->get_compiled_select();
				//echo $str;die;
				
				$query=$this->db->get();
				
				return $query->result();

}



public function schoolteacherlist($std_PRN,$school_id)
{
	
	
						$this->db->select('*');

			$this->db->from('tbl_teacher');
				$this->db->where('school_id',$school_id);
			
			//$str=$this->db->get_compiled_select();
				//echo $str;die;
				
				$query=$this->db->get();
				
				return $query->result();

}



}




?>