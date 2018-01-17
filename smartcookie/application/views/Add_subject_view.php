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

           $('#CourseLevel').on('change', function() {
               var id=$(this).attr('id');
               var value=$(this).val();
               var Url="<?php echo base_url()."main/getDepartment";?>"
                 // alert(value);
               $.ajax({
                   type: "POST",
                   dataType:'json',
                   data:{value:value},
                   url: '<?php echo base_url('main/getDepartment');?>',
                   success: function(data){
                       if (data.code == 200) {
                           console.log("coming");
                           alert(data);
                       }else if (data.code == 400) {
                           console.log("coming");
                           alert("fail");
                       }

                   }

                /*  switch(id) {
                    case id='CourseLevel':

                 case id='department':
                                    alert("department");
                                    break;
                    case id='Branch':
                                    alert("Branch");
                                    break;
                    case id='semester':
                                    alert("semester");
                                    break;
                    default:
                                    alert("Default");
                                    break;
                }*/

            });


     	$("#subject_name").keyup(function(){
		$.ajax({
		type: "POST",
		url: "readsubject.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#subject_name").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#subject_name").css("background","#FFF");
		}
		});
	});
 
} );
		
		//document.getElementById("CourseLevel").value;
		
 </script>
</head>

<title>Add Subject</title>
    

<body  >

     <div id="area-chart-spline" style="width: 100%; height:300px; display:none;"></div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
          
          
           
             <div id="page-wrapper"><!--BEGIN TITLE & BREADCRUMB PAGE-->
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Add Subject</div>
                </div>
				
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="members">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                   <!-- <li><a href="#">Logs</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>-->
                    <li class="active">Add Subjects</li>
                </ol>
				
                <div class="clearfix"></div>
            </div>

<div style="bgcolor:#CCCCCC">

<div class="container" style="padding:25px;" >
        	
            
            	<div style="padding:2px 2px 2px 2px;border:1px solid #CCCCCC; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4; background-color:#F8F8F8 ;">
                   <h2 style="padding-top:30px;"><center>Add Subject</center></h2>

               <div class="row formgroup" style="padding:5px;">
                  
				  <form method="post" action="Add_subject_view">

                        <?php //echo  form_open("main/Add_subject_view/".$studentinfo[0]->std_PRN,"class=form-horizontal");?>

                        <div class="row " style="padding-top:30px;">
                            <div class="col-md-2 col-md-offset-4" style="color:#808080; font-size:18px;">Course Level
                            </div>
                            <div class="col-md-3">
                                <select name="CourseLevel" id="CourseLevel" class="form-control">
                                    <option value="">Choose</option>
                                    
                                    <?php foreach ($getCourselevel as $value) {
                                        ?>
                                        <option value="<?php if($value->CourseLevel){echo $value->CourseLevel;}else{}?>"><?php if($value->CourseLevel){echo $value->CourseLevel;}else{}?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
						
                        <div class="row " style="padding-top:30px;">
                            <div class="col-md-2 col-md-offset-4" style="color:#808080; font-size:18px;">Department
                            </div>
                            <div class="col-md-3">
                                <select name="department" id="department" class="form-control">
								<option value="">Choose</option>
                                    <?php foreach ($getalldepartment as $value) {
                                        ?>
                                        <option value="<?php echo $value->Dept_Name ?>"><?php echo $value->Dept_Name; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>


                        <div class="row" style="padding-top:30px;">
                            <div class="col-md-4"></div>
                            <div class="col-md-2" style="color:#808080; font-size:18px;">Branch</div>
                            <div class="col-md-3">
                                <select name="Branch" id="Branch" class="form-control">
								<option value="">Choose</option>
                                     <?php foreach ($getallbranch as $value) {
                                        ?>
                                        <option value="<?php echo $value->branch_Name ?>"><?php echo $value->branch_Name; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
						
						<div class="row" style="padding-top:30px;">
                            <div class="col-md-4"></div>
                            <div class="col-md-2" style="color:#808080; font-size:18px;">Semester</div>
                            <div class="col-md-3">
                                <select name="semester" id="semester" class="form-control">
								<option value="">Choose</option>
                                    <?php foreach ($getallsemester as $value) {
                                        ?>
                                        <option value="<?php echo $value->Semester_Name ?>"><?php echo $value->Semester_Name; ?> </option>
                                    <?php } ?>
                                </select>

                            </div>
                        </div>

                        <div class="row" style="padding-top:30px;">
                            <div class="col-md-4"></div>
                            <div class="col-md-2" style="color:#808080; font-size:18px;">Academic Year</div>
                            <div class="col-md-3">
                                <select name="AcademicYear" id="AcademicYear" class="form-control">
								<option value="">Choose</option>
                                    <?php foreach ($getAcademicYear as $value) {
                                        ?>
                                        <option value="<?php echo $value->Year ?>"><?php echo $value->Year; ?> </option>
                                    <?php } ?>
                                </select>

                            </div>


                        </div>
                        <div class="row " style="padding-top:30px;">
                            <div class="col-md-2 col-md-offset-4" style="color:#808080; font-size:18px;">Division</div>
                            <div class="col-md-3">
                                <select name="Division" id="Division" class="form-control">
								<option value="">Choose</option>
                                <?php foreach ($getDivision as $value) {
                                    ?>
                                    <option value="<?php echo $value->DivisionName ?>"><?php echo $value->DivisionName; ?> </option>
                                <?php } ?>
								</select>
                            </div>
                        </div>
						
						 <div class="row " style="padding-top:50px;">
                            <div class="col-md-2 col-md-offset-4" style="color:#808080; font-size:18px;">Subject Name
                            </div>
                            <div class="col-md-3">
                                <select name="subject_name" id="subject_name" class="form-control">
								<option value="">Choose</option>
                                    <?php foreach ($getallsubject as $value) {
                                        ?>
                                        <option value="<?php echo $value->subject ?>"><?php echo $value->subject; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                      <!-- <div class="row " style="padding-top:50px;">
                            <div class="col-md-2 col-md-offset-4" style="color:#808080; font-size:18px;">Subject code
                            </div>
                            <div class="col-md-3">
                                 <select name="Subject_Code" id="Subject_Code" class="form-control">
								<option value="">Choose</option>
                                    <?php //foreach ($getallsubject as $value) {
                                       // ?>
                                        <option value="<?php// echo $value->Subject_Code ?>"><?php// echo $value->Subject_Code; ?> </option>
                                    <?php //} ?>
                                </select>
                            </div>
                        </div>-->

                        <div class="row" style="padding-top:60px;">
                            <div class="col-md-5"></div>
                            <?php
                            if (isset($report)) {
                            ?> <font color="green"><?php echo $report;?></font>
                          <?php

                            }if(isset($report1)){
                            ?> <font color="red"><?php echo $report1;?></font>
                           <?php }

                            ?>
                            <div class="col-md-1"><input type="submit" name="submit" id="addsubject" value="Add" class="btn btn-success"></div>
                            <div class="col-md-1"></div>
                    </form>
               </div>
            </div>
		</div>
    </div>
	<?php 


$this->load->view('footer');

?>
</body>
</html>
			   