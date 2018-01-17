<?php 
//print_r($schoolinfo);

$this->load->view('stud_header',$studentinfo);

?>

<!DOCTYPE html>
<html lang="en">
<head>

</head>

<title>Purchase Water Points </title>
    

<body>

    <!--END THEME SETTING-->

   
        <!--END SIDEBAR MENU--><!--BEGIN CHAT FORM-->
   
     <div id="area-chart-spline" style="width: 100%; height:300px; display:none;"></div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
          
          
           
             <div id="page-wrapper"><!--BEGIN TITLE & BREADCRUMB PAGE-->
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Purchase Water Points</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="members">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li><a href="#">Points</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Purchase Water Points </li>
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
                                            <div class="panel-heading">Purchase Water Points </div>
                                            <div class="panel-body pan">
                                           
                                              <?php 
echo form_open("main/waterpoints","class=form-horizontal");?>
                                                           
                                                           
                                                        </div>
                                                  

                                                       
                                                     
                                                        <div class="row" style="margin-top:2%;">
                                                        
                                                         <div class="col-md-8">
                                                                <div class="form-group"><label for="inputPhone" class="col-md-4 control-label">Balance Water Points</label>

                                                                    <div class="col-md-5"><p class="form-control-static"><?php echo $studentinfo[0]->balance_water_points?></p></div>
                                                                </div>
                                                            </div>
                                                            
                                                           
                                                        </div>
                                                        
                                                        
                                                     
                                                     
                                                      <div class="row" style="margin-top:2%;">
                                                     
                                                      <div class="col-md-8">
                                                                <div class="form-group"><label for="inputPhone" class="col-md-4 control-label"> Card No</label>

                                                                    <div class="col-md-6"><input id="card_no" name="card_no" type="text" placeholder="Enter Card No" class="form-control" valiue="<?php echo $this->input->post('card_no')?>"><?php echo form_error('card_no', '<div class="error">', '</div>'); ?></div>
                                                            <?php 
													echo form_submit('search', 'Search','class="btn btn-green"');
													
echo form_close();
	
													?>        
                                                                    
                                                                    
                                                                </div>
                                                            </div>
                                                            
                                                             
                                                            
                                                            
                                                            </div>
                                                            
                                                            
                                                            <?php if(isset($cardinfo))
															{
																
																  
echo form_open("main/student_purchase_points/".$cardinfo[0]->card_no,"class=form-horizontal");?>


 <div class="form-body pal" >
											
                                            
                                             <div class="row" style="margin-top:2%;">
                                                     
                                                      <div class="col-md-8">
                                                                <div class="form-group"><label for="inputPhone" class="col-md-4 "> Card Number</label>

                                                                    <div class="col-md-3"><p class="form-control-static"><?php echo $cardinfo[0]->card_no;?></p></div>
                                                                    
                                                                    
                                                                </div>
                                                            </div>
                                                            </div>
                                                            					
                                                                
                                                                
                                                            
                                                             <div class="row" style="margin-top:2%;">
                                                     
                                                      <div class="col-md-8">
                                                                <div class="form-group"><label for="inputPhone" class="col-md-4 "> Card Points</label>

                                                                    <div class="col-md-3"><p class="form-control-static"><?php echo $cardinfo[0]->amount;?></p></div>
                                                                    
                                                                    
                                                                </div>
                                                            </div>
                                                       
                                                         <div class="row" style="margin-top:2%;">
                                                     
                                                      <div class="col-md-8">
                                                                <div class="form-group"><label for="inputPhone" class="col-md-4 "> Validity Date</label>

                                                                    <div class="col-md-6"><p class="form-control-static"><?php echo ucwords(strtolower($cardinfo[0]->valid_to))?></p></div>
                                                                    
                                                                    
                                                                </div>
                                                            </div>
                                                            
                                                             
                                                            
                                                            
                                                            </div>
                                                            
                                                            
                                                             <div class="form-actions text-right pal" style="background-color:#FFF;">
                                                    <div class="error" align="center">
                                                    <?php if(isset($report))
													{
														
													echo $report;	
													}?></div>
                                                    <?php 
													echo form_submit('submit', 'Purchase','class="btn btn-green"');
													?>
                                                    
                                                    
                                                      
                                                        &nbsp;
                                                         <a href="<?php echo site_url();?>/main/waterpoints"><button type="button" class="btn btn-primary">Cancel</button></a>
                                                    </div> 
                                                   
                                                        
                                                      
                                                 
                                               <?php }

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