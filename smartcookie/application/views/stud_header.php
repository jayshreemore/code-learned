<!DOCTYPE html>
<html lang="en">
<head><title>SmartCookie</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Loading bootstrap css-->
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>Assets/vendors/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>Assets/vendors/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>Assets/vendors/bootstrap/css/bootstrap.min.css">
    <!--LOADING STYLESHEET FOR PAGE-->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>Assets/vendors/intro.js/introjs.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>Assets/vendors/calendar/zabuto_calendar.min.css">
    <!--Loading style vendors-->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>Assets/vendors/animate.css/animate.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>Assets/vendors/jquery-pace/pace.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>Assets/vendors/iCheck/skins/all.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>Assets/vendors/jquery-news-ticker/jquery.news-ticker.css">
    <!--Loading style-->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>Assets/css/themes/style3/green-grey.css" id="theme-change" class="style-change color-change">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>Assets/css/style-responsive.css">
	 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Assets/css/jquery.dataTables.css">
	 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Assets/css/coupon_style.css">
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>Assets/vendors/bootstrap/css/bootstrap.css">
</head>
<style>
.error
{
	color:red;
}

#sofrreward {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
}

.sofrreward {
    float: left;
}
</style>

<body>
	
	<script src="<?php echo base_url(); ?>Assets/js/jquery-1.11.1.min.js"></script>	
	<script src="<?php echo base_url(); ?>Assets/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>Assets/vendors/bootstrap/js/bootstrap.min.js"></script>
<div id="area-chart-spline" style="width: 100%; height:300px; display:none;"></div>
<div>
	<!--BEGIN BACK TO TOP--><a id="totop" href="#"><i class="fa fa-angle-up"></i></a><!--END BACK TO TOP-->
	<!--BEGIN TOPBAR-->
    <div id="header-topbar-option-demo" class="page-header-topbar">
        <nav id="topbar" role="navigation" style="margin-bottom: 0;" data-step="3" data-intro="&lt;b&gt;Topbar&lt;/b&gt; has other styles with live demo. Go to &lt;b&gt;Layouts-&gt;Header&amp;Topbar&lt;/b&gt; and check it out." class="navbar navbar-default navbar-static-top">
            <div class="navbar-header">
                <button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                <a id="logo" href="<?php echo base_url(); ?>" class="navbar-brand"><span class="fa fa-rocket"></span><span class="logo-text">SmartCookie</span></a></div>
            <div class="topbar-main"><a id="menu-toggle" href="#" class="hidden-xs"><i class="fa fa-bars"></i></a>
             
                <ul class="nav navbar navbar-top-links navbar-right mbn">
                
                    <li class="dropdown topbar-user">
					
					<?php if($studentinfo[0]->std_img_path=="")
					{
					
							 $this->load->helper('imageurl'); ?>
                            <a data-hover="dropdown" href="#" class="dropdown-toggle">	
								<img src="<?php echo imageurl($studentinfo[0]->std_img_path,'avatar','sp_profile');?>" alt="" class="img-responsive img-circle" />
								
					<?php	
					}
					else
					{
						?>		<a data-hover="dropdown" href="#" class="dropdown-toggle">
								<img src="<?php echo base_url().'core/'?><?php echo $studentinfo[0]->std_img_path?>" alt="" class="img-responsive img-circle" /> 
				    <?php
					}
					?>
					
				
                                        
				
                                <span class="hidden-xs"><?php  if($studentinfo[0]->std_complete_name!="")
											{
												
												echo ucwords(strtolower($studentinfo[0]->std_complete_name));
											}
											else
											{
											echo ucwords(strtolower( $studentinfo[0]->std_name." ".$studentinfo[0]->std_Father_name." ".$studentinfo[0]->std_lastname	));	
											} ?></span>&nbsp;<span class="caret"></span>
                            </a>
                        <ul class="dropdown-menu dropdown-user pull-right">
						
                           <li><a href="<?php echo base_url();?>/main/update_profile"><i class="fa fa-user"></i>My Profile</a></li>
    
<li><a href="<?php echo base_url();?>/main/id_card"><i class="fa fa-key"></i>My ID Card</a></li>                           

						   <li><a href="<?php echo base_url();?>/main/logout"><i class="fa fa-key"></i>Log Out</a></li>
                        </ul>
                    </li>
                    

                </ul>
            </div>
        </nav>
       
    <div id="wrapper"><!--BEGIN SIDEBAR MENU-->
        <nav id="sidebar" role="navigation" data-step="2" data-intro="Template has &lt;b&gt;many navigation styles&lt;/b&gt;" data-position="right" class="navbar-default navbar-static-side">
            <div class="sidebar-collapse menu-scroll">
                <ul id="side-menu" class="nav">
				
				
                    <li class="user-panel">
                        <div class="thumb">
<?php if($studentinfo[0]->std_img_path=="")
					{?>
	<img src="<?php echo imageurl($studentinfo[0]->std_img_path,'avatar','sp_profile');?>"  alt="" class="img-circle"/>
					<?php 
					}
					else{
						?><img src="<?php echo base_url().'core/'?><?php echo $studentinfo[0]->std_img_path?>"  alt="" class="img-circle" >
						<?php
					}
					?></div>
                    <!--<div style="width:30px;height:50px;">-->
                 
					
                                        
						
                        <div class="info">
                            <p><?php 
                                            if($studentinfo[0]->std_complete_name!="")
											{
												
												echo ucwords(strtolower($studentinfo[0]->std_complete_name));
											}
											else
											{
											echo ucwords(strtolower( $studentinfo[0]->std_name." ".$studentinfo[0]->std_Father_name." ".$studentinfo[0]->std_lastname	));	
											}
											?>
											<br>
											<?php
											
											 if($studentinfo[0]->status=='Y')
											 {
												echo "(".ucfirst($this->session->userdata('usertype'))." Coordinator)"; 
											 }else
											 {
												 echo "(".ucfirst($this->session->userdata('usertype')).")"; 
												 
											 }?></p>
							<ul class="list-inline list-unstyled">
                                <li><a href="<?php echo base_url();?>/main/update_profile" data-hover="tooltip" title="Profile"><i class="fa fa-user"></i></a></li>
                               
                                <li><a href="<?php echo base_url();?>/main/logout" data-hover="tooltip" title="Logout"><i class="fa fa-sign-out"></i></a></li>
                            </ul>				
											
							
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <li>
                    
                     <div>
                  <ol id="sofrreward">
					<?php 
					 
					$studentzerokey = $studentinfo[0];
					unset($studentinfo[0]);
                   // $studentimage = array_shift($studentinfo);   
					//
					
					
					
					
				/*	if($studentinfo[1]!='')
					{
						
						/*if($studentinfo[0]->imagepath='')
						{
							
								?>
								<li class="sofrreward">
								<img src="<?php echo base_url()."core/images/200_76.png"; ?>" name="star" height="20" width="20" class="img-responsive" >
                     
								</li>
							
								<?php
							
						}*/
					/*	foreach($studentinfo as $r)
						{*/
                      
							?>
							<!--<li class="sofrreward">
							<img src="<?php //echo base_url()."core/".$r->imagepath; ?>" name="star" height="20" width="20" class="img-responsive" >
                     
							</li>-->
							<?php 
					//	}
						
					//	}
						
						
						
						?>
                     
                     
					
					<?php
                    
					array_unshift($studentinfo,$studentzerokey);
					
					?>
                    </ol>
					</div>
                    
                    </li>

                  
					
		                    <li <?php
					
					
					if(strpos(uri_string(), 'main/members') !== FALSE or strpos(uri_string(),'main/friendship_log' ) !== FALSE or strpos(uri_string(),'main/showcoupon' ) !== FALSE ){ echo 'class="active"'; }; ?> ><a href="<?php echo site_url();?>/main/members"><i class="fa fa-tachometer fa-fw">
                        <div class="icon-bg bg-orange"></div>
                    </i><span class="menu-title">Dashboard</span></a></li>
                     
                     
                        <li <?php if(uri_string()=='main/rewards_log' or uri_string()=='main/usedcoupon_log' or uri_string()=='main/accepted_requests_log' or uri_string()=='main/send_requests_log'  or uri_string()=='main/assign_coordpointslog' or uri_string()=='main/self_motivation_log' or uri_string()=='main/thanQ_log' or uri_string()=='main/shared_log' or uri_string()=='main/purple_points_log' ){
							echo 'class="active"'; 
						} ?>><a href="#"><i class="fa fa-th-list fa-fw">
                       
                  
                    </i><span class="menu-title">Logs</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            





<li <?php
							
						
							 if(uri_string()=='main/softreward_log' ){ 
											echo 'class="active"'; } ?>><a href="<?php echo site_url();?>/main/softreward_log"><i class="fa fa-briefcase"></i><span class="submenu-title">Soft Reward Log</span></a></li>
                                            
                                            <li <?php
							
						
							 if(uri_string()=='main/rewards_log' ){ 
											echo 'class="active"'; } ?>><a href="<?php echo site_url();?>/main/rewards_log"><i class="fa fa-briefcase"></i><span class="submenu-title">Reward Points</span></a></li>





                            <li <?php
							
						
							 if(uri_string()=='main/usedcoupon_log' ){ 
											echo 'class="active"'; } ?>><a href="<?php echo site_url();?>/main/usedcoupon_log"><i class="fa fa-th-large"></i><span class="submenu-title">Used Coupons Log</span></a></li>
                            <li <?php
							
						
							 if(uri_string()=='main/self_motivation_log'){ 
											echo 'class="active"'; } ?>><a href="<?php echo site_url();?>/main/self_motivation_log"><i class="fa fa-hand-o-up"></i><span class="submenu-title">Self Motivation Log</span></a></li>
                                            <li <?php
							
						
							 if(uri_string()=='main/thanQ_log'){ 
											echo 'class="active"'; } ?>><a href="<?php echo site_url();?>/main/thanQ_log"><i class="fa fa-hand-o-up"></i><span class="submenu-title">ThanQ Points Log</span></a></li>
                                            
                                            
                                            <li <?php
							
						
							 if(uri_string()=='main/shared_log'){ 
											echo 'class="active"'; } ?>><a href="<?php echo site_url();?>/main/shared_log"><i class="fa fa-hand-o-up"></i><span class="submenu-title">Shared Points Log</span></a></li>
                         
						<li <?php if(uri_string()=='main/purple_points_log'){ 
											echo 'class="active"'; } ?>><a href="<?php echo site_url();?>/main/purple_points_log"><i class="fa fa-hand-o-up"></i><span class="submenu-title">Purple Points Log</span></a></li>
                        
<?php 
						 if($studentinfo[0]->status=='Y')
						 {?>
					 
					 <li <?php
					
							if(strpos(uri_string(), 'main/assign_coordpointslog') !== FALSE )
						
							{ 
											echo 'class="active"'; } ?> ><a href="<?php echo site_url();?>/main/assign_coordpointslog"><i class="fa fa-hand-o-up"></i><span class="submenu-title">Assigned points Log</span></a></li>
							 
					 
					 
						 <?php }?>
						 
						 
						 <li <?php if(uri_string()=='main/accepted_requests_log'){ 
											echo 'class="active"'; } ?>><a href="<?php echo site_url();?>/main/accepted_requests_log"><i class="fa fa-hand-o-up"></i><span class="submenu-title">Accepted Requests Points Log</span></a></li>
 <li <?php if(uri_string()=='main/send_requests_log'){ 
											echo 'class="active"'; } ?>><a href="<?php echo site_url();?>/main/send_requests_log"><i class="fa fa-hand-o-up"></i><span class="submenu-title">Send Requests Points Log</span></a></li>

						
                        </ul>
                    </li>
                     
                      <li <?php
							
						
							 if(uri_string()=='main/unused_coupons' or uri_string()=='main/partiallyused_coupons' ){ 
											echo 'class="active"'; } ?>><a href="#"><i class="fa fa-file-o fa-fw">
                       
                  
                    </i><span class="menu-title">Smartcookie Coupons</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li <?php
							
						
							 if(uri_string()=='main/unused_coupons' ){ 
											echo 'class="active"'; } ?>><a href="<?php echo site_url();?>/main/unused_coupons"><i class="fa fa-briefcase"></i><span class="submenu-title">Unused Smartcookie Coupons</span></a></li>
                            <li <?php
							
						
							 if( uri_string()=='main/partiallyused_coupons' ){ 
											echo 'class="active"'; } ?> ><a href="<?php echo site_url();?>/main/partiallyused_coupons"><i class="fa fa-th-large"></i><span class="submenu-title">Partial Used  Coupons </span></a></li>
                          
                          
                                                   
                        </ul>
                    </li>
                 
                     <li <?php
					
							if(strpos(uri_string(), 'main/assignThanQpoints') !== FALSE or strpos(uri_string(), 'main/purchase_softrewards') !== FALSE or strpos(uri_string(), 'main/assign_points') !== FALSE or strpos(uri_string(), 'main/Thanq_Assignpoints') !== FALSE or strpos(uri_string(), 'main/show_student') !== FALSE or strpos(uri_string(), 'main/share_points') !== FALSE or strpos(uri_string(), 'main/waterpoints') !== FALSE or strpos(uri_string(), 'main/show_studlist') !== FALSE  or strpos(uri_string(), 'main/waterpoints') !== FALSE or strpos(uri_string(), 'main/student_purchase_points') !== FALSE or strpos(uri_string(), 'main/social_media_points') !== FALSE )
						
							{ 
											echo 'class="active"'; } ?>><a href="#"><i class="fa fa-suitcase">
                       
                  
                    </i><span class="menu-title">Points</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
						 <?php 
						 if($studentinfo[0]->status=='Y')
						 {?>
							 
							 <li <?php
					
							if(strpos(uri_string(), 'main/show_studlist') !== FALSE or strpos(uri_string(), 'main/assign_points') !== FALSE )
						
							{ 
											echo 'class="active"'; } ?> ><a href="<?php echo site_url();?>/main/show_studlist"><i class="fa fa-briefcase"></i><span class="submenu-title">Assign Points on behalf of <?php echo ($this->session->userdata('usertype')=='employee')?'Manager':'Teacher'; ?></span></a></li>
						
						 <?php }	 
						 				 
						 ?>
                            <li <?php
					
							if(strpos(uri_string(), 'main/studentlist') !== FALSE or strpos(uri_string(), 'main/show_student') !== FALSE or strpos(uri_string(), 'main/share_points') !== FALSE )
						
							{ 
											echo 'class="active"'; } ?> ><a href="<?php echo site_url();?>/main/show_student"><i class="fa fa-briefcase"></i><span class="submenu-title">Share Points</span></a></li>
                            <li   <?php
							
					
							 if(strpos(uri_string(), 'main/assignThanQpoints') !== FALSE or strpos(uri_string(), 'main/Thanq_Assignpoints') !== FALSE ){ 
											echo 'class="active"'; } ?>><a href="<?php echo site_url();?>/main/assignThanQpoints"><i class="fa fa-th-large"></i><span class="submenu-title">ThanQ Points </span></a></li>
                           <li <?php
					
							if(strpos(uri_string(), 'main/student_purchase_points') !== FALSE  or strpos(uri_string(), 'main/waterpoints') !== FALSE )
						
							{ 
											echo 'class="active"'; } ?> ><a href="<?php echo site_url();?>/main/waterpoints"><i class="fa fa-th-large"></i><span class="submenu-title">Purchase Points </span></a></li>
                           <li  <?php
					
							if(strpos(uri_string(), 'main/social_media_points') !== FALSE  )
						
							{ 
											echo 'class="active"'; } ?>><a href="<?php echo site_url();?>/main/social_media_points"><i class="fa fa-th-large"></i><span class="submenu-title">Self Motivation</span></a></li> 


 <li <?php
					
							if(strpos(uri_string(), 'main/purchase_softrewards') !== FALSE  )
						
							{ 
											echo 'class="active"'; } ?> ><a href="<?php echo site_url();?>/main/purchase_softrewards"><i class="fa fa-th-large"></i><span class="submenu-title">Soft Rewards</span></a></li>
                                                   
          											
                        </ul>
                    </li>
                     
                     <li <?php
					
							if(strpos(uri_string(), 'main/student_requestlist') !== FALSE  or strpos(uri_string(), 'main/pending_request_student') !== FALSE or strpos(uri_string(), 'main/showstudent_for_request') !== FALSE or strpos(uri_string(), 'main/teacherlist_coordinator') !== FALSE or strpos(uri_string(), 'main/send_reuest_to_student') !== FALSE or strpos(uri_string(), 'main/teacherlist_request') !== FALSE or strpos(uri_string(), 'main/send_requestteacher') !== FALSE )  
						
							{ 
											echo 'class="active"'; } ?>><a href="#"><i class="fa fa-group">
                       
                  
                    </i><span class="menu-title">Requests</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li <?php
					
							if(strpos(uri_string(), 'main/student_requestlist') !== FALSE   or strpos(uri_string(), 'main/pending_request_student') !== FALSE  )
						
							{ 
											echo 'class="active"'; } ?> ><a href="<?php echo site_url();?>/main/student_requestlist"><i class="fa fa-briefcase"></i><span class="submenu-title">Points Requests from <?php echo ($this->session->userdata('usertype')=='employee')?'Employees':'Students'; ?></span></a></li>
                       <li   <?php
					
							if(strpos(uri_string(), 'main/teacherlist_request') !== FALSE or strpos(uri_string(), 'main/send_requestteacher') !== FALSE  )
						
							{ 
											echo 'class="active"'; } ?>><a href="<?php echo site_url();?>/main/teacherlist_request"><i class="fa fa-th-large"></i><span class="submenu-title">Points Request to <?php echo ($this->session->userdata('usertype')=='employee')?'Manager':'Teacher'; ?> </span></a></li> 
                       
                       
                        <li <?php
					
							if(strpos(uri_string(), 'main/show_studlistfor_request') !== FALSE  or strpos(uri_string(), 'main/send_reuest_to_student') !== FALSE )
						
							{ 
											echo 'class="active"'; } ?> ><a href="<?php echo site_url();?>/main/show_studlistfor_request"><i class="fa fa-th-large"></i><span class="submenu-title">Points Request To Other <?php echo ($this->session->userdata('usertype')=='employee')?'Employee':'Student'; ?> </span></a></li>
											
						 <li <?php
					
							if(strpos(uri_string(), 'main/request_to_join_samrtcookie') !== FALSE  or strpos(uri_string(), 'main/request_to_join_samrtcookie') !== FALSE )
						
							{ 
											echo 'class="active"'; } ?> ><a href="<?php echo site_url();?>/main/request_to_join_samrtcookie"><i class="fa fa-group"></i><span class="submenu-title">Request To Join SmartCookie </span></a></li>
                           
						   
						    <li <?php
					//echo $studentinfo[0]->status;die;
					 if($studentinfo[0]->status=='')
					 {
											
							if(strpos(uri_string(), 'main/teacherlist_coordinator') !== FALSE  or strpos(uri_string(), 'main/teacherlist_coordinator') !== FALSE )
						
							{ 
											echo 'class="active"'; } ?> ><a href="<?php echo site_url();?>/main/teacherlist_coordinator"><i class="fa fa-th-large"></i><span class="submenu-title">Coordinator Request To <?php echo ($this->session->userdata('usertype')=='employee')?'Manager':'Teacher'; ?> </span></a>
											
											<?php }
											
											
											?></li>
                           
					                    
                        </ul>
						 
                    </li> 
                     
                      <li  <?php
					
					
					 if(uri_string()=='main/student_subjectlist'){ echo 'class="active"'; }; ?>><a href="<?php echo site_url();?>/main/student_subjectlist"><i class="fa fa-database fa-fw">
                       
                  
                    </i><span class="menu-title">My <?php echo ($this->session->userdata('usertype')=='employee')?'Projects':'Subjects'; ?></span></a>
                        
                    </li>
                     <li  <?php
					
					
					 if(uri_string()=='main/Add_subject_view'){ echo 'class="active"'; }; ?>><a href="<?php echo site_url();?>/main/Add_subject_view"><i class="fa fa-database fa-fw">
                       
                  
                    </i><span class="menu-title"><?php echo ($this->session->userdata('usertype')=='employee')?'':'Add Subject'; ?></span></a>
                        
                    </li>
                 
                    <li  <?php
					
					
					 if(uri_string()=='main/sponsor_map'){ echo 'class="active"'; }; ?> ><a href="<?php echo site_url();?>/main/sponsor_map "><i class="fa fa-bar-chart-o fa-fw">
                       
                  
                    </i><span class="menu-title">Sponsor Map</span></a>
                       
                    </li>
                    
                    
                                    
					<!-- sponsor coupons-->
						<?php $this->load->view('coupons/coupon_navigation'); ?>
					<!-- sponsor coupons end-->
                    
                    
                    
                    
                    
                    
                   <li <?php
							
						
							 if(uri_string()=='main/ my_parent' ){ 
											echo 'class="active"'; } ?>><a href="<?php echo site_url();?>/main/my_parent"><i class="fa fa-briefcase"></i><span class="menu-title">My Parent</span></a></li>
                    
                    
                    
                    
                    
					
                </ul>
            </div>
        </nav>
        <!--END SIDEBAR MENU-->
		<!--BEGIN CHAT FORM-->
        <div id="chat-form" class="fixed">
        
        </div>
       
               
			   <?php if(uri_string()=='Ccoupon/select_coupon' or 
								uri_string()=='Ccoupon/cart' or
								uri_string()=='Ccoupon/unused_coupons' or
								uri_string()=='Ccoupon/used_coupons' or 
								uri_string()=='Ccoupon/suggested_sponsors' or
								uri_string()=='Ccoupon/suggest_sponsor'){ 
								echo '<div id="page-wrapper">
								<div class="page-content">
								<div id="tab-general">';
						} ?>
 