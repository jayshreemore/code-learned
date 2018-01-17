
<?php include("header.php");



$query = mysql_query("select * from tbl_teacher where id = ".$_SESSION['id']);
$value = mysql_fetch_array($query);
$id=$value['id'];
$school_id=$value['school_id'];
//$teacher=$_SESSION['usertype'];
//$teacher($_SESSION['usertype']=='Teacher');

?>

<html>
<head>
</head>

<body>
<div class="header">
<center><div class="name"style="background-color:rgb(47, 50, 159);width:60%;">
<center><h3 style="color:#fff";>Purchase Water Points</h3></center>



</div>
<br><br><br>
<center><form name="waterpoint" method="post" action="add_water_point.php">

Enter Card No<input type="text" name="card_no">
<input type="submit" name="purchase" value="Purchase">


</form>
</center>
</div>
</body>
</html>
