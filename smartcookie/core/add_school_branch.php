<?php
$report="";
$report1="";
 include('scadmin_header.php');
$id=$_SESSION['id'];
           $fields=array("id"=>$id);
		   $table="tbl_school_admin";
		   
		   $smartcookie=new smartcookie();
		   
$results=$smartcookie->retrive_individual($table,$fields);
$result=mysql_fetch_array($results);
$sc_id=$result['school_id'];
if(isset($_POST['submit']))
{		
	
	$course=$_POST['course'];
	$degree=$_POST['degree'];
	$dept_name=$_POST['department'];
	$branch_name=$_POST['branch_name'];
	$branch_code=$_POST['branch_code'];
	$specialization=$_POST['specializaion'];
	$duration=$_POST['duration'];
	$isenable=$_POST['isenable'];
	
	if($_POST['branch_code']!='')
	{
	
	
	$sql= mysql_query("select Branch_code from `tbl_branch_master` where school_id='$sc_id' and Branch_code='$branch_code' and Course_Name='$course' and Dept_Id='$dept_name' and Specialization='$specialization' and  degree_code='$degree'");
$result=mysql_num_rows($sql);
if($result==0)
{



$query=mysql_query("insert into tbl_branch_master (branch_Name,Branch_code,Course_Name,degree_code,Duration,Specialization,DepartmentName,school_id,IsEnabled) values('$branch_name','$branch_code','$course','$degree','$duration','$specialization','$dept_name','$sc_id','$isenable')");

$succesreport="$branch_name is successfully inserted";


}

else
{

$report1="$branch_code Branch Code is already exists";

}
	
	}
	
	else
	{
	
		$report1="Branch code required";
	
	}
	

	
								
							
}

?>


<html>
<head>
<script>

function MyAlert(course)
{
 
 
 
        if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
          }
        else
          {// code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
        xmlhttp.onreadystatechange=function()
          {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
			
			
			var points=xmlhttp.responseText;
			
	
			document.getElementById('degree').innerHTML=points;
      
			
            }
          }
	
		 
        xmlhttp.open("GET","get_schoolscourse.php?course="+course,true);
        xmlhttp.send();


}

 function valid()
{
	var course=document.getElementById("course").value;
		
		
		
		regx1=/^[A-z ]+$/;
		
		
		if(course=="select" )
			{
			   
				document.getElementById('errorcourse').innerHTML='Please select course';
				
				return false;
			}
			else{
				document.getElementById('errorcourse').innerHTML='';
			}
			
			
			var degree=document.getElementById("degree").value;
		
		
		
		
		
		
		if(degree=="select" )
			{
			   
				document.getElementById('errordegree').innerHTML='Please enter degree';
				
				return false;
			}else{
				document.getElementById('errordegree').innerHTML='';
			}
			
			
			
		
		
		
		
		
		
		var department=document.getElementById("department").value;
			
			if(department=='select' )
			{
				document.getElementById('errordepartment').innerHTML='Please select department';
				return false;	
			}
			
			
			
			var branch_name=document.getElementById("branch_name").value;
			
			
			regx1=/^[A-z ]+$/;
		
		
		if(branch_name==null||branch_name=="" )
			{
			   
				document.getElementById('errorbranch').innerHTML='Please enter branch';
				
				return false;
			}
			else if(!regx1.test(branch_name))
			{
				document.getElementById('errorbranch').innerHTML='Please enter valid  branch';
				
				return false;
				}else{
				document.getElementById('errorbranch').innerHTML='';
			}
			var branch_code=document.getElementById("dept_name").value;
		
		
		
		regx1=/^[A-z0-9 ]+$/;
		
		
		if(branch_code==null||branch_code=="" )
			{
			   
				document.getElementById('errorbranchcode').innerHTML='Please enter branch code';
				
				return false;
			}
			else if(!regx1.test(branch_code))
			{
				document.getElementById('errorbranchcode').innerHTML='Please enter valid  branch code';
				
				return false;
				}else{
				document.getElementById('errorbranchcode').innerHTML='';
			}
			
			
			
	
	
}
 
 
 


</script>
</head>
<body bgcolor="#CCCCCC">
<div style="bgcolor:#CCCCCC">
<div>

</div>
<div class="container" style="padding:25px;" >
        		<div style="padding:2px 2px 2px 2px;border:1px solid #CCCCCC; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4;">
                   <form method="post">
                    
                    <div style="background-color:#F8F8F8 ;">
                    <div class="row">
                    <div class="col-md-3 col-md-offset-1"  style="color:#700000 ;padding:5px;" >
                   
               			 </div>
              			 <div class="col-md-4 " align="center" style="color:#663399;" >
                         	
                   				<h2>Add Branch </h2>
               			 </div>
                         
                     </div>
                  
                  
                    <div class="row " style="padding-top:60px;" >
               <div class="col-md-2 col-md-offset-4" style="color:#808080; font-size:18px;"> Course </div><span style="color:red;font-size: 25px;">*</span>
               
               <div class="col-md-3">
               <?php
           //  echo "gtruyfg";
			 // echo "select distinct  CourseLevel from tbl_CourseLevel where school_id='$sc_id'";
			   $query1=mysql_query("select distinct  CourseLevel from tbl_CourseLevel where school_id='$sc_id'");
			 ?>
             <select name="course" id="course" class="form-control" onChange="MyAlert(this.value)">
             <option value="select">Course</option>
             
			 
			 
                <?php
			 while($result1=mysql_fetch_array($query1))
			 {?>
			 
			 
               <option value=<?php echo $result1['CourseLevel'];?>><?php echo $result1['CourseLevel'];?></option>
			 
			 <?php }?>
             
             </select>
             </div>
                
              
                  </div>
                  
                  <div class="row"><div class="col-md-4 col-md-offset-5" id="errorcourse" style="color:#F00"></div></div>
                   
                   
                     <div class="row " style="padding-top:30px;" >
               <div class="col-md-2 col-md-offset-4" style="color:#808080; font-size:18px;">  Degree</div>
               
               <div class="col-md-3">
             <select name="degree" id="degree" class="form-control">
              <?php
			  $Course = $_POST['Course'];
           //  echo "gtruyfg";
			 // echo "select distinct  CourseLevel from tbl_CourseLevel where school_id='$sc_id'";
			   $query1=mysql_query("select distinct  Degee_name from tbl_degree_master where school_id='$sc_id' and course_level=$Course");
			 ?>
             <option value="select">Select Degree</option>
               <?php
			 while($result1=mysql_fetch_array($query1))
			 {?>
			 
			 
               <option value=<?php echo $result1['CourseLevel'];?>><?php echo $result1['CourseLevel'];?></option>
			 
			 <?php }?>
			 
			 
               
             </select>
             </div>
                
              
                  </div>
                   <div class="row"><div class="col-md-4 col-md-offset-5" id="errordegree" style="color:#F00"></div></div>
                  
				  
				  
				  
               <div class="row "  style="padding-top:30px;" >
               <div class="col-md-2 col-md-offset-4" style="color:#808080; font-size:18px;">  Department</div><span style="color:red;font-size: 25px;">*</span>
               
               <div class="col-md-3">
             <select name="department" id="department" class="form-control" onChange="MyAlert(this.value)">
			 
             <option value="select">Select Department</option>
             <?php
			 
			 $query=mysql_query("select Dept_Name from tbl_department_master where school_id='$sc_id'");
			 while($result=mysql_fetch_array($query))
			 {?>
			 
			 
               <option value=<?php echo $result['Dept_Name'];?>><?php echo $result['Dept_Name'];?></option>
			 
			 <?php }?>
             
             </select>
             </div>
                
              
                  </div>
                   <div class="row"><div class="col-md-4 col-md-offset-5" id="errordepartment" style="color:#F00"></div></div>
                  
				  
				  
				    
             
                
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
                    <div class="row "  style="padding-top:30px;" >
               <div class="col-md-2 col-md-offset-4" style="color:#808080; font-size:18px;"> Branch Name</div><span style="color:red;font-size: 25px;">*</span>
               
               <div class="col-md-3">
             <input type="text" name="branch_name"  id="branch_name" value="<?php if(isset($_POST['branch_name'])){ echo $_POST['branch_name'];}?>" class="form-control"/>
             </div>
                
              
                  </div>
                   <div class="row"><div class="col-md-4 col-md-offset-5" id="errorbranch" style="color:#FF0000"></div></div>
                   <div class="row "  style="padding-top:30px;" >
               <div class="col-md-2 col-md-offset-4" style="color:#808080; font-size:18px;"> Branch Code</div><span style="color:red;font-size: 25px;">*</span>
               
               <div class="col-md-3">
             <input type="text" name="branch_code" id="branch_code" value="<?php if(isset($_POST['branch_code'])){ echo $_POST['branch_code'];}?>" class="form-control"/>
             </div>
             </div>
             <div class="row">
             
              <div class="col-md-3 col-md-offset-5" style="color:#FF0000" id="errorbranchcode">
             <?php echo $report1;?>
             </div>
                
              
                  </div>
                  
                  
                  
                    <div class="row "  style="padding-top:30px;" >
               <div class="col-md-2 col-md-offset-4" style="color:#808080; font-size:18px;">Specializaion</div>
               
               <div class="col-md-3">
             <input type="text" name="specializaion" id="specializaion" value="<?php if(isset($_POST['specializaion'])){ echo $_POST['specializaion'];}?>" class="form-control"/>
             </div>
                
              
                  </div>
                  
                  
                      <div class="row "  style="padding-top:30px;" >
               <div class="col-md-2 col-md-offset-4" style="color:#808080; font-size:18px;">Duration</div>
               
               <div class="col-md-3">
             <input type="text" name="duration" id="duration" value="<?php if(isset($_POST['duration'])){ echo $_POST['duration'];}?>" class="form-control"/>
             </div>
                
              
                  </div>
                  
                  
                   <div class="row "  style="padding-top:30px;" >
               <div class="col-md-2 col-md-offset-4" style="color:#808080; font-size:18px;">Is Enable</div>
               
               <div class="col-md-1">
               <input type="radio" name="isenable" value="1" checked> Yes</div>
                 <div class="col-md-1">
               <input type="radio" name="isenable" value="0" > No</div>
               
               
           
            
                
              
                  </div>
                  
                  
                  
               
                  
                   <div class="row" style="padding-top:40px;">
                   <div class="col-md-2">
               </div>
                  <div class="col-md-1 col-md-offset-3 "  >
                    <input type="submit" class="btn btn-primary" name="submit" value="Add "  onClick="return valid()" style="width:100%;"/>
                    </div>
                     <div class="col-md-3 "  align="left">
        <a href="list_school_branch.php" style="text-decoration:none;">
		<input type="button" class="btn btn-danger" name="Back" value="Back" style="width:30%;"  /></a>
                    </div>
                   
                   </div>
                   
                     <div class="row" style="padding-top:30px;">
                  
                      <div class="col-md-4 col-md-offset-4 "  align="center" id="error">
                       <div style="color:#FF0000;">
                      <?php echo $report;?>
                      </div>
                       <div style="color:#093"><?php echo $succesreport;?></div>
               			</div>
                       
                 
                    </div>
                       </div>
                </form>
                  
                 
                    
                    
                  
               </div>
               </div>
</body>
</html>
