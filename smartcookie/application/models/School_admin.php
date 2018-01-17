<?php 
class School_admin extends CI_Model
{




public function can_log_in()
{

	

	$entity=$this->input->post('entity');

	$this->db->where('email',$this->input->post('username'));
	$this->db->where('password',$this->input->post('password'));

$query=$this->db->get($entity);
	
	


	if($query->num_rows()==1)
	{
		 foreach ($query->result() as $row) 
		 {
			$school_id=$row->school_id;
			return $school_id;
		}
	}
	else
	{
		return false; 
	}

}




public function school_info()
{

	$this->db->select('school_name, address, scadmin_city,scadmin_country,scadmin_state');
	$query = $this->db->get('tbl_school_admin');
	   return $query->result() ;






$query=$this->db->get();

	
	 return $query->result() ;

}

public function activity_typeinfo()

{
$this->db->select('id,activity_type');
$this->db->from('tbl_activity_type');
$this->db->where('school_id',0);
$this->db->where('activity_type!=','Study');
	$query=$this->db->get();
	return  $query->result();
	
}

public function get_activity($activity_type,$school_id)
{
	$this->db->select('sc_list,sc_id');
	$this->db->from('tbl_studentpointslist');
	$this->db->where('school_id',$school_id);
	$this->db->where('sc_type',$activity_type);
	//$str=$this->db->get_compiled_select();
	//echo $str;die;
	$query=$this->db->get();
	return  $query->result();
	
}




}

?>