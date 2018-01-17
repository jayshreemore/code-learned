<?php
include('scadmin_header.php');
$report="";
/*$id=$_SESSION['id'];
$fields=array("id"=>$id);
$table="tbl_school_admin";*/
$smartcookie=new smartcookie();
$results=$smartcookie->retrive_individual($table,$fields);
$result=mysql_fetch_array($results);
$sc_id=$result['school_id'];




if(isset($_POST['submit']))
{
    $a_year = $_POST['a_year'];
    $year = $_POST['year'];
//echo"hello1";
//echo "SELECT * FROM  `tbl_academic_Year` WHERE `school_id`='$sc_id' and Academic_Year='$a_year' or Year = '$year' ";
   /* echo  $d_name." ".$d_post." ". $course; */
    $results=mysql_query("SELECT * FROM  `tbl_academic_Year` WHERE `school_id`='$sc_id' and (Academic_Year='$a_year' or Year = '$year') ");
	 //$rs = mysql_num_rows($results);
	
	
  if(mysql_num_rows($results)==0)
    {
		/*
					if(Academic_Year > 0)
					{
					$query= "select * from tbl_academic_Year WHERE Academi
					c_Year='$a_year'";
					$query_run = mysqli_query($con,$query);
					
					if(mysqli_num_rows($query_run)>0)
					{
						// there is already a user with the same username
						echo '<script type="text/javascript"> alert("User already exists.. try another username") </script>';
					}
					}*/
		//echo"hello 2";
       //echo"insert into `tbl_academic_Year`(Academic_Year,Year,school_id) values('$a_year','$year','$sc_id'";
	    $query="insert into `tbl_academic_Year` (Academic_Year,Year,school_id,Enable) values('$a_year','$year','$sc_id',1) ";
        $rs = mysql_query($query );
        $successreport = "Record inserted Successfully";
    }
    else
    {
        $errorreport = 'Error while inserting Record';
    }


}
?>

<html>
    <head>

    </head>
    <body>
        <div class="container" style="padding:25px;"" >

            	<div style="padding:2px 2px 2px 2px;border:1px solid #CCCCCC; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4;background-color:#F8F8F8;">

                   <form method="post">





                    <div class="row">

                    <div class="col-md-3 col-md-offset-1"  style="color:#700000 ;padding:5px;" ></div>

              			 <div class="col-md-3 " align="center" style="color:#663399;" >



                   				<h2>Add Academic Year</h2>

                               <!-- <h5 align="center"><a href="Add_SubjectSheet_updated_20160109PT.php" >Add Excel Sheet</a></h5>  -->
                                 <br><br>
               			 </div>



                     </div>









               <div class="row formgroup" style="padding:5px;" >



                   <div class="col-md-3 col-md-offset-4">

                        <input type="text" name="a_year" class="form-control " id="0" placeholder="Academic Year" required>

                   </div>

                   <br/><br/>

                    <div class="col-md-3 col-md-offset-4">

                        <input type="text" name="year" class="form-control " id="1" placeholder="Current Year" required>

                   </div>

                    <br/><br/>

                   <div class="col-md-3 col-md-offset-4">



                   </div>

                    <!--<br/><br/>
-->


                 </div>


                  <div id="error" style="color:#F00;text-align: center;" align="center"></div>


                   <div class="row" style="padding-top:15px;">



                  <div class="col-md-2 col-md-offset-4 " >

                    <input type="submit" class="btn btn-primary" name="submit" value="Add " style="width:80px;font-weight:bold;font-size:14px;" onClick="return valid()"/>

                    </div>



                     <div class="col-md-3 "  align="left">

                   <a href="list_school_academic_year.php" style="text-decoration:none;"> <input type="button" class="btn btn-primary" name="Back" value="Back" style="width:80px;font-weight:bold;font-size:14px;" /></a>

                    </div>



                   </div>

                     <div class="row" style="padding-top:15px;">

                     <div class="col-md-4">

                     <input type="hidden" name="count" id="count" value="1">

                     </div>

                      <div class="col-md-11" style="color:#FF0000;" align="center" id="error">



                      <?php echo $errorreport;?>

               			</div>
                         <div class="col-md-11" style="color:#063;" align="center" id="error">



                      <?php echo $successreport;?>

               			</div>



                    </div>




                  </form>

          </div>
          </div>

    </body>
</html>