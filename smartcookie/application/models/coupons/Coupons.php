<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Coupons extends CI_Model{
	public function __construct(){
         $this->load->database();
    }
	
	public function getuserinfo($entity, $id){
		if($entity='student'){
			$this->db->select("sc_total_point as green, yellow_points as yellow, purple_points as purple, balance_water_points as water, brown_point as brown, sum(sc_total_point + yellow_points + purple_points + balance_water_points + brown_point) as totat_pts, std_country as country, std_state as state, std_city as city, std_address as address, s.school_id, concat(s.std_lastname,' ',s.std_name,' ',s.std_Father_name) as name, std_email as email");
			$this->db->from('tbl_student_reward sr');
			$this->db->join('tbl_student s','sr.sc_stud_id=s.std_PRN', 'left');
			$this->db->where("s.id='$id'");
			$q = $this->db->get();
			return $q->result();			
		}elseif($entity='teacher'){			
			$this->db->select("balance_blue_points as blue, balance_blue_points as totat_pts, t_country as country, state, t_city as city, t_address as address, t.school_id, concat(t.t_lastname,' ',t.t_name,' ',t.t_middlename) as name, t_email as email");
			$this->db->from('tbl_teacher');			
			$this->db->where("id='$id'");
			$q = $this->db->get();
			return $q->result();
		}else{
			return false;
		}
	}
	
	public function cart_items($entity, $id){
		if($entity='student'){					
			$q = $this->db->get_where('cart',"user_id='$id' and entity_id='3' and `coupon_id` IS NOT NULL");			
			$items['items']=$q->result();
			$items['rows']=$q->num_rows();
			
			$this->db->select('sum(for_points) as usedpts');
			$p = $this->db->get_where('cart',"user_id='$id' and entity_id='3' and `coupon_id` IS NOT NULL");
			$items['usedpts']=$p->result();	
			
			return $items;			
		}elseif($entity='teacher'){							
			$q = $this->db->get_where('cart',"user_id='$id' and entity_id='2' and `coupon_id` IS NOT NULL");		
			$items['items']=$q->result();
			$items['rows']=$q->num_rows();
			
			$this->db->select('sum(for_points) as usedpts');
			$p = $this->db->get_where('cart',"user_id='$id' and entity_id='2' and `coupon_id` IS NOT NULL");
			$items['usedpts']=$p->result();
			return $items;
		}else{
			return false;
		}	
	}
	
	public function cart_itemsinfo($entity, $id){
		if($entity=='student' or $entity=='Student'){
			$entity=3;
		}elseif($entity=='teacher' or $entity=='Teacher'){
			$entity=2;
		}
		
		$this->db->select("c.id, c.entity_id, c.user_id, c.coupon_id, c.for_points, c.timestamp, c.available_points, spd.Sponser_product, s.sp_company, concat(s.sp_address, ', ', s.sp_city) as address, spd.sponsor_id, spd.valid_until, spd.coupon_code_ifunique");
		$this->db->from('cart c');
		$this->db->join('tbl_sponsored spd','spd.id=c.coupon_id');
		$this->db->join('tbl_sponsorer s','s.id=spd.sponsor_id');
		
		$this->db->where("c.user_id='$id' and c.entity_id='$entity' and c.coupon_id IS NOT NULL");
		$q = $this->db->get();
			
		$items['items']=$q->result();
		$items['rows']=$q->num_rows();
		
		$this->db->select('sum(for_points) as usedpts');
		$p = $this->db->get_where('cart',"user_id='$id' and entity_id='$entity' and `coupon_id` IS NOT NULL");
		$items['usedpts']=$p->result();		
		return $items;
	}
	
	public function coupon_list($catid){
/* 
    [id] => 
    [sp_name] => Sudhir Deshmukh
    [sp_address] => shivajinagar
    [sp_city] => Pune
    [sp_dob] => 02/01/2016
    [sp_gender] => male
    [sp_country] => India
    [sp_state] => Maharashtra
    [sp_email] => sudhirp@roseland.com
    [sp_phone] => 9922449794
    [sp_password] => 123
    [sp_date] => 08/16/2015
    [sp_occupation] => 
    [sp_company] => Sudhirs Shop
    [sp_website] => www.sudhirdeshmukh.in
    [sp_img_path] => BANNER2.jpg
    [school_id] => 
    [register_throught] => 
    [lat] => 18.5328
    [lon] => 73.8421
    [pin] => 411038
    [sales_person_id] => 0
    [expiry_date] => 
    [amount] => 
    [v_status] => 
    [v_likes] => 
    [v_category] => 2
    [temp_phone] => 
    [otp_phone] => 1
    [temp_email] => sudhirp@roseland.com
    [otp_email] => 2941
    [Sponser_type] => discount
    [Sponser_product] => 20
    [points_per_product] => 15
    [sponsered_date] => 10/25/2015
    [valid_no_of_student] => 
    [validity] => valid
    [sponsor_id] => 349
    [product_image] => 
    [valid_until] => 04/25/2016
    [category] => Food
    [product_price] => 0
    [discount] => 20
    [buy] => 
    [get] => 
    [saving] => 
    [offer_description] => 
    [daily_limit] => unlimited
    [total_coupons] => unlimited
    [priority] => 
    [coupon_code_ifunique] => 
    [currency] => 
    [daily_counter] => unlimited
    [reset_date] => 10/25/2015 	
	*/

			$this->db->select('spd.id, sp.sp_name, sp.sp_address, sp.sp_country, sp.sp_state, sp.sp_city, sp.sp_email, sp.sp_phone, sp.sp_company, sp.sp_website, sp.sp_img_path, sp.lat, sp.lon, sp.pin, spd.Sponser_type, spd.Sponser_product, spd.points_per_product, spd.sponsered_date, spd.product_image, spd.sponsor_id, spd.valid_until, cat.category, spd.product_price, spd.discount, spd.buy, spd.get, spd.saving, spd.offer_description, spd.daily_limit, spd.total_coupons, spd.priority, spd.coupon_code_ifunique, cur.currency, spd.daily_counter, spd.reset_date, spd.validity');
			$this->db->from('tbl_sponsorer sp');
			$this->db->join('tbl_sponsored spd','sp.id = spd.sponsor_id');		
			$this->db->join('categories cat','cat.id = spd.category','left');
			$this->db->join('currencies cur','sp.id = spd.currency','left');
			$this->db->where("`spd`.`category`='$catid' and `validity`<>'invalid'");
			$q = $this->db->get();
			return $q->result();
		

	}
	
	public function total_coupon_check(){ // for all coupons		
		$data=array("validity"=>'invalid');
		$this->db->where(" total_coupons!='unlimited' and `validity`<>'invalid' and total_coupons='0'");
		$q=$this->db->update('tbl_sponsored', $data);
		return $q;	
	}
	
	public function up_daily_counter($id,$today,$daily_limit){
		$data=array("reset_date"=>$today, "daily_counter"=>$daily_limit);
		$this->db->where("`id`='$id'");
		$q=$this->db->update('tbl_sponsored', $data);
		return $q;
	}
	
	public function up_valid_until($id){
		$data=array("validity"=>'invalid');
		$this->db->where("`id`='$id'");
		$q=$this->db->update('tbl_sponsored', $data);
		return $q;
	}
	public function getDailyCounterValue($id){
		$this->db->select('daily_counter');
		$p = $this->db->get_where('tbl_sponsored',"`id`='$id'");
		return $p->result();
	}
	
	public function getCounters($id){
		$this->db->select('total_coupons, daily_counter');
		$q = $this->db->get_where('tbl_sponsored spd',"spd.id='$id'");
		return $q->result();
	}
	
	public function updateTotalCoupons($proid, $total_coupons){
		$data=array("total_coupons"=>$total_coupons);
		$this->db->where("`id`='$proid'");
		$q=$this->db->update('tbl_sponsored', $data);
		return $q;
	}
	
	public function updateDailyCounterValue($proid, $daily_counter){
		$data=array("daily_counter"=>$daily_counter);
		$this->db->where("`id`='$proid'");
		$q=$this->db->update('tbl_sponsored', $data);
		return $q;
	}
	
	public function addCoupon($entity,$user_id,$proid,$ppp){
		if($entity=='student' or $entity=='Student'){
			$entity=3;
		}elseif($entity=='teacher' or $entity=='Teacher'){
			$entity=2;
		}
		$q=$this->db->query("INSERT INTO `cart` (`id`, `entity_id`, `user_id`, `coupon_id`, `for_points`, `timestamp`, `available_points`) VALUES (NULL, \"$entity\", \"$user_id\",\"$proid\" ,\"$ppp\", CURRENT_TIMESTAMP, \"$ppp\")");
		
		return $q;
	}	
	
	public function updateStudentPoints($id,$pts_green,$pts_yellow,$pts_purple,$pts_water){
		$q=$this->db->query("UPDATE `tbl_student_reward` sr INNER JOIN tbl_student s ON sr.sc_stud_id=s.std_PRN SET `sc_total_point`='$pts_green', `yellow_points`='$pts_yellow', `purple_points`='$pts_purple', balance_water_points='$pts_water' WHERE s.id='$id'");
		return $q;
	}
	
	public function updateTeacherPoints($id,$pts_blue){
		$q=$this->db->query("UPDATE `tbl_teacher` SET `balance_blue_points`='$pts_blue' WHERE `id`='$id'");
		return $q;
	}
	
	public function insertSelectedVendorCoupon($entity,$user_id,$cid,$ppp,$code,$sp_id,$valid_until,$school_id){
		$q=$this->db->query("INSERT INTO tbl_selected_vendor_coupons (id, entity_id, user_id, coupon_id, for_points, timestamp, code,	used_flag, sponsor_id, valid_until, school_id) VALUES(NULL,\"$entity\",\"$user_id\",\"$cid\",\"$ppp\",CURRENT_TIMESTAMP,\"$code\",'unused',\"$sp_id\",\"$valid_until\",\"$school_id\")");
		return $q;
	}
	
	public function my_coupons($entity,$id){
		if($entity=='student' or $entity=='Student'){
			$entity=3;
		}elseif($entity=='teacher' or $entity=='Teacher'){
			$entity=2;
		}
		$this->db->select("spd.id, sp.sp_name, sp.sp_address, sp.sp_country, sp.sp_state, sp.sp_city, sp.sp_email, sp.sp_phone, sp.sp_company, sp.sp_website, sp.sp_img_path, sp.lat, sp.lon, sp.pin, spd.Sponser_type, spd.Sponser_product, spd.points_per_product, spd.sponsered_date, spd.product_image, svc.sponsor_id, svc.valid_until, cat.category, spd.product_price, spd.discount, spd.buy, spd.get, spd.saving, spd.offer_description, spd.daily_limit, spd.total_coupons, spd.priority, spd.coupon_code_ifunique, cur.currency, spd.daily_counter, spd.reset_date, spd.validity, svc.id as sel_id, svc.timestamp, svc.code");
		$this->db->from('tbl_selected_vendor_coupons svc');
		$this->db->join('tbl_sponsorer sp','svc.sponsor_id=sp.id');
		$this->db->join('tbl_sponsored spd','spd.id = svc.coupon_id');		
		$this->db->join('categories cat','cat.id = spd.category','left');
		$this->db->join('currencies cur','cur.id = spd.currency','left');
		$this->db->where("`svc`.`used_flag`='unused' and `validity`<>'invalid' and svc.entity_id='$entity' and svc.user_id='$id'");
		$q = $this->db->get();
		//$this->db->last_query();

		return $q->result();	

	}
	public function used_coupons($entity,$id){
		if($entity=='student' or $entity=='Student'){
			$entity=3;
		}elseif($entity=='teacher' or $entity=='Teacher'){
			$entity=2;
		}
		$this->db->select("spd.id, sp.sp_name, sp.sp_address, sp.sp_country, sp.sp_state, sp.sp_city, sp.sp_email, sp.sp_phone, sp.sp_company, sp.sp_website, sp.sp_img_path, sp.lat, sp.lon, sp.pin,spd.Sponser_type, spd.Sponser_product, spd.points_per_product, spd.sponsered_date,spd.product_image, svc.sponsor_id, svc.valid_until, cat.category, spd.product_price, spd.discount, spd.buy, spd.get, spd.saving, spd.offer_description, spd.daily_limit, spd.total_coupons, spd.priority, spd.coupon_code_ifunique, cur.currency, spd.daily_counter, spd.reset_date, spd.validity, svc.id as sel_id, svc.timestamp, svc.code");
		$this->db->from('tbl_selected_vendor_coupons svc');
		$this->db->join('tbl_sponsorer sp','svc.sponsor_id=sp.id');
		$this->db->join('tbl_sponsored spd','spd.id = svc.coupon_id');		
		$this->db->join('categories cat','cat.id = spd.category','left');
		$this->db->join('currencies cur','cur.id = spd.currency','left');
		$this->db->where("`svc`.`used_flag`='used' and svc.entity_id='$entity' and svc.user_id='$id'");				$this->db->order_by("svc.timestamp", "desc");
		$q = $this->db->get();
		//$this->db->last_query();

		return $q->result();

	}
	
	public function use_now($sel_id,$school_id){
		$q=$this->db->query("UPDATE tbl_selected_vendor_coupons set timestamp=NOW(), used_flag='used', school_id='$school_id' WHERE id='$sel_id'");

		return $q;
	}
	
	public function suggested_sponsors($catid){
		$this->db->select('sp.id,sp_name,sp_company,category,sp_phone,sp_email,sp_address,sp_state,sp_city,sp_country,v_status,v_likes,lat,lon');
		$this->db->from('tbl_sponsorer sp');		
		$this->db->join('categories cat','cat.id = sp.v_category','left');	
		$this->db->where("v_status`='Inactive' and `sp`.`v_category`='$catid'");
		$this->db->order_by("sp.id","DESC");
		$q = $this->db->get();
		return $q->result();		
	}
	
	public function is_suggested_liked($entity,$userid, $spid){
		if($entity=='student' or $entity=='Student'){
			$entity=3;
		}elseif($entity=='teacher' or $entity=='Teacher'){
			$entity=2;
		}
		
		$this->db->select("*");
		$this->db->from('tbl_like_status l');		
		$this->db->where("from_entity='$entity' and from_user_id='$userid' and to_entity='4' and to_user_id='$spid'");		
		$q = $this->db->get();	
		$is_liked=$q->num_rows();
		
		if($is_liked > 0){
			return true;
		}else{
			return false;
		}			
	}
	
	public function likeThisSponsor($entity,$userid, $spid){
		if($entity=='student' or $entity=='Student'){
			$entity=3;
		}elseif($entity=='teacher' or $entity=='Teacher'){
			$entity=2;
		}
		
		$data = array(
		   'from_entity' => $entity,
		   'from_user_id' => $userid,
		   'to_entity' => 4,
		   'to_user_id' => $spid,
		   'active_status' =>0
		);
		$this->db->insert('tbl_like_status', $data); 
		
		$q=$this->db->query("update `tbl_sponsorer` set v_likes = v_likes + 1 where `id`='$spid'");		
		
	}
	
	public function suggest_new_sponsor($entity, $user_id, $lat, $lon,$school_id){
		if($entity=='student' or $entity=='Student'){
			$entity=3;
		}elseif($entity=='teacher' or $entity=='Teacher'){
			$entity=2;
		}
		
		$country = $this->input->post('country');
		if($country=='India')
			{
				date_default_timezone_set("Asia/Calcutta");
				$dates = date("Y-m-d h:i:s A");
			}
		elseif($country=='USA')
			{
				date_default_timezone_set("America/Boa_Vista");
				$dates = date("Y-m-d h:i:s A");
			}
	

		$data = array(
			'sp_date'=> $dates,
		   'sp_name' => $this->input->post('name'),
		   'sp_company' => $this->input->post('company'),
		   'v_category' =>  $this->input->post('cat'),
		   'sp_phone' =>  $this->input->post('phone_number'),
		   'sp_email' =>  $this->input->post('email'),
		   'sp_address' =>  $this->input->post('vendor_address'),
		   'v_status' =>  'Inactive',
		   'v_likes' =>  1,
		   'sp_city' =>  $this->input->post('city'),
		   'sp_state' =>  $this->input->post('state'),
		   'sp_country' =>  $this->input->post('country'),
		   'lat' =>  $lat,
		   'lon' =>  $lon,
		   'calculated_lat' =>  $lat,
		   'calculated_lon' =>  $lon,
		   'platform_source'=>'student web',
		   'user_member_id'=>$user_id,
		   'entity_id'=>'105',
		   'v_responce_status'=>'Suggested',
		   'school_id'=>$school_id
		);
   
		$this->db->insert('tbl_sponsorer', $data); 
		//call webservece
		$this->db->select('std_complete_name,id');
									$this->db->from('tbl_student');
									$this->db->where('id',$user_id);
									$this->db->where('school_id',$school_id);
									$query1=$this->db->get();
									//$query->['t_complete_name']
									$stud_name =$query1->result()[0]->std_complete_name;
									
			 
			 $server_name = $_SERVER['SERVER_NAME'];
			 
							
									$data = array('Action_Description'=>'Suggest Sponsor',
												'Actor_Mem_ID'=>$user_id,
												'Actor_Name'=>$stud_name,
												'Actor_Entity_Type'=>105,
												'Second_Receiver_Mem_Id'=>'',
												'Second_Party_Receiver_Name'=>'Cookie Admin',
												'Second_Party_Entity_Type'=>113,
												'Third_Party_Name'=>'',
												'Third_Party_Entity_Type'=>'',
												'Coupon_ID'=>'',
												'Points'=>'',
												'Product'=>'',
												'Value'=>'',
												'Currency'=>''
							);
							
							$ch = curl_init("http://$server_name/core/Version2/master_action_log_ws.php"); 	
							
							
							$data_string = json_encode($data);    
							curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");    
							curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);  
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);      
							curl_setopt($ch, CURLOPT_HTTPHEADER, array('ContentType: application/json','ContentLength: ' . strlen($data_string)));
							$result = json_decode(curl_exec($ch),true);
			 
			 //end	
		
		$data = array(
		   'from_entity'=>$entity,
		   'from_user_id'=>$user_id,
		   'to_entity'=>4,
		   'to_user_id'=>$this->db->insert_id(),
		   'active_status'=>0
		);

		$this->db->insert('tbl_like_status', $data); 
	}
}	