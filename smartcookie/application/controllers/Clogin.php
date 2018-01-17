<?php 
class Clogin extends CI_Controller
{
	public function index(){
		$this->load->view('index');		
	}	
	public function login($entity){
		$a = array('sponsor','student','salesperson','employee');
		if (!in_array($entity, $a)) {			
			redirect('/Clogin', 'location', 301);
		}	
		$data['report']="";
		$data['LoginOption']="EmailID";
		$data['EmailID']="";
		$data['OrganizationID']="";
		$data['EmployeeID']="";
		$data['CountryCode']="";
		$data['PhoneNumber']="";
		$data['Password']="";
		$data['entity']=$entity;	
		$data['index_url']=base_url();
		
		$this->load->view('login',$data);
	}

	public function setLoginLogoutStatus($EntityID, $UserID,$lat,$lon,$CountryCode,$school_id=''){
		$browse=$this->getBrowser();
		$browser=$browse['name'].' '.$browse['version']; 
		$ip=$this->getIP();
		$os=$this->getOS();
		
		$this->load->model("Mlogin");
		$this->Mlogin->setLoginLogoutStatus($EntityID, $UserID,$lat,$lon,$CountryCode,$ip,$os,$browser,$school_id);
	}

public function setSessionAndForward($entity,$record,$CountryCode,$lat,$lon){		

		
		switch($entity){
			case 1:
				$user='School Admin';
						$_SESSION['id'] = $record[0]['id'];					
						$_SESSION['school_id'] = $record[0]['school_id'];
						$this->setLoginLogoutStatus(102,$record[0]['id'],$lat,$lon,$CountryCode,$record[0]['school_id']);
						$_SESSION['entity'] = 1;					
						$_SESSION['username'] = $record[0]['email'];
						//header("Location:scadmin_dashboard.php");					
				break;
			case 2:
				$user='Teacher';
						$_SESSION['id'] = $record[0]['id'];					
						$_SESSION['rid'] = $record[0]['t_id'];					
						$_SESSION['school_id']= $record[0]['school_id'];
						$this->setLoginLogoutStatus(103,$record[0]['id'],$lat,$lon,$CountryCode,$record[0]['school_id']);
						$_SESSION['entity'] = 2;					
						$_SESSION['username'] = $record[0]['t_email'];
						if($this->upcartonlogin($entity,$record[0]['id'], $record[0]['t_id'], $record[0]['school_id'])){
							//header("Location:dashboard.php");
						}else{
							$msg='Error Occured';
						}					
				break;
			case 5:
				$user='Parent';
						$_SESSION['id'] = $record[0]['id'];
						$_SESSION['entity'] = 5;	
						$this->setLoginLogoutStatus(106,$record[0]['id'],$lat,$lon,$CountryCode);
						if($record[0]['email_id']!=''){
							$_SESSION['username'] = $record[0]['email_id'];	
						}else{
							$_SESSION['username'] = $record[0]['Phone'];	
						}
						//header("Location:child.php");
				break;
			case 6:
				$user='Cookie Admin';
						$_SESSION['id'] = $record[0]['id'];
						$_POST['username']=$record[0]['admin_email']; 					
						$_SESSION['entity'] = 6;
						$this->setLoginLogoutStatus(113,$record[0]['id'],$lat,$lon,$CountryCode);
						//header("Location:home_cookieadmin.php");
				break;		
			case 8:
				$user='Cookie Admin Staff';
					$_SESSION['cookieStaff'] = $record[0]['id'];
					$_SESSION['username']=$record[0]['email']; 				
					$_SESSION['entity'] = 8;
					$this->setLoginLogoutStatus(114,$record[0]['id'],$lat,$lon,$CountryCode);	
					//header("Location:home_cookieadmin_staff.php");
				break;	
			case 7:
				$user='School Admin Staff';
					$_SESSION['staff_id'] = $record[0]['id'];				
					$_SESSION['username']=$record[0]['email']; 		
					 		
					$_SESSION['entity'] = 7;
					$this->setLoginLogoutStatus(115,$record[0]['id'],$lat,$lon,$CountryCode,$record[0]['school_id']);
					//header("Location:school_staff_dashboard.php");
				break;	
			case 'salesperson':	
				$user='Sales Person';
					$data = array(
                 		'id'  =>  $record[0]->person_id,			
						'entity'=> 'salesperson',
					);
					$this->session->set_userdata($data);
					$this->setLoginLogoutStatus(116,$record[0]->person_id,$lat,$lon,$CountryCode);
					redirect('/Csalesperson', 'location', 301);
					break;
			case 'student':	
				$user='Student';
					
					$data = array(
                 			  	'std_PRN'  =>  $record[0]->std_PRN,
								'school_id' => $record[0]->school_id,
								'stud_id' => $record[0]->id,
								'username'=> $record[0]->std_email,
								'is_loggen_in'=>1,
								'entity'=> 'student',
								'usertype'=> 'student',
					);
					$this->session->set_userdata($data);
					$this->setLoginLogoutStatus(105,$record[0]->id,$lat,$lon,$CountryCode,$record[0]->school_id);
					redirect('main/members');
					break;
				case 'employee':	
					$user='employee';
					
					$data = array(
                 			  	'std_PRN'  =>  $record[0]->std_PRN,
								'school_id' => $record[0]->school_id,
								'stud_id' => $record[0]->id,
								'username'=> $record[0]->std_email,
								'is_loggen_in'=>1,
								'entity'=> 'student',
								'usertype'=> 'employee',
					);
					$this->session->set_userdata($data);
					$this->setLoginLogoutStatus(105,$record[0]->id,$lat,$lon,$CountryCode,$record[0]->school_id);
					redirect('main/members');
					break;		
			case 'sponsor':	
				$user='Sponsor';
					$data = array(
                 		'ids'  =>  $record,
						'logged_in'=> TRUE,
						'entity'=> 'sponsor',
					);
					$this->session->set_userdata($data);
					$myid=array();
					foreach(@$record as $key=>$value){						
						$myid[]=$value->id;
					}	
					$id=min($myid);					
					$this->setLoginLogoutStatus(108,$id,$lat,$lon,$CountryCode);
					redirect('/Allshops', 'location', 301);
					break;
			default:
				$user='';
				break;
		}

	}

	public function searchUser($LoginOption,$entity,$Password,$EmailID="",$OrganizationID="",$EmployeeID="",$CountryCode="",$PhoneNumber=""){
		$table='';		
		$FieldPassword='';
		$FieldEmail='';
		$FieldOrg='';
		$FieldEmployeeID='';
		$FieldCountryCode='';
		$FieldPhoneNumber='';
		
		switch($entity){
			case 2:
				$table='tbl_teacher';		
				$FieldPassword='t_password';
				$FieldEmail='t_email';
				$FieldOrg='school_id';
				$FieldEmployeeID='t_id';
				//$FieldCountryCode='t_id';
				$FieldPhoneNumber='t_phone';
				break;
			case 1:
				$table='tbl_school_admin';
				$FieldPassword='password';
				$FieldEmail='email';
				$FieldOrg='school_id';
				//$FieldEmployeeID='t_id';
				//$FieldCountryCode='t_id';
				$FieldPhoneNumber='mobile';
				break;
			case 5:
				$table='tbl_parent';
				$FieldPassword='Password';
				$FieldEmail='email_id';
				//$FieldOrg='school_id';
				//$FieldEmployeeID='t_id';
				//$FieldCountryCode='t_id';
				$FieldPhoneNumber='Phone';
				break;
			case 6:
				$table='tbl_cookieadmin';
				$FieldPassword='admin_password';
				$FieldEmail='admin_email';
				//$FieldOrg='school_id';
				//$FieldEmployeeID='t_id';
				//$FieldCountryCode='t_id';
				//$FieldPhoneNumber='Phone';
				break;
			case 8:
				$table='tbl_cookie_adminstaff';
				$FieldPassword='pass';
				$FieldEmail='email';
				//$FieldOrg='school_id';
				//$FieldEmployeeID='t_id';
				//$FieldCountryCode='t_id';
				$FieldPhoneNumber='phone';
				break;
			case 7:
				$table='tbl_school_adminstaff';
				$FieldPassword='pass';
				$FieldEmail='email';
				$FieldOrg='school_id';
				//$FieldEmployeeID='t_id';
				//$FieldCountryCode='t_id';
				$FieldPhoneNumber='phone';
				break;	
			case 'salesperson':
				$table='tbl_salesperson';
				$FieldPassword='p_password';
				$FieldEmail='p_email';
				//$FieldOrg='school_id';
				//$FieldEmployeeID='t_id';
				//$FieldCountryCode='t_id';
				$FieldPhoneNumber='p_phone';
				break;	
			case 'student':
				$table='tbl_student';
				$FieldPassword='std_password';
				$FieldEmail='std_email';
				$FieldOrg='school_id';
				$FieldEmployeeID='std_PRN';
				$FieldCountryCode='country_code';
				$FieldPhoneNumber='std_phone';
				break;		
			case 'employee':
				$table='tbl_student';
				$FieldPassword='std_password';
				$FieldEmail='std_email';
				$FieldOrg='school_id';
				$FieldEmployeeID='std_PRN';
				$FieldCountryCode='country_code';
				$FieldPhoneNumber='std_phone';
				break;					
			case 'sponsor':
				$table='tbl_sponsorer';
				$FieldPassword='sp_password';
				$FieldEmail='sp_email';
				//$FieldOrg='school_id';
				//$FieldEmployeeID='std_PRN';
				$FieldCountryCode='CountryCode';
				$FieldPhoneNumber='sp_phone';
				break;		
		}
		
		$this->load->model("Mlogin");
		
		$res=$this->Mlogin->searchUser($LoginOption,$table,$FieldPassword,$Password,$FieldEmail,$EmailID,$FieldEmployeeID,$EmployeeID,$FieldOrg,$OrganizationID,$FieldPhoneNumber,$PhoneNumber,$FieldCountryCode,$CountryCode);	
		
		return $res;	
	}
	public function chk_input($value){
		return addslashes(htmlentities(trim($value)));
	}

	public function login_validation(){
		$report="";
		$LoginOption=$this->chk_input($this->input->post('LoginOption'));
		$EmailID=$this->chk_input($this->input->post('EmailID'));
		
		$OrganizationID=$this->chk_input($this->input->post('OrganizationID'));
		$EmployeeID=$this->chk_input($this->input->post('EmployeeID'));
		
		$CountryCode=$this->chk_input($this->input->post('CountryCode'));
		$PhoneNumber=$this->chk_input($this->input->post('PhoneNumber'));
		
		$Password=$this->chk_input($this->input->post('Password'));
		$entity=$this->chk_input($this->input->post('entity'));		
		

		//$lat=$this->chk_input($this->input->post('lat'));		
		//$lon=$this->chk_input($this->input->post('lon'));	

		$ip  = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		$url = "http://freegeoip.net/json/$ip";
		$ch  = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		$data_ip = curl_exec($ch);
		curl_close($ch);

		if ($data_ip) {
			$location = json_decode($data_ip);


				$lat = $location->latitude;
				$lon = $location->longitude;

		}
		
		
		if($entity!="" and $Password!="" and ( $EmailID!="" or ($CountryCode!="" and $PhoneNumber!="") or ($OrganizationID!="" and $EmployeeID!="") )){
				if($EmailID!="" && $LoginOption=='EmailID'){			
					$emailval = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';		
					if(!preg_match($emailval, $EmailID)){						
						$report="<span id='error' class='red'>Check your email.</span>";
					}
				}
				if($PhoneNumber!="" && $LoginOption=='PhoneNumber'){
					$mob="/^[789][0-9]{9}$/";
					if(!preg_match($mob, $PhoneNumber)){ 
						$report="<span id='error' class='red'>Check your Mobile number.</span>";
					}
				}
				if($report==""){	
					$res=$this->searchUser($LoginOption,$entity,$Password,$EmailID,$OrganizationID,$EmployeeID,$CountryCode,$PhoneNumber);
					if($res['TotalUser']<1){
						$report="<span id='error' class='red'>Invalid Credentials!</span>";
					}else{
						if($entity!='sponsor' and $res['TotalUser']>1){		
								$this->load->model('Mlogin');
								$insert_id=$this->Mlogin->errorMultipleUsers($entity);								
								$report="<span id='error' class='red'>Somethis went wrong.There may be multiple users with same credentials</span>";
						}else{
							$this->setSessionAndForward($entity,$res['Result'],$CountryCode, $lat, $lon);
						}						
						
					}					
				}		
			}else{
				$report="<span id='error' class='red'>All Fields Are Mandatory.</span>";
			}	
		if($report!=''){
					$data['report']=$report;
					$data['LoginOption']=$LoginOption;
					$data['EmailID']=$EmailID;
					$data['OrganizationID']=$OrganizationID;
					$data['EmployeeID']=$EmployeeID;
					$data['CountryCode']=$CountryCode;
					$data['PhoneNumber']=$PhoneNumber;
					$data['Password']=$Password;
					$data['entity']=$entity;	
					$data['index_url']=base_url();
					
					$this->load->view('login',$data);
		}	
	}


	public function getOS(){ 

		$user_agent=$_SERVER['HTTP_USER_AGENT'];

		$os_platform    =   "Unknown OS Platform";

		$os_array       =   array(
								'/windows nt 10/i'     =>  'Windows 10',
								'/windows nt 6.3/i'     =>  'Windows 8.1',
								'/windows nt 6.2/i'     =>  'Windows 8',
								'/windows nt 6.1/i'     =>  'Windows 7',
								'/windows nt 6.0/i'     =>  'Windows Vista',
								'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
								'/windows nt 5.1/i'     =>  'Windows XP',
								'/windows xp/i'         =>  'Windows XP',
								'/windows nt 5.0/i'     =>  'Windows 2000',
								'/windows me/i'         =>  'Windows ME',
								'/win98/i'              =>  'Windows 98',
								'/win95/i'              =>  'Windows 95',
								'/win16/i'              =>  'Windows 3.11',
								'/macintosh|mac os x/i' =>  'Mac OS X',
								'/mac_powerpc/i'        =>  'Mac OS 9',
								'/linux/i'              =>  'Linux',
								'/ubuntu/i'             =>  'Ubuntu',
								'/iphone/i'             =>  'iPhone',
								'/ipod/i'               =>  'iPod',
								'/ipad/i'               =>  'iPad',
								'/android/i'            =>  'Android',
								'/blackberry/i'         =>  'BlackBerry',
								'/webos/i'              =>  'Mobile'
							);

		foreach ($os_array as $regex => $value) { 

			if (preg_match($regex, $user_agent)) {
				$os_platform    =   $value;
			}

		}   

		return $os_platform;

	}


	public function getBrowser() 
	{ 
		$u_agent = $_SERVER['HTTP_USER_AGENT']; 
		$bname = 'Unknown';
		$platform = 'Unknown';
		$version= "";

		//First get the platform?
		if (preg_match('/linux/i', $u_agent)) {
			$platform = 'linux';
		}
		elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
			$platform = 'mac';
		}
		elseif (preg_match('/windows|win32/i', $u_agent)) {
			$platform = 'windows';
		}

		// Next get the name of the useragent yes seperately and for good reason
		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
		{ 
			$bname = 'Internet Explorer'; 
			$ub = "MSIE"; 
		} 
		elseif(preg_match('/Firefox/i',$u_agent)) 
		{ 
			$bname = 'Mozilla Firefox'; 
			$ub = "Firefox"; 
		} 
		elseif(preg_match('/Chrome/i',$u_agent)) 
		{ 
			$bname = 'Google Chrome'; 
			$ub = "Chrome"; 
		} 
		elseif(preg_match('/Safari/i',$u_agent)) 
		{ 
			$bname = 'Apple Safari'; 
			$ub = "Safari"; 
		} 
		elseif(preg_match('/Opera/i',$u_agent)) 
		{ 
			$bname = 'Opera'; 
			$ub = "Opera"; 
		} 
		elseif(preg_match('/Netscape/i',$u_agent)) 
		{ 
			$bname = 'Netscape'; 
			$ub = "Netscape"; 
		} 

		// finally get the correct version number
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)) {
			// we have no matching number just continue
		}

		// see how many we have
		$i = count($matches['browser']);
		if ($i != 1) {
			//we will have two since we are not using 'other' argument yet
			//see if version is before or after the name
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
				$version= $matches['version'][0];
			}
			else {
				$version= $matches['version'][1];
			}
		}
		else {
			$version= $matches['version'][0];
		}

		// check if we have a number
		if ($version==null || $version=="") {$version="?";}

		return array(
			'userAgent' => $u_agent,
			'name'      => $bname,
			'version'   => $version,
			'platform'  => $platform,
			'pattern'    => $pattern
		);
	} 



	public function getIP()
	{
		$ip = "";

		if (!empty($_SERVER["HTTP_CLIENT_IP"]))
		{
		//check for ip from share internet
		$ip = $_SERVER["HTTP_CLIENT_IP"];
		}
		elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
		{
		// Check for the Proxy User
		$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		}
		else
		{
		$ip = $_SERVER["REMOTE_ADDR"];
		}
		return $ip;
	}
}
?>