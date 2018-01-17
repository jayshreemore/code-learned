<?php
include 'conn.php';
$school_id=$_SESSION["id"];
if(isset($_GET['method'])){
$method_id=$_GET['method'];
$val= mysql_query("SELECT m.id,from_range,to_range, m.points, school_id FROM tbl_master m JOIN tbl_method t on t.id=m.method_id WHERE t.id ='$method_id' AND activity_id='0' AND subject_id='0' AND school_id='$school_id'");
$q=mysql_num_rows($val);
if($q==0){ 
$val= mysql_query("SELECT m.id,from_range,to_range, m.points, school_id FROM tbl_master m JOIN tbl_method t on t.id=m.method_id WHERE t.id ='$method_id' AND activity_id='0' AND subject_id='0' AND school_id='0'");
echo "<span style='color:#080; margin-top:5px; margin-bottom:5px;'>Showing Defaults From CookieAdmin</span>";
}
echo "
<table class='table'>
<tr><th>From Range</th><th>To Range</th><th>Points</th></tr>";
$i=1;
while($row=mysql_fetch_array($val)){ 
echo "<tr><td>
<input value='$row[school_id]' name='school_id' id='school_id' type='hidden'>
<input value='$row[id]' name='mid$i' id='mid$i' type='hidden'>
<input value='$row[from_range]' class='form-control' name='from$i' id='from$i' type='text'></td>
<td><input value='$row[to_range]' class='form-control' name='to$i' id='to$i' type='text'></td>
<td><input value='$row[points]' class='form-control' name='points$i' id='points$i' type='text'></td></tr>";
$i++;
} 	
$i-=1;
echo "</table>
<div class='panel-footer'>
<input type='hidden' name='total_ranges' id='total_ranges' value='$i' >
<input type='hidden' name='method_id' id='method_id' value='$method_id' >
<button type='submit' class='btn btn-default' name='submit' id='submit'>Set</button>
</div>";
}

?>