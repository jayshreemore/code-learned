<?php
include("cookieadminheader.php");
if(!isset($_SESSION['id']))
	{
		header('location:login.php');
	}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Generate Coupon</title>
</head>

      <script>
       $(document).ready(function() {

	    $('#example').DataTable();
} );
        </script>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
<style>
@media only screen and (max-width: 800px) {

    /* Force table to not be like tables anymore */
	#no-more-tables table,
	#no-more-tables thead,
	#no-more-tables tbody,
	#no-more-tables th,
	#no-more-tables td,
	#no-more-tables tr {
		display: block;
	}

	/* Hide table headers (but not display: none;, for accessibility) */
	#no-more-tables thead tr {
		position: absolute;
		top: -9999px;
		left: -9999px;
	}

	#no-more-tables tr { border: 1px solid #ccc; }

	#no-more-tables td {
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee;
		position: relative;
		padding-left: 50%;
		white-space: normal;
		text-align:left;
		font:Arial, Helvetica, sans-serif;
	}

	#no-more-tables td:before {
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%;
		padding-right: 10px;
		white-space: nowrap;
		text-align:left;

	}

	/*
	Label the data
	*/
	#no-more-tables td:before { content: attr(data-title); }
}
</style>


<body>
<div class="container" style="padding-top:50px;">
<div class="row">

<div class="col-md-1"></div>
<div class="col-md-10" style="border:1px solid #694489;border: solid 1px gainsboro; transition: box-shadow 0.3s, border 0.3s; box-shadow: 0 0 5px 1px #969696;">
<h2 align="center">Gift card Report</h2>

<div class="row">
<div class="col-md-1"><a href="generate.php"> <input type="button" value="Generate Gift Card" class="btn btn-primary"></a></div>
</div>

<div >
<div class="row" style="padding-top:20px;">
<div class="col-md-1"></div>
<div class="col-md-10">

<div id="no-more-tables" style="padding-top:20px;">


  <table id="example" class="table-bordered table-striped " style="border-collapse:collapse" >


        				<thead>
        			<tr style="background-color:#9F5F9F;color:#FFFFFF;">
                	<th >Sr. No.</th>
                    <th >Gift Card No.</th>
                     <th>Amount</th>
                      <th>Issue Date</th>
                     <th>Validity Date</th>
                    <th>Status</th>

                </tr>
                </thead>



             <?php $i=1;

			 	$sql=mysql_query("SELECT * FROM tbl_giftcards  order by amount desc ");

 while($result=mysql_fetch_array($sql)){

?>
<tr>
<td data-title="Sr.No."><?php echo $i;   ?></td>
<td data-title="Card No."><?php echo  $result['card_no'];?></td>
<td data-title="Amount"><?php echo $result['amount'];?></td>
<td data-title="Issue Date"><?php echo $result['issue_date'];?></td>
<td data-title="Issue Date"><?php echo $result['valid_to'];?></td>
<td data-title="Status"><?php echo $result['status'];?></td>






</tr>
<?php  $i++; }?>

        	</table>
        </div>

</div>

</div>

</div>

</div>

</div>
</div>


</body>
</html>
