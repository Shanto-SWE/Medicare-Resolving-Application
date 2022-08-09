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
$result = $server->viewData();


if (isset($_POST['show'])) {
    $data = $server->viewStockData($_POST);
}

if (isset($_POST['save'])) {
    $updateData = $server->updateStock($_POST);
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
            
            
            <?php while ($row = $data->fetch_assoc()) { ?>

                <div class="page-wrapper">
                    <div class="content">
                    <div class="row">
                        <div class="col-sm-4 col-3">
                        <h4 class="page-title"><u>Update Stock Details</u>
                                    <?php
                                    echo '<span style="color:red">' . $updateData . '</span>';
                                    ?>
                                </h4>
                        </div>
                        <div class="col-sm-8 col-9 text-right m-b-20">
                            <a href="manage-stock.php" class="btn btn-primary btn-rounded float-right"><i class="fa fa-address-book"></i>&nbsp;Stocks</a>
                        </div>
                    </div>
               <div class="row">
               
               <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  
           
                  <form class="forms-sample" method="POST" action = "">
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Drug Name</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="exampleInputUsername2" name="drug_name" value="<?php echo $row['drug_name'] ?>" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Category</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="exampleInputEmail2" name="category" value="<?php echo $row['category'] ?>" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Description</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="exampleInputMobile" name="description" value="<?php echo $row['description'] ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Company</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="exampleInputPassword2" name="company" value="<?php echo $row['company'] ?>" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Supplier</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="exampleInputConfirmPassword2" name="supplier" value="<?php echo $row['supplier'] ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Quantity</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="exampleInputConfirmPassword2" name="quantity" value="<?php echo $row['quantity'] ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Cost</label>
                      <div class="col-sm-9">
                        
                      
                      <input type="text" class="form-control" id="exampleInputConfirmPassword2" name="cost" value="<?php echo $row['cost'] ?>">
                      <input type="hidden" class="form-control" id="exampleInputConfirmPassword2" name="stock_id" value="<?php echo $row['stock_id'] ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Status</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="exampleInputConfirmPassword2" name="status" value="<?php echo $row['status'] ?>">
                      </div>
                    </div>
                    <button type="submit" name="save" class="btn btn-block btn-primary class="mr-4" style="display:inline-block;">Update</button>
                   
                  </form>
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
        <script src="assets/js/select2.min.js"></script>
        <script src="assets/js/moment.min.js"></script>
        <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
        <script src="assets/js/app.js"></script>
    </body>


    <!-- Mirrored from dreamguys.co.in/preclinic/template/edit-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 18 Nov 2019 07:31:38 GMT -->
</html>

