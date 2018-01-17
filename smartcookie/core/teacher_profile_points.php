<?php
include("smartcookiefunction.php");
 include("conn.php");
 include("header.php");
   if(!isset($_SESSION['id']))
	 {
	 	header('Location:login.php');
	 }




 $query = mysql_query("select  s.id, sum(s.sc_point) total,s.sc_point,s.sc_teacher_id, s.sc_stud_id, s.point_date, s.sc_studentpointlist_id,t.school_id, t.t_pc,t.t_name,t.tc_balance_point from tbl_student_point s, tbl_teacher t where s.sc_teacher_id = t.t_id and s.sc_entites_id='103'and t.id = '".$_SESSION['id']."' ");
 //echo"select  s.id, sum(s.sc_point) total,s.sc_point,s.sc_teacher_id, s.sc_stud_id, s.point_date, s.sc_studentpointlist_id,t.school_id, t.t_pc,t.t_name,t.tc_balance_point from tbl_student_point s, tbl_teacher t where s.sc_teacher_id = t.t_id and s.sc_entites_id='103'and t.id = '".$_SESSION['id']."' ";
$value = mysql_fetch_array($query);
$total = $value['total'];
$balance = $value['tc_balance_point'];

$sc_id=$value['school_id'];


 $teacher_id=$_SESSION['id'];
 
 $count=$balance+$total;
 
 
$sql=mysql_query("select t_id from tbl_teacher where id='$teacher_id'");
$testresult=mysql_fetch_array($sql);
$t_id=$testresult['t_id'];


							
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.css" rel="stylesheet" type="text/css"></link>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
  <script src="js/accordian.js"></script>  
    <script>
$(document).ready(function() {

    $('#example').DataTable();
} );
</script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    
<script>
function confirmation(xxx,yyy) {

    var answer = confirm("Are you sure you want to delete?")
    if (answer){
        
        window.location = "delete_teachersubject.php?subid="+xxx+"&sc_id="+yyy;
    }
    else{
       
    }
}


function confirmation1(xxx,yyy) {


    var answer = confirm("Are you sure you want to delete?")
    if (answer){
        
        window.location = "delete_classanddivision.php?classid="+xxx+"&divid="+yyy;
    }
    else{
       
    }
}
</script>

    
    
    
<title>Student Rewards::Smart Cookies</title>
</head>

<body style="text-shadow: none;">
    	
     
     <div class="container">
        <div class="row" style="padding-top:20px; padding-left:20px;">
	
      
        <!--center div-->
  
        <div  style="padding:2px 2px 2px 2px;border:1px solid #CCCCCC; background-color:#FFFFFF;">
                    <div style="padding:2px 2px 2px 2px; background-image:url(image/images_.jpg); color:#FFFFFF;background-color:#2F329F; ">
					
                   <?php echo $dynamic_student;?> Rewards
				    <div >
					<?php
					/*$q=mysql_query("select sum(st.sc_point) as totalpts ,s.std_name,s.std_complete_name,st.point_date,
						
IF(st.activity_type =  'subject', (SELECT subject from tbl_school_subject where Subject_Code=sc_studentpointlist_id and school_id='$sc_id' limit 1), (SELECT sc_list FROM tbl_studentpointslist WHERE sc_id = sc_studentpointlist_id and school_id='$sc_id' limit 1 ) ) AS reason
						 from tbl_student_point st  join tbl_student s on  s.std_PRN=st.sc_stud_id
 where st.sc_teacher_id='$t_id' and st.sc_entites_id='103' and s.school_id='$sc_id' ORDER BY st.id DESC");
				    
					
					while($value1 = mysql_fetch_array($q))
					{
						$total1=$value1[totalpts];
					}
					?>
				   Total Reward points from Students=<?php echo $total1;
				   */
				   
					?>
					
				   </div>
                    </div>
                    
                    <div class="container">
  
<center> <h2>Total</h2> <button type="button" class="btn btn-success"> <span class="badge"><?php echo $count;?></span></button></center>
                             <div style="margin:center">
                 
                   <div style=" padding:15px;">
                        <div class="row" style="padding-top:2px;">
                                   
                                   <div class="col-md-7" align="center">
                                   <h3>Balance Points</h3>
                                   </div>
                                  <div class="col-md-4">
                                   <h3>Used Points</h3>
                                   </div>
                                 </div> 
                                      <div class="row" style="padding-top:2px;">
                                   
                                   <div class="col-md-2"></div>
                                   
                                   
                                   <div class="col-md-3" align="center">
                                   <h2 style="color:#308C00;"><?php echo $balance;?></h2>
                                   </div>
                                   
                                    
                                     <div class="col-md-2"></div>
                                     
                                   
                                    <div class="col-md-2"  align="right">
                                   <h2 style="color:#308C00;"><?php echo $total;?></h2>
                                   </div>
                                   
                                   
                                   </div> 
								  
								       <div class="row"> 
                                <div class="col-md-4"></div>
                               <div class="col-md-4">  
                                <div  align="center" style=" color:#FFFFFF; padding:5px; background-color:#00611C; border:1px solid #999999; font-size:16px;">REWARDS
                                </div>
                                </div>
                                    </div>
                                   
                                   
                                   <div style="padding-top:15px;">
										
                                   <div class="row" style="border-top:groove;padding-top:30px;">
                                   <h3 align="center"><?php echo $dynamic_student;?> Reward History </h3>
                                   
                                   <div style="padding-top:30px;">
                                   <table  id="example" class=" table-striped" width="100%"  ><thead>
                            	<tr><th width="5%">Sr.No.</th><th width="30%"><?php echo $dynamic_student.' Name';?></th><th width="40%">
                                Activity/ <?php echo $dynamic_subject. ' Name';?></th><th width="35%" align="center" style="width: 12px;">Points</th><th width="40%">Reward Date</th></tr></thead>
                           <?php
	
					
						$j=0;
				
						 
						  if( $teacher_id!= '')
						  {
					
		$sum = 0;   
						$query1=mysql_query("select st.sc_point,s.std_name,s.std_complete_name,st.point_date,s.std_name,s.std_lastname,
						
IF(st.activity_type =  'subject', (SELECT subject from tbl_school_subject where Subject_Code=sc_studentpointlist_id and school_id='$sc_id' limit 1), (SELECT sc_list FROM tbl_studentpointslist WHERE sc_id = sc_studentpointlist_id and school_id='$sc_id' limit 1 ) ) AS reason
						 from tbl_student_point st  join tbl_student s on  s.std_PRN=st.sc_stud_id
 where st.sc_teacher_id='$t_id' and st.sc_entites_id='103' and s.school_id='$sc_id' ORDER BY st.id DESC");
 /*echo"select st.sc_point,s.std_name,s.std_complete_name,st.point_date,
						
IF(st.activity_type =  'subject', (SELECT subject from tbl_school_subject where Subject_Code=sc_studentpointlist_id and school_id='$sc_id' limit 1), (SELECT sc_list FROM tbl_studentpointslist WHERE sc_id = sc_studentpointlist_id and school_id='$sc_id' limit 1 ) ) AS reason
						 from tbl_student_point st  join tbl_student s on  s.std_PRN=st.sc_stud_id
 where st.sc_teacher_id='$t_id' and st.sc_entites_id='103' and s.school_id='$sc_id' ORDER BY st.id DESC";
					
			*/		    
					
						
					
						
					

						   while($value1 = mysql_fetch_array($query1)){
								$sc_list= $value1['reason'];
								$std_name=$value1['std_complete_name'];
								
								/*if ($std_name == "") {
                                        $name = ucwords(strtolower($result4['std_name'])) . " " . ucwords(strtolower($result4['std_Father_name'])) . " " . ucwords(strtolower($result4['std_lastname']));

                                        echo $name;
                                    } else {
                                        $name1 = ucwords(strtolower($std_name));
                                        echo $name1;
                                    }
									*/
								
								$sum = $sum + $value1['sc_point'];
						   $j++;
						  
						   							   
							?>
                                <tr><td><?php echo $j;?></td><td style="padding-left:10px;"><?php if ($std_name == "") {
                                        $name = ucwords(strtolower($value1['std_name'])) . " " . ucwords(strtolower($value1['std_Father_name'])) . " " . ucwords(strtolower($value1['std_lastname']));

                                        echo $name;
                                    } else {
                                        $name1 = ucwords(strtolower($std_name));
                                        echo $name1;
                                    }?></td><td style="padding-left:10px;"><?php echo $sc_list;?></td><td><?php echo $value1['sc_point'];?></td><td><?php echo $value1['point_date'];?></td></tr>
                            <?php
                            	}
							}
							?>
                            </table>
                         
                                   </div>
                                   
                                 </div>
                             </div>
                            
                        </div>
                        </div>
                       
      
 </div>
      </div>
</body>
</html>
