<?php

include('conn.php');
$school_id = $_GET['sc_id'];

$sql2=mysql_query("Select id,subject from tbl_school_subject where school_id='$school_id' group by subject order by subject" );
echo "<option  value='' disabled selected>$dynamic_subject Name</option>  ";

if($school_id=="all")
{
	echo "<option  value='allSubjects' >All $dynamic_subject</option>";
}
else
{
	echo "<option  value='' >All $dynamic_subject</option>";
}
while($row=mysql_fetch_assoc($sql2)){ ?>

    <option value="<?php echo $row['id'];?>"><?php echo $row['subject'];?>    </option>

    <?php }?>

   