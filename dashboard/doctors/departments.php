<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("location:logout.php");
}

require_once './classes/Server.php';
$result = "";
$depts = "";

$server = new Server();
$result = $server->viewData();
$depts = $server->DeptData();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
        <title>CMS</title>
        <?php include './parts/css-links.php'; ?>

    </head>

    <body>
        <div class="main-wrapper">
            <?php while ($row = $result->fetch_assoc()) { ?>

                <?php
                if ($row['doctor_status'] == 0) {
                    echo "<script type='text/javascript'>alert('SORRY! YOU ARE BLOCKED!');document.location='logout.php';</script>";
                }
                ?>
                <div class="header">
                    <?php include './parts/top-nav.php'; ?>
                </div>
                <div class="sidebar" id="sidebar">
                    <?php include './parts/side-nav.php'; ?>
                </div>
            <?php } ?>
            <div class="page-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-4 col-3"><h4 class="page-title"><u>DEPARTMENTS</u></h4></div>
                        <div class="col-sm-8 col-9 text-right m-b-20">
                            <a href="add-doctor.php" class="btn btn-primary btn-rounded float-right"><i class="fa fa-search"></i> </a>
                        </div>
                    </div>
                    <div class="row doctor-grid">
                        <?php
                        if ($depts->num_rows > 0) {
                            while ($row = $depts->fetch_assoc()) {
                                ?>
                                <div class="col-md-4 col-sm-4  col-lg-3">
                                    <div class="profile-widget">
                                        <div class="doctor-img">
                                            <a class="avatar" href="#">
                                                <img alt="" src="<?php echo $row['picture'] ?>" onerror="this.onerror=null; this.src='assets/img/medical.jpg'" alt="">
                                            </a>
                                        </div>
                                        <div class="dropdown profile-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="department-details.php?dept_id=<?php echo $row['dept_id'] ?>" />
                                                <i class="fa fa-book m-r-5"></i> Details
                                                </a>
                                            </div>
                                        </div>
                                        <h4 class="doctor-name text-ellipsis"><a href="profile.html"><?php echo $row['dept_name']; ?></a></h4>
                                        <div class="doc-prof">Department ID: &nbsp;<?php echo $row['dept_id'] ?></div>
                                        <?php if ($row['status'] == 1) { ?>
                                            Status: <span style="color:green">ACTIVE</span>
                                        <?php } else {
                                            ?>
                                            Status: <span style="color:red">INACTIVE</span>
                                        <?php }
                                        ?>

                                    </div>
                                </div>



                                <?php
                            }
                        } else {
                            ?>
                            <div class="col-md-12 col-sm-12  col-lg-12">
                                <div class="profile-widget">
                                    <center>
                                        <img alt="" src="../gallery/NoRecordFound.jpg" alt="" style="height: 100%;width: 100%">
                                    </center>
                                </div>
                            </div>
                        <?php }
                        ?>


                    </div>
                </div>
                <?php include './parts/messages.php'; ?>
            </div>
        </div>
        <?php include './parts/js-links.php'; ?>

    </body>
</html>