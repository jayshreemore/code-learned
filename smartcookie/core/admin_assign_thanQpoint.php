<?php


ob_start();


             if(isset($_GET['Tid']))

			 {

				 $report="";

	include_once("school_staff_header.php");



	$id=$_GET['Tid'];



$rows=mysql_query("select * from tbl_teacher where id=$id");

$value=mysql_fetch_array($rows);

$school_id=$value['school_id'];

$scadmin_id=$_SESSION['staff_id'];



            

            if(isset($_POST['assign']))

				{

				

				if(isset($_POST['reason']))

				{

     				 $point=$_POST['point'];

                     $activity_id=$_POST['reason'];

	 				

					$arrs=mysql_query("select * from tbl_school_admin where id='$scadmin_id' ");

      				$arr=mysql_fetch_array($arrs);

					if($arr['balance_blue_points']>=$point)

					{

      				$sc_balance_blue_points=$arr['balance_blue_points']-$point;

                    $sc_assign_blue_points=$arr['assign_blue_points']+$point;



		  			mysql_query("update tbl_school_admin set balance_blue_points='$sc_balance_blue_points',assign_blue_points='$sc_assign_blue_points' where id='$scadmin_id'");

					$assign_date=date('m/d/Y');

					

					$arrs=mysql_query("select balance_blue_points from tbl_teacher where id='$id' ");

      				$arr=mysql_fetch_array($arrs);

      				$t_balance_blue_points=$arr['balance_blue_points']+$point;



                    

		  			mysql_query("update tbl_teacher set balance_blue_points='$t_balance_blue_points' where id='$id'");

					

					mysql_query("insert into tbl_teacher_point(sc_teacher_id,sc_entities_id,assigner_id,sc_point,sc_thanqupointlist_id,point_date) values('$id','102','$scadmin_id','$point','$activity_id','$assign_date')");

                    $report= "You assigned $point blue points .";

					 header("location:admin_assign_thanQpoint.php?id=$id&report=$report");

					 

					 }

					 

					 

					else

	 		{

	 				 $report= "You have insufficient balance to assign .";

			} 

					 

					  

	 }

	 

	 else

	 {

	 

	 $report="Please select ThanQ Reason";

	 }

	 

	            

	 

	}

	

 ?>

<html>

<head>

 <link rel="stylesheet" href="css/bootstrap.min.css">

</head>

<script>

function validate()

{

	var elem=document.forms['radioform'].elements['reason'];

	len=elem.length-1;

	chkvalue='';

	for(i=0; i<=len; i++)

	{

	if(elem[i].checked)chkvalue=elem[i].value;

	}

	if(chkvalue=='')

	{

	

	  document.getElementById('error').innerHTML="Please select reason";

	

	return false;

	}

	else

	{

	  document.getElementById('error').innerHTML="";

	}

	var value=document.getElementById('point').value;

	if(value=='' || value==null)

	{

	

		 document.getElementById('points').innerHTML="Please enter points";

		 return false;

	

	}

	

	regx=/^[0-9]*$/;

				//validation of point

				

			if(!regx.test(value))

				{

				  

					document.getElementById('points').innerHTML='Please enter valid points';

					return false;

				}

				else

				{

					document.getElementById('points').innerHTML="";

				}

		

	

	return true;

}

</script>



<body>



    <div>

    <div >

        <div style="height:10px;"></div>

    	

         </div>

         

         

       </div

       

       

       

       >

    <div class="row" style="padding:10px;">

    <div class="col-md-3" > 

        <div class="panel panel-default" style="border:1 px solid #999999;padding-left:15px;">

        <div class="row" style="font-size:20px;" align="center">

        Balance Blue  Points

        </div>

        <div class="row" style="font-size:24px;color:#06F;font-weight:bold;" align="center">

          <?php $row1=mysql_query("select balance_blue_points from tbl_school_admin where id='$scadmin_id'");

                $value1=mysql_fetch_array($row1);

                echo $value1['balance_blue_points']?>

        </div>

         <div class="row" style="font-size:16px;font-weight:bold;" align="center">

          Points

        </div>

        </div>

        <div  class="panel panel-default" >

        <div class="row" style="font-size:20px;" align="center">

            <?php echo ucwords($value['t_name']);?>

        </div>

        <div  class="panel panel-default" >

        <div class=" panel-heading" style="font-size:24px;color:#32979a;font-weight:bold;" align="center">

        <div class="panel-title">Classes</div>

        </div>

         <ul>

          <?php 

		

	

		$class=mysql_query("select distinct class,division from tbl_division divs join tbl_class c on c.class=divs.class_id where divs.teacher_id=$id");

		      while($class_value=mysql_fetch_array($class)){?>

              

         <div class="row" style="font-size:12px;padding-left:70px;" >

         <li>

          <?php if($class_value['division']!=""){echo 

		  $class=$class_value['class'];

		  $sql=mysql_query("select class from tbl_school_class where id='$class'");

		  $result=mysql_fetch_array($sql);

		  $division=$class_value['division'];

		  $sql1=mysql_query("select division from tbl_school_division where id='$division'");

		  $result1=mysql_fetch_array($sql1);

		  

		 echo $result['class']."-".$result1['division'];}

		  else

		  {

		   $class=$class_value['class'];

		  $sql=mysql_query("select class from tbl_school_class where id='$class'");

		  $result=mysql_fetch_array($sql);

		  echo $result['class'];}?>

        </div></li>

        <?php }?>

        </ul>

       </div>

        

      <div  class="panel panel-default" style="">

        <div class="panel-heading" style="font-size:24px;color:#32979a;font-weight:bold;" align="center">

          <div class="panel-title"> Subjects</div>

        </div>

        <ul>

       <?php 

		

		$class=mysql_query("select subject from  tbl_subject where teacher_id=$id");

		      while($class_value=mysql_fetch_array($class)){

			   $subject=$class_value['subject'];

		 $sql2=mysql_query("select subject from tbl_school_subject where id='$subject'");

		 $result1=mysql_fetch_array($sql2);

		 

			  ?>

         <div class="row" style="font-size:12px;padding-left:70px;" >

         

        <li>

		<?php echo $result1['subject']; ?>

         </li>

        </div>

        <?php }?>

        </ul>

        </div>

    </div>

    </div>



         <?php 

            

               

	

        

			

            ?>

            <div class="col-md-7"> 

    	<div class="panel panel-default" >

        <form method="post" name="radioform">

        <div class="row">

        <h3 style="margin-top:2px;color:#4A7B64;font-weight:bold;" align="center">Assign Blue Points to <?php echo $dynamic_teacher;?> </h3>

        </div>

        <div class="row">

            <div class="col-md-4"  style="padding-left:25px;font-family:Arial,Helvetica,sans-serif;font-size:13px;font-weight:bold;" >

                <?php echo $dynamic_teacher;?> Name :

            </div>

			<div class="col-md-4">

		 <?php echo ucwords($value['t_name']);?>

            </div>

          </div>

           <div class="row">

            <div class="col-md-4"  style="padding-left:25px;font-family:Arial,Helvetica,sans-serif;font-size:13px;font-weight:bold;">

           Balance Blue Points :</div>

			<div class="col-md-4">

		 <?php echo $value['balance_blue_points'];?>

            </div>

          </div>

           <div class="row">

            <div class="col-md-4" style="padding-left:25px;font-family:Arial,Helvetica,sans-serif;font-size:13px;font-weight:bold;">

           Used Blue Points :</div>

			<div class="col-md-4" >

		 <?php echo $value['used_blue_points'];?>

            </div>

          </div>

           

          

          

          <div class="row">

          <div class="col-md-4">

              <div align="left" style="padding:10px;font-size:16px"><b>Reason</b></div>

			  </div>

              </div>

            

			     <?php $row=mysql_query("select * from tbl_thanqyoupointslist where school_id='$school_id'");

				     $i=0;

					 $count=mysql_num_rows($row);

					 ?>

                     

                     <?php

				        while($values=mysql_fetch_array($row))

						{

						

						 if($i%3==0)

						 {

						  ?>

                          <div class="row">

                          <?php 

						 }

						      

								?>

                                 <div class="col-md-1" align="right">

                              <input type="radio" value='<?php echo $values['id']; ?>' id='<?php echo  $i;?>' name="reason">

                                </div>

                                <div class="col-md-3" align="left">

                                <?php echo ucwords($values['t_list']);?>

                                </div>

                               <?php 

							 if($i%3==2 || $count==$i+1)

								 {

								  ?>

								  </div>

								  <?php 

								 }	

								$i++;

						

						}

						    

				 ?>

              

              <div class="row" style="padding:5px;">

                   <div class="col-md-8">

               <div align="center" style="padding:10px;font-size:16px;color:#FF0000;" id="error"></div>

               </div>

               </div>

          

              

               <div class="row" style="padding:5px;">

                   <div class="col-md-4">

               <div align="left" style="padding:10px;font-size:16px"> <b>Assign Points</b></div>

               </div>

                 

                   <div class="col-md-3">

               <input type="text" name="point" class="form-control" id="point"/>

               </div>

                

               </div>

               

                 <div class="row" style="padding:5px;">

                   <div class="col-md-8">

               <div align="center" style="padding:10px;font-size:16px;color:#FF0000;" id="points"></div>

               </div>

               </div>

               

               <div class="row" >

               <div class="col-md-3"></div>

                 <div class="col-md-1">

                 <input type="submit" class="btn btn-primary"  name="assign" value="Assign" onClick="return validate()"/></div>

                <div class="col-md-4 col-md-offset-1">

                <a href="teacher_thanQ_points.php?name=<?=$name?>" style="text-decoration:none;"> <input type="button" class="btn btn-danger" name="back" value="Back"/></a>

                </div>

               </div>

               <div class="row" style="color:#FF0000; padding-top:20px;">

               <div class="col-md-9 " align="center">

              <?php 

			  if($report!="")

			  {

			   echo $report;

			  }

			  

			  else if(isset($_GET['report']))

						{

						echo $_GET['report'];

	                    

						}

                       ?>

                        </div>

               </div>

              

            </form>

           

	

            </div>

            

        </div>

        </div>

        

        

          

         

       

       

       

       

       

</body>

</html>

<?php

		     }

			 else

			 {

				 $report="";

	include("scadmin_header.php");



	$id=$_GET['id'];



$rows=mysql_query("select * from tbl_teacher where id=$id");

$value=mysql_fetch_array($rows);

$school_id=$value['school_id'];

$t_id=$value['t_id'];

$scadmin_id=$_SESSION['id'];



            

            if(isset($_POST['assign']))

				{

				if($_POST['point']>0)
				{

				if(isset($_POST['reason']))

				{

     				 $point=$_POST['point'];

                     $activity_id=$_POST['reason'];

	 				

					$arrs=mysql_query("select * from tbl_school_admin where id='$scadmin_id' ");

      				$arr=mysql_fetch_array($arrs);

					if($arr['balance_blue_points']>=$point)

					{

      				$sc_balance_blue_points=$arr['balance_blue_points']-$point;

                    $sc_assign_blue_points=$arr['assign_blue_points']+$point;



		  			mysql_query("update tbl_school_admin set balance_blue_points='$sc_balance_blue_points',assign_blue_points='$sc_assign_blue_points' where id='$scadmin_id'");

					$assign_date=date('d/m/Y');

					

					$arrs=mysql_query("select balance_blue_points from tbl_teacher where id='$id' ");

      				$arr=mysql_fetch_array($arrs);

      				$t_balance_blue_points=$arr['balance_blue_points']+$point;



                    

		  			mysql_query("update tbl_teacher set balance_blue_points='$t_balance_blue_points' where id='$id'");



					mysql_query("insert into tbl_teacher_point(sc_teacher_id,sc_entities_id,assigner_id,sc_point,sc_thanqupointlist_id,point_date) values('$t_id','102','$scadmin_id','$point','$activity_id','$assign_date')");

                    $report= "You assigned $point blue points .";

					 header("location:admin_assign_thanQpoint.php?id=$id&successreport=$report");

					 

					 }

					 

					 

					else

	 		{

	 				 $report= "You have insufficient balance to assign .";

			} 

					 

					  

	 }

	 

	 else

	 {

	 

	 $report="Please select ThanQ Reason";

	 }

				}
				else
				{
					$report="Enter valid points";
				}

	            

	 

	}

	

 ?>

<html>

<head>

 <link rel="stylesheet" href="css/bootstrap.min.css">

</head>

<script>

function validate()

{

	var elem=document.forms['radioform'].elements['reason'];

	len=elem.length-1;

	chkvalue='';

	for(i=0; i<=len; i++)

	{

	if(elem[i].checked)chkvalue=elem[i].value;

	}

	if(chkvalue=='')

	{

	

	  document.getElementById('error').innerHTML="Please select reason";

	

	return false;

	}

	else

	{

	  document.getElementById('error').innerHTML="";

	}

	var value=document.getElementById('point').value;

	if(value=='' || value==null)

	{

	

		 document.getElementById('points').innerHTML="Please enter points";

		 return false;

	

	}

	

	regx=/^[0-9]*$/;

				//validation of point

				

			if(!regx.test(value))

				{

				  

					document.getElementById('points').innerHTML='Please enter valid points';

					return false;

				}

				else

				{

					document.getElementById('points').innerHTML="";

				}

		

	

	return true;

}

</script>



<body>



    <div>

    <div >

        <div style="height:10px;"></div>

    	

         </div>

         

         

       </div

       

       

       

       >

    <div class="row" style="padding:10px;">

    <div class="col-md-3" > 

        <div class="panel panel-default" style="border:1 px solid #999999;padding-left:15px;">

        <div class="row" style="font-size:20px;" align="center">

        Balance Blue  Points

        </div>

        <div class="row" style="font-size:24px;color:#06F;font-weight:bold;" align="center">

          <?php $row1=mysql_query("select balance_blue_points from tbl_school_admin where id='$scadmin_id'");

                $value1=mysql_fetch_array($row1);

                echo $value1['balance_blue_points']?>

        </div>

         <div class="row" style="font-size:16px;font-weight:bold;" align="center">

          Points

        </div>

        </div>

        <div  class="panel panel-default" >

        <div class="row" style="font-size:20px;" align="center">

            <?php echo ucwords($value['t_complete_name']);?>

        </div>

     

    

    </div>

    </div>



         <?php 

            

               

	

        

			

            ?>

            <div class="col-md-7"> 

    	<div class="panel panel-default" >

        <form method="post" name="radioform">

        <div class="row">

        <h3 style="margin-top:2px;color:#4A7B64;font-weight:bold;" align="center">Assign Blue Points to <?php echo $dynamic_teacher;?> </h3>

        </div>

        <div class="row">

            <div class="col-md-4"  style="padding-left:25px;font-family:Arial,Helvetica,sans-serif;font-size:13px;font-weight:bold;" >

                <?php echo $dynamic_teacher;?> Name :

            </div>

			<div class="col-md-4">

		 <?php echo ucwords($value['t_complete_name']);?>

            </div>

          </div>

           <div class="row">

            <div class="col-md-4"  style="padding-left:25px;font-family:Arial,Helvetica,sans-serif;font-size:13px;font-weight:bold;">

           Balance Blue Points :</div>

			<div class="col-md-4">

		 <?php echo $value['balance_blue_points'];?>

            </div>

          </div>

           <div class="row">

            <div class="col-md-4" style="padding-left:25px;font-family:Arial,Helvetica,sans-serif;font-size:13px;font-weight:bold;">

           Used Blue Points :</div>

			<div class="col-md-4" >

		 <?php echo $value['used_blue_points'];?>

            </div>

          </div>

           

          

          

          <div class="row">

          <div class="col-md-4">

              <div align="left" style="padding:10px;font-size:16px"><b>Reason</b></div>

			  </div>

              </div>

            

			     <?php $row=mysql_query("select * from tbl_thanqyoupointslist where school_id='$school_id' order by `t_list`");

				     $i=0;

					 $count=mysql_num_rows($row);

					 ?>

                     

                     <?php

				        while($values=mysql_fetch_array($row))

						{

						

						 if($i%3==0)

						 {

						  ?>

                          <div class="row">

                          <?php 

						 }

						      

								?>

                                 <div class="col-md-1" align="right">

                              <input type="radio" value='<?php echo $values['id'];?>' id='<?php echo  $i;?>' name="reason">

                                </div>

                                <div class="col-md-3" align="left">

                                <?php echo ucwords($values['t_list']);?>

                                </div>

                                 

                                

                                <?php 

							 if($i%3==2 || $count==$i+1)

								 {

								  ?>

								  </div>

								  <?php 

								 }	

								$i++;

						

						}

						    

				 ?>

              

              <div class="row" style="padding:5px;">

                   <div class="col-md-8">

               <div align="center" style="padding:10px;font-size:16px;color:#FF0000;" id="error"></div>

               </div>

               </div>

          

              

               <div class="row" style="padding:5px;">

                   <div class="col-md-4">

               <div align="left" style="padding:10px;font-size:16px"> <b>Assign Points</b></div>

               </div>

                 

                   <div class="col-md-3">

               <input type="text" name="point" class="form-control" id="point"/>

               </div>

                

               </div>

               

                 <div class="row" style="padding:5px;">

                   <div class="col-md-8">

               <div align="center" style="padding:10px;font-size:16px;color: #ff0000;" id="points"></div>

               </div>

               </div>



               <div class="row" >

               <div class="col-md-3"></div>

                 <div class="col-md-1">

                 <input type="submit" class="btn btn-primary"  name="assign" value="Assign" onClick="return validate()"/></div>

                <div class="col-md-4 col-md-offset-1">

                <a href="teacher_thanQ_points.php" style="text-decoration:none;"> <input type="button" class="btn btn-danger" name="back" value="Back"/></a>

                </div>

               </div>

               <div class="row" style=" padding-top:20px;">

               <div class="col-md-9 " align="center">
				<div style="color:#008000;">
              <?php

			  if($report!="")

			  {

			   echo $report;

			  }

			  

			  else if(isset($_GET['report']))

						{

						echo $_GET['report'];

	                    

						}
else if(isset($_GET['successreport']))
{
                       ?>
                    </div>
                    <div style="color:#093;">
                    <?php 

					

						echo $_GET['successreport'];

	                    

						}
						else
						{
							} ?></div>
                        </div>

               </div>

              

            </form>

           

	

            </div>

            

        </div>

        </div>

        

        

          

         

       

       

       

       

       

</body>

</html>

<?php

			  }

  ?>