<?php 
//print_r($schoolinfo);

$this->load->view('stud_header',$studentinfo);

?>

<!DOCTYPE html>
<html lang="en">
<head>
       
</head>

<title>Self Motiation</title>
    

<body>

    <!--END THEME SETTING-->

   
        <!--END SIDEBAR MENU--><!--BEGIN CHAT FORM-->
   
     <div id="area-chart-spline" style="width: 100%; height:300px; display:none;"></div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
      
           
             <div id="page-wrapper"><!--BEGIN TITLE & BREADCRUMB PAGE-->
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Self Motivation Points </div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="members">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li><a href="#">Points</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Self Motivation Points</li>
                </ol>
                <div class="clearfix"></div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
            <div class="page-content">
                
                 <?php 
echo form_open("main/social_media_points");?>
                
                
                  <div class="row">
                    <div class="col-lg-12">
                        <div id="generalTabContent" class="tab-content responsive" >
                 <div id="note-tab" >
                
                <?php 
				 $i=0;
			
				 foreach($social_media as $t)
				 
				
				{ if(($i%4)==0)			{	?>
                
                
                                 <div class="row">
                              
                                    <div class="col-lg-3">
                                   
                                        <div class="note note-success" style="background-color:#BFBFBF; border-color:#BFBFBF;" ><h4 class="box-heading" style="color:#000;"><?php echo $t->media_name;?></h4>

                                            <p><img src="<?php echo base_url().'/core/'.$t->media_logo;?>" style="width:64px;height:69px;"> 
                                         <?php   $med_name=substr($t->media_name, 0,2);
										 if(isset($studentpointsinfo[0]->online_flag))
										 {
										 $flag= $studentpointsinfo[0]->online_flag;
										 $pos2 = strpos($flag,$med_name);
										 }else{
											 
										 }
										 
										 
										 if($pos2 !== false){
										 ?>
                                            
                                            <input type="checkbox" name="online_presence[]" style="border-color:#000;" checked="checked" disabled>
                                       
                                       <?php }
									   else
									   {?>
										  <input type="checkbox" name="online_presence[]" style="border-color:#000;" value="<?php echo $t->media_name;?>">   
										   
									   <?php }
									   ?>
                                     </p> 
                                    </div>
                                  </div>
                                 
                                     <?php } else
									 {?>  
                                  
                             
                             
                                    <div class="col-lg-3">
                                   
                                        <div class="note note-success" style="background-color:#BFBFBF; border-color:#BFBFBF;"><h4 class="box-heading" style="color:#000;"><?php echo $t->media_name;?></h4>

                                            <p><img src="<?php echo base_url().'/core/'.$t->media_logo;?>" style="width:64px;height:69px;"> 
                                            
                                            
                                            
                                         <?php   $med_name=substr($t->media_name, 0,2);
										 
										 $flag= $studentpointsinfo[0]->online_flag;
										 $pos2 = strpos($flag,$med_name);
										 
										 if($pos2 !== false){
										 ?>
                                            
                                            <input type="checkbox" name="online_presence[]" style="border-color:#000;" checked="checked" disabled>
                                       
                                       <?php }
									   else
									   {?>
										  <input type="checkbox" name="online_presence[]" style="border-color:#000;" value="<?php echo $t->media_name;?>">   
										   
									   <?php }
									   ?>
                                            
                                             </p>
                                             </div>
                                       
                                  
                                       </div>
                                   
                                 
                                <?php }
                               
                               if(($i%4)==3)			{	?>
                               
                               </div>
                               
                               <?php }?>
                          
                              <?php $i++; }?>
                                </div>
                                
                                
                                <div class="row" align="center"> <?php 
													echo form_submit('done', 'Done','class="btn btn-green"');
													?></div>
                          
                     
                                
                                   <!--END generalTabContent-->
                       <div class="error" align="center" style="margin-top:3%;">
                       <?php						 if(isset($report))
													{?>
													<font color="green"><?php echo $report;?></font>	
														
													<?php }
													
												 if(isset($report1))
													{?>
														<font color="red"><?php echo $report1;?></font>
													<?php }
														?>
						 
						 </div>
						
                            
             
              </div>
              </div>
            </div>
                 <?php

echo form_close();
	?>
            <!--END CONTENT--><!--BEGIN FOOTER-->
            
           
        <!--END PAGE WRAPPER-->
           
           
           
                   
                  <?php 


$this->load->view('footer');

?>
 
                </div>
            <!--END CONTENT--><!--BEGIN FOOTER-->
         
            
            
         
</body>
</html>