<em></em><!--
Reshma Karande
Date: 05/01/2016
Model: Student
Project :Smartcookie

-->


<?php

class Student extends CI_Model
{

    //for Authentication purpose
    public function can_log_in()
    {

        $entity = $this->input->post('entity');
        $this->db->where('std_username ', $this->input->post('username'));
        $this->db->or_where('std_email ', $this->input->post('username'));
        $this->db->or_where('std_phone', $this->input->post('username'));
        $this->db->or_where('std_PRN', $this->input->post('username'));
        $this->db->where('std_password', $this->input->post('password'));
        $query = $this->db->get($entity);


        if ($query->num_rows() == 1) {
            foreach ($query->result() as $row) {
                $std_PRN = $row->std_PRN;
                return $std_PRN;
            }
        } else {
            return false;
        }

    }


    //for Getting student Information
    public function studentinfo($std_PRN, $school_id)
    {

        //$st_mem_id1 = $st_mem_id[0]->id;

        $this->db->select('s.id,s.std_PRN,s.std_complete_name,s.std_name,s.std_Father_name,s.std_lastname,s.std_school_name,s.school_id,s.std_branch,s.std_dept,
					s.std_year,s.std_semester,s.std_class,s.std_address,s.std_city,s.std_country,s.std_gender,s.std_img_path,s.std_email,s.latitude,
					s.longitude,s.Email_Internal,s.std_phone,s.used_blue_points,s.balance_bluestud_points,s.balance_water_points,s.Academic_Year,s.Course_level,c.teacher_id,c.stud_id,c.status,c.pointdate,s.country_code');
        $this->db->from('tbl_student s');
        $this->db->join('tbl_coordinator c', 's.id=c.stud_id or s.std_PRN=c.stud_id', 'left');
        //$this->db->join('tbl_coordinator c','s.std_PRN=c.stud_id','left');

        $this->db->where('s.school_id', $school_id);
        $this->db->where('s.std_PRN', $std_PRN);


        //$str=$this->db->get_compiled_select();
        //echo $str;
        $query = $this->db->get();
        return $res1 = $query->result();


        //	$this->db->select('r.imagepath');
//	$this->db->from('softreward r');
//	$this->db->join(' purcheseSoftreward s','s.reward_id=r.softrewardId	');
//	$this->db->where('s.user_id',$std_PRN);
        //$this->db->where('s.school_id',$school_id);
//	$query=$this->db->get();
//	$res2 =  $query->result();
//	$res = array_merge($res1,$res2);
//	return $res ;


    }

    public function studentinfowithusername($username)
    {


        $this->db->select('s.id,s.std_PRN,s.std_complete_name,s.std_name,s.std_Father_name,s.std_lastname,s.std_school_name,s.school_id,s.std_branch,s.std_dept,
					s.std_year,s.std_semester,s.std_class,s.std_address,s.std_city,s.std_country,s.std_gender,s.std_img_path,s.std_email,s.latitude,
					s.longitude,s.Email_Internal,s.std_phone,s.used_blue_points,s.balance_bluestud_points,s.balance_water_points,s.Academic_Year,s.Course_level,c.teacher_id,c.stud_id,c.status,c.pointdate,s.country_code');
        $this->db->from('tbl_student s');
        $this->db->join('tbl_coordinator c', 's.id=c.stud_id', 'left');

        $this->db->where('std_email', $username);
        //$this->db->where('s.school_id',$school_id);
        //$str=$this->db->get_compiled_select();
        //echo $str;
        $query = $this->db->get();
        return $res1 = $query->result();


        //	$this->db->select('r.imagepath');
//	$this->db->from('softreward r');
//	$this->db->join(' purcheseSoftreward s','s.reward_id=r.softrewardId	');
//	$this->db->where('s.user_id',$std_PRN);
        //$this->db->where('s.school_id',$school_id);
//	$query=$this->db->get();
//	$res2 =  $query->result();
//	$res = array_merge($res1,$res2);
//	return $res ;


    }


    // For Student Points Information

    public function studentpointsinfo($std_PRN, $school_id)
    {
        /*echo "<pre>";
        die(print_r($school_id, TRUE));*/
        $this->db->select('sc_total_point,yellow_points,purple_points,online_flag,brown_point');
        $this->db->from('tbl_student_reward');
        $this->db->where('sc_stud_id', $std_PRN);
        $this->db->where('school_id', $school_id);


        $query = $this->db->get();
        return $query->result();
        //return $query->row();
        /*echo "<pre>";
        die(print_r($p, TRUE));*/
    }
	public function studentwaterpointsinfo($std_PRN, $school_id)
    {
        /*echo "<pre>";
        die(print_r($school_id, TRUE));*/
        $this->db->select('balance_water_points');
        $this->db->from('tbl_student');
        $this->db->where('std_PRN', $std_PRN);
        $this->db->where('school_id', $school_id);


        $query = $this->db->get();
        return $query->result();
        //return $query->row();
        /*echo "<pre>";
        die(print_r($p, TRUE));*/
    }
	
    /*public function studentpointsinfowithusername($username)
    {
        $this->db->select('sc_total_point,yellow_points,purple_points,online_flag');
        $this->db->from('tbl_student_reward');
        $this->db->where('std_email',$username);
        $query=$this->db->get();
        return $query->result();
    }*/
    // For Student Smartcookie Coupon List
    public function studentsmartcookie_coupons($std_PRN, $school_id)
    {
        $this->db->select('id,stud_complete_name,amount,cp_code,cp_gen_date,validity');
        $this->db->from('tbl_coupons');
        $this->db->where('cp_stud_id', $std_PRN);
        $this->db->where('school_id', $school_id);
        $where = '(status="p" or status = "yes")';
        $this->db->where($where);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
    }
    /*public function studentsmartcookie_couponswithusername($username)
    {
        $this->db->select('id,amount,cp_code,cp_gen_date,validity');
        $this->db->from('tbl_coupons');
        $this->db->where('std_email',$username);
        $where = '(status="p" or status = "yes")';
        $this->db->where($where);
        $this->db->order_by("id", "desc");
        $query=$this->db->get();
        return  $query->result();
    }*/

    // For Student Reward log from Teacher
    public function rewardlog($std_PRN, $school_id)
    {
        $this->db->select('sp.sc_point,
							   sp.sc_studentpointlist_id,t.t_name,t.t_lastname,
							   t.t_complete_name,
							   sp.point_date,
							   IF(sp.activity_type = "activity", (SELECT sc_list FROM tbl_studentpointslist WHERE sc_id = 
							   sp.sc_studentpointlist_id limit 1 ),(select s.subjectName from tbl_student_subject_master s where 
							   s.subjcet_code=sp.sc_studentpointlist_id  and s.student_id="' . $std_PRN . '" limit 1)) as reason');
        $this->db->from('tbl_student_point sp');
        $this->db->join('tbl_teacher t', 'sp.sc_teacher_id = t.t_id');
        $this->db->where('sp.sc_entites_id', 103);
        $this->db->where('sp.sc_stud_id', $std_PRN);
        $this->db->where('sp.school_id', $school_id);		 $this->db->where('t.school_id', $school_id);
        $this->db->order_by("sp.id", "desc");


        $query = $this->db->get();
        return $query->result();


    }
    /*echo "select sp.sc_point,
                   sp.point_date,
                   st.std_complete_name,
        from tbl_student_point sp
        join tbl_student st on sp.sc_stud_id = st.std_PRN
        where sp.sc_entites_id='102	'
        where sp.sc_stud_id='$std_PRN'";


    select st.sc_point,st.point_date,st.reason,st.school_id from tbl_student_point st join tbl_studentpointslist sl on sl.sc_id=st.sc_studentpointlist_id where st.sc_stud_id='$std_PRN' and st.sc_entites_id='102' and st.school_id='$school_id'
        select st.sc_point,st.point_date,st.reason,st.school_id,
                        sc_list FROM tbl_studentpointslist  WHERE sc_id =
                   st.sc_studentpointlist_id

        from tbl_student_point st
        join  tbl_student tc', 'st.sc_stud_id = tc.std_PRN
        where st.sc_entites_id='102'
        and st.sc_stud_id='$std_PRN'



        */

    // For Student Reward log from School Admin
    public function rewardschooladmin($std_PRN, $school_id)
    {

        /*select st.sc_point,st.point_date,st.reason,st.school_id from tbl_student_point st join tbl_studentpointslist sl on sl.sc_id=st.sc_studentpointlist_id where st.sc_stud_id='$std_PRN' and st.sc_entites_id='102' and st.school_id='$school_id'*/
        $this->db->distinct();
        $this->db->select(
            'st.sc_point,st.point_date,st.reason,st.school_id,stp.sc_list,stp.sc_id');
        $this->db->from('tbl_studentpointslist stp');
        $this->db->join('tbl_student_point st', 'st.sc_studentpointlist_id=stp.sc_id');
        $this->db->join('tbl_student tc', 'st.sc_stud_id = tc.std_PRN');
        $this->db->where('st.sc_entites_id', 102);
        $this->db->where('st.sc_stud_id', $std_PRN);
        $this->db->where('st.school_id', $school_id);

        $this->db->order_by("st.id", "desc");

        $query = $this->db->get();
        return $query->result();
    }


    // For parent log
    public function parentlog($std_PRN, $school_id)
    {
        $this->db->select('Mother_name,Father_name,email_id,Phone,Occupation');
        $this->db->from('tbl_parent');
        $this->db->where('std_PRN', $std_PRN);
        $query = $this->db->get();
        return $query->result();


    }

    //Reward Log History
    public function softreward_log1($std_PRN, $school_id)
    {
        $this->db->select('r.imagepath,r.rewardType,s.point,s.date');
        $this->db->from('softreward r');
        $this->db->join(' purcheseSoftreward s', 's.reward_id=r.softrewardId	');
        $this->db->where('s.user_id', $std_PRN);
        $this->db->where('s.school_id', $school_id);
        $this->db->order_by("s.date", "desc");

        $query = $this->db->get();
        return $query->result();


    }


    //For Student Reward log from Student Coordinator

    public function rewardcoordinatorlog($std_PRN, $school_id)
    {
        $this->db->select('sp.sc_stud_id,
					sp.sc_entites_id,
					sp.sc_teacher_id,
					sp.sc_studentpointlist_id,
					sp.sc_point,
					sp.sc_outofpoint,
					sp.point_date,
					sp.coordinate_id,
					s.std_complete_name AS student,
					st.std_complete_name AS coordinator,
					t.t_complete_name AS teacher,
					
					IF(sp.activity_type = "activity",
					(SELECT sc_list FROM tbl_studentpointslist WHERE sc_id = 
							   sp.sc_studentpointlist_id limit 1 ),
							   (select s.subjectName from tbl_student_subject_master s where 
							   s.subjcet_code=sp.sc_studentpointlist_id  and s.student_id="' . $std_PRN . '" limit 1)) as reason');


        $this->db->from('tbl_student_point sp');
        $this->db->join('tbl_student s', 'sp.sc_stud_id = s.std_PRN', 'left');
        $this->db->join('tbl_student st', 'sp.coordinate_id = st.std_PRN', 'left');
        $this->db->join('tbl_teacher t', 'sp.sc_teacher_id = t.t_id', 'left');
        $this->db->where('sp.sc_entites_id', 111);
        $this->db->where('sp.sc_stud_id', $std_PRN);
        $this->db->where('sp.school_id', $school_id);
        $this->db->order_by('sp.id', 'desc');
        $query = $this->db->get();
        return $query->result();


    }


    // Smartcookie Used Coupon Log
    public function usedcoupon_log($std_PRN)

    {

        $this->db->select('sp.sp_name,ac.points,ac.product_name,ac.coupon_id,ac.issue_date');
        $this->db->from('tbl_accept_coupon ac');
        $this->db->join('tbl_sponsorer sp', ' sp.id=ac.sponsored_id');
        $this->db->where('ac.stud_id', $std_PRN);
        $this->db->order_by("sp.id", "desc");
        $query = $this->db->get();
        return $query->result();
    }


    // Self Motivation Points Log
    public function self_motivation_log($std_PRN)

    {
        $this->db->select('reason,sc_point,point_date');
        $this->db->from('tbl_student_point');
        $this->db->where('sc_stud_id', $std_PRN);
        $this->db->where('sc_teacher_id', $std_PRN);
        $this->db->where('sc_entites_id', 110);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
    }


    // Blue Points Log
    public function thanq_points_log($std_PRN, $school_id)

    {

        $this->db->select('s.t_name,s.t_lastname,s.t_complete_name,sp.sc_point,sp.sc_thanqupointlist_id,t.t_list,sp.point_date');
        $this->db->from('tbl_teacher_point sp');
        $this->db->join('tbl_teacher s', 's.t_id=sp.sc_teacher_id');
        $this->db->join('tbl_thanqyoupointslist t', 'sp.sc_thanqupointlist_id=t.id', 'left');
        $this->db->where('t.school_id', $school_id);
        $this->db->where('sp.sc_entities_id', 105);
        $this->db->where('sp.assigner_id', $std_PRN);
        $this->db->order_by("sp.id", "desc");
        $query = $this->db->get();
        return $query->result();
    }


    // Shared points Log
    public function sharedlog($std_PRN, $school_id)
    {


        $this->db->select('s.std_PRN,s.std_name,s.std_lastname,s.std_Father_name,s.std_complete_name,sp.sc_point,sp.reason,sp.point_date');
        $this->db->from('tbl_student_point sp');
        $this->db->join('tbl_student s', 'sp.sc_stud_id=s.std_PRN');
        $this->db->where('sp.sc_entites_id', '105');
        $this->db->where('sp.sc_teacher_id', $std_PRN);
        $this->db->order_by("sp.id", "desc");
        $query = $this->db->get();
        return $query->result();

    }


    // Friendship Points Log
    public function friendshiplog($std_PRN, $school_id)
    {
        $this->db->select('s.std_PRN,s.std_name,s.std_lastname,s.std_Father_name,s.std_complete_name,sp.sc_point,sp.reason,sp.point_date');
        $this->db->from('tbl_student_point sp');
        $this->db->join('tbl_student s', 'sp.sc_teacher_id=s.std_PRN');
        $this->db->where('sp.sc_entites_id', '105');
        $this->db->where('sp.sc_stud_id', $std_PRN);
        $this->db->order_by("sp.id", "desc");
        $query = $this->db->get();
        return $query->result();

    }


    public function purple_points_log($std_PRN, $school_id)
    {

        $this->db->select('s.Name, sp.sc_point,sp.sc_studentpointlist_id,sp.activity_type, sp.point_date,st.sc_list');
        $this->db->from('tbl_student_point sp');
        $this->db->join('tbl_parent s', 'sp.sc_teacher_id = s.Id');
        $this->db->join('tbl_studentpointslist st', 'sc_id=sp.sc_studentpointlist_id');
        $this->db->where('sp.sc_entites_id', 106);
        $this->db->where('sp.sc_stud_id', $std_PRN);
        $this->db->where('st.school_id', $school_id);
        $this->db->order_by("sp.id", "desc");


        $query = $this->db->get();
        return $query->result();
    }

    public function accepted_requests_log($std_PRN, $school_id)
    {
        $this->db->select('s.std_PRN,s.std_name,s.std_complete_name,sp.sc_point,sp.reason,sp.point_date');
        $this->db->from('tbl_student_point sp');
        $this->db->join('tbl_student s', 'sp.sc_stud_id=s.std_PRN ');
        $this->db->where('sp.sc_entites_id', 105);
        $this->db->where('sp.sc_teacher_id', $std_PRN);
        $this->db->where('sp.school_id', $school_id);
        $this->db->order_by("sp.id", "desc");
        $query = $this->db->get();
        return $query->result();


    }


    public function send_requests_log($std_PRN, $school_id)

    {
        $this->db->select('s.std_PRN,s.std_name,s.std_complete_name,s.std_lastname,r.points,r.reason,r.flag,r.requestdate');
        $this->db->from('tbl_student s');
        $this->db->join('tbl_request r', 'r.stud_id2=s.std_PRN');
        $this->db->where('r.entitity_id', 105);
        $this->db->where('r.stud_id1', $std_PRN);
        $this->db->where('s.school_id', $school_id);
        $this->db->order_by("r.id", "desc");
        $query = $this->db->get();
        return $query->result();

        //$sql1="select  from tbl_student s join tbl_request r on    and ='105' and r.stud_id1='$std_PRN' order by desc";
    }

    public function assign_points_log($std_PRN, $school_id)
    {
        $this->db->select('sp.sc_stud_id,
					sp.sc_entites_id,
					sp.sc_teacher_id,
					sp.sc_studentpointlist_id,
					sp.sc_point,
					sp.sc_outofpoint,
					sp.point_date,
					sp.coordinate_id,
					s.std_complete_name AS student,
					st.std_complete_name AS coordinator,
					t.t_complete_name AS teacher,
					
					IF(sp.activity_type = "activity",
					(SELECT sc_list FROM tbl_studentpointslist WHERE sc_id = 
							   sp.sc_studentpointlist_id limit 1 ),
							  (SELECT subject from tbl_school_subject where Subject_Code=sc_studentpointlist_id and school_id="' . $school_id . '" limit 1)) as reason');


        $this->db->from('tbl_student_point sp');
        $this->db->join('tbl_student s', 'sp.sc_stud_id = s.std_PRN', 'left');
        $this->db->join('tbl_student st', 'sp.coordinate_id = st.std_PRN', 'left');
        $this->db->join('tbl_teacher t', 'sp.sc_teacher_id = t.t_id', 'left');
        $this->db->where('sp.sc_entites_id', 111);
        $this->db->where('sp.coordinate_id', $std_PRN);
        $this->db->where('sp.school_id', $school_id);
        $this->db->order_by('sp.id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }


    public function get_student_member_id($std_PRN, $school_id)
    {
        $this->db->select('*');

        $this->db->from('tbl_student');
        $this->db->where('std_PRN', $std_PRN);
        $this->db->where('school_id', $school_id);
        $query = $this->db->get();
        return $query->result();

        /*echo "<pre>";
        die(print_r($data, TRUE));*/
    }

    // Smartcookie Coupon Generation
    public function student_generate_coupon($std_PRN,$school_id, $st_mem_id,$select_opt)
    {
		$st_mem_id1 = $st_mem_id[0]->id;



        if ($st_mem_id[0]->std_complete_name != '') {



            $stdname = ucwords(strtolower($st_mem_id[0]->std_complete_name));



        } else {



            $stdname = ucwords(strtolower($st_mem_id[0]->std_name . " " . $st_mem_id[0]->std_Father_name . " " . $st_mem_id[0]->std_lastname));



        }
		
		
		echo $points = $this->input->post('points');
		
		
		
			
						
		
			switch ($select_opt) {
			case "1":
						//if(sc_total_point<100)


						$this->db->select('sc_total_point');
						$this->db->from('tbl_student_reward');
						$this->db->where('sc_stud_id', $std_PRN);
						/* add pravin*/
						$this->db->where('school_id', $school_id);

						$query1 = $this->db->get();

						foreach ($query1->result() as $row1) {
							echo $sc_total_point1 = $row1->sc_total_point;
						}
						echo "<script>console.log($sc_total_point1)</script>";
						echo "<script>console.log($points)</script>";
						echo "<script>console.log($sc_total_point1 - $points)</script>";
						
						if(!($points>$sc_total_point1))
						{
							$this->db->select('id');
						$this->db->from('tbl_coupons');
						$this->db->order_by("id", "desc");
						$this->db->limit(1);
						$query = $this->db->get();

						foreach ($query->result() as $row) {
							$id = $row->id;
						}

						$id = $id + 1;
						$chars = "0123456789";
						$res = "";

						for ($i = 0; $i < 9; $i++) {
							$res .= $chars[mt_rand(0, strlen($chars) - 1)];
						}

						$id = $id . "" . $res;
						$date = date('d/m/Y');
						$d = strtotime("+6 Months -1 day");
						$validity = date("d/m/Y", $d);
						$data = array('Stud_Member_Id' => $st_mem_id1,
							'school_id' => $school_id, 'cp_stud_id' => $std_PRN,
							'stud_complete_name' => $stdname, 'cp_stud_id' => $std_PRN,
							'cp_code' => $id,
							'amount' => $points,
							'status' => 'yes',
							'validity' => $validity,
							'cp_gen_date' => $date
						);
						$this->db->insert('tbl_coupons', $data);
						echo $sc_total_point = $sc_total_point1 - $points;
						$data1 = array(
							'sc_total_point' => $sc_total_point
						);


						$this->db->where('sc_stud_id', $std_PRN);
						$this->db->where('school_id', $school_id);
						$this->db->update('tbl_student_reward', $data1);
						}
						else
						{
							
							echo "<script>alert('you dont have sufficient point')</script>";
						}
						
							
							break;
			
			case "2":
			
						echo"yellow";
						$this->db->select('yellow_points');
						$this->db->from('tbl_student_reward');
						$this->db->where('sc_stud_id', $std_PRN);
						/* add pravin*/
						$this->db->where('school_id', $school_id);

						$query1 = $this->db->get();

						foreach ($query1->result() as $row1) {
							echo $yellow_points1 = $row1->yellow_points;
						}
						echo "<script>console.log($yellow_points1)</script>";
						echo "<script>console.log($points)</script>";
						echo "<script>console.log($yellow_points1 - $points)</script>";
						
						
						echo "<script>alert('$points')</script>";
						echo "<script>alert('$yellow_points1')</script>";
						echo "<script>alert($points>$yellow_points1)</script>";
						if(!($points>$yellow_points1))
						{
							$this->db->select('id');
						$this->db->from('tbl_coupons');
						$this->db->order_by("id", "desc");
						$this->db->limit(1);
						$query = $this->db->get();

						foreach ($query->result() as $row) {
							$id = $row->id;
						}

						$id = $id + 1;
						$chars = "0123456789";
						$res = "";

						for ($i = 0; $i < 9; $i++) {
							$res .= $chars[mt_rand(0, strlen($chars) - 1)];
						}

						$id = $id . "" . $res;
						$date = date('d/m/Y');
						$d = strtotime("+6 Months -1 day");
						$validity = date("d/m/Y", $d);
						$data = array('Stud_Member_Id' => $st_mem_id1,
							'school_id' => $school_id, 'cp_stud_id' => $std_PRN,
							'stud_complete_name' => $stdname, 'cp_stud_id' => $std_PRN,
							'cp_code' => $id,
							'amount' => $points,
							'status' => 'yes',
							'validity' => $validity,
							'cp_gen_date' => $date
						);
						$this->db->insert('tbl_coupons', $data);
						echo $yellow_points = $yellow_points1 - $points;
						$data1 = array(
							'yellow_points' => $yellow_points
						);


						$this->db->where('sc_stud_id', $std_PRN);
						$this->db->where('school_id', $school_id);
						$this->db->update('tbl_student_reward', $data1);
						}
						else
						{
							echo "<script>alert('you dont have sufficient point')</script>";
						}
						
						/*else
						{
							echo "<script>alert('not')</script>";
						}*/
						
							
			break;
			case "3":
						
					echo"purple";
						$this->db->select('purple_points');
						$this->db->from('tbl_student_reward');
						$this->db->where('sc_stud_id', $std_PRN);
						/* add pravin*/
						$this->db->where('school_id', $school_id);

						$query1 = $this->db->get();

						foreach ($query1->result() as $row1) {
							echo $purple_points1 = $row1->purple_points;
						}
						echo "<script>console.log($purple_points1)</script>";
						echo "<script>console.log($points)</script>";
						echo "<script>console.log($purple_points1 - $points)</script>";
						
						
						
						if(!($points>$purple_points1))
						{
						
						$this->db->select('id');
						$this->db->from('tbl_coupons');
						$this->db->order_by("id", "desc");
						$this->db->limit(1);
						$query = $this->db->get();

						foreach ($query->result() as $row) {
							$id = $row->id;
						}

						$id = $id + 1;
						$chars = "0123456789";
						$res = "";

						for ($i = 0; $i < 9; $i++) {
							$res .= $chars[mt_rand(0, strlen($chars) - 1)];
						}

						$id = $id . "" . $res;
						$date = date('d/m/Y');
						$d = strtotime("+6 Months -1 day");
						$validity = date("d/m/Y", $d);
						$data = array('Stud_Member_Id' => $st_mem_id1,
							'school_id' => $school_id, 'cp_stud_id' => $std_PRN,
							'stud_complete_name' => $stdname, 'cp_stud_id' => $std_PRN,
							'cp_code' => $id,
							'amount' => $points,
							'status' => 'yes',
							'validity' => $validity,
							'cp_gen_date' => $date
						);
						$this->db->insert('tbl_coupons', $data);
						echo $purple_points = $purple_points1 - $points;
						$data1 = array(
							'purple_points' => $purple_points
						);


						$this->db->where('sc_stud_id', $std_PRN);
						$this->db->where('school_id', $school_id);
						$this->db->update('tbl_student_reward', $data1);
						}
						else
						{
							
							echo "<script>alert('you dont have sufficient point')</script>";
						}
			break;
			case "4":
					
					
					$this->db->select('balance_water_points');
					$this->db->from('tbl_student');
					$this->db->where('std_PRN', $std_PRN);
					/* add pravin*/
					$this->db->where('school_id', $school_id);

					$query1 = $this->db->get();

					foreach ($query1->result() as $row1) {
						echo $balance_water_points1 = $row1->balance_water_points;
					}
					
					
					
					if(!($points>$balance_water_points1))
						{
					
					$this->db->select('id');
						$this->db->from('tbl_coupons');
						$this->db->order_by("id", "desc");
						$this->db->limit(1);
						$query = $this->db->get();

						foreach ($query->result() as $row) {
							$id = $row->id;
						}

						$id = $id + 1;
						$chars = "0123456789";
						$res = "";

						for ($i = 0; $i < 9; $i++) {
							$res .= $chars[mt_rand(0, strlen($chars) - 1)];
						}

						$id = $id . "" . $res;
						$date = date('d/m/Y');
						$d = strtotime("+6 Months -1 day");
						$validity = date("d/m/Y", $d);
						$data = array('Stud_Member_Id' => $st_mem_id1,
							'school_id' => $school_id, 'cp_stud_id' => $std_PRN,
							'stud_complete_name' => $stdname, 'cp_stud_id' => $std_PRN,
							'cp_code' => $id,
							'amount' => $points,
							'status' => 'yes',
							'validity' => $validity,
							'cp_gen_date' => $date
						);
						$this->db->insert('tbl_coupons', $data);
					echo "<script>console.log($balance_water_points1)</script>";
					echo "<script>console.log($points)</script>";
					echo "<script>console.log($balance_water_points1 - $points)</script>";
					echo $balance_water_points = $balance_water_points1 - $points;
					$data1 = array(
						'balance_water_points' => $balance_water_points
					);


					$this->db->where('std_PRN', $std_PRN);
					$this->db->where('school_id', $school_id);
					$this->db->update('tbl_student', $data1);

						}
						else
						{
							
							echo "<script>alert('you dont have sufficient point')</script>";
						}
						
			break;
			case "5":
						
					echo"brown";
						$this->db->select('brown_point');
						$this->db->from('tbl_student_reward');
						$this->db->where('sc_stud_id', $std_PRN);
						/* add pravin*/
						$this->db->where('school_id', $school_id);

						$query1 = $this->db->get();

						foreach ($query1->result() as $row1) {
							echo $brown_point1 = $row1->brown_point;
						}
						echo "<script>console.log($brown_point1)</script>";
						echo "<script>console.log($points)</script>";
						echo "<script>console.log($brown_point1 - $points)</script>";
						
						
						
						if(!($points>$brown_point1))
						{
						
						$this->db->select('id');
						$this->db->from('tbl_coupons');
						$this->db->order_by("id", "desc");
						$this->db->limit(1);
						$query = $this->db->get();

						foreach ($query->result() as $row) {
							$id = $row->id;
						}

						$id = $id + 1;
						$chars = "0123456789";
						$res = "";

						for ($i = 0; $i < 9; $i++) {
							$res .= $chars[mt_rand(0, strlen($chars) - 1)];
						}

						$id = $id . "" . $res;
						$date = date('d/m/Y');
						$d = strtotime("+6 Months -1 day");
						$validity = date("d/m/Y", $d);
						$data = array('Stud_Member_Id' => $st_mem_id1,
							'school_id' => $school_id, 'cp_stud_id' => $std_PRN,
							'stud_complete_name' => $stdname, 'cp_stud_id' => $std_PRN,
							'cp_code' => $id,
							'amount' => $points,
							'status' => 'yes',
							'validity' => $validity,
							'cp_gen_date' => $date
						);
						$this->db->insert('tbl_coupons', $data);
						echo $brown_point = $brown_point1 - $points;
						$data1 = array(
							'brown_point' => $brown_point
						);


						$this->db->where('sc_stud_id', $std_PRN);
						$this->db->where('school_id', $school_id);
						$this->db->update('tbl_student_reward', $data1);
						}
						else
						{
							
							echo "<script>alert('you dont have sufficient point')</script>";
						}
			break;

       /* echo $points = $this->input->post('points');
        $this->db->select('id');
        $this->db->from('tbl_coupons');
        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        $query = $this->db->get();

        foreach ($query->result() as $row) {
            $id = $row->id;
        }

        $id = $id + 1;
        $chars = "0123456789";
        $res = "";

        for ($i = 0; $i < 9; $i++) {
            $res .= $chars[mt_rand(0, strlen($chars) - 1)];
        }

        $id = $id . "" . $res;
        $date = date('d/m/Y');
        $d = strtotime("+6 Months -1 day");
        $validity = date("d/m/Y", $d);
        $data = array('Stud_Member_Id' => $st_mem_id1,
            'school_id' => $school_id, 'cp_stud_id' => $std_PRN,
            'stud_complete_name' => $stdname, 'cp_stud_id' => $std_PRN,
            'cp_code' => $id,
            'amount' => $points,
            'status' => 'yes',
            'validity' => $validity,
            'cp_gen_date' => $date
        );
        $this->db->insert('tbl_coupons', $data);

        $this->db->select('sc_total_point');
        $this->db->from('tbl_student_reward');
        $this->db->where('sc_stud_id', $std_PRN);
        /* add pravin*/
        /*$this->db->where('school_id', $school_id);

        $query1 = $this->db->get();

        foreach ($query1->result() as $row1) {
            echo $sc_total_point1 = $row1->sc_total_point;
        }
        echo "<script>console.log($sc_total_point1)</script>";
        echo "<script>console.log($points)</script>";
        echo "<script>console.log($sc_total_point1 - $points)</script>";
        echo $sc_total_point = $sc_total_point1 - $points;
        $data1 = array(
            'sc_total_point' => $sc_total_point
        );


        $this->db->where('sc_stud_id', $std_PRN);
        $this->db->where('school_id', $school_id);
        $this->db->update('tbl_student_reward', $data1);*/

    };
	
	$this->db->select('std_complete_name,id');
									$this->db->from('tbl_student');
									$this->db->where('std_PRN',$std_PRN);
									$this->db->where('school_id',$school_id);
									$query1=$this->db->get();
									//$query->['t_complete_name']
									$stud_name =$query1->result()[0]->std_complete_name;
									$stud_id =$query1->result()[0]->id;
			 
			 $server_name = $_SERVER['SERVER_NAME'];
			 
							
									$data = array('Action_Description'=>'Generate Smartcookie Coupon',
												'Actor_Mem_ID'=>$stud_id,
												'Actor_Name'=>$stud_name,
												'Actor_Entity_Type'=>105,
												'Second_Receiver_Mem_Id'=>'',
												'Second_Party_Receiver_Name'=>'',
												'Second_Party_Entity_Type'=>'',
												'Third_Party_Name'=>'',
												'Third_Party_Entity_Type'=>'',
												'Coupon_ID'=>$id,
												'Points'=>$points,
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
	}
	

    // Smartcookie Coupon Info
    public function smartcookie_coupon_info($id)
    {
        //	$st_mem_id1 = $st_mem_id[0]->id;
        $this->db->select('s.id,c.Stud_Member_Id,s.std_complete_name,s.std_school_name,c.cp_code,c.amount,c.cp_gen_date,c.validity');
        $this->db->from('tbl_coupons c');
        $this->db->join('tbl_student s', 's.id=c.Stud_Member_Id');
        $this->db->where('c.id', $id);
        $query = $this->db->get();
        return $data = $query->result();
    }


    //Unused Coupon Log
    public function unused_coupons($st_mem_id)
    {
        $st_mem_id1 = $st_mem_id[0]->id;
        $this->db->select('id,amount,cp_code,cp_gen_date,validity');
        $this->db->from('tbl_coupons');
        //$this->db->where('cp_stud_id',$std_PRN);
        $this->db->where('Stud_Member_Id', $st_mem_id1);
        $where = '(status = "yes")';
        $this->db->where($where);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
    }


    // Partially Used Coupon Log
    public function partiallyused_coupons($st_mem_id)
    {
        $st_mem_id1 = $st_mem_id[0]->id;

        $this->db->select('id,amount,cp_code,cp_gen_date,validity');
        $this->db->from('tbl_coupons');
        //$this->db->where('cp_stud_id',$std_PRN);
        $this->db->where('Stud_Member_Id', $st_mem_id1);
        $where = '(status = "p")';
        $this->db->where($where);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
    }


    //ThanQ Reason List
    public function thanqreasonlist($school_id)
    {
        $this->db->select('id,t_list');
        $this->db->from('tbl_thanqyoupointslist');
        $this->db->where('school_id', $school_id);
        $query = $this->db->get();

        return $query->result();
    }
	//student recognization( get all reason from new table)
	 public function getallreason($school_id)
    {
        $this->db->select('id,student_recognition');
        $this->db->from('tbl_student_recognition');
        $this->db->where('school_id', $school_id);
        $query = $this->db->get();

        return $query->result();
    }
	

    // Studenrt Semester Record Information
    public function student_semister_record($std_PRN, $school_id)
    {

        $this->db->select(' s.BranchName,s.DeptName,s.SemesterName,s.DivisionName, s.CourseLevel,s.AcdemicYear');
        $this->db->from('StudentSemesterRecord s');
        $this->db->join('tbl_academic_Year Y', ' Y.Year= s.AcdemicYear AND  Y.Enable=1');
        $this->db->where(' s.IsCurrentSemester', '1');
        $this->db->where('s.student_id', $std_PRN);

        //	$str=$this->db->get_compiled_select();
        //echo $str;die;
        $query = $this->db->get();
        return $query->result();

    }

    public function studentsearchlist($std_PRN, $school_id, $studentPRN, $studemail, $studphone, $studentname)
    {
        if ($studentPRN != "" && $school_id!= "") {
            $this->db->select('s.std_img_path,s.id,s.std_PRN,s.std_email,s.std_name,s.std_phone,s.std_address,s.std_Father_name,s.std_lastname,
					s.std_complete_name');
            $this->db->from('tbl_student s');
            $this->db->where('s.std_PRN', $studentPRN);
            $this->db->where('s.school_id',$school_id);

            $query = $this->db->get();
            return $query->result();
            /*$this->db->or_where('s.std_phone',$studphone);
            $this->db->or_where('s.std_email',$studemail);
            $this->db->or_where('s.std_complete_name',$studentname);*/
        } elseif ($studemail != "" && $school_id!= "") {
            $this->db->select('s.std_img_path,s.id,s.std_PRN,s.std_email,s.std_name,s.std_phone,s.std_address,s.std_Father_name,s.std_lastname,
					s.std_complete_name');
            $this->db->from('tbl_student s');
            $this->db->where('s.std_email', $studemail);
			$this->db->where('s.school_id',$school_id);
			
            $query = $this->db->get();
            return $query->result();
        } elseif ($studphone != "") {
            $this->db->select('s.std_img_path,s.id,s.std_PRN,s.std_email,s.std_name,s.std_phone,s.std_address,s.std_Father_name,s.std_lastname,
					s.std_complete_name');
            $this->db->from('tbl_student s');
            $this->db->or_where('s.std_phone', $studphone);
			$this->db->where('s.school_id',$school_id );
			
            $query = $this->db->get();
            return $query->result();
        } elseif ($studentname != "" && $school_id!= "") {
            $this->db->select('s.std_img_path,s.id,s.std_PRN,s.std_email,s.std_name,s.std_phone,s.std_address,s.std_Father_name,s.std_lastname,
					s.std_complete_name');
            $this->db->from('tbl_student s');
				
			$this->db->where('s.school_id',$school_id );
            $this->db->where('s.std_complete_name', $studentname);
            $this->db->or_where('s.std_name', $studentname);
            $this->db->or_where('s.std_Father_name', $studentname);
            $this->db->or_where('s.std_lastname', $studentname);
            //$this->db->or_where('s.std_name',$studentname);
            $query = $this->db->get();
            return $query->result();
        }

    }


    // Student List From Class or All college
    public function studentlist($std_PRN, $school_id, $BranchName, $DeptName, $SemesterName, $CourseLevel, $DivisionName)
    {
        //if($select_opt==1)
        //{
        $this->db->select('s.std_img_path,s.id,s.std_PRN,s.std_name,s.std_Father_name,s.std_lastname,s.std_complete_name');
        $this->db->from('tbl_student s');
        $this->db->join('StudentSemesterRecord ss', 'ss.student_id=s.std_PRN');
        $this->db->where('s.std_PRN!=', $std_PRN);
        $this->db->where('ss.BranchName', $BranchName);
        $this->db->where('ss.DeptName', $DeptName);
        $this->db->where('ss.IsCurrentSemester', 1);
        $this->db->where('ss.SemesterName', $SemesterName);
        $this->db->where('ss.DivisionName', $DivisionName);
        $this->db->where('ss.CourseLevel', $CourseLevel);
        $this->db->where('s.school_id', $school_id);
        $this->db->order_by('s.std_name');
        $query = $this->db->get();
		/*echo "<pre>";
		die(print_r($query,true));*/
		
		
        return $query->result();

    }
    /*elseif($select_opt==2)
    {
    $this->db->select('s.std_img_path,s.id,s.std_PRN,s.std_name,s.std_Father_name,s.std_lastname,
    s.std_complete_name');
    $this->db->from('tbl_student s');

    $this->db->where('s.std_PRN!=',$std_PRN);
    $this->db->where('s.school_id',$school_id);
    $this->db->order_by('s.std_name');
    $query=$this->db->get();
    return $query->result();
    }
    else
    {
        $this->db->select('s.std_img_path,s.id,s.std_PRN,s.std_name,s.std_Father_name,s.std_lastname,
    s.std_complete_name');
    $this->db->from('tbl_student s');
    $this->db->join('StudentSemesterRecord ss','ss.student_id=s.std_PRN');
    $this->db->where('s.std_PRN!=',$std_PRN);
    $this->db->where('ss.BranchName',$BranchName);
    $this->db->where('ss.DeptName',$DeptName);
    $this->db->where('ss.IsCurrentSemester',1);
    $this->db->where('ss.SemesterName',$SemesterName);
    $this->db->where('ss.DivisionName',$DivisionName);
    $this->db->where('ss.CourseLevel',$CourseLevel);
    $this->db->where('s.school_id',$school_id);
    $this->db->order_by('s.std_name');
    $query=$this->db->get();
    return $query->result();

    }

}
    */


    // coordinator info

    public function coordinator_info($school_id, $stud_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_coordinator c');
        $this->db->join('tbl_teacher t', 't.id=c.teacher_id');
        $this->db->where('c.school_id', $school_id);
        $this->db->where('c.stud_id', $stud_id);

        $query = $this->db->get();
        return $query->result();

    }

    // Share Points to Student
    public function sharepoints($school_id, $std_PRN, $student_id, $student_rewardpoints, $student_allpoints, $flag,$select_opt,$select_reason)
    {
        $points = $this->input->post('points');
        //$reason = $this->input->post('reason');
        $date = Date('d/m/Y');
		
		
		switch ($select_opt) {
			case "1":
							if(!($points>$student_rewardpoints))
							{
									if ($flag == 'Y') {
										$student_yellowpoints = $student_allpoints + $points;
										$data = array(
											'yellow_points' => $student_yellowpoints,
											'sc_date' => $date
										);

										$this->db->where('sc_stud_id', $student_id);
										$this->db->update('tbl_student_reward', $data);
									} else {

										$student_yellowpoints = $student_allpoints + $points;
										$data = array(
											'yellow_points' => $student_yellowpoints,
											'sc_date' => $date,
											'sc_stud_id' => $student_id
										);
										$this->db->insert('tbl_student_reward', $data);

									}
								$student_reward = $student_rewardpoints - $points;
								$data1 = array(
									'sc_total_point' => $student_reward,
									'sc_date' => $date
								);
								$this->db->where('sc_stud_id', $std_PRN);
								$this->db->update('tbl_student_reward', $data1);
								$data2 = array(
									'sc_entites_id' => '105',
									'sc_point' => $points,
									'sc_teacher_id' => $std_PRN,
									'sc_stud_id' => $student_id,
									//'reason' => $reason,
									'reason' => $select_reason,
									'point_date' => $date

								);
								$this->db->insert('tbl_student_point', $data2);
								$final_report = "you have successsfully assigned $points Greeen points";
							}
							else
							{
								$final_report = 'you do not have suffcient Green points';
								
							}
										break;
			case "2":
						if(!($points>$student_rewardpoints))
							{
							if ($flag == 'Y') {
										$student_yellowpoints = $student_allpoints + $points;
										$data = array(
											'yellow_points' => $student_yellowpoints,
											'sc_date' => $date
										);

										$this->db->where('sc_stud_id', $student_id);
										$this->db->update('tbl_student_reward', $data);
									} else {

										$student_yellowpoints = $student_allpoints + $points;
										$data = array(
											'yellow_points' => $student_yellowpoints,
											'sc_date' => $date,
											'sc_stud_id' => $student_id
										);
										$this->db->insert('tbl_student_reward', $data);

									}
						$student_reward = $student_rewardpoints - $points;
						$data1 = array(
							'yellow_points' => $student_reward,
							'sc_date' => $date
						);
						$this->db->where('sc_stud_id', $std_PRN);
						$this->db->update('tbl_student_reward', $data1);
						$data2 = array(
							'sc_entites_id' => '105',
							'sc_point' => $points,
							'sc_teacher_id' => $std_PRN,
							'sc_stud_id' => $student_id,
							//'reason' => $reason,
							'reason' => $select_reason,
							'point_date' => $date

						);
						$this->db->insert('tbl_student_point', $data2);
						$final_report = "you have successsfully assigned $points Yellow points";
						}
							else
							{
								$final_report = 'you do not have suffcient Yellow points';
							}
								break;
			case "3":
					
					if(!($points>$student_rewardpoints))
							{
					
					if ($flag == 'Y') {
										$student_yellowpoints = $student_allpoints + $points;
										$data = array(
											'yellow_points' => $student_yellowpoints,
											'sc_date' => $date
										);

										$this->db->where('sc_stud_id', $student_id);
										$this->db->update('tbl_student_reward', $data);
									} else {

										$student_yellowpoints = $student_allpoints + $points;
										$data = array(
											'yellow_points' => $student_yellowpoints,
											'sc_date' => $date,
											'sc_stud_id' => $student_id
										);
										$this->db->insert('tbl_student_reward', $data);

									}
										$student_reward = $student_rewardpoints - $points;
										$data1 = array(
											'purple_points' => $student_reward,
											'sc_date' => $date
										);
										$this->db->where('sc_stud_id', $std_PRN);
										$this->db->update('tbl_student_reward', $data1);
										$data2 = array(
											'sc_entites_id' => '105',
											'sc_point' => $points,
											'sc_teacher_id' => $std_PRN,
											'sc_stud_id' => $student_id,
											//'reason' => $reason,
											'reason' => $select_reason,
											'point_date' => $date

										);
										$this->db->insert('tbl_student_point', $data2);
										$final_report = "you have successsfully assigned $points Purple points";
										}
										
							else
							{
								$final_report = 'you do not have suffcient Purple points';
							}
												break;
		case "4":
		
		if(!($points>$student_rewardpoints))
							{
					if ($flag == 'Y') {
										$student_yellowpoints = $student_allpoints + $points;
										$data = array(
											'yellow_points' => $student_yellowpoints,
											'sc_date' => $date
										);

										$this->db->where('sc_stud_id', $student_id);
										$this->db->update('tbl_student_reward', $data);
									} else {

										$student_yellowpoints = $student_allpoints + $points;
										$data = array(
											'yellow_points' => $student_yellowpoints,
											'sc_date' => $date,
											'sc_stud_id' => $student_id
										);
										$this->db->insert('tbl_student_reward', $data);

									}
										$student_reward = $student_rewardpoints - $points;
										$data1 = array(
											'balance_water_points' => $student_reward
											
										);
										$this->db->where('std_PRN', $std_PRN);
										$this->db->update('tbl_student', $data1);
										$data2 = array(
											'sc_entites_id' => '105',
											'sc_point' => $points,
											'sc_teacher_id' => $std_PRN,
											'sc_stud_id' => $student_id,
											//'reason' => $reason,
											'reason' => $select_reason,
											'point_date' => $date

										);
										$this->db->insert('tbl_student_point', $data2);
										$final_report = "you have successsfully assigned $points Water points";
											}
											
							else
							{
								$final_report = 'you do not have suffcient Water points';
							}
												break;

		}
		
		return $final_report;
				
		

    }


    //assign points from coordinator to student

    public function assignpoints($school_id, $t_id, $student_id, $sc_total_point, $flag, $tc_balance_points, $std_PRN)
    {

        $points = $this->input->post('points');
        $activity = $this->input->post('activity');

// for general, Art, sports
        $reason = $this->input->post('activity_type');


        $date = Date('d/m/Y');


        if ($activity == 'activity') {
            $reason = $this->input->post('activitydisplay');

        }


        if ($flag == 'Y') {
            $sc_total_point = $sc_total_point + $points;
            $data = array(
                'sc_total_point' => $sc_total_point,
                'sc_date' => $date
            );

            $this->db->where('sc_stud_id', $student_id);
            $this->db->update('tbl_student_reward', $data);
        } else {

            $sc_total_point = $sc_total_point + $points;
            $data = array(
                'sc_total_point' => $sc_total_point,
                'sc_date' => $date,
                'sc_stud_id' => $student_id,
                'school_id' => $school_id
            );
            $this->db->insert('tbl_student_reward', $data);

        }

        $tc_balance_points = $tc_balance_points - $points;

        $data1 = array(
            'tc_balance_point' => $tc_balance_points


        );
        $this->db->where('t_id', $t_id);
        $this->db->where('school_id', $school_id);
        $this->db->update('tbl_teacher', $data1);

        $data2 = array(
            'sc_entites_id' => '111',
            'sc_point' => $points,
            'sc_teacher_id' => $t_id,
            'sc_stud_id' => $student_id,
            'sc_studentpointlist_id' => $reason,
            'method' => '1',
            'activity_type' => $activity,
            'coordinate_id' => $std_PRN,
            'point_date' => $date,
            'school_id' => $school_id

        );
        $this->db->insert('tbl_student_point', $data2);

        return true;


    }

    // Assign Blue Points to Teacher
    public function assignbluepoints($school_id, $std_PRN, $balance_teach_blue_points, $balance_stud_blue_points, $t_id)

    {

        $points = $this->input->post('points');
        $reason_id = $this->input->post('thanq_reason');
        $date = Date('d/m/Y');

        $teacher_blue_points = $balance_teach_blue_points + $points;
        $data = array(
            'balance_blue_points' => $teacher_blue_points
        );
        $this->db->where('t_id', $t_id);
        $this->db->update('tbl_teacher', $data);
        $student_blue_points = $balance_stud_blue_points - $points;
        $data1 = array(
            'balance_bluestud_points' => $student_blue_points
        );

        $this->db->where('std_PRN', $std_PRN);
        $this->db->update('tbl_student', $data1);

        $data2 = array(
            'sc_teacher_id' => $t_id,
            'sc_entities_id' => 105,
            'assigner_id' => $std_PRN,
            'sc_thanqupointlist_id' => $reason_id,
            'sc_point' => $points,
            'point_date' => $date
        );

        $this->db->insert('tbl_teacher_point', $data2);

 ///calling  master action log
									//teacher details
									$this->db->select('t_complete_name,id');
									$this->db->from('tbl_teacher');
									$this->db->where('t_id',$t_id);
									$this->db->where('school_id',$school_id);
									$query=$this->db->get();
									//$query->['t_complete_name']
									$t_name1 =$query->result()[0]->t_complete_name;
									$t_id1 =$query->result()[0]->id;
									//student details
									$this->db->select('std_complete_name,id');
									$this->db->from('tbl_student');
									$this->db->where('std_PRN',$std_PRN);
									$this->db->where('school_id',$school_id);
									$query1=$this->db->get();
									//$query->['t_complete_name']
									$stud_name =$query1->result()[0]->std_complete_name;
									$stud_id =$query1->result()[0]->id;
			 
			 $server_name = $_SERVER['SERVER_NAME'];
			 
							
									$data = array('Action_Description'=>'Assign ThanQ Points To Teacher',
												'Actor_Mem_ID'=>$stud_id,
												'Actor_Name'=>$stud_name,
												'Actor_Entity_Type'=>105,
												'Second_Receiver_Mem_Id'=>$t_id1,
												'Second_Party_Receiver_Name'=>$t_name1,
												'Second_Party_Entity_Type'=>103,
												'Third_Party_Name'=>'',
												'Third_Party_Entity_Type'=>'',
												'Coupon_ID'=>'',
												'Points'=>$points,
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
        // this code is core php
        //Message to be sent
        /*
        $row_student=mysql_query("select id from tbl_student where std_PRN='$std_PRN' and school_id='$school_id'");

                            $value_student=mysql_fetch_array($row_student);

                            $stdudentid=$value_student['id'];
$sql = mysql_query("select sc_list from  tbl_studentpointslist where sc_id='$reason_id'");
$result = mysql_fetch_array($sql);
$reasonofreward = $result['sc_list'];
$row=mysql_query("select gc.gcm_id,std_name,std_lastname from student_gcmid  gc left outer join tbl_student s on  gc.std_PRN=s.std_PRN where gc.student_id='$stdudentid' and s.school_id='$school_id'");
            while($value=mysql_fetch_array($row))
            {

        $Gcm_id=$value['gcm_id'];
        $message = "Reward Point | Hello ".trim(ucfirst(strtolower($value['std_name'])))." ".trim(ucfirst(strtolower($value['std_lastname']))).", your teacher ".$teacher_name." rewarded you ".$point." points for ".$reasonofreward;
            include('pushnotification.php');
            send_push_notification($Gcm_id, $message);

            }
        */


    }


    public function valid_card($card_no)
    {
        $date1 = date('m/d/Y');
        $this->db->select('*');
        $this->db->from('tbl_giftcards');
        $this->db->where('card_no', $card_no);
        $this->db->where('status', 'Unused');
        $query = $this->db->get();

        return $query->result();


    }


    public function student_purchase_points($card_no, $std_PRN, $school_id, $amount, $balance_water_points)
    {
        $date = date('d/m/Y');
        $data = array(
            'coupon_id' => $card_no,
            'entities_id' => '105',
            'issue_date' => $date,
            'stud_id' => $std_PRN,
            'school_id' => $school_id,
            'points' => $amount


        );


        $this->db->insert('tbl_waterpoint', $data);

        $water_points = $balance_water_points + $amount;


        $data1 = array(
            'balance_water_points' => $water_points,


        );
        $this->db->where('std_PRN', $std_PRN);
        $this->db->update('tbl_student', $data1);


        $data2 = array(
            'amount' => 0,
            'status' => 'Used',

        );

        $this->db->where('card_no', $card_no);
        $this->db->update('tbl_giftcards', $data2);

///calling  master action log
									//student details
									$this->db->select('std_complete_name,id');
									$this->db->from('tbl_student');
									$this->db->where('std_PRN',$std_PRN);
									$this->db->where('school_id',$school_id);
									$query1=$this->db->get();
									//$query->['t_complete_name']
									$stud_name =$query1->result()[0]->std_complete_name;
									$stud_id =$query1->result()[0]->id;
			 
			 $server_name = $_SERVER['SERVER_NAME'];
			 
							
									$data = array('Action_Description'=>'Purchased Water Point by student',
												'Actor_Mem_ID'=>$stud_id,
												'Actor_Name'=>$stud_name,
												'Actor_Entity_Type'=>105,
												'Second_Receiver_Mem_Id'=>'',
												'Second_Party_Receiver_Name'=>'',
												'Second_Party_Entity_Type'=>'',
												'Third_Party_Name'=>'',
												'Third_Party_Entity_Type'=>'',
												'Coupon_ID'=>$card_no,
												'Points'=>$amount,
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
    }


    public function purchase_softrewards()
    {
        $this->db->select('softrewardId,user,rewardType,fromRange,imagepath');
        $this->db->from('softreward');
        $this->db->where('user', 'Student');
        $query = $this->db->get();
        return $query->result();


    }

    public function purchase_reward($std_PRN, $school_id, $user_type, $reward_name, $reward_points)

    {


        // $prn=mysql_query("select sc_total_point from tbl_student_reward where sc_stud_id='$stud_PRN' and school_id='$sch_id'");


        $this->db->select('sc_total_point');
        $this->db->from('tbl_student_reward');
        $this->db->where('sc_stud_id', $std_PRN);
        $this->db->where('school_id', $school_id);
        $query = $this->db->get();
        $res1 = $query->result();
        //var_dump($res1);
        foreach ($res1 as $t) {
            $student_rewardpoints = $t->sc_total_point;
        }

        $this->db->select('*');
        $this->db->from(' softreward');
        $this->db->where('rewardType', $reward_name);
        $this->db->where('fromRange', $reward_points);
        $query = $this->db->get();
        $result = $query->result();

        foreach ($result as $t) {
            $reward_id = $t->softrewardId;
            $fromRange = $t->fromRange;
        }

        if ($student_rewardpoints >= $fromRange) {
            $final_sc_total_point = $student_rewardpoints - $fromRange;

            $data_point = array(
                "sc_total_point" => $final_sc_total_point);

            $this->db->where('sc_stud_id', $std_PRN);
            $this->db->where('school_id', $school_id);
            $this->db->update('tbl_student_reward', $data_point);


            $data = array(
                'user_id' => $std_PRN,
                'userType' => $user_type,
                'school_id' => $school_id,
                'reward_id' => $reward_id,
                'point' => $reward_points,

            );
            $res = $this->db->insert('purcheseSoftreward', $data);

//student details
									$this->db->select('std_complete_name,id');
									$this->db->from('tbl_student');
									$this->db->where('std_PRN',$std_PRN);
									$this->db->where('school_id',$school_id);
									$query1=$this->db->get();
									//$query->['t_complete_name']
									$stud_name =$query1->result()[0]->std_complete_name;
									$stud_id =$query1->result()[0]->id;
			 //call  webservice
			 $server_name = $_SERVER['SERVER_NAME'];
			 
							
									$data = array('Action_Description'=>'Purchased Soft Reward by Student',
												'Actor_Mem_ID'=>$stud_id,
												'Actor_Name'=>$stud_name,
												'Actor_Entity_Type'=>105,
												'Second_Receiver_Mem_Id'=>'',
												'Second_Party_Receiver_Name'=>'',
												'Second_Party_Entity_Type'=>'',
												'Third_Party_Name'=>'',
												'Third_Party_Entity_Type'=>'',
												'Coupon_ID'=>'',
												'Points'=>$reward_points,
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
            echo "<script>if(confirm('Are you sure you want Purchase Rewards...?'))
					{
								
					}
					else{
						redirect('/main/purchase_softrewards', 'refresh');
					}</script>";
            //echo "<script>alert(' Reward Purchased successfully')</script>";
        } else {
            echo "<script>alert('You Dont Have sufficient Point')</script>";


        }
        redirect('/main/purchase_softrewards', 'refresh');

    }

    public function display_reward($std_PRN, $school_id)
    {
        /*$this->db->select('*');
        $this->db->from('purcheseSoftreward');
        $this->db->where('user_id',$std_PRN);
        $this->db->where('school_id',$school_id);
        $query=$this->db->get();
        return $query->result();*/
        //$this->db->join('comments', 'comments.id = blogs.id');
        /*$this->db->select('r.id,r.stud_id1,r.requestdate,r.points,r.reason,s.std_name,s.std_Father_name,s.std_lastname,s.std_complete_name,s.std_img_path');
    $this->db->from('tbl_request r');
    $this->db->join('tbl_student s','r.stud_id1=s.std_PRN');
    $this->db->where('r.stud_id2',$std_PRN);
    $this->db->where('r.flag','N');
    $this->db->where('r.entitity_id',105);
    $this->db->where('r.school_id',$school_id);
    $this->db->order_by("r.id", "desc"); */
        $this->db->select('r.imagepath');
        $this->db->from('softreward r');
        $this->db->join(' purcheseSoftreward s', 's.reward_id=r.softrewardId	');
        $this->db->where('s.user_id', $std_PRN);
        $this->db->where('s.user_id', $school_id);
        $query = $this->db->get();
        return $query->result();


    }


    public function student_water_points_log($std_RPN, $school_id)
    {

        $this->db->select('coupon_id,points,issue_date');
        $this->db->from(' tbl_waterpoint');
        $this->db->where('school_id', $school_id);
        $this->db->where('stud_id', $std_RPN);


        $query = $this->db->get();
        return $query->result();


    }


    public function social_media()
    {
        $this->db->select('*');
        $this->db->from('tbl_social_points');
        $query = $this->db->get();

        return $query->result();

    }

    public function points_from_socialmedia($online_presence)
    {

        $this->db->select('media_name,points');
        $this->db->from('tbl_social_points');
        $where = '(media_name like "' . $online_presence . '")';
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();

    }


    public function add_points_social_media($media_points, $media_name, $std_PRN)
    {
        $date = Date('d/m/Y');


        $data = array(
            'sc_entites_id' => '110',
            'sc_point' => $media_points,
            'sc_teacher_id' => $std_PRN,
            'sc_stud_id' => $std_PRN,
            'reason' => $media_name,
            'point_date' => $date

        );
        $this->db->insert('tbl_student_point', $data);

    }

    public function social_media_points($std_PRN, $points, $online_flag, $flag)
    {


        $date = Date('d/m/Y');
        if ($flag == 'Y') {

            $data = array(
                'sc_total_point' => $points,
                'sc_date' => $date,
                'online_flag' => $online_flag
            );

            $this->db->where('sc_stud_id', $std_PRN);
            $this->db->update('tbl_student_reward', $data);


        }

        if ($flag == 'N') {


            $data = array(
                'online_flag' => $online_flag,
                'sc_date' => $date,
                'sc_stud_id' => $std_PRN,
                'sc_total_point' => $points
            );
            $this->db->insert('tbl_student_reward', $data);


        }


    }

    public function requests_pointlist($std_PRN, $school_id)

    {

        $this->db->select('r.id,r.stud_id1,r.requestdate,r.points,r.reason,s.std_name,s.std_Father_name,s.std_lastname,s.std_complete_name,s.std_img_path');
        $this->db->from('tbl_request r');
        $this->db->join('tbl_student s', 'r.stud_id1=s.std_PRN');
        $this->db->where('r.stud_id2', $std_PRN);
        $this->db->where('r.flag', 'N');
        $this->db->where('r.entitity_id', 105);
        $this->db->where('r.school_id', $school_id);
        $this->db->order_by("r.id", "desc");

//$str=$this->db->get_compiled_select();
        $query = $this->db->get();
        return $query->result();


    }


    public function requsetinfo($id, $std_PRN, $school_id)
    {

        $this->db->select('points,stud_id1,reason');
        $this->db->from('tbl_request');
        $this->db->where('id', $id);
        $this->db->where('stud_id2', $std_PRN);
        $this->db->where('school_id', $school_id);
        $this->db->where('entitity_id', 105);

        $query = $this->db->get();
        return $query->result();

    }


    public function assign_request_points($stud_id, $std_PRN, $points, $value, $reason, $rewards, $student_yellowpoints, $flag, $school_id)
    {

        $date = Date('d/m/Y');
        if ($flag == 'Y') {
            $student_yellowpoints = $student_yellowpoints + $points;
            $data = array(
                'yellow_points' => $student_yellowpoints,
                'sc_date' => $date
            );

            $this->db->where('sc_stud_id', $stud_id);
            $this->db->where('school_id', $school_id);
            $this->db->update('tbl_student_reward', $data);
        } else {

            $student_yellowpoints = $student_yellowpoints + $points;
            $data = array(
                'yellow_points' => $student_yellowpoints,
                'sc_date' => $date,
                'sc_stud_id' => $student_id,
                'school_id' => $school_id
            );
            $this->db->insert('tbl_student_reward', $data);

        }


        $student_reward = $rewards - $points;
        $data1 = array(
            'sc_total_point' => $student_reward,
            'sc_date' => $date
        );
        $this->db->where('sc_stud_id', $std_PRN);
        $this->db->where('school_id', $school_id);
        $this->db->update('tbl_student_reward', $data1);
        $data2 = array(
            'sc_entites_id' => '105',
            'sc_point' => $points,
            'sc_teacher_id' => $std_PRN,
            'sc_stud_id' => $stud_id,
            'reason' => $reason,
            'point_date' => $date,
            'school_id' => $school_id

        );
        $this->db->insert('tbl_student_point', $data2);
                                   /* $this->db->select('std_complete_name,id');
									$this->db->from('tbl_student');
									$this->db->where('std_PRN',$std_PRN);
									$this->db->where('school_id',$school_id);
									$query1=$this->db->get();
									//$query->['t_complete_name']
									$stud_name =$query1->result()[0]->std_complete_name;
									$stud_id =$query1->result()[0]->id;
									
									
									$this->db->select('std_complete_name,id');
									$this->db->from('tbl_student');
									$this->db->where('std_PRN',$stud_id);
									$this->db->where('school_id',$school_id);
									$query2=$this->db->get();
									//$query->['t_complete_name']
									$stud_name2 =$query2->result()[0]->std_complete_name;
									$stud_id2 =$query2->result()[0]->id;
			 
			 $server_name = $_SERVER['SERVER_NAME'];
			 
							
									$data = array('Action_Description'=>'Point Request Accept ',
												'Actor_Mem_ID'=>$stud_id,
												'Actor_Name'=>$stud_name,
												'Actor_Entity_Type'=>105,
												'Second_Receiver_Mem_Id'=>$stud_id2,
												'Second_Party_Receiver_Name'=>$stud_name2,
												'Second_Party_Entity_Type'=>105,
												'Third_Party_Name'=>'',
												'Third_Party_Entity_Type'=>'',
												'Coupon_ID'=>'',
												'Points'=>$points,
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
			 
			 //end	*/

        $data3 = array(
            'flag' => 'Y',

        );

        $this->db->where('id', $value);

        $this->db->update('tbl_request', $data3);


    }


    public function decline_student_request($id, $std_PRN, $school_id)
    {

        $data = array(
            'flag' => 'P',

        );

        $this->db->where('id', $id);
        $this->db->where('stud_id2', $std_PRN);
        $this->db->where('school_id', $school_id);
        $this->db->update('tbl_request', $data);


    }

    public function pending_student_request_info($std_PRN, $school_id)
    {


        $this->db->select('r.id,r.stud_id1,r.requestdate,r.points,r.reason,s.std_name,s.std_Father_name,s.std_lastname,s.std_complete_name,s.std_img_path');
        $this->db->from('tbl_request r');
        $this->db->join('tbl_student s', 'r.stud_id1=s.std_PRN');
        $this->db->where('r.stud_id2', $std_PRN);
        $this->db->where('r.flag', 'P');
        $this->db->where('r.school_id', $school_id);
        $this->db->where('r.entitity_id', 105);
        $this->db->order_by("r.id", "desc");

//$str=$this->db->get_compiled_select();
        $query = $this->db->get();
        return $query->result();


    }


    public function send_request_tostudent($school_id, $std_PRN, $student_id)
    {

        $points = $this->input->post('points');
        $reason = $this->input->post('reason');
        $date = Date('d/m/Y');

        $this->db->select('*');
        $this->db->from('tbl_request');
        $where = ('stud_id1="' . $std_PRN . '" and stud_id2="' . $student_id . '" and reason like "' . $reason . '" and flag="N" and requestdate="' . $date . '" and points="' . $points . '" and entitity_id=105 and school_id="' . $school_id . '"');

        $this->db->where($where);


        $query = $this->db->get();


        if ($query->num_rows() == 0) {


            $data = array(
                'stud_id1' => $std_PRN,
                'stud_id2' => $student_id,
                'reason' => $reason,
                'points' => $points,
                'requestdate' => $date,
                'flag' => 'N',
                'entitity_id' => '105',
                'school_id' => $school_id

            );

            $this->db->insert('tbl_request', $data);
			
			
			
			//call webservece
		$this->db->select('std_complete_name,id');
									$this->db->from('tbl_student');
									$this->db->where('std_PRN',$std_PRN);
									$this->db->where('school_id',$school_id);
									$query1=$this->db->get();
									//$query->['t_complete_name']
									$stud_name1 =$query1->result()[0]->std_complete_name;
									$stud_id1 =$query1->result()[0]->id;
									
									
									$this->db->select('std_complete_name,id');
									$this->db->from('tbl_student');
									$this->db->where('std_PRN',$student_id);
									$this->db->where('school_id',$school_id);
									$query1=$this->db->get();
									//$query->['t_complete_name']
									$stud_name2 =$query1->result()[0]->std_complete_name;
									$stud_id2 =$query1->result()[0]->id;
			 
			 $server_name = $_SERVER['SERVER_NAME'];
			 
							
									$data = array('Action_Description'=>'point Request to Student',
												'Actor_Mem_ID'=>$stud_id1,
												'Actor_Name'=>$stud_name1,
												'Actor_Entity_Type'=>105,
												'Second_Receiver_Mem_Id'=>$stud_id2,
												'Second_Party_Receiver_Name'=>$stud_name2,
												'Second_Party_Entity_Type'=>105,
												'Third_Party_Name'=>'',
												'Third_Party_Entity_Type'=>'',
												'Coupon_ID'=>'',
												'Points'=>$points,
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
		

            return true;


        } else {
            return false;
        }


    }


    public function send_request_toteacher($school_id, $std_PRN, $t_id)
    {
        $points = $this->input->post('points');
        $activity = $this->input->post('activity');

        $activity_type = $this->input->post('activity_type');


        $date = Date('Y/m/d');
		
		$this->db->select('t_complete_name');
        $this->db->from('tbl_teacher');
		$this->db->where('t_id',$t_id );
		$this->db->where('school_id', $school_id);
		 $q =$this->db->get();
		 $t_complete_name = $q->result()[0]->t_complete_name;
		 
		 
		 $this->db->select('std_complete_name');
        $this->db->from('tbl_student');
		$this->db->where('std_PRN',$std_PRN );
		$this->db->where('school_id', $school_id );
		$qw =$this->db->get();
		$std_complete_name = $qw->result()[0]->std_complete_name;
		 
		 
		//$this->db->select('std_complete_name');
        //$this->db->from('tbl_request');
		//$this->db->where('std_PRN',$std_PRN);
		//$qs = $this->db->get();
		// $date = Date('Y/m/d');
		//$qw = $this -> db
       //->select('std_complete_name');
       //->where('std_PRN',$std_PRN);
	   //->from('tbl_student');
	   //$std_complete_name = $qs->result()[0]->std_complete_name;

        $this->db->select('*');
        $this->db->from('tbl_request');
        if ($activity == 'activity') {
            $reason = $this->input->post('activitydisplay');
            $where = ('stud_id1="' . $std_PRN . '" and stud_id2="' . $t_id . '" and reason like "' . $reason . '" and flag="N" and requestdate="' . $date . '" and points="' . $points . '" and activity_type="' . $activity . '" and entitity_id=103 and school_id="' . $school_id . '"');
        }

        if ($activity == 'subject') {
            $where = ('stud_id1="' . $std_PRN . '" and stud_id2="' . $t_id . '" and reason like "' . $activity_type . '" and flag="N" and requestdate="' . $date . '" and points="' . $points . '" and activity_type="' . $activity . '" and entitity_id=103 and school_id="' . $school_id . '"');
        }
        $this->db->where($where);


        $query = $this->db->get();


        if ($query->num_rows() == 0) {

            if ($activity == 'activity') {
                $data = array(
                    'stud_id1' => $std_PRN,
                    'stud_id2' => $t_id,
                    'reason' => $reason,
                    'points' => $points,
                    'requestdate' => $date,
                    'activity_type' => 'activity',
                    'flag' => 'N',
                    'entitity_id' => '103',
                    'school_id' => $school_id

                );
				 $data1 = array(
                    'actor_mem_id' => $std_PRN,
                    'receiver_mem_id' => $t_id,
                    'action_description' =>'Point Request To Teacher',
                    'points' => $points,
                    'action_date_time' => $date,
                    //'activity_type' => 'activity',
                    'actor_entity_type' => '105',
                   // 'school_id' => $school_id
				   'receiver_name'=> $t_complete_name,
				   'actor_name'=> $std_complete_name,
				   'receiver_entity_type'=>'103',
				   
				   

                );

            }


            if ($activity == 'subject') {
                $data = array(
                    'stud_id1' => $std_PRN,
                    'stud_id2' => $t_id,
                    'reason' => $activity_type,
                    'points' => $points,
                    'requestdate' => $date,
                    'activity_type' => 'subject',
                    'flag' => 'N',
                    'entitity_id' => '103',
                    'school_id' => $school_id

                );

				$data1 = array(
                    'actor_mem_id' => $std_PRN,
                    'receiver_mem_id' => $t_id,
                    'action_description' =>'Point Request To Teacher',
                    'points' => $points,
                    'action_date_time' => $date,
                    //'activity_type' => 'activity',
                    'actor_entity_type' => '103',
                   // 'school_id' => $school_id
				   'receiver_name'=> $t_complete_name,
				   'actor_name'=> $std_complete_name,
				    'receiver_entity_type'=>'103'

                );
            }


            $this->db->insert('tbl_request', $data);
			$this->db->insert('tbl_master_action_log', $data1);

            return true;


        } else {
            return false;
        }


    }


    public function studentsendrequest($std_PRN, $teach_id, $school_id)
    {

        $date = Date('d/m/Y');


        $data = array(


            'stud_id1' => $std_PRN,
            'stud_id2' => $teach_id,
            'requestdate' => $date,
            'flag' => 'N',
            'entitity_id' => '117',
            'school_id' => $school_id


        );

        //	print_r($data);die;

        $this->db->insert('tbl_request', $data);
        return true;

    }

    public function studentteacherrequset_info($std_PRN, $school_id)
    {

        $this->db->select('*');
        $this->db->from('tbl_request');
        $this->db->where('entitity_id', '117');
        $this->db->where('school_id', $school_id);
        $this->db->where('stud_id1', $std_PRN);
        $this->db->where('points', 0);
        $this->db->where('reason', '');
        $this->db->where('flag', 'N');


        $query = $this->db->get();
        return $query->result();

    }

    public function send_request_toteacher_coordinator($stud_id, $teacher_id, $school_id)
    {
        $date = Date('d/m/Y');

        $data = array(
            'stud_id1' => $stud_id,
            'stud_id2' => $teacher_id,
            'requestdate' => $date,
            'flag' => 'N',
            'entitity_id' => '112',
            'school_id' => $school_id
        );

        //	print_r($data);die;

        $this->db->insert('tbl_request', $data);
        return true;


    }

    public function coordinator_request_info($stud_id, $school_id)
    {

        $this->db->select('*');
        $this->db->from('tbl_request');
        $this->db->where('entitity_id', '112');
        $this->db->where('school_id', $school_id);
        $this->db->where('stud_id1', $stud_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function subjectlistforteacher($t_id, $std_PRN, $school_id)
    {
        $this->db->select('sm.subjcet_code,sm.subjectName');
        $this->db->distinct();
        $this->db->from('tbl_student_subject_master sm');
        $this->db->join('tbl_academic_Year a', 'sm.AcademicYear = a.Year');
        $this->db->where('sm.student_id', $std_PRN);
        $this->db->where('sm.teacher_ID', $t_id);
        $this->db->where('Enable', 1);
        $this->db->where('sm.school_id', $school_id);
        $query = $this->db->get();
        return $query->result();

    }

    public function remove_profile_image($std_PRN, $school_id)
    {

        $data = array('std_img_path' => '');

        $this->db->where('std_PRN', $std_PRN);
        $this->db->where('school_id', $school_id);
        $this->db->update('tbl_student', $data);
        //$query=$this->db->get();
        //if($result)
        echo "<script>alert('Do you want to remove your profile image...!');</script>";


    }

    public function update_profile($std_PRN, $school_id, $image)
    {
        $fname = $this->input->post('fname');
        $mname = $this->input->post('mname');
        $lname = $this->input->post('lname');
        //$gender= $this->input->post('gender');<br />
        $country_code = $this->input->post('country_code');
        $phone = $this->input->post('phone');
        $address = $this->input->post('address');
        $int_email = $this->input->post('int_email');
        $ext_email = $this->input->post('ext_email');


        $data = array(
            'std_name' => $fname,
            'std_Father_name' => $mname,
            'std_lastname' => $lname,
            'std_complete_name' => $fname . " " . $mname . " " . $lname,
            'std_phone' => $phone,
            'std_address' => $address,
            'Email_Internal' => $int_email,
            'std_email' => $ext_email,
            'country_code' => $country_code
        );
        if ($image != '') {
            $data['std_img_path'] = $image;
        }

        $this->db->where('std_PRN', $std_PRN);
        $this->db->where('school_id', $school_id);
        $this->db->update('tbl_student', $data);


    }


    public function emp_projectlist($std_PRN, $school_id)
    {
        $this->db->distinct();
        $this->db->select('sm.subjcet_code,sm.subjectName,sm.Semester_id,sm.Branches_id,sm.AcademicYear,sm.teacher_id,t.t_complete_name');

        $this->db->from('tbl_student_subject_master sm');
        $this->db->join('tbl_teacher t', 't.t_id=sm.teacher_id', 'left');
        $this->db->where('sm.student_id', $std_PRN);
        $this->db->where('sm.school_id', $school_id);
        $this->db->where('t.school_id', $school_id);
        $this->db->order_by("sm.id");

        $query = $this->db->get();

        return $query->result();

    }

    public function student_subjectlist($std_PRN, $school_id)
    {

        $select_opt = $this->input->post('select_opt');
        //current semester
        if ($select_opt == '1') {
            $this->db->distinct();
            $this->db->select('sm.subjcet_code,sm.subjectName,sm.Semester_id,sm.Branches_id,sm.AcademicYear,sm.teacher_id,t.t_complete_name');
            $this->db->from('tbl_student_subject_master sm');
            $this->db->join('tbl_teacher t', 't.t_id=sm.teacher_id');
            $this->db->join('StudentSemesterRecord ss', 'ss.student_id=sm.student_id');
            $this->db->join('tbl_academic_Year a', 'sm.AcademicYear = a.Year');
            $this->db->join('tbl_semester_master tsm', 'sm.Semester_id=tsm.Semester_Name');
            $this->db->where('tsm.Is_enable', '1');
            $this->db->where('sm.student_id', $std_PRN);
            $this->db->where('sm.school_id', $school_id);
            $this->db->where('t.school_id', $school_id);
            $this->db->where('a.school_id', $school_id);
            $this->db->where('a.Enable', '1');
            $this->db->where('ss.IsCurrentSemester', '1');
        } //All semester
        elseif ($select_opt == '2') {
            $this->db->distinct();
            $this->db->select('sm.subjcet_code,sm.subjectName,sm.Semester_id,sm.Branches_id,sm.AcademicYear,sm.teacher_id,t.t_complete_name');
            $this->db->from('tbl_student_subject_master sm');
            $this->db->join('tbl_teacher t', 't.t_id=sm.teacher_id');
            $this->db->join('tbl_academic_Year a', 'sm.AcademicYear = a.Year');
            //$this->db->join('StudentSemesterRecord ss','ss.student_id=sm.student_id');
            $this->db->where('sm.student_id', $std_PRN);
            $this->db->where('sm.school_id', $school_id);
            $this->db->where('t.school_id', $school_id);
            $this->db->where('a.school_id', $school_id);
            $this->db->where('a.Enable', '1');
            //$this->db->where('ss.IsCurrentSemester','1');
            $this->db->order_by("sm.id");
        } //all year 20170321 this code created by jayshree more
        elseif ($select_opt == '3') {

            $this->db->distinct();
            $this->db->select('sm.subjcet_code,sm.subjectName,sm.Semester_id,sm.Branches_id,sm.AcademicYear,sm.teacher_id,t.t_complete_name');
            $this->db->from('tbl_student_subject_master sm');

            $this->db->join('tbl_teacher t', 't.t_id=sm.teacher_id');
            $this->db->join('tbl_academic_Year a', 'sm.AcademicYear = a.Year');
            //$this->db->join('StudentSemesterRecord ss','ss.student_id=sm.student_id');

            $this->db->where('sm.student_id', $std_PRN);
            $this->db->where('sm.school_id', $school_id);
            $this->db->where('t.school_id', $school_id);
            $this->db->where('a.school_id', $school_id);

            //$this->db->where('ss.IsCurrentSemester','1');
            $this->db->order_by("sm.id");


        } //current year 20170321 this code created by jayshree more
        elseif ($select_opt == '4') {

            $this->db->distinct();
            $this->db->select('sm.subjcet_code,sm.subjectName,sm.Semester_id,sm.Branches_id,sm.AcademicYear,sm.teacher_id,t.t_complete_name');
            $this->db->from('tbl_student_subject_master sm');

            $this->db->join('tbl_teacher t', 't.t_id=sm.teacher_id');
            $this->db->join('tbl_academic_Year a', 'sm.AcademicYear = a.Year');
            //$this->db->join('StudentSemesterRecord ss','ss.student_id=sm.student_id');

            $this->db->where('sm.student_id', $std_PRN);
            $this->db->where('sm.school_id', $school_id);
            $this->db->where('t.school_id', $school_id);
            $this->db->where('a.school_id', $school_id);
            $this->db->where('a.Enable', '1');

            //$this->db->where('ss.IsCurrentSemester','1');
            $this->db->order_by("sm.id");


        } //current semester
        elseif ($select_opt == '5'){
            $this->db->distinct();
            $this->db->select('*');
            $this->db->from('tbl_student_subject_master');
            $this->db->where('school_id', $school_id);
            $this->db->where('student_id', $std_PRN);
        }
        else {
            $this->db->distinct();
            $this->db->select('sm.subjcet_code,sm.subjectName,sm.Semester_id,sm.Branches_id,sm.AcademicYear,sm.teacher_id,t.t_complete_name');
            $this->db->from('tbl_student_subject_master sm');
            $this->db->join('tbl_teacher t','t.t_id=sm.teacher_id');
            $this->db->join('StudentSemesterRecord ss','ss.student_id=sm.student_id');
            $this->db->join('tbl_academic_Year a','sm.AcademicYear = a.Year');
            $this->db->join('tbl_semester_master tsm','sm.Semester_id=tsm.Semester_Name');
            $this->db->where('tsm.Is_enable','1');
            $this->db->where('sm.student_id',$std_PRN);
            $this->db->where('sm.school_id',$school_id);
            $this->db->where('t.school_id',$school_id);
            $this->db->where('a.school_id',$school_id);
            $this->db->where('a.Enable','1');
            $this->db->where('ss.IsCurrentSemester','1');


        }
        //$str=$this->db->get_compiled_select();
        //echo $str;die;
        $query = $this->db->get();
        return $query->result();


        /*

        $select_opt=$this->input->post('select_opt');



        $this->db->distinct();
        $this->db->select('sm.subjcet_code,sm.subjectName,sm.Semester_id,sm.Branches_id,sm.AcademicYear,sm.teacher_id,t.t_complete_name');

        $this->db->from('tbl_student_subject_master sm');
        $this->db->join('tbl_teacher t','t.t_id=sm.teacher_id','left');

        //$this->db->join('StudentSemesterRecord ss','ss.student_id=sm.student_id');
        $this->db->join('tbl_academic_Year a','sm.AcademicYear = a.Year');

        $this->db->where('sm.student_id',$std_PRN);
        $this->db->where('sm.school_id',$school_id);
        $this->db->where('t.school_id',$school_id);
        $this->db->where('a.Enable',1);
        //$this->db->where('ss.IsCurrentSemester','1');
        $this->db->where('a.school_id',$school_id);



        //$str=$this->db->get_compiled_select();
        //echo $str;die;




        //current semester
        /*if($select_opt=='1')
        {
        $this->db->distinct();

        $this->db->select('sm.subjcet_code,sm.subjectName,sm.Semester_id,sm.Branches_id,sm.AcademicYear,sm.teacher_id,t.t_complete_name');
        $this->db->from('tbl_student_subject_master sm');
        $this->db->join('tbl_teacher t','t.t_id=sm.teacher_id');
        $this->db->join('StudentSemesterRecord ss','ss.student_id=sm.student_id');
        $this->db->join('tbl_academic_Year a','sm.AcademicYear = a.Year');
        $this->db->join('tbl_semester_master tsm','tsm.ExtSemesterId','sm.ExtSemesterId');
        $this->db->where('sm.student_id',$std_PRN);
        $this->db->where('sm.school_id',$school_id);
        $this->db->where('t.school_id',$school_id);
        $this->db->where('a.school_id',$school_id);
        $this->db->where('a.Enable','1');
        $this->db->where('tsm.Is_enable','1');
        $this->db->order_by("sm.id");
        //$this->db->where('tsm.ExtSemesterId','sm.ExtSemesterId');
        //$this->db->where('ss.IsCurrentSemester','1');
        //$this->db->where('tsm.ExtSemesterId !=','0');

        }/*
        //All semester
        elseif($select_opt=='2')

        {
        $this->db->distinct();
        $this->db->select('sm.subjcet_code,sm.subjectName,sm.Semester_id,sm.Branches_id,sm.AcademicYear,sm.teacher_id,t.t_complete_name');
        $this->db->from('tbl_student_subject_master sm');

        $this->db->join('tbl_teacher t','t.t_id=sm.teacher_id');
        $this->db->join('tbl_academic_Year a','sm.AcademicYear = a.Year');
        //$this->db->join('StudentSemesterRecord ss','ss.student_id=sm.student_id');

        $this->db->where('sm.student_id',$std_PRN);
        $this->db->where('sm.school_id',$school_id);
        $this->db->where('t.school_id',$school_id);
        $this->db->where('a.school_id',$school_id);
        $this->db->where('a.Enable','1');
        //$this->db->where('ss.IsCurrentSemester','1');
        $this->db->order_by("sm.id");

        }
        //All Year
        elseif($select_opt=='3')
        {
        $this->db->distinct();
        $this->db->select('sm.subjcet_code,sm.subjectName,sm.Semester_id,sm.Branches_id,sm.AcademicYear,sm.teacher_id,t.t_complete_name');
        $this->db->from('tbl_student_subject_master sm');
        $this->db->join('tbl_teacher t','t.t_id=sm.teacher_id');
        $this->db->join('tbl_academic_Year a','sm.AcademicYear = a.Year');
        $this->db->where('sm.student_id',$std_PRN);
        $this->db->where('sm.school_id',$school_id);
        $this->db->where('t.school_id',$school_id);
        $this->db->where('a.school_id',$school_id);

        }
        //Current Year
        else
        {
        $this->db->distinct();
        $this->db->select('sm.subjcet_code,sm.subjectName,sm.Semester_id,sm.Branches_id,sm.AcademicYear,sm.teacher_id,t.t_complete_name');
        $this->db->from('tbl_student_subject_master sm');
        $this->db->join('tbl_teacher t','t.t_id=sm.teacher_id');
        $this->db->join('tbl_academic_Year a','sm.AcademicYear = a.Year');
        $this->db->where('sm.student_id',$std_PRN);
        $this->db->where('sm.school_id',$school_id);
        $this->db->where('t.school_id',$school_id);
        $this->db->where('a.school_id',$school_id);
        $this->db->where('a.Enable','1');

        }
        */

        /*$query=$this->db->get();
        return $query->result();




        /// old code.....
        /*$select_opt=$this->input->post('select_opt');
        if($select_opt=="2")
        {
            $this->db->distinct();
        $this->db->select('sm.subjcet_code,sm.subjectName,sm.Semester_id,sm.Branches_id,sm.AcademicYear,sm.teacher_id,t.t_complete_name');

        $this->db->from('tbl_student_subject_master sm');
        $this->db->join('tbl_teacher t','t.t_id=sm.teacher_id','left');
        $this->db->where('sm.student_id',$std_PRN);
        $this->db->where('sm.school_id',$school_id);
        $this->db->where('t.school_id',$school_id);
    $this->db->order_by("sm.id");


        }
        else{
        $this->db->distinct();
        $this->db->select('sm.subjcet_code,sm.subjectName,sm.Semester_id,sm.Branches_id,sm.AcademicYear,sm.teacher_id,t.t_complete_name');

    $this->db->from('tbl_student_subject_master sm');
        $this->db->join('tbl_teacher t','t.t_id=sm.teacher_id','left');

        $this->db->join('StudentSemesterRecord ss','ss.student_id=sm.student_id','left');
        $this->db->join('tbl_academic_Year a','sm.AcademicYear = a.Year','left');

        $this->db->where('sm.student_id',$std_PRN);
        $this->db->where('sm.school_id',$school_id);
        $this->db->where('t.school_id',$school_id);
        $this->db->where('a.Enable',1);
            $this->db->where('ss.IsCurrentSemester','1');
        $this->db->where('a.school_id',$school_id);


        }
        //$str=$this->db->get_compiled_select();
        //echo $str;die;
        $query=$this->db->get();

        return $query->result();*/


    }

    public function Add_subject($data, $school_id, $sub_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_school_subject');
        $this->db->where('school_id', $school_id);
        $this->db->where('id', $sub_id);
        $query = $this->db->get();
        $result['allsubinfo'] = $query->result_array();
        //var_dump($result['allsubinfo']);
        foreach ($result['allsubinfo'] as $row) {
            $data['subjcet_code'] = $row['Subject_Code'];
            $data['Semester_id'] = $row['Semester_id'];
            $data['CourseLevel'] = $row['Course_Level_PID'];
            $data['subjectName'] = $row['subject'];

        }
        //var_dump($data);
        $sql1 = $this->db->insert('tbl_student_subject_master', $data);
        echo $sql1;
        //$query=$this->db->get();
        //return $query->result();

    }

    /**
     * @return mixed
     * @throws Exception
     * @description add subjects
     * @auther Rohit Pawar[rohitp@roseland.com]
     * @date 2017/05/02
     */
    public function AddSubject()
    {
        if (func_num_args() > 0) {
            $data = func_get_arg(0);
            try {
                return $this->db->insert('tbl_student_subject_master', $data);
                /*echo "<per>";
                die(print_r($results,true));*/
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        } else {
            throw new \Exception('Data not passed');
        }
    }


    public function getallsubject($school_id)
    {
        $this->db->select('id,subject,Subject_Code');
        $this->db->from('tbl_school_subject');
        $this->db->where('school_id', $school_id);

        $query = $this->db->get();
        return $query->result();
    }

    /**
     * @AUTHER ROHIT PAWAR
     * @DESCRIPTION GET ALL BRANCHES
     */
    public function getallbranches($school_id)
    {
        try {
            $this->db->select('Dept_Name');
            $this->db->from('tbl_department_master');
            $this->db->where('school_id', $school_id);
            $query = $this->db->get();
            return $query->result();

        } catch (Exception $e) {
            throw Exception('message', 'Please try again');
        }

    }

    /**
     * @AUTHER ROHIT PAWAR
     * @DESCRIPTION GET ALL BRANCHES
     */
    public function getCourselevel($school_id)
    {
        try {
            $this->db->select('CourseLevel');
            $this->db->from('tbl_CourseLevel');
            $this->db->where('school_id', $school_id);
            $query = $this->db->get();
            return $query->result();
        } catch (Exception $e) {
            throw Exception('message', 'Please try again');
        }

    }

    public function getallsemester($school_id)
    {
        try {
            $this->db->distinct();
            $this->db->select('Semester_Name');
            $this->db->from('tbl_semester_master');
            $this->db->where('school_id', $school_id);
            $query = $this->db->get();
            return $query->result();
        } catch (Exception $e) {
            throw Exception('message', 'Please try again');
        }

    }

    public function getAcademicYear($school_id)
    {
        try {
            $this->db->distinct();
            $this->db->select('Year');
            $this->db->from('tbl_academic_Year');
            $this->db->where('school_id', $school_id);
            $this->db->where('Enable', '1');
            $query = $this->db->get();
            return $query->result();
        } catch (Exception $e) {
            throw Exception('message', 'Please try again');
        }

    }

    public function getDivision($school_id)
    {
        try {
            $this->db->distinct();
            $this->db->select('DivisionName');
            $this->db->from('Division');
            $this->db->where('school_id', $school_id);
            $query = $this->db->get();
            return $query->result();
        } catch (Exception $e) {
            throw Exception('message', 'Please try again');
        }

    }

    public function getalldepartment($school_id)
    {
        try {
            $this->db->distinct();
            $this->db->select('Dept_Name');
            $this->db->from('tbl_department_master');
            $this->db->where('school_id', $school_id);
            $query = $this->db->get();
            return $query->result();
        } catch (Exception $e) {
            throw Exception('message', 'Please try again');
        }

    }

    public function getallbranch($school_id)
    {
        try {
            $this->db->distinct();
            $this->db->select('branch_Name');
            $this->db->from('tbl_branch_master');
            $this->db->where('school_id', $school_id);
            $query = $this->db->get();
            return $query->result();
        } catch (Exception $e) {
            throw Exception('message', 'Please try again');
        }

    }

    public function getDepartment($data,$school_id){
        try{
            $this->db->distinct();
            $this->db->select('*');
            $this->db->from('tbl_branch_master');
            $this->db->where('school_id', $school_id);
            $this->db->where('Course_Name', $data);
            $data= $this->db->get();
            $results= $data->result();
            return $results;
           /* echo "<pre>";
            die(print_r($results,true));*/
        }catch (Exception $e){
            throw Exception('message', 'Please try again');
        }
    }

       public function GetSubjectID($subjectname,$school_id){
        try{
            $this->db->distinct();
            $this->db->select('subjcet_code');
            $this->db->from('tbl_student_subject_master');
            $this->db->where('school_id', $school_id);
            $this->db->where('subjectName',$subjectname);
            $data= $this->db->get();
            $results= $data->result();
            if($data->num_rows() == 1) {
                // Return the first row:
                return $results[0];
            }

            return $results;
           /* echo "<pre>";
            die(print_r($results,true));*/
        }catch (Exception $e){
            throw Exception('message', 'Please try again');
        }
    }



}

?>