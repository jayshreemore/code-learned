<?php
$report = "";
include('scadmin_header.php');
$fields = array("id" => $id);
$smartcookie = new smartcookie();
$results = $smartcookie->retrive_individual($table, $fields);
$result = mysql_fetch_array($results);
$sc_id = $result['school_id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>School Admin</title>
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
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
                padding-right: 10px;
                white-space: nowrap;
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
        $(document).ready(function () {

            $('#example').dataTable({});

        });
    </script>
</head>
<html>
<body bgcolor="#CCCCCC">
<div style="bgcolor:#CCCCCC">
    <div>
    </div>
    <div class="container" style="padding:25px;">
        <div style="padding:2px 2px 2px 2px;border:1px solid #CCCCCC; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4;">
            <div style="background-color:#F8F8F8 ;">
                <div class="row">
                    <div class="col-md-3 " style="color:#700000 ;padding:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="add_school_branch.php"> <input type="submit" class="btn btn-primary" name="submit" value="Add Branch" style="width:150px;font-weight:bold;font-size:14px;"/></a>
                    </div>
                    <div class="col-md-5 " align="center" style="color:black;padding:5px;">
                        <h2> College Branches</h2>
                    </div>
                </div>
                <div class="row" style="padding-top:0px;">
                    <div class="col-md-0">
                    </div>
                    <div class="col-md-12 ">
                        <?php $i = 0; ?>
                        <table id="example" class="display" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>
                                    <center>Sr.No</center>
                                </th>

                                <th>
                                    <center>Branch Name</center>
                                </th>

                                <th>
                                    <b>
                                        <center>Branch code</center>
                                    </b>
                                </th>

                                <th>
                                    <b>
                                        <center>Department Name</center>
                                    </b>
                                </th>

                                <th>
                                    <b>
                                        <center>Course Level</center>
                                    </b>
                                </th>

                                <th>
                                    <b>
                                        <center>Degree</center>
                                    </b>
                                </th>

                                <th>
                                    <b>
                                        <center>Edit</center>
                                    </b>
                                </th>

                                <th>
                                    <b>
                                        <center>Delete</center>
                                    </b>
                                </th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            $arr = mysql_query("select ExtBranchId,branch_Name,Branch_code,Dept_Id,Course_Name,degree_code from tbl_branch_master where school_id='$sc_id' ORDER BY id"); ?>
                            <?php while ($row = mysql_fetch_array($arr)) { ?>
                                <tr style="height:40px;">
                                    <th style="width:100px;">
                                            <center><?php echo $i;?></center>
                                    </th>

                                    <th style="width:150px;">
                                        <center> <?php echo $row['branch_Name']; ?></center>
                                    </th>

                                    <th style="width:100px;"><b>
                                            <center><?php echo $row['Branch_code']; ?></center>
                                        </b>
                                    </th>

                                    <th style="width:100px;"><b>
                                            <center><?php $dept_id = $row['Dept_Id'];
                                                $sql = mysql_query("select Dept_Name from  tbl_department_master where Dept_code='$dept_id' and school_id='$sc_id'");
                                                $result = mysql_fetch_array($sql);
                                                $dept_name = $result['Dept_Name'];
                                                echo $dept_name;
                                                ?></center>
                                        </b>
                                    </th>

                                    <th style="width:100px;"><b>
                                            <center><?php echo $row['Course_Name']; ?></center>
                                        </b>
                                    </th>

                                    <th style="width:100px;"><b>
                                            <center><?php $degree_code = $row['degree_code'];
                                                $sql2 = mysql_query("select Degee_name from tbl_degree_master where Degree_code='$degree_code' and school_id='$sc_id'");
                                                $result2 = mysql_fetch_array($sql2);
                                                echo $result2['Degee_name'];
                                                ?></center>
                                        </b>
                                    </th>

                                    <td>
                                        <a class="btn btn-default"
                                           href="#">
                                            <span class="glyphicon glyphicon-pencil"></span></a>
                                    </td>


                                    <td>
                                        <a href="delete_school_branch" class=""  value="<?php echo $rows['id']?>">
                                            <span class="glyphicon glyphicon-trash" ></span>
                                        </a>
                                    </td>

                                </tr>
                                <?php $i++; ?>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row" style="padding:5px;">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-3 " align="center">
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4" style="color:#FF0000;" align="center">
                        <?php if (isset($_GET['report'])) {
                            echo $_GET['report'];
                        } ?>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>

