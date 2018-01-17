<?php
    $class = "";
    include("scadmin_header.php");
    if (isset($_GET["class"])) {
        $class_id = $_GET["class"];
        $sql1 = "select * from Class where id='$class_id'";
        $row = mysql_query($sql1);
        $arr = mysql_fetch_array($row);
        $class = $arr['class'];
        $ClassID = $arr['ExtClassID'];
        $CourseLevel = $arr['course_level'];
        $id = $_SESSION['id'];
        $fields = array("id" => $id);
        $table = "tbl_school_admin";
        $smartcookie = new smartcookie();
        $results = $smartcookie->retrive_individual($table, $fields);
        $result = mysql_fetch_array($results);
        $sc_id = $result['school_id'];
        // GET FORM DATA
        if (isset($_POST['submit'])) {
            $class_new = $_POST['class'];

            if (empty($_POST["Class"])) {
                $ErrClass = "Class Name is required";
            } else {
                $Class = $_POST['Class'];
            }


            if (empty($_POST["ClassID"])) {
                $ErrClassID = "ClassID  is required";
            } else {
                $ClassID = $_POST['ClassID'];
            }


            if (empty($_POST["CourseLevel"])) {
                $ErrCourseLevel = "CourseLevel is required";
            } else {
                $CourseLevel = $_POST['CourseLevel'];
            }


            if ($Class != '' && $ClassID != '' && $CourseLevel != '') {
                $sql = mysql_query("SELECT school_id,class FROM `Class` WHERE `school_id`='$sc_id' and `class`='$Class'");
                $row = mysql_fetch_row($sql);
                if ($row != '') {
                    $errorreport = "This Class is already present ";
                } else {

                    //echo "update Class set class='$Class', ExtClassID = '$ClassID' ,course_level='$CourseLevel' where id=$class_id";
                    // Update New Class

                    if(mysql_query("update Class set class='$Class', ExtClassID = '$ClassID' ,course_level='$CourseLevel' where id=$class_id")){
                        $report="Updated data successfully";
                    }else{

                        $errorreport="Please Try Again";
                    }
                }
            } else {
                $errorreport = "All fields are requird";
            }



           /* $row = mysql_query("select id,class from Class  where class like '%$class_new%' and school_id='$sc_id' ");
            if (mysql_num_rows($row) <= 0) {
                $rows = mysql_query("update Class set class='$class_new' where id=$class_id");
                if (mysql_affected_rows() > 0) {
                    $successreport = "Class is successfully updated !!!";
                    header("Location:list_school_class.php?successreport=" . $successreport);
                }
            } else {
                $errorreport = "class " . $class_new . " is already present.";
            }*/




        } ?>
        <html>
        <head>
            <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
        </head>
        <body align="center">
        <div class="container" style="padding:10px;" align="center">
            <div class="row">
                <div class="col-md-3">
                </div>
                <div style="padding:2px -20px 122px -42px;border:0px solid #CCCCCC; border:0px solid #CCCCCC;box-shadow: 0px 1px 1px 1px #C3C3C4;">
                    <div class="container">
                        <div style="padding:2px 2px 2px 2px;border:1px solid #CCCCCC; border:0px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4;background-color:#F8F8F8 ;">
                            <form method="post">
                                <div style="background-color:#F8F8F8 ;">
                                    <div class="row">
                                        <div class="col-md-12 " align="center" style="color:#663399;">
                                            <h2>Update Class</h2>
                                        </div>
                                    </div>

                                    <div class="row" style="padding-top:30px;">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-2" style="color:#808080; font-size:18px;"> Class<span
                                                    style="color:red;font-size: 25px;">*</span></div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="Class" id="Class" value="<?php echo $class;?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-md-offset-5"  style="color:#F00; text-align: center;">
                                        <span class="error"><?php echo $ErrClass; ?></span>
                                    </div>

                                    <div class="row" style="padding-top:30px;">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-2" style="color:#808080; font-size:18px;"> ClassID<span
                                                    style="color:red;font-size: 25px;">*</span></div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="ClassID" id="ClassID" value="<?php echo $ClassID; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-md-offset-5"  style="color:#F00; text-align: center;">
                                        <span class="error"><?php echo $ErrClassID; ?></span>
                                    </div>

                                    <div class="row" style="padding-top:30px;">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-2" style="color:#808080; font-size:18px;"> CourseLevel<span
                                                    style="color:red;font-size: 25px;">*</span></div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="CourseLevel" id="CourseLevel" value="<?php echo $CourseLevel; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-md-offset-5" id="errordept" style="color:#F00; text-align: center;">
                                        <span class="error"><?php echo $ErrCourseLevel; ?></span>
                                    </div>

                                    <div class="row" style="padding-top:35px;padding-left:350px;">
                                        <div class="col-md-2 col-md-offset-2 ">
                                            <input type="submit" class="btn btn-primary" name="submit" value="Update" style="width:80px;font-weight:bold;font-size:14px;" "/>
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
                </div>
            </div>
        </div>
        </div>
        </body>
        </html>
    <?php }

?>

