<?php 
class sponsor extends CI_Model
{

public function sponsorinfo()
{
	$this->db->select('sp_name, sp_address,sp_email, sp_city,sp_country,sp_state,lat,lon');
	$this->db->from('tbl_sponsorer');  
	   $query = $this->db->get();
        return $res1 = $query->result();
	
}





public function sponsorlist()
{
	$this->db->select('id,sp_name, sp_address,sp_company,sp_email, sp_city,sp_country,sp_state,lat,lon');
	$this->db->from('tbl_sponsorer');  
	   $query = $this->db->get();
        return $res1 = $query->result();
	
}



}


?>







