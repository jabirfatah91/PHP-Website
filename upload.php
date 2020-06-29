<?php

include_once 'dbconnect.php';

// fetch files
$con = mysqli_connect($host, $user, $pass, $db, $port) or die("Error " . mysqli_error($con));
$sql = "select filename from tbl_files";
$result = mysqli_query($con, $sql);
?>
<?php

if (isset($_POST['submit'])) {
    $filename = $_FILES['file1']['name'];

    //upload file
    if ($filename != '') {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $allowed = ['pdf', 'txt', 'doc', 'docx', 'png', 'jpg', 'jpeg', 'JPG', 'gif', 'mp3', 'mp4', 'xls', 'xlsx', 'csv', 'xlsm'];

        //check if file type is valid
        if (in_array($ext, $allowed)) {
            // get last record id
            $sql = 'select max(id) as id from tbl_files';
            $result = mysqli_query($con, $sql);
            if (count($result) > 0) {
                $row = mysqli_fetch_array($result);
                $filename = $filename;
            } else
                $filename = $filename;

            //set target directory
            $path = 'uploads/';

            $created = @date('Y-m-d H:i:s');
            move_uploaded_file($_FILES['file1']['tmp_name'], ($path . $filename));

            // insert file details into database
            $sql = "INSERT INTO tbl_files(filename, created) VALUES('$filename', '$created')";
            mysqli_query($con, $sql);
            header("Location: upload-page.php?st=success");
        } else {
            header("Location: upload-page.php?st=error");
        }
    } else
        header("Location: upload-page.php");
}
?>