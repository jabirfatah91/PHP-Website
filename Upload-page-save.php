<?php include('includes/header-admin-login.php'); ?>
<?php
include_once 'dbconnect.php';

$con = mysqli_connect($host, $user, $pass, $db, $port) or die("Error " . mysqli_error($con));
$sql = "select filename from tbl_files";
$result = mysqli_query($con, $sql);
?>
<?php
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

        <style>
            #logout-text{

            } 

        </style>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" >
        <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                                <div class="alert alert-danger text-center">
                                    <?php
                                    if ($_GET['st'] == 'success') {
                                        echo "File Uploaded Successfully!";
                                    } else {
                                        echo 'Invalid File Extension!';
                                    }
                                    ?>
                                </div>
                            <?php } ?>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-8 col-xs-offset-2">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>File</th>
                                    <th>File Name</th>
                                    <th>View</th>
                                    <th>Download</th>
                                    <th>Delete</th>
                                    <th>Share</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $row['filename']; ?></td>
                                        <td><a href="uploads/<?php echo $row['filename']; ?>" target="_blank">View</a></td>
                                        <td><a href="uploads/<?php echo $row['filename']; ?>" download>Download</a></td>
                                        <td>
                                            <!--trying to delete the file: starts-->
                                            <a href="?delete=1">
                                                <i class = "fa fa-trash-o" style="color:red"></i>
                                            </a>
                                            <?php
                                            $current_file_name = $row['filename'];
                                            if (isset($_GET['delete'])) {
                                                if (is_file($_SERVER['uploadfile.se/'] . 'uploads/' . $current_file_name)) {
                                                    unlink($_SERVER['uploadfile.se/'] . 'uploads/' . $current_file_name);
                                                    $stmt = $con->prepare("DELETE FROM tbl_files WHERE filename = ?");
                                                    $stmt->bind_param('s', $current_file_name);
                                                    $result = $stmt->execute();
                                                    $stmt->close();
                                                }
                                            }
                                            ?>

                                            <!--trying to delete the file: ends-->
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
        </div>
</html>
<?php include('includes/footer.php'); ?>
