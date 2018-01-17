<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Msalesperson extends CI_Model{
	public function __construct(){
         $this->load->database();
    }
	
	public function headerData($id){	
		$q = $this->db->query("select * from tbl_salesperson s where s.person_id='$id'");
		return $q->result();		
	}	
	
	public function RegisteredSponsorsList($id){	
		$this->db->order_by('sp_company', 'ASC');	
		$q = $this->db->get_where("tbl_sponsorer",array("sales_person_id"=>$id));		
		return $q->result();			
	}
	
	public function activateSponsor($a){
		$data = array(
               'v_status' => 'Active'
        );			
		$q=$this->db->update('tbl_sponsorer', $data, array('id' => $a));
		return $q;
	}
	
	public function getSponsorByID($id){
		$q = $this->db->get_where("tbl_sponsorer",array("id"=>$id));		
		return $q->result();	
	}
	
	function RegisterSponsor($form_data)
	{
		$this->db->insert('tbl_sponsorer', $form_data);
		
		if ($this->db->affected_rows() == '1')
		{
			return $this->db->insert_id();
		}else{
			return FALSE;
		}	
		
	}
		public function nearby_sponsors(){
 		//$map_init=$this->map_init($id);
		//$lat1=$map_init[0]->lat;
		//$lon1=$map_init[0]->lon;
		//$spcountry=$map_init[0]->sp_country;
		$q=$this->db->query("select id, lat ,lon, sp_city, sp_company, sp_address, v_status, sales_person_id from tbl_sponsorer where `lat`!=0");
		$locations = array();
		$i=0;
		$sp= $q->result(); 
		foreach($sp as $key =>$value ){
			//$lat2=$sp[$key]->lat;
			//$lon2=$sp[$key]->lon;
			//$sp_id=$sp[$key]->id;
			//$miles=$this->calculateDistance($lat1, $lon1, $lat2, $lon2);
			//$distance = round($miles * 1.609344,1);
			//if($distance <= $dist){
			if(true){
				$locations[$i]=$sp[$key];
				$i++;
			}		
		}
		return $locations;
	}

	public function nearby_schools(){
		//$map_init=$this->map_init($id);
		//$lat1=$map_init[0]->lat;
		//$lon1=$map_init[0]->lon;
		$sch=$this->db->query("select id,school_name,school_address,school_latitude,school_longitude,school_mnemonic from tbl_school where school_latitude!='0'");	
		$schools = array();
		$i=0;
		$school= $sch->result();
		foreach($school as $key =>$value ){
			//$lat2=$school[$key]->school_latitude;
			//$lon2=$school[$key]->school_longitude;
			//$miles=$this->calculateDistance($lat1, $lon1, $lat2, $lon2);
			//$distance = round($miles * 1.609344,1);
			//if($distance <= $dist){
			if(true){
				$schools[$i]=$school[$key];
				$i++;
			}	
		}
		return $schools;
	}
	
	public function receiptinfo($pdfdata)
	{
			$pdfdata1=array(
				'sp_id'=>$pdfdata['id'],
				'ReceiptNo'=>"SPR".$pdfdata['id'].$pdfdata['dates'],
				'Name'=>$pdfdata['sponsor_name'],
				'Email'=>$pdfdata['email'],
				'sp_phone'=>$pdfdata['sp_phone'],
				'Amount'=>$pdfdata['amount'],
				'Validity'=>$pdfdata['date1']);
									
		$res=$this->db->insert('tbl_insert_receipt', $pdfdata1);
		return $res;
		
	}
}	