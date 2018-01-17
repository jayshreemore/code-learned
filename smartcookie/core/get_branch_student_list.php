<?php
include("conn.php");

$id=$_SESSION['id'];
$query = mysql_query("select school_id from tbl_school_admin where id ='$id'");
$value = mysql_fetch_array($query);
$school_id=$value['school_id'];

?>
  <script>
   $('#example1').DataTable();
  </script>
<?php
$branch=$_GET['branch'];

//echo "select Degee_name,Degree_code from tbl_degree_master where school_id='$sc_id' and course_level='$value'";die;

 // $row=mysql_query("select DISTINCT t_dept from tbl_teacher where school_id='$school_id'"); 
  ?>
  

        <div class="container" style="padding-top:70px;" >	
				 <?php $branch=$_GET['branch'];
				 ?>
           <div class='panel-heading h4'><center>Assign Points to <?php echo $branch; ?> Branch Student List</center></div>
    	
                     
                  <div class='col-md-12' id='no-more-tables' style='padding-top:30px;' >
               <?php  $i=0;  ?>
               <table id="example1" class="display table-bordered" cellspacing="0" width="100%">

        <thead>

            <tr>

            <th style="width:5%">Sr.No</th>

                <th><?php echo $dynamic_student;?> ID</th>

                <th><?php echo $dynamic_student;?> Name</th>

                <th style="width:20%">Email ID</th>
				
				<th style="width:20%">Branch</th>

               <!--<th style="width:10%">Class</th>-->

                <th style="width:15%">Used Blue Points</th>

                <th style="width:20%">Balance Blue Points</th>

             </tr>

        </thead>

 <tbody>

        <?php $sql=mysql_query("Select * from tbl_student where school_id='$school_id' AND std_branch = '$branch' order by std_complete_name,std_name ASC");

		$i=1;

						 while($result=mysql_fetch_array($sql))

						 { 

									  $firstname=$result['std_name'];

									  $fathrname=$result['std_Father_name'];

									  $lastname=$result['std_lastname'];

									  $studentName=$firstname." ".$fathrname." ".$lastname;

						 ?>

<tr onClick="document.location = 'studassignbluepoints.php?id=<?php echo $result['id'];?>'">

                             <td><?php echo $i;?></td>

                             </td><td ><?php echo $result['std_PRN'];?></td>

                             <td><?php $coplitename=$result['std_complete_name'];

									 if($coplitename=="")

									 {echo ucwords(strtolower($studentName)); } else { echo ucwords(strtolower($coplitename));}

									  ?></td>

                             <td><?php echo $result['std_email'];?></td>

							 <td><?php echo $result['std_branch'];?></td>
							 
                             <td><?php echo $result['used_blue_points'];?> </td>

                             <td><?php echo $result['balance_bluestud_points'];?> </td>

                       </tr></a>

                  <?php $i++; }?>

        </tbody>

</table>

                </div>

