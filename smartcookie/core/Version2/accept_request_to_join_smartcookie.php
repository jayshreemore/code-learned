<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <style>
    .textstyle{
      color:red;
      margin-top:400px;
    }
  </style>
  <script>
  $(document).ready(function(){
    $('h1').fadeIn(2000);
    var server =window.location.hostname;
    $("#div").text('loading...').delay(10000).queue(function() {
             $(this).hide();
             window.location.assign("http://"+server);
             $(this).dequeue();
         });
  });
  </script>
</head>
<body>

<?php
include 'conn.php';
$sender_member_id = $_GET['id'];
$sender_entity_id = $_GET['senderentity'];
$receiver_entity_id = $_GET['receiverentity'];
$receiver_member_id = $_GET['receiver_member_id'];

/*$sender_member_id = 1194;
$sender_entity_id = 103;
$receiver_entity_id = 103;
$receiver_member_id = 1490;*/
$request_status = 'request_accepted';
$sender = $sender_entity_id == 103 ?  'teacher' : ( $sender_entity_id == 105 ? 'student' : 'sponsor');

$receiver = $receiver_entity_id == 103 ?  'teacher' : ( $sender_entity_id == 105 ? 'student' : 'sponsor');

$check_request_status_query = mysql_query("select accepted_datestamp from referral_activity_log where receiver_member_id='$receiver_member_id'");
$check_request_status_query_row = mysql_fetch_assoc($check_request_status_query);
if($check_request_status_query_row['accepted_datestamp']=='null' || $check_request_status_query_row['accepted_datestamp']=='')
{
$points_query = mysql_query("select points from rule_engine_for_referral_activity where from_user='$sender' and to_user='$receiver' and  referal_reason='$request_status'");
$points_query_result = mysql_fetch_assoc($points_query);
$points = (integer)$points_query_result['points'];

$points;
if($sender_entity_id == 105 || $sender_entity_id == 103)
{
  $data = array('request_status'=>$request_status,
    'sender_entity_id'=>$sender_entity_id,
    'receiver_entity_id'=>$receiver_entity_id,
    'sender_member_id'=>$sender_member_id,
    'receiver_member_id'=>$receiver_member_id,
    'receiver_employee_id'=>$receiver_member_id,
  );

  $ch = curl_init("http://$server_name/core/Version2/assign_promotion_points.php");
  $data_string = json_encode($data);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('ContentType: application/json','ContentLength: ' . strlen($data_string)));
  $result = json_decode(curl_exec($ch),true);
  $assign_promotion_points = $result["responseStatus"];

  if($assign_promotion_points == 200)
  {
    $accepted_datestamp = date("Ymd h:i:s");
    $referral_activity_log_query = mysql_query("update referral_activity_log set accepted_datestamp ='$accepted_datestamp'  where receiver_member_id='$receiver_member_id'");
    if($sender_entity_id == '103')
  {
    $teacher_query = mysql_query("select t_id,t_complete_name,t_email,t_phone from tbl_teacher where id='$receiver_member_id'");

    $teacher_query_result = mysql_fetch_assoc($teacher_query);
    $t_id = $teacher_query_result['t_id'];
    $sender_name = $teacher_query_result['t_complete_name'];
    $sender_phone = $teacher_query_result['t_phone'];
    $sender_email = $teacher_query_result['t_email'];

      $tbl_teacher_update_query=mysql_query("update tbl_teacher set brown_point = CASE
      WHEN brown_point is not null THEN brown_point + $points
      WHEN brown_point is null THEN $points
                    END
      where id='$receiver_member_id'");

      $tbl_teacher_update_query_error = mysql_error($con);

      $tbl_teacher_point_insert_query=mysql_query("insert into tbl_teacher_point (sc_teacher_id,sc_entities_id,assigner_id,reason,sc_point,point_date) values('$t_id','$receiver_entity_id','$receiver_member_id','$request_status','$points','$accepted_datestamp')");



  }
  elseif($sender_entity_id == '105')
  {
    $student_query = mysql_query("select std_PRN,std_complete_name,std_email,std_phone from tbl_student where id='$receiver_member_id'");
    $student_query_result = mysql_fetch_assoc($student_query);
    $std_PRN = $student_query_result['std_PRN'];
    $sender_name = $student_query_result['std_complete_name'];
    $sender_phone = $student_query_result['std_email'];
    $sender_email = $student_query_result['std_phone'];

    $tbl_student_reward_check_data_query = mysql_query("select id from tbl_student_reward where sc_stud_id='$std_PRN'");

        if(mysql_num_rows($tbl_student_reward_check_data_query) >= 1)
        {
          $tbl_student_reward_update_query=mysql_query("update tbl_student_reward set brown_point = CASE
          WHEN brown_point is not null THEN brown_point + $points
          WHEN brown_point is null THEN $points
                        END
          where sc_stud_id='$std_PRN'");
        }
        else
        {
          $tbl_student_reward_update_query=mysql_query("insert into tbl_student_reward (sc_stud_id,sc_date,brown_point) values ('$std_PRN','$accepted_datestamp','$points')");
        }
          $tbl_student_point_insert_query = mysql_query("INSERT INTO `tbl_student_point` (sc_stud_id, sc_entites_id, sc_teacher_id, reason,sc_point, point_date)VALUES('$std_PRN', '$receiver_entity_id', '$receiver_member_id ','$request_status', '$points', '$accepted_datestamp')");
    }

$server_name = $_SERVER['SERVER_NAME'];
    header('Location: '.'http://'.$server_name);
  //  header('Contenttype: application/json');
  //  echo json_encode($postvalue);
  }
  else
  {
    $postvalue['responseStatus']  = 1000;
    $postvalue['responseMessage'] = "invalid input from assign point web service";
    $postvalue['posts'] = null;
    var_dump($postvalue);
  //  header('Contenttype: application/json');
  //  echo json_encode($postvalue);
  }
}
}
echo '<center><div><h1 class="textstyle" style="display:none">Request Already Accepted</h1><hr style="border : 1px solid red;width:300px"/><div id="div"></div></div></center>';



 ?>

</body>
</html>
