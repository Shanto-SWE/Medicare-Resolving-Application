<?php

session_start();
require_once './classes/Server.php';

if (!isset($_SESSION["user_id"])) {
   header("location:logout.php");
}
$data = '';
$dept = '';
$updateData = '';
$result = "";

$server = new Server();
$result = $server->adminData();


if (isset($_POST['show'])) {
    $data = $server->viewPharmacistData($_POST);
}

if (isset($_POST['save'])) {
    $updateData = $server->updatePharamacist($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>CMS</title>
        <style>
            label, h3{
                font-family: 'Rajdhani', sans-serif !important;
            }
            form input,textarea{
                border: 1px solid !important;
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
            
            <?php echo $updateData; ?>
            <?php while ($row = $data->fetch_assoc()) { ?>
          
                <div class="page-wrapper">
                    <div class="content">
                        <div class="row">
                            <div class="col-sm-4 col-3">
                                <h4 class="page-title"><u>Update Phamacist's Profile</u>
                                    <?php
                                    echo '<span style="color:red">' . $updateData . '</span>';
                                    ?>
                                </h4>
                            </div>
                            <div class="col-sm-8 col-9 text-right m-b-20">
                                <a href="phamacist.php" class="btn btn-primary btn-rounded float-right"><i class="fa fa-user-md"></i> Phamacist</a>
                            </div>
                        </div>
                        <form method="POST" action = "" enctype="multipart/form-data">
                            <div class="card-box">
                                <h3 class="card-title">Basic Informations</h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="profile-img-wrap">
                                            <img class="inline-block" src="<?php echo $row['photo'] ?>" onerror="this.onerror=null; this.src='assets/img/user.jpg'" alt="user" id="output">
                                            <div class="fileupload btn">
                                                <span class="btn-text">change</span>
                                                <input class="upload" type="file" onchange="loadFile(event)" name="photo">
                                            </div>
                                            <?php
                                            $oldpic = $row['photo'];
                                            $_SESSION['oldpic'] = $oldpic;
                                            ?>
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
                                                        <label class="focus-label">First Name<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control floating" name = "first_name" value = "<?php echo $row['first_name']; ?>" required >
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <label class="focus-label">Last Name</label>
                                                        <input type="text" class="form-control floating" name = "last_name" value = "<?php echo $row['last_name']; ?>" required>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus select-focus">
                                                        <label class="focus-label">Gender<span class="text-danger">*</span></label>
                                                        <select class="select form-control floating" name="gender" >
                                                            <?php if ($row['gender'] == 'Male') { ?>
                                                                <option value="Male" selected>Male</option>
                                                                <option value="Female">Female</option>
                                                            <?php } else {
                                                                ?>
                                                                <option value="Male">Male</option>
                                                                <option value="Female" selected>Female</option>
                                                            <?php }
                                                            ?>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-box">
                                <h3 class="card-title">Contact Informations</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <label class="focus-label">Phone Number<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control floating" name = "phone" value="<?php echo $row['phone'] ?>" required>
                                        </div>
                                    </div>
                                    
                                   
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <label class="focus-label">Email<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control floating" name="email" value="<?php echo $row['email'] ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         
                           
                           
                            
                            <div class="card-box">
                                <h3 class="card-title">Authentication Information </h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <label class="focus-label">Username<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control floating" name = "username" value = "<?php echo $row['user_name']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <label class="focus-label">Password<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control floating" name = "password" value = "<?php echo $row['password']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <label class="focus-label">User ID <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control floating" name="pharmacist_id" value = "<?php echo $row['user_id']; ?>"  readonly>
                                            <input type="hidden" class="form-control floating" name="id" value = "<?php echo $row['id']; ?>"  >
                                        </div>
                                    </div>
                                </div>
                
                            </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn" type="submit" name="save">Submit</button>
                            </div>
                        </form>
                    </div>
                    <?php include './parts/messages.php'; ?>
                </div>
            <?php } ?>
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


    <!-- Mirrored from dreamguys.co.in/preclinic/template/edit-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 18 Nov 2019 07:31:38 GMT -->
</html>