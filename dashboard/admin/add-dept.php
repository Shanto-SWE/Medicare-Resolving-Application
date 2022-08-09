<?php

session_start();
$adminid = $_SESSION['admin_id'];

if (!isset($_SESSION["admin_id"])) {
    header("location:logout.php");
}

require_once './classes/Server.php';
$output = "";
$data ="";

$server = new Server();
$data = $server->adminData();

if (isset($_POST['save'])) {
    $output = $server->addDept($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
        <title>CMS</title>
        <?php include './parts/css-links.php'; ?>
        <style>
            form, select, h4{
                font-family: 'Ubuntu', sans-serif;
                font-size: 25px
            }

        </style>
    </head>

    <body>
        <div class="main-wrapper">
            <?php while ($row = $data->fetch_assoc()) { ?>
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
                        <div class="col-sm-8">
                            <h4 class="page-title"><u>Create Department</u><span style="color: green"> &ensp; <?php echo $output ?></span></h4>
                        </div>
                        <div class="col-sm-4 col-9 text-right m-b-20">
                            <a href="departments.php" class="btn btn-primary btn-rounded float-right"><i class="fa fa-book"></i> View All</a>
                        </div>
                    </div>
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="card-box">
                            <h3 class="card-title">Basic Informations</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="profile-img-wrap">
                                        <img class="inline-block" src="" onerror="this.onerror=null; this.src='assets/img/medical.jpg'" alt="user" id="output">
                                        <div class="fileupload btn">
                                            <span class="btn-text">Upload</span>
                                            <input class="upload" type="file" onchange="loadFile(event)" name="picture">
                                        </div>
                                    </div>
                                    <script>
                                        var loadFile = function (event) {
                                            var output = document.getElementById('output');
                                            output.src = URL.createObjectURL(event.target.files[0]);
                                        };
                                    </script>
                                    <div class="profile-basic">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <label class="focus-label">Department Name</label>
                                                    <input type="text" class="form-control floating" name="dept_name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <label class="focus-label">Department ID</label>
                                                    <input type="text" class="form-control floating" name="dept_id" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <label class="focus-label">Created On</label>
                                                    <div class="cal-icon">
                                                        <input class="form-control floating datetimepicker" type="text" name="created_on" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus select-focus">
                                                    <label class="focus-label">Status</label>
                                                    <select class="select form-control floating" name="status" required>
                                                        <option value="1" selected>Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-box" style="min-height:200px">
                            <h3 class="card-title">Short Description</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-focus">
                                        <textarea class="form-control floating" style="min-height: 100px;resize: none" cols="30" name="description" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center m-t-20">
                            <button class="btn btn-primary submit-btn" name="save" type="submit">Save</button>
                        </div>
                    </form>
                </div>
                <?php include './parts/messages.php'; ?>
            </div>
        </div>
        <div class="sidebar-overlay" data-reff=""></div>
        <script src="assets/js/jquery-3.2.1.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/select2.min.js"></script>
        <script src="assets/js/moment.min.js"></script>
        <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
        <script src="assets/js/app.js"></script>
    </body>

</html>