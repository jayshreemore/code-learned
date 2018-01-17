<?php
include("smartcookiefunction.php");
 include("conn.php");
 include("header.php");
   if(!isset($_SESSION['id']))
	 {
	 	header('Location:login.php');
	 }




 $query = mysql_query("select  s.id, sum(s.sc_point) total,s.sc_point,s.sc_teacher_id,sc.t_id,s.sc_stud_id, s.point_date, s.sc_studentpointlist_id,t.school_id, t.t_pc,t.t_name,t.tc_balance_point from tbl_student_point s, tbl_teacher t where s.sc_teacher_id = t.t_id and s.sc_entites_id='103'and t.id = '".$_SESSION['id']."' ");
$value = mysql_fetch_array($query);
$total = $value['total'];
$balance = $value['tc_balance_point'];
$t_id=$value['t_id'];


$sc_id=$value['school_id'];


 $teacher_id=$_SESSION['id'];
 
 
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
                    <div style="padding:2px 2px 2px 2px; background-image:url(image/images_.jpg); color:#FFFFFF; ">
					
                  
				    <div >
					
				   </div>
                    </div>
                 
                   <div style=" padding:15px;">
                     <div class="row" style="padding-top:2px;background-color:#2F329F;">
                                   
                       <div class="col-md-2"></div>
                                   
                                   
                                 
                                     <div class="col-md-2"></div>
                                     
                                   
                                    <div class="col-md-2"  align="right">
                                    
                                   <h2 style="color:#308C00;">&nbsp;</h2>
                                   </div>
                                   
                                   
                                   </div> 
								  
								       
                                   
                                   
                                   <div style="padding-top:15px;">
										
                                   <div class="row" style="border-top:groove;padding-top:30px;">
                                   <h3 align="center"> Used Points History </h3>
                                   
                                   <div style="padding-top:30px;">
                                   <table  id="example" class=" table-striped" width="100%"  ><thead>
                            	<tr><th width="5%">Sr.No.</th>
                                 <th width="30%">Name</th>
                            	<th width="30%">Reason</th><th width="40%">
                               
                                 Point</th><th width="40%">Date</th></tr></thead>
                           <?php
	
					
						$j=0;
				
						 
						  if( $teacher_id!= '')
						  {
					
			
					
						//$query1=mysql_query("select reason,sc_point,point_date from tbl_teacher_point where sc_teacher_id='$teacher_id' or sc_teacher_id='$t_id'  and sc_entities_id='102'");
					
					   //echo "select reason,sc_point,point_date from tbl_teacher_point where sc_teacher_id='$teacher_id' or sc_teacher_id='$t_id'  and sc_entities_id='102'";
					$sum = 0;   
					   
			$query1=mysql_query("select s.t_complete_name,s.t_name,s.t_middlename,s.t_lastname,sp.sc_point,sp.reason,sp.point_date from tbl_teacher_point sp join tbl_teacher s where sp.sc_teacher_id=s.id and sp.sc_entities_id='103' and sp.assigner_id='$id' order by sp.id desc " );		
						
				//echo"select s.t_complete_name,s.t_name,s.t_middlename,s.t_lastname,sp.sc_point,sp.reason,sp.point_date from tbl_teacher_point sp join tbl_teacher s where sp.sc_teacher_id=s.id and sp.sc_entities_id='103' and sp.assigner_id='$id' order by sp.id desc";
						
					

						   while($value1 = mysql_fetch_array($query1)){
							   $name=$value1['t_complete_name'];
								$sc_list= $value1['reason'];
								$point=$value1['sc_point'];
								$date=$value1['point_date'];
								$sum = $sum + $value1['sc_point'];
								//$sum1=$value1['SUM(sp.sc_point)'];
						   $j++;
						  
						   							   
							?>
                         <tr><td><?php echo $j;?>
                         <td style="padding-left:10px;">Shared To <?php echo $name ;?></td>
                        <td style="padding-left:10px;"><?php echo $sc_list;?></td>
                                <td style="padding-left:10px;"><?php echo $point;?></td>
                           <td><?php echo $date;?></td></tr>
                            <?php
                            	}
							
							
                      $query2=mysql_query("select s.t_complete_name,s.t_name,s.t_middlename,s.t_lastname,vc.for_points,vc.timestamp from tbl_selected_vendor_coupons vc join tbl_teacher s on s.id=vc.`user_id` where 
(vc.user_id='$t_id' or vc.user_id='$teacher_id' and vc.entity_id='2') " );		      
                         //echo "select s.t_complete_name,s.t_name,s.t_middlename,s.t_lastname,vc.for_points,vc.timestamp from tbl_selected_vendor_coupons vc join tbl_teacher s where vc.user_id=$t_id or vc.user_id=$teacher_id  and vc.entity_id='2'" ;   
                            
                             while($value2 = mysql_fetch_array($query2)){
								  $name= $value1['t_complete_name'];
								$sc_list= "coupon generation";
								$point=$value2['for_points'];
								$date=$value2['timestamp'];
								$sum = $sum + $value2['for_points'];
						   $j++;
						  
						   							   
							?>
                                <tr><td><?php echo $j;?></td>
                                <td style="padding-left:10px;"><?php echo Self ;?></td>
                                
                                <td style="padding-left:10px;"><?php echo $sc_list;?></td><td style="padding-left:10px;"><?php echo $point;?></td><td><?php echo $date;?></td>
                               
                                
                                </tr>
                                
                                 <?php
                            	}
							}
							
							 //echo $sum;
							?>
                            <div class="container">
  
<center> <h2>Total</h2> <button type="button" class="btn btn-primary"> <span class="badge"><?php echo $sum;?></span></button></center>
                             <div style="margin:center">
                            
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
