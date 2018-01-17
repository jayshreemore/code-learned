<?php

include("conn.php");
$id=$_SESSION['id'];

$query = mysql_query("select school_id from tbl_school_admin where id ='$id'");
$value = mysql_fetch_array($query);
$school_id=$value['school_id'];

?>



<?php
$value=$_GET['course'];
if($value=="Dept"){
//echo "select Degee_name,Degree_code from tbl_degree_master where school_id='$sc_id' and course_level='$value'";die;

  $row=mysql_query("SELECT DISTINCT  `std_branch`,school_id FROM `tbl_student` where `std_branch`!=' ' AND `school_id`='$school_id'"); 
  
echo " <div class='row1 form-inline'>
<div style='float:left'>Select Branch</div>
             <select name='Department' id='Department' class='form-control' onChange='showbranchwise(this.value)'  style='width:140px;'>
			 <option value='select'>Select Degree</option>";
  while($val=mysql_fetch_array($row))
  {    
   echo "<option value='$val[std_branch]'> $val[std_branch]</option>";
  }
 
 echo " </select>
      </div>";

}else{
echo '';
}


?>
