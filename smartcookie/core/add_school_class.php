<?php
include('scadmin_header.php');
$id = $_SESSION['id'];
$fields = array("id" => $id);
$table = "tbl_school_admin";
$smartcookie = new smartcookie();
$results = $smartcookie->retrive_individual($table, $fields);
$result = mysql_fetch_array($results);
$sc_id = $result['school_id'];
if (isset($_POST['submit'])) {

    if (empty($_POST["Class"])) {
        $ErrClass = "Class Name is required";
    } else {
        $Class = $_POST['Class'];
    }


    if (empty($_POST["ClassID"])) {
        $ErrClassID = "ClassID  is required";
    } else {
        $ClassID = $_POST['ClassID'];
      //  echo ClassID;
    }


    if (empty($_POST["CourseLevel"])) {
        $ErrCourseLevel = "CourseLevel is required";
    } else {
        $CourseLevel = $_POST['CourseLevel'];
    }


    if ($Class != '' && $ClassID != '' && $CourseLevel != '') 
	{
        $sql = mysql_query("SELECT school_id,class FROM `Class` WHERE `school_id`='$sc_id' and `class`='$Class'");
        $row = mysql_fetch_row($sql);
        if ($row != '') 
		{
            $errorreport = "This Class is already present ";
        } else {
			
            if(mysql_query("INSERT INTO `Class` (ExtClassID,school_id,class,course_level) VALUES ('$ClassID','$sc_id','$Class','$CourseLevel')")){
                $report="Inserted data successfully";
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
<body bgcolor="#CCCCCC">
<div style="bgcolor:#CCCCCC">
    <div class="container" style="padding:25px;">
        <div style="padding:2px 2px 2px 2px;border:1px solid #CCCCCC; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4;">
            <form method="post">
                <div style="background-color:#F8F8F8 ;">
                    <div class="row">
                        <div class="col-md-12 " align="center" style="color:#663399;">
                            <h2>Add Class</h2>
                        </div>
                    </div>

                    <div class="row" style="padding-top:30px;">
                        <div class="col-md-4"></div>
                        <div class="col-md-2" style="color:#808080; font-size:18px;"> Class<span
                                    style="color:red;font-size: 25px;">*</span></div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="Class" id="Class" value="">
                        </div>
                    </div>

                    <div class="col-md-4 col-md-offset-5" id="errordept" style="color:#F00; text-align: center;">
                        <span class="error"><?php echo $ErrClass; ?></span>
                    </div>

                    <div class="row" style="padding-top:30px;">
                        <div class="col-md-4"></div>
                        <div class="col-md-2" style="color:#808080; font-size:18px;"> ClassID<span
                                    style="color:red;font-size: 25px;">*</span></div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="ClassID" id="ClassID" value="">
                        </div>
                    </div>

                    <div class="col-md-4 col-md-offset-5" id="errordept" style="color:#F00; text-align: center;">
                        <span class="error"><?php echo $ErrClassID; ?></span>
                    </div>

                    <div class="row" style="padding-top:30px;">
                        <div class="col-md-4"></div>
                        <div class="col-md-2" style="color:#808080; font-size:18px;"> CourseLevel<span
                                    style="color:red;font-size: 25px;">*</span></div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="CourseLevel" id="CourseLevel" value="">
                        </div>
                    </div>

                    <div class="col-md-4 col-md-offset-5" id="errordept" style="color:#F00; text-align: center;">
                        <span class="error"><?php echo $ErrCourseLevel; ?></span>
                    </div>

					
					<div class="row" style="padding-top:30px;">
                        <div class="col-md-4"></div>
                        <div class="col-md-2" style="color:#808080; font-size:18px;"> Batch ID<span
                                    style="color:red;font-size: 25px;">*</span></div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="Batch ID" id="Batch ID" value="">
                        </div>
                    </div>

                    <div class="col-md-4 col-md-offset-5" id="errordept" style="color:#F00; text-align: center;">
                        <span class="error"><?php echo $ErrBatchID; ?></span>
                    </div>
					
					
					
			
					
					
					
					
					
					
					
                    <div class="row" style="padding-top:35px;padding-left:350px;">
                        <div class="col-md-2 col-md-offset-2 ">
                            <input type="submit" class="btn btn-primary" name="submit" value="Add " style="width:80px;font-weight:bold;font-size:14px;" />
                        </div>

                        <div class="col-md-3 " align="left">
                            <a href="list_school_class.php" style="text-decoration:none;"><input type="button" class="btn btn-primary" name="Back" value="Back" style="width:80px;font-weight:bold;font-size:14px;"/></a>
                        </div>

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
    </div>
</body>
</html>