<?php

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
    <title>Semester</title>
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script>
        $(document).ready(function () {
            $('#example').dataTable({});
        });
    </script>
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
</head>
<body bgcolor="#CCCCCC">
<div style="bgcolor:#CCCCCC">
    <div class="container" style="padding:30px;">
        <div style="border:1px solid #CCCCCC; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4;">
            <div style="background-color:#F8F8F8 ;">
                <div class="row">
                    <div class="col-md-3 " style="color:#700000 ;padding:5px;">&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="Add_degree.php"> <input type="submit" class="btn btn-primary" name="submit" value="Add Degree" style="font-weight:bold;font-size:14px;"/></a>
                    </div>
                    <div class="col-md-6 " align="center">
                        <h2>Degree List </h2>
                    </div>
                </div>
                <div class="row" style="padding:10px;">
                    <div class="col-md-12  " id="no-more-tables">
                        <table id="example" class="display" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Degree ID</th>
                                <th>Degree Name</th>
                                <th>Degree Code</th>
                                <th>Course Level</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $sql = "SELECT * FROM `tbl_degree_master` WHERE `school_id`='$sc_id'";
                            $query = mysql_query($sql);
                            $i=0;
                            while ($rows = mysql_fetch_assoc($query)) { ?>
                                <tr>
                                    <td>
                                        <?php echo $i; ?>
                                    </td>

                                    <td>
                                        <?php echo $rows['ExtDegreeID']; ?>
                                    </td>
                                    <td>
                                        <?php echo $rows['Degee_name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $rows['Degree_code']; ?>
                                    </td>
                                    <td>
                                        <?php echo $rows['course_level']; ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-default"
                                           href="edit_degree.php?degree_id=<?php echo $rows['id']; ?>">
                                            <span class="glyphicon glyphicon-pencil"></span></a>
                                    </td>
                                    <td>
                                        <a href="edit_degree.php?delete_id=<?php echo $rows['id']; ?>" class="confirm" value="<?php echo $rows['id']?>">
                                            <span class="glyphicon glyphicon-trash" ></span>
                                        </a>
                                    </td>
                                </tr>

                            <?php $i++; } ?>
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
                    <div class="col-md-3" style="color:#FF0000;" align="center">
                        <?php echo $report; ?>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>


