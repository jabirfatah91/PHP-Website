<?php include('includes/header-admin-login.php'); ?>
<?php
include_once 'dbconnect.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
define('ROOTPATH', dirname(__FILE__));

$mysqli = new mysqli($host, $user, $pass, $db, $port);

if ($mysqli === false) {
    echo $current_file_name;
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


$con = mysqli_connect($host, $user, $pass, $db, $port) or die("Error " . mysqli_error($con));
$sql = "select filename from tbl_files";
$result = mysqli_query($con, $sql);
?>
<?php



if (isset($_GET['delete'])) {
    // get value of id that sent from address bar 
    $delete_id = base64_decode($_GET['delete']);

    $sql = "SELECT * FROM `tbl_files` WHERE id=$delete_id";
    $getfile = $mysqli->query($sql);

    $current_file_name = $getfile->fetch_assoc();

   if (file_exists(ROOTPATH.'/uploads/'.$current_file_name)) {
unlink(ROOTPATH. '/uploads/' . $current_file_name);
     

    // Delete data in mysql from row that has this id 
    $sql = "DELETE FROM `tbl_files` WHERE id='$delete_id'";
    $result = $mysqli->query($sql);

    // if successfully deleted
    if ($result) {
        echo "Deleted Successfully";
        echo "<BR>";
    } else {
        echo "Delete ERROR";
    }


    }
}


$sql = "SELECT * FROM `tbl_files`";
$result = $mysqli->query($sql);
?>

<?php
ob_start();
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: admin-login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: admin-login.php");
}
?>
<html>
    <head>

        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta content="width=device-width, initial-scale=1.0" name="viewport" >
        <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />



    </head>
    <div id="content">


        <div class="box-section contact-section triggerAnimation animated" data-animate="flipInY">
            <div class="container">
                <!--logout starts-->

                <div class="content-logout">
                    <!-- notification message -->
                    <?php if (isset($_SESSION['success'])) : ?>
                        <div class="error success" >
                            <h3>
                                <?php
                                echo $_SESSION['success'];
                                unset($_SESSION['success']);
                                ?>
                            </h3>
                        </div>
                    <?php endif ?>

                    <!-- logged in user information -->
                    <?php if (isset($_SESSION['username'])) : ?>
                        <div class = "logout-text text-right">
                            <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
                            <p> <a href="admin-login.php?logout='1'" class="btn btn-danger btn-md">Logout</a> </p>
                        <?php endif ?>
                    </div>
                </div>
                <!--logout ends-->

                <div class="row">

                    <div class="col-xs-8 col-xs-offset-2 well">
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                            <legend>Select File to Upload:</legend>
                            <div class="form-group">
                                <input type="file" name="file1" />
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" value="Upload" class="btn btn-info"/>

                            </div>
                            <?php if (isset($_GET['st'])) { ?>
                                <div class="alert alert-info text-center">
                                    <?php
                                    if ($_GET['st'] == 'success') {
                                        echo "<p style = 'color: green'>" ."File Uploaded Successfully!". "</p>"; 
                                    } else {
                                        echo "<p style = 'color: red'>" ."Invalid File Extension!". "</p>";
                                    }
                                    ?>
                                </div>
                            <?php } ?>
                        </form>
                    </div>
                </div>

                <div class="row table-responsive">
                    <div class="col-xs-8 col-xs-offset-2">
                        <table class="table table-striped  table-hover">
                            <thead class = "thead-dark">
                                <tr>
                                    <th>File</th>
                                    <th>File Name</th>
                                    <th>View</th>
                                    <th>Download</th>

                                    <th>Remove</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                 $i = 1;
            if ($result->num_rows > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $row['filename']; ?></td>
                                        <td><a href="uploads/<?php echo $row['filename']; ?>" target="_blank">View</a></td>
                                        <td><a href="uploads/<?php echo $row['filename']; ?>" download><i class = "fa fa-download"></i></a></td>


                                        <td>
                                            <!--trying to delete the file: starts-->
                                           <a href="?delete=<?php echo base64_encode($row['id']); ?>" >
                                <i class = "fa fa-trash-o" style="color:red"></i>
                            </a>
                                        
                                            <!--trying to delete the file: ends-->
                                        </td>

                                    </tr>
                                <?php }
} $mysqli->close(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
        </div>
</html>
<?php include('includes/footer.php'); ?>
