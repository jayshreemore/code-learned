<?php 
class Mlogin extends CI_Model
{
	public function searchUser($LoginOption,$table,$FieldPassword,$Password,$FieldEmail,$EmailID,$FieldEmployeeID,$EmployeeID,$FieldOrg,$OrganizationID,$FieldPhoneNumber,$PhoneNumber,$FieldCountryCode,$CountryCode){		
		if($table=='tbl_sponsorer'){
			$sel='id';			
		}else{
			$sel='*';
		}
		$q="select ".$sel." from ".$table." where "; 			
			if($EmailID!="" && $LoginOption=='EmailID'){
				$q.=$FieldEmail."='".$EmailID."' and ".$FieldPassword."='".$Password."'";
			}
			
			if($EmployeeID!="" && $LoginOption=='EmployeeID'){
				$q.=$FieldEmployeeID."='".$EmployeeID."' and ".$FieldOrg."='".$OrganizationID."' and ".$FieldPassword."='".$Password."'";
			}
			
			if($PhoneNumber!="" && $LoginOption=='PhoneNumber' ){
				if($table=='tbl_sponsorer'){
					if($FieldCountryCode!=""){					
						$q.="(".$FieldPhoneNumber."='".$PhoneNumber."' or sp_landline='".$PhoneNumber."' ) and ".$FieldCountryCode."='".$CountryCode."' and ".$FieldPassword."='".$Password."'";	
					}else{
						$q.="(".$FieldPhoneNumber."='".$PhoneNumber."' or sp_landline='".$PhoneNumber."' ) and ".$FieldPassword."='".$Password."'";
					}
				}else{
					if($FieldCountryCode!=""){					
						$q.=$FieldPhoneNumber."='".$PhoneNumber."' and ".$FieldCountryCode."='".$CountryCode."' and ".$FieldPassword."='".$Password."'";	
					}else{
						$q.=$FieldPhoneNumber."='".$PhoneNumber."' and ".$FieldPassword."='".$Password."'";
					}
				}
			}
			if($table=='tbl_sponsorer'){
				$q.=' order by sp_company ASC, sp_name ASC';
			}	
		
			$query=$this->db->query($q);	
			//echo $q;
			$data['Result']=$query->result();
			$data['TotalUser']=$query->num_rows();
			
			return $data;			
	}
	
	public function errorMultipleUsers($entity,$record=''){
		$query=$this->db->query("insert into `tbl_error_log` (`id`, `error_type`, `error_description`, `datetime`, `user_type`, `last_programmer_name`) values(NULL, 'More Than 1 User', 'Login.php', CURRENT_TIMESTAMP, '$entity', 'Sudhir')");
		
		$insert_id = $this->db->insert_id();
		return  $insert_id;
		
	}
	
	public function setLoginLogoutStatus($TblEntityID, $UserID,$lat,$lon,$CountryCode,$ip,$os,$browser,$school_id){
		$date=date('Y-m-d H:i:s');
		//$q=$this->db->get_where("tbl_LoginStatus","EntityID = '$UserID' AND Entity_type= '$TblEntityID'");
		 $this->db->select('*');
		 $this->db->from('tbl_LoginStatus');
		 $this->db->where('EntityID', $UserID);
		 $this->db->where('Entity_type', $TblEntityID);
		 $this->db->order_by("RowID", "DESC");
		 $this->db->limit('1');
		 $q = $this->db->get();
		 $q_result = $q->result_array();
		
		 $this->session->set_userdata('TblEntityID_loginstatus', $q_result[0]['Entity_type']);
		 $this->session->set_userdata('UserID_loginstatus', $q_result[0]['EntityID']);
		// print_r($q_result);echo "</br>";
		// echo $q_result[0]['EntityID'];die;
		$rows=$q->num_rows();
		if( $rows > 0 ){
			$insdata=array(
					'EntityID'=>$q_result[0]['EntityID'],
					'Entity_type'=>$q_result[0]['Entity_type'],
					'FirstLoginTime'=>$q_result[0]['FirstLoginTime'],
					'FirstMethod'=>$q_result[0]['FirstMethod'],
					'FirstDevicetype'=>$q_result[0]['FirstDevicetype'],
					'FirstDeviceDetails'=>$q_result[0]['FirstDeviceDetails'],
					'FirstPlatformOS'=>$q_result[0]['FirstPlatformOS'],
					'FirstIPAddress'=>$q_result[0]['FirstIPAddress'],
					'FirstLatitude'=>$q_result[0]['FirstLatitude'],
					'FirstLongitude'=>$q_result[0]['FirstLongitude'],
					'FirstBrowser'=>$q_result[0]['FirstBrowser'],	
					
					'LatestLoginTime'=>$date,
					'LatestMethod'=>'web',
					'LatestDevicetype'=>'',
					'LatestDeviceDetails'=>$os,
					'LatestPlatformOS'=>$os,
					'LatestIPAddress'=>$ip,
					'LatestLatitude'=>$lat,
					'LatestLongitude'=>$lon,
					'LatestBrowser'=>$browser,			
					'CountryCode'=>$CountryCode,			
					'school_id'=>$school_id			
			);
			
			$q=$this->db->insert("tbl_LoginStatus",$insdata);
			
				
			if($q_result[0]['RowID']!='')
			{
			$RowID = $q_result[0]['RowID'];
			$updata=array(
				'LogoutTime'=>$date,
			);			
			//$this->db->limit(1);
			$q=$this->db->update("tbl_LoginStatus",$updata,"EntityID = '$UserID' AND Entity_type= '$TblEntityID' AND RowID= '$RowID'");		
			}
		
		}else{
			$insdata=array(
					'EntityID'=>$UserID,
					'Entity_type'=>$TblEntityID,
					'FirstLoginTime'=>$date,
					'FirstMethod'=>'web',
					'FirstDevicetype'=>'',
					'FirstDeviceDetails'=>$os,
					'FirstPlatformOS'=>$os,
					'FirstIPAddress'=>$ip,
					'FirstLatitude'=>$lat,
					'FirstLongitude'=>$lon,
					'FirstBrowser'=>$browser,			
					'LatestLoginTime'=>$date,
					'LatestMethod'=>'web',
					'LatestDevicetype'=>'',
					'LatestDeviceDetails'=>$os,
					'LatestPlatformOS'=>$os,
					'LatestIPAddress'=>$ip,
					'LatestLatitude'=>$lat,
					'LatestLongitude'=>$lon,
					'LatestBrowser'=>$browser,			
					'CountryCode'=>$CountryCode,			
					'school_id'=>$school_id			
			);
		
		$q=$this->db->insert("tbl_LoginStatus",$insdata);
				
				}
		
		if($q){
			return true;
		}else{
			return false;
		}
	}
	public function sessionLogout()	{	
//echo "<script>alert('updated')</script>";die;	
	$TblEntityID_loginstatus = $this->session->userdata('TblEntityID_loginstatus');
	$UserID_loginstatus = $this->session->userdata('UserID_loginstatus');
 $this->db->select('RowID');
				 $this->db->from('tbl_LoginStatus');
				 $this->db->where('EntityID', $UserID_loginstatus);
				 $this->db->where('Entity_type', $TblEntityID_loginstatus);
				 $this->db->order_by("RowID", "DESC");
				 $this->db->limit('1');
				 $q_rowid = $this->db->get();
				 $q_rowid_result = $q_rowid->result_array();
				
	$RowID_loginstatus = $q_rowid_result[0]['RowID'];

	
	$updata=array(
				'LogoutTime'=>date("Y-m-d h:i:s"),
			);	
		
		$q=$this->db->update("tbl_LoginStatus",$updata,"EntityID = '$UserID_loginstatus' AND Entity_type= '$TblEntityID_loginstatus' AND RowID= '$RowID_loginstatus'");			
	
		
	}
}	
				

?>