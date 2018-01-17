<?php

$report = "";

include('scadmin_header.php');

$id = $_SESSION['id'];

$fields = array("id" => $id);

$table = "tbl_school_admin";


$smartcookie = new smartcookie();


$results = $smartcookie->retrive_individual($table, $fields);

$result = mysql_fetch_array($results);

$sc_id = $result['school_id'];

if (isset($_POST['submit'])) {

    $j = 0;

    $count = $_POST['count'];

    $counts = 0;

    $subcode = $_POST['subcode'];
    $Degee_name = $_POST['Degee_name'];
    $Semester_Name = $_POST['Semester_Name'];

    // Loop to store and display values of individual checked checkbox.


    for ($i = 0; $i < $count; $i++) {

        $subject = ucwords(strtolower($_POST[$i]));


        $results = mysql_query("select * from tbl_school_subject where school_id='$sc_id' and subject like '$subject'");


        if (mysql_num_rows($results) == 0 && $subject != "") {

            $query = "insert into tbl_school_subject (subject,school_id,Subject_Code,Semester_id,Degree_name) values('$subject','$sc_id','$subcode','$Semester_Name','$Degee_name') ";

            $rs = mysql_query($query);

            $subject2[$counts] = $subject;

            $counts++;


        } else {

            $subject1[$j] = $subject;

            $j++;

        }


    }


    $subjects = "";

    if ($counts == 0) {


        for ($i = 0; $i < count($subject1); $i++) {


            if ($j == $i + 1) {

                $subjects = $subjects . " " . $subject1[$i];


            } else {


                $subjects = $subjects . " " . $subject1[$i] . ",";


            }

        }


        if (count($subject1) > 1) {

            $errorreport = $subjects . " subjects are already present . ";

        } else {

            $errorreport = $subject . " subject is already present . ";


        }


    } else if ($counts == 1) {

        $successreport = "You are successfully added " . $subject . " subject ";

    } else {

        for ($i = 0; $i < count($subject2); $i++) {


            if ($counts == $i + 1) {

                $subjects = $subjects . " " . $subject2[$i];

            } else {

                $subjects = $subjects . " " . $subject2[$i] . ",";

            }

        }


        $successreport = "You are successfully added " . $subjects . " subjects";


    }


}


?>

<html>

<head>

    <script>

        var i = 1;

        function create_input() {


            var index = 'E-';

            $("<div class='row formgroup' style='padding:5px;'  ><div class='col-md-3 col-md-offset-4'  ><input type='text' id=" + i + " name=" + i + " class='form-control' placeholder='Enter Subject Code'><input type='text' id=" + i + " name=" + i + " class='form-control' placeholder='Enter Subject Title'><input type='text' id=" + i + " name=" + i + " class='form-control' placeholder='Branch Id'><input type='text' id=" + i + " name=" + i + " class='form-control' placeholder='Degree Name'></div><div class='col-md-3' style='color:#FF0000;' id=" + index + i + " ></div></div>").appendTo('#add');

            i = i + 1;

            document.getElementById("count").value = i;


        }


        function valid() {

            var subject_code = document.getElementById("0").value;
            var subject_name = document.getElementById("1").value;
            var subject_type = document.getElementById("2").value;
            var subject_short_name = document.getElementById("3").value;
            var branch_name = document.getElementById("4").value;
            var degree_name = document.getElementById("5").value;
            var semester_name = document.getElementById("6").value;
            regx1 = /^[A-z0-9]+$/;


            if (subject_code == '') {
                document.getElementById("error").innerHTML = 'Please enter Subject code ';


                return false;

            }
            if (!regx1.test(subject_code)) {
                document.getElementById('error').innerHTML = 'Please enter valid Subject code';
                return false;
            }
            else {
                document.getElementById('error').innerHTML = '';
            }


            if (subject_name == '') {
                document.getElementById("error").innerHTML = 'Please Enter Subject name ';


                return false;

            }

            //validation for name

            if (!regx1.test(subject_name)) {
                document.getElementById('error').innerHTML = 'Please Enter valid Subject name';

                return false;
            }
            else {
                document.getElementById('error').innerHTML = '';
            }


            if (subject_type == '') {
                document.getElementById("error").innerHTML = 'Please Enter Subject Type';


                return false;

            }

            //validation for name

            if (!regx1.test(subject_type)) {
                document.getElementById('error').innerHTML = 'Please Enter valid Subject Type';

                return false;
            }
            else {
                document.getElementById('error').innerHTML = '';
            }


            if (subject_short_name == '') {
                document.getElementById("error").innerHTML = 'Please Enter Subject Short name ';


                return false;

            }

            //validation for name

            if (!regx1.test(subject_short_name)) {
                document.getElementById('error').innerHTML = 'Please Enter valid Subject Short name';

                return false;
            }
            else {
                document.getElementById('error').innerHTML = '';
            }


            if (branch_name == '') {
                document.getElementById("error").innerHTML = 'Please enter branch name ';


                return false;

            }
            if (!regx1.test(branch_name)) {
                document.getElementById('error').innerHTML = 'Please enter valid branch name';

                return false;
            }
            else {
                document.getElementById('error').innerHTML = '';
            }


            if (degree_name == '') {
                document.getElementById("error").innerHTML = 'Please Enter degree name ';


                return false;
            }
            if (!regx1.test(degree_name)) {
                document.getElementById('error').innerHTML = 'Please Enter valid degree name';

                return false;
            }
            else {
                document.getElementById('error').innerHTML = '';
            }


            if (semester_name == '') {
                document.getElementById("error").innerHTML = 'Please enter semester name ';


                return false;

            }
            if (!regx1.test(semester_name)) {
                document.getElementById('error').innerHTML = 'Please enter valid semester name';

                return false;
            }
            else {
                document.getElementById('error').innerHTML = '';
            }


            /*var count=document.getElementById("count").value;



            var index='E-';



            for(var i=0;i<count;i++)

            {

            var values=document.getElementById(i).value;



            if(values==null||values=="")

            {



            document.getElementById(index+i).innerHTML='Please Enter Subject code ';



            return false;

            }

            regx=/^[0-9]*$/;

                //validation of subject



            if(regx.test(values))

            {



            document.getElementById(index+i).innerHTML='Please Enter valid Subject';

            return false;

            }
            }

            */


        }

    </script>

</head>

<body bgcolor="#CCCCCC">

<div style="bgcolor:#CCCCCC">

    <div></div>

    <div class="container" style="padding:25px;"
    " >


    <div style="padding:2px 2px 2px 2px;border:1px solid #CCCCCC; border:1px solid #CCCCCC;box-shadow: 0px 1px 3px 1px #C3C3C4;background-color:#F8F8F8;">

        <form method="post">


            <div class="row">

                <div class="col-md-3 col-md-offset-1" style="color:#700000 ;padding:5px;"></div>

                <div class="col-md-3 " align="center" style="color:#663399;">

                    <h2>Add <?php echo $dynamic_subject;?></h2>


                    <h5 align="center"><a href="Add_SubjectSheet_updated_20160109PT.php">Add Excel Sheet</a></h5>
                    <h5 align="center"><b style="color:red;">All Field Are mandatory</b></h5>

                </div>

            </div>


            <div class="row formgroup" style="padding:5px;">


                <div class="col-md-3 col-md-offset-4">

                    <input type="text" name="0" class="form-control " id="0" placeholder="<?php echo $dynamic_subject;?> name"/>

                </div>

                <br/><br/>

                <div class="col-md-3 col-md-offset-4">

                    <input type="text" name="subcode" class="form-control " id="1" placeholder="<?php echo $dynamic_subject;?> Code"/>

                </div>

                <br/><br/>

                <div class="col-md-3 col-md-offset-4">

                    <input type="text" name="2" class="form-control " id="2" placeholder="<?php echo $dynamic_subject;?> Type"/>

                </div>

                <br/><br/>


                <div class="col-md-3 col-md-offset-4">

                    <input type="text" name="1" class="form-control " id="3" placeholder="<?php echo $dynamic_subject;?> Short Name"/>

                </div>

                <br/><br/>

                <div class="col-md-3 col-md-offset-4">

                    <?php /*?>  <input type="text" name="2" class="form-control " id="4" placeholder="Branch Name"/><?php */ ?>

                    <?php
                    //  echo "gtruyfg";
                    // echo "select distinct  CourseLevel from tbl_CourseLevel where school_id='$sc_id'";
                    $query1 = mysql_query("select distinct branch_Name from tbl_branch_master where school_id='$sc_id'");
                    ?>
                    <select name="BranchName" id="BranchName" class="form-control" onChange="MyAlert(this.value)">
                        <option value="select">Branch Name</option>


                        <?php
                        while ($result1 = mysql_fetch_array($query1)) {
                            ?>


                            <option value=<?php echo $result1['branch_Name']; ?>><?php echo $result1['branch_Name']; ?></option>

                        <?php } ?>

                    </select>


                </div>

                <br/><br/>

                <div class="col-md-3 col-md-offset-4">

                    <?php /*?> <input type="text" name="3" class="form-control " id="5" placeholder="Degree Name"/><?php */ ?>

                    <?php
                    //  echo "gtruyfg";
                    // echo "select distinct  CourseLevel from tbl_CourseLevel where school_id='$sc_id'";
                    $query1 = mysql_query("select distinct Degee_name from tbl_degree_master where school_id='$sc_id'");
                    ?>
                    <select name="Degee_name" id="Degee_name" class="form-control" onChange="MyAlert(this.value)">
                        <option value="select">Degree Name</option>


                        <?php
                        while ($result1 = mysql_fetch_array($query1)) {
                            ?>


                            <option value=<?php echo $result1['Degee_name']; ?>><?php echo $result1['Degee_name']; ?></option>

                        <?php } ?>

                    </select>


                </div>

                <br/><br/>

                <div class="col-md-3 col-md-offset-4">

                    <?php /*?><input type="text" name="4" class="form-control " id="6" placeholder="Semester Name"/><?php */ ?>

                    <?php /*?> <input type="text" name="3" class="form-control " id="5" placeholder="Degree Name"/><?php */ ?>

                    <?php
                    //  echo "gtruyfg";
                    // echo "select distinct  CourseLevel from tbl_CourseLevel where school_id='$sc_id'";
                    $query1 = mysql_query("select distinct Semester_Name from tbl_semester_master where school_id='$sc_id'");
                    ?>
                    <select name="Semester_Name" id="Semester_Name" class="form-control" onChange="MyAlert(this.value)">
                        <option value="select">Semester Name</option>


                        <?php
                        while ($result1 = mysql_fetch_array($query1)) {
                            ?>


                            <option value=<?php echo $result1['Semester_Name']; ?>><?php echo $result1['Semester_Name']; ?></option>

                        <?php } ?>

                    </select>


                </div>

                <div class="col-md-4" id="E-0" style="color:#FF0000;"></div>


            </div>


            <div id="error" style="color:#F00;text-align: center;" align="center"></div>

            <div id="add"></div>


            <div class="row" style="padding-top:15px;">


                <div class="col-md-2 col-md-offset-4 ">

                    <input type="submit" class="btn btn-primary" name="submit" value="Add "
                           style="width:80px;font-weight:bold;font-size:14px;" onClick="return valid()"/>

                </div>


                <div class="col-md-3 " align="left">

                    <a href="list_school_subject.php" style="text-decoration:none;"> <input type="button"
                                                                                            class="btn btn-primary"
                                                                                            name="Back" value="Back"
                                                                                            style="width:80px;font-weight:bold;font-size:14px;"/></a>

                </div>


            </div>


            <div class="row" style="padding-top:15px;">

                <div class="col-md-4">

                    <input type="hidden" name="count" id="count" value="1">

                </div>

                <div class="col-md-11" style="color:#FF0000;" align="center" id="error">


                    <?php echo $errorreport; ?>

                </div>

                <div class="col-md-11" style="color:#063;" align="center" id="error">


                    <?php echo $successreport; ?>

                </div>


            </div>


        </form>


    </div>

</div>


</body>

</html>
