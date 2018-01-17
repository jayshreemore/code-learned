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
			$('#example1').dataTable( {
         });
        } );
        </script>
</head>
<title>Reward Log</title>
<body>
    <!--END THEME SETTING-->
        <!--END SIDEBAR MENU--><!--BEGIN CHAT FORM-->
     <div id="area-chart-spline" style="width: 100%; height:300px; display:none;"></div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
             <div id="page-wrapper"><!--BEGIN TITLE & BREADCRUMB PAGE-->
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Reward Points</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="members">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li><a href="#">Logs</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Reward Points</li>
                </ol>
                <div class="clearfix"></div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
            <div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
                        <ul id="generalTab" class="nav nav-tabs responsive">
                            <li class="active"><a href="#teacher" data-toggle="tab">Teacher</a></li>							
                          <?php 
						 if($studentinfo[0]->status=='')
						 {?>  <li><a href="#Student-Coordinator" data-toggle="tab">Student Coordinator</a></li>						
						 <?php }?>							<li ><a href="#schooladmin" data-toggle="tab">School Admin</a></li>
                        </ul>
                        <div id="generalTabContent" class="tab-content responsive">
                            <div id="teacher" class="tab-pane fade in active">
                                <div class="row">
                                  <div id="no-more-tables">
                                    <table class="table table-bordered table-hover " id="example" >
                                        <thead class="cf">
                                        <tr>
                                            <th>Sr.No.</th>
                                            <th>Activity/Subject</th>
                                            <th>Points</th>
                                            <th >Teacher Name</th>
                                            <th >Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $i=1;
                                            foreach($rewardinfo as $t) {?>
                                        <tr>
                                            <td data-title="Sr.No"><?php echo $i;?></td>
                                            <td data-title="Reason"><?php echo $t->reason ;?></td>
                                            <td data-title="Points" ><?php echo $t->sc_point;?></td>
                                            <td data-title="Teacher Name" ><?php if($t->t_complete_name=="")											{												echo ucwords(strtolower($t->t_name." ".$t->t_lastname));											}											else											{												echo ucwords(strtolower($t->t_complete_name));																							}												;?></td>
                                            <td data-title="Date"><?php echo $t->point_date;?></td>
                                        </tr>
                                      <?php $i++;}?>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>												   								<div id="schooladmin" class="tab-pane fade">									<div class="row">										<div id="no-more-tables">											<table class="table table-bordered table-hover " id="example" >												<thead class="cf">												<tr>                                            <th>Sr.No.</th>                                            <th>School Admin Name</th>                                            <th>Reason</th>                                            <th >Points</th>																						                                            <th >Date</th>                                        </tr>                                        </thead>                                        <tbody>                                           <!--php code rewards function-->										   										   <?php                                             $i=1;                                            foreach($rewardschooladmin as $t) {?>                                        <tr>                                            <td data-title="Sr.No"><?php echo $i;?></td>																						<td data-title="School Admin Name" ><?php echo $t->school_id;?></td>                                            <td data-title="Reason"><?php echo $t->sc_list ;?></td>                                            <td data-title="Points" ><?php echo $t->sc_point;?></td>                                            <td data-title="Date"><?php echo $t->point_date;?></td>                                        </tr>										<?php $i++;}?>										   											</tbody>											</table>									</div>                                                            </div>							</div>																																																																						
							<?php 
						 if($studentinfo[0]->status=='')
						 {?>
                            <div id="Student-Coordinator" class="tab-pane fade">
                                <div class="row">
                                 <div id="no-more-tables">
                                    <table class="table table-bordered table-hover " id="example1" >
                                        <thead class="cf">
                                        <tr>
                                            <th>Sr.No.</th>
                                            <th>Activity/Subject</th>
                                            <th>Points</th>
                                    		<th>Coordinator Name</th>

                                            <th >On Behalf of Teacher</th>
                                            <th >Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $i=1;
                                            foreach($rewardcoordinatorlog as $t) {?>
                                        <tr>
                                            <td data-title="Sr.No" style="width:5%;"><?php echo $i;?></td>
                                            <td data-title="Reason" style="width:10%;"><?php echo $t->reason ;?></td>
                                            <td data-title="Points" style="width:8%;"><?php echo $t->sc_point;?></td>
                                              <td data-title="Teacher Name" ><?php echo ucwords(strtolower($t->coordinator));?></td>
                                            <td data-title="Teacher Name" ><?php echo ucwords(strtolower($t->teacher)) ;?></td>
                                            <td data-title="Date"><?php echo $t->point_date;?></td>
                                        </tr>
                                      <?php $i++;}?>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>
                          	<?php 
						 } ?>
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