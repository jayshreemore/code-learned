<?php

 $json = file_get_contents('php://input');
$obj = json_decode($json);
    error_reporting(0);
    $stud_PRN = $obj->{'stud_prn'};
    $sch_id = $obj->{'school_id'};
    $user_type = $obj->{'user_type'};
    //$assign_date=date('d/m/Y');


  $number_of_posts = isset($_GET['num']) ? intval($_GET['num']) : 10; //10 is the default
  $format = 'json';

include 'conn.php';

 if($stud_PRN!="" && $sch_id!="" && $user_type!='')
	{
		$query="SELECT ps.*,s.imagepath,s.rewardType FROM `purcheseSoftreward` ps left join softreward s on ps.`reward_id`=s.`softrewardId` where `user_id`='$stud_PRN' and `school_id`='$sch_id' and `userType`='$user_type'";

		$result = mysql_query($query,$con) or die('Errant query:  '.$query);
		/* create one master array of the records */
		$posts = array();
		if(mysql_num_rows($result)>=1)
		{
			while($post = mysql_fetch_assoc($result))
			{
			$posts[] = $post;

			}
			$postvalue['responseStatus']=200;
			$postvalue['responseMessage']="OK";
			$postvalue['posts']=$posts;

		}
		else
			{
				$postvalue['responseStatus']=204;
				$postvalue['responseMessage']="No Response SELECT ps.*,s.imagepath,s.rewardType FROM `purcheseSoftreward` ps left join softreward s on ps.`reward_id`=s.`softrewardId` where `user_id`='$stud_PRN' and `school_id`='$sch_id' and `userType`='$user_type'";
				$postvalue['posts']=null;
			}

	 if($format == 'json')
      {
   					 header('Content-type: application/json');
   					 echo json_encode($postvalue);
    }
    else {
      header('Content-type: text/xml');
      echo '';
      foreach($posts as $index => $post) {
        if(is_array($post)) {
        foreach($post as $key => $value) {
          echo '<',$key,'>';
          if(is_array($value)) {
            foreach($value as $tag => $val) {
              echo '<',$tag,'>',htmlentities($val),'</',$tag,'>';
            }
          }
          echo '</',$key,'>';
        }
      }
    }
    echo '';
  }
  /* disconnect from the db */

  		}
	else
			{

			   $postvalue['responseStatus']=1000;
				$postvalue['responseMessage']="Invalid Input";
				$postvalue['posts']=null;

			  header('Content-type: application/json');
   			  echo  json_encode($postvalue);


			}


  @mysql_close($con);

?>