<?php

$json = file_get_contents('php://input');
$obj = json_decode($json);


 $school_id = $obj->{'school_id'};

 $format = 'json'; //xml is the default
include 'conn.php';
 if(!empty($school_id))
		{



            $query = mysql_query("select sc_id,sc_list from tbl_studentpointslist where school_id='$school_id'");
            $posts = array();
            //if(mysql_num_rows($query)>0)
           // {
              while($post = mysql_fetch_assoc($query))
              {
                $posts[] = $post;
              }
                    if(!empty($posts))
                    {
                    	$postvalue['responseStatus']=200;
          				$postvalue['responseMessage']="OK";
          				$postvalue['posts']=$posts;
                         header('Content-type: application/json');
               			 echo  json_encode($postvalue);
                        }else{


                              $postvalue['responseStatus']=204;
              				 $postvalue['responseMessage']=null;
              			     $postvalue['posts']=null;
                               header('Content-type: application/json');
                     			 echo  json_encode($postvalue);


                        }



           // }
        //  else
        //  {

                   /*      $postvalue['responseStatus']=204;
        				 $postvalue['responseMessage']=null;
        			     $postvalue['posts']=null;
                         header('Content-type: application/json');
               			 echo  json_encode($postvalue); */

         // }
              /* output in necessary format */


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