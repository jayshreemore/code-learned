<?php 
//print_r($schoolinfo);

$this->load->view('stud_header',$studentinfo);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<script>
	
        $(document).ready(function() {
            $('#example').dataTable( {
		
				
         });
			
  
        } );
		
		
        </script>
</head>

<title>Subject List</title>
    

<body>

    <!--END THEME SETTING-->

   
        <!--END SIDEBAR MENU--><!--BEGIN CHAT FORM-->
   
     <div id="area-chart-spline" style="width: 100%; height:300px; display:none;"></div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
          
          
           
             <div id="page-wrapper"><!--BEGIN TITLE & BREADCRUMB PAGE-->
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">My <?php echo ($this->session->userdata('usertype')=='employee')?'Projects':'Subjects'; ?></div>
                </div>
				
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="members">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                   <!-- <li><a href="#">Logs</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>-->
                    <li class="active">My <?php echo ($this->session->userdata('usertype')=='employee')?'Projects':'Subjects'; ?></li>
                </ol>
				
                <div class="clearfix"></div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
            <div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="generalTabContent" class="tab-content responsive" style="margin-top:4%;">
                            <div id="teacher" class="tab-pane fade in active">
                   <?php  if($this->session->userdata('usertype')=='employee'){}else{   ?>
						<div class="row">
						   <?php 

echo form_open("main/student_subjectlist","class=form-horizontal");?>
						<div class="col-md-4">
						
						</div>
						<div class="col-md-4">
						<select id="select_opt" name="select_opt" class="form-control">
     <option value="1" <?php 
	 
	 if(isset($_POST['select_opt']))
	 {
		 if($_POST['select_opt']=="1")
		 {  ?> selected 
	<?php } 
		 
	 }
	 ?>


	 ><?php echo "Current Semester" ?></option>
	 <option value="2"   <?php 
	 
	 if(isset($_POST['select_opt']))
	 {
		 if($_POST['select_opt']=="2")
		 { ?> selected 
	<?php } 
		 
	 }
	  ?>


	  > <?php echo "All Semester" ?></option>
	  
	   <option value="3" <?php 
	 
	 if(isset($_POST['select_opt']))
	 {
		 if($_POST['select_opt']=="3")
		 {  ?> selected 
	<?php } 
		 
	 }
	 ?>


	 ><?php echo "All Year" ?></option>
	 
	  <option value="4" <?php 
	 
	 if(isset($_POST['select_opt']))
	 {
		 if($_POST['select_opt']=="4")
		 {  ?> selected 
	<?php } 
		 
	 }
	 ?>


	 ><?php echo "current Year" ?></option>
	 
	 <option value="5" <?php 
	 
	 if(isset($_POST['select_opt']))
	 {
		 if($_POST['select_opt']=="5")
		 {  ?> selected 
	<?php } 
		 
	 }
	 ?>


	 ><?php echo "My all Subject List" ?></option>
	  
	 
	  
	  
      </select><?php echo form_error('select_opt', '<div class="error">', '</div>'); ?>
						
						</div>
						<div class="col-md-4">
						  <?php 
						 
							 echo form_submit('submit', 'Submit','class="btn btn-green"'); 
						     //echo form_submit('submit', 'Add Subject','class="btn btn-green"');
								//echo form_submit('button', 'Add Subject','class="btn btn-green"');
						  
				    ?>
					</div>
						<?php



echo form_close();

	?>
						
						</div>
						
				   <?php } 
						
								
						
                               ?> <div class="row" style="margin-top:5%;">
                                
                                  <div id="no-more-tables">
                                    <table class="table table-bordered table-hover " id="example" >
                                        <thead class="cf">
                                        <tr>
                                            <th>Sr.No.</th>
                                            <th><?php echo ($this->session->userdata('usertype')=='employee')?'Project':'Subject'; ?> Code</th>
                                            <th><?php echo ($this->session->userdata('usertype')=='employee')?'Project':'Subject'; ?> Name</th>
											
						      <?php if($this->session->userdata('usertype')=='employee')
						        {
							
						        }	
								else
								{
							        echo "<th>Semester</th>";
						        }		
						         ?>	
										
                                            
											
											
                                             <th>Branch</th>
					              <?php if($this->session->userdata('usertype')=='employee')
					                {
							
						            }
									else
									{
							            echo " <th>Year</th>";
						            }		
						          ?>	
							
											
                                            <th ><?php echo ($this->session->userdata('usertype')=='employee')?'Manager':'Teacher'; ?> Name</th>
                                           
                                            
                                           
                                           
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $i=1;
                                            foreach($student_subjectlist as $t) {?>
                                        <tr>
                                            <td data-title="Sr.No"><?php echo $i;?></td>
                                            <td data-title="<?php echo ($this->session->userdata('usertype')=='employee')?'Project':'Subject'; ?> Code"><?php if(isset($t->subjcet_code)){echo $t->subjcet_code;}else{}?></td>
                                            <td data-title="<?php echo ($this->session->userdata('usertype')=='employee')?'Project':'Subject'; ?> Name" ><?php if(isset($t->subjectName)){echo $t->subjectName;}else{}?></td>
											
									<?php if($this->session->userdata('usertype')=='employee')
									{
							
						                        
									}	
									else
									{
							           ?><td data-title="Semester" ><?php if(isset($t->Semester_id)){echo $t->Semester_id ;}else{}?></td><?php
						            }		
						          ?>			
											
                                             
											 
											 <td data-title="Branch"><?php if(isset($t->Branches_id)){echo $t->Branches_id ;}else{}?></td>
											 
						             <?php if($this->session->userdata('usertype')=='employee')
						              {
							
						              }
									  else
						              {
							              ?><td data-title="Year"><?php if(isset($t->AcademicYear)){echo $t->AcademicYear;}else{}?></td><?php
						              }		
						             ?>	 
											 
											 
                                             
											 
											 <td data-title="<?php echo ($this->session->userdata('usertype')=='employee')?'Manager':'Teacher'; ?> Name"><?php  if(isset($t->t_complete_name)){echo ucwords(strtolower( $t->t_complete_name));}else{} ?></td>
                                             
                                         
                                           
                                        </tr>
                                      <?php $i++;}?>
                                        </tbody>
                                    </table>
                                </div>
                                
                                
								
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