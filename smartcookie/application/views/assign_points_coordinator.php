<?php 
//print_r($schoolinfo);

$this->load->view('stud_header',$studentinfo);
$school_id=$studentinfo[0]->school_id;

?>

<!DOCTYPE html>
<html lang="en">
<head>

</head>

<script type="text/javascript">
  var school_id = <?php echo json_encode($school_id); ?>;  
function studentactivityalert()  
    {  

	   var activity = document.getElementById("activity").value;
	if(activity=='select')
  {
document.getElementById('catList').innerHTML='';
  document.getElementById('ciudad').innerHTML='';
   document.getElementById('errorreport').innerHTML='Select one activity type';
  
 
  }
  
  if(activity=='activity')
  {
document.getElementById('catList').innerHTML='<div class="row"> <div class="col-md-6"><div class="form-group"><label for="inputPhone" class="col-md-3 control-label">Activity Type</label><div class="col-md-7"><select name="activity_type" id="activity_type" class="form-control"  onChange="getactivity(this.value)" ><?php $i=0; foreach($activity_type as $t){?>  <option value="<?php echo $t->id;?>"><?php echo $t->activity_type;?></option><?php $i++;}?></div></div></div></div>';
 document.getElementById('errorreport').innerHTML='';
  }
  if(activity=='subject')
  {
	     document.getElementById('ciudad').innerHTML='';
  document.getElementById('catList').innerHTML='<div class="row"> <div class="col-md-6"><div class="form-group"><label for="inputPhone" class="col-md-3 control-label">Activity Type</label><div class="col-md-7"><select name="activity_type" id="activity_type" class="form-control"   ><?php $i=0; foreach($subject_list as $t){?>  <option value="<?php echo $t->subjcet_code;?>"><?php echo $t->subjectName	;?></option><?php $i++;}?></div></div></div></div>';

 document.getElementById('errorreport').innerHTML='';
 
 
  }
 

	  
    
    }    
	
	
	function getactivity(value)
	{
		
	 
     
     $.ajax({
         type: "POST",
		 url: '<?php echo base_url(); ?>main/getactivity',
        
         data: {
			 activity_type : value, 
		 school_id : school_id
		 },
       
         cache:false,
        success: function(data) {
			if(data!='' || data!=NULL)
			{
                        $('#ciudad').html(data);
			}
                    }
					
          });// you have missed this bracket
     


	}
</script>

<title>Assign points </title>
    

<body>

    <!--END THEME SETTING-->

   
        <!--END SIDEBAR MENU--><!--BEGIN CHAT FORM-->
   
     <div id="area-chart-spline" style="width: 100%; height:300px; display:none;"></div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
          
          
           
             <div id="page-wrapper"><!--BEGIN TITLE & BREADCRUMB PAGE-->
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Assign points on behalf of <?php echo $coordinator_info[0]->t_complete_name ;?></div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="members">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li><a href="#">Points</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Assign Points  </li>
                </ol>
                <div class="clearfix"></div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
        <div class="page-content">
        <div id="form-layouts" class="row">
                    <div class="col-lg-12">
         <div id="tab-two-columns-readonly" >
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="panel panel-yellow">
                                            <div class="panel-heading"><?php
											if($studinfo[0]->std_complete_name!='')
											{
											 echo ucwords( strtolower($studinfo[0]->std_complete_name));
											}
											 else
											 {
											  echo ucwords(strtolower( $studinfo[0]->std_name." ".$studinfo[0]->std_Father_name." ".$studinfo[0]->std_lastname	));
											  }
											 ?></div>
                                            <div class="panel-body pan">
                                           
                                              <?php 
echo form_open("main/assign_points/".$studinfo[0]->std_PRN,"class=form-horizontal");?>
                                                 <div class="row" align="center" style="margin-top:2%;">
                                                 <?php if ($studinfo[0]->std_img_path==""){ ?> <img src="<?php echo base_url()?>images/avtar.png"  alt="" class="img-circle" style="height:80px;width:80px;"/><?php  } else {?><img src="<?php echo base_url()?>/core/<?php echo $studinfo[0]->std_img_path?>"  alt="" class="img-circle" style="height:80px;width:80px;border: 5px solid #eee;"/> <?php };?>
                                                           
                                                           
                                                        </div>
                                                    <div class="form-body pal" style="margin-top:-2%;"><h3>Personal</h3>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group"><label for="inputFirstName" class="col-md-3 control-label"> Name:</label>

                                                                    <div class="col-md-9"><p class="form-control-static"><?php
											if($studinfo[0]->std_complete_name!='')
											{
											 echo ucwords( strtolower($studinfo[0]->std_complete_name));
											}
											 else
											 {
											  echo ucwords(strtolower( $studinfo[0]->std_name." ".$studinfo[0]->std_Father_name." ".$studinfo[0]->std_lastname	));
											  }
											 ?></p></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group"><label for="inputLastName" class="col-md-3 control-label">Email:</label>

                                                                    <div class="col-md-9"><p class="form-control-static"><?php echo $studinfo[0]->std_email?></p></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                     
                                                        <div class="row">
                                                        
                                                         <div class="col-md-6">
                                                                <div class="form-group"><label for="inputPhone" class="col-md-3 control-label">Phone</label>

                                                                    <div class="col-md-9"><p class="form-control-static"><?php echo $studinfo[0]->std_phone?></p></div>
                                                                </div>
                                                            </div>
                                                            
                                                             <div class="col-md-6">
                                                                <div class="form-group"><label for="inputPhone" class="col-md-4 control-label">Rewards:</label>

                                                                    <div class="col-md-8"><p class="form-control-static"><?php  if(isset($studentpointsinfo[0]->sc_total_point)!=''){ echo $studentpointsinfo[0]->sc_total_point;}else
																	{
																		echo 0;
																	}
																	?></p></div>
                                                                </div>
                                                            </div>
                                                          
                                                        </div>
                                                        
														<div class="row">
                                                        
                                                         <div class="col-md-6">
                                                                <div class="form-group"><label for="thanq_reason" class="col-md-3 control-label">Activity/Subject</label>
                                                                
                                                            
                                                                    <div class="col-md-7">
                                                                
                                                                 <select name="activity" id="activity" class="form-control" onChange="studentactivityalert()"> 
                                                                 <option value="select">Select</option>

                                                                 <option value="activity" >Activity</option>
                                                                    <option value="subject">Subject</option>
                                                                 </select>
                                                                    
                                                                    
                                                                    </div>
                                                     
                                                        </div>
														</div>
														</div>
														
														
														
														 <div id="catList"></div>
                                                        
                                                              <div class="row">
                                                        
                                                         <div class="col-md-6">
                                                                <div class="form-group"><label for="thanq_reason" class="col-md-3 control-label"></label>
                                                                
                                                            
                                                                    <div class="col-md-7" id="ciudad">
                                                                
                                                                
                                                                    
                                                                    
                                                                    </div>
                                                     
                                                        </div>
														</div>
														</div>
														
														    <div class="row">
                                                        
                                                         <div class="col-md-6" style="display:none;">
                                                                <div class="form-group"><label for="thanq_reason" class="col-md-3 control-label">Activity</label>
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-5">
                                                                
                                                                
                                                                    <input id="points" name="points" type="text" placeholder="Activity" class="form-control">
                                                                    
                                                                    </div>
                                                                    
                                                                     
                                                                    
                                                                    </div>
                                                                    
                                                                   
                                                            
                                                            
                                                          
                                                        </div>
														</div>
														</div>
                                                     
                                                     
                                                      <div class="row">
                                                     
                                                      <div class="col-md-6">
                                                                <div class="form-group"><label for="inputPhone" class="col-md-3 control-label"> Points</label>

                                                                    <div class="col-md-9"><input id="points" name="points" type="text" placeholder=" Points" class="form-control"><?php echo form_error('points', '<div class="error">', '</div>'); ?></div>
                                                                </div>
                                                            </div>
                                                            
                                                             
                                                            
                                                            
                                                            </div>
                                                        
                                                      
                                                    </div>
                                                    <div class="form-actions text-center pal" style="background-color:#FFF;">
                                                    <div class="error" align="left">
                                                    <?php if(isset($report))
													{
														
													?> <font color="green"><?php echo $report;?></font>
													<?php }
													else if(isset($report1))
													{ ?>
														<font color="red"><?php echo $report1;?></font>
													<?php }
													?>
													
													
													</div>
                                                    <?php 
													echo form_submit('assign', 'Assign','class="btn btn-green"');
													?>
                                                    
                                                    
                                                      
                                                        &nbsp;
                                                         <a href="<?php echo site_url();?>/main/show_studlist"><button type="button" class="btn btn-primary">Cancel</button></a>
                                                    </div>
                                               <?php

echo form_close();
	?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                </div>
                </div>
               </div>
            <!--END CONTENT--><!--BEGIN FOOTER-->
            
           
        <!--END PAGE WRAPPER-->
           
           
           
                   
                  <?php 


$this->load->view('footer');

?>
 
                
            <!--END CONTENT--><!--BEGIN FOOTER-->
         
            </div>
            
         
</body>
</html>