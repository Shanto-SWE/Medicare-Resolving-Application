<?php

session_start();
require_once './classes/Server.php';

if (!isset($_SESSION["admin_id"])) {
    header("location:logout.php");
}

$data = '';
$result = '';

$server = new Server();
$result = $server->adminData();

if (isset($_GET['view'])) {
    $data = $server->viewPharmacistData($_GET);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>CMS</title>
        <style>
            .center{
                height: 20%;
                width: 35%;
                border: 1px solid;
                margin: 15% auto;
                padding: 2%
            }
            h3{
                color: red;
                font-family: 'Rajdhani', sans-serif;

            }
        </style>
        <?php include './parts/css-links.php'; ?>

    </head>

    <body>
        <div class="main-wrapper">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="header">
                    <?php include './parts/top-nav.php'; ?>
                </div>
                <div class="sidebar" id="sidebar">
                    <?php include './parts/side-nav.php'; ?>
                </div>
            <?php } ?>
            <?php while ($row = $data->fetch_assoc()) { ?>
                <div class="page-wrapper">
                    <div class="content">
                        <div class="row">
                            <div class="col-sm-4 col-3">
                                <h4 class="page-title">Pharmacist's Profile</h4>
                            </div>
                            <div class="col-sm-8 col-9 text-right m-b-20">
                                <a href="pharmacist.php" class="btn btn-primary btn-rounded float-right"><i class="fa fa-user-md"></i> All Pharmacist</a>
                                <form method="POST" action="update-pharmacist.php">
                                    <input type="hidden" name="pharmacist_id" value="<?php echo $row['user_id'] ?>" required/>
                                    <button name="show" class="btn btn-primary btn-rounded float-right"><i class="fa fa-pencil"></i> Edit Profile</button>
                                </form>
                            </div>
                        </div>
                        <div class="card-box profile-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="profile-view">
                                        <div class="profile-img-wrap">
                                            <div class="profile-img">
                                                <a href="#"><img class="" src="<?php echo $row['photo'] ?>" onerror="this.onerror=null; this.src='../gallery/propic/pharmacist/woman-6108822_1280.webp'" alt=""></a>
                                            </div>
                                        </div>
                                        <div class="profile-basic">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="">
                                                        <h3 class="user-name m-t-0 mb-0"><?php echo $row['first_name'] . ' ' . $row['last_name'] ?></h3>
                                                        <div class="staff-id">Pharmacist ID : <?php echo $row['user_id'] ?></div>
                                                   
                                                        <small class="text-muted">Position: <?php echo $row['role'] ?></small><br>
                                                        
                                                        <br>
                                                       
                                                    </div>
                                                </div>
                                                <div class="col-md-7">
                                                    <ul class="personal-info">
                                                        <li>
                                                            <span class="title">Phone:</span>
                                                            <span class="text"><a href="#"><?php echo $row['phone'] ?></a></span>
                                                            <?php if ($row['phone'] == "") {echo "<br>";}?>
                                                        </li>
                                                        <li>
                                                            <span class="title">Email:</span>
                                                            <span class="text"><a href="mailto:<?php echo $row['email'] ?>?Subject=" target="_top"><?php echo $row['email'] ?></a></span>
                                                            <?php if ($row['email'] == "") {echo "<br>";}?>  
                                                        </li>
                                                 
                                                        <li>
                                                            <span class="title">Gender:</span>
                                                            <span class="text"><?php echo $row['gender'] ?></span>
                                                            <?php if ($row['gender'] == "") {echo "<br>";}?>
                                                        </li>
                                                        <li>
                                                            <span class="title">Role:</span>
                                                            <span class="text"><?php echo $row['role'] ?></span>
                                                            <?php if ($row['role'] == "") {echo "<br>";}?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                    </div>

                </div>
            <?php } ?>
        </div>
        <div class="sidebar-overlay" data-reff=""></div>
        <script src="assets/js/jquery-3.2.1.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/app.js"></script>
    </body>


    <!-- Mirrored from dreamguys.co.in/preclinic/template/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 18 Nov 2019 07:31:33 GMT -->
</html>