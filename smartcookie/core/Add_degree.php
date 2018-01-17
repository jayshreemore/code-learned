<?php
/*
 * @auther(changes) Rohit Pawar rohitp@roseland.com <9595512151>
 * @description Add Degree
 * @date 07/09/2017
 * */
include('scadmin_header.php');
$report = "";
$smartcookie = new smartcookie();
$results = $smartcookie->retrive_individual($table, $fields);
$result = mysql_fetch_array($results);
$sc_id = $result['school_id'];


if (isset($_POST['submit'])) {

    if (empty($_POST["Degee_name"])) {
        $ErrDegeename = "Degee name is required";
    } else {
        $Degee_name = $_POST['Degee_name'];
    }

    if (empty($_POST["Degree_code"])) {
        $ErrDegreecode = "Degree code is required";
    } else {
        $Degree_code = $_POST['Degree_code'];
    }


    if (empty($_POST["course_level"])) {
        $Errcourselevel = "course level name is required";
    } else {
        $course_level = $_POST['course_level'];
    }

    if (empty($_POST["ExtDegreeID"])) {
        $ErrExtDegreeID = "Degree ID code is required";
    } else {
        $ExtDegreeID = $_POST['ExtDegreeID'];
    }

    if ($ExtDegreeID != '' && $course_level != '' && $Degree_code != ''&& $Degee_name != '' ) {
        $sql = mysql_query("SELECT school_id,Degee_name FROM `tbl_degree_master` WHERE `school_id`='$sc_id' and `CourseLevel`='$Degee_name' ");
        $row = mysql_fetch_row($sql);
        if ($row != '') {
            $errorreport = "This degree is already present ";
        } else {
            if(mysql_query("insert into `tbl_degree_master`(ExtDegreeID,Degee_name,Degree_code,course_level,school_id) values('$ExtDegreeID','$Degee_name','$Degree_code','$course_level','$sc_id')")){
                $report="Inserted degree  successfully";
            }else{
                $errorreport="Please Try Again";
            }
        }
    } else {
        $errorreport = "All fields are requird";
    }
}
?>
<html>
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container" style="padding:25px;"" >
<div style="padding:2px 2px 2px 2px;border:1px solid #CCCCCC; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4;background-color:#F8F8F8;">
    <form method="post">

        <div style="background-color:#F8F8F8 ;">
            <div class="row">
                <div class="col-md-12 " align="center" style="color:#663399;">
                    <h2>Add Degree</h2>
                </div>
            </div>

            <div class="row" style="padding-top:30px;">
                <div class="col-md-4"></div>
                <div class="col-md-2" style="color:#808080; font-size:18px;">Degree name<span style="color:red;font-size: 25px;">*</span></div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="Degee_name" id="Degee_name" value="<?php echo $Degee_name;?>">
                </div>
            </div>

            <div class="col-md-4 col-md-offset-5"  style="color:#F00; text-align: center;">
                <span class="error"><?php echo $ErrDegreename; ?></span>
            </div>

            <div class="row" style="padding-top:30px;">
                <div class="col-md-4"></div>
                <div class="col-md-2" style="color:#808080; font-size:18px;"> Degree code<span
                            style="color:red;font-size: 25px;">*</span></div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="Degree_code" id="Degree_code" value="<?php echo $Degree_code; ?>">
                </div>
            </div>

            <div class="col-md-4 col-md-offset-5"  style="color:#F00; text-align: center;">
                <span class="error"><?php echo $ErrDegreecode; ?></span>
            </div>

            <div class="row" style="padding-top:30px;">
                <div class="col-md-4"></div>
                <div class="col-md-2" style="color:#808080; font-size:18px;"> course level<span
                            style="color:red;font-size: 25px;">*</span></div>
                <div class="col-md-3">
                    <select name="course_level" class="form-control" required>
                        <option value="" disabled selected> Select Course Level</option>
                        <?php
                        $sql = "SELECT * FROM `tbl_CourseLevel` WHERE `school_id`='$sc_id'";
                        $query = mysql_query($sql);
                        while ($rows = mysql_fetch_assoc($query)) { ?>
                            <option value="<?php echo $rows['CourseLevel']; ?>" <?php if($rows['CourseLevel']==$course_level){ echo "selected";}else{}?>><?php echo $rows['CourseLevel'];?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-md-4 col-md-offset-5"  style="color:#F00; text-align: center;">
                <span class="error"><?php echo $Errcourselevel; ?></span>
            </div>

            <div class="row" style="padding-top:30px;">
                <div class="col-md-4"></div>
                <div class="col-md-2" style="color:#808080; font-size:18px;">Degree ID<span
                            style="color:red;font-size: 25px;">*</span></div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="ExtDegreeID" id="ExtDegreeID" value="<?php echo $ExtDegreeID; ?>">
                </div>
            </div>

            <div class="col-md-4 col-md-offset-5"  style="color:#F00; text-align: center;">
                <span class="error"><?php echo $ErrExtDegreeID; ?></span>
            </div>

            <div class="row" style="padding-top:60px;">
                <div class="col-md-5"></div>
                <div class="col-md-1"><input type="submit" name="submit" value="Add" class="btn btn-success"></div>
                <div class="col-md-1"><a href="list_school_degree.php"><input type="button" value="Back" class="btn btn-danger"></a></div>
            </div>

            <div class="row" style="padding:30px;padding-left:450px;">
                <div class="col-md-4" style="color:#F00;" align="center" id="error">
                    <b><?php echo $errorreport; ?></b>
                </div>
            </div>
            <div class="row" style="padding:30px;padding-left:450px;">
                <div class="col-md-4" style="color:#008000;" align="center" id="error">
                    <b><?php echo $report; ?></b>
                </div>
            </div>
        </div>

    </form>

</div>
</body>
</html>
<script>
    $(document).ready(function(){
        $("#alert").click(function(){
            alert("asasdas");
            swal(
                'Oops...',
                'Something went wrong!',
                'error'
            )
        });
    });


</script>
