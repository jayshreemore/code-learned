<?php
include("cookieadminheader.php");
if (isset($_POST['search'])) {
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $person_id = $_POST['person_id'];
    $category = $_POST['category'];
    $_SESSION['category'] = $category;
    $_SESSION['person_id'] = $person_id;

    if ($from_date != '' && $to_date != '' && $person_id != '') {
   // $sql="SELECT sp.id,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,c.category from tbl_sponsorer sp  join categories c on sp.v_category=c.id  where sp.sales_person_id='$person_id'  and sp.sp_date between '$from_date' and '$to_date' ";
		//echo "SELECT sp.sp_name,sp.sp_img_path,sp.id,sp.source,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,sp.v_category,sp.v_responce_status,sp.comment,sp.calback_date_time,sp.v_status,sp.lat,sp.lon,sp.sales_p_lat,sp.sales_p_lon,sp.entity_id,sp.user_member_id,sp.platform_source,sp.app_version,sp.payment_method,sp.sp_country,sp.calculated_lat,sp.calculated_lon from tbl_sponsorer sp where sp.sales_person_id='$person_id'  and sp.sp_date between '$from_date' and '$to_date' and sp.sp_date!=''";
		$sql = "SELECT sp.sp_name,sp.sp_img_path,sp.id,sp.source,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,sp.v_category,sp.v_responce_status,sp.comment,sp.calback_date_time,sp.v_status,sp.lat,sp.lon,sp.sales_p_lat,sp.sales_p_lon,sp.entity_id,sp.user_member_id,sp.platform_source,sp.app_version,sp.payment_method,sp.sp_country,sp.calculated_lat,sp.calculated_lon from tbl_sponsorer sp where sp.sales_person_id='$person_id'  and sp.sp_date between '$from_date' and '$to_date' and sp.sp_date!=''";
    }
    if ($from_date != '' && $to_date != '' && $person_id == '') {
			//$sql="SELECT sp.id,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,c.category from tbl_sponsorer sp join categories c on sp.v_category=c.id where sp.sp_date between '$from_date' and '$to_date' ";
	//echo "SELECT sp.sp_name,sp.sp_img_path,sp.id,sp.source,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,sp.v_category,sp.v_responce_status,sp.comment,sp.calback_date_time,sp.v_status,sp.lat,sp.lon,sp.sales_p_lat,sp.sales_p_lon,sp.entity_id,sp.user_member_id,sp.platform_source,sp.app_version,sp.payment_method,sp.sp_country,sp.calculated_lat,sp.calculated_lon from tbl_sponsorer sp where sp.sp_date between '$from_date' and '$to_date' and sp.sp_date!=''";
		$sql = "SELECT sp.sp_name,sp.sp_img_path,sp.id,sp.source,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,sp.v_category,sp.v_responce_status,sp.comment,sp.calback_date_time,sp.v_status,sp.lat,sp.lon,sp.sales_p_lat,sp.sales_p_lon,sp.entity_id,sp.user_member_id,sp.platform_source,sp.app_version,sp.payment_method,sp.sp_country,sp.calculated_lat,sp.calculated_lon from tbl_sponsorer sp where sp.sp_date between '$from_date' and '$to_date' and sp.sp_date!=''";
    }
    if (($from_date == '' || $to_date == '') && $person_id != '') {
        //$sql="SELECT sp.id,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,c.category from tbl_sponsorer sp  join categories c on sp.v_category=c.id  where sp.sales_person_id='$person_id' ";
		//echo "SELECT sp.sp_name,sp.sp_img_path,sp.id,sp.source,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,sp.v_category,sp.v_responce_status,sp.comment,sp.calback_date_time,sp.v_status,sp.lat,sp.lon,sp.sales_p_lat,sp.sales_p_lon,sp.entity_id,sp.user_member_id,sp.platform_source,sp.app_version,sp.payment_method,sp.sp_country,sp.calculated_lat,sp.calculated_lon from tbl_sponsorer sp  where sp.sales_person_id='$person_id' and sp.sp_date!=''";
		$sql = "SELECT sp.sp_name,sp.sp_img_path,sp.id,sp.source,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,sp.v_category,sp.v_responce_status,sp.comment,sp.calback_date_time,sp.v_status,sp.lat,sp.lon,sp.sales_p_lat,sp.sales_p_lon,sp.entity_id,sp.user_member_id,sp.platform_source,sp.app_version,sp.payment_method,sp.sp_country,sp.calculated_lat,sp.calculated_lon from tbl_sponsorer sp  where sp.sales_person_id='$person_id' and sp.sp_date!=''";
    }
    if (($from_date == $to_date) && $person_id != '' && $from_date != '') {
        
		//$sql="SELECT sp.id,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,c.category from tbl_sponsorer sp  join categories c on sp.v_category=c.id  where sp.sales_person_id='$person_id'  and sp.sp_date = '$from_date'";
		//echo "SELECT sp.sp_name,sp.sp_img_path,sp.id,sp.source,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,sp.v_category,sp.v_responce_status,sp.comment,sp.calback_date_time,sp.v_status,sp.lat,sp.lon,sp.sales_p_lat,sp.sales_p_lon,sp.entity_id,sp.user_member_id,sp.platform_source,sp.app_version,sp.payment_method,sp.sp_country,sp.calculated_lat,sp.calculated_lon from tbl_sponsorer sp where sp.sales_person_id='$person_id'  and sp.sp_date = '$from_date' and sp.sp_date!=''";
		$sql = "SELECT sp.sp_name,sp.sp_img_path,sp.id,sp.source,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,sp.v_category,sp.v_responce_status,sp.comment,sp.calback_date_time,sp.v_status,sp.lat,sp.lon,sp.sales_p_lat,sp.sales_p_lon,sp.entity_id,sp.user_member_id,sp.platform_source,sp.app_version,sp.payment_method,sp.sp_country,sp.calculated_lat,sp.calculated_lon from tbl_sponsorer sp where sp.sales_person_id='$person_id'  and sp.sp_date = '$from_date' and sp.sp_date!=''";
    }
    if (($from_date == $to_date) && $person_id == '' && $from_date != '') {
		//$sql="SELECT sp.id,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,c.category from tbl_sponsorer sp  join categories c on sp.v_category=c.id  where sp.sp_date = '$from_date'";
   // echo "SELECT sp.sp_name,sp.sp_img_path,sp.id,sp.source,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,sp.v_category,sp.v_responce_status,sp.comment,sp.calback_date_time,sp.v_status,sp.lat,sp.lon,sp.sales_p_lat,sp.sales_p_lon,sp.entity_id,sp.user_member_id,sp.platform_source,sp.app_version,sp.payment_method,sp.sp_country,sp.calculated_lat,sp.calculated_lon from tbl_sponsorer sp  where sp.sp_date = '$from_date' and sp.sp_date!=''";
	   $sql = "SELECT sp.sp_name,sp.sp_img_path,sp.id,sp.source,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,sp.v_category,sp.v_responce_status,sp.comment,sp.calback_date_time,sp.v_status,sp.lat,sp.lon,sp.sales_p_lat,sp.sales_p_lon,sp.entity_id,sp.user_member_id,sp.platform_source,sp.app_version,sp.payment_method,sp.sp_country,sp.calculated_lat,sp.calculated_lon from tbl_sponsorer sp  where sp.sp_date = '$from_date' and sp.sp_date!=''";
    }
    if ($from_date == "" && $to_date == "" && $person_id == "") {
        
		//$sql="SELECT sp.id,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,c.category from tbl_sponsorer sp  join categories c on sp.v_category=c.id ";
		
		//echo  "SELECT sp.sp_name,sp.sp_img_path,sp.id,sp.source,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,sp.v_category,sp.v_responce_status,sp.comment,sp.calback_date_time,sp.v_status,sp.lat,sp.lon,sp.sales_p_lat,sp.sales_p_lon,sp.entity_id,sp.user_member_id,sp.platform_source,sp.app_version,sp.payment_method,sp.sp_country,sp.calculated_lat,sp.calculated_lon from tbl_sponsorer sp";
		$sql = "SELECT sp.sp_name,sp.sp_img_path,sp.id,sp.source,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,sp.v_category,sp.v_responce_status,sp.comment,sp.calback_date_time,sp.v_status,sp.lat,sp.lon,sp.sales_p_lat,sp.sales_p_lon,sp.entity_id,sp.user_member_id,sp.platform_source,sp.app_version,sp.payment_method,sp.sp_country,sp.calculated_lat,sp.calculated_lon from tbl_sponsorer sp";
    }

   /* if ($category != '') {
        $sql .= "and sp.v_category='$category' order by sp.id desc";
    }
    if ($category == '') {
        $sql .= "order by sp.id desc";
    }
	
	*/
	
	
//echo $sql;

    $row = mysql_query($sql);
//    $result = mysql_fetch_array($row);
//    var_dump($result);
//    die;
    $count1 = mysql_num_rows($row);
} else {
	
    //$sql="SELECT sp.id,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,c.category from tbl_sponsorer sp left join categories c on sp.v_category=c.id order by sp.id desc";
	
	//echo  "SELECT sp.sp_name,sp.sp_img_path,sp.id,sp.source,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,sp.v_category,sp.v_responce_status,sp.comment,sp.calback_date_time,sp.v_status,sp.lat,sp.lon,sp.sales_p_lat,sp.sales_p_lon,sp.entity_id,sp.user_member_id,sp.platform_source,sp.app_version,sp.payment_method,sp.sp_country,sp.calculated_lat,sp.calculated_lon from tbl_sponsorer sp order by sp.id desc";
 
	$sql = "SELECT sp.sp_name,sp.sp_img_path,sp.id,sp.source,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,sp.v_category,sp.v_responce_status,sp.comment,sp.calback_date_time,sp.v_status,sp.lat,sp.lon,sp.sales_p_lat,sp.sales_p_lon,sp.entity_id,sp.user_member_id,sp.platform_source,sp.app_version,sp.payment_method,sp.sp_country,sp.calculated_lat,sp.calculated_lon from tbl_sponsorer sp order by sp.id desc";
 
   $row = mysql_query($sql);
  
	
	
	$count1= mysql_num_rows($row);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Sponsor List</title>
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
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
            #no-more-tables tr {
                border: 1px solid #ccc;
            }
            #no-more-tables td {
                /* Behave  like a "row" */
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
                white-space: normal;
                text-align: left;
                font: Arial, Helvetica, sans-serif;
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
                text-align: left;
            }
            /*
            Label the data
            */
            #no-more-tables td:before {
                content: attr(data-title);
            }
        }
    </style>
    <script>
        $(function () {
            $("#from_date").datepicker({
               // changeMonth: true,
                //changeYear: true
				dateFormat: 'yy-mm-dd',
            });
        });
        $(function () {
            $("#to_date").datepicker({
                //changeMonth: true,
                //changeYear: true,
				dateFormat: 'yy-mm-dd',
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#example').dataTable()
            ({});
        });
    </script>
    <script language="javascript" type="text/javascript">
        function printDiv(divID) {
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;
            //Reset the page's HTML with div's HTML only
            document.body.innerHTML =
                "<html><head><title></title></head><body><center>" +
                divElements + "</center></body>";
            //Print Page
            window.print();
            //Restore orignal HTML
            document.body.innerHTML = oldPage;
        }
    </script>
</head>
<body bgcolor="#CCCCCC">
<div align="center">
    <div class="row" style="padding-top:60px;">
        <div style="width:100%;">
            <div >
                <h2 style="padding-left:55px; margin-top:2px;color:#666">Summary of Sales person</h2>
            </div>
        </div>
        <form method="post">
            <div class="col-md-2" style="font-weight:bold; margin-right:-52px;margin-left:-3%"> Person Name</div>
            <div class="col-md-2" style="width:17%;">
                <select name="person_id" class="form-control">
                    <?php $query = mysql_query("select person_id,p_name from tbl_salesperson"); ?>
                    <option value="">Select</option>
                    <?php $j = 1;
                    while ($test = mysql_fetch_array($query)) {
                        ?>
                        <option value="<?php echo $test['person_id'] ?>" <?php if (($_SESSION['person_id']) == $test['person_id']) {
                            echo $_POST['person_id']; ?> selected="selected" <?php } ?>><?php echo $test['p_name']; ?></option>
                        <?php $j++;
                    }
                    ?>
                </select></div>
<!--            <div class="col-md-1" style="font-weight:bold; margin-right:-36px;"> Category</div>-->
<!--            <div class="col-md-2" style="width:17%;">-->
<!--                <select name="category" class="form-control">-->
<!--                    --><?php //$query1 = mysql_query("select id,category from categories"); ?>
<!--                    <option value="">Select</option>-->
<!--                    --><?php //$k = 1;
//                    while ($test1 = mysql_fetch_array($query1)) {
//                        ?>
<!--                        <option value="--><?php //echo $test1['id'] ?><!--" --><?php //if (($_SESSION['category']) == $test1['id']) {
//                            echo $_POST['category']; ?><!-- selected="selected" --><?php //} ?><!-- >--><?php //echo $test1['category']; ?><!--</option>-->
<!--                        --><?php //$k++;
//                    }
//                    ?>
<!--                </select>-->
<!--            </div>-->
            <div class="col-md-1" style="font-weight:bold; margin-right:-36px;"> from</div>
            <div class="col-md-1" style="width:13%;">
                <input type="text" id="from_date" name="from_date" placeholder="MM/DD/YYYY" class="form-control" value="<?php if (isset($_POST['from_date'])) {echo $_POST['from_date'];} ?>"></div>
            <div class="col-md-1" style="font-weight:bold; margin-right:-54px;margin-left:-28px;"> To</div>
            <div class="col-md-1" style="width:13%;">
                <input type="text" id="to_date" name="to_date" placeholder="MM/DD/YYYY" class="form-control" value="<?php if (isset($_POST['to_date'])) {echo $_POST['to_date'];} ?>">
            </div>
            <div class="col-md-1"><input type="submit" name="search" value="Search" class="btn btn-primary"></div>
            <?php if (isset($_POST['search']) && $count1 != 0) {?>
                <div class="col-md-1"><input type="submit" name="report" value="Report" class="btn btn-primary" onClick="javascript:printDiv('printablediv')"></div>
            <?php } ?>
        </form>
    </div>


        <div id="no-more-tables" style="padding-top:20px;">
            <table id="example" class="col-md-12 table-bordered ">
                <thead>
                <tr style="background-color:#CCCCCC; color:#000000; height:30px;">
                    <th>Sr. No.</th>
                    <th> Reg.Date</th>
<!--                    <th>Sponsor Address</th>-->
<!--                    <th>Sponsor Category</th>-->
<!--                    <th>Email ID</th>-->
<!--                    <th> Phone No.</th>-->
                    <th> Salesperson Name</th>
                    <th>Sponosor Name</th>
					<th> Amount</th>
                    <th>Cash Payment</th>
                    <th>Cheque Payment</th>
                    <th>Free Registor</th>
                </tr>
                </thead>
                <?php 
				$i = 1;
				$total = 0;
				$cash1 = 0;
				$cheque1 = 0;
				$free1 = 0;
                $chequeamount = 0;
                $cashamount = 0;
                while ($result = mysql_fetch_array($row)){
                ?>
                <tr>
                    <td data-title="Sr.No."><?php echo $i; ?></td>
                    <td data-title="Reg.Date"><?php echo $result['sp_date']; ?></td>

<!--                    <td data-title="Address">--><?php //echo $result['sp_address']; ?><!--</td>-->
<!--                    <td data-title="Address">--><?php //echo $result['category']; ?><!--</td>-->
<!--                    <td data-title="Email ID">--><?php //echo $result['sp_email']; ?><!--</td>-->
<!--                    <td data-title="Phone No">--><?php //echo $result['sp_phone']; ?><!--</td>-->
                    <td data-title="Reg.Date"><?php
                        $sp_id = $result['sales_person_id'];
                        if ($sp_id == 0) {
                            echo "NA";
                        } else {
                            $sql2 = mysql_query("select * from tbl_salesperson where person_id='$sp_id'");
                            $sql3 = mysql_fetch_array($sql2);
                            echo $sql3['p_name'];
                        } ?></td>
                    <td data-title="Sponsor Name"><?php echo $result['sp_company']; ?></td>
                  
                    
					<td data-title="amount"><?php if ($result['amount'] == "" or $result['amount'] == 0) {
                            $amount = "0";
                        } else {
                            $amount = $result['amount'];
							$row1 = $row;
							$total = $total + $result['amount'];
							 if($result['payment_method'] == "Cash"){
                                            $cashamount1 = $cashamount1 + $result['amount'];
                                        }elseif ($result['payment_method'] == "Cheque"){
                                            $chequeamount1 = $chequeamount1 + $result['amount'];
                                        }
										
                        }
                        echo $amount; ?></td>
					
					<td data-title="Cash Payment"><?php if($result['payment_method'] == "Cash") { echo "Cash";$cash1++;}else{ echo"";} ?></td>
                    <td data-title="Cheque Payment"><?php if($result['payment_method'] == "Cheque") { echo "Cheque";$cheque1++;}else{ echo"";}  ?></td>
                    <td data-title="Free Registor"><?php if($result['payment_method'] == "Free Register") { echo "Free Registor";$free1++;}else{ echo"";} ?></td>
						
                    <?php $i++;
                    }
					
                    ?>
            </table>
			<?php
			//echo $total;
			?>
        </div>
		
		
		
		<div class="row">
                     <br><br>
                    <TABLE BORDER="1"    WIDTH="10%"  >
                        <caption style="background-color:lightgray"><b>SUMMARY REPORT SALESPERSON<b></caption>
                        <TR>
                            <TH>TOTAL SPONSOR</TH>
                            <TH>BY CASH</TH>
                            <TH>CASH AMOUNT</TH>
                            <TH>BY CHEQUE</TH>
                            <TH>CHEQUE AMOUNT</TH>
                            <TH>FREE REGISTOR</TH>
                            <TH>TOTAL AMOUNT</TH>
                        </TR>
                        <TR ALIGN="CENTER">
                            <TD><?php echo $count1; ?></TD>
                            <TD><?php echo $cash1; ?></TD>
                            <TD><?php echo $cashamount1; ?></TD>
                            <TD><?php echo $cheque1; ?></TD>
                            <TD><?php echo $chequeamount1; ?></TD>
                            <TD><?php echo $free1; ?></TD>
                            <TD><?php echo $total; ?></TD>
                        </TR>
                    </TABLE>
					<br>
				</div>
				
				
				
        <div class="printablediv" id="printablediv" style="display:none;">
            <div class="container" style="border-width:2px;border-style: solid;">
                <div class="row" style="padding-top:20px;" align="center">
                    <h2> Sponsor Registered List </h2>
                </div>
                <div class="row" style="padding-left:20px;" align="center">
                    <h3><?php
                        if (isset($_POST['person_id'])) {
                            $p_id = $_POST['person_id'];
                            $query1 = mysql_query("select p_name from tbl_salesperson where person_id='$p_id'");
                            $test1 = mysql_fetch_array($query1);
                            echo $test1['p_name'];
                        }
                        ?> </h3>
                </div>
                <div class="row" style="padding-top:10px;padding-left:20px;" align="center">
                    <h4><?php
                        $from_date = $_POST['from_date'];
                        echo $_POST['from_date']; ?> &nbsp;&nbsp; To &nbsp;&nbsp;<?php $to_date = $_POST['to_date'];
                        echo $_POST['to_date']; ?></h4>
                </div>
                <div class="row" align="center" style="padding-top:20px;">
                    <table bordercolor="rgb(6,79,168)" border="2" style="border-style:solid;padding:5px;"
                           cellspacing="5">
                        <thead>
                        <tr>
                            <th width="7%"><font face="tahoma" color="rgb(6,79,168)">Sr.No.</font></th>
                            <th width="10%"><font face="tahoma" color="rgb(6,79,168)">Registered Date</font></th>
<!--                            <th width="20%"><font face="tahoma" color="rgb(6,79,168)">Sponsor Name</font></th>-->
<!--                            <th width="30%"><font face="tahoma" color="rgb(6,79,168)">Sponsor Address</font></th>-->
<!--                            <th width="15%"><font face="tahoma" color="rgb(6,79,168)">Category</font></th>-->
<!--                            <th width="15%"><font face="tahoma" color="rgb(6,79,168)">Email ID</font></th>-->
<!--                            <th width="10%"><font face="tahoma" color="rgb(6,79,168)">Phone No</font></th>-->
                            <th width="10%"><font face="tahoma" color="rgb(6,79,168)">Amount</font></th> 
                            <th width="10%"><font face="tahoma" color="rgb(6,79,168)">Cash Payment</font></th> 
                            <th width="10%"><font face="tahoma" color="rgb(6,79,168)">Cheque Payment</font></th> 
                            <th width="10%"><font face="tahoma" color="rgb(6,79,168)">Free Registor</font></th> 
				
                        </thead>
                        </tr>
                        <?php
                        if ($from_date != '' && $to_date != '' && $person_id != '') {
   // $sql="SELECT sp.id,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,c.category from tbl_sponsorer sp  join categories c on sp.v_category=c.id  where sp.sales_person_id='$person_id'  and sp.sp_date between '$from_date' and '$to_date' ";
		//echo "SELECT sp.sp_name,sp.sp_img_path,sp.id,sp.source,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,sp.v_category,sp.v_responce_status,sp.comment,sp.calback_date_time,sp.v_status,sp.lat,sp.lon,sp.sales_p_lat,sp.sales_p_lon,sp.entity_id,sp.user_member_id,sp.platform_source,sp.app_version,sp.payment_method,sp.sp_country,sp.calculated_lat,sp.calculated_lon from tbl_sponsorer sp where sp.sales_person_id='$person_id'  and sp.sp_date between '$from_date' and '$to_date' and sp.sp_date!=''";
		$sql = "SELECT sp.sp_name,sp.sp_img_path,sp.id,sp.source,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,sp.v_category,sp.v_responce_status,sp.comment,sp.calback_date_time,sp.v_status,sp.lat,sp.lon,sp.sales_p_lat,sp.sales_p_lon,sp.entity_id,sp.user_member_id,sp.platform_source,sp.app_version,sp.payment_method,sp.sp_country,sp.calculated_lat,sp.calculated_lon from tbl_sponsorer sp where sp.sales_person_id='$person_id'  and sp.sp_date between '$from_date' and '$to_date' and sp.sp_date!=''";
    }
    if ($from_date != '' && $to_date != '' && $person_id == '') {
			//$sql="SELECT sp.id,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,c.category from tbl_sponsorer sp join categories c on sp.v_category=c.id where sp.sp_date between '$from_date' and '$to_date' ";
	//echo "SELECT sp.sp_name,sp.sp_img_path,sp.id,sp.source,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,sp.v_category,sp.v_responce_status,sp.comment,sp.calback_date_time,sp.v_status,sp.lat,sp.lon,sp.sales_p_lat,sp.sales_p_lon,sp.entity_id,sp.user_member_id,sp.platform_source,sp.app_version,sp.payment_method,sp.sp_country,sp.calculated_lat,sp.calculated_lon from tbl_sponsorer sp where sp.sp_date between '$from_date' and '$to_date' and sp.sp_date!=''";
		$sql = "SELECT sp.sp_name,sp.sp_img_path,sp.id,sp.source,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,sp.v_category,sp.v_responce_status,sp.comment,sp.calback_date_time,sp.v_status,sp.lat,sp.lon,sp.sales_p_lat,sp.sales_p_lon,sp.entity_id,sp.user_member_id,sp.platform_source,sp.app_version,sp.payment_method,sp.sp_country,sp.calculated_lat,sp.calculated_lon from tbl_sponsorer sp where sp.sp_date between '$from_date' and '$to_date' and sp.sp_date!=''";
    }
    if (($from_date == '' || $to_date == '') && $person_id != '') {
        //$sql="SELECT sp.id,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,c.category from tbl_sponsorer sp  join categories c on sp.v_category=c.id  where sp.sales_person_id='$person_id' ";
		//echo "SELECT sp.sp_name,sp.sp_img_path,sp.id,sp.source,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,sp.v_category,sp.v_responce_status,sp.comment,sp.calback_date_time,sp.v_status,sp.lat,sp.lon,sp.sales_p_lat,sp.sales_p_lon,sp.entity_id,sp.user_member_id,sp.platform_source,sp.app_version,sp.payment_method,sp.sp_country,sp.calculated_lat,sp.calculated_lon from tbl_sponsorer sp  where sp.sales_person_id='$person_id' and sp.sp_date!=''";
		$sql = "SELECT sp.sp_name,sp.sp_img_path,sp.id,sp.source,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,sp.v_category,sp.v_responce_status,sp.comment,sp.calback_date_time,sp.v_status,sp.lat,sp.lon,sp.sales_p_lat,sp.sales_p_lon,sp.entity_id,sp.user_member_id,sp.platform_source,sp.app_version,sp.payment_method,sp.sp_country,sp.calculated_lat,sp.calculated_lon from tbl_sponsorer sp  where sp.sales_person_id='$person_id' and sp.sp_date!=''";
    }
    if (($from_date == $to_date) && $person_id != '' && $from_date != '') {
        
		//$sql="SELECT sp.id,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,c.category from tbl_sponsorer sp  join categories c on sp.v_category=c.id  where sp.sales_person_id='$person_id'  and sp.sp_date = '$from_date'";
		//echo "SELECT sp.sp_name,sp.sp_img_path,sp.id,sp.source,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,sp.v_category,sp.v_responce_status,sp.comment,sp.calback_date_time,sp.v_status,sp.lat,sp.lon,sp.sales_p_lat,sp.sales_p_lon,sp.entity_id,sp.user_member_id,sp.platform_source,sp.app_version,sp.payment_method,sp.sp_country,sp.calculated_lat,sp.calculated_lon from tbl_sponsorer sp where sp.sales_person_id='$person_id'  and sp.sp_date = '$from_date' and sp.sp_date!=''";
		$sql = "SELECT sp.sp_name,sp.sp_img_path,sp.id,sp.source,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,sp.v_category,sp.v_responce_status,sp.comment,sp.calback_date_time,sp.v_status,sp.lat,sp.lon,sp.sales_p_lat,sp.sales_p_lon,sp.entity_id,sp.user_member_id,sp.platform_source,sp.app_version,sp.payment_method,sp.sp_country,sp.calculated_lat,sp.calculated_lon from tbl_sponsorer sp where sp.sales_person_id='$person_id'  and sp.sp_date = '$from_date' and sp.sp_date!=''";
    }
    if (($from_date == $to_date) && $person_id == '' && $from_date != '') {
		//$sql="SELECT sp.id,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,c.category from tbl_sponsorer sp  join categories c on sp.v_category=c.id  where sp.sp_date = '$from_date'";
    //echo "SELECT sp.sp_name,sp.sp_img_path,sp.id,sp.source,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,sp.v_category,sp.v_responce_status,sp.comment,sp.calback_date_time,sp.v_status,sp.lat,sp.lon,sp.sales_p_lat,sp.sales_p_lon,sp.entity_id,sp.user_member_id,sp.platform_source,sp.app_version,sp.payment_method,sp.sp_country,sp.calculated_lat,sp.calculated_lon from tbl_sponsorer sp  where sp.sp_date = '$from_date' and sp.sp_date!=''";
	   $sql = "SELECT sp.sp_name,sp.sp_img_path,sp.id,sp.source,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,sp.v_category,sp.v_responce_status,sp.comment,sp.calback_date_time,sp.v_status,sp.lat,sp.lon,sp.sales_p_lat,sp.sales_p_lon,sp.entity_id,sp.user_member_id,sp.platform_source,sp.app_version,sp.payment_method,sp.sp_country,sp.calculated_lat,sp.calculated_lon from tbl_sponsorer sp  where sp.sp_date = '$from_date' and sp.sp_date!=''";
    }
    if ($from_date == "" && $to_date == "" && $person_id == "") {
        
		//$sql="SELECT sp.id,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,c.category from tbl_sponsorer sp  join categories c on sp.v_category=c.id ";
		
		//echo  "SELECT sp.sp_name,sp.sp_img_path,sp.id,sp.source,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,sp.v_category,sp.v_responce_status,sp.comment,sp.calback_date_time,sp.v_status,sp.lat,sp.lon,sp.sales_p_lat,sp.sales_p_lon,sp.entity_id,sp.user_member_id,sp.platform_source,sp.app_version,sp.payment_method,sp.sp_country,sp.calculated_lat,sp.calculated_lon from tbl_sponsorer sp";
		$sql = "SELECT sp.sp_name,sp.sp_img_path,sp.id,sp.source,sp.sp_company,sp.sp_address,sp.sp_email,sp.sp_phone,sp.sp_website,sp.sp_date,sp.amount,sp.sales_person_id,sp.v_category,sp.v_responce_status,sp.comment,sp.calback_date_time,sp.v_status,sp.lat,sp.lon,sp.sales_p_lat,sp.sales_p_lon,sp.entity_id,sp.user_member_id,sp.platform_source,sp.app_version,sp.payment_method,sp.sp_country,sp.calculated_lat,sp.calculated_lon from tbl_sponsorer sp";
    }

                        if ($category == '') {
                            $sql .= "order by sp.id desc";
                        }
                        //$row=mysql_query($sql);
                        //$count1=mysql_num_rows($row);
                        //$query = "SELECT id,sp_company,sp_address,sp_email,sp_phone,sp_website,sp_date,amount,sales_person_id from tbl_sponsorer  where sales_person_id='$p_id'  and sp_date between '$from_date' and '$to_date' order by id";
                        $res = mysql_query($sql);
                        $count = mysql_num_rows($res);
                        $i = 1;
						$cash = 0;
						$cheque = 0;
						$free = 0;
                        $chequeamount = 0;
                        $cashamount = 0;
                        while ($test1 = mysql_fetch_array($res)) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $test1['sp_date']; ?></td>
<!--                                <td>--><?php //echo $test1['sp_company']; ?><!--</td>-->
<!--                                <td>--><?php //echo $test1['sp_address']; ?><!--</td>-->
<!--                                <td>--><?php //echo $test1['category']; ?><!--</td>-->
<!--                                <td>--><?php //echo $test1['sp_email']; ?><!--</td>-->
<!--                                <td>--><?php //echo $test1['sp_phone']; ?><!--</td>-->
                                <td data-title="amount"><?php if ($test1['amount'] == "" or $test1['amount'] == 0) {
                                      //  $amount = "Free Registered";
                                        $amount = "0";
                                    } else {
                                        $amount = $test1['amount'];
                                        if($test1['payment_method'] == "Cash"){
                                            $cashamount = $cashamount + $test1['amount'];
                                        }elseif ($test1['payment_method'] == "Cheque"){
                                            $chequeamount = $chequeamount + $test1['amount'];
                                        }
                                    }
                                    echo $amount; ?></td>
									<td data-title="Cash Payment"><?php if($test1['payment_method'] == "Cash") { echo "Cash";$cash++;}else{ echo"";} ?></td>
                                    <td data-title="Cheque Payment"><?php if($test1['payment_method'] == "Cheque") { echo "Cheque";$cheque++;}else{ echo"";}  ?></td>
                                    <td data-title="Free Registor"><?php if($test1['payment_method'] == "Free_Registor") { echo "Free Registor";$free++;}else{ echo"";} ?></td>
                            </tr>
                            <?php $i++;
                        } ?>
                    </table>
					
                </div>
				<div class="row">
                     <br><br>
                    <TABLE BORDER="1"    WIDTH="10%"  >
                        <caption style="background-color:lightgray"><b>SUMMARY REPORT SALESPERSON<b></caption>
                        <TR>
                            <TH>TOTAL SPONSOR</TH>
                            <TH>BY CASH</TH>
                            <TH>CASH AMOUNT</TH>
                            <TH>BY CHEQUE</TH>
                            <TH>CHEQUE AMOUNT</TH>
                            <TH>FREE REGISTOR</TH>
                            <TH>TOTAL AMOUNT</TH>
                        </TR>
                        <TR ALIGN="CENTER">
                            <TD><?php echo $count; ?></TD>
                            <TD><?php echo $cash; ?></TD>
                            <TD><?php echo $cashamount; ?></TD>
                            <TD><?php echo $cheque; ?></TD>
                            <TD><?php echo $chequeamount; ?></TD>
                            <TD><?php echo $free; ?></TD>
                            <TD><?php echo $total; ?></TD>
                        </TR>
                    </TABLE>
					<br>
				</div>
        </div><!-- end of right content-->
    </div>   <!--end of center content -->
</div>
</div>
</div>
</div>
</body>
</html>