<?php 
$this->load->view('stud_header',$studentinfo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
</head><title>Share Points</title>
<body>   <!--END THEME SETTING-->  <!--END SIDEBAR MENU--><!--BEGIN CHAT FORM--> <div id="area-chart-spline" style="width: 100%; height:300px; display:none;"></div>     <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
             <div id="page-wrapper"><!--BEGIN TITLE & BREADCRUMB PAGE-->
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Share Points</div>
                </div>				<ol class="breadcrumb page-breadcrumb pull-right">				<li><i class="fa fa-home"></i>&nbsp;<a href="members">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li><a href="#">ThanQ Points</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Share Points  </li>
                </ol>
                <div class="clearfix"></div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
        <div class="page-content">
        <div id="form-layouts" class="row">
                    <div class="col-lg-12">
         <div id="tab-two-columns-readonly" >          <div class="row">
                                    <div class="col-lg-12">									<div class="panel panel-yellow">										<div class="panel-heading"><?php
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
echo form_open("main/share_points/".$studinfo[0]->std_PRN,"class=form-horizontal");?>
                                                 <div class="row" align="center" style="margin-top:2%;">
                                                 <?php if ($studinfo[0]->std_img_path==""){ ?> <img src="<?php echo base_url()?>images/avtar.png"  alt="" class="img-circle" style="height:80px;width:80px;"/><?php  } else {?><img src="<?php echo base_url()?>/core/<?php echo $studinfo[0]->std_img_path?>"  alt="" class="img-circle" style="height:80px;width:80px;border: 5px solid #eee;"/> <?php };?>												</div>												<div class="form-body pal" style="margin-top:-2%;"><h3>Personal</h3>													<div class="row">													<div class="col-md-6">
                                                                <div class="form-group"><label for="inputFirstName" class="col-md-3 control-label"> Name:</label>
                                                                    <div class="col-md-9"><p class="form-control-static"><?php
											if($studinfo[0]->std_complete_name!='')
											{										echo ucwords( strtolower($studinfo[0]->std_complete_name));
											}
											 else
											 {
											  echo ucwords(strtolower( $studinfo[0]->std_name." ".$studinfo[0]->std_Father_name." ".$studinfo[0]->std_lastname	));
											  }
											 ?></p></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">															<div class="form-group"><label for="inputLastName" class="col-md-3 control-label">Email:</label>
                                                                    <div class="col-md-9"><p class="form-control-static"><?php echo $studinfo[0]->std_email?></p></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                         <div class="col-md-6">														<div class="form-group"><label for="inputPhone" class="col-md-3 control-label">Phone</label>
                                                                    <div class="col-md-9"><p class="form-control-static"><?php echo $studinfo[0]->std_phone?></p></div>
                                                                </div>
                                                            </div>
                                                             <div class="col-md-6">
                                                                <div class="form-group"><label for="inputPhone" class="col-md-4 control-label">Friendship Points:</label>
                                                                    <div class="col-md-8"><p class="form-control-static"><?php  if(isset($studentpointsinfo[0]->yellow_points)!=''){ echo $studentpointsinfo[0]->yellow_points;}else
																	{
																		echo 0;
																	}
																	?></p></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                              <div class="row">
                                                         <div class="col-md-6">
                                                                <div class="form-group"><label for="thanq_reason" class="col-md-3 control-label"> Reason</label>
                                              <div class="col-md-9">									 <!--<input id="reason" name="reason" type="text" placeholder="Reason" class="form-control">-->									 <select name="select_reson" id="select_reson" class="form-control">								<option value="">Select Reason</option>								<?php //var_dump($getallreason);?>								                                    <?php foreach ($getallreason as $value) {                                        ?>                                        <option value="<?php echo $value->student_recognition ?>"><?php echo $value->student_recognition; ?> </option>                                    <?php } ?>                                </select>											 											  <?php echo form_error('reason', '<div class="error">', '</div>'); ?>											  </div>
                                                                </div>
																 <div class="form-group"><label for="thanq_reason" class="col-md-3 control-label"> Select Point</label>
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
      </select><?php echo form_error('select_opt', '<div class="error">', '</div>'); ?>
						</div>
                                                            </div>
                                                        </div>
                                                      <div class="row">
                                                      <div class="col-md-6">
                                                                <div class="form-group"><label for="inputPhone" class="col-md-3 control-label"> Points</label>
                                                                    <div class="col-md-9"><input id="points" name="points" type="text" placeholder="Share Points" class="form-control"><?php echo form_error('points', '<div class="error">', '</div>'); ?></div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                    </div>
                                                    <div class="form-actions text-center pal" style="background-color:#FFF;">
                                                    <div class="error" align="left">
                                                    <?php if(isset($report))
													{?>
													<font color="green"><?php echo $report;?></font>
													<?php	
													}?></div>
                                                    <?php 
													echo form_submit('share', 'Share','class="btn btn-green"');
													?>
                                                        &nbsp;
                                                         <a href="<?php echo site_url();?>/main/show_student"><button type="button" class="btn btn-danger">Cancel</button></a>
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
           
            </div>
</body>
</html>