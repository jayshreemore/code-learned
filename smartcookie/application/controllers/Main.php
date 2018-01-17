<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller

{

    function __construct()

    {

        parent::__construct();

        $this->load->model('student');

        $this->load->model('school_admin');

        $this->load->model('teacher');

        $this->load->model('sponsor');

        $this->load->library('googlemaps');

        $this->load->library('ciqrcode');

        //$this->load->library('pushnotification');

        if($this->session->userdata('entity')!='student')

        {

            redirect('Welcome','location');

        }


    }

    public $alert_value;

    public function index()

    {

        $this->login();

    }

    public function login()

    {

        $this->load->view('login');

    }

    public function members()

    {
		$std_PRN = $this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        if($std_PRN!='' and $school_id!='')

        {

            if($this->session->userdata('is_loggen_in'))

            {

                $std_PRN = $this->session->userdata('std_PRN');

                $school_id=$this->session->userdata('school_id');

                $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

                $row['studentpointsinfo']=$this->student->studentpointsinfo($std_PRN,$school_id);
		
                //echo "<pre>";

                //die(print_r($row['studentpointsinfo'],true));

                $row['couponinfo']=$this->student->studentsmartcookie_coupons($std_PRN,$school_id);

                //$row['reward']=$this->student->display_reward($std_PRN,$school_id);
				$row['studentwaterpointsinfo']=$this->student->studentwaterpointsinfo($std_PRN,$school_id);

				
                //	$this->load->view('stud_header',$row);

                $this->load->view('student_dashboard',$row);

            }

            else

            {

                redirect('main/restricted');

            }

        }

        else

        {

            if($this->session->userdata('is_loggen_in'))

            {

                $username=$this->session->userdata('username');

                $row['studentinfo']=$this->student->studentinfowithusername($username);

                $row['studentpointsinfo']=$this->student->studentpointsinfowithusername($username);

                $row['couponinfo']=$this->student->studentsmartcookie_couponswithusername($username);

                $row['reward']=$this->student->display_reward($std_PRN,$school_id);
				
				$row['studentwaterpointsinfo']=$this->student->studentwaterpointsinfo($std_PRN,$school_id);

                //	$this->load->view('stud_header',$row);
				
                $this->load->view('student_dashboard',$row);

            }

            else

            {

                redirect('main/restricted');

            }

        }

    }


    public function id_card()

    {

        $std_PRN = $this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

        $school_id=$row['studentinfo'][0]->school_id;

        $this->load->view('student_icard',$row);



    }

    public function rewards_log()

    {

        $std_PRN = $this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        //$st_mem_id=$this->student->get_student_member_id($std_PRN,$school_id);

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

        $school_id=$row['studentinfo'][0]->school_id;

        $row['rewardinfo']=$this->student->rewardlog($std_PRN,$school_id);

        $row['rewardcoordinatorlog']=$this->student->rewardcoordinatorlog($std_PRN,$school_id);

        $row['rewardschooladmin']=$this->student->rewardschooladmin($std_PRN,$school_id);

        $this->load->view('reward-log',$row);

    }

    public function my_parent()

    {

        $std_PRN = $this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

        $school_id=$row['studentinfo'][0]->school_id;

        $row['parentinfo']=$this->student->parentlog($std_PRN,$school_id);

        $this->load->view('parent_log',$row);


    }

    public function usedcoupon_log()

    {

        $std_PRN = $this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

        $row['usedcoupon_log']=$this->student->usedcoupon_log($std_PRN);

        $this->load->view('usedcoupon_log',$row);

    }

    public function self_motivation_log()

    {

        $std_PRN = $this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

        $row['self_motivation_log']=$this->student->self_motivation_log($std_PRN);

        $this->load->view('self_motivation_log',$row);

    }
	
	public function thanQ_log()

    {

	
        $std_PRN = $this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

        $school_id=$row['studentinfo'][0]->school_id;

        $row['thanq_points_log']=$this->student->thanq_points_log($std_PRN,$school_id);

        $this->load->view('thanq_points_log',$row);

    }


    public function softreward_log()

    {

        $std_PRN = $this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

        $school_id=$row['studentinfo'][0]->school_id;

        $row['reward_log']=$this->student->softreward_log1($std_PRN,$school_id);

        $this->load->view('softreward_log',$row);

    }



    public function shared_log()

    {

        $std_PRN = $this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

        $school_id=$row['studentinfo'][0]->school_id;

        $row['sharedinfo']=$this->student->sharedlog($std_PRN,$school_id);

        $this->load->view('shared_log',$row);

    }

    public function friendship_log()

    {

        $std_PRN = $this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

        $school_id=$row['studentinfo'][0]->school_id;

        $row['friendship_poins_info']=$this->student->friendshiplog($std_PRN,$school_id);

        $this->load->view('friendshippoints_log',$row);


    }

    public function purple_points_log()

    {

        $std_PRN = $this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

        $school_id=$row['studentinfo'][0]->school_id;

        $row['purple_points_log']=$this->student->purple_points_log($std_PRN,$school_id);

        $this->load->view('purplepoints_log',$row);



    }

    public function assign_coordpointslog()

    {

        $std_PRN = $this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

        $school_id=$row['studentinfo'][0]->school_id;

        $row['assign_points_log']=$this->student->assign_points_log($std_PRN,$school_id);

        $this->load->view('assign_points_log',$row);

    }

    public function accepted_requests_log()

    {

        $std_PRN = $this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

        $school_id=$row['studentinfo'][0]->school_id;

        $row['accepted_requests_log']=$this->student->accepted_requests_log($std_PRN,$school_id);

        $this->load->view('accepted_requests_log',$row);


    }

    public function send_requests_log()

    {

        $std_PRN = $this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

        $school_id=$row['studentinfo'][0]->school_id;

        $row['send_requests_log']=$this->student->send_requests_log($std_PRN,$school_id);

        $this->load->view('send_requests_log',$row);

    }

    public function unused_coupons()

    {

        $std_PRN = $this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $st_mem_id=$this->student->get_student_member_id($std_PRN,$school_id);

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);



        $row['unused_coupons']=$this->student->unused_coupons($st_mem_id);

        $this->load->view('unused_coupons',$row);

    }



    public function partiallyused_coupons()

    {

        $std_PRN = $this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

        $st_mem_id=$this->student->get_student_member_id($std_PRN,$school_id);

        $row['partiallyused_coupons']=$this->student->partiallyused_coupons($st_mem_id);

        $this->load->view('partiallyused_coupons',$row);

    }

    public function show_student()

    {

        /*echo "

             s.BranchName,s.DeptName,s.SemesterName,s.DivisionName, s.CourseLevel,s.AcdemicYear'

            StudentSemesterRecord s'

            tbl_academic_Year Y',' Y.Year= s.AcdemicYear AND  Y.Enable=1'

             s.IsCurrentSemester','1'

            s.student_id, std_PRN ";

            echo "</br>";*/

        $std_PRN = $this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);



        $school_id=$row['studentinfo'][0]->school_id;

        $row['stud_sem_record']=$this->student->student_semister_record($std_PRN,$school_id);

        $BranchName=@$row['stud_sem_record'][0]->BranchName;

        $DeptName=@$row['stud_sem_record'][0]->DeptName;

        $SemesterName=@$row['stud_sem_record'][0]->SemesterName;

        $CourseLevel=@$row['stud_sem_record'][0]->CourseLevel;

        $DivisionName=@$row['stud_sem_record'][0]->DivisionName;

        $DivisionName=@$row['stud_sem_record'][0]->DivisionName;

        $row['studentlist']=$this->student->studentlist($std_PRN,$school_id,$BranchName,$DeptName,$SemesterName,			                $CourseLevel,$DivisionName);

        $this->load->view('studentlist',$row);

        /*echo "

            's.std_img_path,s.id,s.std_PRN,s.std_name,s.std_Father_name,s.std_lastname,

                s.std_complete_name'

            'tbl_student s'

                StudentSemesterRecord ss','ss.student_id=s.std_PRN'

                's.std_PRN!=',$std_PRN

                'ss.BranchName',$BranchName

                'ss.DeptName',$DeptName

                'ss.IsCurrentSemester',1

                'ss.SemesterName',$SemesterName

                'ss.DivisionName',$DivisionName

                'ss.CourseLevel',$CourseLevel

                's.school_id',$school_id


            ";*/


    }

    public function testing()

    {

        $this->load->view('baseurl');



    }


    public function show_studlist()

    {



        $std_PRN = $this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

        $school_id=$row['studentinfo'][0]->school_id;

        $row['stud_sem_record']=$this->student->student_semister_record($std_PRN,$school_id);

        $BranchName=$row['stud_sem_record'][0]->BranchName;

        $DeptName=$row['stud_sem_record'][0]->DeptName;

        $SemesterName=$row['stud_sem_record'][0]->SemesterName;

        $CourseLevel=$row['stud_sem_record'][0]->CourseLevel;

        $DivisionName=$row['stud_sem_record'][0]->DivisionName;

        $row['studentlist']=$this->student->studentlist($std_PRN,$school_id,$BranchName,$DeptName,$SemesterName,			                $CourseLevel,$DivisionName);


        $this->load->view('show_studentlist',$row);





    }

    public function assign_points($student_id)

    {





        if($this->input->post('assign'))

        {



            $activitydisplay = $this->input->post('activitydisplay');





            $this->form_validation->set_rules('activity_type', 'activity_type', 'required');



            $this->form_validation->set_rules('points', 'points', 'required|numeric');





            if($this->form_validation->run())

            {

                $points=$this->input->post('points');

                $std_PRN = $this->session->userdata('std_PRN');

                $school_id=$this->session->userdata('school_id');

                $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

                $school_id=$row['studentinfo'][0]->school_id;

                $stud_id=$row['studentinfo'][0]->id;

                $row['coordinator_info']=$this->student->coordinator_info($school_id,$stud_id);

                $t_id=$row['coordinator_info'][0]->t_id;



                $row['teacherinfo']=$this->teacher->teacherinfo($t_id,$school_id);

                $tc_balance_points=$row['teacherinfo'][0]->tc_balance_point;



                if($tc_balance_points>=$points)

                {

                    $row['studpoints']=$this->student->studentpointsinfo($student_id,$school_id);



                    if(isset($row['studpoints'][0]->sc_total_point)!='')

                    {

                        $sc_total_point=$row['studpoints'][0]->sc_total_point;

                        $flag='Y';



                    }



                    else

                    {

                        $sc_total_point=0;

                        $flag='N';

                    }

                    $this->student->assignpoints($school_id,$t_id,$student_id,

                        $sc_total_point,$flag,$tc_balance_points,$std_PRN);

                    $school_id=$this->session->userdata('school_id');

                    $row['studinfo']=$this->student->studentinfo($student_id,$school_id);

                    $row['studentpointsinfo']=$this->student->studentpointsinfo($student_id,$school_id);

                    $row['coordinator_info']=$this->student->coordinator_info($school_id,$stud_id);

                    $row['report']="Point assigned successfully";

                    $this->load->view('assign_points_coordinator',$row);







                }

                else

                {

                    $std_PRN = $this->session->userdata('std_PRN');

                    $school_id=$this->session->userdata('school_id');

                    $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

                    $school_id=$row['studentinfo'][0]->school_id;

                    $stud_id=$row['studentinfo'][0]->id;

                    $row['coordinator_info']=$this->student->coordinator_info($school_id,$stud_id);

                    $t_id=$row['coordinator_info'][0]->t_id;



                    $row['studinfo']=$this->student->studentinfo($student_id,$school_id);

                    $row['studentpointsinfo']=$this->student->studentpointsinfo($student_id,$school_id);



                    $row['activity_type']=$this->school_admin->activity_typeinfo();

                    $row['subject_list']=$this->student->subjectlistforteacher($t_id,$student_id,$school_id);



                    $row['report1']="Insufficient points";

                    $this->load->view('assign_points_coordinator',$row);



                }













            }

            else

            {



                $std_PRN = $this->session->userdata('std_PRN');

                $school_id=$this->session->userdata('school_id');

                $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

                $school_id=$row['studentinfo'][0]->school_id;

                $stud_id=$row['studentinfo'][0]->id;

                $row['coordinator_info']=$this->student->coordinator_info($school_id,$stud_id);

                $t_id=$row['coordinator_info'][0]->t_id;



                $row['studinfo']=$this->student->studentinfo($student_id,$school_id);

                $row['studentpointsinfo']=$this->student->studentpointsinfo($student_id,$school_id);



                $row['activity_type']=$this->school_admin->activity_typeinfo();

                $row['subject_list']=$this->student->subjectlistforteacher($t_id,$student_id,$school_id);

                $this->load->view('assign_points_coordinator',$row);

            }

        }

        else

        {



            //



            $std_PRN = $this->session->userdata('std_PRN');

            $school_id=$this->session->userdata('school_id');

            $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

            $school_id=$row['studentinfo'][0]->school_id;

            $stud_id=$row['studentinfo'][0]->id;

            $row['coordinator_info']=$this->student->coordinator_info($school_id,$stud_id);

            $t_id=$row['coordinator_info'][0]->t_id;

            /*echo "<pre>";

            die(print_r($t_id, TRUE));*/



            $row['studinfo']=$this->student->studentinfo($student_id,$school_id);

            $row['studentpointsinfo']=$this->student->studentpointsinfo($student_id,$school_id);



            $row['activity_type']=$this->school_admin->activity_typeinfo();

            $row['subject_list']=$this->student->subjectlistforteacher($t_id,$student_id,$school_id);

            $this->load->view('assign_points_coordinator',$row);

            
			







        }









    }









    public function share_points($student_id)

    {



        if($this->input->post('share'))

        {

	    

            //$this->form_validation->set_rules('reason', 'reason', 'required');

            $this->form_validation->set_rules('points', 'points','required|numeric');

  //$this->form_validation->set_rules('points', 'points','required|numeric|callback_validpoints[points]');


            if($this->form_validation->run())

            {

                $std_PRN = $this->session->userdata('std_PRN');

                $school_id=$this->session->userdata('school_id');             
 		$row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

       		$school_id=$row['studentinfo'][0]->school_id;;            
 		$row['studentpointsinfo']=$this->student->studentpointsinfo($std_PRN,$school_id);
			
			
       // $row['studentrecugnization']=$this->student->studentrecugnization($school_id);
        	$row['studpoints']=$this->student->studentpointsinfo($student_id,$school_id);
			
				 $select_reason = $this->input->post('select_reson');
                 $select_opt = $this->input->post('select_opt');
			

                switch ($select_opt) {

                    case "1":

                        $student_rewardpoints=$row['studentpointsinfo'][0]->sc_total_point;



                        break;

                    case "2":

                        $student_rewardpoints=$row['studentpointsinfo'][0]->yellow_points;



                        break;

                    case "3":

                        $student_rewardpoints=$row['studentpointsinfo'][0]->purple_points;



                        break;

                    case "4":

                        $row['studentwaterpointsinfo']=$this->student->studentwaterpointsinfo($std_PRN,$school_id);

                        $student_rewardpoints=$row['studentwaterpointsinfo'][0]->balance_water_points;



                        break;



                }

                if(isset($row['studpoints'][0]->yellow_points)!='')

                {

                    $student_allpoints=$row['studpoints'][0]->yellow_points;

                    $flag='Y';



                }



                else

                {

                    $student_allpoints=0;

                    $flag='N';

                }





                $row['report'] = $this->student->sharepoints($school_id,$std_PRN,$student_id,$student_rewardpoints,

                    $student_allpoints,$flag,$select_opt,$select_reason);

                $row['studinfo']=$this->student->studentinfo($student_id,$school_id);

                $row['studentpointsinfo']=$this->student->studentpointsinfo($student_id,$school_id);
				$row['getallreason']=$this->student->getallreason($school_id);
				
					
				
                
        //$row['report']="Insufficient points";

                $this->load->view('share_points',$row);





            }

            else

            {



                $std_PRN = $this->session->userdata('std_PRN');

                $school_id=$this->session->userdata('school_id');

                $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

                $school_id=$row['studentinfo'][0]->school_id;

                $row['studinfo']=$this->student->studentinfo($student_id,$school_id);

                $row['studentpointsinfo']=$this->student->studentpointsinfo($student_id,$school_id);
				
				$row['getallreason']=$this->student->getallreason($school_id);
				
                $this->load->view('share_points',$row);

            }

        }

        else

        {

            $std_PRN = $this->session->userdata('std_PRN');

            $school_id=$this->session->userdata('school_id');

            $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

            $school_id=$row['studentinfo'][0]->school_id;

            $row['studinfo']=$this->student->studentinfo($student_id,$school_id);

            $row['studentpointsinfo']=$this->student->studentpointsinfo($student_id,$school_id);
			$row['getallreason']=$this->student->getallreason($school_id);

            $this->load->view('share_points',$row);

        }



    }





    public function validpoints($points)

    {



        $std_PRN = $this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $row['studentpointsinfo']=$this->student->studentpointsinfo($std_PRN,$school_id);



        $rewards=$row['studentpointsinfo'][0]->sc_total_point;



        /*echo "<pre>";

        die(print_r($row['studentpointsinfo'], TRUE));*/





        if(isset($rewards))

        {



            if($rewards!=0 && $points<=$rewards && $points!=0)

            {

                return true;

            }

            else

            {

                // throw new Exception("No records found");

                //echo "Please Enter valid Points";

                $this->form_validation->set_message('validpoints','Please Enter valid Points');

                return false;

                //redirect('main/share_points');

            }



        }

        else

        {

            //echo "Insufficient Points";

            $this->form_validation->set_message('validpoints','Insufficient Points');

            return false;

            //redirect('main/share_points');



        }



    }



    public function assignThanQpoints()

    {

        $std_PRN = $this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

        $school_id=$row['studentinfo'][0]->school_id;

        $row['teacherlist']=$this->teacher->teacherlist($std_PRN,$school_id);

        $this->load->view('teacherlist',$row);

    }











    public function Thanq_Assignpoints($t_id)

    {

        if($this->input->post('assign'))

        {



            $this->form_validation->set_rules('thanq_reason', 'thanq_reason', 'required');

            $this->form_validation->set_rules('points', 'points',

                'required|numeric|callback_validbluepoints[points]');

            if($this->form_validation->run())

            {

                $std_PRN = $this->session->userdata('std_PRN');

                $school_id=$this->session->userdata('school_id');

                $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

                $school_id=$row['studentinfo'][0]->school_id;;

                $row['teacherinfo']=$this->teacher->teacherinfo($t_id,$school_id);

                $balance_teach_blue_points=$row['teacherinfo'][0]->balance_blue_points;

                $balance_stud_blue_points=$row['studentinfo'][0]->balance_bluestud_points;

                $row['thanqreasonlist']=$this->student->thanqreasonlist($school_id);

                $this->student->assignbluepoints($school_id,$std_PRN,$balance_teach_blue_points,

                    $balance_stud_blue_points,$t_id);

                $row['teacherinfo']=$this->teacher->teacherinfo($t_id,$school_id);

                //$this->pushnotification->send_push_notification($Gcm_id, $message);

                $row['report']="Points are successfully assigned";

                $this->load->view('Thanq_Assignpoints',$row);





            }

            else

            {

                $std_PRN = $this->session->userdata('std_PRN');

                $school_id=$this->session->userdata('school_id');

                $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

                $school_id=$row['studentinfo'][0]->school_id;

                $row['teacherinfo']=$this->teacher->teacherinfo($t_id,$school_id);

                $row['thanqreasonlist']=$this->student->thanqreasonlist($school_id);



                $this->load->view('Thanq_Assignpoints',$row);



            }

        }

        else

        {

            $std_PRN = $this->session->userdata('std_PRN');

            $school_id=$this->session->userdata('school_id');

            $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

            $school_id=$row['studentinfo'][0]->school_id;

            $row['teacherinfo']=$this->teacher->teacherinfo($t_id,$school_id);

            $row['thanqreasonlist']=$this->student->thanqreasonlist($school_id);



            $this->load->view('Thanq_Assignpoints',$row);

        }

    }









    public function validbluepoints($points)

    {

        $std_PRN = $this->session->userdata('std_PRN');



        $school_id=$this->session->userdata('school_id');

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);



        $blue_points=$row['studentinfo'][0]->balance_bluestud_points;



        if($blue_points!=0 && $points<=$blue_points)

        {

            $this->form_validation->set_message('validbluepoints','Points are successfully assigned');

            return true;

        }

        else

        {

            $this->form_validation->set_message('validbluepoints','Insufficient blue points');

            return false;

        }



    }







    public function waterpoints()

    {



        if($this->input->post('search'))

        {



            $this->form_validation->set_rules('card_no', 'card_no', 'required|numeric|callback_validcard[card_no]');





            if($this->form_validation->run())

            {



                $card_no=$this->input->post('card_no');

                $std_PRN=$this->session->userdata('std_PRN');

                $row['cardinfo']=$this->student->valid_card($card_no);



                $school_id=$this->session->userdata('school_id');

                $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);



                $school_id=$row['studentinfo'][0]->school_id;



                $this->load->view('purchase_student_water_points',$row);



            }

            else

            {

                $std_PRN=$this->session->userdata('std_PRN');

                $school_id=$this->session->userdata('school_id');

                $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

                $school_id=$row['studentinfo'][0]->school_id;



                $this->load->view('purchase_student_water_points',$row);



            }







        }





        else

        {



            $std_PRN=$this->session->userdata('std_PRN');

            $school_id=$this->session->userdata('school_id');

            $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

            $school_id=$row['studentinfo'][0]->school_id;



            $this->load->view('purchase_student_water_points',$row);





        }





    }





    public function validcard($card_no)

    {

        $row['cardinfo']=$this->student->valid_card($card_no);



        if(count($row['cardinfo'])!=0)

        {

            return true;

        }

        else

        {



            $this->form_validation->set_message('validcard','Invalid Coupon');

            return false;

        }









    }



    public function purchase_reward1()

    {



        $std_PRN=$this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $user_type = $this->session->userdata('usertype');

        $reward_name = $this->uri->segment(4);

        $reward_points = $this->uri->segment(3);



        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

        $school_id=$row['studentinfo'][0]->school_id;

        $row['purchase']=$this->student-> purchase_reward($std_PRN,$school_id,$user_type,$reward_name,$reward_points);



        //$this->alert_value=1;

        /*if($this->alert_value==1)

        {

            echo "<script>alert('success')</script>";



        }





        */



        /*if($row){



        echo "<script>

alert('Reward purchased succesfully');

window.location.href='http://tsmartcookies.bpsi.us/main/purchase_softrewards';

</script>";*/

    }



    //redirect('main/purchase_softrewards');







    public function display_reward1()

    {

        $std_PRN=$this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

        $school_id=$row['studentinfo'][0]->school_id;

        $row['reward']=$this->student->display_reward($std_PRN,$school_id);



        $this->load->view('stud_header',$row);

    }







    public  function purchase_softrewards()

    {

        $std_PRN=$this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

        $school_id=$row['studentinfo'][0]->school_id;

        $row['purchase_softrewards']=$this->student->purchase_softrewards();



        $this->load->view('purchase_softrewards',$row);





    }





    public function student_purchase_points($card_no)

    {

        $std_PRN=$this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

        $school_id=$row['studentinfo'][0]->school_id;

        $balance_water_points=$row['studentinfo'][0]->balance_water_points;

        $row['cardinfo']=$this->student->valid_card($card_no);



        $amount=$row['cardinfo'][0]->amount;





        $this->student->student_purchase_points($card_no,$std_PRN,$school_id,$amount,$balance_water_points);

        $row['report']="Gift Card is successfully Used";

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

        redirect('main/waterpoints');







    }





    public function student_purchasepoints_log()

    {

        $std_PRN=$this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

        $school_id=$row['studentinfo'][0]->school_id;

        $row['student_water_points_log']=$this->student->student_water_points_log($std_PRN,$school_id);

        $this->load->view('student_water_points_log',$row);



    }







    public function social_media_points()

    {

        if($this->input->post('done'))

        {

            $std_PRN=$this->session->userdata('std_PRN');

            $school_id=$this->session->userdata('school_id');

            $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

            $row['studentpointsinfo']=$this->student->studentpointsinfo($std_PRN,$school_id);



            //$online_presence= $this->input->post('online_presence');







            $presence= $this->input->post('online_presence');

            if(count($presence)!=0)

            {



                $points=0;

                $online_presence="";

                foreach($presence as $selected)

                {

                    $row['points']=$this->student->points_from_socialmedia($selected);



                    $media_points=$row['points'][0]->points;

                    $media_name=$row['points'][0]->media_name;



                    $this->student->add_points_social_media($media_points,$media_name,$std_PRN);

                    $points=$points+$media_points;

                    $online_presence=$online_presence."".substr($media_name, 0,2);









                }





                if(isset($row['studentpointsinfo'][0]->online_flag)!='')

                {

                    $online_flag=$row['studentpointsinfo'][0]->online_flag."".$online_presence;

                    $points=$row['studentpointsinfo'][0]->sc_total_point+$points;

                    $flag='Y';



                }



                else

                {

                    $online_flag='';

                    $flag='N';

                }













                $this->student->social_media_points($std_PRN,$points,$online_flag,$flag);



                $std_PRN=$this->session->userdata('std_PRN');

                $school_id=$this->session->userdata('school_id');

                $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

                $row['studentpointsinfo']=$this->student->studentpointsinfo($std_PRN,$school_id);

                $row['social_media']=$this->student->social_media();

                $row['report']="Points are added Successfully";

                $this->load->view('student_online_presence',$row);







            }

            else

            {



                $std_PRN=$this->session->userdata('std_PRN');

                $school_id=$this->session->userdata('school_id');

                $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

                $row['studentpointsinfo']=$this->student->studentpointsinfo($std_PRN,$school_id);

                $row['social_media']=$this->student->social_media();

                $row['report1']="Please Select any Social Media";

                $this->load->view('student_online_presence',$row);



            }





        }



        else

        {

            $std_PRN=$this->session->userdata('std_PRN');

            $school_id=$this->session->userdata('school_id');

            $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

            $row['studentpointsinfo']=$this->student->studentpointsinfo($std_PRN,$school_id);

            $row['social_media']=$this->student->social_media();
			if(!empty($row)){

            $this->load->view('student_online_presence',$row);
			}
			else
			{
				$this->load->view('student_online_presence');
			}

        }







    }











    public function student_requestlist($value='View_all')

    {

        if($value=="View_all")

        {

            $std_PRN=$this->session->userdata('std_PRN');

            $school_id=$this->session->userdata('school_id');

            $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

            echo $school_id=$row['studentinfo'][0]->school_id;

            $row['requestslist']=$this->student->requests_pointlist($std_PRN,$school_id);



            $this->load->view('student_requestlist',$row);

        }



        if($value!=0)

        {



            $std_PRN=$this->session->userdata('std_PRN');

            $school_id=$this->session->userdata('school_id');

            $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

            $school_id=$row['studentinfo'][0]->school_id;

            $row['requestinfo']=$this->student->requsetinfo($value,$std_PRN,$school_id);

            $points=$row['requestinfo'][0]->points;

            $stud_id=$row['requestinfo'][0]->stud_id1;

            $reason=$row['requestinfo'][0]->reason;



            if(isset($points)!='')

            {

                $result=$this->requestpoints($points);

                if($result)

                {

                    $std_PRN=$this->session->userdata('std_PRN');



                    $row['studentpointsinfo']=$this->student->studentpointsinfo($std_PRN,$school_id);

                    $rewards=$row['studentpointsinfo'][0]->sc_total_point;

                    $row['studpoints']=$this->student->studentpointsinfo($stud_id,$school_id);



                    if(isset($row['studpoints'][0]->yellow_points)!='')

                    {

                        $student_yellowpoints=$row['studpoints'][0]->yellow_points;

                        $flag='Y';



                    }



                    else

                    {

                        $student_yellowpoints=0;

                        $flag='N';

                    }



                    $std_PRN=$this->session->userdata('std_PRN');

                    $school_id=$this->session->userdata('school_id');

                    $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

                    $school_id=$row['studentinfo'][0]->school_id;



                    $this->student->assign_request_points($stud_id,$std_PRN,$points,$value,$reason,$rewards,

                        $student_yellowpoints,$flag,$school_id);



                    $row['requestslist']=$this->student->requests_pointlist($std_PRN,$school_id);

                    $row['report']="Request successfully accepted";

                    $this->load->view('student_requestlist',$row);

                }



                else

                {



                    $std_PRN=$this->session->userdata('std_PRN');

                    $school_id=$row['studentinfo'][0]->school_id;

                    $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

                    $row['requestslist']=$this->student->requests_pointlist($std_PRN,$school_id);

                    $row['report1']="Points are insufficient";

                    $this->load->view('student_requestlist',$row);

                }



            }







        }

        if ( strpos($value,'R') !== false )



        {

            $id=explode('R',$value);

            $value=$id[1];

            $std_PRN=$this->session->userdata('std_PRN');

            $school_id=$this->session->userdata('school_id');

            $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

            $school_id=$row['studentinfo'][0]->school_id;

            $this->student->decline_student_request($value,$std_PRN,$school_id);

            $row['report1']="Request Declined";

            $row['requestslist']=$this->student->requests_pointlist($std_PRN,$school_id);



            $this->load->view('student_requestlist',$row);



        }



    }







    public function requestpoints($points)

    {



        $std_PRN = $this->session->userdata('std_PRN');

        $school_id = $this->session->userdata('school_id');

        $row['studentpointsinfo']=$this->student->studentpointsinfo($std_PRN,$school_id);

        $rewards=$row['studentpointsinfo'][0]->sc_total_point;

        if(isset($rewards)!='')

        {

            if($rewards!=0 && $points<=$rewards)

            {

                return true;

            }

            else

            {

                return false;

            }



        }

        else

        {

            return false;

        }



    }



    public function pending_request_student()

    {

        $std_PRN = $this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

        $school_id=$row['studentinfo'][0]->school_id;

        $row['requestslist']=$this->student->pending_student_request_info($std_PRN,$school_id);

        $this->load->view('student_requestlist',$row);

    }















    public function show_studlistfor_request()

    {

        //$select_opt=$this->input->post('select_opt');

        $std_PRN = $this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');



        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

        $school_id=$row['studentinfo'][0]->school_id;

        //$row['stud_sem_record']=$this->student->student_semister_record($std_PRN,$school_id);

        /*$BranchName=@$row['stud_sem_record'][0]->BranchName;

        //$DeptName=@$row['stud_sem_record'][0]->DeptName;

        $SemesterName=@$row['stud_sem_record'][0]->SemesterName;

        $CourseLevel=@$row['stud_sem_record'][0]->CourseLevel;

        $DivisionName=@$row['stud_sem_record'][0]->DivisionName;

        **/

        $studentPRN = $this->input->post('prn');

        $studphone= $this->input->post('phone');

        $studemail= $this->input->post('email');

        $studentname = $this->input->post('name');





        //$studaddress= $this->input->post('addr');



        $row['studentsearchlist']=$this->student->studentsearchlist($std_PRN,$school_id,$studentPRN,$studemail,$studphone,$studentname);



        /*$row['studentlist']=$this->student->studentlist($std_PRN,$school_id,$BranchName,$DeptName,$SemesterName,

        $CourseLevel,$DivisionName);*/

        //$select_opt=$this->input->post('select_opt');



        $this->load->view('show_studlistfor_request',$row);



    }







    public function send_reuest_to_student($student_id)

    {



        if($this->input->post('request'))

        {

            $this->form_validation->set_rules('reason', 'reason', 'required');

            $this->form_validation->set_rules('points', 'points', 'required|numeric');

            if($this->form_validation->run())

            {

                $std_PRN = $this->session->userdata('std_PRN');

                $school_id=$this->session->userdata('school_id');

                $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

                $school_id=$row['studentinfo'][0]->school_id;;

                $result=$this->student->send_request_tostudent($school_id,$std_PRN,$student_id);

                if($result)

                {

                    $row['studinfo']=$this->student->studentinfo($student_id,$school_id);

                    $row['studentpointsinfo']=$this->student->studentpointsinfo($student_id,$school_id);

                    $row['report']="Request Sent Successfully";

                    $this->load->view('send_reuest_to_student',$row);

                }

                else

                {

                    $row['studinfo']=$this->student->studentinfo($student_id,$school_id);

                    $row['studentpointsinfo']=$this->student->studentpointsinfo($student_id,$school_id);

                    $row['report1']="Already request sent";

                    $this->load->view('send_reuest_to_student',$row);

                }

            }



            else

            {

                $std_PRN = $this->session->userdata('std_PRN');

                $school_id=$this->session->userdata('school_id');

                $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

                $school_id=$row['studentinfo'][0]->school_id;

                $row['studinfo']=$this->student->studentinfo($student_id,$school_id);

                $row['report1']="";

                $this->load->view('send_reuest_to_student',$row);





            }



        }

        else

        {

            $std_PRN = $this->session->userdata('std_PRN');

            $school_id=$this->session->userdata('school_id');

            $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

            $school_id=$row['studentinfo'][0]->school_id;

            $row['studinfo']=$this->student->studentinfo($student_id,$school_id);

            $row['report1']="";

            $this->load->view('send_reuest_to_student',$row);

        }



    }





    public function teacherlist_request($teach_id='')

    {

        if($teach_id!='')

        {







            $std_PRN = $this->session->userdata('std_PRN');

            $school_id=$this->session->userdata('school_id');

            $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

            $row['studentteacherrequset_info']=$this->student->studentteacherrequset_info($std_PRN,$school_id);

            $row['sendrequest']=$this->student->studentsendrequest($std_PRN,$teach_id,$school_id);



            $row['studentteacherrequset_info']=$this->student->studentteacherrequset_info($std_PRN,$school_id);

            $row['teacherlist']=$this->teacher->schoolteacherlist($std_PRN,$school_id);

            $row['selectopt']=1;



            $this->load->view('teacherlist_request',$row);





        }



        else if($this->input->post('select_opt')=="2")



        {





            $std_PRN = $this->session->userdata('std_PRN');

            $school_id=$this->session->userdata('school_id');

            $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

            $row['studentteacherrequset_info']=$this->student->studentteacherrequset_info($std_PRN,$school_id);

            //print_r($row['studentteacherrequset_info']);die;

            $row['teacherlist']=$this->teacher->schoolteacherlist($std_PRN,$school_id);

            $row['selectopt']=1;



            $this->load->view('teacherlist_request',$row);

        }



        else

        {

            $std_PRN = $this->session->userdata('std_PRN');

            $school_id=$this->session->userdata('school_id');

            $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

            $school_id=$row['studentinfo'][0]->school_id;

            //echo $school_id;die;

            $row['teacherlist']=$this->teacher->teacherlist($std_PRN,$school_id);

            $row['selectopt']=2;

            $this->load->view('teacherlist_request',$row);





        }







    }



    public function teacherlist_coordinator()

    {

        if($this->input->post('request'))

        {

            $teacher_id= $this->input->post('teacher_id');



            $std_PRN = $this->session->userdata('std_PRN');

            $school_id=$this->session->userdata('school_id');

            $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

            $school_id=$row['studentinfo'][0]->school_id;

            $stud_id=$row['studentinfo'][0]->id;





            $result=$this->student->send_request_toteacher_coordinator($stud_id,$teacher_id,$school_id);

            $row['coordinator_request_info']=$this->student->coordinator_request_info($stud_id,$school_id);



            $row['teacherlist']=$this->teacher->teacherlist($std_PRN,$school_id);

            $row['report']="Request Sent Successfully";



            $this->load->view('teacherlist_coordinator',$row);







        }

        else

        {



            $std_PRN = $this->session->userdata('std_PRN');

            $school_id=$this->session->userdata('school_id');

            $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

            $school_id=$row['studentinfo'][0]->school_id;

            $stud_id=$row['studentinfo'][0]->id;

            //	print_r($row);die;

            $row['coordinator_request_info']=$this->student->coordinator_request_info($stud_id,$school_id);

            $row['teacherlist']=$this->teacher->teacherlist($std_PRN,$school_id);



            $this->load->view('teacherlist_coordinator',$row);

        }



    }





    public function send_requestteacher($t_id)

    {

        if($this->input->post('assign'))

        {





            $activitydisplay = $this->input->post('activitydisplay');





            $this->form_validation->set_rules('activity_type', 'activity_type', 'required');



            $this->form_validation->set_rules('points', 'points', 'required|numeric');

            if($this->form_validation->run())

            {



                $std_PRN = $this->session->userdata('std_PRN');

                $school_id=$this->session->userdata('school_id');

                $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

                $school_id=$row['studentinfo'][0]->school_id;

                $row['teacherinfo']=$this->teacher->teacherinfo($t_id,$school_id);



                $row['thanqreasonlist']=$this->student->thanqreasonlist($school_id);

                $row['activity_type']=$this->school_admin->activity_typeinfo();

                $row['subject_list']=$this->student->subjectlistforteacher($t_id,$std_PRN,$school_id);









                $result=$this->student->send_request_toteacher($school_id,$std_PRN,$t_id);

                if($result)

                {

                    $school_id=$this->session->userdata('school_id');

                    $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);





                    $row['report1']="Request Sent Successfully";

                    $this->load->view('send_request_teacher',$row);

                }

                else

                {

                    $school_id=$this->session->userdata('school_id');

                    $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);



                    $row['report']="Already request sent";

                    $this->load->view('send_request_teacher',$row);

                }















            }

            else

            {

                $std_PRN = $this->session->userdata('std_PRN');

                $school_id=$this->session->userdata('school_id');

                $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

                $school_id=$row['studentinfo'][0]->school_id;

                $row['teacherinfo']=$this->teacher->teacherinfo($t_id,$school_id);

                $row['thanqreasonlist']=$this->student->thanqreasonlist($school_id);

                $row['activity_type']=$this->school_admin->activity_typeinfo();

                $row['subject_list']=$this->student->subjectlistforteacher($t_id,$std_PRN,$school_id);

                $this->load->view('send_request_teacher',$row);

            }





        }

        else

        {

            $std_PRN = $this->session->userdata('std_PRN');

            $school_id=$this->session->userdata('school_id');

            $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

            $school_id=$row['studentinfo'][0]->school_id;

            $row['teacherinfo']=$this->teacher->teacherinfo($t_id,$school_id);

            $row['thanqreasonlist']=$this->student->thanqreasonlist($school_id);

            $row['activity_type']=$this->school_admin->activity_typeinfo();

            $row['subject_list']=$this->student->subjectlistforteacher($t_id,$std_PRN,$school_id);

            $this->load->view('send_request_teacher',$row);

        }

    }











    public function getactivity()

    {

        $activity_type = $this->input->post('activity_type');

        $school_id = $this->input->post('school_id');







        $row['activity']=$this->school_admin->get_activity($activity_type,$school_id);



        if($row['activity']!='' || $row['activity']!=null)

        {

            $activitydisplay=array();

            foreach ($row['activity'] as $c)

            {

                $activitydisplay[$c->sc_id] = $c->sc_list;

            }



            //dropdown



            echo form_dropdown('activitydisplay', $activitydisplay,'Select','class="form-control"');



        }







    }







    public function student_profile()

    {

        $std_PRN = $this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

        $school_id=$row['studentinfo'][0]->school_id;

        $std_PRN = $this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

    }











    public function student_subjectlist()

    {

        $std_PRN = $this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

        $school_id=$row['studentinfo'][0]->school_id;

        if($this->session->userdata('usertype')=='employee'){

            $row['student_subjectlist']=$this->student->emp_projectlist($std_PRN,$school_id);

        }else{

            $row['student_subjectlist']=$this->student->student_subjectlist($std_PRN,$school_id);

        }

        $this->load->view('student_subjectlist',$row);

    }

    public function Add_subject_view()

    {

        $std_PRN = $this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

        $school_id=$row['studentinfo'][0]->school_id;

        $row['getallsubject']=$this->student->getallsubject($school_id);

        $row['getalldepartment']=$this->student->getalldepartment($school_id);

        $row['getCourselevel']=$this->student->getCourselevel($school_id);

        $row['getallbranch']=$this->student->getallbranch($school_id);

        $row['getallsemester']=$this->student->getallsemester($school_id);

        $row['getAcademicYear']=$this->student->getAcademicYear($school_id);

        $row['getDivision']=$this->student->getDivision($school_id);



        if ($this->input->server('REQUEST_METHOD') == 'POST'){



            $CourseLevel = $this->input->post('CourseLevel');

            $department = $this->input->post('department');

            $Branch = $this->input->post('Branch');

            $semester = $this->input->post('semester');

            $AcademicYear = $this->input->post('AcademicYear');

            $Division = $this->input->post('Division');

            $subject_name = $this->input->post('subject_name');

            if(isset($subject_name)) {

                $sub = $this->student->GetSubjectID($subject_name, $school_id);
					
					$sub_id  = empty($sub[0]->subjcet_code) ? NULL : $sub[0]->subjcet_code;
                //$sub_id=$sub[0]->subjcet_code;

                 /*echo "<pre>";

                 die(print_r($sub_id,true));*/



                if($sub_id==''){

                    echo "<script> alert('please try again');</script>";

                    $row['report1']="Subject Not Added please try again ";

                    //$this->load->view('Add_subject_view',$row);
					redirect('/main/Add_subject_view', 'refresh');

                }
				

                /*echo "<pre>";

                die(print_r($sub_id,true));*/

            }

            // $sub_id = $this->input->post('Subject_Code');



            if(!empty($sub_id)){

                $data=array(

                    'school_id'=>$school_id,

                    'student_id'=>$std_PRN,

                    'CourseLevel'=>$CourseLevel,

                    'Department_id'=>$department,

                    'Branches_id'=>$Branch,

                    'Semester_id'=>$semester,

                    'AcademicYear'=>$AcademicYear,

                    'Division_id'=>$Division,

                    'subjectName'=>$subject_name,

                    'subjcet_code'=>$sub_id,

                );

                // $row['report']=$this->student->Add_subject($data);

                $row['report']=$this->student->AddSubject($data);

                $row['report']="Subject Added Successfully ";

                $this->load->view('Add_subject_view',$row);

            }else{

                // echo "<script> alert('please try again');</script>";


					redirect('/main/Add_subject_view', 'refresh');
                //$this->load->view('Add_subject_view',$row);

            }

        }elseif($this->input->server('REQUEST_METHOD') == 'GET'){



            $this->load->view('Add_subject_view',$row);

        }

    }

    public function logout()

    {
		$this->load->model("Mlogin");
		$this->Mlogin->sessionLogout();

        $this->session->sess_destroy();

        redirect(base_url());



        //$this->session->unset_userdata();

    }







    public function coupon_generate()

    {

        $this->form_validation->set_rules('points', 'points', 'required');

        if($this->form_validation->run()!=false)

        {

            $std_PRN = $this->session->userdata('std_PRN');

            $school_id = $this->session->userdata('school_id');

            $st_mem_id=$this->student->get_student_member_id($std_PRN,$school_id);
                   $select_opt = $this->input->post('select_opt');
				   if($select_opt==0)
			{
				
				
                $this->form_validation->set_message('submit','Please choose points');
				
				
				
			}
            
			
			
			else{
				
				$row['report']=$this->student->student_generate_coupon($std_PRN,$school_id,$st_mem_id,$select_opt);
			}
			
			//$select_opt = $this->input->post('select_opt');
			
			
			
			
			
			
			
			
			
			

            redirect('main/members');

        }

        else

        {

        }









    }



    public function showcoupon($id)

    {



        $std_PRN = $this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $st_mem_id = $this->student->get_student_member_id($std_PRN,$school_id);



        //echo "<pre>";

        //die(print_r($st_mem_id, TRUE));

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

        $row['couponinfo']=$this->student->smartcookie_coupon_info($id);

        $row['id']=$id;



        foreach($row['couponinfo'] as $coupon)

        {

            //$coupon_code= $coupon->cp_code;

            $params['data'] =$coupon->cp_code;

        }

        //$params['data'] =$coupon_code ;



        //$params['savename'] ='echo base_url()public\qrcode\image.png';

        $params['level'] = 'H';

        $params['size'] = 3;

        $params['savename'] = FCPATH.'qrcode/qrcode.png';



        //echo $this->ciqrcode->generate($params);





        $this->load->view('qr_img0.50j/php/show_coupon',$row);



    }





    public function sponsor_map()

    {

        $std_PRN = $this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

        $row['sponsorinfo']=$this->sponsor->sponsorinfo();

        $row['schoolinfo']=$this->school_admin->school_info();

        $config['center'] = 'auto';

        $config['onboundschanged'] = 'if (!centreGot) {

			var mapCentre = map.getCenter();

			marker_0.setOptions({

				position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng()) 

			});

				}

				centreGot = true;';

        $this->googlemaps->initialize($config);





        // set up the marker ready for positioning

        // once we know the users location

        $marker = array();

        $marker['icon'] = 'https://maps.google.com/mapfiles/kml/shapes/man.png';

        $marker['infowindow_content'] =  'My Position';

        $this->googlemaps->add_marker($marker);



        foreach($row['sponsorinfo'] as $sponsor)

        {

            $lat= $sponsor->lat;



            $lon=$sponsor->lon;

            //$sp_address=.",".$sponsor->sp_address;

            $marker['position'] = $lat.",".$lon;

            $marker['infowindow_content'] = $sponsor->sp_name;

            //$marker['infowindow_content'] = $sponsor->sp_address;

            $marker['icon'] = 'http://maps.google.com/mapfiles/marker_brownS.png';

            $this->googlemaps->add_marker($marker);



        }

        $row['map'] = $this->googlemaps->create_map();

        $this->load->view('sponsor_map', $row);





    }




    public  function update_profile()

    {

        if($this->input->post('update'))

        {



            $this->form_validation->set_rules('fname', 'firstname', 'required|alpha');

            $this->form_validation->set_rules('mname', 'Middlename', 'required|alpha');

            $this->form_validation->set_rules('lname', 'Lastname', 'required|alpha');

            //$this->form_validation->set_rules('gender', 'gender', 'required');

            $this->form_validation->set_rules('address', 'address', 'required');

            $this->form_validation->set_rules('int_email', 'Email', 'required|valid_email');

            $this->form_validation->set_rules('ext_email', 'Email', 'required|valid_email');



            //$this->form_validation->set_rules('reason', 'reason', 'required');

            $this->form_validation->set_rules('phone', 'Phone', 'required|regex_match[/^[789][0-9]{9}$/]');
			
            //$this->form_validation->set_rules('picture', 'image/jpeg', 'required');



            if($this->form_validation->run())

            {

                $std_PRN = $this->session->userdata('std_PRN');

                $school_id=$this->session->userdata('school_id');

                $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

                $school_id=$row['studentinfo'][0]->school_id;

                $config['upload_path']          = './core/student_image/';

                $config['allowed_types']        = 'gif|jpg|jpeg|png';


                $this->load->library('upload', $config);

                $this->form_validation->set_rules($config);

                $image='';

                if($this->upload->do_upload('picture'))
				{
					
					

                    $image='student_image/'.$this->upload->data('file_name');

					 $row['report']="Profile successfully updated";

                $this->student->update_profile($std_PRN,$school_id,$image);

                $school_id=$this->session->userdata('school_id');

                $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

                $row['stud_sem_record']=$this->student->student_semister_record($std_PRN,$school_id);

                $this->load->view('update_profile',$row);
                }
				

                
				
				// error msg
			else
			{
				$this->student->update_profile($std_PRN,$school_id,$image);

                $school_id=$this->session->userdata('school_id');

                $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

                $row['stud_sem_record']=$this->student->student_semister_record($std_PRN,$school_id);

                
				
				 $row['report1']="Please select image file";
				 $this->load->view('update_profile',$row);
			}
            }
			
			
            else

            {

                $std_PRN = $this->session->userdata('std_PRN');

                $school_id=$this->session->userdata('school_id');

                $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

                $school_id=$row['studentinfo'][0]->school_id;

                $row['stud_sem_record']=$this->student->student_semister_record($std_PRN,$school_id);

                $this->load->view('update_profile',$row);

            }


        }

        else

        {



            $std_PRN = $this->session->userdata('std_PRN');

            $school_id=$this->session->userdata('school_id');

            $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);

            $school_id=$row['studentinfo'][0]->school_id;

            $row['stud_sem_record']=$this->student->student_semister_record($std_PRN,$school_id);

            $this->load->view('update_profile',$row);



        }



    }



    public static function update_profile_image($std_PRN,$school_id)

    {



        self::update_profile();

    }



    public  function remove_profile_image()

    {



        $std_PRN = $this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');

        $row['remove_profile_image']=$this->student->remove_profile_image($std_PRN,$school_id);

        //$this->load->view('update_profile',$row);

        redirect('/main/update_profile', 'refresh');



    }
	
	public function request_to_join_samrtcookie()
	
	{
		$std_PRN = $this->session->userdata('std_PRN');

        $school_id=$this->session->userdata('school_id');
		
        $row['studentinfo']=$this->student->studentinfo($std_PRN,$school_id);
			
		$this->load->view('request_to_join_samrtcookie',$row);
		
		
	}



    public function restricted()

    {

        $this->load->view('restricted');

    }



    /**

     * @description Get department by using courselevel

     * @auther Rohit Pawar

     * @date 2/05/2017

     */

  /*  public function getDepartment(){

        if($this->input->server('REQUEST_METHOD') == 'POST'){

            $data=$this->input->post('value');

            if($data){

                try{

                    $school_id=$this->session->userdata('school_id');

                    $results=(json_encode($this->student->getDepartment($data,$school_id), true));

                    //$results=$this->student->getDepartment($data,$school_id);

                    /*echo "<pre>";

                    die(print_r($results,true));

                    if(!empty($results)){

                        return json_encode(['code' => "200", "message" => "successful","status"=>"successful",'data' => $results]);

                    }

                }catch (Exception $e){

                    return json_encode(['code' => "400", "message" => "data is not comming","status"=>"failure"]);

                }

            }

            return json_encode(['code' => "400", "message" => "data is not comming","status"=>"failure"]);

        }else{

            return json_encode(['code' => "400", "message" => "value not passes","status"=>"failure"]);

        }



    }

*/

}



?>