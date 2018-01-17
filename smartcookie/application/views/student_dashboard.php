<?php 
//print_r($schoolinfo);
//print_r($studentinfo);
$this->load->view('stud_header',$studentinfo);

?>

<!DOCTYPE html>
<html lang="en">
<head><title>Dashboard</title>
    
    <script>
 $(document).ready(function() 
 {

    $('#example').DataTable({
	"pageLength": 5
	});
	
} );

</script>
</head>
<body>

    <!--END THEME SETTING-->
    <div id="page-wrapper"><!--BEGIN SIDEBAR MENU-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Dashboard</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="members">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Dashboard</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        <!--END SIDEBAR MENU--><!--BEGIN CHAT FORM-->
      
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
            <div class="page-content">
                <div id="tab-general">
                    <div id="sum_box" class="row mbl">
                        <div class="col-sm-6 col-md-3">
                          <a href="rewards_log"><div class="panel profit db mbm">
                                <div class="panel-body" style="background-color:#3DBD2F;border-color:#3DBD2F; color:#FFF;"><h4 class="value"><?php 
								if(isset($studentpointsinfo[0]->sc_total_point))
								{
								echo $studentpointsinfo[0]->sc_total_point;
								
								}else
								{
									echo "0";
								}?></h4>

                                    <p style="color:#FFF;">Rewards</p>

                                    
                                </div>
                            </div></a>
                        </div>
                        
                          <div class="col-sm-6 col-md-3">
                           <a href="thanQ_log"> <div class="panel income db mbm">
                                <div class="panel-body"  style="background-color:#203CB6;border-color:#203CB6; color:#FFF;"><h4 class="value"><?php 
								
								if(isset($studentinfo[0]->balance_bluestud_points))
								{
								echo $studentinfo[0]->balance_bluestud_points;
								
								}else
								{
									echo "0";
								}
								?></h4>

                                    <p style="color:#FFF;">ThanQ Points </p>

                                </div>
                            </div></a>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <a href="student_purchasepoints_log">  <div class="panel task db mbm">
                                <div class="panel-body" style="background-color:#D4EFFF;border-color:#D4EFFF; color:#000000;"><h4 class="value"><?php 
								
								
								if(isset($studentinfo[0]->balance_water_points))
								{
								echo $studentinfo[0]->balance_water_points;
								
								}else
								{
									echo "0";
								}
								?></h4>

                                    <p  style="color:#000000;">Water Points</p>

                                  
                                </div>
                            </div></a>
                        </div>
                        <div class="col-sm-6 col-md-3">
                          <a href="friendship_log">   <div class="panel visit db mbm">
                                <div class="panel-body"  style="background-color:#DFCF41;border-color:#DFCF41; color:#000000;"><h4 class="value"><?php 
								
						if(isset($studentpointsinfo[0]->yellow_points))
								{
								echo $studentpointsinfo[0]->yellow_points;
								
								}else
								{
									echo "0";
								}
								?></h4>


                                    <p  style="color:#000000;">Friendship Points</p>

                                    
                                </div>
                            </div></a>
                        </div>
                        
                        
                        
                       
                    </div>


                     <div id="tab-general">
                    <div id="sum_box" class="row mbl">
                        <div class="col-sm-6 col-md-3">
                         <a href="purple_points_log">    <div class="panel profit db mbm">
                                <div class="panel-body" style="background-color:#4B1F81;border-color:#4B1F81; color:#FFF;"><h4 >
								<?php 
								if(isset($studentpointsinfo[0]->purple_points))
								{
								echo $studentpointsinfo[0]->purple_points;
								
								}else
								{
									echo "0";
								}
								?></h4>

                                    <p style="color:#FFF;">Purple Points</p>

                                   
                                </div>
                            </div></a>
                        </div>
                         <div class="col-sm-6 col-md-3">
                             <a href="#" >  <div class="panel income db mbm">
                                <div class="panel-body" style="background-color:#7C3826;border-color:#7C3826; color:#FFF;"><h4>
                                    <?php 
								if(isset($studentpointsinfo[0]->brown_point))
								{
								echo $studentpointsinfo[0]->brown_point;
								
								}else
								{
									echo "0";
								}
								?></h4>
                                    <p style="color:#FFF;">Brown Points</p>

                                
                                </div>
                            </div></a>
                        </div>
                        
                      
                    </div>



                    <div class="row mbl" style="display:none;">
                        <div class="col-lg-8">
                            <div class="panel">
                                <div class="panel-body">
                                    <div class="row">
                                       

                                         <div id="area-chart-spline" style="width: 100%; height:300px"></div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        <div class="row" style="margin-top:2%;">
<div class="col-md-12">
<div class="jumbotron" align="center" style="padding-top:16px;">
<div style="font-size:19px;color:#000;">
Generate Smartcookie Coupon </div>
  
  <p style="padding-top:5px;">
   <?php  
   if(!empty($studentpointsinfo[0]->sc_total_point) || !empty($studentpointsinfo[0]->yellow_points)||!empty($studentpointsinfo[0]->purple_points)||!empty($studentwaterpointsinfo[0]->balance_water_points)||!empty($studentpointsinfo[0]->brown_point))
   {
	   //var_dump($studentpointsinfo);
	  // var_dump($studentwaterpointsinfo);die;
	      if(($studentpointsinfo[0]->sc_total_point!="" && $studentpointsinfo[0]->sc_total_point!=0 && $studentpointsinfo[0]->sc_total_point >=100) ||($studentpointsinfo[0]->yellow_points!="" && $studentpointsinfo[0]->yellow_points!=0 && $studentpointsinfo[0]->yellow_points >=100)||($studentpointsinfo[0]->purple_points!="" && $studentpointsinfo[0]->purple_points!=0 && $studentpointsinfo[0]->purple_points >=100 )||($studentwaterpointsinfo[0]->balance_water_points!="" && $studentwaterpointsinfo[0]->balance_water_points!=0 && $studentwaterpointsinfo[0]->balance_water_points >=100 )||($studentpointsinfo[0]->brown_point!="" && $studentpointsinfo[0]->brown_point!=0 && $studentpointsinfo[0]->brown_point >=100 ))
		//if($studentpointsinfo[0]->sc_total_point!=""  && $studentpointsinfo[0]->sc_total_point >=100 ||($studentpointsinfo[0]->yellow_points!=""  && $studentpointsinfo[0]->yellow_points >=100)||($studentpointsinfo[0]->purple_points!=""  && $studentpointsinfo[0]->purple_points >=100 )
				
		  
		  
    {
		
		?>
  <?php 
echo form_open('main/coupon_generate');?>
                             
                                       
									   
									   
									   	 <div class="form-group">
																 <label for="thanq_reason" class="col-md-3 control-label"> 
																 Select Point</label>
																<div class="col-md-4">
						                           <select id="select_opt" name="select_opt" class="form-control">
						
						                         <option value="0">Select Option</option>
                                            <option value="1" <?php 
	 
															 if(isset($_POST['select_opt']))
															 {
																 if($_POST['select_opt']=="1")
																 {  ?> selected 
															<?php } 
																 
															 }
															 ?>


															 ><?php echo "Green Points" ?></option>
															 <option value="2"   <?php 
															 
															 if(isset($_POST['select_opt']))
															 {
																 if($_POST['select_opt']=="2")
																 { ?> selected 
															<?php } 
																 
															 }
															  ?>


															  > <?php echo "Yellow Points" ?></option>
															  
															   <option value="3" <?php 
															 
															 if(isset($_POST['select_opt']))
															 {
																 if($_POST['select_opt']=="3")
																 {  ?> selected 
															<?php } 
																 
															 }
															 ?>


															 ><?php echo "Purple Points" ?></option>
															 
															  <option value="4" <?php 
															 
															 if(isset($_POST['select_opt']))
															 {
																 if($_POST['select_opt']=="4")
																 {  ?> selected 
															<?php } 
																 
															 }
															 ?>


															 ><?php echo "Water Points" ?></option>
															 
															 <option value="5" <?php 
	 
															 if(isset($_POST['select_opt']))
															 {
																 if($_POST['select_opt']=="5")
																 {  ?> selected 
															<?php } 
																 
															 }
															 ?>


															 ><?php echo "Brown Points" ?></option>
															  
															 
															  
															  
															  </select><?php echo form_error('select_opt', '<div class="error">', '</div>'); ?>
																				
																				</div>
																														

                                                            </div>

									   
									   
                                        	<select name="points" class="issueCertificatesSelectPoints"  id="points" style="width:20%; height:30px; border-radius:2px;">
                                            <?php
											
											/* student can genrate coupon upto total points*/
											$temp=100;
											   $val=$temp;
												$i=2;
											
												
                                               while($temp<=$studentpointsinfo[0]->sc_total_point||($temp<=$studentpointsinfo[0]->yellow_points)||($temp<=$studentpointsinfo[0]->purple_points)||($temp<=$studentwaterpointsinfo[0]->balance_water_points))
												{
												?>
                                            	<option value='<?php echo $temp?>' ><?php echo $temp ?></option>
                                                <?php
												 $temp=$val*$i;
												$i=$i+1;
												}
												
												?>
                                               
                                        </select>
                                       
                                        &nbsp;&nbsp;&nbsp;
                                        
                                       	<input type="submit" name="submit" value="Generate" class="btn btn-success" onclick="coupon_create()">
                                           <div id="errorpoints" style="color:#FF0000;">
                                           <?php ?></div></p>

                                     <?php echo form_close();?>
                                   
                                   
                                    <?php 
									
						}
                                     
									 else
						{
						
						?>
                        <div style="color:#FF0000;font-size:small">
                                	
                                  
                                        You should have minimum 100 reward points to generate a coupon.
                                        
                                      
                                        </div>
                        <?php
						}
		}
		else
		{
						
						?>
                        <div style="color:#FF0000;font-size:small">
                                	
                                  
                                        You should have minimum 100 reward points to generate a coupon.
                                        
                                      
                                        </div>
           <?php
		}
			?>
                                  
                                    
                                <hr  style="border-top: 1px solid #000;"/>
                                
                                <div class="row" style="font-size:19px;color:#000;">Smartcookie Coupons</div>
                              
                                
                                
                                <table id="example" class="table table-striped table-bordered" cellspacing="0"  >
								<thead style="background-color:#FFFFFF;">
								<tr>
									<th>Sr.No.</th>
									<th>Coupon Id</th>		
																											
																											
									<th>Amount</th>
									<th>Generation Date </th>
									<th>Validity Date</th>
									 <th>Show</th>
              
								</tr>
							</thead>
						<tbody>
							<?php 
		   
							/*	if(!$_SESSION['username'])
									{*/
                                            $i=1;
											
                                            foreach($couponinfo as $t) {?>
                                            
                                             <tr>
                                             <td data-title="Coupon Code"><?php echo $i;?></td>
                                             <td data-title="Coupon ID"><?php echo $t->cp_code;?></td>
											 
											 
											 
                                        
                                             <td data-title="Amount" ><?php echo $t->amount;?></td>
                                             <td data-title="Generation Date" > <?php echo $t->cp_gen_date;?></td>
                                             <td data-title="Validity Date" > <?php echo $t->validity;?></td>
                                             <td><a href="showcoupon/<?php echo $t->id ?>" style="text-decoration:none;">show</a></td>
                                          
                                           
											</tr>
											<?php $i++;}//}?>
             
									</tbody>
									</table>
  
</div>

</div>

                       
                        
                        
                        
                        
                       
                    </div>
                   
                   
                </div>
            </div>
          
        
            <!--END CONTENT--><!--BEGIN FOOTER-->
          <?php 


$this->load->view('footer');

?>
            </div>
           

</body>
</html>